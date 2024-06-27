<?php
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";
require "../modelo/Productos.php";

$objConexion = Conectarse();
$mensaje_error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_REQUEST);

    $sql_verificacion = "SELECT nomProductos FROM productos WHERE nomProductos = '$nomProductos'";
    $resultado_verificacion = $objConexion->query($sql_verificacion);

    if ($resultado_verificacion) {
        if ($resultado_verificacion->num_rows > 0) {
            $mensaje_error = "El producto '$nomProductos' ya existe."; 
        } else {
            $objProducto = new Producto();
            $objProducto->crearProducto($nomProductos, $estado, $categoria, $proveedor);

            $resultado = $objProducto->agregarProducto();

            if ($resultado) {
                header("location: listarProductos.php?x=5"); 
                exit;
            } else {
                header("location: listarProductos.php?x=6"); 
                exit;
            }
        }
    } else {
        echo "Error en la consulta: " . $objConexion->error;
        exit;
    }
}
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                
                <div class="card-body">
                    <?php if(!empty($mensaje_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje_error; ?>
                        </div>
                    <?php endif; ?>
                    <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                               