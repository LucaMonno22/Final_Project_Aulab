<x-layout>
    <div class="container my-3 pt-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('index') }}" class="btn btn-komerz shadow-sm px-4 py-2 mb-4">
                    {{ __('ui.backToHome') }} <i class="bi bi-house-door ms-2"></i>
                </a>
            </div>
        </div>
        {{-- Titolo Sezione + Filtro Ordinamento sulla stessa riga --}}
        <div class="row mb-4 align-items-center">
            <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3 mt-5">
                {{-- Titolo a Sinistra --}}
                <h2 class="fw-bold mb-0">
                    {{ __('ui.allArticles') }}:
                    <span style="color: var(--komerz-blue);">{{ __("ui.{$category->name}") }}</span>
                </h2>

                {{-- Filtro a Destra --}}
                <div class="d-flex align-items-center gap-3">
                    <label class="fw-bold text-muted small text-uppercase mb-0 d-none d-sm-block">
                        {{ __('ui.orderBy') }}
                    </label>

                    <div class="d-flex gap-2">
                        {{-- Recenti --}}
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}"
                            class="text-decoration-none small {{ $sort == 'desc' ? 'fw-bold text-dark' : 'text-muted' }}">
                            <i
                                class="bi {{ $sort == 'desc' ? 'bi-record-circle-fill text-primary' : 'bi-circle' }} me-1"></i>
                            {{ __('ui.recent') }}
                        </a>

                        {{-- Meno Recenti --}}
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}"
                            class="text-decoration-none small {{ $sort == 'asc' ? 'fw-bold text-dark' : 'text-muted' }}">
                            <i
                                class="bi {{ $sort == 'asc' ? 'bi-record-circle-fill text-primary' : 'bi-circle' }} me-1"></i>
                            {{ __('ui.oldest') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr class="mt-3">
            </div>
        </div>

        {{-- GRIGLIA ANNUNCI --}}
        <div class="row mt-4">
            @forelse ($announcements as $announcement)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        <img src="{{ $announcement->images->isNotEmpty() ? $announcement->images->first()->getUrl(600, 400) : 'https://picsum.photos/600/400' }}"
                            class="card-img-top"
                            style="height: 230px; width: 100%; object-fit: contain; background-color: #f8f9fa;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary text-white" style="font-size: 0.7rem;">
                                    {{ __("ui.{$announcement->category->name}") }}
                                </span>
                                <span class="fw-bold text-success">
                                    {{ number_format($announcement->price, 2) }} {{ __('ui.currency') }}
                                </span>
                            </div>
                            <a href="{{ route('show', $announcement->id) }}" class="text-decoration-none">
                                <h5 class="card-title fw-bold text-dark h6">
                                    {{ $announcement->getTranslated('title', app()->getLocale()) }}
                                </h5>
                            </a>
                            <p class="card-text text-muted small">
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

                        {{-- Cerca il punto dove carichi il componente add-to-cart --}}
                        <div class="d-flex justify-content-end p-3">
                            @if ($announcement->is_sold)
                                <span class="fw-bold text-danger text-uppercase small" style="letter-spacing: 1px;">
                                    <i class="bi bi-x-circle-fill me-1"></i> {{ __('ui.sold') }}
                                </span>
                            @else
                                @livewire('add-to-cart', ['announcement_id' => $announcement->id], key('cart-category-' . $announcement->id))
                            @endif
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
            @if ($announcements->total() > 0)
                <div class="text-muted small">
                    {{ __('ui.showing') }} {{ $announcements->firstItem() }} - {{ $announcements->lastItem() }}
                    {{ __('ui.of') }}
                    {{ $announcements->total() }} {{ __('ui.results') }}
                </div>
            @endif
            <div class="mt-3">
                {{ $announcements->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-layout>
