-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 05 2020 г., 23:23
-- Версия сервера: 5.5.58-MariaDB
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tasklist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `description`, `created_at`, `status`) VALUES
(43, 30, 'Сделать домашку', '2020-11-04 15:25:28', 'done'),
(45, 35, 'Поести', '2020-11-04 15:26:10', '1'),
(46, 35, 'Пойти на работу', '2020-11-04 15:26:20', '0'),
(47, 30, 'Одеться', '2020-11-05 12:51:10', 'done'),
(48, 30, 'dada', '2020-11-05 13:38:45', 'not_done'),
(49, 30, 'Полить цветы', '2020-11-05 13:38:57', 'not_done');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `created_at`) VALUES
(30, 'MrMeshok', '$2y$10$YlfznPh.GJ58rb9zHElhb.P71HppUVQpNRTaJ3hfAi1l7Ike1bj9q', '2020-11-02 13:51:46'),
(31, 'MrMeshok2', '$2y$10$Bxffpq9seiwVAbh8VzFT6OsEvkVd1O814MbdlVto/wymVe33qXFnC', '2020-11-02 13:53:41'),
(32, '', '$2y$10$Er/VNPWbZCHI.k19orqIFe..GyRLIbaRSg/YcA88/Hq3pW5zCOYU.', '2020-11-04 13:37:18'),
(33, 'MrMeshokfa', '$2y$10$260pufb0GgXgY0UfTcozWO5EDwJ5bjh3My4XdcZGCXfCiiEaGPbPe', '2020-11-04 13:45:00'),
(34, 'Ilya', '$2y$10$msyX3G6juN2cA/.dqii4nO1oHS40YpxfOYS2no0bN.AP7KjT2wKLW', '2020-11-04 14:43:14'),
(35, 'Игорь', '$2y$10$Zb4G4M76sn3wusj4LS3pKO4H2ab5oFO4ZU66E4NKnEwFv2OcqeI2K', '2020-11-04 15:26:01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_unique` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
