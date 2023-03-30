function save_editProveedorPrecio(ids, numProducto,fecha){
    console.log(ids,numProducto,fecha);
    var ed_ids=[];
    var ed_todosPrecios=[];
    var ed_idProducto=[];
    //--bucle sacar los id para actualizar los precios
    for (let r = 0; r < ids.length; r++) {
        ed_ids.push(ids[r]['id']); 
    }
    console.log(ed_ids);
    for (let i = 0; i < numProducto.length; i++) {
        var precio = document.getElementById(`ed_${i}precio`).value;
        ed_todosPrecios.push(precio);
        ed_idProducto.push(numProducto[i]);
    }
    console.log(ed_todosPrecios);
    console.log(ed_idProducto);
    var ed_proveedor = document.getElementById('ed_proveedorSelect').value;
    var ed_fecha = document.getElementById('ed_fechaSelect').value;
    if (ed_fecha==fecha) {
        console.log("fecha es igual");
        $.ajax({
            type: 'post',
            url: '../controllers/proveedorprecio/editar_sin_cambiarfecha.php',
            data: { ed_proveedor: ed_proveedor, ed_idProducto:ed_idProducto, ed_todosPrecios: ed_todosPrecios, ed_ids: ed_ids },
            success:function(data3){
                var resultado = parseInt(data3);
                if (resultado==1) {
                    $('#editarProveedorPrecio').modal('toggle');

                
                    Swal.fire({
                        icon: 'success',
                        title: 'Se editó en el registro satisfactoriamente'
                    })
                    pintarTabla();
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error al editar'
                    })
                }
            }
        });
    }
    else{
        console.log("fecha no es igual");
        $.ajax({
            type: 'post',
            url: '../controllers/proveedorprecio/editar_proveedorprecio.php',
            data: { ed_proveedor: ed_proveedor, ed_idProducto:ed_idProducto, ed_todosPrecios: ed_todosPrecios, ed_fecha: ed_fecha, ed_ids: ed_ids },
            success:function(data){
                const result = parseInt(data);
                if (result == 1) {
                    $('#editarProveedorPrecio').modal('toggle');

                
                    Swal.fire({
                        icon: 'success',
                        title: 'Se editó en el registro satisfactoriamente'
                    })
                    pintarTabla();

                } else if (result==2) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error la fecha ya existe'
                    })
                }
                else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error al editar'
                    })
                }
            }
        });
    }
}

function ed_boton_cerrar(){
    $('#editarProveedorPrecio').modal('toggle');

               
}


function boton_cerrar(){
    $('#nuevoProveedorPrecio').modal('toggle');

    document.getElementById('fechaSelect').value='';
}


