<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartPage extends Component
{
    // Metodo per rimuovere un articolo e avvisare la Navbar di aggiornare il numero
    public function removeFromCart($cartId)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $cartId)->first();
        if ($cartItem) {
            $cartItem->delete();
            // Lanciamo l'evento che già conosciamo per aggiornare l'icona in alto
            $this->dispatch('cartUpdated'); 
        }
    }

    public function render()
    {
        // Recuperiamo gli articoli dell'utente loggato con i dati dell'annuncio
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('announcement') 
            ->get();

        // Calcoliamo la somma totale dei prezzi degli annunci nel carrello
        $total = $cartItems->sum(function($item) {
            return $item->announcement->price;
        });

        // Specifichiamo di usare il tuo x-layout principale
        return view('livewire.cart-page', compact('cartItems', 'total'))->layout('components.layout');
    }
}