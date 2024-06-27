<?php
require "../modelo/db.php";

$idproductos = $_POST['idproductos'];
$nomProductos = $_POST['nomProductos'];
$estado = $_POST['estado'];
$categoria = $_POST['categoria'];
$proveedor = $_POST['proveedor'];

$objConexion = Conectarse();

var_dump($_POST);

$sql = "UPDATE productos SET 
            nomProductos = '$nomProductos', 
            Estado= '$estado',
            idCategoria = '$categoria',
            IDproveedor = '$proveedor'
        WHERE idProductos = '$idproductos'";

echo $sql;

$resultado = $objConexion->query($sql);

if ($resultado) {
    header("location: listarProductos.php?x=1");  
} else {
    header("location: listarProductos.php?x=2"); 
}
?>
