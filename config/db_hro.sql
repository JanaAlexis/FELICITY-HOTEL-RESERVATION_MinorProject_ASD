-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2017 at 07:32 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hro`
--

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

DROP TABLE IF EXISTS `beds`;
CREATE TABLE IF NOT EXISTS `beds` (
  `bedID` int(11) NOT NULL AUTO_INCREMENT,
  `bedType` varchar(255) NOT NULL,
  PRIMARY KEY (`bedID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bedID`, `bedType`) VALUES
(1, 'Single'),
(2, 'Double');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

DROP TABLE IF EXISTS `booking_details`;
CREATE TABLE IF NOT EXISTS `booking_details` (
  `bookingRefNo` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL,
  `noOfperson` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `handledBy` int(11) NOT NULL,
  PRIMARY KEY (`bookingRefNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

DROP TABLE IF EXISTS `card_details`;
CREATE TABLE IF NOT EXISTS `card_details` (
  `paymentNo` int(11) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `cardHolderName` int(11) NOT NULL,
  `cardName` int(11) NOT NULL,
  `cardNo` int(11) NOT NULL,
  `refNo` int(11) NOT NULL,
  PRIMARY KEY (`paymentNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `email`, `status`, `password`) VALUES
(1, 'Chim', 'Park', 'chim@park.com', 'activated', '123');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employeeID` int(1) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`employeeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `firstName`, `lastName`, `username`, `password`) VALUES
(1, 'Jiminie', 'Park', 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `imgID` int(11) NOT NULL AUTO_INCREMENT,
  `imgName` varchar(255) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`imgID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
CREATE TABLE IF NOT EXISTS `meals` (
  `mealID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`mealID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meal_details`
--

DROP TABLE IF EXISTS `meal_details`;
CREATE TABLE IF NOT EXISTS `meal_details` (
  `mealID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `bookingRefNo` int(11) NOT NULL,
  PRIMARY KEY (`mealID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE IF NOT EXISTS `payment_details` (
  `paymentNo` int(11) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `bookingRefNo` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `paymentDate` datetime NOT NULL,
  PRIMARY KEY (`paymentNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_details`
--

DROP TABLE IF EXISTS `reservation_details`;
CREATE TABLE IF NOT EXISTS `reservation_details` (
  `reservationID` int(11) NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `roomID` int(11) NOT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL,
  `noOfperson` int(11) NOT NULL,
  `reservationDate` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `approvedBy` int(11) NOT NULL,
  PRIMARY KEY (`reservationID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `roomTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `roomType` varchar(255) NOT NULL,
  `imgID` int(11) NOT NULL,
  PRIMARY KEY (`roomTypeId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomTypeId`, `roomType`, `imgID`) VALUES
(1, 'Deluxe', 0),
(2, 'Luxury', 0),
(3, 'Suite', 0),
(4, 'Superior', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

DROP TABLE IF EXISTS `room_details`;
CREATE TABLE IF NOT EXISTS `room_details` (
  `roomID` int(11) NOT NULL AUTO_INCREMENT,
  `roomName` varchar(50) NOT NULL,
  `roomTypeId` int(11) NOT NULL,
  `bedID` int(11) NOT NULL,
  `noOfperson` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`roomID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`roomID`, `roomName`, `roomTypeId`, `bedID`, `noOfperson`, `status`) VALUES
(2, '2A', 1, 1, 2, 'Unavailable'),
(3, '2A', 2, 2, 2, 'Available'),
(12, '1A', 1, 2, 2, 'Available'),
(8, '2B', 2, 1, 2, 'Available'),
(9, '2B', 2, 1, 2, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

DROP TABLE IF EXISTS `transportation`;
CREATE TABLE IF NOT EXISTS `transportation` (
  `transID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`transID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trans_sched`
--

DROP TABLE IF EXISTS `trans_sched`;
CREATE TABLE IF NOT EXISTS `trans_sched` (
  `transID` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `bookingRefNo` int(11) NOT NULL,
  PRIMARY KEY (`transID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
