<x-layout>
    <style>
        :root {
            --komerz-blue: #4D58AE;
        }

        .faq-container {
            max-width: 650px;
            margin: 0 auto;
        }

        .faq-accordion .accordion-item {
            border: none;
            margin-bottom: 12px;
            border-radius: 10px !important;
            overflow: hidden;
            background: transparent;
        }

        .faq-accordion .accordion-button {
            background-color: #ffffff;
            color: #333;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            border-radius: 10px !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .faq-accordion .accordion-button:not(.collapsed) {
            background-color: #ffffff;
            color: var(--komerz-blue);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .faq-accordion .accordion-button:not(.collapsed)::after {
            filter: hue-rotate(200deg) brightness(0.5);
        }

        .faq-accordion .accordion-body {
            background-color: #ffffff;
            padding: 1.25rem;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            font-size: 0.95rem;
            color: #666;
            border-top: 1px solid #f1f1f1;
        }

        .faq-icon-wrapper {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(77, 88, 174, 0.1);
            border-radius: 6px;
            margin-right: 12px;
            color: var(--komerz-blue);
            font-size: 0.9rem;
        }

        /* Effetto Zoom sul bottone Home */
        .btn-zoom {
            transition: transform 0.3s ease !important;
        }

        .btn-zoom:hover {
            transform: scale(1.1);
            /* Zoom del 10% */
        }
    </style>

    <div class="container mb-5 pt-5" style="min-height: 70vh;">
        <div class="faq-container">
            <h2 class="text-center mb-5 fw-bold" style="color: var(--komerz-blue);">{{ __('ui.faq_title') }}</h2>

            <div class="accordion faq-accordion" id="accordionFaq">

                {{-- Nuovo: Registrazione --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingRegistration">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseRegistration">
                            <span class="faq-icon-wrapper">
                                <i class="bi bi-person-plus"></i>
                            </span>
                            {{ __('ui.faq_q_registration') }}
                        </button>
                    </h2>
                    <div id="collapseRegistration" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            {{ __('ui.faq_a_registration') }}
                        </div>
                    </div>
                </div>
                {{-- 1. Sicurezza --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            <span class="faq-icon-wrapper">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            {{ __('ui.faq_q_security') }}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            {{ __('ui.faq_a_security') }}
                        </div>
                    </div>
                </div>

                {{-- 2. Corriere --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo">
                            <span class="faq-icon-wrapper">
                                <i class="bi bi-truck"></i>
                            </span>
                            {{ __('ui.faq_q_shipping') }}
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            {{ __('ui.faq_a_shipping') }}
                        </div>
                    </div>
                </div>

                {{-- 3. Metodi di Pagamento --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree">
                            <span class="faq-icon-wrapper">
                                <i class="bi bi-credit-card"></i>
                            </span>
                            {{ __('ui.faq_q_payment') }}
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            {{ __('ui.faq_a_payment') }}
                        </div>
                    </div>
                </div>

                {{-- 4. Feedback Clienti --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour">
                            <span class="faq-icon-wrapper">
                                <i class="bi bi-people"></i>
                            </span>
                            {{ __('ui.faq_q_feedback') }}
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            {{ __('ui.faq_a_feedback') }}
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bottone Torna alla Home --}}
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('index') }}" class="btn btn-komerz shadow-sm px-5 py-2 mb-4 btn-zoom">
                        {{ __('ui.back_to_home') }} <i class="bi bi-house-door ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
