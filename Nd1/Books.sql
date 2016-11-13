INSERT INTO `Authors` (`authorId`, `name`) VALUES (NULL, 'Jonas Biliûnas'), (NULL, 'Balys Sruoga'), (NULL, 'Vincas Kudirka');

INSERT INTO `Books` (`bookId`, `authorId`, `title`, `year`) VALUES (NULL, '8', 'Liûdna pasaka', '1906'), (NULL, '9', 'Dievø miðkas', '1957'), (NULL, '10', 'Tautiðka giesmë', '1898');

SELECT Authors.name, Books.title, Books.year
FROM Books
INNER JOIN Authors
ON Books.authorId=Authors.authorId; 

UPDATE Books
SET authorId='2'
WHERE bookId='9'; 

DELIMITER $$
DROP PROCEDURE IF EXISTS CountAuthorsBooks$$
CREATE PROCEDURE CountAuthorsBooks()
BEGIN
 SET @authorsCount = ( SELECT COUNT(*) FROM Authors );
 SET @i = 1;
 WHILE @i <= @authorsCount DO
   SET @authorsBooks =( SELECT COUNT(*) FROM Books WHERE authorId=@i);
   SELECT @authorsBooks, Authors.name FROM Authors WHERE Authors.authorId=@i;
   SET @i = @i + 1;
 END WHILE;
END$$
DELIMITER ;

call CountAuthorsBooks();



DELIMITER $$
DROP PROCEDURE IF EXISTS CountAuthorsBooks$$
CREATE PROCEDURE CountAuthorsBooks()
BEGIN
 SET @authorsCount = ( SELECT COUNT(*) FROM Authors );
 SET @i = 1;
 WHILE @i <= @authorsCount DO
   SET @authorsBooks =( SELECT COUNT(*) FROM Books WHERE authorId=@i);
   IF @authorsBooks > 0 THEN
   SELECT @authorsBooks, Authors.name FROM Authors WHERE Authors.authorId=@i;  
   END IF;
   SET @i = @i + 1;
 END WHILE;
END$$
DELIMITER ;

call CountAuthorsBooks();



DELETE FROM `Authors` WHERE `Authors`.`authorId` = 8;
DELETE FROM `Authors` WHERE `Authors`.`authorId` = 9;
DELETE FROM `Authors` WHERE `Authors`.`authorId` = 10;

DELIMITER $$
DROP PROCEDURE IF EXISTS DeleteBooksWithoutAuthors$$
CREATE PROCEDURE DeleteBooksWithoutAuthors()
BEGIN
 SET @booksCount = ( SELECT COUNT(*) FROM Books );
 SET @i = 1;
 WHILE @i <= @booksCount DO
   SET @ifHaveAuthor =( SELECT COUNT(*) FROM Authors WHERE Authors.authorId=@i);   
   IF !(@ifHaveAuthor > 0) THEN
   DELETE FROM Books WHERE Books.authorId=@i;
   END IF;
   SET @i = @i + 1;
 END WHILE;
END$$
DELIMITER ;

call DeleteBooksWithoutAuthors();

DELETE FROM Books WHERE Books.authorId IS NULL;

ALTER TABLE `Books` ADD `genre` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `year`;

UPDATE `Books` SET `genre` = 'Coding' WHERE `Books`.`bookId` = 1;
UPDATE `Books` SET `genre` = 'Coding' WHERE `Books`.`bookId` = 2;
UPDATE `Books` SET `genre` = 'LT literature' WHERE `Books`.`bookId` = 9;
UPDATE `Books` SET `genre` = 'Coding' WHERE `Books`.`bookId` = 3;
UPDATE `Books` SET `genre` = 'Coding' WHERE `Books`.`bookId` = 4;
UPDATE `Books` SET `genre` = 'Coding' WHERE `Books`.`bookId` = 5;

ALTER TABLE `Books` CHANGE `authorId` `authorId` VARCHAR(255) NULL DEFAULT NULL;

ALTER TABLE `Books` CHANGE `title` `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

CREATE TABLE Books2 LIKE Books; 
INSERT Books2 SELECT * FROM Books;

CREATE TABLE Authors2 LIKE Authors; 
INSERT Authors2 SELECT * FROM Authors;