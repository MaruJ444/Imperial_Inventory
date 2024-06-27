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




<form action="buscarPedido.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" name="busqueda" id="busqueda" class="form-control bg-light border-0 small" placeholder="Buscar" style="border-radius: 20px; padding: 10px 15px; border: 1px solid #ccc; font-size: 16px; transition: border-color 0.3s ease-in-out; margin-right: 10px;" value="<?php echo $busqueda; ?>">
        <div class="input-group-append">
            <input type="submit" value="Buscar" class="btn_search" style="background-color: #007bff; border: none; color: white; border-radius: 20px; padding: 10px 20px; cursor: pointer; transition: background-color 0.3s ease-in-out;">
            <i class="fa-solid fa-magnifying-glass" style="margin-left: -35px; color: #6c757d;"></i>
        </div>
    </div>
</form>

                <div class="container">
                    <h1 align="center">LISTAR PEDIDOS</h1>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Nombre Pedido</th>
                                <th>Cantidad</th>
                                <th>ID Proveedor</th>
                                <th>editar</th>

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
                                    <td><?php echo $pedido->idProveedor ?></td>
                                    <td align="center">
                                        <a href="frmActualizarPedidos.php?idpedido=<?php echo $pedido->idPedido ?>">
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
                    <a href="frmAgregarPedidos.php" class="btn btn-primary">Agregar Pedido</a>
                </div>
            </div>
            
    </div>
</div>