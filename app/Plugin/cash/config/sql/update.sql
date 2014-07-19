ALTER TABLE  `pagos` 
ADD  `created` TIMESTAMP NULL ,
ADD  `modified` TIMESTAMP NULL;


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `cash_movimientos`
--

CREATE TABLE IF NOT EXISTS `cash_movimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `de_caja_id` int(11) NOT NULL,
  `a_caja_id` int(11) NOT NULL,
  `valor` decimal(11,2) NOT NULL DEFAULT '0.00',
  `observacion` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `cash_zetas`
--

CREATE TABLE IF NOT EXISTS `cash_zetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arqueo_id` int(10) unsigned DEFAULT NULL,
  `total_ventas` decimal(11,2) DEFAULT '0.00',
  `numero_comprobante` int(11) DEFAULT NULL,
  `monto_iva` decimal(11,2) DEFAULT '0.00',
  `monto_neto` decimal(11,2) DEFAULT '0.00',
  `nota_credito_iva` decimal(11,2) DEFAULT '0.00',
  `nota_credito_neto` decimal(11,2) DEFAULT '0.00',
  `observacion_comprobante_tarjeta` text,
  `observacion` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;



