ALTER TABLE  `mesas` ADD  `deleted_date` TIMESTAMP NULL AFTER  `time_cobro` ,
ADD  `deleted` TINYINT NOT NULL DEFAULT  '0' AFTER  `deleted_date`;


ALTER TABLE  `mozos` ADD  `deleted_date` TIMESTAMP NULL AFTER  `activo` ,
ADD  `deleted` TINYINT NOT NULL DEFAULT  '0' AFTER  `deleted_date`;


ALTER TABLE  `mesas` ADD  `subtotal` FLOAT NOT NULL DEFAULT  '0' AFTER  `mozo_id`;


