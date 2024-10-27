$(document).ready(function () {
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

    // FUNCION LIMPIAR INPUTS
    function limpiar() {
        $("#nombre").val('');
        $("#telefono").val('');
        $('#rfc').val('');
        $("#correo").val('');
        $("#pass").val('');
        $("#passConfirm").val('');
        $("#notas").val('');
    }

    $('#registroUsuario').click(function (e) {
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
        else if (nombre == '' || telefono == '' || rfc == '' || correo == '' || pass == '' || passConfirm == '') {
            alertas('Favor de llenar todos los campos obligatorios', 'info');
        }
        else {
            $.post('./php/ajaxRegistro/altaUsuarios.php', {
                nombre: nombre,
                telefono: telefono,
                rfc: rfc,
                correo: correo,
                pass: pass,
                notas: notas

            }).done(function (data) {
                if (data == 1) {
                    alertas('Registro exitoso!', 'success');
                    limpiar();
                    window.location.replace("index.php");

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
                        title: 'Error al guardar usuario...',
                        text: data,
                        footer: '<p class="text-red-500">Por favor comunicate con soporte.</p>'
                    });
                }
            });
        }

        e.preventDefault();
    });

});