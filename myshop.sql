-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 12:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `TimeAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID`, `UserID`, `ItemID`, `ItemName`, `Price`, `Quantity`, `img`, `TimeAdd`) VALUES
(35, 78, 13, 'iPhone 13 Pro 128GB SierraBlue', '1500', '2', 'ASR1501ST0269 (1).jpg', '2023-05-27 01:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` smallint(6) NOT NULL,
  `parentID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryCode` int(11) NOT NULL,
  `Description` text NOT NULL,
  `TimeAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `parentID`, `CategoryName`, `CategoryCode`, `Description`, `TimeAdd`) VALUES
(13, 1, 'Mobiles', 12212, '', '2023-04-12 01:32:03'),
(14, 1, 'Tablets', 12213, '', '2023-04-12 01:32:30'),
(15, 1, 'Cases & Covers', 12214, '', '2023-04-12 01:32:53'),
(16, 2, 'Laptops', 12312, '', '2023-04-12 01:59:50'),
(18, 1, 'Accessories', 21311, 'Accessories for phone like headphone and charger', '2023-04-29 17:17:56'),
(19, 2, 'Laptops Accessories', 12221, 'PC Accessories', '2023-04-29 17:19:14'),
(20, 2, 'Processors', 1222111, '', '2023-04-29 17:19:35'),
(21, 2, 'GPU', 122218, '', '2023-04-29 17:21:36'),
(25, 3, 'Desktops', 8654, '', '2023-04-29 17:26:39'),
(26, 3, 'Monitors', 4586, '', '2023-04-29 17:27:42'),
(27, 2, 'RAM', 78957, '', '2023-04-29 17:27:55'),
(28, 3, 'Processor', 55432, '', '2023-04-29 17:51:18'),
(29, 3, 'PC RAM', 5342, '', '2023-04-29 17:53:38'),
(30, 3, 'PC GPU ', 3123, '', '2023-04-29 17:53:51'),
(31, 3, 'Storage', 332423, '', '2023-04-29 17:54:16'),
(32, 3, 'PC Accessories', 53542, '', '2023-04-29 17:54:51'),
(33, 4, 'Televisions', 6577, '', '2023-04-29 18:05:13'),
(34, 4, 'Home Audio/Video', 2332523, '', '2023-04-29 18:05:34'),
(35, 5, 'Sony PlayStation', 6756777, '', '2023-04-29 18:12:06'),
(36, 5, 'Xbox', 64364, '', '2023-04-29 18:12:21'),
(37, 5, 'Nintendo ', 23535, '', '2023-04-29 18:13:00'),
(38, 5, 'VR', 65765767, '', '2023-04-29 18:13:39'),
(39, 6, 'Smart Watch', 2144444, '', '2023-04-29 18:34:32'),
(44, 7, 'Kitchen', 24442, '', '2023-04-29 18:42:02'),
(45, 7, 'Cooling', 235555, '', '2023-04-29 18:44:25'),
(46, 7, 'Stove', 52355, '', '2023-04-29 18:44:55'),
(47, 8, 'Car Audios', 355, '', '2023-04-29 18:51:51'),
(48, 8, 'GPS & Accessories', 1244, '', '2023-04-29 18:52:07'),
(49, 8, 'Accessories & Parts', 124214, '', '2023-04-29 18:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `ItemCodes` varchar(255) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `SalePrice` varchar(255) NOT NULL,
  `AddDate` date NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `Category` smallint(6) NOT NULL,
  `sCategory` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `MinimumQty` int(11) NOT NULL,
  `Rating` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `ItemCodes`, `ItemName`, `Description`, `Price`, `SalePrice`, `AddDate`, `image`, `Category`, `sCategory`, `Quantity`, `MinimumQty`, `Rating`) VALUES
(12, '3464436', 'iPhone 13 Pro Max 512GB SierraBlue TRA', 'iPhone 13 Pro Max features a new Super Retina XDR display with updated ProMotion technology that allows for an always-on display, It is the first of its kind for the iPhone. Always-On Display is made possible by a new 1Hz to 120Hz refresh rate combined with improved energy efficiency technologies.', '850', '777', '2023-04-29', '41al5-lNvML._AC_UY327_QL65_.jpg', 13, '25', '20', 5, 0),
(13, '32555', 'iPhone 13 Pro 128GB SierraBlue', 'iPhone 13 Pro Max features a new Super Retina XDR display with updated ProMotion technology that allows for an always-on display, It is the first of its kind for the iPhone. Always-On Display is made possible by a new 1Hz to 120Hz refresh rate combined with improved energy efficiency technologies.', '750', '650', '2023-04-29', 'ASR1501ST0269 (1).jpg', 13, '25', '11', 5, 0),
(14, '1244421', 'iPhone 13 128GB Pink', 'iPhone 13 Pro Max features a new Super Retina XDR display with updated ProMotion technology that allows for an always-on display, It is the first of its kind for the iPhone. Always-On Display is made possible by a new 1Hz to 120Hz refresh rate combined with improved energy efficiency technologies.', '755', '688', '2023-04-29', 'ASR1501ST0267.jpg', 13, '25', '15', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `maincategort`
--

CREATE TABLE `maincategort` (
  `MainCatID` int(11) NOT NULL,
  `NameMainCat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `maincategort`
--

INSERT INTO `maincategort` (`MainCatID`, `NameMainCat`) VALUES
(1, 'Smart Phone'),
(2, 'Laptops'),
(3, 'Desktops'),
(4, 'TV & Audio'),
(5, 'Video Games'),
(6, 'SmartWatch'),
(7, 'Large Devices'),
(8, 'Car & GBS');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetalis`
--

CREATE TABLE `orderdetalis` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `NumOfItem` varchar(255) NOT NULL,
  `Total` varchar(255) NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `OrderCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `earnings` varchar(255) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `ZipCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restpassword`
--

CREATE TABLE `restpassword` (
  `UserID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `expiry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `SubCateID` int(11) NOT NULL,
  `SubCatName` varchar(255) NOT NULL,
  `SubCatCode` int(11) NOT NULL,
  `Description` text NOT NULL,
  `parentID` smallint(6) NOT NULL DEFAULT 0,
  `TimeAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`SubCateID`, `SubCatName`, `SubCatCode`, `Description`, `parentID`, `TimeAdd`) VALUES
(18, 'NOKIA', 123123, '', 13, '2023-04-12 01:47:30'),
(20, 'ipads', 12331, '', 14, '2023-04-12 03:23:54'),
(21, 'LG', 3141, '', 13, '2023-04-13 00:09:15'),
(24, 'Samsung', 75643, '', 13, '2023-04-29 17:29:39'),
(25, 'Apple', 87543, '', 13, '2023-04-29 17:31:12'),
(26, 'vivo', 54755, '', 13, '2023-04-29 17:31:36'),
(27, 'Oppo', 857643, '', 13, '2023-04-29 17:31:59'),
(28, 'Xiaomi', 85764, '', 13, '2023-04-29 17:32:15'),
(29, 'realme', 7754, '', 13, '2023-04-29 17:32:28'),
(30, 'Huawei ', 5465, '', 13, '2023-04-29 17:33:08'),
(31, 'Headsets', 32423, '', 18, '2023-04-29 17:33:27'),
(32, 'Cables & Chargers', 65435, '', 18, '2023-04-29 17:33:47'),
(33, 'Electronic Accessories', 56432, '', 18, '2023-04-29 17:33:59'),
(34, 'Selfie Sticks', 534765, '', 18, '2023-04-29 17:34:42'),
(35, 'PowerBank', 12356, '', 18, '2023-04-29 17:35:04'),
(36, 'iPads', 24535, '', 14, '2023-04-29 17:35:33'),
(37, 'Samsung', 324444, '', 13, '2023-04-29 17:35:46'),
(38, 'Microsoft Surface', 32444432, '', 14, '2023-04-29 17:36:12'),
(39, 'Lenovo', 1211, '', 14, '2023-04-29 17:36:24'),
(40, 'Innjoo ', 32432, '', 14, '2023-04-29 17:37:05'),
(41, 'For Nokia', 54342, '', 15, '2023-04-29 17:37:47'),
(42, 'For Oppo', 213, '', 15, '2023-04-29 17:38:06'),
(43, 'For Apple', 324234, '', 15, '2023-04-29 17:38:54'),
(44, 'For Huawei', 543, '', 15, '2023-04-29 17:39:10'),
(45, 'For LG', 533624, '', 15, '2023-04-29 17:39:20'),
(46, 'Business Laptops ', 325234, '', 16, '2023-04-29 17:40:39'),
(47, 'Gaming Laptops', 35462453, '', 16, '2023-04-29 17:40:57'),
(48, 'Touch Laptops', 65243, '', 16, '2023-04-29 17:41:15'),
(49, 'adapter', 231, '', 19, '2023-04-29 17:42:49'),
(50, 'Laptop Stand', 65432, '', 19, '2023-04-29 17:43:38'),
(51, 'Laptop Charger ', 3233, '', 19, '2023-04-29 17:43:59'),
(52, 'AMD', 3425, '', 20, '2023-04-29 17:45:01'),
(53, 'Intel', 435345, '', 20, '2023-04-29 17:45:13'),
(54, 'AMD', 234, '', 21, '2023-04-29 17:46:08'),
(55, 'NVIDIA ', 321, '', 21, '2023-04-29 17:46:26'),
(56, 'Intel', 466543, '', 21, '2023-04-29 17:46:58'),
(57, 'DDR3', 7654, '', 27, '2023-04-29 17:48:15'),
(58, 'DDR4', 213333, '', 27, '2023-04-29 17:48:24'),
(59, 'DDR5', 1223133, '', 27, '2023-04-29 17:48:35'),
(60, 'Dell', 2133, '', 25, '2023-04-29 17:55:13'),
(61, 'HP', 213233, '', 25, '2023-04-29 17:55:20'),
(62, 'Lenovo', 76786, '', 25, '2023-04-29 17:57:15'),
(63, 'DDR3', 543221, '', 29, '2023-04-29 17:58:08'),
(64, 'DDR4', 98765432, '', 29, '2023-04-29 17:58:15'),
(65, 'DDR5', 213567, '', 29, '2023-04-29 17:58:29'),
(66, 'NVIDIA ', 9878769, '', 30, '2023-04-29 17:58:52'),
(67, 'Intel', 8970987, '', 30, '2023-04-29 17:59:02'),
(68, 'AMD', 9800, '', 30, '2023-04-29 17:59:18'),
(69, 'SSD', 78688, '', 31, '2023-04-29 17:59:35'),
(70, 'HDD', 78675, '', 31, '2023-04-29 17:59:54'),
(71, 'Intel', 87656, '', 28, '2023-04-29 18:00:21'),
(72, 'AMD', 9876, '', 28, '2023-04-29 18:00:31'),
(73, 'Mouse', 78888, '', 32, '2023-04-29 18:01:16'),
(74, 'Keyborad', 87667, '', 32, '2023-04-29 18:01:26'),
(75, 'Mouse pad', 6546, '', 32, '2023-04-29 18:02:01'),
(76, 'Headphone', 9000, '', 32, '2023-04-29 18:02:19'),
(77, 'Dell', 67677, '', 26, '2023-04-29 18:04:03'),
(78, 'HP', 636666, '', 26, '2023-04-29 18:04:11'),
(79, 'Asus', 7687543, '', 25, '2023-04-29 18:04:26'),
(80, 'Smart TVs', 4543, '', 33, '2023-04-29 18:07:02'),
(81, '4K TVs', 64344, '', 33, '2023-04-29 18:07:13'),
(82, 'Full HD TVs', 7656432, '', 33, '2023-04-29 18:07:24'),
(83, 'Large Screen TVs', 678978, '', 33, '2023-04-29 18:07:33'),
(84, 'Speakers', 954665, '', 34, '2023-04-29 18:08:07'),
(85, 'Home Theaters', 98765, '', 34, '2023-04-29 18:08:21'),
(86, 'Projectors', 756435, '', 34, '2023-04-29 18:08:41'),
(87, 'Headphones', 7547547, '', 34, '2023-04-29 18:08:54'),
(88, 'Noise Cancelling Headphones', 58989, '', 34, '2023-04-29 18:09:05'),
(89, 'Soundbars', 987878, '', 34, '2023-04-29 18:09:20'),
(90, 'playstation 1', 21122, '', 35, '2023-04-29 18:14:27'),
(91, 'playstation 2', 0, '', 35, '2023-04-29 18:14:34'),
(92, 'playstation 3', 214244, '', 35, '2023-04-29 18:14:54'),
(93, 'playstation 4', 124444, '', 35, '2023-04-29 18:15:02'),
(94, 'playstation 5', 555115, '', 35, '2023-04-29 18:15:13'),
(95, 'Sell Xbox 360', 344444, '', 36, '2023-04-29 18:17:41'),
(96, 'Xbox One', 54555, '', 36, '2023-04-29 18:18:03'),
(97, 'Xbox Games', 976854, '', 36, '2023-04-29 18:18:23'),
(98, 'Nintendo Switch', 6435, '', 37, '2023-04-29 18:21:04'),
(99, 'Nintendo Switch Lite', 676888, '', 37, '2023-04-29 18:21:13'),
(100, 'Nintendo Game', 7865432, '', 37, '2023-04-29 18:21:26'),
(101, 'PlayStation VR', 412444, '', 38, '2023-04-29 18:21:51'),
(102, 'HTC Vive', 2144, '', 38, '2023-04-29 18:23:00'),
(103, 'Microsoft', 754355, '', 38, '2023-04-29 18:23:11'),
(104, 'Apple', 24444, '', 39, '2023-04-29 18:35:09'),
(105, 'Samsung', 33333, '', 39, '2023-04-29 18:35:17'),
(106, 'Huawei Watch', 333112, '', 39, '2023-04-29 18:35:49'),
(107, 'Fossil', 231313, '', 39, '2023-04-29 18:36:18'),
(108, 'Refrigerators', 422144, '', 44, '2023-04-29 18:45:14'),
(109, ' Dishwashers', 2133333, '', 44, '2023-04-29 18:45:30'),
(110, 'Dryers', 8765432, '', 44, '2023-04-29 18:45:51'),
(111, ' Fryers', 978654, '', 44, '2023-04-29 18:46:13'),
(112, 'Air Conditioners', 5325355, '', 45, '2023-04-29 18:46:47'),
(113, 'Fan', 523555, '', 45, '2023-04-29 18:47:05'),
(114, 'Microwaves', 255555, '', 46, '2023-04-29 18:48:27'),
(115, 'Ovens', 1567865, '', 46, '2023-04-29 18:48:38'),
(116, 'Stove', 786888, '', 46, '2023-04-29 18:49:47'),
(117, 'Music Systems', 3242355, '', 47, '2023-04-29 18:52:40'),
(118, 'Video Systems', 555112, '', 47, '2023-04-29 18:52:53'),
(119, 'Speakers', 1244441, '', 47, '2023-04-29 18:53:02'),
(120, 'Car Monitors', 124122, '', 47, '2023-04-29 18:53:09'),
(121, 'Car Parts', 21333312, '', 47, '2023-04-29 18:53:20'),
(122, 'Gps Tracking Devices', 124214214, '', 48, '2023-04-29 18:54:06'),
(123, 'GPS Networking Devices', 125125, '', 48, '2023-04-29 18:54:17'),
(124, 'GPS Monitoring', 1251555, '', 48, '2023-04-29 18:54:26'),
(125, 'Car Accessories', 325, '', 49, '2023-04-29 18:55:31'),
(126, 'Car & Bike Care', 34490987, '', 49, '2023-04-29 18:55:39'),
(127, 'Car Electronics', 764575347, '', 49, '2023-04-29 18:55:50'),
(128, 'Car Parts', 754754, '', 49, '2023-04-29 18:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID` int(11) NOT NULL,
  `SupplierName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Avater` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID`, `SupplierName`, `email`, `Country`, `State`, `phone`, `Description`, `Avater`) VALUES
(1, 'abood', 'alnjjar121@gmail.com', '-1', '-1', '312', 'fdfsf', '2.png'),
(4, 'abood', 'alnjjar12321@gmail.com', 'Antigua and Barbuda', 'Redonda', '1233123', '123312', 'download (2).png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Password` varchar(255) NOT NULL COMMENT 'pass to login',
  `Email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `Country` varchar(222) NOT NULL,
  `State` varchar(222) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Avater` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'identify group id',
  `TrustState` int(11) NOT NULL DEFAULT 0 COMMENT 'seller rank',
  `RegState` int(11) NOT NULL DEFAULT 0 COMMENT 'user accept '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `UserID`, `Password`, `Email`, `phone`, `Country`, `State`, `Fullname`, `Avater`, `GroupID`, `TrustState`, `RegState`) VALUES
('Abood', 'Alnjjar', 60, 'bcd224a38d6d2fb308e305e1be62bab4e0b7ed28', 'alnjjar121@gmail.com', '+962 0781211215', 'Jordan', '\'Amman', 'Abood Alnjjar', 'avatar.png', 1, 0, 0),
('ali', 'nader', 76, '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'nader@gmail.com', '6546465', 'Antigua and Barbuda', 'Saint Philip', 'ali nader', 'avatar.png', 0, 0, 0),
('Abady', 'Kh', 77, '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'Abady@gamil.com', '+1 07999999', 'Jordan', 'Al Balqa\'', 'Abady Kh', 'avatar.png', 1, 0, 0),
('user', 'user', 78, '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'user@gmail.com', '+93 44354434', 'Armenia', 'Vayots\' Dzor', 'user user', 'avatar.png', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `itemadd` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk-7` (`ItemID`),
  ADD KEY `fk-8` (`UserID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`),
  ADD UNIQUE KEY `CategoryCode` (`CategoryCode`),
  ADD KEY `fk-6` (`parentID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ProductCode` (`ItemCodes`);

--
-- Indexes for table `maincategort`
--
ALTER TABLE `maincategort`
  ADD PRIMARY KEY (`MainCatID`);

--
-- Indexes for table `orderdetalis`
--
ALTER TABLE `orderdetalis`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `fk-22` (`UserID`);

--
-- Indexes for table `restpassword`
--
ALTER TABLE `restpassword`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`SubCateID`),
  ADD UNIQUE KEY `SubCatCode` (`SubCatCode`),
  ADD KEY `fk-1` (`parentID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk-12` (`UserID`),
  ADD KEY `fk-13` (`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `maincategort`
--
ALTER TABLE `maincategort`
  MODIFY `MainCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderdetalis`
--
ALTER TABLE `orderdetalis`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restpassword`
--
ALTER TABLE `restpassword`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `SubCateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk-7` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-8` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk-6` FOREIGN KEY (`parentID`) REFERENCES `maincategort` (`MainCatID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetalis`
--
ALTER TABLE `orderdetalis`
  ADD CONSTRAINT `fk-22` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `fk-1` FOREIGN KEY (`parentID`) REFERENCES `category` (`CategoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk-12` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-13` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
