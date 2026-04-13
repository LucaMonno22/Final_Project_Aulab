{{-- 1. AGGIUNTO id="footer" QUI ALL'INIZIO --}}
<footer id="footer" class="text-center text-lg-start bg-komerz-dark text-white pt-5 pb-4">
    <div class="container text-center text-md-start">
        <div class="row mt-3">
            {{-- COLONNA LOGO --}}
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <img src="{{ asset('images/komerz_Tavola_logo22.png') }}" alt="Komerz Logo" height="30"
                    class="mb-4 brightness-img">
                <p class="text-light-gray">
                    {{ __('ui.footerDescription') }}
                </p>

                <div class="social-wrapper mt-4">
                    <p class="text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 1px;">
                        {{ __('ui.followUs') }}
                    </p>
                    <div class="button-4-container">
                        <span class="button-label">{{ __('ui.socialLabel') }}</span>
                        <div class="links">
                            <a href="https://www.facebook.com" class="button-4-box" target="_blank"
                                rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                            <a href="https://x.com" class="button-4-box" target="_blank" rel="noopener noreferrer"><i
                                    class="bi bi-twitter-x"></i></a>
                            <a href="https://www.whatsapp.com" class="button-4-box" target="_blank"
                                rel="noopener noreferrer"><i class="bi bi-whatsapp"></i></a>
                            <a href="https://www.instagram.com" class="button-4-box" target="_blank"
                                rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COLONNA SPONSOR --}}
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4 border-bottom-komerz">
                    {{ __('ui.sponsors') }}
                </h6>
                <div class="sponsor-logos d-flex flex-column gap-3">
                    <a href="https://www.shopify.com" target="_blank" class="sponsor-link"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Shopify_logo.svg"
                            class="sponsor-img"></a>
                    <a href="https://www.stripe.com" target="_blank" class="sponsor-link"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg"
                            class="sponsor-img"></a>
                    <a href="https://www.ebay.it" target="_blank" class="sponsor-link"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/1/1b/EBay_logo.svg"
                            class="sponsor-img"></a>
                    <a href="https://laravel.com" target="_blank" class="sponsor-link"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg"
                            class="sponsor-img"></a>
                </div>
            </div>

            {{-- COLONNA LINK E NEWSLETTER --}}
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4 border-bottom-komerz">
                    {{ __('ui.usefulLinks') }}
                </h6>
                <p><a href="{{ route('contact.us') }}" class="footer-link">{{ __('ui.helpCenter') }}</a></p>
                <p>
                    @auth
                        <a href="{{ route('become.revisor') }}" class="footer-link">{{ __('ui.workWithUs') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="footer-link">{{ __('ui.workWithUs') }}</a>
                    @endauth
                </p>
                {{-- FAQ (Sostituisce Centro Assistenza) --}}
                <p><a href="{{ route('faq') }}" class="footer-link">{{ __('ui.faq') }}</a></p>

                {{-- NEWSLETTER --}}
                {{-- RIMOSSO id="footer" da qui perché ora è nel tag <footer> principale --}}
                <div class="newsletter-wrapper mt-4">
                    <p class="text-uppercase fw-bold mb-2 link-footer"
                        style="letter-spacing: 1px; font-size: 0.7rem; opacity: 0.8;">
                        {{ __('ui.newsletterTitle') }}
                    </p>

                    {{-- 2. AGGIUNTO #footer ALLA FINE DELLA ROUTE --}}
                    <form action="{{ route('newsletter.subscribe') }}#footer" method="POST"
                        class="d-flex align-items-center">
                        @csrf
                        <input type="email" name="email"
                            class="form-control form-control-sm border-0 shadow-none text-white rounded-pill ps-3"
                            style="background-color: rgba(255,255,255,0.1); height: 24px; font-size: 0.75rem; flex: 1;"
                            placeholder="{{ __('ui.newsletterPlaceholder') }}" required>

                        <button type="submit"
                            class="d-flex align-items-center justify-content-center p-0 ms-2 shadow-none"
                            style="height: 22px; width: 22px; min-width: 22px; border-radius: 50%; background-color: #4D58AE; border: none; color: white; cursor: pointer;">
                            <i class="bi bi-send-fill" style="font-size: 0.6rem;"></i>
                        </button>
                    </form>

                    {{-- MESSAGGIO DI ERRORE --}}
                    @if (isset($errors) && $errors->has('email'))
                        <p class="text-danger mt-2 mb-0" style="font-size: 0.65rem; font-weight: 500;">
                            {{ $errors->first('email') }}
                        </p>
                    @endif

                    {{-- MESSAGGIO DI SUCCESSO --}}
                    @if (session('newsletter_success'))
                        <p class="text-success mt-2 mb-0" style="font-size: 0.65rem; font-weight: 500;">
                            {{ session('newsletter_success') }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- COLONNA CONTATTI --}}
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold mb-4 border-bottom-komerz">{{ __('ui.contacts') }}</h6>
                <p><i class="bi bi-geo-alt me-3 text-komerz-blue"></i> {{ __('ui.locationCity') }}</p>
                <p><i class="bi bi-envelope me-3 text-komerz-blue"></i> {{ __('ui.supportEmail') }}</p>
                <p><i class="bi bi-telephone me-3 text-komerz-blue"></i> {{ __('ui.supportPhone') }}</p>
                <p><i class="bi bi-headset me-3 text-komerz-blue"></i> {{ __('ui.support247') }}</p>
            </div>
        </div>
    </div>

    <hr class="mb-4" style="background-color: rgba(255,255,255,0.1);height: 1px;border: none;">

    <div class="text-center p-3 copyright-section text-light-gray">
        © 2026 Copyright: <a class="fw-bold ms-1 text-white" href="#"
            style="text-decoration: none;">Komerz.com</a>
    </div>
</footer>
