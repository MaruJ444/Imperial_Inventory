<?php
require_once("../modelo/db.php");

if (isset($_POST["registrarse"])) {
    $conexion = Conectarse();
    $idUsuario = $_POST["idUsuario"];
    $Nom_usuario = $_POST["Nom_usuario"];
    $Ape_usuario = $_POST["Ape_usuario"];
    $Rol = $_POST["Rol"];
    $Password = $_POST["Password"];

    if (empty($idUsuario) || empty($Nom_usuario) || empty($Ape_usuario) || empty($Rol) || empty($Password)) {
        echo '<script>alert("Uno de los campos está vacío");</script>';
    } else {
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("INSERT INTO usuarios (idUsuarios, Nom_usuario, Ape_usuario, Rol, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $idUsuario, $Nom_usuario, $Ape_usuario, $Rol, $hashedPassword);

        if ($stmt->execute()) {
            echo '<script>alert("Usuario registrado correctamente.");</script>';
        } else {
            echo '<script>alert("Error al registrar el usuario. Por favor, inténtalo nuevamente.");</script>';
        }
        $stmt->close();
    }
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <?php include '../vista/header.php'; ?>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div id="registro-box" class="col-12 col-md-8 col-lg-6">
                <h2 class="text-center mb-4">Registrar nuevo usuario</h2>
                <form class="needs-validation" action="../modelo/registrar.php" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="idUsuario" class="form-label">ID de Usuario:</label>
                        <input type="number" id="idUsuario" name="idUsuario" class="form-control" required oninput="validarid(this);">
                    </div>
                    <div class="mb-3">
                        <label for="Nom_usuario" class="form-label">Nombre:</label>
                        <input type="text" id="Nom_usuario" name="Nom_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Ape_usuario" class="form-label">Apellido:</label>
                        <input type="text" id="Ape_usuario" name="Ape_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Rol" class="form-label">Rol:</label>
                        <select id="Rol" name="Rol" class="form-control" required>
                            <option value="1">Administrador</option>
                            <option value="2">Almacenista</option>
                            <option value="3">Cajero</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Contraseña:</label>
                        <input type="password" id="Password" name="Password" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" value="registrar" name="registrarse">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function validarid(input) {
        if (input.value < 1) {
            input.value = '';
        }
    }
</script>
</body>
</html>
