CREATE TABLE `vales` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`persona` VARCHAR( 50 ) NOT NULL ,
`monto` FLOAT NOT NULL ,
`modified` DATETIME NULL ,
`created` DATETIME NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `tipo_impuestos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` VARCHAR( 50 ) NOT NULL ,
`porcentaje` FLOAT NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;

DROP TABLE `gastos`;
CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `clasificacion` varchar(100) DEFAULT NULL,
  `tipo_factura_id` int(11) NOT NULL,
  `factura_nro` varchar(50) DEFAULT NULL,
  `factura_fecha` date DEFAULT NULL,
  `importe_neto` float NOT NULL DEFAULT '0',
  `otros` float DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE `gastos_tipo_impuestos` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`gasto_id` INT NOT NULL ,
`tipo_impuesto_id` INT NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;


CREATE TABLE `proveedores` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 100 ) NOT NULL ,
`cuit` VARCHAR( 12 ) NULL ,
`mail` VARCHAR( 100 ) NULL ,
`telefono` VARCHAR( 100 ) NULL ,
`domicilio` VARCHAR( 100 ) NULL ,
`created` DATETIME NOT NULL ,
`modified` DATETIME NULL
) ENGINE = MYISAM ;


ALTER TABLE `gastos` ADD `importe_total` FLOAT NOT NULL DEFAULT 0 AFTER `importe_neto`;
