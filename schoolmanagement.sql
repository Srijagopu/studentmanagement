-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 04:28 AM
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
-- Database: `schoolmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `message` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `name`, `phone`, `email`, `message`) VALUES
(1, 'premika', 7896542310, 'premika@gmail.com', 'i want to join');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` int(11) NOT NULL,
  `period` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `period`) VALUES
(1, 'period-1'),
(2, 'period-2'),
(3, 'period-3'),
(4, 'period-4'),
(5, 'period-5');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `class` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `salary` int(50) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `username`, `password`, `class`, `section`, `salary`, `usertype`) VALUES
(4, 'Sree', '1234', 3, 3, 20000, 'teacher'),
(5, 'Roja', '1234', 1, 3, 15000, 'teacher'),
(6, 'Krish', '1234', 1, 2, 15000, 'teacher'),
(7, 'Srinu', '1234', 1, 1, 20000, 'teacher'),
(10, 'Sunny', '1234', 2, 2, 13000, 'teacher'),
(15, 'Happy', '1234', 1, 3, 12000, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `class_id` int(20) NOT NULL,
  `sec_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `time_id` int(20) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `class_id`, `sec_id`, `teacher_id`, `time_id`, `day_of_week`) VALUES
(1, 2, 2, 7, 3, 'Tuesday'),
(5, 2, 2, 5, 2, 'Monday'),
(6, 0, 0, 0, 0, ''),
(7, 0, 0, 0, 0, ''),
(8, 0, 0, 0, 0, ''),
(9, 0, 0, 0, 0, ''),
(10, 1, 1, 2, 1, 'Monday'),
(11, 3, 1, 5, 1, 'Wednesday'),
(12, 1, 1, 6, 2, 'Monday'),
(13, 1, 1, 8, 3, 'Monday'),
(14, 1, 1, 2, 4, 'Monday'),
(15, 1, 1, 7, 1, 'Monday'),
(16, 1, 1, 15, 4, 'Monday'),
(17, 1, 1, 5, 5, 'Monday');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `class` int(11) NOT NULL,
  `section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `phone`, `usertype`, `class`, `section`) VALUES
(1, 'admin', '1234', 'admin@gmail.com', 9247455535, 'admin', 0, 0),
(2, 'teacher', '1234', ' teacher@gmail.com', 9492606023, 'teacher', 0, 0),
(3, 'student', '1234', 'student@gmail.com', 9550540964, 'student', 0, 0),
(4, 'Junnu', '1234', ' junnu294@gmail.comi', 7896542310, '1', 1, 0),
(6, 'Komalika', '1234', ' kitty@gmail.com', 9632587415, 'student', 1, 2),
(7, 'Harsha', '1234', ' harsha123@gmail.com', 9632587415, 'student', 3, 7),
(8, 'Pappa', '1234', ' pappa@gmail.com', 7896542310, 'student', 1, 1),
(9, 'Jyothi', '1234', ' jyothi@gmail.com', 9550540963, 'student', 3, 9),
(10, 'pallu', '1234', ' pallu@gmail.com', 7896542410, 'student', 3, 9),
(11, 'naveen', '1234', ' naveen@gmail.com', 9632587415, 'student', 1, 2),
(12, 'manu', '1234', ' manu@gmail.com', 9555460964, 'student', 1, 3),
(13, 'lilly', '1234', ' lillu@gmail.com', 9550540966, 'student', 2, 4),
(14, 'Anitha', '1234', ' anitha@gmail.com', 9550540962, 'student', 2, 5),
(15, 'ammu', '1234', ' ammu@gmail.com', 7896542315, 'student', 2, 6),
(16, 'Pandu', '1234', ' pandu@gmail.com', 9550540962, 'student', 3, 8),
(17, 'Nani', '1234', ' nani@gmail.com', 9632587411, 'student', 1, 1),
(18, 'Chinnu', '1234', ' chinnu@gmail.com', 9550540966, 'student', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
