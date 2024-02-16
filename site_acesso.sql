-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2024 at 06:51 PM
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
-- Database: `site_acesso`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int UNSIGNED NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
(1, 'alex@solution2b.net', '3610dbd29356cdb6ea07f2642f9be790'),
(2, 'admin@solution2b.net', '$2y$10$khu7VUWDrjwtHPDkY7f8l.dMArgX0LVMS6LJsIVYeYrWVAV3nN4.G'),
(4, 'admin@gmail.com', '$2y$10$SFjIinEk6g1.FNzBGCj00uRyMwBCXi6tPu5L1.wtTRpmYls8R5lA6'),
(5, 'cinthya@gmail.com', '$2y$10$H07zAwAR8L.9gPc8RwyIzOGjfRYnQq6MMLq50OTOfOykHtMiTZDfy'),
(6, 'leonardo@gmail.com', '$2y$10$WBnTaPt6W0uppPxbvThZxuH3/4tEbWz96ia9NLbwUuthdC3wDnXt2'),
(7, 'leo@gmail.com', '$2y$10$XxctNkiB0nRVYoVhC.g.webyPmzD13taAW60GE.k3eQbT4uRqYPti'),
(8, 'leo1@gmail.com', '$2y$10$p5dHtyPs/OPdBFyZLNcv/u7MRB/wm/SufevDM2ypdHvFPvFAQbUd2'),
(9, 'alexccastelo@gmail.com', '$2y$10$ey.n3KWSyq9VJLH5RNb3o.ZO5uvfxQCXTUiWtz27IBU1K3i8kMuni'),
(10, 'root@gmail.com', '$2y$10$RLiYZbQ5ICMHV.dsGyUjwu6he/C/pzVSV.1zYLQiNcc0/uQloJqui');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
