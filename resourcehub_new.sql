-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 05:54 PM
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
  `EVENT_NAME` varchar(200) NOT NULL,
  `EVENT_TYPE` varchar(50) NOT NULL,
  `CONDUCT_BY` varchar(50) NOT NULL,
  `OPTIONAL_DETAILS` varchar(100) DEFAULT NULL,
  `RECURRING` tinyint(1) NOT NULL DEFAULT 0,
  `TEMP` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `EVENT_NAME`, `EVENT_TYPE`, `CONDUCT_BY`, `OPTIONAL_DETAILS`, `RECURRING`, `TEMP`) VALUES
(1, 'Level 1S Practical session  by Dr. K. Thabotharan', 'Practical session', 'Dr. K. Thabotharan', 'From timetable', 1, 0),
(2, 'Level 3S & 3M Lecture  by Dr. S. Shriparen', 'Lecture', 'Dr. S. Shriparen', 'From timetable', 1, 0),
(3, 'Level 2G Practical session  by Mr. S. Suthakar', 'Practical session', 'Mr. S. Suthakar', 'From timetable', 1, 0),
(4, 'Level 3S & 3M Lecture  by Dr. E. Y. A. Charles', 'Lecture', 'Dr. E. Y. A. Charles', 'From timetable', 1, 0),
(5, 'Level 1G & 1S Lecture  by Prof. M. Siyamalan', 'Lecture', 'Prof. M. Siyamalan', 'From timetable', 1, 0),
(6, 'Level 3S & 3M Lecture  by Prof. A. Ramanan', 'Lecture', 'Prof. A. Ramanan', 'From timetable', 1, 0),
(7, 'Level 1S Lecture  by Dr. K. Sarveswaran', 'Lecture', 'Dr. K. Sarveswaran', 'From timetable', 1, 0),
(8, 'Level 1S Lecture  by Dr. T. Kokul', 'Lecture', 'Dr. T. Kokul', 'From timetable', 1, 0),
(9, 'Level 3G Practical session  by Dr. S. Shriparen', 'Practical session', 'Dr. S. Shriparen', 'From timetable', 1, 0),
(10, 'Level 3S & 3M Lecture  by Dr. S. Mahesan', 'Lecture', 'Dr. S. Mahesan', 'From timetable', 1, 0),
(11, 'Level 1S Lecture  by Dr. T. Mathanaranjan', 'Lecture', 'Dr. T. Mathanaranjan', 'From timetable', 1, 0),
(12, 'Level 2G & 2S Lecture  by Mr. S. Suthakar', 'Lecture', 'Mr. S. Suthakar', 'From timetable', 1, 0),
(13, 'Level 2S Lecture  by Dr. (Ms.) R. Nirthika', 'Lecture', 'Dr. (Ms.) R. Nirthika', 'From timetable', 1, 0),
(14, 'Level 2S Lecture  by Dr. (Mrs.) B. Mayurathan', 'Lecture', 'Dr. (Mrs.) B. Mayurathan', 'From timetable', 1, 0),
(15, 'Level 3S & 3M Lecture  by Mr. S. Suthakar', 'Lecture', 'Mr. S. Suthakar', 'From timetable', 1, 0),
(16, 'Level 1S Lecture  by Dr. Ramajeyam Tharshan', 'Lecture', 'Dr. Ramajeyam Tharshan', 'From timetable', 1, 0),
(17, 'Level 2G & 2S Lecture  by Prof. M. Siyamalan', 'Lecture', 'Prof. M. Siyamalan', 'From timetable', 1, 0),
(18, 'Level 1G Practical session  by Dr. K. Thabotharan', 'Practical session', 'Dr. K. Thabotharan', 'From timetable', 1, 0),
(19, 'Level 2S Lecture  by Dr. (Ms.) J. Samantha Tharani', 'Lecture', 'Dr. (Ms.) J. Samantha Tharani', 'From timetable', 1, 0),
(20, 'Level 1S Practical session  by Dr. K. Sarveswaran', 'Practical session', 'Dr. K. Sarveswaran', 'From timetable', 1, 0),
(21, 'Level 3S & 3M Lecture  by AWS', 'Lecture', 'AWS', 'From timetable', 1, 0),
(22, 'Level 2S Practical session  by Dr. (Mrs.) B. Mayurathan', 'Practical session', 'Dr. (Mrs.) B. Mayurathan', 'From timetable', 1, 0),
(23, 'Level 2S Practical session  by Mr. S. Suthakar', 'Practical session', 'Mr. S. Suthakar', 'From timetable', 1, 0),
(24, 'Level 3S & 3M Practical session  by Dr. S. Shriparen', 'Practical session', 'Dr. S. Shriparen', 'From timetable', 1, 0),
(25, 'Level 3M & 3S Lecture  by Dr. S. Mahesan', 'Lecture', 'Dr. S. Mahesan', 'From timetable', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `occupied`
--

CREATE TABLE `occupied` (
  `OCCUPY_ID` int(11) NOT NULL,
  `RESOURCE_ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `TIME_SLOT_ID` int(11) NOT NULL,
  `OCCUPIED_DATE` date DEFAULT NULL,
  `ACTIVE` tinyint(1) NOT NULL DEFAULT 0,
  `OPTIONAL_DETAILS` varchar(100) DEFAULT NULL
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
(1, 'CSL - 1 & 2', 'Lab', 'Computer Science Lab @ 1st Floor of the DCS building			', 'DCS building', 100, '../../assets/images/csl_1&2.jpg'),
(2, 'CSL - 3 & 4', 'Lab', 'Computer Science Lab @ 2nd Floor of the DCS building			', 'DCS building', 100, ''),
(3, 'CSH', 'Lecture Hall', 'Computer Science Lecture Hall @ 2nd Floor of the DCS building			', 'DCS building', 60, ''),
(4, 'CSA', 'Auditorium', 'DCS Auditorium', 'DCS building', 150, '../../assets/images/csa.jpg'),
(5, 'CUL - 1', 'Lecture Hall', 'Computer Unit Lecture Hall @ Ground Floor of the New Science Block			', 'New Science Block', NULL, '../../assets/images/cul_1.jpg'),
(6, 'SLL', 'Lab', 'Science Language Lab @ 2nd Floor of the New Science Block			', 'New Science Block', 67, ''),
(7, 'DRoom', 'Discussion Room', 'Discussion Room @Ground Floor of the DCS building			', 'DCS building', NULL, '../../assets/images/discussion_room.jpg'),
(8, 'P1', 'Lecture Hall', 'Physics Lecture Hall', 'Physics building', NULL, ''),
(9, '1M', 'Lecture Hall', 'Mathematics Lecture Hall', 'Mathematics building', NULL, '../../assets/images/1m.jpg'),
(10, '2M', 'Lecture Hall', 'Mathematics Lecture Hall', 'Mathematics building', NULL, '../../assets/images/2m.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `script_delay`
--

CREATE TABLE `script_delay` (
  `ID` int(11) NOT NULL DEFAULT 0,
  `LAST_RUN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `script_delay`
--

INSERT INTO `script_delay` (`ID`, `LAST_RUN`) VALUES
(0, '2024-10-30 07:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `ID` int(11) NOT NULL,
  `START_TIME` int(11) NOT NULL,
  `END_TIME` int(11) NOT NULL,
  `DAY` varchar(50) DEFAULT NULL,
  `OPTIONAL_DETAILS` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`ID`, `START_TIME`, `END_TIME`, `DAY`, `OPTIONAL_DETAILS`) VALUES
(1, 8, 9, 'Monday', 'From timetable'),
(2, 9, 10, 'Monday', 'From timetable'),
(3, 8, 10, 'Monday', 'From timetable'),
(4, 10, 11, 'Monday', 'From timetable'),
(5, 9, 11, 'Monday', 'From timetable'),
(6, 11, 12, 'Monday', 'From timetable'),
(7, 9, 12, 'Monday', 'From timetable'),
(8, 10, 12, 'Monday', 'From timetable'),
(9, 13, 14, 'Monday', 'From timetable'),
(10, 14, 15, 'Monday', 'From timetable'),
(11, 13, 15, 'Monday', 'From timetable'),
(12, 15, 16, 'Monday', 'From timetable'),
(13, 13, 16, 'Monday', 'From timetable'),
(14, 16, 17, 'Monday', 'From timetable'),
(15, 8, 9, 'Tuesday', 'From timetable'),
(16, 9, 10, 'Tuesday', 'From timetable'),
(17, 10, 11, 'Tuesday', 'From timetable'),
(18, 11, 12, 'Tuesday', 'From timetable'),
(19, 10, 12, 'Tuesday', 'From timetable'),
(20, 15, 16, 'Tuesday', 'From timetable'),
(21, 16, 17, 'Tuesday', 'From timetable'),
(22, 15, 17, 'Tuesday', 'From timetable'),
(23, 8, 9, 'Wednesday', 'From timetable'),
(24, 9, 10, 'Wednesday', 'From timetable'),
(25, 10, 11, 'Wednesday', 'From timetable'),
(26, 11, 12, 'Wednesday', 'From timetable'),
(27, 13, 14, 'Wednesday', 'From timetable'),
(28, 14, 15, 'Wednesday', 'From timetable'),
(29, 13, 15, 'Wednesday', 'From timetable'),
(30, 15, 16, 'Wednesday', 'From timetable'),
(31, 14, 16, 'Wednesday', 'From timetable'),
(32, 16, 17, 'Wednesday', 'From timetable'),
(33, 15, 17, 'Wednesday', 'From timetable'),
(34, 8, 9, 'Thursday', 'From timetable'),
(35, 9, 10, 'Thursday', 'From timetable'),
(36, 10, 11, 'Thursday', 'From timetable'),
(37, 9, 11, 'Thursday', 'From timetable'),
(38, 11, 12, 'Thursday', 'From timetable'),
(39, 9, 12, 'Thursday', 'From timetable'),
(40, 13, 14, 'Thursday', 'From timetable'),
(41, 14, 15, 'Thursday', 'From timetable'),
(42, 15, 16, 'Thursday', 'From timetable'),
(43, 14, 16, 'Thursday', 'From timetable'),
(44, 16, 17, 'Thursday', 'From timetable'),
(45, 14, 17, 'Thursday', 'From timetable'),
(46, 8, 9, 'Friday', 'From timetable'),
(47, 9, 10, 'Friday', 'From timetable'),
(48, 10, 11, 'Friday', 'From timetable'),
(49, 9, 11, 'Friday', 'From timetable'),
(50, 11, 12, 'Friday', 'From timetable'),
(51, 9, 12, 'Friday', 'From timetable'),
(52, 14, 15, 'Friday', 'From timetable'),
(53, 15, 16, 'Friday', 'From timetable'),
(54, 14, 16, 'Friday', 'From timetable'),
(55, 16, 17, 'Friday', 'From timetable'),
(56, 14, 17, 'Friday', 'From timetable'),
(57, 8, 9, 'Saturday', 'From timetable'),
(58, 9, 10, 'Saturday', 'From timetable'),
(59, 8, 10, 'Saturday', 'From timetable'),
(60, 10, 11, 'Saturday', 'From timetable');

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
-- Indexes for table `script_delay`
--
ALTER TABLE `script_delay`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `occupied`
--
ALTER TABLE `occupied`
  MODIFY `OCCUPY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `REQUEST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

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
