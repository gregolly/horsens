// assets/js/dev/scrollReveal.js

/**
 * Inicializa o Intersection Observer para animar elementos
 * quando eles entram na tela.
 */
function initScrollReveal() {
    
    // Seleciona todos os elementos que têm o nosso atributo
    const elementsToObserve = document.querySelectorAll('[data-scroll-reveal]');

    if (!elementsToObserve.length) {
        return; // Sai se não houver nada para observar
    }

    // Configura o observador
    const options = {
        root: null, // 'null' significa que o viewport é a raiz
        rootMargin: '0px',
        threshold: 0.1 // O callback é acionado quando 10% do elemento está visível
    };

    // O callback é o que acontece quando um elemento é "intersectado"
    const callback = (entries, observer) => {
        entries.forEach(entry => {
            // O elemento está a entrar na tela?
            if (entry.isIntersecting) {
                // Sim: adiciona a classe 'is-visible' para acionar a animação CSS
                entry.target.classList.add('is-visible');
                
                // IMPORTANTE: Para de observar o elemento
                // A animação só precisa de acontecer uma vez
                observer.unobserve(entry.target);
            }
        });
    };

    // Cria e ativa o observador
    const observer = new IntersectionObserver(callback, options);
    elementsToObserve.forEach(element => {
        observer.observe(element);
    });
}

// Exporta a função para ser usada no main.js
export default initScrollReveal;