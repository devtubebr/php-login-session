<?php include_once "funcoes.php";?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login · DevTubeBR</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.2/examples/sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" method="post" action="logar.php">
  <img class="mb-4" src="https://getbootstrap.com/docs/4.2/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Identifique-se!</h1>
  <?php //flashMsg("warning");?>
  <?php //flashMsg("danger");?>

  <div id="mensagens">

  </div>

  <label for="email" class="sr-only">E-mail</label>
  <input type="email" id="email" name="email" class="form-control" placeholder="Endereço de e-mail" autofocus>
  <label for="senha" class="sr-only">Senha</label>
  <input type="password" name="senha" id="senha" class="form-control" placeholder="Informa a senha">
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="1" name="lembrar"> Lembrar de mim
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="button" id="bt_login">Entrar</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>

<script type="text/javascript">

  document.getElementById("bt_login").onclick = () => {
    const dados = {
      "email": document.getElementById("email").value,
      "senha": document.getElementById("senha").value,
      "lembrar": document.getElementById("email").checked,
    };

    fetch("logar_ajax.php", {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      method: "POST",
      body: JSON.stringify(dados)
    }).then(response => {
      response.json().then(result => {
        if(result.status == 'success') {
          alert(result.msg);
          window.location = "/dashboard.php";
        } else {
          let divMsg = document.getElementById('mensagens');
          divMsg.innerHTML = `<div class='alert alert-${result.status}'>${result.msg}</div>`;
        }
      })
    })
  }

</script>

</body>
</html>