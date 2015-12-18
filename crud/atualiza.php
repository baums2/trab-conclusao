<?php

//Busca o Arquivo  de conexão e verificação de Login

include "../config/conexao.php";
include "../config/verifica_sessao.php";

//------------------------

//Variáveis//

if (isset($_POST['ano'])) {
	$ano = $_POST['ano'] ;
}

if (isset($_POST['mes'])) {
	$mes = $_POST['mes'] ;
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else{
	$id = 0;
}

if (isset($_SESSION['usuario'])) {
	$usuario = $_SESSION['usuario'];
}

if (isset($_POST['tipo'])) {
	$tipo = $_POST['tipo'] ;
}else{
	header("location: ../telas/editar.php?mes=$mes&ano=$ano&id=$id");
	return false;
}

if (!empty($_POST['descricao'])){
	$desc = $_POST['descricao'] ;
}else{
	echo "<script type='text/javascript'>alert('Descrição em branco!'); location.href='../telas/editar.php?mes=$mes&ano=$ano&id=$id';</script>";
	return false;
}

if (!empty($_POST['valor'])){
	$valor = $_POST['valor'] ;
}else{
	echo "<script type='text/javascript'>alert('Insira um valor!'); location.href='../telas/editar.php?mes=$mes&ano=$ano&id=$id';</script>";
	return false;
}

$data= "$ano-$mes-01"; //Colocando data no formato mysql


//--------------------------------------------------------

//Editando dados na tabela

$sql = $con->prepare("UPDATE receitas_despesas SET tipo = :tipo, descricao = :descricao, data = :data, valor = :valor WHERE id = :id");
$sql->bindValue(":id",$id);
$sql->bindValue(":tipo",$tipo);
$sql->bindValue(":descricao",$desc);
$sql->bindValue(":data",$data);
$sql->bindValue(":valor",$valor);
$sql->execute();

	echo header("location: ../telas/principal.php?mes=$mes&ano=$ano");

//------------------------------------------------------------------------------------

//Fechando a Conexão
	$con = null;
//------------------
 ?>