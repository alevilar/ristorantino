
CREATE TABLE IF NOT EXISTS `pquery_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(50) NOT NULL,
  created timestamp NULL,
  modified timestamp NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;



-- ALTER TABLE `pquery_queries` ADD COLUMN `pquery_category_id` int NOT NULL DEFAULT 0;
-- ALTER TABLE `pquery_queries` DROP COLUMN `categoria`;
ALTER TABLE `pquery_queries` ADD COLUMN `expiration_time` timestamp NULL;
ALTER TABLE `pquery_queries` ADD COLUMN `columns` text;



/*Categorias*/
INSERT INTO pquery_categories (`name`)
VALUES('Generales');

INSERT INTO pquery_categories (`name`)
VALUES('Temporales');

/*Habituales*/
UPDATE pquery_queries
SET pquery_category_id = 1