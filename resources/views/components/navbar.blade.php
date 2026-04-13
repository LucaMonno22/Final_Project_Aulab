<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 sticky-top shadow-sm">
    <div class="container">
        {{-- Logo a sinistra --}}
        <a class="navbar-brand me-3 mb-2" href="{{ route('index') }}">
            <img src="{{ asset('images/komerz_Tavola_logo22.png') }}" alt="Komerz Logo" height="22" class="logo-hover">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Link a SINISTRA --}}
            <ul class="navbar-nav me-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-secondary hover-white fs-7 px-3" href="{{ route('about.us') }}">
                        {{ __('ui.aboutUs') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary hover-white fs-7 px-3" href="{{ route('contact.us') }}">
                        {{ __('ui.contacts') }}
                    </a>
                </li>
            </ul>

            {{-- Parte Profilo e Lingua a DESTRA --}}

            <ul class="navbar-nav ms-auto align-items-center gap-2">

                {{-- 1. SELETTORE LINGUA DINAMICO (Spostato qui) --}}
                <li class="nav-item dropdown ms-2 pe-2 border-end"
                    style="border-color: rgba(255,255,255,0.1) !important;">
                    <a class="nav-link d-flex align-items-center py-1 px-2 rounded-pill profile-nav-link" href="#"
                        id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                        style="color: var(--komerz-blue) !important;">

                        <div class="profile-icon-wrapper me-1 d-flex align-items-center">
                            @php
                                $currentLang = App::getLocale();
                                $flag = $currentLang == 'en' ? 'gb' : $currentLang;
                            @endphp
                            <img src="{{ asset('vendor/blade-flags/country-' . $flag . '.svg') }}" width="18"
                                height="18" class="rounded-circle">
                        </div>

                        <span class="small fw-bold text-uppercase ms-1">
                            {{ App::getLocale() }} <i class="bi bi-chevron-down" style="font-size: 0.7rem;"></i>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 rounded-3 py-2">
                        <li>
                            <div class="dropdown-item d-flex align-items-center py-2 px-3">
                                <x-_locale lang="en" nation="gb">
                                    <span class="small ms-2 fw-semibold">English</span>
                                </x-_locale>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-item d-flex align-items-center py-2 px-3">
                                <x-_locale lang="es">
                                    <span class="small ms-2 fw-semibold">Español</span>
                                </x-_locale>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-item d-flex align-items-center py-2 px-3">
                                <x-_locale lang="it">
                                    <span class="small ms-2 fw-semibold">Italiano</span>
                                </x-_locale>
                            </div>
                        </li>
                    </ul>
                </li>


                {{-- 2. UTENTE (Auth o Guest) --}}
                @auth
                    @if (Auth::user()->is_revisor)
                        <li class="nav-item me-1 logo-hover">
                            <a class="btn btn-sm position-relative px-3"
                                style="background-color: rgba(67, 78, 160, 0.1); color: var(--komerz-blue); border: 1px solid var(--komerz-blue); border-radius: 20px;"
                                href="{{ route('revisor.index') }}">
                                <i class="bi bi-shield-check me-1"></i> {{ __('ui.revisor') }}
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ \App\Models\Announcement::toBeRevisedCount() }}
                                </span>
                            </a>
                        </li>
                    @endif



                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center py-1 px-2 rounded-pill profile-nav-link" href="#"
                            id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="color: var(--komerz-blue) !important;">

                            <div class="profile-icon-wrapper me-2" style="color: var(--komerz-blue) !important;">
                                <i class="bi bi-person fs-5"></i>
                            </div>

                            <span class="small fw-bold" style="color: var(--komerz-blue) !important;">
                                {{ Auth::user()->name }}
                            </span>

                            {{-- Ho aggiunto la classe 'custom-chevron' per farla ruotare col CSS --}}
                            <i class="bi bi-chevron-down ms-1 custom-chevron"
                                style="font-size: 0.7rem; color: var(--komerz-blue) !important; transition: transform 0.3s;"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 rounded-3 py-2">
                            <li class="px-3 py-2">
                                <div class="text-uppercase fw-bold text-muted"
                                    style="font-size: 0.65rem; letter-spacing: 1px;">{{ __('ui.account') }}</div>
                                <div class="small fw-semibold text-dark">{{ Auth::user()->email }}</div>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('user.orders') }}">
                                    <i class="bi bi-bag-check me-2" style="color: var(--komerz-blue);"></i>
                                    <span class="small fw-bold text-dark">{{ __('ui.myOrders') }}</span>
                                </a>
                            </li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger d-flex align-items-center py-2" type="submit">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        <span class="small fw-bold">{{ __('ui.logout') }}</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        {{-- Ho lasciato le tue classi originali, ho solo aggiunto d-flex per tenere la freccia a destra --}}
                        <a class="nav-link dropdown-toggle text-light d-flex align-items-center py-0" href="#"
                            id="guestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="bi bi-person-circle fs-5"></i>

                            {{-- La tua freccia con la logica di rotazione --}}
                            <i class="bi bi-chevron-down ms-1 custom-chevron"
                                style="font-size: 0.7rem; color: var(--komerz-blue) !important; transition: transform 0.3s;"></i>
                        </a>

                        {{-- Tendina posizionata correttamente con dropdown-menu-end --}}
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3" aria-labelledby="guestDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('ui.login') }}
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" style="opacity: 0.08; margin: 0.5rem 0;">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2 fw-bold"
                                    href="{{ route('register') }}" style="color: var(--komerz-blue);">
                                    <i class="bi bi-plus-circle me-2"></i>{{ __('ui.register') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth

                <li>
                    @livewire('cart-counter')
                </li>

            </ul>
        </div>
    </div>
</nav>
