-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 06:29 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cursor_online_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `links` varchar(50) NOT NULL,
  `barcode` int(1) NOT NULL,
  `ware` int(10) NOT NULL,
  `asce` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `links`, `barcode`, `ware`, `asce`) VALUES
(1, 'SETTING', '', 0, 0, 1),
(2, 'Project', '', 0, 0, 2),
(3, 'Ticket', '', 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `id` int(20) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `ware` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `active` varchar(20) NOT NULL,
  `by` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `session` varchar(100) NOT NULL,
  `rank` int(11) NOT NULL COMMENT 'to set rank of super admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`id`, `user`, `password`, `ware`, `type`, `active`, `by`, `status`, `session`, `rank`) VALUES
(1, 'hadmin', '123', '0', '1', '1', '', 0, '6fonkbspb5h4g26klj50i68glp', 0),
(2, 'admin', '123', '1', '2', '1', '1', 0, '7bbml1ukovltre0jn7hu5uau7r', 0),
(3, 'user23', '123', '1', '3', '1', '1', 0, 'evjk2n35n6js3l3v2qrg3ebekv', 0),
(4, 'Rimon', '123', '1', '3', '1', '1', 0, '', 0),
(5, 'Rimon3', '123', '1', '3', '1', '1', 0, '', 0),
(6, 'Rimon1', '123', '1', '3', '1', '1', 0, '', 0),
(7, 'Rimon5', '123', '1', '3', '1', '1', 0, 'a477c9cj6nmudk77onfpnq128u', 0),
(8, 'RimonAdmin', '123', '1', '2', '1', '1', 0, 'a477c9cj6nmudk77onfpnq128u', 0),
(9, 'Rimon66', '123', '1', '3', '1', '1', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(20) NOT NULL,
  `root` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `links` varchar(50) NOT NULL,
  `ware` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `root`, `name`, `links`, `ware`) VALUES
(1, 1, 'USER', 'admin/create_user', 0),
(2, 1, 'User All', 'admin/user_all', 0),
(3, 2, 'Project All', 'project/project_all', 0),
(4, 3, 'New Ticket', 'ticket/create_ticket', 0),
(5, 3, 'Opened Ticket', 'ticket/all_ticket', 0),
(6, 3, 'Completed Ticket', 'ticket/all_completed_ticket', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_list`
--

CREATE TABLE `tbl_message_list` (
  `message_id` int(11) NOT NULL,
  `is_img` smallint(6) NOT NULL COMMENT '0=no, 1=yes image',
  `message` text NOT NULL,
  `to_whom` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'who send the message',
  `ticket_id` int(11) NOT NULL,
  `ware_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `message_time` datetime NOT NULL,
  `is_seen` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message_list`
--

INSERT INTO `tbl_message_list` (`message_id`, `is_img`, `message`, `to_whom`, `user_id`, `ticket_id`, `ware_id`, `status`, `message_time`, `is_seen`) VALUES
(1, 0, 'Ticket 1', 0, 3, 1, 0, 1, '2019-02-03 13:08:50', 0),
(2, 0, 'Ticket 1', 0, 3, 2, 0, 1, '2019-02-03 13:15:34', 0),
(3, 0, 'fdasds', 0, 2, 3, 0, 1, '2019-02-05 11:05:22', 0),
(4, 0, 'Ticket 1', 0, 1, 4, 0, 1, '2019-02-11 17:13:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_priority`
--

CREATE TABLE `tbl_priority` (
  `id` int(11) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_priority`
--

INSERT INTO `tbl_priority` (`id`, `priority`, `status`) VALUES
(1, 'Low', 1),
(2, 'Medium', 1),
(3, 'High', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_start_date` varchar(50) DEFAULT NULL,
  `project_end_date` varchar(50) DEFAULT NULL,
  `project_status` int(11) DEFAULT NULL COMMENT 'status_id',
  `project_ticket` int(11) DEFAULT NULL COMMENT 'ticket_id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`id`, `project_name`, `project_start_date`, `project_end_date`, `project_status`, `project_ticket`) VALUES
(1, 'Project1', '2019-02-01', '', 1, NULL),
(2, 'Project2', '2019-01-25', '', 2, NULL),
(3, 'Project3', '2018-08-01', '2019-01-30', 3, NULL),
(4, 'Project5', '2018-05-01', '2018-09-30', 4, NULL),
(5, 'Project 6 updated', '2019-01-01', '', 5, NULL),
(6, 'Project 7', '2018-11-01', '', 2, NULL),
(7, 'Project8', '2018-07-01', '2019-02-05', 3, NULL),
(8, 'Project 9', '2018-07-01', '2018-11-30', 4, NULL),
(9, 'yyyy', '2019-02-11', '2019-02-13', 1, NULL),
(10, 'Project23', '2019-02-12', '2019-02-12', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `status_name`, `is_active`) VALUES
(1, 'Waiting', 1),
(2, 'Work In Progress', 1),
(3, 'Completed', 1),
(4, 'Received By Customer', 1),
(5, 'Cancled', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE `tbl_tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_sub` text NOT NULL,
  `priority_id` int(11) NOT NULL COMMENT 'id of tbl_priority',
  `ticket_status_id` int(11) NOT NULL COMMENT 'id of tbl_ticket_status',
  `lock_by` int(11) NOT NULL COMMENT '''0'' for all or admin id for who locked it',
  `rating` tinyint(4) NOT NULL,
  `ticket_date_time` datetime NOT NULL,
  `ware_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tickets`
--

INSERT INTO `tbl_tickets` (`ticket_id`, `ticket_sub`, `priority_id`, `ticket_status_id`, `lock_by`, `rating`, `ticket_date_time`, `ware_id`, `user_id`, `status`) VALUES
(1, 'Ticket 1', 3, 1, 0, 0, '2019-02-03 13:08:50', 0, 3, 1),
(2, 'Ticket 1', 3, 1, 0, 0, '2019-02-03 13:15:34', 0, 3, 1),
(3, 'Ticket 1', 1, 1, 0, 0, '2019-02-05 11:05:22', 0, 2, 1),
(4, 'Ticket 1', 2, 1, 0, 0, '2019-02-11 17:13:53', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_status`
--

CREATE TABLE `tbl_ticket_status` (
  `id` int(11) NOT NULL,
  `ticket_status` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ticket_status`
--

INSERT INTO `tbl_ticket_status` (`id`, `ticket_status`, `status`) VALUES
(1, 'Pending', 1),
(2, 'Receive', 1),
(3, 'Work in progress', 1),
(4, 'Complete', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_subjects`
--

CREATE TABLE `tbl_ticket_subjects` (
  `subject_id` int(11) NOT NULL,
  `ticket_subject` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `ware_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(20) NOT NULL,
  `ware` int(20) NOT NULL,
  `head` int(10) NOT NULL,
  `user` int(20) NOT NULL,
  `sub` int(10) NOT NULL,
  `add` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `ware`, `head`, `user`, `sub`, `add`, `edit`, `del`) VALUES
(1, 1, 3, 3, 4, 1, 1, 1),
(2, 1, 3, 3, 5, 1, 1, 1),
(3, 1, 3, 3, 6, 1, 1, 1),
(4, 1, 1, 4, 1, 1, 1, 1),
(5, 1, 1, 4, 2, 1, 1, 1),
(8, 1, 3, 6, 4, 1, 1, 1),
(9, 1, 3, 6, 5, 1, 1, 1),
(10, 1, 3, 6, 6, 1, 1, 1),
(11, 1, 1, 7, 1, 1, 1, 1),
(12, 1, 1, 7, 2, 1, 1, 1),
(13, 1, 2, 7, 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ware`
--

CREATE TABLE `ware` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `acces` int(20) NOT NULL,
  `ch` int(5) NOT NULL,
  `user` varchar(20) NOT NULL,
  `address` varchar(300) NOT NULL,
  `theme` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `vat` varchar(200) NOT NULL,
  `ware` int(11) NOT NULL,
  `barcode` int(1) NOT NULL,
  `printer` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ware`
--

INSERT INTO `ware` (`id`, `name`, `acces`, `ch`, `user`, `address`, `theme`, `phone`, `vat`, `ware`, `barcode`, `printer`) VALUES
(1, 'CursorBD', 0, 9, '0', 'Chattogram', '', '', '', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_message_list`
--
ALTER TABLE `tbl_message_list`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_priority`
--
ALTER TABLE `tbl_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `tbl_ticket_status`
--
ALTER TABLE `tbl_ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ticket_subjects`
--
ALTER TABLE `tbl_ticket_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ware`
--
ALTER TABLE `ware`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password`
--
ALTER TABLE `password`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_message_list`
--
ALTER TABLE `tbl_message_list`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_priority`
--
ALTER TABLE `tbl_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ticket_status`
--
ALTER TABLE `tbl_ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ticket_subjects`
--
ALTER TABLE `tbl_ticket_subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ware`
--
ALTER TABLE `ware`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
