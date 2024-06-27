<?php
require "../modelo/db.php";
require "../modelo/Proveedor.php";

$nombre = $_REQUEST['nombre'];
$telefono = $_REQUEST['telefono'];
$direccion = $_REQUEST['direccion'];
$email = $_REQUEST['correo'];
$producto = $_REQUEST['producto'];
$estado = $_REQUEST['estado'];


$objProveedor = new Proveedor();

$objProveedor->crearProveedor($nombre, $telefono, $direccion, $email, $producto, $estado);

$resultado = $objProveedor->agregarProveedor();

if ($resultado) {
    header("location: listarProveedores.php?x=5");
} else {
    header("location: listarProveedores.php?x=6");
}  
?>
