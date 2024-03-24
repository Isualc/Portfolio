-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Jan 2024 um 17:17
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `onlineshop_schwerter`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pfad_zum_bild` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `changed_at`, `pfad_zum_bild`, `description`) VALUES
(1, 'Schwert 1', 200.00, '2023-12-17 17:54:16', 'img\\bild1.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(2, 'Schwert 2', 200.00, '2023-12-16 14:00:19', 'img\\bild2.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(3, 'Schwert 3', 200.00, '2023-12-16 14:00:19', 'img\\bild3.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(4, 'Schwert 4', 200.00, '2023-12-16 14:00:34', 'img\\bild4.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(5, 'Schwert 5', 200.00, '2023-12-16 14:00:42', 'img\\bild5.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(6, 'Schwert 6', 200.00, '2023-12-16 14:00:48', 'img\\bild6.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(7, 'Schwert 7', 200.00, '2023-12-16 14:00:55', 'img\\bild7.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(8, 'Schwert 8', 200.00, '2023-12-16 14:01:01', 'img\\bild8.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(9, 'Schwert 9', 111.00, '2023-12-23 23:07:03', 'img/bild9.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata'),
(10, 'Schwert 10', 222.00, '2023-12-23 23:07:12', 'img/bild10.jpg', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `uuid` varchar(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `plz` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`uuid`, `username`, `birthday`, `password`, `address`, `plz`, `email`, `role`) VALUES
('657d9bc194692', 'Michi', '1999-07-01', '$2y$10$E0MRGEEDrlblJgiJbujuTeYFztr2QawcCDtWWKQuqKsrN/LfdSRW.', 'Erzherzog-Johann-Gasse 8/06', '8601', 'michi@office.at', 1),
('657d9bfc75c9a', 'Claus', '1981-06-18', '$2y$10$PSIKt4m7pJUFrDjsKeMa/.mit9Ahhh51O47FW1TuRkoclwqQ50HdG', 'Erzherzog-Johann-Gasse 8/06', '8600', 'claus_hierzer@gmx.at', 7),
('657d9c213403a', 'Angie', '1984-11-04', '$2y$10$ZqY6hcJrG/lvR/eWnNx6S.FsDpZ5hp3Eiav/l57LQcVJCzTbjFjLi', '232/3 Kaindorf', '8600', 'angielenpedroso11@gmail.com', 1),
('657f577cd9678', 'Marco', '1999-08-05', '$2y$10$yeotHZX3uUJWDVwNkG7gGeDI/KYOwdpzL/qf3d719FRtv6R1J4mi.', 'Schlossberggasse 232/3', '8600', 'marco@office.at', 1),
('65845e8234bc0', 'Luki', '1999-01-01', '$2y$10$KtY41VLXTtjJdtrb.//sWepcbKOVUe.Km2/GqPLTka07ipA9D2agq', 'Schlossberggasse 232/3', '8600', 'luki@office.at', 7),
('65876878ac066', 'Hermann', '1999-01-01', '$2y$10$CMAWM.Znq8tSfvijxYr3/OF/3DImP9h0U7CTN18pjPTtO/BwwjS3O', 'Kaindorf 232/3', '8600', 'hermann@office.at', 1),
('658c21f011fdb', 'Marcel', '1999-01-01', '$2y$10$GyG.UPKh/wrEIzSYD51SUuOcpGEmKkfnohtuovTNB2wjdJGd1vRpO', 'Schlossberggasse 232/3', '8224', 'marcel@office.at', 1),
('658ecfba9e0af', 'Melli', '1999-01-01', '$2y$10$/iEepYCXpAFSWFFigGUKbOE/Kjjfo.O8uHXA7jECTYAV/efGpakdu', 'Schlossberggasse 232/3', '8600', 'melli@office.at', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
