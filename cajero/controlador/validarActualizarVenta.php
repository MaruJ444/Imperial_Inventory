<?php
require "../modelo/db.php";
require "../modelo/Ventas.php"; 
extract($_REQUEST);
$objConexion = Conectarse();
$sql = "UPDATE ventas SET 
		idVentas ='$_REQUEST[idventas]', 
        Nombre = '$_REQUEST[nombre]',
		Salidas = '$_REQUEST[salidas]',
		Fecha_salida = '$_REQUEST[fecha_salida]'

        WHERE idVentas = '$_REQUEST[idventas]'";
$resultado = $objConexion->query($sql);
if ($resultado) {
    header("location: listarVentas.php?x=1"); 
} else {
    header("location: listarVentas.php?x=2"); 
}
?>