function crearRegistro(datos){
    var todosPrecios=[];
    var codigoProducto=[];


    for (let i = 0; i < datos.length; i++) {
        var precio = document.getElementById(`${i}precio`).value;
        todosPrecios.push(precio);
        codigoProducto.push(datos[i]["codigo"]);
    }



    console.log(todosPrecios);
    console.log(codigoProducto);
    var proveedor = document.getElementById('proveedorSelect').value;
    var fecha = document.getElementById('fechaSelect').value;

    if (fecha != '' && proveedor != 0) {
        $.ajax({
            type: 'post',
            url: '../controllers/proveedorprecio/no_repeat_fecha.php',
            data: { fecha: fecha},
            success:function(data1){
                var validar = JSON.parse(data1);
                if (validar === false) {

                    $.ajax({
                            type: 'post',
                            url: '../controllers/proveedorprecio/crear_proveedorprecio.php',
                            data: { proveedor: proveedor, codigoProducto: codigoProducto, todosPrecios: todosPrecios, fecha: fecha },
                            success: function(data){
                                var result= JSON.parse(data);
                                if (result === true) {
                                    $('#nuevoProveedorPrecio').modal('toggle');
                    
                                    document.getElementById('fechaSelect').value='';
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Se agregó al registro satisfactoriamente'
                                    })
                                    pintarTabla();
                    
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al agregar'
                                    })
                                }
                            }
                        });

                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Esta fecha ya fue usada'
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


function datosNuevoRegistro(){
    $.ajax({
        type: 'post',
        url: '../controllers/proveedorprecio/traerProveedor.php',
        data: null,
        success: function(data){
            var resultado = JSON.parse(data);
            console.log(resultado);
            selectsRestore("proveedorSelect",resultado);
            document.getElementById('fechaSelect').value='';
            $.ajax({
                type: 'post',
                url: '../controllers/proveedorprecio/traerProducto.php',
                data: null,
                success: function(data){
                    var resultado2 = JSON.parse(data);
                    const datos = resultado2;
                    console.log(resultado2);
                    document.getElementById('llenartabla').innerHTML="";
                    let contenido= "";
                    for (let i = 0; i < resultado2.length; i++) {
                        contenido+=`
                            <tr>
                                <td>${resultado2[i]["descripcion"]}</td>
                                <td>
                                <input type="number" step="0.01" id="${i}precio" required placeholder="S/.0.00" class="form-control input-xs">
                                </td>
                            </tr>
                        `;
                        
                    }
                    document.getElementById('llenartabla').innerHTML=contenido;
                    document.getElementById('datos').onclick = function(){crearRegistro(datos);}

                }
            });


        }
    });

}



function editarRegistro(proveedor,fecha){

    //--se trae la tabla atravez de los parametros de la funcion
    console.log(proveedor,fecha);
    $.ajax({
        type: 'post',
        url: '../controllers/proveedorprecio/traer_tabla_editar.php',
        data: { proveedor: proveedor, fecha: fecha },
        success: function(data){
            var result=JSON.parse(data);
             var idproveedor =result[0]['proveedor'];
             console.log(idproveedor);
             var numProducto = [];
             var numPrecio = [];
             //--Bucle para traer el nombre de los productos que se utilizaron al crear
             for (let i = 0; i < result.length; i++) {
                 numProducto.push(result[i]['producto']);
                 numPrecio.push(result[i]['precio']);
             }
             console.log(numProducto);
            // var numProducto = JSON.parse(result[0]['idproducto']);
            // var numPrecio = JSON.parse(result[0]['precio']);
            console.log(result);
            $.ajax({
                type: 'post',
                url: '../controllers/proveedorprecio/traer_tabla_externa.php',
                data:{idproveedor:idproveedor},
                success: function(data1){
                    var resultado  = JSON.parse(data1);
                    console.log(resultado);
                    var ed_producto = resultado[0];
                    var ed_proveedor = resultado[1];
                    console.log(ed_producto);
                    selectsRestore('ed_proveedorSelect',ed_proveedor);
                    let arrProducto=[];
                    document.getElementById('ed_proveedorSelect').value=idproveedor;
                    //--blucles para seleccionar los productos que se utilizaran
                    for (let j = 0; j < ed_producto.length; j++) {
                        
                        for (let i = 0; i < numProducto.length; i++) {
                            if (ed_producto[j]['codigo']==numProducto[i]) {
                                arrProducto.push(ed_producto[j]['descripcion']);
                            }
                            
                        }
                        
                    }
                    console.log(arrProducto);
                    document.getElementById('ed_llenartabla').innerHTML="";
                    let ed_contenido= "";
                    for (let i = 0; i < arrProducto.length; i++) {
                        ed_contenido+=`
                            <tr>
                                <td>${arrProducto[i]}</td>
                                <td>
                                <input type="number" step="0.01" id="ed_${i}precio" required placeholder="S/.0.00" class="form-control input-xs">
                                </td>
                            </tr>
                        `;
                        
                    }
                    
                    document.getElementById('ed_llenartabla').innerHTML=ed_contenido;
                    for (let x = 0; x < arrProducto.length; x++) {
                        document.getElementById('ed_'+x+'precio').value = numPrecio[x];
                        
                    }
                    document.getElementById('ed_fechaSelect').value=result[0]['fecha'];
                    document.getElementById("ed_datos").onclick = function() { save_editProveedorPrecio(result, numProducto,fecha); }
                    $('#editarProveedorPrecio').modal('toggle');

                }
            });
        }
    });
}

function eliminarRegistro(proveedor,fecha){
    console.log(proveedor,fecha)
    //--ajax para traer los id que pasaran a status "0"
    $.ajax({
        type: 'post',
        url: '../controllers/proveedorprecio/traer_tabla_editar.php',
        data: { proveedor: proveedor, fecha: fecha },
        success: function(data){
            var result=JSON.parse(data);
            console.log(result);
            var ids=[];
            //--Obtener los id para pasarlo a status "0"
            for (let i = 0; i < result.length; i++) {
                ids.push(result[i]['id']);
            }
            //--Sentencia para validar los cambios
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
                    url: '../controllers/proveedorprecio/eliminar_proveedorprecio.php',
                    data: { id: ids },
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
                                title: 'No se pudo eliminar del registro'
                            })
                        }
                    }
                });
            }
            })
        }

    });
  

}


