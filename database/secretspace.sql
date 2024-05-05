-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 04:57 AM
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
-- Database: `secretspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `password_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `password_text`) VALUES
(1, 'Ayush Solanki', 'admin@gmail.com', '66049c07d9e8546699fe0872fd32d8f6', 'ayush');

-- --------------------------------------------------------

--
-- Table structure for table `block_list`
--

CREATE TABLE `block_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(60, 24, 21, 'gift your girl . <:D', '2024-02-02 11:13:26'),
(61, 25, 23, 'downloaded', '2024-02-02 11:32:28'),
(62, 23, 23, 'nice shoes . ', '2024-02-02 11:32:52'),
(63, 32, 24, 'all available .', '2024-02-02 11:46:05'),
(64, 27, 25, 'thank you <3', '2024-02-02 11:57:40'),
(65, 41, 26, 'ðŸ˜‚ðŸ¤£ðŸ¤£', '2024-02-02 12:12:15'),
(66, 43, 21, 'price??', '2024-02-02 12:19:40'),
(67, 25, 29, 'how to play ?', '2024-02-02 12:34:55'),
(68, 26, 29, 'collab', '2024-02-02 12:35:04'),
(69, 27, 29, 'looking so empty , i guess you need a ford ! ', '2024-02-02 12:36:22'),
(70, 50, 29, 'my beauty ', '2024-02-02 12:36:37'),
(71, 48, 29, 'shinning in sky .', '2024-02-02 12:36:53'),
(72, 47, 21, 'good', '2024-02-02 12:57:13'),
(73, 44, 21, 'asdsadad', '2024-02-02 13:06:41'),
(74, 44, 30, 'cool Clothes', '2024-02-24 13:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow_list`
--

