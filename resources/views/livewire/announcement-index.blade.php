<div>
    @if (session('success'))
        <div id="announcements-section" class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div
                        class="alert alert-revisor-success shadow-sm d-flex align-items-center justify-content-center border-0 rounded-4">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-5">
        {{-- COLONNA FILTRI A SINISTRA --}}
        <div class="col-md-2 border-end">
            <div style="top: 110px; z-index: 1000;">
                <h6 class="fw-bold mb-3 text-uppercase small ms-3" style="letter-spacing: 1px;">{{ __('ui.categories') }}
                </h6>
                <div class="mt-2">
                    @foreach ($categories as $category)
                        <div class="form-check mb-2 ms-3">
                            <input class="form-check-input shadow-none border-secondary" type="checkbox"
                                value="{{ $category->id }}" wire:model.live="category_ids" id="cat-{{ $category->id }}">
                            <label class="form-check-label small text-dark text-nowrap" for="cat-{{ $category->id }}">
                                {{ __("ui.$category->name") }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- COLONNA CONTENUTO A DESTRA --}}
        <div class="col-md-10">

            {{-- TOP BAR RESPONSIVA --}}
            <div class="row align-items-center mb-5 g-4">
                <div class="col-12 col-lg-7 d-flex justify-content-center justify-content-lg-end">
                    <div class="d-flex align-items-center px-3 bg-light rounded-pill border shadow-sm mx-lg-3 search-container-zoom"
                        style="height: 45px; width: 100%; max-width: 450px;">
                        <i class="bi bi-search text-muted me-2"></i>
                        <input wire:model.live.debounce.100ms="search" type="text"
                            class="form-control form-control-sm border-0 bg-transparent shadow-none p-0"
                            placeholder="{{ __('ui.searchPlaceholder') }}">
                    </div>
                </div>

                <div class="col-12 col-lg-5 d-flex justify-content-center justify-content-lg-start">
                    <div class="d-flex align-items-center px-2 gap-2 ms-lg-5" style="height: 45px;">
                        <label class="fw-bold text-muted small text-uppercase mb-0 me-1 text-nowrap d-none d-xl-block">
                            {{ __('ui.orderBy') }}
                        </label>

                        <div class="form-check form-check-inline mb-0 mx-0 text-nowrap">
                            <input class="form-check-input shadow-none" type="radio" wire:model.live="sort"
                                name="sortOptions" id="sortDesc" value="desc">
                            <label class="form-check-label small text-dark" for="sortDesc">{{ __('ui.recent') }}</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 mx-0 text-nowrap">
                            <input class="form-check-input shadow-none" type="radio" wire:model.live="sort"
                                name="sortOptions" id="sortAsc" value="asc">
                            <label class="form-check-label small text-dark" for="sortAsc">{{ __('ui.oldest') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GRIGLIA ANNUNCI --}}
            <div class="row">
                @forelse ($announcements as $announcement)
                    <div class="col-12 col-md-6 col-lg-4 mb-5">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden">

                            {{-- LOGICA IMMAGINE INTEGRATA --}}
                            <img src="{{ $announcement->images->isNotEmpty() ? $announcement->images->first()->getUrl(600, 400) : 'https://picsum.photos/600/400' }}"
                                class="card-img-top"
                                alt="{{ $announcement->getTranslated('title', app()->getLocale()) }}"
                                style="height: 230px; width: 100%; object-fit: contain; background-color: #f8f9fa;">

                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <a href="{{ route('category_show', $announcement->category) }}"
                                        class="text-decoration-none">
                                        <span class="badge bg-primary text-white" style="font-size: 0.7rem;">
                                            {{ __("ui.{$announcement->category->name}") }}
                                        </span>
                                    </a>

                                    <span class="fw-bold text-success">
                                        {{ number_format($announcement->price, 2) }} {{ __('ui.currency') }}
                                    </span>
                                </div>

                                <a href="{{ route('show', $announcement->id) }}" class="text-decoration-none">
                                    <h5 class="card-title fw-bold text-dark h6">
                                        {{ $announcement->getTranslated('title', app()->getLocale()) }}
                                    </h5>
                                </a>

                                <p class="card-text text-muted small" style="font-size: 0.8rem;">
                                    {{ Str::limit($announcement->getTranslated('description', app()->getLocale()), 80) }}
                                </p>
                            </div>

                            <div
                                class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center pb-3">
                                <small class="text-secondary" style="font-size: 0.7rem;">
                                    {{ __('ui.from') }} <strong>{{ $announcement->user->name }}</strong>
                                </small>
                                <small class="text-muted" style="font-size: 0.65rem;">
                                    {{ $announcement->created_at->format('d/m/y') }}
                                </small>
                            </div>

                            {{-- FOOTER AZIONI: EDIT/DELETE (SINISTRA) E CARRELLO (DESTRA) --}}
                            <div
                                class="d-flex justify-content-between align-items-center p-3 border-top bg-light-subtle">
                                <div class="d-flex gap-3">
                                    @auth
                                        @if (Auth::id() == $announcement->user_id)
                                            {{-- EDIT --}}
                                            <a href="{{ route('announcements.edit', $announcement) }}"
                                                class="text-warning border-0 bg-transparent p-0 shadow-none">
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('announcements.destroy', $announcement) }}"
                                                method="POST" onsubmit="return confirm('{{ __('ui.confirmDelete') }}')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="text-danger border-0 bg-transparent p-0 shadow-none">
                                                    <i class="bi bi-trash3 fs-5"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>

                                <div>
                                    @if ($announcement->is_sold)
                                        <span class="fw-bold text-danger text-uppercase"
                                            style="letter-spacing: 1px; font-size: 0.8rem;">
                                            <i class="bi bi-x-lg me-1"></i> {{ __('ui.sold') }}
                                        </span>
                                    @else
                                        @livewire('add-to-cart', ['announcement_id' => $announcement->id], key('cart-index-' . $announcement->id))
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">{{ __('ui.noResults') }}</h4>
                    </div>
                @endforelse
            </div>

            {{-- PAGINAZIONE --}}
            <div class="mt-5 pt-4 border-top d-flex flex-column align-items-center justify-content-center">
                <div class="text-muted small">
                    {{ __('ui.showing') }} {{ $announcements->firstItem() }} - {{ $announcements->lastItem() }}
                    {{ __('ui.of') }}
                    {{ $announcements->total() }} {{ __('ui.results') }}
                </div>
                <div class="mt-3">
                    {{ $announcements->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
