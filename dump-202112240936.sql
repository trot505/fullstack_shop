DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
LOCK TABLES `cities` WRITE;
INSERT INTO `cities` VALUES (1,'Москва',NULL),(2,'Казань',NULL),(3,'Уфа',NULL),(4,'Екатеринбург',NULL),(5,'Пермь',NULL),(6,'Ижевск',NULL);
UNLOCK TABLES;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
LOCK TABLES `roles` WRITE;
INSERT INTO `roles` VALUES (1,'admin',NULL),(2,'manger',NULL),(3,'client',NULL);
UNLOCK TABLES;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` longtext NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT 3,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `users_cities_FK` (`city_id`),
  KEY `users_roles_FK` (`role_id`),
  CONSTRAINT `users_cities_FK` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `users_roles_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,'Дмитрий','t@t.tu','fa33bb8306889dfb13889a04e62915c1',6,1);
UNLOCK TABLES;