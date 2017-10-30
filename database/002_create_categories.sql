# 
# Create the Categories table
#
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `dateTimeAdded` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Insert some values to the categories table
#
INSERT INTO `categories` (`id`, `name`, `description`) VALUES (1, 'Books','Books and Readings');
INSERT INTO `categories` (`id`, `name`, `description`) VALUES (2, 'Audios','CDs and Audio recordings');
