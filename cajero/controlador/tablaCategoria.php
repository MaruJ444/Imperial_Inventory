<?php
require "../modelo/db.php";
$objConexion=Conectarse();
$sql2= "select * from categoria";
$resultado = $objConexion->query($sql2);
$cantidadCategorias = $resultado->num_rows;

echo "<br> Cantidad de categorias en la Base de Datos es: ".$cantidadCategorias;
echo "<br>";
echo "<br> y sus datos son: ";
echo "<br>";
while ($categoria = $resultado->fetch_object())
  {
    echo "<br> Codigo categoria: ".$categoria->Cod_Categoria;
    echo "<br> Tipo de la Categoria: ".$categoria->Tipo;
	  echo "<br> Estado de la categoria: ".$categoria->Estado;
	  echo "<br>";

  }

?>