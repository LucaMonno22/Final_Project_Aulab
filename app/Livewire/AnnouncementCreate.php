<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\File;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth; // Aggiunto per pulizia

class AnnouncementCreate extends Component
{
    use WithFileUploads;

    #[Validate]
    public $title;
    #[Validate]
    public $price;
    #[Validate]
    public $description;
    #[Validate]
    public $category_id;

    public $images = [];
    public $temporary_images;

    protected function rules()
    {
        return [
            'title' => ['required', 'min:5'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'min:10'],
            'category_id' => ['required'],
        ];
    }

    protected function messages()
    {
        return [
            'title.required' => __('ui.titleRequired'),
            'price.required' => __('ui.priceRequired'),
            'description.required' => __('ui.descriptionRequired'),
            'category_id.required' => __('ui.categoryRequired'),
        ];
    }

    public function store()
    {
        $this->validate();

        // 1. Creiamo l'annuncio e salviamolo nella variabile $announcement
        $announcement = Announcement::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
            'lang' => app()->getLocale(),
        ]);

        // 2. Gestione Immagini
        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                // Definiamo il percorso di salvataggio
                $newFileName = "announcements/{$announcement->id}";

                // Salviamo il file fisicamente e creiamo il record nel DB
                $newImage = $announcement->images()->create([
                    'path' => $image->store($newFileName, 'public')
                ]);

                // Lanciamo il Job per il ridimensionamento
                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 600, 400),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id),
                ])->dispatch($newImage->id);
            }

            // Pulizia cartella temporanea
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        session()->flash('success', __('ui.announcementCreated'));

        $this->cleanForm();

        return redirect()->to(route('index') . '#articles-section');
    }

    public function updatedTemporaryImages()
    {
        // Validazione specifica per le immagini se necessario
        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    protected function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category_id = '';
        $this->price = '';
        $this->images = [];
    }

    public function render()
    {
        return view('livewire.announcement-create', [
            'categories' => Category::all()
        ]);
    }
}
