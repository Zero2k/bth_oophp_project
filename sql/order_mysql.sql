USE vibe16;

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
    `fullName` VARCHAR(250),
    `cardNumber` VARCHAR(250),
    `expiration` VARCHAR(250),
    `cvv` VARCHAR(250),
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
    `productName` VARCHAR(250),
    `quantity` INT,
    `size` VARCHAR(250),
    `price` INT,

    FOREIGN KEY (`orderId`) REFERENCES `oophp_Order` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`productId`) REFERENCES `oophp_Product` (`id`)

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

-- ------------------------------------------------------------------------
--
-- UpdateStock
--
DROP TRIGGER IF EXISTS UpdateStock;

DELIMITER //

CREATE TRIGGER UpdateStock
AFTER INSERT ON oophp_OrderRow
FOR EACH ROW

BEGIN
	DECLARE amount INT;

	SELECT stock INTO amount
	FROM oophp_Product AS Product
	WHERE Product.id = NEW.productId;
    
    IF amount - New.quantity > 0 THEN
		UPDATE oophp_Product AS Product
		SET Product.stock = Product.stock - New.quantity
		WHERE Product.id = NEW.productId; 
    ELSE
		UPDATE oophp_Product AS Product
		SET Product.stock = 0
		WHERE Product.id = NEW.productId; 
    END IF;
END;

//

DELIMITER ;
