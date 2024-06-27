<?php

require "../modelo/db.php";
require "../modelo/Productos.php"; 
extract ($_REQUEST);

$objProducto = new Producto();

$objProducto->crearProducto($_REQUEST['nomProductos'], $_REQUEST['cantidad'], $_REQUEST['estado'], $_REQUEST['precio'],  $_REQUEST['categoria'],  $_REQUEST['proveedor'] );

$resultado = $objProducto->agregarProducto();

if ($resultado)
	header("location: listarProductos.php?x=5"); 
else
	header("location: listarProductos.php?x=6");  

?>
