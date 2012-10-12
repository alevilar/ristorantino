ALTER TABLE  `users` CHANGE  `apellido`  `apellido` VARCHAR( 40 ) NULL DEFAULT  '';


ALTER TABLE  `users` CHANGE  `domicilio`  `domicilio` VARCHAR( 110 ) NULL DEFAULT  '';



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