function selectsRestore(id, res) {
    var select = document.getElementById(id);

    for (var i = select.length - 1; i >= 0; i--) {
        select.remove(i);
    }
    var opt = document.createElement('option');
    opt.value = "0";
    opt.innerHTML = "No seleccionado";
    select.appendChild(opt);
    for (var i = 0; i < res.length; i++) {
        var opt = document.createElement('option');
        opt.value = res[i]["razonsocial"];
        opt.innerHTML = res[i]["razonsocial"];
        select.appendChild(opt);
    }
}





function expandirFila(d) {
    console.log(d.id);
    console.log(d.productos);
    // `d` is the original data object for the row
    
    var completar = "";
     completar+= '<table style="width:100%;">';
     completar+= '<thead>';
     completar+= '<tr>' + '<td><b>Fecha:</b></td>';
     
                for (let i = 0; i < d.productos.length; i++) {
                    completar+=`<td><b>`+
                    `${d.productos[i]['descripcion']}`;
                    completar+=`</b></td>`;
                }
    completar+= '<td><b>Editar/Eliminar</b></td>';
                '</tr>';
     
        completar+='</thead>';
        completar+='<tbody>';
        console.log( d.id['fecha'][0]['fecha']);
        console.log(d.id['fecha'][0]['productos']);
        //fecha:console.log( d.id['fecha'][0]['fecha']);
        //console.log(d.id['fecha'][0]['productos'][0]['precio']);

                for (let i = 0; i < d.id['fecha'].length; i++) {
                    completar+='<tr>';
                    completar+=`<td><div id="${i}${d.id['fecha'][i]['fecha']}">${d.id['fecha'][i]['fecha']}</div></td>`;
                    //console.log(d.id['fecha'][0]['fecha']);
                    for (let j = 0; j < d.id['fecha'][i]['productos'].length; j++) {
                       
                       completar+=`<td><div style="display:flex;"><div>S/.</div><div id="${i}${d.id['cliente']}${d.id['fecha'][0]['fecha']}${j}">${d.id['fecha'][i]['productos'][j]['precio']}</div></div></td>`;
                        
                    }
                    //console.log(d.id['fecha'][0]['productos'][j]['precio']);
                    completar+= '<td>';
                    completar+=`<button onclick="editarRegistro(\'${d.id['cliente']}\',\'${d.id['fecha'][i]['fecha']}\')" type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">mode_edit</i>
                        </button>`;
                    completar+=` <button onclick="eliminarRegistro(\'${d.id['cliente']}\',\'${d.id['fecha'][i]['fecha']}\')" type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">delete</i>
                </button>`;
                    
                    completar+= '</td>';
                    completar+='</tr>';
                }

        completar+='</tbody>';
        completar+='</table>';

        return completar;
}

function pintarTabla() {
    $.ajax({
        type: 'post',
        url: '../controllers/proveedorprecio/rellenar_tabla_precio.php',
        data: null,
        success: function(data) {
            var js = JSON.parse(data);
            console.log(js);

            $.ajax({
                type: 'post',
                url: '../controllers/proveedorprecio/traer_producto_para_tabla.php',
                data:null,
                success: function(data){
                    var result=JSON.parse(data);
                    console.log(result);

            
                    var data_tabla = [];
                    for (let i = 0; i < js.length; i++) {
                    
                        var elemento = {
                            "id": js[i],
                            "proveedor": js[i]["cliente"],
                            "productos": result
                        };
                        data_tabla.push(elemento);
                        console.log(data_tabla);
                    }
                    

        

            document.getElementById('contenido_tabla').innerHTML = "";

            document.getElementById('contenido_tabla').innerHTML = `<div class="table-responsive">
                <table id="instalaciones" class="table table-bordered table-striped table-hover dataTable" >
                    <thead>
                        <tr>
                            <th></th>
                            <th>Proveedor</th>

                        
                        
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Proveedor</th>

                        
                        
                        </tr>
                    </tfoot>
                </table>
            </div>`;

 
            var table = $('#instalaciones').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1]
                            
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
                    { "data": "proveedor" },
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
    });

}


$(document).ready(function() {
    pintarTabla();

});
