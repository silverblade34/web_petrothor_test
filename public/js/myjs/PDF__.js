
 $("#pdf").on('click', function() {
     // --
     let valoresCheck = [];
     // --
     $('[name="milista"]:checked').each(function(){
         // --
         if (this.value != "on") {
             valoresCheck.push(this.value);
         }
     });
     // --
     window.open('../../../petrothor_b/controllers/pdf/enviar_correo.php?resultado='+ valoresCheck)
 })

