@php
    $supportedLangs = ['it', 'en', 'es'];

    // 1. Recupera la lingua dall'URL (es: /en/...)
$lang = request()->segment(1);

// 2. Se l'URL è nudo, usa il cookie o l'italiano di default
if (!in_array($lang, $supportedLangs)) {
    $lang = $_COOKIE['user_locale'] ?? 'it';
}

// Traduzioni hardcoded per la 404
$content = [
    'it' => [
        'title' => 'Pagina non trovata',
        'desc' => 'Spiacenti, la pagina che cerchi non esiste.',
        'btn' => 'Torna alla Home',
        'url' => route('index'),
    ],
    'en' => [
        'title' => 'Page Not Found',
        'desc' => 'Sorry, the page you are looking for does not exist.',
        'btn' => 'Back to Home',
        'url' => route('index.localized', ['locale' => 'en']),
    ],
    'es' => [
        'title' => 'Página no encontrada',
        'desc' => 'Lo sentimos, la página que buscas no existe.',
        'btn' => 'Volver al inicio',
        'url' => route('index.localized', ['locale' => 'es']),
        ],
    ];

    $text = $content[$lang];
@endphp

<!DOCTYPE html>
<html lang="{{ $lang }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - {{ $text['title'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --komerz-blue: #434ea0;
            --komerz-dark: #2c3e50;
        }

        .error-container {
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-card {
            position: relative;
            overflow: hidden;
            padding: 4rem 2rem;
            border-radius: 1.5rem;
            background: white;
            text-align: center;
            width: 100%;
            max-width: 550px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: none;
        }

        /* Icona Bussola Sfondo */
        .card-bg-icon {
            position: absolute;
            font-size: 18rem;
            opacity: 0.03;
            right: -4rem;
            bottom: -4rem;
            z-index: 0;
            color: var(--komerz-blue);
        }

        .error-content {
            position: relative;
            z-index: 1;
        }

        .error-icon {
            font-size: 5rem;
            color: var(--komerz-blue);
            margin-bottom: 1rem;
        }

        .error-number {
            font-size: 6.5rem;
            font-weight: 900;
            color: var(--komerz-dark);
            line-height: 1;
            margin: 0;
        }

        .error-title {
            font-weight: 700;
            color: var(--komerz-dark);
            margin-top: 1.5rem;
            font-size: 1.8rem;
        }

        .error-subtitle {
            color: #6c757d;
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
        }

        .btn-home {
            background-color: var(--komerz-blue);
            color: white !important;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 12px rgba(67, 78, 160, 0.2);
        }

        .btn-home:hover {
            background-color: #353d82;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 78, 160, 0.3);
        }
    </style>
</head>

<body class="bg-light">
    <div class="container error-container mt-4">
        <div class="error-card">
            <i class="bi bi-compass-fill card-bg-icon"></i>

            <div class="error-content">
                <div class="mb-3">
                    <i class="bi bi-exclamation-octagon-fill error-icon"></i>
                </div>

                <h1 class="error-number">404</h1>

                <div class="mt-2">
                    <h2 class="error-title">{{ $text['title'] }}</h2>
                    <p class="error-subtitle">{{ $text['desc'] }}</p>

                    <a href="{{ $text['url'] }}" class="btn btn-home">
                        <i class="bi bi-house-door-fill me-2"></i> {{ $text['btn'] }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
