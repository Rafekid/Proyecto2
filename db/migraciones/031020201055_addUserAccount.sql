USE banca;
DROP procedure IF EXISTS `create_user_account`;
-- Create user account
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_user_account`(add_account INT(11),add_email VARCHAR(50), add_name VARCHAR(50), add_role INT(11), phone VARCHAR(50), add_password VARCHAR(50), add_status BOOLEAN)
BEGIN

    DECLARE account_id INT(11);
    DECLARE account_user_id INT(11);
    DECLARE user_registered_email VARCHAR(50);
    
    START TRANSACTION;
    SELECT id_account, id_user INTO  account_id, account_user_id FROM account WHERE id_account = add_account;

    IF( account_id IS NULL OR  account_user_id IS NOT NULL) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La cuenta no existe o ya tiene asignada un usuario.';
    END IF;
    
	SELECT email INTO  user_registered_email FROM user WHERE email = add_email;
    IF( user_registered_email IS NOT NULL) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El e-mail ya se utilizo con anterioridad.';
    END IF;
    
	IF add_role > 0 and add_role <= 3 THEN 
		INSERT INTO `user` (`email`, `name`, `role`, `phone`, `password`, `status`) values (add_email, add_name, add_role, phone, add_password, add_status);
		UPDATE account SET id_user = last_insert_id()  WHERE id_account = account_id;
	END IF;
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$


call create_user_account(3,'edgar33@gmail.com', 'Edgar Vega', 3, '4654654654', 'testpass', 1); -- account,email, name, role, phone, pass, status

