
<?php

// ================================================
// IDENTIFICAR SE O USUÁRIO ESTÁ NA ÁREA ADMINISTRATIVA
// ================================================

$esta_na_area_admin = (
    strpos($_SERVER['PHP_SELF'], '/admin/') !== false
);


// ================================================
// IDENTIFICAR O CAMINHO BASE DO PROJETO
// ================================================

$caminho_script = $_SERVER['SCRIPT_NAME'];

if ($esta_na_area_admin) {
    $base_projeto = dirname(dirname($caminho_script));
} else {
    $base_projeto = dirname($caminho_script);
}

$base_projeto = rtrim($base_projeto, '/\\');

if ($base_projeto === '.' || $base_projeto === '/') {
    $base_projeto = '';
}


// ================================================
// FUNÇÃO PARA MONTAR OS LINKS
// ================================================

$montar_link = function ($caminho) use ($base_projeto) {
    return $base_projeto . '/' . ltrim($caminho, '/');
};


// ================================================
// IDENTIFICAR A ORIGEM DA NAVEGAÇÃO
// ================================================

$inicio_no_admin = (
    $esta_na_area_admin ||
    (
        isset($_GET['origem']) &&
        $_GET['origem'] === 'admin'
    )
);


// ================================================
// DEFINIR DESTINO DA LOGO
// ================================================

if ($esta_na_area_admin) {
    $link_logo = $montar_link('admin/dashboard.php');
} else {
    $link_logo = $montar_link('index.php');
}


// ================================================
// DEFINIR DESTINO DO INÍCIO
// ================================================

if ($inicio_no_admin) {
    $link_inicio = $montar_link('admin/dashboard.php');
} else {
    $link_inicio = $montar_link('index.php');
}


// ================================================
// DEFINIR LINK DO CONTEÚDO TEÓRICO
// ================================================

$link_teorico = $montar_link('conteudo-teorico.php');

if ($inicio_no_admin) {
    $link_teorico .= '?origem=admin';
}

?>

<style>
.site-header .navbar {
    background-color: #101722 !important;
}

.site-header .nav-link {
    color: #ffffff !important;
    font-weight: 500;
    font-size: 15px;
    padding: 9px 12px !important;
    transition: color 0.25s ease;
}

.site-header .nav-link:hover {
    color: #3985ff !important;
}

.site-header .nav-link i {
    margin-right: 5px;
}

.site-header .navbar-brand {
    color: #ffffff !important;
    font-size: 22px;
}

.site-header .navbar-brand i {
    color: #3985ff;
}
</style>


<header class="site-header">

    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand fw-bold"
               href="<?php echo htmlspecialchars($link_logo, ENT_QUOTES, 'UTF-8'); ?>">

                <i class="fa-solid fa-store me-2"></i>
                Vitrine Digital

            </a>


            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSite"
                aria-controls="navbarSite"
                aria-expanded="false"
                aria-label="Alternar navegação">

                <span class="navbar-toggler-icon"></span>

            </button>


            <div class="collapse navbar-collapse" id="navbarSite">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo htmlspecialchars($link_inicio, ENT_QUOTES, 'UTF-8'); ?>">
                            <i class="fa-solid fa-house"></i>
                            Início
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php
                           echo htmlspecialchars(
                               $montar_link('sobre.php') .
                               ($inicio_no_admin ? '?origem=admin' : ''),
                               ENT_QUOTES,
                               'UTF-8'
                           );
                           ?>">
                            <i class="fa-solid fa-circle-info"></i>
                            Sobre
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo htmlspecialchars($link_teorico, ENT_QUOTES, 'UTF-8'); ?>">
                            <i class="fa-solid fa-book-open"></i>
                            TCC
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo htmlspecialchars($montar_link('login.php'), ENT_QUOTES, 'UTF-8'); ?>">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Admin
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>

</header>
