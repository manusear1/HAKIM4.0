<?php
header("Acess-Control-Allow-Origin: *");
session_start();

//conexão
$user = 'igndibau_nunu';
$pass = 'NauIva17';
$banco = 'igndibau_biblioteca';
$sever = 'localhost';
$conn = new mysql($server,$user,$pass,$banco);
if(!$conn){
	echo 'Erro de conexão: '.$conn->error;
}
/*Métodos do CRUD do Administrador */
function Login($email,$senha,$tipo){
	$sql = 'SELECT * FROM usuario WHERE email = "'.$email.'" AND senha "'.$senha.'"';
	$res = $GLOBALS['conn']->query($sql);
	if($res->num_rows > 0){
		$retorno['erro'] = false;
		$user = $res->fetch_object();
		$retorno['dados'] = $user;
	}else{
		$retorno['erro'] = true;
	}
	if($tipo == "json")
		return json_encode($retorno);
    else
    	return $retorno;
}
function CadastrarUsuario($rm,$nome,$email,$senha,$adm){
	$sql = 'INSERT INTO usuario (rm,nome,email,senha,adm) VALUES(null, ';
	$sql.= $rm. ',"'.$nome.'","'.$email.'","'.$senha.'","'.$adm.')';
	$destino = 'usuario/foto/'.$rm;
	if(!is_dir($destino)){
		mkdir($destino, 0777);
	}
	$res = $GLOBALS['conn']->query($sql);
	if($res)
		echo "Usuario cadastrado com sucesso!";
	else 
		echo "Erro ao cadastrar usuario";
}
function ExcluirUsuario($rm){
	$sql = 'DELETE FROM usuario WHERE rm = '.$rm;
	$res = $GLOBALS['conn']->query($sql);
	if($res)
		echo "Ecluído com sucesso!";
	else
		echo "Erro ao excluir";
}
function AtualizarUsuario($rm,$nome,$nasc,$gen,$tel){
	$sql = 'UPDATE usuario SET nome="'.$nome.'", dt_nascimento ="'.$nasc.'", genero = "'.$gen.'", telefone = "'.$tel.'" WHERE rm ='.$rm;
	$res = $GLOBALS['conn']->query($sql);
	if($res)
		echo "Atualizado com sucesso!";
	else
		echo "Erro ao atualizar";
}
function TrocarFoto($rm,$foto){
	$destino = 'usuario/fotos/'.$rm.'/'.$foto['name'];
	if(move_uploaded_file($foto['tmp_name'], $destino)){
		$sql = 'SELECT * FROM usuario WHERE rm = '.$rm;
		$res = $GLOBALS['conn']->query($sql);
		$user = $res=>fetch_array();
		unlink($user['perfil']);
		$sql = 'UPDATE usuario SET perfil = "'.$destino.'" WHERE rm ='.$rm;
		$res = $GLOBALS['conn']->query($sql);
		if($res){
			echo "Atualizado com sucesso";
		}else{
			echo "Erro ao atualizar foto";
		}
	}
}
function TrocarSenha($rm){
	$nova_senha = ""; //fazer metodo
	$sql 'SELECT * FROM usuario WHERE rm = '.$rm;
	$res = $GLOBALS['conn']->query($sql);
	$user = $res->fetch_array();
	if(mail ($user ['email'], "Biblioteca [nova senha]", $msg)){
		$sql = 'UPDATE *  senha = "'.$nova_senha.'"WHERE rm = '.$rm;
		$res = $GLOBALS['conn']->query($sql);
		if($res){
			echo "Nova senha encaminhada com sucesso";
		}else{
			echo "Erro ao trocar de senha. Tente novamente";
		}
	}
}
function CadastrarGenero($nome){
	$sql 'INSERT INTO genero VALUES(null,"'.$nome.'"")';
	$res = $GLOBALS['conn']->query($sql);
		if($res){
			echo "Gênero cadastrado";
		}else{
			echo "Erro ao cadastrar";
		}
}
function ExcluirGenero($cd){
	$sql 'DELETE FROM genero WHERE cd = '.$cd;
	$res = $GLOBALS['conn']->query($sql);
		if($res){
			echo "Gênero excluido";
		}else{
			echo "Erro ao excluir, verifique se há livros utilizando.";
		}
}
function ListarGenero($cd){
	$sql = 'SELECT * FROM genero';
	if($gen !=""){
		$sql.='WHERE cd = '.$cd;
	}
	$res = $GLOBALS['conn']->query($sql);
	return $res;
}