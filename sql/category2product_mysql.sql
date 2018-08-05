USE vibe16;

SET NAMES utf8;

--
-- Table CategoryProduct
--
DROP TABLE IF EXISTS oophp_CategoryProduct;
CREATE TABLE oophp_CategoryProduct (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `categoryId` INTEGER NOT NULL,
    `productId` INTEGER NOT NULL,

    FOREIGN KEY (categoryId) REFERENCES oophp_Category(id) ON DELETE CASCADE,
    FOREIGN KEY (productId) REFERENCES oophp_Product(id) ON DELETE CASCADE

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO oophp_CategoryProduct (id, categoryId, productId)
    VALUES
(1, 1, 1),
(2, 2, 2),
(3, 1, 3);
