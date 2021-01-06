create schema `cartech`;
use `cartech`;
CREATE TABLE `admin_accounts` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `series_id` varchar(60) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `admin_type` enum('super','admin') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

CREATE TABLE `advertising` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_adver` varchar(45) NOT NULL,
  `ad_content` varchar(500) NOT NULL,
  `img_adver` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `phone` char(11) NOT NULL,
  `account_type` enum('Client','Provider') NOT NULL,
  `prof_img` longblob DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  PRIMARY KEY (`chat_message_id`),
  KEY `to_user_id` (`to_user_id`),
  CONSTRAINT `chat_message_ibfk_1` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_name_UNIQUE` (`city_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

CREATE TABLE `coordinates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prov_foreign` (`p_id`),
  CONSTRAINT `prov_foreign` FOREIGN KEY (`p_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `favorite` (
  `user_id` int(6) NOT NULL,
  `favorite_id` int(6) NOT NULL,
  PRIMARY KEY (`user_id`,`favorite_id`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `P_id` int(11) NOT NULL,
  `G_image` longblob NOT NULL,
  `MSG` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `P_id` (`P_id`),
  CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL,
  PRIMARY KEY (`login_details_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `login_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Subject` varchar(45) NOT NULL,
  `Massege` text NOT NULL,
  `date_time` datetime NOT NULL,
  `message_type` enum('new','old') NOT NULL DEFAULT 'new',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ID_img` longblob NOT NULL,
  `comm_img` longblob NOT NULL,
  `prov_state` enum('accept','hold') NOT NULL DEFAULT 'hold',
  PRIMARY KEY (`id`),
  KEY `prov_user` (`user_id`),
  CONSTRAINT `prov_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `region_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_foreign` (`city_id`),
  CONSTRAINT `city_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8;


CREATE TABLE `p_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provider_user` (`p_id`),
  KEY `region_constraint` (`region_id`),
  CONSTRAINT `provider_user` FOREIGN KEY (`p_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `region_constraint` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ser_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `prov_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `ser_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `serv_foreign` (`ser_id`),
  KEY `prov__foreign` (`p_id`),
  CONSTRAINT `prov__foreign` FOREIGN KEY (`p_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `serv_foreign` FOREIGN KEY (`ser_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `sent_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mess_name` varchar(45) NOT NULL,
  `mess_from` varchar(10) NOT NULL,
  `mess_to` varchar(100) NOT NULL,
  `mess_subject` varchar(45) NOT NULL,
  `mess_text` varchar(1000) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;


