----------KPI4a----------
DROP PROCEDURE IF EXISTS EmployeesTraining;

DELIMITER $$
CREATE PROCEDURE EmployeesTraining()
BEGIN
    SELECT
        training_topic AS topic,
        training_hours AS hours
    FROM
        employeetraining;
END$$
DELIMITER ;

-------KPI4b--------------

DROP PROCEDURE IF EXISTS `FarmProductivity`;

DELIMITER $$
CREATE PROCEDURE `FarmProductivity`()
BEGIN
    SELECT
        year,
        productivity_index
    FROM
        farm_productivity;
END$$
DELIMITER ;

