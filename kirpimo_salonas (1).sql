-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 12:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kirpimo salonas`
--

-- --------------------------------------------------------

--
-- Table structure for table `includes`
--

CREATE TABLE `includes` (
  `fk_Servicesid_Services` int(11) NOT NULL,
  `fk_Reservationid_Reservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `includes`
--

INSERT INTO `includes` (`fk_Servicesid_Services`, `fk_Reservationid_Reservation`) VALUES
(30, 25),
(31, 31),
(32, 23),
(33, 21),
(33, 30),
(33, 43),
(33, 45),
(33, 46),
(34, 26),
(35, 44),
(36, 29),
(36, 47),
(36, 48),
(38, 24),
(38, 27),
(38, 28);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `End_time` timestamp NOT NULL DEFAULT '2022-10-27 10:35:00',
  `id_Reservation` int(11) NOT NULL,
  `fk_Barber_code` bigint(11) NOT NULL,
  `fk_UserPersonal_code` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Start_time`, `End_time`, `id_Reservation`, `fk_Barber_code`, `fk_UserPersonal_code`) VALUES
('2022-02-18 13:00:00', '2022-02-18 13:30:00', 21, 39911140571, 39911140570),
('2022-04-18 08:00:00', '2022-04-18 09:00:00', 23, 39911140571, 39911140570),
('2022-03-18 11:00:00', '2022-03-18 11:30:00', 24, 39911140570, 39911140571),
('2022-12-30 10:00:00', '2022-12-30 10:30:00', 25, 39911140570, 39911140571),
('2022-12-31 12:00:00', '2022-12-31 12:30:00', 26, 39911140570, 39911140571),
('2022-12-31 13:00:00', '2022-12-31 13:30:00', 27, 39911140570, 39911140571),
('2022-10-27 09:00:00', '2022-10-27 09:30:00', 28, 39911140570, 39911140571),
('2022-04-17 09:00:00', '2022-04-17 09:45:00', 29, 39911140570, 39911140571),
('2022-12-15 15:00:00', '2022-12-15 15:30:00', 30, 39911140571, 39911140571),
('2022-12-15 14:00:00', '2022-12-15 15:15:00', 31, 39911140571, 39911140571),
('2022-05-16 08:00:00', '2022-05-16 08:30:00', 43, 39911140571, 50001015555),
('2022-03-16 13:00:00', '2022-03-16 14:00:00', 44, 39911140570, 39805248712),
('2022-12-31 14:00:00', '2022-12-31 14:30:00', 45, 39911140571, 39805248712),
('2023-02-16 08:00:00', '2023-02-16 08:30:00', 46, 39911140571, 39805248712),
('2022-12-31 09:00:00', '2022-12-31 09:45:00', 47, 39911140570, 39805248712),
('2022-12-28 09:00:00', '2022-12-28 09:45:00', 48, 39911140570, 39805248712);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `Name` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Price` decimal(6,0) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  `Tags` enum('Vyriškas kirpimas','Moteriškas kirpimas','Plaukų dažymas (vyrams)','Plaukų dažymas (moterims)') CHARACTER SET utf16 COLLATE utf16_lithuanian_ci DEFAULT NULL,
  `id_Services` int(11) NOT NULL,
  `fk_Barber_code` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`Name`, `Price`, `Duration`, `Description`, `Tags`, `id_Services`, `fk_Barber_code`) VALUES
