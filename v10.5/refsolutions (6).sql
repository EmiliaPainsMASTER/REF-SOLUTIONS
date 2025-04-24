-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2025 at 03:49 PM
-- Server version: 9.1.0
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `refsolutions`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'adminpass');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int NOT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `Address` text,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerName`, `Address`, `Email`) VALUES
(1, 'rob', 'sf tseebe ', 'rob@gmail.com'),
(2, 'Ruben Sob', '32 street', 'ruben@gmail.com'),
(3, 'rub', '32 rfer', 'sob@gmail.com'),
(4, 'sdfsdf', 'sdfsdf', 'rob@gmail.com'),
(5, 'Kobena', 'Adamstown', 'rob@gmail.com'),
(6, 'steve', '23 dtg', 'SteveJobs@myspace.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemID` int NOT NULL,
  `OrderID` int DEFAULT NULL,
  `ProductID` int DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `Price`) VALUES
(1, 1, 3, 1, 1500.00),
(2, 2, 3, 1, 1500.00),
(3, 3, 4, 1, 800.00),
(4, 4, 3, 1, 1500.00),
(5, 5, 2, 1, 1299.99),
(6, 5, 7, 1, 2199.00),
(7, 5, 4, 1, 800.00),
(8, 6, 2, 2, 1299.99),
(9, 6, 1, 2, 2499.99),
(10, 6, 8, 1, 3299.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int NOT NULL,
  `Price` double NOT NULL,
  `Image` varchar(100) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `ProductDesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Price`, `Image`, `ProductName`, `ProductDesc`) VALUES
