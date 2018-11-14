-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2018 a las 07:04:58
-- Versión del servidor: 5.6.15-log
-- Versión de PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `acl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `idModulo` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(50) DEFAULT NULL COMMENT 'hash',
  `nombre` varchar(50) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idModulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idModulo`, `hash`, `nombre`, `estado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Producto', 'Activo'),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'Venta', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE IF NOT EXISTS `objeto` (
  `idObjeto` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(50) DEFAULT NULL COMMENT 'hash',
  `nombre` varchar(50) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `nombreControl` varchar(50) DEFAULT NULL COMMENT 'Nombre del Controlador de Arranque',
  `orden` int(11) DEFAULT NULL,
  `idModulo` int(11) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idObjeto`),
  KEY `FK_Objeto` (`idModulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `objeto`
--

INSERT INTO `objeto` (`idObjeto`, `hash`, `nombre`, `imagen`, `nombreControl`, `orden`, `idModulo`, `estado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Listar Productos', NULL, 'c-producto-list', 1, 1, 'Activo'),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'Registrar Producto', NULL, 'c-producto-new', 2, 1, 'Activo'),
(3, '77de68daecd823babbb58edb1c8e14d7106e83bb', 'Editar Producto', NULL, 'c-producto-edit', 3, 1, 'Activo'),
(4, '1b6453892473a467d07372d45eb05abc2031647a', 'Eliminar Producto', NULL, 'c-producto-delete', 4, 1, 'Activo'),
(5, 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Listar Ventas', NULL, 'c-venta-list', 5, 2, 'Activo'),
(6, 'c1dfd96eea8cc2b62785275bca38ac261256e278', 'Registrar Venta', NULL, 'c-venta-new', 6, 2, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(50) DEFAULT NULL COMMENT 'hash',
  `nombre` varchar(50) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `hash`, `nombre`, `estado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Administrador', 'Activo'),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'Ejecutivo de Ventas', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_modulo`
--

CREATE TABLE IF NOT EXISTS `rol_modulo` (
  `idRol` int(11) NOT NULL,
  `idModulo` int(11) NOT NULL,
  `hash` varchar(50) DEFAULT NULL COMMENT 'hash',
  `estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idRol`,`idModulo`),
  KEY `FK_UsuarioModulo_2` (`idModulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_modulo`
--

INSERT INTO `rol_modulo` (`idRol`, `idModulo`, `hash`, `estado`) VALUES
(1, 1, '4442a5dbd26972f9c3cdc88ca26d25f692c416f0', 'Activo'),
(1, 2, 'e97543e8793f59c7aa79daebc8d07a0c4b291e52', 'Activo'),
(2, 2, '66f51dd12de258598aca6a343a5217561904c489', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(50) DEFAULT NULL COMMENT 'hash',
  `username` varchar(50) NOT NULL COMMENT 'user',
  `password` blob NOT NULL COMMENT 'pswd',
  `alias` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `idRol` int(11) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FK_Usuario` (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='user' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `hash`, `username`, `password`, `alias`, `email`, `idRol`, `estado`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'admin', 0x60f4aa7481a32daaee8b383667940ec2, 'Admin', 'admin@hotmail.com', 1, 'Activo'),
(2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'vendedor', 0x60f4aa7481a32daaee8b383667940ec2, 'Vendedor', 'vendedor@hotmail.com', 2, 'Activo');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `FK_Objeto` FOREIGN KEY (`idModulo`) REFERENCES `modulo` (`idModulo`);

--
-- Filtros para la tabla `rol_modulo`
--
ALTER TABLE `rol_modulo`
  ADD CONSTRAINT `FK_UsuarioModulo_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `FK_UsuarioModulo_2` FOREIGN KEY (`idModulo`) REFERENCES `modulo` (`idModulo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_Usuario` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
