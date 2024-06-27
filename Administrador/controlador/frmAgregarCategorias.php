<?php
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";
require "../modelo/Categoria.php"; 

$objConexion = Conectarse();

$sql_categoria = "SELECT Cod_Categoria, Tipo FROM categoria";
$resultado_categoria = $objConexion->query($sql_categoria);

$mensaje_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_REQUEST);

    $sql_verificacion = "SELECT Cod_Categoria FROM categoria WHERE Tipo = ?";
    $stmt = $objConexion->prepare($sql_verificacion);
    $stmt->bind_param("s", $tipo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $mensaje_error = "La categoría '$tipo' ya está registrada.";
    } else {
        $objCategoria = new Categoria();
        $objCategoria->crearCategoria($tipo, $estado);

        $resultado = $objCategoria->agregarCategoria();

        if ($resultado) {
            header("location: listarCategorias.php?x=5");
            exit;
        } else {
            $mensaje_error = "Error al agregar la categoría.";
        }
    }
}
?>

<?php include '../vista/header.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Agregar Categoría
                </div>
                <div class="card-body">
                    <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                        <div class="form-group">
                                <label for="codigo">Código de Categoría</label>
                                <input name="codigo" type="number" id="codigo" class="form-control" readonly />
                            </div>
                            <label for="tipo">Tipo</label>
                            <input name="tipo" type="text" id="tipo" class="form-control" pattern="[A-Za-z ]+" title="Solo se permiten letras." required />
                            <span class="text-danger"><?php echo $mensaje_error; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
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

<script>
    window.onload = function() {
        document.getElementById('form1').addEventListener('submit', function() {
            window.onbeforeunload = null;
        });

        if (!<?php echo isset($_POST['button']) ? 'true' : 'false'; ?>) {
            window.onbeforeunload = function() {
                return "¿Está seguro que desea salir de la vista de actualizar pedido?";
            };
        }
    };
</script>
