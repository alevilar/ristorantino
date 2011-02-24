CREATE TABLE IF NOT EXISTS `historico_precios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `producto_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT;