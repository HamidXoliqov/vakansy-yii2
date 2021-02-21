-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 21 2021 г., 19:47
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vakansy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `employe`
--

CREATE TABLE `employe` (
  `id` int NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country_of_origin` varchar(255) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `hired` tinyint(1) DEFAULT NULL,
  `employe_status_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `updated` int DEFAULT NULL,
  `created` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employe`
--

INSERT INTO `employe` (`id`, `lastname`, `firstname`, `address`, `country_of_origin`, `email`, `phone_number`, `age`, `hired`, `employe_status_id`, `user_id`, `updated`, `created`) VALUES
(5, 'Testeqw', 'Testqew', 'dasdasdasd', 'Test', 'dasdad@faf.cf', '+888123323223', 12, 0, 2, 1, 1613727660, 1613727660),
(6, 'Test modal', 'Test modal', 'Test modal', 'Test modal', 'sada@das.h', '+128382332344', 12, 0, 3, 2, 1613739864, 1613739864),
(7, 'Test modal', 'dsadsadsadasd', 'dasdasdasd', 'adsadsa', 'dasdaqwed@faf.cf', '+568446546546', 312213, 0, 1, NULL, 1613922332, 1613922332),
(8, 'Hamid', 'Hamid', 'Test modal', 'Hamid', 'Hamid@faf.cf', '+238432423423', 12, 0, 1, NULL, 1613922399, 1613922399),
(9, 'Test modal sdfsfs', 'dsadsadsadasd', 'Test modal', 'adsadsa', 'wdasdaqwed@faf.cf', '+138123123123', 12, 0, 2, 2, 1613922579, 1613922579),
(10, 'Test modal', 'Testadas', 'dasdasdasd', 'Test modal', 'qdasdaqwed@faf.cf', '+128312312312', 12, 0, 1, 2, 1613924350, 1613924350);

-- --------------------------------------------------------

--
-- Структура таблицы `employe_history`
--

CREATE TABLE `employe_history` (
  `id` int NOT NULL,
  `employe_id` int DEFAULT NULL,
  `employe_status_id` int NOT NULL,
  `comment` text,
  `diadline_time` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `create_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employe_history`
--

INSERT INTO `employe_history` (`id`, `employe_id`, `employe_status_id`, `comment`, `diadline_time`, `user_id`, `create_at`) VALUES
(2, 5, 3, 'eqw                                \r\n                            ', 1614114000, 1, 1613731375),
(3, 6, 2, 'qeweqw                                \r\n                            ', 1612731600, 2, 1613740174),
(4, 6, 4, 'qwewq                                \r\n                            ', 1613740302, 2, 1613740302),
(5, 6, 3, '    ok                            \r\n                            ', 1614373200, NULL, 1613922259),
(6, 9, 2, 'asdasd                                \r\n                            ', 1614200400, 2, 1613923061);

-- --------------------------------------------------------

--
-- Структура таблицы `employe_status`
--

CREATE TABLE `employe_status` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `updated` int DEFAULT NULL,
  `created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employe_status`
--

INSERT INTO `employe_status` (`id`, `name`, `updated`, `created`) VALUES
(1, 'Yangi', 1613671750, 1613671750),
(2, 'Intervyu belgilangan', 1613671746, 1613671746),
(3, 'Qabul qilingan', 1613671729, 1613671745),
(4, 'Qabul qilinmagan', 1613671744, 1613671744);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1613574037),
('m140506_102106_rbac_init', 1613574044),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1613574045),
('m180523_151638_rbac_updates_indexes_without_prefix', 1613574046),
('m200409_110543_rbac_update_mssql_trigger', 1613574046),
('m210217_153253_create_user_table', 1613576639),
('m210217_153348_create_employe_table', 1613576640),
('m210217_153422_create_employe_status_table', 1613576641),
('m210219_094825_create_employe_history_table', 1613728138);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` int DEFAULT '1',
  `auth_key` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `updated` int DEFAULT NULL,
  `created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `status`, `auth_key`, `password_reset_token`, `updated`, `created`) VALUES
(2, 'Hamid', 'Xoliqov', 'xoliqovhamid@gmail.com', '$2y$13$oIPGY3.gBZXBleHAGtPyJuc/v8ugBdzzvKnDy4navvL8N6fdVKMPS', 'admin', 1, '', NULL, 1613579434, 1613579434),
(10, 'Hamid full', 'Hamid full', 'xoliqovfull@gmail.com', '$2y$13$3n2fS9wUy2WY7I6Y77UvZu/TCkYQjGALw9eBCgYJhBrPfmdrHvgAK', 'user', 1, 'WmVFjTscYwM1Hsh-8OpQYkQONWtBVVv5', NULL, 1613924522, 1613924522);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `employe_history`
--
ALTER TABLE `employe_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-employe_history-employe_id` (`employe_id`);

--
-- Индексы таблицы `employe_status`
--
ALTER TABLE `employe_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `employe_history`
--
ALTER TABLE `employe_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `employe_status`
--
ALTER TABLE `employe_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `employe_history`
--
ALTER TABLE `employe_history`
  ADD CONSTRAINT `fk-employe_history-employe_id` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
