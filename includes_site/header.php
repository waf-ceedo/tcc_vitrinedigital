
<?php

// IDENTIFICAR SE O USUÁRIO ESTÁ NA ÁREA ADMINISTRATIVA

$esta_na_area_admin = (
    strpos($_SERVER['PHP_SELF'], '/admin/') !== false
);


// DEFINIR DESTINO DA LOGO

if ($esta_na_area_admin) {

    $link_logo = '/tcc/admin/dashboard.php';

} else {

    $link_logo = '/tcc/index.php';

}


// IDENTIFICAR O DESTINO DA OPÇÃO INÍCIO

$inicio_no_admin = (
    strpos($_SERVER['PHP_SELF'], '/admin/') !== false ||
    (
        isset($_GET['origem']) &&
        $_GET['origem'] === 'admin'
    )
);


// DEFINIR DESTINO DO INÍCIO

if ($inicio_no_admin) {

    $link_inicio = '/tcc/admin/dashboard.php';

} else {

    $link_inicio = '/tcc/index.php';

}

?>

<style>

/* CABEÇALHO */

.site-header {
    background-color: #101722 !important;
    padding: 10px 0;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
}


/* LOGO */

.site-header .navbar-brand {
    color: #FFFFFF !important;
    font-size: 1.5rem;
    font-weight: 700;
    transition: color 0.2s ease;
}

.site-header .navbar-brand i {
    color: #FFFFFF;
}

.site-header .navbar-brand:hover {
    color: #1769E0 !important;
}


/* LINKS DO MENU */

.site-header .nav-link {
    color: #D5DCE7 !important;
    font-weight: 500;
    padding: 10px 14px !important;
    transition: color 0.2s ease;
}

.site-header .nav-link i {
    color: #AEB9C9;
    transition: color 0.2s ease;
}

.site-header .nav-link:hover {
    color: #FFFFFF !important;
}

.site-header .nav-link:hover i {
    color: #1769E0;
}


/* BOTÃO DO MENU MOBILE */

.site-header .navbar-toggler {
    border-color: rgba(255, 255, 255, 0.3);
}

.site-header .navbar-toggler:focus {
    box-shadow: 0 0 0 3px rgba(23, 105, 224, 0.25);
}


/* RESPONSIVIDADE */

@media (max-width: 991px) {

    .site-header .navbar-collapse {
        padding-top: 15px;
    }

    .site-header .nav-link {
        padding: 12px 5px !important;
    }

}

</style>


<nav class="navbar navbar-expand-lg navbar-dark site-header">

    <div class="container">

        <!-- LOGO / NOME -->

        <a
            class="navbar-brand fw-bold d-flex align-items-center"
            href="<?php echo $link_logo; ?>">

            <i class="fa-solid fa-store me-2"></i>

            Vitrine Digital

        </a>


        <!-- BOTÃO MOBILE -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu"
            aria-controls="menu"
            aria-expanded="false"
            aria-label="Abrir menu">

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- MENU -->

        <div
            class="collapse navbar-collapse"
            id="menu">

            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">


                <!-- INÍCIO -->

                <li class="nav-item">

                    <a
                        class="nav-link px-3"
                        href="<?php echo $link_inicio; ?>">

                        <i class="fa-solid fa-house me-1"></i>

                        Início

                    </a>

                </li>


                <!-- SOBRE -->

                <li class="nav-item">

                    <a
                        class="nav-link px-3"
                        href="<?php echo $inicio_no_admin ? '/tcc/sobre.php?origem=admin' : '/tcc/sobre.php'; ?>">

                        <i class="fa-solid fa-circle-info me-1"></i>

                        Sobre

                    </a>

                </li>


                <!-- ADMIN -->

                <li class="nav-item">

                    <a
                        class="nav-link px-3"
                        href="/tcc/login.php">

                        <i class="fa-solid fa-right-to-bracket me-1"></i>

                        Admin

                    </a>

                </li>


                <!-- CADASTRAR -->

            </ul>

        </div>

    </div>

</nav>
