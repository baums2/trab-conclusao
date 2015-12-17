<!-- Script de validação -->

<?php

session_start();
session_destroy();

 ?>
<script type="text/javascript">
  function valida(){
    if(login.usuario.value == "" || cadastro_usu.usuario.value.length > 10) {
      alert("Acesso Negado!");
      return false;
    }

    if(login.senha.value == "" || cadastro_usu.senha.value.length > 6) {
      alert("Acesso Negado!");
      return false;
    }
  }
</script>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Controle Financeiro</title>
    
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-responsive.css">
     <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
</head>

<body>

  <div class="row-fluid">  
    <div class="span11" id="fundo">  
      <h1 id="h">Controle Financeiro</h1>
        <div class="row-fluid">  
          <div class="span10" id="fundo1"></div>    
        </div>  
    </div>  
  </div> 

      <div class="row-fluid" align="center">
       <form action="../crud/login.php" method="post" onsubmit="return valida()" name="login">
        <div class="spa10">
         <div><h1 style="color: #1d2f16">Login</h1></div>
         <hr>
          <div>Usuário:</div><div><input type="text" name="usuario"></div><br>
          <div>Senha:</div><div><input type="password" name="senha"></div><br>
          <div><input type="submit" value="Enviar"></div><br>
          <div><a href="../telas/cadastra_perfil.php">Cadastrar Perfil</a></div>
            
        </div>
        </form>
      </div>
        
           <footer>
          <div class="row-fluid">
            <div class="span11"><hr></div>
          </div>
        </footer>
    
</body>
</html>