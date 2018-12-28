CREATE database library;
USE library;

-- --------------------------------------------------------

CREATE TABLE `user` (
  `login`   varchar(20) NOT NULL,
  `pass`    VARBINARY(255) NOT NULL,
  `dni`     char(9)     NOT NULL,
  `email`   varchar(50) NOT NULL,
  `role`    varchar(20) NOT NULL,

   CONSTRAINT PK_user PRIMARY KEY (login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`login`, `pass`, `dni`, `email`, `role`) VALUES
('angel', 0xd67241fa97a2bc93d92ec0167446b989, '12321312G', 'angel@angel.com', 'user'),
('biel', 0xb4306cc31975394c76a033c97c595bf6, '12374591A', 'daw2glopezmonjo@iesjoanramis.org', 'user'),
('jona', 0xe26a8bf6758b85b06f50af446734a749, '11122233K', 'daw2jsuarezalvarez@iesjoanramis.org', 'librarian'),
('pepea', 0x559525453cd4bcdde670232210498c03, '21312312F', 'myself@domain.com', 'user');

-- --------------------------------------------------------

CREATE TABLE `author` (
  `id`      int auto_increment  NOT NULL,
  `name`    varchar(50)         NOT NULL,

   CONSTRAINT PK_author PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'Cervantes'),
(2, 'J.K.Rowling'),
(3, 'Tolkien');

-- --------------------------------------------------------

CREATE TABLE `category` (
  `id`     int auto_increment  NOT NULL,
  `name`   varchar(25)         NOT NULL,

   CONSTRAINT PK_category PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'fantasy'),
(2, 'horror'),
(3, 'love');

-- --------------------------------------------------------

CREATE TABLE `book` (
  `isbn`        int             NOT NULL,
  `name`        varchar(100)    NOT NULL,
  `category_id` varchar(25)     NOT NULL,
  `author_id`   int             DEFAULT NULL,

   CONSTRAINT `PK_book` PRIMARY KEY (isbn),
   CONSTRAINT `FK_author_book` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `book` (`isbn`, `name`, `category_id`, `author_id`) VALUES
(1823681231, 'The Lord Of the Rings', 1, 3),
(2147483647, 'Harry Potter and the chamber of secrets', 1, 2);

-- --------------------------------------------------------

CREATE TABLE `book_copy` (
  `id`          int auto_increment NOT NULL,
  `book_isbn`   int                NOT NULL,

   CONSTRAINT `PK_book_copy` PRIMARY KEY (id),
   CONSTRAINT `FK_book_copy_isbn` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `book_copy` (`id`, `book_isbn`) VALUES
(1, 1823681231),
(2, 1823681231),
(3, 1823681231),
(4, 1823681231);

-- --------------------------------------------------------

CREATE TABLE `borrow` (
  `id`              int auto_increment NOT NULL,
  `user_login`      varchar(20)        NOT NULL,
  `book_copy_id`    int                NOT NULL,
  `borrowing_date`  datetime           DEFAULT NULL,
  `return_date`     datetime           DEFAULT NULL,

   CONSTRAINT `PK_borrow` PRIMARY KEY (id),
   CONSTRAINT `FK_book_copy_id_borrow` FOREIGN KEY (`book_copy_id`) REFERENCES `book_copy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
   CONSTRAINT `FK_user_login_borrow` FOREIGN KEY (`user_login`) REFERENCES `user` (`login`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `reserve` (
  `id`                  int auto_increment  NOT NULL,
  `user_login`          varchar(20)         NOT NULL,
  `book_isbn`           int                 NOT NULL,
  `reservation_date`    datetime            DEFAULT NULL,

   CONSTRAINT `PK_reserve` PRIMARY KEY (id),
   CONSTRAINT `FK_reserve_isbn` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`) ON DELETE NO ACTION ON UPDATE CASCADE,
   CONSTRAINT `FK_reserve_login` FOREIGN KEY (`user_login`) REFERENCES `user` (`login`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;