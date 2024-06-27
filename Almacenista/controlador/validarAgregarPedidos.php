<?php

require "../modelo/db.php";
require "../modelo/Pedido.php";


$producto = $_REQUEST['producto'];
$cantidad = $_REQUEST['cantidad'];
$proveedor = $_REQUEST['proveedor'];


$objPedido = new Pedido();

$objPedido->crearPedido($producto, $cantidad, $proveedor);

$resultado = $objPedido->agregarPedido();

if ($resultado)
	header("location: listarPedidos.php?x=5");
else
	header("location: listarPedidos.php?x=6");
