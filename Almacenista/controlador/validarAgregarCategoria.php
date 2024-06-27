<?php
require "../modelo/db.php";
require "../modelo/Categoria.php"; 
extract ($_REQUEST);

$objCategoria = new Categoria();

$objCategoria->crearCategoria( $_REQUEST['tipo'], $_REQUEST['estado']);

$resultado = $objCategoria->agregarCategoria();


if ($resultado)
	header("location: listarCategorias.php?x=5"); 
else
	header("location: listarCategorias.php?x=6");  

?>