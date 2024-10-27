$(document).ready(function () {
    // ENTRAR CON ENTER A SESION
    $(document).keypress(function (event) {
        if (event.keyCode === 13) {
            $('#loginBtn').click();
            event.preventDefault();
        }
    });
    $("#loginBtn").click(function (e) {
        e.preventDefault();
    });

    ///////////////// INICIAR SESION/////////////////////////
	$("#loginBtn").click(function (e) { 
        let email=$("#email").val();
        let pass=$("#password").val();
        if(email=="" || pass=="")
        {
           alertas('Favor de llenar ambos datos', 'warning')
        }
        else
        {
            $.post("./php/ajaxLogin/ajaxLogin.php",
            {
                email:email,
                pass:pass
            }).done(function(data) 
            {
                // alert(data);
                if(data==1)
                {
                    alertas('Bienvenido!', 'success');
                    window.location.replace("infouser.php");
                }
                else
                {
                    alertas('Datos invalidos', 'error');
                }
            });
        }
        e.preventDefault();
    });

    // CERRAR SESION
    $("#logout").click(function (e) { 
        window.location.replace("./php/ajaxLogin/logout.php");
        e.preventDefault();
    });
    $(document).on("click","#logout", function () {
        window.location.replace("./php/ajaxLogin/logout.php");
    });


});