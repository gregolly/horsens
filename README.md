[![WordPress](https://img.shields.io/badge/WordPress-6.x-blue?style=for-the-badge&logo=wordpress)](https://wordpress.org/) [![SASS](https://img.shields.io/badge/SASS-Compilado-pink?style=for-the-badge&logo=sass)](https://sass-lang.com/) [![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v3-blueviolet?style=for-the-badge&logo=tailwindcss)](https://tailwindcss.com/)

# Tema WordPress Horsens

Este é o repositório do tema WordPress customizado para o site Horsens. O tema foi construído com um pipeline de front-end moderno, focado em performance e manutenibilidade.

O tema utiliza **ACF Pro** extensivamente para gerir o conteúdo da página inicial e outras secções-chave através de uma **Página de Opções** global.

## Tech Stack Principal

- **WordPress:** Como CMS base.
- **ACF Pro:** Para todos os campos de conteúdo dinâmico e a Página de Opções.
- **Gulp:** Como task runner (automatizador de tarefas).
- **SASS:** Para pré-processamento de CSS.
- **Tailwind CSS (v3):** Como framework CSS utility-first.
- **Webpack (via `webpack-stream`):** Para agrupar (bundling) e transpilar JavaScript (ES6+).
- **Babel:** Para transpilar JavaScript moderno para código compatível com browsers antigos.
- **BrowserSync:** Para live-reloading automático durante o desenvolvimento.
- **WP-CLI:** Recomendado para gestão de ambiente.

## Requisitos

Para correr este projeto localmente, você precisará de ter instalado:

- Um ambiente WordPress local (ex: [Local by Flywheel](https://localwp.com/)).
- [Node.js](https://nodejs.org/) (versão LTS recomendada).

### Plugins Obrigatórios e Recomendados

- **Advanced Custom Fields Pro (Obrigatório):** O tema **NÃO FUNCIONARÁ** sem este plugin. Os campos e a Página de Opções dependem dele.
- **Contact Form 7 (Recomendado):** O tema inclui estilos customizados para este plugin, como visto na secção de contacto.

## Instalação e Setup

1.  **Clonar o Repositório:**
    Clone este repositório (idealmente a branch `develop`) para a sua pasta `wp-content/themes/`:

    ```bash
    git clone [URL_DO_SEU_REPOSITORIO] horsens
    ```

2.  **Navegar para a Pasta:**
    Abra um terminal dentro da pasta do tema:

    ```bash
    cd wp-content/themes/horsens
    ```

3.  **Instalar Dependências NPM:**
    Isto irá instalar Gulp, Tailwind, Webpack, e todas as outras dependências listadas no `package.json` para a pasta `node_modules/`.

    ```bash
    npm install
    ```

4.  **Ativar o Tema:**
    Vá ao painel de administração do WordPress (`Aparência > Temas`) e ative o tema "Horsens".

## Desenvolvimento (Build Scripts)

Todos os comandos devem ser corridos a partir da raiz da pasta do tema (`/wp-content/themes/horsens/`).

### Para Desenvolvimento

Este é o comando principal que você usará 99% do tempo. Ele irá compilar todos os seus assets, iniciar o BrowserSync (para recarregar o browser) e ficar a "observar" (`watch`) os seus ficheiros `src/` e `.php` por alterações.

```bash
gulp default
```
