<?php
require "../modelo/db.php";
require "../modelo/Proveedor.php"; 
extract ($_REQUEST);
$objConexion=Conectarse();

$sql="update proveedor set idProveedor ='$_REQUEST[proveedor]', 
Nombre = '$_REQUEST[nombre]',
Telefono = '$_REQUEST[telefono]',
Direccion = '$_REQUEST[direccion]',
Email = '$_REQUEST[email]',
id_Producto = '$_REQUEST[producto]'
Estado = '$_REQUEST[estado]'


where idProveedor = '$_REQUEST[proveedor]'";

$resultado=$objConexion->query($sql);

if ($resultado)
	header("location: listarProveedores.php?x=1");  
else
	header("location: listarProveedores.php?x=2"); 

?> 