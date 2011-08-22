ALTER TABLE `productos_precios_futuros` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;


CREATE TABLE  `mesa_estados` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`parent_id` INT NULL ,
`name` VARCHAR( 100 ) NOT NULL ,
`created` TIMESTAMP NULL ,
`modified` TIMESTAMP NULL ,
`deleted_date` TIMESTAMP NULL ,
`deleted` TINYINT NULL,
`lft` INT NULL ,
`rght` INT NULL
) ENGINE = MYISAM ;

ALTER TABLE  `mesas` ADD  `mesa_estado_id` INT NOT NULL AFTER  `cant_comensales`;

