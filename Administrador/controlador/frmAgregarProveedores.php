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
                        Agregar Proveedor
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarAgregarProveedor.php">
                            <div class="form-group">
                                <label for="proveedor">ID Proveedor</label>
                                <input name="proveedor" type="number" id="proveedor" required class="form-control" readonly />
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input name="nombre" type="text" id="nombre" required class="form-control" pattern="[A-Za-z ]+" title="Solo se permiten letras."/>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefono">Teléfono</label>
                                <input name="telefono" type="number" id="telefono" style="width: 100%" class="form-control" pattern="[0-9]{10}" title="El teléfono debe contener 10 dígitos numéricos" checkdate required oninput="validarTelefono(this);" />
                            </div>
                                <div class="form-group col-md-6">
                                    <label for="correo">Email</label>
                                    <input name="correo" type="email" id="correo" required style="width: 100%" class="form-control" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="El correo electrónico debe tener un formato válido" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input name="direccion" type="text" id="direccion" required class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="producto">ID Producto</label>
                                <select name="producto" id="producto" style="width: 100%" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    require "../modelo/db.php";
                                    $objConexion = Conectarse();
                                    $sql = "SELECT idEntrada, Producto FROM entradas"; 
                                    $resultado = $objConexion->query($sql);
                                    while ($producto = $resultado->fetch_object()) {
                                    ?>
                                        <option value="<?php echo $producto->Producto; ?>"><?php echo $producto->Producto; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
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
</body>
<script>
    function validarNumerosPositivos(input) {
        input.value = input.value.replace(/\D/g, '');
        if (input.value < 1) {
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

    function validarTelefono(input) {
        // Eliminar espacios en blanco y caracteres no numéricos
        var telefono = input.value.replace(/\D/g, '');
        // Validar que tenga al menos 10 caracteres numéricos
        if (telefono.length < 10) {
            input.setCustomValidity('El teléfono debe contener al menos 10 dígitos numéricos.');
        } else {
            input.setCustomValidity('');
        }
    }
</script>
