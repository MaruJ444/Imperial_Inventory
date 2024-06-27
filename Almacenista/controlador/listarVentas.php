<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];


if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}
require "../modelo/db.php";
require "../modelo/Ventas.php";


$objConexion = Conectarse();
$objVenta = new Venta();
$resultado = $objVenta->consultarVenta();




?>


<?php include '../vista/header.php'; ?>


<?php
$busqueda = strtolower ($_REQUEST["busqueda"]);
if(empty($busqueda)){
    header("location: listarProductos.php");
}


?>


<form action="buscarVenta.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" name="busqueda" id="busqueda" class="form-control bg-light border-0 small" placeholder="Buscar" style="border-radius: 20px; padding: 10px 15px; border: 1px solid #ccc; font-size: 16px; transition: border-color 0.3s ease-in-out; margin-right: 10px;" value="<?php echo $busqueda; ?>">
        <div class="input-group-append">
            <input type="submit" value="Buscar" class="btn_search" style="background-color: #007bff; border: none; color: white; border-radius: 20px; padding: 10px 20px; cursor: pointer; transition: background-color 0.3s ease-in-out;">
            <i class="fa-solid fa-magnifying-glass" style="margin-left: -35px; color: #6c757d;"></i>
        </div>
    </div>
</form>

                <div class="container">
                    <h1 align="center">LISTAR VENTAS</h1>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Venta</th>
                                <th>Nombre Producto </th>
                                <th>Salida</th>
                                <th>Fecha salida</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($venta = $resultado->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?php echo $venta->idVentas ?></td>
                                    <td><?php echo $venta->Nombre_producto ?></td>
                                    <td><?php echo $venta->Salidas ?></td>
                                    <td><?php echo $venta->Fecha_salida ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="frmAgregarVentas.php" class="btn btn-primary">Agregar Venta</a>
                </div>
            </div>
           
        </div>
    </div>
</div>