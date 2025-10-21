-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2025 a las 02:37:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_videojuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre`, `descripcion`) VALUES
(1, 'RPG', 'Juegos de rol donde tomás decisiones que afectan la historia'),
(2, 'Metroidvania', 'Juegos de acción y aventura en mundo interconectado, donde el jugador explora mapas no lineales, adquiere habilidades que desbloquean nuevas áreas y suele volver sobre zonas ya visitadas para progresar.'),
(3, 'MMORPG', 'Juegos de rol multijugador masivo en línea donde cientos o miles de jugadores interactúan simultáneamente en un mundo persistente, completando misiones, subiendo niveles, formando grupos y participando en combates o eventos sociales.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user_name`, `password`) VALUES
(1, 'webadmin', '$2b$10$vmucttHXCoC9Js7gMf9ZpuND62Ky9GCIL/O8etyZSCfILYUkXKrWi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `id_videojuego` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `anio_publicacion` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`id_videojuego`, `titulo`, `id_genero`, `anio_publicacion`, `imagen`, `sinopsis`) VALUES
(1, 'The Witcher 3: Wild Hunt', 1, 2015, '', 'Sigue a Geralt de Rivia en su búsqueda de Ciri mientras enfrenta la Cacería Salvaje'),
(2, 'Hollow Knight', 2, 2017, 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/367520/header.jpg?t=1695270428', 'Explora Hallownest, un vasto y antiguo reino subterráneo habitado por insectos y misteriosas criaturas. Como el misterioso Caballero, te enfrentarás a enemigos peligrosos, descubrirás secretos ocultos, desbloquearás habilidades únicas y desentrañarás la oscura historia que ha corrompido este mundo olvidado.'),
(3, 'World of Warcraft', 3, 2004, '', 'Sumérgete en Azeroth, un mundo masivo y persistente donde miles de jugadores interactúan en línea. Crea tu personaje, elige tu raza y clase, completa misiones, explora vastos territorios, participa en mazmorras y raids con otros jugadores, y forma parte de la épica lucha entre la Horda y la Alianza mientras descubres la rica historia del mundo.'),
(5, 'Hollow Knight: Silksong', 2, 2025, 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_656/b_white/f_auto/q_auto/store/software/switch/70010000020840/60eebc8f7133f685eddbffbe43c8da617ba0a5d699f2008f9c31c6119d1792af', 'En Silksong, encarnas a Hornet, la aguerrida protectora de Hallownest, transportada a un misterioso reino completamente nuevo. Explora vastos y verticales escenarios, enfréntate a enemigos únicos y jefes desafiantes, desbloquea habilidades especiales y desentraña los secretos oscuros de este nuevo mundo en tu viaje para descubrir tu destino.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`id_videojuego`),
  ADD KEY `id_genero` (`id_genero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `id_videojuego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD CONSTRAINT `videojuegos_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
