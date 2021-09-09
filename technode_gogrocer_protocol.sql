-- Adminer 4.8.0 MySQL 5.5.5-10.3.31-MariaDB-cll-lve dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `aboutuspage`;
CREATE TABLE `aboutuspage` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `aboutuspage` (`about_id`, `title`, `description`) VALUES
(1,	'About Us',	'<p><strong>About U</strong><br />\r\nGrocery Delivery is an online Delivery &nbsp;Mobile App as a Service. We are committed to nurturing a neutral platform and are helping food establishments maintain high standards through Hyper pure. Food Hygiene Ratings is a coveted mark of quality among our restaurant partners</p>');

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `agent` text NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_role` enum('1','2','3','4','5') DEFAULT NULL COMMENT '1 =admin, 2= store_owner,3=store,4=user. 5= driver',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `activities` (`id`, `subject`, `url`, `method`, `ip`, `agent`, `user_id`, `user_role`, `created_at`, `updated_at`) VALUES
(6,	'hdhhdhdhddhdhdhdh',	'http://technodeviser.com/grocerydelivery/protocol/clear-cache',	'GET',	'162.158.166.84',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36',	NULL,	NULL,	'2021-07-23 13:44:13',	'2021-07-23 13:44:13'),
(7,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.69.239.157',	'PostmanRuntime/7.28.2',	'19',	'5',	'2021-07-24 05:57:15',	'2021-07-24 05:57:15'),
(8,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.133',	'okhttp/3.14.4',	'18',	'5',	'2021-07-28 07:46:56',	'2021-07-28 07:46:56'),
(9,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.155',	'okhttp/3.14.4',	'18',	'5',	'2021-07-28 07:50:08',	'2021-07-28 07:50:08'),
(10,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.155',	'okhttp/3.14.4',	'18',	'5',	'2021-07-28 07:52:22',	'2021-07-28 07:52:22'),
(11,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.133',	'okhttp/3.14.4',	'18',	'5',	'2021-07-28 07:59:10',	'2021-07-28 07:59:10'),
(12,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.132',	'okhttp/3.14.4',	'18',	'5',	'2021-07-28 10:58:19',	'2021-07-28 10:58:19'),
(13,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.155',	'okhttp/3.14.4',	'19',	'3',	'2021-07-29 12:46:34',	'2021-07-29 12:46:34'),
(14,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.79.152',	'okhttp/3.14.4',	'19',	'3',	'2021-07-31 04:33:43',	'2021-07-31 04:33:43'),
(15,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.133',	'okhttp/3.14.4',	'18',	'5',	'2021-08-02 11:37:03',	'2021-08-02 11:37:03'),
(16,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.135',	'okhttp/3.14.4',	'18',	'5',	'2021-08-02 11:54:06',	'2021-08-02 11:54:06'),
(17,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.152',	'okhttp/3.14.4',	'18',	'5',	'2021-08-02 12:02:23',	'2021-08-02 12:02:23'),
(18,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/3.14.4',	'18',	'5',	'2021-08-02 12:05:39',	'2021-08-02 12:05:39'),
(19,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.135',	'PostmanRuntime/7.28.2',	'18',	'5',	'2021-08-02 12:29:17',	'2021-08-02 12:29:17'),
(20,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/successpayment',	'POST',	'172.68.79.143',	'okhttp/3.14.4',	'18',	'5',	'2021-08-04 06:17:02',	'2021-08-04 06:17:02'),
(21,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.154',	'okhttp/3.14.4',	'28',	'5',	'2021-08-05 02:30:33',	'2021-08-05 02:30:33'),
(22,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.152',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 10:49:16',	'2021-08-05 10:49:16'),
(23,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.153',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 11:17:40',	'2021-08-05 11:17:40'),
(24,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.134',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 11:30:32',	'2021-08-05 11:30:32'),
(25,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.153',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 11:46:01',	'2021-08-05 11:46:01'),
(26,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.134',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 12:02:52',	'2021-08-05 12:02:52'),
(27,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.132',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 12:23:31',	'2021-08-05 12:23:31'),
(28,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.135',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 12:30:29',	'2021-08-05 12:30:29'),
(29,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.153',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 12:56:11',	'2021-08-05 12:56:11'),
(30,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/successpayment',	'POST',	'172.68.155.152',	'okhttp/3.14.4',	'18',	'5',	'2021-08-05 12:59:31',	'2021-08-05 12:59:31'),
(31,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.134',	'okhttp/3.14.4',	'18',	'5',	'2021-08-06 07:31:57',	'2021-08-06 07:31:57'),
(32,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.134',	'okhttp/3.14.4',	'18',	'5',	'2021-08-06 07:34:42',	'2021-08-06 07:34:42'),
(33,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.152',	'okhttp/3.14.4',	'18',	'5',	'2021-08-06 12:01:48',	'2021-08-06 12:01:48'),
(34,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.132',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 06:50:23',	'2021-08-10 06:50:23'),
(35,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.132',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 07:59:26',	'2021-08-10 07:59:26'),
(36,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.152',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 08:03:15',	'2021-08-10 08:03:15'),
(37,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.134',	'PostmanRuntime/7.28.3',	'18',	'5',	'2021-08-10 08:11:30',	'2021-08-10 08:11:30'),
(38,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'PostmanRuntime/7.28.3',	'18',	'5',	'2021-08-10 08:21:09',	'2021-08-10 08:21:09'),
(39,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 08:22:27',	'2021-08-10 08:22:27'),
(40,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 08:23:19',	'2021-08-10 08:23:19'),
(41,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'PostmanRuntime/7.28.3',	'18',	'5',	'2021-08-10 08:24:55',	'2021-08-10 08:24:55'),
(42,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'PostmanRuntime/7.28.3',	'18',	'5',	'2021-08-10 08:25:00',	'2021-08-10 08:25:00'),
(43,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 08:26:19',	'2021-08-10 08:26:19'),
(44,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.132',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 08:36:08',	'2021-08-10 08:36:08'),
(45,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.132',	'okhttp/3.14.4',	'18',	'5',	'2021-08-10 08:47:19',	'2021-08-10 08:47:19'),
(46,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.134',	'okhttp/3.14.4',	'34',	'5',	'2021-08-10 11:57:18',	'2021-08-10 11:57:18'),
(47,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.134',	'okhttp/3.14.4',	'18',	'5',	'2021-08-12 13:46:58',	'2021-08-12 13:46:58'),
(48,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.69.239.140',	'okhttp/3.14.4',	'18',	'5',	'2021-08-13 04:28:02',	'2021-08-13 04:28:02'),
(49,	'cancel order',	'http://technodeviser.com/grocerydelivery/api/protocol/order-cancel',	'POST',	'172.68.79.152',	'okhttp/3.14.4',	'18',	'5',	'2021-08-16 04:29:48',	'2021-08-16 04:29:48'),
(50,	'cancel order',	'http://technodeviser.com/grocerydelivery/api/protocol/order-cancel',	'POST',	'172.68.79.152',	'okhttp/3.14.4',	'18',	'5',	'2021-08-16 04:30:06',	'2021-08-16 04:30:06'),
(51,	'cancel order',	'http://technodeviser.com/grocerydelivery/api/protocol/order-cancel',	'POST',	'172.68.79.134',	'okhttp/3.14.4',	'18',	'5',	'2021-08-16 04:30:08',	'2021-08-16 04:30:08'),
(52,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'162.158.22.16',	'okhttp/4.9.0',	'19',	'5',	'2021-08-18 06:14:59',	'2021-08-18 06:14:59'),
(53,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'162.158.22.16',	'okhttp/4.9.0',	'19',	'5',	'2021-08-18 06:40:04',	'2021-08-18 06:40:04'),
(54,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/successpayment',	'POST',	'162.158.22.185',	'okhttp/4.9.0',	'19',	'5',	'2021-08-18 06:47:59',	'2021-08-18 06:47:59'),
(55,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.132',	'okhttp/4.9.0',	'18',	'5',	'2021-08-18 11:02:36',	'2021-08-18 11:02:36'),
(56,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.152',	'okhttp/4.9.0',	'38',	'5',	'2021-08-19 11:53:42',	'2021-08-19 11:53:42'),
(57,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.152',	'okhttp/4.9.0',	'38',	'5',	'2021-08-19 11:57:18',	'2021-08-19 11:57:18'),
(58,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/4.9.0',	'38',	'5',	'2021-08-20 05:01:30',	'2021-08-20 05:01:30'),
(59,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.79.154',	'okhttp/3.12.0',	'19',	'3',	'2021-08-20 05:03:00',	'2021-08-20 05:03:00'),
(60,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.79.132',	'okhttp/3.12.0',	'1',	'3',	'2021-08-20 05:27:23',	'2021-08-20 05:27:23'),
(61,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.79.152',	'okhttp/3.12.0',	'1',	'3',	'2021-08-20 12:01:18',	'2021-08-20 12:01:18'),
(62,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.79.134',	'okhttp/3.12.0',	'0',	'3',	'2021-08-23 09:39:53',	'2021-08-23 09:39:53'),
(63,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/4.9.0',	'38',	'5',	'2021-08-25 09:51:08',	'2021-08-25 09:51:08'),
(64,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.79.134',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 04:42:40',	'2021-08-26 04:42:40'),
(65,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.79.132',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 06:40:09',	'2021-08-26 06:40:09'),
(66,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'162.158.22.14',	'okhttp/4.9.0',	'19',	'5',	'2021-08-26 08:33:41',	'2021-08-26 08:33:41'),
(67,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.154',	'okhttp/4.9.0',	'18',	'5',	'2021-08-26 09:00:16',	'2021-08-26 09:00:16'),
(68,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.134',	'okhttp/4.9.0',	'18',	'5',	'2021-08-26 09:27:31',	'2021-08-26 09:27:31'),
(69,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.155.134',	'okhttp/4.9.0',	'18',	'5',	'2021-08-26 10:04:20',	'2021-08-26 10:04:20'),
(70,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.69.239.136',	'okhttp/4.9.0',	'19',	'5',	'2021-08-26 10:56:58',	'2021-08-26 10:56:58'),
(71,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'162.158.22.14',	'okhttp/4.9.0',	'19',	'5',	'2021-08-26 10:58:09',	'2021-08-26 10:58:09'),
(72,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.154',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 11:38:57',	'2021-08-26 11:38:57'),
(73,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.152',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 12:51:06',	'2021-08-26 12:51:06'),
(74,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.154',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 13:03:46',	'2021-08-26 13:03:46'),
(75,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.154',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 13:03:58',	'2021-08-26 13:03:58'),
(76,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.154',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 13:07:37',	'2021-08-26 13:07:37'),
(77,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.154',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 13:07:57',	'2021-08-26 13:07:57'),
(78,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.154',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 13:09:25',	'2021-08-26 13:09:25'),
(79,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'172.68.155.154',	'okhttp/3.12.0',	'1',	'3',	'2021-08-26 13:09:57',	'2021-08-26 13:09:57'),
(80,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.134',	'okhttp/4.9.0',	'18',	'5',	'2021-08-27 07:10:25',	'2021-08-27 07:10:25'),
(81,	'cancel order',	'http://technodeviser.com/grocerydelivery/api/protocol/order-cancel',	'POST',	'162.158.167.226',	'okhttp/4.9.0',	'18',	'5',	'2021-08-27 09:51:20',	'2021-08-27 09:51:20'),
(82,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/4.9.0',	'18',	'5',	'2021-08-27 10:06:06',	'2021-08-27 10:06:06'),
(83,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.154',	'okhttp/4.9.0',	'18',	'5',	'2021-08-27 10:06:45',	'2021-08-27 10:06:45'),
(84,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'172.68.79.132',	'okhttp/4.9.0',	'18',	'5',	'2021-08-27 10:10:53',	'2021-08-27 10:10:53'),
(85,	'cancel order',	'http://technodeviser.com/grocerydelivery/api/protocol/order-cancel',	'POST',	'106.206.248.27',	'okhttp/4.9.0',	'18',	'5',	'2021-08-30 07:36:15',	'2021-08-30 07:36:15'),
(86,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'106.206.248.27',	'okhttp/3.12.0',	'1',	'3',	'2021-08-30 08:37:58',	'2021-08-30 08:37:58'),
(87,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'2409:4055:314:64e5:51f:8c49:891b:8a4a',	'okhttp/4.9.0',	'18',	'5',	'2021-08-31 11:02:31',	'2021-08-31 11:02:31'),
(88,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'223.225.128.237',	'okhttp/4.9.0',	'18',	'5',	'2021-08-31 11:03:44',	'2021-08-31 11:03:44'),
(89,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'2409:4055:314:64e5:51f:8c49:891b:8a4a',	'okhttp/4.9.0',	'18',	'5',	'2021-08-31 11:10:02',	'2021-08-31 11:10:02'),
(90,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'223.225.128.237',	'okhttp/4.9.0',	'18',	'5',	'2021-08-31 11:12:54',	'2021-08-31 11:12:54'),
(91,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'2409:4055:314:64e5:51f:8c49:891b:8a4a',	'okhttp/4.9.0',	'19',	'5',	'2021-08-31 12:11:45',	'2021-08-31 12:11:45'),
(92,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'223.225.128.237',	'okhttp/4.9.0',	'18',	'5',	'2021-08-31 12:13:13',	'2021-08-31 12:13:13'),
(93,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'106.206.232.14',	'okhttp/4.9.0',	'18',	'5',	'2021-09-01 04:39:08',	'2021-09-01 04:39:08'),
(94,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'106.206.232.14',	'okhttp/4.9.0',	'18',	'5',	'2021-09-01 04:43:41',	'2021-09-01 04:43:41'),
(95,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'106.206.232.14',	'okhttp/4.9.0',	'18',	'5',	'2021-09-01 04:46:14',	'2021-09-01 04:46:14'),
(96,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'106.206.232.14',	'okhttp/4.9.0',	'18',	'5',	'2021-09-01 04:54:02',	'2021-09-01 04:54:02'),
(97,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'106.206.232.14',	'okhttp/4.9.0',	'18',	'5',	'2021-09-01 05:16:05',	'2021-09-01 05:16:05'),
(98,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'106.206.232.14',	'okhttp/4.9.0',	'18',	'5',	'2021-09-01 05:19:09',	'2021-09-01 05:19:09'),
(99,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'2409:4055:593:bdc9:9011:39c4:120e:37c5',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:24:59',	'2021-09-01 05:24:59'),
(100,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'2409:4055:593:bdc9:9011:39c4:120e:37c5',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:29:41',	'2021-09-01 05:29:41'),
(101,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/successpayment',	'POST',	'157.39.31.240',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:37:09',	'2021-09-01 05:37:09'),
(102,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'2409:4055:593:bdc9:9011:39c4:120e:37c5',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:40:35',	'2021-09-01 05:40:35'),
(103,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/successpayment',	'POST',	'2409:4055:593:bdc9:9011:39c4:120e:37c5',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:41:34',	'2021-09-01 05:41:34'),
(104,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/successpayment',	'POST',	'2409:4055:593:bdc9:9011:39c4:120e:37c5',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:42:38',	'2021-09-01 05:42:38'),
(105,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/successpayment',	'POST',	'2409:4055:593:bdc9:9011:39c4:120e:37c5',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:43:34',	'2021-09-01 05:43:34'),
(106,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'2409:4055:593:bdc9:9011:39c4:120e:37c5',	'okhttp/4.9.0',	'19',	'5',	'2021-09-01 05:45:14',	'2021-09-01 05:45:14'),
(107,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'182.77.56.142',	'okhttp/4.9.0',	'38',	'5',	'2021-09-01 10:56:22',	'2021-09-01 10:56:22'),
(108,	'request for stock',	'http://technodeviser.com/grocerydelivery/api/protocol/store/stock-request',	'POST',	'182.77.56.142',	'okhttp/3.12.0',	'1',	'3',	'2021-09-03 05:22:32',	'2021-09-03 05:22:32'),
(109,	'cancel order',	'http://technodeviser.com/grocerydelivery/api/protocol/order-cancel',	'POST',	'182.77.56.142',	'okhttp/4.9.0',	'38',	'5',	'2021-09-03 05:36:52',	'2021-09-03 05:36:52'),
(110,	'New Order',	'http://technodeviser.com/grocerydelivery/api/protocol/create-order',	'POST',	'182.77.56.142',	'okhttp/4.9.0',	'38',	'5',	'2021-09-03 05:39:26',	'2021-09-03 05:39:26');

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `select_status` int(11) NOT NULL,
  `full_address` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_address` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `address` (`address_id`, `user_id`, `receiver_name`, `receiver_phone`, `city`, `society`, `house_no`, `landmark`, `state`, `pincode`, `lat`, `lng`, `select_status`, `full_address`, `address_type`, `other_address`, `added_at`, `updated_at`) VALUES
