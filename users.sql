/*
 Navicat Premium Data Transfer

 Source Server         : LocalAppache
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : koprasibaru

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 05/06/2017 18:46:57 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_grp` int(11) DEFAULT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  KEY `id_level` (`id_level`),
  KEY `user_grp` (`user_grp`),
  CONSTRAINT `user_group_menu` FOREIGN KEY (`user_grp`) REFERENCES `menu_group` (`user_grp`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `user_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('9', '1', 'admin', 'admin@admin.com', '$2y$10$PmcUVEJRgmmIEBQxKL/pzeHMsmjLZYEnUxvjFk5oosm1yskMtohVi', '1', '7Pp3tAZOq7L7T6poB5OTtf8ZCnqqBc5WHr7xbRRlkqIwA1IP3nf0BfPPqOcL'), ('15', '2', 'Rifky', 'rifky.rachman@gmail.com', '$2y$10$yG6TzyHZpkaNWQVT6uuAtuxHaNt.BeYZAzS.jXNIE9k1FepOtw1oC', '1', 'BSOwGb2cbIcN4qPSgW9zLAXgstHPu08wpQdjRjSqG9zMQZGN6odtiPytab7z'), ('16', '3', 'akbar', 'akbar@gmail.com', '$2y$10$GDyKw0F.GFOfA7LX.L0O8e9KJ3hegeSE14guuFmh1/.lqolaJ1PTW', '1', 'xuoS5Ipqwqa8DRVCJ835vXrUTFNklLfpJUE7rFbuz6gEfp3Mv0SaFXf4m1I5'), ('26', '5', 'Rifky000', '', '$2y$10$9mYNEXKrW4Pt.SkizYO6Tu9mlrod0ogK/ClBnTRgkY85AWvyptIle', '4', null), ('27', '5', 'Rifky111', '', '$2y$10$ohKiMvPf5tVX.c/275YpSOEvCj..SJVQi0bc4fIDyFZ0ymaw5yJ8.', '4', null), ('28', '5', 'Rifky222', '', '$2y$10$ahPaJvALdLElOypkiMel8ONl55tNvU6ID0nkH3z2lUaNrgPq0tgFG', '4', null), ('29', '5', 'asdfasfda234', '', '$2y$10$BbFzgeZ62X0EQiTFc6qT/OxvQrDYnObFzWfxVIzHgUD/mC6CBQAq.', '4', 'gIqLz8Anep6HtHhPv33owfZALZTLPmAtKqmPuQ8Jy8exgsqPcsNR7IfY1mry'), ('30', '5', 'xxx098908090', '', '$2y$10$NLIHlUBjTFIOPcuSvO2HYeQXTwYQervxTQBSbhmQ2uO8k0ghgzIx.', '4', null), ('31', '5', 'rr979', '', '$2y$10$jRdxKi2ZA50QzyMyRHMX/.emVxz2cmsI7uRI58NGME2xZvduQHMHW', '4', null), ('32', '5', 'xxx000', '', '$2y$10$dyED.mEsAf0oL.dFqqg.yuk9TgePZ4o9i9imwTD/KNCblbpoDLPIS', '4', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
