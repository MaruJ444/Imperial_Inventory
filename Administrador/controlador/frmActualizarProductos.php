<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}
require "../Modelo/db.php";
extract($_REQUEST);
$objConexion = Conectarse();
$sql = "SELECT * FROM productos WHERE idProductos = '$_REQUEST[idproductos]'";
$resultadoProducto = $objConexion->query($sql);
$producto = $resultadoProducto->fetch_object();

$sql_categorias = "SELECT Cod_Categoria, Tipo FROM categoria";
$resultado_categorias = $objConexion->query($sql_categorias);

$sql_proveedores = "SELECT idProveedor, Nombre FROM proveedor";
$resultado_proveedores = $objConexion->query($sql_proveedores);
?>
<?php include '../vista/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Actualizar Producto
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarActualizarProducto.php">
                            <div class="form-group">
                                <label for="idproductos">ID Producto</label>
                                <input name="idproductos" type="text" id="idproductos" value="<?php echo $producto->idProductos ?>" readonly class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="nomProductos">Nombre</label>
                                <input name="nomProductos" type="text" id="nomProductos" value="<?php echo $producto->nomProductos ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="Activo" <?php if ($producto->Estado == 'Activo') echo 'selected="selected"'; ?>>Activo</option>
                                    <option value="Inactivo" <?php if ($producto->Estado == 'Inactivo') echo 'selected="selected"'; ?>>Inactivo</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="categoria">Categoría</label>
                                    <select name="categoria" id="categoria" class="form-control" required>
                                        <?php while ($categoria = $resultado_categorias->fetch_object()) { ?>
                                            <option value="<?php echo $categoria->Tipo; ?>" <?php if ($categoria->Cod_Categoria == $producto->idCategoria) echo 'selected="selected"'; ?>><?php echo $categoria->Tipo; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="proveedor">Proveedor</label>
                                    <select name="proveedor" id="proveedor" class="form-control" required>
                                        <?php while ($proveedor = $resultado_proveedores->fetch_object()) { ?>
                                            <option value="<?php echo $proveedor->Nombre; ?>" <?php if ($proveedor->idProveedor == $producto->idProveedor) echo 'selected="selected"'; ?>><?php echo $proveedor->Nombre; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
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
