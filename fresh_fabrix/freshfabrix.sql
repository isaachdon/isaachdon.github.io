-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2018 at 03:46 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshfabrix`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `type` text NOT NULL,
  `size` text,
  `price` float NOT NULL,
  `stock` int(10) NOT NULL,
  `color` text NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `type`, `size`, `price`, `stock`, `color`, `picture`) VALUES
(1, 'hat', 'Unisex', 40, 10, 'black', 'images/blackhat.png'),
(2, 'pants', 'S,M,L,XL', 75, 10, 'galaxy', 'images/galaxypants.png'),
(4, 'shirt', 'S,M,L,XL', 50, 10, 'white', 'images/whiteshirt.png'),
(5, 'shirt', 'S,M,L,XL', 50, 10, 'grey', 'images/greyshirt.png'),
(6, 'shirt', 'S,M,L,XL', 50, 10, 'toothpaste', 'images/tiedyeshirt.png'),
(7, 'shirt', 'S,M,L,XL', 50, 10, 'galaxy', 'images/galaxyshirt.png'),
(8, 'hat', 'Unisex', 40, 9, 'white', 'images/whitehat.png'),
(9, 'hat', 'Unisex', 40, 10, 'grey', 'images/greyhat.png'),
(10, 'hat', 'Unisex', 40, 10, 'toothpaste', 'images/tiedyehat.png'),
(11, 'hat', 'Unisex', 40, 10, 'galaxy', 'images/galaxyhat.png'),
(12, 'pants', 'S,M,L,XL', 75, 10, 'black', 'images/blackpants.png'),
(13, 'pants', 'S,M,L,XL', 75, 10, 'white', 'images/whitepants.png'),
(14, 'pants', 'S,M,L,XL', 75, 10, 'grey', 'images/greypants.png'),
(15, 'pants', 'S,M,L,XL', 75, 10, 'toothpaste', 'images/tiedyepants.png'),
(21, 'shirt', 'S,M,L,XL', 50, 10, 'black', 'images/blackshirt.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `role`) VALUES
(0, 'Savanna', 'Sito', 'slsito@iu.edu', 'nanner60', 0),
(1, 'Isaac', 'Herndon', 'isaach', 'helloworld', 0),
(2, 'Zach', 'Platt', 'zach@iu.edu', 'hi', 0),
(3, 'Maya', 'Hauersperger', 'maya@iu.edu', 'maya', 0),
(4, 'Ryan', 'Meyer', 'ryan@iu.edu', 'ryan', 0),
(15, 'aero', 'smith', 'aerosmith', 'steventyler', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
