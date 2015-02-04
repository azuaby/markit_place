-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2014 at 01:02 PM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `markit_beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `fc_banners`
--

CREATE TABLE IF NOT EXISTS `fc_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(50) NOT NULL,
  `html_source` text NOT NULL,
  `banner_type` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_carts`
--

CREATE TABLE IF NOT EXISTS `fc_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `payment_status` enum('success','cancel','progress') NOT NULL DEFAULT 'progress',
  `quantity` int(11) NOT NULL,
  `size_options` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=483 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_categories`
--

CREATE TABLE IF NOT EXISTS `fc_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  `category_urlname` varchar(50) NOT NULL,
  `category_parent` int(11) NOT NULL,
  `category_vrintype` varchar(30) NOT NULL,
  `category_sub_vrintype` varchar(30) NOT NULL,
  `category_del_type` varchar(30) NOT NULL,
  `category_sub_parent` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_colors`
--

CREATE TABLE IF NOT EXISTS `fc_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(20) NOT NULL,
  `rgb` varchar(20) NOT NULL,
  `color_hex` varchar(20) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `fc_colors`
--

INSERT INTO `fc_colors` (`id`, `color_name`, `rgb`, `color_hex`, `cdate`) VALUES
(1, 'Red', '255,0,0', '#ff0000', 1376994637),
(2, 'Pink', '255,192,203', '#ffc0cb', 1376994663),
(3, 'Purple', '160,32,240', '#a020f0', 1376994694),
(4, 'Blue', '0,0,255', '#0000ff', 1376994712),
(5, 'Skyblue', '135,206,250', '#87cefa', 1376994740),
(6, 'Green', '0,128,0', '#008000', 1376994793),
(7, 'Yellow', '255,255,0', '#ffff00', 1376995133),
(8, 'Orange', '255,165,0', '#ffa500', 1376995150),
(9, 'Brown', '165,42,42', '#a52a2a', 1376995163),
(10, 'Black', '0,0,0', '#000000', 1376995176),
(11, 'White', '255,255,255', '#ffffff', 1376995198),
(12, 'Silver', '192,192,192', '#c0c0c0', 1376995216),
(14, 'Gold', '255,215,0', '#ffd700', 1376995548);
-- --------------------------------------------------------

--
-- Table structure for table `fc_comments`
--

CREATE TABLE IF NOT EXISTS `fc_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=598 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_commissions`
--

CREATE TABLE IF NOT EXISTS `fc_commissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applyto` varchar(10) NOT NULL,
  `type` varchar(25) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `min_value` varchar(20) NOT NULL,
  `max_value` varchar(20) NOT NULL,
  `commission_details` varchar(250) NOT NULL,
  `active` int(2) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fc_commissions`
--

INSERT INTO `fc_commissions` (`id`, `applyto`, `type`, `amount`, `min_value`, `max_value`, `commission_details`, `active`, `cdate`) VALUES
(1, 'Seller', '%', '10', '1', '1000', '5%(listing commission) + 10% (seller commission)+0.04%(Paypal commission) ', 1, 1376488080),
(2, 'Seller', '$', '10', '1000', '2000', '5%(listing commission) + 10% (seller commission)+0.04%(Paypal commission) ', 1, 1376487909),
(3, 'Seller', '%', '3', '0', '1000000', '', 0, 1376743784);
-- --------------------------------------------------------

--
-- Table structure for table `fc_contactsellermsgs`
--

CREATE TABLE IF NOT EXISTS `fc_contactsellermsgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contactsellerid` int(11) NOT NULL,
  `message` tinytext NOT NULL,
  `sentby` varchar(50) NOT NULL,
  `createdat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_contactsellers`
--

CREATE TABLE IF NOT EXISTS `fc_contactsellers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `buyerid` int(11) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `itemname` varchar(200) NOT NULL,
  `buyername` varchar(100) NOT NULL,
  `sellername` varchar(100) NOT NULL,
  `sellerread` int(11) NOT NULL,
  `buyerread` int(11) NOT NULL,
  `lastsent` varchar(20) NOT NULL,
  `lastmodified` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_conversations`
--

CREATE TABLE IF NOT EXISTS `fc_conversations` (
  `con_id` bigint(20) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `created` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fc_countries`
--

