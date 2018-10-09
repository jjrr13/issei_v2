-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-09-2018 a las 15:59:27
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

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `descripcion`, `valor`, `valor2`, `comentario`, `rango1`, `rango2`, `fecha_registro`, `usuario_registro`, `estado`) VALUES
(1, 'SALARIO_MIN_MENSUAL', '781242', NULL, 'Salario minimo mensual vigente', NULL, NULL, '2007-10-25 09:43:57', NULL, '1'),
(7, 'PORCENTAJE_CV', '0.80', NULL, 'Porcentaje de CV', NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(8, 'PORCENTAJE_CF', '0.40', NULL, 'Porcentaje de CF', NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(9, 'I_VIVIENDA_1', '0.5', NULL, NULL, NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(10, 'I_VIVIENDA_2', '0.5', NULL, NULL, NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(11, 'I_VIVIENDA_3', '1', NULL, NULL, NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(12, 'I_VIVIENDA_4', '1.5', NULL, NULL, NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(13, 'I_VIVIENDA_5', '2', NULL, NULL, NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(14, 'I_VIVIENDA_6', '2.5', NULL, NULL, NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(15, 'CARGO_FIJO_CIUDAD', '0.938', NULL, 'Cargo fijo de la ciudad (Cali)', NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(16, 'OTRO_USOS_INSTITUCIONAL', '2.9', NULL, NULL, 1, 300, '2007-10-25 00:00:00', NULL, '1'),
(17, 'OTRO_USOS_INSTITUCIONAL', '3.2', NULL, NULL, 300, 1000, '2007-10-25 00:00:00', NULL, '1'),
(18, 'OTRO_USOS_INSTITUCIONAL', '4', NULL, NULL, 1000, 10000000, '2007-10-25 00:00:00', NULL, '1'),
(19, 'OTRO_USOS_COMERCIO', '2.9', NULL, NULL, 1, 300, '2007-10-25 00:00:00', NULL, '1'),
(20, 'OTRO_USOS_COMERCIO', '3.2', NULL, NULL, 300, 1000, '2007-10-25 00:00:00', NULL, '1'),
(21, 'OTRO_USOS_COMERCIO', '4', NULL, NULL, 1000, 10000000, '2007-10-25 00:00:00', NULL, '1'),
(22, 'OTRO_USOS_INDUSTRIA', '2.9', NULL, NULL, 1, 300, '2007-10-25 00:00:00', NULL, '1'),
(23, 'OTRO_USOS_INDUSTRIA', '3.2', NULL, NULL, 300, 1000, '2007-10-25 00:00:00', NULL, '1'),
(24, 'OTRO_USOS_INDUSTRIA', '4', NULL, NULL, 1000, 10000000, '2007-10-25 00:00:00', NULL, '1'),
(25, 'J_CONSTRUCCION', '0.45', NULL, NULL, -99999, 101, '2007-10-25 00:00:00', NULL, '1'),
(26, 'J_CONSTRUCCION', '3.8', '800', '0.12', 101, 11000, '2007-10-25 00:00:00', NULL, '1'),
(27, 'J_CONSTRUCCION', '2.2', '800', '0.018', 11000, 10000000, '2007-10-25 00:00:00', NULL, '1'),
(28, 'J_URBANISMO_PARCELACION', '4', '2000', '0.025', NULL, NULL, '2007-10-25 00:00:00', NULL, '1'),
(29, 'AJUSTE_COTAS', '1', '4', '4 Veces el salario minimo diario', NULL, NULL, '2007-11-02 00:00:00', NULL, '1'),
(30, 'AJUSTE_COTAS', '2', '4', NULL, NULL, NULL, '2007-11-02 00:00:00', NULL, '1'),
(31, 'AJUSTE_COTAS', '3', '8', NULL, NULL, NULL, '2007-11-02 00:00:00', NULL, '1'),
(32, 'AJUSTE_COTAS', '4', '8', NULL, NULL, NULL, '2007-11-02 00:00:00', NULL, '1'),
(33, 'AJUSTE_COTAS', '5', '12', NULL, NULL, NULL, '2007-11-02 00:00:00', NULL, '1'),
(34, 'AJUSTE_COTAS', '6', '12', NULL, NULL, NULL, '2007-11-02 00:00:00', NULL, '1'),
(35, 'PROPIEDAD_HORIZONTAL', '0.25', NULL, NULL, 1, 250, '2007-11-02 00:00:00', NULL, '1'),
(36, 'PROPIEDAD_HORIZONTAL', '0.5', NULL, NULL, 251, 500, '2007-11-02 00:00:00', NULL, '1'),
(37, 'PROPIEDAD_HORIZONTAL', '1', NULL, NULL, 501, 1000, '2007-11-02 00:00:00', NULL, '1'),
(38, 'PROPIEDAD_HORIZONTAL', '2', NULL, NULL, 1001, 5000, '2007-11-02 00:00:00', NULL, '1'),
(39, 'PROPIEDAD_HORIZONTAL', '3', NULL, NULL, 5001, 10000, '2007-11-02 00:00:00', NULL, '1'),
(40, 'PROPIEDAD_HORIZONTAL', '4', NULL, NULL, 10001, 20000, '2007-11-02 00:00:00', NULL, '1'),
(41, 'PROPIEDAD_HORIZONTAL', '5', NULL, NULL, 20000, 2147480000, '2007-11-02 00:00:00', NULL, '1'),
(42, 'MOVIMIENTO_TIERRAS', '2', NULL, NULL, 1, 100, '2007-11-02 00:00:00', NULL, '1'),
(43, 'MOVIMIENTO_TIERRAS', '4', NULL, NULL, 101, 500, '2007-11-02 00:00:00', NULL, '1'),
(44, 'MOVIMIENTO_TIERRAS', '1', '1', NULL, 501, 1000, '2007-11-02 00:00:00', NULL, '1'),
(45, 'MOVIMIENTO_TIERRAS', '2', '1', NULL, 1001, 5000, '2007-11-02 00:00:00', NULL, '1'),
(46, 'MOVIMIENTO_TIERRAS', '3', '1', NULL, 5001, 10000, '2007-11-02 00:00:00', NULL, '1'),
(47, 'MOVIMIENTO_TIERRAS', '4', '1', NULL, 10001, 20000, '2007-11-02 00:00:00', NULL, '1'),
(48, 'MOVIMIENTO_TIERRAS', '5', '1', NULL, 20000, 2147480000, '2007-11-02 00:00:00', NULL, '1'),
(49, 'RELOTEO', '2', NULL, NULL, 1, 1000, '2007-11-02 00:00:00', NULL, '1'),
(50, 'RELOTEO', '0.5', '1', NULL, 1001, 5000, '2007-11-02 00:00:00', NULL, '1'),
(51, 'RELOTEO', '1', '1', NULL, 5001, 10000, '2007-11-02 00:00:00', NULL, '1'),
(52, 'RELOTEO', '1.5', '1', NULL, 10001, 20000, '2007-11-02 00:00:00', NULL, '1'),
(53, 'RELOTEO', '2', '1', NULL, 20001, 2147480000, '2007-11-02 00:00:00', NULL, '1'),
(54, 'REQUISITO_EXPENSA', 'Completar entrega', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '1'),
(55, 'REQUISITO_EXPENSA', 'Presentar Proyecto Estructural Completo', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '1'),
(56, 'REQUISITO_EXPENSA', 'Ajustar los planos segun las observaciones efectuadas', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '1'),
(57, 'REQUISITO_EXPENSA', 'Adjuntar copias de los planos visados', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '1'),
(58, 'REQUISITO_EXPENSA', 'Adjuntar recibo de Rentas Varias (nomenclatura) debidamente cancelado', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '0'),
(59, 'REQUISITO_EXPENSA', 'Segun Acuerdo 0338 de 2012 que modificó parcialmente el Acuerdo 0321 de 2011, debe anexar la Declaracion y Liquidacion privada del Impuesto de Delineacion debidamente cancelada', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '1'),
(60, 'REQUISITO_EXPENSA', 'Adjuntar Certificado de Nomenclatura', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '0'),
(61, 'REQUISITO_EXPENSA', 'Anexar Peritaje Estructural', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '1'),
(62, 'REQUISITO_EXPENSA', 'Anexar foto de Valla', NULL, NULL, NULL, NULL, '2007-11-19 00:00:00', NULL, '1'),
(63, 'REQUISITO_EXPENSA', 'Certificado de Uso de suelo', NULL, NULL, NULL, NULL, '2010-09-01 00:00:00', NULL, '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
