-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 09:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `iline`
--

CREATE TABLE `iline` (
  `ino` int(5) NOT NULL,
  `itype` varchar(20) NOT NULL,
  `icode` int(5) NOT NULL,
  `uprice` int(20) NOT NULL,
  `rqty` int(10) NOT NULL,
  `dqty` int(100) NOT NULL,
  `qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iline`
--

INSERT INTO `iline` (`ino`, `itype`, `icode`, `uprice`, `rqty`, `dqty`, `qty`) VALUES
(247, '', 65, 0, 10, 10, 0),
(249, '', 68, 0, 10, 0, 0),
(250, '', 67, 0, 43, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invent`
--

CREATE TABLE `invent` (
  `ino` int(5) NOT NULL,
  `itype` varchar(20) NOT NULL,
  `vdate` date NOT NULL,
  `sno` int(10) DEFAULT NULL,
  `total` int(20) DEFAULT NULL,
  `sref` varchar(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `status` int(3) NOT NULL,
  `ostatus` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invent`
--

INSERT INTO `invent` (`ino`, `itype`, `vdate`, `sno`, `total`, `sref`, `uid`, `status`, `ostatus`) VALUES
(247, 'OR', '2023-05-25', NULL, 0, '', 36, 1, 3),
(249, 'OR', '2023-05-25', NULL, 0, '', 36, 0, 4),
(250, 'OR', '2023-05-31', NULL, NULL, '', 36, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `icode` int(5) NOT NULL,
  `iname` varchar(20) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `itype` varchar(20) NOT NULL,
  `uprice` int(20) NOT NULL,
  `qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`icode`, `iname`, `sname`, `itype`, `uprice`, `qty`) VALUES
(65, 'A4 Sheet', 'A4', '', 0, 1090),
(66, 'file cover', 'ගොනු ආවරණ', '', 0, 5),
(67, 'gloves', 'අත්වැසුම්', '', 0, 0),
(68, 'stepler pin', 'ස්ටේප්ලර් පින්', '', 0, 12),
(69, 'tonor', 'tonar', '', 0, 0),
(70, 'scissor', 'kathura', '', 0, 76),
(71, 'b', 'h', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(10) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `vdate` date NOT NULL,
  `iname` varchar(20) NOT NULL,
  `rqty` int(10) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `oactive` int(1) NOT NULL,
  `ostatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`oactive`, `ostatus`) VALUES
(0, 'request'),
(1, 'deliver'),
(2, 'canceled');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `pgid` int(5) NOT NULL,
  `pghead` varchar(30) NOT NULL,
  `pgfile` varchar(30) NOT NULL,
  `pgicon` varchar(30) NOT NULL,
  `accessDesi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`pgid`, `pghead`, `pgfile`, `pgicon`, `accessDesi`) VALUES
(1, 'Dashboard', 'userdboard.php', 'fa fa-align-justify', '1'),
(2, 'Dashboard', 'stockdboard.php', 'fa fa-align-justify', '2'),
(3, 'Dashboard', 'admindboard.php', 'fa fa-align-justify', '3'),
(4, 'Dashboard', 'aodboard.php', 'fa fa-align-justify', '4'),
(5, 'Items', 'items.php', 'fas fa-th-list', '2,3,4'),
(6, 'Issued Items', 'issued.php', 'fas fa-vote-yea', '2'),
(7, 'Received Items', 'received.php', 'fas fa-shopping-cart', '2'),
(8, 'All Users', 'allusers.php', 'fa fa-users', '2,3,4'),
(9, 'Suppliers', 'suppliers.php', 'fa fa-sitemap', '2,3,4'),
(10, 'Profile', 'profile.php', 'fas fa-users-cog', '1,2,3,4'),
(11, 'Log out', 'logout.php', 'fas fa-sign-out-alt', '1,2,3,4'),
(12, 'Reports', 'reports.php', '', '1,2,3,4');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sno` int(10) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `sadd` varchar(50) NOT NULL,
  `stel` int(10) NOT NULL,
  `semail` varchar(20) NOT NULL,
  `spname` varchar(50) NOT NULL,
  `sptel` int(10) NOT NULL,
  `spmail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `udesi` varchar(20) NOT NULL,
  `upcode` varchar(20) NOT NULL,
  `uactive` int(3) NOT NULL,
  `usec_id` int(10) NOT NULL,
  `telno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `udesi`, `upcode`, `uactive`, `usec_id`, `telno`) VALUES
(39, 'admin', '3', 'admin', 2, 1, '0917854963');

-- --------------------------------------------------------

--
-- Table structure for table `user_section`
--

CREATE TABLE `user_section` (
  `usection_id` int(10) NOT NULL,
  `usection` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_section`
--

INSERT INTO `user_section` (`usection_id`, `usection`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `ustatus`
--

CREATE TABLE `ustatus` (
  `uactive` int(3) NOT NULL,
  `u_st_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ustatus`
--

INSERT INTO `ustatus` (`uactive`, `u_st_name`) VALUES
(0, 'disable'),
(1, 'insert'),
(2, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `u_desi_name`
--

CREATE TABLE `u_desi_name` (
  `u_desi_index` int(10) NOT NULL,
  `udesi` varchar(20) NOT NULL,
  `u_desi_page` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `u_desi_name`
--

INSERT INTO `u_desi_name` (`u_desi_index`, `udesi`, `u_desi_page`) VALUES
(1, 'user', 1),
(2, 'stock keeper', 2),
(3, 'admin', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iline`
--
ALTER TABLE `iline`
  ADD PRIMARY KEY (`ino`);

--
-- Indexes for table `invent`
--
ALTER TABLE `invent`
  ADD PRIMARY KEY (`ino`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`icode`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`oactive`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`pgid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_section`
--
ALTER TABLE `user_section`
  ADD PRIMARY KEY (`usection_id`);

--
-- Indexes for table `ustatus`
--
ALTER TABLE `ustatus`
  ADD PRIMARY KEY (`uactive`);

--
-- Indexes for table `u_desi_name`
--
ALTER TABLE `u_desi_name`
  ADD PRIMARY KEY (`u_desi_index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iline`
--
ALTER TABLE `iline`
  MODIFY `ino` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `invent`
--
ALTER TABLE `invent`
  MODIFY `ino` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `icode` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_section`
--
ALTER TABLE `user_section`
  MODIFY `usection_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
