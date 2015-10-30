-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2015 a las 09:32:31
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `habitaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Ingreso', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(2, 'Egreso', '2015-04-27 15:03:21', '2015-04-27 15:03:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigned_roles`
--

CREATE TABLE IF NOT EXISTS `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `assigned_roles`
--

INSERT INTO `assigned_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buildings_catalog`
--

CREATE TABLE IF NOT EXISTS `buildings_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urbanism_id` int(11) NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urbanism_id` (`urbanism_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `buildings_catalog`
--

INSERT INTO `buildings_catalog` (`id`, `urbanism_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'Piso 1', '2015-05-05 12:14:46', '2015-05-05 12:14:46'),
(2, 2, 'Piso 2', '2015-05-05 12:14:46', '2015-05-05 12:14:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'San Nicolas de los Garza', '2015-05-04 06:42:05', '2015-05-04 06:42:05'),
(2, 2, 'Aguascalientes', '2015-05-04 04:30:00', '2015-05-04 04:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collectors`
--

CREATE TABLE IF NOT EXISTS `collectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `urbanism_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urbanism_id` (`urbanism_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `collectors`
--

INSERT INTO `collectors` (`id`, `user_id`, `urbanism_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2015-05-05 12:36:27', '2015-05-05 12:36:27'),
(2, 5, 2, '2015-05-05 12:36:27', '2015-05-05 12:36:27'),
(3, 6, 3, '2015-05-05 12:36:27', '2015-05-05 12:36:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colonies`
--

CREATE TABLE IF NOT EXISTS `colonies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `colonies`
--

INSERT INTO `colonies` (`id`, `location_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Anahuac', '2015-05-04 08:40:11', '2015-05-04 08:40:11'),
(2, 2, 'Chihuahua', '2015-05-04 08:40:11', '2015-05-04 08:40:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'México', '2015-05-04 06:36:06', '2015-05-04 06:36:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urbanism_id` int(11) NOT NULL,
  `sub_account_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sub_account_id` (`sub_account_id`),
  KEY `created_by` (`created_by`),
  KEY `urbanism_id` (`urbanism_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses_files`
--

CREATE TABLE IF NOT EXISTS `expenses_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `public_filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `expense_id` (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invited_neighbors`
--

CREATE TABLE IF NOT EXISTS `invited_neighbors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invited_id` varchar(255) NOT NULL,
  `urbanism_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `confirmation_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urbanism_id` (`urbanism_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monthly_fee`
--

CREATE TABLE IF NOT EXISTS `monthly_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urbanism_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `since` date NOT NULL,
  `until` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urbanism_id` (`urbanism_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `neighbors`
--

CREATE TABLE IF NOT EXISTS `neighbors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `mobile` int(11) NOT NULL,
  `coments` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `neighbors_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `neighbors`
--

INSERT INTO `neighbors` (`id`, `user_id`, `name`, `last_name`, `phone`, `mobile`, `coments`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super', 'Administrador', 0, 0, '', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(2, 2, 'Administrador', 'Admin', 0, 0, '', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(3, 3, 'Jhon', 'Presidente', 0, 0, '', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(4, 4, 'Jhon', 'Cobrador', 0, 0, '', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(5, 5, 'Jhon', 'Comprador', 0, 0, '', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(6, 6, 'Jhon', 'Vecino', 0, 0, '', '2015-04-27 15:03:21', '2015-04-27 15:03:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `neighbors_properties`
--

CREATE TABLE IF NOT EXISTS `neighbors_properties` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `neighbor_id` int(11) NOT NULL,
  `urbanism_id` int(11) NOT NULL,
  `num_street_id` int(11) DEFAULT NULL,
  `num_floor_id` int(11) DEFAULT NULL,
  `num_house_or_apartment` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `num_house_or_apartment` (`num_house_or_apartment`),
  KEY `urbanism_id` (`urbanism_id`),
  KEY `neighbor_id` (`neighbor_id`),
  KEY `num_street_id` (`num_street_id`),
  KEY `num_floor_id` (`num_floor_id`),
  FULLTEXT KEY `num_house_or_apartment_2` (`num_house_or_apartment`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `neighbors_properties`
--

INSERT INTO `neighbors_properties` (`id`, `neighbor_id`, `urbanism_id`, `num_street_id`, `num_floor_id`, `num_house_or_apartment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, NULL, '1', '2015-05-05 14:51:49', '2015-05-05 14:51:49'),
(2, 4, 1, 3, NULL, '67', '2015-05-05 14:51:49', '2015-05-05 14:51:49'),
(3, 5, 1, 2, NULL, '45', '2015-05-05 14:52:36', '2015-05-05 14:52:36'),
(4, 5, 1, 4, NULL, '90', '2015-05-05 14:52:36', '2015-05-05 14:52:36'),
(5, 6, 2, NULL, 2, '10', '2015-05-05 14:53:44', '2015-05-05 14:53:44'),
(6, 6, 1, 3, NULL, '38', '2015-05-05 14:53:44', '2015-05-05 14:53:44'),
(7, 3, 1, 4, NULL, '23', '2015-05-13 15:18:45', '2015-05-05 14:54:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parameters`
--

CREATE TABLE IF NOT EXISTS `parameters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_colony` int(11) NOT NULL,
  `id_parameter` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collector_id` int(11) NOT NULL,
  `neighbor_property_id` int(11) NOT NULL,
  `sub_account_id` int(11) NOT NULL,
  `coments` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `deposit` decimal(10,2) DEFAULT NULL,
  `debt` decimal(10,2) DEFAULT NULL,
  `status_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `collector_id` (`collector_id`),
  KEY `neighbor_property_id` (`neighbor_property_id`),
  KEY `sub_account_id` (`sub_account_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_states`
--

CREATE TABLE IF NOT EXISTS `payment_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `neighbor_property_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `Jan` decimal(10,2) DEFAULT NULL,
  `Feb` decimal(10,2) DEFAULT NULL,
  `Mar` decimal(10,2) DEFAULT NULL,
  `Apr` decimal(10,2) DEFAULT NULL,
  `May` decimal(10,2) DEFAULT NULL,
  `Jun` decimal(10,2) DEFAULT NULL,
  `Jul` decimal(10,2) DEFAULT NULL,
  `Aug` decimal(10,2) DEFAULT NULL,
  `Sep` decimal(10,2) DEFAULT NULL,
  `Oct` decimal(10,2) DEFAULT NULL,
  `Nov` decimal(10,2) DEFAULT NULL,
  `Decem` decimal(10,2) DEFAULT NULL,
  `accumulated` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_status`
--

CREATE TABLE IF NOT EXISTS `payment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `payment_status`
--

INSERT INTO `payment_status` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pago', '2015-05-08 01:59:07', '0000-00-00 00:00:00'),
(2, 'Abono', '2015-05-08 01:59:07', '0000-00-00 00:00:00'),
(3, 'Deuda', '2015-05-08 01:59:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2015-04-27 15:03:20', '2015-04-27 15:03:20'),
(2, 'admin', '2015-04-27 15:03:20', '2015-04-27 15:03:20'),
(3, 'presidente', '2015-04-27 15:03:20', '2015-04-27 15:03:20'),
(4, 'cobrador', '2015-04-27 15:03:20', '2015-04-27 15:03:20'),
(5, 'comprador', '2015-04-27 15:03:20', '2015-04-27 15:03:20'),
(6, 'vecino', '2015-04-27 15:03:20', '2015-04-27 15:03:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nuevo León', '2015-05-05 05:30:06', '2015-05-05 05:30:06'),
(2, 1, 'Aguascalientes‎', '2015-05-05 05:30:06', '2015-05-05 05:30:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Activo', '2015-04-27 15:03:19', '2015-04-27 15:03:19'),
(2, 'Suspendido', '2015-04-27 15:03:19', '2015-04-27 15:03:19'),
(3, 'Prohibido', '2015-04-27 15:03:19', '2015-04-27 15:03:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `streets_catalog`
--

CREATE TABLE IF NOT EXISTS `streets_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urbanism_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urbanism_id` (`urbanism_id`),
  KEY `urbanism_id_2` (`urbanism_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Volcado de datos para la tabla `streets_catalog`
--

INSERT INTO `streets_catalog` (`id`, `urbanism_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Almazan', '2015-05-05 14:45:02', '2015-05-05 14:44:28'),
(2, 1, 'Gerrero', '2015-05-05 14:45:02', '2015-05-05 14:44:28'),
(3, 1, 'Bolivar', '2015-05-05 14:45:02', '2015-05-05 14:44:28'),
(4, 1, 'Teran', '2015-05-05 14:45:02', '2015-05-05 14:44:28'),
(5, 3, 'Chihuahua 1', '2015-05-05 14:45:02', '2015-05-05 14:44:28'),
(6, 3, 'Chihuahua 2', '2015-05-05 14:45:02', '2015-05-05 14:44:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_accounts`
--

CREATE TABLE IF NOT EXISTS `sub_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `urbanism_id` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `urbanism_id` (`urbanism_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `sub_accounts`
--

INSERT INTO `sub_accounts` (`id`, `account_id`, `urbanism_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Ingreso por cuota mensual', '2015-04-27 15:20:21', '2015-04-27 15:20:21'),
(2, 1, 2, 'Ingreso por aportacion extraordinaria', '2015-04-27 15:20:21', '2015-04-27 15:20:21'),
(3, 2, 1, 'Pago de nómina guardias', '2015-04-27 15:20:21', '2015-04-27 15:20:21'),
(4, 2, 1, 'Pago de energía eléctrica', '2015-04-27 15:20:21', '2015-04-27 15:20:21'),
(5, 2, 1, 'Pago de corte de cesped área común', '2015-04-27 15:20:21', '2015-04-27 15:20:21'),
(6, 2, 2, 'Pago de utensilios de limpieza', '2015-04-27 15:20:21', '2015-04-27 15:20:21'),
(7, 2, 3, 'Pago mtto alberca', '2015-04-27 15:20:21', '2015-04-27 15:20:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urbanisms`
--

CREATE TABLE IF NOT EXISTS `urbanisms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `colony_id` int(11) NOT NULL,
  `urbanism_type_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `	num_streets_or_floors` int(11) NOT NULL,
  `num_houses_or_apartments` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `colony_id` (`colony_id`),
  KEY `urbanism_type_id` (`urbanism_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `urbanisms`
--

INSERT INTO `urbanisms` (`id`, `colony_id`, `urbanism_type_id`, `name`, `	num_streets_or_floors`, `num_houses_or_apartments`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Anahuac Norte', 4, 32, '2015-05-05 12:09:46', '2015-05-05 11:58:41'),
(2, 1, 3, 'Regio', 4, 20, '2015-05-05 12:08:31', '2015-05-05 11:58:41'),
(3, 2, 2, 'Chihuahua Sur', 2, 20, '2015-05-05 12:10:48', '2015-05-05 11:58:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urbanism_types`
--

CREATE TABLE IF NOT EXISTS `urbanism_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `urbanism_types`
--

INSERT INTO `urbanism_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Colonia Abierta', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(2, 'Colonia Cerrada', '2015-04-27 15:03:21', '2015-04-27 15:03:21'),
(3, 'Edificio', '2015-04-27 15:03:21', '2015-04-27 15:03:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `users_status_id_foreign` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `status_id`, `email`, `password`, `confirmation_code`, `remember_token`, `confirmed`, `created_at`, `updated_at`) VALUES
(1, 1, 'superadmin@ejemplo.org', '$2y$10$1KAv8SoXqhzuuWjTDXgg6eLkbl1PBUOwVKTgVcA.EGdY3BYM.hxxu', '1006d02d557c0f08ab5c7db95b154050', NULL, 1, '2015-04-27 15:03:20', '2015-04-27 15:03:20'),
(2, 1, 'admin@ejemplo.org', '$2y$10$W6MnRV/2w.r58yC4RWc7auOeoKKC90surr13ge.rU59o0OVN9XKGa', 'e115587b8f64dc803c0c990cb2a8cd1f', 'TvopYP5xfyjp3JZmPS1FLxwm4tkZjzc0uo5x9tMEyyPUG7qXF9jaPAB97jUY', 1, '2015-04-27 15:03:20', '2015-05-15 13:01:10'),
(3, 1, 'presidente@ejemplo.org', '$2y$10$vjmPQHkIv0cbiZfJu4WSluk2emnnhGpvMyCIYPAHp3fNiPHstZqiu', 'c189dc8b12fe95bf92c60a05c2945043', 'AVYYqjU5VLJ8wv7JMMdbMwWcRK7yyPd6jiTWq01a8yeW6SyfDHL00kScv40z', 1, '2015-04-27 15:03:20', '2015-05-13 14:14:16'),
(4, 1, 'cobrador@ejemplo.org', '$2y$10$qkCcJfpRIULEcM2W1rSAleEEYKEKD3DGMKK4meiqWP9K.jkWZMKNi', '10e318f25ce3844d4fc9b3004c8850b5', 'DqeOuwS48IL8bIfqdydyMCLLgY4QGhN2eYuN9T65gRefzVjRS5p0DNBTtmxL', 1, '2015-04-27 15:03:20', '2015-05-14 16:26:16'),
(5, 1, 'comprador@ejemplo.org', '$2y$10$KYSR8uBFi.smLQvtQCwrz.Y0zmSXMXhAlnLXKme4NC/M3oLFT8nN6', 'f87798f1b7bd6593fbd5a263c06bd245', NULL, 1, '2015-04-27 15:03:20', '2015-04-27 15:03:20'),
(6, 1, 'vecino@ejemplo.org', '$2y$10$ltAA7mWgHgAH3jtbhrw2wuqTJu6H.Nq3.Ww/b05WyVoHfDG2FhiBu', 'ab5fa7ca5f32558059c7d0c74f5d373f', NULL, 1, '2015-04-27 15:03:20', '2015-04-27 15:03:20');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `buildings_catalog`
--
ALTER TABLE `buildings_catalog`
  ADD CONSTRAINT `buildings_catalog_urbanism_id_foreign` FOREIGN KEY (`urbanism_id`) REFERENCES `urbanisms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `collectors`
--
ALTER TABLE `collectors`
  ADD CONSTRAINT `collectors_urbanism_id_foreign` FOREIGN KEY (`urbanism_id`) REFERENCES `urbanisms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `collectors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `colonies`
--
ALTER TABLE `colonies`
  ADD CONSTRAINT `colonies_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_sub_account_id_foreign` FOREIGN KEY (`sub_account_id`) REFERENCES `sub_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_urbanism_id_foreign` FOREIGN KEY (`urbanism_id`) REFERENCES `urbanisms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `expenses_files`
--
ALTER TABLE `expenses_files`
  ADD CONSTRAINT `expenses_files_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `invited_neighbors`
--
ALTER TABLE `invited_neighbors`
  ADD CONSTRAINT `invited_neighbors_urbanism_id_foreign` FOREIGN KEY (`urbanism_id`) REFERENCES `urbanisms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monthly_fee`
--
ALTER TABLE `monthly_fee`
  ADD CONSTRAINT `monthly_fee_urbanism_id_foreign` FOREIGN KEY (`urbanism_id`) REFERENCES `urbanisms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `neighbors`
--
ALTER TABLE `neighbors`
  ADD CONSTRAINT `neighbors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sub_accounts`
--
ALTER TABLE `sub_accounts`
  ADD CONSTRAINT `sub_accounts_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_accounts_urbanism_id_foreign` FOREIGN KEY (`urbanism_id`) REFERENCES `urbanisms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
