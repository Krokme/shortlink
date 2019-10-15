SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `genady_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `genady_test`;

DROP TABLE IF EXISTS `test_authors`;
CREATE TABLE IF NOT EXISTS `test_authors` (
  `author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`author_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `test_books`;
CREATE TABLE IF NOT EXISTS `test_books` (
  `book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `test_books_authors`;
CREATE TABLE IF NOT EXISTS `test_books_authors` (
  `book_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  KEY `book_id` (`book_id`) USING BTREE,
  KEY `author_id` (`author_id`) USING BTREE,
  KEY `book_id_2` (`book_id`,`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `test_shortlink`;
CREATE TABLE IF NOT EXISTS `test_shortlink` (
  `shortlink` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(2083) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(32) CHARACTER SET ascii DEFAULT NULL,
  PRIMARY KEY (`shortlink`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `test_books_authors`
  ADD CONSTRAINT `fk_test_books_authors1` FOREIGN KEY (`book_id`) REFERENCES `test_books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_test_books_authors2` FOREIGN KEY (`author_id`) REFERENCES `test_authors` (`author_id`) ON DELETE CASCADE;
COMMIT;
