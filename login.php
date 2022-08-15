<form id="entrar" method="post">
	Usuário:
	<input type="text" name="login" id="login">
	<br>
	Senha:
	<input type="text" name="senha" id="senha">
	<br>
	<button> Entrar </button>
</form> 
<?php
session_start();
include('biblioteca.php');
if($_POST) {
	$resultado = Login($_POST['login'], $_POST['senha'], "");
	if($resultado['erro']){
		echo "Usuário e/ou senha inválido";
	}else{
		$user = $resultado['dados'];
		if($user->status == 'bloqueado'){
			echo "Usuário bloqueado";
		}else{
		echo "Usuário existe";
		$user = $resultado['dados'];
		$_SESSION['rm'] = $user->rm;
		$_SESSION['nome'] = $user->nome;
		$_SESSION['email'] = $user->email;
		$_SESSION['senha'] = $user->senha;
		$_SESSION['perfil'] = $user->perfil;
		$_SESSION['status'] = $user->status;
		$_SESSION['adm'] = $user->adm;
		//redireciona o usuário para a pag adm
		header('location: home.php');
		}
	}

}