# 
# Create the Categories table
#
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `image` varchar(255) NOT NULL DEFAULT '',
  `dateTimeAdded` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Insert some values to the categories table
#

INSERT INTO `categories` (`id`, `name`, `description`, `dateTimeAdded`, `image`)
VALUES
	(1,'Books','Books and Readings','2017-11-22 04:38:49','1489798288.png'),
	(2,'Audios','CDs and Audio recordings','2017-11-22 04:38:49','9181761519.png'),
	(3,'Toys & Games','Toys and Games','2017-11-22 04:38:49','1918721089.png'),
	(4,'Video Games','Video Games','2017-11-22 04:38:49','1713620010.png');