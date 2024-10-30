-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 04:30 PM
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
-- Database: `resourcehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `topic`, `message`, `status`, `date`) VALUES
(1, 'Maintenance On SLL', 'There is going to be a two day maintenance starting from 2024/10/24', 'notice', '2024-10-24'),
(2, 'AC Not working', 'The AC in the CSL 2 is not working', 'complaint', '2024-10-15'),
(3, 'Hall is not up for requesting', 'There is a special meeting going on 2024/10/28, so the Discussion room will be unavailable between 2-5 P.M', 'notice', '2024-10-28'),
(19, 'The Hall needs cleaning', 'The Discussion room needs to be cleaned', 'complaint', '2024-10-16'),
(20, 'Missing Door Key', 'The SLL door key is missing, if anyone find, please hand over to HOD as soon as anyone find it', 'notice', '2024-10-31'),
(31, 'Door hinges are broken', 'This door hinges of CSA are broken', 'complaint', '2024-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `EVENT_NAME` varchar(50) NOT NULL,
  `EVENT_TYPE` varchar(50) NOT NULL,
  `CONDUCT_BY` varchar(50) NOT NULL,
  `OPTIONAL_DETAILS` varchar(100) NOT NULL,
  `RECURRING` tinyint(1) NOT NULL,
  `TEMP` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `EVENT_NAME`, `EVENT_TYPE`, `CONDUCT_BY`, `OPTIONAL_DETAILS`, `RECURRING`, `TEMP`) VALUES
(1, 'Introduction to Javascript', 'Tech Talk', 'IEEE', 'Basic syntax of javascript', 0, 0),
(4, 'Introduction React Native', 'Hands On Session', 'CSSL', 'Hands on guide to React native', 0, 0),
(5, 'React Native', 'Other', 'CSSL', 'Deploy web apps using react', 0, 1),
(6, 'Poem Competition ', 'Other', 'IEEE WIE', ' Inter society competition', 0, 0),
(7, 'Mathematics For Computing II', 'Lectures', 'Prof. Sudath', 'Lectures', 0, 0),
(10, 'Introduction to ReactJS', 'Hands On Session', 'CIS IEEE', ' ', 0, 0),
(25, 'Introduction to Node JS', 'Hands On Session', 'IEEE', '', 0, 0),
(26, 'Cybersecurity Awareness', 'Seminar', 'IEEE', 'Get a basic awareness about cyber security', 0, 0),
(27, 'Machine Learning', 'Hands on Session', 'CompSoc', 'This is a basic intro to machine learning', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `occupied`
--

CREATE TABLE `occupied` (
  `OCCUPY_ID` int(11) NOT NULL,
  `RESOURCE_ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `TIME_SLOT_ID` int(11) NOT NULL,
  `OCCUPIED_DATE` date NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `occupied`
--

INSERT INTO `occupied` (`OCCUPY_ID`, `RESOURCE_ID`, `EVENT_ID`, `TIME_SLOT_ID`, `OCCUPIED_DATE`, `ACTIVE`) VALUES
(4, 1, 6, 45, '2023-08-28', 0),
(5, 16, 26, 17, '2024-10-23', 1),
(6, 1, 6, 25, '2024-10-31', 1),
(7, 16, 7, 5, '2024-11-05', 1),
(8, 1, 4, 46, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `REQUEST_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `RESOURCE_ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `TIME_SLOT_ID` int(11) NOT NULL,
  `REQUEST_DATE` date DEFAULT NULL,
  `REQUEST_APPROVED` tinyint(1) NOT NULL DEFAULT 0,
  `PRIORITY` int(11) NOT NULL DEFAULT 0,
  `REQUEST_MESSAGE` varchar(400) NOT NULL,
  `DECLINE_MESSAGE` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`REQUEST_ID`, `USER_ID`, `RESOURCE_ID`, `EVENT_ID`, `TIME_SLOT_ID`, `REQUEST_DATE`, `REQUEST_APPROVED`, `PRIORITY`, `REQUEST_MESSAGE`, `DECLINE_MESSAGE`) VALUES
(37, 60, 1, 6, 45, '2023-08-28', -1, 0, 'I need this\r\n', 'We are not ready'),
(38, 60, 1, 4, 46, '2023-08-31', 0, 0, 'I am writing to get permission for an informative event that going to be conducted by IEEE SB of UoJ', ''),
(39, 60, 1, 4, 46, '2023-08-31', 0, 0, 'I\'m writing to get permission for an informative event that going to be conducted by IEEE SB of UoJ', ''),
(40, 60, 1, 4, 46, '2023-08-31', 1, 0, 'I\'m writing to get permission for an informative event that going to be conducted by IEEE SB of UoJ', ''),
(41, 70, 21, 25, 2, '2024-10-17', 1, 1, 'This is for Node js workshop in IEEE', ''),
(42, 59, 16, 1, 15, '2024-10-31', 1, 0, 'This event is organized by the CS chapter of the IEEE Student Branch of UOJ', '');

