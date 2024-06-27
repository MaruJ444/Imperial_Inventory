<?php
require "../modelo/db.php";
require "../modelo/Pedido.php"; 
extract($_REQUEST);
$objConexion = Conectarse();
$sql = "UPDATE pedido SET 
		idPedido ='$_REQUEST[idpedido]', 
		idProveedor = '$_REQUEST[idproveedor]',
		Cantidad = '$_REQUEST[cantidad]',
        id_Producto = '$_REQUEST[id_producto]'

        WHERE idPedido = '$_REQUEST[idpedido]'";
$resultado = $objConexion->query($sql);
if ($resultado) {
    header("location: listarPedidos.php?x=1"); 
} else {
    header("location: listarPedidos.php?x=2"); 
}
?>