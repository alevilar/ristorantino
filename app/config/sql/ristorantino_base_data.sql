
--
-- Table structure for table `account_cierres`
--

CREATE TABLE IF NOT EXISTS `account_cierres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `account_clasificaciones`
--

CREATE TABLE IF NOT EXISTS `account_clasificaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `account_egresos`
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
);

-- --------------------------------------------------------

--
-- Table structure for table `account_egresos_gastos`
--

CREATE TABLE IF NOT EXISTS `account_egresos_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `egreso_id` int(11) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `account_gastos`
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
);

-- --------------------------------------------------------

--
-- Table structure for table `account_gastos_tipo_impuestos`
--

CREATE TABLE IF NOT EXISTS `account_gastos_tipo_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `tipo_impuesto_id` int(11) NOT NULL,
  `importe` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `account_impuestos`
--

CREATE TABLE IF NOT EXISTS `account_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasto_id` int(11) NOT NULL,
  `tipo_impuesto_id` int(11) NOT NULL,
  `neto` decimal(10,2) DEFAULT '0.00',
  `importe` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `account_proveedores`
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
);

-- --------------------------------------------------------

--
-- Table structure for table `account_tipo_impuestos`
--

CREATE TABLE IF NOT EXISTS `account_tipo_impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `porcentaje` decimal(6,2) NOT NULL,
  `tiene_neto` tinyint(1) NOT NULL DEFAULT '1',
  `tiene_impuesto` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `_read` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `_update` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `_delete` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `cake_sessions`
--

CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `cash_arqueos`
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
);

-- --------------------------------------------------------

--
-- Table structure for table `cash_cajas`
--

CREATE TABLE IF NOT EXISTS `cash_cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(124) NOT NULL,
  `computa_ingresos` tinyint(1) NOT NULL DEFAULT '1',
  `computa_egresos` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `cash_zetas`
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
);

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned DEFAULT NULL,
  `rght` int(10) unsigned DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `image_url` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent_id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `mail` varchar(110) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descuento_id` int(10) unsigned DEFAULT '0',
  `tipofactura` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imprime_ticket` tinyint(1) DEFAULT '1',
  `nombre` varchar(110) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nrodocumento` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipodocumento` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `domicilio` varchar(110) COLLATE utf8_spanish_ci DEFAULT NULL,
  `responsabilidad_iva` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'ver el listado de posibilidades de CHARs para la responsabilidad del IVA, se pude ver en el codigo fuente, pero es casi un standar',
  `iva_responsabilidad_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `comandas`
--

CREATE TABLE IF NOT EXISTS `comandas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mesa_id` int(11) NOT NULL,
  `prioridad` tinyint(4) NOT NULL,
  `impresa` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `observacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`),
  KEY `mesa_id` (`mesa_id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `comanderas`
--

CREATE TABLE IF NOT EXISTS `comanderas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `path` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `imprime_ticket` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'me dice si imprime o no tickets factura',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `comensales`
--

CREATE TABLE IF NOT EXISTS `comensales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cant_mayores` tinyint(4) NOT NULL,
  `cant_menores` tinyint(4) NOT NULL,
  `cant_bebes` tinyint(4) NOT NULL,
  `mesa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
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
);

-- --------------------------------------------------------

--
-- Table structure for table `config_categories`
--

CREATE TABLE IF NOT EXISTS `config_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `descuentos`
--

CREATE TABLE IF NOT EXISTS `descuentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `porcentaje` float NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_comandas`
--

CREATE TABLE IF NOT EXISTS `detalle_comandas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) unsigned NOT NULL,
  `cant` FLOAT( 4 ) NOT NULL,
  `cant_eliminada` tinyint(4) NOT NULL DEFAULT '0',
  `comanda_id` int(11) unsigned NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `es_entrada` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mesa_id_2` (`comanda_id`),
  KEY `producto_id` (`producto_id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_sabores`
--

CREATE TABLE IF NOT EXISTS `detalle_sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detalle_comanda_id` int(11) NOT NULL,
  `sabor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `egresos`
--

CREATE TABLE IF NOT EXISTS `egresos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_factura_id` int(11) DEFAULT NULL,
  `iva` float(10,2) DEFAULT '0.00',
  `iibb` float(10,2) DEFAULT '0.00',
  `otros` float(10,2) DEFAULT '0.00',
  `total` float(10,2) NOT NULL DEFAULT '0.00',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `gastos`
--

CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `importe` float(10,2) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `historico_precios`
--

CREATE TABLE IF NOT EXISTS `historico_precios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `producto_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `impfiscales`
--

CREATE TABLE IF NOT EXISTS `impfiscales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `path` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_categories`
--

CREATE TABLE IF NOT EXISTS `inventory_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_counts`
--

CREATE TABLE IF NOT EXISTS `inventory_counts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `count` float NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_products`
--

CREATE TABLE IF NOT EXISTS `inventory_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `iva_responsabilidades`
--

CREATE TABLE IF NOT EXISTS `iva_responsabilidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_fiscal` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `mesas`
--

CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `mozo_id` int(10) unsigned NOT NULL,
  `subtotal` float NOT NULL DEFAULT '0',
  `total` float(10,2) DEFAULT '0.00',
  `cliente_id` int(10) unsigned DEFAULT '0',
  `menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'es para cuando un cliente quiere imprimir el importe como MENU sin que se vea lo que consumio',
  `cant_comensales` int(11) DEFAULT '0',
  `estado_id` tinyint(4) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `time_cerro` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_cobro` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `time_cerro` (`time_cerro`,`time_cobro`),
  KEY `mozo_id` (`mozo_id`),
  KEY `numero` (`numero`),
  KEY `time_cobro` (`time_cobro`),
  KEY `created` (`time_cerro`,`mozo_id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `mozos`
--

CREATE TABLE IF NOT EXISTS `mozos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `numero` (`numero`)
);

-- --------------------------------------------------------

--
-- Table structure for table `observaciones`
--

CREATE TABLE IF NOT EXISTS `observaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `observacion_comandas`
--

CREATE TABLE IF NOT EXISTS `observacion_comandas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mesa_id` int(10) unsigned NOT NULL,
  `tipo_de_pago_id` int(10) unsigned NOT NULL,
  `valor` float NOT NULL COMMENT 'por ahora este campo vale cuando el tipo de pago es mixto, entonces se pone la cantidad de efectivo que pagó. Para poder hacer el arqueo.',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `pquery_categories`
--

CREATE TABLE IF NOT EXISTS `pquery_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `pquery_queries`
--

CREATE TABLE IF NOT EXISTS `pquery_queries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(78) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci,
  `query` text COLLATE utf8_spanish_ci NOT NULL,
  `ver_online` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `expiration_time` timestamp NULL DEFAULT NULL,
  `columns` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `abrev` varchar(28) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `categoria_id` int(10) unsigned NOT NULL,
  `precio` float(10,2) NOT NULL,
  `comandera_id` int(11) NOT NULL,
  `order` int(11) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `productos_precios_futuros`
