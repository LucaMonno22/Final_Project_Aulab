<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache; // Aggiunto per la cache

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'description', 'user_id', 'category_id', 'is_accepted', 'lang', 'is_sold'];

    /**
     * Metodo per tradurre i campi dell'annuncio con supporto CACHE.
     */
    public function getTranslated($field, $targetLang)
    {
        // Se la lingua dell'annuncio è uguale a quella selezionata, restituisci l'originale
        if ($this->lang == $targetLang || !$this->lang) {
            return $this->$field;
        }

        // Creiamo una chiave unica per questo specifico testo (es: "trans_title_ann_5_en")
        $cacheKey = "trans_{$field}_ann_{$this->id}_{$targetLang}";

        // Controlla se la traduzione esiste in cache, altrimenti interroga Google e salvala per sempre
        return Cache::rememberForever($cacheKey, function () use ($field, $targetLang) {
            $tr = new GoogleTranslate();

            $tr->setOptions([
                'verify' => env('GOOGLE_TRANSLATE_VERIFY_SSL', true)
            ]);

            try {
                return $tr->setSource($this->lang)
                    ->setTarget($targetLang)
                    ->translate($this->$field);
            } catch (\Exception $e) {
                // In caso di errore API, restituisce l'originale e non salva in cache (riproverà al prossimo refresh)
                return $this->$field;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public static function toBeRevisedCount()
    {
        return Announcement::where('is_accepted', null)->count();
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
