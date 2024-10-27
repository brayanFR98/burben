$(document).ready(function () {
    tabla();
    var oidUser = 0;
    $('input[name="phone-number"]').mask('(000)-000-0000');
    $('input[name="rfc-mask"]').mask('AAAA000000AA0', {
        translation: {
            'A': { pattern: /[A-Za-z]/ },
            '0': { pattern: /[0-9]/ }
        }
    }).on('input', function () {
        this.value = this.value.toUpperCase();
    });

    var verifyEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    function tabla() {

        $("#tablainfo").load("./php/ajaxInfoUsuarios/selectUsuarios.php", {
        }, function (response, status, request) {
            this; // dom element  
        });

    }
    // FUNCION LIMPIAR INPUTS
    function limpiar() {
        $("#nombre").val('');
        $("#telefono").val('');
        $('#rfc').val('');
        $("#correo").val('');
        $("#pass").val('');
        $("#passConfirm").val('');
        $("#notas").val('');
        oidUser = 0;
        $("#resgitroUsuario").html("registrar");
    }
    // LLENAR INPUTS CON DATOS DEL USUARIO
    $(document).on("click", ".editar", function () {
        let oidUser2 = $(this).data("id");
        $.post("./php/ajaxInfoUsuarios/infoUsuarios.php", {
            oid: oidUser2
        }).done(function (data) {
            let info = JSON.parse(data);
            $("#nombre").val(info["name"]);
            $("#telefono").val(info["telephone"]);
            $("#rfc").val(info["rfc"]);
            $("#correo").val(info["email"]);
            $("#notas").val(info["notes"]);
            oidUser = info["oid"];
            $("#resgitroUsuario").html("Actualizar");

        });
        alertas('Ya puedes editar el usuario.', 'info');
    });

    // BORRAR USUARIO
    $(document).on("click", ".borrar", function () {
        let oidUser2 = $(this).data("id");
        $.post("./php/ajaxInfoUsuarios/deleteUsuarios.php", {
            oid: oidUser2
        }).done(function (data) {
            if (data == 1) {
                alertas('Usuario eliminado', 'success');
                tabla();
            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al eliminar usuario...',
                    text: data,
                    footer: '<p class="text-red-500">Por favor comunicate con soporte.</p>'
                });
            }
        });
    });
    //EDITAR USUARIO
    $("#resgitroUsuario").click(function (e) {
        let nombre = $('#nombre').val();
        let telefono = $('#telefono').val();
        let rfc = $('#rfc').val();
        let correo = $('#correo').val();
        let pass = $('#pass').val();
        let passConfirm = $('#passConfirm').val();
        let notas = $('#notas').val();

        if (pass != passConfirm) {
            alertas('Las contraseñas no coinciden', 'warning');
        }
        else if (!verifyEmail.test(correo)) {
            alertas('Correo invalido.', 'warning');
        }
        else if (nombre == '' || telefono == '' || rfc == '' || correo == '') {
            alertas('Favor de llenar todos los campos obligatorios', 'info');
        }
        else {
            if (oidUser != 0) {
                $.post('./php/ajaxInfoUsuarios/updateUsuarios.php', {
                    nombre: nombre,
                    telefono: telefono,
                    rfc: rfc,
                    correo: correo,
                    pass: pass,
                    notas: notas,
                    oidUser: oidUser,

                }).done(function (data) {
                    if (data == 1) {
                        alertas('Actualización exitosa!', 'success');
                        limpiar();
                        $('#cerrarModal').trigger('click');
                        tabla();

                    }
                    else if (data == 2) {
                        alertas('El nombre es demasiado corto.', 'warning');
                    }
                    else if (data == 3) {
                        alertas('El nombre es demasiado largo, maximo 100 caracteres.', 'warning');
                    }
                    else if (data == 4) {
                        alertas('El teléfono es demasiado corto, debe ser 10 digitos.', 'warning');
                    }
                    else if (data == 5) {
                        alertas('El teléfono es demasiado largo, maximo 10 digitos.', 'warning');
                    }
                    else if (data == 12) {
                        alertas('El RFC es demasiado corto, debe ser 13 caracteres.', 'warning');
                    }
                    else if (data == 13) {
                        alertas('El RFC es demasiado largo, maximo 13 caracteres.', 'warning');
                    }
                    else if (data == 6) {
                        alertas('El coreo es demasiado corto.', 'warning');
                    }
                    else if (data == 7) {
                        alertas('El correo es demasiado largo, maximo 100 caracteres.', 'warning');
                    }
                    else if (data == 8) {
                        alertas('La contraseña es demasiado corta, minimo 8 caracteres.', 'warning');
                    }
                    else if (data == 9) {
                        alertas('La contraseña es demasiado larga, maximo 30 caracteres.', 'warning');
                    }
                    else if (data == 10) {
                        alertas('Nota es demasiado larga, maximo 500 caracteres.', 'warning');
                    }
                    else if (data == 11) {
                        alertas('Teléfono vinculado a otro usuario.', 'warning');
                    }
                    else if (data == 14) {
                        alertas('Correo vinculado a otro usuario.', 'warning');
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al actualizar usuario...',
                            text: data,
                            footer: '<p class="text-red-500">Por favor comunicate con soporte.</p>'
                        });
                    }
                });
            }
        }
        e.preventDefault();
    });

    // IMPRIMIR PDF
    $("#imprimirpdf").click(function (e) { 
        window.open('./reports/usuariosPDF.php', '_blank');
        
        e.preventDefault();
    });

    // IMPRIMIR EXCEL
    $('#imprimirexcel').on('click', function() {
        $.ajax({
            url: './reports/usuariosJSON.php', // Ruta al archivo PHP que genera JSON
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Configuración para SheetJS
                const ws = XLSX.utils.json_to_sheet(data);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Usuarios');

                // Genera y descarga el archivo Excel
                XLSX.writeFile(wb, 'Lista_Usuarios.xlsx');
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener los datos: ", error);
            }
        });
    });
    
});