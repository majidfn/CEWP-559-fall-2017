# 
# Create the Categories table
#
CREATE TABLE `categories` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Description` text,
  `DateTimeAdded` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Insert some values to the categories table
#
INSERT INTO `categories` (`ID`, `Name`, `Description`) VALUES (1, 'Books','Books and Readings');
INSERT INTO `categories` (`ID`, `Name`, `Description`) VALUES (2, 'Audios','CDs and Audio recordings');
