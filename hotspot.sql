-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.38 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных hotspot
CREATE DATABASE IF NOT EXISTS `hotspot` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hotspot`;

-- Дамп структуры для таблица hotspot.aps
CREATE TABLE IF NOT EXISTS `aps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mac` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotspot.aps: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `aps` DISABLE KEYS */;
REPLACE INTO `aps` (`id`, `mac`, `place_id`) VALUES
	(1, '1', 1);
/*!40000 ALTER TABLE `aps` ENABLE KEYS */;

-- Дамп структуры для таблица hotspot.config
CREATE TABLE IF NOT EXISTS `config` (
  `unifi_url` varchar(255) NOT NULL DEFAULT 'https://localhost:8443',
  `unifi_login` varchar(255) NOT NULL DEFAULT 'admin',
  `unifi_pass` varchar(255) NOT NULL DEFAULT 'remoteadmin6333',
  `session_time` int(11) NOT NULL DEFAULT '3',
  `speed_up` int(11) NOT NULL DEFAULT '1024',
  `speed_down` int(11) NOT NULL DEFAULT '1024',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotspot.config: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
REPLACE INTO `config` (`unifi_url`, `unifi_login`, `unifi_pass`, `session_time`, `speed_up`, `speed_down`, `id`) VALUES
	('https://localhost:8443', 'admin', 'pass', 3, 1024, 1024, 1);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Дамп структуры для таблица hotspot.places
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotspot.places: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
REPLACE INTO `places` (`id`, `name`) VALUES
	(1, 'Test Place');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;

-- Дамп структуры для таблица hotspot.smsc
CREATE TABLE IF NOT EXISTS `smsc` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mac` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `code` int(6) NOT NULL,
  `ap_mac` varchar(100) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0' COMMENT '0 - не подтвержден 1 - подтвержден 2 - изменен',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotspot.smsc: ~20 rows (приблизительно)
/*!40000 ALTER TABLE `smsc` DISABLE KEYS */;
/*!40000 ALTER TABLE `smsc` ENABLE KEYS */;

-- Дамп структуры для таблица hotspot.voucher
CREATE TABLE IF NOT EXISTS `voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `time` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotspot.voucher: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `voucher` DISABLE KEYS */;
REPLACE INTO `voucher` (`id`, `password`, `time`) VALUES
	(18, '2vqjhe', 1534280399),
	(19, 'agy4ch', 1534280399);
/*!40000 ALTER TABLE `voucher` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
