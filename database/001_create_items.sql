CREATE DATABASE IF NOT EXISTS CCE_PHPMySQL2;

# 
# Create the items table
#
CREATE TABLE `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `price` float DEFAULT NULL,
  `datetimeAdded` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;