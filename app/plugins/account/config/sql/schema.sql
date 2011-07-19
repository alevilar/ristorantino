CREATE TABLE `coqus`.`vales` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`persona` VARCHAR( 50 ) NOT NULL ,
`monto` FLOAT NOT NULL ,
`modified` DATETIME NULL ,
`created` DATETIME NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `coqus`.`tipo_impuestos` (
`id` INT NOT NULL ,
`name` VARCHAR( 50 ) NOT NULL ,
`porcentaje` FLOAT NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;
ALTER TABLE `tipo_impuestos` CHANGE `id` `id` INT( 11 ) NOT NULL AUTO_INCREMENT;

CREATE TABLE `coqus`.`gastos_tipo_impuestos` (
`id` INT NOT NULL ,
`gasto_id` INT NOT NULL ,
`tipo_impuesto_id` INT NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;
ALTER TABLE `gastos_tipo_impuestos` CHANGE `id` `id` INT( 11 ) NOT NULL AUTO_INCREMENT;

ALTER TABLE `gastos`
  DROP `iva_a`,
  DROP `iva_b`,
  DROP `iibb`,
  DROP `imp_int`,
  DROP `percep_iva`,
  DROP `no_gravado`;