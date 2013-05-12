DROP TABLE IF EXISTS `account_tipo_impuestos`;
CREATE TABLE IF NOT EXISTS `account_tipo_impuestos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` VARCHAR( 50 ) NOT NULL ,
`porcentaje` DECIMAL( 6, 2 )  NOT NULL ,
PRIMARY KEY (`id`)
);


CREATE TABLE  IF NOT EXISTS account_clasificaciones (
    id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    parent_id INTEGER(10) DEFAULT NULL,
    lft INTEGER(10) DEFAULT NULL,
    rght INTEGER(10) DEFAULT NULL,
    `name` VARCHAR( 50 ) NOT NULL,
    PRIMARY KEY  (id)
);


DROP TABLE IF EXISTS `account_egresos`;
CREATE TABLE IF NOT EXISTS `account_egresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` DECIMAL( 10, 2 )  NOT NULL DEFAULT 0.00,
  `observacion` TEXT NULL,
  `tipo_de_pago_id` INTEGER(10) NOT NULL,
  `fecha` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `account_egresos_gastos`;
CREATE TABLE IF NOT EXISTS `account_egresos_gastos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`gasto_id` INT NOT NULL,
`egreso_id` INT NOT NULL,
`importe` DECIMAL( 10, 2 )  NOT NULL ,
`created` TIMESTAMP NULL ,
`modified` TIMESTAMP NULL,
PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `account_gastos`;
CREATE TABLE `account_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cierre_id` INT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `clasificacion_id` INT DEFAULT NULL,
  `tipo_factura_id` int(11) DEFAULT NULL,
  `factura_nro` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL,
  `importe_neto` DECIMAL( 10, 2 )  NOT NULL DEFAULT 0.00,
  `importe_total` DECIMAL( 10, 2 )  NOT NULL DEFAULT 0.00, 
  `observacion` TEXT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `account_impuestos`;
CREATE TABLE IF NOT EXISTS `account_impuestos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`gasto_id` INT NOT NULL ,
`tipo_impuesto_id` INT NOT NULL ,
`neto` DECIMAL( 10, 2 ) NULL DEFAULT  0,
`importe` DECIMAL( 10, 2 )  NULL DEFAULT  0,
PRIMARY KEY ( `id` )
);


CREATE TABLE IF NOT EXISTS`account_proveedores` (
`id` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR( 100 ) NOT NULL ,
`cuit` VARCHAR( 12 ) NULL ,
`mail` VARCHAR( 100 ) NULL ,
`telefono` VARCHAR( 100 ) NULL ,
`domicilio` VARCHAR( 100 ) NULL ,
`created` DATETIME NOT NULL ,
`modified` DATETIME NULL,
PRIMARY KEY (`id`)
);


INSERT INTO  `account_tipo_impuestos` (
`name` ,
`porcentaje`
)
VALUES (
'IVA 21%',  21
), (
'IVA 10,5%',  10.5
), (
'IVA 27%',  27
), (
'Neto No Gravado',  NULL
), (
'Conceptos Excluidos', NULL
), (
'I.G.', NULL
), (
'I.V.A.', NULL
), (
'I.B.', NULL
)
;




INSERT INTO `account_clasificaciones` (`parent_id`, `lft`, `rght`, `name`) VALUES
( NULL, 9, 28, 'otros costos'),
( NULL, 29, 52, 'mercaderia'),
( 2, 30, 31, 'helados'),
( 1, 10, 11, 'gas'),
( 1, 12, 13, 'calp'),
( 1, 14, 15, 'expensas'),
( 1, 16, 17, 'alquiler'),
( 1, 18, 19, 'telpin'),
( 1, 20, 21, 'seguros'),
( 1, 22, 23, 'bancos'),
( 1, 24, 25, 'contador'),
( 1, 26, 27, 'Sueldos'),
( 2, 32, 33, 'Pescados'),
( 2, 34, 35, 'Carniceria'),
( 2, 36, 37, 'Verduleria'),
( 2, 38, 39, 'Bebidas'),
( 2, 40, 41, 'vinos'),
( 2, 42, 43, 'Pan y Grisines'),
( 2, 44, 45, 'Almacen'),
( 2, 46, 47, 'Pollos'),
( 2, 48, 49, 'Cafeteria'),
( 2, 50, 51, 'Mercaderias menores'),
( NULL, NULL, NULL, 'otros gastos'),
( 27, NULL, 9, 'limpieza'),
(28, 1, 2, 'viaticos'),
( 28, 3, 4, 'mantenimiento'),
( 28, 5, 6, 'bazar'),
( 28, 7, 8, 'lipieza');
