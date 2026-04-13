<div> {{-- Tag radice obbligatorio per Livewire 3 --}}
    @if ($inCart)
        <button class="btn btn-sm btn-outline-secondary disabled rounded-pill px-3 shadow-none border-0">
            <i class="bi bi-cart-check-fill me-1"></i> {{ __('ui.alreadyInCart') }}
        </button>
    @else
        <button wire:click="addToCart" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm text-white border-0"
            style="background-color: var(--komerz-blue);">
            <i class="bi bi-cart-plus me-1"></i> {{ __('ui.addToCart') }}
        </button>
    @endif
</div>
