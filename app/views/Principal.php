<?php
class Principal
{
  public function formPrincipal()
  {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <link rel="icon" type="image/x-icon" href="assets/uploads/favicon.png">
    </head>
    <style>
      body {
        width: 100%;
        height: calc(100%);
        position: fixed;
        top: 0;
        left: 0
      }

      main#main {
        width: 100%;
        height: calc(100%);
        display: flex;
        align-items: center;
        background-image: url(assets/uploads/background.jpg);
        background-size: cover;
      }
    </style>

    <body class="bg-dark">
      <main id="main">
        <div class="align-self-center w-100">
          <div id="login-center" align="center">
            <div class="card col-md-3 ">
              <div class="card-body">
                <h1 class="text-center mb-5"><img src="assets/uploads/logo.jpg" width="249px"></h1>
                <form id="login-form">
                  <div class="form-group">
                    <label for="username" class="control-label">Correo</label>
                    <input type="text" id="username" name="username" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                  </div>
                  <div class="form-group">
                    <label for="password" class="control-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" pattern="[A-Za-z0-9_-\.]" required>
                  </div>
                  <br>
                  <center><button class="btn btn-primary">Ingresar</button></center>
                  <br>
                  <br>
                  <br>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
      <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    </body>

    <script>
      document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
      });

      document.onkeydown = function(e) {
        if (event.keyCode == 123) {
          return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'i'.charCodeAt(0))) {
          return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'C'.charCodeAt(0) || e.keyCode == 'c'.charCodeAt(0))) {
          return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'J'.charCodeAt(0) || e.keyCode == 'j'.charCodeAt(0))) {
          return false;
        }
        if (e.ctrlKey && (e.keyCode == 'U'.charCodeAt(0) || e.keyCode == 'u'.charCodeAt(0))) {
          return false;
        }
        if (e.ctrlKey && (e.keyCode == 'S'.charCodeAt(0) || e.keyCode == 's'.charCodeAt(0))) {
          return false;
        }
      }
      $('#login-form').submit(function(e) {
        e.preventDefault()
        $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
        if ($(this).find('.alert-danger').length > 0)
          $(this).find('.alert-danger').remove();
        $.ajax({
          url: 'ajax.php?action=login',
          method: 'POST',
          data: $(this).serialize(),
          error: err => {
            console.log(err)
            $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
          },
          success: function(resp) {
            console.log(resp)
            // return
            if (resp == 1) {
              location.href = 'index.php?page=payments_report';
            } else {
              $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
              $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
            }
          }
        })
      })
    </script>

    </html>
<?php
  }
}
?>