('Trumpų plaukų kirpimas', '150', 50, 'Testas', 'Vyriškas kirpimas', 30, 39911140570),
('Ilgų plaukų dažymas', '120', 75, 'Moteriškų ilgų plaukų dažymas su kliento dažais', 'Plaukų dažymas (moterims)', 31, 39911140571),
('Ilgų plaukų kirpimas', '50', 60, 'Vyriškų ilgų plaukų kirpimas ir formavimas', 'Vyriškas kirpimas', 32, 39911140571),
('Trumpų plaukų kirpimas', '40', 30, 'Moteriškų trumpų plaukų kirpimas', 'Moteriškas kirpimas', 33, 39911140571),
('Trumpų plaukų kirpimas', '25', 30, 'Vyriškų trumpų plaukų kirpimas', 'Vyriškas kirpimas', 34, 39911140570),
('Trumpų plaukų dažymas', '75', 60, 'Moteriškų plaukų dažymas su salono priemonėmis', 'Plaukų dažymas (moterims)', 35, 39911140570),
('Vidutinių plaukų kirpimas', '45', 45, 'Moteriškų vidutinių (kare ir truputi ilgesnių) plaukų kirpimas', 'Moteriškas kirpimas', 36, 39911140570),
('Trumpų plaukų dažymas', '50', 30, 'Trumpų vyriškų plaukų dažymas', 'Plaukų dažymas (vyrams)', 37, 39911140570),
('Trumpų plaukų dažymas', '120', 30, '', 'Plaukų dažymas (vyrams)', 38, 39911140570),
('Trumpų plaukų kirpimas', '55', 30, 'Vyriškų plaukų kirpimas', 'Vyriškas kirpimas', 39, 39911140571),
('Vidutinių plaukų dažymas', '75', 60, 'Vidutinio ilgio moteriškų plaukų dažymas', '', 40, 39911140570),
('Labai ilgų plaukų dažymas', '125', 90, 'Labai ilgų moteriškų plaukų dažymas', 'Plaukų dažymas (moterims)', 43, 39911140570);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Surname` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Personal_code` bigint(12) NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Role` enum('Client','Admin','Guest','Barber') COLLATE utf8mb4_lithuanian_ci NOT NULL DEFAULT 'Guest',
  `Gender` enum('Male','Female','Other') COLLATE utf8mb4_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Surname`, `Personal_code`, `Email`, `Password`, `Role`, `Gender`) VALUES
('Antanas', 'Riebžda', 39805248712, 'antrie@gmail.com', '$2y$10$5xJL.refAkfITFdj2a6V9eDOaO7cUI/ulvOjobYI452A2pH10Gvdm', 'Client', 'Male'),
('Viktoras', 'Dechtiar', 39911140570, 'dechtiar3@gmail.com', '$2y$10$hJAt0/1jqlAbXNg0Yw7yWuPBMlNFXDdx6RlaXyoHHYsqWbhMz9Qui', 'Barber', 'Male'),
('Testas', 'Testas', 39911140571, 'testas@gmail.com', '$2y$10$p715mZtB8cAkqSDyujeIp.5Gvky41o.rKJstwMkD/9wBX4T8hqBNu', 'Barber', 'Other'),
('Petras', 'Martinkus', 50001015555, 'admin@gmail.com', '$2y$10$wiv/PPtnKjvCNjlEmus.n.ao68G4XSqS4lBsRnQcQpf1hRsMHpUzK', 'Admin', 'Other');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `includes`
--
ALTER TABLE `includes`
  ADD PRIMARY KEY (`fk_Servicesid_Services`,`fk_Reservationid_Reservation`),
  ADD KEY `includes1` (`fk_Reservationid_Reservation`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_Reservation`),
  ADD KEY `serviced_by` (`fk_Barber_code`),
  ADD KEY `creates` (`fk_UserPersonal_code`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_Services`),
  ADD KEY `makes` (`fk_Barber_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Personal_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_Reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id_Services` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `includes`
--
ALTER TABLE `includes`
  ADD CONSTRAINT `includes` FOREIGN KEY (`fk_Servicesid_Services`) REFERENCES `services` (`id_Services`),
  ADD CONSTRAINT `includes1` FOREIGN KEY (`fk_Reservationid_Reservation`) REFERENCES `reservation` (`id_Reservation`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `creates` FOREIGN KEY (`fk_UserPersonal_code`) REFERENCES `users` (`Personal_code`),
  ADD CONSTRAINT `serviced_by` FOREIGN KEY (`fk_Barber_code`) REFERENCES `users` (`Personal_code`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `makes` FOREIGN KEY (`fk_Barber_code`) REFERENCES `users` (`Personal_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
