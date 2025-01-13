<!-- views/template.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Painel Administrativo' ?></title>
    <link rel="stylesheet" href="/public/assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/painel_style.css">
    <link rel="stylesheet" href="/public/assets/css/loading.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="/public/assets/js/bootstrap/bootstrap.bundle.min.js" defer></script>
    <script src="/public/assets/js/jquery-3.7.1.min.js" defer></script>
    <script src="/public/assets/js/painel_funcoes.js" defer></script>
    <style>
        /* Estilo personalizado para ocultar a barra lateral em telas menores */
        @media (max-width: 768px) {
            .main-sidebar {
                position: absolute;
                left: -250px;
                width: 250px;
                transition: left 0.3s ease-in-out;
                z-index: 1050;
            }

            .main-sidebar.show {
                left: 0;
            }

            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="wrapper d-flex flex-grow-1">

        <button id="menu-toggle" class="btn btn-dark d-md-none position-absolute" style="top: 10px; left: 10px; z-index: 1100;">
            <i class="fas fa-bars"></i>
        </button>

        <aside class="main-sidebar bg-dark text-white vh-100 p-1 d-flex flex-column">
            <a href="#" id="title-painel" class="brand-link text-center mb-4 mt-4">
                <span class="">Painel Admin</span>
            </a>
            <nav>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/painel/home"
                            class="nav-link <?php echo ($activePage === 'home' || $activePage === 'cliente') ? 'active rounded bg-primary' : '' ?>">
                            <i class="nav-icon fas fa-users me-2"></i>
                            Clientes
                        </a>
                    </li>

                    <li class="nav-item mt-1">
                        <a href="/painel/login/logout"
                            class="nav-link active rounded bg-danger">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            Sair
                        </a>
                    </li>

                </ul>
            </nav>
        </aside>

        <div class="content-wrapper flex-grow-1 bg-light d-flex flex-column">
            <div class="content p-4">
                <div class="container-fluid" id="page-content">
                    <?= $content ?>
                </div>
            </div>

            <footer class="bg-white py-3 mt-auto">
                <div class="container">
                    <span>&copy; <?= date('Y') ?> Painel Admin. Todos os direitos reservados.</span>
                </div>
            </footer>
        </div>
    </div>

    <div id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

</body>

<script>
    /* menu responsivo */
    document.querySelector('#menu-toggle').addEventListener('click', function() {
        const sidebar = document.querySelector('.main-sidebar');
        sidebar.classList.toggle('show');
    });
</script>

</html>