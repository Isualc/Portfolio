-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Jan 2024 um 17:51
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
-- Datenbank: `onlineshop`
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
(1, 'Ätherklinge', 210000.00, '2024-01-06 15:15:30', 'img\\bild1.png', 'Geschmiedet im Herzen eines gefallenen Sterns, schneidet dieses Schwert durch die Essenz der Zeit selbst. Ein Schlag kann Risse im Gewebe der Realität hinterlassen, wodurch Verbündete in der Lage sind, durch diese zu schlüpfen um dich dir anzuschließen.'),
(2, 'Wirbelherz', 200000.00, '2023-12-29 19:12:56', 'img\\bild2.png', 'Dieser Schild pulsiert mit einer Energie, die stetig zwischen Chaos und Ordnung schwankt. Jeder Hieb auf ihn entfesselt einen Sturm, der Feinde in einen Strudel aus Verwirrung stürzt, ihre Sinne benebelt und ihre Verteidigung schwächt.'),
(3, 'Sphärenzepter', 400000.00, '2023-12-29 19:12:32', 'img\\bild3.png', 'Mehr als nur eine Waffe, ist das Sphärenzepter ein Artefakt alter Weisheit. Seine Kraft ermöglicht es dem Träger, das Schlachtfeld aus der Vogelperspektive zu betrachten, wodurch taktische Manöver mit übernatürlicher Präzision ausgeführt werden können.'),
(4, 'Greifenklauen-Handschuhe', 100000.00, '2023-12-29 19:14:33', 'img\\bild4.png', 'Diese Handschuhe verleihen dem Träger die Stärke und den Griff eines Greifen. Perfekt für den Nahkampf, ermöglichen sie es, Schilder zu zerschmettern und Panzerungen zu zerreißen, als wären sie aus Pergament.'),
(5, 'Rüstung der Unbeugsamkeit', 400000.00, '2023-12-29 19:15:33', 'img\\bild5.png', 'Angelegt, wird der Träger dieser Rüstung zu einer unaufhaltsamen Macht. Jeder Schritt hallt mit der Autorität alter Könige wider und jeder Stoß wird von einer Aura der Unverwundbarkeit begleitet.'),
(6, 'Ozeanauge', 10000.00, '2023-12-29 19:16:37', 'img\\bild6.png', 'Eingebettet in eine geheimnisvolle Metallkonstruktion, ermöglicht dieses Artefakt die Kontrolle über Wasserelemente. Ströme können herbeigerufen, Wellen gesteuert und selbst die tiefsten Abgründe der Meere erforscht werden.'),
(7, 'Galaxienorb', 200000.00, '2023-12-29 19:17:22', 'img\\bild7.png', 'Der Galaxienorb birgt das Licht entfernter Sterne. Seine Macht erlaubt es dem Benutzer, Licht zu biegen und Illusionen zu erschaffen, die so lebensecht sind, dass sie selbst die klügsten Gegner täuschen können.'),
(8, 'Wirbeltrank', 200000.00, '2023-12-29 19:17:22', 'img\\bild8.png', 'Ein Schluck aus diesem Trank versetzt den Trinker in einen Zustand höchster Konzentration, in dem die Zeit zu kriechen scheint. In diesem Zustand kann der Krieger Angriffe mit übermenschlicher Geschwindigkeit und Präzision ausführen.');

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
('657d9bfc75c9a', 'Claus', '1981-06-18', '$2y$10$2LVjUrRY2nu2wHbBOloQ/OF0N74E8x.cT/C1FVibItyvvWQfIhw8K', 'Erzherzog-Johann-Gasse 8/06', '8600', 'claus_hierzer@gmx.at', 7),
('657d9c213403a', 'Angie', '1984-11-04', '$2y$10$ZqY6hcJrG/lvR/eWnNx6S.FsDpZ5hp3Eiav/l57LQcVJCzTbjFjLi', '232/3 Kaindorf', '8600', 'angielenpedroso11@gmail.com', 1),
('657f577cd9678', 'Marco', '1999-08-05', '$2y$10$yeotHZX3uUJWDVwNkG7gGeDI/KYOwdpzL/qf3d719FRtv6R1J4mi.', 'Schlossberggasse 232/3', '8600', 'marco@office.at', 1),
('65940717ba4a4', 'Luki', '1999-01-01', '$2y$10$93XSiN8rzoyG69NnwkW9BuEgsc.OFROYVIKdhtmahJjOc4pOUpjJC', 'Erzherzog-Johann-Gasse 8/06', '8600', 'luki@offixe.at', 7),
('659407e6b210a', 'Werner', '1999-01-01', '$2y$10$zSrEdUtGnVW7.HrpoclsnuIJ.KoS21gMoRJITfqwPKmYcb31MwTDi', 'Schlossberggasse 232/3', '8224', 'werner@office.at', 1),
('6594093edb3fa', 'Marcel', '1999-01-01', '$2y$10$YCIZnaK2L0wOu4N2vXdzPO7/qTkPbbPjgsgbDjtfwOJA96QtDzcuy', 'Erzherzog-Johann-Gasse 8/06', '8600', 'marcel@office.at', 1),
('65940a5c13ef3', 'Hermann', '1999-01-01', '$2y$10$b3YZHt4ZsoMLaU8i5pN.0uSaz0RmtnlJTqedKWtI9OrC6I7H4IDGC', 'Schlossberggasse 232/3', '8224', 'hermann@office.at', 1);

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
