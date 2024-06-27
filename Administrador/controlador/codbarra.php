<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Barras</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <script src="JsBarcode.all.min.js"></script>
</head>
<body>
    <?php include '../vista/header.php'; ?>

    <div class="container">
        <h1 align="center">CODIGO DE BARRAS</h1>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-10">
                <?php require_once "tabla.php" ?>
            </div>
        </div>
    </div>
</body>
</html>
