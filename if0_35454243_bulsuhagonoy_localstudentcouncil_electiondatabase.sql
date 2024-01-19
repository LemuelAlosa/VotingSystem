-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql110.infinityfree.com
-- Generation Time: Jan 10, 2024 at 07:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_35454243_bulsuhagonoy_localstudentcouncil_electiondatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username_admin` varchar(250) NOT NULL,
  `password_admin` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username_admin`, `password_admin`, `status`) VALUES
(16, 'admin123', 'b90608f341bd1c14e8089cdf2aa690a7e84d4f5ad6e41b096e97ec07ad1e4c41', 'activated'),
(17, 'admin333', '542a681c6e29225f88a931f56ce43e9ea31aa077b0171a44d2973de96969a0b5', 'activated'),
(18, 'admin777', 'e17aab03273292bfbda2ef7d112a02b6019efb322910c0059556a2ae1ca05f68', 'activated'),
(22, 'admin1', 'b90608f341bd1c14e8089cdf2aa690a7e84d4f5ad6e41b096e97ec07ad1e4c41', 'activated');

-- --------------------------------------------------------

--
-- Table structure for table `audittrial_report2021-2022`
--

CREATE TABLE `audittrial_report2021-2022` (
  `id` int(11) NOT NULL,
  `reports` varchar(250) NOT NULL,
  `account` varchar(250) NOT NULL,
  `date/time` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audittrial_report2021-2022`
--

INSERT INTO `audittrial_report2021-2022` (`id`, `reports`, `account`, `date/time`) VALUES
(1, 'Login', 'admin123', '11-30-2023/9:27 AM'),
(2, 'Login', 'superadmin123', '11-30-2023/9:27 AM'),
(3, 'Login', 'superadmin123', '11-30-2023/10:15 AM'),
(4, 'Login', 'admin123', '11-30-2023/11:06 AM'),
(5, 'Login', 'superadmin123', '11-30-2023/11:07 AM'),
(6, 'Added new partylist named PalaDesisyon.', 'admin123', '11-30-2023/11:08 AM'),
(7, 'Partylist PalaDesisyon has been removed.', 'admin123', '11-30-2023/11:08 AM'),
(8, 'Added new position named Muse.', 'admin123', '11-30-2023/11:08 AM'),
(9, 'Position Muse has been removed.', 'admin123', '11-30-2023/11:09 AM'),
(10, 'Added new candidate named Fasdf SADF as Governor.', 'admin123', '11-30-2023/11:10 AM'),
(11, 'Candidate Fasdf SADF / Governor has been removed from candidate list.', 'admin123', '11-30-2023/11:10 AM'),
(12, 'Logout', 'admin123', '11-30-2023/11:11 AM'),
(13, 'Login', 'superadmin123', '11-30-2023/11:12 AM'),
(14, 'Login', 'admin123', '11-30-2023/11:13 AM'),
(15, 'Logout', 'admin123', '11-30-2023/11:14 AM'),
(16, 'Login', 'superadmin123', '11-30-2023/11:15 AM'),
(17, 'Login', 'superadmin123', '11-30-2023/11:16 AM'),
(18, 'Logout', 'superadmin123', '11-30-2023/11:16 AM'),
(19, 'Login', 'admin123', '11-30-2023/11:16 AM'),
(20, 'Login', 'superadmin123', '11-30-2023/11:17 AM'),
(21, 'Login', 'admin123', '11-30-2023/11:19 AM'),
(22, 'Login', 'superadmin123', '11-30-2023/11:19 AM'),
(23, 'Login', 'superadmin123', '11-30-2023/11:19 AM'),
(24, 'Logout', 'superadmin123', '11-30-2023/11:19 AM'),
(25, 'Login', 'superadmin123', '11-30-2023/11:19 AM'),
(26, 'Login', 'admin123', '11-30-2023/11:23 AM'),
(27, 'Logout', 'admin123', '11-30-2023/11:23 AM'),
(28, 'Login', 'admin123', '11-30-2023/11:23 AM'),
(29, 'Login', 'superadmin123', '11-30-2023/11:23 AM'),
(30, 'Logout', 'superadmin123', '11-30-2023/11:23 AM'),
(31, 'Login', 'admin123', '11-30-2023/11:23 AM'),
(32, 'Login', 'superadmin123', '11-30-2023/11:23 AM'),
(33, 'Deactivated all the admins', 'superadmin123', '11-30-2023/11:32 AM'),
(34, 'Activated all the admins.', 'superadmin123', '11-30-2023/11:32 AM'),
(35, 'Added new admin named admin455', 'superadmin123', '11-30-2023/11:32 AM'),
(36, 'admin that has a username admin333 has been removed', 'superadmin123', '11-30-2023/11:35 AM'),
(37, 'Added new superadmin named superadmin402', 'superadmin123', '11-30-2023/11:36 AM'),
(38, 'Superadmin that has a username superadmin402 has been removed', 'superadmin123', '11-30-2023/11:36 AM'),
(39, 'Activated all the superadmins.', 'superadmin123', '11-30-2023/11:36 AM'),
(40, 'Deactivated all the superadmins', 'superadmin123', '11-30-2023/11:36 AM'),
(41, 'Student 2029700345 / Mias Miller was edited.', 'superadmin123', '11-30-2023/11:37 AM'),
(42, 'Student 2029700345 / Mias Miller has been removed.', 'superadmin123', '11-30-2023/11:37 AM'),
(43, 'Student 2020600818 / Lemuel Alosa was generate a new password and resend it on email.', 'superadmin123', '11-30-2023/11:37 AM'),
(44, 'Added new partylist named PalaDesisyon.', 'superadmin123', '11-30-2023/11:38 AM'),
(45, 'Partylist PalaDesisyon has been removed.', 'superadmin123', '11-30-2023/11:39 AM'),
(46, 'Added new position named Muse.', 'superadmin123', '11-30-2023/11:39 AM'),
(47, 'Position Muse has been removed.', 'superadmin123', '11-30-2023/11:39 AM'),
(48, 'Candidate Mark ZUCKERBERG was edited.', 'superadmin123', '11-30-2023/11:39 AM'),
(49, 'Candidate Mark ZUCKERBERG was edited.', 'superadmin123', '11-30-2023/11:39 AM'),
(50, 'Login', 'superadmin123', '11-30-2023/1:53 PM'),
(51, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/1:54 PM'),
(52, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/1:57 PM'),
(53, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:06 PM'),
(54, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:09 PM'),
(55, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:10 PM'),
(56, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:12 PM'),
(57, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:19 PM'),
(58, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:23 PM'),
(59, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:25 PM'),
(60, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:26 PM'),
(61, 'Generate the Final VoteTally of via PDF.', 'superadmin123', '11-30-2023/2:26 PM'),
(62, 'Login', 'superadmin123', '11-30-2023/4:07 PM'),
(63, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:10 PM'),
(64, 'Login', 'superadmin123', '11-30-2023/4:13 PM'),
(65, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:14 PM'),
(66, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:15 PM'),
(67, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:31 PM'),
(68, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:39 PM'),
(69, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:42 PM'),
(70, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:44 PM'),
(71, 'Logout', 'superadmin123', '11-30-2023/4:44 PM'),
(72, 'Login', 'superadmin123', '11-30-2023/4:44 PM'),
(73, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:44 PM'),
(74, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:49 PM'),
(75, 'Logout', 'superadmin123', '11-30-2023/4:50 PM'),
(76, 'Login', 'superadmin123', '11-30-2023/4:50 PM'),
(77, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:50 PM'),
(78, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:54 PM'),
(79, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/4:57 PM'),
(80, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:01 PM'),
(81, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:08 PM'),
(82, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:08 PM'),
(83, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:09 PM'),
(84, 'Logout', 'superadmin123', '11-30-2023/5:09 PM'),
(85, 'Login', 'superadmin123', '11-30-2023/5:09 PM'),
(86, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:09 PM'),
(87, 'Logout', 'superadmin123', '11-30-2023/5:12 PM'),
(88, 'Login', 'superadmin123', '11-30-2023/5:12 PM'),
(89, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:13 PM'),
(90, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:14 PM'),
(91, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:16 PM'),
(92, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:18 PM'),
(93, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:20 PM'),
(94, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:23 PM'),
(95, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:30 PM'),
(96, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/5:33 PM'),
(97, 'Login', 'superadmin123', '11-30-2023/9:12 PM'),
(98, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:13 PM'),
(99, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:13 PM'),
(100, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:17 PM'),
(101, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:19 PM'),
(102, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:22 PM'),
(103, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:25 PM'),
(104, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:32 PM'),
(105, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:35 PM'),
(106, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:36 PM'),
(107, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:44 PM'),
(108, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:47 PM'),
(109, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:47 PM'),
(110, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:49 PM'),
(111, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/9:53 PM'),
(112, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:00 PM'),
(113, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:03 PM'),
(114, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:12 PM'),
(115, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:14 PM'),
(116, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:15 PM'),
(117, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:17 PM'),
(118, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:20 PM'),
(119, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:23 PM'),
(120, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:30 PM'),
(121, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:35 PM'),
(122, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:41 PM'),
(123, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:45 PM'),
(124, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:54 PM'),
(125, 'Generate the Final VoteTally via PDF.', 'superadmin123', '11-30-2023/10:55 PM'),
(126, 'Login', 'superadmin123', '12-01-2023/12:00 AM'),
(127, 'Logout', 'superadmin123', '12-01-2023/12:12 AM'),
(128, 'Login', 'superadmin123', '12-01-2023/12:12 AM'),
(129, 'Deactivated all the admins', 'superadmin123', '12-01-2023/12:12 AM'),
(130, 'Activated all the admins.', 'superadmin123', '12-01-2023/12:12 AM'),
(131, 'Activated all the superadmins.', 'superadmin123', '12-01-2023/12:12 AM'),
(132, 'Deactivated all the superadmins', 'superadmin123', '12-01-2023/12:12 AM'),
(133, 'Activated all the students.', 'superadmin123', '12-01-2023/12:14 AM'),
(134, 'Login', 'admin123', '12-01-2023/12:16 AM'),
(135, 'Logout', 'admin123', '12-01-2023/12:16 AM'),
(136, 'Login', 'superadmin123', '12-01-2023/12:20 AM'),
(137, 'Activated all the students.', 'superadmin123', '12-01-2023/12:21 AM'),
(138, 'Deactivated all the admins', 'superadmin123', '12-01-2023/12:24 AM'),
(139, 'Activated all the admins.', 'superadmin123', '12-01-2023/12:24 AM'),
(140, 'Deactivated all the admins', 'superadmin123', '12-01-2023/12:24 AM'),
(141, 'Activated all the admins.', 'superadmin123', '12-01-2023/12:24 AM'),
(142, 'Activated all the students.', 'superadmin123', '12-01-2023/12:24 AM'),
(143, 'Deactivated all the students', 'superadmin123', '12-01-2023/12:27 AM'),
(144, 'Activated all the students.', 'superadmin123', '12-01-2023/12:27 AM'),
(145, 'Deactivated all the students', 'superadmin123', '12-01-2023/12:27 AM'),
(146, 'All students have been sent their passwords via email.', 'superadmin123', '12-01-2023/12:29 AM'),
(147, 'Login', 'superadmin123', '12-01-2023/8:01 AM'),
(148, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:01 AM'),
(149, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:02 AM'),
(150, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:05 AM'),
(151, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:06 AM'),
(152, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:08 AM'),
(153, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:11 AM'),
(154, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:11 AM'),
(155, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:12 AM'),
(156, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:15 AM'),
(157, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:16 AM'),
(158, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:18 AM'),
(159, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:19 AM'),
(160, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:19 AM'),
(161, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:20 AM'),
(162, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:21 AM'),
(163, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:22 AM'),
(164, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:26 AM'),
(165, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:31 AM'),
(166, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:33 AM'),
(167, 'Admin that has a username admin123 has been removed', 'superadmin123', '12-01-2023/8:34 AM'),
(168, 'Admin that has a username admin444 has been removed', 'superadmin123', '12-01-2023/8:34 AM'),
(169, 'Admin that has a username admin999 has been removed', 'superadmin123', '12-01-2023/8:34 AM'),
(170, 'Added new admin named admin123', 'superadmin123', '12-01-2023/8:34 AM'),
(171, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/8:35 AM'),
(172, 'Activated all the admins.', 'superadmin123', '12-01-2023/8:36 AM'),
(173, 'Added new admin named admin333', 'superadmin123', '12-01-2023/8:36 AM'),
(174, 'Added new admin named admin777', 'superadmin123', '12-01-2023/8:36 AM'),
(175, 'Logout', 'superadmin123', '12-01-2023/8:36 AM'),
(176, 'Login', 'admin123', '12-01-2023/8:36 AM'),
(177, 'Logout', 'admin123', '12-01-2023/8:36 AM'),
(178, 'Login', 'superadmin123', '12-01-2023/8:37 AM'),
(179, 'Login', 'superadmin123', '12-01-2023/9:21 AM'),
(181, 'Student 2020600479 / Jennlyn Halili was edited.', 'superadmin123', '12-01-2023/9:23 AM'),
(182, 'Login', 'superadmin123', '12-01-2023/11:35 AM'),
(183, 'Activated all the students.', 'superadmin123', '12-01-2023/11:41 AM'),
(184, 'Deactivated all the students', 'superadmin123', '12-01-2023/11:41 AM'),
(185, 'Activated all the students.', 'superadmin123', '12-01-2023/11:59 AM'),
(186, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/12:00 PM'),
(187, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-01-2023/12:06 PM'),
(188, 'Login', 'superadmin123', '12-01-2023/3:44 PM'),
(189, 'All students have been sent their passwords via email.', 'superadmin123', '12-01-2023/3:45 PM'),
(190, 'Login', 'admin123', '12-01-2023/5:39 PM'),
(191, 'Login', 'superadmin123', '12-01-2023/5:40 PM'),
(192, 'Login', 'superadmin123', '12-01-2023/5:41 PM'),
(193, 'Added new partylist named PalaDesisyon.', 'superadmin123', '12-01-2023/6:12 PM'),
(194, 'Candidate Mark ZUCKERBERG was edited.', 'superadmin123', '12-01-2023/6:12 PM'),
(195, 'Added new position named Muse.', 'superadmin123', '12-01-2023/6:13 PM'),
(196, 'Login', 'superadmin123', '12-02-2023/4:09 PM'),
(197, 'Logout', 'superadmin123', '12-02-2023/4:09 PM'),
(198, 'Login', 'superadmin123', '12-02-2023/4:20 PM'),
(199, 'Login', 'superadmin123', '12-02-2023/4:21 PM'),
(200, 'Login', 'superadmin123', '12-02-2023/4:22 PM'),
(201, 'Login', 'superadmin123', '12-02-2023/4:23 PM'),
(202, 'Login', 'superadmin123', '12-02-2023/4:24 PM'),
(203, 'Activated all the superadmins.', 'superadmin123', '12-02-2023/4:28 PM'),
(204, 'Login', 'superadmin123', '12-02-2023/4:32 PM'),
(205, 'Login', 'superadmin123', '12-02-2023/4:32 PM'),
(206, 'Login', 'superadmin123', '12-02-2023/4:35 PM'),
(207, 'Login', 'superadmin123', '12-02-2023/4:37 PM'),
(208, 'Login', 'superadmin123', '12-02-2023/4:37 PM'),
(209, 'Added new superadmin named superadmin1234', 'superadmin123', '12-02-2023/4:38 PM'),
(210, 'Login', 'superadmin123', '12-02-2023/4:38 PM'),
(211, 'Added new superadmin named superadmin1234', 'superadmin123', '12-02-2023/4:38 PM'),
(212, 'Deactivated all the superadmins', 'superadmin123', '12-02-2023/4:41 PM'),
(213, 'Activated all the superadmins.', 'superadmin123', '12-02-2023/4:41 PM'),
(214, 'Login', 'superadmin123', '12-02-2023/4:43 PM'),
(215, 'Login', 'superadmin123', '12-02-2023/4:43 PM'),
(216, 'Superadmin that has a username superadmin1234 has been removed', 'superadmin123', '12-02-2023/4:44 PM'),
(217, 'Superadmin that has a username superadmin1234 has been removed', 'superadmin123', '12-02-2023/4:44 PM'),
(218, 'Login', 'superadmin123', '12-02-2023/4:44 PM'),
(219, 'Added new superadmin named superadmin1234', 'superadmin123', '12-02-2023/4:44 PM'),
(220, 'Deactivated all the superadmins', 'superadmin123', '12-02-2023/4:44 PM'),
(221, 'Activated all the superadmins.', 'superadmin123', '12-02-2023/4:44 PM'),
(222, 'Logout', 'superadmin123', '12-02-2023/4:44 PM'),
(223, 'Login', 'superadmin1234', '12-02-2023/4:45 PM'),
(224, 'Login', 'superadmin1234', '12-02-2023/4:45 PM'),
(225, 'Login', 'superadmin123', '12-02-2023/5:10 PM'),
(226, 'Added new admin named admin1', 'superadmin123', '12-02-2023/5:11 PM'),
(227, 'Deactivated all the admins', 'superadmin123', '12-02-2023/5:12 PM'),
(228, 'Activated all the admins.', 'superadmin123', '12-02-2023/5:12 PM'),
(229, 'Login', 'superadmin123', '12-02-2023/5:19 PM'),
(230, 'Added new admin named admin1', 'superadmin123', '12-02-2023/5:20 PM'),
(231, 'Login', 'admin123', '12-02-2023/5:20 PM'),
(232, 'Login', 'admin123', '12-02-2023/5:21 PM'),
(233, 'Student 2020600719 / Adrian Louie Laruan has been removed.', 'superadmin123', '12-02-2023/5:23 PM'),
(234, 'Logout', 'admin123', '12-02-2023/5:24 PM'),
(235, 'Login', 'superadmin123', '12-02-2023/5:25 PM'),
(236, 'Login', 'superadmin123', '12-02-2023/5:26 PM'),
(237, 'Added new student accounts.', 'superadmin123', '12-02-2023/5:26 PM'),
(238, 'Login', 'superadmin123', '12-02-2023/5:27 PM'),
(239, 'Login', 'superadmin123', '12-02-2023/5:27 PM'),
(240, 'Login', 'superadmin123', '12-02-2023/5:28 PM'),
(241, 'Login', 'superadmin123', '12-02-2023/5:29 PM'),
(242, 'Logout', 'superadmin123', '12-02-2023/5:33 PM'),
(243, 'Candidate Lemuel ALOSA was edited.', 'superadmin123', '12-02-2023/5:37 PM'),
(244, 'Login', 'superadmin123', '12-02-2023/5:38 PM'),
(245, 'Added new candidate named Gsadg ASDGASDG as Governor.', 'superadmin123', '12-02-2023/5:39 PM'),
(246, 'Deactivated all the students', 'superadmin123', '12-02-2023/5:39 PM'),
(247, 'Candidate Gsadg ASDGASDG was edited.', 'superadmin123', '12-02-2023/5:39 PM'),
(248, 'Activated all the students.', 'superadmin123', '12-02-2023/5:39 PM'),
(249, 'Candidate Gsadg ASDGASDG was edited.', 'superadmin123', '12-02-2023/5:42 PM'),
(250, 'Candidate Gsadg ASDGASDG / Governor has been removed from candidate list.', 'superadmin123', '12-02-2023/5:42 PM'),
(251, 'Candidate Lemuel ALOSA / Governor has been removed from candidate list.', 'superadmin123', '12-02-2023/5:42 PM'),
(252, 'Logout', 'superadmin123', '12-02-2023/5:43 PM'),
(253, 'Login', 'admin123', '12-02-2023/5:43 PM'),
(254, 'Added new candidate named Lemuel ALOSA as Governor.', 'admin123', '12-02-2023/5:43 PM'),
(255, 'Login', 'superadmin123', '12-02-2023/5:44 PM'),
(256, 'Logout', 'superadmin123', '12-02-2023/5:48 PM'),
(257, 'Login', 'admin123', '12-02-2023/5:48 PM'),
(258, 'Candidate Lemuel ALOSA was edited.', 'admin123', '12-02-2023/5:48 PM'),
(259, 'Login', 'superadmin123', '12-02-2023/5:49 PM'),
(260, 'Position Muse has been removed.', 'superadmin123', '12-02-2023/5:54 PM'),
(261, 'Login', 'superadmin123', '12-02-2023/5:54 PM'),
(262, 'Logout', 'superadmin123', '12-02-2023/5:59 PM'),
(263, 'Login', 'admin123', '12-02-2023/6:01 PM'),
(264, 'Partylist PalaDesisyon has been removed.', 'admin123', '12-02-2023/6:03 PM'),
(265, 'Candidate Lemuel ALOSA was edited.', 'admin123', '12-02-2023/6:03 PM'),
(266, 'Candidate Mark ZUCKERBERG was edited.', 'admin123', '12-02-2023/6:04 PM'),
(267, 'Login', 'superadmin123', '12-02-2023/6:06 PM'),
(268, 'Logout', 'admin123', '12-02-2023/6:09 PM'),
(269, 'Login', 'superadmin123', '12-02-2023/6:09 PM'),
(270, 'Login', 'superadmin123', '12-02-2023/6:09 PM'),
(271, 'Login', 'superadmin123', '12-02-2023/6:11 PM'),
(272, 'Login', 'superadmin123', '12-02-2023/6:12 PM'),
(273, 'Deactivated all the students', 'superadmin123', '12-02-2023/6:12 PM'),
(274, 'Admin that has a username admin1 has been removed', 'superadmin123', '12-02-2023/6:21 PM'),
(275, 'Admin that has a username admin1 has been removed', 'superadmin123', '12-02-2023/6:21 PM'),
(276, 'Superadmin that has a username superadmin1234 has been removed', 'superadmin123', '12-02-2023/6:21 PM'),
(277, 'Generate the Final VoteTally via PDF.', 'superadmin123', '12-02-2023/6:22 PM'),
(278, 'Login', 'superadmin123', '12-02-2023/6:26 PM'),
(279, 'Login', 'superadmin123', '12-02-2023/6:26 PM'),
(280, 'Added new admin named admin1', 'superadmin123', '12-02-2023/6:26 PM'),
(281, 'Deactivated all the admins', 'superadmin123', '12-02-2023/6:27 PM'),
(282, 'Deactivated all the superadmins', 'superadmin123', '12-02-2023/6:27 PM'),
(283, 'Login', 'superadmin123', '12-02-2023/6:28 PM'),
(284, 'Activated all the admins.', 'superadmin123', '12-02-2023/6:29 PM'),
(285, 'Activated all the superadmins.', 'superadmin123', '12-02-2023/6:29 PM'),
(286, 'Activated all the admins.', 'superadmin123', '12-02-2023/6:29 PM'),
(287, 'Login', 'admin123', '12-02-2023/6:29 PM'),
(288, 'Deactivated all the admins', 'superadmin123', '12-02-2023/6:29 PM'),
(289, 'Activated all the admins.', 'superadmin123', '12-02-2023/6:29 PM'),
(290, 'Login', 'admin123', '12-02-2023/6:30 PM'),
(291, 'Login', 'superadmin123', '12-02-2023/6:31 PM'),
(292, 'Login', 'superadmin123', '12-02-2023/6:31 PM'),
(293, 'Added new candidate named Asdgasdg SADGASDG as Governor.', 'superadmin123', '12-02-2023/6:37 PM'),
(294, 'Candidate Asdgasdg SADGASDG / Governor has been removed from candidate list.', 'superadmin123', '12-02-2023/6:37 PM'),
(295, 'Added new candidate named Gsadgasdg SADGASDG as Governor.', 'superadmin123', '12-02-2023/6:38 PM'),
(296, 'Candidate Gsadgasdg SADGASDG / Governor has been removed from candidate list.', 'superadmin123', '12-02-2023/6:38 PM'),
(297, 'Candidate Lemuel ALOSA was edited.', 'superadmin123', '12-02-2023/6:38 PM'),
(298, 'Candidate Lemuel ALOSA was edited.', 'superadmin123', '12-02-2023/6:39 PM'),
(299, 'Login', 'superadmin123', '12-02-2023/6:45 PM'),
(300, 'Activated all the students.', 'superadmin123', '12-02-2023/6:46 PM'),
(301, 'Login', 'admin123', '12-02-2023/6:52 PM'),
(302, 'Login', 'admin123', '12-02-2023/6:52 PM'),
(303, 'Logout', 'admin123', '12-02-2023/6:53 PM'),
(304, 'Login', 'admin123', '12-02-2023/6:54 PM'),
(305, 'Logout', 'admin123', '12-02-2023/7:00 PM'),
(306, 'Login', 'superadmin123', '12-02-2023/7:00 PM'),
(307, 'Admin that has a username admin1 has been removed', 'superadmin123', '12-02-2023/7:07 PM'),
(308, 'Login', 'superadmin123', '12-02-2023/8:46 PM'),
(309, 'Logout', 'superadmin123', '12-02-2023/8:46 PM'),
(310, 'Login', 'admin123', '12-02-2023/9:07 PM'),
(311, 'Login', 'superadmin123', '12-03-2023/11:30 AM'),
(312, 'Login', 'superadmin123', '12-03-2023/11:31 AM'),
(313, 'Added new admin named admin1', 'superadmin123', '12-03-2023/11:31 AM'),
(314, 'Deactivated all the admins', 'superadmin123', '12-03-2023/11:31 AM'),
(315, 'Activated all the admins.', 'superadmin123', '12-03-2023/11:31 AM'),
(316, 'Login', 'admin123', '12-03-2023/11:31 AM'),
(317, 'Login', 'admin123', '12-03-2023/11:36 AM'),
(318, 'Login', 'admin123', '12-03-2023/11:37 AM'),
(319, 'Login', 'admin123', '12-03-2023/11:38 AM'),
(320, 'Login', 'admin123', '12-03-2023/11:39 AM'),
(321, 'Login', 'admin123', '12-03-2023/11:40 AM'),
(322, 'Login', 'admin123', '12-03-2023/11:42 AM'),
(323, 'Login', 'admin123', '12-03-2023/11:42 AM'),
(324, 'Login', 'admin123', '12-03-2023/11:43 AM'),
(325, 'Login', 'admin123', '12-03-2023/11:44 AM'),
(326, 'Login', 'admin123', '12-03-2023/11:45 AM'),
(327, 'Login', 'admin123', '12-03-2023/11:49 AM'),
(328, 'Login', 'admin123', '12-03-2023/11:49 AM'),
(329, 'Login', 'admin123', '12-03-2023/11:50 AM'),
(330, 'Login', 'admin123', '12-03-2023/11:50 AM'),
(331, 'Login', 'admin123', '12-03-2023/11:51 AM'),
(332, 'Login', 'admin123', '12-03-2023/11:51 AM'),
(333, 'Login', 'superadmin123', '12-03-2023/12:09 PM'),
(334, 'Added new superadmin named superadmin1234', 'superadmin123', '12-03-2023/12:09 PM'),
(335, 'Login', 'superadmin123', '12-03-2023/12:10 PM'),
(336, 'Added new superadmin named superadmin1234', 'superadmin123', '12-03-2023/12:10 PM'),
(337, 'Superadmin that has a username superadmin1234 has been removed', 'superadmin123', '12-03-2023/12:10 PM'),
(338, 'Deactivated all the superadmins', 'superadmin123', '12-03-2023/12:10 PM'),
(339, 'Activated all the superadmins.', 'superadmin123', '12-03-2023/12:10 PM'),
(340, 'Login', 'superadmin1234', '12-03-2023/12:11 PM'),
(341, 'Login', 'superadmin1234', '12-03-2023/12:12 PM'),
(342, 'Login', 'superadmin1234', '12-03-2023/12:16 PM'),
(343, 'Login', 'superadmin1234', '12-03-2023/12:19 PM'),
(344, 'Login', 'superadmin1234', '12-03-2023/12:22 PM'),
(345, 'Login', 'admin123', '12-03-2023/12:30 PM'),
(346, 'Login', 'admin123', '12-03-2023/12:31 PM'),
(347, 'Login', 'admin123', '12-03-2023/12:46 PM'),
(348, 'Login', 'admin123', '12-03-2023/12:48 PM'),
(349, 'Login', 'admin123', '12-03-2023/12:50 PM'),
(350, 'Login', 'admin123', '12-03-2023/12:50 PM'),
(351, 'Login', 'admin123', '12-03-2023/12:52 PM'),
(352, 'Login', 'admin123', '12-03-2023/12:53 PM'),
(353, 'Login', 'superadmin123', '12-03-2023/2:01 PM'),
(354, 'Login', 'admin123', '12-03-2023/2:16 PM'),
(355, 'Login', 'superadmin1234', '12-03-2023/2:18 PM'),
(356, 'Login', 'admin123', '12-03-2023/2:18 PM'),
(357, 'Login', 'admin123', '12-03-2023/2:19 PM'),
(358, 'Login', 'admin123', '12-03-2023/2:28 PM'),
(359, 'Added new candidate named David DELA CRUZ as Governor.', 'admin123', '12-03-2023/2:32 PM'),
(360, 'Login', 'admin123', '12-03-2023/2:32 PM'),
(361, 'Login', 'admin123', '12-03-2023/2:33 PM'),
(362, 'Candidate David DELA CRUZ / Governor has been removed from candidate list.', 'admin123', '12-03-2023/2:35 PM'),
(363, 'Login', 'admin123', '12-03-2023/2:35 PM'),
(364, 'Added new candidate named David DELA CRUZ as Governor.', 'admin123', '12-03-2023/2:36 PM'),
(365, 'Candidate David DELA CRUZ / Governor has been removed from candidate list.', 'admin123', '12-03-2023/2:36 PM'),
(366, 'Login', 'admin123', '12-03-2023/2:36 PM'),
(367, 'Added new candidate named David DELA CRUZ as Governor.', 'admin123', '12-03-2023/2:37 PM'),
(368, 'Candidate David DELA CRUZ / Governor has been removed from candidate list.', 'admin123', '12-03-2023/2:37 PM'),
(369, 'Login', 'admin123', '12-03-2023/2:38 PM'),
(370, 'Added new candidate named David DELA CRUZ as Governor.', 'admin123', '12-03-2023/2:38 PM'),
(371, 'Login', 'admin123', '12-03-2023/2:45 PM'),
(372, 'Login', 'admin123', '12-03-2023/2:46 PM'),
(373, 'Added new partylist named Good Wanderers.', 'admin123', '12-03-2023/2:48 PM'),
(374, 'Login', 'admin123', '12-03-2023/2:48 PM'),
(375, 'Partylist Good Wanderers has been removed.', 'admin123', '12-03-2023/2:49 PM'),
(376, 'Login', 'admin123', '12-03-2023/2:49 PM'),
(377, 'Added new partylist named Good Wanderers.', 'admin123', '12-03-2023/2:49 PM'),
(378, 'Login', 'admin123', '12-03-2023/2:58 PM'),
(379, 'Login', 'admin123', '12-03-2023/2:59 PM'),
(380, 'Added new position named Muse.', 'admin123', '12-03-2023/3:00 PM'),
(381, 'Login', 'admin123', '12-03-2023/3:00 PM'),
(382, 'Position Muse has been removed.', 'admin123', '12-03-2023/3:00 PM'),
(383, 'Login', 'admin123', '12-03-2023/3:01 PM'),
(384, 'Added new position named Muse.', 'admin123', '12-03-2023/3:01 PM'),
(385, 'Position Muse has been removed.', 'admin123', '12-03-2023/3:01 PM'),
(386, 'Login', 'admin123', '12-03-2023/3:01 PM'),
(387, 'Added new position named Muse.', 'admin123', '12-03-2023/3:01 PM'),
(388, 'Position Muse has been removed.', 'admin123', '12-03-2023/3:02 PM'),
(389, 'Login', 'admin123', '12-03-2023/3:02 PM'),
(390, 'Added new position named Muse.', 'admin123', '12-03-2023/3:02 PM'),
(391, 'Login', 'admin123', '12-03-2023/3:19 PM'),
(392, 'Candidate David DELA CRUZ / Governor has been removed from candidate list.', 'admin123', '12-03-2023/3:19 PM'),
(393, 'Login', 'admin123', '12-03-2023/3:20 PM'),
(394, 'Added new candidate named David DELA CRUZ as Governor.', 'admin123', '12-03-2023/3:20 PM'),
(395, 'Login', 'admin123', '12-03-2023/3:21 PM'),
(396, 'Candidate David DELA CRUZ / Governor has been removed from candidate list.', 'admin123', '12-03-2023/3:21 PM'),
(397, 'Login', 'admin123', '12-03-2023/3:22 PM'),
(398, 'Login', 'admin123', '12-03-2023/3:22 PM'),
(399, 'Position Muse has been removed.', 'admin123', '12-03-2023/3:22 PM'),
(400, 'Login', 'admin123', '12-03-2023/3:24 PM'),
(401, 'Added new position named Muse.', 'admin123', '12-03-2023/3:24 PM'),
(402, 'Login', 'admin123', '12-03-2023/3:24 PM'),
(403, 'Position Muse has been removed.', 'admin123', '12-03-2023/3:24 PM'),
(404, 'Login', 'admin123', '12-03-2023/3:30 PM'),
(405, 'Added new position named Muse.', 'admin123', '12-03-2023/3:30 PM'),
(406, 'Login', 'admin123', '12-03-2023/3:31 PM'),
(407, 'Position Muse has been removed.', 'admin123', '12-03-2023/3:31 PM'),
(408, 'Login', 'admin123', '12-03-2023/3:32 PM'),
(409, 'Partylist Good Wanderers has been removed.', 'admin123', '12-03-2023/3:36 PM'),
(410, 'Login', 'admin123', '12-03-2023/3:37 PM'),
(411, 'Added new partylist named Good Wanderers.', 'admin123', '12-03-2023/3:38 PM'),
(412, 'Login', 'admin123', '12-03-2023/3:38 PM'),
(413, 'Partylist Good Wanderers has been removed.', 'admin123', '12-03-2023/3:38 PM'),
(414, 'Login', 'admin123', '12-03-2023/3:42 PM'),
(415, 'Logout', 'admin123', '12-03-2023/3:42 PM'),
(416, 'Login', 'admin123', '12-03-2023/3:42 PM'),
(417, 'Added new partylist named Good Wanderers.', 'admin123', '12-03-2023/3:42 PM'),
(418, 'Login', 'admin123', '12-03-2023/3:43 PM'),
(419, 'Partylist Good Wanderers has been removed.', 'admin123', '12-03-2023/3:43 PM'),
(420, 'Login', 'admin123', '12-03-2023/3:51 PM'),
(421, 'Login', 'admin123', '12-03-2023/4:04 PM'),
(422, 'Login', 'admin123', '12-03-2023/4:10 PM'),
(423, 'Login', 'admin123', '12-03-2023/4:10 PM'),
(424, 'Logout', 'admin123', '12-03-2023/4:11 PM'),
(425, 'Login', 'admin123', '12-03-2023/4:12 PM'),
(426, 'Logout', 'admin123', '12-03-2023/4:12 PM'),
(427, 'Login', 'admin123', '12-03-2023/4:12 PM'),
(428, 'Logout', 'admin123', '12-03-2023/4:12 PM'),
(429, 'Login', 'admin123', '12-03-2023/4:12 PM'),
(430, 'Logout', 'admin123', '12-03-2023/4:12 PM'),
(431, 'Login', 'admin123', '12-03-2023/4:13 PM'),
(432, 'Logout', 'admin123', '12-03-2023/4:13 PM'),
(433, 'Login', 'admin123', '12-03-2023/4:13 PM'),
(434, 'Logout', 'admin123', '12-03-2023/4:13 PM'),
(435, 'Login', 'admin123', '12-03-2023/4:14 PM'),
(436, 'Logout', 'admin123', '12-03-2023/4:14 PM'),
(437, 'Login', 'admin123', '12-03-2023/4:14 PM'),
(438, 'Logout', 'admin123', '12-03-2023/4:14 PM'),
(439, 'Logout', 'admin123', '12-03-2023/4:20 PM'),
(440, 'Login', 'superadmin123', '12-03-2023/4:20 PM'),
(441, 'Login', 'superadmin123', '12-03-2023/5:11 PM'),
(442, 'Deactivated all the admins', 'superadmin123', '12-03-2023/5:28 PM'),
(443, 'Activated all the admins.', 'superadmin123', '12-03-2023/5:29 PM'),
(444, 'Login', 'admin123', '12-03-2023/5:40 PM'),
(445, 'Candidate Grace PANGANIBAN was edited.', 'admin123', '12-03-2023/5:42 PM'),
(446, 'Login', 'admin123', '12-03-2023/5:42 PM'),
(447, 'Candidate Grace PANGANIBAN was edited.', 'admin123', '12-03-2023/5:43 PM'),
(448, 'Login', 'superadmin1234', '12-03-2023/5:43 PM'),
(449, 'Login', 'superadmin123', '12-03-2023/6:15 PM'),
(450, 'Login', 'superadmin1234', '12-03-2023/6:24 PM'),
(451, 'Login', 'superadmin1234', '12-03-2023/6:28 PM'),
(452, 'Login', 'superadmin1234', '12-03-2023/6:29 PM'),
(453, 'Login', 'superadmin1234', '12-03-2023/6:42 PM'),
(454, 'Login', 'superadmin1234', '12-03-2023/6:43 PM'),
(455, 'Login', 'superadmin1234', '12-03-2023/6:44 PM'),
(456, 'All students have been sent their passwords via email.', 'superadmin1234', '12-03-2023/6:46 PM'),
(457, 'Login', 'superadmin1234', '12-03-2023/6:48 PM'),
(458, 'All students have been sent their passwords via email.', 'superadmin1234', '12-03-2023/6:49 PM'),
(459, 'Login', 'superadmin1234', '12-03-2023/6:57 PM'),
(460, 'Login', 'superadmin1234', '12-03-2023/7:07 PM'),
(461, 'Deactivated all the students', 'superadmin1234', '12-03-2023/7:07 PM'),
(462, 'Login', 'superadmin1234', '12-03-2023/7:07 PM'),
(463, 'Activated all the students.', 'superadmin1234', '12-03-2023/7:08 PM'),
(464, 'Login', 'superadmin1234', '12-03-2023/7:13 PM'),
(465, 'Deactivated all the students', 'superadmin1234', '12-03-2023/7:13 PM'),
(466, 'Activated all the students.', 'superadmin1234', '12-03-2023/7:13 PM'),
(467, 'Deactivated all the students', 'superadmin1234', '12-03-2023/7:13 PM'),
(468, 'Activated all the students.', 'superadmin1234', '12-03-2023/7:23 PM'),
(469, 'Activated all the students.', 'superadmin1234', '12-03-2023/7:23 PM'),
(470, 'Login', 'superadmin1234', '12-03-2023/7:25 PM'),
(471, 'Student 2020600077 / Mark Steven Blanco was generate a new password and resend it on email.', 'superadmin1234', '12-03-2023/7:25 PM'),
(472, 'Login', 'superadmin1234', '12-03-2023/7:25 PM'),
(473, 'Student 2020600077 / Mark Steven Blanco was generate a new password and resend it on email.', 'superadmin1234', '12-03-2023/7:26 PM'),
(474, 'Login', 'superadmin1234', '12-03-2023/7:33 PM'),
(475, 'Login', 'superadmin1234', '12-03-2023/7:34 PM'),
(476, 'Login', 'superadmin1234', '12-03-2023/8:17 PM'),
(477, 'Login', 'superadmin1234', '12-03-2023/8:23 PM'),
(478, 'Student 2020600719 / Adrian Louie Laruan was edited.', 'superadmin1234', '12-03-2023/8:24 PM'),
(479, 'Login', 'superadmin1234', '12-03-2023/8:24 PM'),
(480, 'Student 2020600719 / Adrian Louie Laruan was edited.', 'superadmin1234', '12-03-2023/8:24 PM'),
(481, 'Login', 'superadmin1234', '12-03-2023/8:34 PM'),
(482, 'Login', 'superadmin1234', '12-03-2023/8:34 PM'),
(483, 'Login', 'superadmin1234', '12-03-2023/8:41 PM'),
(484, 'Login', 'superadmin1234', '12-03-2023/8:41 PM'),
(485, 'Login', 'superadmin1234', '12-03-2023/8:49 PM'),
(486, 'Login', 'superadmin1234', '12-03-2023/8:51 PM'),
(487, 'Login', 'superadmin1234', '12-03-2023/9:01 PM'),
(488, 'Login', 'superadmin1234', '12-03-2023/9:04 PM'),
(489, 'Login', 'superadmin1234', '12-03-2023/9:06 PM'),
(490, 'Generate the Final VoteTally via PDF.', 'superadmin1234', '12-03-2023/9:09 PM'),
(491, 'Login', 'superadmin1234', '12-03-2023/9:11 PM'),
(492, 'Login', 'superadmin1234', '12-03-2023/9:11 PM'),
(493, 'Generate the Final VoteTally via PDF.', 'superadmin1234', '12-03-2023/9:11 PM'),
(494, 'Login', 'superadmin1234', '12-04-2023/8:54 AM'),
(495, 'Login', 'superadmin123', '12-04-2023/8:54 AM'),
(496, 'Login', 'superadmin1234', '12-04-2023/8:55 AM'),
(497, 'Login', 'superadmin1234', '12-04-2023/8:55 AM'),
(498, 'Login', 'superadmin1234', '12-04-2023/9:03 AM'),
(499, 'Logout', 'superadmin1234', '12-04-2023/9:03 AM'),
(500, 'Login', 'superadmin1234', '12-04-2023/9:03 AM'),
(501, 'Logout', 'superadmin1234', '12-04-2023/9:03 AM'),
(502, 'Login', 'superadmin1234', '12-04-2023/9:05 AM'),
(503, 'Login', 'superadmin1234', '12-04-2023/9:06 AM'),
(504, 'Login', 'superadmin1234', '12-04-2023/9:11 AM'),
(505, 'Login', 'superadmin1234', '12-04-2023/9:11 AM'),
(506, 'Login', 'superadmin1234', '12-04-2023/9:16 AM'),
(507, 'Login', 'superadmin1234', '12-04-2023/9:17 AM'),
(508, 'Logout', 'superadmin1234', '12-04-2023/9:17 AM'),
(509, 'Login', 'superadmin1234', '12-04-2023/9:18 AM'),
(510, 'Added new admin named admin0', 'superadmin1234', '12-04-2023/9:19 AM'),
(511, 'Login', 'superadmin1234', '12-04-2023/9:20 AM'),
(512, 'Added new admin named admin0', 'superadmin1234', '12-04-2023/9:20 AM'),
(513, 'Admin that has a username admin0 has been removed', 'superadmin1234', '12-04-2023/9:20 AM'),
(514, 'Admin that has a username admin0 has been removed', 'superadmin1234', '12-04-2023/9:20 AM'),
(515, 'Login', 'admin123', '12-04-2023/9:21 AM'),
(516, 'Login', 'superadmin1234', '12-04-2023/9:24 AM'),
(517, 'Added new superadmin named superadmin0', 'superadmin1234', '12-04-2023/9:26 AM'),
(518, 'Login', 'superadmin1234', '12-04-2023/9:31 AM'),
(519, 'Added new superadmin named superadmin0', 'superadmin1234', '12-04-2023/9:31 AM'),
(520, 'Superadmin that has a username superadmin0 has been removed', 'superadmin1234', '12-04-2023/9:31 AM'),
(521, 'Superadmin that has a username superadmin0 has been removed', 'superadmin1234', '12-04-2023/9:31 AM'),
(522, 'Login', 'superadmin1234', '12-04-2023/9:32 AM'),
(523, 'Added new superadmin named superadmin0', 'superadmin1234', '12-04-2023/9:32 AM'),
(524, 'Login', 'superadmin1234', '12-04-2023/9:52 AM'),
(525, 'Added new superadmin named superadmin0', 'superadmin1234', '12-04-2023/9:52 AM'),
(526, 'Superadmin that has a username superadmin0 has been removed', 'superadmin1234', '12-04-2023/9:53 AM'),
(527, 'Superadmin that has a username superadmin0 has been removed', 'superadmin1234', '12-04-2023/9:54 AM'),
(528, 'Login', 'superadmin1234', '12-04-2023/9:54 AM'),
(529, 'Added new superadmin named superadmin0', 'superadmin1234', '12-04-2023/9:55 AM'),
(530, 'Login', 'superadmin1234', '12-04-2023/9:55 AM'),
(531, 'Login', 'superadmin1234', '12-04-2023/9:56 AM'),
(532, 'Superadmin that has a username superadmin0 has been removed', 'superadmin1234', '12-04-2023/9:57 AM'),
(533, 'Login', 'superadmin1234', '12-04-2023/10:00 AM'),
(534, 'Added new superadmin named superadmin0', 'superadmin1234', '12-04-2023/10:01 AM'),
(535, 'Login', 'superadmin1234', '12-04-2023/10:01 AM'),
(536, 'Superadmin that has a username superadmin0 has been removed', 'superadmin1234', '12-04-2023/10:01 AM'),
(537, 'Login', 'superadmin1234', '12-04-2023/10:01 AM'),
(538, 'Added new superadmin named superadmin0', 'superadmin1234', '12-04-2023/10:01 AM'),
(539, 'Login', 'superadmin1234', '12-04-2023/10:10 AM'),
(540, 'Deactivated all the admins', 'superadmin1234', '12-04-2023/10:11 AM'),
(541, 'Activated all the admins.', 'superadmin1234', '12-04-2023/10:11 AM'),
(542, 'Login', 'superadmin1234', '12-04-2023/10:12 AM'),
(543, 'Login', 'superadmin1234', '12-04-2023/10:12 AM'),
(544, 'Deactivated all the superadmins', 'superadmin1234', '12-04-2023/10:12 AM'),
(545, 'Activated all the superadmins.', 'superadmin1234', '12-04-2023/10:12 AM'),
(546, 'Login', 'superadmin1234', '12-04-2023/10:13 AM'),
(547, 'Deactivated all the superadmins', 'superadmin1234', '12-04-2023/10:13 AM'),
(548, 'Activated all the superadmins.', 'superadmin1234', '12-04-2023/10:13 AM'),
(549, 'Login', 'admin123', '12-04-2023/12:52 PM'),
(550, 'Logout', 'admin123', '12-04-2023/12:53 PM'),
(551, 'Login', 'superadmin123', '12-04-2023/12:53 PM'),
(552, 'Logout', 'superadmin123', '12-04-2023/1:15 PM'),
(553, 'Login', 'admin123', '12-04-2023/1:46 PM'),
(554, 'Added new position named President.', 'admin123', '12-04-2023/1:46 PM'),
(555, 'Added new candidate named Mark Steven BLANCO as President.', 'admin123', '12-04-2023/1:49 PM'),
(556, 'Candidate Mark Steven BLANCO was edited.', 'admin123', '12-04-2023/1:49 PM'),
(557, 'Candidate Mark Steven BLANCO was edited.', 'admin123', '12-04-2023/1:50 PM'),
(558, 'Logout', 'admin123', '12-04-2023/1:51 PM'),
(559, 'Login', 'superadmin123', '12-04-2023/1:51 PM'),
(560, 'Logout', 'superadmin123', '12-04-2023/1:53 PM'),
(561, 'Login', 'superadmin123', '12-04-2023/1:53 PM'),
(562, 'Login', 'superadmin123', '12-04-2023/6:36 PM'),
(563, 'Login', 'admin123', '12-05-2023/9:11 PM'),
(564, 'Login', 'superadmin123', '12-05-2023/9:23 PM'),
(565, 'Login', 'admin123', '12-05-2023/9:24 PM'),
(566, 'Login', 'superadmin123', '12-05-2023/10:17 PM'),
(567, 'Deactivated all the admins', 'superadmin123', '12-05-2023/10:39 PM'),
(568, 'Login', 'superadmin123', '01-05-2024/9:00 PM'),
(569, 'Logout', 'superadmin123', '01-05-2024/9:04 PM'),
(570, 'Login', 'superadmin123', '01-05-2024/9:05 PM'),
(571, 'Logout', 'superadmin123', '01-05-2024/9:05 PM'),
(572, 'Login', 'superadmin123', '01-05-2024/9:09 PM'),
(573, 'Logout', 'superadmin123', '01-05-2024/9:13 PM'),
(574, 'Login', 'superadmin123', '01-05-2024/9:15 PM'),
(575, 'Deactivated all the students', 'superadmin123', '01-05-2024/9:15 PM'),
(576, 'Activated all the students.', 'superadmin123', '01-05-2024/9:16 PM'),
(577, 'Login', 'superadmin123', '01-07-2024/8:23 PM'),
(578, 'Activated all the admins.', 'superadmin123', '01-07-2024/8:23 PM'),
(579, 'Logout', 'superadmin123', '01-07-2024/8:23 PM'),
(580, 'Login', 'admin123', '01-07-2024/8:23 PM'),
(581, 'Added new position named Fgfgfgfgfg.', 'admin123', '01-07-2024/9:14 PM'),
(582, 'Logout', 'admin123', '01-07-2024/9:38 PM'),
(583, 'Login', 'superadmin123', '01-07-2024/9:38 PM'),
(584, 'Deactivated all the admins', 'superadmin123', '01-07-2024/9:38 PM'),
(585, 'Position Fgfgfgfgfg has been removed.', 'superadmin123', '01-07-2024/9:53 PM'),
(586, 'Activated all the admins.', 'superadmin123', '01-07-2024/9:54 PM'),
(587, 'Logout', 'superadmin123', '01-07-2024/9:56 PM'),
(588, 'Login', 'superadmin123', '01-07-2024/9:56 PM'),
(589, 'Deactivated all the students', 'superadmin123', '01-07-2024/10:01 PM'),
(590, 'Activated all the students.', 'superadmin123', '01-07-2024/10:03 PM'),
(591, 'Deactivated all the admins', 'superadmin123', '01-07-2024/11:28 PM'),
(592, 'Added new admin named tgthgyjg', 'superadmin123', '01-07-2024/11:34 PM'),
(593, 'Admin that has a username tgthgyjg has been removed', 'superadmin123', '01-07-2024/11:34 PM'),
(594, 'Login', 'superadmin123', '01-09-2024/11:57 AM'),
(595, 'Login', 'superadmin123', '01-09-2024/12:16 PM'),
(596, 'Login', 'superadmin123', '01-09-2024/5:00 PM'),
(597, 'Login', 'superadmin123', '01-09-2024/5:00 PM'),
(598, 'Logout', 'superadmin123', '01-09-2024/5:03 PM'),
(599, 'Login', 'superadmin123', '01-09-2024/5:07 PM'),
(600, 'Deactivated all the students', 'superadmin123', '01-09-2024/5:08 PM'),
(601, 'Activated all the students.', 'superadmin123', '01-09-2024/5:08 PM'),
(602, 'Login', 'superadmin123', '01-10-2024/9:33 AM'),
(603, 'Activated all the admins.', 'superadmin123', '01-10-2024/9:34 AM'),
(604, 'Login', 'admin123', '01-10-2024/9:34 AM'),
(605, 'Login', 'superadmin123', '01-10-2024/8:04 PM');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_batch2021-2022`
--

CREATE TABLE `candidate_batch2021-2022` (
  `id` int(11) NOT NULL,
  `Position` varchar(250) NOT NULL,
  `Partylist` varchar(250) NOT NULL,
  `Firstname_candidate` varchar(250) NOT NULL,
  `Middlename_candidate` varchar(250) NOT NULL,
  `Lastname_candidate` varchar(250) NOT NULL,
  `Yearlevel` varchar(250) NOT NULL,
  `Course` varchar(250) NOT NULL,
  `Gender` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Mission` varchar(250) NOT NULL,
  `suffix` varchar(250) NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_batch2021-2022`
--

INSERT INTO `candidate_batch2021-2022` (`id`, `Position`, `Partylist`, `Firstname_candidate`, `Middlename_candidate`, `Lastname_candidate`, `Yearlevel`, `Course`, `Gender`, `Image`, `Mission`, `suffix`, `votes`) VALUES
(2, 'Vice Governor', 'Crammers', 'Wilmer', 'Enot', 'ALOSA', '4th', 'BSIT', 'Male', 'ed2105546b534db4e4ebd2635a9184b3e244912e.jpg', 'Dedicated to creating a supportive learning environment, where students thrive academically, socially, and emotionally, fostering holistic development.', '', 106),
(3, 'Governor', 'Wisdom Seekers', 'Elon', '', 'MUSK', '4th', 'BSTM', 'Male', '1674217862129.jpg', 'Fostering a collaborative learning community, we empower students to become effective communicators, critical thinkers, and responsible global citizens.', '', 109),
(4, 'Vice Governor', 'Wisdom Seekers', 'Josh', '', 'CONCEPTION', '4th', 'BSHM', 'Male', '4336fdb3a81055246f935cd6b1a16fd8.jpg', 'Advocating for digital literacy, we prepare students for the challenges of the digital age, ensuring they are proficient, ethical, and responsible users.', '', 112),
(6, 'Bm Tourism', 'Wisdom Seekers', 'Steve Mark', 'George', 'ROGER', '3rd', 'BSTM', 'Male', '2x2.jpg', 'Promoting a sustainable future, our mission is to instill environmental consciousness, ethical values, and civic responsibility in every student.', 'iv', 106),
(7, 'Bm Tourism', 'Crammers', 'Micheal', 'Ewan', 'JORDAN', '4th', 'BSTM', 'Male', 'after2-e1546769616778-240x300.jpg', 'Championing educational excellence by equipping students with practical skills, instilling a passion for lifelong learning, and promoting global citizenship.', 'jr', 105),
(8, 'Bm Education', 'Crammers', 'Jennylyn', 'Delos Reyes', 'HALILI', '4th', 'BEED', 'Female', 'Mengyu-Chang.jpg', 'Committed to fostering a culture of respect, kindness, and resilience, we prepare students not just for academic success but for a fulfilling and balanced life.', '', 113),
(10, 'Bm Education', 'Wisdom Seekers', 'David', 'Ewan', 'LAID', '4th', 'BSED', 'Male', '20682869510_f79eaa49d9_z.jpg', 'Committed to cultivating a culture of inclusivity, where diversity is celebrated, and students embrace each other\'s unique perspectives to foster mutual growth.', '', 109),
(11, 'Bm Hm / Bit', 'Wisdom Seekers', 'Grace', 'Lopez', 'PANGANIBAN', '4th', 'BSHM', 'Female', 'images.jpg', 'Striving for academic excellence, we are dedicated to providing a challenging yet supportive environment that prepares students for a competitive world.', '', 109),
(12, 'Bm Hm / Bit', 'Crammers', 'Cristiano', 'Ewan', 'RONALDO', '4th', 'BSHM', 'Male', '2x2 Pic.png', 'Inspiring academic curiosity and a love for knowledge, we strive to ignite the spark of learning that lasts a lifetime, shaping future leaders.', '', 105),
(13, 'Bm It', 'Crammers', 'Harry', '', 'POTTER', '4th', 'BSIT', 'Male', '1631242787973.jpg', 'Promoting a growth mindset, our mission is to encourage students to embrace challenges, learn from failures, and develop a lifelong love for learning.', 'iii', 104),
(14, 'Bm It', 'Wisdom Seekers', 'Mark', '', 'ZUCKERBERG', '4th', 'BSIT', 'Male', '142572.jpeg', 'Cultivating a passion for community service, we aim to instill a sense of social responsibility, empathy, and compassion in every student.', '', 103),
(17, 'Governor', 'Crammers', 'Lemuel', 'Enot', 'ALOSA', '4th', 'BSIT', 'Male', '2x2Lemuel.JPG', 'Advocating for digital literacy, we prepare students for the challenges of the digital age, ensuring they are proficient, ethical, and responsible users.', '', 111),
(25, 'President', 'Crammers', 'Mark Steven', 'Lomangaya', 'BLANCO', '4th', 'BSIT', 'Male', '1209416.png', 'To see is to see', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `candidate_partylist2021-2022`
--

CREATE TABLE `candidate_partylist2021-2022` (
  `id` int(11) NOT NULL,
  `partylist` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_partylist2021-2022`
--

INSERT INTO `candidate_partylist2021-2022` (`id`, `partylist`) VALUES
(3, 'Crammers'),
(21, 'Wisdom Seekers');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_position2021-2022`
--

CREATE TABLE `candidate_position2021-2022` (
  `id` int(11) NOT NULL,
  `position` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_position2021-2022`
--

INSERT INTO `candidate_position2021-2022` (`id`, `position`) VALUES
(2, 'Governor'),
(3, 'Vice Governor'),
(4, 'Bm Tourism'),
(5, 'Bm Education'),
(7, 'Bm Hm / Bit'),
(10, 'Bm It'),
(20, 'President');

-- --------------------------------------------------------

--
-- Table structure for table `lsc_election_list`
--

CREATE TABLE `lsc_election_list` (
  `lscbatch_id` int(11) NOT NULL,
  `lscbatch_list` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `electiondetails` varchar(250) NOT NULL,
  `candidate_batch` varchar(250) NOT NULL,
  `students_batch` varchar(250) NOT NULL,
  `candidate_position` varchar(250) NOT NULL,
  `candidate_partylist` varchar(250) NOT NULL,
  `audittrial_report` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lsc_election_list`
--

INSERT INTO `lsc_election_list` (`lscbatch_id`, `lscbatch_list`, `date`, `electiondetails`, `candidate_batch`, `students_batch`, `candidate_position`, `candidate_partylist`, `audittrial_report`, `status`) VALUES
(1, 'LSCBatch2021-2022', '2022-10-24', 'Promoting a growth mindset, our mission is to encourage students to embrace challenges, learn from failures, and develop a lifelong love for learning.', 'candidate_batch2021-2022', 'students_batch2021-2022', 'candidate_position2021-2022', 'candidate_partylist2021-2022', 'audittrial_report2021-2022', 'activated');

-- --------------------------------------------------------

--
-- Table structure for table `students_batch2021-2022`
--

CREATE TABLE `students_batch2021-2022` (
  `student_number` int(11) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `password_student` varchar(250) NOT NULL,
  `cysg` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `account` varchar(250) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `Fname` varchar(250) NOT NULL,
  `Lname` varchar(250) NOT NULL,
  `Mname` varchar(250) NOT NULL,
  `suffix` varchar(250) NOT NULL,
  `sendpass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_batch2021-2022`
--

INSERT INTO `students_batch2021-2022` (`student_number`, `student_id`, `password_student`, `cysg`, `status`, `account`, `email_address`, `Fname`, `Lname`, `Mname`, `suffix`, `sendpass`) VALUES
(1, '2031600578', '4b211f4ab83dGcr8675kI8a8032c0c269cd56bc39c76f6584c75c09ded44a625e1c7768', 'BSIT - 3C', 'voted', 'activated', 'ava.garciajr.g@bulsu.edu.ph', 'Ava', 'Garcia', 'Grace', 'jr', 'Yes'),
(2, '2023600123', '8830a1f67cbhnWF46f98eU6f016ab77228e1e4fe114409c8d8653c5efdded3e3c015c16', 'BSCS - 2A', 'voted', 'activated', 'alex.smith.m@bulsu.edu.ph', 'Alex', 'Smith', 'Michael', '', 'Yes'),
(3, '2024800456', 'a49d669fa71wmai60e2Hb8614d5029ae97210a39ec5a30ee7339354271c3a3c2008ef0e', 'BSIT - 3B', 'voted', 'activated', 'emily.johnson.g@bulsu.edu.ph', 'Emily', 'Johnson', 'Grace', '', 'Yes'),
(4, '2025900879', '05a937e1793B8Lx0ba2hSDa54c5794b719aa02b82920083485d6b38de6a3e223447a1b6', 'BBA - 4C', 'unvoted', 'activated', 'sophia.anderson.e@bulsu.edu.ph', 'Sophia', 'Anderson', 'Elizabeth', '', 'Yes'),
(5, '2026900234', '676753949adl12v0b00PYx3496e62187583ca0f8b0b0b656103b4c07305a01ce2a31770', 'BSED - 2B', 'unvoted', 'activated', 'daniel.williamssr.j@bulsu.edu.ph', 'Daniel', 'Williams', 'James', 'sr', 'Yes'),
(6, '2027100556', '40189bfdae4eeTubf34tbr69ed37ee99cc095f7066b572263b4eaa9893d1e6115a0e442', 'BSHRM - 3A', 'voted', 'activated', 'olivia.davis.a@bulsu.edu.ph', 'Olivia', 'Davis', 'Anne', '', 'Yes'),
(7, '2028600765', 'e9d9686118c4pvn1103wCx29b5f41440b92a0d6076948ac5ab658619aca8a57ca5ae2e2', 'BSCS - 4B', 'voted', 'activated', 'ethan.browniii.t@bulsu.edu.ph', 'Ethan', 'Brown', 'Thomas', 'iii', 'Yes'),
(9, '2030700987', 'ff4ef6ec111XZ2x476cLdYd6c86620fa3f78ef4332fd2233de4b448ee503a8a1dcb63e3', 'BSM - 3C', 'unvoted', 'activated', 'liam.martinezv.j@bulsu.edu.ph', 'Lian', 'Martinez', 'Joseph', 'v', 'Yes'),
(10, '2032800112', '87d3042cf3cA7ul0df0TQU86b5e275324f697dd9ade1a6965eb1cadc11cacffe334b862', 'BSN - 4A', 'voted', 'activated', 'noah.lee.b@bulsu.edu.ph', 'Noah', 'Lee', 'Benjamin', '', 'Yes'),
(11, '2031600528', '2c79855fb81t4bwf852Iq80dda8554076e80fae16ed0cd8c04a191956d4883a68ea4977', 'BSIT - 2C', 'voted', 'activated', 'tyler.garciaiv.g@bulsu.edu.ph', 'Tyler', 'Garcia', 'Grace', 'iv', 'Yes'),
(12, '2031300528', '98b04bd3941YHwP4acaPQPcfd1332a93acb95bf01b9e592037b30750b8b9009ab6075dc', 'BSIT - 1C', 'voted', 'activated', 'tyler.garcia.dc@bulsu.edu.ph', 'Tyler', 'Garcia', 'Dela cruz', '', 'Yes'),
(13, '2020600818', '76073768c52bLCw78446rOf48e777eb4814abc89805746754962e724e1b4b9eeb94abcb', 'BSIT - 4C', 'unvoted', 'activated', 'lemuel.alosa.e@bulsu.edu.ph', 'Lemuel', 'Alosa', 'Enot', '', 'Yes'),
(16, '2020600077', '64caa82054ff2ba275e0nbfe2269384f954c81c5fb216d031ce0d8577fd56d919661f1b', 'BSIT - 4C', 'unvoted', 'activated', 'marksteven.blanco.l@bulsu.edu.ph', 'Mark Steven', 'Blanco', 'Lomangaya', '', 'Yes'),
(17, '2020600479', 'a81ef0f95a8CDVLe9d3kvy471a1a1d9ad156009526bfb0ee3d9c15467fc1af87ee131cc', 'BSIT - 4C', 'voted', 'activated', 'jennlyn.halili.dr@bulsu.edu.ph', 'Jennlyn', 'Halili', 'Delos reyes', '', 'Yes'),
(18, '2020600719', '1a8b03d8449T1C471e0TwFd78b814bbea089c93b3ce8a76c07fbca14c423e95d6a13685', 'BSIT - 4C', 'voted', 'activated', 'adrianlouie.laruan.m@bulsu.edu.ph', 'Adrian Louie', 'Laruan', 'Magaling', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `superadmin_Id` int(11) NOT NULL,
  `username_superadmin` varchar(250) NOT NULL,
  `password_superadmin` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`superadmin_Id`, `username_superadmin`, `password_superadmin`, `status`) VALUES
(1, 'superadmin123', 'fa753b0d0ac0537cfcbb2117dd7713d056ab1fdd19c03e9329daf481b3413563', 'main_account'),
(9, 'superadmin111', 'e7c8a6d783ca9cd4fad8e3650e09b843e4549b651d748c9e19b939ec9f2018be', 'activated'),
(11, 'superadmin222', 'b6f316b4eeb8324289b7610f84df94cfcc15cbd04827381b6946ac42e815645d', 'activated'),
(23, 'superadmin1234', 'f4f01e18046382445d3b1c04ad7c18402e8958cd47775c4d17962e6f17a5faa9', 'activated'),
(30, 'superadmin0', '098663dfe6f25a8d53b93250a9aa1818e3134bef9a9db40de7640ad78a9a9f75', 'activated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `audittrial_report2021-2022`
--
ALTER TABLE `audittrial_report2021-2022`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_batch2021-2022`
--
ALTER TABLE `candidate_batch2021-2022`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_partylist2021-2022`
--
ALTER TABLE `candidate_partylist2021-2022`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_position2021-2022`
--
ALTER TABLE `candidate_position2021-2022`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsc_election_list`
--
ALTER TABLE `lsc_election_list`
  ADD PRIMARY KEY (`lscbatch_id`);

--
-- Indexes for table `students_batch2021-2022`
--
ALTER TABLE `students_batch2021-2022`
  ADD PRIMARY KEY (`student_number`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`superadmin_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `audittrial_report2021-2022`
--
ALTER TABLE `audittrial_report2021-2022`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT for table `candidate_batch2021-2022`
--
ALTER TABLE `candidate_batch2021-2022`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `candidate_partylist2021-2022`
--
ALTER TABLE `candidate_partylist2021-2022`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `candidate_position2021-2022`
--
ALTER TABLE `candidate_position2021-2022`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lsc_election_list`
--
ALTER TABLE `lsc_election_list`
  MODIFY `lscbatch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students_batch2021-2022`
--
ALTER TABLE `students_batch2021-2022`
  MODIFY `student_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `superadmin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
