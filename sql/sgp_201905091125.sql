-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2019 a las 11:25:41
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '1', 1556204478),
('Cliente', '13', 1557021820),
('Cliente', '15', 1557413843),
('Proveedor', '2', 1556422628),
('Proveedor', '7', 1557011629),
('Proveedor', '8', 1557011768);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Administrador', 1, '', NULL, NULL, 1556204478, 1556496142),
('Cliente', 1, 'Usuario que realiza los pedidos', NULL, NULL, 1556416787, 1557413644),
('medicamento/*', 2, 'Route medicamento/*', NULL, NULL, 1556306505, 1556306505),
('medicamento/create', 2, 'Route medicamento/create', NULL, NULL, 1556306505, 1556306505),
('medicamento/delete', 2, 'Route medicamento/delete', NULL, NULL, 1556306505, 1556306505),
('medicamento/index', 2, 'Route medicamento/index', NULL, NULL, 1556306505, 1556306505),
('medicamento/update', 2, 'Route medicamento/update', NULL, NULL, 1556306505, 1556306505),
('medicamento/view', 2, 'Route medicamento/view', NULL, NULL, 1556306505, 1556306505),
('pedido/*', 2, 'Route pedido/*', NULL, NULL, 1556306505, 1556306505),
('pedido/create', 2, 'Route pedido/create', NULL, NULL, 1556306505, 1556306505),
('pedido/delete', 2, 'Route pedido/delete', NULL, NULL, 1556306505, 1556306505),
('pedido/index', 2, 'Route pedido/index', NULL, NULL, 1556306505, 1556306505),
('pedido/update', 2, 'Route pedido/update', NULL, NULL, 1556306505, 1556306505),
('pedido/view', 2, 'Route pedido/view', NULL, NULL, 1556306505, 1556306505),
('Proveedor', 1, 'Usuario que provee de los medicamentos a la farmacia', NULL, NULL, 1556416713, 1557413666),
('site/*', 2, 'Route site/*', NULL, NULL, 1556306505, 1556306505),
('site/about', 2, 'Route site/about', NULL, NULL, 1556306505, 1556306505),
('site/captcha', 2, 'Route site/captcha', NULL, NULL, 1556306505, 1556306505),
('site/contact', 2, 'Route site/contact', NULL, NULL, 1556306505, 1556306505),
('site/error', 2, 'Route site/error', NULL, NULL, 1556306505, 1556306505),
('site/index', 2, 'Route site/index', NULL, NULL, 1556306505, 1556306505),
('site/logout', 2, 'Route site/logout', NULL, NULL, 1556306505, 1556306505),
('tipo-medicamento/*', 2, 'Route tipo-medicamento/*', NULL, NULL, 1556306505, 1556306505),
('tipo-medicamento/create', 2, 'Route tipo-medicamento/create', NULL, NULL, 1556306505, 1556306505),
('tipo-medicamento/delete', 2, 'Route tipo-medicamento/delete', NULL, NULL, 1556306505, 1556306505),
('tipo-medicamento/index', 2, 'Route tipo-medicamento/index', NULL, NULL, 1556306505, 1556306505),
('tipo-medicamento/update', 2, 'Route tipo-medicamento/update', NULL, NULL, 1556306505, 1556306505),
('tipo-medicamento/view', 2, 'Route tipo-medicamento/view', NULL, NULL, 1556306505, 1556306505);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administrador', 'medicamento/create'),
('Administrador', 'medicamento/delete'),
('Administrador', 'medicamento/index'),
('Administrador', 'medicamento/update'),
('Administrador', 'medicamento/view'),
('Administrador', 'pedido/create'),
('Administrador', 'pedido/delete'),
('Administrador', 'pedido/index'),
('Administrador', 'pedido/update'),
('Administrador', 'pedido/view'),
('Administrador', 'site/index'),
('Administrador', 'tipo-medicamento/create'),
('Administrador', 'tipo-medicamento/delete'),
('Administrador', 'tipo-medicamento/index'),
('Administrador', 'tipo-medicamento/update'),
('Administrador', 'tipo-medicamento/view'),
('Cliente', 'medicamento/index'),
('Cliente', 'medicamento/view'),
('Cliente', 'pedido/create'),
('Cliente', 'pedido/delete'),
('Cliente', 'pedido/index'),
('Cliente', 'pedido/update'),
('Cliente', 'pedido/view'),
('medicamento/*', 'medicamento/create'),
('medicamento/*', 'medicamento/delete'),
('medicamento/*', 'medicamento/index'),
('medicamento/*', 'medicamento/update'),
('medicamento/*', 'medicamento/view'),
('pedido/*', 'pedido/create'),
('pedido/*', 'pedido/delete'),
('pedido/*', 'pedido/index'),
('pedido/*', 'pedido/update'),
('pedido/*', 'pedido/view'),
('Proveedor', 'medicamento/index'),
('Proveedor', 'medicamento/view'),
('Proveedor', 'pedido/index'),
('Proveedor', 'pedido/view'),
('Proveedor', 'site/index'),
('site/*', 'site/about'),
('site/*', 'site/captcha'),
('site/*', 'site/contact'),
('site/*', 'site/error'),
('site/*', 'site/index'),
('site/*', 'site/logout'),
('tipo-medicamento/*', 'tipo-medicamento/create'),
('tipo-medicamento/*', 'tipo-medicamento/delete'),
('tipo-medicamento/*', 'tipo-medicamento/index'),
('tipo-medicamento/*', 'tipo-medicamento/update'),
('tipo-medicamento/*', 'tipo-medicamento/view');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_contacto`
--

CREATE TABLE `informacion_contacto` (
  `id` int(11) NOT NULL COMMENT 'Perfil',
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Telefono',
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Dirección',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `informacion_contacto`
--

INSERT INTO `informacion_contacto` (`id`, `telefono`, `direccion`, `fecha_creacion`) VALUES
(8, '11212', 'sdsdsds \r\n\r\nddsds\r\n\r\ndsd', '2019-05-04 23:16:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `id` int(11) NOT NULL COMMENT 'No.',
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Código',
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre',
  `indicacion` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Indicación',
  `contraindicacion` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Contraindicación',
  `observacion` text COLLATE utf8_unicode_ci COMMENT 'Observación',
  `stock` double(11,0) NOT NULL COMMENT 'Stock',
  `proveedor_id` int(11) NOT NULL COMMENT 'Proveedor',
  `tipo_id` int(11) NOT NULL COMMENT 'Tipo',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT '1' COMMENT 'Activo',
  `imagen` text COLLATE utf8_unicode_ci COMMENT 'Imagen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`id`, `codigo`, `nombre`, `indicacion`, `contraindicacion`, `observacion`, `stock`, `proveedor_id`, `tipo_id`, `fecha_registro`, `activo`, `imagen`) VALUES
(1, '112', 'dsd', 'dsd', 'dsd', 'dsd', 1122, 2, 1, '2019-04-28 03:37:46', 1, ''),
(2, '111', 'Medicamento2', 'Indicación 1: bla bla bla bla\r\nIndicación 1: bla bla bla bla\r\nIndicación 1: bla bla bla bla\r\nIndicación 1: bla bla bla bla\r\nIndicación 1: bla bla bla bla fdsdsds\r\ndsdsdsdsdsdsd\r\nIndicación 1: bla bla bla bla\r\n', 'Contraindicación 1: dsdsdsds ellele elle lele elle elle lle  lele \r\nContraindicación  2: dlalala  alalaa allaa \r\nlalalaa', '', 12, 2, 1, '2019-04-29 17:56:14', 1, NULL),
(3, '222', 'Medicamento3', 'dsddsd', 'dsdsd', '', 13, 2, 1, '2019-04-29 17:58:30', 1, NULL),
(4, '333', 'Medicamento4', 'dsds', 'dsd', '', 14, 2, 1, '2019-04-29 17:58:59', 1, NULL),
(5, '15', 'Medicamento5', 'dsdsd', 'dsd', '', 16, 2, 1, '2019-04-29 17:59:23', 1, NULL),
(6, '444', 'dsds', 'dsd', 'dsd', '', 22, 2, 1, '2019-04-29 17:59:51', 1, NULL),
(7, '555', 'dsd', 'dsd', 'dsd', '', 45, 2, 1, '2019-04-29 19:58:13', 1, ''),
(8, 'ytyttt', 'aspirina', 'dsddsd', 'dsdsd', '', 23, 2, 1, '2019-04-29 20:09:48', 1, 'medicamento-images/medicina-farmacia-drogasshutterstock_8.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('Da\\User\\Migration\\m000000_000001_create_user_table', 1556204431),
('Da\\User\\Migration\\m000000_000002_create_profile_table', 1556204431),
('Da\\User\\Migration\\m000000_000003_create_social_account_table', 1556204431),
('Da\\User\\Migration\\m000000_000004_create_token_table', 1556204431),
('Da\\User\\Migration\\m000000_000005_add_last_login_at', 1556204431),
('Da\\User\\Migration\\m000000_000006_add_two_factor_fields', 1556204432),
('Da\\User\\Migration\\m000000_000007_enable_password_expiration', 1556204432),
('m000000_000000_base', 1556204429),
('m140506_102106_rbac_init', 1556204440),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1556204440),
('m190426_155844_esquema_inicial', 1556300804),
('m190429_122910_alter_medicamento_table', 1556565235),
('m190503_143739_alter_table_pedido', 1556894302),
('m190503_183224_alter_table_pedido_detalle', 1556908384);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL COMMENT 'No.',
  `estado` smallint(6) NOT NULL COMMENT 'Estado',
  `observacion` text COLLATE utf8_unicode_ci COMMENT 'Observación',
  `usuario_id` int(11) NOT NULL COMMENT 'Usuario',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_entrega` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `estado`, `observacion`, `usuario_id`, `fecha_registro`, `fecha_entrega`) VALUES
