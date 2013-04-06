--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `parent_id`, `lft`, `rght`, `name`, `description`, `image_url`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, NULL, 1, 2, '/', '', '', '2012-12-10 16:52:14', '2012-12-10 16:52:14', NULL, 0);

--
-- Dumping data for table `comandas`
--

INSERT INTO `comandas` (`id`, `mesa_id`, `prioridad`, `impresa`, `created`, `observacion`) VALUES
(1, 1, 0, NULL, '2012-12-10 16:53:26', ''),
(2, 2, 0, NULL, '2013-03-27 01:54:59', ''),
(3, 1, 0, NULL, '2013-03-27 01:55:28', ''),
(4, 3, 0, NULL, '2013-03-27 01:55:42', '');

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`config_category_id`, `key`, `value`, `description`, `created`, `modified`) VALUES
( 1, 'imprimePrimeroRemito', '1', 'Esta variable sirve para imprimir siempre un comprobante de consumicion antes de imprimir el ticket los valores posibles son 1 o 0 (para imprimir directamente la factura)', NULL, '2012-01-14 01:12:39'),
( 2, 'name', 'Nombre del Lugar', 'Generalmente utilizado para las impresiones extra como remitos e informes', NULL, '2012-11-25 03:01:46'),
( 2, 'razon_social', '', '', NULL, NULL),
( 2, 'cuit', '', '', NULL, NULL),
( 2, 'ib', '', 'ingresos brutos', NULL, NULL),
( 2, 'iva_resp', '', '', NULL, NULL),
( 3, 'modelo', 'hasar_441', '', NULL, NULL),
( 4, 'usarCajero', '1', '', NULL, NULL),
( 1, 'tituloMesa', 'Mesa', '', NULL, NULL),
( 1, 'tituloMozo', 'Mozo', '', NULL, NULL),
( 4, 'cantidadCubiertosObligatorio', '1', '', NULL, NULL),
( 3, 'tempFuente', '/tmp/fuente', '', NULL, NULL),
( 3, 'tempDest', '/tmp/dest', '', NULL, NULL),
( 3, 'TempImpfiscal', '/tmp/impfiscal', '', NULL, NULL),
( 6, 'descuento_maximo', '15', 'máximo porcentaje de descuento que puede hacer un mozo', NULL, NULL),
( 7, 'corte_del_dia', '6', 'Es el horario en el que se va a tomar como corte del dia. Funcionara para el arqueo de caja, recuento de mesas. Por ejemplo, si se dice que el corte del dia es a las 6, quiere decir que, lo que vendi hasta las 6AM pertenecen al dia anterior. O sea, si es sabado y pasan las 12 am, hasta las 6 de la madrugada del domingo, se dirá que lo vendido pertenece al día sabado.', NULL, NULL),
( 3, 'encoding', '', 'encoding para las impresoras, de esta forma saldrán los acentos. Lo que no funciona es la "Ñ" mayúscula', NULL, '2011-11-15 23:23:03'),
( 4, 'reload_interval', '9700', 'valor en milisegundos de actualizacion de nuevas mesas', NULL, NULL),
( 4, 'reload_interval_timeout', '60000', 'valor en milisegundos que debe esperar el ajax para actualizar las mesas. Si el ajax no se resuelve. entonces se termina a la fuerza.', NULL, NULL),
( 4, 'jqm_page_transition', '', 'activar animaciones\r\n', NULL, NULL),
( 3, 'server', 'localhost', '', NULL, NULL),
( 3, 'nombre', 'fiscalfile', 'nombre de la impresora CUPS, es la impresora fiscal que para CUPS será una impresora que imprima "raw" en una carpeta particular donde estará leyendo el spooler', NULL, '2011-11-16 00:33:01'),
( 1, 'prueba', '1111111', '', '2011-11-04 12:21:31', '2011-11-04 12:21:31'),
( 2, 'valorCubierto', '0', '', '2011-11-06 20:55:21', '2011-11-15 23:10:11'),
( 2, 'mail', 'info@mail.com.ar', '', '2011-11-22 23:13:01', '2012-11-25 03:02:17'),
( 4, 'preTicketHeader', '            COMPROBANTE DE CONSUMICION', '', '2011-11-22 23:13:38', '2011-11-22 23:13:38'),
( 4, 'cobrada_hide_ms', '0', '', '2011-11-22 23:13:01', '2012-11-25 03:02:17')
;

--
-- Dumping data for table `config_categories`
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
-- Dumping data for table `detalle_comandas`
--

