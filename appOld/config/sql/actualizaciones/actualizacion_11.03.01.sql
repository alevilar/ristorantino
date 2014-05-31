	CREATE TABLE IF NOT EXISTS `historico_precios` (
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `precio` float NOT NULL,
	  `producto_id` int(11) NOT NULL,
	  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT  CHARSET=latin1;



	CREATE TABLE IF NOT EXISTS `productos_precios_futuros` (
	  `producto_id` int(11) NOT NULL,
	  `precio` float NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
        ALTER TABLE  `productos_precios_futuros` ADD PRIMARY KEY (  `producto_id` );

