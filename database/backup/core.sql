/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : core

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-03-24 16:21:39
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `actions`
-- ----------------------------
DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `actions_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of actions
-- ----------------------------
INSERT INTO actions VALUES ('2', 'Index', 'index', '2016-03-22 08:52:09', '2016-03-22 08:52:09');
INSERT INTO actions VALUES ('3', 'Delete', 'delete', '2016-03-22 08:52:20', '2016-03-22 08:52:20');
INSERT INTO actions VALUES ('4', 'Update', 'update', '2016-03-22 08:52:32', '2016-03-22 08:52:32');
INSERT INTO actions VALUES ('5', 'View', 'view', '2016-03-22 08:52:43', '2016-03-22 08:52:43');
INSERT INTO actions VALUES ('6', 'Create', 'create', '2016-03-22 08:52:49', '2016-03-22 08:52:49');
INSERT INTO actions VALUES ('8', 'Publish UnPublish', 'publish', '2016-03-23 12:43:26', '2016-03-23 12:43:26');

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  KEY `menus_controller_index` (`controller`),
  KEY `menus_slug_index` (`slug`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO menus VALUES ('1', null, 'Dashboard', 'DashboardController', 'dashboard', '1', 'fa-home', null, null);
INSERT INTO menus VALUES ('9', '2', 'Action', 'ActionController', 'action', '2', '', '2016-03-22 07:47:57', '2016-03-22 07:47:57');
INSERT INTO menus VALUES ('10', null, 'User', '#', 'user', '6', 'fa-user', '2016-03-22 09:48:39', '2016-03-22 09:48:39');
INSERT INTO menus VALUES ('11', '10', 'Role', 'RoleController', 'role', '1', '', '2016-03-22 09:49:40', '2016-03-22 09:49:40');
INSERT INTO menus VALUES ('12', '10', 'Manage User', 'UserController', 'manage-user', '3', '', '2016-03-22 12:10:31', '2016-03-22 12:10:31');
INSERT INTO menus VALUES ('13', '10', 'Profile', 'ProfileController', 'profile', '9', '', '2016-03-23 07:49:10', '2016-03-23 07:49:10');
INSERT INTO menus VALUES ('17', NULL, 'Kategori Kerjasama', 'KategoriController', 'kategori-kerjasama', '2', 'fa-clipboard', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menus VALUES ('18', NULL, 'Usulan Kerjasama', 'UsulanController', 'usulan-kerjasama', '3', 'fa-calendar', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menus VALUES ('19', NULL, 'Laporan', 'LaporanController', 'laporan-kerjasama', '4', 'fa-file-excel-o', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menus VALUES ('20', NULL, 'Konten Website', '#', 'konten', '5', '', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO menus VALUES ('21', '20', 'Slideshow', 'SlideshowController', 'slideshow', '1', '', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menus VALUES ('22', '20', 'Page', 'PageController', 'page', '2', '', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menus VALUES ('23', '20', 'Social Media', 'SocialController', 'social', '3', '', '2017-08-19 22:15:14', '2017-08-19 22:15:14');


-- ----------------------------
-- Table structure for `menu_actions`
-- ----------------------------
DROP TABLE IF EXISTS `menu_actions`;
CREATE TABLE `menu_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `action_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_actions_menu_id_foreign` (`menu_id`),
  KEY `menu_actions_action_id_foreign` (`action_id`),
  CONSTRAINT `menu_actions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_actions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu_actions
-- ----------------------------
INSERT INTO menu_actions VALUES ('27', '11', '2', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('28', '11', '3', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('29', '11', '4', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('30', '11', '5', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('31', '11', '6', '2016-03-22 11:15:59', '2016-03-22 11:15:59');
INSERT INTO menu_actions VALUES ('32', '12', '2', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('33', '12', '3', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('34', '12', '4', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('35', '12', '6', '2016-03-22 12:10:49', '2016-03-22 12:10:49');
INSERT INTO menu_actions VALUES ('36', '13', '2', '2016-03-23 07:49:23', '2016-03-23 07:49:23');
INSERT INTO menu_actions VALUES ('47', '17', '2', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('48', '17', '6', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('49', '17', '4', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('50', '17', '3', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('51', '18', '2', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('52', '18', '6', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('53', '18', '4', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('54', '18', '3', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('55', '19', '2', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('56', '19', '6', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('57', '19', '4', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO menu_actions VALUES ('58', '19', '3', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO menu_actions VALUES ('59', '20', '2', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO menu_actions VALUES ('60', '20', '6', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO menu_actions VALUES ('61', '20', '4', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO menu_actions VALUES ('62', '20', '3', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO menu_actions VALUES ('63', '21', '2', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('64', '21', '6', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('65', '21', '4', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('66', '21', '3', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('67', '22', '2', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('68', '22', '6', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('69', '22', '4', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('70', '22', '3', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO menu_actions VALUES ('71', '23', '2', '2017-08-19 22:15:15', '2017-08-19 22:15:15');
INSERT INTO menu_actions VALUES ('72', '23', '6', '2017-08-19 22:15:15', '2017-08-19 22:15:15');
INSERT INTO menu_actions VALUES ('73', '23', '4', '2017-08-19 22:15:15', '2017-08-19 22:15:15');
INSERT INTO menu_actions VALUES ('74', '23', '3', '2017-08-19 22:15:15', '2017-08-19 22:15:15');



-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `rights`
-- ----------------------------
DROP TABLE IF EXISTS `rights`;
CREATE TABLE `rights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `menu_action_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rights_menu_action_id_foreign` (`menu_action_id`),
  KEY `rights_role_id_foreign` (`role_id`),
  CONSTRAINT `rights_menu_action_id_foreign` FOREIGN KEY (`menu_action_id`) REFERENCES `menu_actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rights_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rights
-- ----------------------------
INSERT INTO rights VALUES ('270', '1', '27', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('271', '1', '28', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('272', '1', '29', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('273', '1', '30', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('274', '1', '31', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('275', '1', '32', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('276', '1', '33', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('277', '1', '34', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('278', '1', '35', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('279', '1', '36', '2016-03-23 12:46:53', '2016-03-23 12:46:53');
INSERT INTO rights VALUES ('295', '1', '47', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('296', '1', '48', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('297', '1', '49', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('298', '1', '50', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('299', '1', '51', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('300', '1', '52', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('301', '1', '53', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('302', '1', '54', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('303', '1', '55', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('304', '1', '56', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('305', '1', '57', '2017-08-19 20:46:15', '2017-08-19 20:46:15');
INSERT INTO rights VALUES ('306', '1', '58', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO rights VALUES ('307', '1', '59', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO rights VALUES ('308', '1', '60', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO rights VALUES ('309', '1', '61', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO rights VALUES ('310', '1', '62', '2017-08-19 20:46:16', '2017-08-19 20:46:16');
INSERT INTO rights VALUES ('311', '1', '63', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('312', '1', '64', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('313', '1', '65', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('314', '1', '66', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('315', '1', '67', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('316', '1', '68', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('317', '1', '69', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('318', '1', '70', '2017-08-19 22:10:24', '2017-08-19 22:10:24');
INSERT INTO rights VALUES ('319', '1', '71', '2017-08-19 22:15:15', '2017-08-19 22:15:15');
INSERT INTO rights VALUES ('320', '1', '72', '2017-08-19 22:15:15', '2017-08-19 22:15:15');
INSERT INTO rights VALUES ('321', '1', '73', '2017-08-19 22:15:15', '2017-08-19 22:15:15');
INSERT INTO rights VALUES ('322', '1', '74', '2017-08-19 22:15:15', '2017-08-19 22:15:15');


-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO roles VALUES ('1', 'Superadmin', null, null);
INSERT INTO roles VALUES ('4', 'admin', '2016-03-22 12:52:56', '2016-03-22 12:52:56');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `gender` enum('pria','wanita') COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_username_index` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('6', 'TRINATA', 'superadmin@gmail.com', '$2y$10$.Hu3gSD6sdEtvqX7uN7w7eJXo6e.SFZwvppK.8RtdlqjIQ1f2bwGy', 'AclreK3rt4UOpBPwP8j9DPnW6abfPL5OpqsOj9JOA0G475QqTtjYIUIUVX2T', '2016-03-22 13:07:29', '2016-03-24 16:16:08', '1', 'pria', '', '0', 'superadmin');
INSERT INTO users VALUES ('7', 'admin', 'ultramantigar@gmail.com', '$2y$10$gPafGNqLHVtVtPgO7/KqjeqGwLhBr/ZSe1G3YnZWp80Yo8GcpdYRG', 'AsrSmU1PESaINwJGI1pH1KQgrYetdGz0QyQO5y02Ix0rfOGVIIOvh1ugrwgD', '2016-03-22 13:08:00', '2016-03-23 09:51:11', '4', 'pria', '', '0', 'admin');

-- ----------------------------
-- Table structure for `user_activities`
-- ----------------------------
DROP TABLE IF EXISTS `user_activities`;
CREATE TABLE `user_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `action` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_activities_user_id_foreign` (`user_id`),
  CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_activities
-- ----------------------------
