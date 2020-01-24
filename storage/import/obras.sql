-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2017 at 03:50 PM
-- Server version: 10.2.7-MariaDB-10.2.7+maria~xenial-log
-- PHP Version: 7.1.11-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obras`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `zip` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(72) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `state_id`, `city_id`, `zip`, `district`, `street`, `number`, `complement`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 18, 2869, '80740000', 'Seminário', 'Rua General Mario Tourinho', '1805', NULL, '2017-10-28 17:25:49', '2017-10-28 17:25:49', NULL),
(2, 18, 2869, '80740000', 'Seminário', 'Rua General Mario Tourinho', '1805', NULL, '2017-10-28 17:26:47', '2017-10-28 17:26:47', NULL),
(3, 26, 8503, '13564002', 'Parque Arnold Schimidt', 'Av. Francisco Pereira Lopes', 'sn', 'Sala 30-Passeio São Carlos', '2017-10-28 17:33:02', '2017-10-28 17:33:02', NULL),
(4, 26, 8503, '13564002', 'Parque Arnold Schimidt', 'Av. Francisco Pereira Lopes', 'sn', 'Sala 30-Passeio São Carlos', '2017-10-28 17:34:38', '2017-10-28 17:34:38', NULL),
(5, 26, 8966, '05657000', 'Fazenda Morumbi', 'Av. Dona Maria Mesquita de Mota e Silva', '17', NULL, '2017-10-28 17:58:27', '2017-10-28 17:58:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TIGRE', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(2, 'ELUMA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(3, 'RAMO CONEXÕES', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(4, 'GERDAU', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(5, 'BLUKIT', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(6, 'BISNAGA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(7, 'OTTO BAUMGART', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(8, 'SCHENEIDER', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(9, 'STECK', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(10, 'VOTORAN', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `cpf` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rg` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT 0,
  `birthday` date DEFAULT NULL,
  `cnpj` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ie` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isention_ie` tinyint(1) NOT NULL DEFAULT 0,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fantasy_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foundation` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `contact_id`, `address_id`, `type`, `cpf`, `rg`, `name`, `sex`, `birthday`, `cnpj`, `ie`, `isention_ie`, `company_name`, `fantasy_name`, `foundation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, 0, NULL, '28373422000121', NULL, 1, 'Lake Academia de Ginastica Ltda', 'Lake Academia', '2017-01-02', '2017-10-28 17:25:49', '2017-10-28 17:25:49', NULL),
