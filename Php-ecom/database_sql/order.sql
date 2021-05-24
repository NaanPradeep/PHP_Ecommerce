SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `order` (
    `order_id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `serialized_product_details` varchar(5000) NOT NULL,
    `order_total` int NOT NULL,
    `transaction_id` int NOT NULL,
    `ship_address` int NOT NULL,
    `bill_address` int NOT NULL,
    `status` varchar(25) NOT NULL,
    `order_date` date DEFAULT CURRENT_DATE(),
    PRIMARY KEY (`order_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
    FOREIGN KEY (`ship_address`) REFERENCES `shipping_address` (`address_id`),
    FOREIGN KEY (`bill_address`) REFERENCES `billing_address` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;