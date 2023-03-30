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
?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>PETROTHOR S.A.C</title>
    <!-- Favicon-->
    <link rel="icon" href="../public/images/logoPetrothor.png" type="image/x-icon">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.min.css">
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
    <link href="../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    


</head>

<body class="theme-indigo">
    <!-- Page Loader -->
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
                           
							<li class="active">
								<a href="javascript:void(0);">Mantenimiento</a>
							</li>
							<li>
								<a href="cliente_precio.php">Registro de precio</a>
							</li>
                            <li>
								<a href="envio_correspondiente.php">Envío de correspondencia</a>
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
                <h2 style="display:inline-block;">CLIENTES</h2>
                <button type="button" class="btn bg-green waves-effect right" style="display:inline-block;" data-toggle="modal" data-target="#nuevoCliente" onclick="abrir_cliente()">NUEVO CLIENTE</button>
			</div>
			<div class="card">
				<div class="body" id="contenido_tabla">
					
				</div>

			</div>

        </div>

        <div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" style="margin-top:30px;">
            <div class="modal-dialog modal-default" role="document">
                <div class="modal-content" id="agregarInstalacion">
                    <div class="card">
                        <div class="header">
                        <button type="button" class="btn btn-link btn-circle waves-effect waves-circle" style="position:absolute; right:10px; top:10px;" onclick="boton_cerrar()">
                        <i class="material-icons" style="font-size: 25px; position:absolute; right:0px; top:8px;" >close</i></button>
                            <h2>
                                Nuevo cliente
                                <small>Rellene todos los campos</small>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Datos</h2>
                            <div class="row clearfix">
 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Código</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="codigoSelect" placeholder="Introducir código" />
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Razon social</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="rsSelect" placeholder="Introducir Razon social" />
                                        </div>
                                    </div>
                                </div>
                           
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p>
                                        <b>Correo</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" id="correoSelect" placeholder="Introducir Correo" />
                                        </div>
                                    </div>
                                </div>
                                <div class="demo-checkbox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p>
                                        <b>Lista</b>
                                    </p>
                                    <div id="listcheckbox"> 

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn bg-green btn-block waves-effect" id="crearboton">CREAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" style="margin-top:30px;">
            <div class="modal-dialog modal-default" role="document">
                <div class="modal-content" id="cambiarInstalacion">
                    <div class="card">
                        <div class="header">
                        <button type="button" class="btn btn-link btn-circle waves-effect waves-circle" style="position:absolute; right:10px; top:10px;" onclick="ed_boton_cerrar()">
                        <i class="material-icons" style="font-size: 25px; position:absolute; right:0px; top:8px;" >close</i></button>
                            <h2>
                                Editar cliente
                                <small>Edite los campos</small>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Datos</h2>
                            <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Código</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="ed_codigoSelect" placeholder="Introducir código" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Razon social</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="ed_rsSelect" placeholder="Introducir Razon social" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p>
                                        <b>Correo</b>
                                    </p>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" id="ed_correoSelect" placeholder="Introducir Correo" />
                                        </div>
                                    </div>
                                </div>
                                <div class="demo-checkbox col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Lista</b>
                                    </p>
                                    <div id="ed_listcheckbox"> 

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn bg-green btn-block waves-effect" id="save_cambios_bt">GUARDAR CAMBIOS</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
	
	<style>
        
        #largeModal{
            overflow-y: hidden;
            overflow-x: hidden;

        }

        #largeModal .modal-body{
           height: calc(100vh - 200px);
           overflow: auto;
        }

        .table-responsive{
            overflow-y: hidden !important;
            overflow-x: hidden !important;
        }
        
		#instalaciones td{
			padding:8px 0px 5px 7px;
			
			font-size: 11px;
		}

		#instalaciones th{
			font-size:12px;
		}

		td.details-control {
		background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
		cursor: pointer;
		}
		tr.shown td.details-control {
		background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
		}
	</style>

    

    <!-- Jquery Core Js -->
    <script src="../public/plugins/jquery/jquery.min.js"></script>


    <script src="../public/js/myjs/cliente_mantenimiento.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../public/plugins/bootstrap/js/bootstrap.js"></script>



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
    <!-- LOGICA TABLA -->
   
    
   
    

</body>

</html>
