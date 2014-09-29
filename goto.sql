CREATE TABLE `travels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `travels_id` int(11) unsigned NOT NULL,
  `time` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `travels_id` (`travels_id`),
  CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`travels_id`) REFERENCES `travels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;