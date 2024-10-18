-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 01:30 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `reset_token`
--

CREATE TABLE `reset_token` (
  `USER_ID` int(11) NOT NULL,
  `TOKEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `SEATING` int(11) DEFAULT NULL,
  `IMAGE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`ID`, `RESOURCE_NAME`, `RESOURCE_TYPE`, `OPTIONAL_DETAILS`, `BUILDING_NAME`, `SEATING`, `IMAGE`) VALUES
(1, 'CSL - 1 & 2', 'Lab', 'Computer Science Lab @ 1st Floor of the DCS building			', 'DCS building', 100, ''),
(2, 'CSL - 3 & 4', 'Lab', 'Computer Science Lab @ 2nd Floor of the DCS building			', 'DCS building', 100, ''),
(3, 'CSH', 'Lecture Hall', 'Computer Science Lecture Hall @ 2nd Floor of the DCS building			', 'DCS building', 60, ''),
(4, 'CSA', 'Auditorium', 'DCS Auditorium', 'DCS building', 150, ''),
(5, 'CUL - 1', 'Lecture Hall', 'Computer Unit Lecture Hall @ Ground Floor of the New Science Block			', 'New Science Block', NULL, ''),
(6, 'SLL', 'Lab', 'Science Language Lab @ 2nd Floor of the New Science Block			', 'New Science Block', 67, ''),
(7, 'DRoom', 'Discussion Room', 'Discussion Room @Ground Floor of the DCS building			', 'DCS building', NULL, ''),
(8, 'P1', 'Lecture Hall', 'Physics Lecture Hall', 'Physics building', NULL, ''),
(9, '1M', 'Lecture Hall', 'Mathematics Lecture Hall', 'Mathematics building', NULL, ''),
(10, '2M', 'Lecture Hall', 'Mathematics Lecture Hall', 'Mathematics building', NULL, '');

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `ACRONYM` varchar(10) DEFAULT NULL,
  `STUDENT_ID` varchar(50) DEFAULT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(100) NOT NULL,
  `USER_TYPE` varchar(50) NOT NULL,
  `APPROVED` tinyint(1) NOT NULL DEFAULT 0,
  `VERIFIED` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `USER_NAME`, `ACRONYM`, `STUDENT_ID`, `USER_EMAIL`, `USER_PASSWORD`, `USER_TYPE`, `APPROVED`, `VERIFIED`) VALUES
(1, 'Prof. A. Ramanan', 'AR', NULL, 'a.ramanan@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(2, 'Dr. (Mrs.) B. Mayurathan', 'BM', NULL, 'barathym@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'ADMIN', 1, 1),
(3, 'Dr. E. Y. A. Charles', 'EYAC', NULL, 'charles.ey@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(4, 'Dr. K. Sarveswaran', 'KS', NULL, 'sarves@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(5, 'Dr. K. Thabotharan', 'KT', NULL, 'thabo@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(6, 'Prof. M. Siyamalan', 'MS', NULL, 'siyam@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(7, 'Dr. (Ms.) R. Nirthika', 'NR', NULL, 'nirthika@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(8, 'Dr. Ramajeyam Tharshan', 'RT', NULL, 'rtharshan@univ.jfn.a.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(9, 'Dr. S. Mahesan', 'SM', NULL, 'mahesan.csc.ju@gmail.dummy.com', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(10, 'Dr. S. Shriparen', 'SSh', NULL, 'shriparens@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(11, 'Mr. S. Suthakar', 'SSu', NULL, 'sosuthakar@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(12, 'Dr. (Ms.) J. Samantha Tharani', 'STJ', NULL, 'samanthaj@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(13, 'Dr. T. Kokul', 'TK', NULL, 'kokul@univ.jfn.ac.dummy.lk', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1),
(14, 'Dr. T. Mathanaranjan', 'TM', NULL, 'mathanaranjan@gmail.dummmy.com', '$2y$10$8Ap0sfxFyWrQWOxq9mHE0O.lDIEQ9i4jIY4FkbWzjoDJBhqvN0MpG', 'LECTURER', 1, 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `occupied`
--
ALTER TABLE `occupied`
  MODIFY `OCCUPY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `REQUEST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
