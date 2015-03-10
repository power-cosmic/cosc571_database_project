DROP TRIGGER IF EXISTS on_delete_book;
DELIMITER $$
CREATE TRIGGER on_delete_book
	AFTER DELETE
	ON book
	FOR EACH ROW
	BEGIN
		UPDATE publisher 
		SET num_books=num_books-1,
		WHERE publisher.id=OLD.publisher_id;
		
	END $$

DELIMITER ;