--

CREATE TABLE IF NOT EXISTS `productos_precios_futuros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `personas` int(11) NOT NULL,
  `mesa` text NOT NULL,
  `observaciones` text NOT NULL,
  `evento` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `restaurantes`
--

CREATE TABLE IF NOT EXISTS `restaurantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `sabores`
--

CREATE TABLE IF NOT EXISTS `sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_de_pagos`
--

CREATE TABLE IF NOT EXISTS `tipo_de_pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(110) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci,
  `image_url` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_documentos`
--

CREATE TABLE IF NOT EXISTS `tipo_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_fiscal` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_facturas`
--

CREATE TABLE IF NOT EXISTS `tipo_facturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `role` varchar(64) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'invitado',
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_spanish_ci NOT NULL DEFAULT '''''',
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio` varchar(110) COLLATE utf8_spanish_ci NOT NULL DEFAULT '''''',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);


CREATE TABLE IF NOT EXISTS `printer_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `printer_id` int(11) NOT NULL,
  `text` text  CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);






INSERT INTO `acos` (`parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(NULL, NULL, NULL, 'controllers', 1, 1060),
(1, NULL, NULL, 'Pages', 2, 15),
(2, NULL, NULL, 'display', 3, 4),
(2, NULL, NULL, 'add', 5, 6),
(2, NULL, NULL, 'edit', 7, 8),
(2, NULL, NULL, 'index', 9, 10),
(2, NULL, NULL, 'view', 11, 12),
(2, NULL, NULL, 'delete', 13, 14),
(1, NULL, NULL, 'Mozos', 16, 29),
(9, NULL, NULL, 'index', 17, 18),
(9, NULL, NULL, 'view', 19, 20),
( 9, NULL, NULL, 'add', 21, 22),
( 9, NULL, NULL, 'edit', 23, 24),
( 9, NULL, NULL, 'delete', 25, 26),
( 9, NULL, NULL, 'mesas_abiertas', 27, 28),
(1, NULL, NULL, 'Observaciones', 30, 41),
(16, NULL, NULL, 'add', 31, 32),
(16, NULL, NULL, 'edit', 33, 34),
(16, NULL, NULL, 'index', 35, 36),
(16, NULL, NULL, 'view', 37, 38),
(16, NULL, NULL, 'delete', 39, 40),
(1, NULL, NULL, 'Configs', 42, 55),
(22, NULL, NULL, 'toggle_remito', 43, 44),
(22, NULL, NULL, 'add', 45, 46),
(22, NULL, NULL, 'edit', 47, 48),
(22, NULL, NULL, 'index', 49, 50),
(22, NULL, NULL, 'view', 51, 52),
(22, NULL, NULL, 'delete', 53, 54),
(1, NULL, NULL, 'Reservas', 56, 67),
(29, NULL, NULL, 'index', 57, 58),
(29, NULL, NULL, 'view', 59, 60),
(29, NULL, NULL, 'add', 61, 62),
(29, NULL, NULL, 'edit', 63, 64),
(29, NULL, NULL, 'delete', 65, 66),
(1, NULL, NULL, 'Sabores', 68, 79),
(35, NULL, NULL, 'index', 69, 70),
(35, NULL, NULL, 'view', 71, 72),
(35, NULL, NULL, 'add', 73, 74),
(35, NULL, NULL, 'edit', 75, 76),
(35, NULL, NULL, 'delete', 77, 78),
(1, NULL, NULL, 'ObservacionComandas', 80, 91),
(41, NULL, NULL, 'add', 81, 82),
(41, NULL, NULL, 'edit', 83, 84),
( 41, NULL, NULL, 'index', 85, 86),
( 41, NULL, NULL, 'view', 87, 88),
( 41, NULL, NULL, 'delete', 89, 90),
( 1, NULL, NULL, 'Categorias', 92, 111),
( 47, NULL, NULL, 'index', 93, 94),
( 47, NULL, NULL, 'reordenar', 95, 96),
( 47, NULL, NULL, 'view', 97, 98),
( 47, NULL, NULL, 'recover', 99, 100),
( 47, NULL, NULL, 'verify', 101, 102),
( 47, NULL, NULL, 'edit', 103, 104),
( 47, NULL, NULL, 'delete', 105, 106),
( 47, NULL, NULL, 'listar', 107, 108),
(47, NULL, NULL, 'add', 109, 110),
( 1, NULL, NULL, 'TipoFacturas', 112, 133),
( 57, NULL, NULL, 'index', 113, 114),
( 57, NULL, NULL, 'view', 115, 116),
( 57, NULL, NULL, 'add', 117, 118),
( 57, NULL, NULL, 'edit', 119, 120),
( 57, NULL, NULL, 'delete', 121, 122),
( 57, NULL, NULL, 'admin_index', 123, 124),
( 57, NULL, NULL, 'admin_view', 125, 126),
( 57, NULL, NULL, 'admin_add', 127, 128),
( 57, NULL, NULL, 'admin_edit', 129, 130),
( 57, NULL, NULL, 'admin_delete', 131, 132),
( 1, NULL, NULL, 'Aclprep', 134, 161),
( 68, NULL, NULL, 'buildAcos', 135, 136),
( 68, NULL, NULL, 'buildAros', 137, 138),
( 68, NULL, NULL, 'assignPermissions', 139, 140),
( 68, NULL, NULL, 'assignPermissions1Dot6', 141, 142),
(68, NULL, NULL, 'assignPermissions1Dot6Dot2', 143, 144),
( 68, NULL, NULL, 'assignPermissions1Dot6Dot3', 145, 146),
( 68, NULL, NULL, 'assignPermissions1Dot6Dot4', 147, 148),
( 68, NULL, NULL, 'checkPermissions', 149, 150),
( 68, NULL, NULL, 'add', 151, 152),
( 68, NULL, NULL, 'edit', 153, 154),
( 68, NULL, NULL, 'index', 155, 156),
( 68, NULL, NULL, 'view', 157, 158),
( 68, NULL, NULL, 'delete', 159, 160),
( 1, NULL, NULL, 'TipoDocumentos', 162, 173),
( 82, NULL, NULL, 'index', 163, 164),
( 82, NULL, NULL, 'view', 165, 166),
( 82, NULL, NULL, 'add', 167, 168),
( 82, NULL, NULL, 'edit', 169, 170),
( 82, NULL, NULL, 'delete', 171, 172),
( 1, NULL, NULL, 'Restaurantes', 174, 185),
( 88, NULL, NULL, 'index', 175, 176),
( 88, NULL, NULL, 'view', 177, 178),
( 88, NULL, NULL, 'add', 179, 180),
( 88, NULL, NULL, 'edit', 181, 182),
( 88, NULL, NULL, 'delete', 183, 184),
( 1, NULL, NULL, 'Egresos', 186, 199),
( 94, NULL, NULL, 'index', 187, 188),
( 94, NULL, NULL, 'ajax_agregar_gasto', 189, 190),
( 94, NULL, NULL, 'view', 191, 192),
( 94, NULL, NULL, 'add', 193, 194),
( 94, NULL, NULL, 'edit', 195, 196),
( 94, NULL, NULL, 'delete', 197, 198),
( 1, NULL, NULL, 'Comandas', 200, 213),
( 101, NULL, NULL, 'add', 201, 202),
(101, NULL, NULL, 'index', 203, 204),
( 101, NULL, NULL, 'imprimir', 205, 206),
( 101, NULL, NULL, 'edit', 207, 208),
(101, NULL, NULL, 'view', 209, 210),
(101, NULL, NULL, 'delete', 211, 212),
( 1, NULL, NULL, 'DetalleSabores', 214, 225),
( 108, NULL, NULL, 'add', 215, 216),
( 108, NULL, NULL, 'edit', 217, 218),
( 108, NULL, NULL, 'index', 219, 220),
( 108, NULL, NULL, 'view', 221, 222),
( 108, NULL, NULL, 'delete', 223, 224),
( 1, NULL, NULL, 'Users', 226, 253),
( 114, NULL, NULL, 'index', 227, 228),
( 114, NULL, NULL, 'listar_x_nombre', 229, 230),
( 114, NULL, NULL, 'view', 231, 232),
( 114, NULL, NULL, 'add', 233, 234),
( 114, NULL, NULL, 'edit', 235, 236),
( 114, NULL, NULL, 'delete', 237, 238),
( 114, NULL, NULL, 'login', 239, 240),
( 114, NULL, NULL, 'logout', 241, 242),
( 114, NULL, NULL, 'self_user_edit', 243, 244),
( 114, NULL, NULL, 'cambiar_password', 245, 246),
( 114, NULL, NULL, 'verificar', 247, 248),
( 114, NULL, NULL, 'arreglar', 249, 250),
( 114, NULL, NULL, 'listadoUsuarios', 251, 252),
( 1, NULL, NULL, 'Comanderas', 254, 265),
( 128, NULL, NULL, 'index', 255, 256),
( 128, NULL, NULL, 'view', 257, 258),
( 128, NULL, NULL, 'add', 259, 260),
( 128, NULL, NULL, 'edit', 261, 262),
( 128, NULL, NULL, 'delete', 263, 264),
( 1, NULL, NULL, 'Pagos', 266, 277),
( 134, NULL, NULL, 'index', 267, 268),
(134, NULL, NULL, 'view', 269, 270),
( 134, NULL, NULL, 'add', 271, 272),
( 134, NULL, NULL, 'edit', 273, 274),
( 134, NULL, NULL, 'delete', 275, 276),
( 1, NULL, NULL, 'IvaResponsabilidades', 278, 289),
( 140, NULL, NULL, 'index', 279, 280),
( 140, NULL, NULL, 'view', 281, 282),
( 140, NULL, NULL, 'add', 283, 284),
( 140, NULL, NULL, 'edit', 285, 286),
( 140, NULL, NULL, 'delete', 287, 288),
( 1, NULL, NULL, 'Descuentos', 290, 301),
( 146, NULL, NULL, 'index', 291, 292),
( 146, NULL, NULL, 'view', 293, 294),
( 146, NULL, NULL, 'add', 295, 296),
( 146, NULL, NULL, 'edit', 297, 298),
(146, NULL, NULL, 'delete', 299, 300),
(1, NULL, NULL, 'ConfigCategories', 302, 313),
(152, NULL, NULL, 'add', 303, 304),
( 152, NULL, NULL, 'edit', 305, 306),
( 152, NULL, NULL, 'index', 307, 308),
( 152, NULL, NULL, 'view', 309, 310),
( 152, NULL, NULL, 'delete', 311, 312),
( 1, NULL, NULL, 'DetalleComandas', 314, 329),
( 158, NULL, NULL, 'index', 315, 316),
( 158, NULL, NULL, 'prueba', 317, 318),
( 158, NULL, NULL, 'view', 319, 320),
( 158, NULL, NULL, 'sacarProductos', 321, 322),
( 158, NULL, NULL, 'add', 323, 324),
( 158, NULL, NULL, 'edit', 325, 326),
( 158, NULL, NULL, 'delete', 327, 328),
( 1, NULL, NULL, 'ProductosPreciosFuturos', 330, 341),
(166, NULL, NULL, 'index', 331, 332),
( 166, NULL, NULL, 'add', 333, 334),
( 166, NULL, NULL, 'edit', 335, 336),
( 166, NULL, NULL, 'view', 337, 338),
( 166, NULL, NULL, 'delete', 339, 340),
( 1, NULL, NULL, 'TipoDePagos', 342, 353),
( 172, NULL, NULL, 'index', 343, 344),
( 172, NULL, NULL, 'view', 345, 346),
( 172, NULL, NULL, 'edit', 347, 348),
( 172, NULL, NULL, 'delete', 349, 350),
( 172, NULL, NULL, 'add', 351, 352),
( 1, NULL, NULL, 'Productos', 354, 375),
( 178, NULL, NULL, 'index', 355, 356),
( 178, NULL, NULL, 'view', 357, 358),
( 178, NULL, NULL, 'buscar_por_nombre', 359, 360),
( 178, NULL, NULL, 'add', 361, 362),
( 178, NULL, NULL, 'edit', 363, 364),
( 178, NULL, NULL, 'delete', 365, 366),
( 178, NULL, NULL, 'buscarProductos', 367, 368),
( 178, NULL, NULL, 'actualizarPreciosFuturos', 369, 370),
( 178, NULL, NULL, 'sinpreciosfuturos', 371, 372),
(178, NULL, NULL, 'update', 373, 374),
( 1, NULL, NULL, 'Mesas', 376, 405),
( 189, NULL, NULL, 'index', 377, 378),
( 189, NULL, NULL, 'view', 379, 380),
( 189, NULL, NULL, 'ticket_view', 381, 382),
( 189, NULL, NULL, 'cerrarMesa', 383, 384),
( 189, NULL, NULL, 'imprimirTicket', 385, 386),
( 189, NULL, NULL, 'abrirMesa', 387, 388),
( 189, NULL, NULL, 'add', 389, 390),
( 189, NULL, NULL, 'ajax_edit', 391, 392),
( 189, NULL, NULL, 'edit', 393, 394),
( 189, NULL, NULL, 'delete', 395, 396),
(189, NULL, NULL, 'cerradas', 397, 398),
(189, NULL, NULL, 'abiertas', 399, 400),
(189, NULL, NULL, 'reabrir', 401, 402),
( 189, NULL, NULL, 'addClienteToMesa', 403, 404),
(1, NULL, NULL, 'Clientes', 406, 427),
( 204, NULL, NULL, 'index', 407, 408),
( 204, NULL, NULL, 'view', 409, 410),
( 204, NULL, NULL, 'add', 411, 412),
( 204, NULL, NULL, 'addFacturaA', 413, 414),
( 204, NULL, NULL, 'edit', 415, 416),
( 204, NULL, NULL, 'delete', 417, 418),
( 204, NULL, NULL, 'ajax_buscador', 419, 420),
( 204, NULL, NULL, 'jqm_clientes', 421, 422),
( 204, NULL, NULL, 'ajax_clientes_factura_a', 423, 424),
( 204, NULL, NULL, 'ajax_clientes_con_descuento', 425, 426),
( 1, NULL, NULL, 'Account', 428, 515),
( 215, NULL, NULL, 'TipoImpuestos', 429, 440),
( 216, NULL, NULL, 'index', 430, 431),
( 216, NULL, NULL, 'view', 432, 433),
( 216, NULL, NULL, 'add', 434, 435),
( 216, NULL, NULL, 'edit', 436, 437),
( 216, NULL, NULL, 'delete', 438, 439),
( 215, NULL, NULL, 'Account', 441, 514),
( 222, NULL, NULL, 'index', 442, 443),
( 222, NULL, NULL, 'arqueo', 444, 445),
( 222, NULL, NULL, 'success', 446, 447),
( 222, NULL, NULL, 'failure', 448, 449),
( 222, NULL, NULL, 'add', 450, 451),
( 222, NULL, NULL, 'edit', 452, 453),
( 222, NULL, NULL, 'view', 454, 455),
( 222, NULL, NULL, 'delete', 456, 457),
( 222, NULL, NULL, 'Proveedores', 458, 469),
( 231, NULL, NULL, 'index', 459, 460),
(231, NULL, NULL, 'view', 461, 462),
( 231, NULL, NULL, 'add', 463, 464),
( 231, NULL, NULL, 'edit', 465, 466),
( 231, NULL, NULL, 'delete', 467, 468),
( 222, NULL, NULL, 'Gastos', 470, 485),
( 237, NULL, NULL, 'index', 471, 472),
( 237, NULL, NULL, 'view', 473, 474),
( 237, NULL, NULL, 'add', 475, 476),
( 237, NULL, NULL, 'edit', 477, 478),
( 237, NULL, NULL, 'delete', 479, 480),
( 237, NULL, NULL, 'success', 481, 482),
( 237, NULL, NULL, 'failure', 483, 484),
( 222, NULL, NULL, 'GastosTipoImpuestos', 486, 497),
( 245, NULL, NULL, 'index', 487, 488),
(245, NULL, NULL, 'view', 489, 490),
(245, NULL, NULL, 'add', 491, 492),
(245, NULL, NULL, 'edit', 493, 494),
( 245, NULL, NULL, 'delete', 495, 496),
( 222, NULL, NULL, 'Vales', 498, 513),
(251, NULL, NULL, 'index', 499, 500),
( 251, NULL, NULL, 'add', 501, 502),
( 251, NULL, NULL, 'edit', 503, 504),
( 251, NULL, NULL, 'delete', 505, 506),
( 251, NULL, NULL, 'success', 507, 508),
(251, NULL, NULL, 'failure', 509, 510),
( 251, NULL, NULL, 'view', 511, 512),
( 1, NULL, NULL, 'Acl', 516, 631),
( 259, NULL, NULL, 'AclAros', 517, 540),
( 260, NULL, NULL, 'load', 518, 519),
( 260, NULL, NULL, 'delete', 520, 521),
( 260, NULL, NULL, 'children', 522, 523),
( 260, NULL, NULL, 'add', 524, 525),
( 260, NULL, NULL, 'update', 526, 527),
(260, NULL, NULL, 'test', 528, 529),
( 260, NULL, NULL, 'success', 530, 531),
( 260, NULL, NULL, 'failure', 532, 533),
(260, NULL, NULL, 'edit', 534, 535),
(260, NULL, NULL, 'index', 536, 537),
( 260, NULL, NULL, 'view', 538, 539),
( 259, NULL, NULL, 'AclAcos', 541, 562),
( 272, NULL, NULL, 'load', 542, 543),
( 272, NULL, NULL, 'delete', 544, 545),
( 272, NULL, NULL, 'children', 546, 547),
( 272, NULL, NULL, 'add', 548, 549),
( 272, NULL, NULL, 'update', 550, 551),
( 272, NULL, NULL, 'success', 552, 553),
( 272, NULL, NULL, 'failure', 554, 555),
( 272, NULL, NULL, 'edit', 556, 557),
( 272, NULL, NULL, 'index', 558, 559),
( 272, NULL, NULL, 'view', 560, 561),
( 259, NULL, NULL, 'Acl', 563, 630),
( 283, NULL, NULL, 'admin_index', 564, 565),
( 283, NULL, NULL, 'admin_aros', 566, 567),
( 283, NULL, NULL, 'admin_acos', 568, 569),
( 283, NULL, NULL, 'admin_permissions', 570, 571),
( 283, NULL, NULL, 'admin_tree', 572, 573),
( 283, NULL, NULL, 'success', 574, 575),
( 283, NULL, NULL, 'failure', 576, 577),
( 283, NULL, NULL, 'add', 578, 579),
( 283, NULL, NULL, 'edit', 580, 581),
( 283, NULL, NULL, 'index', 582, 583),
( 283, NULL, NULL, 'view', 584, 585),
( 283, NULL, NULL, 'delete', 586, 587),
( 283, NULL, NULL, 'AclPermissions', 588, 613),
( 296, NULL, NULL, 'exists', 589, 590),
( 296, NULL, NULL, 'create', 591, 592),
(296, NULL, NULL, 'aros', 593, 594),
( 296, NULL, NULL, 'acos', 595, 596),
( 296, NULL, NULL, 'revoke', 597, 598),
( 296, NULL, NULL, 'success', 599, 600),
(296, NULL, NULL, 'failure', 601, 602),
(296, NULL, NULL, 'add', 603, 604),
(296, NULL, NULL, 'edit', 605, 606),
( 296, NULL, NULL, 'index', 607, 608),
(296, NULL, NULL, 'view', 609, 610),
(296, NULL, NULL, 'delete', 611, 612),
(283, NULL, NULL, 'AclScripts', 614, 629),
( 309, NULL, NULL, 'success', 615, 616),
(309, NULL, NULL, 'failure', 617, 618),
( 309, NULL, NULL, 'add', 619, 620),
(309, NULL, NULL, 'edit', 621, 622),
( 309, NULL, NULL, 'index', 623, 624),
(309, NULL, NULL, 'view', 625, 626),
( 309, NULL, NULL, 'delete', 627, 628),
(1, NULL, NULL, 'Adition', 632, 741),
(317, NULL, NULL, 'Adition', 633, 740),
(318, NULL, NULL, 'home', 634, 635),
( 318, NULL, NULL, 'abrirMesa', 636, 637),
(318, NULL, NULL, 'adicionar', 638, 639),
(318, NULL, NULL, 'cambiarMozo', 640, 641),
( 318, NULL, NULL, 'success', 642, 643),
(318, NULL, NULL, 'failure', 644, 645),
( 318, NULL, NULL, 'add', 646, 647),
(318, NULL, NULL, 'edit', 648, 649),
( 318, NULL, NULL, 'index', 650, 651),
(318, NULL, NULL, 'view', 652, 653),
( 318, NULL, NULL, 'delete', 654, 655),
(318, NULL, NULL, 'Cashier', 656, 739),
(330, NULL, NULL, 'reiniciar', 657, 658),
( 330, NULL, NULL, 'apagar', 659, 660),
(330, NULL, NULL, 'cierre_z', 661, 662),
( 330, NULL, NULL, 'cierre_x', 663, 664),
(330, NULL, NULL, 'nota_credito', 665, 666),
( 330, NULL, NULL, 'vaciar_cola_impresion_fiscal', 667, 668),
(330, NULL, NULL, 'listar_dispositivos', 669, 670),
( 330, NULL, NULL, 'print_dnf', 671, 672),
(330, NULL, NULL, 'cobrar', 673, 674),
(330, NULL, NULL, 'ajax_mesas_x_cobrar', 675, 676),
( 330, NULL, NULL, 'mesas_abiertas', 677, 678),
( 330, NULL, NULL, 'ultimas_cobradas', 679, 680),
( 330, NULL, NULL, 'activar_webcam', 681, 682),
( 330, NULL, NULL, 'success', 683, 684),
( 330, NULL, NULL, 'failure', 685, 686),
(330, NULL, NULL, 'add', 687, 688),
( 330, NULL, NULL, 'edit', 689, 690),
( 330, NULL, NULL, 'index', 691, 692),
( 330, NULL, NULL, 'view', 693, 694),
( 330, NULL, NULL, 'delete', 695, 696),
( 330, NULL, NULL, 'Cashier', 697, 738),
( 351, NULL, NULL, 'reiniciar', 698, 699),
( 351, NULL, NULL, 'apagar', 700, 701),
( 351, NULL, NULL, 'cierre_z', 702, 703),
( 351, NULL, NULL, 'cierre_x', 704, 705),
(351, NULL, NULL, 'nota_credito', 706, 707),
(351, NULL, NULL, 'vaciar_cola_impresion_fiscal', 708, 709),
(351, NULL, NULL, 'listar_dispositivos', 710, 711),
(351, NULL, NULL, 'print_dnf', 712, 713),
(351, NULL, NULL, 'cobrar', 714, 715),
(351, NULL, NULL, 'ajax_mesas_x_cobrar', 716, 717),
( 351, NULL, NULL, 'mesas_abiertas', 718, 719),
(351, NULL, NULL, 'ultimas_cobradas', 720, 721),
( 351, NULL, NULL, 'activar_webcam', 722, 723),
(351, NULL, NULL, 'success', 724, 725),
(351, NULL, NULL, 'failure', 726, 727),
( 351, NULL, NULL, 'add', 728, 729),
(351, NULL, NULL, 'edit', 730, 731),
( 351, NULL, NULL, 'index', 732, 733),
(351, NULL, NULL, 'view', 734, 735),
( 351, NULL, NULL, 'delete', 736, 737),
(1, NULL, NULL, 'Inventory', 742, 795),
( 372, NULL, NULL, 'Counts', 743, 756),
( 373, NULL, NULL, 'listar_faltantes_para_imprimir', 744, 745),
(373, NULL, NULL, 'add', 746, 747),
( 373, NULL, NULL, 'edit', 748, 749),
(373, NULL, NULL, 'index', 750, 751),
( 373, NULL, NULL, 'view', 752, 753),
(373, NULL, NULL, 'delete', 754, 755),
( 372, NULL, NULL, 'Inventory', 757, 794),
(380, NULL, NULL, 'index', 758, 759),
(380, NULL, NULL, 'add', 760, 761),
( 380, NULL, NULL, 'edit', 762, 763),
(380, NULL, NULL, 'view', 764, 765),
(380, NULL, NULL, 'delete', 766, 767),
( 380, NULL, NULL, 'Products', 768, 781),
(386, NULL, NULL, 'index', 769, 770),
(386, NULL, NULL, 'update', 771, 772),
( 386, NULL, NULL, 'add', 773, 774),
(386, NULL, NULL, 'view', 775, 776),
( 386, NULL, NULL, 'edit', 777, 778),
(386, NULL, NULL, 'delete', 779, 780),
(380, NULL, NULL, 'Categories', 782, 793),
( 393, NULL, NULL, 'add', 783, 784),
(393, NULL, NULL, 'edit', 785, 786),
( 393, NULL, NULL, 'index', 787, 788),
(393, NULL, NULL, 'view', 789, 790),
(393, NULL, NULL, 'delete', 791, 792),
( 1, NULL, NULL, 'New Cashier', 796, 829),
( 399, NULL, NULL, 'Cashiers', 797, 828),
( 400, NULL, NULL, 'mesas_abiertas', 798, 799),
( 400, NULL, NULL, 'reiniciar', 800, 801),
( 400, NULL, NULL, 'cierre_x', 802, 803),
( 400, NULL, NULL, 'cierre_z', 804, 805),
( 400, NULL, NULL, 'vaciar_cola_impresion_fiscal', 806, 807),
( 400, NULL, NULL, 'print_dnf', 808, 809),
( 400, NULL, NULL, 'cobrar', 810, 811),
( 400, NULL, NULL, 'activar_webcam', 812, 813),
( 400, NULL, NULL, 'success', 814, 815),
( 400, NULL, NULL, 'failure', 816, 817),
(400, NULL, NULL, 'add', 818, 819),
( 400, NULL, NULL, 'edit', 820, 821),
( 400, NULL, NULL, 'index', 822, 823),
( 400, NULL, NULL, 'view', 824, 825),
(400, NULL, NULL, 'delete', 826, 827),
( 1, NULL, NULL, 'Pquery', 830, 1007),
(416, NULL, NULL, 'PqueryCategories', 831, 842),
( 417, NULL, NULL, 'add', 832, 833),
(417, NULL, NULL, 'edit', 834, 835),
( 417, NULL, NULL, 'index', 836, 837),
(417, NULL, NULL, 'view', 838, 839),
( 417, NULL, NULL, 'delete', 840, 841),
(416, NULL, NULL, 'Stats', 843, 982),
( 423, NULL, NULL, 'year', 844, 845),
(423, NULL, NULL, 'mesas_total', 846, 847),
( 423, NULL, NULL, 'mozos_total', 848, 849),
( 423, NULL, NULL, 'mesas_factura', 850, 851),
( 423, NULL, NULL, 'dia', 852, 853),
(423, NULL, NULL, 'index', 854, 855),
( 423, NULL, NULL, 'mozos_mesas', 856, 857),
( 423, NULL, NULL, 'mozos_pagos', 858, 859),
( 423, NULL, NULL, 'mozos_productos', 860, 861),
(423, NULL, NULL, 'mesas_ranking', 862, 863),
( 423, NULL, NULL, 'mesas_pago', 864, 865),
( 423, NULL, NULL, 'mesas_clientes', 866, 867),
( 423, NULL, NULL, 'cont_ingresos', 868, 869),
( 423, NULL, NULL, 'cont_caja', 870, 871),
( 423, NULL, NULL, 'prod_ranking', 872, 873),
(423, NULL, NULL, 'prod_ingresos', 874, 875),
( 423, NULL, NULL, 'prod_pedidos', 876, 877),
( 423, NULL, NULL, 'prod_listado', 878, 879),
( 423, NULL, NULL, 'real_mesasabiertas', 880, 881),
( 423, NULL, NULL, 'real_comandas', 882, 883),
(423, NULL, NULL, 'real_comensales', 884, 885),
( 423, NULL, NULL, 'real_mesasmozos', 886, 887),
(423, NULL, NULL, 'success', 888, 889),
( 423, NULL, NULL, 'failure', 890, 891),
( 423, NULL, NULL, 'add', 892, 893),
( 423, NULL, NULL, 'edit', 894, 895),
( 423, NULL, NULL, 'view', 896, 897),
( 423, NULL, NULL, 'delete', 898, 899),
( 416, NULL, NULL, 'Queries', 983, 1006),
( 452, NULL, NULL, 'index', 984, 985),
( 452, NULL, NULL, 'view', 986, 987),
( 452, NULL, NULL, 'add', 988, 989),
(452, NULL, NULL, 'edit', 990, 991),
( 452, NULL, NULL, 'delete', 992, 993),
( 452, NULL, NULL, 'descargar_queries', 994, 995),
( 452, NULL, NULL, 'contruye_excel', 996, 997),
( 452, NULL, NULL, 'get_columnas', 998, 999),
( 452, NULL, NULL, 'list_view', 1000, 1001),
( 452, NULL, NULL, 'success', 1002, 1003),
( 452, NULL, NULL, 'failure', 1004, 1005),
(1, NULL, NULL, 'PqueryOLD', 1008, 1033),
(464, NULL, NULL, 'Queries', 1009, 1032),
( 465, NULL, NULL, 'index', 1010, 1011),
( 465, NULL, NULL, 'view', 1012, 1013),
( 465, NULL, NULL, 'add', 1014, 1015),
(465, NULL, NULL, 'edit', 1016, 1017),
( 465, NULL, NULL, 'delete', 1018, 1019),
( 465, NULL, NULL, 'descargar_queries', 1020, 1021),
(465, NULL, NULL, 'contruye_excel', 1022, 1023),
( 465, NULL, NULL, 'get_columnas', 1024, 1025),
( 465, NULL, NULL, 'list_view', 1026, 1027),
( 465, NULL, NULL, 'success', 1028, 1029),
( 465, NULL, NULL, 'failure', 1030, 1031),
( 1, NULL, NULL, 'Robot', 1034, 1059),
( 477, NULL, NULL, 'Queries', 1035, 1058),
( 478, NULL, NULL, 'index', 1036, 1037),
( 478, NULL, NULL, 'view', 1038, 1039),
(478, NULL, NULL, 'add', 1040, 1041),
( 478, NULL, NULL, 'edit', 1042, 1043),
( 478, NULL, NULL, 'delete', 1044, 1045),
( 478, NULL, NULL, 'descargar_queries', 1046, 1047),
(478, NULL, NULL, 'contruye_excel', 1048, 1049),
( 478, NULL, NULL, 'get_columnas', 1050, 1051),
( 478, NULL, NULL, 'list_view', 1052, 1053),
( 478, NULL, NULL, 'success', 1054, 1055),
( 478, NULL, NULL, 'failure', 1056, 1057),
( 423, NULL, NULL, 'Stats', 900, 981),
( 490, NULL, NULL, 'year', 901, 902),
(490, NULL, NULL, 'mesas_total', 903, 904),
( 490, NULL, NULL, 'mozos_total', 905, 906),
(490, NULL, NULL, 'mesas_factura', 907, 908),
(490, NULL, NULL, 'dia', 909, 910),
( 490, NULL, NULL, 'index', 911, 912),
( 490, NULL, NULL, 'mozos_mesas', 913, 914),
( 490, NULL, NULL, 'mozos_pagos', 915, 916),
( 490, NULL, NULL, 'mozos_productos', 917, 918),
( 490, NULL, NULL, 'mesas_ranking', 919, 920),
( 490, NULL, NULL, 'mesas_pago', 921, 922),
( 490, NULL, NULL, 'mesas_clientes', 923, 924),
( 490, NULL, NULL, 'cont_ingresos', 925, 926),
( 490, NULL, NULL, 'cont_caja', 927, 928),
( 490, NULL, NULL, 'prod_ranking', 929, 930),
( 490, NULL, NULL, 'prod_ingresos', 931, 932),
( 490, NULL, NULL, 'prod_pedidos', 933, 934),
( 490, NULL, NULL, 'prod_listado', 935, 936),
( 490, NULL, NULL, 'real_mesasabiertas', 937, 938),
( 490, NULL, NULL, 'real_comandas', 939, 940),
( 490, NULL, NULL, 'real_comensales', 941, 942),
( 490, NULL, NULL, 'real_mesasmozos', 943, 944),
( 490, NULL, NULL, 'success', 945, 946),
( 490, NULL, NULL, 'failure', 947, 948),
( 490, NULL, NULL, 'add', 949, 950),
( 490, NULL, NULL, 'edit', 951, 952),
( 490, NULL, NULL, 'view', 953, 954),
(490, NULL, NULL, 'delete', 955, 956),
( 490, NULL, NULL, 'Queries', 957, 980),
( 519, NULL, NULL, 'index', 958, 959),
( 519, NULL, NULL, 'view', 960, 961),
( 519, NULL, NULL, 'add', 962, 963),
( 519, NULL, NULL, 'edit', 964, 965),
( 519, NULL, NULL, 'delete', 966, 967),
( 519, NULL, NULL, 'descargar_queries', 968, 969),
( 519, NULL, NULL, 'contruye_excel', 970, 971),
( 519, NULL, NULL, 'get_columnas', 972, 973),
( 519, NULL, NULL, 'list_view', 974, 975),
( 519, NULL, NULL, 'success', 976, 977),
( 519, NULL, NULL, 'failure', 978, 979);

--
-- Volcar la base de datos para la tabla `aros`
--

INSERT INTO `aros` (`parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(NULL, '', NULL, 'User', 1, 8),
(1, '', NULL, 'Gerente', 2, 7),
(2, 'User', 1, 'admin', 3, 4),
(2, 'User', 2, 'mozo', 5, 6);

--
-- Volcar la base de datos para la tabla `aros_acos`
--

INSERT INTO `aros_acos` ( `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
( 1, 1, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Volcar la base de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `parent_id`, `lft`, `rght`, `name`, `description`, `image_url`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, NULL, 1, 8, '/', '', '', '2012-11-28 22:57:10', '2012-11-28 22:57:10', NULL, 0),
(2, 1, 2, 3, 'Guarnicion', '', 'french_fries_icon.png', '2013-05-17 13:49:56', '2013-05-17 13:46:57', NULL, 0),
(3, 1, 4, 5, 'Bebidas', '', 'Pepsi_Classic_128.png', '2014-04-02 06:49:47', '2014-04-02 06:49:47', NULL, 0),
(4, 1, 6, 7, 'Hamburguesas', '', 'hamburger_128.png', '2014-04-02 06:53:54', '2014-04-02 06:53:54', NULL, 0);
-- --------------------------------------------------------

INSERT INTO `clientes` (`id`, `user_id`, `codigo`, `mail`, `telefono`, `descuento_id`, `tipofactura`, `imprime_ticket`, `nombre`, `nrodocumento`, `tipodocumento`, `tipo_documento_id`, `domicilio`, `responsabilidad_iva`, `iva_responsabilidad_id`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, NULL, 0, 'A', 1, 'EXAMPLE Google Arg. SRL', '33709585229', NULL, 1, NULL, NULL, 1, '2013-05-17 13:52:17', '2013-05-17 13:52:17');

--
-- Volcar la base de datos para la tabla `clientes`
--

--
-- Volcar la base de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id`, `mesa_id`, `prioridad`, `impresa`, `created`, `observacion`) VALUES
(1, 1, 0, NULL, '2012-11-28 23:07:32', '');




INSERT INTO `comanderas` (`id`, `name`, `description`, `path`, `imprime_ticket`) VALUES
(1, 'comanderacocina', 'comandera de la cocina', '/tmp', 0);


-- --------------------------------------------------------

--
-- Volcar la base de datos para la tabla `comanderas`
--

--
-- Volcar la base de datos para la tabla `comensales`
--


--
-- Volcar la base de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `config_category_id`, `key`, `value`, `description`, `created`, `modified`) VALUES
(1, 1, 'imprimePrimeroRemito', '1', 'Esta variable sirve para imprimir siempre un comprobante de consumicion antes de imprimir el ticket los valores posibles son 1 o 0 (para imprimir directamente la factura)', NULL, '2012-01-13 22:12:39'),
(2, 2, 'name', 'Nombre Comercio', 'Generalmente utilizado para las impresiones extra como remitos e informes', NULL, '2012-11-28 21:36:07'),
(3, 2, 'razon_social', '', '', NULL, NULL),
(4, 2, 'cuit', '', '', NULL, NULL),
(5, 2, 'ib', '', 'ingresos brutos', NULL, NULL),
(6, 2, 'iva_resp', '', '', NULL, NULL),
(7, 3, 'modelo', 'hasar_441', '', NULL, NULL),
(8, 4, 'usarCajero', '1', '', NULL, NULL),
(9, 1, 'tituloMesa', 'Mesa', '', NULL, '2012-11-28 21:36:24'),
(10, 1, 'tituloMozo', 'Mozo', '', NULL, '2012-11-28 21:36:46'),
(11, 4, 'cantidadCubiertosObligatorio', '0', '', NULL, '2012-11-28 21:36:59'),
(12, 3, 'tempFuente', '/tmp/fuente', '', NULL, NULL),
(13, 3, 'tempDest', '/tmp/dest', '', NULL, NULL),
(14, 3, 'TempImpfiscal', '/tmp/impfiscal', '', NULL, NULL),
(15, 5, 'debug', '0', '', NULL, '2012-11-28 22:22:06'),
(16, 6, 'descuento_maximo', '15', 'máximo porcentaje de descuento que puede hacer un mozo', NULL, NULL),
(17, 7, 'corte_del_dia', '6', 'Es el horario en el que se va a tomar como corte del dia. Funcionara para el arqueo de caja, recuento de mesas. Por ejemplo, si se dice que el corte del dia es a las 6, quiere decir que, lo que vendi hasta las 6AM pertenecen al dia anterior. O sea, si es sabado y pasan las 12 am, hasta las 6 de la madrugada del domingo, se dirá que lo vendido pertenece al día sabado.', NULL, NULL),
(18, 3, 'encoding', '', 'encoding para las impresoras, de esta forma saldrán los acentos. Lo que no funciona es la "Ñ" mayúscula', NULL, '2011-11-15 20:23:03'),
(19, 4, 'reload_interval', '3700', 'valor en milisegundos de actualizacion de nuevas mesas', NULL, '2012-11-28 21:37:22'),
(20, 4, 'reload_interval_timeout', '60000', 'valor en milisegundos que debe esperar el ajax para actualizar las mesas. Si el ajax no se resuelve. entonces se termina a la fuerza.', NULL, '2012-11-28 21:37:29'),
(21, 4, 'jqm_page_transition', '1', 'activar animaciones\r\n', NULL, '2012-11-28 21:37:44'),
(22, 3, 'server', 'auto', '', NULL, '2012-11-28 22:19:51'),
(23, 3, 'nombre', 'fiscalprinter', 'nombre de la impresora CUPS, es la impresora fiscal que para CUPS será una impresora que imprima "raw" en una carpeta particular donde estará leyendo el spooler', NULL, '2011-11-15 21:33:01'),
(24, 1, 'prueba', '1111111', '', '2011-11-04 09:21:31', '2011-11-04 09:21:31'),
(25, 2, 'valorCubierto', '0', '', '2011-11-06 17:55:21', '2011-11-15 20:10:11'),
(26, 2, 'mail', 'info@mail.com.ar', '', '2011-11-22 20:13:01', '2012-11-25 00:02:17'),
(27, 4, 'preTicketHeader', '            COMPROBANTE DE CONSUMICION', '', '2011-11-22 20:13:38', '2011-11-22 20:13:38'),
(28, 3, 'precision', '2', 'Cantidad de decimales a mostrar en los totales y en el ticket', NULL, NULL),
(29, 1, 'usar_generica', '1', 'va 0 o 1 dependiendo si quiero mostrar y adicionar con mesa generica (usa por defecto mozo 99, numero de mesa 99, y cero cubiertos para abrir la mesa generica)', NULL, NULL),
(30, 1, 'generica_name', 'Kiosko', 'Nombre generico para abrir mesas que sean de pronta atencion', NULL, NULL),
(31, 1, 'generica_mozo_id', '1', 'ID del mozo a utilizar como generico, generalmente tratamos de crear un mozo con numero 99 y usar ese. Pero por defecto el sistema usa el mozo con ID:1, que, por defecto es el mozo de identico numero (el 1)', NULL, NULL)
;



