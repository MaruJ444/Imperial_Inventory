<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];


if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}
require "../modelo/db.php";
require "../modelo/Ventas.php";


$objConexion = Conectarse();
$objVenta = new Venta();
$resultado = $objVenta->consultarVenta();
?>
<?php include '../vista/header.php'; ?>

                <div class="container">
                    <h1 align="center">LISTAR VENTAS</h1>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Venta</th>
                                <th>Nombre Producto </th>
                                <th>Salida</th>
                                <th>Fecha salida</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($venta = $resultado->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?php echo $venta->idVentas ?></td>
                                    <td><?php echo $venta->Nombre_producto ?></td>
                                    <td><?php echo $venta->Salidas ?></td>
                                    <td><?php echo $venta->Fecha_salida ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="frmAgregarVentas.php" class="btn btn-primary">Agregar Venta</a>
                </div>
            </div>
           
        </div>
    </div>
</div>
