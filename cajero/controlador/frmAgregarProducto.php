<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";
$objConexion = Conectarse();

$sql_categoria = "SELECT Cod_Categoria, Tipo FROM categoria";
$resultado_categoria = $objConexion->query($sql_categoria);

$sql_proveedor = "SELECT idProveedor, Nombre FROM proveedor";
$resultado_proveedor = $objConexion->query($sql_proveedor);
?>

<?php include '../vista/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Agregar Producto
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarAgregarProducto.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="idproductos">ID Producto</label>
                                    <input name="idproductos" type="text" id="idproductos" class="form-control" readonly />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomProductos">Nombre</label>
                                    <select name="nomProductos" id="nomProductos" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        <?php
                                        $sql_productos = "SELECT DISTINCT Producto FROM entradas";
                                        $resultado_productos = $objConexion->query($sql_productos);
                                        while ($producto = $resultado_productos->fetch_object()) {
                                            echo "<option value='{$producto->Producto}'>{$producto->Producto}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cantidad">Cantidad</label>
                                    <input name="cantidad" type="number" id="cantidad" class="form-control" required oninput="validarNumerosPositivos(this)" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="precio">Precio</label>
                                    <input name="precio" type="money" id="precio" class="form-control" required oninput="validarNumerosPositivos(this)" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="categoria">ID Categoria</label>
                                    <select name="categoria" id="categoria" style="width: 100%" class="form-control" required>
                                        <option value="0">Seleccione</option>
                                        <?php while ($categoria = $resultado_categoria->fetch_object()) { ?>
                                            <option value="<?php echo $categoria->Tipo ?>"><?php echo $categoria->Tipo ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="proveedor">ID Proveedor</label>
                                    <select name="proveedor" id="proveedor" style="width: 100%" class="form-control" required>
                                        <option value="0">Seleccione</option>
                                        <?php while ($proveedor = $resultado_proveedor->fetch_object()) { ?>
                                            <option value="<?php echo $proveedor->Nombre ?>"><?php echo $proveedor->Nombre ?></option>
                                        <?php } ?>
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
