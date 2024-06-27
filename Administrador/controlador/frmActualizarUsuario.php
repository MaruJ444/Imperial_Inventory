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
$sql = "SELECT * FROM usuarios WHERE idUsuarios = '$_REQUEST[idusuario]'";
$resultadoUsuario = $objConexion->query($sql);
$usuario = $resultadoUsuario->fetch_object();
?>
<?php include '../vista/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Actualizar Datos usuario
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarActualizarUsuario.php">

                            <div class="form-group">
                                <label for="nom_usuario">Nombre usuario</label>
                                <input name="nom_usuario" type="text" id="nom_usuario" value="<?php echo $usuario->Nom_usuario ?>" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="ape_usuario">Apellido usuario</label>
                                <input name="ape_usuario" type="text" id="ape_usuario" value="<?php echo $usuario->Ape_usuario ?>" class="form-control" style="width: 270px" />
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