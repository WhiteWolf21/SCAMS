-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;


-- ************************************** `Department`

CREATE TABLE `Department`
(
 `department_id` varchar(10) NOT NULL ,
 `name`          varchar(45) NOT NULL ,

PRIMARY KEY (`department_id`)
);



-- ************************************** `Device`

CREATE TABLE `Device`
(
 `device_id`     varchar(10) NOT NULL ,
 `name`          varchar(45) NOT NULL ,
 `department_id` varchar(10) NOT NULL ,
 `room_id`       varchar(10) NOT NULL ,
 `status`        int NOT NULL ,
 `usage`         int NOT NULL ,

PRIMARY KEY (`device_id`),
KEY `fkIdx_154` (`department_id`),
CONSTRAINT `FK_154` FOREIGN KEY `fkIdx_154` (`department_id`) REFERENCES `Department` (`department_id`),
KEY `fkIdx_157` (`room_id`),
CONSTRAINT `FK_157` FOREIGN KEY `fkIdx_157` (`room_id`) REFERENCES `Room` (`room_id`)
);



-- ************************************** `Room`

CREATE TABLE `Room`
(
 `room_id`       varchar(10) NOT NULL ,
 `name`          varchar(45) NULL ,
 `department_id` varchar(10) NOT NULL ,

PRIMARY KEY (`room_id`),
KEY `fkIdx_130` (`department_id`),
CONSTRAINT `FK_130` FOREIGN KEY `fkIdx_130` (`department_id`) REFERENCES `Department` (`department_id`)
);



-- ************************************** `Schedules`

CREATE TABLE `Schedule`
(
 `schedule_id`  varchar(10) NOT NULL ,
 `room_id`      varchar(10) NOT NULL ,
 `lecturer_id`  varchar(10) NOT NULL ,
 `date`         date NOT NULL ,
 `start_lesson` int NOT NULL ,
 `end_lesson`   int NOT NULL ,

PRIMARY KEY (`schedule_id`),
KEY `fkIdx_142` (`room_id`),
CONSTRAINT `FK_142` FOREIGN KEY `fkIdx_142` (`room_id`) REFERENCES `Room` (`room_id`),
KEY `fkIdx_145` (`lecturer_id`),
CONSTRAINT `FK_145` FOREIGN KEY `fkIdx_145` (`lecturer_id`) REFERENCES `User` (`user_id`)
);



-- ************************************** `UserInfo`

CREATE TABLE `User`
(
 `user_id`  varchar(10) NOT NULL ,
 `username` varchar(20) NOT NULL ,
 `password` varchar(45) NOT NULL ,
 `type`     varchar(20) NOT NULL ,

PRIMARY KEY (`user_id`)
);






