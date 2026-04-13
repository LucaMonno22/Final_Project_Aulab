<div> {{-- UNICO DIV RADICE - Fondamentale per Livewire --}}

    <div class="container mt-5 mb-5">
        {{-- Messaggio di Successo --}}
        @if (session('message'))
            <div class="alert alert-success d-flex align-items-center mb-4 shadow-sm border-0 rounded-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>{{ session('message') }}</div>
            </div>
        @endif

        <form wire:submit.prevent="update" class="p-4 shadow rounded-4 bg-white border-top border-primary border-4">
            @csrf
            
            <div class="row">
                <div class="col-12">
                    {{-- CAMPO TITOLO --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('ui.title') }}</label>
                        <input type="text" wire:model="title"
                            class="form-control rounded-pill border-secondary shadow-none @error('title') is-invalid @enderror">
                        @error('title') <span class="text-danger small">{{ __('ui.errortitle') }}</span> @enderror
                    </div>

                    {{-- CAMPO PREZZO --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('ui.price') }} ({{ __('ui.currency') }})</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold text-secondary">{{ __('ui.currency') }}</span>
                            <input type="number" step="0.01" wire:model="price"
                                class="form-control border-secondary shadow-none @error('price') is-invalid @enderror">
                        </div>
                        @error('price') <span class="text-danger small">{{ __('ui.errorprice') }}</span> @enderror
                    </div>

                    {{-- CAMPO CATEGORIA --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('ui.category') }}</label>
                        <select wire:model="category_id"
                            class="form-select rounded-pill border-secondary shadow-none @error('category_id') is-invalid @enderror">
                            <option value="">{{ __('ui.selectCategory') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ __("ui.{$category->name}") }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ __('ui.errorcategory') }}</span> @enderror
                    </div>

                    {{-- CAMPO DESCRIZIONE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('ui.description') }}</label>
                        <textarea wire:model="description" rows="5"
                            class="form-control rounded-4 border-secondary shadow-none @error('description') is-invalid @enderror"></textarea>
                        @error('description') <span class="text-danger small">{{ __('ui.errordescription') }}</span> @enderror
                    </div>
                </div>
            </div>

            <hr class="my-4 text-muted">

            {{-- SEZIONE DROPZONE (CARICA IMMAGINI) - STILE SCREENSHOT --}}
            <div class="mb-5">
                <label class="form-label fw-bold mb-3 text-uppercase text-muted small" style="letter-spacing: 1px;">
                    {{ __('ui.addNewImages') }}
                </label>
                <div class="dropzone-container position-relative border border-2 border-dashed rounded-4 p-5 text-center bg-light" style="border-style: dashed !important; border-color: #dee2e6 !important;">
                    <input type="file" wire:model="images" multiple id="fileUpload" class="position-absolute top-0 start-0 w-100 h-100 opacity-0" style="cursor: pointer;">
                    <div class="dropzone-content py-3">
                        <i class="bi bi-images fs-1 text-primary mb-3 d-block"></i>
                        <p class="mb-1 fw-bold text-dark fs-5">{{ __('ui.dropHere') }}</p>
                        <p class="text-muted small">{{ __('ui.chooseFile') }}</p>
                    </div>
                    
                    <div wire:loading wire:target="images" class="mt-3">
                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                        <span class="ms-2 small text-muted">{{ __('ui.uploading') }}...</span>
                    </div>
                </div>
            </div>

            {{-- SEZIONE ANTEPRIMA (COPIATA DALLO SCREENSHOT) --}}
            <div class="mb-5">
                <p class="fw-bold mb-3 fs-5"><i class="bi bi-eye me-2 text-primary"></i>{{ __('ui.photoPreview') }}</p>
                <div class="preview-container p-4 border rounded-4 bg-white shadow-sm">
                    <div class="row g-3">
                        {{-- IMMAGINI ESISTENTI CON BADGE VETRINA E CESTINO ROSSO --}}
                        @foreach($announcement->images as $image)
                            <div class="col-auto">
                                <div class="position-relative" style="width: 100px; height: 100px;">
                                    <img src="{{ Storage::url($image->path) }}" 
                                        class="rounded-3 shadow-sm {{ $loop->first ? 'border border-success border-3' : 'border' }}" 
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                    
                                    @if ($loop->first)
                                        <span class="badge bg-success position-absolute top-0 start-0 m-1 text-uppercase fw-bold" style="font-size: 0.6rem; padding: 4px 6px;">
                                            {{ __('ui.featured') }}
                                        </span>
                                    @endif
                                    
                                    <button type="button" wire:click="deleteImage({{ $image->id }})" 
                                        class="btn btn-danger btn-sm position-absolute rounded-circle shadow p-0 d-flex align-items-center justify-content-center" 
                                        style="width: 26px; height: 26px; bottom: 5px; right: 5px; border: 2px solid white;">
                                        <i class="bi bi-trash-fill fs-6 text-white"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach

                        {{-- ANTEPRIME NUOVE IMMAGINI --}}
                        @if ($images)
                            @foreach ($images as $key => $image)
                                <div class="col-auto">
                                    <div class="position-relative" style="width: 100px; height: 100px;">
                                        <img src="{{ $image->temporaryUrl() }}" 
                                            class="img-fluid rounded-3 border shadow-sm" 
                                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                                        <span class="badge bg-primary position-absolute top-0 start-0 m-1" style="font-size: 0.6rem;">New</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- BOTTONE FINALE --}}
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-bold text-uppercase shadow-sm border-0">
                    {{ __('ui.edit') }} <i class="bi bi-save ms-2"></i>
                </button>
            </div>
        </form>
    </div>

</div> {{-- CHIUSURA DIV RADICE --}}