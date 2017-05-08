-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Maj 2017, 22:08
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mysmalltweet`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `tweetId` int(11) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `text` varchar(60) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `userId`, `tweetId`, `creation_date`, `text`) VALUES
(1, 1, 1, '2017-04-27 21:01:08', 'komentarz 1 do tweeta 1'),
(2, 1, 1, '2017-04-27 21:01:46', 'komentarz 2 do tweeta 1'),
(3, 1, 1, '2017-04-27 21:01:56', 'komentarz 3 do tweeta 1'),
(13, 1, 4, '2017-04-27 21:06:05', 'komentarz 1 do tweeta 4'),
(14, 1, 4, '2017-04-27 21:06:17', 'komentarz 2 do tweeta 4'),
(15, 1, 4, '2017-04-27 21:06:25', 'komentarz 3 do tweeta 4'),
(16, 1, 4, '2017-04-27 21:06:33', 'komentarz 4 do tweeta 4'),
(17, 1, 27, '2017-04-27 21:07:23', 'komentarz 1 do tweeta 27'),
(18, 1, 27, '2017-04-27 21:07:31', 'komentarz 2 do tweeta 27'),
(19, 1, 27, '2017-04-27 21:07:39', 'komentarz 3 do tweeta 27'),
(20, 2, 5, '2017-04-27 21:08:11', 'komentarz 1 do tweeta 5'),
(21, 2, 5, '2017-04-27 21:08:18', 'komentarz 2 do tweeta 5'),
(22, 2, 5, '2017-04-27 21:08:27', 'komentarz 3 do tweeta 5'),
(23, 2, 5, '2017-04-27 21:08:35', 'komentarz 4 do tweeta 5'),
(24, 2, 5, '2017-04-27 21:08:44', 'komentarz 5 do tweeta 5'),
(25, 2, 6, '2017-04-27 21:09:05', 'komentarz 1 do tweeta 6'),
(26, 2, 6, '2017-04-27 21:09:17', 'komentarz 2 do tweeta 6'),
(36, 7, 5, '2017-04-28 17:12:02', 'a teraz'),
(37, 7, 6, '2017-04-28 17:14:52', 'gramy dalej'),
(38, 7, 5, '2017-04-28 17:20:42', 'zobaczymy teraz'),
(39, 7, 5, '2017-04-28 17:21:19', 'a teraz???'),
(40, 7, 5, '2017-04-28 17:23:10', 'a teraz, teraz?'),
(41, 7, 5, '2017-05-05 16:50:18', 'sprawdzamy działanie'),
(42, 7, 22, '2017-05-05 16:52:54', 'komentarz do muzyki'),
(43, 7, 22, '2017-05-05 16:58:41', 'drugi komentarz do muzyki'),
(44, 7, 28, '2017-05-05 17:02:00', 'komentarz do nowego tweeta józia'),
(45, 7, 30, '2017-05-05 17:17:24', 'aaa'),
(46, 7, 25, '2017-05-05 17:20:03', 'ala ma kota'),
(47, 7, 22, '2017-05-05 17:21:44', 'aaaaaaaaaaaaaaa'),
(48, 7, 30, '2017-05-05 17:22:49', 'aaa'),
(49, 7, 1, '2017-05-05 17:23:35', 'heja'),
(50, 7, 29, '2017-05-05 17:29:38', 'a kuku'),
(51, 7, 5, '2017-05-05 17:37:35', 'jasna cholera'),
(52, 7, 29, '2017-05-05 18:01:36', 'jasna cholera niech to szlag'),
(53, 13, 30, '2017-05-05 18:47:49', 'działa??????????????'),
(54, 13, 30, '2017-05-05 18:48:34', 'co sie teraz znowu dzieje?'),
(55, 13, 5, '2017-05-05 18:49:59', 'a terazzzzzzzzzzzzzzzzzzz'),
(56, 13, 5, '2017-05-05 18:57:01', 'bardzo ciekawe co sie teraz stanie...'),
(57, 13, 22, '2017-05-05 19:13:12', 'dupadupadupa'),
(58, 13, 31, '2017-05-05 19:17:47', 'komentujemy cyrana'),
(59, 13, 31, '2017-05-05 19:20:54', 'gendo komentuje'),
(60, 13, 31, '2017-05-05 19:21:17', 'gendo????'),
(61, 14, 35, '2017-05-05 19:24:00', 'gendo do genda'),
(62, 14, 29, '2017-05-05 19:36:47', 'kto to komentuje?'),
(63, 14, 35, '2017-05-05 19:37:20', 'gendo pisze ze gendo pisze?'),
(64, 14, 36, '2017-05-05 19:38:03', 'jozio komentuje post genda'),
(65, 14, 36, '2017-05-05 19:38:28', 'jestem jozio?'),
(66, 14, 36, '2017-05-05 19:39:08', 'a teraz kim jestem?'),
(67, 14, 35, '2017-05-05 19:40:38', 'kim jestem?'),
(68, 14, NULL, '2017-05-05 19:45:24', 'kim jestem cholera/'),
(69, 14, NULL, '2017-05-05 19:45:36', 'kim jestem cholera/'),
(70, 14, NULL, '2017-05-05 19:46:35', 'kim jestem cholera/'),
(71, 14, 36, '2017-05-05 19:47:22', 'gendo to ja'),
(72, 14, 31, '2017-05-05 19:48:11', 'gendo komentuje cyrana'),
(73, 7, 31, '2017-05-05 19:53:22', 'cyrana kto komentuje'),
(74, 7, 38, '2017-05-05 19:53:57', 'mozna dostac cholery'),
(75, 7, 39, '2017-05-05 19:54:40', 'bosko jest'),
(76, 14, 39, '2017-05-05 19:59:24', 'dupe komentuje gendo'),
(77, 14, 35, '2017-05-05 20:01:43', 'nowy komentuje genda'),
(78, 7, 44, '2017-05-05 20:05:07', 'naprawde jestem jozefem'),
(79, 7, 35, '2017-05-05 20:05:40', 'genda komentuje jozef'),
(80, 7, 45, '2017-05-05 20:06:53', 'zaprawde to prawda'),
(81, 7, 45, '2017-05-05 20:07:07', 'zajebista prawda'),
(82, 7, 22, '2017-05-05 20:07:34', 'jozio do ani'),
(83, 16, 46, '2017-05-05 20:08:29', 'nowy komentuje nowego'),
(84, 16, 46, '2017-05-05 20:12:20', 'eee'),
(85, 13, 51, '2017-05-05 20:16:59', 'no i ciul'),
(86, 17, 53, '2017-05-05 20:18:29', 'dziala'),
(87, 17, 53, '2017-05-05 20:18:43', '2 rqazy dziala'),
(88, 17, 54, '2017-05-05 20:20:52', 'szlag'),
(89, 37, 62, '2017-05-05 21:37:13', 'dwa pieprzone nawiasy...'),
(90, 37, 62, '2017-05-05 21:48:43', 'wreszcie'),
(91, 11, 45, '2017-05-07 00:45:06', 'mama komentuje'),
(92, 11, 44, '2017-05-07 00:45:51', 'znowu dupa'),
(93, 11, 45, '2017-05-07 00:46:46', 'mama komentuje raz jeszcze'),
(94, 11, 45, '2017-05-07 00:47:10', 'raz jeszcze'),
(95, 11, 22, '2017-05-07 00:47:42', '6 komentarz od mamy'),
(96, 11, 21, '2017-05-07 00:48:01', 'pierwszy komentarz'),
(97, 11, 64, '2017-05-07 00:49:03', 'mama komentuje mame'),
(98, 9, 64, '2017-05-07 00:49:59', 'magda komentuje mame'),
(99, 9, 68, '2017-05-07 09:05:35', 'magda komentuje a kuku');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `written_date` datetime NOT NULL,
  `mess_text` varchar(1800) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `read_unread` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `authorId`, `receiverId`, `written_date`, `mess_text`, `read_unread`) VALUES
(1, 37, 13, '2017-05-06 21:18:48', 'paczamy', 0),
(2, 15, 5, '2017-05-06 21:41:43', 'olga do andrzeja', 0),
(3, 15, 1, '2017-05-06 21:42:23', 'olga do jerzego', 0),
(4, 15, 13, '2017-05-06 21:44:13', 'olga pisze do cyrana', 0),
(5, 15, 13, '2017-05-06 21:46:44', 'jeszcze raz olga chyba do cyrana', 0),
(6, 15, 13, '2017-05-07 00:04:51', 'bawimy sie', 0),
(7, 15, 13, '2017-05-07 00:05:56', 'aaa', 0),
(8, 15, 7, '2017-05-07 00:08:01', 'ciekawe...', 10),
(9, 7, 15, '2017-05-07 00:09:24', 'jozef do olgi', 0),
(10, 7, 15, '2017-05-07 00:11:56', 'ale', 0),
(11, 7, 15, '2017-05-07 00:12:25', 'qqqq', 0),
(12, 7, 15, '2017-05-07 00:13:51', 'jozef do olgi', 0),
(13, 7, 15, '2017-05-07 00:14:56', 'qqq', 0),
(14, 7, 15, '2017-05-07 00:16:16', 'co jest', 0),
(15, 7, 15, '2017-05-07 00:18:48', 'ppisze joozio do olusi', 0),
(16, 7, 15, '2017-05-07 00:21:05', 'porebalo sie', 10),
(17, 7, 15, '2017-05-07 00:23:30', 'piszemy do olgi', 0),
(18, 7, 15, '2017-05-07 00:24:00', 'jeszcze raz do olgi', 10),
(19, 9, 11, '2017-05-07 00:50:30', 'magda pisze do mamy', 0),
(20, 9, 15, '2017-05-07 09:07:05', 'magda pisze do olgi', 0),
(21, 7, 9, '2017-05-07 21:20:39', 'józek do magdy', 10),
(22, 7, 9, '2017-05-07 21:32:53', 'piszemy ciag znakow ponad 30 liter zeby sprawdzic czy funkcja wycinania dziala poprawnie - mam nadzieje, ze tak, bo jak nie bede zly.', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `text` varchar(140) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `creationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tweets`
--

INSERT INTO `tweets` (`id`, `userId`, `text`, `creationDate`) VALUES
(1, 1, 'próba bazy tweets', '2017-04-20'),
(4, 1, 'próba zakończona pomyślnie', '2017-04-10'),
(5, 2, 'O własnych stój siłach – nie zaś podtrzymywany', '2017-04-22'),
(6, 2, 'Chyba nikt naprawdę nie wie, co to znaczy bać się, dopóki jego dziecko nie zacznie nagle krzyczeć w nocy', '2017-03-22'),
(9, 3, 'W miłości to jest nieszczęściem: raz wojna, raz pokój', '2017-03-10'),
(11, 3, 'Ciało zmarłego wroga zawsze słodko smakuje', '2017-01-05'),
(18, 3, 'Staram się odnaleźć siebie, czasem to nie jest proste', '2017-01-09'),
(19, 5, 'Można spędzić w sposób sensowny lata z jednym człowiekiem po to, by mu pomóc w zrozumieniu siebie', '2017-04-24'),
(20, 5, 'Za każdym razem, kiedy jestem na szczycie, widzę nowy, który chciałabym zdobyć. To tak, jakbym nie mogła się zatrzymać', '2017-02-02'),
(21, 6, 'Życie jest chwilą wieczności ', '2017-01-02'),
(22, 6, 'Muzyka jest kąpielą duszy zmywającą z niej wszelką nieczystość', '2017-04-29'),
(23, 7, 'Cisza. Brak odpowiedzi. Kłopot polegał na tym, że cisza to też odpowiedź', '2017-04-13'),
(24, 7, 'Ludzie mają naturalną skłonność do wywyższania się, ustawiania w pozycji osób wybranych i bardzo szczególnych', '2017-01-01'),
(25, 7, 'Jeżeli udoskonalasz coś dostatecznie długo – na pewno to zepsujesz', '2017-02-19'),
(26, 7, 'Dar przepowiadania dany jest wszystkim tym, którzy nie wiedzą, co czeka ich samych', '2017-02-15'),
(27, 1, 'Przez długą część młodego życia było we mnie bardzo dużo gniewu i agresji, których nie byłam w stanie powściągnąć. Oczywiście teraz tego już', '2017-04-01'),
(28, 7, 'nowy Tweet józia', '2017-04-28'),
(29, 7, 'nowy tweet józefa', '2017-05-05'),
(30, 7, 'nowy tweet józefa raz jeszcze', '2017-05-05'),
(31, 13, 'pierwszy tweet cyrana', '2017-05-05'),
(32, 13, 'kto to pisze?', '2017-05-05'),
(33, 13, 'a to?', '2017-05-05'),
(34, 7, 'piszemy', '2017-05-05'),
(35, 14, 'gendo pisze...?', '2017-05-05'),
(36, 14, 'olga pisze?', '2017-05-05'),
(37, 7, 'jestem józiem', '2017-05-05'),
(38, 7, 'jestem józiem razy dwa', '2017-05-05'),
(39, 7, 'dupa', '2017-05-05'),
(40, 14, 'jestem teraz gendem znowu', '2017-05-05'),
(41, 14, 'gendzior', '2017-05-05'),
(42, 14, 'jasna cholera', '2017-05-05'),
(43, 14, 'jestem nowy', '2017-05-05'),
(44, 7, 'jestem jozefem', '2017-05-05'),
(45, 7, 'jozef jest geofizykiem', '2017-05-05'),
(46, 16, 'jestem nowy', '2017-05-05'),
(47, 16, 'jestem nowszy', '2017-05-05'),
(48, 16, 'jeszcze nowszy', '2017-05-05'),
(49, 16, 'nowszy do jasnej cholery!', '2017-05-05'),
(50, 16, 'najnowszy', '2017-05-05'),
(51, 13, 'zarejestrowalem sie jako cyrano', '2017-05-05'),
(52, 13, 'chyba cyrano dziala', '2017-05-05'),
(53, 17, 'nowszy pisze', '2017-05-05'),
(54, 17, 'ciul zarejestrowany', '2017-05-05'),
(55, 17, 'ciula nie ma', '2017-05-05'),
(57, 16, 'ciekawe kto to', '2017-05-05'),
(58, 16, 'nowy jest nowy bo jest nowy', '2017-05-05'),
(59, 16, 'dziunia?', '2017-05-05'),
(60, 16, 'kto to', '2017-05-05'),
(61, 16, 'jestem znowu nowy', '2017-05-05'),
(62, 37, 'bbb', '2017-05-05'),
(63, 15, 'olga pisze tweeta', '2017-05-06'),
(64, 11, 'mama komentuje', '2017-05-07'),
(65, 9, 'magda pisze tweeta', '2017-05-07'),
(66, 9, 'raz jeszcze magda pisze', '2017-05-07'),
(67, 9, 'kolejny wpis madzi', '2017-05-07'),
(68, 9, 'a kuku mówi magda', '2017-05-07'),
(69, 9, 'a kuku kuku od madzi', '2017-05-07');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `hash_pass` varchar(60) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `hash_pass`) VALUES
(1, 'jerzy@interia.pl', 'jerzy', '$2y$10$FJg0ShzKFOm3Tm3kHECtS.Pcdn6s6ENXeD0nuOE0aGPXhEG9/ldg.'),
(2, 'monika.nowak@gmail.com', 'monika', '$2y$10$shArfXP/8Me1eR9e7Qcd8ezZHgUpwEan.xYwAi9x6RX6NRWjsKPsu'),
(3, 'ada@upcpoczta.pl', 'ada', '$2y$10$F4zVrdfzf15WcMdC4awTNumKssjawjWlSkxwEtv8fYZxXVkiQDcZW'),
(5, 'andrzej@interia.pl', 'andrzej', '$2y$10$y09XRYa9W67F.l5ioBrfz.zztMK9QFg1EqDa667oU8BFwCuGS4gfS'),
(6, 'ania@wp.pl', 'ania', '$2y$10$mOMy0zdetWQyYvP6zAIrxuubcZNmdd0O0M9hrsuCQJ/R98fyu.6.K'),
(7, 'józio@geofizyka.com.pl', 'józio', '$2y$10$q..cfMqmKHh1lt03xbN/7.6eVBKkXtw1rXWdSkBPWD8oJ0qNkHz66'),
(8, 'janek@interia.com', 'janek', '$2y$10$PCgU3FC4UALBWP.zjQQZdOMYzMB.oA5Zzc8eCd0wxotLWXJkaXTuq'),
(9, 'magda@wawel.com', 'magdalena', '$2y$10$pzVNYJI/8G2S4CDJyN1Ztu/VmwyM8BITyN45BBK9T6IQ3lPd90NNK'),
(10, 'wandeczka@wp.pl', 'wandeczka', '$2y$10$mcF3J1qsOziwIdFFKD9o1.JgwR/7WEPCLr.uIwvNFwNIjP.1UT4di'),
(11, 'mama@interia.pl', 'mama', '$2y$10$5ISzMZfkE9m4IR6rV.KFpeqRZb6M/UIPZj7ZwvJjyOTce/.q9yyz.'),
(12, 'adam@baklab.pl', 'adam', '$2y$10$D5IKH8tu8YYcDl/ibSEnme9TQ9QFCmz0EsuokxRYJeXHfi5uttnzO'),
(13, 'cyrano@cyrano.pl', 'cyrano', '$2y$10$od.6OjC2rB0Qg44eooHs4OWvnjr6S6dXeIBlc.RIlOS8euaiaKM12'),
(14, 'gendo@gendo.pl', 'gendo', '$2y$10$q2ZgX/GLsVUlc2m8MrR4E.OhxQDRXn0LlINh27F9uwluetIa1wEmS'),
(15, 'olga@olga.pl', 'olga', '$2y$10$Bygz.le0weLTGf4HjVl1Lun6/2uoxtDcadHJiakpnOp4wmFki7kpy'),
(16, 'nowy@pl', 'nowy', '$2y$10$mCq7VCHRvpNmCyfaJJPrxOQcSoQI4dHJ.DTx0nKeNq8bO4AQzutM2'),
(17, 'nowszy@pl', 'nowszy', '$2y$10$ZEE4ndk.QhjQzBgldG.sMe9I7MtWUtqQ73MS.ESTJLRKspOffbhWW'),
(18, 'ciul@pl', 'ciul', '$2y$10$3COMwe5wlJNc0lrDtt6HM..5SprGG8/4tHqaMf4ssOOtBBpdtleYe'),
(19, 'kurew@pl', 'kurew', '$2y$10$V0JUy1WsOhZsB54VQVpOIemeXldeUQP7qb8f1.lABaspxr9jTjLGm'),
(20, 'jestem@pl', 'jestem', '$2y$10$ReG9p9PdcdK58oMuA0tJBeM/vYxXgZTUXFIIh/IX64w.cRlE7yBjq'),
(21, 'szlag', 'szlag', '$2y$10$Q2wgZh0me83X2xeiphZU/.tT7hm2oUg6TNxCNyYf9bvOqOcHbrsgq'),
(22, 'szlag1', 'szlag1', '$2y$10$CMaP9NUfYJLRwE2rFPxUeuQdgdntPE0zLYOi.wIkDtED/9Bx5DN96'),
(23, 'szlag11', 'szlag11', '$2y$10$CcC5GlDAiZ.Na8rMg.oeaeJTwoSxUcudcDx78jCZHB30sUiTqwjqa'),
(24, 'szlag111', 'szlag111', '$2y$10$EYLlX4ejUMXdGbyvoubnYeHDZ.vtPMUio5IumjBcr.zOM.vrpNkKe'),
(25, 'szlag1111', 'szlag1111', '$2y$10$BpkVqf2A1KC4OIObgR/ovuNQMNICIlTSN/CFEnWNQ56fbLbY.zFuu'),
(26, 'ktos', 'ktos', '$2y$10$q6/yi/MGBNtrhJxWSiWxT.u.ZbYi717aIOJDw2lFhDQ91SKifm59i'),
(27, 'nie', 'nie', '$2y$10$DGWqeKqyOfEAxp9AIHisbu8PXL8cbpRNctP.NYpb.mhf0MeK50hFy'),
(28, 'nie1', 'nie1', '$2y$10$mw21iRwHinbHjPt.XinrJuVrslJy4J2fiIvn27Ww3pjY/8z1JO98K'),
(29, 'nie11', 'nie11', '$2y$10$GSxI5GD6CcFZPNWm7syhu.o/szqLZO8w43BAr5YtYlnQvt5AMSWIO'),
(30, 'nie111', 'nie111', '$2y$10$9qMtQFRW.r9p95/ALV6sOOnrrAr1tH/V16PAvoWHo/tsJJUm6.Ine'),
(31, 'nie1111', 'nie1111', '$2y$10$29PIb0s4wr0fWmv7/gyIQeFK/E9FPZO34j5xJb0HMrOY6FXu.C/lW'),
(32, 'tak', 'tak', '$2y$10$jFzbvETVssIfhvQAHarMbuRlxYtrHatm8MAdht3NgY1CEuIhz7DxW'),
(33, 'tak1', 'tak1', '$2y$10$TuFpWdAnXzmuTdkiQ9bWYecyJsn1fnIqH/UwaI8AYhZ.EJJiu6RF6'),
(34, 'dziunia', 'dziunia', '$2y$10$KINqOUuD5Q3G6Bl33WsZ6uA1yJJ7u96PWZBE1XjIOQ8iD.C8zocQe'),
(35, 'ala', 'ala', '$2y$10$Z9oFYLfJ/anhJlUz/KU5V.XhLRl2QFx3icuE40rylL8f/XXQUdPx.'),
(36, 'bbb', 'bbb', '$2y$10$7UQXaO7YDCAEG8uzbIc5YOq9o8nHMd73eOK4j/3/kKy16uGb1xMiq'),
(37, 'bbbb', 'bbbb', '$2y$10$7U52.yHqcXfG7aPp/GZi3Oj5KDZB268CuqmVWR6mGH3B9qSWyCiO6');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `tweetId` (`tweetId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`authorId`),
  ADD KEY `receiver` (`receiverId`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT dla tabeli `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`tweetId`) REFERENCES `tweets` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
