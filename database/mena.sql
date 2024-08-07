-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2021 at 06:22 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mena`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(80) NOT NULL,
  `PhoneCode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `PhoneCode`) VALUES
(1, 'Afghanistan', 93),
(2, 'Albania', 355),
(3, 'Algeria', 213),
(4, 'American Samoa', 1684),
(5, 'Andorra', 376),
(6, 'Angola', 244),
(7, 'Anguilla', 1264),
(8, 'Antarctica', 0),
(9, 'Antigua and Barbuda', 1268),
(10, 'Argentina', 54),
(11, 'Armenia', 374),
(12, 'Aruba', 297),
(13, 'Australia', 61),
(14, 'Austria', 43),
(15, 'Azerbaijan', 994),
(16, 'Bahamas', 1242),
(17, 'Bahrain', 973),
(18, 'Bangladesh', 880),
(19, 'Barbados', 1246),
(20, 'Belarus', 375),
(21, 'Belgium', 32),
(22, 'Belize', 501),
(23, 'Benin', 229),
(24, 'Bermuda', 1441),
(25, 'Bhutan', 975),
(26, 'Bolivia', 591),
(27, 'Bosnia and Herzegovina', 387),
(28, 'Botswana', 267),
(29, 'Bouvet Island', 0),
(30, 'Brazil', 55),
(31, 'British Indian Ocean Territory', 246),
(32, 'Brunei Darussalam', 673),
(33, 'Bulgaria', 359),
(34, 'Burkina Faso', 226),
(35, 'Burundi', 257),
(36, 'Cambodia', 855),
(37, 'Cameroon', 237),
(38, 'Canada', 1),
(39, 'Cape Verde', 238),
(40, 'Cayman Islands', 1345),
(41, 'Central African Republic', 236),
(42, 'Chad', 235),
(43, 'Chile', 56),
(44, 'China', 86),
(45, 'Christmas Island', 61),
(46, 'Cocos (Keeling) Islands', 672),
(47, 'Colombia', 57),
(48, 'Comoros', 269),
(49, 'Congo', 242),
(50, 'Congo, the Democratic Republic of the', 242),
(51, 'Cook Islands', 682),
(52, 'Costa Rica', 506),
(53, 'Cote D\'Ivoire', 225),
(54, 'Croatia', 385),
(55, 'Cuba', 53),
(56, 'Cyprus', 357),
(57, 'Czech Republic', 420),
(58, 'Denmark', 45),
(59, 'Djibouti', 253),
(60, 'Dominica', 1767),
(61, 'Dominican Republic', 1809),
(62, 'Ecuador', 593),
(63, 'Egypt', 20),
(64, 'El Salvador', 503),
(65, 'Equatorial Guinea', 240),
(66, 'Eritrea', 291),
(67, 'Estonia', 372),
(68, 'Ethiopia', 251),
(69, 'Falkland Islands (Malvinas)', 500),
(70, 'Faroe Islands', 298),
(71, 'Fiji', 679),
(72, 'Finland', 358),
(73, 'France', 33),
(74, 'French Guiana', 594),
(75, 'French Polynesia', 689),
(76, 'French Southern Territories', 0),
(77, 'Gabon', 241),
(78, 'Gambia', 220),
(79, 'Georgia', 995),
(80, 'Germany', 49),
(81, 'Ghana', 233),
(82, 'Gibraltar', 350),
(83, 'Greece', 30),
(84, 'Greenland', 299),
(85, 'Grenada', 1473),
(86, 'Guadeloupe', 590),
(87, 'Guam', 1671),
(88, 'Guatemala', 502),
(89, 'Guinea', 224),
(90, 'Guinea-Bissau', 245),
(91, 'Guyana', 592),
(92, 'Haiti', 509),
(93, 'Heard Island and Mcdonald Islands', 0),
(94, 'Holy See (Vatican City State)', 39),
(95, 'Honduras', 504),
(96, 'Hong Kong', 852),
(97, 'Hungary', 36),
(98, 'Iceland', 354),
(99, 'India', 91),
(100, 'Indonesia', 62),
(101, 'Iran, Islamic Republic of', 98),
(102, 'Iraq', 964),
(103, 'Ireland', 353),
(104, 'Israel', 972),
(105, 'Italy', 39),
(106, 'Jamaica', 1876),
(107, 'Japan', 81),
(108, 'Jordan', 962),
(109, 'Kazakhstan', 7),
(110, 'Kenya', 254),
(111, 'Kiribati', 686),
(112, 'Korea, Democratic People\'s Republic of', 850),
(113, 'Korea, Republic of', 82),
(114, 'Kuwait', 965),
(115, 'Kyrgyzstan', 996),
(116, 'Lao People\'s Democratic Republic', 856),
(117, 'Latvia', 371),
(118, 'Lebanon', 961),
(119, 'Lesotho', 266),
(120, 'Liberia', 231),
(121, 'Libyan Arab Jamahiriya', 218),
(122, 'Liechtenstein', 423),
(123, 'Lithuania', 370),
(124, 'Luxembourg', 352),
(125, 'Macao', 853),
(126, 'Macedonia, the Former Yugoslav Republic of', 389),
(127, 'Madagascar', 261),
(128, 'Malawi', 265),
(129, 'Malaysia', 60),
(130, 'Maldives', 960),
(131, 'Mali', 223),
(132, 'Malta', 356),
(133, 'Marshall Islands', 692),
(134, 'Martinique', 596),
(135, 'Mauritania', 222),
(136, 'Mauritius', 230),
(137, 'Mayotte', 269),
(138, 'Mexico', 52),
(139, 'Micronesia, Federated States of', 691),
(140, 'Moldova, Republic of', 373),
(141, 'Monaco', 377),
(142, 'Mongolia', 976),
(143, 'Montserrat', 1664),
(144, 'Morocco', 212),
(145, 'Mozambique', 258),
(146, 'Myanmar', 95),
(147, 'Namibia', 264),
(148, 'Nauru', 674),
(149, 'Nepal', 977),
(150, 'Netherlands', 31),
(151, 'Netherlands Antilles', 599),
(152, 'New Caledonia', 687),
(153, 'New Zealand', 64),
(154, 'Nicaragua', 505),
(155, 'Niger', 227),
(156, 'Nigeria', 234),
(157, 'Niue', 683),
(158, 'Norfolk Island', 672),
(159, 'Northern Mariana Islands', 1670),
(160, 'Norway', 47),
(161, 'Oman', 968),
(162, 'Pakistan', 92),
(163, 'Palau', 680),
(164, 'Palestinian Territory, Occupied', 970),
(165, 'Panama', 507),
(166, 'Papua New Guinea', 675),
(167, 'Paraguay', 595),
(168, 'Peru', 51),
(169, 'Philippines', 63),
(170, 'Pitcairn', 0),
(171, 'Poland', 48),
(172, 'Portugal', 351),
(173, 'Puerto Rico', 1787),
(174, 'Qatar', 974),
(175, 'Reunion', 262),
(176, 'Romania', 40),
(177, 'Russian Federation', 70),
(178, 'Rwanda', 250),
(179, 'Saint Helena', 290),
(180, 'Saint Kitts and Nevis', 1869),
(181, 'Saint Lucia', 1758),
(182, 'Saint Pierre and Miquelon', 508),
(183, 'Saint Vincent and the Grenadines', 1784),
(184, 'Samoa', 684),
(185, 'San Marino', 378),
(186, 'Sao Tome and Principe', 239),
(187, 'Saudi Arabia', 966),
(188, 'Senegal', 221),
(189, 'Serbia and Montenegro', 381),
(190, 'Seychelles', 248),
(191, 'Sierra Leone', 232),
(192, 'Singapore', 65),
(193, 'Slovakia', 421),
(194, 'Slovenia', 386),
(195, 'Solomon Islands', 677),
(196, 'Somalia', 252),
(197, 'South Africa', 27),
(198, 'South Georgia and the South Sandwich Islands', 0),
(199, 'Spain', 34),
(200, 'Sri Lanka', 94),
(201, 'Sudan', 249),
(202, 'Suriname', 597),
(203, 'Svalbard and Jan Mayen', 47),
(204, 'Swaziland', 268),
(205, 'Sweden', 46),
(206, 'Switzerland', 41),
(207, 'Syrian Arab Republic', 963),
(208, 'Taiwan, Province of China', 886),
(209, 'Tajikistan', 992),
(210, 'Tanzania, United Republic of', 255),
(211, 'Thailand', 66),
(212, 'Timor-Leste', 670),
(213, 'Togo', 228),
(214, 'Tokelau', 690),
(215, 'Tonga', 676),
(216, 'Trinidad and Tobago', 1868),
(217, 'Tunisia', 216),
(218, 'Turkey', 90),
(219, 'Turkmenistan', 7370),
(220, 'Turks and Caicos Islands', 1649),
(221, 'Tuvalu', 688),
(222, 'Uganda', 256),
(223, 'Ukraine', 380),
(224, 'United Arab Emirates', 971),
(225, 'United Kingdom', 44),
(226, 'United States', 1),
(227, 'United States Minor Outlying Islands', 1),
(228, 'Uruguay', 598),
(229, 'Uzbekistan', 998),
(230, 'Vanuatu', 678),
(231, 'Venezuela', 58),
(232, 'Viet Nam', 84),
(233, 'Virgin Islands, British', 1284),
(234, 'Virgin Islands, U.s.', 1340),
(235, 'Wallis and Futuna', 681),
(236, 'Western Sahara', 212),
(237, 'Yemen', 967),
(238, 'Zambia', 260),
(239, 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_06_113213_create_telr_transactions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('basitawan.abdul@gmail.com', '$2y$10$9Rafy6KL9JP53wQ2rRHnie0IPFuViHZue3DDD50xiz2chvAOLr6SW', '2021-07-06 03:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `balance` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `package_name`, `amount`, `status`, `expiry_date`, `balance`, `user_id`, `date_created`, `date_modified`) VALUES
(1, 'Gold', 10, 1, '2021-07-31', 10, 1, '2021-07-07 12:24:30', '2021-07-07 12:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `cart_id` varchar(63) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The unique cart id to be submit for telr',
  `order_id` int(11) DEFAULT NULL COMMENT 'Should be the foreign key for items',
  `store_id` int(11) NOT NULL COMMENT 'Map to ivp_store',
  `test_mode` tinyint(1) NOT NULL DEFAULT '0',
  `amount` decimal(8,2) NOT NULL COMMENT 'Map to ivp_amount the total or purchase',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description should be limit to 64',
  `success_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The success URL',
  `canceled_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The canceled URL',
  `declined_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The declined URL',
  `billing_fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing first name',
  `billing_sname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing sur name',
  `billing_address_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing address 1',
  `billing_address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing address 2',
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing city',
  `billing_region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing region',
  `billing_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing zip',
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing country',
  `billing_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Billing email',
  `lang_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Transaction Request lang',
  `trx_reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The transaction reference',
  `approved` tinyint(1) DEFAULT NULL COMMENT 'The transaction status is approved or failed',
  `response` json DEFAULT NULL COMMENT 'The transaction response',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The transaction status is updated or not',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `company_name`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `address`, `country`, `mobile`, `office`) VALUES
(1, 'Abdul', 'basitawan.abdul@gmail.com', 'Accrual Group', NULL, '$2y$10$x8ZrLSOPU6tJGgblIDGkJepgF6KqsVDtVK27J3pIt8y7s0fhY..M2', NULL, '2021-07-02 02:27:23', '2021-07-02 02:27:23', 'office 2/19 RWP', 162, '03115818727', '03115818727'),
(2, '123', '123@123.com', NULL, NULL, '$2y$10$9UyN4i/y1qGSsfqmm76hy..lCOnvbcTztivlXXbwt1X5Nk8DsK./m', NULL, '2021-07-02 04:04:31', '2021-07-02 04:04:31', NULL, NULL, NULL, NULL),
(3, 'Abdul Basit', 'abdul.basit@accrualgroup.com', NULL, NULL, '$2y$10$pG0I40pwl2YtyztMu0BS1.qOdztaHq0FhFTGXgHf3TrweRXIgHJvC', NULL, '2021-07-05 03:38:40', '2021-07-05 03:38:40', NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
