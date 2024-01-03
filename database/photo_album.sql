-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 03, 2024 at 06:31 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo_album`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `favourites`
--

CREATE TABLE `favourites` (
  `ID` int(11) NOT NULL,
  `fk_userID` int(11) NOT NULL,
  `fk_photoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `ID` int(11) NOT NULL,
  `CID` text NOT NULL,
  `photoName` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fk_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`, `fk_roleID`) VALUES
(1, 'admin', 'admin@example.com', 'admin', 1),
(2, 'moderator', 'moderator@example.com', 'moderator', 2),
(3, 'user_test', 'user_test123@example.com', 'Qwerty!23', 3),
(4, 'test123', 'test123@email.com', 'Qwerty!23', 3),
(5, 'jan_kowal', 'jankowalski@example.com', 'Qwerty!23', 3),
(6, 'stefcio1234', 'stefan1234@example.com', 'Stefcio!234', 3),
(7, 'aadadadadad', 'adambakowicz.vp.pl@vp.pl', 'Qwerty!23', 3),
(8, 'grazka87', 'grazynamoc@example.com', 'Qwerty!23', 3),
(9, 'jasia_m', 'jasiam@example.com', 'Qwerty!23', 3),
(10, 'janek12', 'janekkowal@example.com', 'Qwerty!23', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_profile_photos`
--

CREATE TABLE `users_profile_photos` (
  `ID` int(11) NOT NULL,
  `fk_userID` int(11) NOT NULL,
  `fk_photoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_uploaded_photos`
--

CREATE TABLE `users_uploaded_photos` (
  `ID` int(11) NOT NULL,
  `fk_userID` int(11) NOT NULL,
  `fk_photoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_userID` (`fk_userID`) USING BTREE,
  ADD KEY `fk_photoID` (`fk_photoID`) USING BTREE;

--
-- Indeksy dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `users_roles` (`fk_roleID`);

--
-- Indeksy dla tabeli `users_profile_photos`
--
ALTER TABLE `users_profile_photos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_photoID` (`fk_photoID`),
  ADD KEY `fk_userID` (`fk_userID`);

--
-- Indeksy dla tabeli `users_uploaded_photos`
--
ALTER TABLE `users_uploaded_photos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_photoID` (`fk_photoID`),
  ADD KEY `fk_userID` (`fk_userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `photos_ID` FOREIGN KEY (`fk_photoID`) REFERENCES `photos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ID` FOREIGN KEY (`fk_userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles` FOREIGN KEY (`fk_roleID`) REFERENCES `roles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_profile_photos`
--
ALTER TABLE `users_profile_photos`
  ADD CONSTRAINT `fk_photoID` FOREIGN KEY (`fk_photoID`) REFERENCES `photos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`fk_userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_uploaded_photos`
--
ALTER TABLE `users_uploaded_photos`
  ADD CONSTRAINT `users_uploaded_photos_ibfk_1` FOREIGN KEY (`fk_photoID`) REFERENCES `photos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_uploaded_photos_ibfk_2` FOREIGN KEY (`fk_userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
