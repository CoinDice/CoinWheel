SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+01:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admins` (`id`, `username`, `passwd`) VALUES
(6,	'admin',	'21232f297a57a5a743894a0e4a801fc3');

DROP TABLE IF EXISTS `deposits`;
CREATE TABLE `deposits` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `player_id` int(255) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `received` int(1) NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `confirmations` int(255) NOT NULL DEFAULT '0',
  `time_generated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `hash` text COLLATE utf8_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `alias` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `banned` int(1) NOT NULL DEFAULT '0',
  `t_spins` int(255) NOT NULL DEFAULT '0',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_last_active` datetime NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `lastip` text COLLATE utf8_unicode_ci NOT NULL,
  `server_seed` text COLLATE utf8_unicode_ci NOT NULL,
  `client_seed` text COLLATE utf8_unicode_ci NOT NULL,
  `old_client_seed` text COLLATE utf8_unicode_ci NOT NULL,
  `old_server_seed` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `spins`;
CREATE TABLE `spins` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `wager` double NOT NULL,
  `multiplier` double NOT NULL,
  `player` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `system`;
CREATE TABLE `system` (
  `id` int(1) NOT NULL DEFAULT '1',
  `autoalias_increment` int(255) NOT NULL DEFAULT '1',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `currency` text COLLATE utf8_unicode_ci NOT NULL,
  `currency_sign` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `system` (`id`, `autoalias_increment`, `title`, `url`, `currency`, `currency_sign`, `description`) VALUES
(1,	1,	'Default',	'Default',	'Default',	'Default',	'Default');
