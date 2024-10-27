<?php
session_start();

if (isset($_SESSION["oid"])) {
    header("location:infouser.php");
    exit();
    if ($_SESSION["oid"]) {
        header("location:infouser.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Registro Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top" class="d-flex flex-column min-vh-100">

    <!--INICIA NAV-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Registro de Usuarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-user"></i>&nbsp;Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--TERMINA NAV-->

    <!-- HEADER -->
    <header class="bg-success text-white py-5 mt-5">
        <div class="container text-center">
            <h1>¡Bienvenido!</h1>
            <p class="lead">Por favor llene los campos siguientes de manera correcta.</p>
        </div>
    </header>
    <!-- FIN HEADER -->

    <!-- FORMULARIO DE REGISTRO -->
    <section id="registro" class="flex-grow-1 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-4 border rounded bg-light">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo*</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono*</label>
                            <input type="text" name="phone-number" class="form-control" id="telefono">
                        </div>

                        <div class="mb-3">
                            <label for="rfc" class="form-label">RFC*</label>
                            <input type="text" name="rfc-mask" class="form-control" id="rfc">
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico* <small>(Podrás iniciar sesión con
                                    el correo)</small></label>
                            <input type="email" name="email-mask" class="form-control" id="correo">
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Contraseña*</label>
                            <div class="input-group">
                                <input id="pass"type="password" class="form-control password">
                                <button class="btn btn-outline-secondary verpass" type="button"><i
                                        class="icono fa fa-eye-slash"></i></button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Confirmar Contraseña*</label>
                            <div class="input-group">
                                <input id="passConfirm" type="password" class="form-control password">
                                <button class="btn btn-outline-secondary verpass" type="button"><i
                                        class="icono fa fa-eye-slash"></i></button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notas" class="form-label">Notas</label>
                            <textarea class="form-control" id="notas" placeholder="notas"></textarea>
                        </div>

                        <button id="registroUsuario" class="btn btn-success w-100">Registrarse</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN FORMULARIO DE REGISTRO -->

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container text-center">
            <p class="m-0">Prueba Técnica &copy;</p>
        </div>
    </footer>
    <!-- FIN FOOTER -->

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/jquery.js"></script>
    <script src="./js/jquery.mask.js"></script>
    <script src="./js/funcionesGlobales.js"></script>
    <script src="./js/registro.js"></script>
    <!-- FIN SCRIPTS -->

</body>

</html>