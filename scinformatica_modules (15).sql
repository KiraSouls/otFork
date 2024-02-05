-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-08-2019 a las 13:48:52
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scinformatica_modules`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hours` int(11) NOT NULL,
  `id_ot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `id_clients` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `branch_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `branches`
--

INSERT INTO `branches` (`id`, `id_clients`, `location`, `phone`, `branch_name`) VALUES
(20, 12, 'Andres Bello', '5606200', 'Andres Bello'),
(22, 12, 'Los Conquistadores 7ED-43', '5606200', 'Conquistadores'),
(23, 13, 'Excequieel Fernandez 1168', '222373879', 'Cra Ingenieria Spa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(2, 'HP'),
(9, 'DELL'),
(10, 'XEROX'),
(11, 'BROTHER'),
(12, 'Epson');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rut` varchar(20) NOT NULL,
  `web` varchar(30) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `rut`, `web`, `phone`, `email`) VALUES
(12, 'Ferrovial Agroman S.A.', '96825130-9', 'www.ferrovial.com', '96825130-9', 'ferrovial@ferrovial.com'),
(13, 'CRA  Ingenieria  SPA', '78202640-2', 'www.cra.cl', '22 2373879 ', 'claudiamelo@ingenieriacra.cl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `id_branches` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  `charge` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `contact_name`, `phone`, `id_branches`, `department`, `charge`, `email`) VALUES
(16, 'Salome Cortez', '99101000', 20, 'Secretaria', 'Secretaria', 'scortez@ferrovial.com'),
(18, 'Samuel Monasterio', '99101000', 22, 'Departamento TI2', 'Encargado de Soporte TI', 'samonasterio@ferrovial.com'),
(19, 'Claudia Melo', '223334444', 23, 'Administracion', 'Jefe Administracion', 'cmelo@ingenieriacra.cl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `id_branches` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `series_number` varchar(18) NOT NULL,
  `id_linea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipment`
--

INSERT INTO `equipment` (`id`, `id_branches`, `id_model`, `series_number`, `id_linea`) VALUES
(32, 20, 15, '213213123', 5),
(33, 20, 15, '1382913892083', 5),
(34, 20, 15, '123214', 5),
(36, 23, 16, 'u63889l5n641688', 8),
(38, 23, 19, 'BRBFD3LQ2V', 8),
(40, 23, 21, 'MHEY001908', 11),
(41, 23, 22, 'S4XY053579', 9),
(42, 23, 21, 'MHEY004959', 11),
(43, 23, 22, 'S4XY024958', 9),
(44, 23, 23, 'VJFY016642', 9),
(45, 23, 23, 'VJFY018105', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `executives`
--

CREATE TABLE `executives` (
  `id` int(11) NOT NULL,
  `id_providers` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `executives`
--

INSERT INTO `executives` (`id`, `id_providers`, `name`, `email`, `phone`) VALUES
(5, 5, 'luis', 'desarrollo@scinformatica.cl', '232323232');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`id`, `name`) VALUES
(1, 'Computadores'),
(2, 'Impresoras ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_brands`
--

CREATE TABLE `linea_brands` (
  `id_relation` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_line` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `linea_brands`
--

INSERT INTO `linea_brands` (`id_relation`, `id_brand`, `id_line`) VALUES
(10, 9, 4),
(11, 2, 5),
(12, 2, 7),
(13, 10, 8),
(14, 2, 8),
(15, 11, 8),
(16, 12, 9),
(17, 12, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_linea` int(11) NOT NULL,
  `pal_number` varchar(50) NOT NULL,
  `id_sublinea` int(11) NOT NULL,
  `short_desc` varchar(300) NOT NULL,
  `long_desc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `model`
--

INSERT INTO `model` (`id`, `name`, `id_brand`, `id_linea`, `pal_number`, `id_sublinea`, `short_desc`, `long_desc`) VALUES
(10, 'Modelo de equipo', 9, 1, '2', 4, '', ''),
(14, 'modelo con descripci&oacute;n ', 9, 1, '120312039', 4, 'Descripci&oacute;n corta', 'Descripci&oacute;n larga'),
(15, 'Modelo 32', 2, 1, '123123213', 5, 'Descripci&oacute;n corta', 'Descripci&oacute;n larga'),
(16, 'MFC-L2740DW', 11, 2, 'MFCL2740DW', 8, 'Multifuncional l&aacute;ser compacto con conectividad en red inal&aacute;mbrica y d&uacute;plex mejorado', 'Multifuncional l&aacute;ser compacto con conectividad en red inal&aacute;mbrica y d&uacute;plex mejorado'),
(19, 'LASERJET  PROFESIONAL P1606DN', 2, 2, 'P1606DN', 8, 'LASERJET  PROFESIONAL P1606DN', 'LASERJET  PROFESIONAL P1606DN'),
(21, 'STYLUS OFFICE TX620FWD', 12, 2, 'TX620FWD', 11, 'STYLUS OFFICE TX620FWD', 'STYLUS OFFICE TX620FWD'),
(22, 'Epson EcoTank L555', 12, 2, 'L555', 9, 'Epson EcoTank L555', 'Epson EcoTank L555'),
(23, 'Epson EcoTank L565', 12, 2, 'L565', 9, 'Epson EcoTank L565', 'Epson EcoTank L565'),
(24, 'Epson EcoTank L575', 12, 2, 'L575', 9, 'Epson EcoTank L575', 'Epson EcoTank L575');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `notification_name`, `created_at`, `status`) VALUES
(1, 'Se ha creado una nueva orden', '2019-06-29 21:55:42', 1),
(2, 'Se ha creado una nueva orden', '2019-06-29 22:04:08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ots`
--

CREATE TABLE `ots` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_branch` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `id_service` int(11) NOT NULL,
  `leader` varchar(50) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'iniciada',
  `number` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ots`
--

INSERT INTO `ots` (`id`, `id_client`, `id_branch`, `id_contact`, `hours`, `created_at`, `type`, `description`, `id_service`, `leader`, `priority`, `status`, `number`, `comment`) VALUES
(197, 13, 23, 19, 2, '2019-08-21 15:01:46', 'Remota', '2', 11, 'Especialista de impresoras', 'alta', 'finalizada', 1001, 'orden lista '),
(199, 13, 23, 19, 3, '2019-08-21 15:12:33', 'Remota', '3', 11, 'Luis Torralbo', 'alta', 'iniciada', 1002, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parameter_area`
--

CREATE TABLE `parameter_area` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parameter_area`
--

INSERT INTO `parameter_area` (`id`, `name`) VALUES
(1, 'Conectividad y redes'),
(2, 'Soporte TI'),
(3, 'Areas sociales'),
(4, 'Impresoras'),
(5, 'Comunicaciones'),
(6, 'impresoras'),
(7, 'Soporte TI'),
(8, 'Servicio Tecnico Impresoras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parameter_brand`
--

CREATE TABLE `parameter_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parameter_brand`
--

INSERT INTO `parameter_brand` (`id`, `name`) VALUES
(1, 'Intel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `participant_name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `ot_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `participants`
--

INSERT INTO `participants` (`id`, `participant_name`, `description`, `ot_number`) VALUES
(216, 'Luis Torralbo', '2', 1001),
(217, 'Especialista de impresoras', '2', 1001),
(218, 'Pedro  Salgado  ', '2', 1001),
(221, 'Luis Torralbo', '3', 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `rut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id`, `name`, `location`, `phone`, `email`, `rut`) VALUES
(1, 'nuevo proveedor', 'Santiago', '929392933', 'luis2@gmail.com', '3243243-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `replacements`
--

CREATE TABLE `replacements` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `equipment` tinyint(1) NOT NULL,
  `id_sublinea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `service_name`, `equipment`, `id_sublinea`) VALUES
(11, 'Servicio Tecnico Impresoras', 1, 7),
(12, 'Servicio Tecnico Computadores', 1, 5),
(13, 'Conectividad en Redes', 0, 0),
(14, 'Desarrollo de Sistemas', 0, 0),
(15, 'Seguridad Digital', 1, 0),
(16, 'Marketing Digital', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_linea`
--

CREATE TABLE `sub_linea` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_line` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sub_linea`
--

INSERT INTO `sub_linea` (`id`, `name`, `id_line`) VALUES
(4, 'nueva sublinea 1000', 1),
(5, 'Notebook', 1),
(6, 'Computador Escritorio', 1),
(7, 'Deskjet', 2),
(8, 'Laserjet', 2),
(9, 'Ecotank', 2),
(11, 'Officejet', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `id_service`, `name`) VALUES
(13, 11, 'Mantencion General'),
(17, 11, 'Remplazo Pickup Bandeja'),
(18, 11, 'Remplazo Pickup ADF'),
(19, 13, 'Instalacion de puntos de RED'),
(20, 13, 'Instalacion de Conector de RED'),
(21, 13, 'Rotulado de Punto de RED'),
(23, 12, 'Diagnostico Tecnico'),
(24, 12, 'Mantencion Fisica'),
(25, 12, 'Mantencion Logica'),
(26, 12, 'Instalacion Disco Duro'),
(27, 12, 'Instalacion Memoria Ram'),
(29, 12, 'Instalacion de Teclado'),
(31, 12, 'Instalacion de Pantalla'),
(32, 16, 'Dise&ntilde;ar web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks_equipments`
--

CREATE TABLE `tasks_equipments` (
  `id` int(11) NOT NULL,
  `id_tasks` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `number_ot` int(11) NOT NULL,
  `task_set` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tasks_equipments`
--

INSERT INTO `tasks_equipments` (`id`, `id_tasks`, `id_equipment`, `number_ot`, `task_set`, `comment`, `status`) VALUES
(283, 18, 36, 1001, 1, '', 1),
(284, 18, 44, 1001, 2, '', 1),
(288, 18, 36, 1002, 1, '', 0),
(289, 17, 41, 1002, 2, '', 0),
(290, 18, 40, 1002, 3, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `techs`
--

CREATE TABLE `techs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rut` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hour_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `techs`
--

INSERT INTO `techs` (`id`, `name`, `rut`, `phone`, `email`, `hour_price`) VALUES
(16, 'Luis Torralbo', '18448966-K', '23232323', 'luis.torralbo20@gmail.com', 20000),
(17, 'Especialista de impresoras', '18548866-K', '99101000', 'informatica@scinformatica.cl', 60000),
(18, 'Pedro  Salgado  ', '13050202-4', '22 8840171', 'impresoras@scinformatica.cl', 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `techs_services`
--

CREATE TABLE `techs_services` (
  `id_relation` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_tech` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `techs_services`
--

INSERT INTO `techs_services` (`id_relation`, `id_service`, `id_tech`) VALUES
(11, 11, 16),
(12, 11, 17),
(13, 16, 16),
(14, 12, 17),
(15, 13, 16),
(16, 11, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `rol`, `email`) VALUES
(1, 'luis', '141f87be1330a105a87923f4ee6383bd7de46541', 'ADMINISTRADOR', 'desarrollo@scinformatica.cl'),
(4, 'Raul Moya F.', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'ADMINISTRADOR', 'rmoya@scinformatica.cl'),
(16, 'Luis Torralbo', '141f87be1330a105a87923f4ee6383bd7de46541', 'ESPECIALISTA', 'luis.torralbo20@gmail.com'),
(17, 'Especialista de impresoras', '141f87be1330a105a87923f4ee6383bd7de46541', 'ESPECIALISTA', 'informatica@scinformatica.cl'),
(18, 'Pedro  Salgado  ', '7c222fb2927d828af22f592134e8932480637c0d', 'ESPECIALISTA', 'impresoras@scinformatica.cl');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_activities_ot` (`id_ot`);

--
-- Indices de la tabla `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branches_clients` (`id_clients`);

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rut` (`rut`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contacts_branches` (`id_branches`);

--
-- Indices de la tabla `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipments_branches` (`id_branches`),
  ADD KEY `fk_equipments_model` (`id_model`);

--
-- Indices de la tabla `executives`
--
ALTER TABLE `executives`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea_brands`
--
ALTER TABLE `linea_brands`
  ADD PRIMARY KEY (`id_relation`),
  ADD KEY `fk_brandslineas` (`id_brand`),
  ADD KEY `fk_lineasbrands` (`id_line`);

--
-- Indices de la tabla `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_model_brands` (`id_brand`),
  ADD KEY `fk_model_linea` (`id_linea`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ots`
--
ALTER TABLE `ots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ots_clients` (`id_client`),
  ADD KEY `fk_ots_branches` (`id_branch`),
  ADD KEY `fk_ots_contacts` (`id_contact`);

--
-- Indices de la tabla `parameter_area`
--
ALTER TABLE `parameter_area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parameter_brand`
--
ALTER TABLE `parameter_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `replacements`
--
ALTER TABLE `replacements`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_linea`
--
ALTER TABLE `sub_linea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subline_line` (`id_line`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasks_services` (`id_service`);

--
-- Indices de la tabla `tasks_equipments`
--
ALTER TABLE `tasks_equipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasksequipments` (`id_tasks`),
  ADD KEY `fk_equipmentstasks` (`id_equipment`);

--
-- Indices de la tabla `techs`
--
ALTER TABLE `techs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `techs_services`
--
ALTER TABLE `techs_services`
  ADD PRIMARY KEY (`id_relation`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `executives`
--
ALTER TABLE `executives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `linea_brands`
--
ALTER TABLE `linea_brands`
  MODIFY `id_relation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ots`
--
ALTER TABLE `ots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT de la tabla `parameter_area`
--
ALTER TABLE `parameter_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `parameter_brand`
--
ALTER TABLE `parameter_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `replacements`
--
ALTER TABLE `replacements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `sub_linea`
--
ALTER TABLE `sub_linea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tasks_equipments`
--
ALTER TABLE `tasks_equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT de la tabla `techs`
--
ALTER TABLE `techs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `techs_services`
--
ALTER TABLE `techs_services`
  MODIFY `id_relation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_activities_ot` FOREIGN KEY (`id_ot`) REFERENCES `ots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `fk_branches_clients` FOREIGN KEY (`id_clients`) REFERENCES `clients` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_branches` FOREIGN KEY (`id_branches`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `fk_equipments_branches` FOREIGN KEY (`id_branches`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipments_model` FOREIGN KEY (`id_model`) REFERENCES `model` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `linea_brands`
--
ALTER TABLE `linea_brands`
  ADD CONSTRAINT `fk_brandslineas` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lineasbrands` FOREIGN KEY (`id_line`) REFERENCES `sub_linea` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `fk_model_brands` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_model_linea` FOREIGN KEY (`id_linea`) REFERENCES `linea` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ots`
--
ALTER TABLE `ots`
  ADD CONSTRAINT `fk_ots_branches` FOREIGN KEY (`id_branch`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ots_clients` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ots_contacts` FOREIGN KEY (`id_contact`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sub_linea`
--
ALTER TABLE `sub_linea`
  ADD CONSTRAINT `fk_subline_line` FOREIGN KEY (`id_line`) REFERENCES `linea` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_services` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
