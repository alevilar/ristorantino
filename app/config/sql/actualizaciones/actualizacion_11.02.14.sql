CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `config_category_id` int(10) unsigned NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcar la base de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `config_category_id`, `key`, `value`, `description`) VALUES
(1, 1, 'imprimePrimeroRemito', '1', 'Esta variable sirve para imprimir siempre un comprobante de consumicion antes de imprimir el ticket los valores posibles son 1 o 0 (para imprimir directamente la factura)'),
(2, 2, 'name', '          - NOMBRE RESTAURANTE-', 'Generalmente utilizado para las impresiones extra como remitos e informes'),
(3, 2, 'razon_social', '', ''),
(4, 2, 'cuit', '', ''),
(5, 2, 'ib', '', 'ingresos brutos'),
(6, 2, 'iva_resp', 'IVA RESPONSABLE INSCRIPTO A CONS. FINAL', ''),
(7, 3, 'modelo', 'hasar_441', ''),
(8, 4, 'usarCajero', '1', ''),
(9, 1, 'tituloMesa', '''Mesa''', ''),
(10, 1, 'titluloMozo', 'Mozo', ''),
(11, 4, 'cantidadCubiertosObligatorio', '1', ''),
(12, 3, 'tempFuente', '/tmp/fuente', ''),
(13, 3, 'tempDest', '/tmp/dest', ''),
(14, 3, 'TempImpfiscal', '/tmp/impfiscal', ''),
(15, 5, 'debug', '2', '');




CREATE TABLE IF NOT EXISTS `config_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `config_categories`
--

INSERT INTO `config_categories` (`id`, `name`) VALUES
(1, 'Mesa'),
(2, 'Restaurante'),
(3, 'ImpresoraFiscal'),
(4, 'Adicion'),
(5, '');