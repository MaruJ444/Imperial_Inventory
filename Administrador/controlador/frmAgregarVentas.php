<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

$mensajeError = ""; 
$mensajeExito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $idventas = $_POST["idventas"];
    $nombreProducto = $_POST["nombre"];
    $salidas = $_POST["salidas"];
    $fechaSalida = $_POST["fecha_salida"];

    $fechaSalidaInput = strtotime($fechaSalida);
    $fechaActual = time();
    if ($fechaSalidaInput < $fechaActual) {
        $mensajeError .= "La fecha de salida no puede ser anterior a la fecha actual.<br>";
    }

    require "../modelo/db.php";
    $conexion = Conectarse();

    $sqlSaldo = "SELECT COALESCE(SUM(e.Cant_entrada), 0) - COALESCE(v.Salidas, 0) AS Saldo
                 FROM productos p
                 LEFT JOIN (SELECT Producto, Cant_entrada FROM entradas) e ON p.nomProductos = e.Producto
                 LEFT JOIN (SELECT Nombre_producto, SUM(Salidas) AS Salidas FROM ventas GROUP BY Nombre_producto) v ON p.nomProductos = v.Nombre_producto
                 WHERE p.nomProductos = '$nombreProducto'";
    $resultadoSaldo = $conexion->query($sqlSaldo);
    $saldoDisponible = 0;
    if ($filaSaldo = $resultadoSaldo->fetch_assoc()) {
        $saldoDisponible = $filaSaldo["Saldo"];
    }

    if ($salidas > $saldoDisponible) {
        $mensajeError .= "La cantidad de salida ingresada es mayor que el saldo disponible del producto.<br>";
    } else {
        
        $sqlInsertarVenta = "INSERT INTO ventas (idventas, Nombre_producto, Salidas, Fecha_salida)
                             VALUES ('$idventas', '$nombreProducto', '$salidas', '$fechaSalida')";
        if ($conexion->query($sqlInsertarVenta) === TRUE) {
            $mensajeExito = "La venta se ha agregado correctamente.";
        } else {
            $mensajeError .= "Error al agregar la venta: " . $conexion->error . "<br>";
        }
    }

    $conexion->close();
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
                        <?php if(isset($mensajeError) && !empty($mensajeError)) echo '<div class="alert alert-danger">' . $mensajeError . '</div>'; ?>
                        <?php if(isset($mensajeExito)) echo '<div class="alert alert-success">' . $mensajeExito . '</div>'; ?>
                        <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
                                        echo '<option value="' . $producto->nomProductos . '">' . $producto->nomProductos . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="salidas">Salida </label>
                                    <input name="salidas" type="number" id="salidas" class="form-control" required oninput="validarNumerosPositivos(this);" />
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

    document.getElementById('form1').addEventListener('submit', function(event) {
        var fechaSalidaInput = document.getElementById('fecha_salida').value;
        var fechaSalida = new Date(fechaSalidaInput);
        var fechaActual = new Date();

        if (fechaSalida < fechaActual) {
            alert('La fecha de salida no puede ser anterior a la fecha actual.');
            event.preventDefault();
            return false;
        }
        
        var salidas = document.getElementById('salidas').value;
        var saldoDisponible = <?php echo $saldoDisponible; ?>;

        if (parseInt(salidas) > parseInt(saldoDisponible)) {
            alert('La cantidad de salida ingresada es mayor que el saldo disponible del producto.');
            event.preventDefault();
            return false;
        }
        
        return true;
    });
</script>
