-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2022 at 06:50 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csnj`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `adminNumber` int(128) NOT NULL,
  `adminName` varchar(128) NOT NULL,
  `adminSurname` varchar(128) NOT NULL,
  `adminMatricule` varchar(128) NOT NULL,
  `adminPass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id_agent` int(11) NOT NULL,
  `agent_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `agent_surname` varchar(100) CHARACTER SET latin1 NOT NULL,
  `agent_matricule` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id_agent`, `agent_name`, `agent_surname`, `agent_matricule`) VALUES
(30, 'Mourret', 'Pierre', '0'),
(36, 'LeGeoff', 'FranÃ§ois', '1');

-- --------------------------------------------------------

--
-- Table structure for table `email_received`
--

CREATE TABLE `email_received` (
  `mail_uid` varchar(128) CHARACTER SET latin1 NOT NULL,
  `sent_by` varchar(100) CHARACTER SET latin1 NOT NULL,
  `date_reception` varchar(100) CHARACTER SET latin1 NOT NULL,
  `body_received` mediumtext CHARACTER SET latin1,
  `answered` tinyint(1) NOT NULL,
  `id_agent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_received`
--

INSERT INTO `email_received` (`mail_uid`, `sent_by`, `date_reception`, `body_received`, `answered`, `id_agent`) VALUES
('1F09ED4C-8C30-4082-88DA-04624B7B200A@hxcore.ol', 'pierre.mourret.cav@gmail.com', 'Wed, 22 Dec 2021 09:13:40 +0000', NULL, 0, 0),
('c14b8524-3245-4267-b491-79d34ddf57a3@atl1s07mta2703.xt.local', 'email@engage.windows.com', 'Tue, 7 Dec 2021 10:34:37 +0000', NULL, 1, 0),
('CA+SCQF0kaPm4cRpvQsnhjWb3+c6-xoLrLnC5mn9HYUgUxGD7PA@mail.gmail.com', 'test1234zebi@gmail.com', 'Wed, 22 Dec 2021 08:28:33 +0000', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_sent`
--

CREATE TABLE `email_sent` (
  `mail_uid` varchar(128) CHARACTER SET latin1 NOT NULL,
  `in_reply_to` varchar(128) CHARACTER SET latin1 NOT NULL,
  `date_sent` varchar(100) NOT NULL,
  `body_sent` mediumtext CHARACTER SET latin1,
  `id_agent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_sent`
--

INSERT INTO `email_sent` (`mail_uid`, `in_reply_to`, `date_sent`, `body_sent`, `id_agent`) VALUES
('AM0P193MB0724DC10A6B314F2116CFA98BC7D9@AM0P193MB0724.EURP193.PROD.OUTLOOK.COM', 'CA+SCQF0kaPm4cRpvQsnhjWb3+c6-xoLrLnC5mn9HYUgUxGD7PA@mail.gmail.com', 'Wed, 22 Dec 2021 08:29:04 +0000', NULL, 0),
('DBAP193MB08573C92A0B5B2E583B4547EBC4C9@DBAP193MB0857.EURP193.PROD.OUTLOOK.COM', 'c14b8524-3245-4267-b491-79d34ddf57a3@atl1s07mta2703.xt.local', 'Thu, 6 Jan 2022 11:53:10 +0000', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`adminNumber`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id_agent`);

--
-- Indexes for table `email_received`
--
ALTER TABLE `email_received`
  ADD PRIMARY KEY (`mail_uid`),
  ADD KEY `id_agent` (`id_agent`);

--
-- Indexes for table `email_sent`
--
ALTER TABLE `email_sent`
  ADD PRIMARY KEY (`mail_uid`),
  ADD KEY `id_agent` (`id_agent`),
  ADD KEY `in_reply_to` (`in_reply_to`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `adminNumber` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
