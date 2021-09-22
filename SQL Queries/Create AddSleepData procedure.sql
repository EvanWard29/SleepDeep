CREATE DEFINER=`PRCO204_GeekSquad`@`%` PROCEDURE `AddSleepData`(newSleepStart datetime, newSleepEnd datetime, UserID int(10))
BEGIN
	INSERT INTO sleeps(sleepStart, sleepEnd, userID)
		VALUES(newSleepStart, newSleepEnd, UserID);
END