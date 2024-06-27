<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}
?>

<?php include '../vista/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Agregar Pedidos
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarAgregarPedidos.php">
                            <div class="form-group">
                                <label for="idpedido">ID Pedido</label>
                                <input name="idpedido" type="number" id="idpedido" class="form-control" readonly />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="producto">Producto</label>
                                <select name="producto" id="producto" style="width: 100%" class="form-control">
                                    <option value="0">Seleccione</option>
                                    <?php
                                    require "../modelo/db.php";
                                    $objConexion = Conectarse();
                                    $sql_productos = "SELECT idProductos, nomProductos FROM productos";
                                    $resultado_productos = $objConexion->query($sql_productos);
                                    while ($producto = $resultado_productos->fetch_object()) {
                                    ?>
                                        <option value="<?php echo $producto->nomProductos ?>"><?php echo $producto->nomProductos ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cantidad">Cantidad</label>
                                    <input name="cantidad" type="number" id="cantidad" class="form-control" checkdate required oninput="validarNumerosPositivos(this);" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="proveedor">Proveedor</label>
                                    <select name="proveedor" id="proveedor" style="width: 100%" class="form-control">
                                        <option value="0">Seleccione</option>
                                        <?php
                                        $sql_proveedores = "SELECT idProveedor, Nombre FROM proveedor";
                                        $resultado_proveedores = $objConexion->query($sql_proveedores);
                                        while ($proveedor = $resultado_proveedores->fetch_object()) {
                                        ?>
                                            <option value="<?php echo $proveedor->Nombre ?>"><?php echo $proveedor->Nombre ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="button" id="button" value="Enviar" class="btn btn-success" />
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
