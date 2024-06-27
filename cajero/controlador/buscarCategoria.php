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

$busqueda = isset($_REQUEST["busqueda"]) ? strtolower($_REQUEST["busqueda"]) : "";
if(empty($busqueda)){
    header("location: listarCategorias.php");
    exit;
}

$query = "SELECT Cod_Categoria, Tipo, Estado FROM categoria 
          WHERE Cod_Categoria LIKE '%$busqueda%' OR
          Tipo LIKE '%$busqueda%' OR
          Estado LIKE '%$busqueda%' ";

$resultado = mysqli_query($objConexion, $query);

include '../vista/header.php';
?>

<div class="container">
  
<form action="buscarCategoria.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" name="busqueda" id="busqueda" class="form-control bg-light border-0 small" placeholder="Buscar" style="border-radius: 20px; padding: 10px 15px; border: 1px solid #ccc; font-size: 16px; transition: border-color 0.3s ease-in-out; margin-right: 10px;" value="<?php echo $busqueda; ?>">
        <div class="input-group-append">
            <input type="submit" value="Buscar" class="btn_search" style="background-color: #007bff; border: none; color: white; border-radius: 20px; padding: 10px 20px; cursor: pointer; transition: background-color 0.3s ease-in-out;">
            <i class="fa-solid fa-magnifying-glass" style="margin-left: -35px; color: #6c757d;"></i>
        </div>
    </div>
</form>

                
<h1 align="center">LISTAR CATEGORIAS </h1>
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th width="10 %">Codigo categoria</th>
        <th width="15%">Tipo de categoria</th>
        <th width="12%">Estado </th>
        <th width="15%">Editar </th>
        <th width="9%">Cambiar Estado</th>
        
      </tr>
    </thead>
    <tbody>
      <?php
        while ($categoria = mysqli_fetch_assoc($resultado)) {
      ?>
      <tr>
        <td><?php echo $categoria['Cod_Categoria']; ?></td>
        <td><?php echo $categoria['Tipo']; ?></td>
        <td><?php echo $categoria['Estado']; ?></td>
        <td align="center">
          <a href="frmActualizarCategorias.php?categoria=<?php echo $categoria['Cod_Categoria']; ?>">
            <img src="../Imagenes/xd.jpg" width="29" height="24" />
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
  <a href="../controlador/listarCategorias.php" class="btn btn-primary">Volver</a>
</div>