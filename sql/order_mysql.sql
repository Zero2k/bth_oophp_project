USE oophp_project;

SET NAMES utf8;

-- ------------------------------------------------------------------------
--
-- Setup tables
--
DROP TABLE IF EXISTS oophp_OrderRow;
DROP TABLE IF EXISTS oophp_Order;



-- ------------------------------------------------------------------------
--
-- Order
--
DROP TABLE IF EXISTS oophp_Order;

CREATE TABLE oophp_Order (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `userId` INT,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (`userId`) REFERENCES `oophp_User` (`id`)

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

-- ------------------------------------------------------------------------
--
-- OrderRow
--
DROP TABLE IF EXISTS oophp_OrderRow;

CREATE TABLE oophp_OrderRow (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `orderId` INT,
    `productId` INT,
    `quantity` INT,
    `size` VARCHAR(250),
    `price` INT,

    FOREIGN KEY (`orderId`) REFERENCES `oophp_Order` (`id`),
    FOREIGN KEY (`productId`) REFERENCES `oophp_Product` (`id`)

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

-- ------------------------------------------------------------------------
--
-- View Products in Order
--
DROP PROCEDURE IF EXISTS viewOrder;

DELIMITER //

CREATE PROCEDURE viewOrder(
    orderId INT
)
BEGIN

SELECT
	Orders.id AS orderNr,
	Product.id AS productId,
    Product.title AS title,
    Product.price AS price,
    OrderRow.quantity AS quantity,
    OrderRow.size AS size,
    User.username AS customerName
FROM

	`oophp_Order` AS Orders
    LEFT JOIN `oophp_OrderRow` AS OrderRow
        ON Orders.id = OrderRow.orderId
    LEFT JOIN `oophp_Product` AS Product
        ON OrderRow.productId = Product.id
    INNER JOIN `oophp_User` AS User
        ON Orders.userId = User.id
    WHERE Orders.id = orderId;

END;
//

DELIMITER ;
