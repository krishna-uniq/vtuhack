-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2015 at 09:45 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `challenge3`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `articles` text,
  `category` varchar(200) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pic` text,
  `votes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `name`, `articles`, `category`, `user_name`, `user_pic`, `votes`) VALUES
(7, 'inajs', 'injanjnjn		', 'Import Questions', 'injas velur', 'https://lh6.googleusercontent.com/-N1k670SlC7c/AAAAAAAAAAI/AAAAAAAAA0s/jIYe9asL3eA/photo.jpg', 1),
(8, 'kjkjkj', 'kjkjjlllkj		', 'Import Questions', 'injas velur', 'https://lh6.googleusercontent.com/-N1k670SlC7c/AAAAAAAAAAI/AAAAAAAAA0s/jIYe9asL3eA/photo.jpg', 1),
(9, 'kjhhklh', 'jgyjjhbn		', 'Import Questions', 'injas velur', 'https://lh6.googleusercontent.com/-N1k670SlC7c/AAAAAAAAAAI/AAAAAAAAA0s/jIYe9asL3eA/photo.jpg', 3),
(10, '66565', '7698709mbm,		', 'Concepts In Chapters', 'injas velur', 'https://lh6.googleusercontent.com/-N1k670SlC7c/AAAAAAAAAAI/AAAAAAAAA0s/jIYe9asL3eA/photo.jpg', 0),
(11, 'kjkjkj', 'fgvbnm,		', 'Concepts In Chapters', 'Injas Vellur', 'https://graph.facebook.com/1032464806764743/picture', 0),
(12, 'injas article', 'this is first moderator review', 'Concepts In Chapters', '', NULL, 5),
(13, 'injas article', 'this is first moderator review', 'Concepts In Chapters', '', NULL, 5),
(14, 'kjkjkj', 'yjhjh kjhkj hjkhkjhjkh jhjhjkhj hjkhjkhkj hkjhjkhkjh kjhjhk hkjhkh kjhjkhk hjkhjkh jhjkhkj hkjh hjkh jkhj hj jh		', 'Concepts In Chapters', '', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `google_users`
--

CREATE TABLE IF NOT EXISTS `google_users` (
  `google_id` decimal(21,0) NOT NULL,
  `google_name` varchar(60) NOT NULL,
  `google_email` varchar(60) NOT NULL,
  `google_link` varchar(60) NOT NULL,
  `google_picture_link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_type` int(11) DEFAULT '0'
  `college` varchar(50) DEFAULT NULL;
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `user_password`, `user_type`,`college`) VALUES
(1, 1234,'Suyash Katoch','moderator1',0,'PES INSTITUTE OF TECHNOLOGY');
(2, 2234,'Injas MTP','moderator2',0,'H.M.S INSTITUTE OF TECHNOLOGY');
(3, 3234,'Deepankar Sharma','moderator3',0,'ACHARAYA INSTITUTE OF TECHNOLOGY');
(4, 4234,'Krishna Bhandari','moderator4',0,'DAYANANDA SAGAR COLLEGE OF ENGINEERING');
(5, 5234,'Mahesh Dhugana','moderator5',0,'M.S.RAMAIAH INSTITUTE OF TECHNIOLOGY');

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `voted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `article_id`, `user_id`, `voted`) VALUES
(1, 7, 1234, 1),
(2, 8, 1234, 1);

-- Table structure for table `colleges`
--

CREATE TABLE IF NOT EXISTS `colleges` (
  `college_name` varchar(50)
  );
--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`college_name`) VALUES
('H.M.S Institute Of Technology');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_users`
--
ALTER TABLE `google_users`
  ADD PRIMARY KEY (`google_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
