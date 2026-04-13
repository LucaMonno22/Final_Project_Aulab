<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image as SpatieImage;
use Spatie\Image\Enums\Fit;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Enums\Unit;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $w, $h, $fileName, $path;

    public function __construct($filePath, $w, $h)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;

        $srcPath = storage_path('app/public/' . $this->path . '/' . $this->fileName);
        $destPath = storage_path('app/public/' . $this->path . "/crop_{$w}x{$h}_" . $this->fileName);

        // Carichiamo l'immagine e applichiamo fit + watermark
        SpatieImage::load($srcPath)
            ->fit(Fit::Max, $w, $h) // Ridimensiona senza tagliare
            ->watermark(
                base_path('resources/img/watermark.png'),
                width: 150,
                height: 70,
                paddingX: 5,
                paddingY: 5,
                paddingUnit: Unit::Percent
            )
            ->save($destPath);
    }
}
