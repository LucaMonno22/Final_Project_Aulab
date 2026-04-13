document.addEventListener('DOMContentLoaded', () => {
    let missionVideo = document.getElementById('shortVideo');
    let touchLayer = document.getElementById('videoTouchLayer');
    let statusIconContainer = document.getElementById('videoStatusIcon');

    if (missionVideo && touchLayer) {
        
        // Tenta l'autoplay all'avvio (partirà muto)
        missionVideo.play().catch(e => console.log("Autoplay in attesa di click"));

        touchLayer.addEventListener('click', (event) => {
            let iconInner = statusIconContainer.querySelector('i');
            
            // Al primo click, sblocchiamo il volume
            if (missionVideo.muted) {
                missionVideo.muted = false;
                missionVideo.volume = 1.0;
            }
            
            if (!missionVideo.paused) {
                // 1. SE STA ANDANDO: Metti in pausa (non tocca il tempo)
                missionVideo.pause();
                iconInner.className = "bi bi-pause-fill";
            } else {
                // 2. SE È FERMO: Riparte esattamente da dove era rimasto
                missionVideo.play().catch(e => console.error("Errore play:", e));
                iconInner.className = "bi bi-play-fill";
            }

            // Mostra icona feedback
            statusIconContainer.classList.remove('d-none');
            setTimeout(() => {
                statusIconContainer.classList.add('d-none');
            }, 500);
        });

        // Quando finisce i 19 secondi, si ferma del tutto
        missionVideo.addEventListener('ended', () => {
            missionVideo.currentTime = 0;
            missionVideo.pause();
        });
    }
});