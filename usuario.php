<?php
header("Acess-Control-Allow-Origin: *");
include('biblioteca.php');

if($_POST){
	if(isset($_POST['cadastro'])){
		CadastrarUsuario($_POST['rm'],$_POST['nome'],$_POST['email'],$_POST['senha'],$_POST['adm']);
	}
	else if(isset($_POST['atualizar'])){
		AtualizarUsuario($_POST['rm'],$_POST['nome'],$_POST['nasc'],$_POST['genero'],$_POST['tel']);
	}
	else if(isset($_FILES['foto'])){
		TrocarFoto($rm,$_FILES['foto']);
	}
	else if (isset($_POST['trocarSenha'])){
		TrocarSenha($_POST['rm']);{
	}
	else if (isset($_POST['login']) && isset($_POST['senha'])){
		Login($email,$senha,$_POST['tipo']);
	}
}
	else if($_GET){
		if(isset($_GET['excluir'])){
		ExcluirUsuario($_GET['excluir']);
	}
}