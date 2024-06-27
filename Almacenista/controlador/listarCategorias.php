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


<form action="buscarCategoria.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" name="busqueda" id="busqueda" class="form-control bg-light border-0 small" placeholder="Buscar" style="border-radius: 20px; padding: 10px 15px; border: 1px solid #ccc; font-size: 16px; transition: border-color 0.3s ease-in-out; margin-right: 10px;" value="<?php echo $busqueda; ?>">
        <div class="input-group-append">
            <input type="submit" value="Buscar" class="btn_search" style="background-color: #007bff; border: none; color: white; border-radius: 20px; padding: 10px 20px; cursor: pointer; transition: background-color 0.3s ease-in-out;">
            <i class="fa-solid fa-magnifying-glass" style="margin-left: -35px; color: #6c757d;"></i>
        </div>
    </div>
</form>


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