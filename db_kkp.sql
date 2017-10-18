# Host: localhost  (Version 5.5.5-10.1.21-MariaDB)
# Date: 2017-09-22 19:31:22
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "file"
#

DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `file_name_source` varchar(255) DEFAULT NULL,
  `file_name_finish` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `tgl_upload` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "file"
#


#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "users"
#

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','Administrator','Project Manager','2017-04-28 15:48:55','2017-07-14 16:08:10','1'),('sidang','74e7caf98c6df498fb9a242884317da5','sidang','penguji','2017-07-10 11:31:24','2017-07-10 11:41:23','2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
