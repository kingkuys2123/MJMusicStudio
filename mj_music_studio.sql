-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 02:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mj_music_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `StartDateTime` datetime NOT NULL,
  `EndDateTime` datetime NOT NULL,
  `Cost` float NOT NULL,
  `Duration` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `StudioRoomNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`StartDateTime`, `EndDateTime`, `Cost`, `Duration`, `CustomerID`, `StudioRoomNumber`) VALUES
('2023-12-20 16:24:00', '2023-12-20 17:24:00', 50, 1, 5, 101),
('2023-12-20 17:25:00', '2023-12-20 18:25:00', 50, 1, 5, 101);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MI` varchar(3) NOT NULL,
  `BookingHistory` int(11) NOT NULL DEFAULT 0,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `LastName`, `FirstName`, `MI`, `BookingHistory`, `UserID`) VALUES
(5, 'Quitco', 'Kyle Matthew', 'M', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `EquipmentID` int(11) NOT NULL,
  `EquipmentType` varchar(50) NOT NULL,
  `StudioRoomNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintain`
--

CREATE TABLE `maintain` (
  `Date` date NOT NULL,
  `Cost` float NOT NULL,
  `MaintenanceID` int(11) NOT NULL,
  `EquipmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `MaintenanceID` int(11) NOT NULL,
  `MaintenanceTotalCost` float NOT NULL,
  `MaintenanceType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `StudioRoomNumber` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MI` varchar(3) NOT NULL,
  `JobTitle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studio_room`
--

CREATE TABLE `studio_room` (
  `StudioRoomNumber` int(11) NOT NULL,
  `StudioRoomSize` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studio_room`
--

INSERT INTO `studio_room` (`StudioRoomNumber`, `StudioRoomSize`) VALUES
(101, 'Small'),
(102, 'Small'),
(201, 'Medium'),
(202, 'Medium'),
(301, 'Large'),
(302, 'Large'),
(303, 'Large');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Email`, `Password`) VALUES
(5, 'KingKuys2123', 'kylequitco3212@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD KEY `customers_book` (`CustomerID`),
  ADD KEY `studio_rooms_book` (`StudioRoomNumber`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `customer_ibfk_1` (`UserID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`EquipmentID`),
  ADD KEY `studio_room_equipement` (`StudioRoomNumber`);

--
-- Indexes for table `maintain`
--
ALTER TABLE `maintain`
  ADD KEY `equipment_maintain` (`EquipmentID`),
  ADD KEY `maintenance_maintain` (`MaintenanceID`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`MaintenanceID`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD KEY `staff_manage` (`StaffID`),
  ADD KEY `studio_room_manage` (`StudioRoomNumber`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `studio_room`
--
ALTER TABLE `studio_room`
  ADD PRIMARY KEY (`StudioRoomNumber`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `customers_book` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `studio_rooms_book` FOREIGN KEY (`StudioRoomNumber`) REFERENCES `studio_room` (`StudioRoomNumber`) ON DELETE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `studio_room_equipement` FOREIGN KEY (`StudioRoomNumber`) REFERENCES `studio_room` (`StudioRoomNumber`);

--
-- Constraints for table `maintain`
--
ALTER TABLE `maintain`
  ADD CONSTRAINT `equipment_maintain` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`),
  ADD CONSTRAINT `maintenance_maintain` FOREIGN KEY (`MaintenanceID`) REFERENCES `maintenance` (`MaintenanceID`);

--
-- Constraints for table `manage`
--
ALTER TABLE `manage`
  ADD CONSTRAINT `staff_manage` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`),
  ADD CONSTRAINT `studio_room_manage` FOREIGN KEY (`StudioRoomNumber`) REFERENCES `studio_room` (`StudioRoomNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
