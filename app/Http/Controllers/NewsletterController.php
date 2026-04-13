<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Gestisce l'iscrizione alla newsletter.
     * Accetta l'email solo se esiste già nel database degli utenti.
     */
    public function subscribe(Request $request)
    {
        // La validazione rimane uguale
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => __('ui.email_required'),
            'email.email'    => __('ui.email_invalid'),
            'email.exists'   => __('ui.email_not_found'),
        ]);

        $email = $request->email;

        try {
            Mail::to($email)->send(new NewsletterMail($email));

            // Ritorna all'URL precedente AGGIUNGENDO l'ancora #footer
            return redirect(url()->previous() . '#footer')->with('newsletter_success', __('ui.newsletter_success'));
        } catch (\Exception $e) {
            // Anche in caso di errore tecnico, resta sul footer
            return redirect(url()->previous() . '#footer')->withErrors(['email' => 'Errore invio.']);
        }
    }
}
