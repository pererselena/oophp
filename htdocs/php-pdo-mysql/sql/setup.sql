--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a testuser
--
CREATE DATABASE IF NOT EXISTS elpr18;
CREATE USER IF NOT EXISTS 'elpr18'@'%'
    IDENTIFIED WITH mysql_native_password BY 'NJUJcEKR2Vq6'
;

GRANT ALL PRIVILEGES
	ON elpr18.* 
	TO 'elpr18'@'%';
USE elpr18;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `kmom05_movie`;
CREATE TABLE `kmom05_movie`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `director` VARCHAR(100),
    `length` INT DEFAULT NULL,            -- Length in minutes
    `year` INT NOT NULL DEFAULT 1900,
    `plot` TEXT,                          -- Short intro to the movie
    `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
    `subtext` CHAR(3) DEFAULT NULL,       -- swe, fin, en, etc
    `speech` CHAR(3) DEFAULT NULL,        -- swe, fin, en, etc
    `quality` CHAR(3) DEFAULT NULL,
    `format` CHAR(3) DEFAULT NULL         -- mp4, divx, etc
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DELETE FROM `kmom05_movie`;
INSERT INTO `kmom05_movie` (`title`, `year`, `image`) VALUES
    ('Pulp fiction', 1994, 'img/pulp-fiction.jpg'),
    ('American Pie', 1999, 'img/american-pie.jpg'),
    ('Pokémon The Movie 2000', 1999, 'img/pokemon.jpg'),  
    ('Kopps', 2003, 'img/kopps.jpg'),
    ('From Dusk Till Dawn', 1996, 'img/from-dusk-till-dawn.jpg')
;

SELECT * FROM `kmom05_movie`;
