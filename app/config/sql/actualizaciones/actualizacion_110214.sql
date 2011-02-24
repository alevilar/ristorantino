CREATE TABLE `configs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_category_id` int(10) unsigned NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

CREATE TABLE `config_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
);

