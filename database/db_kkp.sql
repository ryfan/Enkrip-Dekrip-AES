# Host: localhost  (Version 5.5.5-10.1.19-MariaDB)
# Date: 2017-04-28 17:31:23
# Generator: MySQL-Front 6.0  (Build 1.110)


#
# Structure for table "file"
#

DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `file_source` varchar(255) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `tgl_upload` date DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `jumlah_dekripsi` varchar(255) DEFAULT NULL,
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
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "users"
#

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('ryfan','79e779bb0f878043e7c396229df8d5f1','Ryfan Aditya','Project Manager','2017-04-28 15:48:55','2017-04-28 17:30:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
