-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2026 a las 00:58:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `streepsoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos_torneos`
--

CREATE TABLE `abonos_torneos` (
  `id` int(11) NOT NULL,
  `jugador_torneo_id` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `metodo_pago` enum('efectivo','nequi','daviplata','bre-b') NOT NULL,
  `fecha_pago` date NOT NULL,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos_uniformes`
--

CREATE TABLE `abonos_uniformes` (
  `id` int(11) NOT NULL,
  `uniforme_id` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `metodo_pago` enum('efectivo','nequi','daviplata','bre-b') NOT NULL,
  `fecha_pago` date NOT NULL,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `horario` varchar(35) DEFAULT NULL,
  `sede` varchar(35) DEFAULT NULL,
  `activa` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `jugador_id` int(11) NOT NULL,
  `doc_identidad` tinyint(1) DEFAULT 0,
  `consentimiento` tinyint(1) DEFAULT 0,
  `ficha_idrd` tinyint(1) DEFAULT 0,
  `cert_eps` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructores`
--

CREATE TABLE `instructores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL,
  `apellidos_nombres` varchar(100) NOT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `iniciales` varchar(5) DEFAULT NULL,
  `camiseta` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `documento` varchar(20) NOT NULL,
  `celular_acudiente` varchar(15) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `eps` varchar(50) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `estado` enum('activo','inactivo','retirado') DEFAULT 'activo',
  `tipo_beca` enum('sin_beca','media_beca','beca_completa') DEFAULT 'sin_beca',
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_torneos`
--

CREATE TABLE `jugadores_torneos` (
  `id` int(11) NOT NULL,
  `jugador_id` int(11) NOT NULL,
  `torneo_id` int(11) NOT NULL,
  `saldo_pendiente` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `jugador_id` int(11) NOT NULL,
  `anio` year(4) NOT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `metodo_pago` enum('efectivo','nequi','daviplata','bre-b') NOT NULL,
  `fecha_pago` date NOT NULL,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_mensualidades`
--

CREATE TABLE `pagos_mensualidades` (
  `id` int(11) NOT NULL,
  `jugador_id` int(11) NOT NULL,
  `anio` year(4) NOT NULL,
  `mes` enum('ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic') NOT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `metodo_pago` enum('efectivo','nequi','daviplata','bre-b') NOT NULL,
  `fecha_pago` date NOT NULL,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_actividad`
--

CREATE TABLE `registro_actividad` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `accion` varchar(150) NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `tipo` enum('local','nacional','internacional') NOT NULL,
  `fecha` date DEFAULT NULL,
  `anio` year(4) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uniformes`
--

CREATE TABLE `uniformes` (
  `id` int(11) NOT NULL,
  `jugador_id` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `saldo_pendiente` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` enum('pendiente','pagado') DEFAULT 'pendiente',
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `creado_en` timestamp NULL DEFAULT current_timestamp(),
  `pin_recuperacion` varchar(255) DEFAULT NULL,
  `token_password` varchar(255) DEFAULT NULL,
  `expired_session` datetime DEFAULT NULL,
  `request_password` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `usuario`, `contrasena`, `creado_en`, `pin_recuperacion`, `token_password`, `expired_session`, `request_password`) VALUES
(1, 'David mora', 'davi1@gmail.com', '$2y$10$aFuRwi7s9XI9m0nDGWM92OEqSXninYWWIg5RexHdyVtd4EpFbX5DW', '0000-00-00 00:00:00', '$2y$10$NkRf8fV7yfz4s3mtmQP8pOIs5hCgsMcX5mw/M5aFfMLUK1xGdvtne', '5942c2441ca40d5e1ab8a155ec3215edd7ba54b9b9329843e4222338471eed8a', '2026-05-26 19:50:29', 0),
(2, 'Noni', 'Noni@gmail.com', '$2y$10$aFuRwi7s9XI9m0nDGWM92OEqSXninYWWIg5RexHdyVtd4EpFbX5DW', '2026-05-17 23:20:48', NULL, NULL, NULL, 0),
(5, 'cristian', 'cdavidg4396@gmail.com', '$2y$10$WLRGi2rBDGsJoN4eE2pCQ.cMkCY7rXxUFfHqoelQK1vOuCljfpzqu', '2026-05-26 15:54:10', NULL, NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos_torneos`
--
ALTER TABLE `abonos_torneos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jugador_torneo_id` (`jugador_torneo_id`);

--
-- Indices de la tabla `abonos_uniformes`
--
ALTER TABLE `abonos_uniformes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniforme_id` (`uniforme_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jugador_id` (`jugador_id`);

--
-- Indices de la tabla `instructores`
--
ALTER TABLE `instructores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indices de la tabla `jugadores_torneos`
--
ALTER TABLE `jugadores_torneos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unico_jugador_torneo` (`jugador_id`,`torneo_id`),
  ADD KEY `torneo_id` (`torneo_id`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unica_matricula` (`jugador_id`,`anio`);

--
-- Indices de la tabla `pagos_mensualidades`
--
ALTER TABLE `pagos_mensualidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unico_pago` (`jugador_id`,`anio`,`mes`);

--
-- Indices de la tabla `registro_actividad`
--
ALTER TABLE `registro_actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `uniformes`
--
ALTER TABLE `uniformes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jugador_id` (`jugador_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos_torneos`
--
ALTER TABLE `abonos_torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `abonos_uniformes`
--
ALTER TABLE `abonos_uniformes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instructores`
--
ALTER TABLE `instructores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores_torneos`
--
ALTER TABLE `jugadores_torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_mensualidades`
--
ALTER TABLE `pagos_mensualidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_actividad`
--
ALTER TABLE `registro_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `uniformes`
--
ALTER TABLE `uniformes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos_torneos`
--
ALTER TABLE `abonos_torneos`
  ADD CONSTRAINT `abonos_torneos_ibfk_1` FOREIGN KEY (`jugador_torneo_id`) REFERENCES `jugadores_torneos` (`id`);

--
-- Filtros para la tabla `abonos_uniformes`
--
ALTER TABLE `abonos_uniformes`
  ADD CONSTRAINT `abonos_uniformes_ibfk_1` FOREIGN KEY (`uniforme_id`) REFERENCES `uniformes` (`id`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`);

--
-- Filtros para la tabla `instructores`
--
ALTER TABLE `instructores`
  ADD CONSTRAINT `instructores_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructores` (`id`);

--
-- Filtros para la tabla `jugadores_torneos`
--
ALTER TABLE `jugadores_torneos`
  ADD CONSTRAINT `jugadores_torneos_ibfk_1` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`),
  ADD CONSTRAINT `jugadores_torneos_ibfk_2` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`);

--
-- Filtros para la tabla `pagos_mensualidades`
--
ALTER TABLE `pagos_mensualidades`
  ADD CONSTRAINT `pagos_mensualidades_ibfk_1` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`);

--
-- Filtros para la tabla `registro_actividad`
--
ALTER TABLE `registro_actividad`
  ADD CONSTRAINT `registro_actividad_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `uniformes`
--
ALTER TABLE `uniformes`
  ADD CONSTRAINT `uniformes_ibfk_1` FOREIGN KEY (`jugador_id`) REFERENCES `jugadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
