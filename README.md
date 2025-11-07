Tema WordPress Horsens

Este é o repositório do tema WordPress customizado para o site Horsens. O tema foi construído com um pipeline de front-end moderno, focado em performance e manutenibilidade.

O tema utiliza ACF Pro extensivamente para gerir o conteúdo da página inicial e outras secções-chave através de uma Página de Opções global.

Tech Stack Principal

WordPress: Como CMS base.

ACF Pro: Para todos os campos de conteúdo dinâmico e a Página de Opções.

Gulp: Como task runner (automatizador de tarefas).

SASS: Para pré-processamento de CSS.

Tailwind CSS (v3): Como framework CSS utility-first.

Webpack (via webpack-stream): Para agrupar (bundling) e transpilar JavaScript (ES6+).

Babel: Para transpilar JavaScript moderno para código compatível com browsers antigos.

BrowserSync: Para live-reloading automático durante o desenvolvimento.

WP-CLI: Recomendado para gestão de ambiente.

Requisitos

Para correr este projeto localmente, você precisará de ter instalado:

Um ambiente WordPress local (ex: Local by Flywheel).

Node.js (versão LTS recomendada).

Composer (recomendado para dependências PHP e stubs do PHPStorm).

Instalação e Setup

Clonar o Repositório:
Clone este repositório para a sua pasta wp-content/themes/:

git clone [URL_DO_SEU_REPOSITORIO] horsens

Navegar para a Pasta:
Abra um terminal dentro da pasta do tema:

cd wp-content/themes/horsens

Instalar Dependências NPM:
Isto irá instalar Gulp, Tailwind, Webpack, e todas as outras dependências listadas no package.json para a pasta node_modules/.

npm install

Instalar Dependências do Composer (Opcional, mas Recomendado):
Se você usa PHPStorm, isto irá instalar os stubs de código do WordPress e do ACF Pro para um autocomplete inteligente.

composer install

Ativar o Tema:
Vá ao painel de administração do WordPress (Aparência > Temas) e ative o tema "Horsens".

Sincronizar Campos ACF:

Vá para Campos Personalizados > Grupos de Campos no admin.

Você deve ver uma notificação a dizer que foram encontrados novos ficheiros JSON.

Clique no botão "Sincronizar" para importar todos os grupos de campos definidos na pasta acf-json/.

Preencher a Página de Opções:

A maioria do conteúdo da página inicial (como a secção de Equipa, Testemunhos, etc.) é gerida globalmente.

Vá para Aparência > Configurações da página inicial e preencha os campos necessários.

Desenvolvimento (Build Scripts)

Todos os comandos devem ser corridos a partir da raiz da pasta do tema (/wp-content/themes/horsens/).

Para Desenvolvimento

Este é o comando principal que você usará 99% do tempo. Ele irá compilar todos os seus assets, iniciar o BrowserSync (para recarregar o browser) e ficar a "observar" (watch) os seus ficheiros src/ e .php por alterações.

npm start

(Se você não configurou o package.json, pode correr gulp ou gulp watch diretamente, dependendo do seu gulpfile.js)

Para Produção

Este comando apenas compila e minifica todos os seus assets para a pasta dist/ sem iniciar o watch ou o browsersync.

npm run build

Estrutura do Tema

A estrutura de ficheiros é fundamental para o pipeline de build.

/src/
É aqui que todo o desenvolvimento de front-end acontece.

/src/scss/: Contém os seus ficheiros SASS. O style.scss importa o Tailwind e todos os seus parciais (ex: \_menu-modal.scss, \_contact-form.scss).

/src/js/: Contém o seu JavaScript. O main.js é o ponto de entrada principal que importa todos os seus componentes (ex: faq-accordion.js).

/src/images/: Imagens que precisam de ser otimizadas e movidas para dist/.

/src/fonts/: Ficheiros de fontes locais.

/dist/
NÃO EDITE FICHEIROS NESTA PASTA! Esta pasta é gerada automaticamente pelo Gulp.

/dist/css/style.min.css: O seu CSS final compilado e minificado.

/dist/js/bundle.min.js: O seu JavaScript final agrupado e minificado.

/dist/images/ e /dist/fonts/: Assets otimizados e prontos para produção.

/inc/
Contém todo o código PHP modular do WordPress.

cpt.php: Registo dos Custom Post Types (Equipe, Eventos, Inscrições).

register-options-page.php: Registo da página "Configurações da página inicial".

enqueue-assets.php: Enfileira os ficheiros CSS e JS da pasta dist/.

acf-\*.php: Funções de configuração do ACF (incluindo o acf-json).

helpers.php: Funções de ajuda (como add_svg_classes).

/template-parts/
Contém os blocos de layout reutilizáveis (ex: section-about.php, section-faq.php).

/acf-json/
O "código-fonte" dos seus campos ACF. Sempre "commite" as alterações nesta pasta para manter os campos sincronizados entre ambientes.
