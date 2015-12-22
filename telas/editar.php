<?php

//Busca o Arquivo  de conexão e verificação de Login

include "../config/conexao.php";
include "../config/verifica_sessao.php";

//-------------------------- 

//Variaveis

if (isset($_GET['mesp'])) {
	$mesp = $_GET['mesp'];
}else{
	$mesp = @date('m');
}

if (isset($_SESSION['usuario'])) {
	$usuario = $_SESSION['usuario'];
}

if (isset($_GET['ano'])) {
	$ano = $_GET['ano'];
}else{
	$ano = @date('Y');
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else{
	header("location:principal.php?mesp=$mesp&ano=$ano");
}



//ARRAY para renomear os Mêses
$titulo = array(1 =>'JAN', 2 =>'FEV', 3 =>'MAR', 4 =>'ABR',5 =>'MAI', 6 =>'JUN', 7 =>'JUL', 8 =>'AGO', 9 =>'SET',
10 =>'OUT', 11 =>'NOV', 12 =>'DEZ', );

$data = "$ano-$mesp-01";

//Iniciando os Acomuladores
$tdespesa=0;
$treceita=0;
$greceita=0;
$gdespesa=0;

//---------------------------------

//Seleciona todos as receitas conforme o ano
$sqlr = $con->prepare("SELECT * FROM receitas_despesas WHERE data = :data AND tipo = 're' AND usuario = :usuario");
$sqlr->bindvalue(":data",$data);
$sqlr->bindvalue(":usuario",$usuario);
$sqlr->execute();

//---------------------------------

//Seleciona todas as despesas conforme o ano
$sqld = $con->prepare("SELECT * FROM receitas_despesas WHERE data = :data AND tipo = 'de' AND usuario = :usuario");
$sqld->bindvalue(":data",$data);
$sqld->bindvalue(":usuario",$usuario);
$sqld->execute();

//--------------------------------

//Seleciona todas as receitas do ano

$tr = $con->prepare("SELECT * FROM receitas_despesas WHERE year(data) = :data AND tipo = 're' AND usuario = :usuario");
$tr->bindvalue("data",$ano);
$tr->bindvalue(":usuario",$usuario);
$tr->execute();

//Seleciona todas as despesas do ano

$td = $con->prepare("SELECT * FROM receitas_despesas WHERE year(data) = :data AND tipo = 'de' AND usuario = :usuario");
$td->bindvalue("data",$ano);
$td->bindvalue(":usuario",$usuario);
$td->execute();

//-----------------------------------

//Selecio o registro a ser editado conforme o ID

$rg = $con->prepare("SELECT * FROM receitas_despesas WHERE id = :id");
$rg->bindvalue("id",$id);
$rg->execute();

?>

<!-- Scripta para atualizar a página quando um ano for selecionado -->
<script>


var pagina = '../telas/principal.php?mesp='; 
window.onload = function(){
    document.getElementById('ano').onchange = function(){
        window.location = pagina + '&ano=' + this.value;
    }
}
</script>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerenciador Financeiro</title>
    
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-responsive.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    
    <script src="../bootstrap/jquery.min.js"></script>
    <script src="../bootstrap/bootstrap.js" ></script>
</head>

<body>
    <div class="row-fluid">  
    <div class="span11" id="fundo">  
    <h1 id="h">Controle FInanceiro</h1>
    <div class="row-fluid">  
    <div class="span10" id="fundo1">
            <nav role="navigation" class="navbar navbar-default">

           <div class="navbar-header">
               <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">

                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>

               </button>
                    
           </div>

            <div id="navbarCollapse" class="collapse navbar-collapse">
               <ul class="nav navbar-nav">
                     <li><a href="principal.php?mesp=1&ano=<?php echo $ano;?>">Janeiro</a></li>
                   <li><a href="principal.php?mesp=2&ano=<?php echo $ano;?>">Fevereiro</a></li>
                   <li><a href="principal.php?mesp=3&ano=<?php echo $ano;?>">Março</a></li>
                   <li><a href="principal.php?mesp=4&ano=<?php echo $ano;?>">Abril</a></li>
                   <li><a href="principal.php?mesp=5&ano=<?php echo $ano;?>">Maio</a></li>
                   <li><a href="principal.php?mesp=6&ano=<?php echo $ano;?>">Junho</a></li>
                   <li><a href="principal.php?mesp=7&ano=<?php echo $ano;?>">Julho</a></li>
                   <li><a href="principal.php?mesp=8&ano=<?php echo $ano;?>">Agosto</a></li>
                   <li><a href="principal.php?mesp=9&ano=<?php echo $ano;?>">Setembro</a></li>
                   <li><a href="principal.php?mesp=10&ano=<?php echo $ano;?>">Outubro</a></li>
                   <li><a href="principal.php?mesp=11&ano=<?php echo $ano;?>">Novembro</a></li>
                   <li><a href="principal.php?mesp=12&ano=<?php echo $ano;?>">Dezembro</a></li>
               </ul>
            </div>

    </div>  
        <div class="span2"  id="fundo2">
           Usuário: <?php echo $_SESSION['usuario'] ?>
           <a href="../crud/logoff.php"><img src="../img/logof.png" id="logoff"></a>
           <br>
           <select onchange="location.replace('?mesp=<?php echo $mesp?>&ano='+this.value)" style="margin-top: 12px" id="selano">
                    <?php
                    for ($i=2015;$i<=2025;$i++){
                    ?>
                    <option value="<?php echo $i?>" <?php if ($i==$ano) echo "selected=selected"?> ><?php echo $i?></option>
                    <?php }?>
                </select>
        </div>  
    </div>  
    </div>  
</div> 
    <div class="row-fluid">
      <div class="span11" id="corpo">
          <div class="span9"><h1 style="margin-left: 10px"><h1 style="color: #6D6B6B"><?php echo $titulo[$mesp]."/".$ano;?></h1></h1></div>
           <a href="../telas/adicionar.php?mesp=<?php echo $mesp; ?>&ano=<?php echo $ano; ?>"><div class="span2" id="addbt">[+] Adicionar Movimento</div></a>
      </div>
    </div>
    <hr>

    <div class="row-fluid">
      <div class="span11">
          
        <!-- Formulário de edição do registro -->
          <div class="container-fluid" id="edita">
              <?php while($dados = $rg->fetch(PDO::FETCH_ASSOC)) {?>  
                <legend><strong><?php echo "Editar - ".utf8_encode($dados['descricao']); ?></strong></legend>

                
            <form action="../crud/atualiza.php?id=<?php echo $id ?>" method="POST">
              
              <strong>Data:</strong><br>
                Mês: <select name="mes">
                  <option value="<?php echo $mesp; ?>"><?php echo $titulo[$mesp]; ?></option>
                  <option value="1">JAN</option>
                  <option value="2">FEV</option>
                  <option value="3">MAR</option>
                  <option value="4">ABR</option>
                  <option value="5">MAI</option>
                  <option value="6">JUN</option>
                  <option value="7">JUL</option>
                  <option value="8">AGO</option>
                  <option value="9">SET</option>
                  <option value="10">OUT</option>
                  <option value="11">NOV</option>
                  <option value="12">DEZ</option>
                  </select> /
                Ano: <input type="number" name="ano" value="<?php echo $ano; ?>" id="tamanho">
              <strong> | Tipo:</strong>
              <input type="radio" name="tipo" value="re"> <strong style="color: green">Receita</strong>
              <input type="radio" name="tipo" value="de"> <strong style="color: red">Despesa</strong><br><br>
              <strong>Descrição:</strong><input type="text" name="descricao" value="<?php echo utf8_encode($dados['descricao']);?>" id="tamanhod"><br><br>
              <strong>Valor:</strong> R$ <input type="number" name="valor" value="<?php echo $dados['valor'];?>"><br><br>
              <input type="submit" name="" value="Alterar">
              <a href="../crud/exclui.php?mesp=<?php echo $mesp; ?>&ano=<?php echo $ano; ?>&id=<?php echo $id ?>" id="font1" style="margin-left: 8px; color: red">[Excluir]</a>
            </form>
          <?php } ?>
          </div>
      </div>
    </div>
    <br><br><br>
    <div class="row-fluid">
        <div class="span11" id="lista">
            <h2 style="margin-left: 10px; color: #6D6B6B">Movimentações do Mês</h2>
	
				<table border = solid id="table">

					<!-- Lista as RECEITAS do mes correspondente -->
					<?php while ($dados = $sqlr->fetch(PDO::FETCH_ASSOC)){ $treceita = $treceita+$dados['valor'];?>
					<tr bgcolor="E1DCDC" width="100%" style="color: green">
						<td><?php echo utf8_encode($dados['descricao']); ?></td>
						<td width="10%"><a href="editar.php?mesp=<?php echo $mesp; ?>&ano=<?php echo $ano; ?>&id=<?php echo $dados['id']; ?>">[editar]</a></td>
						<td width="10%"><?php echo $dados['tipo'] = "Receita"; ?></td>
						<td width="10%" align="right">R$ <?php echo $dados['valor']; ?></td>
					</tr >
					<?php } ?>
		
					<!-- Lista as DESPESAS do mes correspondente -->
					<?php while ($dados = $sqld->fetch(PDO::FETCH_ASSOC)){ $tdespesa = $tdespesa+$dados['valor'];?>
					<tr bgcolor="#F2EEEE" style="color: red";>
						<td><?php echo utf8_encode($dados['descricao']); ?></td>
						<td width="10%"><a href="editar.php?mesp=<?php echo $mesp; ?>&ano=<?php echo $ano; ?>&id=<?php echo $dados['id']; ?>">[editar]</a></td>
						<td width="10%"><?php echo $dados['tipo'] = "Despesa"; ?></td>
						<td width="10%" align="right">R$ <?php echo $dados['valor']; ?></td>
					</tr>
					<?php } ?>
				</table>
				<hr>
        </div>
    </div>
    
        <div class="row-fluid">
            <div class="span11">
                <div class="span5" >
                   
                  <div class="container-fluid" id="exibem">
            					<legend>Balanço Mensal</legend>
            					<h4 style="margin-top: -5px;">
                					<strong style="color: green">Receitas: R$ <?php echo $treceita; ?></strong><br>
                                <strong style="color: red">Despesas: R$ <?php echo $tdespesa; ?></strong>
                                <hr>
                                    <strong style="color: green">Saldo: R$</strong> <?php $total = $treceita-$tdespesa; 
                                    if ($total >= 0) {
                                      echo "<strong style='color: green'>$total</strong>";
                                    }else{
                                      echo "<strong style='color: red'>$total</strong>";
                                    }
                            ?>
                      </h4>
				        </div>
                </div>

           <div class="row-fluid">
                <div class="span5 offset1" >
                   
                  <div class="container-fluid" id="exibea">
                      <legend>Balanço Anual</legend>
                      <h4 style="margin-top: -5px;">
                          <?php while ($dados = $tr->fetch(PDO::FETCH_ASSOC)) $greceita = $greceita+$dados['valor']; {?>  
                              <strong style="color: green">Receitas: R$ <?php echo $greceita; ?></strong><br>
                              <?php } ?>

                              <?php while ($dados = $td->fetch(PDO::FETCH_ASSOC)) $gdespesa = $gdespesa+$dados['valor']; {?>
                              <strong style="color: red">Despesas: R$ <?php echo $gdespesa; ?> </strong>
                              <?php } ?>
                              <hr>
                              <strong style="color: green">Saldo: R$</strong> <?php $total = $treceita-$tdespesa; 
                                if ($total >= 0) {
                                  echo "<strong style='color: green'>$total</strong>";
                                }else{
                                  echo "<strong style='color: red'>$total</strong>";
                                }
                          ?>
                      </h4>
                </div>
                </div>
        </div>
        </div>
        </div>

        <footer>
          <div class="row-fluid">
            <div class="span12"><hr></div>
          </div>
        </footer>

</body>
</html>