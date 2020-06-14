-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 05, 2019 at 01:45 PM
-- Server version: 5.7.23
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_ucportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '0ec41debe09e5ec84f85a205e8709937');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuel_requests`
--

CREATE TABLE `tbl_fuel_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_date` varchar(255) NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `purpose` text NOT NULL,
  `client_username` varchar(255) NOT NULL,
  `total_distance` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `request_status` varchar(255) NOT NULL DEFAULT 'Under Review',
  `approved_distance` int(11) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `created_on` varchar(255) NOT NULL,
  `updated_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_fuel_requests`
--

INSERT INTO `tbl_fuel_requests` (`id`, `user_id`, `request_date`, `ticket_number`, `start`, `end`, `from`, `to`, `purpose`, `client_username`, `total_distance`, `status`, `request_status`, `approved_distance`, `remarks`, `created_on`, `updated_on`) VALUES
(2, 2, '2019-07-02', '123456', '100', '101', 'New Baneshwor', 'Sinamangal', 'Installation', 'santosh1992', '2', 'pending', 'Declined', 0, '', '2019-07-02 18:50:12', '2019-07-03 15:15:50'),
(3, 2, '2019-07-03', '456789', '110', '115', 'Office', 'SAB School', 'Internet connection not working', 'sab123', '5', 'completed', 'Approved', 5, 'Approved ', '2019-07-03 15:23:29', '2019-07-03 15:29:17'),
(4, 2, '2019-07-03', '3456789', '105', '113', 'Office', 'Tinkune', 'Fixing router issue', 'tinkune123#', '7', 'pending', 'Approved', 5, 'Approved with grace', '2019-07-03 15:34:42', '2019-07-03 15:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actual_password` varchar(255) NOT NULL COMMENT 'stores the actual password',
  `position` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_on` varchar(255) NOT NULL,
  `updated_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `actual_password`, `position`, `status`, `created_on`, `updated_on`) VALUES
(2, 'Santosh Neupane', 'neu.santosh@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 'Sales Incharge', 1, '2019-07-01 23:35:22', '2019-07-02 11:18:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_fuel_requests`
--
ALTER TABLE `tbl_fuel_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_fuel_requests`
--
ALTER TABLE `tbl_fuel_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
