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
$idVenta = $_REQUEST['idventas'];
$sql = "SELECT * FROM ventas WHERE idVentas = '$idVenta'";
$resultadoVenta = $objConexion->query($sql);
$venta = $resultadoVenta->fetch_object();

include '../vista/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Actualizar Venta
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarActualizarVenta.php">
                            <div class="form-group">
                                <label for="idventas">ID Venta</label>
                                <input name="idventas" type="number" id="idventas" value="<?php echo $venta->idVentas ?>" readonly class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input name="nombre" type="text" id="nombre" value="<?php echo $venta->Nombre ?>" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="salidas">Salidas</label>
                                <input name="salidas" type="number" id="salidas" value="<?php echo $venta->Salidas ?>" class="form-control" required oninput="validarNumerosPositivos(this);"/>
                            </div>
                            <div class="form-group">
                                <label for="fecha_salida">Fecha salida</label>
                                <input name="fecha_salida" type="date" id="fecha_salida" value="<?php echo $venta->Fecha_salida ?>" readonly class="form-control" required />
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
