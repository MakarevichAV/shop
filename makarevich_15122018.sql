-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 12 2019 г., 19:05
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `makarevich_15122018`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `pic` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `article` int(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `price`, `pic`, `category_id`, `article`, `description`) VALUES
(1, 'Куртка синяя', 5400, '1.jpg', 4, 457683, 'Самая лучшая синяя куртка в мире'),
(2, 'Кожаная куртка', 22500, '4.jpg', 4, 4446, 'Самая лучшая кожаная куртка в мире'),
(3, 'Куртка с карманами', 9200, '3.png', 4, 6445, 'Отличная куртка с карманами. Карманы - это круто'),
(4, 'Куртка с капюшоном', 6100, '2.jpg', 4, 228203, 'Отличная куртка с капюшоном. Капюшон - это круто'),
(5, 'Куртка Casual', 8800, '5.jpg', 4, 14542, 'Самая лучшая куртка в мире'),
(6, 'Стильная кожаная куртка', 12800, '6.jpg', 4, 99028, 'Самая стильная кожаная куртка в мире'),
(7, 'Кеды серые', 2900, '7.jpg', 6, 73366, 'Самые серые кеды в мире'),
(8, 'Кеды черные', 4500, '8.jpg', 6, 18214, 'Самые черные кеды в мире'),
(9, 'Кеды Casual', 5900, '9.jpg', 6, 90933, 'Отличные кеды из водонепроницаемого материала. Отлично подходят для любой погоды. Приятно сидят на ноге, стильные и комфортные'),
(10, 'Кеды всепогодные', 9200, '10.jpg', 6, 29328, 'Самые всепогодные кеды в мире'),
(11, 'Джинсы', 4800, '11.jpg', 7, 4476, 'Самые джинсовые джинсы в мире'),
(12, 'Джинсы голубые', 4200, '12.jpg', 7, 485372, 'Самые голубые джинсы в мире');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_category`) VALUES
(1, 'Мужчинам', '0'),
(2, 'Женщинам', '0'),
(3, 'Детям', '0'),
(4, 'Верхняя одежда', '1'),
(5, 'Брюки', '1'),
(6, 'Обувь', '1'),
(7, 'Джинсы', '1'),
(8, 'Верхняя одежда', '2'),
(9, 'Брюки', '2'),
(10, 'Блузы и рубашки', '2'),
(11, 'Платья и сарафаны', '2'),
(12, 'Юбки', '2'),
(13, 'Обувь', '2'),
(14, 'Джинсы', '2'),
(15, 'Верхняя одежда', '3'),
(16, 'Брюки', '3'),
(17, 'Обувь', '3');

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `article` int(15) NOT NULL,
  `size` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `article`, `size`) VALUES
(1, 457683, 'M'),
(2, 457683, 'L'),
(3, 457683, 'XL'),
(4, 4446, 'M'),
(5, 4446, 'L'),
(6, 4446, 'XL'),
(7, 4446, 'XXL'),
(8, 6445, 'M'),
(9, 6445, 'L'),
(10, 6445, 'XL'),
(11, 6445, 'XXL'),
(12, 228203, 'M'),
(13, 228203, 'L'),
(14, 228203, 'XL'),
(16, 14542, 'M'),
(17, 14542, 'L'),
(18, 14542, 'XL'),
(19, 14542, 'XXL'),
(20, 99028, 'L'),
(21, 99028, 'XL'),
(22, 73366, '42'),
(23, 73366, '43'),
(24, 73366, '44'),
(25, 73366, '45'),
(26, 18214, '40'),
(27, 18214, '41'),
(28, 18214, '42'),
(29, 18214, '43'),
(30, 18214, '44'),
(31, 90933, '41'),
(32, 90933, '42'),
(33, 90933, '43'),
(34, 90933, '44'),
(35, 29328, '39'),
(36, 29328, '40'),
(37, 29328, '41'),
(38, 29328, '42'),
(39, 29328, '43'),
(40, 29328, '44'),
(41, 29328, '45'),
(42, 4476, '30'),
(43, 4476, '31'),
(44, 4476, '32'),
(45, 4476, '33'),
(46, 4476, '34'),
(47, 4476, '35'),
(48, 485372, '31'),
(49, 485372, '32'),
(50, 485372, '33'),
(51, 485372, '34'),
(52, 485372, '35'),
(53, 485372, '36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
