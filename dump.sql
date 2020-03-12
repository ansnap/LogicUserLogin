/**
 * Creates DB schema
 */

CREATE TABLE `users` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(100) NOT NULL,
	`password` VARCHAR(256) NOT NULL,
	`name` VARCHAR(100) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`gender` CHAR(1) NOT NULL,
	`birthday` DATE NOT NULL,
	`phone` VARCHAR(13) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `username` (`username`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
