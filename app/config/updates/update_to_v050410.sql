-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-04-2010 a las 19:12:06
-- Versión del servidor: 5.1.37
-- Versión de PHP: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `ristorantino_v100405`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_facturas`
--

CREATE TABLE IF NOT EXISTS `tipo_facturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `tipo_facturas`
--

INSERT INTO `tipo_facturas` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Factura "A"', '2010-03-27 20:04:20', '2010-03-27 20:04:20'),
(2, 'Factura "B"', '2010-03-27 20:04:27', '2010-03-27 20:04:27'),
(3, 'Remito "X"', '2010-03-27 20:04:36', '2010-03-27 20:04:36'),
(4, 'Factura "M"', '2010-03-27 20:04:42', '2010-03-27 20:04:42'),
(5, 'Factura "C"', '2010-03-27 20:04:48', '2010-03-27 20:04:48'),
(6, 'Vale', '2010-03-27 20:04:54', '2010-03-27 20:04:54'),
(7, 'Otros', '2010-03-27 20:05:18', '2010-03-27 20:05:18');







-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE IF NOT EXISTS `egresos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_factura_id` int(11) DEFAULT NULL,
  `iva` float(10,2) NOT NULL DEFAULT '0.00',
  `iibb` float(10,2) NOT NULL DEFAULT '0.00',
  `otros` float(10,2) NOT NULL DEFAULT '0.00',
  `total` float(10,2) NOT NULL DEFAULT '0.00',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

