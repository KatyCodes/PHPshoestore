--
-- Database: `shoes`
--
CREATE DATABASE IF NOT EXISTS `shoes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shoes`;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_name` varchar(255) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_name`, `id`) VALUES
('Nike ', 89),
('Kate Spade', 90);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_name` varchar(255) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_name`, `id`) VALUES
('SW 5th and Washington ', 44),
('Time2', 45);

-- --------------------------------------------------------

--
-- Table structure for table `stores_brands`
--

CREATE TABLE `stores_brands` (
  `store_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores_brands`
--

INSERT INTO `stores_brands` (`store_id`, `brand_id`, `id`) VALUES
(24, 12, 1),
(3, 20, 2),
(3, 21, 3),
(3, 22, 4),
(3, 23, 5),
(3, 24, 6),
(3, 25, 7),
(3, 26, 8),
(3, 27, 9),
(3, 28, 10),
(3, 29, 11),
(5, 30, 12),
(4, 31, 13),
(5, 32, 14),
(3, 33, 15),
(5, 34, 16),
(5, 35, 17),
(5, 36, 18),
(3, 37, 19),
(3, 38, 20),
(3, 39, 21),
(3, 40, 22),
(5, 41, 23),
(5, 42, 24),
(5, 43, 25),
(3, 44, 26),
(3, 45, 27),
(3, 46, 28),
(3, 47, 29),
(3, 48, 30),
(3, 49, 31),
(9, 50, 32),
(9, 51, 33),
(12, 52, 34),
(13, 53, 35),
(12, 54, 36),
(12, 55, 37),
(12, 56, 38),
(12, 57, 39),
(12, 58, 40),
(14, 60, 41),
(14, 61, 42),
(17, 69, 43),
(29, 74, 44),
(29, 75, 45),
(33, 76, 46),
(33, 77, 47),
(33, 78, 48),
(29, 79, 49),
(37, 80, 50),
(37, 81, 51),
(40, 85, 52),
(40, 85, 53),
(41, 85, 54),
(40, 86, 55),
(40, 86, 56),
(42, 86, 57),
(42, 87, 58),
(43, 88, 59),
(40, 88, 60),
(45, 89, 61),
(45, 90, 62),
(45, 90, 63),
(44, 90, 64);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores_brands`
--
ALTER TABLE `stores_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `stores_brands`
--
ALTER TABLE `stores_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
