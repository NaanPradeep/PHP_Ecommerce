SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `shipping_address` (
    `address_id` int NOT NULL AUTO_INCREMENT,
    `address_owner` int NOT NULL,
    `street_no` varchar(15) NOT NULL,
    `street_name` varchar(25) NOT NULL,
    `town_name` varchar(25) NOT NULL,
    `city_name` varchar(25) NOT NULL,
    `pincode` int(6) NOT NULL,
    `country` varchar(25) NOT NULL,
    PRIMARY KEY (`address_id`),
    FOREIGN KEY (`address_owner`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;