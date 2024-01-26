-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 11:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onbookstore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `book_price` double(8,2) NOT NULL,
  `book_des` varchar(1000) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `book_status` tinyint(1) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `YearBook` int(11) NOT NULL,
  `inventory` int(11) NOT NULL,
  `book_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_author`, `book_price`, `book_des`, `cat_id`, `book_status`, `discount_id`, `publisher_id`, `page`, `YearBook`, `inventory`, `book_image`) VALUES
(1, 'Conan', 'Ayoma Gosho', 100.00, 'Conan Edogawa is the alias used by Shinichi Kudo in his shrunken form. Shinichi took the appearance of his six or seven-year-old self after being exposed to a prototype poison called APTX 4869, which he had been forced to swallow by two men in black later revealed to be members of the Black Organization.[4] The poison de-aged Shinichi\'s entire body except for his nervous system and therefore he still has the personality, memories, and incredible deductive ability of his teenage self. Conan\'s goal is to hunt down the Black Organization and have them arrested for their crimes, as well as find an antidote to the APTX 4869. To do so he plans to make the washout detective Kogoro Mouri famous in hopes of attracting cases related to the Black Organization.', 1, 1, 1, 1, 20, 2008, 23, '../../../../img/Step03.jpg'),
(2, 'Sherlock Holme', 'Conan Doyle', 120.00, 'dsadacax', 1, 1, 1, 1, 150, 1987, 20, '../../../../img/sherlock holmes.jpg'),
(3, 'Lich su the gioi co dai', 'Nha lich su hoc Viet nam', 200.00, 'Vietnam\'s history is a long and complex one, filled with periods of war, colonization, and revolution. The earliest known Vietnamese civilization was the Hong Bang dynasty, which existed over 2,000 years ago. Many different groups, including the Chinese and the French, have invaded and occupied Vietnam throughout its history', 5, 1, 1, 3, 150, 1999, 15, '../../../../img/lich su the gioi.jpg'),
(4, 'Harry Potter', 'J.K.Rowling', 150.00, 'asdasdsa', 1, 1, 1, 1, 150, 1999, 12, '../../../../img/harry potter.jpg'),
(5, 'Dolly Parton', 'J.K.Rowling', 220.00, 'ghdkfgkdj', 3, 1, 2, 1, 120, 2003, 6, '../../../../img/Dolly Parton.jpg'),
(10, 'Harry va bao boi tu than', 'J.K.Rowling', 210.00, 'abc', 2, 1, 2, 1, 12, 2010, 2, '../../../../img/HARRY bao boi tu than.jpg'),
(11, 'Oxford Dictionary', 'Oxford Publisher', 150.00, 'sadasd', 6, 1, 2, 2, 150, 2019, 12, '../../../../img/p1_hover.jpg'),
(14, 'aptech', 'asdas', 190.00, 'sadasd', 1, 1, 1, 1, 17, 1945, 12, '../../public/assets/img/book/z4036380563967_b5854a0df77f6335ec94f1d52614e945.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_status`) VALUES
(1, 'Detective Story', 1),
(2, 'Fairy Tale', 0),
(3, 'Classics', 1),
(4, 'Action and Adventure', 1),
(5, 'Historical Fiction', 1),
(6, 'Education', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_block` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `pwd`, `phone`, `address`, `gender`, `email`, `is_block`) VALUES
(1, 'Pham Quoc Chien', 'phamquocchien123', 912121166, '123/14/6 duong so 5, p. binh hung hoa', 1, 'chien@gmail.com', 1),
(2, 'hoa', '123456', 912121166, '123456', 0, 'hoasenxanh0709@gmail.com', 0),
(3, 'Manh Cat', 'mancat112', 912121, '275 Nguyen Van Dau', 1, 'cat@gmail.com', 0),
(4, 'Hoang Quoc', 'quoc112', 912121166, '275 bca, p. 1, Q.1', 1, 'quoc@gmail.com', 0),
(5, 'Ho Anh Quan', 'anhquan123', 912121, '178/5 CMT8, Q. Tan Binh', 1, 'quan@gmail.com', 0),
(6, 'chien', '202cb962ac59075b964b07152d234b70', 912184166, '123/14/5 duong so 3', 1, 'phamquocchien160501@gmail.com', 1),
(7, 'chien123', '202cb962ac59075b964b07152d234b70', 912184166, '123/14/5 duong so 3', 1, 'chienguvn@gmail.com', 0),
(8, 'chien145', '2b24d495052a8ce66358eb576b8912c8', 912184166, '123/14/5 duong so 3', 1, 'chienguvn@gmail.com', 0),
(9, 'chien089', '202cb962ac59075b964b07152d234b70', 912184166, '123/14/5 duong so 3', 1, 'chienpqts2204021@fpt.edu.vn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(100) NOT NULL,
  `discount_des` varchar(1000) NOT NULL,
  `discount_per` double(8,2) NOT NULL,
  `discount_start` varchar(40) NOT NULL,
  `discount_end` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `discount_des`, `discount_per`, `discount_start`, `discount_end`) VALUES
(1, 'Giam Gia ngay 10', 'giam gia len den 30%', 0.30, '03/05/2023', '31/05/2023'),
(2, 'San sale trung ngay ', 'cung ngay cung thang giam 50%', 0.50, '05/05/2023', '07/05/2023'),
(3, 'Hanh trinh san qua ', 'san qua giam den 70%', 0.70, '09/05/2023', '23/05/2023'),
(4, 'Idol qua tang', 'qua tang giam 50%', 0.50, '05/05/2023', '23/05/2023'),
(5, 'aptech', 'sadasd', 0.90, '24/04/2023', '26/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `content` varchar(250) NOT NULL,
  `rating` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `content`, `rating`, `book_id`, `customer_id`) VALUES
(1, 'sadljfnsdaljfb', 4, 4, 2),
(2, 'WOW', 3, 1, 1),
(3, 'This is amazing book\r\n', 5, 2, 1),
(5, 'hgdhgdf', 2, 1, 9),
(6, 'hfh', 2, 1, 9),
(7, 'sach rat hay', 5, 1, 9),
(8, 'sach rat hay', 5, 1, 2),
(9, 'hfgjfaaaa', 4, 1, 2),
(10, 'sach rat thu vi', 4, 2, 2),
(11, 'sach rat thu vi', 4, 2, 2),
(12, 'hgfjf jg6836', 3, 2, 2),
(13, 'hgfjf jg6836', 3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `book_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`detail_id`, `order_id`, `book_id`, `quantity`, `book_price`) VALUES
(4, 21021548, 4, 1, 1),
(5, 21021819, 5, 1, 1),
(6, 22060942, 1, 1, 1),
(7, 22062009, 2, 1, 12),
(8, 22035302, 2, 3, 12),
(9, 23124550, 1, 3, 1),
(10, 24085949, 1, 1, 50),
(11, 24090649, 1, 1, 50),
(12, 24091059, 1, 1, 50),
(13, 24091216, 1, 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `ordermaster`
--

CREATE TABLE `ordermaster` (
  `order_id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `shipping_name` varchar(100) NOT NULL,
  `shipping_address` varchar(100) NOT NULL,
  `shipping_phone` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_note` varchar(50) DEFAULT NULL,
  `last_modify_at` varchar(50) DEFAULT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordermaster`
--

INSERT INTO `ordermaster` (`order_id`, `order_date`, `cus_id`, `shipping_name`, `shipping_address`, `shipping_phone`, `payment_method`, `order_note`, `last_modify_at`, `order_status`) VALUES
(21021309, '2023-04-21 14:13:09', 3, 'hjfjgf', 'hfghf', '6587', 'COD', 'kgkjh', '2023-04-21 14:13:09', 'Pending'),
(21021407, '2023-04-21 14:14:07', 3, 'hjfjgf', 'hfghf', '6587', 'COD', 'kgkjh', '2023-04-21 14:14:07', 'Pending'),
(21021548, '2023-04-21 14:15:48', 3, 'jfgj', 'jfjyhg', '6768', 'COD', '', '2023-04-22 18:21:43', 'Processing'),
(21021819, '2023-04-21 14:18:19', 3, 'hos', 'hkdgj', '7809454', 'COD', 'jngfhjg', '2023-04-22 16:07:09', 'Completed'),
(22035302, '2023-04-22 15:53:02', 3, '', '', '', 'COD', '', '2023-04-22 15:53:02', 'Pending'),
(22060942, '2023-04-22 18:09:42', 3, 'hoa', '195 tan son', '705069879', 'COD', 'fghf', '2023-04-22 18:09:42', 'Pending'),
(22062009, '2023-04-22 18:20:09', 3, 'hoa', 'fdfhd', '75687087', 'COD', 'hfgjf', '2023-04-22 18:20:09', 'Pending'),
(23124550, '2023-04-23 12:45:50', 3, 'chien', '123/14/5 duong so 3', '0912184166', 'Bank Transfer', 'sadasdasd', '2023-04-23 12:45:50', 'Pending'),
(24085949, '2023-04-24 08:59:49', 3, 'hoa', 'gkdh', 'ghkdhf ', 'COD', '', '2023-04-24 08:59:49', 'Pending'),
(24090649, '2023-04-24 09:06:49', 3, 'hfghf', 'hfghf', '6767637', 'COD', '', '2023-04-24 09:06:49', 'Pending'),
(24091059, '2023-04-24 09:10:59', 3, 'hfg', 'hfgh', '7912345678', 'COD', '', '2023-04-24 09:10:59', 'Pending'),
(24091216, '2023-04-24 09:12:16', 3, '57', 'hfghjf', '123456789', 'COD', '', '2023-04-24 09:12:16', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisher_id` int(11) NOT NULL,
  `publisher_name` varchar(500) NOT NULL,
  `publisher_logo` varchar(100) NOT NULL,
  `publisher_web` varchar(500) NOT NULL,
  `publisher_phone` varchar(11) NOT NULL,
  `publisher_email` varchar(200) NOT NULL,
  `publisher_address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `publisher_name`, `publisher_logo`, `publisher_web`, `publisher_phone`, `publisher_email`, `publisher_address`) VALUES
(1, 'Kim Dong 3333', '../../public/assets/img/publisher/', 'https://tiki.vn/', 912164166, 'gb@gmail.com', 'asdASasd 756jf '),
(2, 'ABC Publisher', '../../public/assets/img/publisher/Step04.jpg', 'https://tiki.vn/', 2147483647, 'ghd@gmail.com', 'adsfsadf 8678 hfghjgfh'),
(3, 'Nha xuat ban giao duc ', '../../public/assets/img/publisher/Step05.jpg', 'https://www.nxbgd.vn/', 2147483647, 'ghdg@gmail.com', ' hfg6ghn hf'),
(4, 'ih', '../../public/assets/img/publisher/UTF-8 Region.png', 'https://tiki.vn/', 2147483647, 'gdb@gmail.com', '6875 hfgjfj'),
(19, 'gdfg', '../../public/assets/img/publisher/Step03.jpg', 'http://shoppe.vn', 63745637, 'gdh@gmail.com', 'gdhfdf'),
(20, 'gdfg', '../../public/assets/img/publisher/Step04.jpg', 'http://google.vn', 27563676, 'hgd@gmail.com', 'gdfhdf'),
(30, '', '../../public/assets/img/publisher/Step03.jpg', 'https://tiki.vn/', 2147483647, 'gd@gmail.com', 'hfgjfgj'),
(31, 'sak', '../../public/assets/img/publisher/Step04.jpg', 'https://hasaki.vn/', 2147483647, 'ghd@gmail.com', 'hdh hyhrt75 '),
(32, 'admin', '../../public/assets/img/publisher/z4036380563967_b5854a0df77f6335ec94f1d52614e945.jpg', 'http://localhost:8080/project/group5/group5/admin/modules/book/create.php', 912164166, 'likk@email.com', '123 Nguyen Van Dau'),
(33, 'aptech', '../../public/assets/img/publisher/', 'http://localhost:8080/project/group5/group5/admin/modules/book/create.php', 912164166, 'likk@email.com', '123 Nguyen Van Dau');

-- --------------------------------------------------------

--
-- Table structure for table `webmaster`
--

CREATE TABLE `webmaster` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_pwd` varchar(50) NOT NULL,
  `admin_email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webmaster`
--

INSERT INTO `webmaster` (`admin_id`, `admin_name`, `admin_pwd`, `admin_email`) VALUES
(1, 'admin', '123', 'admin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_discount_id_foreign` (`discount_id`),
  ADD KEY `book_cat_id_foreign` (`cat_id`),
  ADD KEY `book_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback_book_id_foreign` (`book_id`),
  ADD KEY `feedback_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `orderdetail_book_id_foreign` (`book_id`),
  ADD KEY `orderdetail_order_id_foreign` (`order_id`);

--
-- Indexes for table `ordermaster`
--
ALTER TABLE `ordermaster`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `ordermaster_cus_id_foreign` (`cus_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indexes for table `webmaster`
--
ALTER TABLE `webmaster`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ordermaster`
--
ALTER TABLE `ordermaster`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24091217;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `book_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`discount_id`),
  ADD CONSTRAINT `book_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `feedback_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `orderdetail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `ordermaster` (`order_id`);

--
-- Constraints for table `ordermaster`
--
ALTER TABLE `ordermaster`
  ADD CONSTRAINT `ordermaster_cus_id_foreign` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
