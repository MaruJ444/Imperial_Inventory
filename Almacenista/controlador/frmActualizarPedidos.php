<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";
extract($_REQUEST);
$objConexion = Conectarse();
$sql = "SELECT * FROM pedido WHERE idPedido = '$_REQUEST[idpedido]'";
$resultadoPedido = $objConexion->query($sql);
$pedido = $resultadoPedido->fetch_object();
?>

<?php include '../vista/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Actualizar Pedido
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarActualizarPedidos.php">
                            <div class="form-group">
                                <label for="idpedido">ID Pedido</label>
                                <input name="idpedido" type="number" id="idpedido" value="<?php echo $pedido->idPedido ?>" readonly class="form-control"  />
                            </div>
                            <div class="form-group">
                                <label for="idproductos">ID Producto</label>
                                <input name="idproductos" type="number" id="idproductos" value="<?php echo $pedido->nomProductos ?>" readonly class="form-control"  />
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input name="cantidad" type="number" id="cantidad" value="<?php echo $pedido->Cantidad ?>" class="form-control" required oninput="validarNumerosPositivos(this);"/>
                            </div>
                            <div class="form-group">
                                <label for="idproveedor">ID Proveedor</label>
                                <input name="idproveedor" type="number" id="idproveedor" value="<?php echo $pedido->idProveedor ?>" readonly class="form-control"  />
                            </div>
                            <div class="text-center">
                                <input type="submit" name="button" id="button" value="Actualizar" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validarNumerosPositivos(input) {
        input.value = input.value.replace(/\D/g, '');
        if (input.value < 0) {
            input.value = '';
        }
    }

    window.onload = function() {
        document.getElementById('form1').addEventListener('submit', function() {
            window.onbeforeunload = null;
        });

        if (!<?php echo isset($_POST['button']) ? 'true' : 'false'; ?>) {
            window.onbeforeunload = function() {
                return "¿Está seguro que desea salir de la vista de actualizar pedido?";
            };
        }
    };
</script>
