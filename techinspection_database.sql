-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 03:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techinspection`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_table`
--

CREATE TABLE `account_table` (
  `account_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `account_name` varchar(64) NOT NULL,
  `role_descriptor` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_table`
--

CREATE TABLE `driver_table` (
  `driver_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `helmet_status` varchar(5) NOT NULL,
  `inspection_date` date NOT NULL,
  `helmetimg` longblob NOT NULL,
  `novice_driver` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_table`
--

CREATE TABLE `form_table` (
  `form_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `annualinspect` varchar(5) NOT NULL,
  `form_date` datetime NOT NULL,
  `wheelbearings` varchar(5) NOT NULL,
  `wheelbearingsnotes` text NOT NULL,
  `wheelbearingsimg` longblob NOT NULL,
  `wheelcheck` varchar(5) NOT NULL,
  `wheelchecknotes` text NOT NULL,
  `wheelcheckimg` longblob NOT NULL,
  `hubcaps` varchar(5) NOT NULL,
  `hubcapsnotes` text NOT NULL,
  `hubcapsimg` longblob NOT NULL,
  `tirecheck` varchar(5) NOT NULL,
  `tirechecknotes` text NOT NULL,
  `tirecheckimg` longblob NOT NULL,
  `tiretreads` varchar(5) NOT NULL,
  `tiretreadsnotes` text NOT NULL,
  `tiretreadsimg` longblob NOT NULL,
  `brakecheck` varchar(5) NOT NULL,
  `brakechecknotes` text NOT NULL,
  `brakecheckimg` longblob NOT NULL,
  `bodypanels` varchar(5) NOT NULL,
  `bodypanelsnotes` text NOT NULL,
  `bodypanelsimg` longblob NOT NULL,
  `numbers` varchar(5) NOT NULL,
  `numbersnotes` text NOT NULL,
  `numbersimg` longblob NOT NULL,
  `exteriorimg` longblob NOT NULL,
  `floormats` varchar(5) NOT NULL,
  `floormatsnotes` text NOT NULL,
  `floormatsimg` longblob NOT NULL,
  `pedalscheck` varchar(5) NOT NULL,
  `pedalschecknotes` text NOT NULL,
  `pedalscheckimg` longblob NOT NULL,
  `brakepedal` varchar(5) NOT NULL,
  `brakepedalnotes` text NOT NULL,
  `brakepedalimg` longblob NOT NULL,
  `steering` varchar(5) NOT NULL,
  `steeringnotes` text NOT NULL,
  `steeringimg` longblob NOT NULL,
  `gearselector` varchar(5) NOT NULL,
  `gearselectornotes` text NOT NULL,
  `gearselectorimg` longblob NOT NULL,
  `seat` varchar(5) NOT NULL,
  `seatnotes` text NOT NULL,
  `seatimg` longblob NOT NULL,
  `seatbelt` varchar(5) NOT NULL,
  `seatbeltnotes` text NOT NULL,
  `seatbeltimg` longblob NOT NULL,
  `camerascheck` varchar(5) NOT NULL,
  `cameraschecknotes` text NOT NULL,
  `camerascheckimg` longblob NOT NULL,
  `interiorimg` longblob NOT NULL,
  `battery` varchar(5) NOT NULL,
  `batterynotes` text NOT NULL,
  `batteryimg` longblob NOT NULL,
  `airintake` varchar(5) NOT NULL,
  `airintakenotes` text NOT NULL,
  `airintakeimg` longblob NOT NULL,
  `throttlecable` varchar(5) NOT NULL,
  `throttlecablenotes` text NOT NULL,
  `throttlecableimg` longblob NOT NULL,
  `fluidcaps` varchar(5) NOT NULL,
  `fluidcapsnotes` text NOT NULL,
  `fluidcapsimg` longblob NOT NULL,
  `leakcheck` varchar(5) NOT NULL,
  `leakchecknotes` text NOT NULL,
  `leakcheckimg` longblob NOT NULL,
  `trunk` varchar(5) NOT NULL,
  `trunknotes` text NOT NULL,
  `trunkimg` longblob NOT NULL,
  `exhaust` varchar(5) NOT NULL,
  `exhaustnotes` text NOT NULL,
  `exhaustimg` longblob NOT NULL,
  `hoodimg` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garage_table`
--

CREATE TABLE `garage_table` (
  `car_year` int(4) NOT NULL,
  `car_make` varchar(64) NOT NULL,
  `car_model` varchar(64) NOT NULL,
  `car_owner_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_table`
--
ALTER TABLE `account_table`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `driver_table`
--
ALTER TABLE `driver_table`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `form_table`
--
ALTER TABLE `form_table`
  ADD PRIMARY KEY (`form_id`),
  ADD KEY `car_keys` (`car_id`),
  ADD KEY `account_keys` (`account_id`);

--
-- Indexes for table `garage_table`
--
ALTER TABLE `garage_table`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `car_owner` (`car_owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_table`
--
ALTER TABLE `account_table`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_table`
--
ALTER TABLE `driver_table`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_table`
--
ALTER TABLE `form_table`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garage_table`
--
ALTER TABLE `garage_table`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_table`
--
ALTER TABLE `driver_table`
  ADD CONSTRAINT `account_id` FOREIGN KEY (`account_id`) REFERENCES `account_table` (`account_id`);

--
-- Constraints for table `form_table`
--
ALTER TABLE `form_table`
  ADD CONSTRAINT `account_keys` FOREIGN KEY (`account_id`) REFERENCES `account_table` (`account_id`),
  ADD CONSTRAINT `car_keys` FOREIGN KEY (`car_id`) REFERENCES `garage_table` (`car_id`);

--
-- Constraints for table `garage_table`
--
ALTER TABLE `garage_table`
  ADD CONSTRAINT `car_owner` FOREIGN KEY (`car_owner_id`) REFERENCES `driver_table` (`driver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
