<div class="container mt-5 mb-5">
    {{-- Messaggio di Successo --}}
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4 shadow-sm border-0 rounded-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <form wire:submit.prevent="store" class="p-4 shadow rounded-4 bg-white border-top border-primary border-4">

        <div class="row">
            <div class="col-12">
                {{-- Titolo --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">{{ __('ui.announcementTitle') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title"
                        placeholder="{{ __('ui.titlePlaceholder') }}">
                    @error('title')
                        <span class="error-message">{{ __('ui.errortitle') }}</span>
                    @enderror
                </div>

                {{-- Prezzo --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">{{ __('ui.announcementPrice') }} ({{ __('ui.currency') }})</label>


                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold text-secondary">{{ __('ui.currency') }}</span>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                            wire:model="price" placeholder="0.00">
                    </div>
                    @error('price')
                        <span class="error-message">{{ __('ui.errorprice') }}</span>
                    @enderror
                </div>

                {{-- Categoria --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">{{ __('ui.announcementCategory') }}</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" wire:model="category_id">
                        <option value="">{{ __('ui.chooseCategory') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ __("ui.$category->name") }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="error-message">{{ __('ui.errorcategory') }}</span>
                    @enderror
                </div>

                {{-- Descrizione (Ora sotto gli altri campi) --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">{{ __('ui.announcementDescription') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="5" wire:model="description"
                        placeholder="{{ __('ui.descriptionPlaceholder') }}"></textarea>
                    @error('description')
                        <span class="error-message">{{ __('ui.errordescription') }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <hr class="my-4 text-muted">

        {{-- SEZIONE CARICAMENTO IMMAGINI --}}
        <div class="mb-4">
            <div class="d-flex align-items-baseline gap-2 mb-2">
                <label class="form-label fw-bold mb-0">{{ __('ui.uploadImages') }}</label>
                <span class="text-muted small fst-italic">({{ __('ui.firstImageFeatured') }})</span>
            </div>

            {{-- Dropzone Custom --}}
            <div class="dropzone-container">
                <input type="file" wire:model.live="temporary_images" multiple class="dropzone-input" />

                <div class="dropzone-content">
                    <i class="bi bi-images dropzone-icon"></i>
                    <p class="dropzone-text-main">{{ __('ui.dropHere') }}</p>
                    <p class="dropzone-text-sub">{{ __('ui.clickToBrowse') }}</p>
                </div>

                {{-- Loading State --}}
                <div wire:loading wire:target="temporary_images" class="mt-3">
                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                    <span class="ms-2 upload-loading-text">{{ __('ui.uploading') }}...</span>
                </div>
            </div>

            @error('temporary_images.*')
                <p class="error-message mt-2"><i class="bi bi-exclamation-triangle-fill"></i>{{ __('ui.errorimage') }}</p>
            @enderror
        </div>

        {{-- PREVIEW IMMAGINI --}}
        @if (!empty($images))
            <div class="mb-4">
                <p class="fw-bold mb-3"><i class="bi bi-eye me-2"></i>{{ __('ui.photoPreview') }}</p>
                <div class="preview-grid row g-3">
                    @foreach ($images as $key => $image)
                        <div class="col-6 col-md-3 col-lg-2 text-center" wire:key="image-{{ $key }}">
                            <div class="preview-wrapper">
                                <div class="preview-image {{ $loop->first ? 'is-featured' : '' }}"
                                    style="background-image: url({{ $image->temporaryUrl() }});">

                                    @if ($loop->first)
                                        <span class="badge-featured">{{ __('ui.featured') }}</span>
                                    @endif
                                </div>

                                <button type="button" class="btn-delete-img"
                                    wire:click="removeImage({{ $key }})" title="{{ __('ui.delete') }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Bottone Invio --}}
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary px-5 py-3 fw-bold shadow-sm text-uppercase rounded-pill">
                {{ __('ui.createButton') }}
            </button>
        </div>
    </form>
</div>
