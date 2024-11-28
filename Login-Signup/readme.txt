mkdir login-signup-node
cd login-signup-node
npm init -y


---------------------------------------------------------------------------



npm install express mysql2 bcryptjs body-parser express-session



-------------------------------

RUN IN [MYSQL]

DROP SCHEMA if exists `EAGLE`;
CREATE SCHEMA `Eagle`;
CREATE TABLE `eagleaccount` (
   `UserID` int NOT NULL AUTO_INCREMENT,
   `Fname` varchar(255) NOT NULL,
   `Lname` varchar(255) NOT NULL,
   `DOB` date DEFAULT NULL,
   `Telephone` varchar(11) NOT NULL,
   `email` varchar(255) NOT NULL,
   `Password` varchar(255) NOT NULL,
   `IsAdmin` tinyint(1) DEFAULT NULL,
   `IsOwner` tinyint(1) DEFAULT NULL,
   PRIMARY KEY (`UserID`),
   KEY `UserID` (`UserID`)
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE  `Eagle`.EagleGeneratedCost (TransactionID int not null, Price int NOT NULL, KEY (TransactionID));
CREATE TABLE  `Eagle`.EagleReservation (ResID int not null, ResDate date not null, ResTime Time not null, Key (ResID));
CREATE TABLE  `Eagle`.EagleInventory (InvID int not null, Item varchar(255), Colour varchar(255), Grade int not null, Price int not null, Key (InvID));-- 
CREATE TABLE  `Eagle`.EgleFeedback (FeedID int not null, FeedBack text not null, FeedDate date not null, FeedTime time not null, Key (FeedID));



CREATE TABLE  `Eagle`.Book (ResID int not null, UserID int NOT NULL, KEY (ResID, UserID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));
CREATE TABLE  `Eagle`.Needs (ResID int not null, TransactionID int NOT NULL, KEY (ResID, TransactionID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (TransactionID) REFERENCES EagleGeneratedCost(TransactionID));
CREATE TABLE  `Eagle`.Generate (TransactionID int not null, UserID int NOT NULL, KEY (TransactionID, UserID ), FOREIGN KEY (TransactionID) REFERENCES EagleGeneratedCost(TransactionID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));
CREATE TABLE  `Eagle`.Gives (ResID int not null, UserID int NOT NULL, KEY (ResID, UserID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));
CREATE TABLE  `Eagle`.Adds (InvID int not null, UserID int NOT NULL, KEY (InvID, UserID), FOREIGN KEY (InvID) REFERENCES EagleInventory(InvID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));


-- CREATE TABLE `Egle`.EagleAccount (UserID int NOT NULL, Fname varchar(255) NOT NULL, Lname varchar(255) not null, DOB date, Telephone varchar(11) not null, email varchar(255) not null, Password varchar(255) not null, IsAdmin boolean not null, IsOwner boolean not null, KEY (UserID));
-- Create TABLE  `Egle`.EagleGeneratedCost (TransactionID int not null, Price int NOT NULL, KEY (TransactionID));
-- Create TABLE  `Egle`.EagleReservation (ResID int not null, ResDate date not null, ResTime Time not null, Key (ResID));
-- Create TABLE  `Egle`.EagleInventory (InvID int not null, Item varchar(255), Colour varchar(255), Grade int not null, Price int not null, Key (InvID));-- 
-- Create TABLE  `Egle`.EgleFeedback (FeedID int not null, FeedBack text not null, FeedDate date not null, FeedTime time not null, Key (FeedID));



-- SELECT QUERIES