
<x-layout>
    <div class="container my-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                {{-- Intestazione Pagina --}}
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h2 class="fw-bold mb-0 text-uppercase">
                        <i class="bi bi-bag-check me-2" style="color: var(--komerz-blue);"></i>{{ __('ui.myOrders') }}
                    </h2>
                    <a href="{{ route('index') }}#articles-section" class="btn btn-outline-secondary btn-checkout-sink rounded-pill px-4 small"; style="background-color: var(--komerz-blue); color:white;">
                        {{ __('ui.backToHome') }}
                    </a>
                </div>

                {{-- Tabella Storico Ordini --}}
                <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-uppercase text-muted" style="letter-spacing: 1px;">
                                <th class="border-0 px-3">ID</th>
                                <th class="border-0">{{ __('ui.date') }}</th>
                                <th class="border-0">{{ __('ui.shipping') }}</th>
                                <th class="border-0">{{ __('ui.total') }}</th>
                                <th class="border-0 text-center">{{ __('ui.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="fw-bold px-3" style="color: var(--komerz-blue);">#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="small fw-semibold text-dark">{{ $order->address }}</div>
                                        <div class="small text-muted text-uppercase" style="font-size: 0.65rem;">{{ $order->city }} | {{ $order->courier }}</div>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        {{ number_format($order->total_price, 2) }} {{ __('ui.currency') }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill bg-success px-3 py-2 shadow-sm">
                                            <i class="bi bi-check2-circle me-1"></i> {{ __('ui.paid') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                {{-- Se l'utente non ha mai comprato nulla --}}
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="opacity-25 mb-3">
                                            <i class="bi bi-cart-x display-1"></i>
                                        </div>
                                        <h5 class="text-muted">{{ __('ui.noOrders') }}</h5>
                                        <p class="small text-muted">{{ __('ui.welcomeSubtitle') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>