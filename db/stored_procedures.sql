-- Stored procedure script (MySQL)
USE be_opdracht7;

DROP PROCEDURE IF EXISTS sp_sync_voertuig_datumgewijzigd;
DELIMITER $$
CREATE PROCEDURE sp_sync_voertuig_datumgewijzigd(IN p_voertuig_id BIGINT UNSIGNED)
BEGIN
    UPDATE voertuigs
    SET datum_gewijzigd = NOW(6)
    WHERE id = p_voertuig_id;
END$$
DELIMITER ;
