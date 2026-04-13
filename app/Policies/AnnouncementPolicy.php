<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnnouncementPolicy
{
    /**
     * Chi può vedere la lista (tutti)
     */
    public function viewAny(?User $user): bool
    {
        return true; 
    }

    /**
     * Chi può vedere il singolo annuncio (tutti)
     */
    public function view(?User $user, Announcement $announcement): bool
    {
        return true;
    }

    /**
     * Chi può creare annunci (tutti gli utenti loggati)
     */
    public function create(User $user): bool
    {
        return true; 
    }

    /**
     * Solo il proprietario può modificare i propri annunci
     */
    public function update(User $user, Announcement $announcement): bool
    {
        return $user->id === $announcement->user_id;
    }

    /**
     * Chi può eliminare? Il proprietario OPPURE il revisore
     */
    public function delete(User $user, Announcement $announcement): bool
    {
        // Usiamo l'operatore || (che significa "OPPURE")
        return $user->id === $announcement->user_id || $user->is_revisor;
    }
}