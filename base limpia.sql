-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2021 a las 08:41:46
-- Versión del servidor: 5.5.39
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `archivos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cdetalle`
--

CREATE TABLE IF NOT EXISTS `cdetalle` (
  `idprestamo` bigint(20) NOT NULL,
  `tipodoc` varchar(20) NOT NULL,
  `iddoc` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprestamo`
--

CREATE TABLE IF NOT EXISTS `detalleprestamo` (
`iddetalleprestamo` bigint(20) NOT NULL,
  `idprestamo` bigint(20) NOT NULL,
  `tipodoc` varchar(20) COLLATE ucs2_spanish2_ci NOT NULL,
  `iddoc` bigint(20) NOT NULL,
  `estado_doc` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
`iddocumento` bigint(20) NOT NULL,
  `fecharegistro` date NOT NULL,
  `num_documento` bigint(20) NOT NULL,
  `nomraz_social` varchar(200) COLLATE ucs2_spanish2_ci NOT NULL,
  `detalle` varchar(200) COLLATE ucs2_spanish2_ci NOT NULL,
  `importe` float(9,2) NOT NULL,
  `doc_adj` varchar(50) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `observaciones` varchar(200) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `gestion` varchar(20) COLLATE ucs2_spanish2_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE ucs2_spanish2_ci NOT NULL,
  `estado_doc` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE IF NOT EXISTS `prestamo` (
`idprestamo` bigint(20) NOT NULL,
  `nombre` varchar(200) COLLATE ucs2_spanish2_ci NOT NULL,
  `ci` int(8) NOT NULL,
  `dependencia` varchar(20) COLLATE ucs2_spanish2_ci NOT NULL,
  `objeto_prestamo` varchar(200) COLLATE ucs2_spanish2_ci NOT NULL,
  `fecha_prestamo` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tomo`
--

CREATE TABLE IF NOT EXISTS `tomo` (
`idtomo` bigint(20) NOT NULL,
  `fecharegistro` date NOT NULL,
  `num_tomo` bigint(20) NOT NULL,
  `doc_adj` varchar(50) COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `gestion` varchar(20) COLLATE ucs2_spanish2_ci NOT NULL,
  `tipo_tomo` varchar(20) COLLATE ucs2_spanish2_ci NOT NULL,
  `estado_tomo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`idusuario` int(11) NOT NULL,
  `cuenta` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `habilitado` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `cuenta`, `password`, `habilitado`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'cmartinez', '33b8b0195fa5a3d546181cf4ba36d5aa', 1),
(3, 'boris', '8b906286b443928eb59c3067d48b36b7', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
 ADD PRIMARY KEY (`iddetalleprestamo`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
 ADD PRIMARY KEY (`iddocumento`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
 ADD PRIMARY KEY (`idprestamo`);

--
-- Indices de la tabla `tomo`
--
ALTER TABLE `tomo`
 ADD PRIMARY KEY (`idtomo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
MODIFY `iddetalleprestamo` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
MODIFY `iddocumento` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
MODIFY `idprestamo` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tomo`
--
ALTER TABLE `tomo`
MODIFY `idtomo` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
