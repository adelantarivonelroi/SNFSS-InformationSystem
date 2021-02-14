-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2018 at 02:57 AM
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
  `LogType` varchar(355) DEFAULT NULL,
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
  `ClearanceDescription` varchar(60) NOT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `DateCleared` date DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `DepartmentName`) VALUES
(1, 'Science'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `EnrollmentID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `EnrollmentStatus` varchar(20) NOT NULL,
  `DateEnroll` datetime(6) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `facultylist`
--

CREATE TABLE `facultylist` (
  `FacultyListID` int(11) NOT NULL,
  `SchoolYearID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SectionID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `TimeSlotID` int(11) NOT NULL,
  `DateCreated` date DEFAULT NULL,
  `DateApproved` date DEFAULT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackid` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `datesent` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `GenderID` int(11) NOT NULL,
  `GenderName` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`GenderID`, `GenderName`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `GradeID` int(11) NOT NULL,
  `StudentListID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `GradeStatusID` int(11) NOT NULL,
  `Grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradeaverage`
--

CREATE TABLE `gradeaverage` (
  `GradeAverageID` int(11) NOT NULL,
  `SchoolYearID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `GradeTypeID` int(11) NOT NULL,
  `Grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradestatus`
--

CREATE TABLE `gradestatus` (
  `GradeStatusID` int(11) NOT NULL,
  `GradeTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradestatus`
--

INSERT INTO `gradestatus` (`GradeStatusID`, `GradeTypeID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gradetype`
--

CREATE TABLE `gradetype` (
  `GradeTypeID` int(11) NOT NULL,
  `GradeTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradetype`
--

INSERT INTO `gradetype` (`GradeTypeID`, `GradeTypeName`) VALUES
(1, '1st Grading'),
(2, '2nd Grading'),
(3, '3rd Grading'),
(4, '4th Grading'),
(5, 'Final Grade'),
(6, 'Average Grade'),
(7, 'Entrance Exam Average Grade');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `LevelID` int(11) NOT NULL,
  `LevelName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`LevelID`, `LevelName`) VALUES
(1, 'Grade 1'),
(2, 'Grade 2'),
(3, ' Grade 3'),
(4, ' Grade 4'),
(5, 'Grade 5'),
(6, 'Grade 6'),
(7, 'Grade 7'),
(8, 'Grade 8'),
(9, 'Freshman'),
(10, 'Sophomore'),
(11, 'Junior'),
(12, 'Senior');

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
  `Image` varchar(1000) DEFAULT NULL,
  `Attachment` varchar(1000) DEFAULT NULL,
  `DateAdded` datetime(6) NOT NULL,
  `DateModified` datetime(6) DEFAULT NULL,
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
  `SchoolYearStart` int(11) NOT NULL,
  `SchoolYearEnd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`SchoolYearID`, `SchoolYearStart`, `SchoolYearEnd`) VALUES
(1, 2017, 2018),
(2, 2018, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `SectionID` int(11) NOT NULL,
  `SchoolYearID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SectionName` varchar(20) NOT NULL,
  `DateCreated` date NOT NULL,
  `DateApproved` date DEFAULT NULL,
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
-- Table structure for table `statusstudent`
--

CREATE TABLE `statusstudent` (
  `StatusStudentID` int(11) NOT NULL,
  `StatusName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statusstudent`
--

INSERT INTO `statusstudent` (`StatusStudentID`, `StatusName`) VALUES
(1, 'Old'),
(2, 'New'),
(3, 'Transferee');

-- --------------------------------------------------------

--
-- Table structure for table `studentlist`
--

CREATE TABLE `studentlist` (
  `StudentListID` int(11) NOT NULL,
  `SchoolYearID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SectionID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `DateCreated` date NOT NULL,
  `DateApproved` date NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `StatusStudentID` int(11) NOT NULL,
  `LevelID` int(10) NOT NULL,
  `FirstName` varchar(70) NOT NULL,
  `MiddleName` varchar(20) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Picture` varchar(1000) DEFAULT NULL,
  `GenderID` int(10) NOT NULL,
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
  `DateAdded` datetime(6) NOT NULL,
  `DateModified` datetime(6) DEFAULT NULL,
  `AssignStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectID` int(10) NOT NULL,
  `DepartmentID` int(10) DEFAULT NULL,
  `SubjectName` varchar(70) NOT NULL,
  `SubjectDescription` varchar(255) DEFAULT NULL,
  `DateApproved` date DEFAULT NULL,
  `DateCreated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectID`, `DepartmentID`, `SubjectName`, `SubjectDescription`, `DateApproved`, `DateCreated`) VALUES
(4, NULL, 'Filipino', NULL, NULL, NULL),
(5, NULL, 'English', NULL, NULL, NULL),
(6, NULL, 'Science', NULL, NULL, NULL),
(7, NULL, 'Araling Panlipunan', NULL, NULL, NULL),
(8, NULL, 'Edukasyon sa Pagpapakatao', NULL, NULL, NULL),
(9, NULL, 'Technology and Livelihood Education', NULL, NULL, NULL),
(10, NULL, 'Mathematics', NULL, NULL, NULL),
(11, NULL, 'MAPEH', NULL, NULL, NULL);

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
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TeacherID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TeacherID`, `UserID`, `SubjectID`) VALUES
(1, 4, 4),
(2, 8, 5),
(3, 9, 6),
(4, 10, 7),
(5, 11, 8),
(6, 12, 9),
(7, 13, 10),
(8, 14, 11);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `TimeSlotID` int(11) NOT NULL,
  `TimeCode` varchar(11) NOT NULL,
  `TimeForm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`TimeSlotID`, `TimeCode`, `TimeForm`) VALUES
(1, 'A', '7:10AM - 8:10AM'),
(2, 'B', '8:10AM - 9:10AM'),
(3, 'C', '9:30AM - 10:15AM'),
(4, 'D', '10:15AM - 11:15AM'),
(5, 'E', '11:15AM - 12:15AM'),
(6, 'F', '1:15PM - 2:15PM'),
(7, 'G', '2:15PM - 3:15PM'),
(8, 'H', '3:15PM - 4:20PM');

-- --------------------------------------------------------

--
-- Table structure for table `trigger`
--

CREATE TABLE `trigger` (
  `TriggerID` int(11) NOT NULL,
  `TriggerTypeID` int(11) NOT NULL,
  `TriggerValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trigger`
--

INSERT INTO `trigger` (`TriggerID`, `TriggerTypeID`, `TriggerValue`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `triggertype`
--

CREATE TABLE `triggertype` (
  `TriggerTypeID` int(11) NOT NULL,
  `TriggerName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `triggertype`
