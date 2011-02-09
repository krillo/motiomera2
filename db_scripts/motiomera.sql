DROP TABLE IF EXISTS `users`;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `email_confirmed` int(1) NOT NULL,
  `password` varchar(120) COLLATE utf8_swedish_ci NOT NULL,
  `f_name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `l_name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `nick` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `sex` enum('man','kvinna') COLLATE utf8_swedish_ci NOT NULL,
  `born` date DEFAULT NULL,
  `descr` text COLLATE utf8_swedish_ci,
  `last_login` datetime DEFAULT NULL,
  `img_filename` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `avatar_filename` varchar(128) COLLATE utf8_swedish_ci DEFAULT NULL,
  `session_id` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `customer_id` int(11) unsigned DEFAULT NULL,
  `paid_until` date DEFAULT NULL,
  `trophy_start` date DEFAULT NULL,
  `browser` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `ip` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mAffCode` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `company_key_temp` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22957 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;


INSERT INTO `m2`.`users` (`email`, `email_confirmed`, `password`, `f_name`, `l_name`, `nick`, `sex`, `born`, `descr`, `last_login`, `paid_until`, `trophy_start`, `mAffCode`, `created_at`, `updated_at`) VALUES ('krillo@erendi.se', '1', 'kapten', 'krillo', 'dillo', 'krillo', 'male', '1967', 'cool cat', '2011-02-03', '2012-02-03', '2011-02-03', 'måbra', '2011-02-03 14:54:58', '2011-02-03 14:54:58');
