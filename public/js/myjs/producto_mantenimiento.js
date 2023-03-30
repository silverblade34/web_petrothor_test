


function save_editProducto(idreq){
    $.ajax({
        type:'post',
        url: '../controllers/clientemantenimiento/traer_lp.php',
        data: null,
        success:function(data1){
            const resultado=JSON.parse(data1);
            console.log(resultado);

            let ids = [];
            for (let i = 0; i < resultado.length; i++) {
                ids.push(resultado[i]['codigo']);
            }



            let checkes = "[";
            ids.forEach(element => {
                if (document.getElementById(element).checked == true) {
                    checkes += element + ",";
                }
            });
            checkes = checkes.slice(0, -1);
            checkes += "]";
            console.log(checkes);
            var codigo = document.getElementById('ed_codigoSelect').value;
            var descripcion = document.getElementById('ed_descripcionSelect').value;
            var id = idreq;
            if (codigo != '' && checkes!= ']' && descripcion!='') {
                $.ajax({
                    type: 'post',
                    url: '../controllers/productomantenimiento/editar_producto.php',
                    data: { codigo: codigo, descripcion: descripcion, id: id, checkes: checkes },
                    success: function(data) {
                        const result = parseInt(data);
                        
                        if (result == 1) {
                            $('#editarProducto').modal('toggle');

                            var listclear = ["ed_codigoSelect","ed_descripcionSelect"];
                            for (var i = 0; i < listclear.length; i++) {
                                document.getElementById(listclear[i]).value = ''
                            }
                            Swal.fire({
                                icon: 'success',
                                title: 'Se editó en el registro satisfactoriamente'
                            })
                            pintarTabla();

                        } else if (result==2){
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
            } else{
                Swal.fire({
                    icon: 'error',
                    title: 'Importante registrar código y lista de precio'
                })
            }
        }
    });
}

function ed_boton_cerrar(){
    $('#editarProducto').modal('toggle');

    var listclear = ["ed_codigoSelect","ed_descripcionSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = ''
    }
}


function editarProducto(id){
    var id = id;
    $.ajax({
        type: 'post',
        url: '../controllers/productomantenimiento/obtener_producto.php',
        data: { id:id },
        success: function(data){
            var result= JSON.parse(data);
            var datos=result[0][0];
            console.log(datos);
            const idreq = datos['id'];
            const codigo = datos['codigo'];
            const descripcion = datos['descripcion'];
            let listaprecio = datos['codlistaprecio'];
            //Setear valores del id seleccionado
            document.getElementById('ed_codigoSelect').value = codigo;
            document.getElementById('ed_descripcionSelect').value = descripcion;
            ed_selectscheckbox('ed_listcheckbox',result[1]);
            console.log(listaprecio);
            listaprecio= listaprecio.replace('[','');
            listaprecio=listaprecio.replace(']','');
            const arreglar = listaprecio.split(",");
            console.log(arreglar);
            arreglar.forEach(element => {
                console.log(element);
                if (!document.getElementById(element)) {
                    
                
                }else{
                    document.getElementById(element).checked = true;
                 }
            });

            document.getElementById("save_cambios_bt").onclick = function() { save_editProducto(idreq); }
            $('#editarProducto').modal('toggle');
        }
    });
}
function ed_selectscheckbox(id, res) {

    document.getElementById(id).innerHTML = "";
    let contenido = "";
    let ids = [];
    res.forEach(element => {
        contenido += `<input type="checkbox" class="filled-in" id="${element["codigo"]}" value="${element["codigo"]}" />`;
        contenido += `<label for="${element["codigo"]}"> ${element["descripcion"]} </label> </br>`;
        ids.push(element["codigo"]);
    });
    document.getElementById(id).innerHTML = contenido;


}
function selectscheckbox(id, res) {
    document.getElementById(id).innerHTML = '';
    let contenido = '';
    let ids = [];
    res.forEach(element => {
        contenido += `<input type="checkbox" class="filled-in" id="${element["codigo"]}nuevo" value="${element["codigo"]}" />`;
        contenido += `<label for="${element["codigo"]}nuevo"> ${element["descripcion"]} </label> </br>`;
        ids.push(element["codigo"]);
    });
    document.getElementById(id).innerHTML = contenido;
    console.log(ids);

    document.getElementById("crearboton").onclick = function() { crearProducto(ids); }
}
function nuevo_datos_producto(){
    
    var listclear = ["codigoSelect","descripcionSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = '';
    }
    $.ajax({
        type: 'post',
        url: '../controllers/clientemantenimiento/traer_lp.php',
        data: null,
        success: function(data){
            const resultado = JSON.parse(data);
            console.log(resultado);
            //--Datos de la lista de precio en Checkbox
            selectscheckbox('listcheckbox',resultado);
        }
    });
}


function crearProducto(ids) {
    let checkes = "[";
    ids.forEach(element => {
        if (document.getElementById(`${element}nuevo`).checked == true) {
            checkes += element + ",";
        }
    });
    checkes = checkes.slice(0, -1);
    checkes += "]";
    checkes = checkes.replace(/nuevo/g, "");
    console.log(checkes);

    var codigo = document.getElementById("codigoSelect").value;
    var descripcion = document.getElementById('descripcionSelect').value;


    if (codigo!='' && descripcion!='' && checkes!=']') {
        $.ajax({
            type: 'post',
            url: '../controllers/productomantenimiento/crear_producto.php',
            data: { codigo: codigo, descripcion: descripcion , checkes: checkes},
            success: function(data) {
                var result = JSON.parse(data);
    
                if (result == 1) {
                    $('#nuevoProducto').modal('toggle');
    
                    var listclear = ["codigoSelect","descripcionSelect"];
                    for (var i = 0; i < listclear.length; i++) {
                        document.getElementById(listclear[i]).value = '';
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Se agregó al registro satisfactoriamente'
                      })
                    pintarTabla();
    
                }else if (result=2) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'El codigo se encuentra registrado'
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
    $('#nuevoProducto').modal('toggle');

    var listclear = ["codigoSelect","descripcionSelect"];
    for (var i = 0; i < listclear.length; i++) {
        document.getElementById(listclear[i]).value = '';
    }
}


function eliminarProducto(id){

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
        url: '../controllers/productomantenimiento/eliminar_producto.php',
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
                    title: 'No se pudo eliminar el producto seleccionado'
                  })
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
        <button onclick="editarProducto(\'${d.id}\')" type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons">mode_edit</i>
        </button>
        <button onclick="eliminarProducto(\'${d.id}\')" type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons">delete</i>
        </button>
        </td>` +
        '</tr>' +
        '</table>';
}

function pintarTabla() {
    $.ajax({
        type: 'post',
        url: '../controllers/productomantenimiento/rellenar_tabla_producto.php',
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