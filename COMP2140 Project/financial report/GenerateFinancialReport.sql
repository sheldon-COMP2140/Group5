DELIMITER //

CREATE PROCEDURE GenerateFinancialReport (
    IN ReportMonth INT,
    IN ReportYear INT
)
BEGIN
    -- Validate input
    IF ReportMonth < 1 OR ReportMonth > 12 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid month. Please enter a value between 1 and 12.';
    END IF;

    -- Query for reservation details
    SELECT 
        ea.UserID,
        egc.TransactionID,
        egc.Price,
        er.ResID,
        er.ResDate,
        er.ResTime,
        DATE_FORMAT(er.ResDate, '%M %Y') AS ReportMonthYear
    FROM 
        EagleAccount ea
    JOIN 
        EagleReservation er ON ea.UserID = er.UserID
    JOIN 
        EagleGeneratedCost egc ON er.ResID = egc.TransactionID
    WHERE 
        YEAR(er.ResDate) = ReportYear
        AND MONTH(er.ResDate) = ReportMonth
    ORDER BY 
        er.ResDate, er.ResTime;

    -- Query for total revenue
    SELECT 
        DATE_FORMAT(CONCAT(ReportYear, '-', ReportMonth, '-01'), '%M %Y') AS ReportMonthYear,
        SUM(egc.Price) AS TotalRevenue
    FROM 
        EagleGeneratedCost egc
    JOIN 
        EagleReservation er ON egc.TransactionID = er.ResID
    WHERE 
        YEAR(er.ResDate) = ReportYear
        AND MONTH(er.ResDate) = ReportMonth;
END//

DELIMITER ;