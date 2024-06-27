<?php
require "../modelo/db.php";
extract ($_REQUEST);

$objConexion = Conectarse();
$sql="delete from proveedor where idProveedor = '$_REQUEST[proveedor]'";
$resultado = $objConexion->query($sql);

if ($resultado)
	header("location: listarProveedores.php?x=3");  
else
	header("location: listarProveedores.php?x=4");  
?>