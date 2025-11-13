function initSmoothScroll() {
    // Seleciona todos os links de âncora que começam com #
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
        // 1. Previne o comportamento padrão (o pulo)
        e.preventDefault();

        // 2. Pega o ID do alvo (ex: "#contato")
        const targetId = this.getAttribute('href');

        // 3. Trata o caso de href="#" (link para o topo)
        if (targetId === '#') {
            window.scrollTo({
            top: 0,
            behavior: 'smooth'
            });
            return;
        }

        // 4. Encontra o elemento-alvo na página
        const targetElement = document.querySelector(targetId);

        // 5. Se o elemento existir, rola suavemente até ele
        if (targetElement) {
            targetElement.scrollIntoView({
            behavior: 'smooth', // A mágica acontece aqui
            block: 'start'      // Alinha o topo do elemento ao topo da viewport
            });
        }
        });
    });
}

export default initSmoothScroll;
