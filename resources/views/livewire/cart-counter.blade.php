<li class="nav-item">
    <a href="{{ route('cart.index') }}" class="nav-link cart-link px-2 position-relative shadow-none"
        style="color: var(--komerz-blue) !important;">
        <i class="bi bi-cart3 fs-5"></i>

        @if ($count > 0)
            <span class="position-absolute translate-middle badge rounded-pill bg-danger shadow-sm"
                style="font-size: 0.65rem; top: 15%; left: 85%;">
                {{ $count }}
            </span>
        @endif
    </a>
</li>