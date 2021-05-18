-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 05:25 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ucstickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `AssetName` varchar(255) NOT NULL,
  `AssetType` varchar(255) NOT NULL,
  `AssetRoom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `AssetName`, `AssetType`, `AssetRoom`) VALUES
(3, '16546541', 'Whiteboard', '125GF'),
(4, '196823784', 'Computer', '205GF'),
(5, '16546541', 'Mouse', '125GF'),
(6, '196823784', 'Computer', '205GF'),
(7, '16546541', 'Mouse', '125GF'),
(8, '196823784', 'Computer', '205GF'),
(9, '16546541', 'Mouse', '125GF'),
(10, '196823784', 'Computer', '205GF');

-- --------------------------------------------------------

--
-- Table structure for table `assetsaffected`
--

CREATE TABLE `assetsaffected` (
  `id` int(11) NOT NULL,
  `assetid` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assetsaffected`
--

INSERT INTO `assetsaffected` (`id`, `assetid`, `ticketid`) VALUES
(148, 6, 397),
(149, 7, 397),
(150, 8, 397),
(156, 7, 0),
(157, 8, 0),
(158, 3, 0),
(159, 4, 0),
(160, 3, 0),
(161, 4, 0),
(162, 3, 0),
(163, 4, 0),
(166, 3, 401),
(167, 4, 401),
(171, 5, 398),
(172, 6, 398),
(173, 3, 396),
(174, 4, 396),
(175, 5, 396),
(176, 4, 400),
(177, 3, 400),
(178, 5, 400),
(179, 10, 400),
(211, 3, 419),
(212, 3, 424),
(213, 4, 424);

-- --------------------------------------------------------

--
-- Table structure for table `campusassigned`
--

CREATE TABLE `campusassigned` (
  `id` int(11) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `ticketid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campusassigned`
--

INSERT INTO `campusassigned` (`id`, `campus`, `ticketid`) VALUES
(2, 'Taunton', 377),
(3, 'Taunton', 378),
(4, 'Taunton', 379),
(5, 'Taunton', 383),
(6, 'Bridgwater', 383),
(10, 'Taunton', 384),
(11, 'Bridgwater', 384),
(12, 'Taunton', 385),
(13, 'Taunton', 387),
(15, 'Bridgwater', 388),
(16, 'Taunton', 389),
(17, 'Bridgwater', 390),
(18, 'Taunton', 391),
(19, 'Bridgwater', 392),
(22, 'Taunton', 393),
(23, 'Taunton', 394),
(25, 'Bridgwater', 397),
(30, 'Bridgwater', 0),
(31, 'Taunton', 0),
(33, 'Taunton', 401),
(35, 'Bridgwater', 399),
(36, 'Taunton', 398),
(37, 'Taunton', 396),
(38, 'Taunton', 400),
(39, 'Taunton', 412),
(40, 'Taunton', 413),
(41, 'Taunton', 414),
(42, 'Taunton', 415),
(43, 'Taunton', 416),
(44, 'Taunton', 417),
(45, 'Bridgwater', 418),
(48, 'Taunton', 419),
(49, 'Taunton', 422),
(50, 'Taunton', 424);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `Staffid` int(11) NOT NULL,
  `ticketid` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `Staffid`, `ticketid`, `body`, `created_at`, `type`) VALUES
