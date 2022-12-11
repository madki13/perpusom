-- Adminer 4.7.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `author` (`id`, `first_name`, `last_name`, `email`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'Arief',	'Siswanto',	'arief@siswanto.com',	NULL,	NULL,	NULL,	NULL),
(3,	'test',	'gan',	'gan@test.com',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin',	'1',	1575602373),
('User',	'2',	1663605410),
('User',	'3',	1661183081),
('User',	'4',	1663602768),
('User',	'5',	1663605774),
('User',	'6',	1663645253),
('User',	'7',	1664249477);

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin',	1,	NULL,	NULL,	NULL,	1661097949,	1661097949),
('guest',	1,	NULL,	NULL,	NULL,	1663602370,	1663602370),
('User',	1,	NULL,	NULL,	NULL,	1661183073,	1661183073);

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin',	'/admin/*'),
('admin',	'/admin/assignment/*'),
('admin',	'/admin/assignment/assign'),
('admin',	'/admin/assignment/index'),
('admin',	'/admin/assignment/revoke'),
('admin',	'/admin/assignment/view'),
('admin',	'/admin/default/*'),
('admin',	'/admin/default/index'),
('admin',	'/admin/menu/*'),
('admin',	'/admin/menu/create'),
('admin',	'/admin/menu/delete'),
('admin',	'/admin/menu/index'),
('admin',	'/admin/menu/update'),
('admin',	'/admin/menu/view'),
('admin',	'/admin/permission/*'),
('admin',	'/admin/permission/assign'),
('admin',	'/admin/permission/create'),
('admin',	'/admin/permission/delete'),
('admin',	'/admin/permission/get-users'),
('admin',	'/admin/permission/index'),
('admin',	'/admin/permission/remove'),
('admin',	'/admin/permission/update'),
('admin',	'/admin/permission/view'),
('admin',	'/admin/role/*'),
('admin',	'/admin/role/assign'),
('admin',	'/admin/role/create'),
('admin',	'/admin/role/delete'),
('admin',	'/admin/role/get-users'),
('admin',	'/admin/role/index'),
('admin',	'/admin/role/remove'),
('admin',	'/admin/role/update'),
('admin',	'/admin/role/view'),
('admin',	'/admin/route/*'),
('admin',	'/admin/route/assign'),
('admin',	'/admin/route/create'),
('admin',	'/admin/route/index'),
('admin',	'/admin/route/refresh'),
('admin',	'/admin/route/remove'),
('admin',	'/admin/rule/*'),
('admin',	'/admin/rule/create'),
('admin',	'/admin/rule/delete'),
('admin',	'/admin/rule/index'),
('admin',	'/admin/rule/update'),
('admin',	'/admin/rule/view'),
('admin',	'/admin/user/*'),
('admin',	'/admin/user/activate'),
('admin',	'/admin/user/change-password'),
('admin',	'/admin/user/delete'),
('admin',	'/admin/user/index'),
('admin',	'/admin/user/login'),
('admin',	'/admin/user/logout'),
('admin',	'/admin/user/request-password-reset'),
('admin',	'/admin/user/reset-password'),
('admin',	'/admin/user/signup'),
('admin',	'/admin/user/view'),
('admin',	'/classroom/*'),
('admin',	'/classroom/create'),
('admin',	'/classroom/delete'),
('admin',	'/classroom/index'),
('admin',	'/classroom/update'),
('admin',	'/classroom/view'),
('admin',	'/debug/*'),
('admin',	'/debug/default/*'),
('admin',	'/debug/default/db-explain'),
('admin',	'/debug/default/download-mail'),
('admin',	'/debug/default/index'),
('admin',	'/debug/default/toolbar'),
('admin',	'/debug/default/view'),
('admin',	'/debug/user/*'),
('admin',	'/debug/user/reset-identity'),
('admin',	'/debug/user/set-identity'),
('admin',	'/gii/*'),
('admin',	'/gii/default/*'),
('admin',	'/gii/default/action'),
('admin',	'/gii/default/diff'),
('admin',	'/gii/default/index'),
('admin',	'/gii/default/preview'),
('admin',	'/gii/default/view'),
('admin',	'/gridview/*'),
('admin',	'/gridview/export/*'),
('admin',	'/gridview/export/download'),
('admin',	'/gridview/grid-edited-row/*'),
('admin',	'/gridview/grid-edited-row/back'),
('admin',	'/question-template/*'),
('admin',	'/question-template/create'),
('admin',	'/question-template/delete'),
('admin',	'/question-template/index'),
('admin',	'/question-template/update'),
('admin',	'/question-template/view'),
('admin',	'/report/*'),
('admin',	'/report/detail'),
('admin',	'/report/export-detail'),
('admin',	'/report/export-training'),
('admin',	'/report/training'),
('admin',	'/site/*'),
('admin',	'/site/about'),
('admin',	'/site/captcha'),
('admin',	'/site/contact'),
('admin',	'/site/error'),
('admin',	'/site/index'),
('admin',	'/site/login'),
('admin',	'/site/logout'),
('admin',	'/trainer/*'),
('admin',	'/trainer/create'),
('admin',	'/trainer/delete'),
('admin',	'/trainer/index'),
('admin',	'/trainer/update'),
('admin',	'/trainer/view'),
('admin',	'/training/*'),
('admin',	'/training/create'),
('admin',	'/training/delete'),
('admin',	'/training/index'),
('admin',	'/training/update'),
('admin',	'/training/view'),
('admin',	'/user/*'),
('admin',	'/user/admin/*'),
('admin',	'/user/admin/assignments'),
('admin',	'/user/admin/block'),
('admin',	'/user/admin/confirm'),
('admin',	'/user/admin/create'),
('admin',	'/user/admin/delete'),
('admin',	'/user/admin/index'),
('admin',	'/user/admin/info'),
('admin',	'/user/admin/resend-password'),
('admin',	'/user/admin/switch'),
('admin',	'/user/admin/update'),
('admin',	'/user/admin/update-profile'),
('admin',	'/user/profile/*'),
('admin',	'/user/profile/index'),
('admin',	'/user/profile/show'),
('admin',	'/user/recovery/*'),
('admin',	'/user/recovery/request'),
('admin',	'/user/recovery/reset'),
('admin',	'/user/registration/*'),
('admin',	'/user/registration/confirm'),
('admin',	'/user/registration/connect'),
('admin',	'/user/registration/register'),
('admin',	'/user/registration/resend'),
('admin',	'/user/security/*'),
('admin',	'/user/security/auth'),
('admin',	'/user/security/login'),
('admin',	'/user/security/logout'),
('admin',	'/user/settings/*'),
('admin',	'/user/settings/account'),
('admin',	'/user/settings/confirm'),
('admin',	'/user/settings/delete'),
('admin',	'/user/settings/disconnect'),
('admin',	'/user/settings/networks'),
('admin',	'/user/settings/profile'),
('guest',	'/admin/user/request-password-reset'),
('guest',	'/admin/user/reset-password'),
('guest',	'/debug/user/reset-identity'),
('guest',	'/site/login'),
('guest',	'/user/login/*'),
('guest',	'/user/recovery/*'),
('guest',	'/user/recovery/request'),
('guest',	'/user/recovery/reset'),
('guest',	'/user/registration/*'),
('guest',	'/user/registration/confirm'),
('guest',	'/user/registration/connect'),
('guest',	'/user/registration/register'),
('guest',	'/user/registration/resend'),
('User',	'/admin/user/login'),
('User',	'/admin/user/logout'),
('User',	'/site/index'),
('User',	'/site/login'),
('User',	'/site/logout'),
('User',	'/submission/*'),
('User',	'/submission/create'),
('User',	'/submission/delete'),
('User',	'/submission/index'),
('User',	'/submission/update'),
('User',	'/submission/view'),
('User',	'/user/security/login'),
('User',	'/user/security/logout'),
('User',	'/user/settings/*'),
('User',	'/user/settings/account'),
('User',	'/user/settings/confirm'),
('User',	'/user/settings/disconnect'),
('User',	'/user/settings/networks'),
('User',	'/user/settings/profile');

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `bibliography`;
CREATE TABLE `bibliography` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `bibliography_category_id` int(11) NOT NULL,
  `shelf_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `edition` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `language` int(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `bibliography_author`;
CREATE TABLE `bibliography_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bibliography_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `bibliography_category`;
CREATE TABLE `bibliography_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bibliography_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `copy`;
CREATE TABLE `copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `bibliography_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `fine`;
CREATE TABLE `fine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `guest_book`;
CREATE TABLE `guest_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` int(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `join_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `gender` int(2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1575530673),
('m140209_132017_init',	1575530677),
('m140403_174025_create_account_table',	1575530679),
('m140504_113157_update_tables',	1575530683),
('m140504_130429_create_token_table',	1575530684),
('m140506_102106_rbac_init',	1575530932),
('m140602_111327_create_menu_table',	1575530975),
('m140830_171933_fix_ip_field',	1575530685),
('m140830_172703_change_account_table_name',	1575530685),
('m141222_110026_update_ip_field',	1575530685),
('m141222_135246_alter_username_length',	1575530686),
('m150614_103145_update_social_account_table',	1575530691),
('m150623_212711_fix_username_notnull',	1575530691),
('m151218_234654_add_timezone_to_profile',	1575530692),
('m160312_050000_create_user',	1575530975),
('m160929_103127_add_last_login_at_to_user_table',	1575530692),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id',	1575530933),
('m180523_151638_rbac_updates_indexes_without_prefix',	1575530934);

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `profile` (`user_id`, `name`, `photo`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1,	'Administrators',	'4983bd8cd9be192b4e26419602aa16f9_1667147214.png',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL),
(2,	'Arief Siswanto',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'Arief Siswanto',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'Rio Ganteng',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(5,	'Rio Ganteng Sekaleh',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(6,	'Rio Ganteng Sekaleh haha',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	'Joko Aja',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `publisher`;
CREATE TABLE `publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `shelf`;
CREATE TABLE `shelf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1,	'C5PQ3LdKfVJ4eZJj4NJKlGKnKsOYXr0h',	1575532706,	0),
(1,	'F2Gk-yvk6AMFG-UWN1EzKABP-fZ0fYPb',	1661181974,	1),
(2,	'FQJ2FRtgkfnZXboQ0MMl3IDbKR1ylpYk',	1661182889,	0),
(4,	'pRCv_LYX7MXGWfgY8xMXxeVXv9kbKbUm',	1663602678,	0);

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(2) NOT NULL,
  `return_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `transaction_detail`;
CREATE TABLE `transaction_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `copy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classroom_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `classroom_id`, `name`, `username`, `email`, `password_hash`, `auth_key`, `access_token`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `status`, `last_login_at`) VALUES
(1,	0,	'',	'admin',	'arief7385@yahoo.com',	'$2y$10$pb9IG5/DJpvdgszqDxcnguwvWnnDqrzsxUSRNza71hjLiweW.jodi',	'jJDfbICBB0E-g_bO2BUUR6p2u_Sj9SCC',	'6282dfe026e7e6c552d0b65ee42dec3e0faa11bd',	2019,	NULL,	NULL,	'::1',	1575532706,	1575605017,	0,	0,	1668306917),
(2,	0,	'',	'arief.siswanto',	'arief.siswanto@computesta.com',	'$2y$10$4RbgUj.lAFPD.mDtx9EoW.oYasOV9xxDFpExn2eTtumte/ev.sjx.',	'BDR4DadPBHa5qPtZaho3SqGagbgLWzh6',	NULL,	1663519651,	NULL,	NULL,	'::1',	1661182889,	1661182889,	0,	0,	1663605396),
(3,	0,	'',	'arief.applicanity',	'arief.siswanto@applicanity.com',	'$2y$10$DTVc1jYewx3SMYY/2Uz7c.dJIYlTqj.1TSqQBsxO9RjPMBD7Clu3W',	'xFhJhLrkppMK-N0iazoNF1eckkQQW5GY',	NULL,	1661183082,	NULL,	NULL,	'::1',	1661182986,	1661182986,	0,	0,	1664156320),
(4,	0,	'',	'ridyko_',	'riowidyatmoko@gmail.com',	'$2y$10$OxhsPCrIv/qhQBFgEjag4eRn179k8bdbEhLCmYYRDhc.X0NyrvhKK',	'7ZAD9v2uDJ0K4J0IVgNejdA86NOScdGK',	NULL,	1663602722,	NULL,	NULL,	'180.243.10.3',	1663602678,	1663602678,	0,	0,	1664242339),
(5,	0,	'',	'_Wakwaw_',	'riowidyatmoko1992@gmail.com',	'$2y$10$bwOmknPNXIEWFlg/tyDTU.ons35yjPR.Ids4zpwpYJ7zJhDe0L5hy',	'b4jeGqSWHijZYbRQsAKA5onz71PP47jx',	NULL,	1663605774,	NULL,	NULL,	'180.243.10.3',	1663605746,	1663605746,	0,	0,	NULL),
(6,	0,	'',	'_Anon',	'riowidyatmoko69@gmail.com',	'$2y$10$m1NZw7aLwosa8M/WMBd5yeVoLHSdOmUO/qEcKzRiheXwP3/VE.hka',	'-3Nbb575mQheBxd_MvDzW_cDwLt9a_PY',	NULL,	1663645253,	NULL,	NULL,	'180.252.115.125',	1663645188,	1663645188,	0,	0,	NULL),
(7,	0,	'',	'Joko_',	'questkomputer@gmail.com',	'$2y$10$agNBSRK2ZRbWtu/fsLXbZOmYK3tRmELTXBjXfCHfQ7ClIgjvT4zlu',	'gx0zk3dIgnmfwbvXeVZXgohctpATGlLJ',	NULL,	1664249477,	NULL,	NULL,	'120.188.67.225',	1664249337,	1664249337,	0,	0,	1664249509);

-- 2022-12-11 04:17:40
