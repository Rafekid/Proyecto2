DROP procedure IF EXISTS `create_user`;
DROP procedure IF EXISTS `update_user`;
DROP procedure IF EXISTS `delete_user`;
DROP procedure IF EXISTS `create_account`;
DROP procedure IF EXISTS `update_account`;
DROP procedure IF EXISTS `delete_account`;

-- Create user
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_user`(email varchar(50), add_name varchar(50), add_role int, phone varchar(50), add_password varchar(50), add_status boolean)
BEGIN
	START TRANSACTION;
		IF add_role > 0 and add_role <= 3 THEN 
		   INSERT INTO `user` (`email`, `name`, `role`, `phone`, `password`, `status`) values (email, add_name, add_role, phone, add_password, add_status);
		END IF;
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$

-- Update user
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user`(up_id_user int, email varchar(50), add_name varchar(50), add_role int, phone varchar(50), add_password varchar(50), add_status boolean)
BEGIN
	START TRANSACTION;
		IF add_role > 0 and add_role <= 3 THEN 
			UPDATE `banco`.`user`
			SET
			`email` = email,
			`role` = add_role,
			`phone` = phone,
			`password` = add_password,
			`status` = add_status,
			`name` = add_name
			WHERE `id_user` = up_id_user;
		END IF;
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$
DELIMITER ;

-- Delete user
DELIMITER $$
CREATE PROCEDURE `delete_user`(u_id int)
BEGIN
	START TRANSACTION;
		DELETE FROM `user` WHERE `id_user` = u_id;
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$
DELIMITER;

-- Crear cuenta
DELIMITER $$
CREATE PROCEDURE `create_account`(id_user int, add_name varchar(50), dpi varchar(20), amount decimal(15,2), add_status boolean)
BEGIN
	START TRANSACTION;
		INSERT INTO `account` (`id_user`, `name`, `dpi`, `amount`, `status`) VALUES (id_user, add_name, dpi, amount, add_status);
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$
DELIMITER;

-- Update cuenta
DELIMITER $$
CREATE PROCEDURE `update_account`(up_id_account int, id_user int, up_name varchar(50), dpi varchar(20), amount decimal(15,2), up_status boolean)
BEGIN
	START TRANSACTION;
		UPDATE `account` SET 
		`id_user` = id_user,
		`name` = up_name,
		`dpi` = dpi,
		`amount` = amount,
		`status` = up_status WHERE `id_account` = up_id_account;
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$
DELIMITER;

-- Delete cuenta
DELIMITER $$
CREATE PROCEDURE `delete_account`(del_account int)
BEGIN
	START TRANSACTION;
		DELETE FROM `account` WHERE `id_account` = del_account;
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$
DELIMITER ;


-- Examples

-- call create_user('edgar.vega@gmail.com', 'Edgar Vega', 2, '4654654654', 'testpass', 1); -- emial, name, role, phone, pass, status
-- call update_user(6,'edgar.vega@gmailc.com', 'Edgar Vega', 2, '4654654654', 'test', 1); -- id user, emial, name, role, phone, pass, status
-- call delete_user(6); -- id user

-- call create_account(8, 'account name', '54654654654', 30.99, 1); -- id user, name, dpi, amount, status
-- call update_account(12, 8, 'account name test', '546546546', 33.99, 0); -- id account, id user, name, dpi, amount, status
-- call delete_account(13); -- id account
