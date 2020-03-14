CREATE TABLE `booking` (
  `id` int(10) NOT NULL AUTO_INCREMENT, 
  `name_user` varchar(50) NOT NULL,
  `num` varchar(50) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `area` varchar(500) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;