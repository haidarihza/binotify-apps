-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Waktu pembuatan: 28 Okt 2022 pada 03.51
-- Versi server: 8.0.31
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binotify`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `album_id` int NOT NULL,
  `judul` varchar(64) NOT NULL,
  `penyanyi` varchar(128) NOT NULL,
  `total_duration` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `genre` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`album_id`, `judul`, `penyanyi`, `total_duration`, `image_path`, `tanggal_terbit`, `genre`) VALUES
(1, 'Ruang Tunggu', 'Payung Teduh', 2514, '../assets/images/Ruang Tunggu.jpg', '2017-08-20', 'Pop'),
(2, 'Bersenjagurau', 'Senar Senja', 1894, '../assets/images/BersenjaGurau.jpg', '2017-05-06', 'Pop'),
(3, 'Dunia Batas', 'Payung Teduh', 2416, '../assets/images/DuniaBatas.jpg', '2012-04-01', 'Jazz'),
(5, 'Lintasan Waktu', 'Danilla Riyadi', 2800, '../assets/images/LintasanWaktu.jpg', '2017-08-31', 'Alternative');

-- --------------------------------------------------------

--
-- Struktur dari tabel `song`
--

CREATE TABLE `song` (
  `song_id` int NOT NULL,
  `judul` varchar(64) NOT NULL,
  `penyanyi` varchar(128) DEFAULT NULL,
  `tanggal_terbit` date NOT NULL,
  `genre` varchar(64) DEFAULT NULL,
  `duration` int NOT NULL,
  `audio_path` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `album_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `song`
--

INSERT INTO `song` (`song_id`, `judul`, `penyanyi`, `tanggal_terbit`, `genre`, `duration`, `audio_path`, `image_path`, `album_id`) VALUES
(1, 'Laguland', 'Danilla Riyadi', '2017-08-31', 'Alternative', 317, '../assets/audio/01 - Danilla - Laguland.mp3', '../assets/images/LintasanWaktu.jpg', 5),
(2, 'Entah Ingin Ke Mana (feat. Rd Moch Sigit Agung Pramudita)', 'Danilla Riyadi', '2017-08-31', 'Alternative', 252, '../assets/audio/02 - Danilla - Entah Ingin Ke Mana (feat. Rd Moch Sigit Agung Pramudita).mp3', '../assets/images/LintasanWaktu.jpg', 5),
(3, 'Kalapuna', 'Danilla Riyadi', '2017-08-31', 'Alternative', 266, '../assets/audio/03 - Danilla - Kalapuna.mp3', '../assets/images/LintasanWaktu.jpg', 5),
(4, 'Meramu', 'Danilla Riyadi', '2017-08-31', 'Alternative', 248, '../assets/audio/04 - Danilla - Meramu.mp3', '../assets/images/LintasanWaktu.jpg', 5),
(5, 'Berdua Saja', 'Payung Teduh', '2012-04-01', 'Jazz', 266, '../assets/audio/01 Payung Teduh Berdua Saja.mp3', '../assets/images/DuniaBatas.jpg', 3),
(6, 'Menuju Senja', 'Payung Teduh', '2012-04-01', 'Jazz', 306, '../assets/audio/02 Payung Teduh Menuju Senja.mp3', '../assets/images/DuniaBatas.jpg', 3),
(7, 'Untuk Perempuan Yang Sedang Di Pelukan', 'Payung Teduh', '2012-04-01', 'Jazz', 341, '../assets/audio/03 Payung Teduh Untuk Perempuan Yang Sedang Di Pelukan.mp3', '../assets/images/DuniaBatas.jpg', 3),
(8, 'Rahasia', 'Payung Teduh', '2012-04-01', 'Jazz', 355, '../assets/audio/04 Payung Teduh Rahasia.mp3', '../assets/images/DuniaBatas.jpg', 3),
(9, 'Akad', 'Payung Teduh', '2017-08-20', 'Pop', 258, '../assets/audio/Payung Teduh - Akad.mp3', '../assets/images/Ruang Tunggu.jpg', 1),
(10, 'Di Atas Meja', 'Payung Teduh', '2017-08-20', 'Pop', 329, '../assets/audio/Payung Teduh - Di Atas Meja.mp3', '../assets/images/Ruang Tunggu.jpg', 1),
(11, 'Kita Hanya Sebentar', 'Payung Teduh', '2017-08-20', 'Pop', 253, '../assets/audio/Payung Teduh - Kita Hanya Sebentar.mp3', '../assets/images/Ruang Tunggu.jpg', 1),
(12, 'Kerinduan', 'Payung Teduh', '2017-08-20', 'Pop', 340, '../assets/audio/Payung Teduh - Kerinduan.mp3', '../assets/images/Ruang Tunggu.jpg', 1),
(13, 'Introduction', 'Senar Senja', '2017-05-06', 'Pop', 58, '../assets/audio/Senar+Senja+Introduction.mp3', '../assets/images/BersenjaGurau.jpg\r\n', 2),
(14, 'Bersenjagurau', 'Senar Senja', '2017-05-06', 'Pop', 230, '../assets/audio/Senar+Senja+Bersenjagurau.mp3', '../assets/images/BersenjaGurau.jpg', 2),
(15, 'Asmara Roda Dua', 'Senar Senja', '2017-05-06', 'Pop', 285, '../assets/audio/Senar+Senja+Asmara+Roda+Dua.mp3', '../assets/images/BersenjaGurau.jpg', 2),
(16, 'Dialog Hujan', 'Senar Senja', '2017-05-06', 'Pop', 264, '../assets/audio/Senar+Senja+Dialog+Hujan.mp3', '../assets/images/BersenjaGurau.jpg', 2),
(45, 'Ikatan Waktu Lampau', 'Danilla Riyadi', '2022-10-31', 'Alternative', 276, '../assets/audio/05-Danilla-Ikatan-Waktu-Lampau.mp3', '../assets/images/LintasanWaktu.jpg', 5),
(46, 'Aaa', 'Danilla Riyadi', '2017-08-31', 'Alternative', 369, '../assets/audio/06-Danilla-Aaa.mp3', '../assets/images/LintasanWaktu.jpg', 5),
(47, 'Resah', 'Payung Teduh', '2012-04-01', 'Jazz', 241, '../assets/audio/07 Payung Teduh Resah.mp3', '../assets/images/DuniaBatas.jpg', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `isAdmin`, `name`) VALUES
(1, 'ilhambintangn@gmail.com', '$2y$10$qCWKwK422jqbHyVRw96rQuHxbqhyJ.udF/ToBPzVMABElruESWZjO', 'hambinn', 1, 'Ilham Bintang Nurmansyah'),
(2, 'hambinze@gmail.com', '$2y$10$NFdfoSUWsgo07C8GNryxtOCjkgAHCgoTUeNUS/U4.lC67g/Di9qaW', 'hambinnze', 0, 'Ilham Bintang Nurmansyah'),
(3, 'ilhambintangn@Gmail.co.id', '$2y$10$a8K2eQQlp2sTGEp4dE/HJejACgHPZ4c2JPRYPw9DqVBGCeFUiZ3lm', 'hambinnn', 0, 'Ilham Bintang Nurmansyah');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indeks untuk tabel `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
