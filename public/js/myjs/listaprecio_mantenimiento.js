
function save_editListaPrecio(idreq){
    var codigo = document.getElementById('ed_codigoSelect').value;
    var descripcion = document.getElementById('ed_descripcionSelect').value;
    var id = idreq;
    $.ajax({
        type: 'post',
        url: '../controllers/listapreciomantenimiento/editar_listaprecio.php',
        data: { codigo: codigo, descripcion: descripcion, id: id },
        success: function(data) {
            const result = parseInt(data);
            
            if (result == 1) {
                $('#editarListaPrecio').modal('toggle');

                var listclear = ["ed_codigoSelect","ed_descripcionSelect"];
                for (var i = 0; i < listclear.length; i++) {
                    document.getElementById(listclear[i]).value = ''
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Se editó en el registro satisfactoriamente'
                  })
                pintarTabla();
            } else if(result==2){
                Swal.fire({
                    icon: 'warning',
                    title: 'No se puede cambiar a un codigo existente'
                  })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Error al editar'
                  })
            }
        }
    });

}

function editarListaPrecio(id){
    var id = id;
    $.ajax({
        type: 'post',
        url: '../controllers/listapreciomantenimiento/obtener_listaprecio.php',
        data: { id:id },
        success: function(data){
            var result= JSON.parse(data);
            var datos=result[0];
            console.log(datos);
            const idreq = datos['id'];
            const codigo = datos['codigo'];
            const descripcion = datos['descripcion'];
            //Setear valores del id seleccionado
            document.getElementById('ed_codigoSelect').value = codigo;
            document.getElementById('ed_descripcionSelect').value = descripcion;

            document.getElementById("save_cambios_bt").onclick = function() { save_editListaPrecio(idreq); }
            $('#editarListaPrecio').modal('toggle');
        }
    });
}

function nuevo_listaprecio(){
    var listclear = ["codigoSelect","descripcionSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = '';
    }
}


function crearListaPrecio() {
    var codigo = document.getElementById("codigoSelect").value;
    var descripcion = document.getElementById('descripcionSelect').value;

    if (codigo != '' && descripcion != '') {
        $.ajax({
            type: 'post',
            url: '../controllers/listapreciomantenimiento/crear_listaprecio.php',
            data: { codigo: codigo, descripcion: descripcion },
            success: function(data) {
                var result = JSON.parse(data);
    
                if (result == 1) {
                    $('#nuevoListaPrecio').modal('toggle');
    
                    var listclear = ["codigoSelect","descripcionSelect"];
                    for (var i = 0; i < listclear.length; i++) {
                        document.getElementById(listclear[i]).value = '';
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Se agregó al registro satisfactoriamente'
                      })
                    pintarTabla();

                } else if (result == 2) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'El codigo ya se encuentra registrado'
                      })
    
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
    $('#nuevoListaPrecio').modal('toggle');
    var listclear = ["codigoSelect","descripcionSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = '';
    }
}

function eliminarListaPrecio(id) {


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
        url: '../controllers/listapreciomantenimiento/eliminar_listaprecio.php',
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
                    title: 'No se pudo eliminar'
                  })
            }
        }
    });
}
})

}

function ed_boton_cerrar(){
    $('#editarListaPrecio').modal('toggle');
    var listclear = ["ed_codigoSelect","ed_descripcionSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = ''
    }
    
}



function expandirFila(d) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0">' +

        '<tr>' + '<td>Acciones:</td>' +
        `<td>
        <button onclick="editarListaPrecio(\'${d.id}\')" type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons">mode_edit</i>
        </button>
        <button onclick="eliminarListaPrecio(\'${d.id}\')" type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons">delete</i>
        </button>
        </td>` +
        '</tr>' +
        '</table>';
}

function pintarTabla() {
    $.ajax({
        type: 'post',
        url: '../controllers/listapreciomantenimiento/rellenar_tabla_listaprecio.php',
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
                            <th>Código</th>
                            <th>Descripción</th>
                            
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Código</th>
                            <th>Descripción</th>
                            
                            
                        </tr>
                    </tfoot>
                </table>
            </div>`;

            var data_tabla = [];

            for (var i = 0; i < js.length; i++) {
                var elemento = {
                    "id": js[i]["id"],
                    "codigo": js[i]["codigo"],
                    "descripcion": js[i]["descripcion"]
                };

                data_tabla.push(elemento);
            }

            var table = $('#instalaciones').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1,2]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1,2]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1,2]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1,2]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1,2]
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
                    { "data": "codigo" },
                    { "data": "descripcion" },
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