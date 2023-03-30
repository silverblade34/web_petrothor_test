
function aumentarPrecio(){
    const codigoproducto = document.getElementById('productoSelect').value;
    const precio = parseFloat(document.getElementById('incrementoSelect').value);
    
        let miarray=[];
        $.each($("input[name='milista']:checked"), function () {
            miarray.push($(this).val());
        });
    console.log(codigoproducto,precio);
    console.log(miarray);
    if (document.getElementById('incrementoSelect').value != '' && codigoproducto!=0) {
        for(let i=0;i<miarray.length;i++){
            document.getElementById(`${miarray[i]}${codigoproducto}`).innerHTML=0;

            const valoractual= parseFloat(document.getElementById(`${miarray[i]}${codigoproducto}`).innerHTML);
            document.getElementById(`${miarray[i]}${codigoproducto}`).innerHTML=precio+valoractual;

        }
        if (miarray.length!=0) {
            Swal.fire({
                icon: 'success',
                title: 'Precio modificado exitosamente',
                text: 'Si no quiere perder los cambios pulse el boton "Guardar cambios"'
              })
        }else{
            Swal.fire({
                icon: 'warning',
                title: 'Seleccione almenos un cliente de la tabla'
              })
        }
        
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Complete todos los campos'
          })

    }
}
function traerDatosGuardar(precioProducto){
    return new Promise((resolve,reject)=>{
        try{
            let miarrays=[];
            $.each($("input[name='milista']"), function () {
                miarrays.push($(this).val());
            });
            console.log(precioProducto);
            console.log(miarrays);
            let arrayProducto=[];
            let contenidos=[];
            for (let i = 0; i < miarrays.length; i++) {
                arrayProducto=[];
                precioProducto.forEach(element => {
                    
                    var valoractualizado= parseFloat(document.getElementById(`${miarrays[i]}${element['codigo']}`).innerHTML);
                    arrayProducto.push(valoractualizado);
                   
                });
        
                contenidos.push(arrayProducto);
                
            }
            console.log(contenidos);
            let productoss = [];
            precioProducto.forEach(element => {
                let unidProducto=element['codigo'];
                productoss.push(unidProducto);
            });
    
            resolve([miarrays,contenidos,productoss]);
        }catch(error){
            reject(error);
        }
    });

}
function fechaNoRepeat(fecha){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/preciomasivo/fecha_no_repeat.php',
            data: {fecha:fecha},
            success:function(data1){
                var respuesta=JSON.parse(data1);
                resolve(respuesta);
                
            },
            error:function(error){
                reject(error);
            }
        });
        
    });
}
function guardarCambios(fecha,miarray,contenido,productos){
    return new Promise((resolve,reject)=>{
        $('#loader-process').show();
        $.ajax({
            type: 'post',
            url: '../controllers/preciomasivo/guardar_cambios.php',
            data : {fecha: fecha, check: miarray, precio:JSON.stringify(contenido), productos:productos},
            success:function(data){
                var result=JSON.parse(data);
                console.log(result);
                if (result===true) {
                    
                    document.getElementById('fechaSelect').value = '';
                    setTimeout(function () { $('#loader-process').fadeOut(); }, 50);
                    Swal.fire({
                        icon: 'success',
                        title: 'Cambios guardados'
                    })

                        pintarTabla();
                        document.getElementById('contenido_tabla').innerHTML ='';
                }else {
                    setTimeout(function () { $('#loader-process').fadeOut(); }, 50);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error al agregar'
                    })
                }
                resolve();
            },
            error:function(error){
                reject(error);
            }
        });
    });
}
function guardarCambiosRepeat(fecha,miarray,contenido,productos){
    return new Promise((resolve,reject)=>{
        Swal.fire({
            title: 'Actualmente lleva un registro con esa fecha',
            text: "¿Desea reemplazar el registro con esta nueva?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
            }).then((result) => {
            if (result.isConfirmed) {
                $('#loader-process').show();
                $.ajax({
                    type: 'post',
                    url: '../controllers/preciomasivo/guardar_cambios_fechrepeat.php',
                    data:{fecha: fecha, check: miarray, precio:JSON.stringify(contenido), productos:productos},
                    success:function(data2){
                        respuesta2=JSON.parse(data2);
                        if (respuesta2===true) {
                            
                            document.getElementById('fechaSelect').value = '';
                            setTimeout(function () { $('#loader-process').fadeOut(); }, 50);
                            Swal.fire({
                                icon: 'success',
                                title: 'Cambios guardados'
                                })
    
                                pintarTabla();
                                document.getElementById('contenido_tabla').innerHTML ='';
    
                        }else {
                            setTimeout(function () { $('#loader-process').fadeOut(); }, 50);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error al agregar'
                                })
                        }
                        resolve();
                    },
                    error:function(error){
                        reject(error);
                    }
                });
            }
        })
    });
}
async function guardar(precioProducto){
    console.log(precioProducto);
    const fecha = document.getElementById('fechaSelect').value;
    const datos = await traerDatosGuardar(precioProducto);
    const miarray=datos[0];
    const contenido = datos[1];
    const productos= datos[2];
    console.log(miarray);
    console.log(contenido);
    console.log(productos);
    if (fecha != '') {
        const dt = await fechaNoRepeat(fecha);
        console.log(dt);
        if (dt===false) {
            await guardarCambios(fecha,miarray,contenido,productos);
        } else {
            
            await guardarCambiosRepeat(fecha,miarray,contenido,productos);
        }
     
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Por favor, llene los campos de la parte superior'
          })
    }
    
}





