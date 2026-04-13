<x-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4 login-card shadow-lg p-5 rounded-4 text-center">

            <div class="login-icon-box mb-3">
                <i class="bi bi-envelope-check fs-1 text-komerz"></i>
            </div>

            <h1 class="h2 fw-bold text-dark">{{ __('ui.resetPasswordTitle') }}</h1>
            <p class="text-muted small mb-4">{{ __('ui.resetPasswordSubtitle') }}</p>

            {{-- Messaggio di stato dinamico (Verde se inviata, Rosso se troppi tentativi) --}}
            @if (session('status'))
                <div class="alert {{ session('status') == 'passwords.throttled' ? 'alert-danger' : 'alert-success' }} mb-4 small fw-bold shadow-sm border-0 text-center">
                    <i class="bi {{ session('status') == 'passwords.throttled' ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill' }} me-2"></i>

                    @if (session('status') == 'passwords.sent')
                        {{ __('ui.emailSentSuccess') }}
                    @elseif (session('status') == 'passwords.throttled')
                        {{ __('ui.tooManyRequests') }}
                    @else
                        {{ session('status') }}
                    @endif
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4 text-start">
                    <label for="email" class="form-label-custom">{{ __('ui.email') }}</label>
                    <input type="email" name="email" id="email"
                        class="form-control-custom @error('email') is-invalid-custom @enderror"
                        value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <div class="text-danger-custom mt-1 small fw-bold">
                            @if ($message == 'passwords.user')
                                {{ __('ui.emailNotFound') }}
                            @elseif ($message == 'passwords.throttled')
                                {{ __('ui.tooManyRequests') }}
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-komerz-primary w-100 py-3 fw-bold shadow-sm">
                    {{ __('ui.sendResetLink') }}
                </button>
            </form>

            <div class="mt-3">
                <a href="{{ route('login') }}" class="text-muted small text-decoration-none hover-link">
                    <i class="bi bi-arrow-left"></i> {{ __('ui.backToLogin') }}
                </a>
            </div>
        </div>
    </div>
</x-layout>