-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2019 a las 19:15:11
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `library`
--

CREATE DATABASE library;
USE library;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'Cervantes'),
(2, 'J.K.Rowling'),
(3, 'Tolkien'),
(4, 'Brandon Sanderson');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`id`, `isbn`, `name`, `description`, `category_id`, `author_id`) VALUES
(1, '1823681231123', 'The Lord Of the Rings', 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', 1, 3),
(2, '2147483647123', 'Harry Potter and the chamber of secrets', 'An ancient prophecy seems to be coming true when a mysterious presence begins stalking the corridors of a school of magic and leaving its victims paralyzed.', 5, 2),
(3, '9783453317109', 'The Way of Kings', 'Roshar is a world of stone and storms. Uncanny tempests of incredible power sweep across the rocky terrain so frequently that they have shaped ecology and civilization alike. Animals hide in shells, trees pull in branches, and grass retracts into the soilless ground. Cities are built only where the topography offers shelter.', 1, 4),
(4, '1283747182411', 'Words Of Radiance', 'Expected by his enemies to die the miserable death of a military slave, Kaladin survived to be given command of the royal bodyguards, a controversial first for a low-status \"darkeyes.\" Now he must protect the king and Dalinar from every common peril as well as the distinctly uncommon threat of the Assassin, all while secretly struggling to master remarkable new powers that are somehow linked to his honorspren, Syl.', 1, 4),
(5, '4187264113612', 'Oathbringer', 'In Oathbringer, the third volume of the New York Times bestselling Stormlight Archive, humanity faces a new Desolation with the return of the Voidbringers, a foe with numbers as great as their thirst for vengeance.', 1, 4),
(6, '1273618236128', 'The adventures of Don Quixote', 'Don Quixote is a middle-aged gentleman from the region of La Mancha in central Spain. Obsessed with the chivalrous ideals touted in books he has read, he decides to take up his lance and sword to defend the helpless and destroy the wicked.', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_copy`
--

CREATE TABLE `book_copy` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `book_copy`
--

INSERT INTO `book_copy` (`id`, `book_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 6),
(21, 6),
(22, 6),
(23, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `user_login` varchar(20) NOT NULL,
  `book_copy_id` int(11) NOT NULL,
  `borrowing_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Fantasy'),
(2, 'Horror'),
(3, 'Love'),
(4, 'Adventure'),
(5, 'Magic'),
(6, 'Mystery');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `user_login` varchar(20) NOT NULL,
  `book_id` int(11) NOT NULL,
  `reservation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `login` varchar(20) NOT NULL,
  `pass` varbinary(255) NOT NULL,
  `dni` char(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`login`, `pass`, `dni`, `email`, `role`) VALUES
('angel', 0xb4306cc31975394c76a033c97c595bf6, '12321312G', 'angel@angel.com', 'user'),
('biel', 0xb4306cc31975394c76a033c97c595bf6, '12374591A', 'daw2glopezmonjo@iesjoanramis.org', 'user'),
('jona', 0xe26a8bf6758b85b06f50af446734a749, '11122233K', 'daw2jsuarezalvarez@iesjoanramis.org', 'librarian'),
('pepea', 0xb4306cc31975394c76a033c97c595bf6, '21312312F', 'myself@domain.com', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_category_book` (`category_id`),
  ADD KEY `FK_author_book` (`author_id`);

--
-- Indices de la tabla `book_copy`
--
ALTER TABLE `book_copy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_book_copy_id` (`book_id`);

--
-- Indices de la tabla `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_book_copy_id_borrow` (`book_copy_id`),
  ADD KEY `FK_user_login_borrow` (`user_login`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reserve_id` (`book_id`),
  ADD KEY `FK_reserve_login` (`user_login`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `book_copy`
--
ALTER TABLE `book_copy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_author_book` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_category_book` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `book_copy`
--
ALTER TABLE `book_copy`
  ADD CONSTRAINT `FK_book_copy_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `FK_book_copy_id_borrow` FOREIGN KEY (`book_copy_id`) REFERENCES `book_copy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_login_borrow` FOREIGN KEY (`user_login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `FK_reserve_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reserve_login` FOREIGN KEY (`user_login`) REFERENCES `user` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
