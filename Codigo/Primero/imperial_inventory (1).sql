-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2024 a las 05:23:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `imperial_inventory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Cod_Categoria` int(11) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  `Estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`Cod_Categoria`, `Tipo`, `Estado`) VALUES
(1, 'Limpieza', 'Activo'),
(2, 'Grano', 'Activo'),
(3, 'Licores', 'Activo'),
(4, 'Higiene', 'Activo'),
(5, 'Carnes', 'Activo'),
(6, 'Pollitos', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_producto`
--

CREATE TABLE `detalle_producto` (
  `idDetalle_producto` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_producto`
--

INSERT INTO `detalle_producto` (`idDetalle_producto`, `Nombre`, `Tipo`, `Cantidad`) VALUES
(7, 'Peras', 'Fruta', 40),
(8, 'Brócoli', 'Vegetal', 25),
(9, 'Carne de Res', 'Carne', 10),
(10, 'Yogur', 'Lacteo', 30),
(11, 'Pan de Ajo', 'Panaderia', 15),
(12, 'Cola-cola', 'Bebida', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `idDetalle_venta` int(11) NOT NULL,
  `Fecha_venta` date NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`idDetalle_venta`, `Fecha_venta`, `Cantidad`, `Nombre`, `idProducto`) VALUES
(153, '2023-07-29', 3, 'jabon ariel', 444),
(156, '2023-07-19', 1, 'papel higienico', 333),
(159, '2023-07-17', 2, 'papas margarita', 111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `idEntrada` int(11) NOT NULL,
  `Producto` varchar(20) DEFAULT NULL,
  `Fecha_entrada` date NOT NULL,
  `Cant_entrada` int(11) DEFAULT NULL,
  `Valor_unitario` int(11) DEFAULT NULL,
  `Valor_totalentrada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`idEntrada`, `Producto`, `Fecha_entrada`, `Cant_entrada`, `Valor_unitario`, `Valor_totalentrada`) VALUES
(1, 'Zucaritas', '2024-03-30', 50, 2000, 100000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Fecha_entrada` date NOT NULL,
  `Cant_entrada` int(11) NOT NULL,
  `Fecha_salida` date DEFAULT NULL,
  `Salidas` varchar(45) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `idVenta` int(11) DEFAULT NULL,
  `idEntrada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_inventario`
--

CREATE TABLE `movimiento_inventario` (
  `id_Movimiento_inventario` int(11) NOT NULL,
  `Fecha_movimiento` date NOT NULL,
  `Tipo_movimiento` varchar(1) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Cantidad` varchar(45) NOT NULL,
  `Factura` varchar(45) NOT NULL,
  `Orden_pedido` varchar(45) NOT NULL,
  `Venta_producto` varchar(45) NOT NULL,
  `Id_Usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimiento_inventario`
--

INSERT INTO `movimiento_inventario` (`id_Movimiento_inventario`, `Fecha_movimiento`, `Tipo_movimiento`, `Id_producto`, `Cantidad`, `Factura`, `Orden_pedido`, `Venta_producto`, `Id_Usuarios`) VALUES
(1, '2023-08-10', 'E', 111, '50', 'FAC-001', '', '', 1002352336),
(2, '2023-08-12', 'S', 222, '5', '', '', 'VEN-001', 1022334851),
(3, '2023-08-15', 'E', 333, '30', 'FAC-002', '', '', 1023548963),
(4, '2023-08-18', 'S', 444, '2', '', '', 'VEN-002', 1045236879),
(5, '2023-08-20', 'E', 555, '15', 'FAC-003', '', '', 1052641765),
(6, '2023-08-22', 'S', 666, '10', '', '', 'VEN-003', 1052641765);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `Cantidad` varchar(45) NOT NULL,
  `idProveedor` varchar(45) NOT NULL,
  `id_Productos` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `Cantidad`, `idProveedor`, `id_Productos`) VALUES
(1, '80', '', 'pechuguita'),
(2, '10', '', 'Arrocito'),
(3, '100', '', 'Arrocito'),
(4, '40', '', '2'),
(5, '50', '', 'pechuguita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `nomProductos` varchar(45) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `idCategoria` varchar(50) NOT NULL,
  `IDproveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `nomProductos`, `Cantidad`, `Estado`, `precio`, `idCategoria`, `IDproveedor`) VALUES
(1, 'Zucaritas', 80, 'Activo', 12500, 'Grano', 'Manuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Telefono` int(10) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `id_Producto` varchar(50) NOT NULL,
  `Estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `Nombre`, `Telefono`, `Direccion`, `Email`, `id_Producto`, `Estado`) VALUES
(1, 'pollo', 2147483647, 'Bogotá D.C', 'femsa@gmail.com', 'pechuguita', 'Activo'),
(2, 'Manuela', 2147483647, 'Coca Cola Femsa', 'Zuc@gmail.com', '0', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL,
  `Nom_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRoles`, `Nom_rol`) VALUES
(1, 'Administrador'),
(2, 'Almacenista'),
(3, 'Cajero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id_Tipo_Movimiento` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_Tipo_Movimiento`, `Descripcion`) VALUES
(17, 'Entrada de productos'),
(53, 'Salida de productos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `Nom_usuario` varchar(45) NOT NULL,
  `Ape_usuario` varchar(45) NOT NULL,
  `Rol` int(11) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `Nom_usuario`, `Ape_usuario`, `Rol`, `Password`) VALUES
(11548636, 'Samuel', 'Vanegas', 2, '$2y$10$.IQ1ryx.6muGblDg4tYhJu1GSS1kCxyIKbTDZj.IEIf2Vrnjin9Pu'),
(1022338465, 'Juanita', 'Marulanda', 1, '$2y$10$AjQBY671Cw9FQCJyOecFF.JgYQj7Y4p9bCxDHf4EBOusQTEbHLM9W'),
(1053328822, 'Sebastian ', 'Quiroga', 1, '$2y$10$xfW8UQW4Y/SfiK68kpjHLepTnMXIEptQElGnfBdDglXzGFJbyQFX.'),
(1141111111, 'Jessica', 'Cuadros', 3, '$2y$10$xMtgNzc4A1dHNdVbFegGxeEyOgu3agVzuMiQHPgdXRKoMxmwgypNC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVentas` int(11) NOT NULL,
  `Nombre_producto` char(45) NOT NULL,
  `Salidas` varchar(45) NOT NULL,
  `Fecha_salida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idVentas`, `Nombre_producto`, `Salidas`, `Fecha_salida`) VALUES
(2, 'pollito', '40', '2024-04-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Cod_Categoria`);

--
-- Indices de la tabla `detalle_producto`
--
ALTER TABLE `detalle_producto`
  ADD PRIMARY KEY (`idDetalle_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`idDetalle_venta`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`idEntrada`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `fk_inventario_productos` (`idProducto`),
  ADD KEY `fk_inventario_ventas` (`idVenta`),
  ADD KEY `fk_inventario_entradas` (`idEntrada`);

--
-- Indices de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD PRIMARY KEY (`id_Movimiento_inventario`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProductos`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRoles`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id_Tipo_Movimiento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVentas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Cod_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_entradas` FOREIGN KEY (`idEntrada`) REFERENCES `entradas` (`idEntrada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventario_productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProductos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventario_ventas` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVentas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
