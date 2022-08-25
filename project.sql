-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2022 at 08:28 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessibilities`
--

DROP TABLE IF EXISTS `accessibilities`;
CREATE TABLE IF NOT EXISTS `accessibilities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accessibilities`
--

INSERT INTO `accessibilities` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 'مدیریت آگهی ها', '', NULL, NULL),
(2, 'ثبت آگهی جدید', '', NULL, NULL),
(3, 'مدیریت کوپن ها', '', NULL, NULL),
(4, 'ثبت کوپن جدید', '', NULL, NULL),
(5, 'مدیریت کاربران', '', NULL, NULL),
(6, 'ثبت کاربران جدید', '', NULL, NULL),
(7, 'داشبورد', '', NULL, NULL),
(8, 'مدیریت نقش ها', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_08_15_133758_create_offers_table', 1),
(5, '2022_08_15_134206_create_offer_packages_table', 1),
(6, '2022_08_15_134442_create_orders_table', 1),
(7, '2022_08_15_134834_create_user_offers_table', 1),
(8, '2022_08_15_135215_create_products_table', 1),
(9, '2022_08_15_140422_create_roles_table', 1),
(10, '2022_08_15_141814_create_accessibilities_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 create 1 accept 2 cancel 3 payed',
  `pay_date` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `pro_id` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `user_id`, `pro_id`, `price`, `status`, `pay_date`, `created_at`, `updated_at`) VALUES
(1, 6, 3, '25000000', '3', '1401-05-29 14:33:56', '2022-08-18 08:14:42', '2022-08-18 08:14:42'),
(2, 3, 3, '27000000', '0', '0000-00-00 00:00:00', '2022-08-18 09:34:47', '2022-08-19 19:43:56'),
(3, 6, 5, '1800000', '0', '0000-00-00 00:00:00', '2022-08-22 07:38:47', '2022-08-22 07:38:47'),
(5, 8, 4, '3000000', '3', '1401-05-31 13:04:49', '2022-08-22 08:14:12', '2022-08-22 08:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `offer_packages`
--

DROP TABLE IF EXISTS `offer_packages`;
CREATE TABLE IF NOT EXISTS `offer_packages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qui` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'number of offers',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 create 1 payed 2 fail_pay',
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 create 1 register 2 sending',
  `cellphone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offer_id` (`offer_id`),
  KEY `buyer_id` (`buyer_id`),
  KEY `seller_id` (`seller_id`),
  KEY `pro_id` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `buyer_id`, `seller_id`, `pro_id`, `offer_id`, `price`, `pay_status`, `status`, `cellphone`, `address`, `created_at`, `updated_at`) VALUES
(1, 6, 3, 3, 1, '25000000', '1', '2', '09369632111', 'یزد ، قاسم آباد ، خیابان فروغ ، کوچه فروغ', '2022-08-20 07:40:17', '2022-08-21 16:50:03'),
(3, 8, 3, 4, 5, '3000000', '1', '2', '09171586584', 'یزد', '2022-08-22 08:15:27', '2022-08-22 08:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attrs` json NOT NULL,
  `created_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 create 1 select 2 sailed 3 send',
  `from_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '120 min',
  `is_delete` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `created_id` (`created_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `image`, `body`, `price`, `attrs`, `created_id`, `status`, `from_date`, `to_date`, `pay_date`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Facilis velit corpor', 'facilis-velit-corpor', 'images/products/22_08_16_09_49_55_25.jpg', 'Non quia cum est aut', '864', '[{\"key\": \"vdvd\", \"value\": \"vdsvs\"}]', 1, '0', '01-Oct-1993', '06-Jan-1977', '13-Oct-2018', '1', '2022-08-16 05:19:58', '2022-08-16 14:54:33'),
(2, 'قالیچه حضرت سلیمان', 'kalychh-hdrt-slyman', 'images/products/22_08_16_10_09_42_611.jpg', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', '65000000', '[{\"key\": \"جنس\", \"value\": \"عالی\"}, {\"key\": \"رنگ\", \"value\": \"7 رنگ\"}]', 1, '0', '1401-05-25 00:00:00', '1401-05-27 00:00:00', '20', '0', '2022-08-16 05:39:44', '2022-08-16 05:39:44'),
(3, 'گوشی A40', 'goshy-a40', 'images/products/22_08_16_10_12_19_913.jpg', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', '2000000', '[{\"key\": \"رنگ\", \"value\": \"آبی\"}]', 3, '3', '1401-05-25 00:00:00', '1401-05-28 00:00:00', '20', '0', '2022-08-16 05:42:20', '2022-08-21 16:59:24'),
(4, 'کوزه هخامنشی', 'kozh-hkhamnshy', 'default.png', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', '2000000', '[{\"key\": \"زمان ساخت\", \"value\": \"1500 سال پیش\"}]', 3, '3', '1401-05-25 00:00:00', '1401-05-31 12:00:00', '20', '0', '2022-08-16 05:45:28', '2022-08-22 08:26:32'),
(5, 'آینه بغل کوییک', 'aynh-bghl-koyyk', 'images/products/22_08_21_10_36_08_395.jpg', 'یکی از مهم‌ترین اجزایی که تاثیر زیادی در حفظ امنیت خودرو و مسافران دارد؛تمامی خودروها در طرفین خود دارای دو آینه هستند که راننده از آنها برای بررسی وضعیت اطراف و انتهای خودرو استفاده می‌کند. با وجود این دو آینه، آمار تصادفات بسیار کاهش یافته. آینه بغل تاشو سمت راست (شاگرد) و چپ (شاگرد) مناسب برای انواع پراید.', '1500000', '[{\"key\": \"رنگبندی\", \"value\": \"دارد\"}, {\"key\": \"جنس\", \"value\": \"پلاستیک\"}, {\"key\": \"اندازه\", \"value\": \"20*65*10\"}]', 8, '0', '1401-05-30 22:40', '1401-05-31 22:40', '30', '0', '2022-08-21 18:06:08', '2022-08-21 18:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_id` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `access_id`, `created_at`, `updated_at`) VALUES
(1, 'مدیر سایت', '[{\"access_id\": 7, \"access_route\": [\"admin.dashboard\"], \"access_title\": \"داشبورد\"}, {\"access_id\": 8, \"access_route\": [\"admin.roles\", \"admin.create.role\"], \"access_title\": \"مدیریت نقش ها\"}, {\"access_id\": \"1\", \"access_route\": [\"admin.products\", \"admin.delete.product\"], \"access_title\": \"مدیریت آگهی ها\"}, {\"access_id\": \"2\", \"access_route\": [\"admin.create.product\", \"admin.form.product\"], \"access_title\": \"ثبت آگهی جدید\"}, {\"access_id\": \"3\", \"access_route\": [\"\"], \"access_title\": \"مدیریت کوپن ها\"}, {\"access_id\": \"4\", \"access_route\": [\"\"], \"access_title\": \"ثبت کوپن جدید\"}, {\"access_id\": \"5\", \"access_route\": [\"admin.users\", \"admin.delete.user\"], \"access_title\": \"مدیریت کاربران\"}, {\"access_id\": \"6\", \"access_route\": [\"admin.form.user\", \"admin.create.user\"], \"access_title\": \"ثبت کاربران جدید\"}]', NULL, NULL),
(2, 'کاربر عادی', '[{\"access_id\": 0, \"access_title\": \"کاربر عادی\"}]', NULL, NULL),
(9, 'ناظر آگهی', '[{\"access_id\": 7, \"access_route\": [\"admin.dashboard\"], \"access_title\": \"داشبورد\"}, {\"access_id\": \"1\", \"access_route\": [\"admin.products\", \"admin.delete.product\"], \"access_title\": \"مدیریت آگهی ها\"}, {\"access_id\": \"2\", \"access_route\": [\"admin.create.product\", \"admin.form.product\"], \"access_title\": \"ثبت آگهی جدید\"}]', '2022-08-22 07:14:54', '2022-08-22 07:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cellphone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `cellphone`, `offer`, `role_id`, `remember_token`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'سید محمد هادی مرتضوی', 'msmhm7613@gmail.com', '$2y$10$VS1xlrnrvqPvzl02QwVbTOXMl30i9ZIfoa3rezvd6tTsUmPhE0Rm6', '09140691429', '10', 1, NULL, 1, '2022-08-17 02:31:52', '2022-08-17 02:31:52'),
(2, 'علی دهقان', 'ali@gmail.com', '$2y$10$6mkD3NLIgDKiPJcj0Hw1V.AgUL3yGSsmRrht4F8pY8UjF1poYYnYO', '09137499327', '9', 9, NULL, 1, '2022-08-17 02:43:23', '2022-08-18 08:14:42'),
(3, 'محسن رضوی', 'mohsen@gmail.com', '$2y$10$NzRrftxkAEzmyrpNEtAg1OvpkE2pt9nPCS6e2FrRvVHZnGdLaDTuq', '09131583568', '9', 2, 'tSmIhC8ErwwHh6V4RuUJT0sKUGKEKI09VxHxKVEECHn2OymTk8pMZc0MANE4', 1, '2022-08-17 03:25:38', '2022-08-18 09:34:48'),
(4, 'داوود قرقچیان', 'davood@gmail.com', '$2y$10$xO0QHivfgRzcQHuojEvDeOnov0lfpUJ5pnQK0X3lvEnaHv8JdT4FW', '09133581698', '10', 2, 'MrHAMjRd0OsLrYcBu0eIkdeyuLuvMrQUep28btGF78vnozMRQrttMEgpMATnaMSHJxCIW7MgPdTNP2Y1iQyiUly5e8kH9dq2b3zI', 1, '2022-08-17 03:41:58', '2022-08-17 03:41:58'),
(5, 'احسان علی زاده', 'ehsan@gmail.com', '$2y$10$jsKEEn6GZcp4KUR6dutaousBJThLCUbCOdzNcE4wk1H2HBRS1t91G', '09131356423', '10', 2, '4dnQ3JYs8X0DUQzxgYgty5jhOVZ3ZZmkJbszLUUnxLF4MjL9XCtDiXM9k5ESE82MyiOUaBnwagfRBNE1G7kuUJqjaDIMsriNiWqO', 1, '2022-08-17 03:48:24', '2022-08-17 03:48:24'),
(6, 'محمد هاشمی', 'mohammad@gmail.com', '$2y$10$a6inuwKqsdtqUFdvxmcZEePNbF7J/WwG/v4lFRl/ARIK2JgBLJFL2', '09369632111', '8', 2, 'HXCfDsOfYyMcSiYkumYuttafJj1z9CF3Qm2Y7BJ7ciOPmvdRXFgQCvBJJ5xc', 1, '2022-08-17 06:12:04', '2022-08-22 07:38:47'),
(8, 'محسن طاهری', 'mo@gmail.com', '$2y$10$9C4zj8cOALp8v9FuQnEuj.VK4LR053CwQ9F3CpnpJde0P3sExZwXa', '09163546556', '8', 2, 'hmPah4Zb0iLzXMUDYXIAS6chNW8F33REugF6kKNAURmCfPh6b39oqLRyyZu3', 1, '2022-08-21 17:31:00', '2022-08-22 08:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_offers`
--

DROP TABLE IF EXISTS `user_offers`;
CREATE TABLE IF NOT EXISTS `user_offers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pkg_id` bigint(20) UNSIGNED NOT NULL,
  `pay_status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 create 1 payed 2 fail_pay',
  `trans_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 not payed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_offers_user_id_foreign` (`user_id`),
  KEY `user_offers_pkg_id_foreign` (`pkg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
