$(function () {
    console.log("holaaa mundooooo");
    
    $('sign_in').bind('submit', function () {
      $.ajax({
        type: 'post',
        url: './controllers/consultarSesion.php',
        data: $('sign_in').serialize(),
        success: function (data) {
          alert('form was submitted');
        }
      });
      return false;
    });
  });