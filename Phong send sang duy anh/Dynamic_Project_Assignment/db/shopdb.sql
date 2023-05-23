-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 12:57 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopdb`
--
CREATE DATABASE IF NOT EXISTS `shopdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shopdb`;

-- --------------------------------------------------------

--
-- Table structure for table `camping_sites`
--

DROP TABLE IF EXISTS `camping_sites`;
CREATE TABLE IF NOT EXISTS `camping_sites` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `availability` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `camping_sites`
--

INSERT INTO `camping_sites` (`id`, `name`, `location`, `availability`, `image`, `description`) VALUES
(1, 'Beautiful Lake Camping', 'Da Lat', 5, 'img/site-a.jpg', 'Site A is a stunning camping and swimming spot located in the charming city of Da Lat. With its lush'),
(2, 'Island Paradise', 'Ha Long Bay', 3, 'img/site-b.jpg', 'Located in the UNESCO World Heritage site Ha Long Bay, Site B offers a unique camping and swimming e'),
(3, 'Tropical Getaway', 'Phu Quoc Island', 0, 'img/site-c.jpg', 'Site C, situated on the idyllic Phu Quoc Island, is currently fully booked. Stay tuned for future av'),
(4, 'Coastal Serenity', 'Nha Trang', 2, 'img/site-d.jpg', 'Nestled in the coastal city of Nha Trang, Site D boasts picturesque beaches and inviting swimming sp'),
(5, 'Sandy Beach Retreat', 'Mui Ne', 8, 'img/site-e.jpg', 'Discover Site E in Mui Ne, a coastal gem known for its sandy beaches and azure waters. With its plen'),
(6, 'Mountain Escape', 'Sapa', 1, 'img/site-f.jpg', 'Escape to Site F in the mountainous town of Sapa, where you can enjoy breathtaking landscapes and re'),
(7, 'Jungle Oasis', 'Phong Nha-Ke Bang National Park', 0, 'img/site-g.jpg', 'Unfortunately, Site G in Phong Nha-Ke Bang National Park is currently fully booked. Keep an eye out '),
(8, 'Hạ Long Bay', 'Quảng Ninh', 10, 'img/halong_bay.jpg', 'Explore the stunning limestone karsts and emerald waters of Hạ Long Bay. Camp on one of the secluded'),
(9, 'Mui Ne Beach', 'Bình Thuận', 5, 'img/mui_ne_beach.jpg', 'Experience the sandy beaches and strong sea breezes of Mui Ne. Enjoy camping under the starry sky an'),
(10, 'Sơn Đoòng Cave', 'Quảng Bình', 2, 'img/son_doong_cave.jpg', 'Embark on an extraordinary adventure to Sơn Đoòng, the world\'s largest cave. Set up camp inside the '),
(11, 'Cát Bà Island', 'Hải Phòng', 8, 'img/cat_ba_island.jpg', 'Visit Cát Bà Island and its beautiful beaches surrounded by lush jungles. Camp along the coastline, '),
(12, 'Phú Quốc Island', 'Kiên Giang', 6, 'img/phu_quoc_island.jpg', 'Escape to Phú Quốc Island and its picturesque beaches. Set up your camp near the shoreline, enjoy th');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Hai Phong', 'tranhaiphong2016fpt@gmail.com', '1111', '1111'),
(2, 'Hai Phong', 'felixharvey2017fpt@gmail.com', '1111', 'ddd'),
(3, 'Hai Phong', 'felixharvey2017fpt@gmail.com', '1111', 'ddd'),
(4, 'Hai Phong', 'tranhaiphong2016fpt@gmail.com', 's', 's');

-- --------------------------------------------------------

--
-- Table structure for table `fcustomers`
--

DROP TABLE IF EXISTS `fcustomers`;
CREATE TABLE IF NOT EXISTS `fcustomers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `numberofcheck` int(11) DEFAULT NULL,
  `numberofviews` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `numberofviews` (`numberofviews`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `page_id`, `name`, `content`, `rating`, `submit_date`) VALUES
