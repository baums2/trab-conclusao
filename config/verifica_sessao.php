<?php 

session_start();

if (!isset($_SESSION['usuario']) AND !isset($_SESSION['senha'])) {
	
	//Destroi a Sessão

	session_destroy();

	//Limpa os dados da Sessão

	unset($_SESSION['usuario']);
	unset($_SESSION['senha']);

	//Redireciona para tela de Login

	echo "	<script type='text/javascript'>alert('Acesso Negado!!!'); location.href='../index.html';</script>";
}

 ?>