-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 16 2018 г., 16:51
-- Версия сервера: 10.1.25-MariaDB
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `strip`
--

-- --------------------------------------------------------

--
-- Структура таблицы `t_afisha`
--

CREATE TABLE `t_afisha` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `banner` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(250) NOT NULL,
  `day_in` int(11) NOT NULL,
  `day_out` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_afisha`
--

INSERT INTO `t_afisha` (`id`, `name`, `banner`, `description`, `photo`, `day_in`, `day_out`, `status`) VALUES
(1, '1', '1', '1', '1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `t_banner`
--

CREATE TABLE `t_banner` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `name` varchar(300) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_banner`
--

INSERT INTO `t_banner` (`id`, `status`, `img`, `name`, `sort`) VALUES
(3, 1, '8.jpg', 'Баннер главный', 1),
(4, 1, '2.jpg', 'второй банер', 2),
(5, 1, '1.jpg', '3', 3),
(6, 1, '5.jpg', '3', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `t_girls`
--

CREATE TABLE `t_girls` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `about` text NOT NULL,
  `img` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_girls`
--

INSERT INTO `t_girls` (`id`, `name`, `about`, `img`, `status`) VALUES
(4, 'Irina', 'Какой-то текст', '10.png', 1),
(5, 'Katy', 'text', '56.png', 1),
(6, 'Mary', 'text', '3.png', 1),
(7, 'Helen', 'text', '55.png', 0),
(8, 'Sahra', 'text', '2.png', 1),
(9, 'Annabel', 'text', '4.png', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `t_afisha`
--
ALTER TABLE `t_afisha`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `t_banner`
--
ALTER TABLE `t_banner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `t_girls`
--
ALTER TABLE `t_girls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `t_afisha`
--
ALTER TABLE `t_afisha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `t_banner`
--
ALTER TABLE `t_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `t_girls`
--
ALTER TABLE `t_girls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
