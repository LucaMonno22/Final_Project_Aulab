<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name'];

    //Relazione 1 a N: Una categoria ha molti annunci.
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}
