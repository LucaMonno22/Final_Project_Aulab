<x-layout>
    @if (session()->has('message'))
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="alert alert-revisor-success shadow-sm d-flex align-items-center justify-content-center">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <span>{{ session('message') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('last_revised'))
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div
                        class="alert alert-warning shadow-sm d-flex justify-content-between align-items-center rounded-pill border-0 px-4 py-2">
                        <span class="small fw-bold text-dark">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>
                            {{ __('ui.undoMessage') }}
                        </span>
                        <form action="{{ route('revisor.undo', session('last_revised')) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3 fw-bold text-uppercase"
                                style="font-size: 0.7rem;">
                                {{ __('ui.undo') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid py-5 px-md-5">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-12 col-md-6">
                <div class="revisor-header-box">
                    <h1 class="display-5 fw-bold">
                        {{ __('ui.revisorDashboard') }} <span class="text-komerz">{{ __('ui.revisorTitle') }}</span>
                    </h1>
                    <p class="revisor-subtitle">{{ __('ui.revisorSubtitle') }}</p>
                </div>
            </div>
        </div>

        @if ($announcement_to_check)
            <div class="row g-5 justify-content-center align-items-start">
                <div class="col-lg-6">
                    <div class="row g-3">
                        @if ($announcement_to_check->images->count())
                            @foreach ($announcement_to_check->images as $key => $image)
                                <div class="col-12 mb-4">
                                    <div class="revisor-image-card shadow-sm p-3 bg-white rounded border">
                                        <div class="row align-items-start">
                                            <div class="col-md-4">
                                                <img src="{{ $image->getUrl(600, 400) }}"
                                                    class="img-fluid rounded shadow-sm"
                                                    style="height: 200px; width: 100%; object-fit: contain; background-color: #f8f9fa;"
                                                    alt="Immagine {{ $key + 1 }}">
                                            </div>

                                            <div class="col-md-8">
                                                <div class="row">
                                                    {{-- Labels --}}
                                                    <div class="col-md-6 border-end">
                                                        <h5 class="fw-bold small text-uppercase text-muted">
                                                            {{ __('ui.labels') }}</h5>
                                                        @if ($image->labels)
                                                            <p class="mb-0">
                                                                @foreach ($image->labels as $label)
                                                                    <span
                                                                        class="badge bg-light text-dark border me-1">#{{ $label }}</span>
                                                                @endforeach
                                                            </p>
                                                        @else
                                                            <p class="fst-italic small text-secondary">
                                                                {{ __('ui.noLabels') }}</p>
                                                        @endif
                                                    </div>

                                                    {{-- Ratings: Allineamento Ultra-Preciso --}}
                                                    <div class="col-md-6">
                                                        <h5 class="fw-bold small text-uppercase text-muted">
                                                            {{ __('ui.ratings') }}</h5>
                                                        <div class="row g-1">
                                                            @php
                                                                $ratings = [
                                                                    'adult' => $image->adult,
                                                                    'violence' => $image->violence,
                                                                    'spoof' => $image->spoof,
                                                                    'racy' => $image->racy,
                                                                    'medical' => $image->medical,
                                                                ];
                                                            @endphp

                                                            @foreach ($ratings as $key => $value)
                                                                <div class="col-12 small d-flex align-items-center"
                                                                    style="line-height: 1.2; margin-bottom: 5px;">
                                                                    <span class="me-2">{{ __("ui.$key") }}:</span>
                                                                    <span
                                                                        class="{{ $value }} d-inline-block rounded-circle"
                                                                        style="width: 12px; height: 12px; margin-top: -2px;"></span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="revisor-detail-card shadow-lg p-4 h-100">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge-category badge">
                                    {{ __('ui.' . $announcement_to_check->category->name) }}
                                </span>
                                <small class="text-muted fw-bold">ID: #{{ $announcement_to_check->id }}</small>
                            </div>

                            <h1 class="h2 fw-bold mb-3 text-dark">
                                {{ $announcement_to_check->getTranslated('title', app()->getLocale()) }}
                            </h1>

                            <div class="revisor-info-box d-flex align-items-center mb-4 p-3 rounded-3">
                                <i class="bi bi-person-circle fs-3 me-2 text-secondary"></i>
                                <div>
                                    <p class="mb-0 small fw-bold text-dark">{{ $announcement_to_check->user->name }}
                                    </p>
                                    <p class="mb-0 x-small text-muted">
                                        {{ $announcement_to_check->created_at->format('d M Y') }}</p>
                                </div>
                                <div class="ms-auto text-end">
                                    <h2 class="mb-0 fw-bold text-komerz">
                                        {{ number_format($announcement_to_check->price, 2) }}{{ __('ui.currency') }}
                                    </h2>
                                </div>
                            </div>

                            <h5 class="revisor-section-title">{{ __('ui.description') }}</h5>
                            <p class="revisor-description">
                                {{ $announcement_to_check->getTranslated('description', app()->getLocale()) }}
                            </p>
                        </div>

                        <div class="revisor-actions mt-auto pt-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <form action="{{ route('reject', ['announcement' => $announcement_to_check]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-reject w-100 py-3 fw-bold rounded-pill">
                                            <i class="bi bi-x-lg me-2"></i> {{ __('ui.reject') }}
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('accept', ['announcement' => $announcement_to_check]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-accept w-100 py-3 fw-bold rounded-pill text-white">
                                            <i class="bi bi-check-lg me-2"></i> {{ __('ui.accept') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center py-5">
                <div class="col-md-6 text-center py-5 bg-white rounded-4 shadow-sm border">
                    <div class="mb-4">
                        <i class="bi bi-check2-circle display-1 text-komerz"></i>
                    </div>
                    <h2 class="fw-bold text-dark">{{ __('ui.noAnnouncements') }}</h2>
                    <p class="text-muted mb-4 px-4">{{ __('ui.noAnnouncementsSubtitle') }}</p>
                    <a href="{{ route('index') }}#articles-section"
                        class="btn btn-dark px-5 py-3 rounded-pill fw-bold shadow">
                        {{ __('ui.backHome') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
    @if (
        $announcement_to_check &&
            ($announcement_to_check->images->whereNull('adult')->count() > 0 ||
                $announcement_to_check->images->whereNull('labels')->count() > 0))
        <script>
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        </script>
    @endif
</x-layout>
