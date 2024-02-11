-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2024 at 01:21 PM
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
  `fk_postID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`ID`, `fk_userID`, `fk_postID`) VALUES
(1, 1, '1'),
(2, 1, '5'),
(3, 3, '1'),
(4, 3, '3'),
(5, 11, '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `CID` text NOT NULL,
  `description` text DEFAULT NULL,
  `fk_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `CID`, `description`, `fk_userID`) VALUES
(1, 'QmaJwpxiwPPB2wJ5ncBK2NhaDgi2Yqnd7GVeQHGi8mjNAf', 'Wyścigowa tradycja z Valtterim Bottasem! Gdy życie stawia przede mną butelkę, ja trzymam ją z klasą! #ValtteriBottas #Tradycje #Szampan #Mem', 5),
(2, 'Qmc5SXw5YSfy1sFeRT5K1ZRJ5bj8UmUtcD4vMtUWK9WcHF', 'Koenigsegg CCX w pełnej okazałości pokonuje malowniczą, krętą trasę. Potężny silnik w harmonii z zakrętami, a błyskawiczne przyspieszenie świętuje triumf nad krętym asfaltem. Luksus, moc i perfekcyjna kontrola splatają się w tańcu po drodze, tworząc niezapomnianą symfonię dynamiki i designu. #KoenigseggCCX #SztukaNaDrodze #MocWZakrętach', 11),
(3, 'Qme5XJWjTcXjHyoyyqkBxMEeP5QVobgwe4mC4qzwJaEgAj', 'Dwaj mistrzowie toru na jednym zdjęciu! Max Verstappen w bolidzie Red Bull Racing, a Pierre Gasly reprezentujący Alphatauri w sezonie 2021. Wzajemna rywalizacja, talent i prędkość, które definiują dynamikę Formuły 1. #F1 #Honda #Verstappen #Gasly #F1Rivalry', 14),
(4, 'QmeGKYzFKPVD5DXMd1HoSrMSJo2WWYPwNdVEWc5sZJZFhw', 'W zimowym raju, Koenigsegg Agera prezentuje swoją potęgę, a na bagażniku dachowym gości niezwykły pasażer - Stig z Top Gear. Białe auto, białe otoczenie, biały kombinezon Stiga - to spotkanie legendy motoryzacji z zimową aurą. Moc, szybkość i tajemnicza obecność Stiga, tworzą magię na śnieżnych drogach. #KoenigseggAgera #Stig #ZimowaMoc', 11),
(5, 'QmeH46WfJEa6JtXnG7cUck3RNPRbwHHteJbxoHVCS3r3Fd', 'Marc Marquez w pełnej krasie! Wheelie z mistrzem motocyklowych emocji. Adrenalina na asfalcie, sztuka w powietrzu. Nieśmiertelność na dwóch kółkach! #MarcMarquez #MistrzWheelie #MotoGP', 7),
(6, 'QmfHsUH8nmuTkUVrhQjAdgbRp6CMn3PRLFW7F2fb6Z9GqN', 'Fascynujące chwile z testów na torze w Barcelonie. Lewis Hamilton prowadzi bolid Mercedes F1 z 2020, wyposażony w kraty do pomiaru przepływu powietrza. Nauka, innowacje, dominacja! #LewisHamilton #MercedesF1 #InnowacjeNaTorze', 8),
(7, 'QmPajFTEA6mdeVphjtRaxZz8AVFrZrsUzkiVCBZnsKpaHb', 'Siła w działaniu! Codzienna praca nad sobą na #siłownia. Żaden dzień bez postępów! #Motywacja #FitnessLifestyle', 5),
(8, 'QmQpkPPjdgG24VVdcvzQwD2uuVGy9Pm3rcGoVhJa53xQeh', 'Aston Martin prezentuje się majestatycznie na piaszczystym zakręcie. Czerwień mocy w harmonii z przyrodą. Elegancja, styl i silnik w jednym spojrzeniu. #AstonMartin #ElegancjaNaDrodze #MocISztuka', 9),
(9, 'QmSxAKPW9xMMHW3jpoaJ3CevfWVwgxWMjJR5bTModi1ZHt', 'Marc Marquez w płynnym tańcu na torze. Szybkość, perfekcja, kontrola. Po prostu jedzie, a za nim zostaje tylko smuga pasji. Mistrzowska jazda w czystej postaci! #MarcMarquez #MotoGP #PasjaNaKołach', 7),
(10, 'QmTVz4rUpLU7sMY9bDVWkDEAqqX4B7jxUTM1MfsfmfL87g', 'Aston Martin 2023 w całej swej nowoczesnej chwale! Dynamiczne linie, futurystyczny design. Bolid, który definiuje nowy standard elegancji i szybkości.  #AstonMartin #NowoczesnośćNaTorze #InnowacyjnyDesign', 11),
(11, 'QmUo62KGXTbUz5Xqr1P8c3T2qA6ajuLfQuNMZozp64tMQ7', 'Otoczony luksusem: Bugatti Veyron Super Sport. Kombinacja elegancji i mocy. Szybki jak myśl, piękny jak sen. To nie jest tylko samochód, to manifestacja doskonałości inżynierii i designu. #BugattiVeyronSS #Luksus #Potęga', 6),
(12, 'QmUoBazhnj53REqNc6LpiYsT7dnSrfKKKqgoPNJ86dfJn3', 'Odkrywanie przyszłości wyścigów: McLaren MCL38 prezentuje się zjawiskowo na torze. Innowacyjny design, potężne osiągi, to bolid, który zdobywa serca fanów i zmienia zasady gry. Siła, szybkość i nieustający ducha rywalizacji w jednym ujęciu. #McLaren #MCL38 #PrzyszłośćWyścigów', 11),
(13, 'QmUwoddtpct693K54XUytp1qmb24AoYBBX6ArsRi1N3vJM', 'Moc i elegancja Red Bulla na zimowym torze! Bolid przecina śnieg z pasją, tworząc kontrast między siłą a delikatnością natury. Red Bull w zimowej scenerii - potęga w białym płaszczu. #RedBullRacing #ZimowaJazda #MocWŚniegu', 14),
(14, 'QmUYBiRb1ioggpaYgQqdcvfndWGEWtJzCDw9N5uGDoTBfj', 'Koenigsegg Agera RS, czarna bestia w jesiennym lesie. Mocne kontrasty z pomarańczowymi akcentami podkreślają wyrafinowany design. Szlachetna elegancja i potężna moc splatają się z naturą, tworząc pełne magii sceny. To nie tylko samochód, to dzieło sztuki, które rozkwita w złotych promieniach jesiennego słońca.', 11),
(15, 'QmXyhkjrLSgws3MwHpKCiRzwdiYk9ShbZgEEpPUiwaBd1s', 'Nostalgiczny powrót do sezonu 2007-2008 z bolidem BMW Sauber na malowniczym torze w Singapurze. Historia, moc i duma w jednym obrazie! #BMWSauber #SingapurGP #MotorsportHistory', 8),
(16, 'QmY9M5uexb2otrWZLRCYk8tEDSQCT87rMJJz5rT9VpWGBT', 'Sebastian Vettel w akcji za kierownicą bolidu Aston Martin w sezonie 2021. Dynamika, doświadczenie i niepowtarzalny styl mistrza, który znalazł nowe wyzwanie. Bolid mieni się w słońcu, podczas gdy mistrzowska jazda definiuje kolejny rozdział w historii wyścigów. #SebastianVettel #AstonMartin #MistrzowskaJazda', 11),
(17, 'QmZWQDc6E6PUA3Nt4TuHcWLW7vS5v8JVyB1CsESnHiwUuq', 'Chwila dramatu na torze w Australii. Fernando Alonso w McLarenie, złowieszcza kraksa, ale bezpieczeństwo zawsze na pierwszym miejscu. Żelazna wola mistrza w obliczu wyzwań. #FernandoAlonso #McLaren #BezpieczeństwoNaTorze', 8),
(18, 'QmT7WgkdYdQgmz6mppcRxKKGCANuEH1bG9o67vuMqFwRTw', 'Bugatti Chiron, kontrastujący z żółto-czarną elegancją, zatrzymuje czas na malowniczej drodze wzdłuż zatoki. To nie tylko samochód - to dzieło sztuki na tle przyrody. Potęga, szybkość i styl spotykają się z naturalnym pięknem, tworząc harmonię luksusu i pejzażu. #BugattiChiron #LuksusNaDrodze #ZatokowaElegancja', 11);

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
  `profile_photoCID` text NOT NULL,
  `fk_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`, `profile_photoCID`, `fk_roleID`) VALUES
