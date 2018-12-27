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

/*INSERT INTO `user` (`login`, `pass`, `dni`, `email`, `role`) VALUES
('biel', 'esselte14', '39581473k', 'daw2glopezmonjo@iesjoanramis.org', 'client'),
('jonathan', 'esselte14', '34567281S', 'daw2jsuarezalvarez@iesjoanramis.org', 'librarian'),
('marc', 'supersegura', '31231231G', 'asdasdasdasd@gmail.com', 'client'),
('user1', 'supersegura', '37291847G', 'no_reply@gmail.com', 'client');*/

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
  `id`              int auto_increment  NOT NULL,
  `category_name`   varchar(25)         NOT NULL,

   CONSTRAINT PK_category PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `category_name`) VALUES
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