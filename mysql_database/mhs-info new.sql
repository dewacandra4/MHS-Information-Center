-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Mar 2020 pada 02.40
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
-- Database: `mhs-info`
--

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
(1, 'candra@gmail.com', '1000.00', 1),
(2, 'candra2@gmail.com', '12212.00', 3);

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
(1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `residences`
--

CREATE TABLE `residences` (
  `residence_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `address` varchar(128) NOT NULL,
  `numUnits` int(128) NOT NULL,
  `sizePerUnit` int(128) NOT NULL,
  `monthlyRental` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `residences`
--

INSERT INTO `residences` (`residence_id`, `staff_id`, `address`, `numUnits`, `sizePerUnit`, `monthlyRental`) VALUES
(3, 1, 'p talaud', 12, 121, '1222.00'),
(4, 1, 'p bali', 100, 100, '100.00'),
(5, 0, 'p sumatra', 12, 100, '100.00');

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
(1, 'candrabrata1', '$2y$10$TarKEnBv6xUPLoz6xqpGwO7moX5eTNNq1V1khL.ITvOBWy5nHp.3O', 'Candraditya Brata', '1545029166339.jpg', 2, 1585198497),
(2, 'admin', '$2y$10$mMJbBzgNo9oQq3U1qbVs7.TwWnClYgKXaKs8araHx9KGLVXfN4sp.', 'Dewa Candraditya Brata', 'stikom_bali_logo1.jpg', 1, 1585198634),
(3, 'candrabrata2', '$2y$10$yBCKasSb6x443bUlHp5lC.l8aJawAn9o1ExamD/WGXbQ/us6G7x4i', 'Candra Brata', 'IMG_20181208_184719_5352.jpg', 2, 1585210449);

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
-- Indeks untuk tabel `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`applicant_id`),
  ADD UNIQUE KEY `FK_user_id` (`user_id`);

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
-- AUTO_INCREMENT untuk tabel `applicant`
--
ALTER TABLE `applicant`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `housing_officer`
--
ALTER TABLE `housing_officer`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `residences`
--
ALTER TABLE `residences`
  MODIFY `residence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `housing_officer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
