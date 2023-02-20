-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Фев 20 2023 г., 17:45
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `avito`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(8) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'other'),
(2, 'real_estate'),
(3, 'technique'),
(4, 'clothing'),
(5, 'furniture'),
(6, 'work'),
(7, 'sport'),
(8, 'musical_instruments'),
(9, 'recreation_and_entertainment'),
(10, 'transport');

-- --------------------------------------------------------

--
-- Структура таблицы `favorite`
--

CREATE TABLE `favorite` (
  `id` int(8) NOT NULL,
  `login` varchar(16) NOT NULL,
  `id_product` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `favorite`
--

INSERT INTO `favorite` (`id`, `login`, `id_product`) VALUES
(3, 'admin', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(8) NOT NULL,
  `id_categ` int(8) NOT NULL,
  `id_user` int(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `descr` varchar(512) NOT NULL,
  `price` int(10) NOT NULL,
  `view` int(10) NOT NULL,
  `img` varchar(64) NOT NULL,
  `adress` varchar(128) NOT NULL,
  `date_create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `id_categ`, `id_user`, `name`, `descr`, `price`, `view`, `img`, `adress`, `date_create`) VALUES
(1, 1, 1, 'iphone 13', 'Iphone 13 new, one year', 700, 209, 'Iphone 13.jpeg', 'ffsafas', '2023-01-21'),
(2, 3, 4, 'Iphone', 'Iphone 13 new, one year', 700, 8, 'Iphone 13.jpeg', 'ffsafas', '2023-01-21'),
(3, 1, 7, 'Iphone 12', 'Iphone 13 new, one year', 700, 1, 'Iphone 13.jpeg', 'ffsafas', '2023-01-21'),
(4, 3, 4, 'Iphone 13', 'Iphone 13 new, one year', 700, 3, 'Iphone_13.jpeg', 'ffsafas', '2023-01-21'),
(5, 1, 3, 'Iphone 13', 'Iphone 13 new, one year', 700, 5, 'Iphone_13.jpeg', 'ffsafas', '2023-01-21'),
(6, 1, 5, 'Iphone 13', 'Iphone 13 new, one year', 700, 5, 'Iphone_13.jpeg', 'ffsafas', '2023-01-21'),
(7, 1, 6, 'Iphone 13', 'Iphone 13 new, one year', 700, 0, 'Iphone_13.jpeg', 'ffsafas', '2023-01-21');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `login` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `verify` varchar(16) NOT NULL,
  `block` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL,
  `img` varchar(32) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `phone`, `email`, `verify`, `block`, `status`, `img`, `date_reg`) VALUES
(1, 'admin', '$2y$10$GHDf7fHbUu7mksFxU4o6R.61s4HDEjbuNKcwu3ZTZep8DVb1ju8R.', 'Nikanor', 'Burlaku', '', 'nicanorburlacu@gmail.com', 'true', 'false', 'admin', 'default.png', '2022-11-29'),
(3, 'admin2', '$2y$10$g.cTR9B/vr5TyFVLxjyuUOOljbYmAH2plAKbZC1YtiWY/wcwj5Teq', 'avito', 'Бурлаку1', '', 'nicanorburlacu@gmail.com', 'false', 'false', 'admin', 'default.png', '2023-02-01'),
(4, 'admin3', '$2y$10$jn8mdkWRHewAChQHucgycuGDD/QEXJabLzIoPDsV620uFH5xAkuKa', 'avito', 'Sui', '', 'nicanorburlacu@gmail.com', 'false', 'false', 'user', 'default.png', '2023-02-01'),
(5, 'admin4', '$2y$10$zHK6flDFCyc6Klj6Zw8CM.7Lx9WWWU2tYbyoCGuYRDKMDjaDLRFfm', 'avito', 'Dag', '', 'nicanorburlacu@gmail.com', 'false', 'false', 'user', 'default.png', '2023-02-01'),
(6, 'admin5', '$2y$10$TOv3kT67IbiUd8EZuPiGwOwmL9atC.Ut7LPpyZ4OarYan4aSsEVSG', 'avito', 'Бурлаку1', '', 'nicanorburlacu@gmail.com', 'false', 'false', 'user', 'default.png', '2023-02-01'),
(7, 'admin7', '$2y$10$eKlrWSHtNHvBPBz1kLr.TeG.xBKl35VxHCtTXg2CWCGcV7IIA1Of6', 'avito', 'Бурлаку6', '', 'nicanorburlacu@gmail.com', 'false', 'false', 'user', 'admin7.png', '2023-02-01'),
(8, 'admin213123', '$2y$10$IUXWs4OBHLvSdyBZSQIHKecbL0XC1BjG3Y7mnXe9aTblviiEfHAjy', 'avito', 'Бурлаку6', '', 'nicanorburlacu@gmail.com', 'false', 'false', 'user', 'admin213123.png', '2023-02-01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`),
  ADD KEY `login_2` (`login`),
  ADD KEY `id_product` (`id_product`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categ` (`id_categ`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_categ`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
