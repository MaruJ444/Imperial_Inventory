<?php
session_start();
if (empty($_SESSION['usuario'])) {
    header("Location: ../modelo/login.php");
    exit;
}

require_once "../modelo/db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $salidas = $_POST["salidas"];
    $fecha_salida = $_POST["fecha_salida"];

    if ($salidas <= 0) {
        header("Location: frmAgregarVentas.php?error=La cantidad de salida debe ser mayor que cero");
        exit;
    }

    $conexion = Conectarse();

    $sql_exist = "SELECT * FROM ventas WHERE Nombre_producto = ?";
    $stmt_exist = $conexion->prepare($sql_exist);
    $stmt_exist->bind_param("s", $nombre);
    $stmt_exist->execute();
    $result_exist = $stmt_exist->get_result();

    if ($result_exist->num_rows > 0) {
        $sql_insert = "INSERT INTO ventas (Nombre_producto, Salidas, Fecha_salida) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("sis", $nombre, $salidas, $fecha_salida);
        $stmt_insert->execute();
    } else {
        $sql_insert = "INSERT INTO ventas (Nombre_producto, Salidas, Fecha_salida) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("sis", $nombre, $salidas, $fecha_salida);
        $stmt_insert->execute();
    }

    $conexion->close();

    header("Location: listarVentas.php");
    exit;
}
?>
