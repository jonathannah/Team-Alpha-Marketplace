-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2018 at 12:13 AM
-- Server version: 10.2.10-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TeamAlphaMarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `firstName` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `emailAddress` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `streetAddress` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `apt` varchar(8) COLLATE utf8mb4_bin DEFAULT NULL,
  `city` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `zipCode` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `homePhone` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `cellPhone` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `groupID` enum('Administrator','Customer') COLLATE utf8mb4_bin DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`firstName`, `lastName`, `emailAddress`, `password`, `streetAddress`, `apt`, `city`, `state`, `zipCode`, `homePhone`, `cellPhone`, `groupID`) VALUES
('Alfred', 'Bravo', 'ab@charlie.com', '123', '1234 My Street', '', 'Anytown', 'CA', '95000', '4085551234', '4085551235', 'Customer'),
('Hannah', 'Pointe', 'balletgirl@gmail.com', 'blue18', '456 My Street', '', 'MyTowm', 'CA', '95032', '9045551212', '9045551213', 'Customer'),
('Billybob', 'Bodine', 'bbodine@gamil.com', 'password', '789 1st Ave', '', 'Georgetown', 'CA', '95648', '4155551212', '4155551213', 'Customer'),
('Wilma', 'Flinstone', 'cavewoman@aol.com', 'password', '1 Rocky Point Ave', '', 'Rocksberg', 'AZ', '87674', '4805551234', '4805551235', 'Customer'),
('Walter', 'White', 'chemnerd@gmail.com', 'password', '25Trailer Trash Way', '', 'Hicksville', 'AL', '46578', '2065558676', '2065558677', 'Customer'),
('Nick', 'Dundee', 'crocjock@gmail.com', 'password', '10 Down Under Path', '', 'Destin ', 'FL', '32556', '9045557865', '9045557866', 'Customer'),
('Chia-Tea', 'Tu', 'ctt@hotmail.com', 'password', '97 Carl Bandt Dr', '', 'Shalimar ', 'FL', '32579', '9046661342', '9046661343', 'Customer'),
('Jon-boy', 'Discman', 'frisbeefan@gmail.com', 'password', '8 Dull Road', '', 'Lamesville', 'MO', '62345', '8065551756', '8065551757', 'Customer'),
('Lizzy', 'Bordon', 'hatchetgal@yahoo.com', 'password', '1 Psycopath Way', '', 'Pittsburgh', 'PA', '23657', '6652348576', '6652348577', 'Customer'),
('I.M.', 'Wired', 'imwired@roncabeanz.com', 'adminPassword', '', '', '', '', '', '', '', 'Administrator'),
('Tony', 'Stark', 'ironman@gmail.com', 'password', '12 Pacific Coast Highway', '', 'Malibu', 'CA', '92567', '2135556789', '2135556788', 'Customer'),
('Jessica', 'Jones', 'jj@gmail.com', 'password', '1 B Street', '', 'Placerville', 'CA', '95667', '5125558675', '5125558676', 'Customer'),
('John Q', 'Public', 'jqp@gmail.com', 'password', '123 4th St', '', 'Shalimar ', 'FL', '32579', '9045553456', '9045553457', 'Customer'),
('Lois', 'Lane', 'lois@dailyplanet.com', 'password', '1123 Manhattan Way', '', 'New York City', 'NY', '98761', '8345551234', '8345551235', 'Customer'),
('Jesse ', 'Pinkman', 'methhead@gmail.com', 'password', '24 Trailer Trash Way', '', 'Hicksville', 'AL', '46578', '2065558476', '2065558477', 'Customer'),
('Nick', 'Caffeine', 'ncaffeine@gmail.com', 'freshroast', '26 Tenth St', '', 'Los Gatos', 'CA', '95032', '4085557654', '4085557655', 'Customer'),
('Noah', 'Justice', 'nojustice@hotmail.com', 'password', '123 Bad Luck Way', '6', 'Baton Rouge', 'LA', '54367', '3875554327', '3875554328', 'Customer'),
('Ruby', 'Reddress', 'psych@gmail.com', 'password', '9876 Any Street', '', 'Blah', 'PA', '24567', '2675556789', '2675556790', 'Customer'),
('Saul', 'Goodman', 'saul@goodman.com', 'password', '23 Trailer Trash Way', '', 'Hicksville', 'AL', '46758', '2065558475', '2065558476', 'Customer'),
('Wanda', 'Moca', 'wmoca@yahoo.com', 'loveMocha', '12993 Grizzley Rock Road', '', 'Los Gatos', 'CA', '95032', '4085554234', '4085554235', 'Customer'),
('Jack', 'Yukon', 'yj@gmail.cpom', 'password', '123 LaLa Lane', '', 'Wherever', 'IA', '56783', '8765553456', '8765553457', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`emailAddress`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
