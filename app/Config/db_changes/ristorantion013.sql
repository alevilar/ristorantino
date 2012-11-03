ALTER TABLE  `users` CHANGE  `apellido`  `apellido` VARCHAR( 40 ) NULL DEFAULT  '';


ALTER TABLE  `users` CHANGE  `domicilio`  `domicilio` VARCHAR( 110 ) NULL DEFAULT  '';

ALTER TABLE `users` DROP `numero`;

ALTER TABLE `mozos`  ADD `apellido` VARCHAR(64) NOT NULL AFTER `id`;
ALTER TABLE  `mozos` ADD  `nombre` VARCHAR( 64 ) NOT NULL AFTER  `id`;


/** colocar los nombres de usuarios al mozo **/
update mozos, users
set
mozos.nombre = users.nombre,
mozos.apellido = users.apellido
where
mozos.user_id > 0 AND
users.id = mozos.user_id;

ALTER TABLE `mozos` DROP `user_id`;



CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `machin_name` VARCHAR( 64 ) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);


--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`name`, `machin_name`) VALUES
('Administrador', 'administrador'),
('Mozo', 'mozo'),
('Adicionista', 'adicionista');



DROP TABLE reservas;

ALTER TABLE `clientes` DROP `user_id`;

ALTER TABLE  `clientes` CHANGE  `codigo`  `codigo` VARCHAR( 64 ) NULL DEFAULT NULL;

ALTER TABLE `clientes` DROP `imprime_ticket`;
ALTER TABLE `clientes` DROP `tipofactura`;
ALTER TABLE `clientes` DROP `tipodocumento`;


ALTER TABLE  `descuentos` ADD  `deleted_date` TIMESTAMP NULL AFTER  `modified` ,
ADD  `deleted` TINYINT NOT NULL DEFAULT  '0' AFTER  `deleted_date`;

ALTER TABLE `tipo_de_pagos` DROP `description`;