-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 mrt 2026 om 14:07
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `adres` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `role`, `adres`) VALUES
(9, 'kelvin@kelvin.nl', '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', 'customer', ''),
(10, 'cassandra@cassandra.nl', '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', 'customer', ''),
(12, 'test@example.com', '$2y$14$RbPLoCuSKEO4UF.L52AXmueisuhFwG0yyYQoGQzx9ctC/HgyHvEjO', 'admin', ''),
(13, 'test@test.com', '$2y$14$vGB26I/PLGNZbCmSijvv9uscdaTyWCU5zTONLOgBp17x4v7b9HLTq', 'customer', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `fuel` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `transmission` enum('automatic','manual') NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cars`
--

INSERT INTO `cars` (`id`, `name`, `category`, `image`, `fuel`, `seats`, `transmission`, `price`, `description`) VALUES
(1, 'Nissan GT-R', 'Sport', '', 70, 2, 'manual', 100, 'NISMO is het toonbeeld geworden van Nissan\'s uitzonderlijke prestaties, geïnspireerd door het meest meedogenloze testterrein: het circuit.'),
(2, 'BMW 5 Series', 'sedan', 'assets/images/products/bmw5.jpg', 68, 5, 'automatic', 120, 'De BMW 5 Serie staat voor luxe, comfort en dynamische prestaties in elke rit.'),
(3, 'Mercedes-Benz E-Class', 'sedan', 'assets/images/products/eclass.jpg', 66, 5, 'automatic', 130, 'De E-Klasse combineert verfijnde luxe met geavanceerde technologie en rijcomfort.'),
(4, 'Audi A6', 'sedan', 'assets/images/products/a6.jpg', 65, 5, 'automatic', 125, 'De Audi A6 levert premium comfort en krachtige prestaties met iconische uitstraling.'),
(5, 'Tesla Model S', 'electric', 'assets/images/products/models.jpg', 0, 5, 'automatic', 180, 'De Model S herdefinieert elektrisch rijden met snelheid, luxe en innovatie.'),
(6, 'BMW 7 Series', 'sedan', 'assets/images/products/bmw7.jpg', 78, 5, 'automatic', 220, 'De 7 Serie belichaamt topklasse luxe met ongeëvenaard comfort en technologie.'),
(7, 'Mercedes-Benz S-Class', 'sedan', 'assets/images/products/sclass.jpg', 76, 5, 'automatic', 250, 'De S-Klasse zet de standaard in luxe, innovatie en ultiem rijcomfort.'),
(8, 'Audi A8', 'sedan', 'assets/images/products/a8.jpg', 72, 5, 'automatic', 230, 'De Audi A8 biedt limousineklasse luxe met vooruitstrevende technologie.'),
(9, 'Porsche Panamera', 'sports', 'assets/images/products/panamera.jpg', 75, 4, 'automatic', 280, 'De Panamera combineert sportwagenprestaties met dagelijkse luxe en comfort.'),
(10, 'Range Rover Vogue', 'suv', 'assets/images/products/rangerover.jpg', 90, 5, 'automatic', 300, 'De Range Rover Vogue staat voor ultieme luxe en ongekende terreinprestaties.'),
(11, 'Range Rover Sport', 'suv', 'assets/images/products/rangerover_sport.jpg', 85, 5, 'automatic', 260, 'De Range Rover Sport levert krachtige prestaties met een luxe sportieve uitstraling.'),
(12, 'BMW X5', 'suv', 'assets/images/products/x5.jpg', 80, 5, 'automatic', 160, 'De BMW X5 combineert luxe, ruimte en prestaties voor elke situatie.'),
(13, 'BMW X7', 'suv', 'assets/images/products/x7.jpg', 83, 7, 'automatic', 220, 'De X7 biedt ultieme ruimte en luxe voor wie alleen het beste verwacht.'),
(14, 'Mercedes-Benz GLE', 'suv', 'assets/images/products/gle.jpg', 85, 5, 'automatic', 170, 'De GLE brengt comfort, technologie en kracht samen in één premium SUV.'),
(15, 'Mercedes-Benz G-Class', 'suv', 'assets/images/products/gclass.jpg', 100, 5, 'automatic', 350, 'De G-Klasse is een icoon van luxe en kracht, gebouwd voor elke uitdaging.'),
(16, 'Audi Q7', 'suv', 'assets/images/products/q7.jpg', 75, 7, 'automatic', 150, 'De Audi Q7 biedt ruimte, luxe en technologie voor elke rit.'),
(17, 'Audi Q8', 'suv', 'assets/images/products/q8.jpg', 85, 5, 'automatic', 200, 'De Q8 combineert een krachtig design met premium prestaties en comfort.'),
(18, 'Porsche Cayenne', 'suv', 'assets/images/products/cayenne.jpg', 85, 5, 'automatic', 220, 'De Cayenne levert sportwagengevoel in een luxe en veelzijdige SUV.'),
(19, 'Tesla Model X', 'electric', 'assets/images/products/modelx.jpg', 0, 7, 'automatic', 210, 'De Model X combineert futuristisch design met ruimte en elektrische kracht.'),
(20, 'Ford Mustang GT', 'coupe', 'assets/images/products/mustang.jpg', 61, 4, 'manual', 190, 'De Mustang GT brengt pure Amerikaanse power en iconische rijbeleving.'),
(21, 'Chevrolet Camaro SS', 'coupe', 'assets/images/products/camaro.jpg', 60, 4, 'automatic', 180, 'De Camaro SS staat voor brute kracht en een agressief sportief karakter.'),
(22, 'Porsche 911 Carrera', 'sports', 'assets/images/products/911.jpg', 64, 4, 'automatic', 400, 'De 911 Carrera is het ultieme icoon van precisie, snelheid en rijplezier.'),
(23, 'Audi R8', 'sports', 'assets/images/products/r8.jpg', 73, 2, 'automatic', 600, 'De Audi R8 levert pure supercar-prestaties met dagelijkse bruikbaarheid.'),
(24, 'Lamborghini Huracan', 'sports', 'assets/images/products/huracan.jpg', 80, 2, 'automatic', 900, 'De Huracán staat voor extreme prestaties en een ongeëvenaarde rijervaring.'),
(25, 'Ferrari F8 Tributo', 'sports', 'assets/images/products/f8.jpg', 78, 2, 'automatic', 950, 'De F8 Tributo combineert Italiaanse passie met ongekende snelheid en luxe.'),
(26, 'Bentley Continental GT', 'coupe', 'assets/images/products/bentley.jpg', 90, 4, 'automatic', 500, 'De Bentley GT biedt ultieme luxe, kracht en een verfijnde rijervaring.'),
(27, 'Rolls-Royce Cullinan', 'suv', 'assets/images/products/cullinan.jpg', 100, 5, 'automatic', 1200, 'De Cullinan belichaamt ultieme luxe, stilte en een ongeëvenaarde rijervaring.'),
(28, 'Rolls-Royce Ghost', 'sedan', 'assets/images/products/ghost.jpg', 82, 5, 'automatic', 1100, 'De Ghost staat voor pure elegantie, comfort en moeiteloze prestaties.'),
(29, 'Lamborghini Aventador S', 'sports', 'assets/images/products/aventador.jpg', 85, 2, 'automatic', 1400, 'De Aventador levert extreme V12-prestaties en een onvergetelijke rijbeleving.'),
(30, 'Ferrari SF90 Stradale', 'sports', 'assets/images/products/sf90.jpg', 68, 2, 'automatic', 1500, 'De SF90 combineert hybride innovatie met ongekende Ferrari-prestaties.'),
(31, 'McLaren 720S', 'sports', 'assets/images/products/720s.jpg', 72, 2, 'automatic', 1300, 'De 720S biedt pure snelheid, precisie en een futuristisch design.'),
(32, 'Bentley Bentayga Speed', 'suv', 'assets/images/products/bentayga.jpg', 85, 5, 'automatic', 900, 'De Bentayga Speed combineert luxe, kracht en comfort in een exclusieve SUV.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservations`
--

CREATE TABLE `reservations` (
  `user` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`user`),
  ADD KEY `fk_reservations_cars1_idx` (`car`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_account` FOREIGN KEY (`user`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservations_cars1` FOREIGN KEY (`car`) REFERENCES `cars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
