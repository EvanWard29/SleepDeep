DROP PROCEDURE IF EXISTS AddEvent;
DROP PROCEDURE IF EXISTS UserLogin;
DROP PROCEDURE IF EXISTS UserLoginDetails;
DROP PROCEDURE IF EXISTS CheckUsername;
DROP PROCEDURE IF EXISTS AddUser;
DROP PROCEDURE IF EXISTS GDPR_DeleteAll;
DELIMITER //

CREATE PROCEDURE GDPR_DeleteAll(p_UserID INT(11))
BEGIN
	DELETE FROM sleeps WHERE userID = p_UserID;
	DELETE FROM calendarevents WHERE userID = p_UserID;
	DELETE FROM users WHERE userID = p_UserID;
END;

CREATE PROCEDURE AddEvent(p_EventDate DATE, p_EventDescription VARCHAR(255), p_UserID INT(11))
BEGIN	
	INSERT INTO calendarevents(eventDate, eventDescription, userID)
		VALUES(p_EventDate, p_EventDescription, p_UserID);
END;

CREATE PROCEDURE UserLogin(p_Username VARCHAR(25))
BEGIN
	SELECT userPassword FROM users
		WHERE p_Username = username;
END;

CREATE PROCEDURE UserLoginDetails(p_Username VARCHAR(25))
BEGIN
	SELECT * FROM users
		WHERE p_Username = username;
END;

CREATE PROCEDURE CheckUsername(p_Username VARCHAR(25))
BEGIN
	SELECT EXISTS(SELECT * FROM users WHERE userName=p_Username);
END;

CREATE PROCEDURE AddUser(p_Forename VARCHAR(25), p_Surname VARCHAR(25), p_Username VARCHAR(25), p_Password VARCHAR(25))
BEGIN
	INSERT INTO users(forename, surname, username, userPassword)
		VALUES(p_Forename, p_Surname, p_Username, p_Password);
END;

