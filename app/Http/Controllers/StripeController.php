<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmed;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function index()
    {
        return view('stripe');
    }

    public function store(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // 1. SICUREZZA: Recuperiamo il carrello reale dal Database
        $cartItems = Cart::where('user_id', Auth::id())->with('announcement')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('index')->with('errorMessage', __('ui.noResults'));
        }

        // 2. CALCOLO SERVER-SIDE: Il prezzo lo decidiamo noi qui, non l'utente
        $realPrice = $cartItems->sum(function($item) {
            return $item->announcement->price;
        });

        try {
            // 3. PAGAMENTO: Usiamo $realPrice * 100 (Stripe preleva i centesimi corretti)
            $charge = Charge::create([
                'amount' => (int)($realPrice * 100), 
                'currency' => 'eur',
                'source' => $request->stripeToken,
                'description' => 'Acquisto sicuro su Komerz da ' . Auth::user()->name,
            ]);

            $brand = $charge->source->brand;

            // 4. CREAZIONE ORDINE: Salviamo il prezzo reale nel DB degli ordini
            $order = Order::create([
                'user_id' => Auth::id(),
                'address' => $request->address, 
                'city' => $request->city,
                'total_price' => $realPrice,
                'status' => 'paid',
            ]);

            foreach ($cartItems as $item) {
                // Aggiorniamo la colonna is_sold nel database degli annunci
                $item->announcement->update([
                    'is_sold' => true
                ]);
            }

            // 5. INVIO EMAIL (Maildev)
            Mail::to(Auth::user()->email)->send(new OrderConfirmed($order, $brand));

            // 6. SVUOTA CARRELLO
            Cart::where('user_id', Auth::id())->delete();

            // 7. FEEDBACK: Successo multilingua sulla Home
            session()->flash('paymentSuccess', __('ui.orderCompleted') . ' ' . __('ui.emailSent') . ' ' . Auth::user()->email);
            
            return redirect()->route('index');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
