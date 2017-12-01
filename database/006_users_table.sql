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


INSERT INTO `users` (`username`, `password`, `email`, `isAdmin`) VALUES ('majid', '$2y$10$fwYjdH70myASfdhDGnZYL.UBfzi7IDA4bnyrcyfe0tD7gTTOsT7P.', 'majidfn@gmail.com', 1);
INSERT INTO `users` (`username`, `password`, `email`, `isAdmin`) VALUES ('admin', '$2y$10$fwYjdH70myASfdhDGnZYL.UBfzi7IDA4bnyrcyfe0tD7gTTOsT7P.', 'majidfn@yahoo.com', 1);
INSERT INTO `users` (`username`, `password`, `email`, `isAdmin`) VALUES ('user', '$2y$10$fwYjdH70myASfdhDGnZYL.UBfzi7IDA4bnyrcyfe0tD7gTTOsT7P.', 'majidfn@yahoo.com', 0);