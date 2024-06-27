<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";
require "../modelo/Entradas.php";

$objConexion = Conectarse();
$objEntrada = new Entrada();

$resultado = $objEntrada->consultarEntrada();
?>

<?php include '../vista/header.php'; ?>

<div class="container">
    <h1 align="center"> LISTAR ENTRADAS</h1>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID Entrada</th>
                <th>Producto</th>
                <th>Fecha entrada</th>
                <th>Cantidad entrada</th>
                <th>Valor unitario</th>
                <th>Valor total</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            while ($entrada = $resultado->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $entrada->idEntrada ?></td>
                    <td><?php echo $entrada->Producto ?></td>
                    <td><?php echo $entrada->Fecha_entrada ?></td>
                    <td><?php echo $entrada->Cant_entrada ?></td>
                    <td><?php echo $entrada->Valor_unitario ?></td>
                    <td><?php echo $entrada->Valor_totalentrada ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="text-center mt-3">
        <a href="../controlador/frmAgregarEntradas.php" class="btn btn-primary">Agregar Entrada</a>
    </div>
</div>
</body>

</html>