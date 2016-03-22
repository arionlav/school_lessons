-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 22 2016 г., 16:23
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `school_lessons`
--

-- --------------------------------------------------------

--
-- Структура таблицы `count_course`
--

CREATE TABLE IF NOT EXISTS `count_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Course number id',
  `course_year` char(4) NOT NULL COMMENT 'Year',
  `course_name_id` smallint(5) unsigned NOT NULL COMMENT 'Course id',
  `course_month` tinyint(4) NOT NULL COMMENT 'Mounth',
  `count_courses` smallint(5) unsigned NOT NULL COMMENT 'The number of courses',
  PRIMARY KEY (`id`),
  KEY `ixCourseNameId` (`course_name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2221 ;

--
-- Дамп данных таблицы `count_course`
--

INSERT INTO `count_course` (`id`, `course_year`, `course_name_id`, `course_month`, `count_courses`) VALUES
(2041, '2015', 1, 0, 58),
(2042, '2015', 1, 1, 48),
(2043, '2015', 1, 2, 92),
(2044, '2015', 1, 3, 47),
(2045, '2015', 1, 4, 65),
(2046, '2015', 1, 5, 42),
(2047, '2015', 1, 6, 76),
(2048, '2015', 1, 7, 35),
(2049, '2015', 1, 8, 16),
(2050, '2015', 1, 9, 82),
(2051, '2015', 1, 10, 48),
(2052, '2015', 1, 11, 36),
(2053, '2015', 2, 0, 97),
(2054, '2015', 2, 1, 26),
(2055, '2015', 2, 2, 48),
(2056, '2015', 2, 3, 75),
(2057, '2015', 2, 4, 19),
(2058, '2015', 2, 5, 36),
(2059, '2015', 2, 6, 17),
(2060, '2015', 2, 7, 45),
(2061, '2015', 2, 8, 28),
(2062, '2015', 2, 9, 65),
(2063, '2015', 2, 10, 74),
(2064, '2015', 2, 11, 84),
(2065, '2015', 3, 0, 47),
(2066, '2015', 3, 1, 56),
(2067, '2015', 3, 2, 44),
(2068, '2015', 3, 3, 95),
(2069, '2015', 3, 4, 27),
(2070, '2015', 3, 5, 19),
(2071, '2015', 3, 6, 65),
(2072, '2015', 3, 7, 23),
(2073, '2015', 3, 8, 58),
(2074, '2015', 3, 9, 49),
(2075, '2015', 3, 10, 46),
(2076, '2015', 3, 11, 42),
(2077, '2015', 4, 0, 97),
(2078, '2015', 4, 1, 59),
(2079, '2015', 4, 2, 42),
(2080, '2015', 4, 3, 47),
(2081, '2015', 4, 4, 56),
(2082, '2015', 4, 5, 85),
(2083, '2015', 4, 6, 17),
(2084, '2015', 4, 7, 59),
(2085, '2015', 4, 8, 52),
(2086, '2015', 4, 9, 46),
(2087, '2015', 4, 10, 57),
(2088, '2015', 4, 11, 42),
(2089, '2015', 5, 0, 32),
(2090, '2015', 5, 1, 25),
(2091, '2015', 5, 2, 63),
(2092, '2015', 5, 3, 48),
(2093, '2015', 5, 4, 25),
(2094, '2015', 5, 5, 46),
(2095, '2015', 5, 6, 74),
(2096, '2015', 5, 7, 88),
(2097, '2015', 5, 8, 12),
(2098, '2015', 5, 9, 65),
(2099, '2015', 5, 10, 26),
(2100, '2015', 5, 11, 59),
(2161, '2016', 1, 0, 58),
(2162, '2016', 1, 1, 48),
(2163, '2016', 1, 2, 92),
(2164, '2016', 1, 3, 47),
(2165, '2016', 1, 4, 65),
(2166, '2016', 1, 5, 42),
(2167, '2016', 1, 6, 76),
(2168, '2016', 1, 7, 35),
(2169, '2016', 1, 8, 16),
(2170, '2016', 1, 9, 82),
(2171, '2016', 1, 10, 48),
(2172, '2016', 1, 11, 36),
(2173, '2016', 2, 0, 97),
(2174, '2016', 2, 1, 26),
(2175, '2016', 2, 2, 48),
(2176, '2016', 2, 3, 75),
(2177, '2016', 2, 4, 19),
(2178, '2016', 2, 5, 36),
(2179, '2016', 2, 6, 17),
(2180, '2016', 2, 7, 45),
(2181, '2016', 2, 8, 28),
(2182, '2016', 2, 9, 65),
(2183, '2016', 2, 10, 74),
(2184, '2016', 2, 11, 84),
(2185, '2016', 3, 0, 47),
(2186, '2016', 3, 1, 56),
(2187, '2016', 3, 2, 44),
(2188, '2016', 3, 3, 95),
(2189, '2016', 3, 4, 27),
(2190, '2016', 3, 5, 19),
(2191, '2016', 3, 6, 65),
(2192, '2016', 3, 7, 23),
(2193, '2016', 3, 8, 58),
(2194, '2016', 3, 9, 49),
(2195, '2016', 3, 10, 46),
(2196, '2016', 3, 11, 42),
(2197, '2016', 4, 0, 97),
(2198, '2016', 4, 1, 59),
(2199, '2016', 4, 2, 42),
(2200, '2016', 4, 3, 47),
(2201, '2016', 4, 4, 56),
(2202, '2016', 4, 5, 85),
(2203, '2016', 4, 6, 17),
(2204, '2016', 4, 7, 59),
(2205, '2016', 4, 8, 52),
(2206, '2016', 4, 9, 46),
(2207, '2016', 4, 10, 57),
(2208, '2016', 4, 11, 42),
(2209, '2016', 5, 0, 32),
(2210, '2016', 5, 1, 25),
(2211, '2016', 5, 2, 63),
(2212, '2016', 5, 3, 48),
(2213, '2016', 5, 4, 25),
(2214, '2016', 5, 5, 46),
(2215, '2016', 5, 6, 74),
(2216, '2016', 5, 7, 88),
(2217, '2016', 5, 8, 12),
(2218, '2016', 5, 9, 65),
(2219, '2016', 5, 10, 26),
(2220, '2016', 5, 11, 59);

