-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2025 at 09:35 AM
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
-- Database: `expense`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_auth`
--

CREATE TABLE `t_auth` (
  `id` int(11) NOT NULL,
  `c_username` varchar(100) DEFAULT NULL,
  `c_name` varchar(100) DEFAULT NULL,
  `c_password` longtext DEFAULT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `c_theme` varchar(100) DEFAULT NULL,
  `c_datetime` datetime DEFAULT NULL,
  `c_datetime_email` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_auth`
--

INSERT INTO `t_auth` (`id`, `c_username`, `c_name`, `c_password`, `c_email`, `c_theme`, `c_datetime`, `c_datetime_email`) VALUES
(9, 'adzka', NULL, '$2y$10$TpGu2QfrRuGAs1mDdQai6edGV5e1nVOVUMmUw032YGnZbdtFhZnkS', 'adzka.sfr@gmail.com', '#103c84', '2025-02-27 19:59:00', NULL),
(10, 'fahmi', NULL, '$2y$10$ZFSzjA96LE6uK1ACE2U7fOF0/aQB5pGRziIaWbI53q9x1H/ba2f7u', NULL, NULL, '2025-08-29 10:11:04', NULL),
(11, 'tes', NULL, '$2y$10$ava9b0i0YwqC6cO7DJ81JuUvSczDO7T78mO7fzDGmUTkpZrIpPsp2', NULL, NULL, '2025-10-23 13:13:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_budget`
--

CREATE TABLE `t_budget` (
  `id` int(11) NOT NULL,
  `c_category` int(11) DEFAULT NULL,
  `c_username` varchar(100) DEFAULT NULL,
  `c_budget` decimal(15,0) DEFAULT NULL,
  `c_month` varchar(100) DEFAULT NULL,
  `c_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_category`
--

CREATE TABLE `t_category` (
  `id` int(11) NOT NULL,
  `c_name` varchar(100) DEFAULT NULL COMMENT 'Transportasi Makan dll',
  `c_username` varchar(100) DEFAULT NULL,
  `c_datetime` datetime DEFAULT NULL,
  `c_status` varchar(100) DEFAULT NULL,
  `c_icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_icon`
--

CREATE TABLE `t_icon` (
  `id` int(11) NOT NULL,
  `c_name` varchar(100) DEFAULT NULL,
  `c_code` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_icon`
--

INSERT INTO `t_icon` (`id`, `c_name`, `c_code`) VALUES
(1, 'rumah 1', 'fa-solid fa-home'),
(2, 'user', 'fa-solid fa-user'),
(3, 'tanda pengenal', 'fa-solid fa-address-card'),
(4, 'apel', 'fa-solid fa-apple-whole'),
(5, 'bayi', 'fa-solid fa-baby'),
(6, 'tas', 'fa-solid fa-bag-shopping'),
(7, 'tas indomaret', 'fa-solid fa-basket-shopping'),
(8, 'mandi', 'fa-solid fa-bath'),
(9, 'turu', 'fa-solid fa-bed'),
(10, 'lonceng', 'fa-solid fa-bell'),
(11, 'sepeda', 'fa-solid fa-bicycle'),
(13, 'bom', 'fa-solid fa-bomb'),
(14, 'buku', 'fa-solid fa-book'),
(15, 'bibel', 'fa-solid fa-book-bible'),
(16, 'Al-Quran', 'fa-solid fa-book-quran'),
(19, 'otak', 'fa-solid fa-brain'),
(20, 'cat', 'fa-solid fa-brush'),
(21, 'bis', 'fa-solid fa-bus'),
(23, 'kalkulator', 'fa-solid fa-calculator'),
(24, 'kalender', 'fa-solid fa-calendar'),
(25, 'kalender hari', 'fa-solid fa-calendar-days'),
(26, 'kamera', 'fa-solid fa-camera'),
(27, 'kamera retro', 'fa-solid fa-camera-retro'),
(28, 'mobil', 'fa-solid fa-car'),
(29, 'troli', 'fa-solid fa-cart-shopping'),
(30, 'ceklis', 'fa-solid fa-check'),
(31, 'anak', 'fa-solid fa-child'),
(33, 'gereja', 'fa-solid fa-church'),
(34, 'user bulat', 'fa-solid fa-circle-user'),
(35, 'papan', 'fa-solid fa-clipboard'),
(36, 'awan', 'fa-solid fa-cloud'),
(37, 'hujan', 'fa-solid fa-cloud-showers-heavy'),
(38, 'chat', 'fa-solid fa-comment'),
(39, 'chat berdua', 'fa-solid fa-comments'),
(41, 'kartu', 'fa-solid fa-credit-card'),
(42, 'salib', 'fa-solid fa-cross'),
(43, 'burung', 'fa-solid fa-crow'),
(44, 'anjing!', 'fa-solid fa-dog'),
(45, 'paket', 'fa-solid fa-dolly'),
(46, 'tetes air', 'fa-solid fa-droplet'),
(47, 'amplop', 'fa-solid fa-envelope'),
(48, 'mata', 'fa-solid fa-eye'),
(49, 'mata coret', 'fa-solid fa-eye-slash'),
(50, 'emoji marah', 'fa-solid fa-face-angry'),
(51, 'emoji kaget', 'fa-solid fa-face-flushed'),
(52, 'emoji nyengir', 'fa-solid fa-face-grin-beam-sweat'),
(53, 'emoji wlee', 'fa-solid fa-face-grin-tongue-wink'),
(54, 'emoji cium', 'fa-solid fa-face-kiss-wink-heart'),
(55, 'emoji ketawa', 'fa-solid fa-face-laugh-squint'),
(56, 'emoji datar', 'fa-solid fa-face-meh'),
(57, 'emoji sok kasihan', 'fa-solid fa-face-rolling-eyes'),
(58, 'emoji nangis', 'fa-solid fa-face-sad-cry'),
(59, 'emoji sedih dikit', 'fa-solid fa-face-sad-tear'),
(60, 'emoji senyum', 'fa-solid fa-face-smile'),
(61, 'emoji blink', 'fa-solid fa-face-smile-wink'),
(62, 'emoji ooo', 'fa-solid fa-face-surprise'),
(63, 'emoji capek', 'fa-solid fa-face-tired'),
(65, 'dokumen', 'fa-solid fa-file'),
(66, 'film', 'fa-solid fa-film'),
(67, 'api', 'fa-solid fa-fire'),
(69, 'ikan', 'fa-solid fa-fish'),
(70, 'bendera finish', 'fa-solid fa-flag-checkered'),
(71, 'folder', 'fa-solid fa-folder'),
(72, 'permainan', 'fa-solid fa-gamepad'),
(73, 'bensin', 'fa-solid fa-gas-pump'),
(74, 'gear', 'fa-solid fa-gear'),
(75, 'hantu', 'fa-solid fa-ghost'),
(76, 'kado', 'fa-solid fa-gift'),
(77, 'kacamata', 'fa-solid fa-glasses'),
(79, 'gitar', 'fa-solid fa-guitar'),
(80, 'kak gem paham', 'fa-solid fa-hand'),
(81, 'kasih sayang', 'fa-solid fa-hand-holding-heart'),
(82, 'fucek', 'fa-solid fa-hand-middle-finger'),
(83, 'salaman', 'fa-solid fa-handshake'),
(84, 'headphone', 'fa-solid fa-headphones'),
(85, 'admin', 'fa-solid fa-headset'),
(86, 'hati', 'fa-solid fa-heart'),
(87, 'hati berdetak', 'fa-solid fa-heart-pulse'),
(88, 'kuda nil', 'fa-solid fa-hippo'),
(89, 'rumah sakit', 'fa-solid fa-hospital'),
(90, 'hotel', 'fa-solid fa-hotel'),
(92, 'gambar', 'fa-solid fa-image'),
(93, 'rokok', 'fa-solid fa-joint'),
(94, 'kunci', 'fa-solid fa-key'),
(95, 'ayam', 'fa-solid fa-kiwi-bird'),
(96, 'lemon', 'fa-solid fa-lemon'),
(97, 'lokasi', 'fa-solid fa-location-dot'),
(98, 'gembok', 'fa-solid fa-lock'),
(99, 'kaca pembesar', 'fa-solid fa-magnifying-glass'),
(100, 'hiburan', 'fa-solid fa-masks-theater'),
(102, 'uang 1', 'fa-solid fa-money-bill'),
(106, 'uang 2', 'fa-solid fa-money-bill-wave'),
(108, 'bulan', 'fa-solid fa-moon'),
(109, 'masjid', 'fa-solid fa-mosque'),
(111, 'motor', 'fa-solid fa-motorcycle'),
(112, 'kopi', 'fa-solid fa-mug-hot'),
(113, 'musik', 'fa-solid fa-music'),
(114, 'klip', 'fa-solid fa-paperclip'),
(115, 'hewan peliharaan', 'fa-solid fa-paw'),
(116, 'pensil', 'fa-solid fa-pen'),
(117, 'pensil penggaris', 'fa-solid fa-pen-ruler'),
(119, 'cabai', 'fa-solid fa-pepper-hot'),
(120, 'pria', 'fa-solid fa-person'),
(121, 'wanita', 'fa-solid fa-person-dress'),
(122, 'telepon', 'fa-solid fa-phone'),
(123, 'pizza', 'fa-solid fa-pizza-slice'),
(124, 'pesawat', 'fa-solid fa-plane'),
(125, 'colokan listrik', 'fa-solid fa-plug'),
(127, 'tai', 'fa-solid fa-poo'),
(128, 'tai ori', 'fa-solid fa-poop'),
(129, 'print', 'fa-solid fa-print'),
(131, 'toilet', 'fa-solid fa-restroom'),
(132, 'robot', 'fa-solid fa-robot'),
(133, 'rute', 'fa-solid fa-route'),
(134, 'satelit', 'fa-solid fa-satellite-dish'),
(135, 'timbangan neraca', 'fa-solid fa-scale-balanced'),
(136, 'sekolah', 'fa-solid fa-school'),
(137, 'gunting', 'fa-solid fa-scissors'),
(138, 'perbaikan', 'fa-solid fa-screwdriver-wrench'),
(140, 'kapal', 'fa-solid fa-ship'),
(141, 'baju', 'fa-solid fa-shirt'),
(142, 'shower', 'fa-solid fa-shower'),
(143, 'udang', 'fa-solid fa-shrimp'),
(144, 'sim card', 'fa-solid fa-sim-card'),
(145, 'rokok murah', 'fa-solid fa-smoking'),
(146, 'parfum', 'fa-solid fa-spray-can-sparkles'),
(147, 'bintang', 'fa-solid fa-star'),
(148, 'bulan bintang', 'fa-solid fa-star-and-crescent'),
(149, 'dokter', 'fa-solid fa-stethoscope'),
(150, 'toko', 'fa-solid fa-store'),
(151, 'taxi', 'fa-solid fa-taxi'),
(152, 'sempol', 'fa-solid fa-thermometer'),
(153, 'jempol kebawah', 'fa-solid fa-thumbs-down'),
(154, 'jempol keatas', 'fa-solid fa-thumbs-up'),
(155, 'tiket', 'fa-solid fa-ticket'),
(156, 'gigi', 'fa-solid fa-tooth'),
(157, 'seluler', 'fa-solid fa-tower-broadcast'),
(158, 'kereta', 'fa-solid fa-train'),
(159, 'kereta api', 'fa-solid fa-train-subway'),
(160, 'tempat sampah', 'fa-solid fa-trash'),
(161, 'pohon', 'fa-solid fa-tree'),
(162, 'piala', 'fa-solid fa-trophy'),
(163, 'truck', 'fa-solid fa-truck'),
(164, 'truck ngebut', 'fa-solid fa-truck-fast'),
(165, 'ambulan', 'fa-solid fa-truck-medical'),
(166, 'payung', 'fa-solid fa-umbrella'),
(168, 'kecelakaan', 'fa-solid fa-user-injured'),
(169, 'suster', 'fa-solid fa-user-nurse'),
(170, 'makan', 'fa-solid fa-utensils'),
(171, 'angkot', 'fa-solid fa-van-shuttle'),
(172, 'video', 'fa-solid fa-video'),
(174, 'air', 'fa-solid fa-water'),
(175, 'kolam renang', 'fa-solid fa-water-ladder'),
(177, 'timbangan', 'fa-solid fa-weight-scale'),
(178, 'wifi', 'fa-solid fa-wifi'),
(179, 'miras', 'fa-solid fa-wine-bottle'),
(180, 'silang', 'fa-solid fa-xmark');

-- --------------------------------------------------------

--
-- Table structure for table `t_income`
--

CREATE TABLE `t_income` (
  `id` int(11) NOT NULL,
  `c_payment` int(11) DEFAULT NULL,
  `c_nominal` decimal(15,0) DEFAULT NULL,
  `c_detail` text DEFAULT NULL,
  `c_datetime` datetime DEFAULT NULL,
  `c_username` varchar(100) DEFAULT NULL,
  `c_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_outcome`
--

CREATE TABLE `t_outcome` (
  `id` int(11) NOT NULL,
  `c_category` int(11) DEFAULT NULL,
  `c_payment` int(11) DEFAULT NULL,
  `c_nominal` decimal(15,0) DEFAULT NULL,
  `c_detail` text DEFAULT NULL,
  `c_datetime` datetime DEFAULT NULL,
  `c_username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_payment`
--

CREATE TABLE `t_payment` (
  `id` int(11) NOT NULL,
  `c_name` varchar(100) DEFAULT NULL,
  `c_username` varchar(100) DEFAULT NULL,
  `c_datetime` varchar(100) DEFAULT NULL,
  `c_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_balance`
-- (See below for the actual view)
--
CREATE TABLE `v_balance` (
`c_payment` int(11)
,`c_payment_name` varchar(100)
,`c_username` varchar(100)
,`c_total` decimal(38,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_balance_comparison`
-- (See below for the actual view)
--
CREATE TABLE `v_balance_comparison` (
`c_username` varchar(100)
,`this_month` varchar(7)
,`last_month_balance` decimal(38,0)
,`this_month_balance` decimal(38,0)
,`c_difference` decimal(39,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_category_budget_outcome`
-- (See below for the actual view)
--
CREATE TABLE `v_category_budget_outcome` (
`c_category_id` int(11)
,`c_category_name` varchar(100)
,`c_username` varchar(100)
,`c_month` varchar(100)
,`c_total_outcome` decimal(37,0)
,`c_budget` decimal(15,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_category_outcome_monthly`
-- (See below for the actual view)
--
CREATE TABLE `v_category_outcome_monthly` (
`c_category_id` int(11)
,`c_category_name` varchar(100)
,`c_username` varchar(100)
,`c_month` varchar(7)
,`c_total` decimal(37,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_monthly_balance`
-- (See below for the actual view)
--
CREATE TABLE `v_monthly_balance` (
`c_month` varchar(7)
,`c_username` varchar(100)
,`c_total_income` decimal(37,0)
,`c_total_outcome` decimal(37,0)
,`c_balance` decimal(38,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_transaction`
-- (See below for the actual view)
--
CREATE TABLE `v_transaction` (
`c_date` date
,`c_datetime` datetime
,`id` int(11)
,`c_username` varchar(100)
,`c_detail` mediumtext
,`c_nominal` decimal(15,0)
,`c_category_id` int(11)
,`c_category_name` varchar(100)
,`c_payment_id` int(11)
,`c_payment_name` varchar(100)
,`c_category_icon` varchar(100)
,`c_status` varchar(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_balance`
--
DROP TABLE IF EXISTS `v_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_balance`  AS SELECT `p`.`id` AS `c_payment`, `p`.`c_name` AS `c_payment_name`, `p`.`c_username` AS `c_username`, coalesce(`income`.`total_income`,0) - coalesce(`outcome`.`total_outcome`,0) AS `c_total` FROM ((`t_payment` `p` left join (select `t_income`.`c_payment` AS `c_payment`,`t_income`.`c_username` AS `c_username`,sum(`t_income`.`c_nominal`) AS `total_income` from `t_income` group by `t_income`.`c_payment`,`t_income`.`c_username`) `income` on(`p`.`id` = `income`.`c_payment` and `p`.`c_username` = `income`.`c_username`)) left join (select `t_outcome`.`c_payment` AS `c_payment`,`t_outcome`.`c_username` AS `c_username`,sum(`t_outcome`.`c_nominal`) AS `total_outcome` from `t_outcome` group by `t_outcome`.`c_payment`,`t_outcome`.`c_username`) `outcome` on(`p`.`id` = `outcome`.`c_payment` and `p`.`c_username` = `outcome`.`c_username`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_balance_comparison`
--
DROP TABLE IF EXISTS `v_balance_comparison`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_balance_comparison`  AS SELECT `curr`.`c_username` AS `c_username`, `curr`.`c_month` AS `this_month`, coalesce(`prev`.`c_balance`,0) AS `last_month_balance`, `curr`.`c_balance` AS `this_month_balance`, `curr`.`c_balance`- coalesce(`prev`.`c_balance`,0) AS `c_difference` FROM ((select `v_monthly_balance`.`c_username` AS `c_username`,`v_monthly_balance`.`c_month` AS `c_month`,`v_monthly_balance`.`c_balance` AS `c_balance`,str_to_date(concat(`v_monthly_balance`.`c_month`,'-01'),'%Y-%m-%d') AS `formatted_date` from `v_monthly_balance`) `curr` left join (select `v_monthly_balance`.`c_username` AS `c_username`,`v_monthly_balance`.`c_month` AS `c_month`,`v_monthly_balance`.`c_balance` AS `c_balance`,str_to_date(concat(`v_monthly_balance`.`c_month`,'-01'),'%Y-%m-%d') AS `formatted_date` from `v_monthly_balance`) `prev` on(`curr`.`c_username` = `prev`.`c_username` and `prev`.`formatted_date` = `curr`.`formatted_date` - interval 1 month)) ORDER BY `curr`.`c_username` ASC, `curr`.`c_month` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_category_budget_outcome`
--
DROP TABLE IF EXISTS `v_category_budget_outcome`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_category_budget_outcome`  AS SELECT `a`.`id` AS `c_category_id`, `a`.`c_name` AS `c_category_name`, `a`.`c_username` AS `c_username`, `c`.`c_month` AS `c_month`, coalesce(`b`.`total_nominal`,0) AS `c_total_outcome`, `c`.`c_budget` AS `c_budget` FROM ((`t_category` `a` join `t_budget` `c` on(`a`.`id` = `c`.`c_category` and `a`.`c_username` = `c`.`c_username`)) left join (select `b`.`c_category` AS `c_category`,`b`.`c_username` AS `c_username`,date_format(`b`.`c_datetime`,'%Y-%m') AS `month`,sum(`b`.`c_nominal`) AS `total_nominal` from `t_outcome` `b` group by `b`.`c_category`,`b`.`c_username`,date_format(`b`.`c_datetime`,'%Y-%m')) `b` on(`a`.`id` = `b`.`c_category` and `a`.`c_username` = `b`.`c_username` and `c`.`c_month` = `b`.`month`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_category_outcome_monthly`
--
DROP TABLE IF EXISTS `v_category_outcome_monthly`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_category_outcome_monthly`  AS SELECT `a`.`id` AS `c_category_id`, `a`.`c_name` AS `c_category_name`, `a`.`c_username` AS `c_username`, date_format(`b`.`c_datetime`,'%Y-%m') AS `c_month`, sum(`b`.`c_nominal`) AS `c_total` FROM (`t_category` `a` join `t_outcome` `b` on(`a`.`id` = `b`.`c_category` and `a`.`c_username` = `b`.`c_username`)) GROUP BY `a`.`id`, `a`.`c_name`, `a`.`c_username`, date_format(`b`.`c_datetime`,'%Y-%m') ;

-- --------------------------------------------------------

--
-- Structure for view `v_monthly_balance`
--
DROP TABLE IF EXISTS `v_monthly_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_monthly_balance`  AS SELECT `month_data`.`c_month` AS `c_month`, `month_data`.`c_username` AS `c_username`, coalesce(`income`.`c_total_income`,0) AS `c_total_income`, coalesce(`outcome`.`c_total_outcome`,0) AS `c_total_outcome`, coalesce(`income`.`c_total_income`,0) - coalesce(`outcome`.`c_total_outcome`,0) AS `c_balance` FROM (((select distinct date_format(`t_income`.`c_datetime`,'%Y-%m') AS `c_month`,`t_income`.`c_username` AS `c_username` from `t_income` union select distinct date_format(`t_outcome`.`c_datetime`,'%Y-%m') AS `c_month`,`t_outcome`.`c_username` AS `c_username` from `t_outcome`) `month_data` left join (select date_format(`t_income`.`c_datetime`,'%Y-%m') AS `c_month`,`t_income`.`c_username` AS `c_username`,sum(`t_income`.`c_nominal`) AS `c_total_income` from `t_income` group by date_format(`t_income`.`c_datetime`,'%Y-%m'),`t_income`.`c_username`) `income` on(`month_data`.`c_month` = `income`.`c_month` and `month_data`.`c_username` = `income`.`c_username`)) left join (select date_format(`t_outcome`.`c_datetime`,'%Y-%m') AS `c_month`,`t_outcome`.`c_username` AS `c_username`,sum(`t_outcome`.`c_nominal`) AS `c_total_outcome` from `t_outcome` group by date_format(`t_outcome`.`c_datetime`,'%Y-%m'),`t_outcome`.`c_username`) `outcome` on(`month_data`.`c_month` = `outcome`.`c_month` and `month_data`.`c_username` = `outcome`.`c_username`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_transaction`
--
DROP TABLE IF EXISTS `v_transaction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaction`  AS SELECT cast(`i`.`c_datetime` as date) AS `c_date`, `i`.`c_datetime` AS `c_datetime`, `i`.`id` AS `id`, `i`.`c_username` AS `c_username`, `i`.`c_detail` AS `c_detail`, `i`.`c_nominal` AS `c_nominal`, `i`.`c_category` AS `c_category_id`, `c`.`c_name` AS `c_category_name`, `i`.`c_payment` AS `c_payment_id`, `p`.`c_name` AS `c_payment_name`, `c`.`c_icon` AS `c_category_icon`, 'pemasukan' AS `c_status` FROM ((`t_income` `i` join `t_category` `c` on(`i`.`c_category` = `c`.`id`)) join `t_payment` `p` on(`i`.`c_payment` = `p`.`id`))union all select cast(`o`.`c_datetime` as date) AS `c_date`,`o`.`c_datetime` AS `c_datetime`,`o`.`id` AS `id`,`o`.`c_username` AS `c_username`,`o`.`c_detail` AS `c_detail`,`o`.`c_nominal` AS `c_nominal`,`o`.`c_category` AS `c_category_id`,`c`.`c_name` AS `c_category_name`,`o`.`c_payment` AS `c_payment_id`,`p`.`c_name` AS `c_payment_name`,`c`.`c_icon` AS `c_category_icon`,'pengeluaran' AS `c_status` from ((`t_outcome` `o` join `t_category` `c` on(`o`.`c_category` = `c`.`id`)) join `t_payment` `p` on(`o`.`c_payment` = `p`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_auth`
--
ALTER TABLE `t_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_budget`
--
ALTER TABLE `t_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_icon`
--
ALTER TABLE `t_icon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_income`
--
ALTER TABLE `t_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_outcome`
--
ALTER TABLE `t_outcome`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_payment`
--
ALTER TABLE `t_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_auth`
--
ALTER TABLE `t_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_budget`
--
ALTER TABLE `t_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `t_icon`
--
ALTER TABLE `t_icon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `t_income`
--
ALTER TABLE `t_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `t_outcome`
--
ALTER TABLE `t_outcome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `t_payment`
--
ALTER TABLE `t_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
