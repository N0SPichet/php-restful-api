-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2019 at 10:07 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'tect', '2019-09-22 17:31:32'),
(2, 'animal', '2019-09-22 17:31:41'),
(3, 'space', '2019-09-22 17:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `body`, `author`, `created_at`) VALUES
(2, 1, 'Generating fancy text', 'So perhaps, you\'ve generated some fancy text, and you\'re content that you can now copy and paste your fancy text in the comments section of funny cat videos, but perhaps you\'re wondering how it\'s even possible to change the font of your text? Is it some sort of hack? Are you copying and pasting an actual font?', 'https://lingojam.com/FancyTextGenerator', '2019-09-22 14:15:14'),
(3, 1, 'my test post', 'my test body', 'pichet', '2019-09-22 17:30:41'),
(4, 2, 'my test post 2', 'my test body 2', 'alex', '2019-09-22 17:32:23'),
(5, 2, 'my test post update', 'my test body 2', 'alex', '2019-09-22 17:37:16'),
(6, 2, 'my test post update', 'my test body 2', 'alex', '2019-09-22 17:37:21'),
(7, 2, 'my test post update', 'my test body 2', 'alex', '2019-09-22 17:37:57'),
(10, 1, 'Test from XMLHttpRequest', 'Test from XMLHttpRequest body', 'I am', '2019-09-27 14:16:29'),
(21, 1, 'Test from XMLHttpRequest', 'Test from XMLHttpRequest body', 'I am', '2019-09-27 14:47:32'),
(22, 2, 'Test from fetch', 'Test from fetch body', 'I am fetch', '2019-09-27 14:47:57'),
(23, 2, 'Test from fetch', 'Test from fetch body', 'I am fetch', '2019-09-27 15:00:16'),
(24, 2, 'Test from axios', 'Test from axios body', 'I am axios', '2019-09-27 15:06:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
