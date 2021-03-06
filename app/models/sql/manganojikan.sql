
CREATE TABLE IF NOT EXISTS `library` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `path` varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `manga` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_library` int(11) NOT NULL ,
  `name` varchar(255) NOT NULL,
  `to_delete` tinyint(1),
  FOREIGN KEY (`id_library`) REFERENCES `library` (`id`)
);

CREATE TABLE IF NOT EXISTS `volume` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_manga` int(11) NOT NULL,
  `volume_number` VARCHAR(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `access_date` date,
  `read_status` tinyint(1) NOT NULL,
  `page_number` int(11) NOT NULL,
  `file_names` LONGTEXT NOT NULL,
  `to_delete` tinyint(1),
  FOREIGN KEY (`id_manga`) REFERENCES `manga` (`id`)
);

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `id_library` int(11),
  FOREIGN KEY (`id_library`) REFERENCES `library` (`id`)
);