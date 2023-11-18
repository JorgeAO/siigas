-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2019 a las 19:46:41
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_base`
--
CREATE DATABASE IF NOT EXISTS `bd_base` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_base`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_par_estados`
--

DROP TABLE IF EXISTS `tb_par_estados`;
CREATE TABLE IF NOT EXISTS `tb_par_estados` (
  `esta_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `esta_descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`esta_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_par_estados`
--

INSERT INTO `tb_par_estados` (`esta_codigo`, `esta_descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_par_tipos`
--

DROP TABLE IF EXISTS `tb_par_tipos`;
CREATE TABLE IF NOT EXISTS `tb_par_tipos` (
  `tipo_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_descripcion` varchar(56) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT '1',
  `fc` datetime NOT NULL,
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  PRIMARY KEY (`tipo_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_par_tipos`
--

INSERT INTO `tb_par_tipos` (`tipo_codigo`, `tipo_descripcion`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 'Quitar', 1, '2018-10-15 09:10:32', 1, '2018-10-17 10:10:02', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_modulos`
--

DROP TABLE IF EXISTS `tb_seg_modulos`;
CREATE TABLE IF NOT EXISTS `tb_seg_modulos` (
  `modu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `modu_descripcion` varchar(50) NOT NULL,
  `modu_prefijo` varchar(3) NOT NULL,
  `modu_icono` varchar(20) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`modu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_modulos`
--

INSERT INTO `tb_seg_modulos` (`modu_codigo`, `modu_descripcion`, `modu_prefijo`, `modu_icono`, `fk_par_estados`) VALUES
(1, 'Seguridad', 'seg', 'shield', 1),
(2, 'Parámetros', 'par', 'sliders', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_opciones`
--

DROP TABLE IF EXISTS `tb_seg_opciones`;
CREATE TABLE IF NOT EXISTS `tb_seg_opciones` (
  `opci_codigo` int(11) NOT NULL,
  `fk_seg_modulos` int(11) NOT NULL,
  `opci_nombre` varchar(50) NOT NULL,
  `opci_enlace` varchar(100) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`opci_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_opciones`
--

INSERT INTO `tb_seg_opciones` (`opci_codigo`, `fk_seg_modulos`, `opci_nombre`, `opci_enlace`, `fk_par_estados`) VALUES
(1001, 1, 'Perfiles', 'seguridad/perfiles', 1),
(1002, 1, 'Usuarios', 'seguridad/usuarios', 1),
(1003, 1, 'Permisos', 'seguridad/permisos', 1),
(1004, 1, 'Cambiar Clave', 'seguridad/cambiarClave', 1),
(2001, 2, 'Tipo', 'parametros/tipos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_perfiles`
--

DROP TABLE IF EXISTS `tb_seg_perfiles`;
CREATE TABLE IF NOT EXISTS `tb_seg_perfiles` (
  `perf_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `perf_descripcion` varchar(50) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT '1',
  `fc` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  PRIMARY KEY (`perf_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_perfiles`
--

INSERT INTO `tb_seg_perfiles` (`perf_codigo`, `perf_descripcion`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 'root', 1, '2017-07-01 10:00:00', 1, NULL, NULL),
(3, 'Administrador', 1, '2018-10-13 17:10:39', 1, NULL, NULL),
(5, 'Supervisor', 1, '2018-10-16 17:10:01', 1, '2018-10-18 09:10:20', 1),
(6, 'Cobrador', 1, '2018-10-18 09:10:28', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_permisos`
--

DROP TABLE IF EXISTS `tb_seg_permisos`;
CREATE TABLE IF NOT EXISTS `tb_seg_permisos` (
  `perm_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_seg_perfiles` int(11) NOT NULL,
  `fk_seg_opciones` int(11) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT '1',
  `perm_c` int(11) NOT NULL DEFAULT '0',
  `perm_r` int(11) NOT NULL DEFAULT '0',
  `perm_u` int(11) NOT NULL DEFAULT '0',
  `perm_d` int(11) NOT NULL DEFAULT '0',
  `perm_l` int(11) NOT NULL,
  PRIMARY KEY (`perm_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_permisos`
--

INSERT INTO `tb_seg_permisos` (`perm_codigo`, `fk_seg_perfiles`, `fk_seg_opciones`, `fk_par_estados`, `perm_c`, `perm_r`, `perm_u`, `perm_d`, `perm_l`) VALUES
(5, 3, 1001, 1, 1, 1, 1, 0, 1),
(6, 3, 1002, 1, 0, 0, 0, 0, 1),
(7, 1, 1001, 1, 1, 1, 1, 1, 1),
(8, 1, 1002, 1, 1, 1, 1, 1, 1),
(9, 1, 1003, 1, 1, 1, 1, 1, 1),
(10, 1, 1004, 1, 1, 1, 1, 1, 1),
(11, 1, 2001, 1, 1, 1, 1, 1, 1),
(13, 5, 1004, 1, 1, 0, 0, 0, 0),
(14, 5, 2001, 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_usuarios`
--

DROP TABLE IF EXISTS `tb_seg_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_seg_usuarios` (
  `usua_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usua_nombre` varchar(50) NOT NULL,
  `usua_mail` varchar(100) NOT NULL,
  `usua_login` varchar(20) NOT NULL,
  `usua_clave` varchar(50) NOT NULL,
  `fk_seg_perfiles` int(11) NOT NULL,
  `usua_token` varchar(255) DEFAULT NULL,
  `usua_vcto_token` datetime DEFAULT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT '1',
  `fc` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` smallint(11) DEFAULT NULL,
  PRIMARY KEY (`usua_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_usuarios`
--

INSERT INTO `tb_seg_usuarios` (`usua_codigo`, `usua_nombre`, `usua_mail`, `usua_login`, `usua_clave`, `fk_seg_perfiles`, `usua_token`, `usua_vcto_token`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 'Usuario Root', '', 'root', '202cb962ac59075b964b07152d234b70', 1, '', '0000-00-00 00:00:00', 1, '2017-07-01 10:00:00', 0, '2018-10-23 16:10:03', 1),
(3, 'Administrador Prueba', 'q@q.com', 'admin.prueba', '202cb962ac59075b964b07152d234b70', 3, NULL, NULL, 1, '2018-10-13 17:10:15', 0, '2018-10-13 17:10:26', 1),
(4, 'Visitante Prueba', 'q@q.com', 'visitante', '202cb962ac59075b964b07152d234b70', 5, NULL, NULL, 1, '2018-10-16 17:10:11', 0, '2018-10-16 17:10:37', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
