-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Mei 2016 pada 19.59
-- Versi Server: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hero`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `skillsatu` varchar(500) NOT NULL,
  `skilldua` varchar(500) NOT NULL,
  `skilltiga` varchar(500) NOT NULL,
  `skillempat` varchar(500) DEFAULT NULL,
  `skilllima` varchar(500) DEFAULT NULL,
  `skillenam` varchar(500) NOT NULL,
  `tipe` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `skill`
--

INSERT INTO `skill` (`id`, `nama`, `skillsatu`, `skilldua`, `skilltiga`, `skillempat`, `skilllima`, `skillenam`, `tipe`) VALUES
(1, 'SVEN', 'Storm Hammer\r\n\r\nSven unleashes his magical gauntlet that deals damage and stuns enemy units.\r\nCast Animation: 0.3+0\r\nCast Range: 600\r\nEffect Radius: 255\r\nDamage: 100/175/250/325\r\nStun Duration: 2', 'Great Cleave\r\n\r\nSven strikes with great force, cleaving all nearby enemy units with his attack.\r\nCleave Radius: 300\r\nCleave Damage: 30%/42%/54%/66%', 'Warcry\r\n\r\nSvens Warcry heartens his allies for battle, increasing their movement speed and armor. Lasts 8 seconds.\r\nCast Animation: 0+0\r\nEffect Radius: 900\r\nMove Speed Bonus: 12%\r\nArmor Bonus: 5/10/15/20\r\nBuff Duration: 8', '', '', 'Gods Strength\r\n\r\nSven channels his rogue strength, granting bonus damage for 25 seconds.\r\nCast Animation: 0.3+0\r\nSelf Damage Bonus: 100%/150%/200%\r\nAllies Bonus Radius: 0 (Can be Improved by Aghanims Scepter. 900)\r\nAllies Attack Damage Bonus: 0 (Can be Improved by Aghanims Scepter. 75%/100%/125%)\r\nBuff Duration: 25', 1),
(2, 'TINY', 'Avalanche\r\n\r\nBombards an area with rocks, stunning and damaging enemy land units.\r\nCast Animation: 0+0.53\r\nCast Range: 600\r\nEffect Radius: 275\r\nTotal Damage: 100/180/260/300\r\nStun Duration: 1', 'Toss\r\n\r\nGrabs the nearest unit in a 275 radius around Tiny, ally or enemy, and launches it at the target unit or rune to deal damage where they land. If the tossed unit is an enemy, it will take an extra 20% damage. Toss does more damage with each level in Grow.\r\nCast Animation: 0+0.53\r\nCast Range: 1300\r\nGrab Radius: 275\r\nDamage Radius: 275\r\nDamage: 75/150/225/300\r\nToss Duration: 1.3', 'Craggy Exterior\r\n\r\nCauses damage to bounce back on Tinys attackers. Enemies that attack Tiny from within 300 units have a chance of being stunned.\r\nMaximum Radius: 300\r\nProc Chance: 10%/15%/20%/25%\r\nDamage: 25/35/45/55\r\nArmor Bonus: 2/3/4/5\r\nStun Duration: 1/1.25/1.5/1.75', '', '', 'Grow\r\n\r\nTiny gains craggy mass that increases his power at the cost of his attack speed. Increases Tossed unit damage and improves movement speed.\r\nAttack Damage Bonus: 50/100/150\r\nAttack Speed Loss: 20/35/50\r\nMove Speed Bonus: 40/50/60\r\nTossed Unit Bonus Damage: 35%/50%/65% (Can be Improved by Aghanims Scepter. 50%/65%/80%)\r\nAttack Range Bonus: 0 (Can be Improved by Aghanims Scepter. 85)\r\nCleave Radius: 0 (Can be Improved by Aghanims Scepter. 400)\r\nCleave Damage: 0 (Can be Improved by Aghanims ', 1),
(3, 'MAGNUS', '', '', '', NULL, NULL, '', 1),
(4, 'KUNKKA', '', '', '', NULL, NULL, '', 1),
(5, 'BEASTMASTER', '', '', '', NULL, NULL, '', 1),
(6, 'DRAGON KNIGHT', '', '', '', NULL, NULL, '', 1),
(7, 'CLOCKWERK', '', '', '', NULL, NULL, '', 1),
(8, 'OMNIKNIGHT', '', '', '', NULL, NULL, '', 1),
(9, 'HUSKAR', '', '', '', NULL, NULL, '', 1),
(10, 'ALCHEMIST', '', '', '', NULL, NULL, '', 1),
(11, 'BREWMASTER', '', '', '', NULL, NULL, '', 1),
(12, 'TREANT PROTECTOR', '', '', '', NULL, NULL, '', 1),
(13, 'IO', '', '', '', NULL, NULL, '', 1),
(14, 'CENTAUR WARRUNNER', '', '', '', NULL, NULL, '', 1),
(15, 'TIMBERSAW', '', '', '', NULL, NULL, '', 1),
(16, 'BRISTLEBACK', '', '', '', NULL, NULL, '', 1),
(17, 'TUSK', '', '', '', NULL, NULL, '', 1),
(18, 'ELDER TITAN', '', '', '', NULL, NULL, '', 1),
(19, 'LEGION COMMANDER', '', '', '', NULL, NULL, '', 1),
(20, 'EARTH SPIRIT', '', '', '', NULL, NULL, '', 1),
(21, 'PHOENIX', '', '', '', NULL, NULL, '', 1),
(22, 'AXE', '', '', '', NULL, NULL, '', 1),
(23, 'PUDGE', '', '', '', NULL, NULL, '', 1),
(24, 'SAND KING', '', '', '', NULL, NULL, '', 1),
(25, 'SLARDAR', '', '', '', NULL, NULL, '', 1),
(26, 'TIDEHUNTER', '', '', '', NULL, NULL, '', 1),
(27, 'WRAITH KING', '', '', '', NULL, NULL, '', 1),
(28, 'LIFESTEALER', '', '', '', NULL, NULL, '', 1),
(29, 'NIGHT STALKER', '', '', '', NULL, NULL, '', 1),
(30, 'DOOM', '', '', '', NULL, NULL, '', 1),
(31, 'SPIRIT BREAKER', '', '', '', NULL, NULL, '', 1),
(32, 'CHAOS KNIGHT', '', '', '', NULL, NULL, '', 1),
(33, 'UNDYING', '', '', '', NULL, NULL, '', 1),
(34, 'ABADDON', '', '', '', NULL, NULL, '', 1),
(35, 'ANTI-MAGE', '', '', '', NULL, NULL, '', 2),
(36, 'DROW RANGER', '', '', '', NULL, NULL, '', 2),
(37, 'JUGGERNAUT', '', '', '', NULL, NULL, '', 2),
(38, 'MIRANA', '', '', '', NULL, NULL, '', 2),
(39, 'MORPHLING', '', '', '', NULL, NULL, '', 2),
(40, 'PHANTOM LANCER', '', '', '', NULL, NULL, '', 2),
(41, 'VENGEFUL SPIRIT', '', '', '', NULL, NULL, '', 2),
(42, 'RIKI', '', '', '', NULL, NULL, '', 2),
(43, 'SNIPER', '', '', '', NULL, NULL, '', 2),
(44, 'TEMPLAR ASSASSIN', '', '', '', NULL, NULL, '', 2),
(45, 'LUNA', '', '', '', NULL, NULL, '', 2),
(46, 'BOUNTY HUNTER', '', '', '', NULL, NULL, '', 2),
(47, 'URSA', '', '', '', NULL, NULL, '', 2),
(48, 'GYROCOPTER', '', '', '', NULL, NULL, '', 2),
(49, 'LONE DRUID', '', '', '', NULL, NULL, '', 2),
(50, 'NAGA SIREN', '', '', '', NULL, NULL, '', 2),
(51, 'TROLL WARLORD', '', '', '', NULL, NULL, '', 2),
(52, 'EMBER SPIRIT', '', '', '', NULL, NULL, '', 2),
(53, 'BLOODSEEKER', '', '', '', NULL, NULL, '', 2),
(54, 'SHADOW FIEND', '', '', '', NULL, NULL, '', 2),
(55, 'RAZOR', '', '', '', NULL, NULL, '', 2),
(56, 'VENOMANCER', '', '', '', NULL, NULL, '', 2),
(57, 'FACELESS VOID', '', '', '', NULL, NULL, '', 2),
(58, 'PHANTOM ASSASSIN', '', '', '', NULL, NULL, '', 2),
(59, 'VIPER', '', '', '', NULL, NULL, '', 2),
(60, 'CLINKZ', '', '', '', NULL, NULL, '', 2),
(61, 'BROODMOTHER', '', '', '', NULL, NULL, '', 2),
(62, 'WEAVER', '', '', '', NULL, NULL, '', 2),
(63, 'SPECTRE', '', '', '', NULL, NULL, '', 2),
(64, 'MEEPO', '', '', '', NULL, NULL, '', 2),
(65, 'NYX ASSASSIN', '', '', '', NULL, NULL, '', 2),
(66, 'SLARK', '', '', '', NULL, NULL, '', 2),
(67, 'MEDUSA', '', '', '', NULL, NULL, '', 2),
(68, 'TERRORBLADE', '', '', '', NULL, NULL, '', 2),
(69, 'ARC WARDEN', '', '', '', NULL, NULL, '', 2),
(70, 'LYCAN', '', '', '', NULL, NULL, '', 1),
(71, 'EARTHSHAKER', '', '', '', NULL, NULL, '', 1),
(72, 'CRYSTAL MAIDEN', '', '', '', NULL, NULL, '', 3),
(73, 'PUCK', '', '', '', NULL, NULL, '', 3),
(74, 'WINDRANGER', '', '', '', NULL, NULL, '', 3),
(75, 'ZEUS', '', '', '', NULL, NULL, '', 3),
(76, 'LINA', '', '', '', NULL, NULL, '', 3),
(77, 'SHADOW SHAMAN', '', '', '', NULL, NULL, '', 3),
(78, 'TINKER', '', '', '', NULL, NULL, '', 3),
(79, 'NATURES PROPHET', '', '', '', NULL, NULL, '', 3),
(80, 'ENCHANTRESS', '', '', '', NULL, NULL, '', 3),
(81, 'JAKIRO', '', '', '', NULL, NULL, '', 3),
(82, 'CHEN', '', '', '', NULL, NULL, '', 3),
(83, 'SILENCER', '', '', '', NULL, NULL, '', 3),
(84, 'OGRE MAGI', '', '', '', NULL, NULL, '', 3),
(85, 'RUBICK', '', '', '', NULL, NULL, '', 3),
(86, 'DISRUPTOR', '', '', '', NULL, NULL, '', 3),
(87, 'KEEPER OF THE LIGHT', '', '', '', NULL, NULL, '', 3),
(88, 'SKYWRATH MAGE', '', '', '', NULL, NULL, '', 3),
(89, 'ORACLE', '', '', '', NULL, NULL, '', 3),
(90, 'TECHIES', '', '', '', NULL, NULL, '', 3),
(91, 'BANE', '', '', '', NULL, NULL, '', 3),
(92, 'LICH', '', '', '', NULL, NULL, '', 3),
(93, 'LION', '', '', '', NULL, NULL, '', 3),
(94, 'WITCH DOCTOR', '', '', '', NULL, NULL, '', 3),
(95, 'ENIGMA', '', '', '', NULL, NULL, '', 3),
(96, 'NECROPHOS', '', '', '', NULL, NULL, '', 3),
(97, 'WARLOCK', '', '', '', NULL, NULL, '', 3),
(98, 'QUEEN OF PAIN', '', '', '', NULL, NULL, '', 3),
(99, 'DEATH PROPHET', '', '', '', NULL, NULL, '', 3),
(100, 'PUGNA', '', '', '', NULL, NULL, '', 3),
(101, 'DAZZLE', '', '', '', NULL, NULL, '', 3),
(102, 'LESHRAC', '', '', '', NULL, NULL, '', 3),
(103, 'DARK SEER', '', '', '', NULL, NULL, '', 3),
(104, 'BATRIDER', '', '', '', NULL, NULL, '', 3),
(105, 'ANCIENT APPARITION', '', '', '', NULL, NULL, '', 3),
(106, 'INVOKER', '', '', '', NULL, NULL, '', 3),
(107, 'OUTWORLD DEVOURER', '', '', '', NULL, NULL, '', 3),
(108, 'SHADOW DEMON', '', '', '', NULL, NULL, '', 3),
(109, 'VISAGE', '', '', '', NULL, NULL, '', 3),
(110, 'WINTER WYVERN', '', '', '', NULL, NULL, '', 3),
(111, 'STORM SPIRIT', '', '', '', NULL, NULL, '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