INSERT INTO `follow_list` (`id`, `follower_id`, `user_id`) VALUES
(101, 23, 21),
(102, 23, 22),
(103, 24, 22),
(104, 24, 23),
(105, 24, 21),
(106, 24, 25),
(107, 25, 22),
(108, 25, 23),
(109, 25, 21),
(110, 26, 22),
(111, 26, 23),
(112, 26, 25),
(113, 26, 27),
(114, 26, 21),
(115, 26, 24),
(116, 21, 25),
(117, 21, 23),
(119, 21, 26),
(120, 21, 24),
(121, 21, 27),
(122, 27, 24),
(123, 27, 25),
(124, 27, 22),
(125, 27, 21),
(127, 29, 22),
(129, 28, 27),
(130, 28, 26),
(131, 28, 24),
(132, 28, 25),
(133, 28, 21),
(134, 21, 28),
(135, 30, 25),
(136, 30, 24),
(137, 30, 22),
(138, 30, 27),
(139, 30, 26),
(140, 30, 23),
(141, 30, 21);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(123, 24, 21),
(124, 23, 21),
(125, 22, 21),
(126, 27, 22),
(127, 26, 22),
(128, 25, 22),
(129, 24, 22),
(130, 23, 22),
(131, 22, 22),
(132, 31, 23),
(133, 30, 23),
(134, 29, 23),
(135, 28, 23),
(136, 27, 23),
(137, 25, 23),
(138, 24, 23),
(139, 22, 23),
(140, 23, 23),
(141, 25, 24),
(142, 26, 24),
(143, 27, 24),
(144, 34, 24),
(145, 33, 24),
(146, 32, 24),
(147, 31, 24),
(148, 30, 24),
(149, 29, 24),
(150, 28, 24),
(151, 23, 24),
(152, 22, 24),
(153, 24, 24),
(154, 38, 25),
(155, 36, 25),
(156, 35, 25),
(157, 31, 25),
(158, 30, 25),
(159, 27, 25),
(160, 25, 25),
(161, 38, 26),
(162, 36, 26),
(163, 35, 26),
(164, 27, 26),
(165, 41, 26),
(166, 40, 26),
(167, 39, 26),
(168, 25, 26),
(169, 26, 26),
(170, 34, 26),
(171, 22, 26),
(172, 23, 26),
(173, 24, 26),
(174, 28, 26),
(175, 29, 26),
(176, 30, 26),
(177, 31, 26),
(178, 32, 26),
(179, 41, 21),
(180, 40, 21),
(181, 39, 21),
(182, 38, 21),
(183, 36, 21),
(184, 35, 21),
(185, 34, 21),
(186, 32, 21),
(187, 44, 27),
(188, 43, 27),
(189, 42, 27),
(190, 38, 27),
(191, 36, 27),
(192, 35, 27),
(193, 34, 27),
(194, 27, 27),
(195, 25, 27),
(196, 44, 21),
(197, 43, 21),
(198, 33, 21),
(199, 47, 28),
(200, 46, 28),
(201, 45, 28),
(202, 48, 29),
(203, 49, 29),
(204, 50, 29),
(205, 25, 29),
(206, 27, 29),
(207, 26, 29),
(208, 44, 28),
(209, 43, 28),
(210, 42, 28),
(211, 41, 28),
(212, 40, 28),
(213, 46, 21),
(214, 47, 21),
(215, 28, 21),
(216, 27, 21),
(217, 50, 21),
(218, 45, 21),
(219, 38, 24),
(220, 36, 24),
(221, 35, 24),
(222, 38, 30),
(223, 44, 30);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `msg`, `read_status`, `created_at`) VALUES
(99, 21, 25, 'hii', 1, '2024-03-05 08:12:20'),
(100, 25, 21, 'hello', 0, '2024-03-05 08:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_user_id` int(11) NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `post_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `to_user_id`, `message`, `created_at`, `from_user_id`, `read_status`, `post_id`) VALUES
(193, 21, 'started following you !', '2024-02-02 11:24:31', 22, 1, '0'),
(194, 21, 'liked your post !', '2024-02-02 11:24:50', 22, 1, '24'),
(195, 21, 'liked your post !', '2024-02-02 11:24:51', 22, 1, '23'),
(196, 21, 'liked your post !', '2024-02-02 11:24:52', 22, 1, '22'),
(197, 21, 'started following you !', '2024-02-02 11:32:11', 23, 1, '0'),
(198, 22, 'started following you !', '2024-02-02 11:32:11', 23, 0, '0'),
(199, 22, 'commented on your post', '2024-02-02 11:32:28', 23, 0, '25'),
(200, 21, 'commented on your post', '2024-02-02 11:32:52', 23, 1, '23'),
(201, 22, 'liked your post !', '2024-02-02 11:40:13', 23, 0, '27'),
(202, 22, 'liked your post !', '2024-02-02 11:40:14', 23, 0, '25'),
(203, 21, 'liked your post !', '2024-02-02 11:40:16', 23, 1, '24'),
(204, 21, 'liked your post !', '2024-02-02 11:40:18', 23, 1, '22'),
(205, 21, 'liked your post !', '2024-02-02 11:40:21', 23, 1, '23'),
(206, 22, 'started following you !', '2024-02-02 11:44:33', 24, 0, '0'),
(207, 22, 'liked your post !', '2024-02-02 11:47:05', 24, 0, '25'),
(208, 22, 'liked your post !', '2024-02-02 11:47:06', 24, 0, '26'),
(209, 22, 'liked your post !', '2024-02-02 11:47:08', 24, 0, '27'),
(210, 23, 'started following you !', '2024-02-02 11:47:59', 24, 0, '0'),
(211, 21, 'started following you !', '2024-02-02 11:47:59', 24, 1, '0'),
(212, 23, 'liked your post !', '2024-02-02 11:48:08', 24, 0, '31'),
(213, 23, 'liked your post !', '2024-02-02 11:48:10', 24, 0, '30'),
(214, 23, 'liked your post !', '2024-02-02 11:48:11', 24, 0, '29'),
(215, 23, 'liked your post !', '2024-02-02 11:48:14', 24, 0, '28'),
(216, 21, 'liked your post !', '2024-02-02 11:48:17', 24, 1, '23'),
(217, 21, 'liked your post !', '2024-02-02 11:48:19', 24, 1, '22'),
(218, 21, 'liked your post !', '2024-02-02 11:48:22', 24, 1, '24'),
(219, 25, 'started following you !', '2024-02-02 11:48:32', 24, 1, '0'),
(220, 22, 'started following you !', '2024-02-02 11:57:18', 25, 0, '0'),
(221, 23, 'started following you !', '2024-02-02 11:57:25', 25, 0, '0'),
(222, 21, 'started following you !', '2024-02-02 11:57:27', 25, 1, '0'),
(223, 22, 'commented on your post', '2024-02-02 11:57:40', 25, 0, '27'),
(224, 23, 'liked your post !', '2024-02-02 11:57:54', 25, 0, '31'),
(225, 23, 'liked your post !', '2024-02-02 11:57:56', 25, 0, '30'),
(226, 22, 'liked your post !', '2024-02-02 11:58:00', 25, 0, '27'),
(227, 22, 'liked your post !', '2024-02-02 11:58:02', 25, 0, '25'),
(228, 22, 'started following you !', '2024-02-02 12:07:22', 26, 0, '0'),
(229, 23, 'started following you !', '2024-02-02 12:07:24', 26, 0, '0'),
(230, 25, 'started following you !', '2024-02-02 12:07:27', 26, 0, '0'),
(231, 25, 'liked your post !', '2024-02-02 12:08:06', 26, 0, '38'),
(232, 25, 'liked your post !', '2024-02-02 12:08:09', 26, 0, '36'),
(233, 25, 'liked your post !', '2024-02-02 12:08:12', 26, 0, '35'),
(234, 22, 'liked your post !', '2024-02-02 12:08:18', 26, 0, '27'),
(235, 22, 'liked your post !', '2024-02-02 12:08:26', 26, 0, '25'),
(236, 22, 'liked your post !', '2024-02-02 12:08:30', 26, 0, '26'),
(237, 27, 'started following you !', '2024-02-02 12:11:15', 26, 1, '0'),
(238, 21, 'started following you !', '2024-02-02 12:11:16', 26, 1, '0'),
(239, 24, 'started following you !', '2024-02-02 12:11:16', 26, 0, '0'),
(240, 24, 'liked your post !', '2024-02-02 12:11:30', 26, 0, '34'),
(241, 21, 'liked your post !', '2024-02-02 12:11:35', 26, 1, '22'),
(242, 21, 'liked your post !', '2024-02-02 12:11:38', 26, 1, '23'),
(243, 21, 'liked your post !', '2024-02-02 12:11:40', 26, 1, '24'),
(244, 23, 'liked your post !', '2024-02-02 12:11:44', 26, 0, '28'),
(245, 23, 'liked your post !', '2024-02-02 12:11:46', 26, 0, '29'),
(246, 23, 'liked your post !', '2024-02-02 12:11:48', 26, 0, '30'),
(247, 23, 'liked your post !', '2024-02-02 12:11:50', 26, 0, '31'),
(248, 24, 'liked your post !', '2024-02-02 12:11:51', 26, 0, '32'),
(249, 25, 'started following you !', '2024-02-02 12:12:28', 21, 0, '0'),
(250, 23, 'started following you !', '2024-02-02 12:12:28', 21, 0, '0'),
(251, 22, 'started following you !', '2024-02-02 12:12:29', 21, 0, '0'),
(252, 26, 'started following you !', '2024-02-02 12:12:29', 21, 0, '0'),
(253, 24, 'started following you !', '2024-02-02 12:12:29', 21, 0, '0'),
(254, 27, 'started following you !', '2024-02-02 12:12:36', 21, 1, '0'),
(255, 26, 'liked your post !', '2024-02-02 12:12:39', 21, 0, '41'),
(256, 26, 'liked your post !', '2024-02-02 12:12:41', 21, 0, '40'),
(257, 26, 'liked your post !', '2024-02-02 12:12:42', 21, 0, '39'),
(258, 25, 'liked your post !', '2024-02-02 12:12:45', 21, 0, '38'),
(259, 25, 'liked your post !', '2024-02-02 12:12:46', 21, 0, '36'),
(260, 25, 'liked your post !', '2024-02-02 12:12:48', 21, 0, '35'),
(261, 24, 'liked your post !', '2024-02-02 12:12:50', 21, 0, '34'),
(262, 24, 'liked your post !', '2024-02-02 12:12:52', 21, 0, '32'),
(263, 24, 'started following you !', '2024-02-02 12:17:54', 27, 0, '0'),
(264, 25, 'started following you !', '2024-02-02 12:17:57', 27, 0, '0'),
(265, 22, 'started following you !', '2024-02-02 12:17:58', 27, 0, '0'),
(266, 25, 'liked your post !', '2024-02-02 12:18:10', 27, 0, '38'),
(267, 25, 'liked your post !', '2024-02-02 12:18:13', 27, 0, '36'),
(268, 25, 'liked your post !', '2024-02-02 12:18:17', 27, 0, '35'),
(269, 24, 'liked your post !', '2024-02-02 12:18:20', 27, 0, '34'),
(270, 22, 'liked your post !', '2024-02-02 12:18:23', 27, 0, '27'),
(271, 22, 'liked your post !', '2024-02-02 12:18:30', 27, 0, '25'),
(272, 21, 'started following you !', '2024-02-02 12:18:54', 27, 1, '0'),
(273, 27, 'liked your post !', '2024-02-02 12:19:32', 21, 0, '44'),
(274, 27, 'liked your post !', '2024-02-02 12:19:34', 21, 0, '43'),
(275, 27, 'commented on your post', '2024-02-02 12:19:40', 21, 0, '43'),
(276, 24, 'liked your post !', '2024-02-02 12:20:30', 21, 0, '33'),
(277, 22, 'started following you !', '2024-02-02 12:25:57', 28, 0, '0'),
(278, 22, 'started following you !', '2024-02-02 12:33:12', 29, 0, '0'),
(279, 22, 'liked your post !', '2024-02-02 12:33:31', 29, 0, '25'),
(280, 22, 'liked your post !', '2024-02-02 12:33:34', 29, 0, '27'),
(281, 22, 'liked your post !', '2024-02-02 12:33:37', 29, 0, '26'),
(282, 22, 'commented on your post', '2024-02-02 12:34:55', 29, 0, '25'),
(283, 22, 'commented on your post', '2024-02-02 12:35:04', 29, 0, '26'),
(284, 22, 'commented on your post', '2024-02-02 12:36:22', 29, 0, '27'),
(285, 23, 'started following you !', '2024-02-02 12:46:30', 28, 0, '0'),
(286, 27, 'started following you !', '2024-02-02 12:46:31', 28, 0, '0'),
(287, 26, 'started following you !', '2024-02-02 12:46:31', 28, 0, '0'),
(288, 24, 'started following you !', '2024-02-02 12:46:32', 28, 0, '0'),
(289, 25, 'started following you !', '2024-02-02 12:46:32', 28, 0, '0'),
(290, 21, 'started following you !', '2024-02-02 12:46:34', 28, 1, '0'),
(291, 27, 'liked your post !', '2024-02-02 12:46:40', 28, 0, '44'),
(292, 27, 'liked your post !', '2024-02-02 12:46:42', 28, 0, '43'),
(293, 27, 'liked your post !', '2024-02-02 12:46:44', 28, 0, '42'),
(294, 26, 'liked your post !', '2024-02-02 12:46:46', 28, 0, '41'),
(295, 26, 'liked your post !', '2024-02-02 12:46:48', 28, 0, '40'),
(296, 28, 'started following you !', '2024-02-02 12:55:21', 21, 1, '0'),
(297, 28, 'liked your post !', '2024-02-02 12:55:26', 21, 1, '46'),
(298, 28, 'liked your post !', '2024-02-02 12:55:28', 21, 1, '47'),
(299, 23, 'liked your post !', '2024-02-02 12:55:40', 21, 0, '28'),
(300, 22, 'liked your post !', '2024-02-02 12:55:56', 21, 0, '27'),
(301, 29, 'liked your post !', '2024-02-02 12:56:00', 21, 0, '50'),
(302, 28, 'commented on your post', '2024-02-02 12:57:13', 21, 1, '47'),
(303, 28, 'liked your post !', '2024-02-02 12:59:41', 21, 1, '45'),
(304, 27, 'commented on your post', '2024-02-02 13:06:41', 21, 0, '44'),
(305, 25, 'liked your post !', '2024-02-02 13:12:16', 24, 0, '38'),
(306, 25, 'liked your post !', '2024-02-02 13:12:18', 24, 0, '36'),
(307, 25, 'liked your post !', '2024-02-02 13:12:20', 24, 0, '35'),
(308, 25, 'started following you !', '2024-02-24 13:55:56', 30, 0, '0'),
(309, 24, 'started following you !', '2024-02-24 13:55:56', 30, 0, '0'),
(310, 22, 'started following you !', '2024-02-24 13:55:57', 30, 0, '0'),
(311, 25, 'liked your post !', '2024-02-24 13:56:11', 30, 0, '38'),
(312, 27, 'started following you !', '2024-02-24 13:56:46', 30, 0, '0'),
(313, 26, 'started following you !', '2024-02-24 13:56:47', 30, 0, '0'),
(314, 23, 'started following you !', '2024-02-24 13:56:47', 30, 0, '0'),
(315, 21, 'started following you !', '2024-02-24 13:56:47', 30, 1, '0'),
(316, 27, 'commented on your post', '2024-02-24 13:58:31', 30, 0, '44'),
(317, 27, 'liked your post !', '2024-02-24 13:58:44', 30, 0, '44'),
(318, 22, 'blocked you', '2024-03-05 08:14:25', 21, 0, '0'),
(319, 22, 'Unfollowed you !', '2024-03-05 08:52:22', 28, 0, '0'),
(320, 23, 'Unfollowed you !', '2024-03-05 08:52:23', 28, 0, '0'),
(321, 22, 'Unblocked you !', '2024-03-05 08:54:36', 21, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img` varchar(200) NOT NULL,
  `post_text` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img`, `post_text`, `created_at`) VALUES
(22, 21, '1706871900image_2024-02-02_163423123.png', 'shoes you want love <3', '2024-02-02 11:05:00'),
(23, 21, '1706872048image_2024-02-02_163617733.png', 'shine beauty â¤', '2024-02-02 11:07:28'),
(24, 21, '1706872198image_2024-02-02_163923305.png', 'pinky ponky ', '2024-02-02 11:09:58'),
(25, 22, '1706872679image_2024-02-02_164736086.png', 'chose your battle .', '2024-02-02 11:17:59'),
(26, 22, '1706872902image_2024-02-02_165114664.png', 'fire in the hole', '2024-02-02 11:21:42'),
(27, 22, '1706873037image_2024-02-02_165233258.png', 'black ðŸ–¤ pink ðŸ’—', '2024-02-02 11:23:57'),
(28, 23, '1706873527image_2024-02-02_170142816.png', '#1', '2024-02-02 11:32:07'),
(29, 23, '1706873664image_2024-02-02_170402543.png', '#2', '2024-02-02 11:34:24'),
(30, 23, '1706873705image_2024-02-02_170438625.png', '#3', '2024-02-02 11:35:05'),
(31, 23, '1706873996image_2024-02-02_170926106.png', '#4', '2024-02-02 11:39:56'),
(32, 24, '1706874264image_2024-02-02_171354873.png', 'boost your speed', '2024-02-02 11:44:24'),
(33, 24, '1706874335image_2024-02-02_171512979.png', 'chose your speed', '2024-02-02 11:45:35'),
(34, 24, '1706874416image_2024-02-02_171621408.png', 'hangout with us â˜•', '2024-02-02 11:46:56'),
(35, 25, '1706874825image_2024-02-02_172319077.png', '<3', '2024-02-02 11:53:48'),
(36, 25, '1706874863image_2024-02-02_172402669.png', 'live show', '2024-02-02 11:54:24'),
(38, 25, '1706875021image_2024-02-02_172641169.png', 'awsome', '2024-02-02 11:57:01'),
(39, 26, '1706875508image_2024-02-02_173447663.png', 'aww', '2024-02-02 12:05:09'),
(40, 26, '1706875523image_2024-02-02_173507761.png', '', '2024-02-02 12:05:23'),
(41, 26, '1706875636image_2024-02-02_173700609.png', '', '2024-02-02 12:07:16'),
(42, 27, '1706876159image_2024-02-02_174538892.png', '', '2024-02-02 12:15:59'),
(43, 27, '1706876228image_2024-02-02_174650570.png', '', '2024-02-02 12:17:08'),
(44, 27, '1706876267image_2024-02-02_174715059.png', 'buy now ->', '2024-02-02 12:17:48'),
(45, 28, '1706876570image_2024-02-02_175224139.png', 'kr$na', '2024-02-02 12:22:50'),
(46, 28, '1706876667image_2024-02-02_175404807.png', 'Karma', '2024-02-02 12:24:27'),
(47, 28, '1706876719image_2024-02-02_175456119.png', 'Rahhh...', '2024-02-02 12:25:20'),
(48, 29, '1706877045image_2024-02-02_175956267.png', 'Mantion your Car ', '2024-02-02 12:30:46'),
(49, 29, '1706877118image_2024-02-02_180140510.png', '', '2024-02-02 12:31:58'),
(50, 29, '1706877184image_2024-02-02_180242982.png', 'black <3', '2024-02-02 12:33:04'),
(51, 30, '1708783174ESPORT.jpg', 'New Tournament', '2024-02-24 13:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `rememberme_tokens`
--

CREATE TABLE `rememberme_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expiration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rememberme_tokens`
--

INSERT INTO `rememberme_tokens` (`id`, `user_id`, `token`, `expiration`) VALUES
(13, 31, 'f7dcfc16d865247f088f628a5f01622238663b6703b83ebdbc2c579ea810d66d', '2024-04-18'),
(14, 32, 'b3bbbca54672fdb407bbe146963445b5483dfd8b6d633201662fd5a3967a4acf', '2024-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(200) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ac_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=not verified,1=active,2=blocked',
  `blue_tick` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `gender`, `email`, `username`, `password`, `profile_pic`, `created_at`, `updated_at`, `ac_status`, `blue_tick`) VALUES
(21, 'Team', 'Nike', 1, 'nike@gmail.com', 'nike', 'e10adc3949ba59abbe56e057f20f883e', '1706871777imagess.png', '2024-02-02 10:59:50', '2024-03-05 08:39:25', 1, 0),
(22, 'Krafton', 'Mobile', 0, 'krafton@gmail.com', 'krafton', 'e10adc3949ba59abbe56e057f20f883e', '1706872619image_2024-02-02_164644799.png', '2024-02-02 11:14:38', '2024-03-19 05:45:51', 1, 0),
(23, 'Daily', 'quotes', 0, 'quatos@gmail.com', 'quotes', 'e10adc3949ba59abbe56e057f20f883e', '1706873415image_2024-02-02_165952492.png', '2024-02-02 11:27:28', '2024-03-05 08:39:26', 1, 0),
(24, 'intel', 'official', 1, 'intel@gmail.com', 'intel', 'e10adc3949ba59abbe56e057f20f883e', '1706874220image_2024-02-02_171325720.png', '2024-02-02 11:41:49', '2024-03-05 08:39:27', 1, 0),
(25, 'black ', 'pinks', 0, 'blackpink@gmail.com', 'black-pink', 'e10adc3949ba59abbe56e057f20f883e', '1706874782image_2024-02-02_172246277.png', '2024-02-02 11:48:01', '2024-03-05 08:39:27', 1, 0),
(26, 'Meme', 'Masala', 0, 'meme@gmail.com', 'memes', 'e10adc3949ba59abbe56e057f20f883e', '1706875287image_2024-02-02_173113289.png', '2024-02-02 11:59:05', '2024-03-05 08:39:28', 1, 0),
(27, 'gucci', 'brand', 0, 'gucci@gmail.com', 'gucci', 'e10adc3949ba59abbe56e057f20f883e', '1706875947image_2024-02-02_174213194.png', '2024-02-02 12:10:22', '2024-03-05 08:39:29', 1, 0),
(28, 'Kalamkaar', 'Lable', 0, 'kalamkaar@gmail.com', 'kalamkaar', 'e10adc3949ba59abbe56e057f20f883e', '1706876494image_2024-02-02_175119915.png', '2024-02-02 12:20:51', '2024-03-05 08:51:33', 1, 0),
(31, 'ayush', 'Solanki', 1, 'pidohen138@dovesilo.com', 'ayush', '25d55ad283aa400af464c76d713c07ad', 'default.png', '2024-03-19 05:43:11', '2024-03-19 05:44:20', 1, 0),
(32, 'hey', 'kirc', 1, 'ayushsolanki2901@gmail.com', 'heykirc', 'e10adc3949ba59abbe56e057f20f883e', 'default.png', '2024-03-19 05:46:53', '2024-03-19 05:51:04', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block_list`
--
ALTER TABLE `block_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block_list`
--
ALTER TABLE `block_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
