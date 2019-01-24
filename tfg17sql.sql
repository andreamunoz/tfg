-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-01-2019 a las 16:03:41
-- Versión del servidor: 5.5.58-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tfg17sql`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`tfg17sql`@`localhost` PROCEDURE `sp_alumno_autoriza_null`(IN `username` VARCHAR(50))
    NO SQL
BEGIN
	UPDATE usuario SET autoriza = null WHERE rol = 1 AND user = username;
END$$

CREATE DEFINER=`tfg17sql`@`localhost` PROCEDURE `sp_ejecutar_script`(IN `codigo` TEXT)
    NO SQL
BEGIN
	SET @mycode = codigo;
    
	PREPARE stmt FROM @mycode; 
	EXECUTE stmt; 
	DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_avisos`
--

CREATE TABLE IF NOT EXISTS `sqlab_avisos` (
  `id_avisos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `mensaje` varchar(200) CHARACTER SET utf8 NOT NULL,
  `leido` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_avisos`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_categoria`
--

CREATE TABLE IF NOT EXISTS `sqlab_categoria` (
  `tipo` enum('Select-Basico','Select-Join','Select-Group-Basico','Select-Group-Having','Subqueries-Valor','Subqueries-Conjuntos','Operaciones Manipulacion de Datos') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_ejercicio`
--

CREATE TABLE IF NOT EXISTS `sqlab_ejercicio` (
  `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` enum('Principiante','Intermedio','Avanzado') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enunciado` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `deshabilitar` tinyint(1) NOT NULL,
  `tipo` enum('Select-Basico','Select-Join','Select-Group-Basico','Select-Group-Having','Subqueries-Valor','Subqueries-Conjuntos','Operaciones Manipulacion de Datos') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `creador_ejercicio` varchar(40) CHARACTER SET utf8 NOT NULL,
  `dueño_tablas` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `solucion` varchar(600) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ejercicio`),
  KEY `user` (`creador_ejercicio`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=304 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_esta_contenido`
--

CREATE TABLE IF NOT EXISTS `sqlab_esta_contenido` (
  `id_ejercicio` int(11) NOT NULL,
  `id_hoja` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id_ejercicio`,`id_hoja`),
  KEY `esta_hoja` (`id_hoja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_hoja_ejercicios`
--

CREATE TABLE IF NOT EXISTS `sqlab_hoja_ejercicios` (
  `id_hoja` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_hoja` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `creador_hoja` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_hoja`),
  UNIQUE KEY `nombre_hoja` (`nombre_hoja`),
  KEY `user` (`creador_hoja`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_resuelve`
--

CREATE TABLE IF NOT EXISTS `sqlab_resuelve` (
  `user` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  PRIMARY KEY (`user`,`id_ejercicio`),
  KEY `resu_ejer` (`id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_solucion`
--

CREATE TABLE IF NOT EXISTS `sqlab_solucion` (
  `intentos` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `veredicto` tinyint(1) NOT NULL,
  `solucion_propuesta` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`intentos`,`user`,`id_ejercicio`),
  KEY `sol_resu` (`user`,`id_ejercicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_tablas_disponibles`
--

CREATE TABLE IF NOT EXISTS `sqlab_tablas_disponibles` (
  `nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `schema_prof` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`nombre`,`schema_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_usa`
--

CREATE TABLE IF NOT EXISTS `sqlab_usa` (
  `id_ejercicio` int(11) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `schema_prof` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_ejercicio`,`nombre`,`schema_prof`),
  KEY `usa_tablas` (`nombre`,`schema_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sqlab_usuario`
--

CREATE TABLE IF NOT EXISTS `sqlab_usuario` (
  `user` varchar(40) CHARACTER SET utf8 NOT NULL,
  `password` blob NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 NOT NULL,
  `apellidos` varchar(70) CHARACTER SET utf8 NOT NULL,
  `rol` tinyint(1) NOT NULL,
  `autoriza` tinyint(1) DEFAULT NULL,
  `asociado` varchar(130) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sqlab_avisos`
--
ALTER TABLE `sqlab_avisos`
  ADD CONSTRAINT `FK_avisos` FOREIGN KEY (`nombre`) REFERENCES `sqlab_usuario` (`user`);

--
-- Filtros para la tabla `sqlab_ejercicio`
--
ALTER TABLE `sqlab_ejercicio`
  ADD CONSTRAINT `ejer_tipo` FOREIGN KEY (`tipo`) REFERENCES `sqlab_categoria` (`tipo`),
  ADD CONSTRAINT `ejer_user` FOREIGN KEY (`creador_ejercicio`) REFERENCES `sqlab_usuario` (`user`);

--
-- Filtros para la tabla `sqlab_esta_contenido`
--
ALTER TABLE `sqlab_esta_contenido`
  ADD CONSTRAINT `esta_ejer` FOREIGN KEY (`id_ejercicio`) REFERENCES `sqlab_ejercicio` (`id_ejercicio`),
  ADD CONSTRAINT `esta_hoja` FOREIGN KEY (`id_hoja`) REFERENCES `sqlab_hoja_ejercicios` (`id_hoja`);

--
-- Filtros para la tabla `sqlab_hoja_ejercicios`
--
ALTER TABLE `sqlab_hoja_ejercicios`
  ADD CONSTRAINT `hoja_user` FOREIGN KEY (`creador_hoja`) REFERENCES `sqlab_usuario` (`user`);

--
-- Filtros para la tabla `sqlab_resuelve`
--
ALTER TABLE `sqlab_resuelve`
  ADD CONSTRAINT `resu_ejer` FOREIGN KEY (`id_ejercicio`) REFERENCES `sqlab_ejercicio` (`id_ejercicio`),
  ADD CONSTRAINT `resu_user` FOREIGN KEY (`user`) REFERENCES `sqlab_usuario` (`user`);

--
-- Filtros para la tabla `sqlab_solucion`
--
ALTER TABLE `sqlab_solucion`
  ADD CONSTRAINT `sol_resu` FOREIGN KEY (`user`, `id_ejercicio`) REFERENCES `sqlab_resuelve` (`user`, `id_ejercicio`);

--
-- Filtros para la tabla `sqlab_usa`
--
ALTER TABLE `sqlab_usa`
  ADD CONSTRAINT `usa_ejer` FOREIGN KEY (`id_ejercicio`) REFERENCES `sqlab_ejercicio` (`id_ejercicio`),
  ADD CONSTRAINT `usa_tablas` FOREIGN KEY (`nombre`, `schema_prof`) REFERENCES `sqlab_tablas_disponibles` (`nombre`, `schema_prof`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
