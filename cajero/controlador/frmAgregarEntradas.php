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
                        Agregar Entrada
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="validarAgregarEntradas.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="identrada">ID Entrada</label>
                                    <input name="identrada" type="text" id="identrada" class="form-control" readonly />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="producto">ID Producto</label>
                                    <input name="producto" id="producto" style="width: 100%" class="form-control" />
                                    <input type="hidden" name="idProducto" id="idProducto">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_entrada">Fecha Entrada</label>
                                    <input name="fecha_entrada" type="datetime-local" id="fecha_entrada" class="form-control" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cantidadentrada">Cantidad entrada</label>
                                    <input name="cantidadentrada" type="number" id="cantidadentrada" class="form-control" required oninput="validarNumerosPositivos(this)" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="valoruni">Valor unitario</label>
                                    <input name="valoruni" type="number" id="valoruni" class="form-control" required oninput="validarNumerosPositivos(this)" />
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

        document.getElementById('form1').addEventListener('submit', function(event) {
            var fechaEntradaInput = document.getElementById('fecha_entrada').value;
            var fechaEntrada = new Date(fechaEntradaInput);
            var fechaActual = new Date();

            if (fechaEntrada <= fechaActual) {
                alert('La fecha de salida no puede ser anterior a la fecha actual.');
                event.preventDefault();
            }
        });
    };
</script>
