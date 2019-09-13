-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 01:36 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mine`
--

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE `cells` (
  `cell_id` int(4) NOT NULL,
  `cellname` varchar(15) NOT NULL,
  `sector_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cells`
--

INSERT INTO `cells` (`cell_id`, `cellname`, `sector_id`) VALUES
(1, 'Gatoki', 1),
(2, 'Kanserege', 2),
(3, 'Zindiro', 3),
(4, 'Nsinda', 4),
(5, 'Kibiraro', 5),
(6, 'Karambo', 6),
(7, 'Gasanze', 7),
(8, 'Rwanza B', 1),
(9, 'Rwanza', 8),
(10, 'Mukoto', 9),
(11, 'Tumba', 10);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(3) NOT NULL,
  `year` int(2) NOT NULL,
  `letter` text NOT NULL,
  `dept_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `year`, `letter`, `dept_id`) VALUES
(1, 4, '', 1),
(2, 4, '', 2),
(3, 5, '', 1),
(4, 6, '', 1),
(5, 5, '', 2),
(6, 4, '', 3),
(7, 4, '', 4),
(8, 5, '', 4),
(9, 4, '', 5),
(10, 4, 'A', 6),
(11, 4, 'B', 6),
(13, 5, '', 8),
(14, 5, 'B', 9),
(15, 4, '', 10),
(16, 5, '', 10),
(17, 4, 'A', 11),
(18, 6, '', 12);

-- --------------------------------------------------------

--
-- Table structure for table `depts`
--

CREATE TABLE `depts` (
  `dept_id` int(3) NOT NULL,
  `deptname` text NOT NULL,
  `deptacronym` text NOT NULL,
  `school_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depts`
--

INSERT INTO `depts` (`dept_id`, `deptname`, `deptacronym`, `school_id`) VALUES
(1, 'Computer Science', 'CSC', 2),
(2, 'Computer Electronic', 'CEL', 2),
(3, 'Public Work', 'PWO', 2),
(4, 'Phyiscs chemistry maths', 'PCM', 1),
(5, 'History Economy Geography', 'HEG', 1),
(6, 'Electricity', 'ELC', 2),
(7, 'Computer Science', 'CSC', 3),
(8, 'Math-Physics-Chemist', 'MPC', 3),
(9, 'Information Communication Authority', 'ICT', 3),
(10, 'Computer Science', 'CSC', 10),
(11, 'Computer Science', 'CSC', 12),
(12, 'Math-Physics-Chemist', 'MPC', 12);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(2) NOT NULL,
  `district_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`) VALUES
(1, 'Gisagara'),
(2, 'Kicukiro'),
(3, 'Gasabo'),
(4, 'Rwamagana'),
(5, 'Rulindo'),
(6, 'Karongi');

-- --------------------------------------------------------

--
-- Table structure for table `droped`
--

CREATE TABLE `droped` (
  `droped_id` int(3) NOT NULL,
  `student_id` int(3) NOT NULL,
  `date` date NOT NULL,
  `status` int(2) NOT NULL,
  `user_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `droped`
--

INSERT INTO `droped` (`droped_id`, `student_id`, `date`, `status`, `user_id`) VALUES
(1, 2, '2019-09-23', 0, 2),
(2, 0, '2019-09-19', 1, 2),
(3, 3, '2019-09-28', 0, 2),
(4, 4, '2019-09-23', 1, 2),
(5, 5, '2019-07-06', 1, 3),
(6, 6, '2019-07-06', 1, 3),
(10, 9, '2019-08-13', 1, 4),
(11, 9, '2019-08-16', 1, 4),
(12, 10, '2019-08-18', 0, 4),
(13, 10, '2019-08-20', 0, 4),
(14, 13, '2019-08-12', 0, 4),
(15, 14, '2019-08-14', 0, 16),
(16, 15, '2019-08-14', 0, 18),
(17, 16, '2019-08-14', 0, 4),
(18, 17, '2019-08-19', 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `reason_id` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `student_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rehab`
--

CREATE TABLE `rehab` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `sector_id` int(10) NOT NULL,
  `userId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rehab`
--

INSERT INTO `rehab` (`id`, `name`, `sector_id`, `userId`) VALUES
(1, 'Nyanza Rehab', 3, 1),
(2, 'Musanze Rehab', 5, 12),
(3, 'Rehab 1', 6, 1),
(4, 'Nansdkjasndas', 4, 1),
(5, 'Mokoto Center', 5, 1),
(6, 'Tumba center', 7, 1),
(7, 'Save Center', 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `school_name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `village_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`, `user_id`, `village_id`) VALUES
(1, 'Groupe Scolaire Sainte Bernade Save', 5, 1),
(2, 'Ecole Technique Saint KIZITO Save', 2, 1),
(3, 'College immaculee conception', 4, 8),
(4, 'jhgh', 1, 1),
(5, 'nsjnajksncja', 1, 4),
(6, 'ddsadasdWDQWQW', 1, 3),
(7, 'TCT', 1, 8),
(8, 'CTC', 1, 1),
(9, 'CTC2', 1, 7),
(10, 'Saint bernadette', 1, 8),
(11, 'Saint Kizito', 1, 9),
(12, 'Saint Kizito', 1, 8),
(13, 'Saint Kizito', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `sector_id` int(3) NOT NULL,
  `sector_name` varchar(25) NOT NULL,
  `district_id` int(2) NOT NULL,
  `user_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_name`, `district_id`, `user_id`) VALUES