--
-- Volcar la base de datos para la tabla `config_categories`
--

INSERT INTO `config_categories` (`id`, `name`) VALUES
(1, 'Mesa'),
(2, 'Restaurante'),
(3, 'ImpresoraFiscal'),
(4, 'Adicion'),
(5, ''),
(6, 'Mozo'),
(7, 'Horario');

--
-- Volcar la base de datos para la tabla `descuentos`
--

--
-- Volcar la base de datos para la tabla `detalle_comandas`
--

INSERT INTO `detalle_comandas` (`id`, `producto_id`, `cant`, `cant_eliminada`, `comanda_id`, `observacion`, `created`, `modified`, `es_entrada`) VALUES
(1, 1, 1, 0, 1, '', '2012-11-28 23:07:32', '2012-11-28 23:07:32', 0);

-- --------------------------------------------------------

--
-- Volcar la base de datos para la tabla `detalle_sabores`
--


-- --------------------------------------------------------

--
-- Volcar la base de datos para la tabla `egresos`
--


--
-- Volcar la base de datos para la tabla `gastos`
--


--
-- Volcar la base de datos para la tabla `historico_precios`
--


--
-- Volcar la base de datos para la tabla `iva_responsabilidades`
--

INSERT INTO `iva_responsabilidades` (`id`, `codigo_fiscal`, `name`) VALUES
(1, 'I', 'Resp. Inscripto'),
(2, 'E', 'Exento'),
(3, 'A', 'No Responsable'),
(4, 'C', 'Consumidor Final'),
(5, 'T', 'No Categorizado');

