-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-08-2014 a las 04:08:28
-- Versión del servidor: 5.5.38-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `px_chocha014`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_cierres`
--

CREATE TABLE IF NOT EXISTS `account_cierres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_clasificaciones`
--

CREATE TABLE IF NOT EXISTS `account_clasificaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_egresos`
--

CREATE TABLE IF NOT EXISTS `account_egresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `observacion` text COLLATE utf8_bin,
  `file` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `tipo_de_pago_id` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=111 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_egresos_gastos`
--

CREATE TABLE IF NOT EXISTS `account_egresos_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `egreso_id` int(11) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=154 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_gastos`
--

CREATE TABLE IF NOT EXISTS `account_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cierre_id` tinyint(4) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `clasificacion_id` int(11) DEFAULT NULL,
  `tipo_factura_id` int(11) DEFAULT NULL,
  `factura_nro` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date NOT NULL,
  `importe_neto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `observacion` text COLLATE utf8_bin,
  `file` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=176 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_gastos_tipo_impuestos`
--

CREATE TABLE IF NOT EXISTS `account_gastos_tipo_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `tipo_impuesto_id` int(11) NOT NULL,
  `importe` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_impuestos`
--

CREATE TABLE IF NOT EXISTS `account_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `tipo_impuesto_id` int(11) NOT NULL,
  `neto` decimal(10,2) DEFAULT '0.00',
  `importe` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=308 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_proveedores`
--

CREATE TABLE IF NOT EXISTS `account_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `cuit` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `domicilio` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_tipo_impuestos`
--

CREATE TABLE IF NOT EXISTS `account_tipo_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `porcentaje` decimal(6,2) NOT NULL,
  `tiene_neto` tinyint(1) NOT NULL DEFAULT '1',
  `tiene_impuesto` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=814 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `_read` varchar(2) COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `_update` varchar(2) COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `_delete` varchar(2) COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cake_sessions`
--

CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cash_arqueos`
--

CREATE TABLE IF NOT EXISTS `cash_arqueos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja_id` int(10) unsigned NOT NULL,
  `importe_inicial` decimal(11,2) DEFAULT '0.00',
  `ingreso` decimal(11,2) DEFAULT '0.00',
  `egreso` decimal(11,2) DEFAULT '0.00',
  `otros_ingresos` decimal(11,2) DEFAULT '0.00',
  `otros_egresos` decimal(11,2) DEFAULT '0.00',
  `importe_final` decimal(11,2) DEFAULT '0.00',
  `saldo` decimal(11,2) DEFAULT '0.00',
  `datetime` datetime NOT NULL,
  `observacion` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cash_cajas`
--

CREATE TABLE IF NOT EXISTS `cash_cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(124) NOT NULL,
  `computa_ingresos` tinyint(1) NOT NULL DEFAULT '1',
  `computa_egresos` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cash_zetas`
--

CREATE TABLE IF NOT EXISTS `cash_zetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arqueo_id` int(10) unsigned DEFAULT NULL,
  `total_ventas` decimal(11,2) NOT NULL DEFAULT '0.00',
  `numero_comprobante` int(11) DEFAULT NULL,
  `monto_iva` decimal(11,2) NOT NULL DEFAULT '0.00',
  `monto_neto` decimal(11,2) NOT NULL DEFAULT '0.00',
  `nota_credito_iva` decimal(11,2) NOT NULL DEFAULT '0.00',
  `nota_credito_neto` decimal(11,2) NOT NULL DEFAULT '0.00',
  `observacion_comprobante_tarjeta` text,
  `observacion` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned DEFAULT NULL,
  `rght` int(10) unsigned DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `description` text COLLATE utf8_general_ci NOT NULL,
  `image_url` varchar(200) COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(64) COLLATE utf8_general_ci DEFAULT NULL,
  `mail` varchar(110) COLLATE utf8_general_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8_general_ci DEFAULT NULL,
  `descuento_id` int(10) unsigned DEFAULT '0',
  `nombre` varchar(110) COLLATE utf8_general_ci DEFAULT NULL,
  `nrodocumento` varchar(11) COLLATE utf8_general_ci DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `domicilio` varchar(110) COLLATE utf8_general_ci DEFAULT NULL,
  `iva_responsabilidad_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

CREATE TABLE IF NOT EXISTS `comandas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mesa_id` int(11) NOT NULL,
  `prioridad` tinyint(4) NOT NULL,
  `impresa` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `observacion` text COLLATE utf8_general_ci,
  PRIMARY KEY (`id`),
  KEY `mesa_id` (`mesa_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=10206 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comensales`
--

CREATE TABLE IF NOT EXISTS `comensales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cant_mayores` tinyint(4) NOT NULL,
  `cant_menores` tinyint(4) NOT NULL,
  `cant_bebes` tinyint(4) NOT NULL,
  `mesa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `config_category_id` int(10) unsigned NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `description` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_categories`
--

CREATE TABLE IF NOT EXISTS `config_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE IF NOT EXISTS `descuentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `porcentaje` float NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comandas`
--

CREATE TABLE IF NOT EXISTS `detalle_comandas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) unsigned NOT NULL,
  `cant` tinyint(4) NOT NULL,
  `cant_eliminada` tinyint(4) NOT NULL DEFAULT '0',
  `comanda_id` int(11) unsigned NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `es_entrada` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mesa_id_2` (`comanda_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22614 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_sabores`
--

CREATE TABLE IF NOT EXISTS `detalle_sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detalle_comanda_id` int(11) NOT NULL,
  `sabor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=6068 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `color` VARCHAR( 14 ) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_general_ci NOT NULL,
  `importe` float(10,2) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_sabores`
--

CREATE TABLE IF NOT EXISTS `grupo_sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seleccion_de_sabor_obligatorio` tinyint(1) NOT NULL,
  `tipo_de_seleccion` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_sabores_productos`
