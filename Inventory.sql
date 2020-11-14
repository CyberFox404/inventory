-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.20 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.6111
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных inventory
-- CREATE DATABASE IF NOT EXISTS `u358373213__inventory` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `u358373213__inventory`;

-- Дамп структуры для таблица inventory.inventory_data
CREATE TABLE IF NOT EXISTS `inventory_data` (
  `id` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `inventory_number` bigint(20) DEFAULT NULL COMMENT 'инвентарный номер',
  `inner_number` text COMMENT 'внутренний номер',
  `type` bigint(20) unsigned zerofill DEFAULT NULL COMMENT 'тип',
  `model` text COMMENT 'модель',
  `cpu` text COMMENT 'процессор',
  `memory` text COMMENT 'память',
  `storage` text COMMENT 'накопитель',
  `diagonal` text COMMENT 'диагональ',
  `location` bigint(20) unsigned zerofill DEFAULT NULL COMMENT 'местоположение',
  `time_create` timestamp NULL DEFAULT NULL COMMENT 'время создания',
  `time_update` timestamp NULL DEFAULT NULL COMMENT 'время обновления',
  `time_writeoff` timestamp NULL DEFAULT NULL COMMENT 'время списания',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы inventory.inventory_data: ~21 rows (приблизительно)
/*!40000 ALTER TABLE `inventory_data` DISABLE KEYS */;
REPLACE INTO `inventory_data` (`id`, `inventory_number`, `inner_number`, `type`, `model`, `cpu`, `memory`, `storage`, `diagonal`, `location`, `time_create`, `time_update`, `time_writeoff`) VALUES
	(00000000000000000001, 101343202620110000, 'PC-Ky7SN4DjEh', 00000000000000000001, 'ASUS', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-04 17:17:46', '2020-11-04 17:40:19', NULL),
	(00000000000000000002, 343202620110000001, 'PC-Mu2HFKc2vz', 00000000000000000001, 'Acer TravelMate TMP 259- M-37 RW-2', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-04 17:19:08', NULL, NULL),
	(00000000000000000003, 343202620110000002, 'PC-wgdAiyNAIA', 00000000000000000001, 'Acer TravelMate TMP 259- M-37 RW-1', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-04 17:20:00', NULL, NULL),
	(00000000000000000027, 101341400018, 'PC-8JlwMWb', 00000000000000000003, '', '', '', '', '', 00000000000000000001, '2020-11-07 09:44:40', '2020-11-07 10:06:52', NULL),
	(00000000000000000028, 101341403668, 'PC-0GmwMWb', 00000000000000000003, '', '', '', '', '', 00000000000000000001, '2020-11-07 09:45:15', '2020-11-07 10:06:57', NULL),
	(00000000000000000029, 101340200001, 'PC-1yjrMWb', 00000000000000000003, '', '', '', '', '', 00000000000000000001, '2020-11-07 09:47:31', '2020-11-07 10:07:03', NULL),
	(00000000000000000030, 101341400001, 'PC-RJlwMWb', 00000000000000000004, 'SAMSUNG 1210', '', '', '', '', 00000000000000000001, '2020-11-07 09:47:57', '2020-11-08 07:21:59', NULL),
	(00000000000000000031, 101341400009, 'PC-ZJlwMWb', 00000000000000000004, 'HP', '', '', '', '', 00000000000000000001, '2020-11-07 09:59:50', '2020-11-08 14:09:19', NULL),
	(00000000000000000032, 101341403669, 'PC-1GmwMWb', 00000000000000000004, 'SAMSUNG SCX', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:00:20', NULL, NULL),
	(00000000000000000033, 101343202630120008, 'PC-mC7yO4DjEh', 00000000000000000010, 'BENO MS 506', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:01:35', NULL, NULL),
	(00000000000000000034, 101343202620150001, 'PC-UXhTN4DjEh', 00000000000000000004, 'PANTUM M6SOO', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:02:40', NULL, NULL),
	(00000000000000000035, 101340400006, 'PC-UA9rMWb', 00000000000000000011, 'THONSON T32ED33U', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:03:38', NULL, NULL),
	(00000000000000000036, 101343202620110000, 'PC-wWFB5yjRDY', 00000000000000000001, 'ASUS', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:07:36', NULL, NULL),
	(00000000000000000039, 101343202630120005, 'PC-6s042v5L38', 00000000000000000010, 'BENO MS 506', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:14:07', NULL, NULL),
	(00000000000000000040, 101343202630120006, 'PC-HalxA06PZn', 00000000000000000010, 'BENO MS 506', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:14:24', NULL, NULL),
	(00000000000000000041, 101343202630120007, 'PC-HWltwDlLdX', 00000000000000000010, 'BENO MS 506', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:14:45', NULL, NULL),
	(00000000000000000042, 101341400002, 'PC-SJlwMWb', 00000000000000000010, 'BENQ MS 504', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 10:16:09', NULL, NULL),
	(00000000000000000043, 101341400800, 'PC-KWlwMWb', 00000000000000000002, 'Samsung NP-N102-JA01', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 11:49:54', NULL, NULL),
	(00000000000000000044, 101341400801, 'PC-LWlwMWb', 00000000000000000002, 'Samsung NP-N102-JA01', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 11:50:13', NULL, NULL),
	(00000000000000000045, 101341400802, 'PC-MWlwMWb', 00000000000000000002, 'Samsung NP-N102-JA01', '', '', '', '', 00000000000000000001, '2020-11-07 11:50:31', '2020-11-08 15:08:48', NULL),
	(00000000000000000046, 101341400803, 'PC-NWlwMWb', 00000000000000000002, 'Samsung NP-N102-JA01', NULL, NULL, NULL, NULL, 00000000000000000001, '2020-11-07 11:51:06', NULL, NULL);
/*!40000 ALTER TABLE `inventory_data` ENABLE KEYS */;

-- Дамп структуры для таблица inventory.location
CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы inventory.location: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
REPLACE INTO `location` (`id`, `name`) VALUES
	(00000000000000000001, 'Склад');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Дамп структуры для таблица inventory.type
CREATE TABLE IF NOT EXISTS `type` (
  `id` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы inventory.type: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
REPLACE INTO `type` (`id`, `name`) VALUES
	(00000000000000000001, 'Ноутбук'),
	(00000000000000000002, 'Нетбук'),
	(00000000000000000003, 'Компьютер'),
	(00000000000000000004, 'Принтер'),
	(00000000000000000005, 'МФУ'),
	(00000000000000000010, 'Проектор'),
	(00000000000000000011, 'Телевизор');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
