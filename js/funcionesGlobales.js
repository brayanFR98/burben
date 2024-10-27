 // FUNCION DE ALERTAS
 function alertas(mensaje, type) {
    Swal.fire({
        title: mensaje,
        icon: type,
        timer: 4000,
        timerProgressBar: true,
        toast: true,
        position: 'top-start',
        showConfirmButton: false,
        showCloseButton: true,
    });
}
// VER CONTRASEÑA
$(".verpass").click(function (e) {
    e.preventDefault();
    
    // Seleccionar el campo de contraseña relacionado
    const passwordField = $(this).siblings(".password");
    const icon = $(this).find(".icono");
    
    // Alternar entre "text" y "password" y cambiar el icono
    const isPasswordVisible = passwordField.attr("type") === "text";
    passwordField.attr("type", isPasswordVisible ? "password" : "text");
    icon.toggleClass("fa-eye fa-eye-slash");
});