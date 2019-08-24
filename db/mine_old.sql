-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2015 at 06:09 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mine`
--

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE IF NOT EXISTS `cells` (
  `cell_id` int(4) NOT NULL AUTO_INCREMENT,
  `cellname` varchar(15) NOT NULL,
  `sector_id` int(3) NOT NULL,
  PRIMARY KEY (`cell_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(8, 'Rwanza', 1),
(9, 'Rwanza', 8);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(3) NOT NULL AUTO_INCREMENT,
  `year` int(2) NOT NULL,
  `letter` text NOT NULL,
  `dept_id` int(3) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
(11, 4, 'B', 6);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Names` text NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Message` varchar(500) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Id`, `Names`, `Email`, `Message`) VALUES
(1, 'Robinson Carlos', 'robinsoncarlos56@gmail.com', 'Thx for your system! but if possible you can host it in order to help all schools in our country because it is very accurate.');

-- --------------------------------------------------------

--
-- Table structure for table `depts`
--

CREATE TABLE IF NOT EXISTS `depts` (
  `dept_id` int(3) NOT NULL AUTO_INCREMENT,
  `deptname` text NOT NULL,
  `deptacronym` text NOT NULL,
  `school_id` int(3) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `depts`
--

INSERT INTO `depts` (`dept_id`, `deptname`, `deptacronym`, `school_id`) VALUES
(1, 'Computer Science', 'CSC', 2),
(2, 'Computer Electronic', 'CEL', 2),
(3, 'Public Work', 'PWO', 2),
(4, 'Phyiscs chemistry maths', 'PCM', 1),
(5, 'History Economy Geography', 'HEG', 1),
(6, 'Electricity', 'ELC', 2);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` int(2) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(20) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `droped` (
  `droped_id` int(3) NOT NULL AUTO_INCREMENT,
  `student_id` int(3) NOT NULL,
  `date` date NOT NULL,
  `status` int(2) NOT NULL,
  `user_id` int(4) NOT NULL,
  PRIMARY KEY (`droped_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `droped`
--

INSERT INTO `droped` (`droped_id`, `student_id`, `date`, `status`, `user_id`) VALUES
(1, 2, '2015-09-23', 0, 2),
(2, 0, '2015-09-19', 1, 2),
(3, 3, '2015-09-28', 1, 2),
(4, 4, '2015-09-23', 1, 2),
(5, 5, '2015-09-23', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  PRIMARY KEY (`school_id`),
  KEY `user_id` (`user_id`),
  KEY `village_id` (`village_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`, `user_id`, `village_id`) VALUES
(1, 'Groupe Scolaire Sainte Bernade Save', 3, 1),
(2, 'Ecole Technique Saint KIZITO Save', 2, 1),
(3, 'College immaculee conception', 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `sector_id` int(3) NOT NULL AUTO_INCREMENT,
  `sector_name` varchar(10) NOT NULL,
  `district_id` int(2) NOT NULL,
  PRIMARY KEY (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_name`, `district_id`) VALUES
(1, 'Save', 1),
(2, 'Gikondo', 2),
(3, 'Kimironko', 3),
(4, 'Muhazi', 4),
(5, 'Burega', 5),
(6, 'Kimironko', 2),
(7, 'Burega', 6),
(8, 'Ruyenzi', 4);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(4) NOT NULL AUTO_INCREMENT,
  `Fname` text NOT NULL,
  `Lname` text NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Father` varchar(50) NOT NULL,
  `Fathercontact` varchar(20) NOT NULL,
  `Mother` varchar(50) NOT NULL,
  `Mothercontact` varchar(20) NOT NULL,
  `village_id` int(4) NOT NULL,
  `class_id` int(4) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `Fname`, `Lname`, `Gender`, `Father`, `Fathercontact`, `Mother`, `Mothercontact`, `village_id`, `class_id`) VALUES
(0, 'IRAGUHA', 'Lionel', 'male', 'Samwuel', '0785656567', 'Isdolla', '0735785101', 2, 1),
(2, 'TUMAYINE', 'Innocent', 'male', 'Innocent', '0723644579', 'Innocente', '0723585989', 3, 1),
(3, 'IRAKOZE', 'Jean claude', 'male', 'Francois NDAYAMBAJE', '0788594901', 'Vestine MUKOBWUJAHA', '0788590844', 4, 1),
(4, 'RUHIMBAZA', 'Bertin', 'male', 'Ngarambe antoine', '0789545235', 'Nyirabanyiginya venansie', '0726549899', 5, 4),
(5, 'KUBWIMANA ', 'Doriane', 'female', 'Singizwa come', '0723644512', 'Madina nyiraneza', '0788590189', 6, 7),
(6, 'MANZI', 'Aime Prince', 'male', 'Nsengiyumwa cassien', '0732458975', 'Muntabana ellen', '0723698666', 7, 9),
(7, 'NIYOMUGABO', 'Jean d''amour', 'male', 'Augustin ndayamaje', '0734559578', 'Mukandayisenga emertha', '0788431259', 8, 5),
(8, 'HAGIMANA', 'Jean claude', 'male', 'Ngabo', '0788456563', 'Mukam', '0738588888', 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Names` char(30) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `identity_no` int(16) NOT NULL,
  `Usertype` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `Username`, `Password`, `Names`, `Telephone`, `identity_no`, `Usertype`) VALUES
(1, 'Admin', '123', 'Robinson carlos', '0726387260', 2147483647, 'administrator'),
(2, 'Robert', '123', 'Robert stansilas', '0788965470', 2147483647, 'user'),
(3, 'Muka', '123', 'Mukamuligo', '0723654988', 2147483647, 'user'),
(4, 'Sabin', '123', 'Abayo sabin', '0726615641', 2147483647, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE IF NOT EXISTS `villages` (
  `village_id` int(4) NOT NULL AUTO_INCREMENT,
  `villagename` varchar(10) NOT NULL,
  `cell_id` int(11) NOT NULL,
  PRIMARY KEY (`village_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(9, 'Ikaze', 9);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE IF NOT EXISTS `year` (
  `year_id` int(1) NOT NULL AUTO_INCREMENT,
  `year` int(4) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
