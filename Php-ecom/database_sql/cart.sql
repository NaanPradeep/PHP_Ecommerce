SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `cart` (
    `cart_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `product_id` int NOT NULL,
    PRIMARY KEY (`cart_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
    FOREIGN KEY (`product_id`) REFERENCES `product` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SELECT `cart`.`cart_id`, `user`.`user_name` FROM `cart` INNER JOIN `user` ON `cart`.`user_id` = `user`.`user_id`;

COMMIT;