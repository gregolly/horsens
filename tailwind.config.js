/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './*.php',
        './template-parts/**/*.php',
        './src/js/dev/**/*.js',
        './src/scss/**/*.scss'
    ],
    theme: {
        extend: {
            colors: {
                'brand-azul-escuro': '#27363F',
                'brand-bege-claro': '#D4CBB2',
                'brand-off-white': '#D9D4D0',
                'brand-marrom': '#A97C5B',
                'brand-cafe': '#292018',
                'brand-bg-section': '#D9D9D9'
            },
            fontFamily: {
                serif: ['Playfair Display', 'serif'],
                sans: ['Karla', 'sans-serif'],
            }
        }
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}