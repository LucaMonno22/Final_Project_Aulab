<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $localeLanguage = session('locale', 'it');
        App::setLocale($localeLanguage);
        // Salva un cookie "puro" che la pagina 404 può leggere senza sessione dura 5 anni ed è valido per tutto il dominio ("/")
        setcookie('user_locale', $localeLanguage, time() + (86400 * 365 * 5), "/");
        return $next($request);
    }
}
