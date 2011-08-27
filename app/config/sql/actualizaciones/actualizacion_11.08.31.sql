ALTER TABLE `productos_precios_futuros` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;



ALTER TABLE  `mesas` ADD  `estado` TINYINT NOT NULL DEFAULT  0 AFTER  `cant_comensales`;



/* Meto el estado script de migracion de datos existentes con el nuevo campo de estado */
/* COBRADAS*/
UPDATE mesas SET
estado = 3
where
time_cobro <> '0000-00-00 00:00:00';


/* CERRADAS */
UPDATE mesas SET
estado = 2
where
time_cerro <> '0000-00-00 00:00:00'
and
time_cobro = '0000-00-00 00:00:00';

/* ABIERTAS */
UPDATE mesas SET
estado = 1
where
time_cerro = '0000-00-00 00:00:00'
and
time_cobro = '0000-00-00 00:00:00';