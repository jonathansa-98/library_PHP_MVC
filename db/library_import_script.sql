-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2018 a las 16:16:57
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
(3, 'Tolkien');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `isbn` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` varchar(25) NOT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`isbn`, `name`, `category_id`, `author_id`) VALUES
(1823681231, 'The Lord Of the Rings', '1', 3),
(2147483647, 'Harry Potter and the chamber of secrets', '1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_copy`
--

CREATE TABLE `book_copy` (
  `id` int(11) NOT NULL,
  `book_isbn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `book_copy`
--

INSERT INTO `book_copy` (`id`, `book_isbn`) VALUES
(1, 1823681231),
(2, 1823681231),
(3, 1823681231),
(4, 1823681231);

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
(1, 'fantasy'),
(2, 'horror'),
(3, 'love'),
(17, 'pepe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `user_login` varchar(20) NOT NULL,
  `book_isbn` int(11) NOT NULL,
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
('angel', 0xd67241fa97a2bc93d92ec0167446b989, '12321312G', 'angel@angel.com', 'user'),
('biel', 0xb4306cc31975394c76a033c97c595bf6, '12374591A', 'daw2glopezmonjo@iesjoanramis.org', 'user'),
('jona', 0xe26a8bf6758b85b06f50af446734a749, '11122233K', 'daw2jsuarezalvarez@iesjoanramis.org', 'librarian'),
('pepea', 0x559525453cd4bcdde670232210498c03, '21312312F', 'myself@domain.com', 'user');

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
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `FK_author_book` (`author_id`);

--
-- Indices de la tabla `book_copy`
--
ALTER TABLE `book_copy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_book_copy_isbn` (`book_isbn`);

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
  ADD KEY `FK_reserve_isbn` (`book_isbn`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `book_copy`
--
ALTER TABLE `book_copy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  ADD CONSTRAINT `FK_author_book` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `book_copy`
--
ALTER TABLE `book_copy`
  ADD CONSTRAINT `FK_book_copy_isbn` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_reserve_isbn` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reserve_login` FOREIGN KEY (`user_login`) REFERENCES `user` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