INSERT INTO `detalle_comandas` (`id`, `producto_id`, `cant`, `cant_eliminada`, `comanda_id`, `observacion`, `created`, `modified`, `es_entrada`) VALUES
(1, 1, 4, 0, 1, '', '2012-12-10 16:53:26', '2012-12-10 16:53:26', 0),
(2, 1, 3, 0, 2, '', '2013-03-27 01:54:59', '2013-03-27 01:54:59', 0),
(3, 1, 3, 0, 3, '', '2013-03-27 01:55:28', '2013-03-27 01:55:28', 0),
(4, 1, 3, 0, 4, '', '2013-03-27 01:55:42', '2013-03-27 01:55:42', 0);

--
-- Dumping data for table `iva_responsabilidades`
--

INSERT INTO `iva_responsabilidades` (`id`, `codigo_fiscal`, `name`) VALUES
(1, 'I', 'Resp. Inscripto'),
(2, 'E', 'Exento'),
(3, 'A', 'No Responsable'),
(4, 'C', 'Consumidor Final'),
(5, 'T', 'No Categorizado');

--
-- Dumping data for table `mesas`
--

INSERT INTO `mesas` (`id`, `numero`, `mozo_id`, `subtotal`, `total`, `cliente_id`, `menu`, `cant_comensales`, `estado_id`, `created`, `modified`, `time_cerro`, `time_cobro`, `deleted_date`, `deleted`) VALUES
(1, 22, 2, 70, 70.00, 0, 0, 2, 3, '2012-12-10 16:53:03', '2013-03-27 01:56:02', '2013-03-27 01:55:30', '2013-03-27 01:56:02', NULL, 0),
(2, 23, 2, 30, 30.00, 0, 0, 3, 3, '2013-03-27 01:54:57', '2013-03-27 01:56:05', '2013-03-27 01:55:01', '2013-03-27 01:56:05', NULL, 0),
(3, 23, 2, 30, 30.00, 0, 0, 3, 2, '2013-03-27 01:55:39', '2013-03-27 01:55:45', '2013-03-27 01:55:45', '0000-00-00 00:00:00', NULL, 0);

--
-- Dumping data for table `mozos`
--

INSERT INTO `mozos` (`id`, `user_id`, `numero`, `activo`, `deleted_date`, `deleted`) VALUES
(1, NULL, 1, 0, NULL, 0),
(2, 2, 1, 1, NULL, 0);

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `name`, `abrev`, `description`, `categoria_id`, `precio`, `comandera_id`, `order`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
(1, 'Pepsi', 'gaseosa', '', 1, 10.00, 0, 1, '2012-12-10 16:52:42', '2012-12-10 16:52:42', NULL, 0);

--
-- Dumping data for table `tipo_de_pagos`
--

INSERT INTO `tipo_de_pagos` (`name`, `image_url`) VALUES
( 'Efectivo', 'dollar_icon.png'),
( 'No Paga', 'no_paga.png'),
( 'Tarjeta Amex', 'american_express_icon.png'),
( 'Tarjeta Visa', 'visa_icon.png'),
( 'Tarjeta Master Card', 'mastercard_icon.png'),
( 'Tarjeta Visa Debito', '1315361034_visa_electron_curved.png'),
( 'Tarjeta Maestro', 'maestro_icon.png'),
( 'No volvio Cupon', 'no_volvio_cupon.png'),
( 'Dudoso', 'dudoso.png'),
( 'Voucher Cine', 'voucher.png'),
( 'Cheque', 'check_icon.png');

--
-- Dumping data for table `tipo_documentos`
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

--
-- Dumping data for table `tipo_facturas`
--

INSERT INTO `tipo_facturas` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Factura "A"', '2010-03-27 23:04:20', '2010-03-27 23:04:20'),
(2, 'Factura "B"', '2010-03-27 23:04:27', '2010-03-27 23:04:27'),
(3, 'Remito "X"', '2010-03-27 23:04:36', '2010-03-27 23:04:36'),
(4, 'Factura "M"', '2010-03-27 23:04:42', '2010-03-27 23:04:42'),
(5, 'Factura "C"', '2010-03-27 23:04:48', '2010-03-27 23:04:48'),
(6, 'Vale', '2010-03-27 23:04:54', '2010-03-27 23:04:54'),
(7, 'Otros', '2010-03-27 23:05:18', '2010-03-27 23:05:18');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rol_id`, `nombre`, `apellido`, `telefono`, `domicilio`, `created`, `modified`) VALUES
(1, 'admin', 'fa2d96c466f88d70992f6ef17258dce71491daa5', 1, 'admin', 'admin', '', '', '2012-11-25 02:51:09', '2012-12-10 16:48:22'),
(2, 'pepe', 'b75f1329505041fb0e1eb121245f50701566f481', 2, 'pepe', 'lopez', NULL, '''''', '2012-12-10 16:51:05', '2012-12-10 16:51:05');



INSERT INTO `roles` (`name`, `machin_name`) VALUES
('Administrador', 'administrador'),
('Mozo', 'mozo'),
('Adicionista', 'adicionista');
