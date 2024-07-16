-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 01:38 PM
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
-- Database: `leaselab`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `product_id` int(6) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_name`, `email`, `phone_number`, `product_id`, `product_name`, `category`, `from_date`, `to_date`, `amount`, `description`, `image`) VALUES
(22, 'Sunny', 'manomannem@gmail.com', '8500787409', 879324, 'GoPro Hero9', 'Camera', '05/06/2024', '08/06/2024', '120/day', 'Works in water', 'IMG-66610d1e0ede29.88835816.png'),
(25, 'Raviteja', 'ravi2005.madduri@gmail.com', '7093587173', 854139, 'Guitar', 'Musical Instrument', '11/07/2024', '15/07/2024', '150/day', 'Best Guitar in the area', 'IMG-668f690a48f6d4.01497374.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `userbuying`
--

CREATE TABLE `userbuying` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `product_id` int(6) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `taker_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userbuying`
--

INSERT INTO `userbuying` (`id`, `email`, `phone_number`, `product_id`, `product_name`, `category`, `from_date`, `to_date`, `amount`, `description`, `image`, `taker_email`) VALUES
(7, 'manomannem@gmail.com', 2147483647, 0, 'GoPro Hero9', 'Camera', '05/06/2024', '08/06/2024', '120/day', 'Works in water', 'IMG-66610d1e0ede29.88835816.png', 'manomannem@gmail.com'),
(8, 'manomannem@gmail.com', 2147483647, 0, 'GoPro Hero9', 'Camera', '05/06/2024', '08/06/2024', '120/day', 'Works in water', 'IMG-66610d1e0ede29.88835816.png', 'manomannem@gmail.com'),
(9, 'manomannem@gmail.com', 2147483647, 0, 'DSLR 1500D', 'Camera', '11/07/2024', '15/07/2024', '150/day', 'Comes with long lens and short lens only', 'IMG-668f31775c11a3.83205153.jpg', 'manomannem@gmail.com'),
(10, 'ravi2005.madduri@gmail.com', 2147483647, 0, 'Guitar', 'Musical Instrument', '11/07/2024', '15/07/2024', '150/day', 'Best Guitar in the area', 'IMG-668f690a48f6d4.01497374.jpeg', 'satyaramsl72@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `otp`, `otp_expiry`) VALUES
(8, 'sunnymanobharath@gmail.com', '$2y$10$kSbpGajdqbbDOp.TBLZKWOh/T4Fdm7nl1Jed7qz1kxLoRtEgNLqb2', '285481', '2024-06-06 02:39:38'),
(9, 'manomannem@gmail.com', '$2y$10$Ip2RD9Q0Y8G71I8SwvaJ.OPhyqXUKkCjTSMrXOVlxJxh/WS.lOYiK', '594594', '2024-07-11 03:10:37'),
(10, 'ravi.2005@gmail.com', '$2y$10$zOY3It8rrfFb3rZQSpqb9OoLJWTQR/ImogqovFjgy9BKxNUW.cppi', NULL, NULL),
(11, 'ravi2005.madduri@gmail.com', '$2y$10$zvSb1wpCqOvQfbmgXvVH.upVaW/rT1yJRTGiDV83jJbUULUF3CeBm', '384309', '2024-07-11 07:56:26'),
(12, 'satyaramsl72@gmail.com', '$2y$10$lABTlUmi/RMyCJCg1rLMh.w7tFAYxiSMSTF6fviWpGdlXWqz6lgG6', '912734', '2024-07-11 07:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `userselling`
--

CREATE TABLE `userselling` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `product_id` int(6) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userselling`
--

INSERT INTO `userselling` (`id`, `user_name`, `email`, `phone_number`, `product_id`, `product_name`, `category`, `from_date`, `to_date`, `amount`, `description`, `image`) VALUES
(26, 'Sunny', 'manomannem@gmail.com', '8500787409', 879324, 'GoPro Hero9', 'Camera', '05/06/2024', '08/06/2024', '120/day', 'Works in water', 'IMG-66610d1e0ede29.88835816.png'),
(29, 'Raviteja', 'ravi2005.madduri@gmail.com', '7093587173', 854139, 'Guitar', 'Musical Instrument', '11/07/2024', '15/07/2024', '150/day', 'Best Guitar in the area', 'IMG-668f690a48f6d4.01497374.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `userbuying`
--
ALTER TABLE `userbuying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userselling`
--
ALTER TABLE `userselling`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userbuying`
--
ALTER TABLE `userbuying`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userselling`
--
ALTER TABLE `userselling`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
