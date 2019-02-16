-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2019 at 08:19 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

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
(1, 'hadmin', '123', '0', '1', '1', '1', 0, 'a2aepr2jkq5i2maabojilmubdq', 1),
(2, 'Rimon', '123', '1', '3', '1', '1', 0, 'a2aepr2jkq5i2maabojilmubdq', 0),
(3, 'Tasnim', '123', '1', '3', '1', '1', 0, 'a68454ibhkmivmi8spbdo3oi5e', 0),
(4, 'Ranvir', '123', '1', '3', '1', '1', 0, 'oot4rckkf581sdospnraen6b7p', 0),
(5, 'Al-Amin', '123', '1', '3', '1', '1', 0, '', 0),
(6, 'Mizan', '123', '1', '3', '1', '1', 0, '', 0),
(7, 'kishwannajim', '123', '1', '4', '1', '1', 0, 'a2aepr2jkq5i2maabojilmubdq', 0),
(8, 'kishwanmahtab', '123', '1', '4', '1', '1', 0, '', 0),
(9, 'Mijan', '123', '1', '4', '1', '1', 0, '', 0),
(10, 'admin', '123', '1', '2', '1', '1', 0, 'oot4rckkf581sdospnraen6b7p', 0);

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
(1, 1, 'Add User', 'admin/create_user', 0),
(2, 1, 'User All', 'admin/user_all', 0),
(3, 2, 'Project All', 'project/project_all_view', 0),
(4, 3, 'Ticket All', 'ticketing/ticket_all_view', 0),
(5, 3, 'Opened Ticket', 'ticket/all_ticket', 0),
(6, 3, 'Completed Ticket', 'ticket/all_completed_ticket', 0),
(7, 2, 'Assigned Project', 'project/assigned_project_view', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assigned_project`
--

CREATE TABLE `tbl_assigned_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL COMMENT 'project_id',
  `is_assigned` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL COMMENT 'user_id(password_tbl)',
  `project_engineer` int(11) NOT NULL COMMENT 'user_id(password_tbl)',
  `project_customer` int(11) NOT NULL COMMENT 'user_id(password_tbl)',
  `assigned_date` date NOT NULL,
  `assign_note` text NOT NULL,
  `ticket_id` int(11) NOT NULL COMMENT 'from tbl_tickets',
  `pending_ticket` int(11) NOT NULL COMMENT 'pending tickets',
  `ware` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assigned_project`
--

INSERT INTO `tbl_assigned_project` (`id`, `project_id`, `is_assigned`, `assigned_by`, `project_engineer`, `project_customer`, `assigned_date`, `assign_note`, `ticket_id`, `pending_ticket`, `ware`) VALUES
(1, 5, 1, 1, 2, 7, '2019-02-14', 'rrrrrr', 0, 0, 0),
(2, 4, 1, 1, 5, 9, '2019-02-12', 'dsdsa', 0, 0, 0),
(3, 2, 1, 1, 4, 9, '2019-02-01', 'dsas', 0, 0, 0),
(4, 1, 1, 1, 3, 8, '2019-02-01', 'gfzgsfggd', 4, 1, 0),
(5, 3, 1, 1, 5, 9, '2019-02-01', 'fzdfxz', 2, 2, 0),
(6, 4, 1, 1, 2, 9, '2019-02-06', 'gdfgfg', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_list`
--

CREATE TABLE `tbl_message_list` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL COMMENT 'user_id(password_tbl)',
  `receiver` int(11) NOT NULL COMMENT 'user_id(password_tbl)',
  `message_time` datetime NOT NULL,
  `is_img` smallint(6) NOT NULL COMMENT '0=no, 1=yes image',
  `ware` int(11) NOT NULL,
  `is_seen` int(1) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message_list`
--

INSERT INTO `tbl_message_list` (`id`, `ticket_id`, `message`, `sender`, `receiver`, `message_time`, `is_img`, `ware`, `is_seen`, `status`) VALUES
(1, 1, 'xcvxcvc', 1, 0, '2019-02-17 00:55:07', 0, 0, 0, 1),
(2, 2, 'fdgfdg', 1, 0, '2019-02-17 00:55:49', 0, 0, 0, 1);

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
  `is_assigned` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL COMMENT 'user_id(password_tbl)',
  `ware` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`id`, `project_name`, `project_start_date`, `project_end_date`, `project_status`, `is_assigned`, `assigned_by`, `ware`) VALUES
(1, 'Kishwan Payroll', '2018-10-01', '2018-11-30', 4, 1, 1, 0),
(2, 'Yes Payroll', '2018-11-30', '2019-01-31', 4, 1, 1, 0),
(3, 'Mitaly', '2018-08-01', '2018-09-04', 4, 1, 1, 0),
(4, 'Hotel Management', '2018-11-30', '', 2, 1, 1, 0),
(5, 'Danaboy', '2018-12-01', '2018-12-30', 3, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '0',
  `ware` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `status_name`, `is_active`, `ware`) VALUES
(1, 'Waiting', 1, 0),
(2, 'Work In Progress', 1, 0),
(3, 'Completed', 1, 0),
(4, 'Received By Customer', 1, 0),
(5, 'Cancled', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE `tbl_tickets` (
  `id` int(11) NOT NULL,
  `assigned_project_id` int(11) NOT NULL COMMENT 'from tbl_assigned_project',
  `ticket_subject` text NOT NULL,
  `ticket_priority` int(11) NOT NULL,
  `ticket_status_id` int(11) NOT NULL COMMENT 'id of tbl_status',
  `rating` tinyint(4) NOT NULL,
  `opened_by` varchar(50) NOT NULL COMMENT '''0'' for all or admin id for who locked it',
  `ticket_date` datetime NOT NULL,
  `ware` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tickets`
--

INSERT INTO `tbl_tickets` (`id`, `assigned_project_id`, `ticket_subject`, `ticket_priority`, `ticket_status_id`, `rating`, `opened_by`, `ticket_date`, `ware`, `user_id`, `status`) VALUES
(1, 5, 'zvczx', 1, 1, 0, 'hadmin', '2019-02-17 00:55:07', 0, 1, 0),
(2, 5, 'fdgfdg', 1, 1, 0, 'hadmin', '2019-02-17 00:55:49', 0, 1, 0);

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
(1, 1, 2, 2, 3, 1, 1, 1),
(2, 1, 2, 2, 7, 1, 1, 1),
(3, 1, 3, 2, 4, 1, 1, 1),
(4, 1, 3, 2, 5, 1, 1, 1),
(5, 1, 3, 2, 6, 1, 1, 1),
(6, 1, 2, 3, 3, 1, 1, 1),
(7, 1, 2, 3, 7, 1, 1, 1),
(8, 1, 3, 3, 4, 1, 1, 1),
(9, 1, 3, 3, 5, 1, 1, 1),
(10, 1, 3, 3, 6, 1, 1, 1),
(11, 1, 2, 4, 3, 1, 1, 1),
(12, 1, 2, 4, 7, 1, 1, 1),
(13, 1, 3, 4, 4, 1, 1, 1),
(14, 1, 3, 4, 5, 1, 1, 1),
(15, 1, 3, 4, 6, 1, 1, 1),
(16, 1, 3, 5, 4, 1, 1, 1),
(17, 1, 3, 5, 5, 1, 1, 1),
(18, 1, 3, 5, 6, 1, 1, 1),
(19, 1, 2, 5, 3, 1, 1, 1),
(20, 1, 2, 5, 7, 1, 1, 1),
(27, 1, 3, 9, 4, 1, 1, 1),
(28, 1, 3, 9, 5, 1, 1, 1),
(29, 1, 3, 9, 6, 1, 1, 1),
(30, 1, 3, 8, 4, 1, 1, 1),
(31, 1, 3, 8, 5, 1, 1, 1),
(32, 1, 3, 8, 6, 1, 1, 1),
(33, 1, 2, 8, 3, 1, 1, 1),
(34, 1, 2, 8, 7, 1, 1, 1),
(35, 1, 2, 7, 3, 1, 1, 1),
(36, 1, 2, 7, 7, 1, 1, 1),
(37, 1, 3, 7, 4, 1, 1, 1),
(38, 1, 3, 7, 5, 1, 1, 1),
(39, 1, 3, 7, 6, 1, 1, 1);

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
(1, 'CursorBD', 0, 10, '0', 'Chattogram', '', '', '', 0, 0, 0);

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
-- Indexes for table `tbl_assigned_project`
--
ALTER TABLE `tbl_assigned_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message_list`
--
ALTER TABLE `tbl_message_list`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_assigned_project`
--
ALTER TABLE `tbl_assigned_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_message_list`
--
ALTER TABLE `tbl_message_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_priority`
--
ALTER TABLE `tbl_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ware`
--
ALTER TABLE `ware`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
