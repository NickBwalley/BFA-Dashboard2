------------KPI3a-----
DROP PROCEDURE IF EXISTS `PROCESSINGMANUFACTURE`;

DELIMITER $$
CREATE PROCEDURE `PROCESSINGMANUFACTURE`()
BEGIN
    SELECT
        category_column AS category,
        AVG(time_column) AS average_processing_time
    FROM
        processing
    GROUP BY
        category_column;
END$$
DELIMITER ;

---------KPI3b-------------------------
DROP PROCEDURE IF EXISTS `QualityProcess`;

DELIMITER $$
CREATE PROCEDURE `QualityProcess`()
BEGIN
    SELECT
        category_column AS category,
        AVG(quality_column) AS average_quality
    FROM
        qualityprocessed
    GROUP BY
        category_column;
END$$
DELIMITER ;
