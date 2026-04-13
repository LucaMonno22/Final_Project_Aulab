<x-layout>
    <div class="container my-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <h2 class="fw-bold text-uppercase mb-4">
                        <i class="bi bi-pencil-square me-2" style="color: var(--komerz-blue);"></i>
                        {{ __('ui.editAnnouncement') }}
                    </h2>
                    
                    {{-- Qui richiamiamo il componente Livewire passando l'annuncio da modificare --}}
                    @livewire('edit-announcement', ['announcement' => $announcement])
                    
                </div>
            </div>
        </div>
    </div>
</x-layout>