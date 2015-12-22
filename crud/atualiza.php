<?php

//Busca o Arquivo  de conexão e verificação de Login

include "../config/conexao.php";
include "../config/verifica_sessao.php";

//------------------------

//Variáveis//
if (isset($_GET['mesp'])) {
	$mesp = $_GET['mesp'];
}else{
	$mesp = @date('m');
}

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
	echo "	<script type='text/javascript'>alert('Selecione um tipo!'); location.href='../telas/editar.php?mes=$mesp&ano=$ano&id=$id';</script>";
	return false;
}

if (!empty($_POST['descricao'])){
	$desc = $_POST['descricao'] ;
}else{
	echo "<script type='text/javascript'>alert('Descrição em branco!'); location.href='../telas/editar.php?mes=$mesp&ano=$ano&id=$id';</script>";
	return false;
}

if (!empty($_POST['valor'])){
	$valor = $_POST['valor'] ;
}else{
	echo "<script type='text/javascript'>alert('Insira um valor!'); location.href='../telas/editar.php?mes=$mesp&ano=$ano&id=$id';</script>";
	return false;
}

  if(isset($_POST['mes'])){
    for($i = 0; $i < count($_POST['mes']); $i++) {
        $ano = $_POST['ano'];
        $tipo = $_POST['tipo'] ;
        $desc = $_POST['descricao'] ;
        $valor = $_POST['valor'] ;
        $usuario = $_SESSION['usuario'];
        $mes[$i]=$_POST['mes'][$i];
        $data[$i] = "$ano-$mes[$i]-01";
        
      $sql = $con->prepare("UPDATE receitas_despesas SET tipo = :tipo, descricao = :descricao, data = :data, valor = :valor WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->bindValue(":tipo",$tipo);
        $sql->bindValue(":descricao",$desc);
        $sql->bindValue(":data",$data[$i]);
        $sql->bindValue(":valor",$valor);
        $sql->execute();
        
        header("location: ../telas/principal.php?mesp=$mesp&ano=$ano");
    }
	}else{
       echo   "<script type='text/javascript'>alert('Selecione o Mês!'); location.href='../telas/editar.php?mesp=$mesp&ano=$ano&id=$id'</script>";
   }



//--------------------------------------------------------

//Editando dados na tabela



//------------------------------------------------------------------------------------

//Fechando a Conexão
	$con = null;
//------------------
 ?>