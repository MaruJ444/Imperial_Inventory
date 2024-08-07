<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}
require "../modelo/db.php";
require "../modelo/Productos.php";

$objConexion = Conectarse();
$objProducto = new Producto();
$resultado = $objProducto->consultarProductos();

?>
<?php include '../vista/header.php'; ?>
<?php
$busqueda = strtolower($_REQUEST["busqueda"]);
if (empty($busqueda)) {
    header("location: listarProductos.php");
}

?>


<div class="container">
    <h1 align="center">LISTAR PRODUCTOS</h1>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Proveedor</th>
                <th>Estado Productos</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($producto = $resultado->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $producto->idProductos ?></td>
                    <td><?php echo $producto->nomProductos ?></td>
                    <td><?php echo $producto->idCategoria ?></td>
                    <td><?php echo $producto->IDproveedor ?></td>
                    <td><?php echo $producto->Estado ?></td>
                    <td align="center">
                        <a href="frmActualizarProductos.php?idproductos=<?php echo $producto->idProductos ?>">
                            <img src="../Imagenes/xd.jpg" width="29" height="24" />
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="text-center mt-3">
    <a href="frmAgregarProducto.php" class="btn btn-primary">Agregar Producto</a>
</div>
</div>

</html>