(2, 2, 3, 1, NULL, NULL, NULL, 0, NULL, '23383105000172', NULL, 1, 'Hempere Academia de Musculação Ltda-EPP', 'Hempere Academia de Musculação', '2015-10-01', '2017-10-28 17:33:02', '2017-10-28 17:33:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collaborators`
--

CREATE TABLE IF NOT EXISTS `collaborators` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collaborators`
--

INSERT INTO `collaborators` (`id`, `user_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'TESTANDO USER GERENTE', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(2, 2, 'TESTANDO USER COORDENADOR', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(3, 3, 'TESTANDO USER COMPRADOR', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(4, 4, 'TESTANDO USER FINANCEIRO', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(5, 5, 'PRIMEIRO USER', '2017-10-30 03:45:10', '2017-10-30 03:45:10', NULL),
(6, 6, 'Glauco teste', '2017-10-30 03:45:10', '2017-10-30 03:45:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellphone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `phone`, `cellphone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, '2017-10-28 17:25:49', '2017-10-28 17:25:49', NULL),
(2, NULL, NULL, '2017-10-28 17:33:02', '2017-10-28 17:33:02', NULL),
(3, NULL, NULL, '2017-10-28 17:58:27', '2017-10-28 17:58:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CIVIL', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(2, 'HIDRÁULICA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(3, 'ELÉTRICA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(4, 'MARCENARIA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(5, 'PINTURA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(6, 'GRANITOS', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(7, 'VIDROS', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(8, 'GESSO', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(9, 'FERRAMENTAS', '2017-11-09 13:16:42', '2017-11-09 13:16:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `unit_id`, `name`, `descriptions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Implantação Franquia', 'Implantação Franquia "Chave na mão"', '2017-10-28 17:27:10', '2017-10-28 17:27:10', NULL),
(2, 2, 'Amp. Sala Ginastica', 'Construção de Mezanino para ampliação da academia com implantação da Sala de Ginástica e Shape', '2017-10-28 17:36:29', '2017-10-28 17:36:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metric_units`
--

CREATE TABLE IF NOT EXISTS `metric_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metric_units`
--

INSERT INTO `metric_units` (`id`, `code`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kg', 'KILO', '2016-12-07 20:38:42', '2017-10-28 18:10:30', NULL),
(2, 'm', 'METRO', '2016-12-07 20:38:42', '2017-10-28 18:10:39', NULL),
(3, 'cm', 'CENTÍMETRO', '2016-12-07 20:38:42', '2017-10-28 18:10:08', NULL),
(4, 'L', 'LITRO', '2016-12-07 20:38:42', NULL, NULL),
(5, 'ml', 'MILILITRO', '2016-12-07 20:38:42', '2017-10-28 18:10:50', NULL),
(7, 'mês', 'MÊS', '2016-12-07 20:38:42', '2017-10-28 18:11:01', NULL),
(8, 'h', 'HORA', '2016-12-07 20:38:42', '2017-10-28 18:10:18', NULL),
(9, 'und', 'UNIDADE', '2016-12-07 20:38:42', '2017-10-28 18:11:11', NULL),
(10, 'sc', 'SACO', '2017-10-28 18:11:29', '2017-10-28 18:11:29', NULL),
(11, 'vb', 'VERBA', '2017-10-28 18:12:01', '2017-10-28 18:12:01', NULL),
(12, 'pç', 'PEÇA', '2017-10-28 18:12:11', '2017-10-28 18:12:11', NULL),
(13, 'br-6', 'BARRA 6 METROS', '2017-10-28 18:17:04', '2017-10-28 18:17:04', NULL),
(14, 'gl', 'GALÃO', '2017-11-09 13:58:02', '2017-11-09 13:58:22', NULL),
(15, 'br-3', 'BARRA 3 METROS', '2017-11-09 15:25:24', '2017-11-09 15:25:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('silva.zanin@gmail.com', '$2y$10$QkpXKf/r/d1IQZaXEyc2oex6s7ko5ZBfbTgl8OcuBWeuia4ZUFeC6', '2017-10-30 03:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `product_id`, `filename`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, '3b308a3ee9e4e9e717cde2b0db049cf7.jpg', 1, '2017-10-28 18:16:30', '2017-10-28 18:16:30'),
(2, 2, '3a3fe9bb60ec1ec2a9050ddff0a79e44.jpg', 1, '2017-10-28 18:19:00', '2017-10-28 18:19:00'),
(3, 3, 'f28b74c0de38119f3483736a88a99199.jpg', 1, '2017-10-28 18:28:15', '2017-10-28 18:28:15'),
(4, 4, 'd554436c34d91d72f5b245d11e104679.jpg', 1, '2017-11-09 13:24:05', '2017-11-09 13:24:05'),
(5, 5, 'bda81f33d499767d82adcf11daf44c3f.jpg', 1, '2017-11-09 13:27:14', '2017-11-09 13:27:14'),
(6, 6, 'ccdb5662b20d031ee6275e20502f2e9a.jpg', 1, '2017-11-09 13:31:44', '2017-11-09 13:31:44'),
(7, 7, 'c83c60b0bf20d0e099425f75d501ba7b.jpg', 1, '2017-11-09 13:33:13', '2017-11-09 13:33:13'),
(8, 8, '5e55f822210b8d0634caf21b1c13ca1a.jpg', 1, '2017-11-09 13:57:16', '2017-11-09 13:57:16'),
(9, 9, 'ce6881456dc07bcbb635f1e5bed90738.jpg', 1, '2017-11-09 14:06:47', '2017-11-09 14:06:47'),
(10, 10, '62849d4ce2516232466ffab32a64a81a.jpg', 1, '2017-11-09 14:19:35', '2017-11-09 14:19:35'),
(11, 11, '889376edf2466944bf77a62db1685424.jpg', 1, '2017-11-09 14:59:49', '2017-11-09 14:59:49'),
(12, 12, 'be134448d3ca545d399cb6d6f8073ad2.jpg', 1, '2017-11-09 15:04:39', '2017-11-09 15:04:39'),
(13, 13, 'b6a64df8d262ddec6b06baa73e85bcb7.jpg', 1, '2017-11-09 15:17:44', '2017-11-09 15:17:44'),
(14, 14, 'f2a3f8e509c9836d414e2c4268b04841.jpg', 1, '2017-11-09 15:19:53', '2017-11-09 15:19:53'),
(15, 15, '9338caca15352dce063b2fafc53344ac.jpg', 1, '2017-11-09 15:26:55', '2017-11-09 15:26:55'),
(16, 16, '09de1ebb22fb3712568256ad4557e536.jpg', 1, '2017-11-09 15:28:24', '2017-11-09 15:28:24'),
(17, 17, '0a515a24cd478f83d94eb9ef114c9f7e.jpg', 1, '2017-11-09 16:04:14', '2017-11-09 16:04:14'),
(18, 18, 'f646ba9b9cf3cf4591b15c959cc86c3f.jpg', 1, '2017-11-09 16:06:25', '2017-11-09 16:06:25'),
(19, 19, '792f321ab88358cae6d79f23fb60deef.jpg', 1, '2017-11-09 16:11:10', '2017-11-09 16:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `plights`
--

CREATE TABLE IF NOT EXISTS `plights` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plights`
--

INSERT INTO `plights` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'MO CONT. CLIENTE', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(2, 'MO ASA CLIENTE', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(3, 'FEI CLIENTE', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(4, 'MATERIAL CLIENTE', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(5, 'ADMINISTRAÇÃO CLIENTE', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(6, 'CAIXA GERENCIADOR', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(7, 'CONTRATO TRA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(8, 'MATERIAIS TRA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(9, 'ASA TRA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(10, 'FEI TRA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(11, 'EQUIPAMENTO TRA', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `unit_id`, `code`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 'HD-001', 'Cano Marrom PVC Soldável 20mm ou 1/2" 6.00m', 'Cano Marrom PVC Soldável 20mm ou 1/2" 6.00m', '2017-10-28 18:16:30', '2017-10-28 18:19:15', NULL),
(2, 13, 'HD-002', 'Cano Marrom PVC Soldável 25mm ou 3/4" 6.00m', 'Cano Marrom PVC Soldável 25mm ou 3/4" 6.00m', '2017-10-28 18:18:59', '2017-10-28 18:18:59', NULL),
(3, 13, 'HD-003', 'Cano Marrom PVC Soldável 32mm ou 1" 6.00m', 'Cano Marrom PVC Soldável 32mm ou 1" 6.00m', '2017-10-28 18:28:15', '2017-10-28 18:28:15', NULL),
(4, 9, 'FR-001', 'Broca Sds-Plus Plus-3 8x100x160', 'Broca Sds-Plus Plus-3 8x100x160', '2017-11-09 13:24:05', '2017-11-09 13:24:05', NULL),
(5, 9, 'HD-004', 'Cola para PVC Incolor Frasco 175g', 'Cola para PVC Incolor Frasco 175g', '2017-11-09 13:27:14', '2017-11-09 13:27:14', NULL),
(6, 9, 'HD-005', 'Joelho 90° Marrom PVC Soldável 32mm ou 1"', 'Joelho 90° Marrom PVC Soldável 32mm ou 1"', '2017-11-09 13:31:43', '2017-11-09 13:31:43', NULL),
(7, 9, 'HD-006', 'Luva Marrom PVC Soldável 32mm ou 1"', 'Luva Marrom PVC Soldável 32mm ou 1"', '2017-11-09 13:33:13', '2017-11-09 13:33:13', NULL),
(8, 14, 'CIV-001', 'Acelerador de Pega Vedacit Rápido CL 3,6 L', 'Acelerador de Pega Vedacit Rápido CL 3,6 L', '2017-11-09 13:57:15', '2017-11-09 14:06:09', NULL),
(9, 14, 'CIV-002', 'Aditivo Plastificante Vedalit 3,6L', 'Aditivo Plastificante Vedalit 3,6L', '2017-11-09 14:06:47', '2017-11-09 14:06:47', NULL),
(10, 14, 'CIV-003', 'Vedapren Preto 3.6 L', 'Vedapren Preto 3.6 L', '2017-11-09 14:19:35', '2017-11-09 14:19:35', NULL),
(11, 9, 'PT-001', 'Pincel para pintura 4"', 'Pincel para pintura 4"', '2017-11-09 14:59:49', '2017-11-09 14:59:49', NULL),
(12, 10, 'CIV-004', 'Cimento CPll 50 kg', 'Cimento CPll 50 KG', '2017-11-09 15:04:38', '2017-11-09 15:04:38', NULL),
(13, 9, 'FR-002', 'Desempenadeira Aço lisa cabo fechado 25,6x12cm', 'Desempenadeira Aço lisa cabo fechado 25,6x12cm', '2017-11-09 15:17:44', '2017-11-09 15:17:44', NULL),
(14, 9, 'HD-006', 'Plug Branco PVC Roscável 20mm ou 1/2"', 'Plug Branco PVC Roscável 20mm ou 1/2"', '2017-11-09 15:19:53', '2017-11-09 15:19:53', NULL),
(15, 15, 'HD-007', 'Cano CPVC Liso para Condução de Água Quente 22mm ou 3/4"', 'Cano CPVC Liso para Condução de Água Quente 22mm ou 3/4"', '2017-11-09 15:26:55', '2017-11-09 15:26:55', NULL),
(16, 9, 'HD-008', 'Luva CPVC Liso para Condução de Água Quente 22mm ou 3/4"', 'Luva CPVC Liso para Condução de Água Quente 22mm ou 3/4"', '2017-11-09 15:28:24', '2017-11-09 15:28:24', NULL),
(17, 9, 'HD-009', 'Luva de Transição Água Quente 22mmx3/4', 'Luva de Transição Água Quente 22mmx3/4', '2017-11-09 16:04:14', '2017-11-09 16:04:14', NULL),
(18, 10, 'CIV-004', 'Argamassa ACII Cerâmica Externa Cinza 20Kg', 'Argamassa ACII Cerâmica Externa Cinza 20Kg', '2017-11-09 16:06:25', '2017-11-09 16:06:25', NULL),
(19, 9, 'CIV-005', 'Bloco Cerâmico Vedação 6 Furos 9x19x14cm', 'Bloco Cerâmico Vedação 6 Furos 9x19x14cm', '2017-11-09 16:11:10', '2017-11-09 16:11:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'manager', 'GERENTE', 'Usuário com acesso total ao sistema', '2017-10-30 03:45:08', '2017-10-30 03:45:08'),
(2, 'coordenator', 'COORDENADOR', 'Usuário com acessos restritos', '2017-10-30 03:45:09', '2017-10-30 03:45:09'),
(3, 'buyer', 'COMPRADOR', 'Usuário com acesso total ao sistema', '2017-10-30 03:45:09', '2017-10-30 03:45:09'),
(4, 'financial', 'FINANCEIRO', 'Usuário com acessos restritos', '2017-10-30 03:45:09', '2017-10-30 03:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_groups`
--

CREATE TABLE IF NOT EXISTS `sub_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_groups`
--

INSERT INTO `sub_groups` (`id`, `group_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Alvenaria', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(2, 1, 'Bases Alvenaria', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(3, 1, 'Chapisco', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(4, 1, 'Reboco', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(5, 2, 'Esgoto', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(6, 2, 'Água Fria', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(7, 2, 'Água Quente', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(8, 2, 'Águas Pluviais', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(9, 2, 'Louças', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(10, 2, 'Metais', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(11, 2, 'Reservatórios', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(12, 3, 'Infra Elétrica', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(13, 3, 'Infra CFTV', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(14, 3, 'Fiações', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(15, 3, 'Quadros', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(16, 3, 'Instalações Provisorias', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(17, 3, 'Tomadas', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(18, 3, 'Iluminação', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(19, 4, 'MDF', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(20, 4, 'Portas', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(21, 4, 'Rodapés', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(22, 5, 'Textura', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(23, 5, 'Pintura Forro Gesso', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(24, 5, 'Pintura Teto Preto', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(25, 5, 'Pintura Amarelo', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(26, 5, 'Pintura Infra', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(27, 5, 'Pintura Piso concreto', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(28, 6, 'Bebedouros', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(29, 6, 'Soleiras', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL),
(30, 6, 'Escadas', '2017-10-28 16:57:09', '2017-10-28 16:57:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `cnpj` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ie` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isention_ie` tinyint(1) NOT NULL DEFAULT 0,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fantasy_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foundation` date DEFAULT NULL,
  `favored_cnpj` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favored_cpf` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favored_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `contact_id`, `address_id`, `cnpj`, `ie`, `isention_ie`, `company_name`, `fantasy_name`, `foundation`, `favored_cnpj`, `favored_cpf`, `favored_name`, `bank`, `agency`, `account`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 5, '20153909000197', '143469075116', 0, 'Prisma Barletta Impressões Ltda', 'Prisma Barletta', '2014-04-28', '00000000000000', '00000000000', 'Edilson Barlettaa Junior', 'Bradesco', '3061-9', '1000895-6', '2017-10-28 17:58:27', '2017-10-28 17:58:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `client_id`, `address_id`, `name`, `descriptions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'Smart Fit - Curitiba', 'Franquia Smart Fit Curitiba', '2017-10-28 17:26:47', '2017-10-28 17:26:47', NULL),
(2, 2, 4, 'Smart Fit-São Carlos', 'Academia Smart Fit - São Carlos - Franquia', '2017-10-28 17:34:38', '2017-10-28 17:34:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'User teste (GERENTE)', 'gerente@email.com', '$2y$10$9MrFI2iZyXc1hwbQYybZsuz1o3BMmXcyPzx8VSJz4GVXrHilQniV6', 'jWOoefxfUh', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(2, 'User teste (COORDENADOR)', 'coordenador@email.com', '$2y$10$xqmLej6mq9SH/w121Mgg6.r4ROAvhokp0y4VzGaKoEVlZI5LiJVmC', 'Wez4fdYebW', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(3, 'User teste (COMPRADOR)', 'comprador@email.com', '$2y$10$d/M8Kow0sQn5i0TM8uUMZ.c2bSNaPlpE0iH.lQbOpQa16oNpN1J5q', 'zT4iSymAq6', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(4, 'User teste (FINANCEIRO)', 'financeiro@email.com', '$2y$10$XOb6pW9l9obpPIA4T9ocj.TiOlLrE0tI6ss5X..Zyj1N.6.A1Wt4G', 'qpFepDfPoj', '2017-10-30 03:45:09', '2017-10-30 03:45:09', NULL),
(5, 'Leonardo', 'silva.zanin@gmail.com', '$2y$10$Krhj..YTa2P1Gu.zGUuk1e2cMr5lHwxjpdxZlmGdIH9CIQAg3txGS', '78oTf6h3vr', '2017-10-30 03:45:10', '2017-10-30 03:45:10', NULL),
(6, 'Glauco', 'glauco@email.com', '$2y$10$3g1O4p8Ae.peQUjrbxJP2.O76kHJc.8EoQlxQ02lwf.DheJERnAKG', '4maIuNhGTiA1tSKtQb3MG3wpo7W8FLwgjjgfhs225LpezvGzOb6WEBWWRWEp', '2017-10-30 03:45:10', '2017-10-30 03:45:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_state_id_foreign` (`state_id`),
  ADD KEY `addresses_city_id_foreign` (`city_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_contact_id_foreign` (`contact_id`),
  ADD KEY `clients_address_id_foreign` (`address_id`);

--
-- Indexes for table `collaborators`
--
ALTER TABLE `collaborators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collaborators_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `metric_units`
--
ALTER TABLE `metric_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metric_units_code_unique` (`code`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictures_product_id_foreign` (`product_id`);

--
-- Indexes for table `plights`
--
ALTER TABLE `plights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sub_groups`
--
ALTER TABLE `sub_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_groups_group_id_foreign` (`group_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_contact_id_foreign` (`contact_id`),
  ADD KEY `suppliers_address_id_foreign` (`address_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `units_client_id_foreign` (`client_id`),
  ADD KEY `units_address_id_foreign` (`address_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `collaborators`
--
ALTER TABLE `collaborators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `metric_units`
--
ALTER TABLE `metric_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `plights`
--
ALTER TABLE `plights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sub_groups`
--
ALTER TABLE `sub_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cep_cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `addresses_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `cep_states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collaborators`
--
ALTER TABLE `collaborators`
  ADD CONSTRAINT `collaborators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `metric_units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_groups`
--
ALTER TABLE `sub_groups`
  ADD CONSTRAINT `sub_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `suppliers_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `units_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
