-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2017 at 10:39 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'rizky', '$2y$10$p3fi50z3usWGjDkY7hpDi.Jyz6yjFcFpHKmfxIf1wlPmhWA/pnXsi', 1),
(2, 'udin', '$2y$10$E2X7Iq5CRs6D3ITK6AriLOQYnT5KtWCIv8Fho6muw689d7//FUJMq', 0),
(3, 'Kaka', '$2y$10$XTLRCdSbaQ5BoT93EvXbn.0qRxDVrYqs52Ray8z1UA6fq6r0Tshui', 0),
(4, 'lola', '$2y$10$Y942SABHqf1MrGbCtCQjb..O6JDJxuOHSM/Zmxq56EjTJbkj7i8Fy', 0),
(5, 'ade', '$2y$10$zPwiZlEMxMB3B.763.xmzOdqG2HAR1PeYDVMUApaeq/r4i0v5vfIG', 0),
(6, 'koko', '$2y$10$rCJozn4/bPc4PgU2uj/yf.kZBSZr3DCU0GBYd6BfJCOzTD4Y2RRHO', 0),
(7, 'Konda', '$2y$10$WbYdR6tpJOO1Uyl7o06VTOtcvWP51TaWdb6CJlqTYVOeaxzx3qhv2', 0),
(8, 'lopo', '$2y$10$kzG5RZvxr65Ky4iOozX/IOOfxGK1AxZSOci148gsTFqeahjKmJIO.', 0),
(9, 'buta', '$2y$10$P/YD/80iuEUIhJg3.mDWRu3JjNknN.sC4F99CGq6lp6rI/3npZqyG', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
