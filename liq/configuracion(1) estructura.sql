-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-09-2018 a las 16:00:17
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `curaduria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id_configuracion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `valor` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `valor2` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `comentario` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `rango1` float DEFAULT NULL,
  `rango2` float DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usuario_registro` int(11) DEFAULT NULL,
  `estado` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_configuracion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=64 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
