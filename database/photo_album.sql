-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 11:40 AM
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
-- Struktura tabeli dla tabeli `hashtags`
--

CREATE TABLE `hashtags` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hashtags_to_photos`
--

CREATE TABLE `hashtags_to_photos` (
  `ID` int(11) NOT NULL,
  `fk_hashtagID` int(11) NOT NULL,
  `fk_photoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `ID` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
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
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `hashtags_to_photos`
--
ALTER TABLE `hashtags_to_photos`
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
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
