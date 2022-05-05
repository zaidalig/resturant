-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 08:51 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time_in` varchar(50) DEFAULT NULL,
  `time_out` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `num_hr` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `biometrics_attendance`
--

CREATE TABLE `biometrics_attendance` (
  `bio_id` int(11) NOT NULL,
  `biometric_num` text NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `employee_name` varchar(50) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `dtr_day` varchar(20) DEFAULT NULL,
  `time_in` varchar(20) DEFAULT NULL,
  `time_out` varchar(20) DEFAULT NULL,
  `dtr_breakin` varchar(20) DEFAULT NULL,
  `dtr_breakout` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `num_hr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date_today` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biometrics_attendance`
--

INSERT INTO `biometrics_attendance` (`bio_id`, `biometric_num`, `employee_id`, `employee_name`, `date`, `dtr_day`, `time_in`, `time_out`, `dtr_breakin`, `dtr_breakout`, `status`, `num_hr`, `date_today`) VALUES
(3, '6231415', 1, 'John Smith', '2021-11-15', 'Monday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(4, '6231415', 1, 'John Smith', '2021-11-16', 'Tuesday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(5, '6231415', 1, 'John Smith', '2021-11-17', 'Wednesday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(6, '6231415', 1, 'John Smith', '2021-11-18', 'Thursday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(7, '6231415', 1, 'John Smith', '2021-11-19', 'Friday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(8, '6231415', 1, 'John Smith', '2021-11-20', 'Saturday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(9, '6231415', 1, 'John Smith', '2021-11-22', 'Monday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(10, '6231415', 1, 'John Smith', '2021-11-23', 'Tuesday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(11, '6231415', 1, 'John Smith', '2021-11-24', 'Wednesday', '7:05:23', '16:15:00', '', '', 0, '9.16', NULL),
(12, '6231415', 1, 'John Smith', '2021-11-25', 'Thursday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(13, '6231415', 1, 'John Smith', '2021-11-26', 'Friday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(14, '6231415', 1, 'John Smith', '2021-11-27', 'Saturday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(15, '6231415', 1, 'John Smith', '2021-11-29', 'Monday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL),
(16, '6231415', 1, 'John Smith', '2021-11-30', 'Tuesday', '6:45:32', '16:15:00', '', '', 1, '9.49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `cash_id` int(11) NOT NULL,
  `date_advance` varchar(20) DEFAULT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`cash_id`, `date_advance`, `employee_id`, `amount`) VALUES
(1, '2021-11-16', '1', '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `del_det_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`del_det_id`, `delivery_id`, `menu_id`, `quantity`) VALUES
(1, 1, 39, '5.00'),
(2, 1, 37, '1.00'),
(3, 1, 3, '1.00'),
(4, 1, 40, '2.00'),
(5, 2, 40, '2.00'),
(6, 0, 5, '1.00'),
(7, 0, 8, '2.00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details_tmp`
--

CREATE TABLE `delivery_details_tmp` (
  `del_det_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_head`
--

CREATE TABLE `delivery_head` (
  `delivery_id` int(11) NOT NULL,
  `delivery_date` varchar(20) DEFAULT NULL,
  `register_id` int(11) NOT NULL DEFAULT 0,
  `address` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `delivered` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_head`
--

INSERT INTO `delivery_head` (`delivery_id`, `delivery_date`, `register_id`, `address`, `remarks`, `delivered`) VALUES
(1, '2021-11-18', 3, 'Sample Address', 'Sample Only', 1),
(2, '2021-11-18', 3, 'asdadsas asd', 'asd asd', 1),
(3, '2021-11-18', 3, 'test', 'test', 0),
(4, '2021-11-18', 3, 'test', 'test', 0),
(5, '2021-11-18', 3, 'sadads', 'asdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_number` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birthdate` varchar(20) DEFAULT NULL,
  `contact_info` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `created_on` varchar(20) DEFAULT NULL,
  `sss_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `philhealth_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pagibig_amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_number`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`, `sss_amount`, `philhealth_amount`, `pagibig_amount`) VALUES
(1, '6231415', 'John', 'Smith', 'Sample Address 101', '1997-06-23', '091234564789', 'Male', 2, 1, 'avatar.png', '2021-11-18 02:38:54', '375.00', '300.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `huts`
--

CREATE TABLE `huts` (
  `hut_id` int(11) NOT NULL,
  `hut_name` varchar(100) DEFAULT NULL,
  `reserved` int(11) NOT NULL DEFAULT 0,
  `hut_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huts`
--

INSERT INTO `huts` (`hut_id`, `hut_name`, `reserved`, `hut_image`) VALUES
(1, 'Huts 1', 1, 'no-image-available.png'),
(2, 'Huts 2', 0, 'no-image-available.png'),
(3, 'Huts 3', 0, 'Huts 3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menucat_id` int(11) NOT NULL DEFAULT 0,
  `menu_name` text DEFAULT NULL,
  `menu_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `menu_desc` text DEFAULT NULL,
  `menu_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menucat_id`, `menu_name`, `menu_price`, `menu_desc`, `menu_img`) VALUES
(2, 4, 'BUTTERED GARLIC SHRIMP', '230.00', '(250 grams)', 'watermark-2019-07-15-13-51-59-1_orig.jpg'),
(3, 2, 'GRILLED', '120.00', '(250 grams)', 'tilapia-asada-la-parilla-21187035.jpg'),
(4, 3, 'SINIGANG NA BULGAN', '250.00', 'PER KILO', 'sinigang-na-bulgan-sa.jpg'),
(5, 2, 'FRIED', '120.00', '(250 grams)', 'tilapiafry.jpg'),
(8, 2, 'GINATA-AN', '150.00', '(250 grams)', 'Chrysanthemum.jpg'),
(9, 4, 'GAMBAS', '200.00', '(250 grams)', 'Spanish-Garlic-Prawns-I-800x530.jpg'),
(10, 4, 'TEMPURA', '230.00', '(250 Grams)', 'maxresdefault.jpg'),
(11, 4, 'KINILAW', '230.00', '(250 grams)', 'Shrimp-Kinilaw-2-1.jpg'),
(12, 5, 'BUTTERED GARLIC CRAB', '200.00', '(250 grams)', 'images.jpg'),
(13, 5, 'CHILI SAUCE CRAB', '200.00', 'mild spicy, spicy', 'FB_IMG_1503673872844.jpg'),
(14, 5, 'STEAMED CRAB', '180.00', '(250 grams)', '110885865-steamed-crab.jpg'),
(15, 15, 'CHILI SAUCE ALIMANGO', '280.00', '(250 grams)', 'spicy-crab-recipe.jpg'),
(16, 15, 'GINATA-ANG ALIMANGO', '280.00', '(250 grams)', 'filipino-ginataang-alimango19.jpg'),
(17, 15, 'BUTTERED GARLIC ALIMANGO', '280.00', '(250 grams)', '48ffa965cf2ac9dc203222da8bea9433.jpg'),
(18, 15, 'STEAMED ALIMANGO', '250.00', '(250 grams)', 'cde5908947e9cde7d95cf876695f9df3.jpg'),
(19, 16, 'SIZZLING SQUID', '200.00', '(250 grams)', 'images (1).jpg'),
(20, 16, 'CALAMARES', '200.00', '(250 grams)', 'images (2).jpg'),
(21, 16, 'ADOBO', '200.00', '(250 grams)', 'adobong-pusit.jpg'),
(22, 10, 'BINAKOL (native)', '350.00', '(500 grams)', 'chicken-binakol-2.jpg'),
(23, 10, 'ADOBO (native)', '365.00', '(500 grams)', '15aa77bbff4868019b2809bdcde00409 (1).jpg'),
(24, 10, 'PECHO PACK', '80.00', 'grilled', 'Snapseed_3.jpg'),
(25, 10, 'PAA', '75.00', 'grilled', '49688913043_12a19b0e6d_c.jpg'),
(26, 10, 'ISOL', '50.00', 'grilled', 'atay-baticolon-isol.jpg'),
(27, 10, 'ATAY', '35.00', 'grilled', 'grilled_liver.jpg'),
(28, 10, 'BATIKULON', '28.00', 'grilled', '102b7eea5361aff310c540995_original_.jpg'),
(29, 7, 'BBQ', '25.00', '(per stick) grilled', 'pork-bbq.jpg'),
(30, 7, 'LITSON KAWALI', '250.00', '(500 grams)', 'images (3).jpg'),
(31, 7, 'CRISPY PATA', '450.00', '', 'crispy-pata1.jpg'),
(32, 7, 'SISIG', '120.00', '', '0aa0651fa472beea86a02de659f292af.jpg'),
(33, 7, 'BACK RIBS', '150.00', '', 'Pressure-Cooker-Baby-Back-Ribs.jpg'),
(34, 7, 'LIEMPO', '100.00', '', 'inihaw-na-liempo-4.jpg'),
(35, 7, 'SPARE RIBS', '150.00', '', 'glazed-spareribs-18-56a8ba813df78cf772a022f9.jpg'),
(36, 7, 'BICOL EXPRESS', '160.00', '', 'bicol-express--lg-38436p47160.jpg'),
(37, 17, 'CHOPSAUY', '160.00', '(can add meat ingredient)', 'chopsuey-tofu-shiitake-mushrooms-2.jpg'),
(38, 18, 'PLAIN  RICE', '15.00', '(Platter for occasion)', 'rice.png'),
(39, 18, 'GARLIC RICE', '20.00', '(Platter for occasion)', 'sinangag2.jpg'),
(40, 19, 'Sample Menu', '300.00', 'This is a sample description of the menu', 'Sample Menu-40.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `menucat_id` int(11) NOT NULL,
  `menusel_id` int(11) NOT NULL DEFAULT 0,
  `menu_category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`menucat_id`, `menusel_id`, `menu_category`) VALUES
(2, 2, 'TILAPIA'),
(3, 2, 'BULGAN'),
(4, 2, 'SHRIMP'),
(5, 2, 'CRAB'),
(7, 3, 'PORK'),
(8, 2, 'BANGUS'),
(9, 3, 'BEEF'),
(10, 3, 'CHICKEN'),
(12, 3, 'GOAT MEAT'),
(13, 2, 'TALABA'),
(14, 2, 'TANGIGUE'),
(15, 2, 'ALIMANGO'),
(16, 2, 'SQUID'),
(17, 4, 'MIXED VEGES'),
(18, 8, 'RICE'),
(19, 10, 'Menu 101');

-- --------------------------------------------------------

--
-- Table structure for table `menu_selection`
--

CREATE TABLE `menu_selection` (
  `menusel_id` int(11) NOT NULL,
  `menu_selection` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_selection`
--

INSERT INTO `menu_selection` (`menusel_id`, `menu_selection`) VALUES
(2, 'SEAFOODS'),
(3, 'MEAT'),
(4, 'VEGETABLES'),
(5, 'DESSERTS'),
(6, 'PIKA-PIKA'),
(7, 'SOUP'),
(8, 'RICE'),
(9, 'BEVERAGE'),
(10, 'Sample 23');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `overtime_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `hours` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date_overtime` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`overtime_id`, `employee_id`, `hours`, `rate`, `date_overtime`) VALUES
(1, 1, '3.50', '500.00', '2021-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(50) DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `rate`) VALUES
(1, 'Waiter', '90.00'),
(2, 'Cook', '100.00'),
(3, 'Cleaner', '70.00');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `register_id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`register_id`, `fname`, `mname`, `lname`, `contact_no`, `email`, `password`) VALUES
(1, 'TETSING', 'Pido', 'TESTING', '1213123', 'stephinesev@gmail.com', '1234'),
(2, 'Jason', '', 'Flor', '09187811212', 'jasonflor@gmail.com', '1234'),
(3, 'Claire', 'C', 'Blake', '09123654988', 'cblake@sample.com', 'cblake123');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `register_id` int(11) NOT NULL DEFAULT 0,
  `start_date` varchar(20) DEFAULT NULL,
  `end_date` varchar(20) DEFAULT NULL,
  `trans_done` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `register_id`, `start_date`, `end_date`, `trans_done`) VALUES
(1, 1, '2021-11-19', '2021-11-19', 1),
(2, 3, '2021-11-18', '2021-11-18', 1),
(3, 3, '2021-11-18', '2021-11-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_details`
--

CREATE TABLE `reservation_details` (
  `res_det_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL DEFAULT 0,
  `hut_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `table_id` int(11) NOT NULL DEFAULT 0,
  `done` int(11) NOT NULL DEFAULT 0,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation_details`
--

INSERT INTO `reservation_details` (`res_det_id`, `reservation_id`, `hut_id`, `menu_id`, `table_id`, `done`, `quantity`) VALUES
(1, 1, 0, 40, 0, 1, '3.00'),
(2, 1, 0, 39, 0, 1, '10.00'),
(3, 1, 0, 38, 0, 1, '20.00'),
(4, 1, 0, 37, 0, 1, '2.00'),
(5, 1, 0, 0, 3, 1, '0.00'),
(6, 1, 3, 0, 0, 1, '0.00'),
(7, 2, 0, 37, 0, 1, '2.00'),
(8, 2, 0, 0, 3, 1, '0.00'),
(9, 2, 2, 0, 0, 1, '0.00'),
(10, 3, 0, 40, 0, 1, '2.00'),
(11, 3, 0, 0, 1, 0, '0.00'),
(12, 3, 1, 0, 0, 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_details_tmp`
--

CREATE TABLE `reservation_details_tmp` (
  `res_det_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL DEFAULT 0,
  `hut_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `table_id` int(11) NOT NULL DEFAULT 0,
  `done` int(11) NOT NULL DEFAULT 0,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_tmp`
--

CREATE TABLE `reservation_tmp` (
  `reservation_id` int(11) NOT NULL,
  `register_id` int(11) NOT NULL DEFAULT 0,
  `start_date` varchar(20) DEFAULT NULL,
  `end_date` varchar(20) DEFAULT NULL,
  `trans_done` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `time_in` varchar(20) DEFAULT NULL,
  `time_out` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `time_in`, `time_out`) VALUES
(1, '07:00', '16:00');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `table_no` varchar(100) DEFAULT NULL,
  `reserved` int(11) NOT NULL DEFAULT 0,
  `table_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_no`, `reserved`, `table_img`) VALUES
(1, 'Table 1', 1, ''),
(2, 'Table 2', 0, ''),
(3, 'Table 3', 0, 'Table 3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `usertype` int(11) NOT NULL DEFAULT 0 COMMENT '1=Admin, 2=Staff, 3=Users',
  `fullname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `usertype`, `fullname`) VALUES
(1, 'admin', 'admin', 1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `biometrics_attendance`
--
ALTER TABLE `biometrics_attendance`
  ADD PRIMARY KEY (`bio_id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`cash_id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`del_det_id`);

--
-- Indexes for table `delivery_details_tmp`
--
ALTER TABLE `delivery_details_tmp`
  ADD PRIMARY KEY (`del_det_id`);

--
-- Indexes for table `delivery_head`
--
ALTER TABLE `delivery_head`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `huts`
--
ALTER TABLE `huts`
  ADD PRIMARY KEY (`hut_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`menucat_id`);

--
-- Indexes for table `menu_selection`
--
ALTER TABLE `menu_selection`
  ADD PRIMARY KEY (`menusel_id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`overtime_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`register_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `reservation_details`
--
ALTER TABLE `reservation_details`
  ADD PRIMARY KEY (`res_det_id`);

--
-- Indexes for table `reservation_details_tmp`
--
ALTER TABLE `reservation_details_tmp`
  ADD PRIMARY KEY (`res_det_id`);

--
-- Indexes for table `reservation_tmp`
--
ALTER TABLE `reservation_tmp`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biometrics_attendance`
--
ALTER TABLE `biometrics_attendance`
  MODIFY `bio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `cash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `del_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery_details_tmp`
--
ALTER TABLE `delivery_details_tmp`
  MODIFY `del_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `delivery_head`
--
ALTER TABLE `delivery_head`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `huts`
--
ALTER TABLE `huts`
  MODIFY `hut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `menucat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu_selection`
--
ALTER TABLE `menu_selection`
  MODIFY `menusel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `overtime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation_details`
--
ALTER TABLE `reservation_details`
  MODIFY `res_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservation_details_tmp`
--
ALTER TABLE `reservation_details_tmp`
  MODIFY `res_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservation_tmp`
--
ALTER TABLE `reservation_tmp`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
