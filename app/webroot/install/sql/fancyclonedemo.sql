-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2013 at 01:39 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fancyclone`
--

--
-- Dumping data for table `fc_categories`
--

INSERT INTO `fc_categories` (`id`, `category_name`, `category_urlname`, `category_parent`, `category_sub_parent`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 'Men', 'men', 0, 0, 1, '2013-07-31 11:03:46', '0000-00-00 00:00:00'),
(2, 'Women', 'women', 0, 0, 1, '2013-07-31 11:03:53', '0000-00-00 00:00:00'),
(3, 'Home', 'home', 0, 0, 1, '2013-07-31 11:03:59', '0000-00-00 00:00:00'),
(4, 'Clothes', 'clothes', 1, 0, 1, '2013-07-31 11:04:13', '0000-00-00 00:00:00'),
(7, 'Shirts', 'shirts', 1, 4, 1, '2013-07-31 11:06:03', '2013-07-31 09:47:13'),
(9, 'Shoes', 'shoes', 1, 0, 1, '2013-07-31 11:06:41', '0000-00-00 00:00:00'),
(10, 'Casuals', 'casuals', 1, 9, 1, '2013-07-31 11:06:41', '0000-00-00 00:00:00'),
(11, 'Clothe', 'clothe', 2, 0, 1, '2013-07-31 12:19:31', '0000-00-00 00:00:00'),
(12, 'Jeans', 'jeans', 2, 11, 1, '2013-07-31 12:19:32', '0000-00-00 00:00:00'),
(13, 'Interiors', 'interiors', 3, 0, 1, '2013-07-31 12:23:44', '0000-00-00 00:00:00'),
(14, 'Room', 'room', 3, 13, 1, '2013-07-31 12:23:44', '0000-00-00 00:00:00'),
(15, 'Kitchen', 'kitchen', 3, 0, 1, '2013-07-31 12:24:21', '0000-00-00 00:00:00'),
(16, 'Things', 'things', 3, 15, 1, '2013-07-31 12:24:22', '0000-00-00 00:00:00'),
(17, 'Bags', 'bags', 2, 0, 1, '2013-07-31 13:29:28', '0000-00-00 00:00:00'),
(18, 'Hand Bag', 'hand-bag', 2, 17, 1, '2013-07-31 13:29:29', '0000-00-00 00:00:00');

--
-- Dumping data for table `fc_items`
--

INSERT INTO `fc_items` (`id`, `user_id`, `shop_id`, `item_title`, `item_title_url`, `item_description`, `shop_sec`, `recipient`, `occasion`, `style`, `tags`, `materials`, `price`, `quantity`, `quantity_sold`, `category_id`, `super_catid`, `sub_catid`, `item_made_it`, `item_for_what`, `item_when_make`, `variation_propty_1`, `scale_size_1`, `offer_options_1`, `variation_propty_2`, `scale_size_2`, `offer_options_2`, `ship_from_country`, `processing_time`, `processing_min`, `processing_max`, `processing_option`, `status`, `created_on`, `modified_on`, `item_color`, `fav_count`) VALUES
(1, 2, 1, 'Top Coat', 'top-coat', 'A royal look coat', NULL, '["1","6"]', 0, NULL, NULL, NULL, 250, 5, NULL, 1, 4, 7, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 38, '3w', NULL, NULL, NULL, 'publish', '2013-07-31 06:28:32', '2013-07-31 11:26:02', '["SILVER","BLACK","GOLD","BROWN","WHITE"]', 0),
(2, 2, 1, 'Casual T-shirt', 'casual-t-shirt', 'A good lookin tshirt', NULL, '["7","3","2"]', 0, NULL, NULL, NULL, 130, 50, NULL, 1, 4, 7, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 38, '4d', NULL, NULL, NULL, 'publish', '2013-07-31 06:30:41', '2013-07-31 11:26:03', '["WHITE","SILVER","GOLD","BROWN"]', 0),
(3, 2, 1, 'Over coat', 'over-coat', 'Good looking', NULL, '["7","3","2"]', 0, NULL, NULL, NULL, 140, 6, NULL, 1, 4, 7, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 38, '2ww', NULL, NULL, NULL, 'publish', '2013-07-31 06:33:15', '2013-07-31 11:26:04', '["BROWN","SILVER","BLACK","GOLD","PURPLE"]', 0),
(4, 2, 1, 'Casual shoes', 'casual-shoes', 'A pair of trendy casual shoes', NULL, '["7","3","2","1","6"]', 0, NULL, NULL, NULL, 230, 25, NULL, 1, 9, 10, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 89, '3d', NULL, NULL, NULL, 'publish', '2013-07-31 06:44:51', '2013-07-31 11:26:04', '["WHITE","BLACK"]', 0),
(5, 2, 1, 'Short Jean', 'short-jean', 'Short Jean by Deniim', NULL, '["7","3","2","6"]', 1, NULL, NULL, NULL, 240, 20, NULL, 2, 11, 12, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '4w', NULL, NULL, NULL, 'publish', '2013-07-31 06:50:44', '2013-07-31 11:26:05', '["WHITE","BROWN","SILVER","SKY_BLUE","PURPLE"]', 0),
(6, 2, 1, 'Jean Tops', 'jean-tops', 'Jean Tops with dark color', NULL, '["7","3","2","6"]', 1, NULL, NULL, NULL, 120, 30, NULL, 2, 11, 12, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 156, '4w', NULL, NULL, NULL, 'publish', '2013-07-31 06:52:40', '2013-07-31 11:26:05', '["BLACK","SILVER","BROWN","GOLD"]', 0),
(7, 2, 1, 'Modern Light', 'modern-light', 'A Modern sealing light which movable', NULL, '["1","4","6"]', 0, NULL, NULL, NULL, 500, 5, NULL, 3, 13, 14, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 97, '4d', NULL, NULL, NULL, 'publish', '2013-07-31 06:56:05', '2013-07-31 11:26:06', '["PURPLE","SKY_BLUE","BLACK","BLUE","BROWN"]', 0),
(8, 2, 1, 'Natural Tea pad', 'natural-tea-pad', 'A Natural Looking Tea pad', NULL, '["9","1","4"]', 1, NULL, NULL, NULL, 50, 8, NULL, 3, 15, 16, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '3d', NULL, NULL, NULL, 'publish', '2013-07-31 06:57:31', '2013-07-31 11:26:07', '["GOLD","SILVER","BROWN","BLACK"]', 0),
(9, 2, 1, 'Chips and sauce container', 'chips-and-sauce-container', 'A combo container for both', NULL, '["9","1","4"]', 1, NULL, NULL, NULL, 80, 5, NULL, 3, 15, 16, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '3d', NULL, NULL, NULL, 'publish', '2013-07-31 07:53:40', '2013-07-31 11:26:07', '["BROWN","GOLD","SILVER","BLACK"]', 0),
(10, 2, 1, 'Fish Bowl', 'fish-bowl', 'A classic fish bowl', NULL, '["8","5"]', 0, NULL, NULL, NULL, 40, 20, NULL, 3, 13, 14, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '3d', NULL, NULL, NULL, 'publish', '2013-07-31 07:55:00', '2013-07-31 11:26:08', '["BLACK","BROWN","SKY_BLUE","PURPLE"]', 0),
(11, 2, 1, 'Leaky wall mount lamp', 'leaky-wall-mount-lamp', 'A designer wall mount lamp', NULL, '["9","1","4"]', 0, NULL, NULL, NULL, 15, 12, NULL, 3, 13, 14, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '3d', NULL, NULL, NULL, 'publish', '2013-07-31 07:58:25', '2013-07-31 11:28:42', '["SILVER"]', 0),
(12, 2, 1, 'Bag', 'bag', 'A stylish long bag', NULL, '["7","3","2","5","6"]', 1, NULL, NULL, NULL, 60, 10, NULL, 2, 17, 18, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '4d', NULL, NULL, NULL, 'publish', '2013-07-31 08:00:32', '2013-07-31 11:30:44', '["SILVER","WHITE"]', 0),
(13, 2, 1, 'Globe', 'globe', 'Silver stand globe', NULL, '["2","9","4"]', 0, NULL, NULL, NULL, 30, 20, NULL, 3, 13, 14, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '4d', NULL, NULL, NULL, 'publish', '2013-07-31 08:02:00', '2013-07-31 11:34:07', '["SILVER","WHITE","PURPLE","SKY_BLUE"]', 0),
(14, 2, 1, 'Fake pool', 'fake-pool', 'Fake pool to make your lively', NULL, '["2","9","4","6"]', 0, NULL, NULL, NULL, 2500, 5, NULL, 3, 13, 14, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 117, '3w', NULL, NULL, NULL, 'publish', '2013-07-31 08:03:57', '2013-07-31 11:34:07', '["SKY_BLUE","PURPLE","BROWN","BLACK"]', 0),
(15, 2, 1, 'Printed T-shirt', 'printed-t-shirt', '100% DOUCHE printed t-shirt', NULL, '["7","3","2","6"]', 0, NULL, NULL, NULL, 80, 20, NULL, 1, 4, 7, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 100, '4d', NULL, NULL, NULL, 'draft', '2013-07-31 08:06:56', '2013-07-31 11:36:56', '["BROWN","WHITE","SILVER","GOLD"]', 0);

--
-- Dumping data for table `fc_photos`
--

INSERT INTO `fc_photos` (`id`, `item_id`, `image_name`, `created_on`) VALUES
(1, 1, '1375264610.jpg', '2013-07-31 06:28:32'),
(2, 1, '1375264618.jpg', '2013-07-31 06:28:32'),
(3, 1, '1375264624.jpg', '2013-07-31 06:28:32'),
(4, 2, '1375264764.jpg', '2013-07-31 06:30:42'),
(5, 2, '1375264770.jpg', '2013-07-31 06:30:42'),
(6, 3, '1375264896.jpg', '2013-07-31 06:33:15'),
(7, 3, '1375264916.jpg', '2013-07-31 06:33:15'),
(8, 4, '1375265613.jpg', '2013-07-31 06:44:51'),
(9, 4, '1375265616.jpg', '2013-07-31 06:44:51'),
(10, 5, '1375265997.jpg', '2013-07-31 06:50:44'),
(11, 6, '1375266065.jpg', '2013-07-31 06:52:40'),
(12, 7, '1375266287.jpg', '2013-07-31 06:56:05'),
(13, 7, '1375266293.jpg', '2013-07-31 06:56:05'),
(14, 8, '1375266394.jpg', '2013-07-31 06:57:31'),
(15, 9, '1375269714.png', '2013-07-31 07:53:40'),
(16, 9, '1375269747.png', '2013-07-31 07:53:40'),
(17, 10, '1375269850.png', '2013-07-31 07:55:00'),
(18, 10, '1375269856.jpeg', '2013-07-31 07:55:00'),
(19, 11, '1375270048.jpg', '2013-07-31 07:58:25'),
(20, 12, '1375270183.jpg', '2013-07-31 08:00:32'),
(21, 13, '1375270266.jpg', '2013-07-31 08:02:00'),
(22, 14, '1375270352.jpg', '2013-07-31 08:03:57'),
(23, 15, '1375270535.jpg', '2013-07-31 08:06:56'),
(24, 15, '1375270545.jpg', '2013-07-31 08:06:56');

--
-- Dumping data for table `fc_shipings`
--

INSERT INTO `fc_shipings` (`id`, `item_id`, `country_id`, `primary_cost`, `other_item_cost`, `created_on`) VALUES
(1, 1, 38, '25', '23', '2013-07-31 06:28:32'),
(2, 1, 100, '30', '25', '2013-07-31 06:28:32'),
(3, 2, 38, '25', '20', '2013-07-31 06:30:42'),
(4, 2, 100, '35', '32', '2013-07-31 06:30:42'),
(5, 2, 0, '50', '42', '2013-07-31 06:30:42'),
(6, 3, 38, '25', '20', '2013-07-31 06:33:15'),
(7, 3, 100, '40', '30', '2013-07-31 06:33:15'),
(8, 4, 89, '24', '20', '2013-07-31 06:44:51'),
(9, 4, 100, '30', '24', '2013-07-31 06:44:51'),
(10, 4, 0, '50', '45', '2013-07-31 06:44:51'),
(11, 5, 100, '24', '20', '2013-07-31 06:50:44'),
(12, 5, 00, '50', '48', '2013-07-31 06:50:44'),
(13, 6, 156, '40', '30', '2013-07-31 06:52:40'),
(14, 6, 100, '25', '24', '2013-07-31 06:52:40'),
(15, 6, 06, '50', '48', '2013-07-31 06:52:40'),
(16, 7, 97, '80', '70', '2013-07-31 06:56:05'),
(17, 7, 100, '50', '45', '2013-07-31 06:56:05'),
(18, 7, 0, '100', '80', '2013-07-31 06:56:05'),
(19, 8, 100, '20', '15', '2013-07-31 06:57:31'),
(20, 8, 0, '25', '15', '2013-07-31 06:57:31'),
(21, 9, 100, '15', '10', '2013-07-31 07:53:40'),
(22, 9, 0, '25', '20', '2013-07-31 07:53:40'),
(23, 10, 100, '10', '8', '2013-07-31 07:55:01'),
(24, 10, 0, '20', '12', '2013-07-31 07:55:01'),
(25, 11, 100, '5', '4', '2013-07-31 07:58:25'),
(26, 11, 0, '8', '6', '2013-07-31 07:58:25'),
(27, 12, 100, '18', '15', '2013-07-31 08:00:32'),
(28, 12, 0, '24', '20', '2013-07-31 08:00:32'),
(29, 13, 100, '10', '8', '2013-07-31 08:02:00'),
(30, 13, 0, '15', '12', '2013-07-31 08:02:00'),
(31, 14, 117, '120', '100', '2013-07-31 08:03:57'),
(32, 14, 100, '80', '75', '2013-07-31 08:03:57'),
(33, 14, 0, '150', '130', '2013-07-31 08:03:57'),
(34, 15, 100, '30', '25', '2013-07-31 08:06:56'),
(35, 15, 0, '35', '30', '2013-07-31 08:06:56');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
