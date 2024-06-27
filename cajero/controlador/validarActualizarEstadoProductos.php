<?php
require "../modelo/db.php";
require "../modelo/Productos.php"; 
extract ($_REQUEST);
$objConexion=Conectarse();

$sql="update productos set idProductos ='$_REQUEST[idproductos]', 
Estado = '$_REQUEST[estado]'
where idProductos = '$_REQUEST[idproductos]'";

$resultado=$objConexion->query($sql);

if ($resultado)
	header("location: listarProductos.php?x=1"); 
else
	header("location: listarProductos.php?x=2"); 

?>