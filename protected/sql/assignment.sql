-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Máj 10. 17:55
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `assignment`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filenames`
--

CREATE TABLE `filenames` (
  `vehicle_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `filenames`
--

INSERT INTO `filenames` (`vehicle_id`, `file_name`) VALUES
(1, 'civic.jpg'),
(2, 'focus.jpg'),
(4, 'crv.jpeg'),
(5, 'gle.jpeg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fuel`
--

CREATE TABLE `fuel` (
  `fueling_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `fuel_quantity` float NOT NULL,
  `fuel_cost` int(11) NOT NULL,
  `fuel_cost_per_liter` float NOT NULL,
  `fuel_station_name` varchar(250) NOT NULL,
  `vehicle_before_trip_clock` int(11) NOT NULL,
  `vehicle_actual_clock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `fuel`
--

INSERT INTO `fuel` (`fueling_id`, `vehicle_id`, `fuel_quantity`, `fuel_cost`, `fuel_cost_per_liter`, `fuel_station_name`, `vehicle_before_trip_clock`, `vehicle_actual_clock`) VALUES
(1, 1, 44.8, 13793, 307.879, 'OMW', 45000, 45629),
(2, 1, 40.8, 12652, 310.098, 'Shell', 45629, 46237),
(3, 5, 61.7, 20145, 326.499, 'MOL', 1000, 1387);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name_first` varchar(64) NOT NULL,
  `name_last` varchar(64) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `access_level` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`user_id`, `name_first`, `name_last`, `email_address`, `user_password`, `access_level`) VALUES
(1, 'Roland', 'Erdélyi', 'erdelyi.roland99@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(2, 'Elek', 'Teszt', 'Teszt@elek.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_brand` varchar(250) NOT NULL,
  `vehicle_model` varchar(250) NOT NULL,
  `vehicle_clock` int(11) NOT NULL,
  `vehicle_fuel_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `user_id`, `vehicle_brand`, `vehicle_model`, `vehicle_clock`, `vehicle_fuel_type`) VALUES
(1, 1, 'Honda', 'Civic Type R', 46250, 0),
(2, 2, 'Ford', 'Focus', 12000, 1),
(4, 1, 'Honda', 'CRV', 87000, 0),
(5, 1, 'Mercedes Benz', 'GLE Coupé', 1387, 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `filenames`
--
ALTER TABLE `filenames`
  ADD UNIQUE KEY `vehicle_id` (`vehicle_id`);

--
-- A tábla indexei `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`fueling_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `fuel`
--
ALTER TABLE `fuel`
  MODIFY `fueling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
