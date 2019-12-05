-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2019 at 09:26 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `katownin_scams`
--

-- --------------------------------------------------------

--
-- Table structure for table `AccountRequest`
--

CREATE TABLE `AccountRequest` (
  `user_id` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(45) NOT NULL,
  `type` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `AccountRequest`
--

INSERT INTO `AccountRequest` (`user_id`, `username`, `password`, `type`, `email`) VALUES
('LxbZ8NnXTj', 'testing', 'caf1a3dfb505ffed0d024130f58c5cfa', 'student', 'gunshot1t@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `AI`
--

CREATE TABLE `AI` (
  `human` int(255) NOT NULL,
  `sound_alarm` int(1) NOT NULL,
  `datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `department_id` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`department_id`, `name`) VALUES
('K20gRR2fo0', 'Computer Engineer'),
('TYYg824FGn', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `Device`
--

CREATE TABLE `Device` (
  `device_id` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department_id` varchar(10) NOT NULL,
  `room_id` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `usage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Device`
--

INSERT INTO `Device` (`device_id`, `name`, `department_id`, `room_id`, `status`, `usage`) VALUES
('0WLsjRDc1A', 'Projector', 'K20gRR2fo0', 'MBj27fhrl9', 1, 900),
('72ambsQtgF', 'Light', 'K20gRR2fo0', 'MBj27fhrl9', 0, 6000),
('D15jfCJBur', 'Door', 'K20gRR2fo0', 'MBj27fhrl9', 1, 10),
('hmUosKAgTN', 'Camera', 'K20gRR2fo0', 'MBj27fhrl9', 1, 400),
('VP7m9fnPa5', 'Door', 'TYYg824FGn', 'XS72hVV891', 1, 300),
('w2JKrhJqIo', 'Projector', 'TYYg824FGn', 'XS72hVV891', 0, 150),
('ZJmQsuK6jZ', 'Light', 'TYYg824FGn', 'XS72hVV891', 0, 200),
('ZW6KmtJm8X', 'Camera', 'TYYg824FGn', 'XS72hVV891', 1, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `Room`
--

CREATE TABLE `Room` (
  `room_id` varchar(10) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `department_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Room`
--

INSERT INTO `Room` (`room_id`, `name`, `department_id`) VALUES
('MBj27fhrl9', '101B1', 'K20gRR2fo0'),
('XS72hVV891', '102B2', 'TYYg824FGn');

-- --------------------------------------------------------

--
-- Table structure for table `Schedule`
--

CREATE TABLE `Schedule` (
  `schedule_id` varchar(10) NOT NULL,
  `room_id` varchar(10) NOT NULL,
  `lecturer_id` varchar(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `start_lesson` int(11) NOT NULL,
  `end_lesson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Schedule`
--

INSERT INTO `Schedule` (`schedule_id`, `room_id`, `lecturer_id`, `date`, `start_lesson`, `end_lesson`) VALUES
('Fjjk37HN8s', 'XS72hVV891', '12iijUJF39', '22/11/2019', 3, 5),
('Jik7625dBN', 'MBj27fhrl9', 'B36wiioopj', '20/11/2019', 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(45) NOT NULL,
  `type` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `username`, `password`, `type`, `email`) VALUES
('12345Guest', 'Guest', '084e0343a0486ff05530df6c705c8bb4', 'guest', 'thiendepwa22@yahoo.com'),
('12iijUJF39', 'lecturer', '202cb962ac59075b964b07152d234b70', 'lecturer', 'gunshot1st@gmail.com'),
('A4yt10j9ue', 'staff', '202cb962ac59075b964b07152d234b70', 'staff', 'testing@gmail.com'),
('Assdf1926i', 'thien', '202cb962ac59075b964b07152d234b70', 'admin', 'thiendepwa21@yahoo.com'),
('B36wiioopj', 'lecturer', '202cb962ac59075b964b07152d234b70', 'lecturer', 'gunshotst@gmail.com'),
('C2n7p8j77e', 'student', '202cb962ac59075b964b07152d234b70', 'student', 'hihihi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AccountRequest`
--
ALTER TABLE `AccountRequest`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `AI`
--
ALTER TABLE `AI`
  ADD PRIMARY KEY (`datetime`);

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `Device`
--
ALTER TABLE `Device`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `fkIdx_154` (`department_id`),
  ADD KEY `fkIdx_157` (`room_id`);

--
-- Indexes for table `Room`
--
ALTER TABLE `Room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fkIdx_130` (`department_id`);

--
-- Indexes for table `Schedule`
--
ALTER TABLE `Schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `fkIdx_142` (`room_id`),
  ADD KEY `fkIdx_145` (`lecturer_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Device`
--
ALTER TABLE `Device`
  ADD CONSTRAINT `FK_154` FOREIGN KEY (`department_id`) REFERENCES `Department` (`department_id`),
  ADD CONSTRAINT `FK_157` FOREIGN KEY (`room_id`) REFERENCES `Room` (`room_id`);

--
-- Constraints for table `Room`
--
ALTER TABLE `Room`
  ADD CONSTRAINT `FK_130` FOREIGN KEY (`department_id`) REFERENCES `Department` (`department_id`);

--
-- Constraints for table `Schedule`
--
ALTER TABLE `Schedule`
  ADD CONSTRAINT `FK_142` FOREIGN KEY (`room_id`) REFERENCES `Room` (`room_id`),
  ADD CONSTRAINT `FK_145` FOREIGN KEY (`lecturer_id`) REFERENCES `User` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
