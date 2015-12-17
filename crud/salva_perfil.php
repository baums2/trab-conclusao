<?php 

//Busca arquivo de conexão

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

//Cadastra o usuário

$sql = $con->prepare("INSERT INTO usuarios VALUES (null, :usuario, :senha)");
$sql->bindvalue(":usuario",$usuario);
$sql->bindvalue(":senha",$senha);
$sql->execute();

	if ($sql->rowcount() > 0) {
		echo "<script type='text/javascript'>alert('Usuário Cadastrado com Sucesso!'); location.href='../autenticacao.php';</script>";
	}else{
		echo "	<script type='text/javascript'>alert('Usuário já cadastrado!'); location.href='../telas/cadastra_perfil.php';</script>";
	}
?>