/**
 * Função para controlar o modal de BUSCA
 */
function initSearchModal() {
    const openButton  = document.querySelector('#search-open-button');
    const closeButton = document.querySelector('#search-close-button');
    const modal       = document.querySelector('#search-modal');

    if (openButton && closeButton && modal) {
        
        const openModal = () => {
            modal.classList.remove('opacity-0', 'invisible', '-translate-y-full');
            modal.classList.add('opacity-100', 'visible', 'translate-y-0');
        };

        const closeModal = () => {
            modal.classList.add('opacity-0', 'invisible', '-translate-y-full');
            modal.classList.remove('opacity-100', 'visible', 'translate-y-0');
        };

        openButton.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });

        closeButton.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal();
        });
        
        // Evento de teclado para FECHAR (tecla "Escape")
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('visible')) {
                closeModal();
            }
        });
        
        // Opcional: Adicionar "clicar fora" para o modal de busca
        modal.addEventListener('click', (e) => {
            // Se o clique foi no overlay (modal) e NÃO em um filho...
            if (e.target === modal) { 
                closeModal();
            }
        });
    }
}

export default initSearchModal;