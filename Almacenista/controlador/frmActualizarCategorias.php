<?php
session_start();
$usuario = $_SESSION['usuario'];

if (empty($usuario)) {
    header("Location: ../modelo/login.php");
    exit;
}

require "../modelo/db.php";

$objConexion = Conectarse();

$mensaje_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    $sql_verificacion = "SELECT Cod_Categoria FROM categoria WHERE Tipo = ? AND Cod_Categoria != ?";
    $stmt = $objConexion->prepare($sql_verificacion);
    $stmt->bind_param("si", $tipo, $codigo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $mensaje_error = "La categoría '$tipo' ya está registrada.";
    } else {
        $sql_actualizar = "UPDATE categoria SET Tipo = ?, Estado = ? WHERE Cod_Categoria = ?";
        $stmt = $objConexion->prepare($sql_actualizar);
        $stmt->bind_param("ssi", $tipo, $estado, $codigo);

        if ($stmt->execute()) {
            header("location: listarCategorias.php?x=5");
            exit;
        } else {
            $mensaje_error = "Error al actualizar la categoría.";
        }
    }
} else {
    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];

        $sql_categoria = "SELECT Cod_Categoria, Tipo, Estado FROM categoria WHERE Cod_Categoria = ?";
        $stmt = $objConexion->prepare($sql_categoria);
        $stmt->bind_param("i", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tipo = $row['Tipo'];
            $estado = $row['Estado'];
        } else {
            header("Location: error.php");
            exit;
        }
    } else {
        header("Location: error.php");
        exit;
    }
}
?>

<?php include '../vista/header.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Actualizar Categoría
                </div>
                <div class="card-body">
                    <form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="codigo">Código de Categoría</label>
                            <input name="codigo" type="number" id="codigo" value="<?php echo $codigo; ?>" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <input name="tipo" type="text" id="tipo" value="<?php echo $tipo; ?>" class="form-control" pattern="[A-Za-z ]+" title="Solo se permiten letras." required />
                            <span class="text-danger"><?php echo $mensaje_error; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="Activo" <?php if($estado == 'Activo') echo 'selected'; ?>>Activo</option>
                                <option value="Inactivo" <?php if($estado == 'Inactivo') echo 'selected'; ?>>Inactivo</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="button" id="button" value="Actualizar" class="btn btn-success" />
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
                return "¿Está seguro que desea salir de la vista de actualizar categoría?";
            };
        }
    };
</script>
