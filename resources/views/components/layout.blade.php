<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Komerz' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/razzo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/razzo.png') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    {{-- Navbar con i colori brand e accent --}}
    <x-navbar />

    <main>
        <div class="container">
            {{ $slot }}
        </div>
    </main>

    {{-- Footer con i colori brand e accent --}}
    <x-footer />

    {{-- Slot per script specifici di alcune pagine (es. anteprima immagine) --}}
    {{ $extrajs ?? '' }}
</body>

</html>
