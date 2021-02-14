-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 04:02 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `AddressID` int(11) NOT NULL,
  `Street` varchar(500) NOT NULL,
  `Barangay` varchar(500) NOT NULL,
  `CityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`AddressID`, `Street`, `Barangay`, `CityID`) VALUES
(1, 'OWR6ZkxpemlGdGNGZVNWQmM4d3NIQT09OjrljLh0OuI1quNEvlpYnmtK', 'bXlER1owL1FhelROMTEzemVEK2IrQT09OjqLtQVswm8PKak5a6221za7', 1),
(2, 'V3NlVEw3T2VsUEZTMmRTTFZqbWxlZz09Ojr4VP2F7zdQRQqCxBIIZ6Gk', 'UUJkNC9VUDE5bUJXK2IrL2tlUmZPUT09OjoK/QmpPCEYzLprZ1Pj1iQO', 8),
(3, 'TFFsVm9GWDQreHlwU0JCQ2tQV2JxUT09Ojp+AlQgqjmUlawobJb7YcXm', 'bFRKdlVNdXFjOXN1N2dJNk9HV1pMQT09OjqOfUMesl8Efb/wrIHa4Yup', 3),
(4, 'bDNqTldYdHYvRmN2UVVWM09lR3hmZz09OjoKvfeYJjbIIrDGJ1wrCsFA', 'UVFFa1JjdlludUZucmlwRDViazRmdz09OjrtG+HZUODwZvcjO06QJrxa', 17),
(5, 'R3hRcHM3U1RWT3Bwck1pSlFsaElxZz09Ojqx9tKwv1HQx9i35gLEOnc7', 'NzJJbm5IYVVXY0cxUTdDc0FqM3Qwdz09OjrW+GLS5nxdn29JeeaKW9z1', 3),
(6, 'bWs1Y0c4anZLZXoxRG8xN2NFaFVlUT09Ojo253JjF8CcrVeiQKVOFU5h', 'Uy80Vk12dHFsUjRSdHhuNS9ISC8xdz09OjrGCUeGzqctxd19JVmPeXJ6', 17),
(7, 'ajdObW91RXNid3liSDR3YndSeHhndz09OjouNxIu36VIzu2Mivrn4vcH', 'R2NNU2V0NlJwYWVUTVBQdkYrT1V5dz09Ojqf59NEmjarDXII32iKt70v', 4),
(8, 'Nm1keUVOSmpwalJhZXcvSnVBOU16UT09Ojokr7yagVGIThOJCAiBlGED', 'U25UdTl4ajR3ZlRicVBQSlVhSkJpUT09OjoAmrxoo6QnjAIYm0KIBw9U', 8),
(9, 'cFEyS21XQUdQWEM0dEpsQUdtN2ljQT09Ojpv3BRepKFbhH6VGhvTnhtU', 'YTUzTXhyc1lWc2plUTlzTkpaYUdWdz09OjpFltIM5WvHZzKM5O5aO7lY', 16),
(10, 'SlhKTDBDY3pGV0Q4RlRaWm0rMmpEZz09Ojq3IT/7CPyQBJXuRAf16IBg', 'OENkT04vZGc2UnpYN3RQb0sxWDJadz09OjrXZ0Ej+ZSrJREwnav0S6ay', 16),
(11, 'bTNtZUZyS1Y3dkJla2VPSUtkdHNIQT09OjqM24rZqaMhYpPLkLFBxW6d', 'MUFFMkNwa1NkU2Q4OUZuZU1hWkp1dz09Ojp/Btueky6N+WeI+MK7tJ0n', 16),
(12, 'cG5HNUJOdTJVZU5FZmlpL1kwU00xdz09Ojr4hna0+wQKvSKdWoOzi/3i', 'UytxSEdPMlpHanZ5U21UUmVVMjhHQT09OjrQppD7ey4TRJZN/NeECYa1', 10),
(13, 'LytWNzRCSzF6eDVuSVBhL3NtS1dYQT09OjqnXZEHatudjpoHT9G6XZbS', 'NmI1R1NzUDVaMjJtNFhYcG9CQ0NFUT09Ojqev6XBTjEqoAB7SEBGpWak', 2),
(14, 'VURNeGFLbFB2cDRRazVIMW5IRmRiQT09Ojp268xrm1pnFTT+71gtnZnD', 'aDN2dXdqM3BYRSs3bUFEYm1zREFhdz09OjouvkuwicUNSfT9Iat9aXhV', 2),
(15, 'bGkxUkZuRWh3RFUzbXI4RG5KZkhiZz09Ojq2+cQE5CGaE0+DlNYyE19N', 'T1ZKTlJiUWxOMkZmWk9JcXFGSW5UQT09OjosZ/zx363hL8Rzs+Xh3IRw', 5),
(16, 'NlVydFBEUzg0N2gwOWF1UTVTQ3lqUT09Ojo/AJ3lciXw/72OlfwuVoSc', 'NThsUjdKTG5KclJPSG9TWmcyRmhuUT09Ojr68v/wx7tY5Yh0LJ7VQ87n', 5),
(17, 'WGpqZjJYYzdpRUZVMzkzY0dXVFYwZz09OjrO2p4EuE2//5tes4sOtHpE', 'T1pyd2NNZWRDZGlLRXVYVGxLYlp0dz09OjpcRlDlehsMn+pkcV7gJ6aR', 10),
(18, 'RWk5QUtlZElGc2RpQ0tnbklWUmhxQT09OjohZgzdD2aQ+P3xZr/uq3Rh', 'UFJpTi9IQjZRUW9TdlVrdHdJYy8rZz09Ojoi2OxOPOHU8FrB/z/rLvri', 8),
(19, 'SzVVSC94MGJFU2dxeHRJaThhSTlNQT09OjpfAGtQK6htMh0Lq93MQ1lx', 'L0tVQUVnaXg3YWpKZk9mNmY1T2EyUT09Ojor5LIgGNv5T8XE5CRmOlAJ', 8),
(20, 'YlBBbUNXUVEvczlTSk1xMnJucnlQQT09OjoHvaQaNO0DTnT4N8Zs3pHO', 'clEvYk5zSlB5b1IxdEs5ekdHeXhuZz09OjoowRtblH7QY5HSiHKsoKaU', 8),
(21, 'WWVKb3JFbHJqYndmRVp6UHViekxxZz09OjrmWFAsLdKKfrf8xQfTOcs7', 'b2l1eHY4S2s5N20zbTNkNFVLeXkyUT09Ojqfwbp72MVhg0pdFbei0DAs', 8),
(22, 'eVNDL0FVdWZ2VmhSeG5FdHJuZXJ2Zz09OjoKxCP1ea/ppMfm6Ove6pd0', 'b1NmNFhRVmZBNVBWQVduYWo3OXZ5QT09OjphsjC6FfhqpyS3MG/duEMW', 3),
(23, 'NmZoRThTdWNydEJzSUNnejNFR0ZXZz09OjrYnsRqcRCNKxAAPkgIfvpK', 'S1dZbVV6UkN4ajFFTElEenMxamlkUT09OjqhuuZhWjwG9la3b2ap8OXm', 3),
(24, 'ck5lSW1kTUtPYU00WkptcmszQ056Zz09Ojow1DZwh5KdcSx0Ymi0NnDR', 'TWd3NXdGR3gvYUh3VTExeXA0NWtJUT09OjqMNF5sPeJfiHJH5cmZPB3p', 3),
(25, 'aThYOEtNTTZTWVdaaDBhNDg0ZXN2QT09Ojo8N5JSA3lIqs2Tdm61EPB9', 'dG16STBGZHEyWnhIU2tzOGZiYVNPZz09OjqUHpZlGqH/A8DKK0gNm11D', 3);

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

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`AuditID`, `UserID`, `LogType`, `Description`, `LogDate`) VALUES
(1, 6, NULL, 'Added a student record with the id 1', '2018-04-08 14:24:16.000000'),
(2, 6, NULL, 'Viewed student record of student id 1', '2018-04-08 16:41:50.000000'),
(3, 6, NULL, 'Viewed student record of student id 1', '2018-04-08 16:47:14.000000'),
(4, 6, NULL, 'Added a student record with the id 1', '2018-04-09 09:38:59.000000'),
(5, 6, NULL, 'Added a student record with the id 2', '2018-04-09 09:48:30.000000'),
(6, 6, NULL, 'Updated enrollment status of student id 1, Not Enr', '2018-04-09 10:37:51.000000'),
(7, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:37:55.000000'),
(8, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:37:59.000000'),
(9, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:38:02.000000'),
(10, 6, NULL, 'Updated enrollment status of student id 1, Not Enr', '2018-04-09 10:39:57.000000'),
(11, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:40:01.000000'),
(12, 6, NULL, 'Updated enrollment status of student id 1, Not Enr', '2018-04-09 10:40:02.000000'),
(13, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:40:06.000000'),
(14, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:40:09.000000'),
(15, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:40:12.000000'),
(16, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:40:18.000000'),
(17, 6, NULL, 'Updated type of the student id 1, 2', '2018-04-09 10:40:41.000000'),
(18, 6, NULL, 'Updated type of the student id 1, 2', '2018-04-09 10:42:11.000000'),
(19, 6, NULL, 'Updated type of the student id 1, 3', '2018-04-09 10:42:14.000000'),
(20, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:42:21.000000'),
(21, 6, NULL, 'Updated type of the student id 1, 2', '2018-04-09 10:47:17.000000'),
(22, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:47:22.000000'),
(23, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:51:27.000000'),
(24, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:51:31.000000'),
(25, 6, NULL, 'Updated enrollment status of student id 1, Not Enr', '2018-04-09 10:55:56.000000'),
(26, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 10:56:01.000000'),
(27, 6, NULL, 'Viewed student record of student id 1', '2018-04-09 10:57:16.000000'),
(28, 6, NULL, 'Updated enrollment status of student id 1, Not Enr', '2018-04-09 11:16:10.000000'),
(29, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 11:17:20.000000'),
(30, 6, NULL, 'Updated enrollment status of student id 1, Not Enr', '2018-04-09 11:17:23.000000'),
(31, 6, NULL, 'Updated enrollment status of student id 1, Enrolle', '2018-04-09 11:17:33.000000'),
(32, 6, NULL, 'added a new school year 2019 - 2020', '2018-04-09 11:58:31.000000'),
(33, 6, NULL, 'added a new school year 2019 - 2020', '2018-04-09 11:59:25.000000'),
(34, 6, NULL, 'added a new school year 2021 - 2022', '2018-04-09 12:00:16.000000'),
(35, 6, NULL, 'added a new school year 2021 - 2022', '2018-04-09 12:00:46.000000'),
(36, 6, NULL, 'added a new school year 2021 - 2022', '2018-04-09 12:02:31.000000'),
(37, 6, NULL, 'added a new school year 2018 - 2019', '2018-04-09 12:05:20.000000'),
(38, 6, NULL, 'Viewed student record of student id 1', '2018-04-09 12:38:11.000000'),
(39, 6, NULL, 'added a new school year 2018 - 2019', '2018-04-09 13:55:17.000000'),
(40, 6, NULL, 'added a new school year 2019 - 2022', '2018-04-09 13:55:23.000000'),
(41, 6, NULL, 'added a new school year 2018 - 2019', '2018-04-09 13:55:31.000000'),
(42, 6, NULL, 'Updated grade encoding status 1', '2018-04-09 14:51:11.000000'),
(43, 6, NULL, 'Updated grade encoding status 1', '2018-04-09 14:58:25.000000'),
(44, 6, NULL, 'Updated grade encoding status 1', '2018-04-09 14:58:35.000000'),
(45, 6, NULL, 'Updated grade encoding status 1', '2018-04-09 15:02:03.000000'),
(46, 6, NULL, 'Updated grade encoding status 0', '2018-04-09 15:27:19.000000'),
(47, 6, NULL, 'Updated grade encoding status 0', '2018-04-09 15:27:22.000000'),
(48, 6, NULL, 'Added a student record with the id 4', '2018-04-09 19:06:34.000000'),
(49, 6, NULL, 'Added a student record with the id 8', '2018-04-09 19:21:11.000000'),
(50, 6, NULL, 'Viewed student record of student id 1', '2018-04-09 19:23:34.000000'),
(51, 6, NULL, 'Viewed student record of student id 8', '2018-04-09 19:23:42.000000'),
(52, 6, NULL, 'Added a student record with the id 12', '2018-04-09 19:55:58.000000'),
(53, 6, NULL, 'Added a student record with the id 13', '2018-04-09 19:57:32.000000'),
(54, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:11:01.000000'),
(55, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:11:30.000000'),
(56, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:11:34.000000'),
(57, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:11:38.000000'),
(58, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:14:34.000000'),
(59, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:14:39.000000'),
(60, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:15:39.000000'),
(61, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:16:34.000000'),
(62, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:17:02.000000'),
(63, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:17:04.000000'),
(64, 6, NULL, 'Updated clearance status of student id 4 to ', '2018-04-11 10:23:39.000000'),
(65, 6, NULL, 'Created clearance record for student id 4', '2018-04-11 10:24:22.000000'),
(66, 6, NULL, 'Created clearance record for student id 1', '2018-04-11 10:36:50.000000'),
(67, 6, NULL, 'Added a student record with the id 18', '2018-04-11 23:53:30.000000'),
(68, 6, NULL, 'Added a student record with the id 19', '2018-04-11 23:57:20.000000'),
(69, 6, NULL, 'Added a student record with the id 20', '2018-04-11 23:57:31.000000'),
(70, 6, NULL, 'Added a student record with the id 21', '2018-04-11 23:58:35.000000'),
(71, 6, NULL, 'Added a student record with the id 22', '2018-04-12 00:26:24.000000'),
(72, 6, NULL, 'Added a student record with the id 23', '2018-04-12 00:26:36.000000'),
(73, 6, NULL, 'Added a student record with the id 24', '2018-04-12 00:26:49.000000'),
(74, 6, NULL, 'Added a student record with the id 25', '2018-04-12 00:26:58.000000');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `CityID` int(11) NOT NULL,
  `CityName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityID`, `CityName`) VALUES
(1, 'Batangas City'),
(2, 'Lipa City'),
(3, 'Tanauan City'),
(4, 'Bacoor City'),
(5, 'Cavite City'),
(6, 'Dasmarinas City'),
(7, 'Imus City'),
(8, 'Tagaytay City'),
(9, 'Trece Martires City'),
(10, 'Binan City'),
(11, 'Cabuyao city'),
(12, 'San Pablo City'),
(13, 'Santa Rosa City'),
(14, 'Lucena City'),
(15, 'Tayabas City'),
(16, 'Antipolo City'),
(17, 'Calamba City');

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `ClearanceID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ClearanceStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`ClearanceID`, `StudentID`, `ClearanceStatus`) VALUES
(1, 1, 'Cleared'),
(3, 2, 'Cleared'),
(4, 4, ''),
(5, 8, 'Cleared'),
(6, 12, 'Cleared'),
(7, 13, 'Cleared'),
(8, 20, 'Cleared'),
(9, 21, 'Cleared'),
(10, 22, 'Cleared'),
(11, 23, 'Cleared'),
(12, 24, 'Cleared'),
(13, 25, 'Cleared');

