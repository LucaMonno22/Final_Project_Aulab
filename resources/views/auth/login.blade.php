<x-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4 login-card shadow-lg p-5 rounded-4">

            <div class="text-center mb-4">
                <div class="login-icon-box mb-3">
                    <i class="bi bi-person-lock fs-1 text-komerz"></i>
                </div>
                {{-- Titolo: Bentornato --}}
                <h1 class="h2 fw-bold text-dark">{{ __('ui.welcomeBack') }}</h1>
                {{-- Sottotitolo: Inserisci le tue credenziali... --}}
                <p class="text-muted small">{{ __('ui.loginSubtitle') }}</p>
            </div>

            @if (session('url.intended'))
                <div class="alert alert-custom-info mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    {{ __('ui.loginRequired') }}
                </div>
            @endif

            {{-- Messaggio di successo dopo il reset della password --}}
            @if (session('status'))
                {{-- Ho cambiato 'alert-success-custom' in 'alert-success' --}}
                <div class="alert alert-success mb-4 small fw-bold text-center border-0 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i> {{-- Un'iconcina rende tutto più pro --}}
                    @if (session('status') == 'passwords.reset')
                        {{ __('ui.resetSuccess') }}
                    @else
                        {{ session('status') }}
                    @endif
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Campo Email (Spostato qui dentro per funzionare col tasto ACCEDI) --}}
                <div class="mb-3">
                    <label for="email" class="form-label-custom">{{ __('ui.email') }}</label>
                    <input type="email" name="email" id="email"
                        class="form-control-custom @error('email') is-invalid-custom @enderror"
                        value="{{ old('email', request()->cookie('remembered_email')) }}"
                        placeholder="{{ __('ui.email_placeholder') }}" required>
                    @error('email')
                        <div class="text-danger-custom mt-1 small fw-bold">{{ __('ui.errore_mail') }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label-custom">{{ __('ui.password') }}</label>
                    {{-- Inizio blocco modificato --}}
                    <div class="position-relative">
                        <input type="password" name="password" id="password"
                            class="form-control-custom @error('password') is-invalid-custom @enderror"
                            placeholder="••••••••" required>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer text-muted"
                            id="togglePassword" style="cursor: pointer; z-index: 10;">
                        </i>
                    </div>
                    {{-- Fine blocco modificato --}}
                    {{-- AGGIUNTO: Link Password Dimenticata --}}
                    @if (Route::has('password.request'))
                        <div class="text-end mt-1">
                            <a href="{{ route('password.request') }}"
                                class="text-komerz text-decoration-none small fw-bold hover-link">
                                {{ __('ui.forgotPassword') }}
                            </a>
                        </div>
                    @endif

                    @error('password')
                        <div class="text-danger-custom mt-1 small fw-bold">{{ __('ui.errore_password') }}</div>
                    @enderror
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check custom-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input"
                            {{ old('remember') ? 'checked' : '' }}>
                        {{-- Testo: Ricordami --}}
                        <label class="form-check-label small fw-semibold"
                            for="remember">{{ __('ui.rememberMe') }}</label>
                    </div>
                </div>

                {{-- Bottone: ACCEDI --}}
                <button type="submit" class="btn btn-komerz-primary w-100 py-3 fw-bold shadow-sm">
                    {{ __('ui.loginBtn') }}
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted">
                    {{-- Testo: Non hai un account? Registrati --}}
                    {{ __('ui.noAccount') }}
                    <a href="{{ route('register') }}" class="text-komerz text-decoration-none fw-bold hover-link">
                        {{ __('ui.register') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('click', function (e) {
        // Verifica se l'elemento cliccato è l'icona con ID togglePassword
        if (e.target && e.target.id === 'togglePassword') {
            const icon = e.target;
            // Trova l'input che si trova nello stesso contenitore dell'icona
            const passwordInput = icon.parentElement.querySelector('input');
            
            // Cambia il tipo tra 'password' e 'text'
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Cambia l'icona da sbarrata a aperta e viceversa
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        }
    });
</script>
</x-layout>
