<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="../../public/assets/css/loading.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="../../public/assets/js/bootstrap/bootstrap.min.js" defer></script>
    <script src="../../public/assets/js/jquery-3.7.1.min.js" defer></script>
    <script src="../../public/assets/js/funcoes.js" defer></script>
</head>

<body id="body-login">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div id="content-login" class="col-12 col-md-6 col-lg-4 mx-auto w-75 p-2 d-flex justify-content-center align-items-center shadow-lg rounded">
                <div class="col-12 col-md-12 col-lg-6 border-0">
                    <img src="../../public/assets/logo.png" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-12 col-lg-6 card border-0">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Login</h5>
                        <div id="alertLogin" class="alert alert-danger d-none" role="alert">
                            
                        </div>
                        <form id="formLogin" method="POST">
                            <div class="mb-1">
                                <label for="email" class="form-label">Usuário</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Senha</label>
                                <div class="d-flex justify-content-end align-items-center position-relative">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                                    <i id="show-password" class="fa fa-eye position-absolute" aria-hidden="true"></i>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

</body>

</html>