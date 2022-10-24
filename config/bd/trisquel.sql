-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2022 a las 21:08:18
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trisquel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_recorrido`
--

CREATE TABLE `asignacion_recorrido` (
  `id_asignacion_recorrido` int(11) NOT NULL,
  `id_recorrido` int(11) NOT NULL,
  `id_corredor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignacion_recorrido`
--

INSERT INTO `asignacion_recorrido` (`id_asignacion_recorrido`, `id_recorrido`, `id_corredor`) VALUES
(7, 5, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corredores`
--

CREATE TABLE `corredores` (
  `id_corredor` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `numero_corredor` int(4) NOT NULL,
  `tipo_corredor` text NOT NULL,
  `nombre_local` text NOT NULL,
  `teamviewer` text NOT NULL,
  `anydesk` text NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `corredores`
--

INSERT INTO `corredores` (`id_corredor`, `id_persona`, `numero_corredor`, `tipo_corredor`, `nombre_local`, `teamviewer`, `anydesk`, `fecha_registro`, `hora_registro`) VALUES
(9, 17, 110, 'Manual', '', '', '', '2022-10-23', '05:11:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido_paterno` text NOT NULL,
  `apellido_materno` text NOT NULL,
  `telefono` text NOT NULL,
  `direccion` text NOT NULL,
  `enlace_direccion` text NOT NULL,
  `fecha_nac` date NOT NULL,
  `comentarios` text NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `nombre`, `apellido_paterno`, `apellido_materno`, `telefono`, `direccion`, `enlace_direccion`, `fecha_nac`, `comentarios`, `fecha_registro`, `hora_registro`) VALUES
(1, 'Alex', 'Rdz', 'Solis', '8261167643', 'Enrrique Segoviano', 'https://www.google.com', '2022-10-22', 'no', '2022-10-22', '13:12:12'),
(17, 'Prueba', 'Usuario', 'Nuevo', '1826154646', 'saas', 'asas', '2022-10-22', 'as', '2022-10-23', '04:56:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorridos`
--

CREATE TABLE `recorridos` (
  `id_recorrido` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recorridos`
--

INSERT INTO `recorridos` (`id_recorrido`, `nombre`, `fecha_registro`, `hora_registro`) VALUES
(4, '1', '2022-10-23', '05:09:09'),
(5, '2', '2022-10-23', '05:09:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `nombre_usuario` text NOT NULL,
  `contrasena` text NOT NULL,
  `tipo_empleado` text NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_persona`, `nombre_usuario`, `contrasena`, `tipo_empleado`, `fecha_registro`, `hora_registro`) VALUES
(1, 1, 'alekeii', 'b221d9dbb083a7f33428d7c2a3c3198ae925614d70210e28716ccaa7cd4ddb79', 'Sistemas', '2022-10-23', '05:10:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion_recorrido`
--
ALTER TABLE `asignacion_recorrido`
  ADD PRIMARY KEY (`id_asignacion_recorrido`),
  ADD KEY `id_corredor` (`id_corredor`);

--
-- Indices de la tabla `corredores`
--
ALTER TABLE `corredores`
  ADD PRIMARY KEY (`id_corredor`),
  ADD KEY `FK_id_persona` (`id_persona`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  ADD PRIMARY KEY (`id_recorrido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion_recorrido`
--
ALTER TABLE `asignacion_recorrido`
  MODIFY `id_asignacion_recorrido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `corredores`
--
ALTER TABLE `corredores`
  MODIFY `id_corredor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  MODIFY `id_recorrido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_recorrido`
--
ALTER TABLE `asignacion_recorrido`
  ADD CONSTRAINT `FK_id_corredor` FOREIGN KEY (`id_corredor`) REFERENCES `corredores` (`id_corredor`);

--
-- Filtros para la tabla `corredores`
--
ALTER TABLE `corredores`
  ADD CONSTRAINT `FK_id_persona` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
