function login(){
  var username = document.getElementById('username').value;
  var pass = document.getElementById('pass').value;
  
  console.log(username);
  if (username != '' || pass != '') {
    $.ajax({
      type: 'post',
      url: '../controllers/login/consultar_sesion.php',
      data: { username: username , pass: pass },
      success:function(data){
        var resultado = parseInt(data);
  
        if (resultado == 1) {

          window.location.replace('index.php');


        }else{
          Swal.fire({
            icon: 'error',
            title: 'Error, el usuario no existe'
          });
        }


      }
    });
    
  }else{
    Swal.fire({
      icon: 'warning',
      title: 'Campos vacíos'
    });
  }


}

