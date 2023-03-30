function traerCheckbox(){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type: 'post',
            url: '../controllers/enviocorrespondiente/traer_tabla_cliente.php',
            data: null,
            success:function(data){
                const contreo=JSON.parse(data);
                resolve(contreo);
            },
            error:function(error){
                reject(error);
            }
        });
    });
}

async function listaCheckbox(){
    const resultado=await traerCheckbox();
    document.getElementById('listaClientes').innerHTML = "";
    
    let mihtml="";

    mihtml+=`<div style="padding:0px 0px 5px 0px">`;
    mihtml+=`<input type="checkbox" id="generalclientes" name="milista" class="filled-in chk-col-blue">`;
    mihtml+=`<label for="generalclientes">Seleccionar todo</label>`;
    mihtml+=`</div>`;
    $.each(resultado,function(key,value){
        mihtml+='<div style="padding:0px 0px 5px 0px">';
        mihtml+=`<input type="checkbox" id="cliente${key+1}" name="milista" value="${value.codigo}" class="filled-in chk-col-blue" style="position:relative;left:10px;">`;
        mihtml+=`<label for="cliente${key+1}"><b>${value.codigo}</b> - ${value.razonsocial}</label>`;
        mihtml+='</div>';
    });

    document.getElementById('listaClientes').innerHTML=mihtml;
    //--pulscar click para seleccionar todos los checkboc cliente
    document.getElementById('generalclientes').addEventListener('change', function() {
        if (this.checked) {
            for(let i=1;i<resultado.length+1;i++){
                document.getElementById(`cliente${i}`).checked= true;
            }
        } else {
            for(let i=1;i<resultado.length+1;i++){
                document.getElementById(`cliente${i}`).checked= false;
            }
        }
    });


    //document.getElementById("pdf").onclick = function() { contenidoPDF(); }
    //--Traer a los clientes que han sido seleccionado con los checkbox



}







$(document).ready(function() {
    listaCheckbox();

});