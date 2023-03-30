function conteoCheckboxs(result){
    return new Promise((resolve,reject)=>{
        try{

            let arrayCliente=[];
            let arrayCorreo=[];
             //--bucle para encerrar en un array los checkbox seleccionados
            for (let i = 1; i < result.length+1; i++) {
                let contar =document.getElementById(`cliente${i}`);
                if (contar.checked == true) {
                     arrayCliente.push(result[i-1]['codigo']);
                     arrayCorreo.push(result[i-1]['correo']);
                 }
    
            }

            resolve([arrayCliente,arrayCorreo]);
        }catch(error){
            reject(error);
        }

    });
}


function bucleClientes(clientes,correos){
    return new Promise(async(resolve,reject)=>{
        try{
            
            let res="";
            let cont=0;

            for(const ele of clientes){
                if (correos[cont]=='') {
                    
                } else {
                    res = await traerTabla(ele, correos[cont]);
                    await bucleEnvioDeCorreos(res);
                }
                //console.log(ele)
                cont+=1;
            }

            resolve();
        }catch(error){
            reject(error);
        }

    });
}


function bucleEnvioDeCorreos(data){
    return new Promise(async(resolve,reject)=>{
        try{
            console.log(data);   
            const resultado = data[0];
            const arreglo = data[1];
            
            console.log(arreglo);
            //for(const x of arreglo){
                
            await enviarCorreo(resultado,arreglo);
            //}

            resolve();
        }catch(error){
            reject(error);
        }

    });
}


function enviarCorreo(res,correo){
    return new Promise((resolve,reject)=>{
            
          
        $.ajax({
            type:'post',
            url: '../controllers/pdf/enviar_correo.php',
            data: {resultado: res, correo: correo},
            success:function(data3){
                resolve();
            },
            error: function(error){
                reject(error);
            }
        });

            
       
    });
}


function traerTabla(cliente,correo){
    return new Promise((resolve,reject)=>{
            
            $.ajax({
                type: 'post',
                url: '../controllers/pdf/traer_tabla_para_pdf.php',
                data: { cliente: cliente },
                success:function(data1){
                    const resultado = JSON.parse(data1);
                    const expresionRegular = /\s*;\s*/;
                    const arreglo = correo.split(expresionRegular);
                    //console.log([resultado,arreglo]);
                   
                    resolve([resultado,arreglo]);

                },
                error: function(error){
                    reject(error);
                }
                
            });       
           

    });
}

function traer_tabla_cliente(){
    return new Promise((resolve,reject)=>{
      
        $.ajax({
            type: 'post',
            url: '../controllers/enviocorrespondiente/traer_tabla_cliente.php',
            data: null,
            success:function(data){
                const result= JSON.parse(data);
                document.getElementById('contenidoPDF').innerHTML="";
                resolve(result);
            },
            error: function(error){
                reject(error);
            }
        });

        
    });
   
}

async function inipdf(){
    $('#loader-process').show();

    const dt= await traer_tabla_cliente();
    //console.log(dt);
    const selects = await conteoCheckboxs(dt);
    
    const arrayCliente = selects[0];
    const arrayCorreo = selects[1];

    console.log(arrayCliente);
    console.log(arrayCorreo);


    await bucleClientes(arrayCliente,arrayCorreo);
    
    //--bucle de cantidad de pdfs que se crearan
    
    setTimeout(function () { $('#loader-process').fadeOut(); }, 50);
    Swal.fire({
        icon: 'success',
        title: 'Se envió al correo exitosamente'
    })
}
/*function contenidoPDF(){
    $.ajax({
        type: 'post',
        url: '../controllers/enviocorrespondiente/traer_tabla_cliente.php',
        data: null,
        success:function(data){
            var result= JSON.parse(data);
            document.getElementById('contenidoPDF').innerHTML="asdas";
            console.log(result);

            //--bucle para encerrar en un array los checkbox seleccionados
            let arrayCliente=[];
            for (let i = 1; i < result.length+1; i++) {
                let contar =document.getElementById(`cliente${i}`);
                if (contar.checked == true) {
                     arrayCliente.push(result[i-1]['codigo']);
                 }
    
            }
            console.log(arrayCliente);
            for (let j = 0; j < 3; j++) {
                document.getElementById('contenidoPDF').innerHTML=`<div id="crear${j}">${j}</div>`;

             
            
                
            }
            
        }
    });


}
*/