-- --------------------------------------------------------

INSERT INTO `mesas` (`id`, `numero`, `mozo_id`, `subtotal`, `total`, `cliente_id`, `menu`, `cant_comensales`, `estado_id`, `created`, `modified`, `time_cerro`, `time_cobro`, `deleted_date`, `deleted`) VALUES
(1, 23, 1, 0, 0.00, 0, 0, 4, 1, '2013-05-17 13:44:44', '2013-05-17 13:44:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0),
(2, 1, 1, 221, 221.00, 1, 0, 2, 2, '2013-05-17 13:51:19', '2013-05-17 13:52:24', '2013-05-17 13:52:24', '0000-00-00 00:00:00', NULL, 0),
(3, 3, 1, 0, 0.00, 0, 0, 2, 1, '2013-05-17 13:52:30', '2013-05-17 13:52:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0);

--
-- Volcar la base de datos para la tabla `mozos`
--

INSERT INTO `mozos` (`id`, `user_id`, `numero`, `activo`, `deleted_date`, `deleted`) VALUES
(1, 2, 1, 1, NULL, 0),
(2, 2, 4, 1, NULL, 0);

-- --------------------------------------------------------


INSERT INTO `observaciones` (`name`) VALUES
("Observacion de comanda predefinida 1. Ejemplo: Marchar en 10 minutos"),
("Observacion 2");
--
-- Volcar la base de datos para la tabla `observaciones`
--

INSERT INTO `observacion_comandas` (`name`) VALUES
("Observacion predefinida 1 de producto. Ejemplo: SIN SAL"),
("Observacion 2 de producto");
--
-- Volcar la base de datos para la tabla `observacion_comandas`
--

--
-- Volcar la base de datos para la tabla `productos`
--


INSERT INTO `productos` (`id`, `name`, `abrev`, `description`, `categoria_id`, `precio`, `comandera_id`, `order`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, 'Paella', 'paella', '', 1, 100.00, 1, NULL, '2012-11-28 23:11:57', '2012-11-28 23:11:57', NULL, 0),
(2, 'Pure', 'pure', '', 2, 12.00, 1, 2, '2013-05-17 13:50:34', '2013-05-17 13:50:34', NULL, 0),
(3, 'Papas Fritas', 'papas', '', 2, 33.00, 1, NULL, '2013-05-17 13:50:46', '2013-05-17 13:50:46', NULL, 0),
(4, 'Papa al Natural', 'papa', '', 2, 21.00, 1, 2, '2013-05-17 13:51:09', '2013-05-17 13:51:09', NULL, 0),
(5, 'Pepsi', 'pepsi', '', 3, 20.00, 1, NULL, '2014-04-02 06:52:34', '2014-04-02 06:52:34', NULL, 0),
(6, 'Big Ristorantino', 'bg risto', '', 4, 40.00, 1, 2, '2014-04-02 06:56:37', '2014-04-02 06:56:37', NULL, 0),
(7, 'Super de Pollo', 'pollo', '', 4, 33.00, 1, NULL, '2014-04-02 06:57:03', '2014-04-02 06:57:03', NULL, 0);

-- --------------------------------------------------------



-- --------------------------------------------------------

INSERT INTO `sabores` (`id`, `name`, `categoria_id`, `precio`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, 'Queso', 4, 10, '2014-04-02 06:54:36', '2014-04-02 06:54:36', NULL, 0),
(2, 'Tomate', 4, 5, '2014-04-02 06:54:47', '2014-04-02 06:54:47', NULL, 0),
(3, 'Lechuga', 4, 4, '2014-04-02 06:55:00', '2014-04-02 06:55:00', NULL, 0),
(4, 'Huevo', 4, 5, '2014-04-02 06:55:29', '2014-04-02 06:55:29', NULL, 0),
(5, 'Sola', 4, 0, '2014-04-02 06:58:00', '2014-04-02 06:58:00', NULL, 0);
--
-- Volcar la base de datos para la tabla `sabores`
--

--
-- Volcar la base de datos para la tabla `tipo_de_pagos`
--

INSERT INTO `tipo_de_pagos` (`id`, `name`, `description`, `image_url`) VALUES
(1, 'Efectivo', 'cobro de dinero en efectivo', 'dollar_icon.png'),
(2, 'No Paga', '', 'no_paga.png'),
(3, 'Tarjeta Amex', '', 'american_express_icon.png'),
(4, 'Tarjeta Visa', '', 'visa_icon.png'),
(5, 'Tarjeta Master Card', '', 'mastercard_icon.png'),
(6, 'Tarjeta Visa Debito', '', '1315361034_visa_electron_curved.png'),
(7, 'Tarjeta Maestro', '', 'maestro_icon.png'),
(8, 'No volvio Cupon', '', 'no_volvio_cupon.png'),
(9, 'Dudoso', 'pago que no se si pagaron con tarjeta, efectivo, etc...', 'dudoso.png'),
(10, 'Voucher Cine', '', 'check_icon.png');

--
-- Volcar la base de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `codigo_fiscal`, `name`) VALUES
(1, 'C', 'CUIT'),
(2, 'L', 'CUIL'),
(3, '0', 'Libreta de Enrolamiento'),
(4, '1', 'Libreta Cívica'),
(5, '2', 'DNI'),
(6, '3', 'Pasaporte'),
(7, '4', 'Cédula de Identidad'),
(8, '-', 'Sin identificar');

-- --------------------------------------------------------

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
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nombre`, `apellido`, `telefono`, `domicilio`, `created`, `modified`) VALUES
(1, 'admin', 'fa2d96c466f88d70992f6ef17258dce71491daa5', 'invitado', 'admin', 'admin', '', '', '2012-11-24 23:51:09', '2012-11-28 23:13:31'),
(2, 'mozo', 'b75f1329505041fb0e1eb121245f50701566f481', 'invitado', 'Jose Manolo', 'Perez', '', '''''', '2012-11-28 21:47:38', '2012-11-28 23:14:07');