function boton_cerrar(){
    $('#aumentoPrecio').modal('toggle');
    document.getElementById('incrementoSelect').value = '';
}

function datosNuevoIncremento(){
    document.getElementById('incrementoSelect').value = '';
    $.ajax({
        type: 'post',
        url: '../controllers/preciomasivo/traer_producto.php',
        data : null,
        success:function(data){
            var result = JSON.parse(data);
            console.log(result);
            selectsRestore('productoSelect',result);
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
        opt.value = res[i]["codigo"];
        opt.innerHTML = res[i]["descripcion"];
        select.appendChild(opt);
    }
}
function traerTabla(){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/preciomasivo/traer_tabla.php',
            data: null,
            success:function(data){
                const muestra = JSON.parse(data);
                resolve(muestra);
            },
            error:function(error){
                reject(error);
            }
        });
    });
}
async function pintarTabla(){
    var resultado = await traerTabla();
    console.log(resultado);

    let completar = "";
    completar += `<div class="table-responsive">
                    <table id="instalaciones" class="table table-bordered table-striped table-hover dataTable" style="width:100%;">
                        <thead>
                            <tr>
                                <td style="width:5%;">
                                    <input type="checkbox" id="clientegeneral" class="filled-in chk-col-blue">
                                    <label for="clientegeneral"></label>
                                </td>
                                <td><b>Lista de precio</b></td>
                                `;
                                for (let i = 0; i < resultado[1].length; i++) {
                                    completar+=`
                                        <td><b>${resultado[1][i]['descripcion']}<b/></td>
                                    `;
                                }
                    completar+=`
                            </tr>
                        </thead>
                        <tbody>
                    `;
                    for (let j = 0; j < resultado[0].length; j++) {
                    completar+=`
                            <tr>
                                <td>
                                    <input type="checkbox" id="cliente${j+1}" name="milista" value="${resultado[0][j]['codigo_cliente']}"class="filled-in chk-col-blue">
                                    <label for="cliente${j+1}"></label>
                                </td>
                                <td><b>${resultado[0][j]['codigo_cliente']}</b> - ${resultado[0][j]['cliente']}</td>
                    `;
                        for (let r = 0; r < resultado[0][j]['producto'].length; r++) {
                            completar+=`
                                <td><div style="display:flex;"><div>S/.</div><div id="${resultado[0][j]['codigo_cliente']}${resultado[0][j]['producto'][r]['codigo']}">${resultado[0][j]['producto'][r]['precio']}</div></td>
                            `;
                        }
                    completar+=`
                            </tr>
                    `;
                    }
                    completar+=`
                        </tbody>
                    </thead>
                </table>
            </div>
            <div>
                <button type="button" style="padding:15px; position:relative; top:7px;" class="btn bg-green waves-effect" id="guardar">Guardar cambios</button>
            </div>
            `;
    document.getElementById('contenido_tabla').innerHTML = completar;

    var imprimir=[]
    for (let i = 0; i < resultado[1].length+1; i++) {
        imprimir.push(i);
    }

    var table = $('#instalaciones').DataTable({
        dom: 'Bfrtip',
        paging: false,
        responsive: true,
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: imprimir
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns:imprimir
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: imprimir
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: imprimir
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: imprimir
                }
            }


        ]
        
        
    });
    document.getElementById('clientegeneral').addEventListener('change', function() {
        if (this.checked) {
            for(let i=1;i<resultado[0].length+1;i++){
                document.getElementById(`cliente${i}`).checked= true;
            }
        } else {
            for(let i=1;i<resultado[0].length+1;i++){
                document.getElementById(`cliente${i}`).checked= false;
            }
        }
    });

    document.getElementById("guardar").onclick = function() { guardar(resultado[1]); }
}



$(document).ready(function() {
    pintarTabla();

});