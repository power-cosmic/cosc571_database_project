DROP TRIGGER IF EXISTS update_publisher_book;
CREATE TRIGGER update_publisher_book
	AFTER INSERT
	ON book
	FOR EACH ROW
	UPDATE publisher SET num_books=num_books+1 WHERE NEW.publisher_id=publisher.id;