(1, 'admin', 'admin@example.com', 'admin', 'Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC', 1),
(2, 'moderator', 'moderator@example.com', 'moderator', 'Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC', 2),
(3, 'user_test', 'user_test123@example.com', 'Qwerty!23', 'Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC', 3),
(4, 'test123', 'test123@email.com', 'Qwerty!23', 'Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC', 3),
(5, 'jan_kowal', 'jankowalski@example.com', 'Qwerty!23', 'QmSrBZmHGBStEyoUAqn36w3JyjesAQWXQjrKD43zzEQ6mh', 3),
(6, 'stefcio1234', 'stefan1234@example.com', 'Stefcio!234', 'QmX53697aavfMybQeR6psWgF97VyHwkuZt1NbjUwYk6Jxs', 3),
(7, 'aadadadadad', 'adambakowicz.vp.pl@vp.pl', 'Qwerty!23', 'QmarBxX9NCmui6Cwsqb9wKP6gjSJVuKLYTZ7wSe7yUw6gj', 3),
(8, 'grazka87', 'grazynamoc@example.com', 'Qwerty!23', 'QmfSbTosXYVfPeviQmNJiz787K9F816YKY1e5UGJdk6nAL', 3),
(9, 'jasia_m', 'jasiam@example.com', 'Qwerty!23', 'QmcqfhdrA5LrEScHJV3twh9L7YEYFj8Bq2yGaNWvhxNwFQ', 3),
(10, 'janek12', 'janekkowal@example.com', 'Qwerty!23', 'Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC', 3),
(11, 'adamsek123', 'adamsek@example.com', 'Qwerty!23', 'QmY2qXxPcCTuSUhBWKhASkRRH51TfQKvtQjXwaeJRs9Yug', 3),
(12, 'max_ver', 'maxv@example.com', 'Qwerty!23', 'Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC', 3),
(13, 'ferrari', 'ferrari@example.com', 'Qwerty!23', 'QmTanm4EA2MNXX4w2nwEaURJ5cGURC2pQoYzSyY6fMxGRV', 3),
(14, 'OracleRedBullRacing', 'redbullracing@example.com', 'Qwerty!23', 'QmfQrfSgJjLmDS43B6dZSiPKFZRVYEWWMXXxzAVGpXFWW3', 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`) USING BTREE;

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
