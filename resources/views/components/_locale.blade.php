{{-- Il segreto è assegnare null come default --}}
@props(['lang', 'nation' => null])

@php
    // Se 'nation' non viene passato, usa 'lang' (es. per 'it' e 'es')
    // Se 'lang' è 'en', forziamo 'gb' per l'icona
    $currentNation = $nation ?? ($lang === 'en' ? 'gb' : $lang);
@endphp

<form action="{{ route('setLocale', $lang) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="dropdown-item d-flex align-items-center py-2 px-3 border-0 bg-transparent">
        {{-- Usiamo la variabile calcolata sopra --}}
        <img src="{{ asset('vendor/blade-flags/country-' . $currentNation . '.svg') }}" 
             width="20" height="20" class="rounded-circle me-2">

        <span class="small fw-semibold text-dark">{{ $slot }}</span>
    </button>
</form>
