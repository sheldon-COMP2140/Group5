DECLARE @ReportMonth INT = MONTH(GETDATE());
DECLARE @ReportYear INT = YEAR(GETDATE());


SELECT
    ea.UserID,
    egc.TransactionID,
    egc.Price AS ServiceCost,
    er.ResID,
    er.ResDate,
    er.ResTime,
    FORMAT(er.ResDate, 'MMMM yyyy') AS ReportMonthYear
FROM 
    EagleAccount ea
JOIN 
    EagleReservation er ON ea.UserID = er.UserID
JOIN 
    EagleGeneratedCost egc ON er.UserID = egc.UserID AND er.ResID = egc.TransactionID
WHERE 
    YEAR(er.ResDate) = @ReportYear
    AND MONTH(er.ResDate) = @ReportMonth
ORDER BY 
    er.ResDate, er.ResTime;

-- Calculate Total Revenue for the Current Month
SELECT 
    FORMAT(GETDATE(), 'MMMM yyyy') AS ReportMonthYear,
    SUM(egc.Price) AS TotalRevenue
FROM 
    EagleGeneratedCost egc
JOIN 
    EagleReservation er ON egc.TransactionID = er.ResID
WHERE 
    YEAR(er.ResDate) = @ReportYear
    AND MONTH(er.ResDate) = @ReportMonth;
