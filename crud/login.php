<?php 

include "../config/conexao.php";


//Variaveis

if (isset($_POST['usuario'])) {
	$usuario = $_POST['usuario'];
}

if (isset($_POST['senha'])) {
	$senha = $_POST['senha'];
}


//--------------------------------

//Autenticando usuário e senha

$sql = $con->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha");
$sql->bindvalue("usuario",$usuario);
$sql->bindvalue("senha",$senha);
$sql->execute();

	if($sql->rowcount() > 0){
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['senha'] = $senha;
		header('Location: ../telas/principal.php');
	}else{
		echo "<script type='text/javascript'>alert('Acesso Negado'); location.href='../telas/autenticacao.php';</script>";
	}
 ?>