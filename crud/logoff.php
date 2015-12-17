<?php 

session_start();

unset($_SESSION['usuario']);
unset($_SESSION['senha']);
session_destroy();
echo "	<script type='text/javascript'>alert('Deslogado!'); location.href='../index.html';</script>";

 ?>