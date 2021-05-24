SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `user` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(50) NOT NULL, 
    `user_email` varchar(50) NOT NULL,
    `password` varchar(200) NOT NULL,
    `register_date` datetime DEFAULT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `user` (`user_name`, `user_email`, `password`) VALUES
('Pradeep', 'joy@a.com', 'password'),
('Sarah', 'sarah@a.com', 'password');

COMMIT;
