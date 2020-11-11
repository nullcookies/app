-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.25 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных app_ajax
CREATE DATABASE IF NOT EXISTS `app_ajax` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci */;
USE `app_ajax`;

-- Дамп структуры для таблица app_ajax.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_image` varchar(250) NOT NULL,
  `thumbnail_image` varchar(250) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы app_ajax.images: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `original_image`, `thumbnail_image`, `user_id`) VALUES
	(105, '1605041440.jpg', 'thumbnail_1605041440.jpg', '6'),
	(106, '1605041461.jpeg', 'thumbnail_1605041461.jpeg', '6'),
	(145, '1605089265.jpg', 'thumbnail_1605089265.jpg', '8'),
	(146, '1605089272.jpg', 'thumbnail_1605089272.jpg', '8'),
	(147, '1605089742.jpg', 'thumbnail_1605089742.jpg', '9');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Дамп структуры для таблица app_ajax.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы app_ajax.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
	(7, 'geometrics', 'test1@gmail.com', '$2y$10$whgEptcpUVeyRxK4UlAgPOHgjQPNIOYrEolg0e6khtIQyx6a3J1Uq'),
	(8, 'geometrics', 'geometrics@gmail.com', '$2y$10$g2GI/oFSlIhPCRjq6pwpFef9Z8NphSdWorQa4yWBh6HFNTJYjdcDu'),
	(9, 'geometrics123', 'geometrics123@gmail.com', '$2y$10$OXOqs0scCfwj1pzQW1YctOYO.ANADLcD9LPEnMVlnchYt2JtNdxLK');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
