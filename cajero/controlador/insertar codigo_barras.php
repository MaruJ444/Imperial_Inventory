<?php 
require_once "conexion.php";
$conexion=conectarse();

 $IDProducto = $_post['codigo'];
 $EstadoProducto = $_post['codigo'];


 $sql="INSERT into  productos (IDProducto, Descripción, Venta, Cantidad, EstadoProductos)
                         values('$IDProducto'),
                          ('$EstadoProducto')";
            $result=mysqli_query($conexion ,$sql);
     
            $id=mysqli_insert_id($conexion);
                   $codigo=$id.date('is');

            $sql="UPDATE productos set codigo='$codigo'
            where IDProducto,EstadoProducto='$id'";
             mysqli_query($conexion.$sql);

            header("Location:../index.php")
            ?>