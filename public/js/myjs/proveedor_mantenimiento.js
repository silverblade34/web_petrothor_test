

function save_editProveedor(idreq){
    var ruc = document.getElementById('ed_rucSelect').value;
    var rs = document.getElementById('ed_rsSelect').value;
    var id = idreq;
    $.ajax({
        type: 'post',
        url: '../controllers/proveedormantenimiento/editar_proveedor.php',
        data: { ruc: ruc, rs: rs, id: id },
        success: function(data) {
            const result = parseInt(data);
            
            if (result == 1) {
                $('#editarProveedor').modal('toggle');

                var listclear = ["ed_rucSelect","ed_rsSelect"];
                for (var i = 0; i < listclear.length; i++) {
                    document.getElementById(listclear[i]).value = ''
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Se editó en el registro satisfactoriamente'
                  })
                pintarTabla();

            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Error al editar'
                  })
            }
        }
    });

}


function ed_boton_cerrar(){
    $('#editarProveedor').modal('toggle');

    var listclear = ["ed_rucSelect","ed_rsSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = ''
    }
}

function editarProveedor(id){
    var id = id;
    $.ajax({
        type: 'post',
        url: '../controllers/proveedormantenimiento/obtener_proveedor.php',
        data: { id:id },
        success: function(data){
            var result= JSON.parse(data);
            var datos=result[0];
            console.log(datos);
            const idreq = datos['id'];
            const ruc = datos['ruc'];
            const rs = datos['razonsocial'];
            //Setear valores del id seleccionado
            document.getElementById('ed_rucSelect').value = ruc;
            document.getElementById('ed_rsSelect').value = rs;

            document.getElementById("save_cambios_bt").onclick = function() { save_editProveedor(idreq); }
            $('#editarProveedor').modal('toggle');
        }
    });
}

function nuevo_obtener_datos(){
    var listclear = ["rucSelect","rsSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = '';
    }
}

function crearProveedor() {
    var ruc = document.getElementById("rucSelect").value;
    var rs = document.getElementById('rsSelect').value;

    if (ruc != '' && rs != '') {
        $.ajax({
            type: 'post',
            url: '../controllers/proveedormantenimiento/crear_proveedor.php',
            data: { ruc: ruc, rs: rs },
            success: function(data) {
                var result = JSON.parse(data);
    
                if (result == true) {
                    $('#nuevoProveedor').modal('toggle');
    
                    var listclear = ["rucSelect","rsSelect"];
                    for (var i = 0; i < listclear.length; i++) {
                        document.getElementById(listclear[i]).value = '';
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Se agregó al registro satisfactoriamente'
                      })
                    pintarTabla();
    
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error al agregar'
                      })
                }
            }
        });
        
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Complete todos los campos'
          })
    }
}

function boton_cerrar(){
    $('#nuevoProveedor').modal('toggle');

    var listclear = ["rucSelect","rsSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = '';
    }
}


function eliminarProveedor(id){

    Swal.fire({
        title: '¿Estas Seguro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'sí, ¡bórralo!'
      }).then((result) => {
        if (result.isConfirmed) {

    $.ajax({
        type: 'post',
        url: '../controllers/proveedormantenimiento/eliminar_proveedor.php',
        data: { id: id },
        success: function(data) {
            var result = JSON.parse(data);

            if (result == true) {

                Swal.fire(
                    '¡eliminado!'
                    
                  )
                pintarTabla();

            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No se pudo eliminar al proveedor seleccionado'
                  });
            }
        }
    });
}
})

}


function expandirFila(d) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0">' +

        '<tr>' + '<td>Acciones:</td>' +
        `<td>
        <button onclick="editarProveedor(\'${d.id}\')" type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons">mode_edit</i>
        </button>
        <button onclick="eliminarProveedor(\'${d.id}\')" type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons">delete</i>
        </button>
        </td>` +
        '</tr>' +
        '</table>';
}

function pintarTabla() {
    $.ajax({
        type: 'post',
        url: '../controllers/proveedormantenimiento/rellenar_tabla_proveedor.php',
        data: null,
        success: function(data) {
            var js = JSON.parse(data);
            console.log(js);


            document.getElementById('contenido_tabla').innerHTML = "";

            document.getElementById('contenido_tabla').innerHTML = `<div class="table-responsive">
                <table id="instalaciones" class="table table-bordered table-striped table-hover dataTable" >
                    <thead>
                        <tr>
                            <th></th>
                            <th>RUC</th>
                            <th>Razon social</th>
                            
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>RUC</th>
                            <th>Razon social</th>
                            
                            
                        </tr>
                    </tfoot>
                </table>
            </div>`;

            var data_tabla = [];

            for (var i = 0; i < js.length; i++) {
                var elemento = {
                    "id": js[i]["id"],
                    "ruc": js[i]["ruc"],
                    "razonsocial": js[i]["razonsocial"]
                };

                data_tabla.push(elemento);
            }

            var table = $('#instalaciones').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [1,2]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1,2]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1,2]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [1,2]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [1,2]
                        }
                    }

                ],
                "data": data_tabla,
                "columns": [{
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    { "data": "ruc" },
                    { "data": "razonsocial" },
                ],
                "order": [
                    [1, 'asc']
                ]
            });


            // Add event listener for opening and closing details
            $('#instalaciones tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(expandirFila(row.data())).show();
                    tr.addClass('shown');
                }
            });

        }
    });

}


$(document).ready(function() {
    pintarTabla();

});