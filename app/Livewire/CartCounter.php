<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 

class CartCounter extends Component 
{
    public $count = 0;

    // Calcola il numero iniziale al caricamento della pagina
    public function mount() 
    {
        $this->updateCount();
    }

    // Ascolta l'evento "cartUpdated" per aggiornare il numero senza refresh
    #[On('cartUpdated')] 
    public function updateCount() 
    {
        if (Auth::check()) {
            $this->count = Cart::where('user_id', Auth::id())->count();
        } else {
            $this->count = 0;
        }
    }

    public function render() 
    {
        return view('livewire.cart-counter');
    }
}
