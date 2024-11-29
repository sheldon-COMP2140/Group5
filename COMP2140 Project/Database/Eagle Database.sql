DROP SCHEMA if exists `eagle`;
CREATE SCHEMA `eagle`;
CREATE TABLE `eagle`.eagleaccount (UserID int NOT NULL AUTO_INCREMENT, Fname varchar(255) NOT NULL, Lname varchar(255) not null, DOB date, Telephone varchar(11) not null, email varchar(255) not null, Password varchar(255) not null, IsAdmin boolean not null, IsOwner boolean not null, PRIMARY KEY (UserID));
CREATE TABLE  `eagle`.eaglegeneratedCost (TransactionID int not null AUTO_INCREMENT, Price int NOT NULL, PRIMARY KEY (TransactionID));
CREATE TABLE  `eagle`.eaglereservation (ResID int not null AUTO_INCREMENT, ResDate date not null, ResTime Time not null, PRIMARY KEY (ResID));
CREATE TABLE  `eagle`.eagleinventory (InvID int not null AUTO_INCREMENT, Item varchar(255), Colour varchar(255), Price int not null, Description varchar(255), PRIMARY KEY (InvID)); 
CREATE TABLE  `eagle`.eaglefeedback (FeedID int not null AUTO_INCREMENT, FeedBack text not null, FeedDate date not null, FeedTime time not null, PRIMARY KEY (FeedID));



CREATE TABLE  `eagle`.book (ResID int not null, UserID int NOT NULL, PRIMARY KEY (ResID, UserID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));
CREATE TABLE  `eagle`.needs (ResID int not null, TransactionID int NOT NULL, PRIMARY KEY (ResID, TransactionID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (TransactionID) REFERENCES EagleGeneratedCost(TransactionID));
CREATE TABLE  `eagle`.generate (TransactionID int not null, UserID int NOT NULL, PRIMARY KEY (TransactionID, UserID ), FOREIGN KEY (TransactionID) REFERENCES EagleGeneratedCost(TransactionID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));
CREATE TABLE  `eagle`.gives (ResID int not null, UserID int NOT NULL, PRIMARY KEY (ResID, UserID), FOREIGN KEY (ResID) REFERENCES EagleReservation(ResID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));
CREATE TABLE  `eagle`.adds (InvID int not null, UserID int NOT NULL, PRIMARY KEY (InvID, UserID), FOREIGN KEY (InvID) REFERENCES EagleInventory(InvID), FOREIGN KEY (UserID) REFERENCES EagleAccount(UserID));


-- CREATE TABLE `Egle`.EagleAccount (UserID int NOT NULL, Fname varchar(255) NOT NULL, Lname varchar(255) not null, DOB date, Telephone varchar(11) not null, email varchar(255) not null, Password varchar(255) not null, IsAdmin boolean not null, IsOwner boolean not null, KEY (UserID));
-- Create TABLE  `Egle`.EagleGeneratedCost (TransactionID int not null, Price int NOT NULL, KEY (TransactionID));
-- Create TABLE  `Egle`.EagleReservation (ResID int not null, ResDate date not null, ResTime Time not null, Key (ResID));
-- Create TABLE  `Egle`.EagleInventory (InvID int not null, Item varchar(255), Colour varchar(255), Grade int not null, Price int not null, Key (InvID));-- 
-- Create TABLE  `Egle`.EgleFeedback (FeedID int not null, FeedBack text not null, FeedDate date not null, FeedTime time not null, Key (FeedID));



-- SELECT QUERIES
-- SELECT QUERIES
-- SELECT Price FROM `Eagle`.EagleInventory WHERE Item = 'Frosted';
-- SELECT Price FROM `Eagle`.EagleInventory WHERE Item = 'Titanium';
-- SELECT Price FROM `Eagle`.EagleInventory WHERE Item = 'Midnight';
-- SELECT Price FROM `Eagle`.EagleInventory WHERE Item = 'Medium';
-- INSERT INTO `Eagle`.Generate VALUES (450);