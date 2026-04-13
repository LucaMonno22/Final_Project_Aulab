<?php

namespace App\Livewire;

use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Livewire\Component;
use App\Models\Announcement;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class EditAnnouncement extends Component
{
    use WithFileUploads;

    public $announcement;
    public $title, $description, $price, $category_id;
    public $images = []; 

    public function mount(Announcement $announcement)
    {
        $this->announcement = $announcement;
        $this->title = $announcement->title;
        $this->description = $announcement->description;
        $this->price = $announcement->price;
        $this->category_id = $announcement->category_id;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'images.*' => 'image|max:1024',
        ]);

        // SVUOTA LA CACHE DELLE TRADUZIONI
        $languages = ['it', 'en', 'es']; 
        foreach ($languages as $lang) {
            Cache::forget("trans_title_ann_{$this->announcement->id}_{$lang}");
            Cache::forget("trans_description_ann_{$this->announcement->id}_{$lang}");
        }

        // AGGIORNAMENTO DATI
        $this->announcement->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'is_accepted' => null, // Torna in revisione per sicurezza
        ]);

        // SALVATAGGIO NUOVE IMMAGINI E INVIO AI JOBS
        if (count($this->images)) {
            foreach ($this->images as $image) {
                $newImage = $this->announcement->images()->create([
                    'path' => $image->store("announcements/{$this->announcement->id}", 'public')
                ]);
                
                // Lancio dei Jobs per le nuove immagini
                ResizeImage::dispatch($newImage->path, 600, 400);
                GoogleVisionSafeSearch::dispatch($newImage->id);
                GoogleVisionLabelImage::dispatch($newImage->id);
            }
        }

        session()->flash('success', __('ui.announcementUpdated'));
        return redirect()->to(route('index') . '#articles-section');
    }

    public function deleteImage($imageId)
    {
        $image = \App\Models\Image::find($imageId);
        if ($image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
        
        $this->announcement->refresh();
    }

    public function render()
    {
        return view('livewire.edit-announcement', [
            'categories' => Category::all()
        ]);
    }
}