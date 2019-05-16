--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a testuser
--
-- CREATE DATABASE IF NOT EXISTS elpr18;
--  GRANT ALL ON elpr18.* TO user@localhost IDENTIFIED BY "pass";
--  USE elpr18;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for Content
--
DROP TABLE IF EXISTS `kmom06_content`;
CREATE TABLE `kmom06_content`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `path` CHAR(120) UNIQUE,
    `slug` CHAR(120) UNIQUE,

    `title` VARCHAR(120),
    `data` TEXT,
    `type` CHAR(20),
    `filter` VARCHAR(80) DEFAULT NULL,

    -- MySQL version 5.6 and higher
    `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    -- MySQL version 5.5 and lower
    -- `published` DATETIME DEFAULT NULL,
    -- `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- `updated` DATETIME DEFAULT NULL, --  ON UPDATE CURRENT_TIMESTAMP,

  `deleted` DATETIME DEFAULT NULL

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

SELECT * FROM `kmom06_content`;