-- --------------------------------------------------------

--
-- Table structure for table `clearancedetails`
--

CREATE TABLE `clearancedetails` (
  `ClearanceDetailsID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ClearanceDescription` varchar(60) NOT NULL,
  `DateCleared` date DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clearancedetails`
--

INSERT INTO `clearancedetails` (`ClearanceDetailsID`, `StudentID`, `ClearanceDescription`, `DateCleared`, `Status`) VALUES
(2, 4, 'Placeholder Clearance 1', NULL, 'Pending'),
(3, 4, 'Placeholder Clearance 2', NULL, 'Pending'),
(4, 4, 'Placeholder Clearance 3', NULL, 'Pending'),
(5, 4, 'Placeholder Clearance 4', NULL, 'Pending'),
(6, 4, 'Placeholder Clearance 5', NULL, 'Pending'),
(7, 1, 'Placeholder Clearance 1', '2018-04-11', 'Cleared'),
(8, 1, 'Placeholder Clearance 2', '2018-04-11', 'Cleared'),
(9, 1, 'Placeholder Clearance 3', '2018-04-11', 'Cleared'),
(10, 1, 'Placeholder Clearance 4', '2018-04-11', 'Cleared'),
(11, 1, 'Placeholder Clearance 5', '2018-04-11', 'Cleared');

-- --------------------------------------------------------

--
-- Table structure for table `clearancename`
--

CREATE TABLE `clearancename` (
  `ClearanceNameID` int(11) NOT NULL,
  `ClearanceName` varchar(150) NOT NULL
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
  `EnrollmentTypeID` int(11) NOT NULL,
  `DateEnroll` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`EnrollmentID`, `StudentID`, `EnrollmentStatus`, `EnrollmentTypeID`, `DateEnroll`) VALUES
(25, 1, 'Not Enrolled', 1, '2018-04-09'),
(26, 4, 'Enrolled', 1, '2018-01-01'),
(27, 8, 'Enrolled', 1, '2019-01-01'),
(28, 12, 'Enrolled', 1, '2018-01-01'),
(29, 13, 'Enrolled', 1, '1999-01-01'),
(30, 18, 'Enrolled', 2, '2018-01-01'),
(31, 19, 'Enrolled', 2, '2018-01-01'),
(32, 20, 'Enrolled', 2, '2018-01-01'),
(33, 21, 'Enrolled', 2, '2018-01-01'),
(34, 22, 'Enrolled', 2, '2018-01-01'),
(35, 23, 'Enrolled', 2, '2018-01-01'),
(36, 24, 'Enrolled', 2, '2018-01-01'),
(37, 25, 'Enrolled', 2, '2018-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `enrollmenttype`
--

CREATE TABLE `enrollmenttype` (
  `EnrollmentTypeID` int(11) NOT NULL,
  `EnrollmentTypeName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollmenttype`
--

INSERT INTO `enrollmenttype` (`EnrollmentTypeID`, `EnrollmentTypeName`) VALUES
(1, 'Regular Enrollment'),
(2, 'Summer Enrollment');

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
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `MessageID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `MessageDesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageID`, `UserID`, `MessageDesc`) VALUES
(2, 6, '4/19/2018 - 4/30/2018'),
(3, 6, '4/19/2018 - 4/35/2018');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `ParentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`ParentID`, `UserID`, `StudentID`) VALUES
(1, 15, 1),
(2, 19, 1),
(3, 20, 2),
(4, 21, 4),
(5, 22, 8),
(6, 23, 12),
(7, 24, 20),
(8, 25, 21),
(9, 26, 22),
(10, 27, 23),
(11, 28, 24),
(12, 29, 25);

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
(2, 2018, 2019),
(3, 2019, 2020),
(4, 2019, 2020),
(5, 2021, 2022),
(6, 2021, 2022),
(7, 2021, 2022),
(8, 2018, 2019),
(9, 2018, 2019),
(10, 2019, 2022),
(11, 2018, 2019);

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

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`SectionID`, `SchoolYearID`, `LevelID`, `SectionName`, `DateCreated`, `DateApproved`, `SectionStatus`) VALUES
(1, 11, 5, '4', '2018-03-07', '2018-04-12', 'Approved'),
(2, 11, 5, '5', '2018-03-07', '2018-04-10', 'Approved'),
(3, 11, 6, '1', '2018-04-10', '2018-04-11', 'Approved');

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
  `DateCreated` date DEFAULT NULL,
  `DateApproved` date DEFAULT NULL,
  `Status` varchar(50) NOT NULL,
  `ArchiveReason` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentlist`
