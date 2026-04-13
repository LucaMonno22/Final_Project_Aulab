<div class="container my-5 pt-5">
    <div class="row">
        {{-- Titolo Pagina --}}
        <div class="col-12 mb-4 border-bottom pb-3">
            <h1 class="fw-bold text-uppercase">
                <i class="bi bi-cart3 me-2" style="color: var(--komerz-blue);"></i>{{ __('ui.cart') }}
            </h1>
        </div>

        @if ($cartItems->count() > 0)
            {{-- COLONNA SINISTRA: LISTA ARTICOLI --}}
            <div class="col-lg-8">
                @foreach ($cartItems as $item)
                    <div class="card mb-3 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="row g-0 align-items-center">
                            {{-- Immagine (Usa la tua logica dei Job) --}}
                            <div class="col-3 col-md-2 text-center bg-light">
                                <img src="{{ $item->announcement->images->isNotEmpty() ? $item->announcement->images->first()->getUrl(600, 400) : 'https://picsum.photos/600/400' }}"
                                    class="img-fluid" style="max-height: 100px; object-fit: contain;">
                            </div>
                            {{-- Titolo e Prezzo --}}
                            <div class="col-6 col-md-7 px-3">
                                <h6 class="fw-bold mb-1 text-dark">
                                    {{ $item->announcement->getTranslated('title', app()->getLocale()) }}
                                </h6>
                                <p class="text-success fw-bold mb-0">
                                    {{ number_format($item->announcement->price, 2) }} {{ __('ui.currency') }}
                                </p>
                            </div>
                            {{-- Tasto Rimuovi --}}
                            <div class="col-3 col-md-3 text-end px-3">
                                <button wire:click="removeFromCart({{ $item->id }})"
                                    class="btn btn-outline-danger border-0">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- COLONNA DESTRA: RIEPILOGO E TOTALE --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 bg-light">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">{{ __('ui.total') }}</h5>
                    <div class="d-flex justify-content-between fs-4 fw-bold text-dark mb-4">
                        <span>{{ __('ui.total') }}:</span>
                        <span style="color: var(--komerz-blue);">{{ number_format($total, 2) }}
                            {{ __('ui.currency') }}</span>
                    </div>

                    {{-- Bottone per andare al Checkout con effetto Zoom verso L'INTERNO --}}
                    <a href="{{ route('checkout') }}"
                        class="btn btn-primary btn-checkout-sink w-100 py-3 fw-bold rounded-pill text-uppercase border-0 shadow-sm"
                        style="background-color: var(--komerz-blue); color: white !important; transition: all 0.1s ease-in-out;">
                        {{ __('ui.checkout') }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        @else
            {{-- MESSAGGIO CARRELLO VUOTO --}}
            <div class="col-12 text-center py-5">
                <i class="bi bi-cart-x display-1 text-muted opacity-50"></i>
                <h4 class="mt-3 text-muted">{{ __('ui.emptyCart') }}</h4>

                <a href="{{ route('index') }}#articles-section"
                    class="btn btn-primary btn-back-home mt-3 rounded-pill px-4 shadow-sm border-0"
                    style="background-color: var(--komerz-blue); color: white !important; transition: all 0.2s ease-in-out; display: inline-block;">
                    {{ __('ui.backToHome') }}
                </a>
            </div>
        @endif
    </div>
</div>
