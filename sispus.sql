-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2024 at 02:16 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publication_year` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publication_year`, `image`, `available`) VALUES
(1, 'Melukis Senja', 'Budi Doremi', 2016, '', 0),
(2, 'Bumi Manusia', 'Pramoedya Ananta Toer', 1980, NULL, 1),
(3, 'Tapak Jejak', 'Fiersa Besari', 2013, NULL, 1),
(4, 'Garis Waktu', 'Fiersa Besari', 2016, NULL, 1),
(5, 'Hujan', 'Tere Liye', 2016, NULL, 1),
(6, 'Sunset Bersama Rosie', 'Tere Liye', 2011, NULL, 1),
(7, 'Yang Katanya Cemara', 'Vania Winola', 2023, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `user_id`, `book_id`, `borrow_date`, `return_date`) VALUES
(1, 5, 1, '2024-12-16', '2024-12-16'),
(2, 5, 1, '2024-12-16', '2024-12-16'),
(3, 5, 1, '2024-12-16', '2024-12-16'),
(4, 5, 1, '2024-12-16', '2024-12-16'),
(5, 5, 1, '2024-12-16', '2024-12-16'),
(6, 5, 2, '2024-12-17', '2024-12-17'),
(7, 6, 1, '2024-12-17', '2024-12-17'),
(8, 6, 6, '2024-12-17', '2024-12-17'),
(9, 6, 5, '2024-12-17', '2024-12-17'),
(10, 6, 4, '2024-12-17', '2024-12-17'),
(11, 6, 3, '2024-12-17', '2024-12-17'),
(12, 6, 4, '2024-12-17', '2024-12-17'),
(13, 6, 3, '2024-12-17', '2024-12-17'),
(14, 5, 1, '2024-12-17', '2024-12-17'),
(15, 7, 4, '2024-12-17', '2024-12-17'),
(16, 9, 6, '2024-12-17', '2024-12-17'),
(17, 10, 6, '2024-12-18', '2024-12-18'),
(18, 10, 3, '2024-12-18', '2024-12-18'),
(19, 10, 7, '2024-12-18', '2024-12-18'),
(20, 10, 5, '2024-12-18', '2024-12-18'),
(21, 6, 1, '2024-12-24', '2024-12-24'),
(22, 5, 2, '2024-12-24', '2024-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('anggota','pustakawan') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Risma', 'rismaangelina@gmail.com', '$2y$10$Zq1la2PqcQol0ZjVlKom4uE9SwpUcdFl8v.5J.NwwbOr4Cp07jP8m', 'pustakawan', '2024-12-16 07:10:27'),
(5, 'Aldiky', 'aldikyy@gmail.com', '$2y$10$JHETjlKtc264wX14JivR.e7rduGXHVLnkXy8sK/tNhCgLySqcadna', 'anggota', '2024-12-16 07:43:01'),
(6, 'Nabil', 'nabilahmad@gmail.com', '$2y$10$BKWbJlfiAxHTvPWCit6ub.1LhqrbRFrPFhsE6SNgYFycUp2e.tYV.', 'anggota', '2024-12-17 03:35:17'),
(7, 'Raka', 'rakasastra@gmail.com', '$2y$10$LWlBm/b43U7HboRY0fYR7.l/nxLkOSzhfdA41h9wRhV4OGiqFSEU.', 'anggota', '2024-12-17 03:40:09'),
(8, 'Nina', 'ninalatuna@gmail.com', '$2y$10$xb/dC.dXw7FYqKltZ77eUOgrynTRxB.48b2O4OlgnaBQFKuINtmJS', 'pustakawan', '2024-12-17 03:52:15'),
(9, 'Panji', 'panjiakbar@gmail.com', '$2y$10$Lx4SgQJsYDhdnhvigHGwKujQaBZnlDG/djplvSv4ZPis7VMP2KEOm', 'anggota', '2024-12-17 14:28:40'),
(10, 'Alfarixy', 'gifonalfarixy@gmail.com', '$2y$10$qaLWIKRKQftpB8T91FcxV.H5dGhcToB7sbfegHqTrWW10kFZ4OMWi', 'anggota', '2024-12-18 03:01:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
