-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 07:10 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Creating tables and inserting data

-- Table structure for table `tbladmin`
CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)  -- Set ID as PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Inserting data into `tbladmin`
INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 58570983, 'tester@gmail.com', '123456', '2024-12-03 12:26:29');

-- Table structure for table `tblcategory`
CREATE TABLE `tblcategory` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `VehicleCat` varchar(120) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)  -- Set ID as PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `tblvehicle`
CREATE TABLE `tblvehicle` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ParkingNumber` varchar(120) DEFAULT NULL,
  `VehicleCategory` varchar(120) NOT NULL,
  `VehicleCompanyname` varchar(120) DEFAULT NULL,
  `RegistrationNumber` varchar(120) DEFAULT NULL,
  `OwnerName` varchar(120) DEFAULT NULL,
  `OwnerContactNumber` bigint(10) DEFAULT NULL,
  `InTime` timestamp NULL DEFAULT current_timestamp(),
  `OutTime` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ParkingCharge` varchar(120) NOT NULL,
  `Remark` mediumtext NOT NULL,
  `Status` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`)  -- Set ID as PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `comapny` varchar(50) DEFAULT NULL,
  `registration` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)  -- Set ID as PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `logtable`
CREATE TABLE `logtable` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `comapny` varchar(50) DEFAULT NULL,
  `registration` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)  -- Set ID as PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Corrected Trigger to insert into another table (`another_logtable`)
DELIMITER $$

CREATE TRIGGER log_entry
AFTER INSERT ON logtable
FOR EACH ROW
BEGIN
    INSERT INTO another_logtable (name, email, mobile, category, comapny, registration, reg_date)
    VALUES (NEW.name, NEW.email, NEW.mobile, NEW.category, NEW.comapny, NEW.registration, NEW.reg_date);
END $$

DELIMITER ;

COMMIT;

