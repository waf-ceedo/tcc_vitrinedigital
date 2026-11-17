
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include 'includes_site/head.php'; ?>

    <title>Conteúdo Teórico - Vitrine Digital</title>

    <style>

        body {
            background: #f7f9fc;
            color: #465268;
        }

        /* APRESENTAÇÃO */

        .teorico-intro {
            background: linear-gradient(120deg, #eef3fc, #e4edfa);
            padding: 65px 20px;
            text-align: center;
        }

        .teorico-intro span {
            color: #1769e0;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .teorico-intro h1 {
            color: #173b70;
            font-family: Georgia, serif;
            font-size: 42px;
            margin: 18px 0;
        }

        .teorico-intro p {
            max-width: 680px;
            margin: auto;
            color: #596579;
            line-height: 1.8;
            font-size: 15px;
        }

        .teorico-autores {
            margin-top: 20px;
            color: #173b70;
            font-size: 14px;
            font-weight: 600;
        }

        /* CONTEÚDO */

        .teorico-area {
            max-width: 950px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .teorico-artigo {
            background: #ffffff;
            padding: 55px 65px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(23, 59, 112, 0.05);
        }

        /* IDENTIFICAÇÃO */

        .identificacao {
            text-align: center;
            padding-bottom: 30px;
            margin-bottom: 30px;
            border-bottom: 1px solid #e5eaf1;
        }

        .identificacao p {
            text-align: center;
            font-size: 12px;
            margin-bottom: 5px;
            color: #596579;
        }

        .identificacao h2 {
            font-family: Georgia, serif;
            color: #173b70;
            font-size: 25px;
            margin: 30px 0 18px;
        }

        /* TÍTULOS E PARÁGRAFOS */

        .teorico-artigo h2 {
            font-family: Georgia, serif;
            font-size: 23px;
            color: #173b70;
            margin-top: 45px;
            margin-bottom: 20px;
            padding-bottom: 11px;
            border-bottom: 2px solid #e8eef7;
        }

        .teorico-artigo h3 {
            color: #24558e;
            font-size: 17px;
            font-weight: 700;
            margin-top: 28px;
            margin-bottom: 13px;
            line-height: 1.5;
        }

        .teorico-artigo p {
            color: #596579;
            font-size: 14px;
            line-height: 1.85;
            text-align: justify;
            margin-bottom: 15px;
        }

        .teorico-artigo ul,
        .teorico-artigo ol {
            padding-left: 23px;
            margin-bottom: 20px;
        }

        .teorico-artigo li {
            color: #596579;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 5px;
        }

        /* RESUMO */

        .resumo {
            background: #f1f6fd;
            padding: 24px 27px;
            border-left: 4px solid #3985ff;
            margin-bottom: 25px;
        }

        .resumo p {
            margin-bottom: 12px;
        }

        .palavras-chave {
            color: #173b70;
            font-size: 13px;
        }

        /* REFERÊNCIAS */

        .referencias p {
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .referencias a {
            color: #1769e0;
            text-decoration: none;
        }

        .referencias a:hover {
            text-decoration: underline;
        }

        /* RESPONSIVIDADE */

        @media (max-width: 768px) {

            .teorico-intro {
                padding: 45px 20px;
            }

            .teorico-intro h1 {
                font-size: 32px;
            }

            .teorico-area {
                margin: 25px auto;
                padding: 0 12px;
            }

            .teorico-artigo {
                padding: 30px 22px;
            }

            .teorico-artigo h2 {
                font-size: 21px;
            }

            .teorico-artigo h3 {
                font-size: 16px;
            }

        }

    </style>

</head>

<body>

<?php include 'includes_site/header.php'; ?>


<!-- APRESENTAÇÃO -->

<section class="teorico-intro">

    <div class="container">

        <span>TRABALHO DE CONCLUSÃO DE CURSO</span>

        <h1>Conteúdo Teórico</h1>

        <p>
            Conheça os fundamentos e as tecnologias relacionados
            ao desenvolvimento da plataforma Vitrine Digital.
        </p>

        <div class="teorico-autores">
            Jaísy Soares e Sara Brizolla 
        </div>

    </div>

</section>


<!-- CONTEÚDO -->

<main class="teorico-area">

    <article class="teorico-artigo">


        <!-- 1 INTRODUÇÃO -->

        <h2>1 INTRODUÇÃO</h2>

        <p>
            A tecnologia está cada vez mais presente nas atividades
            comerciais. O crescimento do acesso à internet possibilitou
            novas formas de comercialização, permitindo que produtos
            sejam divulgados e vendidos por plataformas digitais.
        </p>

        <p>
            Entre essas plataformas estão os marketplaces, que
            reúnem diferentes produtos e vendedores em um único
            ambiente virtual. Exemplos conhecidos são Shopee,
            Mercado Livre, Amazon, AliExpress, Magazine Luiza e Temu.
        </p>

        <p>
            O presente trabalho tem como tema “Sistemas de Vendas:
            Vitrine Digital” e apresenta o desenvolvimento de um
            website inspirado nesse modelo de comércio eletrônico.
            O objetivo é aplicar os conhecimentos adquiridos na
            área de Desenvolvimento Web e disponibilizar o projeto
            como referência para estudos e possíveis melhorias.
        </p>

        <p>
            Para o desenvolvimento, foram utilizadas principalmente
            as tecnologias PHP e CSS, com edição dos arquivos no
            Visual Studio Code. O PHP foi empregado na programação
            das funcionalidades, enquanto o CSS foi utilizado
            na organização visual da plataforma.
        </p>

        <p>
            O projeto também considera aspectos como usabilidade,
            responsividade, segurança e desempenho, buscando
            proporcionar uma navegação organizada e adequada
            aos usuários.
        </p>


        <!-- 2 FUNDAMENTAÇÃO TEÓRICA -->

        <h2>2 DESENVOLVIMENTO</h2>

        <h3>2.1 DESENVOLVIMENTO DE WEBSITES</h3>

        <p>
            O desenvolvimento de websites envolve planejamento,
            criação, programação, testes e manutenção de páginas
            acessíveis pela internet. Um website pode ter diferentes
            finalidades, como comunicação, divulgação, educação,
            prestação de serviços e comércio eletrônico.
        </p>

        <p>
            No presente projeto, o website possui finalidade
            comercial e foi desenvolvido para apresentar diferentes
            lojas e seus produtos em um ambiente digital organizado.
        </p>

        <h3>
            2.1.1 O que é desenvolvimento de websites e quais são
            seus principais objetivos?
        </h3>

        <p>
            O desenvolvimento de websites consiste na criação
            de páginas e sistemas acessados por navegadores.
            Seus objetivos dependem da finalidade da aplicação.
            Em sistemas comerciais, destacam-se a apresentação
            de produtos, a organização das informações e a
            facilidade de navegação.
        </p>

        <p>
            No projeto Vitrine Digital, a proposta é oferecer
            uma plataforma na qual os usuários possam visualizar
            produtos e conhecer diferentes estabelecimentos.
        </p>

        <h3>
            2.2 COMO FUNCIONA A ESTRUTURA BÁSICA DE UM WEBSITE UTILIZANDO PHP, CSS E BANCO DE DADOS?
        </h3>

        <p>
            A estrutura do sistema utiliza principalmente PHP, CSS e MySQL. O PHP é responsável pelo processamento das informações e pela implementação das funcionalidades executadas no servidor.

        </p>

        <p>
            O CSS define a aparência das páginas, permitindo configurar cores, fontes, espaçamentos e posicionamento dos elementos. Já o MySQL é utilizado para armazenar e organizar os dados do sistema, como informações das lojas e seus produtos.
        </p>

        <p> 
            O Visual Studio Code foi utilizado para criar e editar os arquivos do projeto. Essas tecnologias trabalham de maneira complementar: enquanto o PHP cuida da lógica do sistema, o CSS organiza sua apresentação visual e o MySQL permite armazenar e consultar as informações.
        </p>

        <h3>
            2.3 QUAIS SÃO OS PRINCIPAIS COMPONENTES QUE COMPÕEM
            UM WEBSITE MODERNO?
        </h3>

        <p>
            Um website moderno pode apresentar cabeçalho,
            menu de navegação, área de conteúdo, imagens,
            formulários, botões e rodapé. Em uma plataforma
            de vendas, esses elementos ajudam a identificar
            o sistema e organizar os produtos.
        </p>

        <p>
            Também são importantes características como
            responsividade, acessibilidade, segurança e
            usabilidade, que contribuem para uma experiência
            adequada em diferentes dispositivos.
        </p>

        <h3>
            2.4 COMO FUNCIONA UM SISTEMA DE VENDAS EM UM WEBSITE?
        </h3>

        <p>
            Um sistema de vendas permite apresentar produtos
            e disponibilizar informações como nome, imagem,
            descrição e preço. Dependendo de sua estrutura,
            também pode oferecer pesquisa, categorias,
            filtros e carrinho de compras.
        </p>

        <p>
            No projeto desenvolvido, esses conceitos serviram
            como referência para a criação de uma plataforma
            organizada, com páginas públicas e recursos
            administrativos para os lojistas.
        </p>

        <h3>
            2.5 QUAIS SÃO AS APLICAÇÕES PRÁTICAS DE UM WEBSITE DE VENDAS?
        </h3>

        <p>
            Um website de vendas funciona como uma vitrine digital,
            permitindo divulgar produtos e informações de lojas
            pela internet. A organização por categorias e páginas
            facilita a localização dos produtos pelos visitantes.
        </p>

        <p>
            A plataforma também pode receber novas funcionalidades,
            como carrinho de compras, pedidos e formas de pagamento,
            conforme suas necessidades e futuras melhorias.
        </p>

        <h3>
            2.6 QUAIS LINGUAGENS DE PROGRAMAÇÃO E PLATAFORMAS
            PODEM SER UTILIZADAS NO DESENVOLVIMENTO DE UM WEBSITE?
        </h3>

        <p>
            O desenvolvimento web utiliza diferentes tecnologias.
            O HTML estrutura o conteúdo das páginas, o CSS define
            sua aparência e o JavaScript permite implementar
            interações no navegador. No servidor, podem ser
            utilizadas linguagens como PHP, Python, Java e C#.
        </p>

        <p>
            Neste projeto, foram utilizados PHP e CSS, com o
            Visual Studio Code como ambiente de desenvolvimento.
            A escolha permitiu aplicar os conhecimentos adquiridos
            nas aulas de Desenvolvimento Web.
        </p>

        <h3>
            2.7 COMO OTIMIZAR O DESEMPENHO, A SEGURANÇA E A
            USABILIDADE DE UM WEBSITE?
        </h3>

        <p>
            O desempenho está relacionado à velocidade de
            carregamento das páginas e à organização dos arquivos.
            A segurança envolve validação de informações,
            proteção de dados e controle de acesso.
        </p>

        <p>
            A usabilidade está relacionada à facilidade de
            utilização do sistema. No projeto, a organização
            visual, a disposição dos produtos e a responsividade
            foram consideradas para facilitar a navegação.
        </p>

        <h3>
            2.8 COMO UM WEBSITE DE VENDAS PODE CONTRIBUIR
            PARA O COMÉRCIO ELETRÔNICO?
        </h3>

        <p>
            Websites de vendas contribuem para o comércio
            eletrônico ao permitir que produtos sejam divulgados
            e consultados pela internet. Os usuários podem
            conhecer diferentes opções sem precisar visitar
            fisicamente os estabelecimentos.
        </p>

        <p>
            A Vitrine Digital utiliza o modelo dos marketplaces
            como referência, buscando organizar lojas e produtos
            em uma única plataforma. Dessa forma, o projeto
            demonstra a aplicação dos conhecimentos de
            desenvolvimento web em uma solução comercial.
        </p>

        <!-- 4 CONCLUSÃO -->

        <h2>3 CONCLUSÃO</h2>

        <p>
            O desenvolvimento deste Trabalho de Conclusão de
            Curso possibilitou aplicar os conhecimentos adquiridos
            durante o Ensino Médio Integrado, especialmente na
            área de Desenvolvimento Web.
        </p>

        <p>
            A criação da Vitrine Digital permitiu compreender
            como tecnologias como PHP, CSS e MySQL podem ser
            utilizadas na construção de uma plataforma de vendas.
            Também foram trabalhados aspectos de organização
            de páginas, gerenciamento de informações, segurança
            e experiência do usuário.
        </p>

        <p>
            O projeto demonstrou a importância do planejamento
            e da integração entre diferentes tecnologias para
            desenvolver uma aplicação web. Além disso, possibilitou
            relacionar os conhecimentos teóricos com uma
            experiência prática de programação.
        </p>

        <p>
            Conclui-se que o trabalho atingiu seu propósito ao
            desenvolver uma plataforma inspirada no modelo de
            marketplaces, proporcionando experiência prática
            em desenvolvimento de sistemas e apresentando
            possibilidades de melhorias futuras.
        </p>


        <!-- REFERÊNCIAS -->

        <h2>REFERÊNCIAS</h2>

        <div class="referencias">

            <p>
                MDN WEB DOCS. HTML: HyperText Markup Language.
                Disponível em:
                <a href="https://developer.mozilla.org/pt-BR/docs/Web/HTML"
                   target="_blank">
                    https://developer.mozilla.org/pt-BR/docs/Web/HTML
                </a>.
                Acesso em: 7 out. 2026.
            </p>

            <p>
                MDN WEB DOCS. CSS: Cascading Style Sheets.
                Disponível em:
                <a href="https://developer.mozilla.org/pt-BR/docs/Web/CSS"
                   target="_blank">
                    https://developer.mozilla.org/pt-BR/docs/Web/CSS
                </a>.
                Acesso em: 14 out. 2026.
            </p>

            <p>
                PHP GROUP. PHP: Hypertext Preprocessor.
                Disponível em:
                <a href="https://www.php.net/" target="_blank">
                    https://www.php.net/
                </a>.
                Acesso em: 7 out. 2026.
            </p>

            <p>
                MICROSOFT. Visual Studio Code.
                Disponível em:
                <a href="https://code.visualstudio.com/" target="_blank">
                    https://code.visualstudio.com/
                </a>.
                Acesso em: 5 set. 2026.
            </p>

            <p>
                W3C. Web Standards.
                Disponível em:
                <a href="https://www.w3.org/standards/" target="_blank">
                    https://www.w3.org/standards/
                </a>.
                Acesso em: 4 ago. 2026.
            </p>

            <p>
                W3C. Cascading Style Sheets (CSS).
                Disponível em:
                <a href="https://www.w3.org/Style/CSS/" target="_blank">
                    https://www.w3.org/Style/CSS/
                </a>.
                Acesso em: 7 out. 2026.
            </p>

            <p>
                W3C. HTML Standard.
                Disponível em:
                <a href="https://html.spec.whatwg.org/" target="_blank">
                    https://html.spec.whatwg.org/
                </a>.
                Acesso em: 21 out. 2026.
            </p>

        </div>

    </article>

</main>


<?php include 'includes_site/footer.php'; ?>

</body>
</html>
