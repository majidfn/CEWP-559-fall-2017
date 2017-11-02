CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `createdDateTime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLoginDateTime` DATETIME NULL,
  `isAdmin` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));