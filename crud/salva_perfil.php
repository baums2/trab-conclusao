<?php 

//Busca arquivo de conex�o

include "../config/conexao.php";

//-------------------------

//Variaveis

if (isset($_POST['usuario'])) {
	$usuario = $_POST['usuario'];
}

if (isset($_POST['senha'])) {
	$senha = $_POST['senha'];
}

//-------------------------------

//Cadastra o usu�rio

$sql = $con->prepare("INSERT INTO usuarios VALUES (null, :usuario, :senha)");
$sql->bindvalue(":usuario",$usuario);
$sql->bindvalue(":senha",$senha);
$sql->execute();

	if ($sql->rowcount() > 0) {
		echo "<script type='text/javascript'>alert('Usu�rio Cadastrado com Sucesso!'); location.href='../autenticacao.php';</script>";
	}else{
		echo "	<script type='text/javascript'>alert('Usu�rio j� cadastrado!'); location.href='../telas/cadastra_perfil.php';</script>";
	}
?>