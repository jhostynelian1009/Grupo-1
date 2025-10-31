-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2025 a las 00:24:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbactividades`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(500) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_de_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_de_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `actividad`, `descripcion`, `estado`, `fecha_de_creacion`, `fecha_de_actualizacion`) VALUES
(2, 'Revisión bibliográfica 2025', 'Investigación de fuentes teóricas y antecedentes relacionados.', 1, '2025-10-24 22:38:45', '2025-10-24 22:38:45'),
(3, 'Deberes de calculo 4', 'Deberes de calculo Completos wq', 0, '2025-10-24 23:31:19', '2025-10-24 23:31:19'),
(4, 'Deberes de calculo 6', 'Deberes de calculo Completos  Practica nueva ', 2, '2025-10-24 23:32:54', '2025-10-24 23:32:54'),
(5, 'Valdes Jokabeth', 'Estudiantes del curso de 3a Materia Programación Web Y Diseño', 0, '2025-10-24 23:34:34', '2025-10-24 23:34:34'),
(6, 'Valdes Jokabeth2', 'Estudiantes del curso de 3a Materia Programación Web Y Diseño', 1, '2025-10-24 23:58:56', '2025-10-24 23:58:56'),
(7, 'Deberes de calculo 6', 'Deberes de calculo Completos wq', 0, '2025-10-24 23:59:24', '2025-10-24 23:59:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
