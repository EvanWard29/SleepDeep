CREATE DEFINER=`PRCO204_GeekSquad`@`%` PROCEDURE `GetWeeklyData`(startDate DATETIME, endDate DATETIME)

BEGIN
    SELECT sleepStart, sleepEnd
    FROM Sleeps
    WHERE sleepStart > startDate AND sleepStart < endDate;
END
