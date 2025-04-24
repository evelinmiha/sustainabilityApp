-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 11:28 PM
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
-- Database: `sustainabilitydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `adminname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `adminname`, `email`, `password`, `created_at`) VALUES
(2, 'admin', 'admin@example.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2025-04-14 14:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `exp_month` tinyint(4) NOT NULL,
  `exp_year` tinyint(4) NOT NULL,
  `cvv` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `company_id`, `card_number`, `exp_month`, `exp_year`, `cvv`, `created_at`) VALUES
(10, 12, '1111111111111111', 7, 35, 127, '2025-04-14 20:50:54'),
(11, 13, '7654333456666444', 8, 31, 127, '2025-04-14 20:58:39'),
(12, 14, '3434534535353333', 5, 29, 127, '2025-04-14 22:49:32'),
(13, 15, '5464634333333333', 9, 29, 127, '2025-04-21 13:57:08'),
(14, 16, '2352352435435345', 9, 29, 127, '2025-04-22 20:14:27'),
(15, 17, '8867565444445544', 12, 29, 127, '2025-04-22 22:20:11'),
(16, 18, '1221231321313111', 11, 31, 127, '2025-04-22 22:35:41'),
(25, 19, '8888888888888888', 8, 29, 127, '2025-04-23 15:46:49'),
(26, 20, '3254354354353453', 12, 29, 127, '2025-04-23 16:08:25'),
(27, 21, '1231231231313123', 12, 28, 127, '2025-04-23 18:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `certificateID` int(10) UNSIGNED NOT NULL,
  `issueDate` date NOT NULL,
  `level` enum('bronze','silver','gold') NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`certificateID`, `issueDate`, `level`, `company_id`) VALUES
(6, '2025-04-14', 'gold', 12),
(7, '2025-04-14', 'silver', 13),
(8, '2025-04-14', 'silver', 14),
(9, '2025-04-21', 'silver', 15),
(10, '2025-04-22', 'silver', 16),
(11, '2025-04-22', 'silver', 17),
(12, '2025-04-22', 'bronze', 18),
(13, '2025-04-23', 'silver', 19),
(14, '2025-04-23', 'bronze', 21);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) UNSIGNED NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `industry` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone_number` bigint(20) NOT NULL,
  `subscription_status` enum('active','inactive','deactivated') NOT NULL,
  `contact_person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `email`, `password`, `join_date`, `industry`, `address`, `telephone_number`, `subscription_status`, `contact_person`) VALUES
