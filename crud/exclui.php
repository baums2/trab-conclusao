<?php 

//Busca o Arquivo  de conexão e verificação de Login

include "../config/conexao.php";
include "../config/verifica_sessao.php";

//------------------------

// Variaveis

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

if (isset($_GET['mes'])) {
	$mes = $_GET['mes'];
}

if (isset($_GET['ano'])) {
	$ano = $_GET['ano'];
}else{
	$ano = @date('Y');
}
//-------------------------

// Exclui o egistro
$sql = $con->prepare("DELETE FROM receitas_despesas WHERE id = :id");
$sql->bindvalue("id",$id);
$sql->execute();

header("location:../telas/principal.php?mes=$mes&ano=$ano");

//Fecha conexão

$con = null;

//-------------
?>