<?php 
include('biblioteca.php');
?>
<h1> Olá <?php $_SESSION['nome']; ?></h1>

<form id="novoGenero">
	<fieldset>
		<legend>Novo Gênero</legend>
		Nome: <input type="text" name="genero"><br>
		<button>Cadastrar</button>
	</fieldset>
</form>
<?php
if ($_POST['genero']){
	CadastrarGenero($_POST['genero']);
	}
?>
<h1>Gêneros Cadastrados</h1>
<table>
	<tr>
		<td>Nome</td>
		<td>#</td>

	</tr>
	<?php 
	$todos = ListarGenero("");
	while ($gen = $todos->fetch_object()) {
		echo '<tr>
				<td>'.$gen->nome.'</td>
					<a href="?excluir_gen'.$gen->cd.'">Excluir</a>
					</td>
				</tr>';}
?>
</table>