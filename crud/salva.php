<?php 

//Busca o Arquivo  de conexão e verificação de Login

include "../config/conexao.php";
include "../config/verifica_sessao.php";

//------------------------

//Variaveis

if (isset($_POST['ano'])) {
	$ano = $_POST['ano'] ;
}else{
	$ano = $_GET['ano'];
}

if (isset($_POST['mes'])) {
	$mes = $_POST['mes'] ;
}else{
	$mes = $_GET['mes'];
}

if (isset($_SESSION['usuario'])) {
	$usuario = $_SESSION['usuario'];
}

if (isset($_POST['tipo'])) {
	$tipo = $_POST['tipo'] ;
}else{
	header("location: ../telas/adicionar.php?mes=$mes&ano=$ano");
	return false;
}

if (!empty($_POST['descricao'])){
	$desc = $_POST['descricao'] ;
}else{
	echo header("location: '../telas/adicionar.php?mes=$mes&ano=$ano");
	return false;
}

if (!empty($_POST['valor'])){
	$valor = $_POST['valor'] ;
}else{
	echo "<script type='text/javascript'>alert('Insira um valor!'); location.href='../telas/adicionar.php?mes=$mes&ano=$ano';</script>";
	return false;
}

$data = "$ano-$mes-01";

//------------------------------------

//Adiciona os registros no  banco de dados

$sql = $con->prepare("INSERT INTO receitas_despesas VALUES (null, :usuario, :tipo, :descricao, :data, :valor)");
$sql->bindvalue(":usuario",$usuario);
$sql->bindvalue(":tipo",$tipo);
$sql->bindvalue(":descricao",$desc);
$sql->bindvalue(":data",$data);
$sql->bindvalue(":valor",$valor);
$sql->execute();

//Confere se o registro foi incluido no sistema

	if ($sql->rowcount() > 0) {
		header("location: ../telas/principal.php?mes=$mes&ano=$ano");
	}else{
		echo "	<script type='text/javascript'>alert('Erro ao tentar salvar registro!'); location.href='../telas/principal.php?mes=$mes&ano=$ano'</script>";
	}

//-----------------------------------------------

//Encerra a Conexão

$con = null;

//-----------------

 ?>