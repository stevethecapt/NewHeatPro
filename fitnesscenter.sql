-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 09:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitnesscenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `created_at`) VALUES
(5, 'steve kevins', 'stevekevins', 'stevekevins@gmail.com', '$2y$10$r.Yu33gXcSh/KQ5Hu6d5hePDnahaP5FkpRdNm7qtDyXr99CipclZe', '2025-04-15 11:32:46'),
(6, 'steven sumendap', 'stevensmndp', 'stvenkvn@gmail.com', '$2y$10$u8D9tyT.6rDSD3Yu06nME.YitcHDk0zuiPDottbQfum2cPmwLj./S', '2025-04-15 15:09:22'),
(8, 'steve kevin sumendap', 'kevinsteven', 'stvnsdp@gmail.com', '$2y$10$PwHukZzvQT6lz4hbNlW60ejmv89JG3BzpJpqPSdhMJZ96uVzurLlK', '2025-04-15 15:11:31'),
(10, 'kevin steven', 'kevins', 'kevin@gmail.com', '$2y$10$m2YH6RbWSMNbtetj.wEYkeLWz6gzRLBxcHjVHkTWAuuF2fHfBbAEy', '2025-04-15 15:16:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
