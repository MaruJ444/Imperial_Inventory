<?php
error_reporting(0);
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";
require "../modelo/Productos.php"; 

$objConexion = Conectarse();

$sql_categoria = "SELECT Cod_Categoria, Tipo FROM categoria";
$resultado_categoria = $objConexion->query($sql_categoria);

$sql_proveedor = "SELECT idProveedor, Nombre FROM proveedor";
$resultado_proveedor = $objConexion->query($sql_proveedor);

$mensaje_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_REQUEST);
    $sql_verificacion = "SELECT nomProductos FROM productos WHERE nomProductos = '$nomProductos'";
    $resultado_verificacion = $objConexion->query($sql_verificacion);

    if ($resultado_verificacion) {
        if ($resultado_verificacion->num_rows > 0) {
            $mensaje_error = "El producto '$nomProductos' ya existe."; // Mensaje de error
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
        $mensaje_error = "Error en la consulta: " . $objConexion->error; // Mensaje de error
    }
}
?>

<?php include '../vista/header.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Agregar Producto
                </div>
                <div class="card-body">
                    <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="idproductos">ID Producto</label>
                                <input name="idproductos" type="text" id="idproductos" style="width: 100%" class="form-control" readonly />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nomProductos">Nombre</label>
                                <select name="nomProductos" id="nomProductos" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    $sql_productos = "SELECT DISTINCT Producto FROM entradas";
                                    $resultado_productos = $objConexion->query($sql_productos);
                                    while ($producto = $resultado_productos->fetch_object()) {
                                        echo "<option value='{$producto->Producto}'>{$producto->Producto}</option>";
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo $mensaje_error; ?></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="categoria">ID Categoria</label>
                                <select name="categoria" id="categoria" style="width: 100%" class="form-control" required>
                                    <option value="0">Seleccione</option>
                                    <?php while ($categoria = $resultado_categoria->fetch_object()) { ?>
                                        <option value="<?php echo $categoria->Tipo ?>"><?php echo $categoria->Tipo ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="proveedor">ID Proveedor</label>
                                <select name="proveedor" id="proveedor" style="width: 100%" class="form-control" required>
                                    <option value="0">Seleccione</option>
                                    <?php while ($proveedor = $resultado_proveedor->fetch_object()) { ?>
                                        <option value="<?php echo $proveedor->Nombre ?>"><?php echo $proveedor->Nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="button" id="button" value="Enviar" class="btn btn-success" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>