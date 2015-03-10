DROP TRIGGER IF EXISTS update_publisher_book;
DELIMITER $$
CREATE TRIGGER update_publisher_book
	BEFORE INSERT
	ON book
	FOR EACH ROW
	BEGIN
		UPDATE publisher 
			SET num_books=num_books+1, 
				NEW.isbn=isbn_with_check_digit(CONCAT('9780', code, LPAD(num_books, 8 - CHAR_LENGTH(code), '0')))
			WHERE publisher.id=NEW.publisher_id;
	END $$

DELIMITER ;