<x-layout>
    @if (session()->has('paymentSuccess'))
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div
                        class="alert alert-revisor-success shadow-sm d-flex align-items-center border-0 rounded-4 p-3 border-start border-success border-4">
                        <i class="bi bi-check-circle-fill me-3 fs-4 text-success"></i>
                        <div class="text-white fw-bold">
                            {{ session('paymentSuccess') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- Messaggi di Sessione --}}
    @if (session()->has('errorMessage'))
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="alert alert-danger shadow-sm d-flex align-items-center justify-content-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <span>{{ session('errorMessage') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

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

    {{-- HERO SECTION - Inserita qui per dare il benvenuto al cliente --}}
    <header class="hero-header dimension2 text-center">
        <div class="container py-5">
            <div class="row align-items-center min-vh-50">
                {{-- Aumentata a col-lg-8 per dare più spazio orizzontale al testo --}}
                <div class="col-lg-8 py-5">
                    <h1 class="display-3 fw-bold text-white mb-3 tracking-tight">
                        {{ __('ui.welcomeTitle') }}
                        <span class="ms-3 d-inline-block text-nowrap brand-name">
                            <span class="letter-k">K</span><span class="letter-main">omer</span><span
                                class="letter-z ms-1">z</span>
                        </span>
                    </h1>

                    <p class="lead text-white opacity-75 mb-5 fs-4">
                        {{ __('ui.welcomeSubtitle') }}
                    </p>

                    <div class="d-flex flex-wrap gap-3 justify-content-center align-items-center">
                        <a href="{{ route('create') }}" class="btn btn-hero-primary shadow">
                            <i class="bi bi-plus-circle-fill me-2"></i>{{ __('ui.sellItem') }}
                        </a>
                        <a href="#articles-section" class="btn btn-hero-outline">
                            {{ __('ui.explore') }} <i class="bi bi-arrow-down ms-2"></i>
                        </a>
                    </div>
                </div>

                {{-- Ridotta a col-lg-4 per lasciare più spazio al testo --}}
                <div class="col-lg-4 d-none d-lg-flex justify-content-center">
                    <div class="hero-visual-card shadow-lg">
                        <i class="bi bi-rocket-takeoff-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Punto di ancoraggio per lo scroll --}}
    <div id="articles-section" class="pt-5"></div>

    <div class="container dimension">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-8">
                {{-- Titolo sezione articoli --}}
                <h2 class="fw-bold">{{ __('ui.allArticles') }}</h2>
            </div>
        </div>

        <hr>

        <div class="mt-4 mb-5">
            <div class="bg-white rounded-4 shadow-sm p-2">
                @livewire('AnnouncementIndex')
            </div>
        </div>
    </div>
</x-layout>
