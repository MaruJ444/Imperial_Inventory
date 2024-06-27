<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IMPERIAL INVENTORY</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/Vistas.css" rel="stylesheet" type="text/css">
    

</head>

<body id="page-top">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../modelo/inicio.php">
                    <div class="sidebar-brand-text mx-3"> IMPERIAL INVENTORY </div>
                </a>
                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="../modelo/inicio.php">
                        <i class="fa fa-solid fa-house"></i>
                        <span>Panel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarInventario.php">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarProductos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/codbarra.php">Codigos de barra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarCategorias.php">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarProveedores.php">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarEntradas.php">Entradas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarPedidos.php">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarVentas.php">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/listarUsuarios.php">Usuarios</a>
                </li>
            </ul>
        </div>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="input-group-append">

                            </div>
                        </div>
                    </form>
                    <div class="desplegable">
                        <ul class="nav">
                            <li class="items">
                                <a class="padre" href="#">Usuario</a>

                                <ul class="lista">


                                    <li class="cerrar_sesion"><a class="hijos" href="#" onclick="cerrarSesion()">Cerrar Sesion</a></li>

                                </ul>
                            </li>
                        </ul>
                        <script>
                            function cerrarSesion() {
                                if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                                    window.location.href = '../modelo/cerrarSesion.php';
                                }
                            }
                        </script>
                    </div>
                </nav>