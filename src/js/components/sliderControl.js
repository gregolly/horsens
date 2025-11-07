function initSliderControls() {
    const track = document.getElementById('testimony-slider-track');
    const prevBtn = document.getElementById('testimony-prev-btn');
    const nextBtn = document.getElementById('testimony-next-btn');

    // Só executa se todos os elementos existirem
    if (!track || !prevBtn || !nextBtn) {
        return;
    }

    /**
     * Rola o "track" pela largura de um slide (a largura visível do track).
     * @param {number} direction - 1 para próximo, -1 para anterior.
     */
    const scrollSlide = (direction) => {
        const slideWidth = track.clientWidth; // Pega a largura visível do container
        track.scrollBy({
            left: slideWidth * direction,
            behavior: 'smooth'
        });
    };

    prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        scrollSlide(-1); // Rola para a esquerda
    });

    nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        scrollSlide(1); // Rola para a direita
    });
}

// Exporta a função para ser usada no main.js
export default initSliderControls;
