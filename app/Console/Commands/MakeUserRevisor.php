<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; 

class MakeUserRevisor extends Command
{
    protected $signature = 'app:make-user-revisor {email}';

    protected $description = 'Rende un utente revisore tramite la sua email';

    public function handle()
    {
       $user = User::where('email', $this->argument('email'))->first();

       if (!$user) {
           $this->error('Utente non trovato');
           return;
       }

       // --- AGGIUNGI QUESTO PEZZO ---
       if ($user->is_revisor) {
           $this->warn("L'utente {$user->name} è già un revisore!");
           return;
       }
       // -----------------------------

       $user->is_revisor = true;
       $user->save();
        
       $this->info("L'utente {$user->name} è ora un revisore!");
    }
}
