-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2020 at 08:46 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nizami`
--

-- --------------------------------------------------------

--
-- Table structure for table `addon`
--

DROP TABLE IF EXISTS `addon`;
CREATE TABLE IF NOT EXISTS `addon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(100) NOT NULL,
  `addon` varchar(500) NOT NULL,
  `price` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addon`
--

INSERT INTO `addon` (`id`, `product_id`, `addon`, `price`) VALUES
(1, '1', 'wRedbull', '27');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `area` varchar(100) NOT NULL,
  `city` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `banner_id` int(10) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `sort_order` int(10) NOT NULL,
  `head` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL,
  `active` int(10) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `banner_name`, `image`, `sort_order`, `head`, `link`, `active`) VALUES
(1, 'slide1', 'assets/images/banner_image/5f79d4a97d5a9.jpg', 1, '', '#', 1),
(2, 'Slide2', 'assets/images/banner_image/5f79d4be537c0.jpg', 2, '', '', 1),
(3, 'Slide3', 'assets/images/banner_image/5f7c296c79240.png', 3, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(225) NOT NULL,
  `blog_description` varchar(2550) NOT NULL,
  `blog_image` varchar(225) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_description`, `blog_image`, `created_on`) VALUES
(1, 'Indian Burger', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. ', 'assets/images/blog_image/5f7c342915a5b.png', '2020-10-05 15:24:07'),
(2, 'Lorem Ipsum', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. ', 'assets/images/blog_image/5f7c33f3d1c30.png', '2020-10-05 15:34:38'),
(3, 'Renaissance', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. ', 'assets/images/blog_image/5f7c33fc2f98d.png', '2020-10-05 15:35:21'),
(4, 'Finibus Bonorum et Malorum', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. ', 'assets/images/blog_image/5f7c340720481.png', '2020-10-05 15:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(100) NOT NULL,
  `cookie` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `active`) VALUES
(1, 'Burgers', 1),
(2, 'Wraps', 1),
(3, 'Pastas', 1),
(4, 'Cheese & chips with toppings', 1),
(5, 'Sandwiches', 1),
(6, 'Plates', 1),
(7, 'Beverages', 1),
(8, 'Nizami Quesadillas', 1),
(9, 'Nizami Grills', 1),
(10, 'Nizami Shawarma', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `checkout_time` varchar(100) NOT NULL,
  `checkout_date` date NOT NULL,
  `checkout_items` text NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `payment` enum('cash','card') NOT NULL,
  `status` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `building` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `bill_no` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `user_id`, `checkout_time`, `checkout_date`, `checkout_items`, `total_price`, `payment`, `status`, `name`, `email`, `phone`, `place`, `zone`, `street`, `building`, `address`, `bill_no`) VALUES
(1, 8, '13:33:14', '2020-11-05', '[{\"prod_id\":\"10\",\"prod_name\":\"Classic Beef Burger\",\"qty\":2,\"price\":10,\"image\":\"assets\\/images\\/product_image\\/5f7ecab19928a.png\"},{\"prod_id\":\"9\",\"prod_name\":\"BBQ Chicken Burger\",\"qty\":2,\"price\":15,\"image\":\"assets\\/images\\/product_image\\/5f7eca08026a4.png\"}]', '50', 'cash', '0', 'jincy', 'jincy@tfs.com', '77226543', 'Nashrullah Complex,Al Ghafiqi Street, Near Jaidah FlyOver', '10', '125', '14', 'Nashrullah Complex,Al Ghafiqi Street, Near Jaidah FlyOver', 'BILPR-2C2C');

-- --------------------------------------------------------

--
-- Table structure for table `chefs`
--

DROP TABLE IF EXISTS `chefs`;
CREATE TABLE IF NOT EXISTS `chefs` (
  `chef_id` int(11) NOT NULL AUTO_INCREMENT,
  `chef_name` varchar(225) NOT NULL,
  `chef_img` varchar(225) NOT NULL,
  `fb_link` varchar(225) NOT NULL,
  `insta_link` varchar(225) NOT NULL,
  `designation` varchar(225) NOT NULL,
  `active` varchar(225) NOT NULL,
  PRIMARY KEY (`chef_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chefs`
--

INSERT INTO `chefs` (`chef_id`, `chef_name`, `chef_img`, `fb_link`, `insta_link`, `designation`, `active`) VALUES
(2, 'Fred Macyard', 'assets/images/chefs_image/5f7af6f5efc35.png', '#', '#', 'Chef Master', '1'),
(4, 'Adam Billiard', 'assets/images/chefs_image/5f7afbca5fc0e.png', '#', '#', 'Chef Master', '1'),
(7, 'Justin Stuard', 'assets/images/chefs_image/5f7afd14bd4d5.png', '#', '#', 'Chef Master', '1'),
(8, 'xx', 'assets/images/chefs_image/5f7b00eb9bbf0.png', 'xx', 'xx', 'xx', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupss`
--

DROP TABLE IF EXISTS `groupss`;
CREATE TABLE IF NOT EXISTS `groupss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupss`
--

INSERT INTO `groupss` (`id`, `group_name`, `permission`) VALUES
(1, 'Super Administrator', 'a:56:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createStore\";i:9;s:11:\"updateStore\";i:10;s:9:\"viewStore\";i:11;s:11:\"deleteStore\";i:12;s:12:\"createBanner\";i:13;s:12:\"updateBanner\";i:14;s:10:\"viewBanner\";i:15;s:12:\"deleteBanner\";i:16;s:11:\"createTable\";i:17;s:11:\"updateTable\";i:18;s:9:\"viewTable\";i:19;s:11:\"deleteTable\";i:20;s:17:\"createReservation\";i:21;s:17:\"updateReservation\";i:22;s:15:\"viewReservation\";i:23;s:17:\"deleteReservation\";i:24;s:14:\"createCategory\";i:25;s:14:\"updateCategory\";i:26;s:12:\"viewCategory\";i:27;s:14:\"deleteCategory\";i:28;s:11:\"createChefs\";i:29;s:11:\"updateChefs\";i:30;s:9:\"viewChefs\";i:31;s:11:\"deleteChefs\";i:32;s:11:\"createBlogs\";i:33;s:11:\"updateBlogs\";i:34;s:9:\"viewBlogs\";i:35;s:11:\"deleteBlogs\";i:36;s:13:\"createProduct\";i:37;s:13:\"updateProduct\";i:38;s:11:\"viewProduct\";i:39;s:13:\"deleteProduct\";i:40;s:13:\"createGallery\";i:41;s:13:\"updateGallery\";i:42;s:11:\"viewGallery\";i:43;s:13:\"deleteGallery\";i:44;s:11:\"createOrder\";i:45;s:11:\"updateOrder\";i:46;s:9:\"viewOrder\";i:47;s:11:\"deleteOrder\";i:48;s:19:\"createTakeAwayOrder\";i:49;s:19:\"updateTakeAwayOrder\";i:50;s:17:\"viewTakeAwayOrder\";i:51;s:19:\"deleteTakeAwayOrder\";i:52;s:10:\"viewReport\";i:53;s:13:\"updateCompany\";i:54;s:11:\"viewProfile\";i:55;s:13:\"updateSetting\";}'),
(4, 'Members', 'a:9:{i:0;s:9:\"viewStore\";i:1;s:11:\"deleteStore\";i:2;s:9:\"viewTable\";i:3;s:11:\"deleteTable\";i:4;s:12:\"viewCategory\";i:5;s:11:\"viewProduct\";i:6;s:11:\"createOrder\";i:7;s:11:\"updateOrder\";i:8;s:9:\"viewOrder\";}'),
(5, 'Staff', 'a:10:{i:0;s:9:\"viewTable\";i:1;s:11:\"viewProduct\";i:2;s:11:\"createOrder\";i:3;s:11:\"updateOrder\";i:4;s:9:\"viewOrder\";i:5;s:11:\"viewProfile\";i:6;s:19:\"createTakeAwayOrder\";i:7;s:19:\"updateTakeAwayOrder\";i:8;s:17:\"viewTakeAwayOrder\";i:9;s:19:\"deleteTakeAwayOrder\";}'),
(6, 'Take Away Staff', 'a:4:{i:0;s:19:\"createTakeAwayOrder\";i:1;s:19:\"updateTakeAwayOrder\";i:2;s:17:\"viewTakeAwayOrder\";i:3;s:19:\"deleteTakeAwayOrder\";}');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_url` varchar(200) NOT NULL,
  `sort_order` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge_amount` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `paid_status` varchar(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge_amount`, `vat_charge_rate`, `vat_charge_amount`, `discount`, `net_amount`, `user_id`, `table_id`, `paid_status`, `store_id`) VALUES
(3, 'BILPR-2F3E', '1604487115', '55.00', '', '0', '', '0', '', '55.00', 1, 2, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `online_order_id` int(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `online_order_id`, `product_id`, `qty`, `rate`, `amount`) VALUES
(6, 3, 0, 26, '1', '22', '22.00'),
(7, 3, 0, 21, '1', '18', '18.00'),
(8, 3, 0, 24, '1', '15', '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

DROP TABLE IF EXISTS `order_table`;
CREATE TABLE IF NOT EXISTS `order_table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(100) NOT NULL,
  `capacity` int(10) NOT NULL,
  `reserv_date` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `reserv_time` varchar(50) NOT NULL,
  `table_no` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `customer_name`, `customer_phone`, `capacity`, `reserv_date`, `cust_email`, `reserv_time`, `table_no`, `status`) VALUES
(1, 'Aditi Singhal', '(222) 222-2222', 2, '10/08/2020', 'aditi@tradifyservices.com', '1', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` text NOT NULL,
  `store_id` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `active` int(11) NOT NULL,
  `arabic_name` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `store_id`, `name`, `price`, `description`, `image`, `active`, `arabic_name`) VALUES
(6, '[\"16\"]', '[\"1\"]', 'Arabic Shawarma', '20', '', 'assets/images/product_image/5f7ec7fb23abf.png', 1, ''),
(7, '[\"4\"]', '[\"1\"]', 'Meshroom Burger', '17', '', 'assets/images/product_image/5f7ec82120396.png', 1, ''),
(8, '[\"5\"]', '[\"1\"]', 'Chiken Barbeque Wrap', '15', '', 'assets/images/product_image/5f7ec91aa4628.png', 1, ''),
(9, '[\"4\"]', '[\"1\"]', 'BBQ Chicken Burger', '15', '', 'assets/images/product_image/5f7eca08026a4.png', 1, ''),
(10, '[\"1\"]', '[\"1\"]', 'Classic Beef Burger', '10', '', 'assets/images/product_image/5f7ecab19928a.png', 1, ''),
(11, '[\"1\"]', '[\"1\"]', 'Classic Chicken Burger', '10', '', 'assets/images/product_image/5f7ecb44246b9.png', 1, ''),
(12, '[\"5\"]', '[\"1\"]', 'Falafel Wrap', '5', '', 'assets/images/product_image/5f7ecc517487a.png', 1, ''),
(13, '[\"6\"]', '[\"1\"]', 'Egg Porota', '4', '', 'assets/images/product_image/5f7ecca7b37e1.png', 1, ''),
(14, '[\"1\"]', '[\"1\"]', 'Fillet Burger', '12', '', 'assets/images/product_image/5f7ecd13cf06a.png', 1, ''),
(15, '[\"5\"]', '[\"1\"]', 'Hash Brown Wrap', '12', '', 'assets/images/product_image/5f7ecd931937f.png', 1, ''),
(16, '[\"5\"]', '[\"1\"]', 'Hotdog Wrap', '12', '', 'assets/images/product_image/5f7ecddd3dbd0.png', 1, ''),
(17, '[\"4\"]', '[\"1\"]', 'Hybrid Burger', '18', '', 'assets/images/product_image/5f7ece7c428f8.png', 1, ''),
(18, '[\"6\"]', '[\"1\"]', 'Kheema Porota', '8', '', 'assets/images/product_image/5f7ecf01c4f51.png', 1, ''),
(19, '[\"4\"]', '[\"1\"]', 'Mega Zinger Burger', '18', '', 'assets/images/product_image/5f7ecf6e9c816.png', 1, ''),
(20, '[\"18\"]', '[\"1\"]', 'Mexican Quesadilla', '20', '', 'assets/images/product_image/5f7ecfcfde45c.png', 1, ''),
(21, '[\"5\"]', '[\"1\"]', 'Prawn Wrap', '18', '', 'assets/images/product_image/5f7ed06ed46cd.png', 1, 'راب الروبيان'),
(22, '[\"16\"]', '[\"1\"]', 'Shawarma Plate', '20', '', 'assets/images/product_image/5f7ed10888f53.png', 1, ''),
(23, '[\"13\"]', '[\"1\"]', 'Oreo Shake', '15', '', 'assets/images/product_image/5f7eeeb30f49c.png', 1, ''),
(24, '[\"13\"]', '[\"1\"]', 'Kitkat Shake', '15', '', 'assets/images/product_image/5f7eeece32b6c.png', 1, ''),
(25, '[\"21\"]', '[\"1\"]', 'Veg Pasta', '20', '', 'assets/images/product_image/5f7eef009eab5.png', 1, ''),
(26, '[\"15\"]', '[\"1\"]', 'Rose Lemonade', '22', '', 'assets/images/product_image/5f7ef27a86fbc.png', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `phone`, `address`, `password`) VALUES
(7, 'aditi', 'aditi@gmail.com', '23245535', '', '12345'),
(8, 'jincy', 'jincy@tfs.com', '77226543', '', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `capacity` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(1, 'Nizami', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `name`, `active`) VALUES
(1, 1, 'Fresh Handcrafted Classic Burgers', 1),
(2, 1, 'Nizami Premium Burger', 1),
(4, 1, 'Nizami Signature Burger', 1),
(5, 2, 'Nizami Wraps', 1),
(6, 2, 'Porata Wraps', 1),
(7, 5, 'Combo Samoon Sandwiches', 1),
(8, 5, 'NIZAMI Clubs Sandwiches', 1),
(9, 7, 'Natural Fresh Juice', 1),
(10, 7, 'Refreshing cold cofee', 1),
(11, 6, 'Hot Refreshing Coffee', 1),
(12, 7, 'Vitamin load Smoothies', 1),
(13, 7, 'Authentic Milk shake', 1),
(14, 7, 'Magic mojitos', 1),
(15, 7, 'Special Nizami Mojitos', 1),
(16, 10, 'Nizami Shawaramas', 1),
(17, 9, 'Nizami Grills', 1),
(18, 8, 'Nizami Quesadillas', 1),
(19, 6, 'Plates', 1),
(20, 4, 'Cheese & chips with toppings', 1),
(21, 3, 'Pastas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `available` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_name`, `capacity`, `available`, `active`, `store_id`) VALUES
(1, '1', '2', 2, 1, 1),
(2, '2', '4', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `take_away_orders`
--

DROP TABLE IF EXISTS `take_away_orders`;
CREATE TABLE IF NOT EXISTS `take_away_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(225) NOT NULL,
  `date_time` varchar(225) NOT NULL,
  `customer_name` varchar(225) NOT NULL,
  `customer_number` varchar(225) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paid_status` varchar(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `take_away_orders`
--

INSERT INTO `take_away_orders` (`id`, `bill_no`, `date_time`, `customer_name`, `customer_number`, `amount`, `user_id`, `paid_status`, `store_id`) VALUES
(5, 'BILPR-5367', '1604742521', '', '', '64.00', 1, '1', 1),
(3, 'BILPR-741A', '1604309933', '', '', 'Qr.60', 3, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `take_away_order_items`
--

DROP TABLE IF EXISTS `take_away_order_items`;
CREATE TABLE IF NOT EXISTS `take_away_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` text NOT NULL,
  `qty` varchar(225) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `additional_notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `take_away_order_items`
--

INSERT INTO `take_away_order_items` (`id`, `order_id`, `product_id`, `qty`, `amount`, `additional_notes`) VALUES
(1, 3, '[{\"product_id\":\"6\",\"qty\":2,\"price\":20,\"subtot\":40},{\"product_id\":\"22\",\"qty\":1,\"price\":20,\"subtot\":20}]', '3', 'Qr.60', 'jkjkj'),
(3, 5, '[{\"product_id\":\"26\",\"qty\":\"2\",\"price\":\"22.00\",\"subtot\":\"44.00\"},{\"product_id\":\"25\",\"qty\":\"1\",\"price\":\"20.00\",\"subtot\":\"20.00\"}]', '3', '64.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `todays_special`
--

DROP TABLE IF EXISTS `todays_special`;
CREATE TABLE IF NOT EXISTS `todays_special` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `special_date` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`, `store_id`, `group_id`) VALUES
(1, 'admin', '$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK', 'admin@admin.com', 'john', 'doe', '80789998', 1, 1, 1),
(2, 'TA User', '$2y$10$5wPUfQ9il8W84qbsuoDp/eP3/5u0CO0m8RTcN3JvpzWbBllWKay0i', 'aditi@tradifyservices.com', 'Test', 'user', '20202020', 1, 1, 0),
(3, 'shazsaleem', '$2y$10$Z74xwaDPVb96bYtxh5jK4.cR8/VC2iHUQH1LDidZpagKT5AZoeWHq', 'shaz@tfs.com', 'Shaz', 'Saleem', '77226543', 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 6),
(3, 3, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
