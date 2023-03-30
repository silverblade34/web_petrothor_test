async function datosNuevoIncremento(){
    document.getElementById('incrementoSelect').value = '';
    const result = await sacarProducto();
    console.log(result);
    selectsRestores('productoSelect',result);
}
function sacarProducto(){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/clienteprecio/traerProducto.php',
            data : null,
            success:function(data){
                const ejecutar = JSON.parse(data);
                resolve(ejecutar);
            },
            error:function(error){
                reject(error);
            }
        });
    });
}
function aumentarPrecio(){
    const codigoproducto = document.getElementById('productoSelect').value;
    const precio = parseFloat(document.getElementById('incrementoSelect').value);
    
        let miarray=[];
        $.each($("input[name='milista']:checked"), function () {
            miarray.push($(this).val());
        });
    
    if (document.getElementById('incrementoSelect').value != '' && codigoproducto!=0) {
        let dinero;
        for(let i=0;i<miarray.length;i++){
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



function boton_cerrar(){
    $('#aumentoPrecio').modal('toggle');
    document.getElementById('incrementoSelect').value = '';
}


function traerDatosGuardar(){

    return new Promise((resolve,reject)=>{
        try{
            const codigolistapreciog = document.getElementById('listaprecioSelect').value;
            const fechag = document.getElementById('fechaSelect').value;
        
            let miarrayss=[];
            //--Agrega todos los codigo cliente 
            $.each($("input[name='milista']"), function () {
                miarrayss.push($(this).val());
            });
    
            resolve([codigolistapreciog,fechag,miarrayss]);
        }catch(error){
            reject(error);
        }
    });

}
function arrProducto(miarrays,producto){
    return new Promise((resolve,reject)=>{
        try{
            let arrayProducto=[];
            let contenidos=[];
            for (let i = 0; i < miarrays.length; i++) {
                arrayProducto=[];
                    producto.forEach(element => {
                        
                        var valoractualizado= parseFloat(document.getElementById(`${miarrays[i]}${element['codigo']}`).innerHTML);
                        arrayProducto.push(valoractualizado);
                    
                    });

                contenidos.push(arrayProducto);   
            }
            let productos = [];
            producto.forEach(element => {
                let unidProducto=element['codigo'];
                productos.push(unidProducto);
            });
            resolve([contenidos,productos]);
        }catch(error){
            reject(error);
        }
    });
}
function ejecutarCambios(fecha,codigolistaprecio,miarray,contenido,productos){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/clienteprecio/guardar_cambios.php',
            data : {codigolistaprecio: codigolistaprecio, fecha: fecha, check: miarray, precio:JSON.stringify(contenido), productos:productos},
            success:function(data){
                const barbaridad=JSON.parse(data);
                resolve(barbaridad);
            },
            error:function(error){
                reject(error);
            }
        });
    });
}
function guardarCambios(fecha,codigolistaprecio,miarray,contenido,productos){
    return new Promise(async(resolve,reject)=>{
        try{
            $('#loader-process').show();

            const result = await ejecutarCambios(fecha,codigolistaprecio,miarray,contenido,productos);
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
        }catch(error){
            reject(error);
        }

    });
   
}

function ejecutarCambiosRepeat(fecha,codigolistaprecio,miarray,contenido,productos){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/clienteprecio/guardar_cambios_fechrepeat.php',
            data:{codigolistaprecio: codigolistaprecio, fecha: fecha, check: miarray, precio:JSON.stringify(contenido), productos:productos},
            success:function(data2){
                const barbaridades=JSON.parse(data2);
                resolve(barbaridades);
            },
            error:function(error){
                reject(error);
            }
        });
    });
}
function guardarCambiosRepeat(fecha,codigolistaprecio,miarray,contenido,productos){
    console.log(productos);
    return new Promise((resolve,reject)=>{
        try{
            Swal.fire({
                title: 'Actualmente un registro lleva esa fecha',
                text: "¿Desea reemplazar el registro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then(async(result) => {
                if (result.isConfirmed) {
                    $('#loader-process').show();
                
                    const respuesta= await ejecutarCambiosRepeat(fecha,codigolistaprecio,miarray,contenido,productos);
                    console.log(respuesta);
                    if (respuesta===true) {
                        
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
                        
                }
            })
        }catch(error){
            reject(error);
        }
    });
}
function fechaNoRepeat(fecha,codigolistaprecio){
    return new Promise(async(resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/clienteprecio/no_repeat_fecha.php',
            data: {fecha:fecha, codigolistaprecio:codigolistaprecio},
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
async function guardar(producto){
    
    const datosGuardar = await traerDatosGuardar();
    const codigolistaprecio= datosGuardar[0];
    const fecha=datosGuardar[1];
    const miarray=datosGuardar[2];

    console.log(fecha);
    console.log(codigolistaprecio);
    console.log(miarray);

    const datosGuardar2 = await arrProducto(miarray,producto);
    const contenido= datosGuardar2[0];
    const productos=datosGuardar2[1];
    console.log(contenido);
    console.log(productos);
 
    if (codigolistaprecio != 0 && fecha != '') {

        const dt = await fechaNoRepeat(fecha,codigolistaprecio);

        if (dt === false) {
            await guardarCambios(fecha,codigolistaprecio,miarray,contenido,productos);
        }else{
            await guardarCambiosRepeat(fecha,codigolistaprecio,miarray,contenido,productos);
        }
        
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Por favor, llene los campos de la parte superior'
        })
    }
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
function selectsRestores(id, res) {
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

function traerLp(){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/clienteprecio/traer_lp.php',
            data: null,
            success:function(data1){
                const traelo=JSON.parse(data1);
                resolve(traelo)
            },
            error:function(error){
                reject(error);
            }
        });
    });
}

