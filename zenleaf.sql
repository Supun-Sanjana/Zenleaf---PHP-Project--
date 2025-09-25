-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 12:22 PM
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
-- Database: `zenleaf`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_reg`
--

CREATE TABLE `business_reg` (
  `id` int(5) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `b_name` varchar(200) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `p_number` varchar(15) NOT NULL,
  `b_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_reg`
--

INSERT INTO `business_reg` (`id`, `user_id`, `b_name`, `b_address`, `full_name`, `email`, `p_number`, `b_certificate`) VALUES
(5, 'C73001', 't', 'fg', 'fgh', 's@gmail.com', 'fh', '/uploads/business_files/1758793333_itchi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `categories` varchar(250) NOT NULL,
  `discription` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `user_id`, `product_name`, `categories`, `discription`, `price`, `image`, `qty`, `approve`) VALUES
(5, 'P73854', 'C89748', 'test', 'flowering,miniature', 'fg', 12.00, '1758779038_Flowering_Bonsai_1.png', 100, 1),
(6, 'P90695', 'C73001', 'test 2', 'flowering,miniature', 'ergdf', 12.00, '1758784784_indor_bonzai_2.png', 12, 1),
(7, 'P83985', 'C73001', 'fof', 'indoor,flowering,miniature,accessories', 'dffv', 122.00, '1758795646_hero.png', 1212, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'customer',
  `approve` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `first_name`, `last_name`, `user_name`, `email`, `password`, `type`, `approve`, `image`) VALUES
(2, 'C37129', 'zoro', 'fd', 'gdfg', 'z@gmail.com', '$2y$10$ee29V25XF0UOXd205f9z4.Esi5AUarJoEVmfVhfoAtmrZ1TfcypVS', 'supplier', 1, '../../../public/uploads/1758692931_team6-free-img.png'),
(3, 'C73001', 'admin', 'zen', 'Test', 'admin@gmail.com', '$2a$12$iw38UId1b7lv9R48Xk1eQu7TeaEOCoOW10bFPIiEpoLcgbncSZjF.', 'admin', 0, '../../../public/uploads/1758694265_team6-free-img.png'),
(5, 'C74334', 'fd', 'gdg', 'fg', 's@gmail.com', '$2y$10$YslJMA/EYOZkJ0SXVRP1sOSO2tkSb2B.KhWaIjJDeDWUTIPxfPTay', 'supplier', 1, '1758704079_itchi.jpg'),
(6, 'C89748', 'rthy', 'try', 'rty', 'a@gmail.com', '$2y$10$VV7xq/UhqWiZClJYLytmH.HiHHlzGF/bDzk8I6r2gfnWqf8Sh2alK', 'customer', 0, '1758704436_img5.jpg'),
(7, 'S63676', 'zoro', 'dfg', 'dfgdfg', 'ab@gmail.com', '$2y$10$LWJsv1DG1AsRd1GqKjMjnuDqIAfb3vYmbl1ASKRiQUzE1eDMmC4ki', 'supplier', 0, '1758790470_img5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_reg`
--
ALTER TABLE `business_reg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_reg`
--
ALTER TABLE `business_reg`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_reg`
--
ALTER TABLE `business_reg`
  ADD CONSTRAINT `business_reg_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
