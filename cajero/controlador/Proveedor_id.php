<?php
require "../modelo/db.php";
$objConexion=Conectarse();
$sql2= "select * from categoria";
$resultado = $objConexion->query($sql2);
$cantidadCategorias = $resultado->num_rows;

while ($categoria = $resultado->fetch_object())
{
	echo "<br> Codigo Categoria: ".$categoria->codigo;
    echo "<br> Tipo de la Categoria: ".$categoria->tipo;
	echo "<br> Estado de la Categoria: ".$categoria->estado;
	echo "<br>";
}
?>