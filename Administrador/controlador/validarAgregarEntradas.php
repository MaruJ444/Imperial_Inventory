<?php

require "../modelo/db.php";
require "../modelo/Entradas.php"; 
extract ($_REQUEST);

$objEntrada = new Entrada();

$objEntrada->crearEntrada($_REQUEST['producto'], $_REQUEST['fecha_entrada'], $_REQUEST['cantidadentrada'], $_REQUEST['valoruni'], $_REQUEST['idProducto']);

$resultado = $objEntrada->agregarEntrada();

if ($resultado)
	header("location: listarEntradas.php?x=5"); 
else
	header("location: listarEntradas.php?x=6");  

?>