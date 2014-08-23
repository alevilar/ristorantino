ALTER TABLE  `pagos` ADD  `created` TIMESTAMP NULL AFTER  `valor`;
ALTER TABLE  `pagos` ADD  `modified` TIMESTAMP NULL AFTER  `created`;
ALTER TABLE  `users` ADD  `numero` INT NULL AFTER  `domicilio`;
ALTER TABLE  `users` ADD  `deleted_date` DATETIME NULL AFTER  `modified`;
ALTER TABLE  `users` ADD  `deleted` SMALLINT NULL AFTER  `modified`;
ALTER TABLE  `mesas` ADD  `descuento_id` INT NULL AFTER  `estado_id`;



