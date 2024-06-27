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
$sql = "SELECT * FROM categoria WHERE Cod_Categoria = '$_REQUEST[codigo]'";
$resultadoCategoria = $objConexion->query($sql);
$categoria = $resultadoCategoria->fetch_object();

$formularioEnviado = isset($_POST['button']) && $_POST['button'] === 'Actualizar'; // Verifica si el formulario fue enviado
?>
<?php include '../vista/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Actualizar Categoría
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarActualizarCategoria.php">
                            <div class="form-group">
                                <label for="codigo">Código de Categoría</label>
                                <input name="codigo" type="text" id="codigo" value="<?php echo $categoria->Cod_Categoria ?>" readonly class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo de Categoría</label>
                                <input name="tipo" type="text" id="tipo" value="<?php echo $categoria->Tipo ?>" class="form-control" required />
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
        if (!<?php echo $formularioEnviado ? 'true' : 'false'; ?>) {
            window.onbeforeunload = function() {
                return "¿Está seguro que desea salir de la vista de actualizar categoría?";
            };
        }

        document.getElementById('form1').addEventListener('submit', function() {
            window.onbeforeunload = null;
        });
    };
</script>
