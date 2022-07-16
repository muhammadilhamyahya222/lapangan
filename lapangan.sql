-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 04:46 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lapangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `nama`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Lapangan Futsal GBK A', 120000, 'gbk.jpg', '2020-04-06 11:55:27', '2020-04-07 11:01:48'),
(2, 'Lapangan Basket GBK A', 110000, 'venue_70.jpg', '2020-04-07 13:03:35', '2020-04-07 13:08:21'),
(4, 'Lapangan Badminton GBK A', 90000, 'venue.png', '2020-04-08 03:35:06', '2020-04-08 04:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_user` int(5) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `gender` set('P','L','','') DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_user`, `first_name`, `last_name`, `gender`, `date_birth`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Bruno', 'Ahmad', 'L', '2002-02-02', '1234567890', 'Jl. Sekartaji No.46', '2020-04-06 12:00:53', '2020-04-06 12:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int(5) NOT NULL,
  `id_lapangan` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `tgl_book` date NOT NULL,
  `wkt_mulai` time NOT NULL,
  `wkt_selesai` time NOT NULL,
  `durasi` int(5) NOT NULL,
  `biaya` int(25) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `id_lapangan`, `id_user`, `tgl_book`, `wkt_mulai`, `wkt_selesai`, `durasi`, `biaya`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 2, '2020-04-19', '01:00:00', '02:00:00', 1, 120000, 'done', '2020-04-19 01:45:27', '2020-04-19 03:42:16'),
(5, 2, 6, '2020-04-19', '11:00:00', '12:00:00', 1, 110000, 'done', '2020-04-19 03:48:53', '2020-04-19 03:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Bruno', 'bruno@gmail.com', 'bruno123', 'Member', '2020-04-09 11:36:35', '0000-00-00 00:00:00'),
(2, 'Mark', 'mark@fb.com', 'eyJpdiI6ImpuZ1hJNWtuR2t4XC9FSGdNZFhOQWlRPT0iLCJ2YWx1ZSI6ImJOSVpQZXJER3FET2pUR0pwZWE1aUE9PSIsIm1hYyI6IjAwMGQyNWE3M2RiNjdlMjlkYzVkNmZmODlhZDZmZTE4ZjdlMWJlNWE4NjNhZmRkZjhjNzQ2MDQwMzBlMjIyNTkifQ==', 'Member', '2020-04-18 05:19:57', '2020-04-18 05:19:57'),
(3, 'Garox', 'garox@gmail.com', 'eyJpdiI6Ik5lSkR6dnY4ZnA0czVEVG9BeWMzMnc9PSIsInZhbHVlIjoiM0JFT002cnQxU2llSFI5N0NhOG1EQT09IiwibWFjIjoiZmIzMTZjOGRjZDFjYmM4MjFkMWMzODI2ZjNkYTNjNmRkOTY5ZjRjNmIyNTA2M2Q0YWQ0Y2ZkZjg0Njk3MTlkYSJ9', 'Admin', '2020-04-18 10:20:55', '2020-04-18 10:20:55'),
(4, 'User', 'user@gmail.com', 'eyJpdiI6IkJwRm5YRlN4ZnJVSlkwa3FqOEE0ZlE9PSIsInZhbHVlIjoiWjVJbkc0MEFlMjNnSG5Jd3o5aCt5QT09IiwibWFjIjoiYTk0M2UzZDJiZDQ1NjViNGM4YzYyNGY4MzI5YWFkMTQyODY4MTBjOWQ1YWQxOGNmMDU1OTdkMjNiZjJjMTAxNSJ9', 'Member', '2020-04-19 03:29:44', '2020-04-19 03:29:44'),
(5, 'pacman', 'pacman@gmail.com', 'eyJpdiI6IjdGVXpYbkNScUtpb0F5RnRzaTc5akE9PSIsInZhbHVlIjoiR21ZY05vVkd4WFYyTEpUcEVJK3lCdz09IiwibWFjIjoiMDUyOTdkNTk4Nzg0MGZlZmU3ODUyYTZjNmQzYzJmZTNlNTEzODhmYzgyMDI1MWVhOGVmOWQzM2I2YjViMjU3NCJ9', 'Member', '2020-04-19 03:31:57', '2020-04-19 03:31:57'),
(6, 'Ilham', 'ilham@gmal.com', 'eyJpdiI6IllmOFdQOUFxbnpGSDdXeDRkQ2VpYXc9PSIsInZhbHVlIjoicFJsYWJ6QUpBcjdZVU1HUU5iU2FMQT09IiwibWFjIjoiYjFkN2NjNjY3OTliNjEyN2VlMTY4ZjM1NzQ2NzUzNmU3ZGJiZmVkYzI2MWY4YTJlN2M4ZjVlODZmOWZmMjVjYSJ9', 'Member', '2020-04-19 03:47:39', '2020-04-19 03:47:39'),
(7, 'Ilham', 'muhammad@gmail.com', 'eyJpdiI6IlM1TWNaZ05qY3IxSjRRam5tdTRwd3c9PSIsInZhbHVlIjoieTBQMXBjREJhdWdWNjdxK2UwMUxtUT09IiwibWFjIjoiODZhNmNiMDc5NmEzYzkwY2U0OWFlYTNjZjA3MmI1ODc5NThkOTQ4Zjk0NjA1ZTZmZWUzZjc3NjNlNGEzZGM0MiJ9', 'Member', '2020-04-19 03:49:33', '2020-04-19 03:49:33'),
(8, 'EJRE', 'ezra@gmail.com', 'eyJpdiI6IjVaSlwvN0hzVGVoSFJ5UWR3bzdIOVRBPT0iLCJ2YWx1ZSI6IjRCQjV4NFBOeklnMytzTUtRVnBMM3c9PSIsIm1hYyI6IjBhYTZmYTU5YmY4OGYyMmQyZTFjNGRiNDlhMzUyMzI0YTY5MGQ0ZDM5ODUwYTI0MmViMDUwOTg4ZjhmNGEzYzMifQ==', 'Member', '2020-04-19 04:34:20', '2020-04-19 04:34:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lapangan` (`id_lapangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id`),
  ADD CONSTRAINT `sewa_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
