<?php

require "../modelo/db.php";
require "../modelo/Ventas.php"; 
extract ($_REQUEST);



$objVenta = new Venta();

$objVenta->crearVenta($_REQUEST['nombre'], $_REQUEST['salidas'], $_REQUEST['fecha_salida']);

$resultado = $objVenta->agregarVenta();

if ($resultado)
	header("location: listarVentas.php?x=5"); 
else
	header("location: listarVentas.php?x=6");  

?>