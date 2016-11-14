-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Mar 2016, 02:29
-- Wersja serwera: 10.1.10-MariaDB
-- Wersja PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id_category` INT(11)              NOT NULL,
  `name`        VARCHAR(50)
                CHARACTER SET latin1 NOT NULL,
  `description` VARCHAR(200)
                CHARACTER SET latin1 NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `description`) VALUES
  (1, 'meskie', 'Kategoria ta, zawiera zegarki meskie'),
  (2, 'damskie', 'Kategoria ta, zawiera zegarki damskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id_news`     INT(11)                   NOT NULL,
  `title`       VARCHAR(100)
                CHARACTER SET latin1      NOT NULL,
  `description` TEXT CHARACTER SET latin1 NOT NULL,
  `post_date`   DATE                      NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id_order`        INT(11)        NOT NULL,
  `user_id`         INT(11)        NOT NULL,
  `product_id`      INT(11)        NOT NULL,
  `total`           DECIMAL(10, 2) NOT NULL,
  `additional_info` VARCHAR(255)
                    CHARACTER SET latin1 DEFAULT NULL,
  `order_date`      DATE                 DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id_order`, `user_id`, `product_id`, `total`, `additional_info`, `order_date`) VALUES
  (1, 1, 1, '19.99', 'jakies tam informacje dodatkowe', '2016-03-28');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `id_photo` INT(11)              NOT NULL,
  `path`     VARCHAR(200)
             CHARACTER SET latin1 NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Zrzut danych tabeli `photos`
--

INSERT INTO `photos` (`id_photo`, `path`) VALUES
  (1, 'img/1.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id_product`  INT(11)                   NOT NULL,
  `name`        VARCHAR(50)
                CHARACTER SET latin1      NOT NULL,
  `description` TEXT CHARACTER SET latin1 NOT NULL,
  `price`       DECIMAL(8, 2)             NOT NULL,
  `category_id` INT(11)                   NOT NULL,
  `photo_id`    INT(11)                   NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `category_id`, `photo_id`) VALUES
  (1, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (4, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (5, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (6, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (7, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (8, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (9, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (10, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (11, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (12, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (13, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (14, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (15, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (16, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (17, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (18, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (19, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (20, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (21, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (22, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (23, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (24, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (25, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (26, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (27, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (28, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (29, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (30, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (31, 'Zegarek Geneva', 'Opis zegarka geneva koloru zlotego', '19.99', 1, 1),
  (32, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1),
  (34, 'Zegarek Genewa Women', 'R&oacute;Å¼owy zegarek dla kobiet', '30.00', 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user`    INT(11)              NOT NULL,
  `nick`       VARCHAR(50)
               CHARACTER SET latin1 NOT NULL,
  `password`   VARCHAR(50)
               CHARACTER SET latin1 NOT NULL,
  `permission` TINYINT(1)           NOT NULL,
  `name`       VARCHAR(50)
               CHARACTER SET latin1 NOT NULL,
  `surname`    VARCHAR(50)
               CHARACTER SET latin1 NOT NULL,
  `city`       VARCHAR(50)
               CHARACTER SET latin1 NOT NULL,
  `street`     VARCHAR(50)
               CHARACTER SET latin1 NOT NULL,
  `tel`        VARCHAR(50)
               CHARACTER SET latin1 NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


CREATE TABLE `session` (
  `id_session` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id`    INT(10) UNSIGNED NOT NULL,
  `id`         VARCHAR(64)      NOT NULL,
  `ip`         VARCHAR(39)               DEFAULT NULL,
  `web`        VARCHAR(200)              DEFAULT NULL,
  `time`       TIMESTAMP        NULL     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_session`)
)





  --
  -- Zrzut danych tabeli `users`
  --

  INSERT INTO `users` (`id_user`, `nick`, `password`, `permission`, `name`, `surname`, `city`, `street`, `tel`
) VALUES
(1, 'wojot', 'wojtek', 1, 'Wojciech', 'Ciuba', 'Podolsze', 'Jutrzenki 5', '666700779'
);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`id_order`),
ADD KEY `product_id` (`product_id`),
ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
ADD PRIMARY KEY (`id_photo`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD PRIMARY KEY (`id_product`),
ADD KEY `category_id` (`category_id`, `photo_id`),
ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
MODIFY `id_category` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
MODIFY `id_news` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
MODIFY `id_order` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT dla tabeli `photos`
--
ALTER TABLE `photos`
MODIFY `id_photo` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
MODIFY `id_product` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 35;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id_user` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`),
ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);


ALTER TABLE `session`
ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);


--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`),
ADD CONSTRAINT `photo_id` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id_photo`);

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
