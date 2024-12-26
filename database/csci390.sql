-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 26, 2024 at 10:06 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csci390`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'Pending',
  `shipping_address` text,
  `shipping_country` varchar(100) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `price`, `total_price`, `order_date`, `status`, `shipping_address`, `shipping_country`, `shipping_city`) VALUES
(12, 12, 8, 1, 80.00, 80.00, '2024-12-26 10:04:19', 'completed', 'bierut', 'London', 'London'),
(11, 11, 13, 1, 90.00, 90.00, '2024-12-26 10:03:53', 'completed', 'bierut', 'London', 'London'),
(10, 11, 8, 1, 80.00, 80.00, '2024-12-17 10:03:53', 'completed', 'bierut', 'London', 'London'),
(9, 10, 14, 1, 95.00, 95.00, '2024-12-24 10:03:22', 'completed', 'bekaa', 'London', 'London'),
(8, 10, 4, 1, 50.00, 50.00, '2024-12-23 10:03:22', 'completed', 'bekaa', 'London', 'London'),
(13, 12, 18, 1, 85.00, 85.00, '2024-12-22 10:04:19', 'completed', 'bierut', 'London', 'London');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `category` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `collection` text NOT NULL,
  PRIMARY KEY (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `name`, `image`, `category`, `price`, `description`, `collection`) VALUES
(4, 'Amerat Al Hareb', '../uploads/IMG-20240504-WA0401.jpg', 'Women', 50, 'Asdaaf', 'Arab'),
(5, 'Bade\'e Al Oud', '../uploads/IMG-20240504-WA0417.jpg', 'Women', 55, 'Latafa', 'Arab'),
(6, 'Fakher Lattafa', '../uploads/IMG-20240504-WA0421.jpg', 'Women', 60, 'Lattafa', 'Arab'),
(7, 'Olympea', '../uploads/IMG-20240503-WA0337.jpg', 'Women', 70, 'Paco rabanne', 'France'),
(8, 'Invictus', '../uploads/IMG-20240503-WA0339.jpg', 'Women', 80, 'Paco rabanne', 'France'),
(9, 'Miss Dior', '../uploads/IMG-20240503-WA0326.jpg', 'Women', 90, 'Eau De Parfum', 'France'),
(10, 'Versace', '../uploads/IMG-20240504-WA0021.jpg', 'Women', 45, 'Bright crystal', 'Italian'),
(11, 'Versace', '../uploads/IMG-20240504-WA0022.jpg', 'Women', 60, 'Crystal Noir', 'Italian'),
(12, 'Versace', '../uploads/IMG-20240504-WA0020.jpg', 'Women', 65, 'Eros Pour Femme', 'Italian'),
(13, 'Fattan', '../uploads/IMG-20240504-WA0352.jpg', 'Men', 90, 'Opour Homme', 'arab'),
(14, 'Ana Al Abyad', '../uploads/IMG-20240504-WA0355.jpg', 'Men', 95, 'Lattafa', 'arab'),
(15, 'Hawas', '../uploads/IMG-20240504-WA0371.jpg', 'Men', 80, 'Original', 'arab'),
(16, 'Sauvage', '../uploads/IMG-20240503-WA0212.jpg', 'Men', 80, 'Dior', 'France'),
(17, 'Azzaro', '../uploads/IMG-20240503-WA0309.jpg', 'Men', 85, 'The most parfum wanted', 'France'),
(18, 'Azzaro', '../uploads/IMG-20240503-WA0310.jpg', 'Men', 85, 'Eau de parfum intense', 'France'),
(19, 'Valentino', '../uploads/IMG-20240503-WA0533.jpg', 'Men', 70, 'Born in roma', 'Italian'),
(20, 'Versace', '../uploads/IMG-20240503-WA0568.jpg', 'Men', 75, 'Dylan blue', 'Italian'),
(21, 'Dolice & Gabbana', '../uploads/IMG-20240503-WA0596.jpg', 'Men', 110, 'Ligh blue', 'Italian');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone_number` text NOT NULL,
  `role` text NOT NULL,
  `gender` text NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone_number`, `role`, `gender`, `password`, `created_at`) VALUES
(14, 'admin', 'admin@gmail.com', '03020504', 'admin', 'male', '$2y$10$/paLdCdrdNxNe8pyyuL6EeBTTkJPfKh8xQEzUQ14RsYmyLen50dHO', '2024-12-26 10:00:46'),
(13, 'user4', 'user4@gmail.com', '70673877', 'user', 'male', '$2y$10$NBz400aswWQk0w2pQkgOjetJn5.8le6c4aPdm9AO0bZvr79d0qQQC', '2024-12-23 10:00:24'),
(12, 'user3', 'user3@gmail.com', '70673877', 'user', 'male', '$2y$10$NGUX.n..QkJZqu44ZeKxtuUi6Wn7Jjyt5buM4.9iofheSEEc2UJYK', '2024-12-24 10:00:10'),
(11, 'user2', 'user2@gmail.com', '70673877', 'user', 'male', '$2y$10$UlNI4XgI7xS1zt7zQ/qLRO5.0aqHLLmrUytYYn9nmSz2frIEu7tRm', '2024-12-26 09:59:57'),
(10, 'user1', 'user1@gmail.com', '70673877', 'user', 'male', '$2y$10$FtnZ4szeXPQGc7tWMp/E0eYi3.dkh/Q3ww9y77tb5m7.RWOxWmEkm', '2024-12-26 09:59:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