--

INSERT INTO `triggertype` (`TriggerTypeID`, `TriggerName`) VALUES
(1, 'Encode Grade'),
(2, 'Post Grade Parent'),
(3, 'Encode Lock');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `TypeID` int(11) NOT NULL,
  `TypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TypeID`, `TypeName`) VALUES
(1, 'Principal'),
(2, 'Department Head'),
(3, 'Parents'),
(4, 'Faculty'),
(5, 'Student Services Officer'),
(6, 'Registrar'),
(7, 'IT Personnel');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `FirstName` varchar(70) DEFAULT NULL,
  `MiddleName` varchar(20) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Gender` varchar(7) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `ContactNo` varchar(15) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `DateAdded` datetime(6) NOT NULL,
  `DateModified` datetime(6) DEFAULT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `TypeID`, `UserName`, `FirstName`, `MiddleName`, `LastName`, `Gender`, `Birthday`, `Email`, `ContactNo`, `Address`, `Password`, `DateAdded`, `DateModified`, `Status`) VALUES
(1, 7, 'itpersonnel', 'Elroi', 'A.', 'Adelantar', 'Male', '1990-07-23', 'jan.simbahon@gmail.com', '09258931234', '132 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:37:31.000000', '2018-03-16 09:37:31.000000', 'Active'),
(2, 1, 'principal', 'Kyle', 'F.', 'David', 'Male', '0000-00-00', 'jan.simbahon@gmail.com', '09123214213', '132 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:39:44.000000', '2018-03-16 09:39:44.000000', 'Active'),
(3, 2, 'departmenthead', 'Jon Kenneth', 'R.', 'Que', 'Male', '1997-01-03', 'jan.simbahon@gmail.com', '09128293847', '132 NewStreet, New Subdivision, New Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:40:46.000000', '2018-03-16 09:40:46.000000', 'Active'),
(4, 4, 'faculty', 'Jan', 'S.', 'Simbahon', 'Male', '1998-02-08', 'jan.simbahon@gmail.com', '09273812344', '500 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:41:57.000000', '2018-03-16 09:41:57.000000', 'Active'),
(5, 5, 'studentservicesofficer', 'Elroi', 'A.', 'Adelantar', 'Male', '1998-07-02', 'jan.simbahon@gmail.com', '0928391234', '132 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:43:04.000000', '2018-03-16 09:43:04.000000', 'Active'),
(6, 6, 'registrar', 'Kyle', 'K.', 'David', 'Male', '1998-03-04', 'jan.simbahon@gmail.com', '09871234231', '222 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:44:25.000000', '2018-03-16 09:44:25.000000', 'Active'),
(7, 1, 'faculty1', 'Jon Kenneth', 'R.', 'Que', 'Male', '1998-02-03', 'jan.simbahon@gmail.com', '09872736543', '123 NewStreet, New Subdivision, New Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:45:48.000000', '2018-03-16 09:45:48.000000', 'Active'),
(8, 4, 'faculty2', 'Jan', 'L.', 'Simbahon', 'Male', '1998-02-07', 'jan.simbahon@gmail.com', '09876542345', '500 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:46:33.000000', '2018-03-16 09:46:33.000000', 'Active'),
(9, 4, 'faculty3', 'Jan', 'S.', 'Simbahon', 'Male', '1990-02-02', 'jan.simbahon@gmail.com', '09273871234', '88 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:50:58.000000', '2018-03-16 09:50:58.000000', 'Active'),
(10, 4, 'faculty4', 'Elroi', 'A.', 'Adelantar', 'Male', '1990-08-08', 'jan.simbahon@gmail.com', '09675432123', '132 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:52:04.000000', '2018-03-16 09:52:04.000000', 'Active'),
(11, 4, 'faculty5', 'Kyle', 'K.', 'David', 'Male', '1998-06-06', 'jan.simbahon@gmail.com', '09253647123', '982 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:53:07.000000', '2018-03-16 09:53:07.000000', 'Active'),
(12, 4, 'faculty6', 'Jon Kenneth', 'R.', 'Que', 'Male', '1998-04-23', 'jan.simbahon@gmail.com', '09827364563', '500 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:54:25.000000', '2018-03-16 09:54:25.000000', 'Active'),
(13, 4, 'faculty7', 'Jan ', 'J.', 'Simbahon', 'Male', '1998-06-06', 'jan.simbahon@gmail.com', '0978625364', '111 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:56:28.000000', '2018-03-16 09:56:28.000000', 'Active'),
(14, 4, 'faculty8', 'Elroi', 'A.', 'Adelantar', 'Male', '1997-02-03', 'jan.simbahon@gmail.com', '09772341234', '888 Test Street, Test Subdivision, Test Municipality, Batangas', '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:57:30.000000', '2018-03-16 09:57:30.000000', 'Active');

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
-- Indexes for table `facultylist`
--
ALTER TABLE `facultylist`
  ADD PRIMARY KEY (`FacultyListID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackid`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`GradeID`);

--
-- Indexes for table `gradeaverage`
--
ALTER TABLE `gradeaverage`
  ADD PRIMARY KEY (`GradeAverageID`);

--
-- Indexes for table `gradestatus`
--
ALTER TABLE `gradestatus`
  ADD PRIMARY KEY (`GradeStatusID`);

--
-- Indexes for table `gradetype`
--
ALTER TABLE `gradetype`
  ADD PRIMARY KEY (`GradeTypeID`);

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
-- Indexes for table `studentlist`
--
ALTER TABLE `studentlist`
  ADD PRIMARY KEY (`StudentListID`);

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
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TeacherID`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`TimeSlotID`);

--
-- Indexes for table `trigger`
--
ALTER TABLE `trigger`
  ADD PRIMARY KEY (`TriggerID`);

--
-- Indexes for table `triggertype`
--
ALTER TABLE `triggertype`
  ADD PRIMARY KEY (`TriggerTypeID`);

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
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entranceexam`
--
ALTER TABLE `entranceexam`
  MODIFY `eeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facultylist`
--
ALTER TABLE `facultylist`
  MODIFY `FacultyListID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `GradeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradeaverage`
--
ALTER TABLE `gradeaverage`
  MODIFY `GradeAverageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradestatus`
--
ALTER TABLE `gradestatus`
  MODIFY `GradeStatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gradetype`
--
ALTER TABLE `gradetype`
  MODIFY `GradeTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `LevelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `SchoolYearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `studentlist`
--
ALTER TABLE `studentlist`
  MODIFY `StudentListID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `SubjectID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjectgrade`
--
ALTER TABLE `subjectgrade`
  MODIFY `GradeSubjectID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `TimeSlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trigger`
--
ALTER TABLE `trigger`
  MODIFY `TriggerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `triggertype`
--
ALTER TABLE `triggertype`
  MODIFY `TriggerTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
