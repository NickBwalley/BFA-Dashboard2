
----KPI1a--------------
DROP PROCEDURE IF EXISTS `complaintreceivedandresolved`;

DELIMITER $$
CREATE PROCEDURE `complaintreceivedandresolved`()
BEGIN
    SELECT
        `complaints`.`complaint_id`,
        `complaints`.`complaint_received`,
        `complaints`.`complaint_resolved`,
        `complaints`.`complaint_severity`,
        COUNT(*) AS `complaint_count`
    FROM
        `complaints`
    GROUP BY
        `complaints`.`complaint_id`,
        `complaints`.`complaint_received`,
        `complaints`.`complaint_resolved`,
        `complaints`.`complaint_severity`;
END$$
DELIMITER ;

--KPI2b---------------------------

DROP PROCEDURE IF EXISTS `CUSTOMERSASTIFICATIONINDEX`;

DELIMITER $$
CREATE PROCEDURE `CUSTOMERSASTIFICATIONINDEX`()
BEGIN
    SELECT
        YEAR(`date_column`) AS `year`,
        MONTH(`date_column`) AS `month`,
        AVG(`customer_satisfaction_index`) AS `satisfaction_index`
    FROM
        `customer_satisfaction`
    GROUP BY
        `year`,
        `month`
    ORDER BY
        `year`,
        `month`;
END$$
DELIMITER ;
