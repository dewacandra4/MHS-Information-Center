-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2020 pada 05.12
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhs-center`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `allocation`
--

CREATE TABLE `allocation` (
  `allocation_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `fromDate` date NOT NULL,
  `duration` int(128) NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `applicant`
--

CREATE TABLE `applicant` (
  `applicant_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `monthlyIncome` decimal(19,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `applicant`
--

INSERT INTO `applicant` (`applicant_id`, `email`, `monthlyIncome`, `user_id`) VALUES
(1, 'candra@gmail.com', '100000.00', 1),
(2, 'candra2@gmail.com', '12212.00', 3),
(3, 'geogeabulan33@gmail.com', '1000.00', 4),
(4, 'rma@gmail.com', '111.00', 5),
(5, 'surya@gmail.com', '1000.00', 7),
(6, 'candrabrata1@gmail.com', '500000.00', 8),
(7, 'fajabrata@gmail.com', '200000.00', 10),
(8, 'candra1@gmail.com', '2122.00', 12),
(9, 'candra100@gmail.com', '1000.00', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `application`
--

CREATE TABLE `application` (
  `application_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `residence_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `applicationDate` int(11) NOT NULL,
  `requiredMonth` varchar(128) NOT NULL,
  `requiredYear` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `application`
--

INSERT INTO `application` (`application_id`, `applicant_id`, `residence_id`, `staff_id`, `applicationDate`, `requiredMonth`, `requiredYear`, `status`) VALUES
(1, 1, 3, 1, 1585368466, 'December', '2020', 'New'),
(2, 1, 6, 2, 1585376900, 'December', '2020', 'New'),
(3, 2, 5, 0, 1585630830, 'Decemebr', '2020', 'New'),
(4, 1, 5, 0, 1585917067, 'December', '2020', 'New'),
(5, 1, 6, 2, 1585917156, 'December', '2020', 'New');

-- --------------------------------------------------------

--
-- Struktur dari tabel `housing_officer`
--

CREATE TABLE `housing_officer` (
  `staff_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `housing_officer`
--

INSERT INTO `housing_officer` (`staff_id`, `user_id`) VALUES
(1, 2),
(2, 6),
(3, 9),
(4, 11),
(5, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `residences`
--

CREATE TABLE `residences` (
  `residence_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `address` varchar(128) NOT NULL,
  `numunits` int(128) NOT NULL,
  `size_per_unit` decimal(19,2) NOT NULL,
  `monthly_rental` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `residences`
--

INSERT INTO `residences` (`residence_id`, `staff_id`, `address`, `numunits`, `size_per_unit`, `monthly_rental`) VALUES
(5, 0, 'p sumatra', 12, '100.00', '100.00'),
(6, 2, 'Jalan Pulau Bali No.122', 12, '100.00', '300.00'),
(7, 2, 'Jalan Pulau Dewata No.3', 10, '120.00', '400.00'),
(8, 2, 'Jalan Pulau Obi No.4', 20, '300.00', '600.00'),
(9, 2, 'Jalan Pulau Komodo No.19', 15, '200.00', '500.00'),
(10, 2, 'Jalan Pula Buton', 10, '200.00', '300.00'),
(11, 1, 'Jalan Gajah Mada No.2', 10, '200.00', '500.00'),
(12, 1, 'Jalan Pulau Sulawesi', 14, '200.00', '400.00'),
(13, 3, 'Jalan Pulau Serangan No.12', 10, '100.00', '400.00'),
(19, 4, 'Jalan Pulau Nila', 10, '200.00', '400.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_no` int(11) NOT NULL,
  `availability` varchar(128) NOT NULL,
  `residence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `image`, `role_id`, `date_created`) VALUES
(1, 'candrabrata1', '$2y$10$TarKEnBv6xUPLoz6xqpGwO7moX5eTNNq1V1khL.ITvOBWy5nHp.3O', 'Dewa Candraditya Brata Test Edit', 'NEW_IMAGES.jpg', 2, 1585198497),
(2, 'admin', '$2y$10$mMJbBzgNo9oQq3U1qbVs7.TwWnClYgKXaKs8araHx9KGLVXfN4sp.', 'Dewa Candra Brata', 'stikom_bali_logo1.jpg', 1, 1585198634),
(3, 'candrabrata2', '$2y$10$yBCKasSb6x443bUlHp5lC.l8aJawAn9o1ExamD/WGXbQ/us6G7x4i', 'Candra Brata', 'IMG_20181208_184719_5352.jpg', 2, 1585210449),
(4, 'geogeabulan32', '$2y$10$Et/eqnzGXSnRteXt41Hh6uA9yWEZr83nuT9VNQHRwJUo98.HHw1Eu', 'georamabhujangga', 'default.jpg', 2, 1585279564),
(5, 'georama', '$2y$10$3cZe3NijE8l6iD44Ziyx/OwMZUbtwz0cy7gV/yNlYJhVm7EPwMohO', 'rama the ranma', 'default.jpg', 2, 1585281075),
(6, 'admin2', '$2y$10$79M301BSKqhZE6Ty1kXzLeBHcjjsyvlqAG4teeOOHtt/KB/gf46.K', 'Rama Shinta', 'default.jpg', 1, 1585375948),
(7, 'suryaadi', '$2y$10$aw8DRTfgfG0jv5X08HWyZu9Pfh49xq3vgYf6jd4ftNKs0ulsDHvyS', 'Surya Adi', 'default.jpg', 2, 1585459992),
(8, 'dewacandra10', '$2y$10$Hp3ItxXz.YQGDTrYtRedNu7ZG99K7RD9gSDmSkIj6NRdCSYAnczdO', 'Dewa Candraditya Brata Subrata', '1537449888593.jpg', 2, 1585463074),
(9, 'dewacandra1', '$2y$10$/Kh/T5mjAYJi034AQGSKweANxXY0LAnxKiO1HDlVaOjOF2sFcv/Jm', 'Dewa Candraditya Brata Rai', '1537915392460.jpg', 1, 1585463334),
(10, 'fajar1', '$2y$10$zP.gL.FnaUzcD64mUs.yIe/UIX1F9G8b79VEnHZEeu1bRDunjr0zi', 'Dewa Fajar Brata Manggala Candra Ditya', '1537678264778.jpg', 2, 1585479514),
(11, 'admin3', '$2y$10$KHOypBKLFTgrVw04KM7qp..DWHjEG1uwso5N25N.u9M1LJH4aiihK', 'Leon Rehart', 'default.jpg', 1, 1585480342),
(12, 'candra brata3', '$2y$10$RJi2wOqDtoSa34wGBdzykOs9LUtp9lSWaIfojgZ1hqfiZyf/XLKiC', 'candra', 'default.jpg', 2, 1585623328),
(13, 'candrabrata100', '$2y$10$/SFfj4VApm7I77Kgs7MPPOALhNUhwe1aZRW.ipfAS.ffuUdK4Sh3C', '&lt;h1&gt;Dewa Candraditya Brata&lt;/h1&gt;', 'default.jpg', 2, 1585626357),
(14, 'admin4', '$2y$10$RoCPAtvAsoa7tfsw4Fhz9uqABSKSei7JWJOHdigsHY69Aa6tttPpO', 'Rai Sudewa', 'default.jpg', 1, 1585631449);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`) VALUES
(1, 'Housing Officer'),
(2, 'Applicant');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `allocation`
--
ALTER TABLE `allocation`
  ADD PRIMARY KEY (`allocation_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indeks untuk tabel `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`applicant_id`),
  ADD UNIQUE KEY `FK_user_id` (`user_id`);

--
-- Indeks untuk tabel `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `FK_applicant_id` (`applicant_id`),
  ADD KEY `FK_residence_id` (`residence_id`),
  ADD KEY `FK_staff_id` (`staff_id`);

--
-- Indeks untuk tabel `housing_officer`
--
ALTER TABLE `housing_officer`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `FK_user_id` (`user_id`);

--
-- Indeks untuk tabel `residences`
--
ALTER TABLE `residences`
  ADD PRIMARY KEY (`residence_id`),
  ADD KEY `FK_staff_id` (`staff_id`);

--
-- Indeks untuk tabel `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`),
  ADD KEY `residence_id` (`residence_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_role_id` (`role_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `allocation`
--
ALTER TABLE `allocation`
  MODIFY `allocation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `applicant`
--
ALTER TABLE `applicant`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `housing_officer`
--
ALTER TABLE `housing_officer`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `residences`
--
ALTER TABLE `residences`
  MODIFY `residence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `housing_officer`
--
ALTER TABLE `housing_officer`
  ADD CONSTRAINT `housing_officer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
