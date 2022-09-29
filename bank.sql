-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 27. 04:06
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `bank`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `atutalas`
--

CREATE TABLE `atutalas` (
  `id` int(11) NOT NULL,
  `honnan` int(11) NOT NULL,
  `hova` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `atutalas`
--

INSERT INTO `atutalas` (`id`, `honnan`, `hova`, `mennyiseg`) VALUES
(4, 8000000, 8000007, 30000),
(5, 8000009, 8000007, 70000),
(6, 8000008, 8000007, 30000),
(7, 8000010, 8000009, 50000),
(8, 8000012, 8000007, 20000),
(9, 8000011, 8000002, 30200),
(10, 8000007, 8000027, 230000),
(11, 8000012, 8000027, 30000),
(12, 8000020, 8000016, 7000),
(13, 8000013, 8000021, 50000),
(14, 8000012, 8000026, 40000),
(15, 8000007, 8000025, 70000),
(16, 8000007, 8000010, 890000),
(17, 8000020, 8000017, 40020),
(18, 8000017, 8000022, 5600),
(19, 8000007, 8000017, 79000),
(20, 8000007, 8000000, 670000),
(21, 8000007, 8000011, 90000),
(22, 8000021, 8000018, 80000),
(23, 8000012, 8000020, 300000),
(24, 8000007, 8000020, 3000000),
(25, 8000020, 8000017, 70000),
(26, 8000016, 8000013, 11000),
(27, 8000020, 8000023, 504100),
(28, 8000011, 8000005, 50000),
(29, 8000000, 8000017, 501400),
(30, 8000007, 8000008, 230000),
(31, 8000010, 8000007, 78900);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `folyoszamla`
--

CREATE TABLE `folyoszamla` (
  `ugyfelID` int(11) NOT NULL,
  `folyoszamlaszam` int(11) NOT NULL,
  `egyenleg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `folyoszamla`
--

INSERT INTO `folyoszamla` (`ugyfelID`, `folyoszamlaszam`, `egyenleg`) VALUES
(1, 8000000, 364600),
(1, 8000005, 70000),
(5, 8000007, 12619900),
(2, 8000008, 270000),
(7, 8000010, 1062100),
(3, 8000011, 4159800),
(8, 8000012, 880000),
(17, 8000013, 2361000),
(16, 8000014, 4501000),
(15, 8000015, 3020000),
(14, 8000016, 256000),
(13, 8000017, 706820),
(12, 8000018, 3080000),
(11, 8000019, 2420000),
(11, 8000020, 6828880),
(10, 8000021, 1055000),
(9, 8000022, 261600),
(6, 8000023, 584100),
(5, 8000024, 3010000),
(3, 8000025, 320000),
(7, 8000026, 1560000),
(8, 8000027, 1770000),
(5, 8000028, 270000),
(20, 8000029, 500000),
(21, 8000030, 500000),
(22, 8000031, 100000),
(18, 8000032, 6900000),
(21, 8000033, 100000);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kolcson`
--

CREATE TABLE `kolcson` (
  `id` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `ki` varchar(40) NOT NULL,
  `folyoszamlaszam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `kolcson`
--

INSERT INTO `kolcson` (`id`, `mennyiseg`, `ki`, `folyoszamlaszam`) VALUES
(1, 10000, 'Koca Lajos', 8000008),
(3, 3000000, 'Szabó Pista', 8000005),
(5, 3000000, 'Szerencsés Attila', 8000010),
(8, 10000000, 'Martincsek Levente', 8000007),
(9, 10000000, 'Martincsek Levente', 8000007),
(10, 50000, 'Szabó Pista', 8000000),
(11, 500000, 'Laci Laci', 8000011),
(12, 4500000, 'Martincsek Levente', 8000007),
(13, 3000000, 'Martincsek Levente', 8000007),
(14, 1000000, 'Laci Laci', 8000011),
(15, 2400000, 'Laci Laci', 8000011),
(16, 1000000, 'Susánszky Ádám', 8000012),
(17, 250000, 'Szerencsés Attila', 8000010),
(18, 250000, 'Zolt Zoltán', 8000011),
(19, 250000, 'Susánszky Ádám', 8000012),
(20, 1000000, 'Tamás Dóra', 8000013),
(21, 4500000, 'Zobor Beatrix', 8000014),
(22, 250000, 'Fazekas Benjamin', 8000016),
(23, 3000000, 'Pásztor Csilla', 8000015),
(24, 2400000, 'Gál Richárd', 8000019),
(25, 3000000, 'Szücs Domonkos', 8000018),
(26, 1000000, 'Gál Richárd', 8000020),
(27, 3000000, 'Gál Richárd', 8000020),
(28, 1000000, 'Kelemen Patrik', 8000021),
(29, 100000, 'Veres Alexander', 8000022),
(30, 3000000, 'Martincsek Levente', 8000024),
(31, 250000, 'Zolt Zoltán', 8000025),
(32, 1000000, 'Szerencsés Attila', 8000026),
(33, 500000, 'Susánszky Ádám', 8000027),
(34, 250000, 'Martincsek Levente', 8000028),
(35, 500000, 'Szerencsés Attila', 8000026),
(36, 1000000, 'Susánszky Ádám', 8000027),
(37, 100000, 'Veres Alexander', 8000022),
(38, 250000, 'Tamás Dóra', 8000013),
(39, 1000000, 'Tamás Dóra', 8000013),
(40, 50000, 'Tamás Dóra', 8000013),
(41, 500000, 'Tóth Katalin', 8000030),
(42, 4500000, 'Orosz Bianka', 8000032),
(43, 2400000, 'Orosz Bianka', 8000032),
(44, 500000, 'Király Gabriella', 8000029);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ugyfel`
--

CREATE TABLE `ugyfel` (
  `id` int(11) NOT NULL,
  `nev` varchar(40) NOT NULL,
  `FKV` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `jelszo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `ugyfel`
--

INSERT INTO `ugyfel` (`id`, `nev`, `FKV`, `email`, `jelszo`) VALUES
(1, 'Szabó Pista', 1, 'szavovagyok@gmail.com', 'alma4'),
(2, 'Koca Lajos', 2, 'nosemig@aosdeag.com', 'ziza'),
(3, 'Zolt Zoltán', 2, 'kukac@kukac.com', 'ugyfe'),
(4, 'Kovács Miklós', 1, 'belogubov2012@ecallen.com', 'xQNCqgwC9q'),
(5, 'Martincsek Levente', 5, 'martincsekl@gmail.com', 'lasa32'),
(6, 'Mitykó Norbert', 3, 'shermy01@gnar.hu', 'EzvDBDu278'),
(7, 'Szerencsés Attila', 3, 'jjcane@thesweetshop.me', '4zE4t2JFtW'),
(8, 'Susánszky Ádám', 3, 'susika@gmail.hu', 'Ujuju'),
(9, 'Veres Alexander', 1, 'semperred1@rtfx.site', 'L5EKAddRgd'),
(10, 'Kelemen Patrik', 4, 'qbs1nonly@halosauridae.ml', 'FyZSGY5p43'),
(11, 'Gál Richárd', 4, 'larambla@zipzx.site', 'xZQ9RWRn2W'),
(12, 'Szücs Domonkos', 4, 'evgeniipoge@zipzx.site', '8rASmUMLLt'),
(13, 'Kovács Mihály', 0, 'hahatrollvok@ext.telekom.hu', 'LovingTelekom'),
(14, 'Fazekas Benjamin', 2, 'serasv@partnerct.com', 'zBkfC4yLUY'),
(15, 'Pásztor Csilla', 4, 'fearlessleader@ffo.kr', 'XTxvllDyHu'),
(16, 'Zobor Beatrix', 5, 'wik66@usayoman.com', 'WROZcwGrAR'),
(17, 'Tamás Dóra', 3, 'nuke9340let@readyz.site', 'YbIaRfFteC'),
(18, 'Orosz Bianka', 4, 'vfn8qjad@hedvdeh.com', 'aITLvRGiYA'),
(19, 'Vászoly Lilla', 3, 'paguy35@cbarato.plus', 'AUkpYUyelG'),
(20, 'Király Gabriella', 4, 'agger583@emvil.com', 'fIdemLJkyI'),
(21, 'Tóth Katalin', 3, 'ichimaru69@howg.site', 'aaCsitvBCC'),
(22, 'Kocsis Zsolt', 4, 'maxx073@3kk43.com', 'JQGAtYNetC');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `atutalas`
--
ALTER TABLE `atutalas`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `folyoszamla`
--
ALTER TABLE `folyoszamla`
  ADD PRIMARY KEY (`folyoszamlaszam`),
  ADD KEY `ugyfelID` (`ugyfelID`);

--
-- A tábla indexei `kolcson`
--
ALTER TABLE `kolcson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folyoszamlaszam` (`folyoszamlaszam`);

--
-- A tábla indexei `ugyfel`
--
ALTER TABLE `ugyfel`
  ADD PRIMARY KEY (`id`);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `folyoszamla`
--
ALTER TABLE `folyoszamla`
  ADD CONSTRAINT `folyoszamla_ibfk_1` FOREIGN KEY (`ugyfelID`) REFERENCES `ugyfel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kolcson`
--
ALTER TABLE `kolcson`
  ADD CONSTRAINT `kolcson_ibfk_1` FOREIGN KEY (`folyoszamlaszam`) REFERENCES `folyoszamla` (`folyoszamlaszam`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
