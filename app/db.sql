CREATE TABLE `ssc` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `expect` char(13) NOT NULL,
  `count` int(6) NOT NULL,
  `bet` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `danma` VARCHAR(10) NOT NULL,
  `mahe` VARCHAR(10) NOT NULL,
  `bai` VARCHAR(100) NOT NULL,
  `shi` VARCHAR(100) NOT NULL,
  `ge` VARCHAR(100) NOT NULL,
  `opencode` VARCHAR(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`expect`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;