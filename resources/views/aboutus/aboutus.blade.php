<x-layout>
    <header class="about-header py-5 mb-5">
        <div class="container text-center py-5">
            <h1 class="display-3 fw-bold text-white">{{ __('ui.aboutUs') }}</h1>
            <p class="lead text-white-50">{{ __('ui.aboutSubtitle') }} <span class="text-accent fw-bold">Komerz</span></p>
        </div>
    </header>

    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold text-dark mb-4 text-center">{{ __('ui.our') }} <span
                        class="text-komerz">{{ __('ui.mission') }}</span></h2>
                <p class="lead text-muted text-center">{{ __('ui.missionLead') }}</p>
                <p class="text-secondary mb-4 text-center">{{ __('ui.missionDescription') }}</p>

                <div class="mt-5 text-center">
                    @auth
                        <a href="{{ route('become.revisor') }}" class="btn btn-custom-join shadow-sm">
                            <i class="bi bi-person-plus me-2"></i>{{ __('ui.joinUs') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom-join shadow-sm">
                            <i class="bi bi-person-plus me-2"></i>{{ __('ui.joinUs') }}
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Video con Overlay, Icona e Frase/Freccia -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center mt-3 position-relative">
                <div class="shadow-lg rounded-5 overflow-hidden position-relative"
                    style="width: 280px; aspect-ratio: 9/16; background-color: #000; border: 4px solid #333;">

                    <!-- Overlay per il click -->
                    <div id="videoTouchLayer"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 20; cursor: pointer; background: rgba(0,0,0,0);">
                    </div>

                    <!-- Icona Feedback (Play/Pause) -->
                    <div id="videoStatusIcon"
                        class="position-absolute top-50 start-50 translate-middle d-none text-white"
                        style="z-index: 25; pointer-events: none;">
                        <i class="bi bi-play-fill" style="font-size: 5rem; opacity: 0.8;"></i>
                    </div>

                    <video id="shortVideo" class="w-100 h-100 object-fit-cover" preload="auto" autoplay muted
                        style="pointer-events: none;">
                        <source src="{{ asset('videos/short.mp4') }}" type="video/mp4">
                    </video>
                </div>

                <!-- Frase e Freccia a destra -->
                <div class="ms-4 d-none d-md-flex flex-column align-items-center text-komerz fw-bold"
                    style="max-width: 160px;">
                    <i class="bi bi-arrow-left fs-2 mb-2 animation-pointing"></i>
                    <p class="text-center lh-sm m-0"
                        style="font-family: 'Georgia', serif; font-size: 1rem; font-style: italic; letter-spacing: 0.5px;">
                        {{ __('ui.videoDiscoveryPart1') }}
                        <span class="fw-bold" style="color:#040461; font-style: normal;">
                            {{ __('ui.videoDiscoveryVision') }}
                        </span> <br>
                        {{ __('ui.videoDiscoveryPart2') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Caratteristiche -->
        <div class="row g-4 text-center mt-5">
            <div class="col-md-4">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 border-bottom border-4 border-komerz">
                    <i class="bi bi-shield-check fs-1 text-komerz mb-3"></i>
                    <h3 class="h4 fw-bold">{{ __('ui.security') }}</h3>
                    <p class="text-muted small">{{ __('ui.securityDesc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 border-bottom border-4 border-accent">
                    <i class="bi bi-lightning-charge fs-1 text-accent mb-3"></i>
                    <h3 class="h4 fw-bold">{{ __('ui.speed') }}</h3>
                    <p class="text-muted small">{{ __('ui.speedDesc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 border-bottom border-4 border-dark">
                    <i class="bi bi-people fs-1 text-dark mb-3"></i>
                    <h3 class="h4 fw-bold">{{ __('ui.community') }}</h3>
                    <p class="text-muted small">{{ __('ui.communityDesc') }}</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animation-pointing {
            animation: point-left 1.5s infinite ease-in-out;
        }

        @keyframes point-left {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-8px);
            }
        }
    </style>
</x-layout>