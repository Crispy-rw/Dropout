-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2019 at 02:12 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(10) NOT NULL,
  `names` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `names`, `college`, `username`, `password`) VALUES
('', 'IRADUKUNDA Robert', 'IPRC Tumba', 'Admin', '$2y$10$CLD17Bt4ik6iwfEse0BvOeRr6aBXMZ8An6LYC80F0bYJUcA.Us0Ny');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` varchar(10) NOT NULL,
  `class_name` varchar(15) NOT NULL,
  `dept_id` varchar(30) NOT NULL,
  `level_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`, `dept_id`, `level_id`) VALUES
('IT1', 'Class C', 'Information Technology', '1'),
('IT2', 'Class D', 'Information Technology', '2'),
('RE1', 'Class B', 'Renewable Energy', '2');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `credits` int(10) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  `level_id` varchar(20) NOT NULL,
  `lect_id` varchar(10) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `room_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `credits`, `dept_id`, `level_id`, `lect_id`, `class_id`, `room_id`) VALUES
('ICT20s', 'Linux Server', 0, 'IT3EEEEEEE', 'IT3BEEEEEE', 'JH0012EEEE', 'LB6EEEEEE', 'LBITEEE');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` varchar(10) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_head` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `dept_head`) VALUES
('ET02', 'Electronic and Telecommunication ', 'NSHIMIYIMANA Arcade'),
('IT01', 'Information Technology ', 'HAVUMIRAGIRA Etienne'),
('RE03', 'Renewable Energy', 'MUNYAKAYANZA  David');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lect_id` varchar(10) NOT NULL,
  `lect_name` varchar(50) NOT NULL,
  `dept_id` varchar(30) NOT NULL,
  `lect_grade` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`lect_id`, `lect_name`, `dept_id`, `lect_grade`) VALUES
('ITL011', 'HARERIMANA Sophonie', 'Information Technolo', 'Lecture');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` varchar(10) NOT NULL,
  `level_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `level_name`) VALUES
('IT1', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` varchar(10) NOT NULL,
  `room_name` varchar(30) NOT NULL,
  `description` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `description`) VALUES
('C2', 'Class Room 22', '50');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` varchar(10) NOT NULL,
  `time_id` varchar(10) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `lect_id` varchar(30) NOT NULL,
  `course_id` varchar(30) NOT NULL,
  `room_id` varchar(30) NOT NULL,
  `class_id` varchar(30) NOT NULL,
  `day` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ttime`
--

CREATE TABLE `ttime` (
  `time_id` varchar(10) NOT NULL,
  `course_id` varchar(11) NOT NULL,
  `time_start` varchar(15) NOT NULL,
  `time_end` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttime`
--

INSERT INTO `ttime` (`time_id`, `course_id`, `time_start`, `time_end`) VALUES
('T1', 'ICT206', '10:00', '11:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lect_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ttime`
--
ALTER TABLE `ttime`
  ADD PRIMARY KEY (`time_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
