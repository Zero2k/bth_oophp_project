USE oophp_project;

SET NAMES utf8;

--
-- Table User
--
DROP TABLE IF EXISTS oophp_User;
CREATE TABLE oophp_User (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` VARCHAR(80) UNIQUE NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255),
    `country` VARCHAR(255),
    `city` VARCHAR(255),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    `admin` BOOLEAN DEFAULT 0

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO oophp_User (id, username, email, password, country, city, admin)
    VALUES
(1, 'zero2k', 'test@test.com', '$2y$10$2/YvTXRVIA1eIrts2uteL.qeIswbJH8o8PZJOgCEsZoyM1zwBWRQm', 'sweden', 'lund', 0);