function traerTablas(solucion){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/clienteprecio/traer_tablas.php',
            data: { solucion: solucion},
            success:function(data){
                const respuestasa = JSON.parse(data);
                resolve(respuestasa);
            },
            error:function(error){
                reject(error);
            }
        });
    });
}
async function pintarTabla(){
    const resultado1 = await traerLp();
    selectsRestore("listaprecioSelect",resultado1[0]);

    document.getElementById("listaprecioSelect").addEventListener("change",async function(){
        $('#loader-processs').show();
        var solucion = document.getElementById('listaprecioSelect').value;
        if (solucion==0) {
            document.getElementById('contenido_tabla').innerHTML ='';
            setTimeout(function () { $('#loader-processs').fadeOut(); }, 50);
        }

        else{
            const resultado = await traerTablas(solucion);
            setTimeout(function () { $('#loader-processs').fadeOut(); }, 50);
            var listaprecio = resultado[0];
            var cliente = resultado[1];
            var producto = resultado[2];
            var clienteProducto = resultado[3];
            console.log(resultado);
            console.log(listaprecio);



            // -- Variable para contar los registros
            var countHead = 0
            console.log(clienteProducto);
            // --
            let dato
            var completar = "";
            if (listaprecio==null) {
                
            } else {
                completar += `<div><b>Fecha: </b>${moment(listaprecio[0]['fecha']).format('DD-MM-YYYY')}</div><br>`;
            }
            completar += '<div class="table-responsive">';
            completar += '<table id="instalaciones" class="table table-bordered table-striped table-hover dataTable" style="width:100%;">';
            completar += '<thead>';
            completar += '<tr>';
            completar += '<td style="width:5%;"><input type="checkbox" id="generalclientes" class="filled-in chk-col-blue"><label for="generalclientes"></label></td>';
            completar += '<td><b>CLIENTE</b></td>';            
                    for (countHead = 0; countHead < producto.length; countHead++) {
                    completar += `<td><b>`+
                    `${producto[countHead]['descripcion']}`;
                    completar += `</td></b>`;
                    }
            completar += '</tr>';
            completar += '</thead>';
            // -- Aqui saldran los productos
            completar += '<tbody>';
            $.each( clienteProducto, function( key, value ) {
                completar += '<tr>';
                completar += `<td><input type="checkbox" id="cliente${key+1}" name="milista" value="${value.codigo_cliente}"class="filled-in chk-col-blue"><label for="cliente${key+1}"></td>`;  
                completar += '<td><b>'+value.codigo_cliente+'</b> - '+value.cliente+'</td>';
                let codigoCliente = value.codigo_cliente;
            //--Aqui salen los precios de cada producto
                $.each( value.producto, function( key, value ) {
                    completar += `<td><div style="display:flex;"><div>S/.</div><div id="${codigoCliente}${value.codigo}">${value.precio}</div></div></td>`;  
                });
                completar += '</tr>';
                console.log(value);
            });
            completar += '</tbody>';

            completar += '</table>';
            completar += '</div>';
            completar += '<div><button type="button" style="padding:15px; position:relative; top:7px;" class="btn bg-green waves-effect" id="guardar">Guardar cambios</button></div>';
            document.getElementById('contenido_tabla').innerHTML = completar;
            console.log(producto);
            var imprimir=[]
            //--para mostrar la tabla del PDF sin errores 
            for (let i = 1; i < producto.length+2; i++) {
                imprimir.push(i);
            }
            
            var data_tabla=[];




            // --


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

                document.getElementById('generalclientes').addEventListener('change', function() {
                    if (this.checked) {
                        for(let i=1;i<cliente.length+1;i++){
                            document.getElementById(`cliente${i}`).checked= true;
                        }
                    } else {
                        for(let i=1;i<cliente.length+1;i++){
                            document.getElementById(`cliente${i}`).checked= false;
                        }
                    }
                });
                
        
            document.getElementById("guardar").onclick = function() { guardar(producto); }
        }
    });
}




$(document).ready(function() {
    pintarTabla();

});