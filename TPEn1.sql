CREATE DATABASE Lolinwonderland_db;

CREATE TABLE `Lolinwonderland_db`.`Authors` (
    `author_name` VARCHAR(100) NOT NULL ,
    `author_age` INT NOT NULL ,
    `author_activity` INT NOT NULL ,
    PRIMARY KEY (`author_name`))ENGINE = INNODB;

CREATE TABLE `Lolinwonderland_db`.`Books` (
    `book_id` INT NULL AUTO_INCREMENT ,
    `book_name` VARCHAR(100) NOT NULL ,
    `book_authorname` VARCHAR(100) NOT NULL ,
    `book_series` VARCHAR(100) NOT NULL ,
    `book_seriesnumber` INT NOT NULL ,
    `book_summary` VARCHAR(5000) NOT NULL ,
    `book_img` VARCHAR(50) NOT NULL ,
    PRIMARY KEY (`book_id`, `book_name`))ENGINE = INNODB;

    CREATE TABLE `Lolinwonderland_db`.`Users` (
    `user_id` INT NULL AUTO_INCREMENT ,
    `user_name` VARCHAR(100) NOT NULL ,
    `user_lastname` VARCHAR(100) NOT NULL ,
    `user_email` VARCHAR(200) NOT NULL ,
    `user_username` VARCHAR(50) NOT NULL ,
    `user_password` VARCHAR(100) NOT NULL ,
    PRIMARY KEY (`user_id`))ENGINE = INNODB;

INSERT INTO `Authors` (`author_name`, `author_age`, `author_activity`) VALUES ('Sarah J. Mass', 38, 2012);
INSERT INTO `Authors` (`author_name`, `author_age`, `author_activity`) VALUES ('Jennifer L. Armentrout', 44, 2011);
INSERT INTO `Authors` (`author_name`, `author_age`, `author_activity`) VALUES ('Marissa Meyer', 40, 2012);
INSERT INTO `Books` (`book_id`, `book_name`, `book_authorname`, `book_series`, `book_seriesnumber`, `book_summary`) VALUES (NULL, 'A court of thorns and roses', 'Sarah J. Mass', 'ACOTAR', 1, 'This books is about blablabla');
INSERT INTO `Books` (`book_id`, `book_name`, `book_authorname`, `book_series`, `book_seriesnumber`, `book_summary`) VALUES (NULL, 'A court of mist and fury', 'Sarah J. Mass', 'ACOTAR', 2, 'The adventure continues and they...');
INSERT INTO `Books` (`book_id`, `book_name`, `book_authorname`, `book_series`, `book_seriesnumber`, `book_summary`) VALUES (NULL, 'A court of wings and ruin', 'Sarah J. Mass', 'ACOTAR', 3, 'The war is near and...');
INSERT INTO `Books` (`book_id`, `book_name`, `book_authorname`, `book_series`, `book_seriesnumber`, `book_summary`) VALUES (NULL, 'From blood and ash', 'Jennifer L. Armentrout', 'From blood and ash', 1, 'Noblesse oblige and the protagonist...');

ALTER TABLE `Books` ADD CONSTRAINT `fk_bookauthor` FOREIGN KEY (`book_authorid`) REFERENCES `authors`(`author_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;