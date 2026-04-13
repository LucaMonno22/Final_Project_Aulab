<div class="container my-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                {{-- Titolo Spedizione --}}
                <h3 class="fw-bold mb-4 text-uppercase">
                    <i class="bi bi-truck me-2" style="color: var(--komerz-blue);"></i>{{ __('ui.shipping') }}
                </h3>

                {{-- Form Indirizzo --}}
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">{{ __('ui.address') }}</label>
                    <input type="text" id="address-input" wire:model="address"
                        class="form-control rounded-pill shadow-none border-secondary" placeholder="{{ __('ui.addressPlaceholder') }}">
                </div>

                {{-- Form Città --}}
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">{{ __('ui.city') }}</label>
                    <input type="text" id="city-input" wire:model="city"
                        class="form-control rounded-pill shadow-none border-secondary"   placeholder="{{ __('ui.cityPlaceholder') }}">
                </div>

                <div class="alert alert-info border-0 rounded-4 small py-2 mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i> {{ __('ui.courier') }}: <strong>Komerz Express</strong>
                </div>

                <hr class="my-4">

                {{-- Riepilogo Prezzo --}}
                <div class="d-flex justify-content-between fs-4 fw-bold text-dark mb-4">
                    <span>{{ __('ui.total') }}:</span>
                    <span style="color: var(--komerz-blue);">{{ number_format($total, 2) }} {{ __('ui.currency') }}</span>
                </div>

                {{-- Form Stripe --}}
                <form method="POST" action="{{ route('stripe.payment') }}" id="stripe-form">
                    @csrf
                    
                    {{-- Campi Hidden per il Controller --}}
                    <input type="hidden" name="address" id="hidden-address">
                    <input type="hidden" name="city" id="hidden-city">
                    <input type="hidden" name="stripeToken" id="stripe-token">
                    
                    <div id="card-element" class="form-control mb-3"></div>
                    
                    {{-- Pulsante Tradotto --}}
                    <button class="btn btn-primary w-100 mt-2 py-2 rounded-pill fw-bold" type="button" onclick="createToken()">
                        {{ __('ui.checkout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="https://js.stripe.com/dahlia/stripe.js"></script>

<script type="text/javascript">
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

    var elements = stripe.elements();

    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    function createToken() {
        document.getElementById('hidden-address').value = document.getElementById('address-input').value;
        document.getElementById('hidden-city').value = document.getElementById('city-input').value;
        stripe.createToken(cardElement).then(function(result) {
            if (result.token) {
                document.getElementById('stripe-token').value = result.token.id;
                document.getElementById('stripe-form').submit();
            }
        });
    }
</script>
