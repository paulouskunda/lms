-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2021 at 02:03 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandID` varchar(20) NOT NULL,
  `brand_name` text NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandID`, `brand_name`, `status`) VALUES
('Gucci574', 'Gucci', b'1'),
('New642', 'New', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catID` varchar(20) NOT NULL,
  `category_name` text NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catID`, `category_name`, `status`) VALUES
('w4', 'Wedding Dress', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `contractID` int(11) NOT NULL,
  `contractExtraInfo` text NOT NULL,
  `dateAgreed` date NOT NULL,
  `cusID` int(11) NOT NULL,
  `ptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` varchar(20) NOT NULL,
  `firstname` text NOT NULL,
  `othername` text NOT NULL,
  `lastname` text NOT NULL,
  `ID` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `residentialArea` varchar(50) NOT NULL,
  `city` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstname`, `othername`, `lastname`, `ID`, `contact`, `email`, `residentialArea`, `city`, `password`, `isActive`) VALUES
('LMS-CSTM-2021111', 'Innocent', 'Sha', 'Shatamuka', '123412/12/1', '0975363338', 'innocentshatamuka@gmail.com', '3059 New Mushili', 'Kitwe', 'ca06418aaf960bf4912174c980d2508f273b2664', 1),
('LMS-CSTM-2021610', 'Zulu', '', 'Kill', '142578/45/1', '098234212', 'mwamba@banking.com', '1545 Kabushi Ndola', 'Kabwe', 'ca06418aaf960bf4912174c980d2508f273b2664', 1),
('LMS-CSTM-2021753', 'Paul', '', 'Kunda', '481971/61/1', '0975363338', 'zedhiphop24@GMAIL.COM', '3059', 'Kabwe', 'ca06418aaf960bf4912174c980d2508f273b2664', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemdates`
--

CREATE TABLE `itemdates` (
  `ID` varchar(20) NOT NULL,
  `encounterID` varchar(20) NOT NULL,
  `itemID` varchar(20) NOT NULL,
  `quantity` int(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemdates`
--

INSERT INTO `itemdates` (`ID`, `encounterID`, `itemID`, `quantity`, `date`) VALUES
('stock3160', 'encounter375', 'item636', 12, '2021-05-09'),
('stock5827', 'encounter221', 'item162', 5, '2021-05-09'),
('stock6968', 'encounter767', 'item162', 1, '2021-05-09'),
('stock7302', 'encounter571', 'item402', 1, '2021-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int(11) NOT NULL,
  `catID` varchar(20) NOT NULL,
  `brandID` varchar(20) NOT NULL,
  `small` int(11) NOT NULL,
  `medium` int(11) NOT NULL,
  `large` int(11) NOT NULL,
  `quantity` int(50) NOT NULL,
  `quantityFlag` int(2) NOT NULL,
  `price` int(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `catID`, `brandID`, `small`, `medium`, `large`, `quantity`, `quantityFlag`, `price`, `status`) VALUES
(1, 'w4', 'Gucci574', 18, 5, 10, 23, 1, 2000, 1),
(2, 'w4', 'New642', 5, 1, 2, 8, 1, 3800, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lease`
--

CREATE TABLE `lease` (
  `leaseID` varchar(50) NOT NULL,
  `itemID` varchar(50) NOT NULL,
  `quantity` int(100) NOT NULL,
  `leaseDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `updatedBy` varchar(50) NOT NULL,
  `customerID` varchar(50) NOT NULL,
  `paymentRef` varchar(50) NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationID` int(11) NOT NULL,
  `message` text NOT NULL,
  `reciever` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordersID` varchar(20) NOT NULL,
  `itemID` varchar(20) NOT NULL,
  `quantity` int(100) NOT NULL,
  `orderDate` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentRef` varchar(20) NOT NULL,
  `customerID` varchar(20) NOT NULL,
  `dateofPayment` datetime NOT NULL,
  `totalBill` int(100) NOT NULL,
  `paidamount` int(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_tracking`
--

CREATE TABLE `payment_tracking` (
  `ptID` int(11) NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `brandID` varchar(250) NOT NULL,
  `size` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateOfUse` date NOT NULL,
  `dateOfReturn` date NOT NULL,
  `amountPaid` double NOT NULL,
  `totalBill` double NOT NULL,
  `overReturnDateAmount` double DEFAULT 0,
  `dateOfPayment` date NOT NULL,
  `statusOfPayment` tinyint(1) NOT NULL,
  `statusOfReturn` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_tracking`
--

INSERT INTO `payment_tracking` (`ptID`, `customerID`, `brandID`, `size`, `type`, `quantity`, `dateOfUse`, `dateOfReturn`, `amountPaid`, `totalBill`, `overReturnDateAmount`, `dateOfPayment`, `statusOfPayment`, `statusOfReturn`) VALUES
(1, 'LMS-CSTM-2021111', 'Gucci574', 'small', 'Silk', 8, '2021-05-16', '2021-05-17', 2000, 2000, 800, '2021-05-15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_tracking_history`
--

CREATE TABLE `payment_tracking_history` (
  `PTHID` int(11) NOT NULL,
  `payment_tracking_id` int(11) NOT NULL,
  `amount_paid` double NOT NULL,
  `date_of_payment` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_tracking_history`
--

INSERT INTO `payment_tracking_history` (`PTHID`, `payment_tracking_id`, `amount_paid`, `date_of_payment`) VALUES
(1, 1, 2000, '2021-05-15 11:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` varchar(10) NOT NULL,
  `role_title` varchar(20) NOT NULL,
  `read_privilege` bit(1) NOT NULL,
  `write_privilege` bit(1) NOT NULL,
  `createUsers` bit(1) NOT NULL,
  `removeUsers` bit(1) NOT NULL,
  `viewUsers` bit(1) NOT NULL,
  `editUsers` bit(1) NOT NULL,
  `createCustomers` bit(1) NOT NULL,
  `viewCustomers` bit(1) NOT NULL,
  `edtitCustomers` bit(1) NOT NULL,
  `removeCustomers` bit(1) NOT NULL,
  `editProfile` bit(1) NOT NULL,
  `addProducts` bit(1) NOT NULL,
  `viewProducts` bit(1) NOT NULL,
  `editProducts` bit(1) NOT NULL,
  `removeProducts` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `role_title`, `read_privilege`, `write_privilege`, `createUsers`, `removeUsers`, `viewUsers`, `editUsers`, `createCustomers`, `viewCustomers`, `edtitCustomers`, `removeCustomers`, `editProfile`, `addProducts`, `viewProducts`, `editProducts`, `removeProducts`) VALUES
('role001', 'adminstrator', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1'),
('role002', 'customer service', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'1', b'0', b'1', b'0', b'0'),
('role003', 'customer', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `size_of_dress`
--

CREATE TABLE `size_of_dress` (
  `id` int(11) NOT NULL,
  `small` int(11) NOT NULL,
  `medium` int(11) NOT NULL,
  `large` int(11) NOT NULL,
  `brandID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `username`, `password`) VALUES
(3, 'root', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` varchar(20) NOT NULL,
  `roleID` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `othername` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `identification_number` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `residentialAddress` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `isActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `roleID`, `firstname`, `othername`, `lastname`, `username`, `identification_number`, `contact`, `email`, `residentialAddress`, `city`, `password`, `isActive`) VALUES
('LMS-USR-2020279', 'role001', 'kutemba', 'dahlia', 'kajimo', 'kajimo', '300320/24/1', '0974879447', 'dahliakaji@gmail.com', 'Town Compus', 'Kabwe', 'ca06418aaf960bf4912174c980d2508f273b2664', b'1'),
('LMS-USR-2020373', 'role002', 'mack', '', 'mackinnon', 'mack', '197284/11/1', '09661752783', 'mackinnon@gmail.com', 'rockfiled,', 'Lusaka', 'ca06418aaf960bf4912174c980d2508f273b2664', b'0'),
('LMS-USR-2020774', 'role001', 'lawrence', 'biwa', 'kasalwe', 'lawk', '334991/43/1', '0973001122', 'lawrence.kasalwe@gmail.com', '55554 hillview chalala', 'Lusaka', 'ca06418aaf960bf4912174c980d2508f273b2664', b'0'),
('LMS-USR-2020826', 'role002', 'meebelo', 'chuka', 'hakwendenda', 'stackx', '123478/74/1', '0971022244', 'stackx@thelaw.com', 'somewhere ku komboni', 'Kitwe', 'ca06418aaf960bf4912174c980d2508f273b2664', b'1'),
('LMS-USR-2020909', 'role002', 'naphtali', '', 'siyanjobo', 'naphs', '142536/74/1', '0963528285', 'naph.siya@mail.com', 'meanwood', 'Lusaka', 'ca06418aaf960bf4912174c980d2508f273b2664', b'1'),
('LMS-USR-2020960', 'role002', 'Lumbanya', '', 'Chita', 'lc', '462735/61/1', '0961070206', 'lumbanyachita@gmail.com', '43 mwatakazembe,Kansenshi', 'Ndola', 'ca06418aaf960bf4912174c980d2508f273b2664', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contractID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `itemdates`
--
ALTER TABLE `itemdates`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `lease`
--
ALTER TABLE `lease`
  ADD PRIMARY KEY (`leaseID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ordersID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentRef`);

--
-- Indexes for table `payment_tracking`
--
ALTER TABLE `payment_tracking`
  ADD PRIMARY KEY (`ptID`);

--
-- Indexes for table `payment_tracking_history`
--
ALTER TABLE `payment_tracking_history`
  ADD PRIMARY KEY (`PTHID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `size_of_dress`
--
ALTER TABLE `size_of_dress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contractID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_tracking`
--
ALTER TABLE `payment_tracking`
  MODIFY `ptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_tracking_history`
--
ALTER TABLE `payment_tracking_history`
  MODIFY `PTHID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `size_of_dress`
--
ALTER TABLE `size_of_dress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;