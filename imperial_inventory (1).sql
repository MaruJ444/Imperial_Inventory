-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 03:20:15
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
(1, 'Limpiezas', 'Activo'),
(2, 'Grano', 'Activo'),
(3, 'Licores', 'Activo'),
(4, 'Higiene', 'Activo'),
(5, 'Carnes', 'Activo'),
(6, 'Pollitos', 'Activo'),
(12, 'Aseo', 'Activo');

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
(1, 'Zucaritas', '2024-04-11', 100, 3400, 340000),
(2, 'Zucaritas', '2024-04-12', 24, 3400, 81600),
(5, 'Panecitos', '2024-04-13', 50, 2000, 100000),
(6, 'Coca Cola', '2024-04-13', 80, 2000, 160000),
(7, 'Pollo', '2024-04-06', 60, 3000, 180000);

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
(1, '80', 'Macpollo', 'Coca-Cola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `nomProductos` varchar(45) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `idCategoria` varchar(50) NOT NULL,
  `IDproveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `nomProductos`, `Estado`, `idCategoria`, `IDproveedor`) VALUES
(1, 'Zucaritas', 'Activo', 'Grano', 'Manuela'),
(4, 'Panecitos', 'Activo', 'Grano', 'Juan'),
(5, 'Coca Cola', 'Activo', 'Licores', 'Juan'),
(6, 'Pollo', 'Activo', 'Pollitos', 'Juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `id_Producto` varchar(50) NOT NULL,
  `Estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `Nombre`, `Telefono`, `Direccion`, `Email`, `id_Producto`, `Estado`) VALUES
(1, 'Manuela', '3154875698', 'Bogotá D.C', 'sami15@gmail.com', 'Zucaritas', 'Activo'),
(2, 'Juan', '3043540400', 'Medellin ', 'jntmrlnd@gmail.com', 'Panecitos', 'Activo');

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
(12345, 'Daniel', 'Lopez', 3, '$2y$10$/OBQuS80tlkP96SYISr43O4MOPmtLnNe/tTISAyvrUS5JVTjvbjNG'),
(11548636, 'Samuel', 'Vanegas', 2, '$2y$10$.IQ1ryx.6muGblDg4tYhJu1GSS1kCxyIKbTDZj.IEIf2Vrnjin9Pu'),
(111111111, 'Jessica', 'Cuadros', 3, '$2y$10$qfjeoYkirMI/sHwSdnkqEu/oQQQdsmo7MU3U4AiTWa6q6wks4LScm'),
(1011591299, 'Josesito', 'Garcia ', 1, '$2y$10$1djoGFnVwhakw2zOFx6pguOM25FQtlCjI.vSrW9SawGYAcV2je8aK'),
(1022144507, 'Felipe', 'Garcia', 1, '$2y$10$CCsxJ6yd2rQUukBRV9zhGePyUK8zQjBxscZlImfrusHE8LNo5VRvG'),
(1022338465, 'Juanita', 'Marulanda', 1, '$2y$10$AjQBY671Cw9FQCJyOecFF.JgYQj7Y4p9bCxDHf4EBOusQTEbHLM9W'),
(1053328822, 'Sebastian ', 'Quiroga', 1, '$2y$10$xfW8UQW4Y/SfiK68kpjHLepTnMXIEptQElGnfBdDglXzGFJbyQFX.');

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
(1, 'Panecitos', '20', '2024-04-13'),
(2, 'Coca Cola', '40', '2024-04-06'),
(3, 'Zucaritas', '15', '2024-04-05'),
(4, 'Panecitos', '14', '2024-04-06'),
(5, 'Zucaritas', '50', '2024-04-06'),
(6, 'Zucaritas', '50', '2024-04-06'),
(7, 'Pollo', '40', '2024-04-09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Cod_Categoria`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`idEntrada`);

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
  MODIFY `Cod_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