--

INSERT INTO `studentlist` (`StudentListID`, `SchoolYearID`, `LevelID`, `SectionID`, `StudentID`, `DateCreated`, `DateApproved`, `Status`, `ArchiveReason`) VALUES
(1, 11, 5, 1, 1, '2018-04-11', '2018-04-11', 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `StatusStudentID` int(11) NOT NULL,
  `StudentTypeID` int(11) NOT NULL,
  `LevelID` int(10) NOT NULL,
  `FirstName` varchar(70) NOT NULL,
  `MiddleName` varchar(20) DEFAULT NULL,
  `LastName` varchar(50) NOT NULL,
  `Picture` varchar(1000) DEFAULT NULL,
  `GenderID` int(10) NOT NULL,
  `Birthday` date NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `ContactNo` varchar(15) DEFAULT NULL,
  `AddressID` int(100) NOT NULL,
  `MotherFirstName` varchar(70) DEFAULT NULL,
  `MotherLastName` varchar(50) DEFAULT NULL,
  `MotherOccupation` varchar(100) DEFAULT NULL,
  `FatherFirstName` varchar(70) DEFAULT NULL,
  `FatherLastName` varchar(50) DEFAULT NULL,
  `FatherOccupation` varchar(100) DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `DateModified` date DEFAULT NULL,
  `AssignStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `StatusStudentID`, `StudentTypeID`, `LevelID`, `FirstName`, `MiddleName`, `LastName`, `Picture`, `GenderID`, `Birthday`, `Email`, `ContactNo`, `AddressID`, `MotherFirstName`, `MotherLastName`, `MotherOccupation`, `FatherFirstName`, `FatherLastName`, `FatherOccupation`, `DateAdded`, `DateModified`, `AssignStatus`) VALUES
(1, 2, 2, 5, 'James', '', 'Dean', '20180409033859-', 1, '1998-01-01', 'james.dean@yahoo.com', '09231231243', 5, 'Unknown ', 'Unknown ', 'Housewife', 'Unknown ', 'Unknown ', 'Businessman', '2018-04-09', NULL, 'Unassigned'),
(2, 2, 2, 0, 'Thomas', 'Lee', '', '2', 1998, '0000-00-00', '9271272203', 'Quezon City', 0, 'Mom', 'Mom', 'Dad', 'Dad', 'Dad', '2018-09-04', '0000-00-00', '0000-00-00', ''),
(4, 1, 1, 1, 'Mickey', '', 'Mouse', '20180409130634-', 1, '1997-01-01', '', '', 8, '', '', '', '', '', '', '2018-04-09', NULL, 'Unassigned'),
(12, 1, 1, 2, 'Torredo', '', 'Dean', '20180409135558-', 1, '1998-01-01', '', '', 172, '', '', '', '', '', '', '2018-04-09', NULL, 'Unassigned'),
(13, 1, 1, 9, 'SUTDENT', '', 'Mouse', '20180409135732-', 1, '1998-01-01', '', '', 17, '', '', '', '', '', '', '2018-04-09', NULL, 'Unassigned'),
(16, 2, 2, 2, 'James', 'Thomas', 'Lee', '', 2, '1998-09-01', 'tryemail@mailinator.com', '9271272203', 0, 'Mom', 'Mom', 'Mom', 'Dad', 'Dad', 'Dad', '2018-09-04', '0000-00-00', 'Unassigned'),
(17, 2, 2, 2, 'James', 'Thomas', 'Lee', '', 2, '1998-09-01', 'tryemail@mailinator.com', '9271272203', 0, 'Mom', 'Mom', 'Mom', 'Dad', 'Dad', 'Dad', '2018-09-04', '0000-00-00', 'Unassigned'),
(18, 2, 1, 1, 'Master', '', 'Mouse', '20180411175330-', 1, '1999-01-01', '', '', 18, '', '', '', '', '', '', '2018-04-11', NULL, 'Unassigned'),
(19, 2, 1, 1, 'Master', '', 'Mouse', '20180411175720-', 1, '1999-01-01', '', '', 19, '', '', '', '', '', '', '2018-04-11', NULL, 'Unassigned'),
(20, 2, 1, 1, 'Master', '', 'Mouse', '20180411175731-', 1, '1999-01-01', '', '', 20, '', '', '', '', '', '', '2018-04-11', NULL, 'Unassigned'),
(21, 2, 1, 1, 'Master', '', 'Mouse', '20180411175835-', 1, '1999-01-01', '', '', 21, '', '', '', '', '', '', '2018-04-11', NULL, 'Unassigned'),
(22, 2, 1, 1, 'Daster', '', 'Maxter', '20180411182624-', 1, '1997-01-01', '', '', 22, '', '', '', '', '', '', '2018-04-12', NULL, 'Assigned'),
(23, 2, 1, 1, 'Blake', '', 'Maxter', '20180411182636-', 1, '1997-01-01', '', '', 23, '', '', '', '', '', '', '2018-04-12', NULL, 'Unassigned'),
(24, 2, 1, 1, 'Dudeperf', '', 'Maxter', '20180411182648-', 1, '1997-01-01', '', '', 24, '', '', '', '', '', '', '2018-04-12', NULL, 'Unassigned'),
(25, 2, 1, 1, 'Ahhell', '', 'Maxter', '20180411182658-', 1, '1997-01-01', '', '', 25, '', '', '', '', '', '', '2018-04-12', NULL, 'Unassigned');

-- --------------------------------------------------------

--
-- Table structure for table `studenttype`
--

CREATE TABLE `studenttype` (
  `StudentTypeID` int(11) NOT NULL,
  `StudentTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studenttype`
--

INSERT INTO `studenttype` (`StudentTypeID`, `StudentTypeName`) VALUES
(1, 'Regular'),
(2, 'Scholar'),
(3, 'Athlete');

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
-- Table structure for table `summerfacultylist`
--

CREATE TABLE `summerfacultylist` (
  `SummerFacultyListID` int(11) NOT NULL,
  `SchoolYearID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SummerSectionID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `DateCreated` date DEFAULT NULL,
  `DateApproved` date DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summerfacultylist`
--

INSERT INTO `summerfacultylist` (`SummerFacultyListID`, `SchoolYearID`, `LevelID`, `SummerSectionID`, `TeacherID`, `DateCreated`, `DateApproved`, `Status`) VALUES
(2, 11, 1, 8, 2, '2018-04-12', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `summersection`
--

CREATE TABLE `summersection` (
  `SummerSectionID` int(11) NOT NULL,
  `SchoolYearID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `SectionName` varchar(50) NOT NULL,
  `DateCreated` date NOT NULL,
  `DateApproved` date DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summersection`
--

INSERT INTO `summersection` (`SummerSectionID`, `SchoolYearID`, `LevelID`, `SubjectID`, `SectionName`, `DateCreated`, `DateApproved`, `Status`) VALUES
(7, 11, 1, 4, '1', '2018-04-12', '2018-04-12', 'Disapproved'),
(8, 11, 1, 5, '1', '2018-04-12', '2018-04-12', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `summerstudent`
--

CREATE TABLE `summerstudent` (
  `SummeSectionID` int(11) NOT NULL,
  `EnrollmentID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summerstudent`
--

INSERT INTO `summerstudent` (`SummeSectionID`, `EnrollmentID`, `LevelID`, `SubjectID`) VALUES
(1, 33, 1, 4),
(4, 34, 1, 5),
(5, 35, 1, 6),
(6, 36, 1, 4),
(7, 37, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `summerstudentlist`
--

CREATE TABLE `summerstudentlist` (
  `SummerStudentListID` int(11) NOT NULL,
  `SchoolYearID` int(11) NOT NULL,
  `LevelID` int(11) NOT NULL,
  `SummerSectionID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `DateCreated` date DEFAULT NULL,
  `DateApproved` date DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summerstudentlist`
--

INSERT INTO `summerstudentlist` (`SummerStudentListID`, `SchoolYearID`, `LevelID`, `SummerSectionID`, `StudentID`, `DateCreated`, `DateApproved`, `Status`) VALUES
(8, 11, 1, 8, 22, '2018-04-12', NULL, 'Pending');

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
(1, 1, 1),
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
  `FirstName` varchar(70) NOT NULL,
  `MiddleName` varchar(20) DEFAULT NULL,
  `LastName` varchar(50) NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `Birthday` date NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `ContactNo` varchar(15) DEFAULT NULL,
  `AddressID` int(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DateAdded` datetime(6) NOT NULL,
  `DateModified` datetime(6) DEFAULT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `TypeID`, `UserName`, `FirstName`, `MiddleName`, `LastName`, `Gender`, `Birthday`, `Email`, `ContactNo`, `AddressID`, `Password`, `DateAdded`, `DateModified`, `Status`) VALUES
