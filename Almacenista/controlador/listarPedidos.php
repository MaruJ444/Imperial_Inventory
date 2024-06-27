<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}
require "../modelo/db.php";
require "../modelo/Pedido.php";

$objConexion = Conectarse();
$objPedido = new Pedido();
$resultado = $objPedido->consultarPedido();
?>
<?php include '../vista/header.php'; ?>

                <div class="container">
                    <h1 align="center">LISTAR PEDIDOS</h1>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Nombre Pedido</th>
                                <th>Cantidad</th>
                                <th>ID Proveedor</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($pedido = $resultado->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?php echo $pedido->idPedido ?></td>
                                    <td><?php echo $pedido->id_Productos?></td>
                                    <td><?php echo $pedido->Cantidad ?></td>
                                    <td><?php echo $pedido->idProveedor?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="frmAgregarPedidos.php" class="btn btn-primary">Agregar Pedido</a>
                </div>
            </div>
            
    </div>
</div>