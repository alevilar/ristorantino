
--
-- Volcar la base de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`parent_id`, `lft`, `rght`, `name`, `description`, `media_id`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
( NULL, 1, 8, '/', '', NULL, '2012-11-28 22:57:10', '2012-11-28 22:57:10', NULL, 0),
( 1, 2, 3, 'Guarnicion', '', NULL, '2013-05-17 13:49:56', '2013-05-17 13:46:57', NULL, 0),
( 1, 4, 5, 'Bebidas', '', NULL, '2014-04-02 06:49:47', '2014-04-02 06:49:47', NULL, 0),
( 1, 6, 7, 'Hamburguesas', '', NULL, '2014-04-02 06:53:54', '2014-04-02 06:53:54', NULL, 0);
-- --------------------------------------------------------

INSERT INTO `clientes` (`id`, `codigo`, `mail`, `telefono`, `descuento_id`, `nombre`, `nrodocumento`, `tipo_documento_id`, `domicilio`, `iva_responsabilidad_id`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, 0, 'EXAMPLE Google Arg. SRL', '33709585229', 1, NULL, 1, '2013-05-17 13:52:17', '2013-05-17 13:52:17');

--
-- Volcar la base de datos para la tabla `clientes`
--

--
-- Volcar la base de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id`, `mesa_id`, `prioridad`, `impresa`, `created`, `observacion`) VALUES
(1, 1, 0, NULL, '2012-11-28 23:07:32', '');





INSERT INTO  `printers` ( `id` , `name` ,`alias` ,`driver` ,`driver_model` ,`output` ,`created` ,`modified`) 
VALUES ( NULL ,  'comanderacocina',  'comanderacocina',  'Receipt',  'Bematech',  'Database', NULL , NULL );




--
-- Volcar la base de datos para la tabla `descuentos`
--

--
-- Volcar la base de datos para la tabla `detalle_comandas`
--

INSERT INTO `detalle_comandas` (`id`, `producto_id`, `cant`, `cant_eliminada`, `comanda_id`, `observacion`, `created`, `modified`, `es_entrada`) VALUES
(1, 1, 1, 0, 1, '', '2012-11-28 23:07:32', '2012-11-28 23:07:32', 0);



--
-- Volcar la base de datos para la tabla `iva_responsabilidades`
--

INSERT INTO `iva_responsabilidades` (`id`, `codigo_fiscal`, `name`, `tipo_factura_id`) VALUES
(1, 'I', 'Resp. Inscripto', 1),
(2, 'E', 'Exento', 2),
(3, 'A', 'No Responsable', 2),
(4, 'C', 'Consumidor Final', 2),
(5, 'T', 'No Categorizado', 2);

-- --------------------------------------------------------

INSERT INTO `mesas` (`id`, `numero`, `mozo_id`, `subtotal`, `total`, `cliente_id`, `menu`, `cant_comensales`, `estado_id`, `created`, `modified`, `time_cerro`, `time_cobro`, `deleted_date`, `deleted`) VALUES
(1, 23, 1, 0, 0.00, 0, 0, 4, 1, '2013-05-17 13:44:44', '2013-05-17 13:44:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0),
(2, 1, 1, 221, 221.00, 1, 0, 2, 2, '2013-05-17 13:51:19', '2013-05-17 13:52:24', '2013-05-17 13:52:24', '0000-00-00 00:00:00', NULL, 0),
(3, 3, 1, 0, 0.00, 0, 0, 2, 1, '2013-05-17 13:52:30', '2013-05-17 13:52:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0);

--
-- Volcar la base de datos para la tabla `mozos`
--

INSERT INTO `mozos` ( `numero`, `nombre`, `apellido` ,`activo`, `deleted_date`, `deleted`) VALUES
(1, "Carlos", "Lopez", 1, NULL, 0),
(4, "Mariano", "Gomez", 1, NULL, 0);

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


INSERT INTO `productos` (`id`, `name`, `abrev`, `description`, `categoria_id`, `precio`, `printer_id`, `order`, `created`, `modified`, `deleted_date`, `deleted`) VALUES
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

INSERT INTO `tipo_de_pagos` (`id`, `name`, `media_id`) VALUES
(1, 'Efectivo', NULL),
(2, 'No Paga', NULL),
(3, 'Tarjeta Amex', NULL),
(4, 'Tarjeta Visa', NULL),
(5, 'Tarjeta Master Card', NULL),
(6, 'Tarjeta Visa Debito', NULL),
(7, 'Tarjeta Maestro', NULL),
(8, 'No volvio Cupon', NULL),
(9, 'Dudoso', NULL),
(10, 'Voucher Cine', NULL);

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
(1, '"A"', '2010-03-27 20:04:20', '2010-03-27 20:04:20'),
(2, '"B"', '2010-03-27 20:04:27', '2010-03-27 20:04:27'),
(3, '"X"', '2010-03-27 20:04:36', '2010-03-27 20:04:36'),
(4, '"M"', '2010-03-27 20:04:42', '2010-03-27 20:04:42'),
(5, '"C"', '2010-03-27 20:04:48', '2010-03-27 20:04:48'),
(6, 'Vale', '2010-03-27 20:04:54', '2010-03-27 20:04:54'),
(7, 'Otros', '2010-03-27 20:05:18', '2010-03-27 20:05:18');



INSERT INTO `roles` (`name`, `machin_name`) VALUES
('Administrador', 'administrador'),
('Mozo', 'mozo'),
('Adicionista', 'adicionista');


INSERT INTO `estados` (`name`, `color`) VALUES
('Abierta', 'btn-info'),
('Facturada', 'btn-warning'),
('Cobrada', 'btn-default');




INSERT INTO `hotel_room_states` (`id`, `name`, `created`, `modified`, `color`) VALUES
(1, 'Disponible', '2014-09-08 00:03:55', '2014-09-08 00:03:55', 'btn-success'),
(2, 'En Refacción', '2014-09-08 00:04:29', '2014-09-08 00:04:29', 'btn-warning');




INSERT INTO `hotel_rooms` (`id`, `name`, `description`, `room_state_id`, `created`, `modified`) VALUES
(1, 'Imperial', '', 1, '2014-09-08 00:04:50', '2014-09-08 00:04:50'),
(2, 'Presidencial', '', 2, '2014-09-08 00:05:01', '2014-09-08 00:05:01');



INSERT INTO `cash_cajas` (`id`, `name`, `computa_ingresos`, `computa_egresos`, `created`, `modified`) VALUES
(1, 'Caja Ventas', 1, 1, '2014-09-09 14:20:21', '2014-09-09 14:20:21');


