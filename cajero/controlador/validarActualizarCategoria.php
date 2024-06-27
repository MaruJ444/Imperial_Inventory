<?php
require "../modelo/db.php";
require "../modelo/Categoria.php"; 
extract($_REQUEST);
$objConexion = Conectarse();
$sql = "UPDATE categoria 
        SET Cod_Categoria ='$_REQUEST[codigo]', 
            Tipo = '$_REQUEST[tipo]'
        WHERE Cod_Categoria = '$_REQUEST[codigo]'";
$resultado = $objConexion->query($sql);
if ($resultado) {
    header("location: listarCategorias.php?x=1"); 
} else {
    header("location: listarCategorias.php?x=2"); 
}
?>
