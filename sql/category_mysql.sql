USE vibe16;

SET NAMES utf8;

--
-- Table Category
--
DROP TABLE IF EXISTS oophp_Category;
CREATE TABLE oophp_Category (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `category` VARCHAR(255) NOT NULL

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO oophp_Category (id, category)
    VALUES
(1, "dresses"),
(2, "shirts"),
(3, "shorts"),
(4, "pants");
