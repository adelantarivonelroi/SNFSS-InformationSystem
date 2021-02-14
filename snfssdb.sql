-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2018 at 06:32 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snfssdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `AuditID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `LogType` varchar(50) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `LogDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `ClearanceID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ClearanceStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clearancedetails`
--

CREATE TABLE `clearancedetails` (
  `ClearanceDetailsID` int(11) NOT NULL,
  `ClearanceID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `DateCleared` date NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `EnrollmentID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `EnrollmentStatus` varchar(20) NOT NULL,
  `DateEnroll` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entranceexam`
--

CREATE TABLE `entranceexam` (
  `eeID` int(11) NOT NULL,
  `examineeFirstName` varchar(50) NOT NULL,
  `examineeMiddleName` varchar(50) NOT NULL,
  `examineeLastName` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `yearLevel` int(11) NOT NULL,
  `scoreEnglish` int(11) NOT NULL,
  `scoreMath` int(11) NOT NULL,
  `scoreScience` int(11) NOT NULL,
  `dateTaken` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entranceexam`
--

INSERT INTO `entranceexam` (`eeID`, `examineeFirstName`, `examineeMiddleName`, `examineeLastName`, `birthday`, `yearLevel`, `scoreEnglish`, `scoreMath`, `scoreScience`, `dateTaken`) VALUES
(1, 'Michael', 'Dicaprio', 'D\'angelo', '1990-01-13', 7, 98, 87, 76, '2018-01-26'),
(2, 'Que', 'Rangoon', 'Ken', '1997-07-23', 12, 77, 88, 99, '2018-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `GradeID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `GradeName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradesubject`
--

CREATE TABLE `gradesubject` (
  `GradeSubjectID` int(11) NOT NULL,
  `GradeID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `LevelID` int(11) NOT NULL,
  `LevelName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `LogID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `LoginTime` time(6) NOT NULL,
  `LogoutTime` time(6) NOT NULL,
  `DateLog` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `ParentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostTypeID` int(11) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Image` varchar(1000) NOT NULL,
  `Attachment` varchar(1000) NOT NULL,
  `DateAdded` datetime(6) NOT NULL,
  `DateModified` datetime(6) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posttype`
--

CREATE TABLE `posttype` (
  `PostTypeID` int(11) NOT NULL,
  `PostName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE `schoolyear` (
  `SchoolYearID` int(11) NOT NULL,
  `EnrollmentID` int(11) NOT NULL,
  `SchoolYearStart` date NOT NULL,
  `SchoolYearEnd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `SectionID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SectionName` varchar(20) NOT NULL,
  `SectionStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusID` int(11) NOT NULL,
  `new` varchar(3) NOT NULL,
  `old` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `LevelID` int(10) NOT NULL,
  `GradeID` int(5) NOT NULL,
  `ClearanceID` int(13) NOT NULL,
  `FirstName` varchar(70) NOT NULL,
  `MiddleName` varchar(20) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Picture` varchar(1000) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Birthday` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `MotherFirstName` varchar(70) NOT NULL,
  `MotherLastName` varchar(50) NOT NULL,
  `MotherOccupation` varchar(100) NOT NULL,
  `FatherFirstName` varchar(70) NOT NULL,
  `FatherLastName` varchar(50) NOT NULL,
  `FatherOccupation` varchar(100) NOT NULL,
  `StudentStatus` varchar(20) NOT NULL,
  `DateAdded` datetime(6) NOT NULL,
  `DateModified` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `UserID`, `LevelID`, `GradeID`, `ClearanceID`, `FirstName`, `MiddleName`, `LastName`, `Picture`, `Gender`, `Birthday`, `Email`, `ContactNo`, `Address`, `MotherFirstName`, `MotherLastName`, `MotherOccupation`, `FatherFirstName`, `FatherLastName`, `FatherOccupation`, `StudentStatus`, `DateAdded`, `DateModified`) VALUES
(1, 1, 1, 1, 1, 'Kenneth', 'R', 'Que', '', 'Male', '2018-02-06', 'asdasd@yahoo.com', '123123123', 'Address', 'MotherFIrstName', 'MotherLN', 'MotherOccup', 'FatherFN', 'FatherLN', 'FatherOccup', 'Not Enrolled', '2018-02-01 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectID` int(10) NOT NULL,
  `DepartmentID` int(10) NOT NULL,
  `SubjectName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjectgrade`
--

CREATE TABLE `subjectgrade` (
  `GradeSubjectID` int(11) NOT NULL,
  `GradeID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Unit` double(10,3) NOT NULL,
  `GradeSubjectName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `TypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TypeID`, `TypeName`) VALUES
(1, 'Admin'),
(2, 'Faculty'),
(3, 'IT Personnel'),
(4, 'Parents'),
(5, 'Principal'),
(6, 'Registrar'),
(7, 'Student Services Officer'),
(8, 'Department Head');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `FirstName` varchar(70) NOT NULL,
  `MiddleName` varchar(20) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `Birthday` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DateAdded` datetime(6) NOT NULL,
  `DateModified` datetime(6) NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `TypeID`, `UserName`, `FirstName`, `MiddleName`, `LastName`, `Gender`, `Birthday`, `Email`, `ContactNo`, `Address`, `Password`, `DateAdded`, `DateModified`, `Status`) VALUES
(1, 1, 'jsimbahon', 'Jan Louis', 'C.', 'Simbahon', 'Male', '0000-00-00', 'jan.simbahon@gmail.com', '09271272203', 'Quezon City', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '2018-02-19 21:44:38.000000', '2018-02-27 15:03:45.000000', 'Active'),
(2, 4, 'parent', 'Parent FN', 'Parent MN', 'LN', 'Male', '2018-02-16', 'parent@gmail.com', '09227772283', 'Sample Address', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '2018-02-20 16:40:37.000000', '2018-02-20 16:40:37.000000', 'Active'),
(6, 7, 'sso', 'Student', 'Services', 'Officer', 'Male', '2018-03-02', 'jan.simbahon@gmail.com', '09271272203', 'Quezon City', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '2018-03-01 00:20:46.000000', '2018-03-01 00:20:46.000000', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`AuditID`);

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`ClearanceID`);

--
-- Indexes for table `clearancedetails`
--
ALTER TABLE `clearancedetails`
  ADD PRIMARY KEY (`ClearanceDetailsID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`EnrollmentID`);

--
-- Indexes for table `entranceexam`
--
ALTER TABLE `entranceexam`
  ADD PRIMARY KEY (`eeID`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`GradeID`);

--
-- Indexes for table `gradesubject`
--
ALTER TABLE `gradesubject`
  ADD PRIMARY KEY (`GradeSubjectID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`LevelID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`LogID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`ParentID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PostID`);

--
-- Indexes for table `posttype`
--
ALTER TABLE `posttype`
  ADD PRIMARY KEY (`PostTypeID`);

--
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
  ADD PRIMARY KEY (`SchoolYearID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`SectionID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SubjectID`);

--
-- Indexes for table `subjectgrade`
--
ALTER TABLE `subjectgrade`
  ADD PRIMARY KEY (`GradeSubjectID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TypeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `AuditID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `ClearanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clearancedetails`
--
ALTER TABLE `clearancedetails`
  MODIFY `ClearanceDetailsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entranceexam`
--
ALTER TABLE `entranceexam`
  MODIFY `eeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `GradeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradesubject`
--
ALTER TABLE `gradesubject`
  MODIFY `GradeSubjectID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `LevelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `ParentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posttype`
--
ALTER TABLE `posttype`
  MODIFY `PostTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `SchoolYearID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `SubjectID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjectgrade`
--
ALTER TABLE `subjectgrade`
  MODIFY `GradeSubjectID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
