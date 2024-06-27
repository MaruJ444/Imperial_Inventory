<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require_once "../modelo/db.php";

$conexion = Conectarse();

$sql = "SELECT 
p.idProductos,                    
p.nomProductos,                 
SUM(e.Cant_entrada) AS Cant_entrada,          
MIN(e.Fecha_entrada) AS Fecha_entrada,         
COALESCE(v.Salidas, 0) AS Salidas,                     
MIN(v.Fecha_salida) AS Fecha_salida,             
(CASE WHEN SUM(e.Cant_entrada) >= COALESCE(v.Salidas, 1)
      THEN SUM(e.Cant_entrada) - COALESCE(v.Salidas, 0)
      ELSE 0
 END) AS Saldo  
FROM 
productos p
LEFT JOIN 
(SELECT Producto, Fecha_entrada, Cant_entrada FROM entradas) e ON p.nomProductos = e.Producto
LEFT JOIN 
(SELECT Nombre_producto, SUM(Salidas) AS Salidas, MIN(Fecha_salida) AS Fecha_salida FROM ventas GROUP BY Nombre_producto) v ON p.nomProductos = v.Nombre_producto
GROUP BY 
p.idProductos, p.nomProductos";


$resultado = $conexion->query($sql);

include '../vista/header.php';
?>

<div class="container">
    <h1 align="center">LISTAR INVENTARIO</h1>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre Producto</th>
                <th>Fecha Entrada</th>
                <th>Cantidad Entrada</th>
                <th>Fecha Salida</th>
                <th>Cantidad Salida</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = $resultado->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $producto['idProductos']; ?></td>
                    <td><?php echo $producto['nomProductos']; ?></td>
                    <td><?php echo $producto['Fecha_entrada']; ?></td>
                    <td><?php echo $producto['Cant_entrada']; ?></td>
                    <td><?php echo $producto['Fecha_salida']; ?></td>
                    <td><?php echo $producto['Salidas']; ?></td>
                    <td><?php echo $producto['Saldo']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
$conexion->close();
?>