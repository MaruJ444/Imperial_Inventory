<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}
require "../modelo/db.php";
require "../modelo/Categoria.php";

$objConexion = Conectarse();
$objCategoria = new Categoria();

$resultado = $objCategoria->consultarCategorias();
?>
<?php include '../vista/header.php'; ?>

<?php
$busqueda = strtolower($_REQUEST["busqueda"]);
if (empty($busqueda)) {
    header("location: listarCategorias.php");
}

?>
<div class="container">
    <h1 align="center"> LISTAR CATEGORIAS</h1>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Codigo de Categoria</th>
                <th>Tipo Categoria</th>
                <th>Estado Categoria</th>
                <th>Editar</th>
                <th>Cambio estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($categoria = $resultado->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $categoria->Cod_Categoria ?></td>
                    <td><?php echo $categoria->Tipo ?></td>
                    <td><?php echo $categoria->Estado ?></td>
                    <td align="center">
                        <a href="frmActualizarCategorias.php?codigo=<?php echo $categoria->Cod_Categoria ?>">
                            <img src="../Imagenes/xd.jpg" width="29" height="24" />
                        </a>
                    </td>
                    <td align="center">
                        <a href="frmCambioestadoCategorias.php?codigo=<?php echo $categoria->Cod_Categoria ?>">
                            <img src="../Imagenes/eliminar.jpg" width="29" height="24" />
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="text-center mt-3">
    <a href="../controlador/frmAgregarCategorias.php" class="btn btn-primary">Agregar Categoria</a>
</div>