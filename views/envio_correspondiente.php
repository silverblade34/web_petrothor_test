<?php

if(!isset($_SESSION)) 
{ 
    session_start();
}
if (isset($_SESSION['contenido'])=="existe") {
    
}else{
    session_destroy();
    header("Location: login.php");
    exit;
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
    <link href="../public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../public/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../public/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../public/css/style.css" rel="stylesheet">

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

    <!--Sweetalert2-->
    <link href="../public/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <!-- noUISlider Css -->
    <link href="../public/plugins/nouislider/nouislider.min.css" rel="stylesheet" />

     <!-- Bootstrap Material Datetime Picker Css -->
     <link href="../public/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link rel="stylesheet" href="../public/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css">
    <link href="../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />  
    <link href="../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />  

</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper" style="display: none;background:none;z-index:999;" id="loader-process">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Enviando correo...</p>
        </div>
    </div>
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="javascript:void(0);">GTS v1.0.0</a>
            </div>
            
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVEGACION PRINCIPAL</li>
                    
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Cliente</span>
                        </a>
                        <ul class="ml-menu">
                           
							<li>
								<a href="index.php">Mantenimiento</a>
							</li>
							<li>
								<a href="cliente_precio.php">Registro de precio</a>
							</li>
                            <li class="active">
								<a href="javascript:void(0);">Envío de correspondencia</a>
							</li>
                            <li>
								<a href="reg_precios_masivo.php">Registro de precios masivo</a>
							</li>
                                
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Proveedor</span>
                        </a>
                        <ul class="ml-menu">
                           
							<li>
								<a href="proveedor_mantenimiento.php">Mantenimiento</a>
							</li>
							<li>
								<a href="proveedor_precio.php">Registro de precio</a>
							</li>
                                
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Producto</span>
                        </a>
                        <ul class="ml-menu">
                           
							<li>
								<a href="producto_mantenimiento.php">Mantenimiento</a>
							</li>
                                
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Lista precios</span>
                        </a>
                        <ul class="ml-menu">
                           
							<li>
								<a href="listaprecio_mantenimiento.php">Mantenimiento</a>
							</li>
                                
                        </ul>
                    </li>
                    
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
            <button type="button" class="btn bg-red col-white btn-block waves-effect" id="cerrarSesion">CERRAR SESION</button>
                </br>
                </br>
                </br>
                </br>
                <div class="copyright">
                    &copy; 2021 <a href="javascript:void(0);">PETROTHOR</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2 style="display:inline-block;">ENVIO CORRESPONDIENTE PARA CLIENTES</h2>
                <button onclick="inipdf()" class="btn bg-green waves-effect right" style="display:inline-block;">ENVIAR</button>
            </div>
            <div class="card">
            <div class="body" style="position:relative; top:10px">
                <div>
                                    
                    <p>
                        <b>Clientes:</b>
                    </p>
                </div>
                <div id="listaClientes">
                
                </div>

        
                <div id="contenidoPDF">
                </div>

            </div>

        </div>

 



    </section>



    <!-- Jquery Core Js -->
    <script src="../public/plugins/jquery/jquery.min.js"></script>
        <!--js PDF-->
    <!--<script src="../public/plugins/jsPDF/jsPDF.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    

    <script src="../public/js/myjs/envio_correspondiente.js"></script>
    <!-- Bootstrap Core Js -->
    
    <script src="../public/plugins/bootstrap/js/bootstrap.js"></script>
    <!--Ejecutar js PDF-->
    <script src="../public/js/myjs/PDF.js"></script>
   


    <!-- Slimscroll Plugin Js -->
    <script src="../public/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../public/plugins/node-waves/waves.js"></script>
    
    
    <!-- Light Gallery Plugin Js -->
    <script src="../public/plugins/light-gallery/js/lightgallery-all.js"></script>



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
    <!--script src="../public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="../public/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>-->
    <!--NUEVA FECHAAA ACTUALIZADA-->
    <script src="../public/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Custom Js -->
    <script src="../public/js/pages/medias/image-gallery.js"></script>
    <script src="../public/js/pages/ui/tooltips-popovers.js"></script>


    
    <script type="text/javascript">

            $(function() {
                $('.datetimepicker').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm:00'
                });

            });

    </script>
     <!-- SweetAlert -->
     <script src="../public/plugins/sweetalert2/sweetalert2.all.min.js"></script>

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

    <script src="../public/js/myjs/cerrar_sesion.js"></script>


    
</body>

</html>
