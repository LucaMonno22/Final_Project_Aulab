<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
    public $announcement_id;

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $exists = Cart::where('user_id', Auth::id())
            ->where('announcement_id', $this->announcement_id)
            ->exists();

        if (!$exists) {
            Cart::create([
                'user_id' => Auth::id(),
                'announcement_id' => $this->announcement_id
            ]);

            // AVVISA LA NAVBAR DI AGGIORNARE IL NUMERO
            $this->dispatch('cartUpdated');
        }
    }

    public function render()
    {
        $inCart = false;
        if (Auth::check()) {
            $inCart = Cart::where('user_id', Auth::id())
                ->where('announcement_id', $this->announcement_id)
                ->exists();
        }

        return view('livewire.add-to-cart', compact('inCart'));
    }
}
