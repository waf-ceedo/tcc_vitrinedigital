
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include 'includes_site/head.php'; ?>

    <title>Sobre - Vitrine Digital</title>

    <style>

        body {
            background-color: #ffffff;
        }

        /* APRESENTAÇÃO */

        .sobre-intro {
            background: linear-gradient(120deg, #eef3fc, #e4edfa);
            padding: 75px 0 70px;
        }

        .sobre-etiqueta {
            color: #1769e0;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .sobre-titulo {
            color: #173B70;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .sobre-intro p {
            color: #596579;
            font-size: 1.08rem;
            line-height: 1.8;
            max-width: 750px;
            margin-bottom: 0;
        }


        /* CONTEÚDO PRINCIPAL */

        .sobre-principal {
            padding: 85px 0;
            background-color: #ffffff;
        }

        .sobre-imagem {
            width: 100%;
            height: 480px;
            object-fit: cover;
            border-radius: 22px;
            box-shadow: 0 15px 40px rgba(23, 59, 112, 0.12);
        }

        .sobre-subtitulo {
            color: #173B70;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 25px;
        }

        .sobre-texto p {
            color: #596579;
            font-size: 1.02rem;
            line-height: 1.85;
            margin-bottom: 18px;
        }

        .sobre-lista {
            margin-top: 20px;
        }

        .sobre-item {
            display: flex;
            align-items: center;
            gap: 13px;
            background-color: #eef3fc;
            color: #294d7d;
            padding: 14px 17px;
            border-radius: 12px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .sobre-item i {
            color: #1769e0;
            font-size: 1rem;
        }


        /* COMO FUNCIONA */

        .sobre-funciona {
            background-color: #f4f7fc;
            padding: 75px 0;
        }

        .sobre-funciona h2 {
            color: #173B70;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .sobre-funciona p {
            color: #596579;
            font-size: 1.05rem;
            line-height: 1.8;
            margin-bottom: 15px;
        }


        /* OBJETIVO */

        .sobre-objetivo {
            padding: 75px 0 85px;
            background-color: #ffffff;
        }

        .sobre-objetivo h2 {
            color: #173B70;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .sobre-objetivo p {
            color: #596579;
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .sobre-final {
            color: #1769e0 !important;
            font-size: 1.3rem !important;
            font-weight: 700;
            margin-top: 25px;
        }


        /* BOTÃO */

        .sobre-botao {
            background-color: #173B70;
            border: none;
            color: #ffffff;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .sobre-botao:hover {
            background-color: #1769e0;
            color: #ffffff;
            transform: translateY(-2px);
        }


        /* RESPONSIVIDADE */

        @media (max-width: 991px) {

            .sobre-imagem {
                height: 380px;
                margin-bottom: 35px;
            }

            .sobre-principal {
                padding: 60px 0;
            }

        }

        @media (max-width: 768px) {

            .sobre-intro {
                padding: 50px 0;
            }

            .sobre-titulo {
                font-size: 2.6rem;
            }

            .sobre-subtitulo {
                font-size: 2rem;
            }

            .sobre-imagem {
                height: 300px;
            }

            .sobre-funciona h2,
            .sobre-objetivo h2 {
                font-size: 2rem;
            }

        }

    </style>

</head>

<body>

<?php include 'includes_site/header.php'; ?>


<!-- APRESENTAÇÃO -->

<section class="sobre-intro">

    <div class="container">

        <div class="row">

            <div class="col-lg-10">

                <div class="sobre-etiqueta">
                    Sobre a Vitrine Digital
                </div>

                <h1 class="sobre-titulo">
                    Quem Somos
                </h1>

                <p>
                    Conheça nossa proposta, como funciona a plataforma e por que
                    ela foi criada para aproximar pessoas, valorizar negócios
                    locais e dar visibilidade ao comércio da nossa região.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- NOSSA PROPOSTA -->

<section class="sobre-principal">

    <div class="container">

        <div class="row align-items-center g-lg-5">

            <!-- IMAGEM -->

            <div class="col-lg-6">

                <img
                    src="img/loja1.jpg"
                    alt="Imagem representando o comércio local"
                    class="sobre-imagem">

            </div>


            <!-- TEXTO -->

            <div class="col-lg-6">

                <div class="sobre-texto">

                    <h2 class="sobre-subtitulo">
                        Conectando negócios e pessoas.
                    </h2>

                    <p>
                        Já parou para pensar em quantas lojas incríveis existem
                        por aí e que, às vezes, a gente nem conhece?
                    </p>

                    <p>
                        A Vitrine Digital nasceu com uma ideia simples: reunir
                        esses negócios em um só lugar, tornando mais fácil
                        descobrir lojas, conhecer produtos e encontrar aquele
                        comércio que tem exatamente o que você procura.
                    </p>

                    <p>
                        Cada loja tem sua história, seus produtos e seu jeito
                        próprio de conquistar clientes. Queremos oferecer um
                        espaço para que empreendedores possam apresentar seus
                        negócios e alcançar novas pessoas.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- COMO FUNCIONA -->

<section class="sobre-funciona">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <h2>
                    E como tudo funciona?
                </h2>

                <p>
                    É bem simples! Você pode explorar as categorias, pesquisar
                    lojas, conhecer seus produtos e encontrar informações para
                    entrar em contato diretamente com os estabelecimentos.
                </p>

                <p>
                    Se você tem um negócio, também pode cadastrar sua loja,
                    adicionar seus produtos e organizar sua própria vitrine
                    dentro da plataforma.
                </p>

                <p class="mb-0">
                    Assim, quem visita o site encontra diferentes opções em um
                    só lugar, enquanto os lojistas ganham mais um espaço para
                    apresentar aquilo que fazem.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- NOSSO OBJETIVO -->

<section class="sobre-objetivo">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <h2>
                    Afinal, por que a Vitrine Digital?
                </h2>

                <p>
                    Porque acreditamos que descobrir novos lugares, apoiar
                    negócios da região e encontrar boas oportunidades pode ser
                    muito mais fácil quando tudo está pertinho.
                </p>

                <p>
                    A Vitrine Digital busca aproximar pessoas e empreendedores,
                    incentivando a descoberta de novos negócios e valorizando
                    aquilo que a nossa própria região tem a oferecer.
                </p>

                <p class="sobre-final">
                    Explore, descubra e valorize o comércio da sua cidade.
                </p>

                <p>
                    O próximo lugar incrível que você vai conhecer pode estar aqui!
                </p>


                <!-- BOTÃO -->

                <div class="text-center mt-5">

                    <a
                        href="index.php#resultados-lojas"
                        class="btn sobre-botao rounded-3 px-5 py-3">

                        <i class="fa-solid fa-store me-2"></i>

                        Conhecer as lojas

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<?php include 'includes_site/footer.php'; ?>

</body>

</html>