(1, 7, 'itpersonnel', 'Elroi', 'A.', 'Adelantar', 'Male', '1990-07-23', 'jan.simbahon@gmail.com', '09258931234', 132, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:37:31.000000', '2018-03-16 09:37:31.000000', 'Active'),
(2, 1, 'principal', 'Kyle', 'F.', 'David', 'Male', '0000-00-00', 'jan.simbahon@gmail.com', '09123214213', 132, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:39:44.000000', '2018-03-16 09:39:44.000000', 'Active'),
(3, 2, 'departmenthead', 'Jon Kenneth', 'R.', 'Que', 'Male', '1997-01-03', 'jan.simbahon@gmail.com', '09128293847', 132, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:40:46.000000', '2018-03-16 09:40:46.000000', 'Active'),
(4, 4, 'faculty', 'Jan', 'S.', 'Simbahon', 'Male', '1998-02-08', 'jan.simbahon@gmail.com', '09273812344', 500, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:41:57.000000', '2018-03-16 09:41:57.000000', 'Active'),
(5, 5, 'studentservicesofficer', 'Elroi', 'A.', 'Adelantar', 'Male', '1998-07-02', 'jan.simbahon@gmail.com', '0928391234', 132, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:43:04.000000', '2018-03-16 09:43:04.000000', 'Active'),
(6, 6, 'registrar', 'Kyle', 'K.', 'David', 'Male', '1998-03-04', 'jan.simbahon@gmail.com', '09871234231', 222, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:44:25.000000', '2018-03-16 09:44:25.000000', 'Active'),
(7, 1, 'faculty1', 'Jon Kenneth', 'R.', 'Que', 'Male', '1998-02-03', 'jan.simbahon@gmail.com', '09872736543', 123, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:45:48.000000', '2018-03-16 09:45:48.000000', 'Active'),
(8, 4, 'faculty2', 'Jan', 'L.', 'Simbahon', 'Male', '1998-02-07', 'jan.simbahon@gmail.com', '09876542345', 500, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:46:33.000000', '2018-03-16 09:46:33.000000', 'Active'),
(9, 4, 'faculty3', 'Jan', 'S.', 'Simbahon', 'Male', '1990-02-02', 'jan.simbahon@gmail.com', '09273871234', 88, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:50:58.000000', '2018-03-16 09:50:58.000000', 'Active'),
(10, 4, 'faculty4', 'Elroi', 'A.', 'Adelantar', 'Male', '1990-08-08', 'jan.simbahon@gmail.com', '09675432123', 132, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:52:04.000000', '2018-03-16 09:52:04.000000', 'Active'),
(11, 4, 'faculty5', 'Kyle', 'K.', 'David', 'Male', '1998-06-06', 'jan.simbahon@gmail.com', '09253647123', 982, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:53:07.000000', '2018-03-16 09:53:07.000000', 'Active'),
(12, 4, 'faculty6', 'Jon Kenneth', 'R.', 'Que', 'Male', '1998-04-23', 'jan.simbahon@gmail.com', '09827364563', 500, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:54:25.000000', '2018-03-16 09:54:25.000000', 'Active'),
(13, 4, 'faculty7', 'Jan ', 'J.', 'Simbahon', 'Male', '1998-06-06', 'jan.simbahon@gmail.com', '0978625364', 111, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:56:28.000000', '2018-03-16 09:56:28.000000', 'Active'),
(14, 4, 'faculty8', 'Elroi', 'A.', 'Adelantar', 'Male', '1997-02-03', 'jan.simbahon@gmail.com', '09772341234', 888, '18f3c96386407ba486f6f6178a14639194e498c4f8338fc61bf2945653fe058a', '2018-03-16 09:57:30.000000', '2018-03-16 09:57:30.000000', 'Active'),
(15, 3, '1', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-08 14:24:16.000000', NULL, 'Active'),
(18, 7, 'newaccount', 'Jon', '', 'Que', 'Male', '1997-01-01', '', '', 4, '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '2018-04-08 18:12:53.000000', '2018-04-08 18:12:53.000000', 'Active'),
(19, 3, '1', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-09 09:38:59.000000', NULL, 'Active'),
(20, 3, '2', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-09 09:48:30.000000', NULL, 'Active'),
(21, 3, '4', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-09 19:06:34.000000', NULL, 'Active'),
(22, 3, '8', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-09 19:21:12.000000', NULL, 'Active'),
(23, 3, '12', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-09 19:55:58.000000', NULL, 'Active'),
(24, 3, '20', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-11 23:57:31.000000', NULL, 'Active'),
(25, 3, '21', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-11 23:58:36.000000', NULL, 'Active'),
(26, 3, '22', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-12 00:26:25.000000', NULL, 'Active'),
(27, 3, '23', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-12 00:26:36.000000', NULL, 'Active'),
(28, 3, '24', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-12 00:26:49.000000', NULL, 'Active'),
(29, 3, '25', '', NULL, '', '', '0000-00-00', NULL, NULL, 0, '057ba03d6c44104863dc7361fe4578965d1887360f90a0895882e58a6248fc86', '2018-04-12 00:26:59.000000', NULL, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AddressID`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`AuditID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`CityID`);

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
-- Indexes for table `clearancename`
--
ALTER TABLE `clearancename`
  ADD PRIMARY KEY (`ClearanceNameID`);

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
-- Indexes for table `enrollmenttype`
--
ALTER TABLE `enrollmenttype`
  ADD PRIMARY KEY (`EnrollmentTypeID`);

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageID`);

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
-- Indexes for table `studenttype`
--
ALTER TABLE `studenttype`
  ADD PRIMARY KEY (`StudentTypeID`);

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
-- Indexes for table `summerfacultylist`
--
ALTER TABLE `summerfacultylist`
  ADD PRIMARY KEY (`SummerFacultyListID`);

--
-- Indexes for table `summersection`
--
ALTER TABLE `summersection`
  ADD PRIMARY KEY (`SummerSectionID`);

--
-- Indexes for table `summerstudent`
--
ALTER TABLE `summerstudent`
  ADD PRIMARY KEY (`SummeSectionID`);

--
-- Indexes for table `summerstudentlist`
--
ALTER TABLE `summerstudentlist`
  ADD PRIMARY KEY (`SummerStudentListID`);

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
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `AuditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `CityID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `ClearanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `clearancedetails`
--
ALTER TABLE `clearancedetails`
  MODIFY `ClearanceDetailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `clearancename`
--
ALTER TABLE `clearancename`
  MODIFY `ClearanceNameID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `enrollmenttype`
--
ALTER TABLE `enrollmenttype`
  MODIFY `EnrollmentTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `ParentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  MODIFY `SchoolYearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studentlist`
--
ALTER TABLE `studentlist`
  MODIFY `StudentListID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `studenttype`
--
ALTER TABLE `studenttype`
  MODIFY `StudentTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT for table `summerfacultylist`
--
ALTER TABLE `summerfacultylist`
  MODIFY `SummerFacultyListID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `summersection`
--
ALTER TABLE `summersection`
  MODIFY `SummerSectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `summerstudent`
--
ALTER TABLE `summerstudent`
  MODIFY `SummeSectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `summerstudentlist`
--
ALTER TABLE `summerstudentlist`
  MODIFY `SummerStudentListID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
