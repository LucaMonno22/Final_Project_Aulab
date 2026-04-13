<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Announcement;
use App\Models\Category;

class AnnouncementIndex extends Component
{
    use WithPagination;

    public $sort = 'desc';
    public $category_ids = [];
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function updatedSort()
    {
        $this->resetPage();
    }

    public function updatedCategoryIds()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Announcement::where('is_accepted', true)
            ->with(['category', 'user', 'images']);

        if ($this->search) {
            $searchTerm = $this->search;

            $query->where(function ($ricerca) use ($searchTerm) {
                $termine_ricerca = '%' . $searchTerm . '%';

                // 1. Ricerca normale su Titolo e Descrizione (RIMASTA IDENTICA)
                $ricerca->where('title', 'LIKE', $termine_ricerca)
                    ->orWhere('description', 'LIKE', $termine_ricerca);

                // 2. NUOVA Logica FULL MULTILANGUAGE per le Categorie
                $ricerca->orWhereHas('category', function ($filtro_categoria) use ($searchTerm) {
                    $allCategories = Category::all();
                    $matchedIds = [];
                    $searchTermLower = mb_strtolower($searchTerm);

                    foreach ($allCategories as $category) {
                        // Controlliamo il match su tutte le lingue contemporaneamente
                        // Forza il controllo sui file it, es, en indipendentemente dalla Navbar
                        $nomeIT = mb_strtolower(__("ui." . $category->name, [], 'it'));
                        $nomeES = mb_strtolower(__("ui." . $category->name, [], 'es'));
                        $nomeEN = mb_strtolower(__("ui." . $category->name, [], 'en'));
                        $nomeDB = mb_strtolower($category->name); // Il nome 'originale' nel database

                        if (
                            str_contains($nomeIT, $searchTermLower) ||
                            str_contains($nomeES, $searchTermLower) ||
                            str_contains($nomeEN, $searchTermLower) ||
                            str_contains($nomeDB, $searchTermLower)
                        ) {
                            $matchedIds[] = $category->id;
                        }
                    }

                    if (!empty($matchedIds)) {
                        $filtro_categoria->whereIn('id', $matchedIds);
                    } else {
                        // Fallback di sicurezza
                        $filtro_categoria->where('name', 'LIKE', '%' . $searchTerm . '%');
                    }
                });
            });
        }

        // Filtro Categorie Checkbox (RIMASTO IDENTICO)
        if (!empty($this->category_ids)) {
            $query->whereIn('category_id', $this->category_ids);
        }

        // Restituzione vista e paginazione (RIMASTA IDENTICA)
        return view('livewire.announcement-index', [
            'announcements' => $query->orderBy('created_at', $this->sort)->paginate(9)->fragment('articles-section'),
            'categories' => Category::all()
        ]);
    }
}
