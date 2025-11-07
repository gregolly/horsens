/**
 * Inicializa todos os acordeões de FAQ na página com fecho-exclusivo.
 */
function initFaqAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');
    if (!faqItems.length) {
        return; // Sai se não houver FAQs
    }

    // Função para fechar TODOS os itens
    const closeAllItems = () => {
        faqItems.forEach(item => {
            const answer = item.querySelector('.faq-answer');
            item.classList.remove('open');
            if (answer) {
                answer.style.maxHeight = '0px';
            }
        });
    };

    // Função para abrir um item específico
    const openItem = (item) => {
        const answer = item.querySelector('.faq-answer');
        item.classList.add('open');
        if (answer) {
            // Define a altura máxima para a altura real do conteúdo
            answer.style.maxHeight = answer.scrollHeight + 'px';
        }
    };

    // 1. Configurar o estado inicial (abrir o primeiro item por defeito)
    const firstItem = faqItems[0];
    if (firstItem) {
        // Assegura que todos começam fechados
        closeAllItems(); 
        // Abre o primeiro (que o HTML já marca como 'open')
        openItem(firstItem);
    }

    // 2. Adicionar os listeners de clique
    faqItems.forEach(item => {
        const button = item.querySelector('.faq-question');
        if (button) {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Verifica se o item clicado já está aberto
                const isAlreadyOpen = item.classList.contains('open');

                // Fecha todos os itens
                closeAllItems();

                // Se não estava aberto, abre-o
                if (!isAlreadyOpen) {
                    openItem(item);
                }
                // Se já estava aberto, o 'closeAllItems' já o fechou (efeito de toggle)
            });
        }
    });
}

// Exporta a função para ser usada no main.js
export default initFaqAccordion;