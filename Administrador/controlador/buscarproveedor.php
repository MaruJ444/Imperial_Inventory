<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];
if (empty($usuario)) {
  header("Location: ../modelo/login.php");
  exit;
}
require "../modelo/db.php";
require "../modelo/Proveedor.php";

$objConexion = Conectarse();

$busqueda = isset($_REQUEST["busqueda"]) ? strtolower($_REQUEST["busqueda"]) : "";
if(empty($busqueda)){
    header("location: listarProveedores.php");
    exit;
}

$query = "SELECT idProveedor, Nombre, Telefono, Direccion, Email, id_Producto FROM proveedor 
          WHERE idProveedor LIKE '%$busqueda%' OR
                Nombre LIKE '%$busqueda%' OR
                Telefono LIKE '%$busqueda%' OR
                Direccion LIKE '%$busqueda%' OR
                Email LIKE '%$busqueda%' OR
                id_Producto LIKE '%$busqueda%'";

$resultado = mysqli_query($objConexion, $query);

include '../vista/header.php';
?>

<div class="container">
  
<form action="buscarproveedor.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" name="busqueda" id="busqueda" class="form-control bg-light border-0 small" placeholder="Buscar" style="border-radius: 20px; padding: 10px 15px; border: 1px solid #ccc; font-size: 16px; transition: border-color 0.3s ease-in-out; margin-right: 10px;" value="<?php echo $busqueda; ?>">
        <div class="input-group-append">
            <input type="submit" value="Buscar" class="btn_search" style="background-color: #007bff; border: none; color: white; border-radius: 20px; padding: 10px 20px; cursor: pointer; transition: background-color 0.3s ease-in-out;">
            <i class="fa-solid fa-magnifying-glass" style="margin-left: -35px; color: #6c757d;"></i>
        </div>
    </div>
</form>

                
<h1 align="center">LISTAR PROVEEDORES</h1>
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th width="10%">Código de Proveedor</th>
        <th width="15%">Nombre</th>
        <th width="12%">Teléfono </th>
        <th width="20%">Dirección </th>
        <th width="15%">Email </th>
        <th width="10%">Código Producto</th>
        <th width="9%">Editar</th>
        
      </tr>
    </thead>
    <tbody>
      <?php
        while ($proveedor = mysqli_fetch_assoc($resultado)) {
      ?>
      <tr>
        <td><?php echo $proveedor['idProveedor']; ?></td>
        <td><?php echo $proveedor['Nombre']; ?></td>
        <td><?php echo $proveedor['Telefono']; ?></td>
        <td><?php echo $proveedor['Direccion']; ?></td>
        <td><?php echo $proveedor['Email']; ?></td>
        <td><?php echo $proveedor['id_Producto']; ?></td>
        <td align="center">
          <a href="frmActualizarProveedores.php?proveedor=<?php echo $proveedor['idProveedor']; ?>">
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
  <a href="../controlador/listarProveedores.php" class="btn btn-primary">Volver</a>
</div>