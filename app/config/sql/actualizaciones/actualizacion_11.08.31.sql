ALTER TABLE `productos_precios_futuros` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;



ALTER TABLE  `mesas` ADD  `estado_id` TINYINT NOT NULL DEFAULT  0 AFTER  `cant_comensales`;



/* Meto el estado script de migracion de datos existentes con el nuevo campo de estado */
/* COBRADAS*/
UPDATE mesas SET
estado_id = 3
where
time_cobro <> '0000-00-00 00:00:00';


/* CERRADAS */
UPDATE mesas SET
estado_id = 2
where
time_cerro <> '0000-00-00 00:00:00'
and
time_cobro = '0000-00-00 00:00:00';

/* ABIERTAS */
UPDATE mesas SET
estado_id = 1
where
time_cerro = '0000-00-00 00:00:00'
and
time_cobro = '0000-00-00 00:00:00';



/* Parametro de configuracion nuevo. para hacer los descuentos los mozos tienen un limite 
de esa forma evitamos que un mozo pueda hacer un descuento del 100%
el default esta en 15%
*/
INSERT INTO  `config_categories` (
`id` ,
`name`
)
VALUES (
NULL ,  'Mozo'
);

INSERT INTO `configs` (
`id` ,
`config_category_id` ,
`key` ,
`value` ,
`description`
)
VALUES (
NULL ,  '6',  'descuento_maximo',  '15',  'máximo porcentaje de descuento que puede hacer un mozo'
);



ALTER TABLE  `categorias` ADD  `image_url` VARCHAR( 200 ) NULL AFTER  `description`;

ALTER TABLE  `tipo_de_pagos` ADD  `image_url` VARCHAR( 200 ) NULL AFTER  `description`;

ALTER TABLE  `detalle_comandas` ADD  `observacion` TEXT NULL AFTER  `comanda_id`;


CREATE TABLE  `observaciones` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 64 ) NOT NULL ,
`created` TIMESTAMP NULL ,
`modified` TIMESTAMP NULL
) ENGINE = MYISAM ;



ALTER TABLE  `pagos` ADD  `created` TIMESTAMP NULL AFTER  `valor` ,
ADD  `modified` TIMESTAMP NULL AFTER  `created`;

ALTER TABLE  `pagos` CHANGE  `valor`  `valor` FLOAT NOT NULL;
