$(function() {

    document.getElementById("cerrarSesion").addEventListener("click", function() {

        $.ajax({
            type: 'post',
            url: '../controllers/login/cerrar_sesion.php',
            data: null,
            success: function(data) {

                window.location.replace("./login.php");

            }
        });

    });

}); 