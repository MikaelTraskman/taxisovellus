-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 13, 2020 at 12:01 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `hinnat`
--

CREATE TABLE `hinnat` (
  `ID` int(10) NOT NULL,
  `lahtohinta` decimal(6,2) NOT NULL,
  `lahtohinta_muu` decimal(7,2) NOT NULL,
  `alvprosentti` decimal(4,2) NOT NULL,
  `taksa1` decimal(4,2) NOT NULL,
  `taksa2` decimal(4,2) NOT NULL,
  `taksa3` decimal(4,2) NOT NULL,
  `taksa4` decimal(4,2) NOT NULL,
  `tavarankuljetus` decimal(4,2) NOT NULL,
  `avustus1` decimal(5,2) NOT NULL,
  `avustus2` decimal(5,2) NOT NULL,
  `avustus0` decimal(4,2) NOT NULL,
  `paarilisa` decimal(5,2) NOT NULL,
  `ennakkotilausarvo` decimal(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hinnat`
--

INSERT INTO `hinnat` (`ID`, `lahtohinta`, `lahtohinta_muu`, `alvprosentti`, `taksa1`, `taksa2`, `taksa3`, `taksa4`, `tavarankuljetus`, `avustus1`, `avustus2`, `avustus0`, `paarilisa`, `ennakkotilausarvo`) VALUES
(1, '5.90', '9.00', '10.00', '1.55', '1.87', '2.02', '2.18', '2.80', '15.70', '31.40', '0.00', '29.20', '7.10');

-- --------------------------------------------------------

--
-- Table structure for table `kayttajat`
--

CREATE TABLE `kayttajat` (
  `ID` int(6) NOT NULL,
  `kayttaja` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `kayttajatyyppi` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `salasana` varchar(40) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `kayttajat`
--

INSERT INTO `kayttajat` (`ID`, `kayttaja`, `kayttajatyyppi`, `email`, `salasana`) VALUES
(1, 'paakayttaja', 'paakayttaja', 'paakayttaja@kayttaja.com', 'paakayttaja'),
(2, 'kayttajakayttaja', 'henkilöstö', 'kayttaja@kayttaja.net', 'kayttajakayttaja'),
(3, 'UusiKayttaja', 'henkilöstö', 'uusikayttaja@igmail.com', 'dipijpjedpijde');

-- --------------------------------------------------------

--
-- Table structure for table `kuvat`
--

CREATE TABLE `kuvat` (
  `ID` int(11) NOT NULL,
  `sivusto` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `logo` varchar(500) COLLATE utf8_swedish_ci NOT NULL,
  `taustakuva` varchar(500) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `kuvat`
--

INSERT INTO `kuvat` (`ID`, `sivusto`, `logo`, `taustakuva`) VALUES
(1, 'taksisivusto', 'kuvat/strange_agency_names_taxi.jpg', 'kuvat/stadi_62636764.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tilaus`
--

CREATE TABLE `tilaus` (
  `ID` int(6) NOT NULL,
  `tunnus` int(8) NOT NULL,
  `puhnro` varchar(12) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `mista` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `minne` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `matka` decimal(7,2) NOT NULL,
  `lisatoiveet` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `lisatoiveethinta` decimal(5,2) NOT NULL,
  `hinta` decimal(7,2) NOT NULL,
  `alv` decimal(7,2) NOT NULL,
  `brutto` decimal(7,2) NOT NULL,
  `alvprossa` decimal(5,2) NOT NULL,
  `saapumispvm` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `saapumisklo` varchar(8) COLLATE utf8_swedish_ci NOT NULL,
  `viesti` varchar(800) COLLATE utf8_swedish_ci NOT NULL,
  `tilauspvm` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `tilausklo` varchar(8) COLLATE utf8_swedish_ci NOT NULL,
  `matkustajamaara` varchar(3) COLLATE utf8_swedish_ci NOT NULL,
  `ennakkotilauslisamaksu` decimal(7,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `tilaus`
--

INSERT INTO `tilaus` (`ID`, `tunnus`, `puhnro`, `email`, `mista`, `minne`, `matka`, `lisatoiveet`, `lisatoiveethinta`, `hinta`, `alv`, `brutto`, `alvprossa`, `saapumispvm`, `saapumisklo`, `viesti`, `tilauspvm`, `tilausklo`, `matkustajamaara`, `ennakkotilauslisamaksu`) VALUES
(1, 2898805, '303484', 'oiefohe@nfnfoiw.fi', 'kauniainen', 'Leppävaaran', '6.45', '', '0.00', '15.90', '1.59', '17.49', '10.00', '25.06.2020', '13:15', 'fdkueh', '26.06.2020', '10:42:31', '1', '0.00'),
(3, 2427852, '73693704309', 'sjfijf@fijpijfijf.ti', 'kirkkonummi', 'sipoo', '66.06', '', '0.00', '108.30', '10.83', '119.13', '10.00', '26.06.2020', '18:15', 'psdjpjwfpijiwej', '26.06.2020', '17:55:34', '1', '0.00'),
(6, 9541805, '62323', 'iijdijdij@ofiofijf.du', 'porvoo', 'Kirkkonummi', '84.15', '| Avustus portaissa, invavarusteinen auto |', '31.40', '167.72', '16.77', '184.50', '10.00', '26.06.2020', '19:00', 'ofoweiwoioioijdoijd\r\ndjpjdpjpdej.\r\nwodpjdij', '26.06.2020', '18:46:33', '2', '0.00'),
(5, 4552003, '932434390843', 'eifweoio@fsjoijo.fi', 'kallio', 'helsinki', '1.70', '', '0.00', '8.53', '0.85', '9.39', '10.00', '26.06.2020', '18:15', 'ieoofnwofnoewfe', '26.06.2020', '17:58:58', '1', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `viesti`
--

CREATE TABLE `viesti` (
  `ID` int(6) NOT NULL,
  `lahettaja` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `vastaanottaja` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `kayttajatyyppi` varchar(15) COLLATE utf8_swedish_ci NOT NULL,
  `viesti` varchar(800) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `lahetetty` varchar(20) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `viesti`
--

INSERT INTO `viesti` (`ID`, `lahettaja`, `vastaanottaja`, `kayttajatyyppi`, `viesti`, `email`, `lahetetty`) VALUES
(1, 'iweoijeij', 'henkilöstö', 'asiakas', 'pssdfnnvsdon\r\ncpodpsnivinpipijp\r\nsåokpasopojsdaids', 'tesmi@tesmaaja.net', '27.06.2020'),
(3, 'Uutta', 'henkilöstö', 'asiakas', 'pepjide\r\ndejpfeijew\r\nfwejåojfpjfew\r\nfewkåojefpjfew\r\nwefjpojfpjfew', 'dpjj@ifofoif.vi', '03.07.2020'),
(5, 'paakayttaja', '', 'henkilöstö', 'epideipid\r\npijidoihdhihde\r\ndjpidphde', ' ', '03.07.2020'),
(6, 'paakayttaja', 'paakayttaja', 'henkilöstö', 'Toivottavasti toimittaa!!', ' ', '03.07.2020'),
(7, 'Uutta', 'henkilöstö', 'asiakas', 'pepjide\r\ndejpfeijew\r\nfwejåojfpjfew\r\nfewkåojefpjfew\r\nwefjpojfpjfew', 'dpjj@ifofoif.vi', '03.07.2020'),
(9, 'paakayttaja', 'paakayttaja', 'henkilöstö', 'iojpwjpijjeoi\r\nefojpfeijief\r\nfejpijefijfefe\r\npfeppfeoijfe', ' ', '03.07.2020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hinnat`
--
ALTER TABLE `hinnat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kayttajat`
--
ALTER TABLE `kayttajat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kuvat`
--
ALTER TABLE `kuvat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tilaus`
--
ALTER TABLE `tilaus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `viesti`
--
ALTER TABLE `viesti`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kayttajat`
--
ALTER TABLE `kayttajat`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tilaus`
--
ALTER TABLE `tilaus`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `viesti`
--
ALTER TABLE `viesti`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
