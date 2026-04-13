<x-layout>
    <div class="container-fluid py-5 ">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">

                    {{-- AGGIUNTO: Alert per il messaggio di successo --}}
                    @if (session('status'))
                        <div class="container mb-5">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6">
                                    <div
                                        class="alert alert-revisor-success shadow-sm d-flex align-items-center justify-content-center rounded-4 border-0">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <span>{{ session('status') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif



                    <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                        <div class="row g-0">

                            <div class="col-md-5 bg-dark text-white p-5 d-flex flex-column justify-content-center">
                                <h2 class="fw-bold mb-4">{{ __('ui.contactTitlePart1') }} <span
                                        class="text-accent">{{ __('ui.contactTitlePart2') }}</span></h2>
                                <p class="text-white-50 mb-5">{{ __('ui.contactSubtitle') }}</p>

                                {{-- Blocco Email Dinamico --}}
                                <div class="d-flex align-items-center mb-4">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-envelope-at fs-4 text-accent"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 small text-white-50">{{ __('ui.writeUs') }}</p>
                                        <p class="mb-0 fw-bold">{{ __('ui.supportEmail') }}</p>
                                    </div>
                                </div>

                                {{-- Blocco Telefono Dinamico --}}
                                <div class="d-flex align-items-center mb-4">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-telephone fs-4 text-accent"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 small text-white-50">{{ __('ui.callUs') }}</p>
                                        <p class="mb-0 fw-bold">{{ __('ui.supportPhone') }}</p>
                                    </div>
                                </div>

                                {{-- Blocco Sede Dinamico --}}
                                <div class="d-flex align-items-center">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-geo-alt fs-4 text-accent"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 small text-white-50">{{ __('ui.location') }}</p>
                                        <p class="mb-0 fw-bold">{{ __('ui.locationCity') }}</p>
                                        <p class="mb-0 small text-white-50">{{ __('ui.locationAddress') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 bg-white p-5">
                                {{-- MODIFICATO: Action collegata alla rotta POST --}}
                                <form action="{{ route('contact.submit') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label-custom">{{ __('ui.name') }}</label>
                                            {{-- MODIFICATO: Aggiunto name="name" --}}
                                            <input type="text" name="name" class="form-control-custom w-100"
                                                placeholder="{{ __('ui.namePlaceholder') }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-custom">{{ __('ui.email') }}</label>
                                            {{-- MODIFICATO: Aggiunto name="email" --}}
                                            <input type="email" name="email" class="form-control-custom w-100"
                                                placeholder="{{ __('ui.emailPlaceholder') }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label-custom">{{ __('ui.subject') }}</label>
                                            {{-- MODIFICATO: Aggiunto name="subject" --}}
                                            <input type="text" name="subject" class="form-control-custom w-100"
                                                placeholder="{{ __('ui.subjectPlaceholder') }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label-custom">{{ __('ui.message') }}</label>
                                            {{-- MODIFICATO: Aggiunto name="message" --}}
                                            <textarea name="message" class="form-control-custom w-100" rows="4"
                                                placeholder="{{ __('ui.messagePlaceholder') }}" required></textarea>
                                        </div>
                                        <div class="col-12 mt-4 text-end">
                                            <button type="submit" class="btn btn-komerz-primary px-5 py-3 fw-bold">
                                                {{ __('ui.sendMessage') }} <i class="bi bi-send ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
