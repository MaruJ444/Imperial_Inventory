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
$objProveedor = new Proveedor();
$resultado = $objProveedor->consultarProveedores();
?>

<?php include '../vista/header.php'; ?>





        <div class="container">
          <h1 align="center">LISTAR PROVEEDORES</h1>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="10%">Código de Proveedor</th>
                <th width="15%">Nombre</th>
                <th width="12%">Teléfono </th>
                <th width="15%">Dirección </th>
                <th width="20%">Email </th>
                <th width="15%">Código Producto</th>
                <th width="9%">Estado proveedor</th>
                <th width="9%">Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($proveedor = $resultado->fetch_object()) {
              ?>
                <tr>
                  <td><?php echo $proveedor->idProveedor ?></td>
                  <td><?php echo $proveedor->Nombre ?></td>
                  <td><?php echo $proveedor->Telefono ?></td>
                  <td><?php echo $proveedor->Direccion ?></td>
                  <td><?php echo $proveedor->Email ?></td>
                  <td><?php echo $proveedor->id_Producto ?></td>
                  <td><?php echo $proveedor->Estado ?></td>

                  <td align="center">
                    <a href="frmActualizarProveedores.php?proveedor=<?php echo $proveedor->idProveedor ?>">
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
          <a href="../controlador/frmAgregarProveedores.php" class="btn btn-primary">Agregar Proveedor</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</html>