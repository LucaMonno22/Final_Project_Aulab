<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order; // Lo creeremo tra poco
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CheckoutPage extends Component
{
    public $address, $city, $total;

    public function mount()
    {
        // Recuperiamo il totale dal carrello
        $this->total = Cart::where('user_id', Auth::id())->get()->sum(function ($item) {
            return $item->announcement->price;
        });

        // Se il carrello è vuoto, riportiamo l'utente alla home
        if ($this->total == 0) {
            return redirect()->route('index');
        }
    }

    // Questo metodo verrà chiamato dal tasto PayPal dopo il pagamento
    public function completeOrder()
    {
        // 1. Creiamo l'ordine effettivamente nel Database
        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $this->address,
            'city' => $this->city,
            'total_price' => $this->total,
            'status' => 'paid' // Pagamento confermato da PayPal SDK
        ]);


        // 2. INVIA L'EMAIL (Mettilo esattamente qui!)
        Mail::to(Auth::user()->email)->send(new OrderConfirmed($order));

        // 2. Svuotiamo il carrello dell'utente loggato
        // Questo cancella i record dalla tabella 'carts' per questo user_id
        Cart::where('user_id', Auth::id())->delete();

        // 3. Comunichiamo alla Navbar di tornare a 0 (Evento Livewire)
        $this->dispatch('cartUpdated');

        // 4. Messaggio di successo e ritorno alla Home (con scroll alla sezione success)
        session()->flash('success', __('ui.orderCompleted'));
        return redirect()->to(route('index') . '#announcements-section');
    }

    public function render()
    {
        return view('livewire.checkout-page')->layout('components.layout');
    }
}
