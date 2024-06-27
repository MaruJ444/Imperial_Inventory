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
                        Agregar Ventas
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarAgregarVentas.php">
                            <div class="form-group">
                                <label for="idventas">ID Venta</label>
                                <input name="idventas" type="number" id="idventas" class="form-control" readonly />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre del Producto </label>
                                <select name="nombre" id="nombre" style="width: 100%" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    require "../modelo/db.php";
                                    $objConexion = Conectarse();
                                    $sql = "SELECT idProductos, nomProductos FROM productos";


                                    $resultado = $objConexion->query($sql);
                                    while ($producto = $resultado->fetch_object()) {
                                    ?>
                                        <option value="<?php echo $producto->nomProductos ?>"><?php echo $producto->nomProductos ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="salidas">Salida </label>
                                    <input name="salidas" type="number" id="salidas" class="form-control" checkdate required oninput="validarNumerosPositivos(this);" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_salida">Fecha Salida</label>
                                    <input name="fecha_salida" type="datetime-local" id="fecha_salida" class="form-control" required />
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
            }
        }
    }
    window.onload = function() {
        document.getElementById('form1').addEventListener('submit', function(event) {
            var fechaSalidaInput = document.getElementById('fecha_salida').value;
            var fechaSalida = new Date(fechaSalidaInput);
            var fechaActual = new Date();


            if (fechaSalida < fechaActual) {
                alert('La fecha de salida no puede ser anterior a la fecha actual.');
                event.preventDefault();
            }
        });
    };
</script>