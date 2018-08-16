-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2018 at 08:09 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Admin_name` varchar(50) NOT NULL,
  `Admin_Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Admin_name`, `Admin_Password`) VALUES
(1, 'Payel', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `E_id` int(11) NOT NULL,
  `E_name` text NOT NULL,
  `_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`E_id`, `E_name`, `_date`) VALUES
(1, 'Mukesh', '2018-04-02'),
(1, 'Mukesh', '2018-04-03'),
(1, 'Mukesh', '2018-04-04'),
(2, 'Rahul', '2018-04-05'),
(2, 'Rahul', '2018-04-06'),
(1, 'Mukesh', '2018-04-07'),
(1, 'Mukesh', '2018-04-09'),
(1, 'Mukesh', '2018-04-10'),
(2, 'Rahul', '2018-04-11'),
(2, 'Rahul', '2018-04-12'),
(2, 'Rahul', '2018-04-16'),
(2, 'Rahul', '2018-04-17'),
(2, 'Rahul', '2018-04-18'),
(2, 'Rahul', '2018-04-19'),
(3, 'Rohit', '2018-04-20'),
(3, 'Rohit', '2018-04-21'),
(3, 'Rohit', '2018-04-23'),
(3, 'Rohit', '2018-04-25'),
(1, 'Mukesh', '2018-04-26'),
(1, 'Mukesh', '2018-04-27'),
(1, 'Mukesh', '2018-04-28'),
(2, 'Rahul', '2018-04-30'),
(3, 'Pinky', '2018-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `E_id` int(11) NOT NULL,
  `Employee_name` varchar(50) NOT NULL,
  `Employee_address` varchar(100) NOT NULL,
  `Employee_email` varchar(100) NOT NULL,
  `Employee_contactNo` varchar(20) NOT NULL,
  `Employee_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`E_id`, `Employee_name`, `Employee_address`, `Employee_email`, `Employee_contactNo`, `Employee_password`) VALUES
(1, 'payel Sharma', 'north lakhimpur', 'payelsharmaa@gmail.com', '1234567898', '1212324gfdg'),
(3, 'roshan', 'lucknow', 'roshan@gmail.com', '4168484984', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE `employee_leave` (
  `E_id` int(11) NOT NULL,
  `L_id` int(11) NOT NULL,
  `Leave_from_date` date NOT NULL,
  `Leave_to_date` date NOT NULL,
  `Leave_type` text NOT NULL,
  `Leave_reason` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`E_id`, `L_id`, `Leave_from_date`, `Leave_to_date`, `Leave_type`, `Leave_reason`) VALUES
(55, 1, '2018-04-09', '2018-04-12', 'Marital', 'Unavoidable Reasons'),
(37, 2, '2018-04-02', '2018-04-07', 'casual ', 'dfdgdf');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `H_id` int(11) NOT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_date_from` date NOT NULL,
  `holiday_date_to` date NOT NULL,
  `holiday_description` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`H_id`, `holiday_name`, `holiday_date_from`, `holiday_date_to`, `holiday_description`) VALUES
(1, 'Independence Day', '2018-08-15', '2018-08-15', 'Independence Day is annually celebrated on 15 August, as a national holiday in India.'),
(2, 'Rongali Bihu-1', '2018-04-13', '2018-04-14', 'The Rongali Bihu Festival in Assam begins in the middle of the month of April, which is the last day of the month of Chaitra according to the Hindu calendar.'),
(3, 'Rongali Bihu-2', '2018-04-16', '2018-04-16', 'The Rongali Bihu Festival in Assam begins in the middle of the month of April, which is the last day of the month of Chaitra according to the Hindu calendar.');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `LT_id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`LT_id`, `type`) VALUES
(1, 'Marital'),
(2, 'casual ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`E_id`);

--
-- Indexes for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD PRIMARY KEY (`L_id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`H_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`LT_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `E_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `L_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `H_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `LT_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
