DELIMITER $$
CREATE PROCEDURE SP_ADD_USERS(IN mail VARCHAR(80), IN rol INT, IN tel INT(15), IN pwd VARCHAR(20), IN estado INT)
BEGIN
START TRANSACTION;
INSERT INTO user VALUES(
NULL, mail,rol,tel,pwd,estado);	
IF (@@error_count=0) THEN
COMMIT;
ELSE
ROLLBACK;
END IF;
END $$
DELIMITER ;

 call sp_add_users('rjuarezs1@gmail.com',1,'33524677','rj123',1);