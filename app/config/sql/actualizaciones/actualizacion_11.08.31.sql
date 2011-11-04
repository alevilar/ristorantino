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




ALTER TABLE  `mesas` CHANGE  `cant_comensales`  `cant_comensales` INT( 11 ) NULL DEFAULT  '0';



ALTER TABLE  `productos_precios_futuros` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `cake_sessions` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;



INSERT INTO  `configs` (
`id` ,
`config_category_id` ,
`key` ,
`value` ,
`description`
)
VALUES (
NULL ,  '4',  'reload_interval',  '9700',  'valor en milisegundos de actualizacion de nuevas mesas'
), (
NULL ,  '4',  'reload_interval_timeout',  '60000',  'valor en milisegundos que debe esperar el ajax para actualizar las mesas. Si el ajax no se resuelve. entonces se termina a la fuerza.'
), (
NULL ,  '4',  'jqm_page_transition',  '',  'Utilizar animaciones de jquery mobile o no? poner valores de verdadero o falso de sistemas (dejar vacio "" si no quiero animaciones.'
);


ALTER TABLE `comandas` ADD `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created` ;


ALTER TABLE `configs` ADD `created` TIMESTAMP NULL AFTER `description` ;
ALTER TABLE `configs` ADD `modified` TIMESTAMP NULL AFTER `created` ;