(1, 1, 'David Deacon', 'I use this website daily, the amount of content is brilliant.', 5, '2020-01-09 20:43:02'),
(2, 1, 'John Doe', 'Great website, great content, and great support!', 4, '2020-01-09 21:00:41'),
(3, 1, 'Robert Billings', 'Website needs more content, good website but content is lacking.', 3, '2020-01-09 21:10:16'),
(4, 1, 'Daniel Callaghan', 'Great!', 5, '2020-01-09 23:51:05'),
(5, 1, 'Bobby', 'Not much content.', 2, '2020-01-14 21:54:24'),
(6, 1, 'Joshua Kennedy', 'Fantasic website, has everything I need to know.', 5, '2020-01-16 17:34:27'),
(7, 1, 'Johannes Hansen', 'Really like this website, helps me out a lot!', 5, '2020-01-16 17:35:12'),
(8, 1, 'Wit Kwiatkowski', 'Please provide more quality content.', 5, '2020-01-16 17:36:03'),
(9, 1, 'Ã“li ÃžÃ³rÃ°arson', 'Thanks', 5, '2020-01-16 17:36:34'),
(10, 1, 'Jaroslava BerÃ¡nkovÃ¡', '', 5, '2020-01-16 17:37:48'),
(11, 1, 'Naomi Holt', 'Appreciate the amount of content you guys do.', 5, '2020-01-16 17:39:17'),
(12, 1, 'Isobel Whitehead', 'Thank you for providing a website that helps us out a lot!', 5, '2020-01-16 17:40:28'),
(13, 1, 'Warren Mills', 'Everything is awesome!', 5, '2020-01-16 19:34:08'),
(14, 1, 'Larry Johnson', 'Brilliant, thank you for providing quality content!', 5, '2020-01-29 18:40:36'),
(15, 1, 'Marry Jane', 'Nice System you have there', 4, '2023-05-18 17:25:22'),
(16, 1, 'Duy Anh', 'Web như loz >:(((((((', 1, '2023-05-19 00:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', 'hadmin', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

DROP TABLE IF EXISTS `tbl_blog`;
CREATE TABLE IF NOT EXISTS `tbl_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `category_post` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `title`, `description`, `content`, `category_post`, `image`, `status`) VALUES
(1, 'MVC-News', '<p>Hello this is the description blog page about mvc</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', '<p>Hello this is the content blog page about mvc</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 2, 'f8a8f73bae.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brandId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brandName` varchar(255) NOT NULL,
  PRIMARY KEY (`brandId`),
  UNIQUE KEY `brandName` (`brandName`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(6, 'Apple'),
(1, 'Dell'),
(3, 'MadeByBoo'),
(2, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cartId` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) UNSIGNED NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`cartId`),
  KEY `productId` (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `catId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) NOT NULL,
  PRIMARY KEY (`catId`),
  UNIQUE KEY `catName` (`catName`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(5, 'accessory'),
(7, 'Computer Screening'),
(1, 'Laptop'),
(6, 'Personal Computer'),
(4, 'Smartphone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_post`
--

DROP TABLE IF EXISTS `tbl_category_post`;
CREATE TABLE IF NOT EXISTS `tbl_category_post` (
  `id_cate_post` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_cate_post`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_post`
--

INSERT INTO `tbl_category_post` (`id_cate_post`, `title`, `description`, `status`) VALUES
(2, 'Technology News and Megazine', 'Update Every day, Every time', 0),
(3, 'Food&amp;Health', 'About Food and Health', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_title` varchar(255) NOT NULL,
  `comment_detail` text NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `comment_title`, `comment_detail`, `product_id`, `blog_id`, `image`) VALUES
(2, 'Porter Tran', 'hihihihi', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

DROP TABLE IF EXISTS `tbl_compare`;
CREATE TABLE IF NOT EXISTS `tbl_compare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE IF NOT EXISTS `tbl_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_num` varchar(20) NOT NULL,
  `fax_num` varchar(20) DEFAULT NULL,
  `social_twitter` varchar(70) DEFAULT NULL,
  `social_facebook` varchar(70) DEFAULT NULL,
  `social_mail` varchar(100) DEFAULT NULL,
  `social_pinterest` varchar(70) DEFAULT NULL,
  `title_website` varchar(100) NOT NULL,
  `image_main_web` varchar(255) DEFAULT NULL,
  `slogan_website` varchar(100) DEFAULT NULL,
  `copyright_text` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`config_id`, `phone_num`, `fax_num`, `social_twitter`, `social_facebook`, `social_mail`, `social_pinterest`, `title_website`, `image_main_web`, `slogan_website`, `copyright_text`, `address`) VALUES
(1, '0987654321', '0123456789', 'ahihihi998', 'aptechvietnam.com.uk', 'hello1234567@gmail.com', 'ahihihi998', 'Phong Tran store', '3864e5bd13.jpg', 'fast, convenient, trust', 'Made by Phong @ 2022-2023 | Do not copy without permission.', 'Truong Chinh, Ha Noi');

--
-- Triggers `tbl_config`
--
DROP TRIGGER IF EXISTS `InsertPreventTrigger`;
DELIMITER $$
CREATE TRIGGER `InsertPreventTrigger` BEFORE INSERT ON `tbl_config` FOR EACH ROW BEGIN
IF(new.config_id < 1 or new.config_id > 2) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'You can not insert record';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `passport` varchar(9) DEFAULT NULL,
  `national_citizen_id` varchar(12) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `first_name`, `last_name`, `address`, `city`, `country`, `passport`, `national_citizen_id`, `phone`, `email`, `password`) VALUES
(2, '', 'Phong Tran', 'P69, Trung Yen, Yen Hoa ward, Cau Giay district', 'Hanoi', 'AF', NULL, NULL, '+84969406652', 'tranhaiphong2016fpt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'Phong Hai', 'Tran', '123 Melbourne', 'Melbourne', 'Australia', 'P29282', '333', '0912345678', 'phongdz17@gmail.com', '$2y$10$NtZ2WsGLJhff6qJmIMH/Aeqa314Xt5X6bs5bC1NswI22SUCU1GyPm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customerId` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`,`customerId`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productId`, `productName`, `customerId`, `quantity`, `price`, `image`, `status`, `date_order`) VALUES
(14, 8, 'Macbook 14 inch 2021', 2, 3, '3600', '72355ae44d.jpg', 2, '2023-01-21 04:19:26'),
(15, 5, 'Pencil With Eraser 0.5 mm ', 2, 2, '240', '4c33684243.jpg', 2, '2023-01-21 04:19:26'),
(16, 2, 'Ruler', 2, 1, '100', '0634c9d46a.jpg', 1, '2023-01-21 08:23:04'),
(17, 6, 'Samsung Ultra 4k', 2, 5, '1250', '6f1506da19.png', 2, '2023-01-22 04:12:31'),
(18, 2, 'Ruler', 2, 1, '100', '0634c9d46a.jpg', 0, '2023-01-23 08:34:32'),
(19, 6, 'Samsung Ultra 4k', 2, 1, '25000000', '6f1506da19.png', 0, '2023-01-23 08:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

DROP TABLE IF EXISTS `tbl_page`;
CREATE TABLE IF NOT EXISTS `tbl_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(70) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`page_id`, `page_title`, `page_content`, `status`, `slug`) VALUES
(1, 'About shop', '<p>About</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, 'about-shop'),
(3, 'Terms and Conditions', '<p>Last updated: 17/12/2022</p>\r\n<p>Please read these Terms of Use carefully before using the website (the &ldquo;Service&rdquo;) operated by us.</p>\r\n<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>\r\n<p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service.</p>\r\n<h2>Login</h2>\r\n<p>By proceeding you understand and give your consent that your IP address and browser information might be processed by the security plugins installed on this site.</p>\r\n<h2>Accounts</h2>\r\n<p>When you create an account with us, you must provide us with information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>\r\n<p>You are responsible for safeguarding the password you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>\r\n<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>\r\n<h2>Intellectual Property</h2>\r\n<p>The Service and its original content, features and functionality are and will remain the exclusive property of Porter&rsquo;s Technological blog and its licensors.</p>\r\n<h2>Links To Other Web Sites</h2>\r\n<p>Our Service may contain links to third-party websites or services that are not owned or controlled by Porter&rsquo;s Technological blog.</p>\r\n<p>Porter&rsquo;s Technological blog has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third-party websites or services. You further acknowledge and agree that Porter&rsquo;s Technological blog shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>\r\n<p>We strongly advise you to read the terms and conditions and privacy policies of any third-party websites or services that you visit.</p>\r\n<h2>Termination</h2>\r\n<p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>\r\n<p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service.</p>\r\n<p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>\r\n<h2>Disclaimer</h2>\r\n<p>Your use of the Service is at your sole risk. The Service is provided on an &ldquo;AS IS&rdquo; and &ldquo;AS AVAILABLE&rdquo; basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.</p>\r\n<h2>Governing Law</h2>\r\n<p>These Terms shall be governed and construed by the laws of Viet Nam without regard to its conflict of law provisions.</p>\r\n<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>\r\n<h2>Changes</h2>\r\n<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is a material, we will try to provide at least 30 days&rsquo; notice before any new terms take effect. What constitutes a material change will be determined at our sole discretion.</p>\r\n<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>\r\n<h2>Contact Us</h2>\r\n<p>If you have any questions about these Terms, please contact us.</p>\r\n<div>&nbsp;</div>\r\n<div class=\"pp-multiple-authors-boxes-wrapper pp-multiple-authors-wrapper pp-multiple-authors-layout-boxed multiple-authors-target-the-content box-post-id-224\" data-original_class=\"pp-multiple-authors-boxes-wrapper pp-multiple-authors-wrapper box-post-id-224\">&nbsp;</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, 'terms-and-conditions');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `catId` int(11) UNSIGNED NOT NULL,
  `brandId` int(11) UNSIGNED NOT NULL,
  `productDesc` text CHARACTER SET utf8 NOT NULL,
  `type` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`productId`),
  KEY `catId` (`catId`,`brandId`),
  KEY `brandId` (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `productDesc`, `type`, `price`, `image`) VALUES
(2, 'Ruler', 5, 1, '<p>111111</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '100', '0634c9d46a.jpg'),
(5, 'Pencil With Eraser 0.5 mm ', 5, 3, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '120', '4c33684243.jpg'),
(6, 'Samsung Ultra 4k', 7, 2, '<p>Very good</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '25000000', '6f1506da19.png'),
(7, 'Macbook 16 inch 2021', 1, 6, '<p>So strong</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '2000', '0c168e61b7.jpg'),
(8, 'Macbook 14 inch 2021', 1, 6, '<p>Okayish</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '1200', '72355ae44d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_name` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `slider_name`, `slider_image`, `type`) VALUES
(1, 'Slider 1', '8c1182cc71.jpg', 0),
(3, 'Slider 3', '8c0615eef5.jpg', 0),
(4, 'Slider 4', '76d7561fab.png', 1),
(5, 'Slider 5', '1aea9ae1c1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

DROP TABLE IF EXISTS `tbl_wishlist`;
CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `customer_id`, `product_id`, `productName`, `price`, `image`) VALUES
(1, 2, 2, 'Ruler', '100', '0634c9d46a.jpg'),
(6, 2, 6, 'Samsung Ultra 4k', '25000000', '6f1506da19.png');

-- --------------------------------------------------------

--
-- Table structure for table `views_counter`
--

DROP TABLE IF EXISTS `views_counter`;
CREATE TABLE IF NOT EXISTS `views_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `views` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fcustomers`
--
ALTER TABLE `fcustomers`
  ADD CONSTRAINT `fcustomers_ibfk_1` FOREIGN KEY (`numberofviews`) REFERENCES `views_counter` (`id`);

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD CONSTRAINT `tbl_compare_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_compare_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `tbl_brand` (`brandId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD CONSTRAINT `tbl_wishlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
