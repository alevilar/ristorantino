-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `rol_id` int(11) NOT NULL,
  `password` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_general_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_general_ci DEFAULT '',
  `telefono` varchar(20) COLLATE utf8_general_ci DEFAULT NULL,
  `domicilio` varchar(110) COLLATE utf8_general_ci DEFAULT '',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=31 ;






CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(64) CHARACTER SET utf8 NOT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `sites_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;