-- --------------------------------------------------------

--
-- Структура таблицы `course_name`
--

CREATE TABLE IF NOT EXISTS `course_name` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Course id',
  `course_name` varchar(25) NOT NULL COMMENT 'Course name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `course_name`
--

INSERT INTO `course_name` (`id`, `course_name`) VALUES
(1, 'VN'),
(2, 'PT'),
(3, 'MA'),
(4, 'MRI'),
(5, 'PHL');

-- --------------------------------------------------------

--
-- Структура таблицы `graph_types`
--

CREATE TABLE IF NOT EXISTS `graph_types` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Graph type id',
  `nameGraphType` varchar(25) NOT NULL COMMENT 'Graph type name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `graph_types`
--

INSERT INTO `graph_types` (`id`, `nameGraphType`) VALUES
(1, 'Lines'),
(2, 'Circle');

-- --------------------------------------------------------

--
-- Структура таблицы `user_privilege`
--

CREATE TABLE IF NOT EXISTS `user_privilege` (
  `idPrivilege` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User privilegies id',
  `namePrivilege` varchar(25) NOT NULL COMMENT 'User privilegies name',
  PRIMARY KEY (`idPrivilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user_privilege`
--

INSERT INTO `user_privilege` (`idPrivilege`, `namePrivilege`) VALUES
(1, 'Full access'),
(2, 'Only search');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `idRole` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User role id',
  `nameRole` varchar(25) NOT NULL COMMENT 'User role name',
  `idPrivilege` tinyint(3) unsigned NOT NULL COMMENT 'User privilegies id',
  PRIMARY KEY (`idRole`),
  KEY `ixIdPrivilege` (`idPrivilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`idRole`, `nameRole`, `idPrivilege`) VALUES
(1, 'Admin', 1),
(2, 'Manager', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_users`
--

CREATE TABLE IF NOT EXISTS `user_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User id',
  `login` varchar(32) NOT NULL COMMENT 'User login',
  `password` varchar(100) NOT NULL COMMENT 'User password',
  `salt` varchar(100) NOT NULL COMMENT 'Salt for password',
  `iterationCount` tinyint(3) unsigned NOT NULL COMMENT 'The number of iteration for password hash',
  `role` tinyint(3) unsigned NOT NULL COMMENT 'User role id',
  `graph_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Graph type id',
  PRIMARY KEY (`id`),
  KEY `ixRole` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user_users`
--

INSERT INTO `user_users` (`id`, `login`, `password`, `salt`, `iterationCount`, `role`, `graph_type`) VALUES
(1, 'admin', '21ee475d1b635f080e94d27b1f7f8a05d1c67261539e2c456cc816dc9b3d33eb', '1531016381561272fc644561.88846557', 84, 1, 1),
(2, 'alex', '21ee475d1b635f080e94d27b1f7f8a05d1c67261539e2c456cc816dc9b3d33eb', '1531016381561272fc644561.88846557', 84, 2, 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `count_course`
--
ALTER TABLE `count_course`
  ADD CONSTRAINT `fxCourseName` FOREIGN KEY (`course_name_id`) REFERENCES `course_name` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fxUserPrivilege` FOREIGN KEY (`idPrivilege`) REFERENCES `user_privilege` (`idPrivilege`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_users`
--
ALTER TABLE `user_users`
  ADD CONSTRAINT `fxUserRole` FOREIGN KEY (`role`) REFERENCES `user_role` (`idRole`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