(30, 1, '', 1, '2019-05-06 16:38:00', '0000-00-00 00:00:00'),
(32, 1, '', 15, '2019-05-09 14:57:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE `pedido_detalle` (
  `id` int(11) NOT NULL COMMENT 'No.',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad',
  `pedido_id` int(11) NOT NULL COMMENT 'Pedido',
  `medicamento_id` int(11) NOT NULL COMMENT 'Medicamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id`, `cantidad`, `pedido_id`, `medicamento_id`) VALUES
(49, 2, 30, 1),
(50, 2, 30, 2),
(51, 2, 30, 3),
(54, 1, 32, 1),
(55, 1, 32, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `timezone`, `bio`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'proveedor1', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'xdsd', '', NULL, ''),
(8, 'proveedor2 sa', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', NULL, ''),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_medicamento`
--

CREATE TABLE `tipo_medicamento` (
  `id` int(11) NOT NULL COMMENT 'No.',
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre',
  `descripcion` text COLLATE utf8_unicode_ci COMMENT 'Descripcion',
  `activo` tinyint(1) DEFAULT '1' COMMENT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_medicamento`
--

INSERT INTO `tipo_medicamento` (`id`, `nombre`, `descripcion`, `activo`) VALUES
(1, 'Calmante', 'aaa', 1),
(2, 'Antiflamatorio', 'Antiflamatorio Antiflamatorio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `confirmed_at` int(11) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  `auth_tf_key` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_tf_enabled` tinyint(1) DEFAULT '0',
  `password_changed_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `unconfirmed_email`, `registration_ip`, `flags`, `confirmed_at`, `blocked_at`, `updated_at`, `created_at`, `last_login_at`, `auth_tf_key`, `auth_tf_enabled`, `password_changed_at`) VALUES
(1, 'root', 'root@test.com', '$2y$10$HDLJtYEnkC7Dov8ln3h19eeVAlmR9qkRQwWDNMSwi.W0quRQa0QDa', 'IEXGpe8T6202kKiGrfa6kXGvg3fhagrX', NULL, NULL, 0, 1556204475, NULL, 1556204476, 1556204476, 1557414523, '', 0, 1556204476),
(2, 'proveedor1', 'test@test.cu', '$2y$10$1JRN4hPqY7M6ifoxU.lpWuEOKi8wTWhY7NDgNB.wB2h0qRK3G9M9u', 'kuhhW2jfYkDOijYvCrNMGz0aX2RSTXTq', NULL, '::1', 0, 1556204830, NULL, 1556422591, 1556204830, 1557414542, '', 0, 1556422591),
(8, 'proveedor2', 'test2@test.cu', '$2y$10$roRRT5rPsphHGXWyOdAr3uGccvSguyWZC910nPL7ke.SoCbxDdXIO', 'XpqVdXT24c87psxi0b5MaPEcAK95s3cb', NULL, '::1', 0, 1557011768, NULL, 1557011768, 1557011768, 1557413220, '', 0, 1557011768),
(13, 'cliente1', 'test1@test.cu', '$2y$10$muqu9gyR1cAN1y.wBWs0i.IRNfp1Qr5bGvuEEYMK7lRTghiTzwC6i', 'EjmNAmHzJO7I3PtsUI5nwa6OFYiZ5S0j', NULL, '::1', 0, 1557021763, NULL, 1557021763, 1557021763, 1557414599, '', 0, 1557021763),
(15, 'cliente2', 'cliente2@gmail.com', '$2y$10$aqWKQ00uV569ctJoFw0jLenXoCv4pTyVmvYLA5eqrKiDO33FQu1n.', 'xL9rrmMxNl_dMvemOSSLaUO7ZPe-BKn3', NULL, '::1', 0, 1557022960, NULL, 1557022960, 1557022960, 1557413853, '', 0, 1557022960);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `informacion_contacto`
--
ALTER TABLE `informacion_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_medicamento_tipo_medicamento` (`tipo_id`),
  ADD KEY `fk_medicamento_proveedor` (`proveedor_id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_usuario` (`usuario_id`);

--
-- Indices de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_detalle_medicamento` (`medicamento_id`),
  ADD KEY `fk_pedido_detalle_pedido` (`pedido_id`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_social_account_provider_client_id` (`provider`,`client_id`),
  ADD UNIQUE KEY `idx_social_account_code` (`code`),
  ADD KEY `fk_social_account_user` (`user_id`);

--
-- Indices de la tabla `tipo_medicamento`
--
ALTER TABLE `tipo_medicamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `idx_token_user_id_code_type` (`user_id`,`code`,`type`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_username` (`username`),
  ADD UNIQUE KEY `idx_user_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `informacion_contacto`
--
ALTER TABLE `informacion_contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Perfil', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No.', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No.', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No.', AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_medicamento`
--
ALTER TABLE `tipo_medicamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informacion_contacto`
--
ALTER TABLE `informacion_contacto`
  ADD CONSTRAINT `fk_informacion_contacto_usuario` FOREIGN KEY (`id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD CONSTRAINT `fk_medicamento_proveedor` FOREIGN KEY (`proveedor_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medicamento_tipo_medicamento` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_medicamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD CONSTRAINT `fk_pedido_detalle_medicamento` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedido_detalle_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_social_account_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