(1, 2499.99, '/img/cisco_ucs.jpg', 'Cisco UCS', 'Cisco product'),
(2, 1299.99, '/img/hpe_proliant.jpg', 'HPE ProLiant Series', 'Versatile, manageable, and robust. Suitable for various workloads and environments.'),
(3, 1500, '/img/dell_poweredge.jpg', 'Dell Poweredge', 'It\'s a Dell!'),
(4, 800, '/img/ibm.jpg', 'IBM Power Systems', 'International British Machine'),
(5, 999.51, '/img/lenovo_thinksystem.jpg', 'Lenovo Thinksystem', 'This server thinks? I think?'),
(6, 310, '/img/hp1.jpeg', 'HP 15 Silver Fusion 15.6', 'HP 15 Silver Fusion 15.6 Touchscreen Laptop, Intel Core i3-8130U, 1TB HDD 16GB Intel Optane Memory.'),
(7, 2199, '/img/Asus1.png', 'Asus zenbook 14', 'ASUS Zenbook 14 OLED.it is powered by Intel® Core™ Ultra 7 Processor and Intel Arc™ Graphics.'),
(8, 3299, '/img/Asus2.png', 'Asus Zenbook Duo', 'ASUS Zenbook DUO features dual 14-inch 3K OLED. Powered by Intel® ARL H Core™ Ultra 9 Processor.'),
(9, 499.99, '/img/hp2.png', 'HP Laptop 15', 'Windows 11 Home Processor: AMD Ryzen™ 5 7520U Memory size: 8 GB LPDDR5 Battery life: Up to 10 hours'),
(10, 799.99, '/img/PS5.jpeg', 'PlayStation®5 Pro', 'PS5 Pro is an upgrade over PS5,faster processor, additional storage and graphics upscaling.'),
(11, 399.99, '/img/Dell1.jpeg', 'Dell XPS 9315', 'Windows 11 Pro, 64-bit.12th Generation Intel® Core™ i5-1230U. Intel® Iris Xe Graphics. '),
(12, 90.99, '/img/Cisco1.jpeg', 'Cisco Catalyst 2960X-48LPS-L POE Switch', 'Switch series number:2960\r\nNumber of ports:48\r\nDownlink ports: PoE enabled port\r\nCisco IOS:LAN Base'),
(13, 230, '/img/Nintendo1.jpeg', 'Nintendo Switch Console', 'Nintendo Switch Console, 32GB + Neon Red/Blue Joy-Con, Unboxed.'),
(14, 591.99, '/img/Server1.jpeg', '4-Post 18U Server Rack Cabinet', '4-Post 18U Server Rack Cabinet, Data Rack Cabinet for Computer Network Rack with Casters'),
(15, 389, '/img/Sony1.jpeg', 'Sony sound bar HT-S40R', '5.1ch Home Cinema with Wireless Rear Speakers | HT-S40R'),
(16, 1820, '/img/Lenovo1.jpeg', 'ThinkPad X13 2-in-1 Gen 5', 'ThinkPad X13 2-in-1 Gen 5 (13″ Intel)\r\nUSB-C® 65W, supports Rapid Charge\r\nLenovo Integrated Pen'),
(17, 649.99, '/img/Lenovo2.jpg', 'Lenovo 15.6\" IdeaPad Slim 3', 'Lenovo 15.6\" IdeaPad Slim 3 | Intel Core i5 Processer | 8GB RAM | 512GB SSD | Arctic Grey'),
(18, 1099.99, '/img/Iphone16.jpeg', 'iPhone 16 Pro Max', 'iPhone 16 Pro Max 1TB Gold color'),
(19, 399.99, '/img/SamsungA35.jpeg', 'Samsung A35', 'Galaxy A35 5G Unlocked | 128GB | Awesome Lilac'),
(20, 871.99, '/img/Macbook.jpeg', 'MacBook Pro 13-inch (2022)', 'MacBook Pro 13-inch (2022) - Apple M2 8-core and 10-core GPU - 8GB RAM - SSD 256GB - AZERTY');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `PurchaseID` int NOT NULL,
  `Date` date NOT NULL,
  `AccountID` int NOT NULL,
  `Total` double NOT NULL,
  `Quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`PurchaseID`, `Date`, `AccountID`, `Total`, `Quantity`) VALUES
(5, '2025-04-24', 1, 2099.99, 2),
(6, '2025-04-24', 1, 1500, 1),
(7, '2025-04-24', 1, 6000, 4),
(8, '2025-04-24', 1, 12000, 8),
(9, '2025-04-24', 1, 2499.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `PurchaseID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int DEFAULT NULL,
  `Price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`PurchaseID`, `ProductID`, `Quantity`, `Price`) VALUES
(5, 2, 1, 1299.99),
(5, 4, 1, 800),
(6, 3, 1, 1500),
(7, 3, 4, 1500),
(8, 3, 8, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id` int NOT NULL,
  `seller_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `eircode` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `seller_name`, `email`, `item_name`, `quantity`, `eircode`, `country`) VALUES
(1, 'ron', 'rob@gmail.com', 'HP laptop', 2, 'adafc', 'Ireland');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int NOT NULL,
  `Email` varchar(50) NOT NULL,
  `FName` varchar(40) NOT NULL,
  `SName` varchar(40) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Age` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `Email`, `FName`, `SName`, `Password`, `Age`) VALUES
(1, 'SteveJobs@myspace.com', 'Steve', 'Jobs', 'password', '2000-10-05'),
(4, 'Emiliapains2001@gmail.com', 'Daniel', 'H', 'Emiliaa16', '2001-02-18'),
(5, 'Emiliapains2001@gmail.com', 'D', 'HJ', 'eMILIAA16', '2001-02-18'),
(6, 'rob@gmail.com', 'rob', 'hob', '12', '2025-04-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`PurchaseID`),
  ADD KEY `AccountID` (`AccountID`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`PurchaseID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `OrderItemID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `PurchaseID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD CONSTRAINT `purchase_products_ibfk_1` FOREIGN KEY (`PurchaseID`) REFERENCES `purchases` (`PurchaseID`),
  ADD CONSTRAINT `purchase_products_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