(1, 'Save', 1, 15),
(2, 'Gikondo', 2, 1),
(3, 'Kimironko', 3, 20),
(4, 'Muhazi', 4, 1),
(5, 'Burega', 5, 1),
(6, 'Kimironko', 2, 9),
(7, 'Burega', 6, 1),
(8, 'Ruyenzi', 4, 1),
(9, 'Tumba', 5, 14),
(10, 'Mukoto', 5, 1),
(11, 'Nyirangarama', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(4) NOT NULL,
  `Fname` text NOT NULL,
  `Lname` text NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Father` varchar(50) NOT NULL,
  `Fathercontact` varchar(20) NOT NULL,
  `Mother` varchar(50) NOT NULL,
  `Mothercontact` varchar(20) NOT NULL,
  `behaviour` varchar(100) DEFAULT NULL,
  `ubudehe` int(2) NOT NULL,
  `village_id` int(4) NOT NULL,
  `class_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `Fname`, `Lname`, `Gender`, `Father`, `Fathercontact`, `Mother`, `Mothercontact`, `behaviour`, `ubudehe`, `village_id`, `class_id`) VALUES
(0, 'IRAGUHA', 'Lionel', 'male', 'Samwuel', '0785656567', 'Isdolla', '0735785101', NULL, 0, 2, 1),
(2, 'TUMAYINE', 'Innocent', 'male', 'Innocent', '0723644579', 'Innocente', '0723585989', NULL, 0, 3, 1),
(3, 'IRAKOZE', 'Jean claude', 'male', 'Francois NDAYAMBAJE', '0788594901', 'Vestine MUKOBWUJAHA', '0788590844', NULL, 0, 4, 1),
(4, 'RUHIMBAZA', 'Bertin', 'male', 'Ngarambe antoine', '0789545235', 'Nyirabanyiginya venansie', '0726549899', NULL, 0, 5, 4),
(5, 'KUBWIMANA ', 'Doriane', 'female', 'Singizwa come', '0723644512', 'Madina nyiraneza', '0788590189', NULL, 0, 6, 7),
(6, 'MANZI', 'Aime Prince', 'male', 'Nsengiyumwa cassien', '0732458975', 'Muntabana ellen', '0723698666', NULL, 0, 7, 9),
(7, 'NIYOMUGABO', 'Jean d\'amour', 'male', 'Augustin ndayamaje', '0734559578', 'Mukandayisenga emertha', '0788431259', NULL, 0, 8, 5),
(8, 'HAGIMANA', 'Jean claude', 'male', 'Ngabo', '0788456563', 'Mukam', '0738588888', NULL, 0, 9, 3),
(9, 'ESTER', 'Sdfaefew', 'male', 'jean', '0789910359', 'rehem', '0789910345', NULL, 0, 10, 12),
(10, 'ESTER', 'Sdfaefew', 'male', 'Jean', '0789910359', 'Rehema', '0789910345', NULL, 0, 10, 13),
(11, 'EMMY', 'Nse', 'female', 'Qefsadfad', '0789910359', 'Fvbdfbdgb', '0789910432', NULL, 0, 5, 0),
(12, 'EMMY3', 'Mimimimii', '', 'Jean', '0789910358', 'Yvonee', '0789911432', NULL, 0, 7, 0),
(13, 'EMMY36', 'Nse', 'female', 'Justin nagano', '0789910356', 'Justine Manzi', '0789940432', NULL, 0, 9, 14),
(14, 'BOSCO', 'Ntare', 'male', 'Manzi', '078987631', 'Manzi', '0783276542', NULL, 0, 6, 15),
(15, 'NSHIMYUMUKIZA', 'Christian', 'male', 'James', '0789910342', 'Agnes', '078234372', NULL, 0, 6, 18),
(16, 'TONY', 'Tony', 'male', 'Tony A', '0789965432', 'Tony B', '0786543654', NULL, 0, 6, 14),
(17, 'TEST', 'Test2', 'male', 'Test father', '0789654325', 'Test mother', '0736547865', NULL, 0, 1, 17),
(18, 'TUNE', 'Pati', 'male', 'Pati', '0789910234', 'Gigi', '0723456873', NULL, 3, 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `drop_id` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `comment` varchar(10) NULL,
  `rehab_id` int(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`transfer_id`, `drop_id`, `start_date`, `end_date`, `rehab_id`, `status`) VALUES
(5, 2, '2019-08-12', '0000-00-00', 2, 0),
(6, 4, '2019-08-12', '0000-00-00', 2, 1),
(7, 14, '2019-08-12', '0000-00-00', 2, 0),
(8, 14, '2019-08-12', '0000-00-00', 2, 1),
(9, 3, '2019-08-12', '2019-08-31', 2, 1),
(10, 12, '2019-08-13', '2019-11-07', 2, 1),
(11, 12, '2019-08-13', '2019-11-07', 2, 1),
(12, 12, '2019-08-13', '2019-11-07', 2, 0),
(13, 15, '2019-08-14', '2019-12-12', 2, 1),
(14, 16, '2019-08-14', '2019-09-14', 7, 1),
(15, 6, '2019-08-14', '2019-09-14', 7, 0),
(16, 5, '2019-08-14', '2019-09-14', 7, 0),
(17, 17, '2019-08-14', '2019-09-11', 7, 1),
(18, 18, '2019-08-19', '2019-09-11', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Names` char(30) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `identity_no` int(16) NOT NULL,
  `Usertype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `Username`, `Password`, `Names`, `Telephone`, `identity_no`, `Usertype`) VALUES
(1, 'Admin', '123', 'Robinson carlos', '0726387260', 2147483647, 'administrator'),
(2, 'Robert', '123', 'Robert stansilas', '0788965470', 2147483647, 'user'),
(3, 'Muka', '123', 'Mukamuligo', '0723654988', 2147483647, 'executive'),
(4, 'Sabin', '123', 'Abayo sabin', '0726615641', 2147483647, 'user'),
(5, 'saint', '123', 'Ester', '0789910359', 2147483647, 'user'),
(7, 'WAdwe', '123', 'qsdas', 'ADWQDQ', 0, 'executive'),
(8, 'nyagahene', '123', 'nyagahene', '0789923476', 72631800, 'executive'),
(9, 'Okk', '123', ' Okkk OKk oKKK', '0789923476', 72631800, 'executive'),
(12, 'new', 'new', 'new', '12', 12, 'rehab'),
(13, 'bona3', '123', 'Bona', '0789920432', 2147483647, 'user'),
(14, 'bonaventure', '123', 'Bona', '0787635873', 12341241, 'executive'),
(15, 'Save_sec', '123', 'Save SEC', '078991342', 213213, 'executive'),
(16, 'kiba', '123', 'kIbanguka', '0786574256', 67576585, 'user'),
(17, 'tumba', '123', 'tumba', '0789965432', 2147483647, 'rehab'),
(18, 'jean', '123', 'Jean Bigiricanyi', '0789910478', 2147483647, 'user'),
(19, 'kizito', '123', 'Kizito', '078654325', 23456789, 'rehab'),
(20, '', '', '', 'q', 0, 'executive');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `village_id` int(4) NOT NULL,
  `villagename` varchar(10) NOT NULL,
  `cell_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`village_id`, `villagename`, `cell_id`) VALUES
(1, 'Kavumu', 1),
(2, 'Ikaze', 2),
(3, 'Maraba', 3),
(4, 'Kibale', 4),
(5, 'Butangampu', 5),
(6, 'Itetero', 6),
(7, 'Maraba', 7),
(8, 'Kaneke', 8),
(9, 'Ikaze', 9),
(10, 'Urugwiro', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cells`
--
ALTER TABLE `cells`
  ADD PRIMARY KEY (`cell_id`),
  ADD KEY `sector_id` (`sector_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `depts`
--
ALTER TABLE `depts`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `droped`
--
ALTER TABLE `droped`
  ADD PRIMARY KEY (`droped_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `rehab`
--
ALTER TABLE `rehab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sector_id` (`sector_id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `village_id` (`village_id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`),
  ADD KEY `district_id` (`district_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `village_id` (`village_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `rehab_id` (`rehab_id`),
  ADD KEY `drop_id` (`drop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`village_id`),
  ADD KEY `cell_id` (`cell_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cells`
--
ALTER TABLE `cells`
  MODIFY `cell_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `depts`
--
ALTER TABLE `depts`
  MODIFY `dept_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `droped`
--
ALTER TABLE `droped`
  MODIFY `droped_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `reason_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rehab`
--
ALTER TABLE `rehab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `village_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `depts` (`dept_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
