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
$sql = "SELECT * FROM productos WHERE idProductos = '$_REQUEST[idproductos]'";
$resultadoProducto = $objConexion->query($sql);
$producto = $resultadoProducto->fetch_object();
?>
<?php include '../vista/header.php'; ?>


</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Cambiar Estado Producto
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarActualizarEstadoProductos.php">
                            <div class="form-group">
                                <label for="idproductos">ID Producto</label>
                                <input name="idproductos" type="text" id="idproductos" value="<?php echo $producto->idproductos ?>" readonly class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" style="width: 270px">
                                    <?php
                                    if ($producto->Estado == "Activo") {
                                    ?>
                                        <option value="Activo" selected="selected">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo" selected="selected">Inactivo</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" name="button" id="button" value="Actualizar" class="btn btn-success" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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