(22, 15, '337', 'Issue is resolved', '2021-05-05 21:15:54', 'resolution'),
(24, 15, '334', 'Bye Karina', '2021-05-05 21:16:45', 'resolution'),
(33, 15, '15', 'Donec at mauris et ipsum faucibus luctus sed eu magna.', '2021-05-10 15:20:26', 'resolution'),
(34, 15, '15', 'Donec at mauris et ipsum faucibus luctus sed eu magna.', '2021-05-10 15:20:41', 'resolution'),
(35, 15, '', 'Donec at mauris et ipsum faucibus luctus sed eu magna.', '2021-05-10 15:22:59', 'comment'),
(36, 15, '15', 'Donec at mauris et ipsum faucibus luctus sed eu magna.', '2021-05-10 15:23:04', 'comment'),
(37, 15, '397', 'Donec at mauris et ipsum faucibus luctus sed eu magna.', '2021-05-10 15:27:05', 'resolution'),
(40, 15, '401', 'Donec at mauris et ipsum faucibus luctus sed eu magna.', '2021-05-10 19:07:03', 'resolution'),
(42, 15, '400', 'Test Resolution', '2021-05-12 15:19:13', 'resolution'),
(43, 15, '399', 'Test comment to delete', '2021-05-12 15:25:21', 'comment');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `raisedBy` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Open',
  `body` mediumtext NOT NULL,
  `ticketType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`created_at`, `id`, `user_id`, `raisedBy`, `title`, `status`, `body`, `ticketType`) VALUES
('2021-05-10 12:51:14', 396, 15, 'David', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Test', 'Open', 'Integer fermentum nisi in nulla facilisis, sed efficitur quam mattis. Maecenas dignissim tellus nisl, at dapibus nibh vestibulum vel. Duis at justo dolor. Nullam ante justo, ornare sed magna in, faucibus finibus turpis. ', 'Technical'),
('2021-05-10 12:52:54', 397, 15, 'Susan', 'Sed rutrum laoreet quam, a placerat sapien scelerisque vestibulum.', 'Closed', 'Quisque id mattis sapien, ac dapibus nunc. Quisque mollis eros a sapien rhoncus cursus. Integer eu sapien orci. Suspendisse vel suscipit mi, sit amet rutrum justo. Nulla pretium nibh ut libero fringilla, id dapibus mi suscipit. ', 'Technical'),
('2021-05-10 13:11:57', 398, 18, 'Louise', 'Maecenas facilisis libero et felis aliquam porta. Test', 'Open', 'Aenean fermentum neque pulvinar arcu pellentesque condimentum. Cras laoreet, neque ac convallis maximus, turpis dolor aliquam risus, vel tincidunt nibh enim ut lectus. Sed finibus vel mauris ac aliquam. Vestibulum risus tortor, fringilla at sodales nec, accumsan id turpis. ', 'Technical'),
('2021-05-10 13:12:24', 399, 18, 'Craig', 'Praesent blandit mollis elit at gravida.', 'Open', 'Duis ornare arcu turpis, non iaculis ante porttitor non. Etiam mattis sapien vel arcu semper, vitae ultricies tortor malesuada. Suspendisse potenti.  test', 'General'),
('2021-05-10 13:18:09', 400, 18, 'Tom', 'Donec feugiat ', 'Closed', 'Aenean id orci sed felis congue facilisis. Aenean maximus, tellus nec consectetur congue, eros odio facilisis mi, quis consectetur diam nisl non elit.', 'Technical'),
('2021-05-10 13:20:03', 401, 18, 'Charlie', 'Sed mi augue', 'Closed', 'inibus sit amet vulputate quis, hendrerit eu purus. Quisque magna ligula, condimentum eu convallis non, posuere eu ipsum.', 'Technical'),
('2021-05-11 16:49:01', 419, 15, 'Test', 'Test Edit', 'Open', 'Test Edit', 'Technical'),
('2021-05-11 16:55:08', 420, 15, 'Test2', 'Test2', 'Open', 'Test2', 'Technical'),
('2021-05-11 17:02:43', 422, 15, 'Test3 Edit', 'Test3 Edit', 'Open', 'Test3 Edit', 'General'),
('2021-05-17 15:28:33', 424, 25, 'Test2', 'Testdelete', 'Open', 'Test delete', 'Technical');

-- --------------------------------------------------------

--
-- Table structure for table `ticketsassigned`
--

CREATE TABLE `ticketsassigned` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticketsassigned`
--

INSERT INTO `ticketsassigned` (`id`, `ticketid`, `userid`) VALUES
(1, 360, 3),
(2, 360, 4),
(3, 361, 3),
(4, 373, 3),
(5, 361, 15),
(6, 361, 15),
(7, 377, 15),
(8, 378, 15),
(9, 379, 15),
(10, 380, 15),
(11, 382, 15),
(12, 383, 15),
(13, 383, 16),
(17, 384, 16),
(18, 385, 17),
(19, 387, 15),
(22, 388, 16),
(23, 389, 15),
(24, 390, 16),
(25, 391, 15),
(26, 392, 15),
(28, 393, 15),
(29, 394, 15),
(30, 395, 15),
(32, 397, 16),
(37, 0, 15),
(38, 0, 15),
(40, 401, 15),
(42, 399, 15),
(43, 398, 17),
(44, 396, 15),
(45, 400, 15),
(46, 412, 16),
(47, 413, 15),
(48, 414, 15),
(49, 415, 21),
(54, 421, 15),
(56, 419, 15),
(57, 422, 15),
(58, 424, 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roles` varchar(255) NOT NULL DEFAULT 'Staff',
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roles`, `FirstName`, `LastName`, `email`, `department`, `password`) VALUES
(15, 'Admin', 'Ashley', 'Walker', 'Test@Test.com', 'Home', '0cc175b9c0f1b6a831c399e269772661'),
(16, 'Staff', 'David', 'Frenchy', 'David@test.com', 'Home', '0cc175b9c0f1b6a831c399e269772661'),
(25, 'Staff', 'Test', 'Test', 'Test2@test.com', 'Test', '0cc175b9c0f1b6a831c399e269772661'),
(26, 'Admin', 'Ashley2', 'Walker2', 'Test3@Test.com', 'Home', '0cc175b9c0f1b6a831c399e269772661');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetsaffected`
--
ALTER TABLE `assetsaffected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campusassigned`
--
ALTER TABLE `campusassigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketsassigned`
--
ALTER TABLE `ticketsassigned`
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
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `assetsaffected`
--
ALTER TABLE `assetsaffected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `campusassigned`
--
ALTER TABLE `campusassigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `ticketsassigned`
--
ALTER TABLE `ticketsassigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
