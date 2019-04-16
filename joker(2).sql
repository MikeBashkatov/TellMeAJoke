-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2019 at 01:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joker`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`inClass`@`localhost` PROCEDURE `approveJoke` (IN `jokeid` INT(11))  NO SQL
update jokes
set visible = 1 where id = jokeid$$

CREATE DEFINER=`inClass`@`localhost` PROCEDURE `deleteJoke` (IN `jokeid` INT(11))  NO SQL
delete from jokes where id = jokeid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllUsers` ()  NO SQL
Select * from users$$

CREATE DEFINER=`inClass`@`localhost` PROCEDURE `getJokeDetails` (IN `joke_id` INT(11))  NO SQL
select * from jokes where id = joke_id$$

CREATE DEFINER=`inClass`@`localhost` PROCEDURE `getJokes` (IN `jokeid` INT(11))  NO SQL
select * from jokes where id = jokeid$$

CREATE DEFINER=`inClass`@`localhost` PROCEDURE `getJokesForApproval` ()  NO SQL
select * from jokes where visible = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserDetails` (IN `id` INT(11))  NO SQL
select * from users where users.id = id$$

CREATE DEFINER=`inClass`@`localhost` PROCEDURE `insertJoke` (IN `category_id` INT(11), IN `joke_text` TEXT, IN `teaser` VARCHAR(150), IN `title` VARCHAR(90), IN `user_id` INT(11), IN `visible` INT(1))  NO SQL
insert into jokes (category_id, joke_text, teaser, title, user_id, visible) values (category_id, 'joke_text', 'teaser', 'title', user_id, visible)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
-- Creation: Feb 19, 2019 at 03:11 PM
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `categories`:
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`) VALUES
(1, 'Religion', '2019-02-19 15:14:08'),
(2, 'Relationships', '2019-02-19 15:16:21'),
(3, 'Work', '2019-02-19 15:16:41'),
(4, 'School', '2019-02-19 15:16:54'),
(5, 'Misc', '2019-02-19 15:17:06'),
(6, 'Pets', '2019-02-19 15:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `jokes`
--
-- Creation: Feb 19, 2019 at 03:11 PM
--

CREATE TABLE `jokes` (
  `id` int(11) NOT NULL,
  `title` varchar(90) NOT NULL,
  `teaser` varchar(150) NOT NULL,
  `joke_text` text NOT NULL,
  `visible` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `jokes`:
--   `category_id`
--       `categories` -> `id`
--   `user_id`
--       `users` -> `id`
--

--
-- Dumping data for table `jokes`
--

INSERT INTO `jokes` (`id`, `title`, `teaser`, `joke_text`, `visible`, `created_at`, `user_id`, `category_id`) VALUES
(2, 'R.I.P.', 'When I was a young minister, a funeral director asked me to ...', 'When I was a young minister, a funeral director asked me to hold a grave side service for a homeless man with no family or friends. The funeral was to be at a cemetery way out in the country. This was a new cemetery and this man was the first to be laid to rest there.\r\n\r\nI was not familiar with the area and became lost. Being a typical man, of course, I did not ask for directions. I finally found the cemetery about an hour late. The back hoe was there and the crew was eating their lunch. The hearse was nowhere to be seen.\r\n\r\nI apologized to the workers for being late. As I looked into the open grave, I saw the vault lid already in place. I told the workers I would not keep them long, but that this was the proper thing to do. The workers, still eating their lunch, gathered around the opening.\r\n\r\nI was young and enthusiastic and poured out my heart and soul as I preached. The workers joined in with, \"Praise the Lord,\" \"Amen,\" and \"Glory!\" I got so into the service that I preached and preached and preached, from Genesis to The Revelation.\r\n\r\nWhen the service was over, I said a prayer and walked to my car. As I opened the door, I heard one of the workers say, \"I never saw anything like that before and I\'ve been putting in septic systems for twenty years!', 1, '2019-02-19 15:25:01', 1, 1),
(3, 'Bedside Manners', 'Susie\'s husband had been slipping in and out of a coma for several months...', 'Susie\'s husband had been slipping in and out of a coma for several months. Things looked grim, but she was by his bedside every single day. One day as he slipped back into consciousness, he motioned for her to come close to him. She pulled the chair close to the bed and leaned her ear close to be able to hear him.\r\n\r\n\"You know\" he whispered, his eyes filling with tears, \"you have been with me through all the bad times. When I got fired, you stuck right beside me. When my business went under, there you were. When we lost the house, you were there. When I got shot, you stuck with me. When my health started failing, you were still by my side. And you know what?\"\r\n\r\n\" What, dear? \" she asked gently, smiling to herself ... , \"I think youre bad luck.', 1, '2019-02-19 15:26:11', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Feb 23, 2019 at 03:16 AM
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `type` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `created_at`, `last_login`, `avatar`, `type`) VALUES
(1, 'Bonnie', 'Ryan', 'bonnie', '$2y$10$XJ4ZGzkjaMT/zwqTIBP.Re4W9haNBJPUDAajMnuWp.ah/a/EbNww6', 'bonnie.c.ryan@gmail.com', '2010-01-13 18:44:37', '2010-01-13 14:45:37', 'uploads/avatar3.jpg', 'admin'),
(2, 'Normand', 'Ward', 'norm', '$2y$10$XJ4ZGzkjaMT/zwqTIBP.Re4W9haNBJPUDAajMnuWp.ah/a/EbNww6', 'norm@gmail.com', '2010-01-13 18:44:37', NULL, 'uploads/avatar1.jpg', 'user'),
(3, 'hey', 'ha', 'heya', '$2y$10$XJ4ZGzkjaMT/zwqTIBP.Re4W9haNBJPUDAajMnuWp.ah/a/EbNww6', 'hi@gmail.com', '2010-01-13 18:44:37', NULL, NULL, 'user'),
(6, 'Olena', 'Y', 'olena', '$2y$10$4hLWLzxWcao.rAwiZ.p2au/VzKG9EyzHEylsWt3Mq53E5b0X0QKyq', 'olena@gmail.com', '2019-03-24 21:21:03', NULL, 'uploads/avatar2.jpg', 'admin'),
(7, 'Mike', 'B', 'mike', '$2y$10$3LBAxTPIpGpBRR1rzB7sL.kl./.d9b1v.DRyB3JDJT6LsWLT53EQK', 'mike@gmail.com', '2019-03-24 21:21:43', NULL, 'uploads/article2.jpg', 'user'),
(9, 'first name', 'last name', 'username', '$2y$10$yTnS.YAzSBJL2pVlU6gk3uwdb9hl8JASg74lEBp.popFnAX3jOlWi', 'test@gmail.com', '2019-03-24 23:56:10', NULL, 'uploads/article.jpg', 'admin'),
(10, 'first name', 'last name', 'username', '$2y$10$9RRuAiexbG805AJ64Z8cUefQZTD9W4zzvqLqB8kabgyF7eE1PKyZ6', 'test@gmail.com', '2019-03-24 23:57:58', NULL, 'uploads/article.jpg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jokes`
--
ALTER TABLE `jokes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Joke_Category` (`category_id`),
  ADD KEY `FK_Joke_User` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`password`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jokes`
--
ALTER TABLE `jokes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jokes`
--
ALTER TABLE `jokes`
  ADD CONSTRAINT `FK_Joke_Category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_Joke_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table categories
--

--
-- Metadata for table jokes
--

--
-- Metadata for table users
--

--
-- Metadata for database joker
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
