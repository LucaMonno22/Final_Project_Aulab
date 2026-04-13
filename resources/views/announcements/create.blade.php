<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                {{-- Titolo tradotto: Inserisci il tuo Annuncio --}}
                <h2 class="mb-4 text-center fw-bold" style="color: var(--wevend-primary);">
                    {{ __('ui.createTitle') }}
                </h2>
                
                <hr>

                @livewire('announcement-create')

            </div>
        </div>
    </div>
</x-layout>
