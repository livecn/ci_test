-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2017 at 08:27 PM
-- Server version: 5.5.52-MariaDB
-- PHP Version: 5.4.16

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pg`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE IF NOT EXISTS `aauth_groups` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(2, 'Public', 'Public Access Group'),
(3, 'Default', 'Default Access Group'),
(4, 'Admin', 'Admin Access Group');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_group_to_group` (
  `group_id` int(11) unsigned NOT NULL,
  `subgroup_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aauth_login_attempts`
--

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(5, '::1', '2017-03-23 12:04:21', 1),
(13, '::1', '2017-03-23 14:15:18', 1),
(14, '::1', '2017-03-24 10:55:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE IF NOT EXISTS `aauth_perms` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  `type` varchar(16) DEFAULT 'html'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`, `type`) VALUES
(7, 'perm.save', 'Save permission data', 'json'),
(8, 'perm.delete', 'Delete permission data', 'json');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) unsigned NOT NULL,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` int(11) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `banned`, `active`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`) VALUES
(4, 'livecn@163.com', '26099512199546597858cebb4cc8d90e21f48e9be747c98d45d8a57a0f0a6e44', 'test', 0, 1, '2017-03-24 17:07:01', '2017-03-24 17:52:19', '2017-03-24 11:29:55', NULL, NULL, NULL, 'a87bde33d7e613e0306bccbdecfcef89101c493f', NULL, '::1'),
(5, 'admin@admin.com', '28a9d1ac311fc87b88b094cd50b05abf517134b03d636bbc7ee94401f9952a21', 'admin', 0, 1, '2017-03-24 20:11:40', '2017-03-24 20:11:40', '2017-03-24 17:10:16', NULL, NULL, NULL, NULL, NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(4, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL,
  `method` enum('GET','POST') DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` text,
  `status` enum('0','1','2','3') DEFAULT '0',
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;


--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url` (`url`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;