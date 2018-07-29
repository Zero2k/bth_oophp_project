USE oophp_project;

SET NAMES utf8;

--
-- Table Content
--
DROP TABLE IF EXISTS oophp_Content;
CREATE TABLE oophp_Content (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `content` TEXT,
    `html` TEXT,
    `type` VARCHAR(200) NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO oophp_Content (id, content, html, type)
    VALUES
(1, 'footer', '<p>footer</p>', 'footer'),
(2, 'about', '<p>about</p>', 'about');
