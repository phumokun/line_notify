CREATE TABLE `line_notify_music` (
  `id` int(10) NOT NULL AUTO_INCREMENT, 
  `table_no` varchar(10) NOT NULL,
  `name_music` varchar(50) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `caption` varchar(500) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;