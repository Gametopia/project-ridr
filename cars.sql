CREATE TABLE `cars` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `category` VARCHAR(255) NOT NULL,
        `image` VARCHAR(255) NOT NULL,
        `fuel` INT NOT NULL,
        `seats` INT NOT NULL,
        `transmission` ENUM ('automatic', 'manual') NOT NULL,
        `price` INT NOT NULL,
        `description` TEXT NOT NULL,
        PRIMARY KEY (`id`)
    );

