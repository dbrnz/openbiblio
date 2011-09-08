-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2011 at 04:12 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openbibliowork`
--

-- --------------------------------------------------------

--
-- Table structure for table `material_fields`
--

CREATE TABLE IF NOT EXISTS `material_fields` (
  `material_field_id` int(4) NOT NULL AUTO_INCREMENT,
  `material_cd` int(11) DEFAULT NULL,
  `tag` char(3) NOT NULL,
  `subfield_cd` varchar(10) DEFAULT NULL,
  `position` tinyint(4) NOT NULL,
  `label` varchar(128) DEFAULT NULL,
  `form_type` enum('text','textarea') NOT NULL DEFAULT 'text',
  `required` tinyint(1) NOT NULL,
  `repeatable` tinyint(1) DEFAULT NULL,
  `search_results` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`material_field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `material_fields`
--

INSERT INTO `material_fields` (`material_field_id`, `material_cd`, `tag`, `subfield_cd`, `position`, `label`, `form_type`, `required`, `repeatable`, `search_results`) VALUES
(1, 2, '245', 'a', 0, 'Title', 'text', 1, 0, NULL),
(2, 2, '245', 'b', 1, 'Subtitle', 'text', 0, 0, NULL),
(3, 2, '099', 'a', 0, 'Call Number', 'text', 1, 0, NULL),
(4, 2, '245', 'c', 4, 'Statement of Responsibility', 'text', 0, 0, NULL),
(63, 8, '245', 'a', 1, 'Title', 'text', 0, 0, NULL),
(7, 2, '650', 'a', 8, 'Subject', 'text', 0, 4, NULL),
(8, 2, '250', 'a', 6, 'Edition', 'text', 0, 0, NULL),
(9, 2, '020', 'a', 9, 'ISBN', 'text', 0, 0, NULL),
(54, 7, '44', 'a', 4, 'Country of publishing/producing entity code', 'text', 0, 0, NULL),
(11, 2, '260', 'a', 17, 'Place of Publication', 'text', 0, 0, NULL),
(12, 2, '260', 'b', 16, 'Publisher', 'text', 0, 0, NULL),
(13, 2, '260', 'c', 18, 'Date of Publication', 'text', 0, 0, NULL),
(39, 6, '100', 'a', 6, 'Personal name - Author', 'text', 0, 0, NULL),
(64, 8, '245', 'b', 2, 'Remainder of title', 'text', 0, 0, NULL),
(20, 2, '505', 'a', 19, 'Contents', 'textarea', 0, 0, NULL),
(24, 2, '100', 'a', 3, 'Author', 'text', 1, 0, NULL),
(58, 7, '342', 'g', 9, 'Longitude of central meridian or projection center', 'text', 0, 0, NULL),
(37, 6, '245', 'f', 4, 'Inclusive dates', 'text', 0, 0, NULL),
(38, 6, '245', 'h', 5, 'Medium', 'text', 0, 0, NULL),
(79, 8, '50', 'a', 13, 'Classification number', 'text', 0, NULL, NULL),
(65, 8, '245', 'c', 3, 'Statement of responsibility, etc.', 'text', 0, 0, NULL),
(29, 2, '050', 'a', 10, 'US LoC Classification', 'text', 0, 0, NULL),
(30, 2, '050', 'b', 11, 'US LoC Item Number', 'text', 0, 0, NULL),
(31, 2, '082', 'a', 14, 'Dewey Classification', 'text', 0, 0, NULL),
(32, 2, '082', '2', 15, 'Dewey edition', 'text', 0, 0, NULL),
(33, 2, '700', 'a', 5, 'Additional contributors', 'text', 0, 0, NULL),
(40, 6, '22', 'a', 1, 'International Standard Serial Number', 'text', 0, 0, NULL),
(41, 6, '50', 'a', 7, 'Classification number', 'text', 0, 0, NULL),
(55, 7, '110', 'a', 6, 'Corporate name or jurisdiction name as entry element', 'text', 0, 0, NULL),
(43, 6, '410', 'a', 2, 'Corporate name or jurisdiction name as entry element', 'text', 0, 0, NULL),
(44, 6, '245', 'a', 3, 'Title', 'text', 0, 0, NULL),
(57, 7, '342', 'd', 8, 'Longitude resolution', 'text', 0, 0, NULL),
(75, 8, '300', 'b', 5, 'Other physical details', 'text', 0, NULL, NULL),
(56, 7, '342', 'c', 7, 'Latitude resolution', 'text', 0, 0, NULL),
(50, 6, '50', 'b', 8, 'Item number', 'text', 0, 0, NULL),
(59, 7, '342', 'q', 10, 'Ellipsoid name', 'text', 0, 0, NULL),
(60, 7, '342', 'w', 11, 'Local planar or local georeference information', 'text', 0, 0, NULL),
(61, 7, '342', 'h', 12, 'Latitude of projection origin or projection center', 'text', 0, 0, NULL),
(62, 1, '20', 'a', 1, 'International Standard Book Number', 'text', 0, 0, NULL),
(66, 8, '245', 'h', 4, 'Medium', 'text', 0, 0, NULL),
(67, 8, '306', 'a', 7, 'Playing time', 'text', 0, 0, NULL),
(68, 8, '260', 'c', 8, 'Date of publication, distribution, etc.', 'text', 0, 0, NULL),
(69, 8, '260', 'b', 9, 'Name of publisher, distributor, etc.', 'text', 0, 0, NULL),
(70, 8, '260', 'a', 10, 'Place of publication, distribution, etc.', 'text', 0, 0, NULL),
(76, 8, '300', 'c', 6, 'Dimensions', 'text', 0, NULL, NULL),
(77, 8, '505', 'a', 11, 'Formatted contents note', 'textarea', 0, 0, NULL),
(78, 8, '10', 'a', 12, 'LC control number', 'text', 0, NULL, NULL),
(80, 8, '50', 'b', 14, 'Item number', 'text', 0, NULL, NULL),
(81, 8, '82', 'a', 15, 'Classification number', 'text', 0, NULL, NULL),
(82, 8, '82', 'b', 16, 'Item number', 'text', 0, NULL, NULL),
(83, 8, '82', '2', 17, 'Edition number', 'text', 0, NULL, NULL),
(84, 8, '80', 'a', 18, 'Universal Decimal Classification number', 'text', 0, NULL, NULL),
(85, 8, '80', 'b', 19, 'Item number', 'text', 0, NULL, NULL),
(86, 8, '80', '2', 20, 'Edition identifier', 'text', 0, NULL, NULL),
(87, 3, '099', 'a', 0, 'Call Number', 'text', 1, 0, NULL),
(88, 4, '099', 'a', 0, 'Call Number', 'text', 1, 0, NULL),
(89, 5, '099', 'a', 0, 'Call Number', 'text', 0, NULL, NULL),
(90, 1, '099', 'a', 0, 'Call Number', 'text', 1, 0, NULL),
(91, 6, '099', 'a', 0, 'Call Number', 'text', 0, NULL, NULL),
(92, 7, '099', 'a', 0, 'Call Number', 'text', 0, NULL, NULL),
(93, 8, '099', 'a', 0, 'Call Number', 'text', 0, NULL, NULL),
(94, 1, '245', 'a', 2, 'Title', 'text', 1, 0, NULL),
(95, 1, '245', 'h', 5, 'Medium', 'text', 0, NULL, NULL),
(96, 1, '100', 'a', 6, 'Personal name', 'text', 0, NULL, NULL),
(97, 1, '300', 'a', 7, 'Extent', 'text', 0, NULL, NULL),
(98, 1, '300', 'b', 8, 'Other physical details', 'text', 0, NULL, NULL),
(99, 1, '300', 'c', 9, 'Dimensions', 'text', 0, NULL, NULL),
(100, 1, '260', 'a', 10, 'distribution', 'text', 0, NULL, NULL),
(101, 1, '260', 'b', 11, 'distributor', 'text', 0, NULL, NULL),
(102, 1, '260', 'c', 12, 'distribution', 'text', 0, NULL, NULL),
(103, 1, '500', 'a', 13, 'General note', 'text', 0, 0, NULL),
(104, 1, '500', '5', 14, 'Institution to which field applies', 'text', 0, NULL, NULL),
(105, 1, '650', 'a', 15, 'Topical term or geographic name as entry element', 'text', 0, NULL, NULL),
(106, 1, '245', 'b', 3, 'Remainder of title', 'text', 0, NULL, NULL),
(107, 1, '245', 'c', 4, 'etc.', 'text', 0, NULL, NULL),
(108, 3, '20', 'a', 1, 'International Standard Book Number', 'text', 0, NULL, NULL),
(109, 3, '245', 'a', 2, 'Title', 'text', 0, NULL, NULL),
(110, 3, '245', 'b', 3, 'Remainder of title', 'text', 0, NULL, NULL),
(111, 3, '245', 'c', 4, 'etc.', 'text', 0, NULL, NULL),
(112, 3, '100', 'a', 5, 'Personal name', 'text', 0, NULL, NULL),
(113, 3, '505', 'a', 6, 'Formatted contents note', 'text', 0, NULL, NULL),
(114, 3, '650', 'a', 7, 'Topical term or geographic name as entry element', 'text', 0, NULL, NULL),
(115, 4, '20', 'a', 1, 'International Standard Book Number', 'text', 0, NULL, NULL),
(116, 4, '100', 'a', 2, 'Personal name', 'text', 0, NULL, NULL),
(117, 4, '245', 'a', 3, 'Title', 'text', 0, NULL, NULL),
(118, 4, '245', 'b', 4, 'Remainder of title', 'text', 0, NULL, NULL),
(119, 4, '245', 'c', 5, 'etc.', 'text', 0, NULL, NULL),
(120, 4, '505', 'a', 6, 'Formatted contents note', 'text', 0, NULL, NULL),
(121, 4, '650', 'a', 7, 'Topical term or geographic name as entry element', 'text', 0, NULL, NULL),
(122, 5, '20', 'a', 1, 'International Standard Book Number', 'text', 0, NULL, NULL),
(123, 5, '245', 'a', 2, 'Title', 'text', 0, NULL, NULL),
(124, 5, '245', 'b', 3, 'Remainder of title', 'text', 0, NULL, NULL),
(125, 5, '245', 'c', 4, 'etc.', 'text', 0, NULL, NULL),
(126, 5, '100', 'a', 5, 'Personal name', 'text', 0, NULL, NULL),
(127, 5, '505', 'a', 6, 'Formatted contents note', 'text', 0, NULL, NULL),
(128, 5, '650', 'a', 7, 'Topical term or geographic name as entry element', 'text', 0, NULL, NULL),
(129, 7, '245', 'a', 1, 'Title', 'text', 0, NULL, NULL),
(130, 7, '245', 'b', 2, 'Remainder of title', 'text', 0, NULL, NULL),
(131, 7, '245', 'c', 3, 'etc.', 'text', 0, NULL, NULL),
(132, 7, '100', 'a', 5, 'Personal name', 'text', 0, NULL, NULL),
(133, 7, '500', 'a', 13, 'General note', 'text', 0, NULL, NULL),
(134, 7, '505', 'a', 14, 'Formatted contents note', 'text', 0, NULL, NULL),
(135, 7, '650', 'a', 15, 'Topical term or geographic name as entry element', 'text', 0, NULL, NULL);
