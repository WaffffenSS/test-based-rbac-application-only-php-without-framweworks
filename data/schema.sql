DROP DATABASE if EXISTS `auth-test`;
CREATE DATABASE if NOT EXISTS `auth-test` CHAR SET utf8 COLLATE utf8_general_ci;
use `auth-test`;
CREATE TABLE user
(
    `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255),
    `email` VARCHAR(255),
    `password` VARCHAR(1024)
);
CREATE UNIQUE INDEX user_username_uindex ON user (username);
CREATE UNIQUE INDEX user_email_uindex ON user (email);