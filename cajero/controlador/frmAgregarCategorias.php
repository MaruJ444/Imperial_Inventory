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
                        Agregar Categoría
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarAgregarCategoria.php">
                            <div class="form-group">
                                <label for="codigo">Código de Categoría</label>
                                <input name="codigo" type="number" id="codigo" class="form-control" readonly />
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <input name="tipo" type="text" id="tipo" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" style="width: 270px" required>
                                    
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
