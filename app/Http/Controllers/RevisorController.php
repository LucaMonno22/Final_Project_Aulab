<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use App\Mail\BecomeRevisor;

class RevisorController extends Controller
{
    public function index()
    {
        $announcement_to_check = Announcement::where('is_accepted', null)->first();
        return view('revisor.index', compact('announcement_to_check'));
    }

    public function accept(Announcement $announcement)
    {
        $announcement->setAccepted(true);
        // Forza la pulizia della cache specifica se la stai usando
        return redirect()
            ->back()
            ->with('message', __('ui.revisorAccepted', ['title' => $announcement->title]))
            ->with('last_revised', $announcement->id);
    }

    public function reject(Announcement $announcement)
    {
        $announcement->setAccepted(false);
        // Stessa cosa qui
        return redirect()
            ->back()
            ->with('message', __('ui.revisorRejected', ['title' => $announcement->title]))
            ->with('last_revised', $announcement->id);
    }

    // NUOVO METODO: Riporta l'annuncio a NULL per rivalutarlo
    public function undo(Announcement $announcement)
    {
        $announcement->setAccepted(null);
        return redirect()->back()->with('message', __('ui.revisorUndoMsg', ['title' => $announcement->title]));
    }

    public function becomeRevisor()
    {
        if (Auth::user()->is_revisor) {
            return redirect()->route('index')->with('message', __('ui.alreadyRevisor', ['name' => Auth::user()->name]));
        }

        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->route('index')->with('message', __('ui.revisorRequestSent'));
    }

    public function makeRevisor(User $user)
    {
        if ($user->is_revisor) {
            return redirect()->route('index')->with('message', __('ui.alreadyRevisor', ['name' => $user->name]));
        }

        Artisan::call('app:make-user-revisor', ['email' => $user->email]);

        return redirect()->route('index')->with('message', __('ui.makeRevisorSuccess', ['name' => $user->name]));
    }
}