(12,	18,	'harjit vir',	'9915004993',	'JALANDHAR',	'Jalandhar',	'lamba pind jalandhar',	'JALANDHAR',	'Punjab',	'199188',	'31.340486',	'75.604264',	1,	'Techknow Deviser Professional Pvt. Ltd., Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab, India',	'1',	NULL,	'2021-05-10 18:20:50',	'2021-05-10 18:20:50'),
(21,	23,	'test',	'9915004993',	'Jalandhar',	'test',	'test',	'Jalandhar',	'Punjab',	'144009',	'31.3416601',	'75.604259',	0,	'1295/19, Lamba Pind, Jalandhar, Punjab 144009, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-07-07 13:51:53'),
(22,	23,	'test',	'9915004993',	'Jalandhar',	'test',	'test',	'Jalandhar',	'Punjab',	'144009',	'31.3416601',	'75.604259',	1,	'1295/19, Lamba Pind, Jalandhar, Punjab 144009, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-07-07 13:51:56'),
(23,	19,	'test',	'9915004993',	'Jalandhar',	'test',	'test',	'Jalandhar',	'Punjab',	'144009',	'31.3416601',	'75.604259',	1,	'1295/19, Lamba Pind, Jalandhar, Punjab 144009, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-07-07 13:51:58'),
(24,	18,	'test',	'9915004993',	'Sahibzada Ajit Singh Nagar',	'cghhh',	'test',	'Sahibzada Ajit Singh Nagar',	'Punjab',	'160055',	'30.699770897755556',	'76.69117726385595',	0,	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-02 16:56:22'),
(28,	18,	'nakoder',	'9915004993',	'Nakodar',	'1595 sahid bhagat singh nagar',	'testing',	'Nakodar',	'Punjab',	'144040',	'31.12701857112306',	'75.48177324235438',	0,	'Kalar Nagar, Nakodar, Punjab 144040, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-04 16:11:48'),
(29,	28,	'Gurpreet',	'9915004993',	'Jalandhar',	'hakandh',	'30a ShAnkr garden',	'Jalandhar',	'Punjab',	'144003',	'31.3041275',	'75.5841987',	1,	'50, Sat Kartar Nagar, Jalandhar, Punjab 144003, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-05 07:50:08'),
(33,	30,	'test',	'9915004993',	'Sahibzada Ajit Singh Nagar',	'test',	'test',	'Sahibzada Ajit Singh Nagar',	'Punjab',	'160055',	'30.6998031',	'76.6911361',	1,	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-05 11:35:49'),
(34,	34,	'texf',	'9915004993',	'Sahibzada Ajit Singh Nagar',	'ccc',	'fcc',	'Sahibzada Ajit Singh Nagar',	'Punjab',	'160055',	'30.6998273',	'76.6911204',	1,	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-10 17:26:57'),
(35,	0,	'gf',	'2',	'df',	'df',	'd',	'd',	'd',	'43',	'43',	'3',	0,	'gdfg',	'3',	'sdsfsdf',	'0000-00-00 00:00:00',	'2021-08-12 13:50:05'),
(36,	18,	'Harjit',	'9915004993',	'Sahibzada Ajit Singh Nagar',	'testing',	'testing',	'Sahibzada Ajit Singh Nagar',	'Punjab',	'160055',	'30.6998174',	'76.6911819',	0,	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'2',	NULL,	'0000-00-00 00:00:00',	'2021-08-12 14:05:33'),
(38,	18,	'cvv',	'9915004993',	'Chandigarh',	'ggg',	'rfg',	'Chandigarh',	'Punjab',	'148023',	'30.53899453972059',	'75.9550329297781',	0,	'Unnamed Road, Chandigarh, Punjab 148023, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-12 15:56:26'),
(39,	18,	'tersd',	'9915004993',	'Sahibzada Ajit Singh Nagar',	'cff',	'cff',	'Sahibzada Ajit Singh Nagar',	'Punjab',	'160055',	'30.699849312229365',	'76.69118095189334',	0,	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'3',	'1',	'0000-00-00 00:00:00',	'2021-08-17 12:20:25'),
(40,	39,	'tedt',	'9622222222',	'Sahibzada Ajit Singh Nagar',	'xdfffgggg',	'xffffvvvg',	'Sahibzada Ajit Singh Nagar',	'Punjab',	'160055',	'30.6998261',	'76.6912003',	1,	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'2',	NULL,	'0000-00-00 00:00:00',	'2021-08-18 14:32:20'),
(41,	18,	'harjit',	'9915004993',	'Sahibzada Ajit Singh Nagar',	'nend',	'yaHzhzbsbs',	'Sahibzada Ajit Singh Nagar',	'Punjab',	'140308',	'30.712508378048202',	'76.68714858591557',	0,	'PM6P+RP8, Industrial Area, Sector 74, Sahibzada Ajit Singh Nagar, Punjab 140308, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-19 15:55:08'),
(45,	38,	'ranbir',	'9876543211',	'Sahibzada Ajit Singh Nagar',	'tsst',	'test',	'Sector 75',	'Punjab',	'160055',	'30.6997788',	'76.6911808',	0,	'8A,Industrial Area,Sector 75',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-19 17:02:52'),
(46,	38,	'Ranbir Singh',	'9876543211',	'Sahibzada Ajit Singh Nagar',	'rfgvv',	'xc',	'Sector 75',	'Punjab',	'160055',	'30.704999446862765',	'76.69100157916546',	1,	'Teleperformance, A-40, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'2',	NULL,	'0000-00-00 00:00:00',	'2021-08-26 13:29:00'),
(47,	18,	'harjit',	'9915004993',	'Kharar',	'jgfcdddssdfggggfddd',	'95 sector',	'Sunny Enclave',	'Punjab',	'140301',	'30.76377336430178',	'76.66107550263405',	0,	'95, Sector 124, Sunny Enclave, Kharar, Punjab 140301, India',	'2',	NULL,	'0000-00-00 00:00:00',	'2021-08-26 16:04:32'),
(48,	18,	'harjit',	'9915004993',	'Sahibzada Ajit Singh Nagar',	'gg',	'sbsb',	'Sector 75',	'Punjab',	'160055',	'30.699819618520685',	'76.69114541262388',	0,	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	'1',	NULL,	'0000-00-00 00:00:00',	'2021-08-30 12:56:42');

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_pass`, `admin_image`) VALUES
(1,	'Admin',	'admin@gmail.com',	'$2y$10$5dC8ZRf15xgXzGf1nQ9aNubR19NQ9UNzhyHmNjxlK.ooU1b1Tq7LG',	'images/admin/profile/06-05-21/060521031524pm-gogrocer.png');

DROP TABLE IF EXISTS `admin_notification`;
CREATE TABLE `admin_notification` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `not_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `allocated` tinyint(1) NOT NULL DEFAULT 0,
  `varient_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_stock_request` tinyint(1) NOT NULL DEFAULT 0,
  `quantity` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allocated_quantity` int(111) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_notification` (`not_id`, `not_title`, `not_message`, `store_id`, `allocated`, `varient_id`, `is_stock_request`, `quantity`, `allocated_quantity`, `created_at`) VALUES
(31,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	1,	0,	'15',	0,	'12',	12,	'2021-08-26 18:39:25'),
(32,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	1,	0,	'12',	1,	'13',	0,	'2021-08-26 18:39:57'),
(33,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	1,	0,	'12',	1,	'13',	0,	'2021-08-30 14:07:58'),
(34,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	1,	0,	'2',	1,	'4',	0,	'2021-09-03 10:52:32');

DROP TABLE IF EXISTS `admin_payouts`;
CREATE TABLE `admin_payouts` (
  `payout_id` int(11) NOT NULL AUTO_INCREMENT,
  `payout_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respond_payout_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payout_amt` float NOT NULL,
  PRIMARY KEY (`payout_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `all_categories`;
CREATE TABLE `all_categories` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `store_id` varchar(250) NOT NULL DEFAULT '0',
  `image` text DEFAULT NULL,
  `description` text NOT NULL,
  `discount_type` enum('1','2','0') NOT NULL DEFAULT '0' COMMENT '1 =flat 2 =percentage 0  =none',
  `discount_amount` int(30) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `all_categories` (`id`, `title`, `store_id`, `image`, `description`, `discount_type`, `discount_amount`, `created_at`, `updated_at`) VALUES
(9,	'60% off',	'19',	'images/category_section_images/09-06-2021/icon_cat_163_v_3_500_1617258702.avif',	'60% off',	'2',	60,	'2021-06-09 05:32:14',	'2021-08-05 07:42:21'),
(10,	'60% off',	'19',	'images/category_section_images/09-06-2021/icon_cat_163_v_3_500_1617258702.avif',	'60% off',	'2',	60,	'2021-06-09 05:33:27',	'2021-08-05 07:42:21'),
(11,	'60% off',	'19',	'images/category_section_images/09-06-2021/icon_cat_163_v_3_500_1617258702.avif',	'60% off',	'2',	60,	'2021-06-09 05:34:17',	'2021-08-05 07:42:21'),
(12,	'60% off',	'19',	'images/category_section_images/09-06-2021/icon_cat_14_v_3_500_1617258329.avif',	'60% off',	'2',	60,	'2021-06-09 05:36:28',	'2021-08-05 07:42:21'),
(13,	'60% off',	'19',	'images/category_section_images/09-06-2021/icon_cat_14_v_3_500_1617258329.avif',	'60% off',	'2',	60,	'2021-06-09 05:37:15',	'2021-08-05 07:42:21'),
(14,	'60% off',	'19',	'images/category_section_images/09-06-2021/icon_cat_14_v_3_500_1617258329.avif',	'60% off',	'2',	60,	'2021-06-09 05:38:26',	'2021-08-05 07:42:21'),
(21,	'60% off',	'19',	'images/category_section_images/04-08-2021/cyclepure-three-in-one-agarbatti-800x800.jpg',	'60% off',	'2',	60,	'2021-08-04 08:38:55',	'2021-08-05 07:42:21'),
(22,	'60% off',	'19',	'images/category_section_images/05-08-2021/2420461622288609images-(1).jfif',	'60% off',	'2',	60,	'2021-08-05 06:20:07',	'2021-08-05 07:42:21'),
(23,	'60% off',	'19',	'images/category_section_images/05-08-2021/2420461622288609images-(1).jfif',	'60% off',	'2',	60,	'2021-08-05 07:11:16',	'2021-08-05 07:42:21'),
(25,	'60% off',	'1',	'images/category_section_images/05-08-2021/cyclepure-three-in-one-agarbatti-800x800.jpg',	'60% off',	'2',	60,	'2021-08-05 07:42:57',	'2021-08-05 07:48:05'),
(26,	'75% off',	'1',	'images/category_section_images/05-08-2021/2420461622288609images-(1).jfif',	'75% off',	'2',	75,	'2021-08-05 07:57:20',	'2021-08-05 07:57:53');

DROP TABLE IF EXISTS `app_layout_view`;
CREATE TABLE `app_layout_view` (
  `app_layout_id` int(30) NOT NULL AUTO_INCREMENT,
  `section_type` enum('1','2','3') NOT NULL,
  `app_layout_value` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `view_types` enum('list','grid') NOT NULL DEFAULT 'grid' COMMENT 'grid',
  `grid_row_volume` int(2) NOT NULL,
  `grid_type` enum('slide_down_grid','simple_grid') DEFAULT 'simple_grid' COMMENT 'simple_grid ,slide_down_grid ',
  `bg_type` enum('image','color') NOT NULL DEFAULT 'color',
  `color` varchar(250) DEFAULT 'white',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`app_layout_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `app_layout_view` (`app_layout_id`, `section_type`, `app_layout_value`, `name`, `view_types`, `grid_row_volume`, `grid_type`, `bg_type`, `color`, `created_at`, `updated_at`) VALUES
(1,	'1',	1,	'Category Design - 1',	'grid',	3,	'simple_grid',	'color',	'white',	'2021-06-05 06:10:14',	'2021-06-05 11:36:03'),
(2,	'1',	2,	'Category Design - 2',	'grid',	2,	'simple_grid',	'color',	'white',	'2021-06-05 06:11:04',	'2021-06-05 11:36:16'),
(3,	'1',	3,	'Category Design - 3',	'grid',	3,	'simple_grid',	'image',	'white',	'2021-06-05 06:11:41',	'2021-06-05 11:36:25'),
(4,	'1',	4,	'Category Design - 4',	'grid',	3,	'simple_grid',	'color',	'white',	'2021-06-05 06:12:21',	'2021-06-05 11:36:47'),
(5,	'1',	5,	'Category Design - 5',	'grid',	3,	'slide_down_grid',	'color',	'white',	'2021-06-05 06:12:57',	'2021-06-05 11:36:59'),
(6,	'3',	1,	'Product Design - 1',	'list',	0,	NULL,	'color',	'white',	'2021-06-05 06:18:59',	'2021-06-05 11:37:22'),
(7,	'2',	1,	'Sub-category Design - 1',	'grid',	3,	'simple_grid',	'color',	'white',	'2021-06-05 06:29:20',	'2021-06-05 11:37:41'),
(8,	'2',	2,	'Sub-category Design - 2',	'grid',	2,	'simple_grid',	'color',	'white',	'2021-06-05 06:30:01',	'2021-06-05 11:38:02'),
(9,	'2',	3,	'Sub-category Design - 3',	'grid',	3,	'simple_grid',	'image',	'white',	'2021-06-05 06:30:34',	'2021-06-05 11:38:17'),
(10,	'2',	4,	'Sub-category Design - 4',	'grid',	3,	'simple_grid',	'color',	'white',	'2021-06-05 06:31:31',	'2021-06-05 11:38:27'),
(11,	'2',	5,	'Sub-category Design - 5',	'grid',	3,	'slide_down_grid',	'color',	'white',	'2021-06-05 06:32:16',	'2021-06-05 11:38:39');

DROP TABLE IF EXISTS `app_notice`;
CREATE TABLE `app_notice` (
  `app_notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `notice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`app_notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `app_notice` (`app_notice_id`, `status`, `notice`) VALUES
(1,	0,	'This is the test notice.');

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `banner_id` int(100) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `banner` (`banner_id`, `banner_name`, `banner_image`) VALUES
(1,	'fcfdfd',	'images/banner/110521040258pm-imgCode.jfif');

DROP TABLE IF EXISTS `cancel_for`;
CREATE TABLE `cancel_for` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cancel_for` (`res_id`, `reason`) VALUES
(1,	'i bought from somewhere else'),
(2,	'NOT INTERESTED'),
(3,	'TAKING TO MUCH TIME FOR DELIVERY'),
(4,	'PRICE IS DIFFERENT FROM OTHER STORE');

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL AUTO_INCREMENT,
  `cartref` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `varient_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `product_id` int(30) NOT NULL,
  `varient_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `store_id` int(30) NOT NULL,
  `store_discount_amount` varchar(111) DEFAULT NULL,
  `discount_amount` int(30) DEFAULT NULL,
  `discount_type` enum('1','2','0') NOT NULL DEFAULT '0' COMMENT '1 =flat 2 =percentage 0  =none',
  `store_discount_type` enum('1','2','0') NOT NULL DEFAULT '0' COMMENT '1 =flat 2 =percentage 0  =none',
  `total_discount` int(11) NOT NULL,
  `price` int(30) NOT NULL,
  `final_price` int(30) NOT NULL,
  `product_name` varchar(240) NOT NULL,
  `product_description` text DEFAULT NULL,
  `quantity` int(30) NOT NULL,
  `unit` enum('kg','gm','pc','L','ml','plts','units') NOT NULL,
  `increment_value` int(30) NOT NULL,
  `in_stock` int(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cart_items` (`id`, `product_id`, `varient_id`, `user_id`, `store_id`, `store_discount_amount`, `discount_amount`, `discount_type`, `store_discount_type`, `total_discount`, `price`, `final_price`, `product_name`, `product_description`, `quantity`, `unit`, `increment_value`, `in_stock`, `created_at`, `updated_at`) VALUES
(158,	7,	7,	30,	1,	'0',	12,	'1',	'1',	12,	150,	138,	'Apple',	'Apple',	1,	'kg',	1,	9,	'2021-08-05 05:25:21',	'2021-08-05 05:25:33'),
(159,	2,	2,	30,	1,	'0',	5,	'1',	'1',	5,	50,	45,	'Lady finger',	'Lady finger',	1,	'kg',	1,	5,	'2021-08-05 06:51:55',	'2021-08-05 06:51:58'),
(214,	15,	15,	35,	0,	'0',	25,	'1',	'1',	25,	150,	125,	'DryFruit Halwa',	'DryFruit Halwa',	2,	'kg',	1,	9979,	'2021-08-10 12:56:10',	'2021-08-15 04:49:45'),
(215,	3,	3,	35,	0,	'0',	8,	'2',	'2',	8,	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	1,	8990,	'2021-08-10 13:27:41',	'2021-08-10 13:28:54'),
(216,	7,	7,	35,	0,	'0',	12,	'1',	'1',	12,	150,	138,	'Apple',	'Apple',	3,	'kg',	1,	8996,	'2021-08-10 13:27:48',	'2021-08-10 13:27:51'),
(217,	8,	8,	35,	0,	'0',	10,	'2',	'2',	10,	100,	90,	'Plum',	'Plum',	3,	'kg',	1,	99897,	'2021-08-10 13:28:05',	'2021-08-10 13:28:07'),
(218,	9,	9,	35,	0,	'0',	15,	'2',	'2',	15,	150,	135,	'Banana',	'Banana',	5,	'kg',	1,	10000,	'2021-08-10 13:28:08',	'2021-08-10 13:28:54'),
(219,	10,	10,	35,	0,	'0',	10,	'2',	'2',	10,	80,	70,	'Grapes',	'Grapes',	2,	'kg',	1,	10000,	'2021-08-10 13:28:39',	'2021-08-10 13:28:54'),
(220,	28,	28,	35,	0,	'0',	50,	'1',	'1',	50,	150,	100,	'sun',	'description',	1,	'kg',	1,	10,	'2021-08-10 13:28:50',	'2021-08-10 13:28:50'),
(222,	4,	4,	28,	0,	'0',	10,	'1',	'1',	10,	50,	40,	'Potato',	'Potato',	3,	'kg',	1,	996890,	'2021-08-11 14:01:07',	'2021-08-25 10:08:41'),
(223,	39,	37,	28,	0,	'0',	50,	'2',	'2',	50,	1000,	950,	'container',	NULL,	2,	'kg',	1,	2147483637,	'2021-08-11 14:01:27',	'2021-08-25 10:08:41'),
(224,	7,	7,	28,	0,	'0',	12,	'1',	'1',	12,	150,	138,	'Apple',	'Apple',	1,	'kg',	1,	900000,	'2021-08-11 14:06:06',	'2021-08-25 10:08:41'),
(257,	12,	12,	39,	1,	'0',	0,	'0',	'0',	0,	40,	40,	'Sweet lime',	'Sweet lime',	1,	'kg',	1,	4,	'2021-08-18 08:56:45',	'2021-08-18 08:56:45'),
(356,	4,	4,	18,	1,	'0',	10,	'1',	'1',	10,	50,	40,	'Potato',	'Potato',	1,	'kg',	1,	1,	'2021-09-01 10:59:16',	'2021-09-01 10:59:16'),
(358,	5,	5,	18,	1,	'0',	15,	'1',	'1',	15,	150,	135,	'Tomato',	'Tomato',	1,	'kg',	1,	6,	'2021-09-01 12:57:32',	'2021-09-01 12:57:32');

DROP TABLE IF EXISTS `cart_rewards`;
CREATE TABLE `cart_rewards` (
  `cart_rewards_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rewards` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_rewards_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`cat_id`, `title`, `slug`, `image`, `parent`, `level`, `description`, `status`) VALUES
(1,	'Vegetables and Fruits',	'Vegetables-and-Fruits',	'images/category/06-05-2021/Fresh-Vegetables.jpg',	0,	0,	'Vegetables and Fruits',	1),
(2,	'Sweets and Bakery',	'Sweets-and-Bakery',	'images/category/12-08-2021/40200457_2-bb-popular-bakery-biscuit-choco-chips.jpg',	11,	2,	'Sweets and Bakery',	1),
(3,	'Cakes and sweets',	'Cakes-and-sweets',	'images/category/06-05-2021/41-410728_cakes-and-sweets-png-transparent-png.png',	2,	1,	'Cakes and sweets',	1),
(4,	'Break-fast & Bakery food',	'Break-fast-&-Bakery-food',	'images/category/06-05-2021/breakfast-board-500x500.jpg',	2,	1,	'Break-fast & Bakery food',	1),
(5,	'Restaurant Food',	'Restaurant-Food',	'images/category/06-05-2021/three-col-1-1024x566-(1).jpg',	5,	2,	'Restaurant Food',	1),
(6,	'Biryani & Fried rice',	'Biryani-&-Fried-rice',	'images/category/06-05-2021/three-col-1-1024x566-(1).jpg',	5,	1,	'Biryani & Fried rice',	1),
(7,	'Curry & Snacks',	'Curry-&-Snacks',	'images/category/06-05-2021/pepper-chicken.jpg',	5,	1,	'Curry & Snacks',	1),
(8,	'Grocery',	'Grocery',	'images/category/06-05-2021/Grocery.jpg',	0,	0,	'Grocery',	1),
(9,	'Staple food',	'Staple-food',	'images/category/06-05-2021/concursos-web-1024x678.jpg',	41,	2,	'Staple food',	1),
(10,	'Home-care needs',	'Home-care-needs',	'images/category/06-05-2021/160-1606870_personal-care-products-png-transparent-png.png',	8,	1,	'Home-care needs',	1),
(11,	'Beverages and Biscuits, Snacks & Chocolates',	'Beverages-and-Biscuits,-Snacks-&-Chocolates',	'images/category/06-05-2021/Grocery.jpg',	8,	1,	'Beverages and Biscuits, Snacks & Chocolates',	1),
(12,	'Puja needs',	'Puja-needs',	'images/category/12-08-2021/40088284_1-hazel-nanda-deep-brass-diya-oil-lamp-puja-s11-golden.jpg',	8,	1,	'Puja needs',	1),
(14,	'Fresh Fruits',	'Fresh-Fruits',	'images/category/12-08-2021/hp_fnv_m_fresh-fruits_184_250721_02.jpg',	1,	1,	'Fresh Fruits',	1),
(15,	'Vegetables',	'Vegetables',	'images/category/06-05-2021/Fresh-Vegetables.jpg',	1,	1,	'Vegetables',	1),
(16,	'cuts & Sproutes',	'cuts-&-Sproutes',	'images/category/12-08-2021/hp_fnv_m_cuts-sprouts_m_184_250721_04.jpg',	1,	1,	'cuts & Sproutes',	1),
(20,	'Grocery & Staples',	'Grocery-&-Staples',	'images/category/23-06-2021/icon_cat_16_v_3_500_1553422381-500x250.jpg',	0,	0,	'Grocery & Staples',	1),
(21,	'kitchen and dining',	'kitchen-and-dining',	'images/category/23-06-2021/0e3ec8997ed69785cb07beb65ce4a3b6.jpg',	0,	0,	'kitchen and dining',	1),
(22,	'household items',	'household-items',	'images/category/23-06-2021/category-16160592289157.jpeg',	0,	0,	'household items',	1),
(23,	'personal care',	'personal-care',	'images/category/23-06-2021/Personal-Care-Category-New-GroceryUncle.com_.png',	0,	0,	'personal care',	1),
(25,	'Beverages',	'Beverages',	'images/category/23-06-2021/download-(5).jfif',	0,	0,	'Beverages',	1),
(26,	'Beverages',	'Beverages',	'images/category/23-06-2021/download-(5).jfif',	0,	0,	'Beverages',	1),
(27,	'breakfast & dairy',	'breakfast-&-dairy',	'images/category/23-06-2021/Breakfast-egg-dairy.jpg',	0,	0,	'breakfast & dairy',	1),
(28,	'baby care',	'baby-care',	'images/category/23-06-2021/images-(2).jfif',	0,	0,	'baby care',	1),
(29,	'packaged food',	'packaged-food',	'images/category/23-06-2021/e82e48d2cd67730d7cc9c37a656b001e.jpg',	0,	0,	'packaged food',	1),
(30,	'fresh frozen food',	'fresh-frozen-food',	'images/category/23-06-2021/download-(6).jfif',	0,	0,	'fresh frozen food',	1),
(31,	'pet care',	'pet-care',	'images/category/23-06-2021/PD13006_Main.png',	0,	0,	'pet care',	1),
(32,	'house finishing',	'house-finishing',	'images/category/23-06-2021/images-(3).jfif',	0,	0,	'house finishing',	1),
(33,	'pesticide free staples',	'pesticide-free-staples',	'images/category/23-06-2021/40004555_4-safe-harvest-mung-dal-pesticide-free.png',	0,	0,	'pesticide free staples',	1),
(34,	'best value brand',	'best-value-brand',	'images/category/23-06-2021/worst-walmart-products.jpg',	0,	0,	'best value brand',	1),
(35,	'detergent powders',	'detergent-powders',	'images/category/23-06-2021/BL25BRANDCHANDRIKA2.jfif',	0,	0,	'detergent powders',	1),
(36,	'cooking oil',	'cooking-oil',	'images/category/23-06-2021/0-18.png',	96,	1,	'cooking oil',	1),
(37,	'atta & other flours',	'atta-&-other-flours',	'images/category/23-06-2021/91o0m2iIpVL._SX522_.jpg',	20,	1,	'atta & other flours',	1),
(38,	'dry fruits & nuts',	'dry-fruits-&-nuts',	'images/category/12-08-2021/hp_fom_m_dry-fruits_480_250721_05.jpg',	20,	1,	'dry fruits & nuts',	1),
(39,	'ghee and vanaspati',	'ghee-and-vanaspati',	'images/category/23-06-2021/dla_ghe_l.jpg',	97,	2,	'ghee and vanaspati',	1),
(40,	'organic staples',	'organic-staples',	'images/category/23-06-2021/download-(7).jfif',	20,	1,	'organic staples',	1),
(41,	'rice & other grains',	'rice-&-other-grains',	'images/category/23-06-2021/India-Gate-Mogra-Basmati-Rice-1000x1000-1-405x330.jpg',	20,	1,	'rice & other grains',	1),
(42,	'pulses',	'pulses',	'images/category/24-06-2021/grocery-500x500.jpg',	20,	1,	'pulses',	1),
(43,	'salt& suger',	'salt&-suger',	'images/category/24-06-2021/download-(8).jfif',	20,	1,	'salt& suger',	1),
(44,	'chips & crisps',	'chips-&-crisps',	'images/category/24-06-2021/images-(4).jfif',	20,	1,	'chips & crisps',	1),
(45,	'confectionery',	'confectionery',	'images/category/24-06-2021/51fAvr+EueL.jpg',	20,	1,	'confectionery',	1),
(46,	'ready made meals & mixes',	'ready-made-meals-&-mixes',	'images/category/24-06-2021/3-250x250.png',	20,	1,	'ready made meals & mixes',	1),
(47,	'kitchen accessories',	'kitchen-accessories',	'images/category/24-06-2021/kitchen-accessory-chopping-board-tray-spoon-plate-kitchen-accessories-chopping-board-tray-supports-spoons-plate-wooden-table-168538721.jpg',	21,	1,	'kitchen accessories',	1),
(48,	'container',	'container',	'images/category/24-06-2021/culpol_02.15.19_z48a0104_ds_2400.jpg',	21,	1,	'container',	1),
(49,	'mugs and glasses',	'mugs-and-glasses',	'images/category/24-06-2021/61mDO46ns1L._SL1000_.jpg',	21,	1,	'mugs and glasses',	1),
(50,	'bottle & flask',	'bottle-&-flask',	'images/category/24-06-2021/GC0413Group.jpg.jpg',	21,	1,	'bottle & flask',	1),
(51,	'casseroles',	'casseroles',	'images/category/24-06-2021/download-(9).jfif',	21,	1,	'casseroles',	1),
(52,	'dinner set',	'dinner-set',	'images/category/24-06-2021/36-vt-kds-142-varasani-traders-original-imagfbxhzjgqqumt.jpeg',	21,	1,	'dinner set',	1),
(53,	'dishwashing gels & powder',	'dishwashing-gels-&-powder',	'images/category/24-06-2021/51gFR497YvL._SL1000_.jpg',	22,	1,	'dishwashing gels & powder',	1),
(54,	'scrubbers & Cleaning aids',	'scrubbers-&-Cleaning-aids',	'images/category/24-06-2021/61CO9UPp4wL._SY355_.jpg',	22,	1,	'scrubbers & Cleaning aids',	1),
(55,	'toilet & other disposables',	'toilet-&-other-disposables',	'images/category/24-06-2021/51669.0.jpg',	22,	1,	'toilet & other disposables',	1),
(56,	'detergents',	'detergents',	'images/category/24-06-2021/download_6.jpg',	22,	1,	'detergents',	1),
(57,	'cleaner',	'cleaner',	'images/category/24-06-2021/Floor-x-500ml.jpg',	22,	1,	'cleaner',	1),
(58,	'hair oil',	'hair-oil',	'images/category/24-06-2021/download-(10).jfif',	23,	1,	'hair oil',	1),
(59,	'shampoo',	'shampoo',	'images/category/24-06-2021/40141851_2-dove-intense-repair-shampoo-1.png',	23,	1,	'shampoo',	1),
(60,	'soap baby wash',	'soap-baby-wash',	'images/category/24-06-2021/baby-bath-hygiene-20200522.png',	23,	1,	'soap baby wash',	1),
(61,	'bathroom accessories',	'bathroom-accessories',	'images/category/24-06-2021/Bath-Body.png',	23,	1,	'bathroom accessories',	1),
(62,	'vegetables',	'vegetables',	'images/category/24-06-2021/19356059-assorted-grocery-products-including-vegetables-fruits-wine-bread-dairy-and-meat-isolated-on-white.jpg',	1,	2,	'vegetables',	1),
(65,	'tea',	'tea',	'images/category/24-06-2021/images-(6).jfif',	25,	1,	'tea',	1),
(66,	'green tea',	'green-tea',	'images/category/24-06-2021/top-10-green-tea-brands-in-india-1.jpg',	25,	1,	'green tea',	1),
(67,	'coffee',	'coffee',	'images/category/24-06-2021/2-Eight-O-Clock-The-Original-Decaf-Top-5-Grocery-Bought-Coffee-Brands.jpg',	25,	1,	'coffee',	1),
(68,	'cold drinks',	'cold-drinks',	'images/category/24-06-2021/61YtMzKQZDL._SX522_.jpg',	25,	1,	'cold drinks',	1),
(69,	'juices',	'juices',	'images/category/24-06-2021/713I4hNaXSL._SX522_.jpg',	25,	1,	'juices',	1),
(70,	'butter & cheese',	'butter-&-cheese',	'images/category/24-06-2021/images-(7).jfif',	27,	1,	'butter & cheese',	1),
(71,	'bread & food',	'bread-&-food',	'images/category/24-06-2021/81coLjMhbBL._SX522_.jpg',	27,	1,	'bread & food',	1),
(72,	'milk & whiteners',	'milk-&-whiteners',	'images/category/24-06-2021/download-(12).jfif',	27,	1,	'milk & whiteners',	1),
(73,	'breakfast cereals',	'breakfast-cereals',	'images/category/24-06-2021/61iGpCQrr1L._SX522_.jpg',	27,	1,	'breakfast cereals',	1),
(74,	'Diaper & wipes',	'Diaper-&-wipes',	'images/category/24-06-2021/51Ion1ON-uL.jpg',	28,	1,	'Diaper & wipes',	1),
(75,	'baby food',	'baby-food',	'images/category/24-06-2021/81FSRcLAPiL._SX679_.jpg',	28,	1,	'baby food',	1),
(76,	'baby skin & hair care',	'baby-skin-&-hair-care',	'images/category/24-06-2021/71+a6u-st6L._SL1000_.jpg',	28,	1,	'baby skin & hair care',	1),
(77,	'baby accessories',	'baby-accessories',	'images/category/24-06-2021/8904026630062-300x300.jpg',	28,	1,	'baby accessories',	1),
(78,	'biscuits cookies',	'biscuits-cookies',	'images/category/24-06-2021/812z5KHMZWL._SY550_.jpg',	29,	1,	'biscuits cookies',	1),
(79,	'chocolates & candies',	'chocolates-&-candies',	'images/category/24-06-2021/118a3ceae3afc6a072891a589fc431ea.jpg',	29,	1,	'chocolates & candies',	1),
(80,	'namkeen & chips',	'namkeen-&-chips',	'images/category/24-06-2021/download-(13).jfif',	29,	1,	'namkeen & chips',	1),
(81,	'egg',	'egg',	'images/category/24-06-2021/images-(8).jfif',	30,	1,	'egg',	1),
(82,	'meat',	'meat',	'images/category/24-06-2021/download-(14).jfif',	30,	1,	'meat',	1),
(83,	'frozen',	'frozen',	'images/category/24-06-2021/images-(9).jfif',	30,	1,	'frozen',	1),
(84,	'dog food & Treats',	'dog-food-&-Treats',	'images/category/24-06-2021/81WpJyV8UHL._SL1500_.jpg',	31,	1,	'dog food & Treats',	1),
(85,	'cat food & Treats',	'cat-food-&-Treats',	'images/category/24-06-2021/51esvS2k0zL.jpg',	31,	1,	'cat food & Treats',	1),
(86,	'Twels',	'Twels',	'images/category/24-06-2021/download-(15).jfif',	32,	1,	'Twels',	1),
(87,	'furniture',	'furniture',	'images/category/24-06-2021/HTB151r6c4uTBuNkHFNRq6A9qpXal.jpg',	32,	1,	'furniture',	1),
(88,	'curtains',	'curtains',	'images/category/24-06-2021/Screenshot_20200815_235037.jpg',	32,	1,	'curtains',	1),
(89,	'pesticide-free atta',	'pesticide-free-atta',	'images/category/24-06-2021/20003062_6-safe-harvest-whole-wheat-atta-pesticide-free.jpg',	33,	1,	'pesticide-free atta',	1),
(90,	'pesticide-free pulses',	'pesticide-free-pulses',	'images/category/24-06-2021/40004555_4-safe-harvest-mung-dal-pesticide-free-(1).png',	33,	1,	'pesticide-free pulses',	1),
(91,	'grocery & staples',	'grocery-&-staples',	'images/category/24-06-2021/773d10eaf03213bd0a17e84607e7949d_1200x1200.jpg',	34,	1,	'grocery & staples',	1),
(92,	'beverages',	'beverages',	'images/category/24-06-2021/Beverages-350x326.png',	34,	1,	'beverages',	1),
(93,	'disinfectants',	'disinfectants',	'images/category/24-06-2021/images-(10).jfif',	35,	1,	'disinfectants',	1),
(94,	'laundry detergents',	'laundry-detergents',	'images/category/24-06-2021/images-(11).jfif',	35,	1,	'laundry detergents',	1),
(96,	'cooking oil & ghee',	'cooking-oil-&-ghee',	'images/category/12-08-2021/hp_fom_m_cooking-oil_480_250721_04.jpg',	0,	0,	'cooking oil & ghee',	1),
(97,	'ghee',	'ghee',	'images/category/12-08-2021/40009511_9-patanjali-cow-ghee.jpg',	96,	1,	'ghee',	1);

DROP TABLE IF EXISTS `categories_cat_id`;
CREATE TABLE `categories_cat_id` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `section_id` int(30) NOT NULL,
  `cat_id` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `categories_cat_id` (`id`, `section_id`, `cat_id`, `status`, `created_at`, `updated_at`) VALUES
(9,	9,	13,	1,	'2021-06-09 11:02:14',	NULL),
(11,	10,	13,	1,	'2021-06-09 11:03:27',	NULL),
(12,	10,	18,	1,	'2021-06-09 11:03:28',	NULL),
(13,	11,	13,	1,	'2021-06-09 11:04:17',	NULL),
(14,	11,	18,	1,	'2021-06-09 11:04:17',	NULL),
(15,	12,	13,	1,	'2021-06-09 11:06:28',	NULL),
(16,	12,	18,	1,	'2021-06-09 11:06:28',	NULL),
(21,	21,	8,	1,	'2021-08-05 06:07:47',	NULL),
(22,	21,	23,	1,	'2021-08-05 06:07:48',	NULL),
(23,	21,	24,	1,	'2021-08-05 06:07:54',	NULL),
(24,	9,	1,	1,	'2021-08-05 06:48:44',	NULL),
(25,	9,	8,	1,	'2021-08-05 06:48:45',	NULL),
(28,	9,	25,	1,	'2021-08-05 06:48:47',	NULL),
(29,	23,	1,	1,	'2021-08-05 07:11:56',	NULL),
(30,	23,	8,	1,	'2021-08-05 07:11:56',	NULL),
(31,	23,	21,	1,	'2021-08-05 07:11:57',	NULL),
(32,	23,	23,	1,	'2021-08-05 07:11:58',	NULL),
(33,	25,	1,	1,	'2021-08-05 07:56:21',	NULL),
(34,	25,	8,	1,	'2021-08-05 07:56:22',	NULL),
(35,	25,	21,	1,	'2021-08-05 07:56:22',	NULL),
(36,	25,	23,	1,	'2021-08-05 07:56:23',	NULL),
(37,	25,	24,	1,	'2021-08-05 07:56:27',	NULL),
(38,	25,	25,	1,	'2021-08-05 07:56:28',	NULL),
(39,	26,	33,	1,	'2021-08-05 07:57:43',	NULL),
(40,	26,	31,	1,	'2021-08-05 07:57:44',	NULL),
(41,	26,	30,	1,	'2021-08-05 07:57:45',	NULL),
(42,	26,	29,	1,	'2021-08-05 07:57:45',	NULL),
(43,	26,	27,	1,	'2021-08-05 07:57:46',	NULL),
(44,	26,	25,	1,	'2021-08-05 07:57:48',	NULL);

DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `city_id` int(100) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(2,	'JALANDHAR'),
(3,	'CHANDIGHAR'),
(4,	'DELHI'),
(5,	'SONIPAT'),
(6,	'New testing city');

DROP TABLE IF EXISTS `closing_hours`;
CREATE TABLE `closing_hours` (
  `closing_hrs_id` int(100) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_hrs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_hrs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`closing_hrs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `closing_hours` (`closing_hrs_id`, `date`, `start_hrs`, `end_hrs`) VALUES
(1,	'2020-05-15',	'11:00',	'22:00');

DROP TABLE IF EXISTS `country_code`;
CREATE TABLE `country_code` (
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` int(11) NOT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `country_code` (`code_id`, `country_code`) VALUES
(1,	880);

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `coupon_id` int(100) NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `cart_value` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=''none'',1=''flate'',2=''percentade''',
  `uses_restriction` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `coupon` (`coupon_id`, `coupon_name`, `coupon_code`, `coupon_description`, `start_date`, `end_date`, `cart_value`, `amount`, `type`, `uses_restriction`) VALUES
(1,	'get 20% of on all',	'Discount20',	'20% on order above 300',	'2021-08-08 10:25:00',	'2021-08-14 10:25:00',	200,	20,	'2',	5),
(2,	'dfgdf',	'dgdfg',	'dfgdf',	'2021-08-17 11:01:00',	'2021-09-19 11:01:00',	3,	50,	'1',	1),
(3,	'zsdf',	'ZPDQQVJVO6',	'sf',	'2021-08-17 11:21:00',	'2021-08-31 11:21:00',	4,	50,	'1',	2),
(4,	'sd',	'ZPDQQVJVO6',	'asd',	'2021-08-17 11:24:00',	'2021-09-05 11:24:00',	2,	55,	'1',	2),
(5,	'sadas',	'TDBBU4UTAG',	'fdsf',	'2021-08-20 12:25:00',	'2021-08-28 12:25:00',	2,	10,	'2',	1),
(6,	'sadas',	'TDU535E93P',	'fdsf',	'2021-08-20 12:25:00',	'2021-08-28 12:25:00',	2,	10,	'2',	1),
(7,	'sadas',	'TDQ7XIVCH9',	'fdsf',	'2021-08-20 12:25:00',	'2021-08-28 12:25:00',	2,	10,	'2',	1),
(8,	'sadas',	'TDBJ07SI5V',	'fdsf',	'2021-08-20 12:25:00',	'2021-08-28 12:25:00',	2,	10,	'2',	1),
(9,	'sadas',	'TDY9EYSLQK',	'fdsf',	'2021-08-18 12:36:00',	'2021-08-31 12:36:00',	2,	10,	'2',	1);

DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_sign` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `currency` (`id`, `currency_name`, `currency_sign`) VALUES
(1,	'INR',	'Rs');

DROP TABLE IF EXISTS `deal_product`;
CREATE TABLE `deal_product` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `varient_id` int(11) NOT NULL,
  `deal_price` float NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `delivery_boy`;
CREATE TABLE `delivery_boy` (
  `dboy_id` int(11) NOT NULL AUTO_INCREMENT,
  `boy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `boy_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `boy_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boy_loc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`dboy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `delivery_boy` (`dboy_id`, `boy_name`, `boy_phone`, `boy_city`, `password`, `device_id`, `boy_loc`, `otp_value`, `lat`, `lng`, `status`) VALUES
(1,	'Delivery driver',	'7878787878',	'CHANDIGHAR',	'admin@123',	'd',	'Sector 17, Chandigarh, India',	'5223',	'30.7410517',	'76.779015',	1),
(2,	'goleeeg',	'7696399515',	'jalandhar',	'$2y$10$XH6IDI6G5AXMfwCjzclpf.YVVxY7koJv5sP01E9TqKiwIa57H17ze',	'cIKK-x_4RCufnU4QkPVXSD:APA91bEuLJiClGyQFqZngreKl9tP4YkOBYkR5SPUtYfcYGFVtno6lgOrWczwF7zt0Fq5KtC1pdVlsMJgULqBH0RWLzwDex2sOLB0QCQsiHkwzBX6qkJGB0XyZ83tf5Dp1A4BAy_zAWBZ',	'Capitol Hidpital, Dhogri Road, Nurpur, Punjab 144009, India',	NULL,	'31.363313653646664',	'75.59792429208755',	1),
(4,	'test2',	'9998887771',	'chandigarh',	'$2y$10$XH6IDI6G5AXMfwCjzclpf.YVVxY7koJv5sP01E9TqKiwIa57H17ze',	'cIKK-x_4RCufnU4QkPVXSD:APA91bEuLJiClGyQFqZngreKl9tP4YkOBYkR5SPUtYfcYGFVtno6lgOrWczwF7zt0Fq5KtC1pdVlsMJgULqBH0RWLzwDex2sOLB0QCQsiHkwzBX6qkJGB0XyZ83tf5Dp1A4BAy_zAWBZ',	'8A, Industrial Area, Sector 75, Sahibzada Ajit Singh Nagar, Punjab 160055, India',	NULL,	'30.69992196087617',	'76.69114977121353',	1);

DROP TABLE IF EXISTS `delivery_rating`;
CREATE TABLE `delivery_rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dboy_id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `driver_notification`;
CREATE TABLE `driver_notification` (
  `noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `dboy_id` int(11) NOT NULL,
  `noti_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noti_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_by_user` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `driver_notification` (`noti_id`, `dboy_id`, `noti_title`, `noti_message`, `read_by_user`, `created_at`) VALUES
(30,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-08-31 17:23:53'),
(31,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-08-31 17:25:03'),
(32,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-08-31 17:25:07'),
(33,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-08-31 18:03:26'),
(34,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-08-31 18:21:06'),
(35,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-01 10:20:22'),
(36,	2,	'Removed',	'You are Removed for Delivery order',	0,	'2021-09-01 10:20:58'),
(37,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-01 10:21:12'),
(38,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-01 11:37:28'),
(39,	2,	'Removed',	'You are Removed for Delivery order',	0,	'2021-09-01 11:38:01'),
(40,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-01 11:38:28'),
(41,	2,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-01 11:46:44'),
(42,	4,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-03 11:09:48'),
(43,	4,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-03 11:10:27'),
(44,	4,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-03 11:11:54'),
(45,	4,	'Removed',	'You are Removed for Delivery order',	0,	'2021-09-03 11:11:59'),
(46,	4,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-09-03 11:12:08'),
(47,	4,	'Removed',	'You are Removed for Delivery order',	0,	'2021-09-03 11:12:27');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faqs` (`about_id`, `title`, `description`) VALUES
(1,	'About Us',	'<p><strong>FAQ</strong></p>\r\n\r\n<p>Where you place your FAQ is page is almost as important as creating one.</p>\r\n\r\n<p>While there are many tech-savvy folks who search for the FAQ page link in the footer of websites, most people don&rsquo;t even have a clue about FAQ pages. So it&rsquo;s your job to make it easier for them to find your FAQs.</p>\r\n\r\n<p>For example, the pricing page of a business or product website is a great place to position a FAQ section. It&rsquo;s where most potential customers begin to come up with questions about product features, pricing plans, and more.</p>');

DROP TABLE IF EXISTS `fcm`;
CREATE TABLE `fcm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `server_key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_server_key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_server_key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `fcm` (`id`, `sender_id`, `server_key`, `store_server_key`, `driver_server_key`) VALUES
(1,	'352076647507',	'AAAAvRtfafU:APA91bF8zgzwEpYQwLha0KsSvYvdJW5-PPv3IRzcMStvgSujJNbUOopZp3SjEssppVixodEJpm5gEzijTlpF-Ax5P6stb8Fa4GDLAidy9val70sZTmqLG7EgHKzAces88SOt5zpsfWMy',	'AAAAvRtfafU:APA91bF8zgzwEpYQwLha0KsSvYvdJW5-PPv3IRzcMStvgSujJNbUOopZp3SjEssppVixodEJpm5gEzijTlpF-Ax5P6stb8Fa4GDLAidy9val70sZTmqLG7EgHKzAces88SOt5zpsfWMy',	'AAAAvRtfafU:APA91bF8zgzwEpYQwLha0KsSvYvdJW5-PPv3IRzcMStvgSujJNbUOopZp3SjEssppVixodEJpm5gEzijTlpF-Ax5P6stb8Fa4GDLAidy9val70sZTmqLG7EgHKzAces88SOt5zpsfWMy');

DROP TABLE IF EXISTS `firebase`;
CREATE TABLE `firebase` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `firebase` (`f_id`, `status`) VALUES
(1,	1);

DROP TABLE IF EXISTS `freedeliverycart`;
CREATE TABLE `freedeliverycart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min_cart_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `del_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `freedeliverycart` (`id`, `min_cart_value`, `del_charge`) VALUES
(1,	'500',	'1');

DROP TABLE IF EXISTS `home_content`;
CREATE TABLE `home_content` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `section_id` int(30) NOT NULL,
  `category_id` text NOT NULL,
  `sub_category` text NOT NULL,
  `product_id` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `home_content` (`id`, `section_id`, `category_id`, `sub_category`, `product_id`, `status`, `created_at`, `updated_at`) VALUES
(317,	147,	'1',	'',	'',	0,	'2021-06-29 15:30:33',	'2021-06-29 15:30:33'),
(331,	150,	'',	'',	'1',	1,	'2021-06-30 04:20:36',	'2021-06-30 04:20:36'),
(332,	150,	'',	'',	'2',	1,	'2021-06-30 04:20:37',	'2021-06-30 04:20:37'),
(333,	150,	'',	'',	'3',	1,	'2021-06-30 04:20:38',	'2021-06-30 04:20:38'),
(336,	150,	'',	'',	'6',	1,	'2021-06-30 04:20:40',	'2021-06-30 04:20:40'),
(337,	150,	'1',	'',	'',	0,	'2021-06-30 04:20:46',	'2021-06-30 04:20:46'),
(338,	150,	'',	'',	'17',	1,	'2021-06-30 04:28:11',	'2021-06-30 04:28:11'),
(339,	150,	'',	'',	'18',	1,	'2021-06-30 04:28:11',	'2021-06-30 04:28:11'),
(340,	150,	'',	'',	'19',	1,	'2021-06-30 04:28:12',	'2021-06-30 04:28:12'),
(341,	150,	'',	'',	'21',	1,	'2021-06-30 04:28:12',	'2021-06-30 04:28:12'),
(342,	150,	'2',	'',	'',	0,	'2021-06-30 04:28:13',	'2021-06-30 04:28:13'),
(358,	154,	'',	'9',	'',	1,	'2021-06-30 05:14:51',	'2021-06-30 05:14:51'),
(360,	154,	'',	'11',	'',	1,	'2021-06-30 05:14:52',	'2021-06-30 05:14:52'),
(362,	154,	'',	'19',	'',	1,	'2021-06-30 05:14:56',	'2021-06-30 05:14:56'),
(363,	154,	'',	'36',	'',	1,	'2021-06-30 05:14:57',	'2021-06-30 05:14:57'),
(364,	154,	'',	'37',	'',	1,	'2021-06-30 05:14:58',	'2021-06-30 05:14:58'),
(365,	154,	'',	'38',	'',	1,	'2021-06-30 05:14:59',	'2021-06-30 05:14:59'),
(367,	154,	'',	'40',	'',	1,	'2021-06-30 05:15:02',	'2021-06-30 05:15:02'),
(368,	154,	'',	'41',	'',	1,	'2021-06-30 05:15:02',	'2021-06-30 05:15:02'),
(369,	154,	'',	'42',	'',	1,	'2021-06-30 05:15:04',	'2021-06-30 05:15:04'),
(422,	150,	'',	'',	'33',	1,	'2021-06-30 09:28:31',	'2021-06-30 09:28:31'),
(423,	150,	'',	'',	'34',	1,	'2021-06-30 09:28:32',	'2021-06-30 09:28:32'),
(424,	150,	'20',	'',	'',	0,	'2021-06-30 09:28:36',	'2021-06-30 09:28:36'),
(446,	147,	'',	'',	'26',	1,	'2021-06-30 09:32:21',	'2021-06-30 09:32:21'),
(447,	147,	'',	'',	'25',	1,	'2021-06-30 09:32:21',	'2021-06-30 09:32:21'),
(449,	147,	'',	'',	'23',	1,	'2021-06-30 09:32:23',	'2021-06-30 09:32:23'),
(450,	147,	'',	'',	'22',	1,	'2021-06-30 09:32:23',	'2021-06-30 09:32:23'),
(451,	147,	'',	'',	'21',	1,	'2021-06-30 09:32:25',	'2021-06-30 09:32:25'),
(452,	147,	'',	'',	'20',	1,	'2021-06-30 09:32:25',	'2021-06-30 09:32:25'),
(453,	147,	'',	'',	'19',	1,	'2021-06-30 09:32:27',	'2021-06-30 09:32:27'),
(454,	147,	'',	'',	'18',	1,	'2021-06-30 09:32:28',	'2021-06-30 09:32:28'),
(455,	147,	'',	'',	'15',	1,	'2021-06-30 09:32:30',	'2021-06-30 09:32:30'),
(456,	147,	'8',	'',	'',	0,	'2021-06-30 09:32:31',	'2021-06-30 09:32:31'),
(457,	151,	'20',	'',	'',	1,	'2021-06-30 09:32:53',	'2021-06-30 09:32:53'),
(458,	151,	'8',	'',	'',	1,	'2021-06-30 09:33:02',	'2021-06-30 09:33:02'),
(459,	151,	'13',	'',	'',	1,	'2021-06-30 09:33:05',	'2021-06-30 09:33:05'),
(461,	151,	'21',	'',	'',	1,	'2021-06-30 09:33:07',	'2021-06-30 09:33:07'),
(464,	153,	'13',	'',	'',	1,	'2021-06-30 09:33:30',	'2021-06-30 09:33:30'),
(465,	153,	'18',	'',	'',	1,	'2021-06-30 09:33:31',	'2021-06-30 09:33:31'),
(467,	153,	'21',	'',	'',	1,	'2021-06-30 09:33:33',	'2021-06-30 09:33:33'),
(469,	153,	'20',	'',	'',	1,	'2021-06-30 09:33:44',	'2021-06-30 09:33:44'),
(470,	153,	'8',	'',	'',	1,	'2021-06-30 09:33:48',	'2021-06-30 09:33:48'),
(471,	159,	'',	'',	'1',	1,	'2021-06-30 10:17:59',	'2021-06-30 10:17:59'),
(472,	159,	'',	'',	'2',	1,	'2021-06-30 10:18:00',	'2021-06-30 10:18:00'),
(474,	152,	'8',	'',	'',	1,	'2021-06-30 13:30:14',	'2021-06-30 13:30:14'),
(475,	152,	'18',	'',	'',	1,	'2021-06-30 13:30:15',	'2021-06-30 13:30:15'),
(477,	152,	'21',	'',	'',	1,	'2021-06-30 13:30:16',	'2021-06-30 13:30:16'),
(496,	152,	'20',	'',	'',	1,	'2021-06-30 13:38:30',	'2021-06-30 13:38:30'),
(517,	148,	'8',	'',	'',	1,	'2021-06-30 14:49:13',	'2021-06-30 14:49:13'),
(519,	148,	'20',	'',	'',	1,	'2021-06-30 14:49:16',	'2021-06-30 14:49:16'),
(520,	148,	'21',	'',	'',	1,	'2021-06-30 14:49:16',	'2021-06-30 14:49:16'),
(521,	148,	'18',	'',	'',	1,	'2021-06-30 14:49:30',	'2021-06-30 14:49:30'),
(527,	163,	'8',	'',	'',	1,	'2021-07-12 11:57:38',	'2021-07-12 11:57:38'),
(528,	163,	'18',	'',	'',	1,	'2021-07-12 11:57:38',	'2021-07-12 11:57:38'),
(529,	163,	'20',	'',	'',	1,	'2021-07-12 11:57:38',	'2021-07-12 11:57:38'),
(530,	163,	'21',	'',	'',	1,	'2021-07-12 11:57:39',	'2021-07-12 11:57:39'),
(532,	164,	'8',	'',	'',	1,	'2021-07-12 12:07:48',	'2021-07-12 12:07:48'),
(533,	164,	'20',	'',	'',	1,	'2021-07-12 12:07:48',	'2021-07-12 12:07:48'),
(534,	164,	'21',	'',	'',	1,	'2021-07-12 12:07:49',	'2021-07-12 12:07:49'),
(549,	166,	'',	'',	'2',	1,	'2021-07-12 12:15:01',	'2021-07-12 12:15:01'),
(550,	166,	'',	'',	'3',	1,	'2021-07-12 12:15:01',	'2021-07-12 12:15:01'),
(551,	166,	'',	'',	'4',	1,	'2021-07-12 12:15:02',	'2021-07-12 12:15:02'),
(552,	166,	'',	'',	'5',	1,	'2021-07-12 12:15:02',	'2021-07-12 12:15:02'),
(553,	166,	'',	'',	'6',	1,	'2021-07-12 12:15:04',	'2021-07-12 12:15:04'),
(554,	166,	'',	'',	'7',	1,	'2021-07-12 12:15:05',	'2021-07-12 12:15:05'),
(556,	166,	'',	'',	'9',	1,	'2021-07-12 12:15:08',	'2021-07-12 12:15:08'),
(557,	166,	'',	'',	'10',	1,	'2021-07-12 12:15:10',	'2021-07-12 12:15:10'),
(558,	166,	'',	'',	'12',	1,	'2021-07-12 12:15:11',	'2021-07-12 12:15:11'),
(559,	166,	'',	'',	'11',	1,	'2021-07-12 12:15:11',	'2021-07-12 12:15:11'),
(560,	166,	'8',	'',	'',	0,	'2021-07-12 12:15:16',	'2021-07-12 12:15:16'),
(561,	167,	'',	'',	'1',	1,	'2021-07-12 12:38:16',	'2021-07-12 12:38:16'),
(564,	167,	'',	'',	'3',	1,	'2021-07-12 12:38:18',	'2021-07-12 12:38:18'),
(565,	167,	'',	'',	'4',	1,	'2021-07-12 12:38:18',	'2021-07-12 12:38:18'),
(566,	167,	'',	'',	'5',	1,	'2021-07-12 12:38:20',	'2021-07-12 12:38:20'),
(567,	167,	'',	'',	'6',	1,	'2021-07-12 12:38:20',	'2021-07-12 12:38:20'),
(568,	167,	'',	'',	'7',	1,	'2021-07-12 12:38:21',	'2021-07-12 12:38:21'),
(569,	167,	'',	'',	'9',	1,	'2021-07-12 12:38:23',	'2021-07-12 12:38:23'),
(570,	167,	'',	'',	'8',	1,	'2021-07-12 12:38:24',	'2021-07-12 12:38:24'),
(571,	167,	'',	'',	'10',	1,	'2021-07-12 12:38:24',	'2021-07-12 12:38:24'),
(572,	167,	'',	'',	'11',	1,	'2021-07-12 12:38:25',	'2021-07-12 12:38:25'),
(573,	167,	'',	'',	'12',	1,	'2021-07-12 12:38:26',	'2021-07-12 12:38:26'),
(574,	167,	'8',	'',	'',	0,	'2021-07-12 12:38:29',	'2021-07-12 12:38:29'),
(605,	169,	'8',	'',	'',	0,	'2021-07-12 12:43:29',	'2021-07-12 12:43:29'),
(606,	179,	'8',	'',	'',	1,	'2021-07-13 08:05:04',	'2021-07-13 08:05:04'),
(607,	179,	'18',	'',	'',	1,	'2021-07-13 08:05:05',	'2021-07-13 08:05:05'),
(608,	179,	'20',	'',	'',	1,	'2021-07-13 08:05:06',	'2021-07-13 08:05:06'),
(609,	179,	'21',	'',	'',	1,	'2021-07-13 08:05:06',	'2021-07-13 08:05:06'),
(610,	180,	'1',	'',	'',	1,	'2021-07-15 10:53:35',	'2021-07-15 10:53:35'),
(612,	180,	'21',	'',	'',	1,	'2021-07-15 10:53:40',	'2021-07-15 10:53:40'),
(613,	180,	'22',	'',	'',	1,	'2021-07-15 10:53:41',	'2021-07-15 10:53:41'),
(614,	180,	'24',	'',	'',	1,	'2021-07-15 10:53:42',	'2021-07-15 10:53:42'),
(615,	180,	'23',	'',	'',	1,	'2021-07-15 10:53:42',	'2021-07-15 10:53:42'),
(616,	180,	'27',	'',	'',	1,	'2021-07-15 10:53:43',	'2021-07-15 10:53:43'),
(617,	180,	'28',	'',	'',	1,	'2021-07-15 10:53:45',	'2021-07-15 10:53:45'),
(618,	180,	'29',	'',	'',	1,	'2021-07-15 10:53:45',	'2021-07-15 10:53:45'),
(631,	169,	'',	'',	'3',	1,	'2021-07-15 10:56:26',	'2021-07-15 10:56:26'),
(632,	169,	'',	'',	'4',	1,	'2021-07-15 10:56:26',	'2021-07-15 10:56:26'),
(633,	169,	'',	'',	'5',	1,	'2021-07-15 10:56:27',	'2021-07-15 10:56:27'),
(634,	169,	'',	'',	'6',	1,	'2021-07-15 10:56:28',	'2021-07-15 10:56:28'),
(635,	169,	'',	'',	'7',	1,	'2021-07-15 10:56:29',	'2021-07-15 10:56:29'),
(636,	169,	'',	'',	'8',	1,	'2021-07-15 10:56:34',	'2021-07-15 10:56:34'),
(637,	169,	'1',	'',	'',	0,	'2021-07-15 10:56:38',	'2021-07-15 10:56:38'),
(649,	165,	'',	'10',	'',	1,	'2021-07-15 11:41:32',	'2021-07-15 11:41:32'),
(650,	165,	'',	'50',	'',	1,	'2021-07-15 11:41:32',	'2021-07-15 11:41:32'),
(651,	165,	'',	'15',	'',	1,	'2021-07-15 11:42:18',	'2021-07-15 11:42:18'),
(652,	165,	'',	'54',	'',	1,	'2021-07-15 11:42:18',	'2021-07-15 11:42:18'),
(655,	146,	'',	'10',	'',	1,	'2021-07-15 11:49:12',	'2021-07-15 11:49:12'),
(656,	146,	'',	'50',	'',	1,	'2021-07-15 11:49:14',	'2021-07-15 11:49:14'),
(657,	146,	'',	'15',	'',	1,	'2021-07-15 11:49:14',	'2021-07-15 11:49:14'),
(658,	146,	'',	'54',	'',	1,	'2021-07-15 11:49:15',	'2021-07-15 11:49:15'),
(659,	149,	'',	'10',	'',	1,	'2021-07-15 11:52:29',	'2021-07-15 11:52:29'),
(660,	149,	'',	'15',	'',	1,	'2021-07-15 11:52:31',	'2021-07-15 11:52:31'),
(661,	149,	'',	'50',	'',	1,	'2021-07-15 11:52:31',	'2021-07-15 11:52:31'),
(662,	149,	'',	'54',	'',	1,	'2021-07-15 11:52:31',	'2021-07-15 11:52:31'),
(664,	168,	'',	'10',	'',	1,	'2021-07-15 11:55:19',	'2021-07-15 11:55:19'),
(665,	168,	'',	'15',	'',	1,	'2021-07-15 11:55:20',	'2021-07-15 11:55:20'),
(667,	168,	'',	'54',	'',	1,	'2021-07-15 11:55:23',	'2021-07-15 11:55:23'),
(668,	181,	'1',	'',	'',	1,	'2021-07-15 12:20:24',	'2021-07-15 12:20:24'),
(669,	181,	'8',	'',	'',	1,	'2021-07-15 12:20:25',	'2021-07-15 12:20:25'),
(670,	181,	'21',	'',	'',	1,	'2021-07-15 12:20:26',	'2021-07-15 12:20:26'),
(671,	181,	'22',	'',	'',	1,	'2021-07-15 12:20:27',	'2021-07-15 12:20:27'),
(676,	156,	'1',	'',	'',	1,	'2021-07-19 11:28:20',	'2021-07-19 11:28:20'),
(677,	156,	'21',	'',	'',	1,	'2021-07-19 11:28:21',	'2021-07-19 11:28:21'),
(678,	156,	'8',	'',	'',	1,	'2021-07-19 11:28:21',	'2021-07-19 11:28:21'),
(679,	156,	'22',	'',	'',	1,	'2021-07-19 11:28:21',	'2021-07-19 11:28:21'),
(681,	157,	'1',	'',	'',	1,	'2021-07-19 11:28:56',	'2021-07-19 11:28:56'),
(682,	157,	'8',	'',	'',	1,	'2021-07-19 11:28:57',	'2021-07-19 11:28:57'),
(683,	157,	'21',	'',	'',	1,	'2021-07-19 11:28:58',	'2021-07-19 11:28:58'),
(684,	157,	'22',	'',	'',	1,	'2021-07-19 11:28:59',	'2021-07-19 11:28:59'),
(688,	158,	'',	'',	'3',	1,	'2021-07-19 12:14:44',	'2021-07-19 12:14:44'),
(689,	158,	'',	'',	'4',	1,	'2021-07-19 12:14:46',	'2021-07-19 12:14:46'),
(690,	158,	'',	'',	'5',	1,	'2021-07-19 12:14:47',	'2021-07-19 12:14:47'),
(691,	158,	'',	'',	'6',	1,	'2021-07-19 12:14:50',	'2021-07-19 12:14:50'),
(692,	158,	'',	'',	'7',	1,	'2021-07-19 12:14:51',	'2021-07-19 12:14:51'),
(693,	158,	'',	'',	'8',	1,	'2021-07-19 12:14:52',	'2021-07-19 12:14:52'),
(694,	158,	'',	'',	'9',	1,	'2021-07-19 12:14:53',	'2021-07-19 12:14:53'),
(695,	158,	'',	'',	'10',	1,	'2021-07-19 12:14:53',	'2021-07-19 12:14:53'),
(696,	158,	'',	'',	'39',	1,	'2021-07-19 12:14:55',	'2021-07-19 12:14:55'),
(697,	158,	'',	'',	'40',	1,	'2021-07-19 12:14:56',	'2021-07-19 12:14:56'),
(698,	158,	'1',	'',	'',	0,	'2021-07-19 12:14:58',	'2021-07-19 12:14:58'),
(699,	160,	'',	'10',	'',	1,	'2021-07-19 12:15:58',	'2021-07-19 12:15:58'),
(700,	160,	'',	'15',	'',	1,	'2021-07-19 12:15:59',	'2021-07-19 12:15:59'),
(701,	160,	'',	'50',	'',	1,	'2021-07-19 12:15:59',	'2021-07-19 12:15:59'),
(702,	160,	'',	'54',	'',	1,	'2021-07-19 12:16:00',	'2021-07-19 12:16:00'),
(705,	162,	'1',	'',	'',	1,	'2021-07-19 12:16:42',	'2021-07-19 12:16:42'),
(706,	162,	'8',	'',	'',	1,	'2021-07-19 12:16:43',	'2021-07-19 12:16:43'),
(707,	162,	'21',	'',	'',	1,	'2021-07-19 12:16:44',	'2021-07-19 12:16:44'),
(708,	162,	'22',	'',	'',	1,	'2021-07-19 12:16:44',	'2021-07-19 12:16:44'),
(709,	182,	'',	'',	'2',	1,	'2021-08-02 06:17:37',	'2021-08-02 06:17:37'),
(711,	182,	'',	'',	'5',	1,	'2021-08-02 06:17:38',	'2021-08-02 06:17:38'),
(712,	182,	'',	'',	'4',	1,	'2021-08-02 06:17:38',	'2021-08-02 06:17:38'),
(713,	182,	'',	'',	'6',	1,	'2021-08-02 06:17:40',	'2021-08-02 06:17:40'),
(714,	182,	'',	'',	'7',	1,	'2021-08-02 06:17:40',	'2021-08-02 06:17:40'),
(715,	182,	'',	'',	'9',	1,	'2021-08-02 06:17:41',	'2021-08-02 06:17:41'),
(716,	182,	'',	'',	'8',	1,	'2021-08-02 06:17:44',	'2021-08-02 06:17:44'),
(717,	182,	'1',	'',	'',	0,	'2021-08-02 06:17:49',	'2021-08-02 06:17:49'),
(719,	183,	'8',	'',	'',	1,	'2021-08-02 06:23:13',	'2021-08-02 06:23:13'),
(720,	183,	'21',	'',	'',	1,	'2021-08-02 06:23:14',	'2021-08-02 06:23:14'),
(722,	183,	'23',	'',	'',	1,	'2021-08-02 06:23:16',	'2021-08-02 06:23:16'),
(723,	183,	'24',	'',	'',	1,	'2021-08-02 06:23:16',	'2021-08-02 06:23:16'),
(724,	183,	'27',	'',	'',	1,	'2021-08-02 06:23:18',	'2021-08-02 06:23:18'),
(725,	21,	'',	'1',	'',	1,	'2021-08-05 04:36:49',	'2021-08-05 04:36:49'),
(726,	21,	'',	'8',	'',	1,	'2021-08-05 04:36:53',	'2021-08-05 04:36:53'),
(727,	21,	'',	'23',	'',	1,	'2021-08-05 04:36:55',	'2021-08-05 04:36:55'),
(728,	21,	'',	'24',	'',	1,	'2021-08-05 04:36:56',	'2021-08-05 04:36:56'),
(729,	21,	'',	'25',	'',	1,	'2021-08-05 04:36:57',	'2021-08-05 04:36:57'),
(731,	180,	'8',	'',	'',	1,	'2021-08-05 05:40:18',	'2021-08-05 05:40:18'),
(732,	180,	'20',	'',	'',	1,	'2021-08-05 05:40:42',	'2021-08-05 05:40:42'),
(734,	168,	'',	'14',	'',	1,	'2021-08-05 05:41:25',	'2021-08-05 05:41:25'),
(735,	168,	'',	'11',	'',	1,	'2021-08-05 05:42:14',	'2021-08-05 05:42:14'),
(741,	185,	'1',	'',	'',	1,	'2021-08-12 05:25:48',	'2021-08-12 05:25:48'),
(742,	185,	'8',	'',	'',	1,	'2021-08-12 05:25:49',	'2021-08-12 05:25:49'),
(743,	185,	'20',	'',	'',	1,	'2021-08-12 05:25:50',	'2021-08-12 05:25:50'),
(744,	185,	'21',	'',	'',	1,	'2021-08-12 05:25:51',	'2021-08-12 05:25:51'),
(745,	186,	'1',	'',	'',	1,	'2021-08-12 05:29:40',	'2021-08-12 05:29:40'),
(746,	186,	'8',	'',	'',	1,	'2021-08-12 05:29:41',	'2021-08-12 05:29:41'),
(749,	155,	'30',	'',	'',	1,	'2021-08-17 12:09:26',	'2021-08-17 12:09:26'),
(751,	155,	'29',	'',	'',	1,	'2021-08-17 12:09:27',	'2021-08-17 12:09:27'),
(752,	155,	'28',	'',	'',	1,	'2021-08-17 12:09:28',	'2021-08-17 12:09:28'),
(773,	145,	'1',	'',	'',	1,	'2021-08-17 12:15:57',	'2021-08-17 12:15:57'),
(774,	145,	'8',	'',	'',	1,	'2021-08-17 12:15:58',	'2021-08-17 12:15:58'),
(775,	145,	'21',	'',	'',	1,	'2021-08-17 12:15:58',	'2021-08-17 12:15:58'),
(776,	145,	'23',	'',	'',	1,	'2021-08-17 12:15:59',	'2021-08-17 12:15:59'),
(777,	145,	'25',	'',	'',	1,	'2021-08-17 12:15:59',	'2021-08-17 12:15:59'),
(778,	145,	'27',	'',	'',	1,	'2021-08-17 12:16:00',	'2021-08-17 12:16:00'),
(779,	145,	'28',	'',	'',	1,	'2021-08-17 12:16:01',	'2021-08-17 12:16:01'),
(781,	145,	'31',	'',	'',	1,	'2021-08-17 12:16:03',	'2021-08-17 12:16:03'),
(782,	145,	'33',	'',	'',	1,	'2021-08-17 12:16:04',	'2021-08-17 12:16:04'),
(783,	145,	'96',	'',	'',	1,	'2021-08-17 12:16:05',	'2021-08-17 12:16:05');

DROP TABLE IF EXISTS `home_contents`;
CREATE TABLE `home_contents` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `section_id` int(30) NOT NULL,
  `category` text NOT NULL,
  `sub_category` text NOT NULL,
  `product_id` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `home_design_section`;
CREATE TABLE `home_design_section` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `store_id` int(30) NOT NULL DEFAULT 0,
  `section_type` tinyint(5) NOT NULL,
  `discount_type` enum('1','2','0') NOT NULL DEFAULT '0' COMMENT '1 =flat 2 percentage 0 none',
  `discount_amount` int(30) DEFAULT NULL,
  `image` text NOT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT 1,
  `is_banner` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `home_design_section` (`id`, `name`, `store_id`, `section_type`, `discount_type`, `discount_amount`, `image`, `is_active`, `is_banner`, `created_at`, `updated_at`) VALUES
(145,	'shop by Category',	1,	1,	'2',	70,	'images/home_design/8516861629209570download (74).jpg',	1,	0,	'2021-06-29 15:26:20',	'2021-08-17 14:12:50'),
(146,	'Sub-Category',	1,	2,	'0',	NULL,	'images/home_design/1583881629209642download (81).jpg',	1,	0,	'2021-06-29 15:27:44',	'2021-08-17 14:14:02'),
(147,	'Product\'s',	1,	3,	'0',	NULL,	'images/home_design/8256351629209728download (82).jpg',	1,	0,	'2021-06-29 15:28:48',	'2021-08-17 14:15:28'),
(148,	'Categoriee\'s',	17,	1,	'0',	70,	'C:\\fakepath\\Beverages-350x326.png',	1,	1,	'2021-06-29 15:43:31',	'2021-07-17 11:44:27'),
(149,	'Sub-Categorie\'s',	17,	2,	'0',	100,	'C:\\fakepath\\118a3ceae3afc6a072891a589fc431ea.jpg',	1,	1,	'2021-06-29 15:44:13',	'2021-07-17 11:44:27'),
(150,	'Product\'s',	17,	3,	'0',	70,	'C:\\fakepath\\811G22SIHuL._SL1500_.jpg',	1,	0,	'2021-06-30 04:20:18',	'2021-07-17 11:44:27'),
(151,	'Popular Deals',	1,	1,	'0',	NULL,	'images/home_design/4506971629209828download (81).jpg',	1,	0,	'2021-06-30 04:49:07',	'2021-08-17 14:17:08'),
(153,	'Other Deals',	1,	1,	'0',	NULL,	'images/home_design/1754631629209856download (83).jpg',	1,	0,	'2021-06-30 04:58:09',	'2021-08-17 14:17:36'),
(155,	'Shop by Categories',	0,	1,	'0',	0,	'images/home_design/7357731629208824download (72).jpg',	1,	0,	'2021-06-30 05:25:01',	'2021-08-17 14:00:24'),
(156,	'Discount upto 30%',	0,	1,	'0',	0,	'images/home_design/7754321629208852images (35).jpg',	1,	0,	'2021-06-30 05:28:28',	'2021-08-17 14:00:52'),
(157,	'Populer Deals',	0,	1,	'0',	0,	'images/home_design/8648541629208877download (71).jpg',	1,	0,	'2021-06-30 06:13:23',	'2021-08-17 14:01:17'),
(158,	'Product List',	0,	3,	'',	NULL,	'images/home_design/4605131629209321download (72).jpg',	1,	0,	'2021-06-30 06:15:42',	'2021-08-17 14:08:41'),
(160,	'Sub-Categorie\'s',	0,	2,	'0',	0,	'images/home_design/5674811629209032download (71).jpg',	1,	1,	'2021-06-30 13:39:09',	'2021-08-17 14:03:52'),
(162,	'Banner',	0,	1,	'0',	0,	'images/home_design/5981561629208925download (71).jpg',	1,	1,	'2021-07-12 11:26:04',	'2021-08-17 14:02:05'),
(163,	'Banner',	1,	1,	'0',	0,	'C:\\fakepath\\button-1711966_960_720.png',	1,	1,	'2021-07-12 11:57:09',	'2021-07-17 11:51:53'),
(164,	'Categoriee',	18,	1,	'0',	0,	'C:\\fakepath\\button-1711966_960_720.png',	1,	1,	'2021-07-12 12:05:18',	'2021-07-17 11:51:53'),
(165,	'Sub-Categorie\'s',	18,	2,	'0',	0,	'C:\\fakepath\\dsfsd.jpeg',	1,	0,	'2021-07-12 12:08:44',	'2021-07-17 11:51:53'),
(166,	'Product\'s',	18,	3,	'0',	95,	'C:\\fakepath\\dsfsd.jpeg',	1,	0,	'2021-07-12 12:10:42',	'2021-07-17 11:44:27'),
(168,	'Sub-Categorie\'s',	19,	2,	'1',	90,	'C:\\fakepath\\dsfsd.jpeg',	1,	0,	'2021-07-12 12:39:45',	'2021-08-02 11:14:39'),
(169,	'Product\'s',	19,	3,	'1',	45,	'C:\\fakepath\\dsfsd.jpeg',	1,	0,	'2021-07-12 12:41:42',	'2021-08-02 13:03:37'),
(180,	'Categoriee\'s',	19,	1,	'1',	30,	'C:\\fakepath\\71+a6u-st6L._SL1000_.jpg',	1,	1,	'2021-07-15 10:52:17',	'2021-08-02 13:03:49'),
(181,	'Categoriee\'s',	21,	1,	'0',	0,	'C:\\fakepath\\773d10eaf03213bd0a17e84607e7949d_1200x1200.jpg',	1,	0,	'2021-07-15 12:19:11',	'2021-07-17 11:51:53'),
(182,	'Categoriee\'s 2',	19,	3,	'1',	35,	'C:\\fakepath\\61vYb6pqUOL._SL1025_.jpg',	1,	0,	'2021-08-02 06:06:28',	'2021-08-02 13:04:08'),
(183,	'Shop by categories',	19,	1,	'1',	30,	'C:\\fakepath\\GHEE-2T.jpg',	1,	0,	'2021-08-02 06:19:38',	'2021-08-02 13:03:06'),
(184,	'dfd',	19,	1,	'1',	25,	'C:\\fakepath\\773d10eaf03213bd0a17e84607e7949d_1200x1200.jpg',	1,	0,	'2021-08-02 06:36:49',	'2021-08-02 13:04:25');

DROP TABLE IF EXISTS `home_layouts`;
CREATE TABLE `home_layouts` (
  `layout_id` int(30) NOT NULL AUTO_INCREMENT,
  `store_id` int(30) NOT NULL DEFAULT 0,
  `app_layout_design` int(30) NOT NULL,
  `home_section_id` int(30) NOT NULL,
  `section_type` enum('1','2','3') NOT NULL COMMENT '1=Category,2=Sub-category,3=Product',
  `view_type` enum('list','grid') NOT NULL,
  `is_background` enum('0','1') DEFAULT NULL COMMENT '0=No, 1= Yes',
  `background_type` enum('picture','color') DEFAULT NULL,
  `image` text DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`layout_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `home_layouts` (`layout_id`, `store_id`, `app_layout_design`, `home_section_id`, `section_type`, `view_type`, `is_background`, `background_type`, `image`, `color`, `title`, `subtitle`, `created_at`, `updated_at`) VALUES
(30,	1,	1,	145,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 04:23:18',	'2021-06-30 04:37:56'),
(31,	1,	2,	146,	'2',	'grid',	NULL,	NULL,	'',	'#d49696',	NULL,	NULL,	'2021-06-30 04:23:49',	'2021-06-30 04:23:49'),
(32,	1,	1,	147,	'3',	'grid',	NULL,	NULL,	'',	'#daafaf',	NULL,	NULL,	'2021-06-30 04:24:32',	'2021-06-30 04:24:32'),
(33,	1,	3,	151,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 04:51:52',	'2021-06-30 04:51:52'),
(34,	1,	3,	153,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 04:58:51',	'2021-06-30 04:58:51'),
(35,	1,	1,	154,	'2',	'grid',	NULL,	NULL,	'images/layout/2021-06-30/Beverages-350x326.png',	'#f7cfcf',	NULL,	NULL,	'2021-06-30 05:21:21',	'2021-06-30 05:21:21'),
(36,	1,	1,	155,	'1',	'grid',	NULL,	NULL,	'images/layout/2021-06-30/images-(10).jfif',	'#f5b7b7',	NULL,	NULL,	'2021-06-30 05:26:51',	'2021-06-30 05:26:51'),
(37,	1,	2,	156,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 06:11:48',	'2021-06-30 06:11:48'),
(38,	1,	3,	157,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 06:14:21',	'2021-06-30 06:14:21'),
(40,	17,	2,	148,	'1',	'list',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 08:08:21',	'2021-06-30 08:08:21'),
(41,	17,	5,	149,	'2',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 08:09:02',	'2021-06-30 08:09:02'),
(42,	17,	1,	150,	'3',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 08:09:23',	'2021-08-12 08:42:30'),
(43,	1,	1,	152,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-06-30 13:30:41',	'2021-06-30 13:30:41'),
(44,	0,	2,	155,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-02 05:58:15',	'2021-07-17 10:44:22'),
(45,	0,	1,	156,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-02 05:59:19',	'2021-07-17 10:44:22'),
(46,	0,	4,	157,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-02 05:59:42',	'2021-07-17 10:44:22'),
(48,	0,	2,	160,	'2',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-02 06:00:42',	'2021-07-17 10:44:22'),
(49,	0,	1,	161,	'2',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-02 06:01:10',	'2021-07-17 10:44:22'),
(54,	0,	1,	158,	'3',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-02 06:30:38',	'2021-07-17 10:44:22'),
(55,	0,	2,	162,	'1',	'grid',	NULL,	NULL,	'images/layout/2021-07-12/button-1711966_960_720.png',	'#eed7d7',	NULL,	NULL,	'2021-07-12 11:27:40',	'2021-07-17 10:44:22'),
(56,	1,	2,	163,	'1',	'grid',	NULL,	NULL,	'images/layout/2021-07-12/button-1711966_960_720.png',	'#f2b1b1',	NULL,	NULL,	'2021-07-12 11:58:10',	'2021-07-12 11:58:10'),
(57,	18,	2,	164,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-12 12:08:20',	'2021-07-12 12:08:20'),
(58,	18,	2,	165,	'2',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-12 12:10:18',	'2021-07-12 12:10:18'),
(59,	19,	2,	168,	'2',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-12 12:41:13',	'2021-07-12 12:41:13'),
(60,	19,	1,	169,	'3',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-12 12:43:58',	'2021-08-02 06:27:04'),
(61,	0,	1,	158,	'3',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-12 15:22:06',	'2021-07-17 10:44:22'),
(67,	0,	2,	179,	'1',	'grid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-07-13 08:04:55',	'2021-07-17 10:44:22'),
(69,	18,	1,	166,	'3',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-07-13 09:03:59',	'2021-07-13 09:03:59'),
(70,	19,	2,	180,	'1',	'grid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-07-15 10:52:17',	'2021-07-15 10:52:17'),
(71,	21,	2,	181,	'1',	'grid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-07-15 12:19:11',	'2021-07-15 12:19:11'),
(72,	19,	1,	182,	'3',	'grid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-08-02 06:06:28',	'2021-08-02 06:06:28'),
(73,	19,	1,	183,	'1',	'grid',	NULL,	NULL,	'',	'#000000',	NULL,	NULL,	'2021-08-02 06:19:38',	'2021-08-02 06:27:50'),
(74,	19,	2,	184,	'1',	'grid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-08-02 06:36:49',	'2021-08-02 06:36:49');

DROP TABLE IF EXISTS `home_sections_types`;
CREATE TABLE `home_sections_types` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `home_sections_types` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1,	'Category',	0,	'2021-06-01 17:04:30',	'2021-06-26 19:06:04'),
(2,	'Sub-category',	0,	'2021-06-01 17:04:40',	'2021-06-26 19:06:26'),
(3,	'Product',	0,	'2021-06-01 17:05:18',	'2021-06-26 19:06:42');

DROP TABLE IF EXISTS `img_base_url`;
CREATE TABLE `img_base_url` (
  `url_id` int(11) NOT NULL AUTO_INCREMENT,
  `base_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `img_base_url` (`url_id`, `base_url`) VALUES
(1,	'https://groceryjachai.com/admin/');

DROP TABLE IF EXISTS `mapbox`;
CREATE TABLE `mapbox` (
  `map_id` int(11) NOT NULL AUTO_INCREMENT,
  `mapbox_api` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mapbox` (`map_id`, `mapbox_api`) VALUES
(1,	'pk.eyJ1IjoidGVjbWFuaWdvnmzk4czBqMGh2czJ4dGEyZHE2emhhcSJ9.z6sdnvklsdnclkdsmc');

DROP TABLE IF EXISTS `map_api`;
CREATE TABLE `map_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `map_api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `map_api` (`id`, `map_api_key`) VALUES
(1,	'AIzaSyBwQ4t0rwCyVmkAkpqT-5VqEQsD1KiB4_g');

DROP TABLE IF EXISTS `map_settings`;
CREATE TABLE `map_settings` (
  `map_id` int(11) NOT NULL AUTO_INCREMENT,
  `mapbox` int(11) NOT NULL,
  `google_map` int(11) NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `map_settings` (`map_id`, `mapbox`, `google_map`) VALUES
(1,	0,	1);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `minimum_maximum_order_value`;
CREATE TABLE `minimum_maximum_order_value` (
  `min_max_id` int(100) NOT NULL AUTO_INCREMENT,
  `min_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`min_max_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `minimum_maximum_order_value` (`min_max_id`, `min_value`, `max_value`) VALUES
(1,	'150',	'1000');

DROP TABLE IF EXISTS `msg91`;
CREATE TABLE `msg91` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `msg91` (`id`, `sender_id`, `api_key`, `active`) VALUES
(1,	'GOGRCK',	'197064AVztbjhjjgvdf3',	0);

DROP TABLE IF EXISTS `notificationby`;
CREATE TABLE `notificationby` (
  `noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sms` int(11) NOT NULL,
  `app` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notificationby` (`noti_id`, `user_id`, `sms`, `app`, `email`) VALUES
(24,	24,	1,	1,	1),
(25,	25,	1,	1,	1),
(29,	29,	1,	1,	1),
(31,	31,	1,	1,	1),
(32,	32,	1,	1,	1),
(34,	34,	1,	1,	1),
(35,	35,	1,	1,	1),
(38,	38,	1,	1,	1),
(39,	39,	1,	1,	1),
(40,	40,	1,	1,	1),
(41,	41,	1,	1,	1),
(42,	42,	1,	1,	1),
(43,	43,	1,	1,	1),
(44,	44,	1,	1,	1),
(45,	45,	1,	1,	1),
(46,	46,	1,	1,	1),
(47,	47,	1,	1,	1),
(48,	48,	1,	1,	1),
(49,	49,	1,	1,	1),
(62,	13,	1,	1,	1),
(67,	18,	1,	1,	1);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_id` int(11) NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_without_delivery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_products_mrp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_by_wallet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `rem_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tax` int(11) NOT NULL DEFAULT 0,
  `delivery_charge_km` int(11) NOT NULL DEFAULT 0,
  `delivery_distance` int(11) NOT NULL DEFAULT 0,
  `delivery_date` date DEFAULT NULL,
  `dboy_assigned` date DEFAULT NULL,
  `dboy_request_at` date DEFAULT NULL,
  `delivery_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `time_slot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeslot_delivery_date` date DEFAULT NULL,
  `dboy_id` int(11) NOT NULL DEFAULT 0,
  `pay_by_dboy` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5',
  `user_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelling_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT 0,
  `coupon_discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by_store` int(11) NOT NULL DEFAULT 0,
  `total_items` int(4) DEFAULT NULL,
  `razorpay_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`order_id`, `user_id`, `store_id`, `address_id`, `cart_id`, `total_price`, `price_without_delivery`, `total_products_mrp`, `payment_method`, `paid_by_wallet`, `rem_price`, `tax`, `delivery_charge_km`, `delivery_distance`, `delivery_date`, `dboy_assigned`, `dboy_request_at`, `delivery_charge`, `time_slot`, `timeslot_delivery_date`, `dboy_id`, `pay_by_dboy`, `order_status`, `user_signature`, `cancelling_reason`, `coupon_id`, `coupon_discount`, `discount_amount`, `payment_status`, `cancel_by_store`, `total_items`, `razorpay_order_id`, `razorpay_signature`, `updated_at`, `order_date`) VALUES
(161,	18,	'19',	24,	'61123a7851a92',	'300.76',	'205',	'230',	'1',	'0',	'0',	0,	0,	0,	NULL,	'2021-09-01',	NULL,	'95.76',	'28',	'2021-08-10',	2,	'0',	'3',	NULL,	NULL,	0,	'0',	'25',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-10 14:06:08'),
(162,	18,	'19',	24,	'61123d17cdcf1',	'300.76',	'205',	'230',	'1',	'0',	'0',	0,	0,	0,	NULL,	NULL,	NULL,	'95.76',	'28',	'2021-08-10',	0,	'0',	'0',	NULL,	NULL,	0,	'0',	'25',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-10 14:17:19'),
(163,	34,	'1',	34,	'6112699e7f2e3',	'235.23',	'228',	'250',	'1',	'0',	'0',	0,	0,	0,	NULL,	NULL,	NULL,	'7.23',	'127',	'2021-08-10',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'22',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-10 17:27:18'),
(164,	28,	'0',	29,	'6113d89e0c27d',	'2020',	'2020',	'2150',	'1',	'0',	'0',	0,	0,	0,	NULL,	NULL,	NULL,	'0.0',	'95',	'2021-08-14',	0,	'0',	'2',	NULL,	NULL,	0,	'0',	'130',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-11 19:33:10'),
(165,	18,	'17',	38,	'61152651ee075',	'555',	'555',	'745',	'1',	'0',	'0',	0,	0,	0,	NULL,	NULL,	NULL,	'0.0',	'153',	'2021-08-13',	0,	'0',	'0',	NULL,	NULL,	0,	'0',	'190',	'1',	0,	5,	NULL,	NULL,	NULL,	'2021-08-12 19:16:57'),
(166,	18,	'17',	38,	'6115f4d292934',	'338.51',	'140',	'160',	'1',	'0',	'0',	0,	0,	0,	'2021-08-13',	'2021-08-13',	NULL,	'198.51',	'153',	'2021-08-13',	4,	'0',	'4',	NULL,	NULL,	0,	'0',	'20',	'2',	0,	1,	NULL,	NULL,	NULL,	'2021-08-13 09:58:02'),
(167,	18,	'1',	38,	'611b5c59d152b',	'175.84',	'96',	'100',	'2',	'0',	'0',	0,	0,	0,	NULL,	NULL,	NULL,	'79.84',	'114',	'2021-08-17',	0,	'0',	'5',	NULL,	NULL,	0,	'0',	'4',	'3',	0,	2,	'order_HmAklm7Db7wZ1G',	NULL,	NULL,	'2021-08-17 12:21:05'),
(172,	19,	'1',	23,	'611cace77e450',	'120',	'120',	'120',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-08-18',	0,	'0',	'0',	NULL,	NULL,	0,	'0',	'0',	'2',	0,	1,	'order_HmZDd97eqGfbeh',	NULL,	NULL,	'2021-08-18 12:17:03'),
(173,	18,	'1',	38,	'611ce8cc310fc',	'202',	'202',	'260',	'1',	'0',	'0',	0,	1,	80,	'2021-08-24',	'2021-08-24',	NULL,	'79.84',	'119',	'2021-08-19',	4,	'0',	'4',	NULL,	NULL,	0,	'0',	'58',	'2',	0,	3,	NULL,	NULL,	NULL,	'2021-08-18 16:32:36'),
(174,	38,	'1',	45,	'611e464634384',	'20',	'20',	'20',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'121',	'2021-08-20',	0,	'0',	'0',	NULL,	'NOT INTERESTED',	0,	'0',	'0',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-19 17:23:42'),
(175,	38,	'1',	45,	'611e471eb2cfd',	'8',	'8',	'10',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'125',	'2021-08-21',	0,	'0',	'2',	NULL,	NULL,	0,	'0',	'2',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-19 17:27:18'),
(176,	38,	'1',	45,	'611f372a4a3a7',	'70',	'70',	'120',	'1',	'0',	'0',	0,	1,	7,	NULL,	'2021-08-25',	NULL,	'7.23',	'123',	'2021-08-20',	4,	'0',	'3',	NULL,	NULL,	0,	'0',	'50',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-20 10:31:30'),
(177,	38,	'1',	45,	'6126128bee51a',	'20',	'20',	'20',	'1',	'0',	'0',	0,	1,	7,	'2021-08-25',	'2021-08-25',	NULL,	'7.23',	'118',	'2021-08-26',	4,	'0',	'4',	NULL,	NULL,	0,	'0',	'0',	'2',	0,	1,	NULL,	NULL,	NULL,	'2021-08-25 15:21:07'),
(178,	19,	'1',	23,	'61274ec13a156',	'450',	'450',	'500',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'121',	'2021-08-27',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'50',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-26 13:50:17'),
(179,	19,	'1',	23,	'61274eeaa40bc',	'450',	'450',	'500',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'124',	'2021-08-28',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'50',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-26 13:50:58'),
(184,	19,	'1',	23,	'612751e5095eb',	'450',	'450',	'500',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'124',	'2021-08-28',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'50',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-26 14:03:41'),
(185,	18,	'1',	24,	'612758207a6e0',	'28',	'28',	'30',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'121',	'2021-08-27',	0,	'0',	'5',	NULL,	NULL,	0,	'0',	'2',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-26 14:30:16'),
(186,	18,	'1',	24,	'61275e8356071',	'87',	'87',	'100',	'1',	'0',	'0',	0,	1,	7,	'2021-08-26',	'2021-08-26',	NULL,	'7.23',	'123',	'2021-08-27',	4,	'0',	'4',	NULL,	NULL,	0,	'0',	'13',	'2',	0,	2,	NULL,	NULL,	NULL,	'2021-08-26 14:57:31'),
(187,	18,	'1',	24,	'61276724728a4',	'82',	'82',	'100',	'1',	'0',	'0',	0,	1,	7,	NULL,	'2021-08-26',	NULL,	'7.23',	'122',	'2021-08-27',	4,	'0',	'3',	NULL,	NULL,	0,	'0',	'18',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-26 15:34:20'),
(188,	19,	'19',	23,	'6127737a24f75',	'40',	'40',	'40',	'1',	'0',	'0',	0,	1,	124,	NULL,	NULL,	NULL,	'123.59',	'37',	'2021-08-27',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'0',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-26 16:26:58'),
(189,	19,	'19',	23,	'612773c0d8b78',	'40',	'40',	'40',	'1',	'0',	'0',	0,	1,	124,	NULL,	NULL,	NULL,	'123.59',	'39',	'2021-08-27',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'0',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-26 16:28:08'),
(190,	38,	'1',	46,	'61288668dc771',	'1200',	'1200',	'1270',	'1',	'0',	'0',	0,	0,	7,	NULL,	'2021-08-27',	NULL,	'0',	'122',	'2021-08-27',	2,	'0',	'3',	NULL,	NULL,	0,	'0',	'70',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-27 12:00:00'),
(191,	38,	'1',	46,	'6128867ab6ca1',	'1200',	'1200',	'1270',	'1',	'0',	'0',	0,	0,	7,	'2021-08-27',	'2021-08-27',	NULL,	'0',	'123',	'2021-08-27',	2,	'0',	'4',	NULL,	NULL,	0,	'0',	'70',	'2',	0,	1,	NULL,	NULL,	NULL,	'2021-08-27 12:00:18'),
(192,	38,	'1',	46,	'6128876fd8b2e',	'1200',	'1200',	'1270',	'1',	'0',	'0',	0,	0,	7,	NULL,	NULL,	NULL,	'0',	'123',	'2021-08-27',	0,	'0',	'0',	NULL,	NULL,	0,	'0',	'70',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-27 12:04:23'),
(193,	18,	'1',	24,	'61288b493d56d',	'10',	'10',	'12',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'123',	'2021-08-27',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'2',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-27 12:20:49'),
(194,	18,	'1',	24,	'61288e1eeb7ba',	'82',	'82',	'100',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'124',	'2021-08-28',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'18',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-27 12:32:54'),
(195,	18,	'1',	24,	'61288e437bf63',	'82',	'82',	'100',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'123',	'2021-08-27',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'18',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-27 12:33:31'),
(196,	18,	'1',	24,	'61288eee2dd39',	'82',	'82',	'100',	'1',	'0',	'0',	0,	1,	7,	NULL,	'2021-08-31',	NULL,	'7.23',	'123',	'2021-08-27',	2,	'0',	'3',	NULL,	NULL,	0,	'0',	'18',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-27 12:36:22'),
(197,	18,	'1',	24,	'61288fe1066a4',	'82',	'82',	'100',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'123',	'2021-08-27',	0,	'0',	'0',	NULL,	'NOT INTERESTED',	0,	'0',	'18',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-27 12:40:25'),
(198,	18,	'1',	24,	'6128b90ea33ab',	'460',	'460',	'512',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'124',	'2021-08-28',	0,	'0',	'2',	NULL,	NULL,	0,	'0',	'52',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-27 15:36:06'),
(199,	18,	'1',	24,	'6128b935528c4',	'396',	'396',	'470',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.23',	'124',	'2021-08-28',	0,	'0',	'0',	NULL,	'NOT INTERESTED',	0,	'0',	'74',	'1',	0,	3,	NULL,	NULL,	NULL,	'2021-08-27 15:36:45'),
(201,	18,	'1',	12,	'612e0c47c59d2',	'87',	'87',	'100',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'118',	'2021-09-02',	0,	'0',	'5',	NULL,	NULL,	0,	'0',	'13',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-08-31 16:32:31'),
(202,	18,	'1',	12,	'612e0c90a376c',	'217',	'217',	'250',	'1',	'0',	'0',	0,	1,	130,	NULL,	'2021-08-31',	NULL,	'129.8',	'127',	'2021-08-31',	2,	'0',	'3',	NULL,	NULL,	0,	'0',	'33',	'1',	0,	3,	NULL,	NULL,	NULL,	'2021-08-31 16:33:44'),
(203,	18,	'19',	12,	'612e0e09b7329',	'200',	'200',	'200',	'1',	'0',	'0',	0,	1,	123,	NULL,	'2021-09-01',	NULL,	'123.46',	'31',	'2021-09-01',	2,	'0',	'3',	NULL,	NULL,	0,	'0',	'0',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-31 16:40:01'),
(204,	18,	'19',	12,	'612e0eb66e15b',	'240',	'240',	'270',	'1',	'0',	'0',	0,	1,	123,	NULL,	NULL,	NULL,	'123.46',	'69',	'2021-08-31',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'30',	'1',	0,	3,	NULL,	NULL,	NULL,	'2021-08-31 16:42:54'),
(205,	19,	'1',	23,	'612e1c81bdf5c',	'180',	'180',	'200',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'116',	'2021-09-01',	0,	'0',	'5',	NULL,	NULL,	0,	'0',	'20',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-31 17:41:45'),
(206,	18,	'1',	12,	'612e1cd91f341',	'135',	'135',	'150',	'1',	'0',	'0',	0,	1,	130,	NULL,	'2021-09-01',	NULL,	'129.8',	'127',	'2021-08-31',	2,	'0',	'3',	NULL,	NULL,	0,	'0',	'15',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-08-31 17:43:13'),
(207,	18,	'1',	12,	'612f03ec15696',	'369',	'369',	'420',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'51',	'1',	0,	5,	NULL,	NULL,	NULL,	'2021-09-01 10:09:08'),
(208,	18,	'1',	12,	'612f04fd0639c',	'42',	'42',	'50',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'8',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-01 10:13:41'),
(209,	18,	'1',	12,	'612f059681543',	'75',	'75',	'85',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'10',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-01 10:16:14'),
(210,	18,	'1',	12,	'612f0769f31a9',	'82',	'82',	'100',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'18',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-09-01 10:24:01'),
(211,	18,	'1',	12,	'612f0c95b0d14',	'75',	'75',	'85',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'10',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-01 10:46:05'),
(212,	18,	'1',	12,	'612f0d4da8ecf',	'75',	'75',	'85',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'10',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-01 10:49:09'),
(213,	19,	'1',	23,	'612f0eab80b5c',	'472',	'472',	'550',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'78',	'1',	0,	3,	NULL,	NULL,	NULL,	'2021-09-01 10:54:59'),
(214,	19,	'1',	23,	'612f0fc59a8e9',	'306',	'306',	'330',	'1',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'24',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-01 10:59:41'),
(215,	19,	'1',	23,	'612f11578015c',	'396',	'396',	'470',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'74',	'2',	0,	3,	'order_Hs5UfF9Fpp12Hb',	NULL,	NULL,	'2021-09-01 11:06:23'),
(216,	19,	'1',	23,	'612f118734f8c',	'0',	'0',	'0',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'0',	'2',	0,	0,	NULL,	NULL,	NULL,	'2021-09-01 11:07:11'),
(217,	19,	'1',	23,	'612f12532a501',	'3600',	'3600',	'3810',	'1',	'0',	'0',	0,	0,	130,	NULL,	NULL,	NULL,	'0',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'210',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-01 11:10:35'),
(218,	19,	'1',	23,	'612f127909067',	'10',	'10',	'12',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'2',	'2',	0,	1,	'order_Hs5ZkPQmm3KDig',	NULL,	NULL,	'2021-09-01 11:11:13'),
(219,	19,	'1',	23,	'612f127d2c3df',	'10',	'10',	'12',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'2',	'2',	0,	1,	'order_Hs5Zp9iie15kkT',	NULL,	NULL,	'2021-09-01 11:11:17'),
(220,	19,	'1',	23,	'612f12bb3ee6e',	'2400',	'2400',	'2540',	'2',	'0',	'0',	0,	0,	130,	NULL,	NULL,	NULL,	'0',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'140',	'2',	0,	1,	'order_Hs5auzZMrgF8F6',	NULL,	NULL,	'2021-09-01 11:12:19'),
(221,	19,	'1',	23,	'612f12d0edf9c',	'0',	'0',	'0',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'0',	'2',	0,	0,	NULL,	NULL,	NULL,	'2021-09-01 11:12:40'),
(222,	19,	'1',	23,	'612f12f14e757',	'75',	'75',	'85',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.87',	'117',	'2021-09-01',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'10',	'2',	0,	1,	'order_Hs5brvZGYVdKdn',	NULL,	NULL,	'2021-09-01 11:13:13'),
(223,	19,	'1',	23,	'612f136aba56c',	'75',	'75',	'85',	'1',	'0',	'0',	0,	1,	130,	NULL,	'2021-09-01',	NULL,	'129.87',	'117',	'2021-09-01',	2,	'0',	'3',	NULL,	NULL,	0,	'0',	'10',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-01 11:15:14'),
(224,	38,	'1',	46,	'612f5c5662df1',	'135',	'135',	'160',	'1',	'0',	'0',	0,	1,	7,	NULL,	NULL,	NULL,	'7.05',	'118',	'2021-09-02',	0,	'0',	'5',	NULL,	NULL,	0,	'0',	'25',	'1',	0,	2,	NULL,	NULL,	NULL,	'2021-09-01 16:26:22'),
(225,	18,	'1',	12,	'612f5ee4d3357',	'40',	'40',	'50',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'118',	'2021-09-02',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'10',	'2',	0,	1,	'order_HsB8BL0Z7P0tiv',	NULL,	NULL,	'2021-09-01 16:37:16'),
(226,	18,	'1',	12,	'612f5efb23e04',	'40',	'40',	'50',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'118',	'2021-09-02',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'10',	'2',	0,	1,	'order_HsB8Zzm47RxGzo',	NULL,	NULL,	'2021-09-01 16:37:39'),
(227,	18,	'1',	12,	'612f5f0705776',	'40',	'40',	'50',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'118',	'2021-09-02',	0,	'0',	'1',	NULL,	NULL,	0,	'0',	'10',	'2',	0,	1,	'order_HsB8mZhCNXArS4',	NULL,	NULL,	'2021-09-01 16:37:51'),
(228,	18,	'1',	12,	'612f5fd32046c',	'40',	'40',	'50',	'2',	'0',	'0',	0,	1,	130,	NULL,	NULL,	NULL,	'129.8',	'118',	'2021-09-02',	0,	'0',	'2',	NULL,	NULL,	0,	'0',	'10',	'2',	0,	1,	'order_HsBCNbBnlYB8ks',	NULL,	NULL,	'2021-09-01 16:41:15'),
(229,	38,	'1',	46,	'6131b50e42e00',	'125',	'125',	'150',	'1',	'0',	'0',	0,	1,	7,	NULL,	'2021-09-03',	NULL,	'7.05',	'122',	'2021-09-03',	4,	'0',	'3',	NULL,	NULL,	0,	'0',	'25',	'1',	0,	1,	NULL,	NULL,	NULL,	'2021-09-03 11:09:26');

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `varient_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `store_id` int(30) NOT NULL,
  `total_discount` int(30) DEFAULT NULL,
  `store_discount_type` varchar(30) NOT NULL DEFAULT '0',
  `price` int(30) NOT NULL,
  `final_price` int(30) NOT NULL,
  `product_name` varchar(240) NOT NULL,
  `product_description` text DEFAULT NULL,
  `quantity` int(30) NOT NULL,
  `unit` enum('kg','gm','pc','L','ml','plts','units') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `varient_id`, `user_id`, `store_id`, `total_discount`, `store_discount_type`, `price`, `final_price`, `product_name`, `product_description`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES
(283,	162,	9,	9,	18,	19,	15,	'0',	150,	135,	'Banana',	'Banana',	1,	'kg',	'2021-08-10 08:47:19',	'2021-08-10 08:47:19'),
(284,	162,	10,	10,	18,	19,	10,	'0',	80,	70,	'Grapes',	'Grapes',	1,	'kg',	'2021-08-10 08:47:19',	'2021-08-10 08:47:19'),
(285,	163,	7,	7,	34,	1,	12,	'0',	150,	138,	'Apple',	'Apple',	1,	'kg',	'2021-08-10 11:57:18',	'2021-08-10 11:57:18'),
(286,	163,	8,	8,	34,	1,	10,	'0',	100,	90,	'Plum',	'Plum',	1,	'kg',	'2021-08-10 11:57:18',	'2021-08-10 11:57:18'),
(287,	164,	4,	4,	28,	0,	10,	'0',	50,	40,	'Potato',	'Potato',	3,	'kg',	'2021-08-11 14:03:10',	'2021-08-11 14:03:10'),
(288,	165,	46,	42,	18,	17,	30,	'0',	100,	70,	'atta',	'dddasdsd',	3,	'kg',	'2021-08-12 13:46:57',	'2021-08-12 13:46:57'),
(289,	165,	4,	4,	18,	17,	20,	'0',	50,	30,	'Potato',	'Potato',	3,	'kg',	'2021-08-12 13:46:57',	'2021-08-12 13:46:57'),
(290,	165,	21,	21,	18,	17,	20,	'0',	190,	170,	'Chicken Biryani family pack',	'Chicken Biryani family pack',	1,	'plts',	'2021-08-12 13:46:57',	'2021-08-17 10:30:24'),
(291,	165,	12,	12,	18,	17,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	1,	'kg',	'2021-08-12 13:46:58',	'2021-08-12 13:46:58'),
(292,	165,	43,	39,	18,	17,	20,	'0',	65,	45,	'vegi',	'hgfhfg',	1,	'kg',	'2021-08-12 13:46:58',	'2021-08-12 13:46:58'),
(293,	166,	12,	12,	18,	17,	5,	'0',	40,	35,	'Sweet lime',	'Sweet lime',	4,	'kg',	'2021-08-13 04:28:02',	'2021-08-13 04:28:02'),
(294,	167,	19,	19,	18,	1,	2,	'0',	10,	8,	'Samosa',	'Samosa',	2,	'plts',	'2021-08-17 06:51:05',	'2021-08-17 10:30:24'),
(295,	167,	12,	12,	18,	1,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	2,	'kg',	'2021-08-17 06:51:05',	'2021-08-17 06:51:05'),
(296,	168,	12,	12,	19,	1,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	2,	'kg',	'2021-08-18 06:03:43',	'2021-08-18 06:03:43'),
(297,	169,	12,	12,	19,	1,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	2,	'kg',	'2021-08-18 06:14:58',	'2021-08-18 06:14:58'),
(298,	170,	12,	12,	19,	1,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	1,	'kg',	'2021-08-18 06:16:45',	'2021-08-18 06:16:45'),
(299,	171,	12,	12,	19,	1,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	1,	'kg',	'2021-08-18 06:40:04',	'2021-08-18 06:40:04'),
(300,	172,	12,	12,	19,	1,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	3,	'kg',	'2021-08-18 06:47:03',	'2021-08-18 06:47:03'),
(301,	173,	18,	18,	18,	1,	0,	'0',	20,	20,	'Curry Puff',	'Curry Puff',	5,	'pc',	'2021-08-18 11:02:36',	'2021-08-18 11:02:36'),
(302,	173,	19,	19,	18,	1,	2,	'0',	10,	8,	'Samosa',	'Samosa',	4,	'pc',	'2021-08-18 11:02:36',	'2021-08-18 11:02:36'),
(303,	173,	20,	20,	18,	1,	50,	'0',	120,	70,	'Chicken Biryani',	'Chicken Biryani',	1,	'plts',	'2021-08-18 11:02:36',	'2021-08-18 11:02:36'),
(304,	174,	18,	18,	38,	1,	0,	'0',	20,	20,	'Curry Puff',	'Curry Puff',	1,	'pc',	'2021-08-19 11:53:42',	'2021-08-19 11:53:42'),
(305,	175,	19,	19,	38,	1,	2,	'0',	10,	8,	'Samosa',	'Samosa',	1,	'pc',	'2021-08-19 11:57:18',	'2021-08-19 11:57:18'),
(306,	176,	20,	20,	38,	1,	50,	'0',	120,	70,	'Chicken Biryani',	'Chicken Biryani',	1,	'plts',	'2021-08-20 05:01:30',	'2021-08-20 05:01:30'),
(307,	177,	18,	18,	38,	1,	0,	'0',	20,	20,	'Curry Puff',	'Curry Puff',	1,	'pc',	'2021-08-25 09:51:07',	'2021-08-25 09:51:07'),
(309,	184,	48,	44,	19,	1,	50,	'2',	500,	450,	'flowers',	NULL,	1,	'kg',	'2021-08-26 08:33:41',	'2021-08-26 08:33:41'),
(310,	185,	18,	18,	18,	1,	0,	'2',	20,	20,	'Curry Puff',	'Curry Puff',	1,	'pc',	'2021-08-26 09:00:16',	'2021-08-26 09:00:16'),
(311,	185,	19,	19,	18,	1,	2,	'1',	10,	8,	'Samosa',	'Samosa',	1,	'pc',	'2021-08-26 09:00:16',	'2021-08-26 09:00:16'),
(312,	186,	2,	2,	18,	1,	5,	'1',	50,	45,	'Lady finger',	'Lady finger',	1,	'kg',	'2021-08-26 09:27:31',	'2021-08-26 09:27:31'),
(313,	186,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-08-26 09:27:31',	'2021-08-26 09:27:31'),
(314,	187,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-08-26 10:04:20',	'2021-08-26 10:04:20'),
(315,	187,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-08-26 10:04:20',	'2021-08-26 10:04:20'),
(316,	188,	12,	12,	19,	19,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	1,	'kg',	'2021-08-26 10:56:58',	'2021-08-26 10:56:58'),
(317,	189,	12,	12,	19,	19,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	1,	'kg',	'2021-08-26 10:58:08',	'2021-08-26 10:58:08'),
(318,	197,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-08-27 07:10:25',	'2021-08-27 07:10:25'),
(319,	197,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-08-27 07:10:25',	'2021-08-27 07:10:25'),
(320,	198,	51,	46,	18,	1,	2,	'1',	12,	10,	'shmpoo',	'shmpoo',	1,	'units',	'2021-08-27 10:06:06',	'2021-08-27 10:06:06'),
(321,	198,	48,	44,	18,	1,	50,	'2',	500,	450,	'flowers',	NULL,	1,	'kg',	'2021-08-27 10:06:06',	'2021-08-27 10:06:06'),
(322,	199,	18,	18,	18,	1,	0,	'2',	20,	20,	'Curry Puff',	'Curry Puff',	1,	'pc',	'2021-08-27 10:06:45',	'2021-08-27 10:06:45'),
(323,	199,	20,	20,	18,	1,	50,	'1',	120,	70,	'Chicken Biryani',	'Chicken Biryani',	1,	'plts',	'2021-08-27 10:06:45',	'2021-08-27 10:06:45'),
(324,	199,	33,	32,	18,	1,	24,	'1',	330,	306,	'chakki atta',	'chakki atta',	1,	'kg',	'2021-08-27 10:06:45',	'2021-08-27 10:06:45'),
(326,	201,	2,	2,	18,	1,	5,	'1',	50,	45,	'Lady finger',	'Lady finger',	1,	'kg',	'2021-08-31 11:02:31',	'2021-08-31 11:02:31'),
(327,	201,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-08-31 11:02:31',	'2021-08-31 11:02:31'),
(328,	202,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-08-31 11:03:44',	'2021-08-31 11:03:44'),
(329,	202,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-08-31 11:03:44',	'2021-08-31 11:03:44'),
(330,	202,	5,	5,	18,	1,	15,	'1',	150,	135,	'Tomato',	'Tomato',	1,	'kg',	'2021-08-31 11:03:44',	'2021-08-31 11:03:44'),
(331,	203,	12,	12,	18,	19,	0,	'0',	40,	40,	'Sweet lime',	'Sweet lime',	5,	'kg',	'2021-08-31 11:10:01',	'2021-08-31 11:10:01'),
(332,	204,	4,	4,	18,	19,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-08-31 11:12:54',	'2021-08-31 11:12:54'),
(333,	204,	5,	5,	18,	19,	15,	'1',	150,	135,	'Tomato',	'Tomato',	1,	'kg',	'2021-08-31 11:12:54',	'2021-08-31 11:12:54'),
(334,	204,	6,	6,	18,	19,	5,	'2',	70,	65,	'Onion',	'Onion',	1,	'kg',	'2021-08-31 11:12:54',	'2021-08-31 11:12:54'),
(335,	205,	2,	2,	19,	1,	5,	'1',	50,	45,	'Lady finger',	'Lady finger',	4,	'kg',	'2021-08-31 12:11:45',	'2021-08-31 12:11:45'),
(336,	206,	2,	2,	18,	1,	5,	'1',	50,	45,	'Lady finger',	'Lady finger',	3,	'kg',	'2021-08-31 12:13:13',	'2021-08-31 12:13:13'),
(337,	207,	2,	2,	18,	1,	5,	'1',	50,	45,	'Lady finger',	'Lady finger',	1,	'kg',	'2021-09-01 04:39:08',	'2021-09-01 04:39:08'),
(338,	207,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	2,	'kg',	'2021-09-01 04:39:08',	'2021-09-01 04:39:08'),
(339,	207,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-09-01 04:39:08',	'2021-09-01 04:39:08'),
(340,	207,	5,	5,	18,	1,	15,	'1',	150,	135,	'Tomato',	'Tomato',	1,	'kg',	'2021-09-01 04:39:08',	'2021-09-01 04:39:08'),
(341,	207,	6,	6,	18,	1,	5,	'2',	70,	65,	'Onion',	'Onion',	1,	'kg',	'2021-09-01 04:39:08',	'2021-09-01 04:39:08'),
(342,	208,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-09-01 04:43:41',	'2021-09-01 04:43:41'),
(343,	209,	44,	40,	18,	1,	10,	'2',	85,	75,	'vegiii',	'xxvxxfd',	1,	'kg',	'2021-09-01 04:46:14',	'2021-09-01 04:46:14'),
(344,	210,	3,	3,	18,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-09-01 04:54:02',	'2021-09-01 04:54:02'),
(345,	210,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-09-01 04:54:02',	'2021-09-01 04:54:02'),
(346,	211,	44,	40,	18,	1,	10,	'2',	85,	75,	'vegiii',	'xxvxxfd',	1,	'kg',	'2021-09-01 05:16:05',	'2021-09-01 05:16:05'),
(347,	212,	44,	40,	18,	1,	10,	'2',	85,	75,	'vegiii',	'xxvxxfd',	1,	'kg',	'2021-09-01 05:19:09',	'2021-09-01 05:19:09'),
(348,	213,	3,	3,	19,	1,	8,	'2',	50,	42,	'Brinjal Green',	'Brinjal Green',	1,	'kg',	'2021-09-01 05:24:59',	'2021-09-01 05:24:59'),
(349,	213,	4,	4,	19,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	4,	'kg',	'2021-09-01 05:24:59',	'2021-09-01 05:24:59'),
(350,	213,	5,	5,	19,	1,	15,	'1',	150,	135,	'Tomato',	'Tomato',	2,	'kg',	'2021-09-01 05:24:59',	'2021-09-01 05:24:59'),
(351,	214,	33,	32,	19,	1,	24,	'1',	330,	306,	'chakki atta',	'chakki atta',	1,	'kg',	'2021-09-01 05:29:41',	'2021-09-01 05:29:41'),
(352,	215,	18,	18,	19,	1,	0,	'2',	20,	20,	'Curry Puff',	'Curry Puff',	1,	'pc',	'2021-09-01 05:36:23',	'2021-09-01 05:36:23'),
(353,	215,	20,	20,	19,	1,	50,	'1',	120,	70,	'Chicken Biryani',	'Chicken Biryani',	1,	'plts',	'2021-09-01 05:36:23',	'2021-09-01 05:36:23'),
(354,	215,	33,	32,	19,	1,	24,	'1',	330,	306,	'chakki atta',	'chakki atta',	1,	'kg',	'2021-09-01 05:36:23',	'2021-09-01 05:36:23'),
(355,	217,	38,	36,	19,	1,	70,	'2',	1270,	1200,	'oil',	NULL,	3,	'kg',	'2021-09-01 05:40:35',	'2021-09-01 05:40:35'),
(356,	218,	51,	46,	19,	1,	2,	'1',	12,	10,	'shmpoo',	'shmpoo',	1,	'units',	'2021-09-01 05:41:13',	'2021-09-01 05:41:13'),
(357,	219,	51,	46,	19,	1,	2,	'1',	12,	10,	'shmpoo',	'shmpoo',	1,	'units',	'2021-09-01 05:41:17',	'2021-09-01 05:41:17'),
(358,	220,	38,	36,	19,	1,	70,	'2',	1270,	1200,	'oil',	NULL,	2,	'kg',	'2021-09-01 05:42:19',	'2021-09-01 05:42:19'),
(359,	222,	44,	40,	19,	1,	10,	'2',	85,	75,	'vegiii',	'xxvxxfd',	1,	'kg',	'2021-09-01 05:43:13',	'2021-09-01 05:43:13'),
(360,	223,	44,	40,	19,	1,	10,	'2',	85,	75,	'vegiii',	'xxvxxfd',	1,	'kg',	'2021-09-01 05:45:14',	'2021-09-01 05:45:14'),
(361,	224,	32,	31,	38,	1,	10,	'1',	100,	90,	'dfd',	'sdfsds',	1,	'kg',	'2021-09-01 10:56:22',	'2021-09-01 10:56:22'),
(362,	224,	49,	45,	38,	1,	15,	'2',	60,	45,	'milke',	'milke',	1,	'L',	'2021-09-01 10:56:22',	'2021-09-01 10:56:22'),
(363,	225,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-09-01 11:07:16',	'2021-09-01 11:07:16'),
(364,	226,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-09-01 11:07:39',	'2021-09-01 11:07:39'),
(365,	227,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-09-01 11:07:51',	'2021-09-01 11:07:51'),
(366,	228,	4,	4,	18,	1,	10,	'1',	50,	40,	'Potato',	'Potato',	1,	'kg',	'2021-09-01 11:11:15',	'2021-09-01 11:11:15'),
(367,	229,	15,	15,	38,	1,	25,	'1',	150,	125,	'DryFruit Halwa',	'DryFruit Halwa',	1,	'kg',	'2021-09-03 05:39:26',	'2021-09-03 05:39:26');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payment_via`;
CREATE TABLE `payment_via` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `paypal` int(11) NOT NULL,
  `razorpay` int(11) NOT NULL,
  `paystack` int(11) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payment_via` (`p_id`, `paypal`, `razorpay`, `paystack`) VALUES
(1,	0,	1,	0);

DROP TABLE IF EXISTS `payout_requests`;
CREATE TABLE `payout_requests` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payout_amt` float NOT NULL,
  `req_date` date NOT NULL,
  `complete` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payout_req_valid`;
CREATE TABLE `payout_req_valid` (
  `val_id` int(11) NOT NULL AUTO_INCREMENT,
  `min_amt` int(11) NOT NULL,
  `min_days` int(11) NOT NULL,
  PRIMARY KEY (`val_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payout_req_valid` (`val_id`, `min_amt`, `min_days`) VALUES
(1,	10,	10);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_cat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hide` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product` (`product_id`, `parent_cat_id`, `cat_id`, `product_name`, `product_image`, `hide`) VALUES
(2,	1,	15,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	0),
(3,	1,	15,	'Brinjal Green',	'images/product/06-05-2021/bringal.jpg',	0),
(4,	1,	15,	'Potato',	'images/product/06-05-2021/patato_.jpg',	0),
(5,	1,	15,	'Tomato',	'images/product/06-05-2021/tomato.jpg',	0),
(6,	1,	15,	'Onion',	'images/product/06-05-2021/onion.jpg',	0),
(7,	1,	0,	'Apple',	'images/product/06-05-2021/apples.jpg',	0),
(8,	1,	0,	'Plum',	'images/product/06-05-2021/plum.jpg',	0),
(9,	1,	0,	'Banana',	'images/product/06-05-2021/fruts.jpg',	0),
(10,	1,	0,	'Grapes',	'images/product/06-05-2021/grapes.jpg',	0),
(11,	1,	0,	'Pomegranate',	'images/product/06-05-2021/pomegranate_PNG8653.jpg',	0),
(12,	1,	14,	'Sweet lime',	'images/product/06-05-2021/sweet-lime.jpg',	0),
(13,	96,	97,	'Ghee Pack',	'images/product/12-08-2021/40009511_9-patanjali-cow-ghee.jpg',	0),
(14,	27,	70,	'Amul Butter',	'images/product/12-08-2021/1204991_1-amul-butter-pasteurized.jpg',	0),
(15,	27,	72,	'DryFruit Halwa',	'images/product/06-05-2021/dry-fruit-halwa.jpg',	0),
(16,	31,	84,	'DryFruit Laddu',	'images/product/06-05-2021/dryfruit-ladoo.jpeg',	0),
(17,	23,	60,	'Egg puff',	'images/product/06-05-2021/egg.jpg',	0),
(18,	33,	89,	'Curry Puff',	'images/product/06-05-2021/curry-puf.jpg',	0),
(19,	30,	83,	'Samosa',	'images/product/06-05-2021/samosa.png',	0),
(20,	33,	89,	'Chicken Biryani',	'images/product/06-05-2021/Biryani.jpg',	0),
(21,	24,	63,	'Chicken Biryani family pack',	'images/product/06-05-2021/Biryani.jpg',	0),
(28,	96,	0,	'kachi ghani mustard oil',	'images/product/12-08-2021/40008291_6-emami-healthy-tasty-kachi-ghani-mustard-oil.jpg',	0),
(31,	25,	0,	'test product',	'images/product/17-08-2021/61I+0dBdHHL._SL1500_.jpg',	0),
(32,	28,	74,	'dfd',	'images/product/17-08-2021/download-(59).jpg',	0),
(33,	33,	89,	'chakki atta',	'images/product/24-06-2021/91o0m2iIpVL._SX522_.jpg',	0),
(34,	29,	78,	'chkki atta',	'images/product/24-06-2021/91o0m2iIpVL._SX522_.jpg',	0),
(36,	30,	83,	'almonds',	'images/product/24-06-2021/811G22SIHuL._SL1500_.jpg',	0),
(37,	24,	64,	'desi ghee',	'images/product/24-06-2021/GHEE-2T.jpg',	0),
(38,	25,	68,	'oil',	'images/product/24-06-2021/41fAkhF7UtL.jpg',	0),
(39,	21,	47,	'container',	'images/product/24-06-2021/61vYb6pqUOL._SL1025_.jpg',	0),
(40,	22,	54,	'cup',	'images/product/24-06-2021/61mDO46ns1L._SL1000_.jpg',	0),
(43,	1,	15,	'vegi',	'images/product/20-07-2021/19356059-assorted-grocery-products-including-vegetables-fruits-wine-bread-dairy-and-meat-isolated-on-white.jpg',	0),
(44,	1,	62,	'vegiii',	'images/product/20-07-2021/19356059-assorted-grocery-products-including-vegetables-fruits-wine-bread-dairy-and-meat-isolated-on-white.jpg',	0),
(45,	96,	36,	'cooking oil',	'images/product/17-08-2021/download-(57).jpg',	0),
(46,	35,	0,	'detergents',	'images/product/17-08-2021/images-(40).jpg',	0),
(47,	8,	12,	'agarbatti',	'images/product/02-08-2021/cyclepure-three-in-one-agarbatti-800x800.jpg',	0),
(48,	8,	12,	'flowers',	'images/product/12-08-2021/20001033_9-fresho-marigold-flower-yellow.jpg',	0),
(49,	28,	75,	'milke',	'images/product/17-08-2021/download.jpg',	0),
(51,	23,	59,	'shmpoo',	'images/product/17-08-2021/download-(86).jpg',	0);

DROP TABLE IF EXISTS `product_highlight_info`;
CREATE TABLE `product_highlight_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `type` enum('Highlight','Info') NOT NULL,
  `product_id` int(30) NOT NULL,
  `title` varchar(245) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_highlight_info` (`id`, `type`, `product_id`, `title`, `value`, `created_at`, `updated_at`) VALUES
(1,	'Highlight',	1,	'Description',	'Made from 100% pure and best quality of chana dalWholesome and nutritious Whips quickly ensuring a consistent taste Ideal to pan out various deserts and fried snacks.',	'2021-06-10 06:57:08',	'2021-06-10 06:57:08'),
(2,	'Highlight',	1,	'Key Features',	'Adani wilmar limited, fortune house, near navrangpura railway crossing, 380009',	'2021-06-10 06:57:08',	'2021-06-10 06:57:08'),
(3,	'Highlight',	1,	'Ingredients',	'SHUDH ENTERPRISE - DarkS (https://bit.ly/2QuoDoe)',	'2021-06-10 06:57:51',	'2021-06-10 06:57:51'),
(4,	'Highlight',	1,	'Unit',	'500 g',	'2021-06-10 06:57:51',	'2021-06-10 06:57:51'),
(5,	'Info',	1,	'Disclaimer',	'Every efort is made to maintain the accuracy of all information',	'2021-06-10 06:58:35',	'2021-06-10 06:58:35'),
(6,	'Info',	1,	'Key Features',	'Leaves the skin moistuized',	'2021-06-10 06:58:35',	'2021-06-10 06:58:35'),
(7,	'Info',	1,	'Seller',	'SHUDH ENTERPRISE - DarkS',	'2021-06-10 06:59:01',	'2021-06-10 06:59:01');

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `product_id` int(30) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(15,	49,	'images/product/17-08-2021/download.jpg',	'2021-08-17 06:58:58',	'2021-08-17 06:58:58'),
(16,	49,	'images/product/17-08-2021/download-(1).jpg',	'2021-08-17 07:02:20',	'2021-08-17 07:02:20'),
(17,	49,	'images/product/17-08-2021/10ml-d-lectea-milke-cup-500x500.jpg',	'2021-08-17 07:02:20',	'2021-08-17 07:02:20'),
(18,	2,	'images/product/17-08-2021/download-(4).jpg',	'2021-08-17 07:04:25',	'2021-08-17 07:04:25'),
(19,	2,	'images/product/17-08-2021/download-(3).jpg',	'2021-08-17 07:04:25',	'2021-08-17 07:04:25'),
(20,	2,	'images/product/17-08-2021/download-(2).jpg',	'2021-08-17 07:04:25',	'2021-08-17 07:04:25'),
(21,	3,	'images/product/17-08-2021/download-(8).jpg',	'2021-08-17 07:05:52',	'2021-08-17 07:05:52'),
(22,	3,	'images/product/17-08-2021/download-(7).jpg',	'2021-08-17 07:05:52',	'2021-08-17 07:05:52'),
(23,	3,	'images/product/17-08-2021/download-(6).jpg',	'2021-08-17 07:05:52',	'2021-08-17 07:05:52'),
(24,	3,	'images/product/17-08-2021/download-(5).jpg',	'2021-08-17 07:05:52',	'2021-08-17 07:05:52'),
(25,	4,	'images/product/17-08-2021/download-(12).jpg',	'2021-08-17 07:08:06',	'2021-08-17 07:08:06'),
(26,	4,	'images/product/17-08-2021/download-(11).jpg',	'2021-08-17 07:08:06',	'2021-08-17 07:08:06'),
(27,	4,	'images/product/17-08-2021/download-(10).jpg',	'2021-08-17 07:08:06',	'2021-08-17 07:08:06'),
(28,	4,	'images/product/17-08-2021/download-(9).jpg',	'2021-08-17 07:08:06',	'2021-08-17 07:08:06'),
(29,	5,	'images/product/17-08-2021/images.jpg',	'2021-08-17 07:10:07',	'2021-08-17 07:10:07'),
(30,	5,	'images/product/17-08-2021/download-(15).jpg',	'2021-08-17 07:10:07',	'2021-08-17 07:10:07'),
(31,	5,	'images/product/17-08-2021/download-(14).jpg',	'2021-08-17 07:10:07',	'2021-08-17 07:10:07'),
(32,	5,	'images/product/17-08-2021/download-(13).jpg',	'2021-08-17 07:10:07',	'2021-08-17 07:10:07'),
(33,	6,	'images/product/17-08-2021/Onion-alternative_1200.jpg',	'2021-08-17 07:13:04',	'2021-08-17 07:13:04'),
(34,	6,	'images/product/17-08-2021/download-(18).jpg',	'2021-08-17 07:13:04',	'2021-08-17 07:13:04'),
(35,	6,	'images/product/17-08-2021/download-(17).jpg',	'2021-08-17 07:13:04',	'2021-08-17 07:13:04'),
(36,	6,	'images/product/17-08-2021/download-(16).jpg',	'2021-08-17 07:13:04',	'2021-08-17 07:13:04'),
(37,	7,	'images/product/17-08-2021/images-(1).jpg',	'2021-08-17 07:14:38',	'2021-08-17 07:14:38'),
(38,	7,	'images/product/17-08-2021/download-(21).jpg',	'2021-08-17 07:14:38',	'2021-08-17 07:14:38'),
(39,	7,	'images/product/17-08-2021/download-(20).jpg',	'2021-08-17 07:14:38',	'2021-08-17 07:14:38'),
(40,	7,	'images/product/17-08-2021/download-(19).jpg',	'2021-08-17 07:14:38',	'2021-08-17 07:14:38'),
(41,	8,	'images/product/17-08-2021/download-(26).jpg',	'2021-08-17 07:17:38',	'2021-08-17 07:17:38'),
(42,	8,	'images/product/17-08-2021/download-(25).jpg',	'2021-08-17 07:17:38',	'2021-08-17 07:17:38'),
(43,	8,	'images/product/17-08-2021/download-(24).jpg',	'2021-08-17 07:17:38',	'2021-08-17 07:17:38'),
(44,	8,	'images/product/17-08-2021/download-(23).jpg',	'2021-08-17 07:17:38',	'2021-08-17 07:17:38'),
(45,	9,	'images/product/17-08-2021/download-(30).jpg',	'2021-08-17 07:19:12',	'2021-08-17 07:19:12'),
(46,	9,	'images/product/17-08-2021/download-(29).jpg',	'2021-08-17 07:19:12',	'2021-08-17 07:19:12'),
(47,	9,	'images/product/17-08-2021/download-(28).jpg',	'2021-08-17 07:19:12',	'2021-08-17 07:19:12'),
(48,	9,	'images/product/17-08-2021/download-(27).jpg',	'2021-08-17 07:19:12',	'2021-08-17 07:19:12'),
(49,	10,	'images/product/17-08-2021/images-(3).jpg',	'2021-08-17 07:21:40',	'2021-08-17 07:21:40'),
(50,	10,	'images/product/17-08-2021/images-(2).jpg',	'2021-08-17 07:21:40',	'2021-08-17 07:21:40'),
(51,	10,	'images/product/17-08-2021/download-(32).jpg',	'2021-08-17 07:21:40',	'2021-08-17 07:21:40'),
(52,	10,	'images/product/17-08-2021/download-(31).jpg',	'2021-08-17 07:21:40',	'2021-08-17 07:21:40'),
(53,	11,	'images/product/17-08-2021/download-(33).jpg',	'2021-08-17 07:23:40',	'2021-08-17 07:23:40'),
(54,	11,	'images/product/17-08-2021/images-(7).jpg',	'2021-08-17 07:23:40',	'2021-08-17 07:23:40'),
(55,	11,	'images/product/17-08-2021/images-(6).jpg',	'2021-08-17 07:23:40',	'2021-08-17 07:23:40'),
(56,	11,	'images/product/17-08-2021/images-(5).jpg',	'2021-08-17 07:23:40',	'2021-08-17 07:23:40'),
(57,	11,	'images/product/17-08-2021/images-(4).jpg',	'2021-08-17 07:23:40',	'2021-08-17 07:23:40'),
(58,	12,	'images/product/17-08-2021/images-(10).jpg',	'2021-08-17 07:25:51',	'2021-08-17 07:25:51'),
(59,	12,	'images/product/17-08-2021/images-(9).jpg',	'2021-08-17 07:25:51',	'2021-08-17 07:25:51'),
(60,	12,	'images/product/17-08-2021/images-(8).jpg',	'2021-08-17 07:25:51',	'2021-08-17 07:25:51'),
(61,	12,	'images/product/17-08-2021/download-(35).jpg',	'2021-08-17 07:25:51',	'2021-08-17 07:25:51'),
(62,	12,	'images/product/17-08-2021/download-(34).jpg',	'2021-08-17 07:25:51',	'2021-08-17 07:25:51'),
(63,	13,	'images/product/17-08-2021/images-(13).jpg',	'2021-08-17 07:29:27',	'2021-08-17 07:29:27'),
(64,	13,	'images/product/17-08-2021/images-(12).jpg',	'2021-08-17 07:29:27',	'2021-08-17 07:29:27'),
(65,	13,	'images/product/17-08-2021/images-(11).jpg',	'2021-08-17 07:29:27',	'2021-08-17 07:29:27'),
(66,	14,	'images/product/17-08-2021/images-(14).jpg',	'2021-08-17 07:31:40',	'2021-08-17 07:31:40'),
(67,	14,	'images/product/17-08-2021/download-(37).jpg',	'2021-08-17 07:31:40',	'2021-08-17 07:31:40'),
(68,	14,	'images/product/17-08-2021/download-(36).jpg',	'2021-08-17 07:31:40',	'2021-08-17 07:31:40'),
(69,	15,	'images/product/17-08-2021/images-(18).jpg',	'2021-08-17 07:34:13',	'2021-08-17 07:34:13'),
(70,	15,	'images/product/17-08-2021/images-(17).jpg',	'2021-08-17 07:34:13',	'2021-08-17 07:34:13'),
(71,	15,	'images/product/17-08-2021/images-(16).jpg',	'2021-08-17 07:34:13',	'2021-08-17 07:34:13'),
(72,	15,	'images/product/17-08-2021/images-(15).jpg',	'2021-08-17 07:34:13',	'2021-08-17 07:34:13'),
(73,	16,	'images/product/17-08-2021/download-(41).jpg',	'2021-08-17 07:35:41',	'2021-08-17 07:35:41'),
(74,	16,	'images/product/17-08-2021/download-(40).jpg',	'2021-08-17 07:35:41',	'2021-08-17 07:35:41'),
(75,	16,	'images/product/17-08-2021/download-(39).jpg',	'2021-08-17 07:35:41',	'2021-08-17 07:35:41'),
(76,	16,	'images/product/17-08-2021/download-(38).jpg',	'2021-08-17 07:35:41',	'2021-08-17 07:35:41'),
(77,	17,	'images/product/17-08-2021/download-(45).jpg',	'2021-08-17 07:37:54',	'2021-08-17 07:37:54'),
(78,	17,	'images/product/17-08-2021/download-(44).jpg',	'2021-08-17 07:37:54',	'2021-08-17 07:37:54'),
(79,	17,	'images/product/17-08-2021/download-(43).jpg',	'2021-08-17 07:37:54',	'2021-08-17 07:37:54'),
(80,	17,	'images/product/17-08-2021/download-(42).jpg',	'2021-08-17 07:37:54',	'2021-08-17 07:37:54'),
(81,	18,	'images/product/17-08-2021/download-(45).jpg',	'2021-08-17 07:38:47',	'2021-08-17 07:38:47'),
(82,	18,	'images/product/17-08-2021/download-(44).jpg',	'2021-08-17 07:38:47',	'2021-08-17 07:38:47'),
(83,	18,	'images/product/17-08-2021/download-(43).jpg',	'2021-08-17 07:38:47',	'2021-08-17 07:38:47'),
(84,	18,	'images/product/17-08-2021/download-(42).jpg',	'2021-08-17 07:38:47',	'2021-08-17 07:38:47'),
(85,	19,	'images/product/17-08-2021/download-(49).jpg',	'2021-08-17 07:40:17',	'2021-08-17 07:40:17'),
(86,	19,	'images/product/17-08-2021/download-(48).jpg',	'2021-08-17 07:40:17',	'2021-08-17 07:40:17'),
(87,	19,	'images/product/17-08-2021/download-(47).jpg',	'2021-08-17 07:40:17',	'2021-08-17 07:40:17'),
(88,	19,	'images/product/17-08-2021/download-(46).jpg',	'2021-08-17 07:40:17',	'2021-08-17 07:40:17'),
(89,	20,	'images/product/17-08-2021/download-(53).jpg',	'2021-08-17 07:41:50',	'2021-08-17 07:41:50'),
(90,	20,	'images/product/17-08-2021/download-(52).jpg',	'2021-08-17 07:41:50',	'2021-08-17 07:41:50'),
(91,	20,	'images/product/17-08-2021/download-(51).jpg',	'2021-08-17 07:41:50',	'2021-08-17 07:41:50'),
(92,	20,	'images/product/17-08-2021/download-(50).jpg',	'2021-08-17 07:41:50',	'2021-08-17 07:41:50'),
(93,	21,	'images/product/17-08-2021/download-(53).jpg',	'2021-08-17 07:45:25',	'2021-08-17 07:45:25'),
(94,	21,	'images/product/17-08-2021/download-(52).jpg',	'2021-08-17 07:45:25',	'2021-08-17 07:45:25'),
(95,	21,	'images/product/17-08-2021/download-(51).jpg',	'2021-08-17 07:45:25',	'2021-08-17 07:45:25'),
(96,	21,	'images/product/17-08-2021/download-(50).jpg',	'2021-08-17 07:45:25',	'2021-08-17 07:45:25'),
(97,	28,	'images/product/17-08-2021/download-(57).jpg',	'2021-08-17 07:48:26',	'2021-08-17 07:48:26'),
(98,	28,	'images/product/17-08-2021/download-(56).jpg',	'2021-08-17 07:48:26',	'2021-08-17 07:48:26'),
(99,	28,	'images/product/17-08-2021/download-(55).jpg',	'2021-08-17 07:48:26',	'2021-08-17 07:48:26'),
(100,	28,	'images/product/17-08-2021/download-(54).jpg',	'2021-08-17 07:48:26',	'2021-08-17 07:48:26'),
(101,	32,	'images/product/17-08-2021/download-(61).jpg',	'2021-08-17 07:55:28',	'2021-08-17 07:55:28'),
(102,	32,	'images/product/17-08-2021/download-(60).jpg',	'2021-08-17 07:55:28',	'2021-08-17 07:55:28'),
(103,	32,	'images/product/17-08-2021/download-(59).jpg',	'2021-08-17 07:55:28',	'2021-08-17 07:55:28'),
(104,	32,	'images/product/17-08-2021/download-(58).jpg',	'2021-08-17 07:55:28',	'2021-08-17 07:55:28'),
(105,	33,	'images/product/17-08-2021/download-(65).jpg',	'2021-08-17 07:57:45',	'2021-08-17 07:57:45'),
(106,	33,	'images/product/17-08-2021/download-(64).jpg',	'2021-08-17 07:57:45',	'2021-08-17 07:57:45'),
(107,	33,	'images/product/17-08-2021/download-(63).jpg',	'2021-08-17 07:57:45',	'2021-08-17 07:57:45'),
(108,	33,	'images/product/17-08-2021/download-(62).jpg',	'2021-08-17 07:57:45',	'2021-08-17 07:57:45'),
(109,	34,	'images/product/17-08-2021/download-(65).jpg',	'2021-08-17 07:58:57',	'2021-08-17 07:58:57'),
(110,	34,	'images/product/17-08-2021/download-(64).jpg',	'2021-08-17 07:58:57',	'2021-08-17 07:58:57'),
(111,	34,	'images/product/17-08-2021/download-(63).jpg',	'2021-08-17 07:58:57',	'2021-08-17 07:58:57'),
(112,	34,	'images/product/17-08-2021/download-(62).jpg',	'2021-08-17 07:58:57',	'2021-08-17 07:58:57'),
(113,	36,	'images/product/17-08-2021/images-(23).jpg',	'2021-08-17 08:03:02',	'2021-08-17 08:03:02'),
(114,	36,	'images/product/17-08-2021/images-(22).jpg',	'2021-08-17 08:03:02',	'2021-08-17 08:03:02'),
(115,	36,	'images/product/17-08-2021/download-(67).jpg',	'2021-08-17 08:03:02',	'2021-08-17 08:03:02'),
(116,	36,	'images/product/17-08-2021/download-(66).jpg',	'2021-08-17 08:03:02',	'2021-08-17 08:03:02'),
(117,	37,	'images/product/17-08-2021/images-(13).jpg',	'2021-08-17 08:04:04',	'2021-08-17 08:04:04'),
(118,	37,	'images/product/17-08-2021/images-(12).jpg',	'2021-08-17 08:04:04',	'2021-08-17 08:04:04'),
(119,	37,	'images/product/17-08-2021/images-(11).jpg',	'2021-08-17 08:04:04',	'2021-08-17 08:04:04'),
(120,	38,	'images/product/17-08-2021/images-(25).jpg',	'2021-08-17 08:06:43',	'2021-08-17 08:06:43'),
(121,	38,	'images/product/17-08-2021/images-(24).jpg',	'2021-08-17 08:06:43',	'2021-08-17 08:06:43'),
(122,	38,	'images/product/17-08-2021/download-(69).jpg',	'2021-08-17 08:06:43',	'2021-08-17 08:06:43'),
(123,	38,	'images/product/17-08-2021/download-(68).jpg',	'2021-08-17 08:06:43',	'2021-08-17 08:06:43'),
(124,	39,	'images/product/17-08-2021/images-(29).jpg',	'2021-08-17 08:10:52',	'2021-08-17 08:10:52'),
(125,	39,	'images/product/17-08-2021/images-(28).jpg',	'2021-08-17 08:10:52',	'2021-08-17 08:10:52'),
(126,	39,	'images/product/17-08-2021/images-(27).jpg',	'2021-08-17 08:10:52',	'2021-08-17 08:10:52'),
(127,	39,	'images/product/17-08-2021/download-(70).jpg',	'2021-08-17 08:10:52',	'2021-08-17 08:10:52'),
(128,	39,	'images/product/17-08-2021/images-(26).jpg',	'2021-08-17 08:10:52',	'2021-08-17 08:10:52'),
(129,	40,	'images/product/17-08-2021/images-(34).jpg',	'2021-08-17 08:13:59',	'2021-08-17 08:13:59'),
(130,	40,	'images/product/17-08-2021/images-(33).jpg',	'2021-08-17 08:13:59',	'2021-08-17 08:13:59'),
(131,	40,	'images/product/17-08-2021/images-(32).jpg',	'2021-08-17 08:13:59',	'2021-08-17 08:13:59'),
(132,	40,	'images/product/17-08-2021/images-(31).jpg',	'2021-08-17 08:13:59',	'2021-08-17 08:13:59'),
(133,	40,	'images/product/17-08-2021/images-(30).jpg',	'2021-08-17 08:13:59',	'2021-08-17 08:13:59'),
(134,	43,	'images/product/17-08-2021/images-(35).jpg',	'2021-08-17 08:16:51',	'2021-08-17 08:16:51'),
(135,	43,	'images/product/17-08-2021/download-(74).jpg',	'2021-08-17 08:16:51',	'2021-08-17 08:16:51'),
(136,	43,	'images/product/17-08-2021/download-(73).jpg',	'2021-08-17 08:16:51',	'2021-08-17 08:16:51'),
(137,	43,	'images/product/17-08-2021/download-(72).jpg',	'2021-08-17 08:16:51',	'2021-08-17 08:16:51'),
(138,	43,	'images/product/17-08-2021/download-(71).jpg',	'2021-08-17 08:16:51',	'2021-08-17 08:16:51'),
(139,	44,	'images/product/17-08-2021/images-(35).jpg',	'2021-08-17 08:17:26',	'2021-08-17 08:17:26'),
(140,	44,	'images/product/17-08-2021/download-(74).jpg',	'2021-08-17 08:17:26',	'2021-08-17 08:17:26'),
(141,	44,	'images/product/17-08-2021/download-(73).jpg',	'2021-08-17 08:17:26',	'2021-08-17 08:17:26'),
(142,	44,	'images/product/17-08-2021/download-(72).jpg',	'2021-08-17 08:17:26',	'2021-08-17 08:17:26'),
(143,	44,	'images/product/17-08-2021/download-(71).jpg',	'2021-08-17 08:17:26',	'2021-08-17 08:17:26'),
(144,	45,	'images/product/17-08-2021/download-(57).jpg',	'2021-08-17 08:18:52',	'2021-08-17 08:18:52'),
(145,	45,	'images/product/17-08-2021/download-(56).jpg',	'2021-08-17 08:19:03',	'2021-08-17 08:19:03'),
(146,	45,	'images/product/17-08-2021/download-(55).jpg',	'2021-08-17 08:19:03',	'2021-08-17 08:19:03'),
(147,	45,	'images/product/17-08-2021/download-(54).jpg',	'2021-08-17 08:19:03',	'2021-08-17 08:19:03'),
(148,	46,	'images/product/17-08-2021/images-(40).jpg',	'2021-08-17 08:23:20',	'2021-08-17 08:23:20'),
(149,	46,	'images/product/17-08-2021/images-(39).jpg',	'2021-08-17 08:23:20',	'2021-08-17 08:23:20'),
(150,	46,	'images/product/17-08-2021/images-(38).jpg',	'2021-08-17 08:23:20',	'2021-08-17 08:23:20'),
(151,	46,	'images/product/17-08-2021/images-(37).jpg',	'2021-08-17 08:23:20',	'2021-08-17 08:23:20'),
(152,	46,	'images/product/17-08-2021/images-(36).jpg',	'2021-08-17 08:23:20',	'2021-08-17 08:23:20'),
(153,	47,	'images/product/17-08-2021/download-(79).jpg',	'2021-08-17 08:25:44',	'2021-08-17 08:25:44'),
(154,	47,	'images/product/17-08-2021/download-(78).jpg',	'2021-08-17 08:25:44',	'2021-08-17 08:25:44'),
(155,	47,	'images/product/17-08-2021/download-(77).jpg',	'2021-08-17 08:25:44',	'2021-08-17 08:25:44'),
(156,	47,	'images/product/17-08-2021/download-(76).jpg',	'2021-08-17 08:25:44',	'2021-08-17 08:25:44'),
(157,	47,	'images/product/17-08-2021/download-(75).jpg',	'2021-08-17 08:25:44',	'2021-08-17 08:25:44'),
(158,	48,	'images/product/17-08-2021/download-(83).jpg',	'2021-08-17 08:28:41',	'2021-08-17 08:28:41'),
(159,	48,	'images/product/17-08-2021/download-(82).jpg',	'2021-08-17 08:28:41',	'2021-08-17 08:28:41'),
(160,	48,	'images/product/17-08-2021/download-(81).jpg',	'2021-08-17 08:28:41',	'2021-08-17 08:28:41'),
(161,	48,	'images/product/17-08-2021/download-(80).jpg',	'2021-08-17 08:28:41',	'2021-08-17 08:28:41'),
(162,	50,	'images/product/17-08-2021/download-(86).jpg',	'2021-08-17 11:16:23',	'2021-08-17 11:16:23'),
(163,	51,	'images/product/17-08-2021/download-(86).jpg',	'2021-08-17 11:17:03',	'2021-08-17 11:17:03'),
(164,	50,	'images/product/17-08-2021/download-(86).jpg',	'2021-08-17 11:33:37',	'2021-08-17 11:33:37'),
(165,	50,	'images/product/17-08-2021/download-(85).jpg',	'2021-08-17 11:33:37',	'2021-08-17 11:33:37'),
(166,	50,	'images/product/17-08-2021/download-(84).jpg',	'2021-08-17 11:33:37',	'2021-08-17 11:33:37');

DROP TABLE IF EXISTS `product_varient`;
CREATE TABLE `product_varient` (
  `varient_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` enum('kg','gm','pc','L','ml','plts','units') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'units',
  `base_mrp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `increment_value` int(30) NOT NULL DEFAULT 1,
  `discount_type` enum('1','2','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 =flat 2 =percentage 0  =none',
  `discount_amount` int(20) NOT NULL DEFAULT 0,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`varient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_varient` (`varient_id`, `product_id`, `quantity`, `unit`, `base_mrp`, `base_price`, `increment_value`, `discount_type`, `discount_amount`, `description`, `varient_image`) VALUES
(2,	2,	897890,	'kg',	'50',	'45',	1,	'1',	5,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg'),
(3,	3,	898990,	'kg',	'50',	'46',	1,	'2',	8,	'Brinjal Green',	'images/product/06-05-2021/bringal.jpg'),
(4,	4,	996890,	'kg',	'50',	'40',	1,	'1',	10,	'Potato',	'images/product/06-05-2021/patato_.jpg'),
(5,	5,	996880,	'kg',	'150',	'135',	1,	'1',	15,	'Tomato',	'images/product/06-05-2021/tomato.jpg'),
(6,	6,	996880,	'kg',	'70',	'66.5',	1,	'2',	5,	'Onion',	'images/product/06-05-2021/onion.jpg'),
(7,	7,	900000,	'kg',	'150',	'138',	1,	'1',	12,	'Apple',	'images/product/06-05-2021/apples.jpg'),
(8,	8,	9990000,	'kg',	'100',	'90',	1,	'2',	10,	'Plum',	'images/product/06-05-2021/plum.jpg'),
(9,	9,	1000000,	'kg',	'150',	'127.5',	1,	'2',	15,	'Banana',	'images/product/06-05-2021/fruts.jpg'),
(10,	10,	1000000,	'kg',	'80',	'72',	1,	'2',	10,	'Grapes',	'images/product/06-05-2021/grapes.jpg'),
(11,	11,	1000000,	'kg',	'60',	'54',	1,	'1',	6,	'Pomegranate',	'images/product/06-05-2021/pomegranate_PNG8653.jpg'),
(12,	12,	99789980,	'kg',	'40',	'40',	1,	'0',	0,	'Sweet lime',	'images/product/06-05-2021/sweet-lime.jpg'),
(13,	13,	1000000,	'kg',	'100',	'98',	1,	'1',	2,	'Ghee Pack',	'images/product/17-08-2021/170821125712pm-40009511_9-patanjali-cow-ghee.jpg'),
(14,	14,	9978980,	'kg',	'120',	'108',	1,	'2',	10,	'Horlicks Kalakand',	'images/product/06-05-2021/kalakand-sweet.jpg'),
(15,	15,	9978931,	'kg',	'150',	'125',	1,	'1',	25,	'DryFruit Halwa',	'images/product/06-05-2021/dry-fruit-halwa.jpg'),
(16,	16,	9978980,	'kg',	'100',	'85',	1,	'2',	15,	'Laddus',	'images/product/17-08-2021/170821010621pm-download-(38).jpg'),
(17,	17,	9978980,	'pc',	'150',	'127.5',	1,	'2',	15,	'Egg puff',	'images/product/06-05-2021/egg.jpg'),
(18,	18,	9978980,	'pc',	'20',	'20',	6,	'2',	0,	'Curry Puff',	'images/product/06-05-2021/curry-puf.jpg'),
(19,	19,	9999980,	'pc',	'10',	'8',	6,	'1',	2,	'Samosa',	'images/product/06-05-2021/samosa.png'),
(20,	20,	9789980,	'plts',	'120',	'70',	6,	'1',	50,	'Chicken Biryani',	'images/product/06-05-2021/Biryani.jpg'),
(21,	21,	10000000,	'plts',	'190',	'115',	6,	'1',	75,	'Chicken Biryani family pack',	'images/product/06-05-2021/Biryani.jpg'),
(28,	28,	2147483647,	'kg',	'150',	'100',	1,	'1',	50,	'description',	'images/product/17-08-2021/170821011737pm-40008291_6-emami-healthy-tasty-kachi-ghani-mustard-oil.jpg'),
(30,	31,	479000000,	'kg',	'1100',	'880',	1,	'2',	20,	'descrption',	'images/product/17-08-2021/170821012033pm-61I+0dBdHHL._SL1500_.jpg'),
(31,	32,	2147483627,	'kg',	'100',	'90',	1,	'1',	10,	'sdfsds',	'images/product/17-08-2021/170821012416pm-download-(59).jpg'),
(32,	33,	2147483627,	'kg',	'330',	'306',	10,	'1',	24,	'chakki atta',	'images/product/24-06-2021/91o0m2iIpVL._SX522_.jpg'),
(33,	34,	2147483627,	'kg',	'190',	'161.5',	5,	'2',	15,	'chakki atta',	'images/product/24-06-2021/91o0m2iIpVL._SX522_.jpg'),
(34,	36,	2147483637,	'kg',	'1095',	'273.75',	1,	'2',	75,	NULL,	'images/product/24-06-2021/811G22SIHuL._SL1500_.jpg'),
(35,	37,	2147483647,	'kg',	'500',	'425',	1,	'2',	15,	NULL,	'images/product/24-06-2021/GHEE-2T.jpg'),
(36,	38,	2147483637,	'kg',	'1270',	'381',	5,	'2',	70,	NULL,	'images/product/24-06-2021/41fAkhF7UtL.jpg'),
(37,	39,	2147483637,	'kg',	'1000',	'500',	1,	'2',	50,	NULL,	'images/product/24-06-2021/61vYb6pqUOL._SL1025_.jpg'),
(38,	40,	2147483637,	'kg',	'999',	'924',	1,	'1',	75,	NULL,	'images/product/24-06-2021/61mDO46ns1L._SL1000_.jpg'),
(39,	43,	2147483637,	'kg',	'65',	'55',	1,	'1',	10,	'hgfhfg',	'images/product/20-07-2021/19356059-assorted-grocery-products-including-vegetables-fruits-wine-bread-dairy-and-meat-isolated-on-white.jpg'),
(40,	44,	2147483616,	'kg',	'85',	'76.5',	1,	'2',	10,	'xxvxxfd',	'images/product/20-07-2021/19356059-assorted-grocery-products-including-vegetables-fruits-wine-bread-dairy-and-meat-isolated-on-white.jpg'),
(41,	45,	2147483637,	'kg',	'98',	'80.36',	1,	'2',	18,	'sa asas a',	'images/product/17-08-2021/170821014841pm-download-(57).jpg'),
(42,	46,	77756,	'kg',	'50',	'40',	1,	'1',	10,	'laundry detergent',	'images/product/17-08-2021/170821015249pm-images-(40).jpg'),
(43,	47,	2147483637,	'kg',	'60',	'48',	1,	'2',	20,	'agarbatti',	'images/product/02-08-2021/cyclepure-three-in-one-agarbatti-800x800.jpg'),
(44,	48,	2147483637,	'kg',	'500',	'250',	1,	'2',	50,	NULL,	'images/product/12-08-2021/20001033_9-fresho-marigold-flower-yellow.jpg'),
(45,	49,	99990,	'L',	'60',	'45',	1,	'2',	15,	'milke',	'images/product/17-08-2021/download.jpg'),
(46,	51,	99900,	'units',	'12',	'11.76',	12,	'1',	2,	'shmpoo',	'images/product/17-08-2021/download-(86).jpg');

DROP TABLE IF EXISTS `razorpay_key`;
CREATE TABLE `razorpay_key` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `razorpay_key` (`key_id`, `api_key`) VALUES
(1,	'rzp_test_K4YMcaRBxHAFvi');

DROP TABLE IF EXISTS `reedem_values`;
CREATE TABLE `reedem_values` (
  `reedem_id` int(100) NOT NULL AUTO_INCREMENT,
  `reward_point` int(100) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`reedem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reedem_values` (`reedem_id`, `reward_point`, `value`) VALUES
(1,	1,	'0.50');

DROP TABLE IF EXISTS `reward_points`;
CREATE TABLE `reward_points` (
  `reward_id` int(100) NOT NULL AUTO_INCREMENT,
  `min_cart_value` int(100) NOT NULL,
  `reward_point` int(100) NOT NULL,
  PRIMARY KEY (`reward_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reward_points` (`reward_id`, `min_cart_value`, `reward_point`) VALUES
(1,	10,	10),
(2,	20,	20),
(3,	1000,	200),
(4,	30,	30),
(5,	2000,	450);

DROP TABLE IF EXISTS `secondary_banner`;
CREATE TABLE `secondary_banner` (
  `sec_banner_id` int(100) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`sec_banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `smsby`;
CREATE TABLE `smsby` (
  `by_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg91` int(11) NOT NULL DEFAULT 1,
  `twilio` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `smsby` (`by_id`, `msg91`, `twilio`, `status`) VALUES
(1,	0,	1,	1);

DROP TABLE IF EXISTS `society`;
CREATE TABLE `society` (
  `society_id` int(100) NOT NULL AUTO_INCREMENT,
  `society_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(100) NOT NULL,
  PRIMARY KEY (`society_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `store_id` int(100) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(100) NOT NULL DEFAULT 0,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_share` float NOT NULL DEFAULT 0,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `del_range` float NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_approval` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `store` (`store_id`, `store_name`, `owner_id`, `employee_name`, `phone_number`, `city`, `admin_share`, `device_id`, `email`, `password`, `del_range`, `lat`, `lng`, `is_default`, `status`, `address`, `admin_approval`) VALUES
(0,	'Defult store',	0,	'test',	'',	'',	50,	'fpreMf0ASj6OPmsk3wtg29:APA91bFWOyAc0LLYy7XwLNvmFkhlHGJL-qdVm5fAR-KWAuoPm9Xw4IW9abih-pA6ZjX6Sjt8dQXxqN3KbYES9by0XQwx4zbR-lqPlUhtvGktlhz6HwSeb58HNohBt5bHGuemsw-8q2g_',	'admin@gmail.com',	'$2y$10$7Ekm.9L6qpbkMY9/Ul151eGDusXJEuan6KH/pAiblyZg0un.sjf5a',	80,	'31.3115257',	'75.56775329999999',	1,	1,	'Jalandhar - Nakodar Road, Malind Nagar, Avtar Nagar, Jalandhar, Punjab, India',	1),
(1,	'new store Chandigarh',	1,	'chandigarh',	'4578124578',	'Chandigarh',	10,	'earJrgzqRYqPqI41608mtR:APA91bEfeAXq66SoMrZTxKBzUrOfgpdReK8xw2icVkViVJHD9IWz0NXJuJfaSVyyc7UawV11hbnERHBao6hTik2Ubl7kJJvv_Q7Rt1JKFj457ZpnsnKKdaZJ7Xdv78dOI64xdwtLxfVh',	'chandigarh@gmail.com',	'$2y$10$qhKOX4CVY3t1aekinBCLpOb8tmcZ/FBnl.6EEn3uiHiNzrJicpN52',	12,	'30.724126',	'76.761272',	0,	1,	'2382, Sector 35 Market Rd, near Banga Bhawan, 35C, Sector 35, Chandigarh, 160022, India',	1),
(17,	'big bazar Sonipat',	1,	'harjit',	'35345',	'Sonipat',	33,	'earJrgzqRYqPqI41608mtR:APA91bFSEZXBTFWPVCXwhddRy71R_IBFFMRDraFGb4Xh1tfcn8z1eBh2vaZITBC-5hX7kGukZKIThPzkddS06T0te5BcjXY6UP113N86HBoWCXFGf9BKWsLhs9pUV8n8hoK0RQO2y8Hu',	'bigbazar@gmail.com',	'$2y$10$7Ekm.9L6qpbkMY9/Ul151eGDusXJEuan6KH/pAiblyZg0un.sjf5a',	15,	'29.0020712',	'77.0032751',	0,	0,	'Sonipat Haryana, Chottu Ram Colony Gali Number 2, Pargati Nagar, Sonipat, Haryana, India',	1),
(18,	'amrit Amritsar',	1,	'amrit',	'55345',	'Amritsar',	40,	NULL,	'amrit@gmail.com',	'$2y$10$7Ekm.9L6qpbkMY9/Ul151eGDusXJEuan6KH/pAiblyZg0un.sjf5a',	100,	'31.6258476',	'74.776629',	0,	0,	'India Gate, Grand Trunk Road, Near G.T. Road Bypass, Naraingarh, Shri Guru Amar Dass Nagar, Chheharta, Amritsar, Punjab, India',	1),
(19,	'sangrur',	1,	'sangrur',	'242342',	'Sangrur',	60,	'earJrgzqRYqPqI41608mtR:APA91bGpXu2PRfHEd6U8hKkH1p7a4U_xm_x1Twumb9H9GygOd-RlksePKHKS37pl781HMcKZ6AWhwmljgSfAANK3WB5DeHuEcskDIvox07Owjls2DbAjvJXNkFZ5uXBQnz9-rEF1kddS',	'sangrur@gmail.com',	'$2y$10$7Ekm.9L6qpbkMY9/Ul151eGDusXJEuan6KH/pAiblyZg0un.sjf5a',	50,	'30.2487133',	'75.8398981',	0,	1,	'District Bus Stand, Partap Nagar, Sangrur, Punjab 148001, India',	1);

DROP TABLE IF EXISTS `store_bank`;
CREATE TABLE `store_bank` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `ac_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `store_doc`;
CREATE TABLE `store_doc` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `store_doc` (`doc_id`, `store_id`, `document`) VALUES
(1,	2,	'/source/images/store/documents/070521152502store_doc.png'),
(2,	4,	'/source/images/store/documents/070521190434store_doc.png'),
(3,	5,	'/source/images/store/documents/070521190548store_doc.png'),
(4,	6,	'/source/images/store/documents/080521140938store_doc.png');

DROP TABLE IF EXISTS `store_earning`;
CREATE TABLE `store_earning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `paid` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `store_notification`;
CREATE TABLE `store_notification` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `not_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `is_order_request` tinyint(1) NOT NULL DEFAULT 0,
  `read_by_store` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `store_notification` (`not_id`, `not_title`, `not_message`, `store_id`, `is_order_request`, `read_by_store`, `created_at`) VALUES
(1,	'WooHoo ! You Got a New Order',	'you got an order cart id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235. It will have to delivered on 2021-05-11 between 07:00 - 10:00.',	7,	0,	0,	'2021-05-10 19:44:38'),
(2,	'WooHoo ! You Got a New Order',	'you got an order cart id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235. It will have to delivered on 2021-05-11 between 07:00 - 10:00.',	7,	0,	0,	'2021-05-10 19:47:16'),
(3,	'WooHoo ! You Got a New Order',	'you got an order cart id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235. It will have to delivered on 2021-05-11 between 07:00 - 10:00.',	7,	0,	0,	'2021-05-10 19:51:19'),
(4,	'WooHoo ! You Got a New Order',	'you got an order cart id #MSUG6940 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235. It will have to delivered on 2021-05-11 between 07:00 - 10:00.',	7,	0,	0,	'2021-05-10 19:53:05'),
(5,	'WooHoo ! You Got a New Order',	'you got an order cart id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235. It will have to delivered on 2021-05-11 between 07:00 - 10:00.',	7,	0,	0,	'2021-05-10 19:58:50'),
(6,	'WooHoo ! You Got a New Order',	'you got an order cart id #QMSL2390 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price rs 220. It will have to delivered on 2021-05-11 between 16:00 - 19:00.',	7,	0,	0,	'2021-05-11 10:05:39'),
(7,	'WooHoo ! You Got a New Order',	'you got an order cart id #ACSO9265 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price rs 220. It will have to delivered on 2021-05-11 between 16:00 - 19:00.',	7,	0,	0,	'2021-05-11 12:39:04'),
(8,	'WooHoo ! You Got a New Order',	'you got an order cart id #LKZI48c1 contains of Carrot(10000kg)*1,Onion(10000kg)*3 of price rs 255. It will have to delivered on 2021-05-11 between 16:00 - 19:00.',	7,	0,	0,	'2021-05-11 12:39:43'),
(9,	'WooHoo ! You Got a New Order',	'you got an order cart id #HREM4695 contains of Plum(100000kg)*1,Grapes(10000kg)*1,Aashirvaad Atta with Multigrains(1000000kg)*1 of price rs 775. It will have to delivered on 2021-05-12 between 07:00 - 10:00.',	7,	0,	0,	'2021-05-11 12:40:15'),
(10,	'WooHoo ! You Got a New Order',	'you got an order cart id #QTIO4740 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price rs 220. It will have to delivered on 2021-05-11 between 16:00 - 19:00.',	7,	0,	0,	'2021-05-11 12:41:15'),
(11,	'WooHoo ! You Got a New Order',	'you got an order cart id #BDQU435a contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*5 of price rs 430. It will have to delivered on 2021-05-11 between 19:00 - 22:00.',	7,	0,	0,	'2021-05-11 15:20:54'),
(12,	'WooHoo ! You Got a New Order',	'you got an order cart id #PYFW5577 contains of Carrot(10000kg)*8 of price rs 340. It will have to delivered on 2021-05-11 between 19:00 - 22:00.',	7,	0,	0,	'2021-05-11 15:23:24'),
(13,	'Stock Allocated',	'Admin Allocate 1quantity of Product',	19,	0,	0,	'2021-07-24 13:55:18'),
(14,	'Stock Allocated',	'Admin Allocate 10quantity of Product',	19,	0,	0,	'2021-07-24 13:55:45'),
(15,	'Stock Allocated',	'Admin Allocate 10quantity of Product',	19,	0,	0,	'2021-07-24 13:56:43'),
(16,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #106',	0,	0,	0,	'2021-07-24 19:40:18'),
(17,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #106',	0,	0,	0,	'2021-07-24 19:43:25'),
(18,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #106',	0,	0,	0,	'2021-07-24 19:45:03'),
(19,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #106',	0,	0,	0,	'2021-07-26 09:55:57'),
(20,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #103',	0,	0,	0,	'2021-07-26 09:57:53'),
(21,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #103',	0,	0,	0,	'2021-07-26 09:59:37'),
(22,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #104',	0,	0,	0,	'2021-07-27 18:25:13'),
(23,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #106',	0,	0,	0,	'2021-07-28 12:35:07'),
(24,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-07-29 18:16:34'),
(25,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-07-31 10:03:43'),
(26,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #141',	0,	0,	0,	'2021-08-05 17:03:53'),
(27,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #142',	0,	0,	0,	'2021-08-05 17:17:20'),
(28,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #142',	0,	0,	0,	'2021-08-05 17:17:37'),
(29,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #142',	0,	0,	0,	'2021-08-05 17:18:55'),
(30,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #142',	0,	0,	0,	'2021-08-05 17:19:20'),
(31,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #141',	0,	0,	0,	'2021-08-05 17:22:36'),
(32,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #141',	0,	0,	0,	'2021-08-05 17:22:47'),
(33,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #141',	0,	0,	0,	'2021-08-05 17:22:58'),
(34,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #141',	0,	0,	0,	'2021-08-05 17:28:18'),
(35,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #143',	0,	0,	0,	'2021-08-05 17:34:36'),
(36,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #140',	0,	0,	0,	'2021-08-05 17:54:20'),
(37,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #140',	0,	0,	0,	'2021-08-05 17:56:56'),
(38,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #145',	0,	0,	0,	'2021-08-05 18:06:28'),
(39,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #146',	0,	0,	0,	'2021-08-05 18:32:42'),
(40,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #166',	0,	0,	0,	'2021-08-13 10:04:15'),
(41,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #166',	0,	0,	0,	'2021-08-13 10:17:22'),
(42,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #166',	0,	0,	0,	'2021-08-13 10:17:50'),
(43,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #166',	0,	0,	0,	'2021-08-13 10:21:01'),
(44,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #166',	0,	0,	0,	'2021-08-13 10:21:08'),
(45,	'sfdfsfs',	'dfsdfsdf',	1,	0,	0,	'2021-08-16 10:22:34'),
(46,	'sfdfsfs',	'dfsdfsdf',	17,	0,	0,	'2021-08-16 10:22:34'),
(47,	'sfdfsfs',	'dfsdfsdf',	0,	0,	0,	'2021-08-16 10:22:34'),
(48,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-20 10:33:00'),
(49,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-20 10:57:23'),
(50,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-20 17:31:18'),
(51,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-23 15:09:53'),
(52,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #173',	0,	0,	0,	'2021-08-24 14:29:23'),
(53,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #177',	0,	0,	0,	'2021-08-25 15:26:20'),
(54,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #176',	0,	0,	0,	'2021-08-25 16:47:03'),
(55,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 10:12:40'),
(56,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 12:10:09'),
(57,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #186',	0,	0,	0,	'2021-08-26 15:22:19'),
(58,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #187',	0,	0,	0,	'2021-08-26 15:43:30'),
(59,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 17:08:57'),
(60,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 18:21:05'),
(61,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 18:33:46'),
(62,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 18:33:58'),
(63,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 18:37:37'),
(64,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 18:37:57'),
(65,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 18:39:25'),
(66,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-26 18:39:57'),
(67,	'Stock Allocated',	'Admin Allocate 12quantity of Product',	1,	0,	0,	'2021-08-26 18:52:35'),
(68,	'Stock Allocated',	'Admin Allocate 12quantity of Product',	1,	0,	0,	'2021-08-26 18:57:08'),
(69,	'Stock Allocated',	'Admin Allocate 13quantity of Product',	1,	0,	0,	'2021-08-26 19:04:31'),
(70,	'Stock Allocated',	'Admin Allocate 12quantity of Product',	1,	0,	0,	'2021-08-26 19:05:35'),
(71,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #190',	0,	0,	0,	'2021-08-27 12:13:23'),
(72,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #191',	0,	0,	0,	'2021-08-27 15:34:29'),
(73,	'Rejected by Deliverey Boy',	'Rejected by Deliverey Boy Order ID: #200',	0,	0,	0,	'2021-08-27 16:31:18'),
(74,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-08-30 14:07:58'),
(75,	'Rejected by Deliverey Boy',	'Rejected by Deliverey Boy Order ID: #198',	0,	0,	0,	'2021-08-31 10:54:33'),
(76,	'Rejected by Deliverey Boy',	'Rejected by Deliverey Boy Order ID: #200',	0,	0,	0,	'2021-08-31 10:55:06'),
(77,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #200',	0,	0,	0,	'2021-08-31 15:57:00'),
(78,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #196',	0,	0,	0,	'2021-08-31 16:35:19'),
(79,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #202',	0,	0,	0,	'2021-08-31 16:35:36'),
(80,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	19,	0,	0,	'2021-08-31 17:49:34'),
(81,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #206',	0,	0,	0,	'2021-09-01 10:22:44'),
(82,	'New Order',	'You Have Received New Order',	1,	0,	0,	'2021-09-01 11:10:35'),
(83,	'New Order',	'You Have Received New Order',	1,	0,	0,	'2021-09-01 11:11:34'),
(84,	'New Order',	'You Have Received New Order',	1,	0,	0,	'2021-09-01 11:12:38'),
(85,	'New Order',	'You Have Received New Order',	1,	0,	0,	'2021-09-01 11:13:33'),
(86,	'New Order',	'You Have Received New Order',	1,	0,	0,	'2021-09-01 11:15:14'),
(87,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #161',	0,	0,	0,	'2021-09-01 11:33:37'),
(88,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #203',	0,	0,	0,	'2021-09-01 11:39:08'),
(89,	'Rejected by Deliverey Boy',	'Rejected by Deliverey Boy Order ID: #205',	1,	0,	0,	'2021-09-01 11:50:33'),
(90,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #223',	1,	0,	0,	'2021-09-01 11:51:07'),
(91,	'New Order',	'You Have Received New Order',	1,	0,	0,	'2021-09-01 16:26:22'),
(92,	'WooHoo ! You Got a New Order',	'WooHoo ! You Got a New Order',	0,	0,	0,	'2021-09-03 10:52:32'),
(93,	'New Order',	'You Have Received New Order',	1,	0,	0,	'2021-09-03 11:09:26'),
(94,	'Rejected by Deliverey Boy',	'Rejected by Deliverey Boy Order ID: #229',	1,	0,	0,	'2021-09-03 11:10:12'),
(95,	'Accepted by Deliverey Boy',	'Accepted by Deliverey Boy Order ID: #229',	1,	0,	0,	'2021-09-03 11:10:46');

DROP TABLE IF EXISTS `store_orders`;
CREATE TABLE `store_orders` (
  `store_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `varient_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `varient_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_mrp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `store_approval` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`store_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `store_orders` (`store_order_id`, `product_name`, `varient_image`, `quantity`, `unit`, `varient_id`, `qty`, `price`, `total_mrp`, `order_cart_id`, `order_date`, `store_approval`) VALUES
(1,	'Tomatooooooooooooo',	'http://technodeviser.com/grocerydelivery/images/product/06-05-2021/bringal.jpg',	'12',	'12',	0,	1,	'1500',	'1600',	'',	'2021-05-07 18:07:08',	1),
(2,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'XHVU21f7',	'2021-05-10 16:41:52',	1),
(3,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	2,	'130',	'140',	'XHVU21f7',	'2021-05-10 16:41:52',	1),
(4,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'ZKQW82f1',	'2021-05-10 16:59:24',	1),
(5,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	2,	'130',	'140',	'ZKQW82f1',	'2021-05-10 16:59:24',	1),
(6,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'IPVC3932',	'2021-05-10 16:59:24',	1),
(7,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	2,	'130',	'140',	'IPVC3932',	'2021-05-10 16:59:24',	1),
(8,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'QREN8280',	'2021-05-10 18:25:47',	1),
(9,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	2,	'130',	'140',	'QREN8280',	'2021-05-10 18:25:47',	1),
(10,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'YXLX85fc',	'2021-05-10 19:17:24',	1),
(11,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	'10000',	'kg',	2,	1,	'45',	'50',	'YXLX85fc',	'2021-05-10 19:17:24',	1),
(12,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	2,	'130',	'140',	'YXLX85fc',	'2021-05-10 19:17:24',	1),
(13,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'TXIC5911',	'2021-05-10 19:22:34',	1),
(14,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	'10000',	'kg',	2,	1,	'45',	'50',	'TXIC5911',	'2021-05-10 19:22:34',	1),
(15,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	2,	'130',	'140',	'TXIC5911',	'2021-05-10 19:22:34',	1),
(16,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'MSUG6940',	'2021-05-10 19:53:00',	1),
(17,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	'10000',	'kg',	2,	1,	'45',	'50',	'MSUG6940',	'2021-05-10 19:53:00',	1),
(18,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	2,	'130',	'140',	'MSUG6940',	'2021-05-10 19:53:00',	1),
(19,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'QMSL2390',	'2021-05-11 10:05:33',	1),
(20,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	'10000',	'kg',	2,	1,	'45',	'50',	'QMSL2390',	'2021-05-11 10:05:33',	1),
(21,	'Brinjal Green',	'images/product/06-05-2021/bringal.jpg',	'10000',	'kg',	3,	1,	'22',	'25',	'QMSL2390',	'2021-05-11 10:05:33',	1),
(22,	'Potato',	'images/product/06-05-2021/patato_.jpg',	'10000',	'kg',	4,	1,	'20',	'25',	'QMSL2390',	'2021-05-11 10:05:33',	1),
(23,	'Tomato',	'images/product/06-05-2021/tomato.jpg',	'10000',	'kg',	5,	1,	'8',	'10',	'QMSL2390',	'2021-05-11 10:05:33',	1),
(24,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	1,	'65',	'70',	'QMSL2390',	'2021-05-11 10:05:33',	1),
(25,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'ACSO9265',	'2021-05-11 12:38:59',	1),
(26,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	'10000',	'kg',	2,	1,	'45',	'50',	'ACSO9265',	'2021-05-11 12:38:59',	1),
(27,	'Brinjal Green',	'images/product/06-05-2021/bringal.jpg',	'10000',	'kg',	3,	1,	'22',	'25',	'ACSO9265',	'2021-05-11 12:38:59',	1),
(28,	'Potato',	'images/product/06-05-2021/patato_.jpg',	'10000',	'kg',	4,	1,	'20',	'25',	'ACSO9265',	'2021-05-11 12:38:59',	1),
(29,	'Tomato',	'images/product/06-05-2021/tomato.jpg',	'10000',	'kg',	5,	1,	'8',	'10',	'ACSO9265',	'2021-05-11 12:38:59',	1),
(30,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	1,	'65',	'70',	'ACSO9265',	'2021-05-11 12:38:59',	1),
(31,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'LKZI48c1',	'2021-05-11 12:39:38',	1),
(32,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	3,	'195',	'210',	'LKZI48c1',	'2021-05-11 12:39:38',	1),
(33,	'Plum',	'images/product/06-05-2021/plum.jpg',	'100000',	'kg',	8,	1,	'40',	'45',	'HREM4695',	'2021-05-11 12:40:09',	1),
(34,	'Grapes',	'images/product/06-05-2021/grapes.jpg',	'10000',	'kg',	10,	1,	'65',	'70',	'HREM4695',	'2021-05-11 12:40:09',	1),
(35,	'Aashirvaad Atta with Multigrains',	'images/product/06-05-2021/aashvaad-mltigrain.jpg',	'1000000',	'kg',	22,	1,	'650',	'650',	'HREM4695',	'2021-05-11 12:40:09',	1),
(36,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'QTIO4740',	'2021-05-11 12:41:06',	1),
(37,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	'10000',	'kg',	2,	1,	'45',	'50',	'QTIO4740',	'2021-05-11 12:41:06',	1),
(38,	'Brinjal Green',	'images/product/06-05-2021/bringal.jpg',	'10000',	'kg',	3,	1,	'22',	'25',	'QTIO4740',	'2021-05-11 12:41:06',	1),
(39,	'Potato',	'images/product/06-05-2021/patato_.jpg',	'10000',	'kg',	4,	1,	'20',	'25',	'QTIO4740',	'2021-05-11 12:41:06',	1),
(40,	'Tomato',	'images/product/06-05-2021/tomato.jpg',	'10000',	'kg',	5,	1,	'8',	'10',	'QTIO4740',	'2021-05-11 12:41:06',	1),
(41,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	1,	'65',	'70',	'QTIO4740',	'2021-05-11 12:41:06',	1),
(42,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	1,	'40',	'50',	'BDQU435a',	'2021-05-11 15:20:49',	1),
(43,	'Lady finger',	'images/product/06-05-2021/ladies-finger.jpg',	'10000',	'kg',	2,	1,	'45',	'50',	'BDQU435a',	'2021-05-11 15:20:49',	1),
(44,	'Onion',	'images/product/06-05-2021/onion.jpg',	'10000',	'kg',	6,	5,	'325',	'350',	'BDQU435a',	'2021-05-11 15:20:49',	1),
(45,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	8,	'320',	'400',	'GAIG6952',	'2021-05-11 15:22:59',	1),
(46,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	8,	'320',	'400',	'PYFW5577',	'2021-05-11 15:23:18',	1),
(47,	'Carrot',	'images/product/06-05-2021/carrot-jpeg-vegetable-carrot-png-clip-art.jpg',	'10000',	'kg',	1,	9,	'360',	'450',	'PSMO30a0',	'2021-05-20 11:02:08',	1);

DROP TABLE IF EXISTS `store_owner`;
CREATE TABLE `store_owner` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` int(20) NOT NULL,
  `password` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `store_owner` (`id`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(0,	'admin',	'admin@gmail.com',	0,	'123456789',	'2021-08-12 10:10:11',	'2021-08-12 10:11:40'),
(1,	'sunil',	'sunil@gmail.com',	0,	'123456789',	'2021-05-31 18:11:07',	'2021-06-21 11:17:39'),
(2,	'owner',	'toreowner@gmail.com',	0,	'12345689',	'2021-06-01 10:26:26',	'2021-06-01 10:26:26'),
(3,	'walmart',	'walmart@gmail.com',	0,	'admin@123',	'2021-06-03 17:41:35',	'2021-06-03 17:41:35');

DROP TABLE IF EXISTS `store_payment_by_dboy`;
CREATE TABLE `store_payment_by_dboy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `store_products`;
CREATE TABLE `store_products` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `varient_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `mrp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` int(20) NOT NULL DEFAULT 0,
  `discount_type` enum('1','2','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 =flat 2 percentage 0 none',
  `store_discount_amount` int(20) NOT NULL DEFAULT 0,
  `store_discount_type` enum('1','2','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 =flat 2 percentage 0 none',
  `total_discount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `store_products` (`p_id`, `varient_id`, `stock`, `store_id`, `mrp`, `price`, `discount_amount`, `discount_type`, `store_discount_amount`, `store_discount_type`, `total_discount`) VALUES
(154,	1,	15,	1,	'1000',	'900',	0,	'0',	10,	'0',	55),
(172,	22,	5,	1,	'650',	'650',	0,	'0',	0,	'0',	50),
(173,	23,	5,	1,	'500',	'500',	0,	'0',	0,	'0',	50),
(174,	24,	5,	1,	'150',	'150',	0,	'0',	0,	'0',	50),
(175,	25,	5,	1,	'100',	'95',	0,	'0',	0,	'0',	50),
(176,	26,	5,	1,	'45',	'45',	0,	'0',	0,	'0',	50),
(261,	1,	5,	17,	'0',	'0',	20,	'0',	0,	'0',	0),
(271,	11,	5,	17,	'150',	'140',	0,	'0',	10,	'1',	10),
(273,	13,	5,	17,	'100',	'98',	0,	'0',	2,	'2',	2),
(281,	21,	4,	17,	'190',	'170',	0,	'0',	20,	'1',	20),
(282,	22,	5,	17,	'650',	'650',	0,	'0',	0,	'0',	0),
(283,	23,	5,	17,	'500',	'500',	0,	'0',	0,	'0',	0),
(284,	24,	5,	17,	'150',	'150',	0,	'0',	0,	'0',	0),
(285,	25,	5,	17,	'100',	'95',	0,	'0',	0,	'0',	0),
(286,	26,	5,	17,	'45',	'45',	0,	'0',	0,	'0',	0),
(287,	27,	5,	17,	'450',	'450',	0,	'0',	0,	'0',	0),
(288,	28,	5,	17,	'110',	'100',	50,	'0',	10,	'1',	10),
(294,	35,	5,	17,	'500',	'425',	23,	'0',	15,	'2',	15),
(307,	27,	5,	1,	'450',	'450',	0,	'0',	0,	'0',	0),
(309,	1,	10,	18,	'200',	'160',	20,	'0',	0,	'0',	0),
(319,	11,	10,	18,	'60',	'60',	0,	'0',	0,	'0',	0),
(321,	13,	10,	18,	'100',	'98',	0,	'0',	0,	'0',	0),
(329,	21,	10,	18,	'190',	'190',	0,	'0',	0,	'0',	0),
(330,	22,	10,	18,	'650',	'650',	0,	'0',	0,	'0',	0),
(331,	23,	10,	18,	'500',	'500',	0,	'0',	0,	'0',	0),
(332,	24,	10,	18,	'150',	'150',	0,	'0',	0,	'0',	0),
(333,	25,	10,	18,	'100',	'95',	0,	'0',	0,	'0',	0),
(334,	26,	10,	18,	'45',	'45',	0,	'0',	0,	'0',	0),
(335,	27,	10,	18,	'450',	'450',	0,	'0',	0,	'0',	0),
(336,	28,	7,	18,	'100',	'100',	50,	'0',	0,	'0',	0),
(342,	35,	10,	18,	'500',	'385',	23,	'0',	0,	'0',	0),
(346,	1,	10,	19,	'200',	'160',	10,	'2',	0,	'2',	10),
(367,	22,	10,	19,	'650',	'650',	10,	'2',	0,	'2',	10),
(368,	23,	10,	19,	'500',	'500',	10,	'2',	0,	'2',	10),
(369,	24,	10,	19,	'150',	'150',	10,	'2',	0,	'2',	10),
(370,	25,	10,	19,	'100',	'95',	10,	'2',	0,	'2',	10),
(371,	26,	10,	19,	'45',	'45',	10,	'2',	0,	'2',	10),
(372,	27,	10,	19,	'450',	'450',	10,	'2',	0,	'2',	10),
(529,	7,	900000,	0,	'150',	'138',	12,	'1',	0,	'1',	12),
(530,	8,	9990000,	0,	'100',	'90',	10,	'2',	0,	'2',	10),
(531,	9,	1000000,	0,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(532,	10,	1000000,	0,	'80',	'72',	10,	'2',	0,	'2',	10),
(541,	8,	8,	18,	'45',	'40',	0,	'1',	0,	'1',	0),
(542,	9,	10,	18,	'50',	'45',	0,	'1',	0,	'1',	0),
(543,	10,	10,	18,	'80',	'70',	10,	'2',	0,	'2',	10),
(551,	7,	10,	17,	'70',	'65',	0,	'1',	5,	'1',	5),
(552,	8,	10,	17,	'45',	'41',	0,	'1',	4,	'1',	4),
(553,	9,	10,	17,	'100',	'85',	0,	'1',	15,	'2',	15),
(554,	10,	10,	17,	'80',	'64',	10,	'2',	20,	'2',	20),
(590,	28,	2147483647,	0,	'150',	'100',	50,	'1',	0,	'1',	50),
(628,	11,	1000000,	0,	'60',	'54',	6,	'1',	0,	'1',	6),
(638,	21,	10000000,	0,	'190',	'115',	75,	'1',	0,	'1',	75),
(644,	35,	2147483647,	0,	'500',	'425',	15,	'2',	0,	'2',	15),
(653,	7,	3,	1,	'150',	'138',	12,	'1',	0,	'1',	12),
(654,	8,	19,	1,	'100',	'90',	10,	'2',	0,	'2',	10),
(655,	9,	2,	1,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(656,	10,	3,	1,	'80',	'72',	10,	'2',	0,	'2',	10),
(657,	11,	5,	1,	'60',	'54',	6,	'1',	0,	'1',	6),
(667,	21,	5,	1,	'190',	'115',	75,	'1',	0,	'1',	75),
(668,	28,	3,	1,	'150',	'100',	50,	'1',	0,	'1',	50),
(669,	30,	10,	1,	'1100',	'880',	20,	'2',	0,	'2',	20),
(674,	35,	10,	1,	'500',	'425',	15,	'2',	0,	'2',	15),
(681,	42,	4,	1,	'50',	'40',	10,	'1',	0,	'1',	10),
(685,	2,	0,	19,	'50',	'45',	5,	'1',	0,	'1',	5),
(686,	3,	0,	19,	'50',	'46',	8,	'2',	0,	'2',	8),
(687,	4,	1,	19,	'50',	'40',	10,	'1',	0,	'1',	10),
(688,	5,	7,	19,	'150',	'135',	15,	'1',	0,	'1',	15),
(689,	6,	7,	19,	'70',	'66.5',	5,	'2',	0,	'2',	5),
(690,	7,	0,	19,	'150',	'138',	12,	'1',	0,	'1',	12),
(691,	8,	0,	19,	'100',	'90',	10,	'2',	0,	'2',	10),
(692,	9,	3,	19,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(693,	10,	4,	19,	'80',	'72',	10,	'2',	0,	'2',	10),
(694,	11,	8,	19,	'60',	'54',	6,	'1',	0,	'1',	6),
(695,	12,	0,	19,	'40',	'40',	0,	'0',	0,	'0',	0),
(696,	13,	8,	19,	'100',	'98',	2,	'1',	0,	'1',	2),
(697,	14,	8,	19,	'120',	'108',	10,	'2',	0,	'2',	10),
(698,	15,	8,	19,	'150',	'125',	25,	'1',	0,	'1',	25),
(699,	17,	8,	19,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(700,	19,	8,	19,	'10',	'8',	2,	'1',	0,	'1',	2),
(701,	21,	0,	19,	'190',	'115',	75,	'1',	0,	'1',	75),
(702,	28,	8,	19,	'150',	'100',	50,	'1',	0,	'1',	50),
(703,	30,	8,	19,	'1100',	'880',	20,	'2',	0,	'2',	20),
(705,	33,	8,	19,	'190',	'161.5',	15,	'2',	0,	'2',	15),
(706,	34,	0,	19,	'1095',	'273.75',	75,	'2',	0,	'2',	75),
(707,	35,	8,	19,	'500',	'425',	15,	'2',	0,	'2',	15),
(708,	36,	8,	19,	'1270',	'381',	70,	'2',	0,	'2',	70),
(709,	37,	8,	19,	'1000',	'500',	50,	'2',	0,	'2',	50),
(710,	38,	0,	19,	'999',	'924',	75,	'1',	0,	'1',	75),
(711,	40,	0,	19,	'85',	'76.5',	10,	'2',	0,	'2',	10),
(712,	43,	8,	19,	'60',	'48',	20,	'2',	0,	'2',	20),
(713,	16,	0,	19,	'100',	'85',	15,	'2',	0,	'2',	15),
(714,	18,	8,	19,	'20',	'20',	0,	'2',	0,	'2',	0),
(715,	20,	8,	19,	'120',	'70',	50,	'1',	0,	'1',	50),
(716,	31,	8,	19,	'100',	'90',	10,	'1',	0,	'1',	10),
(717,	39,	8,	19,	'65',	'55',	10,	'1',	0,	'1',	10),
(718,	41,	5,	19,	'98',	'80.36',	18,	'2',	0,	'2',	18),
(719,	42,	8,	19,	'50',	'40',	10,	'1',	0,	'1',	10),
(722,	2,	21,	17,	'150',	'120',	5,	'1',	20,	'2',	20),
(724,	4,	18,	17,	'50',	'30',	10,	'1',	10,	'1',	20),
(725,	5,	21,	17,	'150',	'120',	15,	'1',	15,	'1',	30),
(726,	6,	21,	17,	'70',	'59.5',	5,	'2',	10,	'2',	15),
(727,	12,	16,	17,	'40',	'38',	0,	'0',	5,	'2',	5),
(728,	14,	21,	17,	'120',	'108',	10,	'2',	0,	'2',	10),
(729,	15,	21,	17,	'150',	'125',	25,	'1',	0,	'1',	25),
(730,	16,	21,	17,	'100',	'85',	15,	'2',	0,	'2',	15),
(731,	17,	21,	17,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(732,	18,	21,	17,	'180',	'99',	0,	'2',	45,	'2',	45),
(734,	20,	21,	17,	'120',	'20',	50,	'1',	50,	'1',	100),
(735,	30,	21,	17,	'1100',	'660',	20,	'2',	20,	'2',	40),
(736,	31,	1,	17,	'100',	'80',	10,	'1',	10,	'1',	20),
(737,	32,	5,	17,	'330',	'258',	24,	'1',	48,	'1',	72),
(738,	33,	1,	17,	'280',	'154',	15,	'2',	30,	'2',	45),
(739,	34,	1,	17,	'1095',	'-547.5',	75,	'2',	75,	'2',	150),
(740,	36,	5,	17,	'1270',	'-508',	70,	'2',	70,	'2',	140),
(741,	37,	3,	17,	'1000',	'250',	50,	'2',	75,	'2',	75),
(742,	38,	6,	17,	'1200',	'420',	75,	'1',	65,	'2',	65),
(743,	39,	20,	17,	'65',	'45',	10,	'1',	10,	'1',	20),
(744,	40,	21,	17,	'85',	'68',	10,	'2',	20,	'2',	20),
(745,	42,	18,	17,	'100',	'70',	10,	'1',	20,	'1',	30),
(746,	43,	1,	17,	'150',	'105',	20,	'2',	30,	'2',	30),
(747,	44,	1,	17,	'150',	'140',	50,	'2',	10,	'1',	10),
(761,	30,	479000000,	0,	'1100',	'880',	20,	'2',	0,	'2',	20),
(771,	42,	77756,	0,	'50',	'40',	10,	'1',	0,	'1',	10),
(777,	5,	20,	18,	'150',	'135',	15,	'1',	0,	'1',	15),
(778,	6,	20,	18,	'70',	'66.5',	5,	'2',	0,	'2',	5),
(779,	12,	20,	18,	'40',	'40',	0,	'0',	0,	'0',	0),
(780,	14,	20,	18,	'120',	'108',	10,	'2',	0,	'2',	10),
(781,	15,	20,	18,	'150',	'125',	25,	'1',	0,	'1',	25),
(782,	16,	20,	18,	'100',	'85',	15,	'2',	0,	'2',	15),
(783,	17,	20,	18,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(784,	18,	20,	18,	'20',	'20',	0,	'2',	0,	'2',	0),
(785,	19,	20,	18,	'10',	'8',	2,	'1',	0,	'1',	2),
(786,	20,	20,	18,	'120',	'70',	50,	'1',	0,	'1',	50),
(787,	30,	0,	18,	'1100',	'880',	20,	'2',	0,	'2',	20),
(788,	31,	20,	18,	'100',	'90',	10,	'1',	0,	'1',	10),
(789,	32,	20,	18,	'330',	'306',	24,	'1',	0,	'1',	24),
(790,	33,	20,	18,	'190',	'161.5',	15,	'2',	0,	'2',	15),
(791,	34,	10,	18,	'1095',	'273.75',	75,	'2',	0,	'2',	75),
(792,	36,	10,	18,	'1270',	'381',	70,	'2',	0,	'2',	70),
(793,	37,	10,	18,	'1000',	'500',	50,	'2',	0,	'2',	50),
(794,	38,	10,	18,	'999',	'924',	75,	'1',	0,	'1',	75),
(795,	39,	10,	18,	'65',	'55',	10,	'1',	0,	'1',	10),
(796,	40,	10,	18,	'85',	'76.5',	10,	'2',	0,	'2',	10),
(797,	42,	0,	18,	'50',	'40',	10,	'1',	0,	'1',	10),
(798,	43,	10,	18,	'60',	'48',	20,	'2',	0,	'2',	20),
(799,	44,	10,	18,	'500',	'450',	50,	'2',	0,	'2',	50),
(828,	43,	2147483637,	0,	'60',	'48',	20,	'2',	0,	'2',	20),
(829,	2,	897890,	0,	'50',	'45',	5,	'1',	0,	'1',	5),
(830,	3,	898990,	0,	'50',	'46',	8,	'2',	0,	'2',	8),
(831,	4,	996890,	0,	'50',	'40',	10,	'1',	0,	'1',	10),
(832,	5,	996880,	0,	'150',	'135',	15,	'1',	0,	'1',	15),
(833,	6,	996880,	0,	'70',	'66.5',	5,	'2',	0,	'2',	5),
(834,	12,	99789980,	0,	'40',	'40',	0,	'0',	0,	'0',	0),
(835,	13,	1000000,	0,	'100',	'98',	2,	'1',	0,	'1',	2),
(836,	14,	9978980,	0,	'120',	'108',	10,	'2',	0,	'2',	10),
(837,	15,	9978931,	0,	'150',	'125',	25,	'1',	0,	'1',	25),
(838,	16,	9978980,	0,	'100',	'85',	15,	'2',	0,	'2',	15),
(839,	17,	9978980,	0,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(840,	18,	9978980,	0,	'20',	'20',	0,	'2',	0,	'2',	0),
(841,	19,	9999980,	0,	'10',	'8',	2,	'1',	0,	'1',	2),
(842,	20,	9789980,	0,	'120',	'70',	50,	'1',	0,	'1',	50),
(843,	31,	2147483627,	0,	'100',	'90',	10,	'1',	0,	'1',	10),
(844,	32,	2147483627,	0,	'330',	'306',	24,	'1',	0,	'1',	24),
(845,	33,	2147483627,	0,	'190',	'161.5',	15,	'2',	0,	'2',	15),
(846,	34,	2147483637,	0,	'1095',	'273.75',	75,	'2',	0,	'2',	75),
(847,	36,	2147483637,	0,	'1270',	'381',	70,	'2',	0,	'2',	70),
(848,	37,	2147483637,	0,	'1000',	'500',	50,	'2',	0,	'2',	50),
(849,	38,	2147483637,	0,	'999',	'924',	75,	'1',	0,	'1',	75),
(850,	39,	2147483637,	0,	'65',	'55',	10,	'1',	0,	'1',	10),
(851,	40,	2147483616,	0,	'85',	'76.5',	10,	'2',	0,	'2',	10),
(852,	41,	2147483637,	0,	'98',	'80.36',	18,	'2',	0,	'2',	18),
(853,	44,	2147483637,	0,	'500',	'250',	50,	'2',	0,	'2',	50),
(854,	45,	99990,	0,	'60',	'45',	15,	'2',	0,	'2',	15),
(855,	2,	10,	18,	'50',	'45',	5,	'1',	0,	'1',	5),
(856,	3,	10,	18,	'50',	'46',	8,	'2',	0,	'2',	8),
(857,	4,	10,	18,	'50',	'40',	10,	'1',	0,	'1',	10),
(858,	41,	10,	18,	'98',	'80.36',	18,	'2',	0,	'2',	18),
(859,	45,	10,	18,	'60',	'45',	15,	'2',	0,	'2',	15),
(860,	46,	99900,	0,	'12',	'11.76',	2,	'1',	0,	'1',	2),
(861,	46,	100,	18,	'12',	'11.76',	2,	'1',	0,	'1',	2),
(865,	3,	0,	17,	'50',	'46',	8,	'2',	0,	'2',	8),
(866,	19,	0,	17,	'10',	'8',	2,	'1',	0,	'1',	2),
(867,	41,	0,	17,	'98',	'80.36',	18,	'2',	0,	'2',	18),
(868,	45,	0,	17,	'60',	'45',	15,	'2',	0,	'2',	15),
(869,	46,	0,	17,	'12',	'11.76',	2,	'1',	0,	'1',	2),
(870,	44,	0,	19,	'500',	'250',	50,	'2',	0,	'2',	50),
(871,	45,	0,	19,	'60',	'45',	15,	'2',	0,	'2',	15),
(872,	46,	0,	19,	'12',	'11.76',	2,	'1',	0,	'1',	2),
(873,	2,	0,	1,	'50',	'45',	5,	'1',	0,	'1',	5),
(874,	3,	0,	1,	'50',	'46',	8,	'2',	0,	'2',	8),
(875,	4,	1,	1,	'50',	'40',	10,	'1',	0,	'1',	10),
(876,	5,	6,	1,	'150',	'135',	15,	'1',	0,	'1',	15),
(877,	6,	9,	1,	'70',	'66.5',	5,	'2',	0,	'2',	5),
(879,	13,	10,	1,	'100',	'98',	2,	'1',	0,	'1',	2),
(880,	14,	10,	1,	'120',	'108',	10,	'2',	0,	'2',	10),
(881,	15,	48,	1,	'150',	'125',	25,	'1',	0,	'1',	25),
(882,	16,	10,	1,	'100',	'85',	15,	'2',	0,	'2',	15),
(883,	17,	10,	1,	'150',	'127.5',	15,	'2',	0,	'2',	15),
(884,	18,	0,	1,	'20',	'20',	0,	'2',	0,	'2',	0),
(885,	19,	4,	1,	'10',	'8',	2,	'1',	0,	'1',	2),
(886,	20,	6,	1,	'120',	'70',	50,	'1',	0,	'1',	50),
(887,	31,	9,	1,	'100',	'90',	10,	'1',	0,	'1',	10),
(888,	32,	7,	1,	'330',	'306',	24,	'1',	0,	'1',	24),
(889,	33,	10,	1,	'190',	'161.5',	15,	'2',	0,	'2',	15),
(890,	34,	10,	1,	'1095',	'273.75',	75,	'2',	0,	'2',	75),
(891,	36,	5,	1,	'1270',	'381',	70,	'2',	0,	'2',	70),
(892,	37,	10,	1,	'1000',	'500',	50,	'2',	0,	'2',	50),
(893,	38,	10,	1,	'999',	'924',	75,	'1',	0,	'1',	75),
(894,	39,	10,	1,	'65',	'55',	10,	'1',	0,	'1',	10),
(895,	40,	5,	1,	'85',	'76.5',	10,	'2',	0,	'2',	10),
(896,	41,	10,	1,	'98',	'80.36',	18,	'2',	0,	'2',	18),
(897,	43,	10,	1,	'60',	'48',	20,	'2',	0,	'2',	20),
(898,	44,	8,	1,	'500',	'250',	50,	'2',	0,	'2',	50),
(899,	45,	9,	1,	'60',	'45',	15,	'2',	0,	'2',	15),
(900,	46,	5,	1,	'12',	'11.76',	2,	'1',	0,	'1',	2),
(902,	12,	0,	1,	'40',	'40',	0,	'0',	0,	'0',	0);

DROP TABLE IF EXISTS `store_society`;
CREATE TABLE `store_society` (
  `store_society_id` int(100) NOT NULL AUTO_INCREMENT,
  `society_id` int(100) NOT NULL,
  `store_id` int(100) NOT NULL,
  PRIMARY KEY (`store_society_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `store_time_slot`;
CREATE TABLE `store_time_slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(100) DEFAULT NULL,
  `day` varchar(111) NOT NULL,
  `opening_time` varchar(111) DEFAULT NULL,
  `closing_time` varchar(111) DEFAULT NULL,
  `time_slot` int(111) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `store_time_slot` (`id`, `store_id`, `day`, `opening_time`, `closing_time`, `time_slot`, `status`) VALUES
(16,	19,	'0',	'08:00 AM',	'10:00 AM',	1,	1),
(17,	19,	'0',	'10:00 AM',	'12:00 PM',	2,	1),
(18,	19,	'0',	'12:00 PM',	'02:00 PM',	3,	1),
(19,	19,	'0',	'02:00 PM',	'04:00 PM',	4,	1),
(20,	19,	'0',	'06:00 PM',	'08:00 PM',	5,	1),
(22,	19,	'1',	'11:00 AM',	'01:00 PM',	1,	1),
(23,	19,	'1',	'09:00 AM',	'11:00 AM',	2,	1),
(24,	19,	'1',	'03:00 PM',	'05:00 PM',	3,	1),
(25,	19,	'1',	'05:00 PM',	'07:00 PM',	4,	1),
(26,	19,	'2',	'10:00 AM',	'12:00 PM',	1,	1),
(27,	19,	'2',	'12:00 PM',	'02:00 PM',	2,	1),
(28,	19,	'2',	'03:00 PM',	'05:00 PM',	3,	1),
(30,	19,	'2',	'04:00 PM',	'06:00 PM',	4,	1),
(31,	19,	'3',	'12:00 PM',	'02:00 PM',	1,	1),
(33,	19,	'3',	'03:00 PM',	'05:00 PM',	2,	1),
(34,	19,	'4',	'08:00 AM',	'10:00 AM',	1,	1),
(35,	19,	'4',	'11:00 AM',	'01:00 PM',	2,	1),
(36,	19,	'4',	'03:00 PM',	'05:00 PM',	3,	1),
(37,	19,	'5',	'10:00 AM',	'12:00 PM',	1,	1),
(38,	19,	'5',	'02:00 PM',	'04:00 PM',	2,	1),
(39,	19,	'5',	'04:00 PM',	'06:00 PM',	3,	1),
(40,	19,	'6',	'08:00 AM',	'10:00 AM',	1,	1),
(41,	19,	'6',	'11:00 AM',	'01:00 PM',	2,	1),
(42,	19,	'6',	'06:00 PM',	'08:00 PM',	2,	1),
(69,	19,	'2',	'08:00 PM',	'10:00 PM',	6,	1),
(70,	19,	'2',	'06:00 PM',	'08:00 PM',	5,	1),
(72,	0,	'0',	'08:00 AM',	'10:00 AM',	1,	1),
(73,	0,	'0',	'10:00 AM',	'12:00 PM',	2,	1),
(74,	0,	'0',	'12:00 PM',	'02:00 PM',	3,	1),
(75,	0,	'0',	'02:00 PM',	'04:00 PM',	4,	1),
(76,	0,	'0',	'06:00 PM',	'08:00 PM',	5,	1),
(77,	0,	'1',	'11:00 AM',	'01:00 PM',	1,	1),
(78,	0,	'1',	'09:00 AM',	'11:00 AM',	2,	1),
(79,	0,	'1',	'03:00 PM',	'05:00 PM',	3,	1),
(80,	0,	'1',	'05:00 PM',	'07:00 PM',	4,	1),
(81,	0,	'2',	'10:00 AM',	'12:00 PM',	1,	1),
(82,	0,	'2',	'12:00 PM',	'02:00 PM',	2,	1),
(83,	0,	'2',	'03:00 PM',	'05:00 PM',	3,	1),
(84,	0,	'2',	'04:00 PM',	'06:00 PM',	4,	1),
(85,	0,	'3',	'12:00 PM',	'02:00 PM',	1,	1),
(86,	0,	'3',	'03:00 PM',	'05:00 PM',	2,	1),
(87,	0,	'4',	'08:00 AM',	'10:00 AM',	1,	1),
(88,	0,	'4',	'11:00 AM',	'01:00 PM',	2,	1),
(89,	0,	'4',	'03:00 PM',	'05:00 PM',	3,	1),
(90,	0,	'5',	'10:00 AM',	'12:00 PM',	1,	1),
(91,	0,	'5',	'02:00 PM',	'04:00 PM',	2,	1),
(92,	0,	'5',	'04:00 PM',	'06:00 PM',	3,	1),
(93,	0,	'6',	'08:00 AM',	'10:00 AM',	1,	1),
(94,	0,	'6',	'11:00 AM',	'01:00 PM',	2,	1),
(95,	0,	'6',	'06:00 PM',	'08:00 PM',	2,	1),
(96,	0,	'2',	'08:00 PM',	'10:00 PM',	6,	1),
(97,	0,	'2',	'06:00 PM',	'08:00 PM',	5,	1),
(103,	1,	'0',	'08:00 AM',	'10:00 AM',	1,	1),
(104,	1,	'0',	'10:00 AM',	'12:00 PM',	2,	1),
(105,	1,	'0',	'12:00 PM',	'02:00 PM',	3,	1),
(106,	1,	'0',	'02:00 PM',	'04:00 PM',	4,	1),
(107,	1,	'0',	'06:00 PM',	'08:00 PM',	5,	1),
(108,	1,	'1',	'11:00 AM',	'01:00 PM',	1,	1),
(109,	1,	'1',	'09:00 AM',	'11:00 AM',	2,	1),
(110,	1,	'1',	'03:00 PM',	'05:00 PM',	3,	1),
(111,	1,	'1',	'05:00 PM',	'07:00 PM',	4,	1),
(112,	1,	'2',	'10:00 AM',	'12:00 PM',	1,	1),
(113,	1,	'2',	'12:00 PM',	'02:00 PM',	2,	1),
(114,	1,	'2',	'03:00 PM',	'05:00 PM',	3,	1),
(115,	1,	'2',	'04:00 PM',	'06:00 PM',	4,	1),
(116,	1,	'3',	'12:00 PM',	'02:00 PM',	1,	1),
(117,	1,	'3',	'03:00 PM',	'05:00 PM',	2,	1),
(118,	1,	'4',	'08:00 AM',	'10:00 AM',	1,	1),
(119,	1,	'4',	'11:00 AM',	'01:00 PM',	2,	1),
(120,	1,	'4',	'03:00 PM',	'05:00 PM',	3,	1),
(121,	1,	'5',	'10:00 AM',	'12:00 PM',	1,	1),
(122,	1,	'5',	'02:00 PM',	'04:00 PM',	2,	1),
(123,	1,	'5',	'04:00 PM',	'06:00 PM',	3,	1),
(124,	1,	'6',	'08:00 AM',	'10:00 AM',	1,	1),
(125,	1,	'6',	'11:00 AM',	'01:00 PM',	2,	1),
(126,	1,	'6',	'06:00 PM',	'08:00 PM',	2,	1),
(127,	1,	'2',	'08:00 PM',	'10:00 PM',	6,	1),
(128,	1,	'2',	'06:00 PM',	'08:00 PM',	5,	1),
(134,	17,	'0',	'08:00 AM',	'10:00 AM',	1,	1),
(135,	17,	'0',	'10:00 AM',	'12:00 PM',	2,	1),
(136,	17,	'0',	'12:00 PM',	'02:00 PM',	3,	1),
(137,	17,	'0',	'02:00 PM',	'04:00 PM',	4,	1),
(138,	17,	'0',	'06:00 PM',	'08:00 PM',	5,	1),
(139,	17,	'1',	'11:00 AM',	'01:00 PM',	1,	1),
(140,	17,	'1',	'09:00 AM',	'11:00 AM',	2,	1),
(141,	17,	'1',	'03:00 PM',	'05:00 PM',	3,	1),
(142,	17,	'1',	'05:00 PM',	'07:00 PM',	4,	1),
(143,	17,	'2',	'10:00 AM',	'12:00 PM',	1,	1),
(144,	17,	'2',	'12:00 PM',	'02:00 PM',	2,	1),
(145,	17,	'2',	'03:00 PM',	'05:00 PM',	3,	1),
(146,	17,	'2',	'04:00 PM',	'06:00 PM',	4,	1),
(147,	17,	'3',	'12:00 PM',	'02:00 PM',	1,	1),
(148,	17,	'3',	'03:00 PM',	'05:00 PM',	2,	1),
(149,	17,	'4',	'08:00 AM',	'10:00 AM',	1,	1),
(150,	17,	'4',	'11:00 AM',	'01:00 PM',	2,	1),
(151,	17,	'4',	'03:00 PM',	'05:00 PM',	3,	1),
(152,	17,	'5',	'10:00 AM',	'12:00 PM',	1,	1),
(153,	17,	'5',	'02:00 PM',	'04:00 PM',	2,	1),
(154,	17,	'5',	'04:00 PM',	'06:00 PM',	3,	1),
(155,	17,	'6',	'08:00 AM',	'10:00 AM',	1,	1),
(156,	17,	'6',	'11:00 AM',	'01:00 PM',	2,	1),
(157,	17,	'6',	'06:00 PM',	'08:00 PM',	2,	1),
(158,	17,	'2',	'08:00 PM',	'10:00 PM',	6,	1),
(159,	17,	'2',	'06:00 PM',	'08:00 PM',	5,	1),
(165,	18,	'0',	'08:00 AM',	'10:00 AM',	1,	1),
(166,	18,	'0',	'10:00 AM',	'12:00 PM',	2,	1),
(167,	18,	'0',	'12:00 PM',	'02:00 PM',	3,	1),
(168,	18,	'0',	'02:00 PM',	'04:00 PM',	4,	1),
(169,	18,	'0',	'06:00 PM',	'08:00 PM',	5,	1),
(170,	18,	'1',	'11:00 AM',	'01:00 PM',	1,	1),
(171,	18,	'1',	'09:00 AM',	'11:00 AM',	2,	1),
(172,	18,	'1',	'03:00 PM',	'05:00 PM',	3,	1),
(173,	18,	'1',	'05:00 PM',	'07:00 PM',	4,	1),
(174,	18,	'2',	'10:00 AM',	'12:00 PM',	1,	1),
(175,	18,	'2',	'12:00 PM',	'02:00 PM',	2,	1),
(176,	18,	'2',	'03:00 PM',	'05:00 PM',	3,	1),
(177,	18,	'2',	'04:00 PM',	'06:00 PM',	4,	1),
(178,	18,	'3',	'12:00 PM',	'02:00 PM',	1,	1),
(179,	18,	'3',	'03:00 PM',	'05:00 PM',	2,	1),
(180,	18,	'4',	'08:00 AM',	'10:00 AM',	1,	1),
(181,	18,	'4',	'11:00 AM',	'01:00 PM',	2,	1),
(182,	18,	'4',	'03:00 PM',	'05:00 PM',	3,	1),
(183,	18,	'5',	'10:00 AM',	'12:00 PM',	1,	1),
(184,	18,	'5',	'02:00 PM',	'04:00 PM',	2,	1),
(185,	18,	'5',	'04:00 PM',	'06:00 PM',	3,	1),
(186,	18,	'6',	'08:00 AM',	'10:00 AM',	1,	1),
(187,	18,	'6',	'11:00 AM',	'01:00 PM',	2,	1),
(188,	18,	'6',	'06:00 PM',	'08:00 PM',	2,	1),
(189,	18,	'2',	'08:00 PM',	'10:00 PM',	6,	1),
(190,	18,	'2',	'06:00 PM',	'08:00 PM',	5,	1);

DROP TABLE IF EXISTS `tbl_top_cat`;
CREATE TABLE `tbl_top_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `cat_rank` int(11) NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tbl_top_cat` (`id`, `cat_id`, `cat_rank`, `created_at`, `updated_at`) VALUES
(1,	3,	3,	'2021-08-12 11:14:34',	'2021-08-12 11:14:34');

DROP TABLE IF EXISTS `tbl_web_setting`;
CREATE TABLE `tbl_web_setting` (
  `set_id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topbar_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `splashscreen_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_shapes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tbl_web_setting` (`set_id`, `icon`, `name`, `favicon`, `primary_color`, `secondary_color`, `topbar_color`, `splashscreen_color`, `store_id`, `font_family`, `button_shapes`, `button_color`) VALUES
(1,	'images/app_logo/06-05-2021/gogrocer.png',	'Grocery Delivery',	'images/app_logo/favicon/06-05-2021/gogrocer.png',	'#217fbb',	'#217fbb',	'#217fbb',	'#000000',	'0',	'ABeeZee',	'1',	'#217fbb');

DROP TABLE IF EXISTS `termspage`;
CREATE TABLE `termspage` (
  `terms_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`terms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `termspage` (`terms_id`, `title`, `description`) VALUES
(1,	'Terms & Condition',	'<table cellspacing=\"0\" id=\"datatables\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>\r\n			<p><strong>Terms and Conditions</strong></p>\r\n\r\n			<p>Last Updated: 05&nbsp;May 2020</p>\r\n\r\n			<p><strong>Scope of License</strong></p>\r\n\r\n			<p>This license granted to you for the Licensed Application by the Application Provider, is limited to a non-exclusive, non-transferable, license to use the Licensed Application on any Android&trade; and iOS device that you own or control. This license does not allow you to use the Licensed Application on any Android&trade; device that you do not own or control, and you may not distribute or make the Licensed Application available over a network where it could be used by multiple devices at the same time. Nothing contained in the Licensed Application should be considered as granting you, by implication or otherwise, any license or right to use any trade-marks, logos, or other names contained in the Licensed Application. You may not rent, lease, lend, sell, redistribute or sublicense the Licensed Application. You may not copy, decompile, reverse engineer, disassemble, attempt to derive the source code of, modify, or create derivative works of the Licensed Application, any updates, or any part thereof (except as and only to the extent any foregoing restriction is prohibited by applicable law or to the extent as may be permitted by the licensing terms governing the use of any open-sourced components included within the Licensed Application). Any attempt to do so is a violation of the rights of the Application Provider and its licensors. If you breach this restriction, you may be subject to prosecution and damages. The terms of the license will govern any upgrades provided by the Application Provider that replace and/or supplement the original Licensed Application unless such upgrade is accompanied by a separate license in which case the terms of that license will govern its use.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>');

DROP TABLE IF EXISTS `time_slot`;
CREATE TABLE `time_slot` (
  `time_slot_id` int(100) NOT NULL AUTO_INCREMENT,
  `open_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_slot` int(11) NOT NULL,
  PRIMARY KEY (`time_slot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `time_slot` (`time_slot_id`, `open_hour`, `close_hour`, `time_slot`) VALUES
(1,	'07:00',	'22:00',	180);

DROP TABLE IF EXISTS `twilio`;
CREATE TABLE `twilio` (
  `twilio_id` int(11) NOT NULL AUTO_INCREMENT,
  `twilio_sid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twilio_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twilio_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`twilio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `twilio` (`twilio_id`, `twilio_sid`, `twilio_token`, `twilio_phone`, `active`) VALUES
(1,	'jachai',	'Allahprotectme2011@)!!',	'jachai.com',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_owner_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 user ,2 admin, 3 store',
  `active_store` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `wallet` float NOT NULL DEFAULT 0,
  `rewards` int(11) NOT NULL DEFAULT 0,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `block` int(11) NOT NULL DEFAULT 2,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`user_id`, `user_name`, `user_phone`, `user_email`, `device_id`, `user_image`, `user_password`, `otp_value`, `app_owner_id`, `user_role`, `active_store`, `status`, `wallet`, `rewards`, `is_verified`, `block`, `reg_date`) VALUES
(18,	'harjit',	'9915004993',	'harjitkumar261@gmail.com',	'dV9WKC5CTlmA2kN2HWdgTp:APA91bG7crbG3ZN3LjDUErV4LLtSNw32l5aE9_DpobhiZ7ygaxMPyXqUEP-hW6OQqpsL6FGdDBbF2NR1q_AoN18CgXfmIE-lXoO3OpoC0Xdxp3l6VKHJN_ZC1Lt_k6wWEQ5PmtH5DIy5',	'N/A',	'123456',	'8175',	'1',	'1',	NULL,	1,	0,	30,	1,	2,	'2021-05-10 11:35:19'),
(19,	'parmod',	'7696399515',	'fsfd',	'esY7EmKxQSawtslZHX4Qe4:APA91bEBs6dp6NoRDZnqgW3xf1mrNu_ubCZgGJ7hMZ1t1b32A4NumYPJl_OxfqYLgs4HezLkapABmGxb9EiXn9Fp6eO3jNeN8i8EEIa7MNQqIQ_xGGzuKO3pcAHVm3JNmb1uMt186VGZ',	'public/userprofile/SYOITlgTlhJ6rNjZL91qR6nPUh8btG1ayIwc0PWS.jpg',	'',	'7269',	'1',	'1',	'1',	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(20,	'',	'9915004935',	'',	'',	'N/A',	'',	'8177',	'1',	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(21,	'',	'7946863438',	'',	'',	'N/A',	'',	'8187',	'1',	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(22,	'',	'1111111111',	'',	'',	'N/A',	'',	'6975',	'1',	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(23,	'',	'9915500499',	'',	'dM2SoiZSS_e6gF2eNpv-y1:APA91bGaYNUHGqsB6Fxn-e-9KUy-MKnWWejyUp3uxLFZfwaRdFAu24Lixt0cq91MOL23j5r54kJ7CCi3HxK9y2mxVGDJQis8EYvmZxvb4rliQL_kfb0I4aMrYushmeCipo3j8nvys-J9',	'N/A',	'',	'4875',	'1',	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(24,	'',	'8765434567',	'',	'',	'N/A',	'',	'4580',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(25,	'',	'9915004499',	'',	'',	'N/A',	'',	'9050',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(26,	'',	'9915004933',	'',	'',	'N/A',	'',	'1604',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(27,	'',	'9875489529',	'',	'f84q8VP8T8yNclyCCK6UfY:APA91bFGQxiqku3K9LJEcQVCGrNh7CfYVB5aPBJAZpGc26x57trW8Zug8KLofrzwfclhkY5ca2-tRf22l-1YG4oldUMwtZ7cU4eu415Us1kODJBgmZiim3GvQ7o09jTYmjh5r5oDwaba',	'N/A',	'',	'8766',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(28,	'',	'9888854300',	'',	'dPQa-1zSQBiWSBAjRSENZ-:APA91bHmzpzGxb9UycUx3CiSGkwmZdJMZDqbSK4XvIp7puTs-iCWTdfdCEWUNunJqJqH7d--yj64EKmVjIslwWLxIOokBzCMRvJGMFakg2Hlh8i9-SUOt5CuPR-aJvQK86T5OmaxMFOk',	'N/A',	'',	'7552',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(29,	'',	'9875643125',	'',	'',	'N/A',	'',	'7984',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(30,	'',	'1234567895',	'',	'dsIVA-YcQaW7zHTgIUyqVq:APA91bHmHry2IqULEGZtl1C72zWagqpZUoKd1a82OJBU6ImvyIqzQsQ7hsqmgNP0e3mcJTc49jp35EOsICVZeOQClIrQyy2QCrTqiqfAGJNEfLDTxQaopsOtblJSvN0hCnPuqkI8cHyn',	'N/A',	'',	'5827',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(31,	'',	'9685999999',	'',	'cJBNXuSZRZ642-1R3l2s8y:APA91bG7TZwxlEZTobiw5UlLLLuzdyfOv_Y6ixs8eEFMjv3P0pqpdyA44UxIdt-Jx0eAvxNpyAaLWf2gz_o1COhjNDh1T-tNYku2pBnKCl1rhzVqAfm52CutKNc7LgDSGTH28JMiwMMx',	'N/A',	'',	'2633',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(32,	'',	'9632587415',	'',	'cJBNXuSZRZ642-1R3l2s8y:APA91bG7TZwxlEZTobiw5UlLLLuzdyfOv_Y6ixs8eEFMjv3P0pqpdyA44UxIdt-Jx0eAvxNpyAaLWf2gz_o1COhjNDh1T-tNYku2pBnKCl1rhzVqAfm52CutKNc7LgDSGTH28JMiwMMx',	'N/A',	'',	'5372',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(33,	'',	'9635587415',	'',	'cJBNXuSZRZ642-1R3l2s8y:APA91bG7TZwxlEZTobiw5UlLLLuzdyfOv_Y6ixs8eEFMjv3P0pqpdyA44UxIdt-Jx0eAvxNpyAaLWf2gz_o1COhjNDh1T-tNYku2pBnKCl1rhzVqAfm52CutKNc7LgDSGTH28JMiwMMx',	'N/A',	'',	'3201',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(34,	'',	'9635874485',	'',	'cJBNXuSZRZ642-1R3l2s8y:APA91bG7TZwxlEZTobiw5UlLLLuzdyfOv_Y6ixs8eEFMjv3P0pqpdyA44UxIdt-Jx0eAvxNpyAaLWf2gz_o1COhjNDh1T-tNYku2pBnKCl1rhzVqAfm52CutKNc7LgDSGTH28JMiwMMx',	'N/A',	'',	'9662',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(35,	'',	'+919663918',	'',	'e9zvh8N1TeWnJGmLwUwld4:APA91bE48DJWCdkQ4D0d8DfHC60uqbTHPcwiuUtUHojeWylYCfN4GfgcXVnMzdqomZTuK3M6CaHrrLit1Wl1LmwYpuveUF_7FSpGdToxq3JXCzeHF4g6sjFQKl-FAmB5cad9KZbStlg0',	'N/A',	'',	'1077',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(36,	'',	'9635887558',	'',	'cJBNXuSZRZ642-1R3l2s8y:APA91bG7TZwxlEZTobiw5UlLLLuzdyfOv_Y6ixs8eEFMjv3P0pqpdyA44UxIdt-Jx0eAvxNpyAaLWf2gz_o1COhjNDh1T-tNYku2pBnKCl1rhzVqAfm52CutKNc7LgDSGTH28JMiwMMx',	'N/A',	'',	'7601',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(37,	'',	'9915004995',	'',	'',	'N/A',	'',	'7101',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(38,	'Ranbir Singh',	'9876543211',	'',	'fMz9laSOSPGqz9E99o1p81:APA91bEu9YcGnu7eWdWjCgaWHfcLa7nJnP927pTW8uT7wQEswtoSfymGMH2cl-oPGWxjpMsYY_PchOXkq5cxyWb57NL2TYZXYRA4OTrBaNLtBhALbMFdVfS2or-XeBxQm5TuViuvDg1j',	'N/A',	'',	'5355',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00'),
(39,	'tedt',	'9622222222',	'',	'doKPN3VETPKeK64N4ajKI4:APA91bENVIUwy_gER-boZCBgNBC66jht6dvaauxnQB4cAg2pD0x2GhpVAfJjqVmkLV9arxjsfOGrN1247zbvv6cB70QYwt4jNfxoMPPmIgAjHWaV0TLDJy7xXtnMrhio-RPE79No2dfg',	'N/A',	'',	'3045',	NULL,	'1',	NULL,	1,	0,	0,	0,	2,	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `user_notification`;
CREATE TABLE `user_notification` (
  `noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `noti_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noti_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_by_user` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_notification` (`noti_id`, `user_id`, `noti_title`, `noti_message`, `read_by_user`, `created_at`) VALUES
(1,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 07:00 - 10:00.',	0,	'2021-05-10 19:44:38'),
(2,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 07:00 - 10:00.',	0,	'2021-05-10 19:47:16'),
(3,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 07:00 - 10:00.',	0,	'2021-05-10 19:51:19'),
(4,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #MSUG6940 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 07:00 - 10:00.',	0,	'2021-05-10 19:53:05'),
(5,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #YXLX85fc contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*2 of price rs 235 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 07:00 - 10:00.',	0,	'2021-05-10 19:58:50'),
(6,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #QMSL2390 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price rs 220 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 16:00 - 19:00.',	0,	'2021-05-11 10:05:39'),
(7,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #ACSO9265 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price rs 220 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 16:00 - 19:00.',	0,	'2021-05-11 12:39:04'),
(8,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #LKZI48c1 contains of Carrot(10000kg)*1,Onion(10000kg)*3 of price rs 255 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 16:00 - 19:00.',	0,	'2021-05-11 12:39:43'),
(9,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #HREM4695 contains of Plum(100000kg)*1,Grapes(10000kg)*1,Aashirvaad Atta with Multigrains(1000000kg)*1 of price rs 775 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-12 between 07:00 - 10:00.',	0,	'2021-05-11 12:40:15'),
(10,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #QTIO4740 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price rs 220 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 16:00 - 19:00.',	0,	'2021-05-11 12:41:15'),
(11,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #BDQU435a contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Onion(10000kg)*5 of price rs 430 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 19:00 - 22:00.',	0,	'2021-05-11 15:20:54'),
(12,	18,	'WooHoo! Your Order is Placed',	'Order Successfully Placed: Your order id #PYFW5577 contains of Carrot(10000kg)*8 of price rs 340 is placed Successfully.You can expect your item(s) will be delivered on 2021-05-11 between 19:00 - 22:00.',	0,	'2021-05-11 15:23:24'),
(13,	18,	'Out For Delivery',	'Out For Delivery: Your order id #QMSL2390 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price Rs 200 is Out For Delivery.Get ready with Rs 220 cash.',	0,	'2021-05-11 15:24:11'),
(14,	18,	'Out For Delivery',	'Out For Delivery: Your order id #QMSL2390 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price Rs 200 is Out For Delivery.Get ready with Rs 220 cash.',	0,	'2021-05-11 15:24:45'),
(15,	18,	'Out For Delivery',	'Out For Delivery: Your order id #PYFW5577 contains of Carrot(10000kg)*8 of price Rs 320 is Out For Delivery.Get ready with Rs 340 cash.',	0,	'2021-05-11 15:25:38'),
(16,	18,	'Order Delivered',	'Delivery Completed: Your order id #QMSL2390 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price Rs 200 is Delivered Successfully.',	0,	'2021-05-11 15:28:06'),
(17,	18,	'Order Delivered',	'Delivery Completed: Your order id #QMSL2390 contains of Carrot(10000kg)*1,Lady finger(10000kg)*1,Brinjal Green(10000kg)*1,Potato(10000kg)*1,Tomato(10000kg)*1,Onion(10000kg)*1 of price Rs 200 is Delivered Successfully.',	0,	'2021-05-11 15:29:03'),
(18,	19,	'test',	'test for Notification',	0,	'2021-07-23 17:03:59'),
(19,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-07-24 11:27:15'),
(20,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-07-28 13:16:56'),
(21,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-07-28 13:20:08'),
(22,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-07-28 13:22:22'),
(23,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-07-28 13:29:10'),
(24,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-07-28 16:28:19'),
(25,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-02 17:07:03'),
(26,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-02 17:24:06'),
(27,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-02 17:32:23'),
(28,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-02 17:35:39'),
(29,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-02 17:59:17'),
(30,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-04 11:47:02'),
(31,	28,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 08:00:33'),
(32,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 16:19:16'),
(33,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 16:47:40'),
(34,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 17:00:32'),
(35,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 17:16:01'),
(36,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 17:32:52'),
(37,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 17:53:31'),
(38,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 18:00:29'),
(39,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 18:26:11'),
(40,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-05 18:29:31'),
(41,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-06 13:01:57'),
(42,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-06 13:04:42'),
(43,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-06 17:31:48'),
(44,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 12:20:23'),
(45,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:29:26'),
(46,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:33:15'),
(47,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:41:30'),
(48,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:51:09'),
(49,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:52:27'),
(50,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:53:19'),
(51,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:54:55'),
(52,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:55:00'),
(53,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 13:56:19'),
(54,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 14:06:08'),
(55,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 14:17:19'),
(56,	34,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-10 17:27:18'),
(57,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-12 19:16:58'),
(58,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-13 09:58:02'),
(59,	18,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(60,	19,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(61,	20,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(62,	21,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(63,	22,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(64,	23,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(65,	24,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(66,	25,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(67,	26,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(68,	27,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(69,	28,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(70,	29,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(71,	30,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(72,	31,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(73,	32,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(74,	33,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(75,	34,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(76,	35,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(77,	36,	'test',	'test',	0,	'2021-08-13 10:05:38'),
(78,	18,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(79,	19,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(80,	20,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(81,	21,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(82,	22,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(83,	23,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(84,	24,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(85,	25,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(86,	26,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(87,	27,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(88,	28,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(89,	29,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(90,	30,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(91,	31,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(92,	32,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(93,	33,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(94,	34,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(95,	35,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(96,	36,	'hjkjk',	'uiiuiu',	0,	'2021-08-13 19:37:22'),
(97,	18,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(98,	19,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(99,	20,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(100,	21,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(101,	22,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(102,	23,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(103,	24,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(104,	25,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(105,	26,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(106,	27,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(107,	28,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(108,	29,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(109,	30,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(110,	31,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(111,	32,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(112,	33,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(113,	34,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(114,	35,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(115,	36,	'ttttt',	'kkkk',	0,	'2021-08-16 09:58:26'),
(116,	18,	'New Order',	'Your Order Successfully Cancel',	0,	'2021-08-16 09:59:48'),
(117,	18,	'New Order',	'Your Order Successfully Cancel',	0,	'2021-08-16 10:00:06'),
(118,	18,	'New Order',	'Your Order Successfully Cancel',	0,	'2021-08-16 10:00:08'),
(119,	20,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(120,	18,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(121,	23,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(122,	28,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(123,	30,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(124,	35,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(125,	19,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(126,	27,	'dsd',	'adasd',	0,	'2021-08-16 10:12:19'),
(127,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-18 11:44:59'),
(128,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-18 12:10:04'),
(129,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-18 12:17:59'),
(130,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-18 16:32:36'),
(131,	38,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-19 17:23:42'),
(132,	38,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-19 17:27:18'),
(133,	38,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-20 10:31:30'),
(134,	38,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-23 12:31:05'),
(135,	38,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-23 12:45:49'),
(136,	18,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-24 14:28:32'),
(137,	19,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-24 18:19:57'),
(138,	38,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-25 15:21:08'),
(139,	38,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-25 15:21:43'),
(140,	28,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-25 15:37:14'),
(141,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-26 14:03:41'),
(142,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-26 14:30:16'),
(143,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-26 14:57:31'),
(144,	18,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-26 15:14:55'),
(145,	18,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-26 15:20:08'),
(146,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-26 15:34:20'),
(147,	18,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-26 15:34:47'),
(148,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-26 16:26:58'),
(149,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-26 16:28:09'),
(150,	38,	'Your Order is rejected',	'Your Order is rejected',	0,	'2021-08-27 12:06:11'),
(151,	38,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-08-27 12:10:43'),
(152,	38,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-08-27 12:13:55'),
(153,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-27 12:40:25'),
(154,	18,	'New Order',	'Your Order Successfully Canceled',	0,	'2021-08-27 15:21:20'),
(155,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-27 15:36:06'),
(156,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-27 15:36:45'),
(157,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-27 15:40:53'),
(158,	18,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-08-27 16:29:19'),
(159,	18,	'New Order',	'Your Order Successfully Canceled',	0,	'2021-08-30 13:06:15'),
(160,	18,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-08-30 14:07:06'),
(161,	18,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-08-31 16:09:33'),
(162,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-31 16:32:31'),
(163,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-31 16:33:44'),
(164,	18,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-08-31 16:34:49'),
(165,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-31 16:40:01'),
(166,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-31 16:42:54'),
(167,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-31 17:41:45'),
(168,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-08-31 17:43:13'),
(169,	19,	'You have request for order Delivery',	'You have request for order delivery please accept if you are ready',	0,	'2021-08-31 17:48:16'),
(170,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:09:08'),
(171,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:13:41'),
(172,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:16:14'),
(173,	18,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-09-01 10:18:31'),
(174,	18,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-09-01 10:18:49'),
(175,	19,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-09-01 10:19:04'),
(176,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:24:02'),
(177,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:46:05'),
(178,	18,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:49:09'),
(179,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:54:59'),
(180,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 10:59:41'),
(181,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 11:07:09'),
(182,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 11:10:35'),
(183,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 11:11:34'),
(184,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 11:12:38'),
(185,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 11:13:34'),
(186,	19,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 11:15:14'),
(187,	19,	'Your Order is accepted',	'Your Order is rejected by store',	0,	'2021-09-01 11:17:53'),
(188,	38,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-01 16:26:22'),
(189,	38,	'Your Order is accepted',	'Your Order is accepted by store',	0,	'2021-09-01 16:44:15'),
(190,	38,	'New Order',	'Your Order Successfully Canceled',	0,	'2021-09-03 11:06:52'),
(191,	38,	'New Order',	'Your Order Place Successfully',	0,	'2021-09-03 11:09:26'),
(192,	38,	'Your Order is accepted',	'Your Order is accepted by store',	0,	'2021-09-03 11:09:41'),
(193,	18,	'Your Order is accepted',	'Your Order is accepted by store',	0,	'2021-09-03 11:11:45');

DROP TABLE IF EXISTS `wallet_recharge_history`;
CREATE TABLE `wallet_recharge_history` (
  `wallet_recharge_history` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `recharge_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` float NOT NULL,
  `date_of_recharge` date NOT NULL,
  PRIMARY KEY (`wallet_recharge_history`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wallet_recharge_history` (`wallet_recharge_history`, `user_id`, `recharge_status`, `amount`, `date_of_recharge`) VALUES
(1,	18,	'failed',	5,	'2021-05-11');

DROP TABLE IF EXISTS `web_banner`;
CREATE TABLE `web_banner` (
  `banner_id` int(100) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2021-09-09 06:27:40
