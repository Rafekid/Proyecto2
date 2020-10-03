
ALTER TABLE account MODIFY id_user INT(11);

DROP procedure IF EXISTS `create_account`;
DROP procedure IF EXISTS `deposit_amount`;
DROP procedure IF EXISTS `retirement_amount`;

-- create account
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_account`(INNAME VARCHAR(250), INDPI VARCHAR(20), INAMOUNT DECIMAL(15,2))
BEGIN
    
    START TRANSACTION;
	
    INSERT INTO account(name, dpi, amount, status) VALUES(INNAME, INDPI, INAMOUNT, true);
    
	SELECT LAST_INSERT_ID() as cuenta_id;
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$

-- Deposit
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deposit_amount`(account INT(11), movement_amount DECIMAL(15,2))
BEGIN
    DECLARE account_id INT(11);
    DECLARE account_user_id INT(11);
    DECLARE account_amount DECIMAL(15,2);
    
    START TRANSACTION;
    SELECT id_account, id_user, amount INTO  account_id,  account_user_id, account_amount FROM account WHERE id_account = account;
	
    
    IF( account_id IS NOT NULL AND account_user_id IS NOT NULL ) THEN
		UPDATE account SET amount = account_amount + movement_amount WHERE id_account = account_id;
        INSERT INTO transaction(id_user, id_account, type, monto, fecha ) VALUES ( account_user_id, account_id, 1, movement_amount, now());
        
	ELSE
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede hacer el deposito, la cuenta no existe.';
    END IF;
        
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$

-- Retirement
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `retirement_amount`(account INT(11), movement_amount DECIMAL(15,2))
BEGIN
    DECLARE account_id INT(11);
    DECLARE account_user_id INT(11);
    DECLARE account_amount DECIMAL(15,2);
    
    
    
    START TRANSACTION;
    SELECT id_account, id_user, amount INTO  account_id,  account_user_id, account_amount FROM account WHERE id_account = account;
	
    
    IF( account_amount>=movement_amount AND account_id IS NOT NULL AND account_user_id IS NOT NULL ) THEN
		UPDATE account SET amount = account_amount - movement_amount WHERE id_account = account_id;
        INSERT INTO transaction(id_user, id_account, type, monto, fecha ) VALUES ( account_user_id, account_id, 0, movement_amount, now());
        
	ELSE
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede hacer el retiro, la cuenta no tiene fondos suficientes o no existe.';
    END IF;
        
	IF (@@error_count = 0) THEN
		COMMIT;
	ELSE
		ROLLBACK;
	END IF;
END$$

-- CALL retirement_amount(1,200);
-- CALL deposit_amount(1,200);
-- CALL create_account("Martin","12568125", 6000);