-- --------------------------------------------------------

--
-- Table structure for table `reset_token`
--

CREATE TABLE `reset_token` (
  `USER_ID` int(11) NOT NULL,
  `TOKEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reset_token`
--

INSERT INTO `reset_token` (`USER_ID`, `TOKEN`) VALUES
(60, 'AG0euGLRVor6IeI8258RG05y4HRc0J'),
(60, 'dsH5tM9QPz7X2FnMYEFo4HtXKRAp2n'),
(60, 'KElVnLcyMEXJsotpRDkfm6K3WbJYrq'),
(70, '5WFAdrWZogPihBi12ngiumUd8sX4DJ'),
(70, 'bUY1wZcQ939iyZyH4rw6pGnWb1RV1v'),
(70, 'OQ4fvCiAqYZtR5QoYaFFSrBgcyXaYE');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `ID` int(11) NOT NULL,
  `RESOURCE_NAME` varchar(50) NOT NULL,
  `RESOURCE_TYPE` varchar(50) NOT NULL,
  `OPTIONAL_DETAILS` varchar(100) NOT NULL,
  `BUILDING_NAME` varchar(50) NOT NULL,
  `SEATING` int(11) NOT NULL,
  `IMAGE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`ID`, `RESOURCE_NAME`, `RESOURCE_TYPE`, `OPTIONAL_DETAILS`, `BUILDING_NAME`, `SEATING`, `IMAGE`) VALUES
(1, 'SSL', 'LAB', 'Hello World', 'Department of  Mathematics', 100, '../../assets/images/westminster-abbey-3920477.jpg'),
(14, 'CSA', 'AUDITORIUM', '', 'DCS', 200, '../../assets/images/64ddfe94cb4bf-bc-2297205.jpg'),
(16, 'CSL 3,4', 'LAB', '', 'DCS', 100, '../../assets/images/64de03ce306b5-bc-2297205.jpg'),
(17, 'CSL 1,2', 'LAB', '', 'DCS', 100, '../../assets/images/64de040dec7c0-bc-2297205.jpg'),
(21, 'CSL', 'LECTURE HALL', '', 'DCS', 60, '../../assets/images/64e1b8fd44507-skyline-1337971.jpg'),
(22, 'SSL-M', 'AUDITORIUM', 'New', 'Department of  Mathematics', 50, '../../assets/images/64e6d43472a29-street-2262223.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `ID` int(11) NOT NULL,
  `START_TIME` int(11) NOT NULL,
  `END_TIME` int(11) NOT NULL,
  `DAY` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`ID`, `START_TIME`, `END_TIME`, `DAY`) VALUES
(1, 8, 9, 'Monday'),
(2, 9, 10, 'Monday'),
(3, 11, 12, 'Monday'),
(4, 10, 11, 'Monday'),
(5, 14, 16, 'Monday'),
(6, 14, 16, 'Tuesday'),
(7, 16, 17, 'Tuesday'),
(8, 16, 17, 'Wednesday'),
(9, 0, 0, 'Thursday'),
(10, 12, 13, 'Monday'),
(11, 20, 21, 'Monday'),
(12, 22, 23, 'Monday'),
(13, 18, 19, 'Monday'),
(15, 10, 14, 'Monday'),
(16, 12, 15, 'Monday'),
(17, 16, 18, 'Monday'),
(18, 12, 17, 'Monday'),
(19, 7, 8, 'Friday'),
(20, 8, 10, 'Friday'),
(21, 10, 11, 'Friday'),
(22, 14, 15, 'Sunday'),
(23, 15, 17, 'Sunday'),
(24, 7, 9, 'Monday'),
(25, 16, 17, 'Monday'),
(26, 12, 13, 'Tuesday'),
(27, 10, 11, 'Thursday'),
(28, 10, 11, 'Tuesday'),
(29, 13, 14, 'Wednesday'),
(30, 2, 3, 'Thursday'),
(31, 2, 3, 'Tuesday'),
(32, 10, 13, 'Thursday'),
(33, 1, 2, 'Wednesday'),
(34, 13, 14, 'Tuesday'),
(35, 0, 13, 'Tuesday'),
(36, 17, 18, 'Tuesday'),
(37, 2, 3, 'Wednesday'),
(38, 2, 17, 'Tuesday'),
(39, 15, 16, 'Tuesday'),
(40, 18, 19, 'Wednesday'),
(41, 10, 11, 'Wednesday'),
(42, 8, 9, 'Wednesday'),
(43, 8, 13, 'Wednesday'),
(44, 13, 22, 'Friday'),
(45, 14, 15, 'Monday'),
(46, 13, 14, 'Thursday'),
(47, 10, 16, 'Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `STUDENT_ID` varchar(50) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(100) NOT NULL,
  `USER_TYPE` varchar(50) NOT NULL,
  `APPROVED` tinyint(1) NOT NULL DEFAULT 0,
  `VERIFIED` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `USER_NAME`, `STUDENT_ID`, `USER_EMAIL`, `USER_PASSWORD`, `USER_TYPE`, `APPROVED`, `VERIFIED`) VALUES
(53, 'Sankalpa Fernando', '', 'sankalpafernando2017@gmail.c', '$2y$10$8L7UpBkiyC8W6q006rCZqOUjsqRL805mt9hnBOqmN//KFgHznKXw6', 'SUPER_ADMIN', 1, 0),
(55, 'John Doe', '', 'john@doe.com', '$2y$10$sJnmSnkUzvjFjPHPICkD/uj/PJ/y5bY3xJQnvgRwcyrBmGTKTlmCe', 'ADMIN', 0, 0),
(57, 'Kavindu Snakalpa', '2020/CSC/071', 'sk@gmail.com', '$2y$10$gOAmckmVmrKyoqp5UBtLPuKZuNbPtdmR1vNzSfPP659MFKp237AQu', 'ADMIN', 1, 1),
(58, 'Peter Greyson', '', 'peter@greyson.com', '$2y$10$sJnmSnkUzvjFjPHPICkD/uj/PJ/y5bY3xJQnvgRwcyrBmGTKTlmCe', 'LECTURER', 1, 0),
(59, 'George Hadson', '', 'george@hadson.uk', '$2y$10$sJnmSnkUzvjFjPHPICkD/uj/PJ/y5bY3xJQnvgRwcyrBmGTKTlmCe', 'ADMIN', 0, 0),
(60, 'John Doe', '2020/CSC/090', 'sankalpafernando2017@gmail.com', '$2y$10$Qbz/27.GKowVfSwiTighKO3HRRgPnZId3q/M5Lhf2HHCmooOST3Rm', 'STUDENT', 1, 1),
(70, 'Thiwanka Chanditha', '', 'thiwankachandithasinhalage@gmail.com', '$2y$10$lTZTlPtw5lD8oQwlDan7Pe3oDa7Zcfi2IoaWIEoYPoSKXHNTnjxCK', 'SUPER_ADMIN', 1, 1),
(71, 'Thiwanka Chanditha ', '', 'thiwankasinhalage@ieee.org', '$2y$10$.sz9PWLQ3TFhBIqKAETGA.0QixlWOZc/xUXJYFeWvjCCGXyf/WeHG', 'SUPER_ADMIN', 1, 1),
(72, 'chanditha', '2021/csc/000', 'slmobilestore123@gmail.com', '$2y$10$dkNsYcVb5Wh8KJAO3N10lukUsbHXriC5HC7SYyR5kNwXI/rV7Jyfu', 'STUDENT', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `waitlist`
--

CREATE TABLE `waitlist` (
  `USER_ID` int(11) NOT NULL,
  `RESOURCE_NAME` varchar(255) NOT NULL,
  `JOIN_DATE` date NOT NULL,
  `JOIN_TIME` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waitlist`
--

INSERT INTO `waitlist` (`USER_ID`, `RESOURCE_NAME`, `JOIN_DATE`, `JOIN_TIME`) VALUES
(71, 'SSL', '2025-03-20', '15:24:02'),
(57, 'SSL', '2024-12-18', '15:24:53'),
(72, 'CSL 3,4', '2024-11-06', '15:43:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `occupied`
--
ALTER TABLE `occupied`
  ADD PRIMARY KEY (`OCCUPY_ID`),
  ADD KEY `TIME_SLOT_ID` (`TIME_SLOT_ID`),
  ADD KEY `occupied_ibfk_1` (`RESOURCE_ID`),
  ADD KEY `occupied_ibfk_2` (`EVENT_ID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`REQUEST_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `RESOURCE_ID` (`RESOURCE_ID`),
  ADD KEY `EVENT_ID` (`EVENT_ID`),
  ADD KEY `TIME_SLOT_ID` (`TIME_SLOT_ID`);

--
-- Indexes for table `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`USER_ID`,`TOKEN`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `occupied`
--
ALTER TABLE `occupied`
  MODIFY `OCCUPY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `REQUEST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `occupied`
--
ALTER TABLE `occupied`
  ADD CONSTRAINT `occupied_ibfk_1` FOREIGN KEY (`RESOURCE_ID`) REFERENCES `resource` (`ID`),
  ADD CONSTRAINT `occupied_ibfk_2` FOREIGN KEY (`EVENT_ID`) REFERENCES `events` (`ID`),
  ADD CONSTRAINT `occupied_ibfk_3` FOREIGN KEY (`TIME_SLOT_ID`) REFERENCES `time_slot` (`ID`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`RESOURCE_ID`) REFERENCES `resource` (`ID`),
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`EVENT_ID`) REFERENCES `events` (`ID`),
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`TIME_SLOT_ID`) REFERENCES `time_slot` (`ID`);

--
-- Constraints for table `reset_token`
--
ALTER TABLE `reset_token`
  ADD CONSTRAINT `reset_token_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
