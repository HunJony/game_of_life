-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2017. Feb 01. 15:19
-- Kiszolgáló verziója: 10.1.10-MariaDB
-- PHP verzió: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `game_of_life`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `patterns`
--

CREATE TABLE `patterns` (
  `pat_id` int(11) NOT NULL,
  `pat_name` varchar(255) DEFAULT NULL,
  `pat_width` int(11) DEFAULT NULL,
  `pat_height` int(11) DEFAULT NULL,
  `pat_created_at` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `patterns`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pattern_points`
--

CREATE TABLE `pattern_points` (
  `patpoi_id` int(11) NOT NULL,
  `patpoi_pat_id` int(11) DEFAULT NULL,
  `patpoi_x` int(11) DEFAULT NULL,
  `patpoi_y` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `pattern_points`
--

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `patterns`
--
ALTER TABLE `patterns`
  ADD PRIMARY KEY (`pat_id`);

--
-- A tábla indexei `pattern_points`
--
ALTER TABLE `pattern_points`
  ADD PRIMARY KEY (`patpoi_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `patterns`
--
ALTER TABLE `patterns`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT a táblához `pattern_points`
--
ALTER TABLE `pattern_points`
  MODIFY `patpoi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
