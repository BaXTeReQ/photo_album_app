-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 05, 2024 at 03:31 PM
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
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`ID`, `CID`, `photoName`, `description`) VALUES
(1, 'Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC', 'default_user_profile.png', 'Default photo for user'),
(2, 'QmeZ78pPC6QVY8F1xdEg5tTRBMtvX1oj1yCYBchniZuMfY', 'profilePic_11.jpg', 'Profile photo for user with ID = 11'),
(3, 'QmNVdGkuWeeEtf7918GCQGS1k5B8ZB56L2zeytfxuahvvZ', 'profilePic_8.jpg', 'Profile photo for user with ID = 8'),
(4, 'QmP4AmDYo9oqWDzE1WzNeow6HSenR1GTaqSwWQYYM51m6A', 'profilePic_5.jpg', 'Profile photo for user with ID = 5'),
(5, 'Qme3QMbvhKV22TSYv2N8fZFPN6TXHjSKAhkKVDuBkLshrw', 'profilePic_3.jpg', 'Profile photo for user with ID = 3'),
(6, 'QmSNBDrnC5q7DaFhZjnzqBwiViFKo8H8DakGbSq3bsEnJn', 'profilePic_10.jpg', 'Profile photo for user with ID = 10'),
(7, 'QmZbCmzXsUDA6zuSTHqQNc3dQzxr6nEzVTLv7DH1H3sa34', 'profilePic_9.jpg', 'Profile photo for user with ID = 9'),
(8, 'QmXZTaANxPP8NkG3efgCStm3aFnD63iUoFqogFyMFUSzDb', 'profilePic_7.jpg', 'Profile photo for user with ID = 7'),
(9, 'QmSkrZhhGiFPUELdPHT3S4N5Fi3FBYz1w5cpgR771HnxXr', 'profilePic_6.jpg', 'Profile photo for user with ID = 6'),
(10, 'QmNSH4VUEgxY7at3rJsKS8BUQuLDrFh5coqaG3M3W3GJdo', 'profilePic_4.jpg', 'Profile photo for user with ID = 4');

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
(10, 'janek12', 'janekkowal@example.com', 'Qwerty!23', 3),
(11, 'adamsek123', 'adamsek@example.com', 'Qwerty!23', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_profile_photos`
--

CREATE TABLE `users_profile_photos` (
  `ID` int(11) NOT NULL,
  `fk_userID` int(11) NOT NULL,
  `fk_photoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_profile_photos`
--

INSERT INTO `users_profile_photos` (`ID`, `fk_userID`, `fk_photoID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 5),
(4, 4, 10),
(5, 5, 4),
(6, 6, 9),
(7, 7, 8),
(8, 8, 3),
(9, 9, 7),
(10, 10, 6),
(11, 11, 2);

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
  ADD PRIMARY KEY (`ID`);

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
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users_uploaded_photos`
--
ALTER TABLE `users_uploaded_photos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_profile_photos`
--
ALTER TABLE `users_profile_photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_uploaded_photos`
--
ALTER TABLE `users_uploaded_photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles` FOREIGN KEY (`fk_roleID`) REFERENCES `roles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
