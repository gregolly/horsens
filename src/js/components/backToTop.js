function initBackToTop() {
    const backToTopButton = document.getElementById('back-to-top');

    if (backToTopButton) {

        // 1. Lógica para mostrar/esconder
        window.addEventListener('scroll', function() {
            // Se rolar mais que 300px
            if (window.scrollY > 300) {
                backToTopButton.classList.add('is-visible');
            } else {
                backToTopButton.classList.remove('is-visible');
            }
        });

        // 2. Lógica para scroll suave (BÔNUS)
        // Isso impede o "salto" do href="#top" e faz uma rolagem suave
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault(); // Cancela o evento de clique padrão
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Faz a rolagem suave
            });
        });
    }
}

export default initBackToTop;