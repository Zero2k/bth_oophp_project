USE oophp_project;

SET NAMES utf8;

--
-- Table Product
--
DROP TABLE IF EXISTS oophp_Product;
CREATE TABLE oophp_Product (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId` INTEGER NOT NULL,
    `name` VARCHAR(250) NOT NULL,
    `description` VARCHAR(250),
    `text` TEXT,
    `price` INTEGER,
    `old_price` INTEGER,
    `image` VARCHAR(250),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (userId) REFERENCES oophp_User(id)

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO oophp_Product (id, userId, name, description, text, price)
    VALUES
(1, 1, 'Pleated Halter Blouse', 'description', 'text', 34),
(2, 1, 'Cinch Athletic Poly Spandex Tech Polo', 'description', 'text', 23),
(3, 1, 'Sleeveless Chiffon Zebra Fresco', 'description', 'text', 25);
