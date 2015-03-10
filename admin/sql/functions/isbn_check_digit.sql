DROP FUNCTION IF EXISTS isbn_check_digit;
DELIMITER //

CREATE FUNCTION isbn_check_digit(isbn_check CHAR(12))
    RETURNS CHAR(1)
    BEGIN
        DECLARE check_digit, temp_num, loop_index INT;
        SET check_digit = 0;
        SET loop_index = 0;
        
		count_loop: LOOP
			SET loop_index = loop_index + 1;
			IF (loop_index % 2) = 1 THEN
				SET temp_num = CAST(SUBSTRING(isbn_check, loop_index, 1) AS UNSIGNED) * 1;
			ELSE 
				SET temp_num = CAST(SUBSTRING(isbn_check, loop_index, 1) AS UNSIGNED) * 3;
			END IF;
			SET check_digit = check_digit + temp_num;
			IF loop_index = CHAR_LENGTH(isbn_check) THEN
				LEAVE count_loop;
			END IF;
		END LOOP;
		SET check_digit = 10 - check_digit % 10;
		IF (check_digit = 10) THEN
			SET check_digit = 0;
		END IF;
        RETURN CAST(check_digit AS CHAR(1));
    END //

DELIMITER ;