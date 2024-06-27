<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";
require "../modelo/Usuario.php";

$objConexion = Conectarse();
$objUsuario = new Usuario();

$resultado = $objUsuario->consultarUsuario();
?>

<?php include '../vista/header.php'; ?>

<div class="container">
    <h1 align="center"> LISTAR USUARIOS</h1>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Nombre usuario</th>
                <th>Apellido usuario</th>
                <th>Rol</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($usuario = $resultado->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $usuario->idUsuarios ?></td>
                    <td><?php echo $usuario->Nom_usuario ?></td>
                    <td><?php echo $usuario->Ape_usuario ?></td>
                    <td><?php echo $usuario->Rol ?></td>
                    <td align="center">
                        <a href="frmActualizarUsuario.php?idusuario=<?php echo $usuario->idUsuarios ?>">
                            <img src="../Imagenes/xd.jpg" width="29" height="24" />
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="text-center mt-3">
        <a href="../modelo/registrar.php" class="btn btn-primary">Agregar Usuario</a>
    </div>
</div>
</body>

</html>
