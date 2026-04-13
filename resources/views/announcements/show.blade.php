<x-layout>
    <div class="container my-5">
        {{-- BOTTONE TORNA INDIETRO PERSONALIZZATO --}}
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('index') }}" class="btn btn-komerz shadow-sm px-4 py-2">
                    {{ __('ui.backToHome') }} <i class="bi bi-house-door ms-2"></i>
                </a>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-12 border-bottom pb-3">
                <h1 class="text-center fw-bold text-dark text-uppercase">{{ __('ui.articleDetail') }}</h1>
            </div>
        </div>

        <div class="row justify-content-center align-items-start g-5">
            {{-- COLONNA SINISTRA: CAROUSEL IMMAGINI --}}
            <div class="col-12 col-md-6">
                <div class="p-2 border rounded-4 bg-white shadow-sm">
                    @if ($announcement->images->count() > 0)
                        <div id="carouselDetail" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-3">
                                @foreach ($announcement->images as $key => $image)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img src="{{ $image->getUrl(600, 400) }}"
                                            class="d-block w-100 rounded shadow-sm"
                                            alt="Immagine {{ $key + 1 }} di {{ $announcement->title }}"
                                            style="height: 450px; width: 100%; object-fit: contain; background-color: #f8f9fa;">
                                    </div>
                                @endforeach
                            </div>

                            @if ($announcement->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDetail"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark rounded-circle"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselDetail"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark rounded-circle"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    @else
                        <img src="https://picsum.photos/600/450" class="img-fluid rounded-3"
                            alt="Nessuna immagine disponibile">
                    @endif
                </div>
            </div>

            {{-- COLONNA DESTRA: DETTAGLI E PREZZO --}}
            <div class="col-12 col-md-6">
                <div
                    class="p-4 bg-light rounded-4 shadow-sm h-100 border-start border-primary border-4 d-flex flex-column">
                    <div class="mb-auto">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            {{-- TITOLO TRADOTTO --}}
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $announcement->getTranslated('title', app()->getLocale()) }}
                            </h2>

                            <span class="badge bg-success fs-5 shadow-sm">
                                {{ number_format($announcement->price, 2) }} {{ __('ui.currency') }}
                            </span>
                        </div>

                        <p class="text-muted small text-uppercase mb-4">
                            <i class="bi bi-tag-fill me-1"></i> {{ __('ui.' . $announcement->category->name) }}
                        </p>

                        <h5 class="fw-bold border-bottom pb-2">{{ __('ui.description') }}</h5>

                        {{-- DESCRIZIONE TRADOTTA --}}
                        <p class="fs-5 text-break text-secondary" style="line-height: 1.6;">
                            {{ $announcement->getTranslated('description', app()->getLocale()) }}
                        </p>

                    </div>
                    {{-- MODIFICA TASTO / STATO VENDUTO --}}
                    <div class="mt-4 pt-4 border-top">
                        <div class="d-grid gap-2 justify-content-center">
                            @if ($announcement->is_sold)
                                <div class="alert alert-danger text-center fw-bold text-uppercase mb-0 shadow-sm">
                                    <i class="bi bi-x-circle-fill me-2"></i> {{ __('ui.sold') }}
                                </div>
                            @else
                                @livewire(
                                    'add-to-cart',
                                    [
                                        'announcement_id' => $announcement->id,
                                    ],
                                    key('cart-show-' . $announcement->id),
                                )
                            @endif
                        </div>

                        {{-- Icona di sicurezza sotto il tasto --}}
                        <p class="text-muted small mt-3 text-center mb-0">
                            <i class="bi bi-shield-check text-success me-1"></i> {{ __('ui.securePayment') }}
                        </p>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>
</x-layout>