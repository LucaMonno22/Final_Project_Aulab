<x-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5 login-card shadow-lg p-5 rounded-4 my-5">

            <div class="text-center mb-4">
                <div class="login-icon-box mb-3">
                    <i class="bi bi-person-plus fs-1 text-komerz"></i>
                </div>
                {{-- Titolo: Crea Account --}}
                <h1 class="h2 fw-bold text-dark">{{ __('ui.createAccount') }}</h1>
                {{-- Sottotitolo: Unisciti alla community... --}}
                <p class="text-muted small">{{ __('ui.joinCommunity') }}</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    {{-- Etichetta: Nome Completo --}}
                    <label for="name" class="form-label-custom">{{ __('ui.fullName') }}</label>
                    <input type="text" name="name" id="name"
                        class="form-control-custom @error('name') is-invalid-custom @enderror"
                        value="{{ old('name') }}" placeholder="{{ __('ui.fullNamePlaceholder') }}" required>
                    @error('name')
                        <div class="text-danger-custom mt-1 small fw-bold">{{ __('ui.errore_utente1') }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    {{-- Etichetta: Email --}}
                    <label for="email" class="form-label-custom">{{ __('ui.email') }}</label>
                    <input type="email" name="email" id="email"
                        class="form-control-custom @error('email') is-invalid-custom @enderror"
                        value="{{ old('email') }}" placeholder="{{ __('ui.emailPlaceholder') }}" required>
                    @error('email')
                        <div class="text-danger-custom mt-1 small fw-bold">{{ __('ui.errore_mail') }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        {{-- Etichetta: Password --}}
                        <label for="password" class="form-label-custom">{{ __('ui.password') }}</label>

                        {{-- CONTENITORE RELATIVO - Fondamentale per tenere l'icona dentro --}}
                        <div class="position-relative">
                            <input type="password" name="password" id="password"
                                class="form-control-custom @error('password') is-invalid-custom @enderror"
                                placeholder="••••••••" required>
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer text-muted"
                                id="togglePassword" style="cursor: pointer; z-index: 10;">
                            </i>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        {{-- Etichetta: Conferma --}}
                        <label for="password_confirmation"
                            class="form-label-custom">{{ __('ui.confirmPassword') }}</label>

                        {{-- CONTENITORE RELATIVO - Fondamentale per tenere l'icona dentro --}}
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control-custom" placeholder="••••••••" required>
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer text-muted"
                                id="togglePasswordConfirm" style="cursor: pointer; z-index: 10;">
                            </i>
                        </div>
                    </div>
                </div>

                @error('password')
                    <div class="text-danger-custom mb-3 small fw-bold">{{ __('ui.errore_password1') }}</div>
                @enderror

                {{-- Bottone: REGISTRATI ORA --}}
                <button type="submit" class="btn btn-komerz-primary w-100 py-3 fw-bold shadow-sm mt-3 text-uppercase">
                    {{ __('ui.registerNow') }}
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted">
                    {{-- Testo: Hai già un account? Accedi --}}
                    {{ __('ui.alreadyHaveAccount') }}
                    <a href="{{ route('login') }}" class="text-komerz text-decoration-none fw-bold hover-link">
                        {{ __('ui.login') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('click', function(e) {
            // Controlliamo se è stato cliccato uno dei due occhiolini
            if (e.target && (e.target.id === 'togglePassword' || e.target.id === 'togglePasswordConfirm')) {
                const icon = e.target;
                // Cerchiamo l'input che si trova nello stesso div dell'icona
                const passwordInput = icon.parentElement.querySelector('input');

                // Cambia il tipo di input
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Cambia l'icona
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            }
        });
    </script>
</x-layout>
