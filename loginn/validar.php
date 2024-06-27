<?php
session_start();

if (isset($_SESSION['usuario'])) {
    
    $Rol = $_SESSION['Rol'];
    if ($Rol == '1') {
        header("Location: ../Administrador/modelo/inicio.php");
        exit;
    } elseif ($Rol == '2') {
        header("Location: ../Almacenista/modelo/inicio.php");
        exit;
    } else if ($Rol == '3') {
        header("Location: ../cajero/modelo/inicio.php");
        exit;
    }
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conexion = Conectarse();

    $consulta = "SELECT * FROM usuarios WHERE Nom_usuario = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        if (password_verify($password, $fila['Password'])) {
            $_SESSION['usuario'] = $fila['Nom_usuario'];
            $_SESSION['Rol'] = $fila['Rol']; 

            if ($fila['Rol'] == '1') {
                header("Location: ../Administrador/modelo/inicio.php");
                exit;
            } elseif ($fila['Rol'] == '2') {
                header("Location: ../Almacenista/modelo/inicio.php");
                exit;
            }
            elseif ($fila['Rol'] == '3') {
                header("Location: ../cajero/modelo/inicio.php");
                exit;
            }
        } else {
            $mensaje = "Usuario o contraseña incorrectos.";
        }
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }

    header("Location: login.php?error=" . urlencode($mensaje));
    exit;
} else {
    header("Location: login.php");
    exit;
}







/*

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conexion = Conectarse();

    $consulta = "SELECT * FROM usuarios WHERE Nom_usuario = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        if (password_verify($password, $fila['Password'])) {
            $_SESSION['usuario'] = $fila['Nom_usuario'];
            header("Location: ../Administrador/modelo/inicio.php");
            exit;
        } else {
            $mensaje = "Usuario o contraseña incorrectos.";
        }
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }

    header("Location: login.php?error=" . urlencode($mensaje));
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>
*/