--

CREATE TABLE IF NOT EXISTS `grupo_sabores_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `grupo_sabor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_precios`
--

CREATE TABLE IF NOT EXISTS `historico_precios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `producto_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=461 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_reservations`
--

CREATE TABLE IF NOT EXISTS `hotel_reservations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `room_id` int(10) NOT NULL,
  `cliente_id` int(10) NOT NULL,
  `observation` text,
  `passengers` int(10) NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_rooms`
--

CREATE TABLE IF NOT EXISTS `hotel_rooms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `room_state_id` int(10) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_room_states`
--

CREATE TABLE IF NOT EXISTS `hotel_room_states` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `color` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impfiscales`
--

CREATE TABLE IF NOT EXISTS `impfiscales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `path` varchar(64) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_categories`
--

CREATE TABLE IF NOT EXISTS `inventory_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_counts`
--

CREATE TABLE IF NOT EXISTS `inventory_counts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `count` float NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_products`
--

CREATE TABLE IF NOT EXISTS `inventory_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) COLLATE utf8_general_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva_responsabilidades`
--

CREATE TABLE IF NOT EXISTS `iva_responsabilidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_fiscal` varchar(1) COLLATE utf8_general_ci NOT NULL,
  `name` varchar(24) COLLATE utf8_general_ci NOT NULL,
  `tipo_factura_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `mozo_id` int(10) unsigned NOT NULL,
  `subtotal` float NOT NULL DEFAULT '0',
  `total` float(10,2) DEFAULT '0.00',
  `cliente_id` int(10) unsigned DEFAULT '0',
  `descuento_id` int(11) DEFAULT NULL,
  `menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'es para cuando un cliente quiere imprimir el importe como MENU sin que se vea lo que consumio',
  `cant_comensales` int(11) DEFAULT '0',
  `estado_id` tinyint(4) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `time_cerro` timestamp NULL DEFAULT NULL,
  `time_cobro` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `time_cerro` (`time_cerro`,`time_cobro`),
  KEY `mozo_id` (`mozo_id`),
  KEY `numero` (`numero`),
  KEY `time_cobro` (`time_cobro`),
  KEY `created` (`time_cerro`,`mozo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=3302 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mozos`
--

CREATE TABLE IF NOT EXISTS `mozos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `apellido` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `image_url` varchar(256) COLLATE utf8_general_ci DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `numero` (`numero`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE IF NOT EXISTS `observaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion_comandas`
--

CREATE TABLE IF NOT EXISTS `observacion_comandas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mesa_id` int(10) unsigned NOT NULL,
  `tipo_de_pago_id` int(10) unsigned NOT NULL,
  `valor` float NOT NULL COMMENT 'por ahora este campo vale cuando el tipo de pago es mixto, entonces se pone la cantidad de efectivo que pagó. Para poder hacer el arqueo.',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=2785 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pquery_categories`
--

CREATE TABLE IF NOT EXISTS `pquery_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pquery_queries`
--

CREATE TABLE IF NOT EXISTS `pquery_queries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(78) COLLATE utf8_general_ci NOT NULL,
  `description` text COLLATE utf8_general_ci,
  `query` text COLLATE utf8_general_ci NOT NULL,
  `ver_online` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `expiration_time` timestamp NULL DEFAULT NULL,
  `columns` text COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `printers`
--

CREATE TABLE IF NOT EXISTS `printers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `alias` varchar(32) NOT NULL,
  `driver` varchar(32) NOT NULL,
  `driver_model` varchar(32) NULL,
  `output` varchar(64) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_general_ci NOT NULL,
  `abrev` varchar(28) COLLATE utf8_general_ci NOT NULL,
  `description` text COLLATE utf8_general_ci NOT NULL,
  `categoria_id` int(10) unsigned NOT NULL,
  `precio` float(10,2) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `order` int(11) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1078 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_precios_futuros`
--

CREATE TABLE IF NOT EXISTS `productos_precios_futuros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `producto_id` (`producto_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_tags`
--

CREATE TABLE IF NOT EXISTS `productos_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE IF NOT EXISTS `restaurantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `machin_name` VARCHAR( 64 ) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabores`
--

CREATE TABLE IF NOT EXISTS `sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `grupo_sabor_id` int(11) NULL,
  `precio` float NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=123 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_pagos`
--

CREATE TABLE IF NOT EXISTS `tipo_de_pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(110) COLLATE utf8_general_ci NOT NULL,
  `image_url` varchar(200) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE IF NOT EXISTS `tipo_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_fiscal` varchar(1) COLLATE utf8_general_ci NOT NULL,
  `name` varchar(24) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_facturas`
--

CREATE TABLE IF NOT EXISTS `tipo_facturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `codename` varchar(1) COLLATE utf8_general_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=9 ;



CREATE TABLE IF NOT EXISTS `printer_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `printer_id` int(11) NOT NULL,
  `text` text  CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);