CREATE TABLE IF NOT EXISTS `fc_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=246 ;

--
-- Dumping data for table `fc_countries`
--

INSERT INTO `fc_countries` (`id`, `code`, `country`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'AS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos ('',Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CD', 'Congo, The Democratic Republic of the'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'CI', 'Côte D''Ivoire'),
(54, 'HR', 'Croatia'),
(55, 'CU', 'Cuba'),
(56, 'CY', 'Cyprus'),
(57, 'CZ', 'Czech Republic'),
(58, 'DK', 'Denmark'),
(59, 'DJ', 'Djibouti'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GR', 'Greece'),
(84, 'GL', 'Greenland'),
(85, 'GD', 'Grenada'),
(86, 'GP', 'Guadeloupe'),
(87, 'GU', 'Guam'),
(88, 'GT', 'Guatemala'),
(89, 'GG', 'Guernsey'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard Island and McDonald Islands'),
(95, 'VA', 'Holy See (Vatican City State)'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran, Islamic Republic of'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IM', 'Isle of Man'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'JM', 'Jamaica'),
(109, 'JP', 'Japan'),
(110, 'JE', 'Jersey'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'KW', 'Kuwait'),
(118, 'KG', 'Kyrgyzstan'),
(119, 'LA', 'Lao People''s Democratic Republic'),
(120, 'LV', 'Latvia'),
(121, 'LB', 'Lebanon'),
(122, 'LS', 'Lesotho'),
(123, 'LR', 'Liberia'),
(124, 'LY', 'Libyan Arab Jamahiriya'),
(125, 'LI', 'Liechtenstein'),
(126, 'LT', 'Lithuania'),
(127, 'LU', 'Luxembourg'),
(128, 'MO', 'Macao'),
(129, 'MK', 'Macedonia, The Former Yugoslav Republic of'),
(130, 'MG', 'Madagascar'),
(131, 'MW', 'Malawi'),
(132, 'MY', 'Malaysia'),
(133, 'MV', 'Maldives'),
(134, 'ML', 'Mali'),
(135, 'MT', 'Malta'),
(136, 'MH', 'Marshall Islands'),
(137, 'MQ', 'Martinique'),
(138, 'MR', 'Mauritania'),
(139, 'MU', 'Mauritius'),
(140, 'YT', 'Mayotte'),
(141, 'MX', 'Mexico'),
(142, 'FM', 'Micronesia, Federated States of'),
(143, 'MD', 'Moldova, Republic of'),
(144, 'MC', 'Monaco'),
(145, 'MN', 'Mongolia'),
(146, 'ME', 'Montenegro'),
(147, 'MS', 'Montserrat'),
(148, 'MA', 'Morocco'),
(149, 'MZ', 'Mozambique'),
(150, 'MM', 'Myanmar'),
(151, 'NA', 'Namibia'),
(152, 'NR', 'Nauru'),
(153, 'NP', 'Nepal'),
(154, 'NL', 'Netherlands'),
(155, 'AN', 'Netherlands Antilles'),
(156, 'NC', 'New Caledonia'),
(157, 'NZ', 'New Zealand'),
(158, 'NI', 'Nicaragua'),
(159, 'NE', 'Niger'),
(160, 'NG', 'Nigeria'),
(161, 'NU', 'Niue'),
(162, 'NF', 'Norfolk Island'),
(163, 'MP', 'Northern Mariana Islands'),
(164, 'NO', 'Norway'),
(165, 'OM', 'Oman'),
(166, 'PK', 'Pakistan'),
(167, 'PW', 'Palau'),
(168, 'PS', 'Palestinian Territory, Occupied'),
(169, 'PA', 'Panama'),
(170, 'PG', 'Papua New Guinea'),
(171, 'PY', 'Paraguay'),
(172, 'PE', 'Peru'),
(173, 'PH', 'Philippines'),
(174, 'PN', 'Pitcairn'),
(175, 'PL', 'Poland'),
(176, 'PT', 'Portugal'),
(177, 'PR', 'Puerto Rico'),
(178, 'QA', 'Qatar'),
(179, 'RE', 'Reunion'),
(180, 'RO', 'Romania'),
(181, 'RU', 'Russian Federation'),
(182, 'RW', 'Rwanda'),
(183, 'BL', 'Saint Barthélemy'),
(184, 'SH', 'Saint Helena'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'MF', 'Saint Martin'),
(188, 'PM', 'Saint Pierre and Miquelon'),
(189, 'VC', 'Saint Vincent and the Grenadines'),
(190, 'WS', 'Samoa'),
(191, 'SM', 'San Marino'),
(192, 'ST', 'Sao Tome and Principe'),
(193, 'SA', 'Saudi Arabia'),
(194, 'SN', 'Senegal'),
(195, 'RS', 'Serbia'),
(196, 'SC', 'Seychelles'),
(197, 'SL', 'Sierra Leone'),
(198, 'SG', 'Singapore'),
(199, 'SK', 'Slovakia'),
(200, 'SI', 'Slovenia'),
(201, 'SB', 'Solomon Islands'),
(202, 'SO', 'Somalia'),
(203, 'ZA', 'South Africa'),
(204, 'GS', 'South Georgia and the South Sandwich Islands'),
(205, 'ES', 'Spain'),
(206, 'LK', 'Sri Lanka'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard and Jan Mayen'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syrian Arab Republic'),
(214, 'TW', 'Taiwan, Province Of China'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania, United Republic of'),
(217, 'TH', 'Thailand'),
(218, 'TL', 'Timor-Leste'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States Minor Outlying Islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Viet Nam'),
(239, 'VG', 'Virgin Islands, British'),
(240, 'VI', 'Virgin Islands, U.S.'),
(241, 'WF', 'Wallis And Futuna'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');
-- --------------------------------------------------------

--
-- Table structure for table `fc_coupons`
--

CREATE TABLE IF NOT EXISTS `fc_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponcode` varchar(25) NOT NULL,
  `coupontype` varchar(50) NOT NULL,
  `discount_amount` varchar(25) NOT NULL,
  `totalrange` varchar(25) NOT NULL,
  `validrange` varchar(25) NOT NULL,
  `select_merchant` int(2) NOT NULL,
  `merchant_ids` varchar(100) NOT NULL,
  `validfromdate` varchar(50) NOT NULL,
  `validtodate` varchar(50) NOT NULL,
  `cdate` int(11) NOT NULL,
  `one_time_use` enum('no','yes') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_dispcons`
