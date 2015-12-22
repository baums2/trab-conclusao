<?php 

//Busca o Arquivo  de conexão e verificação de Login

include "../config/conexao.php";
include "../config/verifica_sessao.php";

//------------------------

//Variaveis

if(isset($_GET['mesp'])){
    $mesp = $_GET['mesp'];
}

if(isset($_GET['amo'])){
    $ano = $_GET['ano'];
}

if (isset($_POST['tipo'])) {
	$tipo = $_POST['tipo'] ;
}else{
	echo "	<script type='text/javascript'>alert('Selecione um tipo!'); location.href='../telas/adicionar.php?mes=$mes&ano=$ano';</script>";
	return false;
}

if (!empty($_POST['descricao'])){
	$desc = $_POST['descricao'] ;
}else{
	echo "<script type='text/javascript'>alert('Descrição em branco!'); location.href='../telas/adicionar.php?mes=$mes&ano=$ano';</script>";
	return false;
}

if (!empty($_POST['valor'])){
	$valor = $_POST['valor'] ;
}else{
	echo "<script type='text/javascript'>alert('Insira um valor!'); location.href='../telas/adicionar.php?mes=$mes&ano=$ano';</script>";
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
        
        $sql = $con->prepare("INSERT INTO receitas_despesas VALUES (null, :usuario, :tipo, :descricao, :data, :valor)");
        $sql->bindvalue(":usuario",$usuario);
        $sql->bindvalue(":tipo",$tipo);
        $sql->bindvalue(":descricao",$desc);
        $sql->bindvalue(":data",$data[$i]);
        $sql->bindvalue(":valor",$valor);
        $sql->execute();
        
        header("location: ../telas/principal.php?mesp=$mesp&ano=$ano");
    }
	}else{
       echo   "<script type='text/javascript'>alert('Selecione o Mês!'); location.href='../telas/principal.php?mes=$mes&ano=$ano'</script>";
   }

//------------------------------------

//Adiciona os registros no  banco de dados



//Confere se o registro foi incluido no sistema

	if ($sql->rowcount() > 0) {
		header("location: ../telas/principal.php?mesp=$mesp&ano=$ano");
	}else{
		echo "	<script type='text/javascript'>alert('Erro ao tentar salvar registro!'); location.href='../telas/principal.php?mesp=$mesp&ano=$ano'</script>";
	}

//-----------------------------------------------

//Encerra a Conexão

$con = null;

//-----------------

 ?>