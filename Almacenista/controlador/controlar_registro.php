<?php
require_once("../modelo/db.php");

if (isset($_POST["registrarse"])) {
    $conexion = Conectarse();

    if (empty($_POST["idUsuario"]) || empty($_POST["Nom_usuario"]) || empty($_POST["Ape_usuario"]) || empty($_POST["Rol"]) || empty($_POST["Password"])) {
        echo 'Uno de los campos está vacío';
    } else {
        $idUsuario = $_POST["idUsuario"];
        $Nom_usuario = $_POST["Nom_usuario"];
        $Ape_usuario = $_POST["Ape_usuario"];
        $Rol = $_POST["Rol"];
        $Password = md5( $_POST["Password"]);

        $stmt = $conexion->prepare("INSERT INTO usuarios (idUsuarios, Nom_usuario, Ape_usuario, Rol, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $idUsuario, $Nom_usuario, $Ape_usuario, $Rol, $Password);

        if ($stmt->execute()) {
            echo 'Usuario registrado correctamente. Puedes iniciar sesión ahora.';
        } else {
            echo 'Error al registrar el usuario. Por favor, inténtalo nuevamente.';
        }

        $stmt->close();
    }

    $conexion->close();
}
?>