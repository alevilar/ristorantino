DROP TABLE IF EXISTS `account_tipo_impuestos`;
CREATE TABLE IF NOT EXISTS `account_tipo_impuestos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` VARCHAR( 50 ) NOT NULL ,
`porcentaje` DECIMAL( 2, 2 )  NOT NULL ,
PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `account_clasificaciones`;
CREATE TABLE account_clasificaciones (
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
  `total` DECIMAL( 6, 2 )  NOT NULL DEFAULT 0.00,
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
`importe` DECIMAL( 6, 2 )  NOT NULL ,
`created` TIMESTAMP NULL ,
`modified` TIMESTAMP NULL,
PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `account_gastos`;
CREATE TABLE `account_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) DEFAULT NULL,
  `clasificacion_id` INT DEFAULT NULL,
  `tipo_factura_id` int(11) DEFAULT NULL,
  `factura_nro` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL,
  `importe_neto` DECIMAL( 6, 2 )  NOT NULL DEFAULT 0.00,
  `importe_total` DECIMAL( 6, 2 )  NOT NULL DEFAULT 0.00,
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
`importe` DECIMAL( 6, 4 )  NOT NULL DEFAULT  0.0000,
PRIMARY KEY ( `id` )
);

DROP TABLE IF EXISTS `account_proveedores`;
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
'IVA 21%',  '21'
), (
'IVA 10,5%',  '10.5'
), (
'IVA 27%',  '27'
), (
'Neto No Gravado',  NULL
), (
'Conceptos Excluidos', NULL
), (
'I.G.-I.V.A.-I.B.', NULL
)
;




INSERT INTO `account_clasificaciones` (`id`, `parent_id`, `lft`, `rght`, `name`) VALUES
(1, NULL, 1, 2, 'Fijo'),
(2, NULL, 3, 4, 'Variable');