--

CREATE TABLE IF NOT EXISTS `fc_dispcons` (
  `dcid` int(11) NOT NULL AUTO_INCREMENT,
  `dispid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `msid` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `commented_by` varchar(8) NOT NULL,
  PRIMARY KEY (`dcid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_disputes`
--

CREATE TABLE IF NOT EXISTS `fc_disputes` (
  `disid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `selid` int(11) NOT NULL,
  `uorderid` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `semail` varchar(50) NOT NULL,
  `uorderplm` varchar(20) NOT NULL,
  `uordermsg` varchar(1000) NOT NULL,
  `orderdatedisp` int(11) NOT NULL,
  `uorderstatus` varchar(30) NOT NULL,
  `create` varchar(7) NOT NULL,
  `resolvestatus` varchar(10) NOT NULL,
  PRIMARY KEY (`disid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_delivery_charges`
--

CREATE TABLE IF NOT EXISTS `fc_delivery_charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `regulr_chrge` int(11) NOT NULL,
  `expres_chrge` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------


--
-- Table structure for table `fc_deliverycountries`
--

CREATE TABLE IF NOT EXISTS `fc_deliverycountries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dcountry` varchar(30) NOT NULL,
  `dcountrycode` int(11) NOT NULL,
  `darea` varchar(30) NOT NULL,
  `dcurrency` varchar(11) NOT NULL,
  `dzone` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------



--
-- Table structure for table `fc_fashionusers`
--

CREATE TABLE IF NOT EXISTS `fc_fashionusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemId` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `userimage` varchar(200) DEFAULT NULL,
  `status` enum('Yes','No') NOT NULL DEFAULT 'No',
  `cdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_followers`
--

CREATE TABLE IF NOT EXISTS `fc_followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follow_user_id` int(11) NOT NULL,
  `followed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=333 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_forexrates`
--

CREATE TABLE IF NOT EXISTS `fc_forexrates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(10) DEFAULT NULL,
  `currency_code` varchar(10) DEFAULT NULL,
  `currency_symbol` varchar(10) CHARACTER SET utf8 NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `currency_name` varchar(100) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `cdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_giftcards`
--

CREATE TABLE IF NOT EXISTS `fc_giftcards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `reciptent_name` varchar(200) DEFAULT NULL,
  `reciptent_email` varchar(250) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `avail_amount` varchar(50) DEFAULT NULL,
  `giftcard_key` varchar(30) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_googlecodes`
--

CREATE TABLE IF NOT EXISTS `fc_googlecodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_code` text NOT NULL,
  `status` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_groupgiftpayamts`
--

CREATE TABLE IF NOT EXISTS `fc_groupgiftpayamts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ggid` int(11) DEFAULT NULL,
  `amount` varchar(25) DEFAULT NULL,
  `paiduser_id` int(11) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_groupgiftuserdetails`
--

CREATE TABLE IF NOT EXISTS `fc_groupgiftuserdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `recipient` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `country` varchar(10) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `telephone` int(15) NOT NULL,
  `itemcost` varchar(50) DEFAULT NULL,
  `itemsize` varchar(30) NOT NULL,
  `itemquantity` int(11) NOT NULL,
  `shipcost` varchar(50) DEFAULT NULL,
  `total_amt` varchar(25) DEFAULT NULL,
  `balance_amt` varchar(25) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `notes` text,
  `status` varchar(50) DEFAULT 'Active',
  `c_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_helps`
--

CREATE TABLE IF NOT EXISTS `fc_helps` (
  `id` int(11) NOT NULL,
  `main_termsofSale` text NOT NULL,
  `sub_termsofSale` text NOT NULL,
  `contact` text NOT NULL,
  `main_termsofService` text NOT NULL,
  `sub_termsofService` text NOT NULL,
  `main_privacy` text NOT NULL,
  `sub_privacy` text NOT NULL,
  `main_termsofMerchant` text NOT NULL,
  `sub_termsofMerchant` text NOT NULL,
  `main_copyright` text NOT NULL,
  `sub_copyright` text NOT NULL,
  `main_faq` text NOT NULL,
  `sub_faq` text NOT NULL,
  `err_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `fc_helps`
--

INSERT INTO `fc_helps` (`id`, `main_termsofSale`, `sub_termsofSale`, `contact`, `main_termsofService`, `sub_termsofService`, `main_privacy`, `sub_privacy`, `main_termsofMerchant`, `sub_termsofMerchant`, `main_copyright`, `sub_copyright`, `main_faq`, `sub_faq`, `err_code`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum</p>', '<p>Markit,</p>\r\n<p>Inc. 354 Royals Road,</p>\r\n<p>Canada,</p>\r\n<p>CN 165214</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>', '<p>&nbsp;Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', '<p>This is a short list of our most frequently asked questions. For more information about Markit, or if you need support.</p>', '<p id="fantasy" class="stit">Markit</p>\r\n<h4 class="stit">&nbsp;</h4>\r\n<p>What is Markit ?</p>\r\n<p class="WIF">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>\r\n<p>How to signup for Markit ?</p>\r\n<p>How to Markit an item ?</p>\r\n<p class="HTF">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>\r\n<p>&nbsp;</p>', '<div class="row-fluid">\r\n				    <div class="http-error">\r\n				        <h1>Oops!</h1>\r\n				        <p class="info">Something went wrong, please try again.</p>\r\n				        <p><i class="icon-home"></i></p>\r\n                                <p>Please wait till we got the issues fixed.</p>  \r\n				        <p><a href="<?php echo SITE_URL.''admin/''; ?>">Back to the home page</a></p>\r\n                                </div>\r\n				</div>\r\n				   ');
-- --------------------------------------------------------

--
-- Table structure for table `fc_historyitems`
--

CREATE TABLE IF NOT EXISTS `fc_historyitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` text,
  `cdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_homepagesettings`
--

CREATE TABLE IF NOT EXISTS `fc_homepagesettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layout` varchar(50) NOT NULL,
  `slider` text NOT NULL,
  `properties` text NOT NULL,
  `widgets` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_homepagesettings`
--

INSERT INTO `fc_homepagesettings` (`id`, `layout`, `slider`, `properties`, `widgets`) VALUES
(1, 'default', '[{"image":"1395152872.png","link":"http:\\/\\/markit.com.kw\\/demo"},{"image":"1395153120.png","link":"http:\\/\\/markit.com.kw\\/dev"}]', '{"sliderheight":"320px","sliderbg":"#e0e0de","widgets":{"Most Popular":{"widgettype":"compact","widgetitmcnt":"12"},"Recently Added":{"widgettype":"regular","widgetitmcnt":"12"},"Most Commented":{"widgettype":"regular","widgetitmcnt":"6"},"Most Popular Categories":{"widgettype":"regular","widgetitmcnt":"6"},"Top Stores":{"widgettype":"regular","widgetitmcnt":"12"},"Featured Items":{"widgettype":"regular","widgetitmcnt":"6"}}}', 'Recently Added(,)Top Stores(,)Most Popular(,)Most Commented(,)Most Popular Categories(,)Featured Items');
-- --------------------------------------------------------

--
-- Table structure for table `fc_invoiceorders`
--

CREATE TABLE IF NOT EXISTS `fc_invoiceorders` (
  `invoiceorderid` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`invoiceorderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_invoices`
--

CREATE TABLE IF NOT EXISTS `fc_invoices` (
  `invoiceid` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceno` varchar(150) NOT NULL,
  `invoicedate` int(11) NOT NULL,
  `invoicestatus` varchar(20) NOT NULL,
  `paymentmethod` varchar(20) NOT NULL,
  PRIMARY KEY (`invoiceid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_ipntracks`
--

CREATE TABLE IF NOT EXISTS `fc_ipntracks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_itemfavs`
--

CREATE TABLE IF NOT EXISTS `fc_itemfavs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1064 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_itemlists`
--

CREATE TABLE IF NOT EXISTS `fc_itemlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lists` varchar(50) NOT NULL,
  `list_item_id` text NOT NULL,
  `user_create_list` int(2) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_itemposts`
--

CREATE TABLE IF NOT EXISTS `fc_itemposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(25) NOT NULL,
  `site_url` tinytext NOT NULL,
  `item_color` varchar(200) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_items`
--

CREATE TABLE IF NOT EXISTS `fc_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `item_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `item_title_url` varchar(200) NOT NULL,
  `item_description` text CHARACTER SET utf8 NOT NULL,
  `shop_sec` text CHARACTER SET utf8,
  `recipient` tinytext,
  `occasion` int(11) DEFAULT NULL,
  `style` text CHARACTER SET utf8,
  `tags` text CHARACTER SET utf8,
  `materials` text CHARACTER SET utf8,
  `price` float DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `quantity_sold` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `super_catid` int(11) DEFAULT NULL,
  `sub_catid` int(11) DEFAULT NULL,
  `item_made_it` varchar(50) CHARACTER SET utf8 NOT NULL,
  `item_for_what` varchar(50) CHARACTER SET utf8 NOT NULL,
  `item_when_make` varchar(50) CHARACTER SET utf8 NOT NULL,
  `variation_propty_1` int(11) DEFAULT NULL,
  `scale_size_1` int(11) DEFAULT NULL,
  `offer_options_1` int(11) DEFAULT NULL,
  `variation_propty_2` int(11) DEFAULT NULL,
  `scale_size_2` int(11) DEFAULT NULL,
  `offer_options_2` int(11) DEFAULT NULL,
  `ship_from_country` int(11) NOT NULL,
  `processing_time` varchar(200) DEFAULT NULL,
  `processing_min` varchar(200) DEFAULT NULL,
  `processing_max` varchar(200) DEFAULT NULL,
  `processing_option` varchar(20) DEFAULT NULL,
  `size_options` text,
  `status` enum('draft','publish','things') CHARACTER SET utf8 NOT NULL DEFAULT 'draft',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_color` tinytext NOT NULL,
  `item_color_method` int(1) NOT NULL,
  `fav_count` int(11) NOT NULL DEFAULT '0',
  `bm_redircturl` varchar(500) NOT NULL,
  `videourrl` tinytext,
  `featured` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL,
  `report_flag` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1015 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_logcoupons`
--

CREATE TABLE IF NOT EXISTS `fc_logcoupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_logs`
--

CREATE TABLE IF NOT EXISTS `fc_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('comment','favorite','additem','follow','followers','sellermessage') NOT NULL,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `seller_message` text,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=624 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_managemodules`
--

CREATE TABLE IF NOT EXISTS `fc_managemodules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_banner` enum('yes','no') NOT NULL,
  `site_maintenance_mode` enum('yes','no') NOT NULL,
  `maintenance_text` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_news`
--

CREATE TABLE IF NOT EXISTS `fc_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `status` enum('publish','unpublish') NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_occasions`
--

CREATE TABLE IF NOT EXISTS `fc_occasions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occasion_name` varchar(200) NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_ordercomments`
--

CREATE TABLE IF NOT EXISTS `fc_ordercomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `buyerid` int(11) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `comment` tinytext NOT NULL,
  `createddate` int(11) NOT NULL,
  `commentedby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_orders`
--

CREATE TABLE IF NOT EXISTS `fc_orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `totalcost` varchar(50) NOT NULL,
  `totalCostshipp` varchar(100) DEFAULT NULL,
  `orderdate` int(11) NOT NULL,
  `shippingaddress` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `discount_amount` varchar(100) DEFAULT NULL,
  `currency` varchar(50) NOT NULL,
  `admin_commission` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `status_date` int(11) NOT NULL,
  `deliver_date` int(11) NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_order_items`
--

CREATE TABLE IF NOT EXISTS `fc_order_items` (
  `orderItemid` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `item_size` varchar(30) DEFAULT NULL,
  `itemprice` int(11) NOT NULL,
  `itemquantity` int(11) NOT NULL,
  `itemunitprice` int(11) NOT NULL,
  `shippingprice` int(11) NOT NULL,
  `discountType` varchar(250) DEFAULT NULL,
  `discountAmount` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`orderItemid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_payments`
--

CREATE TABLE IF NOT EXISTS `fc_payments` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `txnid` varchar(20) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `itemid` varchar(25) NOT NULL,
  `createdtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_photos`
--

CREATE TABLE IF NOT EXISTS `fc_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=411 ;

-- --------------------------------------------------------


--
-- Table structure for table `fc_prices`
--

CREATE TABLE IF NOT EXISTS `fc_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------


--
-- Table structure for table `fc_recipients`
--

CREATE TABLE IF NOT EXISTS `fc_recipients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_name` varchar(200) NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `fc_recipients`
--

INSERT INTO `fc_recipients` (`id`, `recipient_name`, `status`, `created_on`) VALUES
(1, 'Married', 'enable', '2013-07-11 09:54:48'),
(2, 'Friends', 'enable', '2013-07-11 09:54:59'),
(3, 'Dating', 'enable', '2013-07-11 09:55:19'),
(4, 'Parent', 'enable', '2013-07-11 09:55:27'),
(5, 'Sibling', 'enable', '2013-07-11 09:55:51'),
(6, 'Youth', 'enable', '2013-07-11 09:55:57'),
(7, 'Adult child', 'enable', '2013-07-11 09:56:33'),
(8, 'Grandchild', 'enable', '2013-07-11 09:56:43'),
(9, 'Grandparent', 'enable', '2013-07-11 09:56:50');
-- --------------------------------------------------------

--
-- Table structure for table `fc_shipings`
--

CREATE TABLE IF NOT EXISTS `fc_shipings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `primary_cost` varchar(200) NOT NULL,
  `other_item_cost` varchar(200) NOT NULL,
  `shipping_delivery` varchar(200) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=328 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shippingaddresses`
--

CREATE TABLE IF NOT EXISTS `fc_shippingaddresses` (
  `shippingid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `countrycode` int(11) NOT NULL,
  PRIMARY KEY (`shippingid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `fc_shippingaddresses`
--

INSERT INTO `fc_shippingaddresses` (`shippingid`, `userid`, `nickname`, `name`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `phone`, `countrycode`) VALUES
(1, 38, 'Home', 'Rahul', '1st Suit, Park Street,', '', 'New Delhi', 'Delhi', 'India', 100025, 34544334, 100);
-- --------------------------------------------------------

--
-- Table structure for table `fc_shippricelists`
--

CREATE TABLE IF NOT EXISTS `fc_shippricelists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weight` varchar(50) DEFAULT NULL,
  `asiaD` varchar(50) DEFAULT NULL,
  `asiaE` varchar(50) DEFAULT NULL,
  `americaD` varchar(50) DEFAULT NULL,
  `americaE` varchar(50) DEFAULT NULL,
  `europeD` varchar(50) DEFAULT NULL,
  `europeE` varchar(50) DEFAULT NULL,
  `africaD` varchar(50) DEFAULT NULL,
  `africaE` varchar(50) DEFAULT NULL,
  `cdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shopcomments`
--

CREATE TABLE IF NOT EXISTS `fc_shopcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shopfavs`
--

CREATE TABLE IF NOT EXISTS `fc_shopfavs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `cretaed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shops`
--

CREATE TABLE IF NOT EXISTS `fc_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_name` varchar(200) DEFAULT NULL,
  `shop_title` varchar(200) DEFAULT NULL,
  `shop_banner` varchar(200) DEFAULT NULL,
  `shop_announcement` text,
  `shop_message` text,
  `shop_address` varchar(100) DEFAULT NULL,
  `shop_latitude` float(10,6) DEFAULT NULL,
  `shop_longitude` float(10,6) DEFAULT NULL,
  `welcome_message` text,
  `payment_policy` text,
  `shipping_policy` text,
  `refund_policy` text,
  `additional_info` text,
  `seller_info` text,
  `phone_no` varchar(25) NOT NULL,
  `paypal_id` varchar(100) NOT NULL,
  `seller_status` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_count` int(11) NOT NULL,
  `follow_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `fc_shops`
--

INSERT INTO `fc_shops` (`id`, `user_id`, `shop_name`, `shop_title`, `shop_banner`, `shop_announcement`, `shop_message`, `welcome_message`, `payment_policy`, `shipping_policy`, `refund_policy`, `additional_info`, `seller_info`, `phone_no`, `paypal_id`, `created_on`) VALUES
(1, 2, 'Demo', 'Demo User', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9999999999', 'demouser@paypal.com', '2013-07-31 09:01:39');
-- --------------------------------------------------------

--
-- Table structure for table `fc_shopuserphotos`
--

CREATE TABLE IF NOT EXISTS `fc_shopuserphotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `userimage` varchar(100) DEFAULT NULL,
  `status` enum('Yes','No') DEFAULT 'No',
  `cdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_sitequeries`
--

CREATE TABLE IF NOT EXISTS `fc_sitequeries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `queries` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_sitesettings`
--

CREATE TABLE IF NOT EXISTS `fc_sitesettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `meta_key` varchar(200) NOT NULL,
  `meta_desc` varchar(200) NOT NULL,
  `welcome_email` enum('yes','no') NOT NULL,
  `signup_active` enum('yes','no') NOT NULL,
  `notification_email` varchar(100) NOT NULL,
  `support_email` varchar(100) NOT NULL,
  `noreply_name` varchar(100) NOT NULL,
  `noreply_email` varchar(100) NOT NULL,
  `noreply_password` varchar(50) NOT NULL,
  `gmail_smtp` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `smtp_port` int(11) NOT NULL DEFAULT '465',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `media_url` varchar(50) NOT NULL,
  `media_server_hostname` varchar(100) NOT NULL,
  `media_server_username` varchar(50) NOT NULL,
  `media_server_password` varchar(50) NOT NULL,
  `like_btn_cmnt` varchar(30) NOT NULL,
  `liked_btn_cmnt` varchar(30) NOT NULL,
  `site_logo` varchar(100) NOT NULL,
  `site_likebtn_logo` varchar(100) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `paypal_id` varchar(50) NOT NULL,
  `site_changes` text NOT NULL,
  `mobile_settings` text NOT NULL,
  `giftcard` text,
  `paypaladaptive` text NOT NULL,
  `mpowerpg` text,
  `affiliate_enb` enum('enable','disable') NOT NULL,
  `footer_left` text NOT NULL,
  `footer_right` text NOT NULL,
  `footer_active` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_sitesettings`
--

INSERT INTO `fc_sitesettings` (`id`, `site_name`, `site_title`, `meta_key`, `meta_desc`, `welcome_email`, `signup_active`, `notification_email`, `support_email`, `noreply_name`, `noreply_email`, `noreply_password`, `gmail_smtp`, `smtp_port`, `created_on`, `media_url`, `media_server_hostname`, `media_server_username`, `media_server_password`, `like_btn_cmnt`, `liked_btn_cmnt`, `site_logo`, `site_likebtn_logo`, `payment_type`, `paypal_id`, `site_changes`, `mobile_settings`, `giftcard`, `paypaladaptive`, `mpowerpg`, `affiliate_enb`, `footer_left`, `footer_right`, `footer_active`) VALUES
(1, 'Markit beta', 'online purchase', 'Markit', 'Markit', 'yes', 'yes', 'noreply@markit.com.kw', 'noreply@simplit.co', 'Markit', 'noreply@simplit.co', 'noreply@simplit', 'enable', 465, '2014-09-12 11:00:52', '', '', '', '', 'Markit', 'Markit''d', 'logo.png', 'Markitlike.png', 'sandbox', 'rajahussain64@yahoo.com', '{"profile_image_view":"square","credit_amount":"23"}', '{"language":"eng"}', '{"title":"Markit GIFT CARD","description":"Markit Gift card is the Feature which is used for the User, User can buy send receive the gift card to the friends, And the User can receive the Gift card code and use for the purchase.","amounts":"10,20,30,50,100,1000,1008,2000,5000,10000","image":"1403790138.jpg","time":1403790268}', '{"paymentMode":"paypalnormal","apiUserId":null,"apiPassword":null,"apiSignature":null,"apiApplicationId":null}', NULL, 'enable', 'Powered by <a href="http://www.simplit.co/">Simpl!t Co.</a>', 'Markit Social eCommerce Script v1.3.5', 'yes');
-- --------------------------------------------------------

--
-- Table structure for table `fc_styles`
--

CREATE TABLE IF NOT EXISTS `fc_styles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `style_name` varchar(200) NOT NULL,
  `cretaed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_tempaddresses`
--

CREATE TABLE IF NOT EXISTS `fc_tempaddresses` (
  `shippingid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `countrycode` int(11) NOT NULL,
  PRIMARY KEY (`shippingid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_trackingdetails`
--

CREATE TABLE IF NOT EXISTS `fc_trackingdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `status` varchar(150) NOT NULL,
  `merchantid` int(11) NOT NULL,
  `buyername` varchar(250) NOT NULL,
  `buyeraddress` tinytext NOT NULL,
  `shippingdate` int(11) NOT NULL,
  `couriername` varchar(250) NOT NULL,
  `courierservice` varchar(250) DEFAULT NULL,
  `trackingid` varchar(250) NOT NULL,
  `notes` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_userbankinfos`
--

CREATE TABLE IF NOT EXISTS `fc_userbankinfos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bankAccNo` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` int(7) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_userdevices`
--

CREATE TABLE IF NOT EXISTS `fc_userdevices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceToken` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `badge` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `mode` int(11) NOT NULL DEFAULT '0',
  `cdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `deviceToken` (`deviceToken`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_userinvitecredits`
--

CREATE TABLE IF NOT EXISTS `fc_userinvitecredits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `invited_friend` int(11) DEFAULT NULL,
  `credit_amount` varchar(50) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `status` enum('Used','NotUsed') NOT NULL DEFAULT 'NotUsed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_userinvites`
--

CREATE TABLE IF NOT EXISTS `fc_userinvites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `invited_email` varchar(50) NOT NULL,
  `invited_date` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_areas`
--

CREATE TABLE IF NOT EXISTS `fc_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_users`
--

CREATE TABLE IF NOT EXISTS `fc_users` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `username_url` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `first_name` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `last_name` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `password` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `email` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,

  `mobile` text NOT NULL,
  `area` varchar(30) NOT NULL,
  `areacode` int(11) NOT NULL,
  `telephone` int(15) NOT NULL,
  `block` varchar(40) NOT NULL,
  `street` varchar(60) NOT NULL,
  `avenue` varchar(60) NOT NULL,
  `bilding` varchar(30) NOT NULL,
  `floor` varchar(30) NOT NULL,
  `aprtmnt` varchar(30) NOT NULL,

  `country` varchar(30) NOT NULL,
  `countrycode` int(11) NOT NULL,
  `state` varchar(40) NOT NULL,
  `city` text NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) NOT NULL,
  `website` varchar(50) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `age_between` varchar(10) NOT NULL,
  `user_level` enum('normal','god','shop','moderate') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `user_status` enum('enable','disable') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'disable',
  `profile_image` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `about` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `joined_date` date NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_type` enum('normal','twitter','facebook') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'normal',
  `facebook_id` bigint(20) DEFAULT NULL,
  `token_key` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `secret_key` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `twitter_id` int(11) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `google_id` varchar(50) DEFAULT NULL,
  `referrer_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `credit_total` varchar(50) DEFAULT NULL,
  `refer_key` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `user_address` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` tinyint(4) NOT NULL DEFAULT '0',
  `subs` int(2) NOT NULL DEFAULT '1',
  `someone_follow` int(2) NOT NULL DEFAULT '1',
  `someone_show` int(2) NOT NULL DEFAULT '0',
  `someone_cmnt_ur_things` int(2) NOT NULL DEFAULT '0',
  `your_thing_featured` int(2) NOT NULL DEFAULT '0',
  `someone_mention_u` int(2) NOT NULL DEFAULT '0',
  `push_notifications` text NOT NULL,
  `featureditemid` int(11) NOT NULL,
  `defaultshipping` int(11) NOT NULL,
  `user_api_details` text NOT NULL,
  `admin_menus` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `fc_users`
--

INSERT INTO `fc_users` (`id`, `username`, `username_url`, `first_name`, `last_name`, `password`, `email`, `city`, `website`, `birthday`, `age_between`, `user_level`, `user_status`, `profile_image`, `location`, `about`, `created_at`, `joined_date`, `modified_at`, `login_type`, `facebook_id`, `token_key`, `secret_key`, `twitter_id`, `twitter`, `referrer_id`, `refer_key`, `gender`, `user_address`, `last_login`, `activation`, `subs`, `someone_follow`, `someone_show`, `someone_cmnt_ur_things`, `your_thing_featured`, `someone_mention_u`, `featureditemid`, `defaultshipping`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin', '4245999507644fc247980e3cc7dd19940c6c6bfc', 'admin@markit.com.kw', '', '', '', '', 'god', 'enable', '', NULL, NULL, '2013-02-28 12:02:24', '2013-03-15', '2013-02-28 12:02:24', 'normal', NULL, NULL, NULL, 0, '', '0', '', 'male', NULL, '2013-07-29 22:28:07', 1, 1, 1, 0, 0, 0, 0, 0, 0),
(2, 'demo', 'demo', 'Demo', NULL, '4245999507644fc247980e3cc7dd19940c6c6bfc', 'demo@markit.com.kw', '', '', '', '', 'normal', 'enable', '', NULL, NULL, '2013-07-31 05:25:11', '0000-00-00', '2013-07-31 08:55:11', 'normal', NULL, NULL, NULL, 0, '', '0', 'NbHE953O', NULL, NULL, '2013-07-31 06:20:21', 1, 1, 1, 0, 0, 0, 0, 0, 0);
-- --------------------------------------------------------

--
-- Table structure for table `fc_wantownits`
--

CREATE TABLE IF NOT EXISTS `fc_wantownits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
