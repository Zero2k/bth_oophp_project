USE vibe16;

SET NAMES utf8;

--
-- Table Post
--
DROP TABLE IF EXISTS oophp_Post;
CREATE TABLE oophp_Post (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId` INTEGER NOT NULL,
    `content` TEXT,
    `html` TEXT,
    `title` VARCHAR(250) NOT NULL,
    `slug` VARCHAR(250) NOT NULL,
    `image` VARCHAR(250),
    `category` VARCHAR(250),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (userId) REFERENCES oophp_User(id)

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO oophp_Post (id, userId, content, html, title, slug, category)
    VALUES
(1, 1, 'post 1', '<p>post 1</p>', 'first post', 'first-post', 'news'),
(2, 1, 'post 2', '<p>post 2</p>', 'second post', 'second-post', 'offers');
