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
$sql = "SELECT * FROM proveedor WHERE idProveedor = '$_REQUEST[proveedor]'";
$resultadoProveedor = $objConexion->query($sql);
$proveedor = $resultadoProveedor->fetch_object();
?>
<?php include '../vista/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Actualizar Proveedor
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarActualizarProveedor.php">
                            <div class="form-group">
                                <label for="proveedor">ID Proveedor</label>
                                <input name="proveedor" type="number" id="proveedor" value="<?php echo $proveedor->idProveedor ?>" readonly class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input name="nombre" type="text" id="nombre" value="<?php echo $proveedor->Nombre ?>" class="form-control" pattern="[A-Za-z ]+" title="Solo se permiten letras." required />
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefono">Teléfono</label>
                                <input name="telefono" type="number" id="telefono" style="width: 100%" value="<?php echo $proveedor->Telefono ?>" class="form-control" style="width: 50%;" required />
                            </div>
                                <div class="form-group col-md-6">
                                    <label for="direccion">Direccion</label>
                                    <input name="direccion" type="text" id="direccion" style="width: 100%" value="<?php echo $proveedor->Direccion ?>" class="form-control ml-2" style="width: 50%;" required />
                                </div>
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input name="email" type="email" id="email" value="<?php echo $proveedor->Email ?>" class="form-control" style="width: 100%;" required />
                            </div>
                                <div class="form-group col-md-6">
                                    <label for="producto">Producto</label>
                                    <input name="producto" type="text" id="producto" value="<?php echo $proveedor->id_Producto ?>" readonly class="form-control ml-2" style="width: 100%;" />
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" style="width: 100%;" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
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
</html>