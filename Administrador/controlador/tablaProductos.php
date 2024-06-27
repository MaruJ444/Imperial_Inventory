<?php
require "../Modelo/db.php";
$objConexion=Conectarse();
$sql2= "select * from productos";
$resultado = $objConexion->query($sql2);
$cantidadProductos = $resultado->num_rows;

echo "<br> Cantidad de productos en la Base de Datos es: ".$cantidadProductos;
echo "<br>";
echo "<br> y sus datos son: ";
echo "<br>";
while ($producto = $resultado->fetch_object())
  {
    echo "<br> Identificacion producto: ".$producto->idproductos;
	echo "<br> Descripcion del prod: ".$producto->desripcion;
    echo "<br> Codigo venta: ".$producto->venta;
	echo "<br> Cantidad del produto: ".$producto->cantidad;
	echo "<br> id proveedor producto: ".$producto->idproveedor;	
	echo "<br>";

  }

?>