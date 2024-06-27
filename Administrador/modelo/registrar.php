<?php
require_once("../modelo/db.php");

$mensaje = '';
$mensajeClase = '';

if (isset($_POST["registrarse"])) {
    $conexion = Conectarse();
    $idUsuario = $_POST["idUsuario"];
    $Nom_usuario = $_POST["Nom_usuario"];
    $Ape_usuario = $_POST["Ape_usuario"];
    $Rol = $_POST["Rol"];
    $Password = $_POST["Password"];

    if (empty($idUsuario) || empty($Nom_usuario) || empty($Ape_usuario) || empty($Rol) || empty($Password)) {
        $mensaje = "Uno de los campos está vacío";
        $mensajeClase = "alert-danger";
    } else {
        if (strlen($idUsuario) < 5 || strlen($idUsuario) > 10) {
            $mensaje = "El ID de usuario debe tener entre 5 y 10 caracteres.";
            $mensajeClase = "alert-danger";
        } elseif (strlen($Password) < 8) {
            $mensaje = "La contraseña debe tener al menos 8 caracteres.";
            $mensajeClase = "alert-danger";
        } else {
            $stmt_check = $conexion->prepare("SELECT idUsuarios FROM usuarios WHERE idUsuarios = ?");
            $stmt_check->bind_param("s", $idUsuario);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows > 0) {
                $mensaje = "El ID de usuario ya está en uso. Por favor, elige otro.";
                $mensajeClase = "alert-danger";
                $stmt_check->close(); 
            } else {
                if (!preg_match("/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/", $Nom_usuario)) {
                    $mensaje = "El nombre no puede contener números.";
                    $mensajeClase = "alert-danger";
                } elseif (!preg_match("/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/", $Ape_usuario)) {
                    $mensaje = "El apellido no puede contener números.";
                    $mensajeClase = "alert-danger";
                } else {
                    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
                    $stmt = $conexion->prepare("INSERT INTO usuarios (idUsuarios, Nom_usuario, Ape_usuario, Rol, Password) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $idUsuario, $Nom_usuario, $Ape_usuario, $Rol, $hashedPassword);

                    if ($stmt->execute()) {
                        $mensaje = "Usuario registrado correctamente.";
                        $mensajeClase = "alert-success";
                    } else {
                        $mensaje = "Error al registrar el usuario. Por favor, inténtalo nuevamente.";
                        $mensajeClase = "alert-danger";
                    }
                    $stmt->close(); 
                }
            }
        }
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
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../vista/header.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div id="registro-box" class="col-12 col-md-8 col-lg-6">
                <h2 class="text-center mb-4">Registrar nuevo usuario</h2>
                <?php if (!empty($mensaje)): ?>
                    <div class="alert <?php echo $mensajeClase; ?>"><?php echo $mensaje; ?></div>
                <?php endif; ?>
                <form class="needs-validation" action="../modelo/registrar.php" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="idUsuario" class="form-label">ID de Usuario:</label>
                        <input type="number" id="idUsuario" name="idUsuario" class="form-control" required oninput="validarid(this);" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label for="Nom_usuario" class="form-label">Nombre:</label>
                        <input type="text" id="Nom_usuario" name="Nom_usuario" class="form-control" required pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="No se permiten números en el nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="Ape_usuario" class="form-label">Apellido:</label>
                        <input type="text" id="Ape_usuario" name="Ape_usuario" class="form-control" required pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="No se permiten números en el apellido" required>
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
                        <a href="../controlador/listarUsuarios.php" class="btn btn-primary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validarid(input) {
            if (input.value < 1) {
                input.value = '';
            }
        }
    </script>
</body>
</html>
