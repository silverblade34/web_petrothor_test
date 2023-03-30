<?php

if(!isset($_SESSION)) 
{ 
    session_start();
}
if (isset($_SESSION['contenido'])=="existe") {
    header("Location: index.php");
    exit;
    
}else{
    session_destroy();

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>PETROTHOR S.A.C</title>
        <!-- Favicon-->
        <link rel="icon" href="../public/images/logoPetrothor.png" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="../public/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="../public/plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="../public/plugins/animate-css/animate.css" rel="stylesheet" />

<!-- Custom Css -->
<link href="../public/css/style.css" rel="stylesheet">

    <!--Sweetalert2-->
    <link href="../public/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">


<!-- JQuery DataTable Css -->
<link href="../public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="../public/css/themes/all-themes.css" rel="stylesheet" />

<!-- Light Gallery Plugin Css -->
<link href="../public/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

 <!-- Dropzone Css -->
 <link href="../public/plugins/dropzone/dropzone.css" rel="stylesheet">

 <!-- Multi Select Css -->
<link href="../public/plugins/multi-select/css/multi-select.css" rel="stylesheet">

<!-- Bootstrap Spinner Css -->
<link href="../public/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

<!-- Bootstrap Tagsinput Css -->
<link href="../public/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

<!-- Bootstrap Select Css -->
<link href="../public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<!-- noUISlider Css -->
<link href="../public/plugins/nouislider/nouislider.min.css" rel="stylesheet" />

 <!-- Bootstrap Material Datetime Picker Css -->
 <link href="../public/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

<!-- Bootstrap DatePicker Css -->
<link href="../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />




</head>

<body class="login-page" style="background-color:white;">
    <!-- Page Loader -->
    <div class="login-box align-center">
    <div class="logo align-center">
        <img src="../public/images/petrothor1.png" width="350px">

    </div>
    <div class="card">
        <div class="body">
            <!--<form id="sign_in" method="post" novalidate="novalidate" _lpchecked="1">-->
                <div class="msg">Registrse para iniciar sesión</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                
                    <div class="form-line">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required autofocus aria-required="true" autocomplete="off">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Clave" required aria-required="true" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-block bg-indigo waves-effect" type="button" onclick="login()">INGRESAR</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-8 align-right">
                            <h6>PETROTHOR 2021</h6>
                        </div>
                    </div>

            <!--</form>-->

        </div>
    </div>
    
    </div>









    <!-- Jquery Core Js -->
    <script src="../public/plugins/jquery/jquery.min.js"></script>


    <script src="../public/js/myjs/login.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../public/plugins/bootstrap/js/bootstrap.js"></script>



    <!-- Slimscroll Plugin Js -->
    <script src="../public/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../public/plugins/node-waves/waves.js"></script>
    
    
    <!-- Light Gallery Plugin Js -->
    <script src="../public/plugins/light-gallery/js/lightgallery-all.js"></script>

     <!-- SweetAlert -->
     <script src="../public/plugins/sweetalert2/sweetalert2.all.min.js"></script>



    <!-- Input Mask Plugin Js -->
    <script src="../public/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="../public/plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="../public/plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="../public/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="../public/plugins/nouislider/nouislider.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../public/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../public/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../public/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="../public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


    <!-- Custom Js -->
    <script src="../public/js/pages/medias/image-gallery.js"></script>
    <script src="../public/js/pages/ui/tooltips-popovers.js"></script>


    
    <script>
        $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm:00',
        clearButton: true,
        weekStart: 1
    });
       
    </script>
    <script src="../public/js/admin.js"></script>


    <!-- Demo Js -->
	<script src="../public/js/demo.js"></script>
	
    <!-- Jquery DataTable Plugin Js -->
    <script src="../public/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../public/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../public/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../public/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../public/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../public/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../public/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../public/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../public/js/pages/tables/jquery-datatable.js"></script>



    <!-- LOGICA TABLA -->
   
    
   
</body>

</html>
