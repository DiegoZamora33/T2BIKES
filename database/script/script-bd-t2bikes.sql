-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2020 a las 21:29:07
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

DROP TABLE IF EXISTS `carreras`;
CREATE TABLE IF NOT EXISTS `carreras` (
  `idCarrera` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreCarrera` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idCompetencia` bigint(20) UNSIGNED NOT NULL,
  `idTipoCarrera` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idCarrera`),
  KEY `carreras_idcompetencia_foreign` (`idCompetencia`),
  KEY `carreras_idtipocarrera_foreign` (`idTipoCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

DROP TABLE IF EXISTS `competencias`;
CREATE TABLE IF NOT EXISTS `competencias` (
  `idCompetencia` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreCompetencia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idEstatus` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idCompetencia`),
  KEY `competencias_idestatus_foreign` (`idEstatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competidors`
--

DROP TABLE IF EXISTS `competidors`;
CREATE TABLE IF NOT EXISTS `competidors` (
  `numeroCompetidor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoPaterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoMaterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`numeroCompetidor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadors`
--

DROP TABLE IF EXISTS `entrenadors`;
CREATE TABLE IF NOT EXISTS `entrenadors` (
  `idEntrenador` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoPaterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoMaterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patrocinio` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idEntrenador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador__competidor__competencias`
--

DROP TABLE IF EXISTS `entrenador__competidor__competencias`;
CREATE TABLE IF NOT EXISTS `entrenador__competidor__competencias` (
  `idEntrenador` bigint(20) UNSIGNED NOT NULL,
  `numeroCompetidor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCompetencia` bigint(20) UNSIGNED NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mesesEntrenamiento` int(11) NOT NULL,
  KEY `entrenador__competidor__competencias_identrenador_foreign` (`idEntrenador`),
  KEY `entrenador__competidor__competencias_numerocompetidor_foreign` (`numeroCompetidor`),
  KEY `entrenador__competidor__competencias_idcompetencia_foreign` (`idCompetencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatuses`
--

DROP TABLE IF EXISTS `estatuses`;
CREATE TABLE IF NOT EXISTS `estatuses` (
  `idEstatus` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `estatus` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idEstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estatuses`
--

INSERT INTO `estatuses` (`idEstatus`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Terminada', '2020-05-24 19:26:31', '2020-05-24 19:26:31'),
(2, 'En Curso', '2020-05-24 19:26:31', '2020-05-24 19:26:31'),
(3, 'Si Terminó', '2020-05-24 19:26:31', '2020-05-24 19:26:31'),
(4, 'No Terminó', '2020-05-24 19:26:31', '2020-05-24 19:26:31'),
(5, 'Pendiente', '2020-05-24 19:26:31', '2020-05-24 19:26:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_22_225212_create_competidors_table', 1),
(4, '2020_04_22_225440_create_entrenadors_table', 1),
(5, '2020_04_22_225603_create_competencias_table', 1),
(6, '2020_04_22_225728_create_tipo_carreras_table', 1),
(7, '2020_04_22_225836_create_carreras_table', 1),
(8, '2020_04_22_230119_create_entrenador__competidor__competencias_table', 1),
(9, '2020_04_22_230205_create_puntaje__competidor__competencias_table', 1),
(10, '2020_04_22_230242_create_puntaje__competidor__carreras_table', 1),
(11, '2020_04_23_152631_create_tipo_usuarios_table', 1),
(12, '2020_04_23_153010_agregando_tipo_usuarioa_usuarios', 1),
(13, '2020_04_25_184316_create_estatuses_table', 1),
(14, '2020_04_25_184555_agregandoid_estatus-_puntaje__competidor__carrera', 1),
(15, '2020_04_25_185036_quitar_estatus-_puntaje__competidor__carrera', 1),
(16, '2020_04_25_220331_alterar_competencias_estatus', 1),
(17, '2020_04_25_220656_eliminar_status-_competencias', 1),
(18, '2020_04_28_214421_agregar_mese_entrenamiento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje__competidor__carreras`
--

DROP TABLE IF EXISTS `puntaje__competidor__carreras`;
CREATE TABLE IF NOT EXISTS `puntaje__competidor__carreras` (
  `numeroCompetidor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCarrera` bigint(20) UNSIGNED NOT NULL,
  `lugarLlegada` bigint(20) UNSIGNED DEFAULT NULL,
  `puntaje` double(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idEstatus` bigint(20) UNSIGNED NOT NULL,
  KEY `puntaje__competidor__carreras_numerocompetidor_foreign` (`numeroCompetidor`),
  KEY `puntaje__competidor__carreras_idcarrera_foreign` (`idCarrera`),
  KEY `puntaje__competidor__carreras_idestatus_foreign` (`idEstatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje__competidor__competencias`
--

DROP TABLE IF EXISTS `puntaje__competidor__competencias`;
CREATE TABLE IF NOT EXISTS `puntaje__competidor__competencias` (
  `numeroCompetidor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCompetencia` bigint(20) UNSIGNED NOT NULL,
  `puntajeGlobal` double(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `puntaje__competidor__competencias_numerocompetidor_foreign` (`numeroCompetidor`),
  KEY `puntaje__competidor__competencias_idcompetencia_foreign` (`idCompetencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_carreras`
--

DROP TABLE IF EXISTS `tipo_carreras`;
CREATE TABLE IF NOT EXISTS `tipo_carreras` (
  `idTipoCarrera` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipoCarrera` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

DROP TABLE IF EXISTS `tipo_usuarios`;
CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `idTipoUsuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`idTipoUsuario`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2020-05-24 19:26:31', '2020-05-24 19:26:31'),
(2, 'Registro', '2020-05-24 19:26:31', '2020-05-24 19:26:31'),
(3, 'Consulta', '2020-05-24 19:26:31', '2020-05-24 19:26:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idtipoUsuario` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_idtipousuario_foreign` (`idtipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `idtipoUsuario`) VALUES
(1, 'Root', 'root@mail.com', '$2y$10$FPvG18f9t42ETb0ITIEux.uH62do09JVKZpY8ctjXTqvQcoK8jNjq', NULL, '2020-05-24 19:26:32', '2020-05-24 19:26:32', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD CONSTRAINT `carreras_idcompetencia_foreign` FOREIGN KEY (`idCompetencia`) REFERENCES `competencias` (`idCompetencia`),
  ADD CONSTRAINT `carreras_idtipocarrera_foreign` FOREIGN KEY (`idTipoCarrera`) REFERENCES `tipo_carreras` (`idTipoCarrera`);

--
-- Filtros para la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD CONSTRAINT `competencias_idestatus_foreign` FOREIGN KEY (`idEstatus`) REFERENCES `estatuses` (`idEstatus`);

--
-- Filtros para la tabla `entrenador__competidor__competencias`
--
ALTER TABLE `entrenador__competidor__competencias`
  ADD CONSTRAINT `entrenador__competidor__competencias_idcompetencia_foreign` FOREIGN KEY (`idCompetencia`) REFERENCES `competencias` (`idCompetencia`),
  ADD CONSTRAINT `entrenador__competidor__competencias_identrenador_foreign` FOREIGN KEY (`idEntrenador`) REFERENCES `entrenadors` (`idEntrenador`),
  ADD CONSTRAINT `entrenador__competidor__competencias_numerocompetidor_foreign` FOREIGN KEY (`numeroCompetidor`) REFERENCES `competidors` (`numeroCompetidor`);

--
-- Filtros para la tabla `puntaje__competidor__carreras`
--
ALTER TABLE `puntaje__competidor__carreras`
  ADD CONSTRAINT `puntaje__competidor__carreras_idcarrera_foreign` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`idCarrera`),
  ADD CONSTRAINT `puntaje__competidor__carreras_idestatus_foreign` FOREIGN KEY (`idEstatus`) REFERENCES `estatuses` (`idEstatus`),
  ADD CONSTRAINT `puntaje__competidor__carreras_numerocompetidor_foreign` FOREIGN KEY (`numeroCompetidor`) REFERENCES `competidors` (`numeroCompetidor`);

--
-- Filtros para la tabla `puntaje__competidor__competencias`
--
ALTER TABLE `puntaje__competidor__competencias`
  ADD CONSTRAINT `puntaje__competidor__competencias_idcompetencia_foreign` FOREIGN KEY (`idCompetencia`) REFERENCES `competencias` (`idCompetencia`),
  ADD CONSTRAINT `puntaje__competidor__competencias_numerocompetidor_foreign` FOREIGN KEY (`numeroCompetidor`) REFERENCES `competidors` (`numeroCompetidor`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idtipousuario_foreign` FOREIGN KEY (`idtipoUsuario`) REFERENCES `tipo_usuarios` (`idTipoUsuario`);
COMMIT;