(12, 'eve6', 'eve6@hotmail.com', 'f93df6c14a50eb8864baad03e0819264584d7f07c7c9cc034874decef4c4104e', '2025-04-14 20:44:27', 'IT3', 'hello1', 9223372036854775807, 'active', 'eveeve'),
(13, 'Eve7', 'eve7@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-14 20:52:23', 'IT', 'dsfdsfdsfsf', 23232333, 'deactivated', 'eve7'),
(14, 'evenew', 'evenew@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-14 22:49:15', 'IT', 'gjjghjghjhg', 324234523456, 'active', 'eve'),
(15, 'NewEve', 'eve1@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-21 13:56:57', 'IT', 'dsgdfgfdgdg', 54353535, 'active', 'Eve'),
(16, 'eve11', 'eve11@hotmail.ocm', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-22 20:13:54', 'IT31', 'adfsfsdf', 3223322222, 'active', 'eve'),
(17, 'evee1', 'evee1@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-22 22:19:59', 'IT', 'dgdfhdfgdfgdfg', 3454354353, 'active', 'Evee'),
(18, 'aaa', 'aaa@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-22 22:35:31', 'asfds', 'asdad', 32432, 'active', 'eve'),
(19, 'eve33', 'eve33@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-22 23:23:58', 'IT5', 'dsgdsgdsgdfg', 335435435435435, 'active', 'eve33'),
(20, 'eveeve', 'eve@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-23 15:48:49', 'IT', 'gfhfhgfhfhfhfddd', 76867867868686, 'active', 'eve'),
(21, 'eveve1', 'eveve1@hotmail.com', '85262adf74518bbb70c7cb94cd6159d91669e5a81edf1efebd543eadbda9fa2b', '2025-04-23 18:32:53', 'IT', 'dfdsfdsf', 32424242424, 'active', 'eve');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNumber` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `submittedDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `fullName`, `email`, `contactNumber`, `message`, `submittedDate`) VALUES
(1, 'Eve1', 'eve1@hotmail.com', '32424242424', 'Hello my friends, Im checking the website :)', '2025-04-14 22:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `greencalculator`
--

CREATE TABLE `greencalculator` (
  `greenCalculatorID` int(11) NOT NULL,
  `carbonReduction` decimal(10,2) NOT NULL,
  `wasteReduction` decimal(10,2) NOT NULL,
  `biodiversity` decimal(10,2) NOT NULL,
  `energyEfficiency` decimal(10,2) NOT NULL,
  `transportationSustainability` decimal(10,2) NOT NULL,
  `ecoProducts` decimal(10,2) NOT NULL,
  `packaging` decimal(10,2) NOT NULL,
  `compliance` decimal(10,2) NOT NULL,
  `education` decimal(10,2) NOT NULL,
  `transparency` decimal(10,2) NOT NULL,
  `totalScore` decimal(10,2) NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `greencalculator`
--

INSERT INTO `greencalculator` (`greenCalculatorID`, `carbonReduction`, `wasteReduction`, `biodiversity`, `energyEfficiency`, `transportationSustainability`, `ecoProducts`, `packaging`, `compliance`, `education`, `transparency`, `totalScore`, `company_id`, `submission_date`) VALUES
(8, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 100.00, 12, '2025-04-14 20:51:28'),
(9, 10.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 0.00, 0.00, 10.00, 50.00, 13, '2025-04-14 20:59:07'),
(10, 5.00, 5.00, 5.00, 5.00, 5.00, 10.00, 10.00, 10.00, 10.00, 10.00, 75.00, 14, '2025-04-14 22:49:57'),
(11, 5.00, 10.00, 5.00, 0.00, 5.00, 5.00, 10.00, 5.00, 0.00, 5.00, 50.00, 15, '2025-04-21 16:59:18'),
(12, 5.00, 10.00, 0.00, 5.00, 10.00, 0.00, 5.00, 5.00, 0.00, 10.00, 50.00, 16, '2025-04-22 20:19:45'),
(13, 5.00, 0.00, 10.00, 5.00, 10.00, 0.00, 5.00, 0.00, 5.00, 10.00, 50.00, 17, '2025-04-22 22:21:18'),
(14, 5.00, 5.00, 10.00, 0.00, 5.00, 0.00, 0.00, 5.00, 0.00, 0.00, 30.00, 18, '2025-04-22 22:36:01'),
(15, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 5.00, 10.00, 0.00, 0.00, 75.00, 19, '2025-04-22 23:24:31'),
(16, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 21, '2025-04-23 18:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `voucher_id` int(11) NOT NULL,
  `points_purchased` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`voucher_id`, `points_purchased`, `amount_paid`, `company_id`) VALUES
(8, 66, 660.00, 13),
(9, 47, 470.00, 14),
(10, 50, 500.00, 16),
(11, 50, 500.00, 16),
(12, 50, 500.00, 16),
(13, 50, 500.00, 17),
(14, 75, 750.00, 18),
(15, 25, 250.00, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificateID`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`);

--
-- Indexes for table `greencalculator`
--
ALTER TABLE `greencalculator`
  ADD PRIMARY KEY (`greenCalculatorID`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`voucher_id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificateID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `greencalculator`
--
ALTER TABLE `greencalculator`
  MODIFY `greenCalculatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD CONSTRAINT `bank_details_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `greencalculator`
--
ALTER TABLE `greencalculator`
  ADD CONSTRAINT `greencalculator_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
