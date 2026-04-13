<x-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4 login-card shadow-lg p-5 rounded-4">
            
            <div class="text-center mb-3">
                <div class="login-icon-box mb-3">
                    <i class="bi bi-shield-lock fs-1 text-komerz"></i>
                </div>
                <h1 class="h2 fw-bold text-dark">{{ __('ui.newPassword') }}</h1>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                {{-- Token e Email nascosti necessari per il funzionamento (INTATTI) --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ $request->email }}">

                <div class="mb-3">
                    <label for="password" class="form-label-custom">{{ __('ui.newPasswordLabel') }}</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" 
                            class="form-control-custom @error('password') is-invalid-custom @enderror" 
                            required autofocus>
                        {{-- Icona aggiunta --}}
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer text-muted"
                            id="togglePassword" style="cursor: pointer; z-index: 10;"></i>
                    </div>

                    {{-- La tua logica di errore originale (INTATTA) --}}
                    @error('password')
                        <div class="text-danger-custom mt-1 small fw-bold">
                            @if($message == 'passwords.password' || str_contains($message, 'min') || str_contains($message, 'confirmation'))
                                {{ __('ui.passwordError') }}
                            @elseif($message == 'passwords.throttled')
                                {{ __('ui.throttledError') }}
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label-custom">{{ __('ui.confirmPassword') }}</label>
                    <div class="position-relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="form-control-custom" required>
                        {{-- Icona aggiunta --}}
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer text-muted"
                            id="togglePasswordConfirm" style="cursor: pointer; z-index: 10;"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-komerz-primary w-100 py-3 fw-bold shadow-sm">
                    {{ __('ui.updatePasswordBtn') }}
                </button>
            </form>
        </div>
    </div>

    {{-- Script per far funzionare l'occhiolino --}}
    <script>
        document.addEventListener('click', function (e) {
            if (e.target && (e.target.id === 'togglePassword' || e.target.id === 'togglePasswordConfirm')) {
                const icon = e.target;
                const passwordInput = icon.parentElement.querySelector('input');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            }
        });
    </script>
</x-layout>