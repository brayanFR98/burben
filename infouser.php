<?php
session_start();

if (!isset($_SESSION["oid"])) {
    header("location:index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Info Usuarios</title>
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
            <a class="navbar-brand" href="#">Info de Usuarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" id="logout"><i class="fas fa-user"></i>&nbsp;Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--TERMINA NAV-->

    <!-- HEADER -->
    <header class="bg-success text-white py-5 mt-5">
        <div class="container text-center">
            <h1>¡Bienvenido! <?= $_SESSION["nombre"] ?></h1>
            <p class="lead">con correo <?= $_SESSION["email"] ?></p>
        </div>
    </header>
    <section class="flex flex-row justify-between">
        <div>
            <h1>Imprimir datos en PDF</h1>
            <button class="btn btn-info" id="imprimirpdf"><i class="text-white fa fa-print" aria-hidden="true"></i></button>
        </div>
        <div>
        <h1>Imprimir datos en Excel</h1>
        <button class="btn btn-success" id="imprimirexcel"><i class="text-white fa-solid fa-file-excel"></i></button>
        </div>

    </section>
    <!-- MODAL -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- FORMULARIO -->
                    <div class="p-4 border rounded bg-light">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="phone-number" class="form-control" id="telefono">
                        </div>

                        <div class="mb-3">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" name="rfc-mask" class="form-control" id="rfc">
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico <small>(Podrás iniciar sesión con
                                    el correo)</small></label>
                            <input type="email" name="email-mask" class="form-control" id="correo">
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input id="pass" type="password" class="form-control password">
                                <button class="btn btn-outline-secondary verpass" type="button"><i
                                        class="icono fa fa-eye-slash"></i></button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Confirmar Contraseña</label>
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


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cerrarModal" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button id="resgitroUsuario" class="btn btn-success">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla -->
    <section id="tabla">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">RFC</th>
                        <th scope="col">Notas</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablainfo">

                </tbody>
            </table>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container text-center">
            <p class="m-0">Prueba Técnica &copy;</p>
        </div>
    </footer>
    <!-- FIN FOOTER -->

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="./js/jquery.js"></script>
    <script src="./js/jquery.mask.js"></script>
    <script src="./js/funcionesGlobales.js"></script>
    <!-- <script src="./js/registro.js"></script> -->
    <script src="./js/infoUsuarios.js"></script>
    <script src="./js/login.js"></script>
    <!-- FIN SCRIPTS -->

</body>

</html>