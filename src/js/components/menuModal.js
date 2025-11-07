/**
 * Função para controlar o modal do MENU
 */
function initMenuModal() {
    // Seleciona os elementos pelos seus IDs
    const openButton  = document.querySelector('#menu-button');
    const closeButton = document.querySelector('#menu-close-button');
    const menuModal   = document.querySelector('#menu-modal');  // O overlay de fundo
    const menuPanel   = document.querySelector('#menu-panel');  // O painel que desliza

    // Só executa se todos os elementos existirem
    if (openButton && closeButton && menuModal && menuPanel) {

        // Função para ABRIR o modal
        const openModal = () => {
            // 1. Mostra o overlay de fundo
            menuModal.classList.remove('opacity-0', 'invisible');
            menuModal.classList.add('opacity-100', 'visible');
            
            // 2. Desliza o painel da DIREITA
            menuPanel.classList.remove('translate-x-full'); // Remove a classe que o esconde à direita
            menuPanel.classList.add('translate-x-0');       // Adiciona a classe que o move para a posição 0
        };

        // Função para FECHAR o modal
        const closeModal = () => {
            // 1. Desliza o painel para a DIREITA
            menuPanel.classList.add('translate-x-full');    // Adiciona a classe que o esconde à direita
            menuPanel.classList.remove('translate-x-0');    // Remove a classe que o mantém na posição 0

            // 2. Esconde o overlay (só depois que a animação de slide terminar)
            setTimeout(() => {
                menuModal.classList.add('opacity-0', 'invisible');
                menuModal.classList.remove('opacity-100', 'visible');
            }, 300); // 300ms (deve ser igual à sua classe `duration-300`)
        };

        // Evento de clique para ABRIR
        openButton.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });

        // Evento de clique para FECHAR (botão "X")
        closeButton.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal();
        });

        // Evento de clique para FECHAR (clicando "fora" do menu)
        menuModal.addEventListener('click', (e) => {
            // Se o clique foi no overlay (menuModal) e NÃO no painel (menuPanel)...
            if (e.target === menuModal) { 
                closeModal();
            }
        });

        // Evento de teclado para FECHAR (tecla "Escape")
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && menuModal.classList.contains('visible')) {
                closeModal();
            }
        });
    }
}

export default initMenuModal;