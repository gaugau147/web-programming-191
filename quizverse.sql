-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 06:57 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizverse`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `privacy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_id`, `name`, `user_id`, `privacy`) VALUES
(3, 'CO2003', 'Algorithms and Data Structures', 4, 'public'),
(4, 'CO3045', 'Web Programming', 4, 'public'),
(5, 'CO3005', 'Principles of Programming Languages', 4, 'private'),
(6, 'CO4027', 'Machine Learning', 4, 'public'),
(7, 'CO3061', 'Ariticial Intelligence', 4, 'private'),
(8, 'CO2013', 'Database System', 4, 'private'),
(9, 'CO1007', 'Discrete Mathematics', 3, 'private'),
(10, 'CO3099', 'Basic Programming', 3, 'private'),
(11, 'CO4027', 'Software Engineering', 5, 'public'),
(12, 'CO5027', 'Advanced Machine Learning', 5, 'public'),
(13, 'CO5000', 'Computer Network', 5, 'public'),
(14, 'CO3006', 'Algebra I', 5, 'private'),
(15, 'MO1008', 'Physics I', 5, 'private'),
(27, 'CO2003', 'Algorithms and Data Structures', 6, 'public'),
(28, 'CO3045', 'Web Programming', 6, 'public'),
(29, 'CO3005', 'Principles of Programming Languages', 6, 'private'),
(30, 'CO4027', 'Machine Learning', 6, 'public'),
(31, 'CO3061', 'Ariticial Intelligence', 6, 'private'),
(32, 'CO2013', 'Database System', 6, 'private');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `no_question` tinyint(4) NOT NULL,
  `class` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `description`, `date`, `time`, `duration`, `no_question`, `class`, `course_id`, `notes`, `user_id`) VALUES
(1, 'Final 2018 HK181', 'Fall 2018', '2019-12-13', '12:00', '60', 30, 'L03', '3', 'This is the final exam ', '2'),
(2, 'Final 2018 HK181', 'Spring 2018', '2019-12-13', '12:00', '60', 30, 'L03', '3', '30', '2'),
(4, 'Final 2018 HK181', 'Fall 2018', '2019-12-19', '12:00', '30', 10, 'L03', '3', '10', '2'),
(5, 'Midterm Software Engineering', 'Winter 2019', '2019-12-28', '08:00', '60', 20, 'L03', '11', '20', '5'),
(6, 'Final 182 Computer Network', 'This is the final exam of spring term', '2020-02-21', '08:00', '120', 10, 'L03', '13', '10', '5'),
(7, 'Final 182 Linear Algebra', 'Spring 2018', '2019-10-11', '08:00', '35', 25, 'L03', '11', '25', '5');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `question_id`) VALUES
(1, '1', '1'),
(2, '1', '2'),
(3, '5', '5'),
(4, '5', '6'),
(5, '5', '7'),
(6, '5', '8'),
(7, '5', '13'),
(8, '5', '14'),
(9, '6', '16'),
(10, '6', '17'),
(11, '6', '18'),
(12, '6', '19'),
(13, '6', '20'),
(14, '6', '21'),
(15, '7', '5'),
(16, '7', '6'),
(17, '7', '7'),
(18, '7', '8'),
(19, '7', '9'),
(20, '7', '10'),
(21, '7', '12'),
(22, '7', '15');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `topic_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_modified` datetime NOT NULL,
  `level` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `option_1` text NOT NULL,
  `option_2` text NOT NULL,
  `option_3` text NOT NULL,
  `option_4` text NOT NULL,
  `option_5` text NOT NULL,
  `answer_1` tinyint(1) NOT NULL,
  `answer_2` tinyint(1) NOT NULL,
  `answer_3` tinyint(1) NOT NULL,
  `answer_4` tinyint(1) NOT NULL,
  `answer_5` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `topic_id`, `course_id`, `user_id`, `created_at`, `last_modified`, `level`, `title`, `option_1`, `option_2`, `option_3`, `option_4`, `option_5`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `answer_5`) VALUES
(1, '1', '3', '4', '2019-12-09 06:10:12', '2019-12-11 10:46:45', 'hard', 'The repeating decimal number 3.14159265265265... written as a ratio of two integers a/b is:', '313845111/99990000', '313844841/99900000', '13845006/99990000', '13845106/99900000', '13845123/99000000', 1, 0, 0, 0, 0),
(2, '1', '3', '4', '2019-12-01 07:16:16', '2019-12-09 08:16:18', 'medium', 'Which of the following statements is true:', 'A number is rational if and only if its square is rational', 'An integer n is odd if and only if n2+ 2 n is odd', 'A number is irrational if and only if its square is irrational', 'A number n is odd if and only if n(n+ 1) is eve', 'At least one of two numbers x and y is irrational if and only if the product xy is irrational', 1, 0, 0, 0, 0),
(3, '1', '3', '4', '2019-12-10 16:02:04', '0000-00-00 00:00:00', 'mindblow', 'Let L be the least common multiple of 175 and 105. Among all of the common divisors x > 1 of 175 and 105, let D be the smallest. Which is correct of the following:', 'D = 5 and L= 1050', 'D = 5 and L= 35', 'D = 7 and L= 525', 'D = 5 and L= 52', 'D = 7 and L= 1050', 0, 0, 0, 1, 0),
(5, '8', '11', '5', '2019-12-13 09:47:41', '2019-12-13 09:59:31', 'medium', 'Show your opinion upon completing this course?', '1', '2', '3', '4', 'All of the answers are wrong', 0, 0, 0, 0, 1),
(6, '8', '11', '5', '2019-12-13 09:48:40', '2019-12-13 09:59:53', 'easy', 'Choose the best answer about software type.', 'consectetur', 'libero', 'neque', 'harum', 'Provident', 0, 0, 1, 0, 1),
(7, '8', '11', '5', '2019-12-13 09:49:48', '2019-12-13 10:00:14', 'mindblow', 'Choose the best answer about software.', 'DE', 'AF', 'GF', 'CE', 'CS', 0, 0, 0, 1, 1),
(8, '9', '11', '5', '2019-12-13 09:51:20', '2019-12-13 10:01:04', 'medium', 'Which of the following is the best case?', 'Present only part of the available data that make customers happy.', 'Can accept some under-the-table money from customers in some circumstances.', 'Do not have responsibility to help colleagues to behave morally.', 'None of the other answers are wrong.', 'None of the other answers are correct.', 0, 0, 0, 0, 1),
(9, '9', '11', '5', '2019-12-13 09:52:26', '2019-12-13 10:01:50', 'hard', 'Software engineering is an engineering discipline when it _____ .', 'All of the other answers are correct.', 'requires that the users should be trained well.', 'needs engineers to operate and develop.', 'uses appropriate theories and methods to solve problems bearing in mind organizational and financial constraints.', 'All of the other answers are wrong.', 0, 0, 0, 1, 0),
(10, '9', '11', '5', '2019-12-13 09:53:25', '2019-12-13 10:02:49', 'hard', 'Choose the wrong answer about software engineering activities.', 'Software developer = software designer + programmer.', 'Fundamental activities in software engineering: specification, development, validation and evolution.', 'Good software can be accepted by customers should match the customer style/personality.', 'The best technique in software engineering is the newest proposed one.', 'All of the anwsers are correct', 0, 0, 0, 1, 0),
(11, '10', '11', '5', '2019-12-13 09:54:17', '2019-12-13 10:03:56', 'hard', 'Which of the following documents are in professional software development?', 'Software Requirement Specification - SRS', 'Software Detail Design - SDD', 'None of the other anwsers', 'Software Testing Document - STD', 'All of the other answers.', 0, 0, 0, 0, 1),
(12, '10', '11', '5', '2019-12-13 09:55:23', '2019-12-13 10:04:01', 'easy', 'Is lion an animal?', 'Yes', 'No', 'Lion is an animal from space', 'Lion is not a lion', 'Lion is a dog', 1, 0, 0, 0, 0),
(13, '11', '11', '5', '2019-12-13 09:56:23', '2019-12-13 10:05:06', 'hard', 'In prototyping software development, what is a prototype?', 'A complete design that can be implement immediately.', 'A program that has at least more features than the requirements from the customer.', 'A program that has user interface and may have some basic functions.', 'A program that has user interface and workable functions.', 'All of the other anwser are correct', 0, 0, 1, 0, 0),
(14, '11', '11', '5', '2019-12-13 10:05:47', '2019-12-13 10:05:47', 'medium', 'Software development activity _____.', 'Design step and then implementation step as in water fall.', 'Is a process of converting specification into executable systems.', 'Includes: design and implementation and testing', 'All of the other answers are correct.', 'All of the other answers are wrong.', 0, 1, 0, 0, 0),
(15, '11', '11', '5', '2019-12-13 10:06:15', '2019-12-13 10:06:15', 'mindblow', 'In which CMM (Capability Maturity Model) level, the company guarantees about the continuously improvement in software process?', '4', '5', '6', '2', '1', 0, 1, 0, 0, 0),
(16, '12', '13', '5', '2019-12-13 10:12:46', '2019-12-13 10:12:46', 'mindblow', 'Choose the best answer about software process concept.', 'Software process is a set of techniques in software development.', 'Software process model is another name for software process.', 'All software processes consist of fundamental activities: specification, development, validation and evolution.', 'All the other answers are correct.', 'All the other answers are wrong', 0, 0, 1, 0, 0),
(17, '12', '13', '5', '2019-12-13 10:13:44', '2019-12-13 10:13:44', 'easy', 'Which one is so wrong in software processes?', 'The incremental process allows fundamental software engineering activities such as specification, development and validation to be performed repeatedly.', 'In the incremental process, the goal for each iteration (repeat) may not be depended on the previous iterations.', 'In the waterfall model, the previous phase should be done before starting the next phase.', 'In the incremental process, only the final product could be deliver to the customer.', 'All of the other anwsers are correct', 0, 0, 0, 1, 0),
(18, '13', '13', '5', '2019-12-13 10:14:27', '2019-12-13 10:14:42', 'hard', 'Software specification activity _____.', 'All of the other answers are correct.', 'Is a fundamental activity in Software engineering.', 'Can includes: requirement elicitation and analysis, requirement specification and requirement validation.', 'Is a process of establishing the software requirements.', 'All are correct', 0, 0, 0, 0, 1),
(19, '13', '13', '5', '2019-12-13 10:15:40', '2019-12-13 10:15:40', 'medium', 'Choose the best answer about software processes.', 'A', 'B', 'C', 'D', 'E', 0, 0, 0, 0, 1),
(20, '14', '13', '5', '2019-12-13 10:16:23', '2019-12-13 10:16:23', 'mindblow', 'Suppose that, some one states that: (1) Software specification is a process of specifying functionalities and constraints in development and operation software; (2) Software development is a process of transferring specification into executable system; (3) Software testing is part of software validation. Giving 1 point for each correct statement and -1 point for each incorrect statement. How many point do we have?', '1', '3', '2', '-1', '-3', 0, 1, 0, 0, 0),
(21, '14', '13', '5', '2019-12-13 10:18:12', '2019-12-13 10:18:12', 'hard', 'Which one is correct?', 'In the waterfall model, there are alway 4 stages.', 'In the waterfall model, we can not go back to the previous stage (only to the first stage if there is any problem in the latter stages).', 'In the development step of incremental development, there is no more requirement analysis.', 'None of the other answers is wrong', 'None of the other answers is correct', 0, 0, 0, 0, 1),
(22, '15', '12', '5', '2019-12-13 10:20:23', '2019-12-13 10:20:23', 'hard', 'Machine learning is:', 'Nothing', 'A thing', 'An algorithm', 'An Industry', 'All of the anwsers are correct', 0, 0, 0, 0, 1),
(23, '15', '12', '5', '2019-12-13 10:21:05', '2019-12-13 10:21:05', 'mindblow', 'Deep learning is:', 'AA', 'BB', 'FF', 'GG', 'EE', 0, 0, 0, 1, 0),
(24, '16', '12', '5', '2019-12-13 10:22:28', '2019-12-13 10:22:28', 'hard', 'The followings are requirements for a movie ticket selling software: (1) An audience can search for a movie schedule; (2) The software shall be operated on web and shall be operated all the time (24/7 mode); (3) The audience can cancel the ticket and get the refund; (4) The movie theatre manager can add movie schedule for a movie. In order from 1 to 4, which requirement is functional (F) or non-functional requirement (NF)?', 'NF-NF-NF-NF', 'F-F-F-F.', 'F-NF-NF-F.', 'F-NF-T-T.', 'F-NF-F-F.', 0, 0, 0, 0, 1),
(25, '16', '12', '5', '2019-12-13 10:23:09', '2019-12-13 10:23:09', 'hard', 'Which is NOT correct about functional and non-functional requirements', 'They are all from customer.', 'They are all requirements.', 'Non-functional requirements can be reformed to be functional requirements.', 'Some non-functional requirements may requires some related functional requirements.', 'Some non-functional requirements may requires some related.', 0, 0, 1, 0, 0),
(26, '17', '12', '5', '2019-12-13 10:23:49', '2019-12-13 10:23:49', 'hard', 'The followings are requirements for a child tracking app: (1) The app sends an alert message to the parent when the child is out of the safe zone; (2) The app sends the locations of the child to the parent regularly; (3) The app allows the child to call the parent just by pressing one button; (4) The app cannot be off at any time. In order from 1 to 4, which requirement is functional (F) or non-functional requirement (NF)?', 'F-NF-NF-F', 'F-NF-F-F.', 'F-F-F-NF.', 'NF-NF-NF-NF', 'NF-NF-NF-NFNF-NF-NF-NF', 0, 0, 1, 0, 0),
(27, '17', '12', '5', '2019-12-13 10:24:30', '2019-12-13 10:24:30', 'medium', 'Question 2: Who are your stakeholders for a university smart lighting software and why?', 'Guesses of the university - they require the software with some requirements', 'All the other answers are correct.', 'Students - they provide what they feel about how beautiful the campus is', 'Security staffs - they tell us what they want to control the light in the campus', 'All the other answers are wrong.', 0, 0, 0, 1, 0),
(28, '18', '14', '5', '2019-12-13 10:27:18', '2019-12-13 10:27:18', 'hard', 'Question 1: 1 +1 =', '1', '2', '3', '4', '5', 0, 1, 0, 0, 0),
(29, '18', '14', '5', '2019-12-13 10:28:02', '2019-12-13 10:28:02', 'medium', 'Question 2: y = ax +b , given x = 1, a = 2, b = 3. Then y = ?', '1', '2', '3', '4', '5', 0, 0, 0, 0, 1),
(30, '19', '15', '5', '2019-12-13 10:29:48', '2019-12-13 10:29:48', 'mindblow', 'Question 1: F = ma. given m = 1 kg, a = 10m/s^2. Find F?', '1', '2', '3', '4', '10', 0, 0, 0, 0, 1),
(31, '1', '14', '5', '2019-12-09 06:10:12', '2019-12-11 10:46:45', 'hard', 'The repeating decimal number 3.14159265265265... written as a ratio of two integers a/b is:', '313845111/99990000', '313844841/99900000', '13845006/99990000', '13845106/99900000', '13845123/99000000', 1, 0, 0, 0, 0),
(32, '1', '14', '5', '2019-12-01 07:16:16', '2019-12-09 08:16:18', 'medium', 'Which of the following statements is true:', 'A number is rational if and only if its square is rational', 'An integer n is odd if and only if n2+ 2 n is odd', 'A number is irrational if and only if its square is irrational', 'A number n is odd if and only if n(n+ 1) is eve', 'At least one of two numbers x and y is irrational if and only if the product xy is irrational', 1, 0, 0, 0, 0),
(33, '1', '15', '5', '2019-12-10 16:02:04', '0000-00-00 00:00:00', 'mindblow', 'Let L be the least common multiple of 175 and 105. Among all of the common divisors x > 1 of 175 and 105, let D be the smallest. Which is correct of the following:', 'D = 5 and L= 1050', 'D = 5 and L= 35', 'D = 7 and L= 525', 'D = 5 and L= 52', 'D = 7 and L= 1050', 0, 0, 0, 1, 0),
(34, '8', '15', '5', '2019-12-13 09:47:41', '2019-12-13 09:59:31', 'medium', 'Show your opinion upon completing this course?', '1', '2', '3', '4', 'All of the answers are wrong', 0, 0, 0, 0, 1),
(35, '8', '15', '5', '2019-12-13 09:48:40', '2019-12-13 09:59:53', 'easy', 'Choose the best answer about software type.', 'consectetur', 'libero', 'neque', 'harum', 'Provident', 0, 0, 1, 0, 1),
(36, '8', '15', '5', '2019-12-13 09:49:48', '2019-12-13 10:00:14', 'mindblow', 'Choose the best answer about software.', 'DE', 'AF', 'GF', 'CE', 'CS', 0, 0, 0, 1, 1),
(37, '14', '27', '5', '2019-12-13 10:18:12', '2019-12-13 10:18:12', 'hard', 'Which one is correct?', 'In the waterfall model, there are alway 4 stages.', 'In the waterfall model, we can not go back to the previous stage (only to the first stage if there is any problem in the latter stages).', 'In the development step of incremental development, there is no more requirement analysis.', 'None of the other answers is wrong', 'None of the other answers is correct', 0, 0, 0, 0, 1),
(38, '15', '27', '5', '2019-12-13 10:20:23', '2019-12-13 10:20:23', 'hard', 'Machine learning is:', 'Nothing', 'A thing', 'An algorithm', 'An Industry', 'All of the anwsers are correct', 0, 0, 0, 0, 1),
(39, '16', '27', '5', '2019-12-13 10:22:28', '2019-12-13 10:22:28', 'hard', 'The followings are requirements for a movie ticket selling software: (1) An audience can search for a movie schedule; (2) The software shall be operated on web and shall be operated all the time (24/7 mode); (3) The audience can cancel the ticket and get the refund; (4) The movie theatre manager can add movie schedule for a movie. In order from 1 to 4, which requirement is functional (F) or non-functional requirement (NF)?', 'NF-NF-NF-NF', 'F-F-F-F.', 'F-NF-NF-F.', 'F-NF-T-T.', 'F-NF-F-F.', 0, 0, 0, 0, 1),
(40, '16', '27', '5', '2019-12-13 10:23:09', '2019-12-13 10:23:09', 'hard', 'Which is NOT correct about functional and non-functional requirements', 'They are all from customer.', 'They are all requirements.', 'Non-functional requirements can be reformed to be functional requirements.', 'Some non-functional requirements may requires some related functional requirements.', 'Some non-functional requirements may requires some related.', 0, 0, 1, 0, 0),
(41, '17', '27', '5', '2019-12-13 10:23:49', '2019-12-13 10:23:49', 'hard', 'The followings are requirements for a child tracking app: (1) The app sends an alert message to the parent when the child is out of the safe zone; (2) The app sends the locations of the child to the parent regularly; (3) The app allows the child to call the parent just by pressing one button; (4) The app cannot be off at any time. In order from 1 to 4, which requirement is functional (F) or non-functional requirement (NF)?', 'F-NF-NF-F', 'F-NF-F-F.', 'F-F-F-NF.', 'NF-NF-NF-NF', 'NF-NF-NF-NFNF-NF-NF-NF', 0, 0, 1, 0, 0),
(42, '17', '28', '5', '2019-12-13 10:24:30', '2019-12-13 10:24:30', 'medium', 'Question 2: Who are your stakeholders for a university smart lighting software and why?', 'Guesses of the university - they require the software with some requirements', 'All the other answers are correct.', 'Students - they provide what they feel about how beautiful the campus is', 'Security staffs - they tell us what they want to control the light in the campus', 'All the other answers are wrong.', 0, 0, 0, 1, 0),
(43, '18', '28', '5', '2019-12-13 10:27:18', '2019-12-13 10:27:18', 'hard', 'Question 1: 1 +1 =', '1', '2', '3', '4', '5', 0, 1, 0, 0, 0),
(44, '18', '28', '5', '2019-12-13 10:28:02', '2019-12-13 10:28:02', 'medium', 'Question 2: y = ax +b , given x = 1, a = 2, b = 3. Then y = ?', '1', '2', '3', '4', '5', 0, 0, 0, 0, 1),
(45, '19', '28', '5', '2019-12-13 10:29:48', '2019-12-13 10:29:48', 'mindblow', 'Question 1: F = ma. given m = 1 kg, a = 10m/s^2. Find F?', '1', '2', '3', '4', '10', 0, 0, 0, 0, 1),
(46, '1', '28', '2', '2019-12-09 06:10:12', '2019-12-11 10:46:45', 'hard', 'The repeating decimal number 3.14159265265265... written as a ratio of two integers a/b is:', '313845111/99990000', '313844841/99900000', '13845006/99990000', '13845106/99900000', '13845123/99000000', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `course_id`, `user_id`, `title`, `name`) VALUES
(1, '3', '4', 'Topic 1', 'Predicate Logic'),
(2, '3', '4', 'Topic 2', 'Sets'),
(3, '3', '4', 'Topic 3', 'Functions'),
(4, '3', '4', 'Topic 4', 'Relations'),
(5, '3', '4', 'Topic 5', 'Counting'),
(8, '11', '5', 'Chapter 1', 'Introduction'),
(9, '11', '5', 'Chapter 2', 'Software Cycles'),
(10, '11', '5', 'Chapter 3', 'Requirements Analysis Technique'),
(11, '11', '5', 'Chapter 4', 'Software Modeling'),
(12, '13', '5', 'Chapter 1', 'Introduction'),
(13, '13', '5', 'Chapter 2', 'Network'),
(14, '13', '5', 'Chapter 3', 'Network Application'),
(15, '12', '5', 'Chapter 1', 'Introduction'),
(16, '12', '5', 'Chapter 2', 'Keras'),
(17, '12', '5', 'Chapter 3', 'Python application'),
(18, '14', '5', 'Chapter 1', 'Linear'),
(19, '15', '5', 'Chapter 1', 'Newton Theory'),
(25, '27', '6', 'Topic 1', 'Predicate Logic'),
(26, '27', '6', 'Topic 2', 'Sets'),
(27, '27', '6', 'Topic 3', 'Functions'),
(28, '27', '6', 'Topic 4', 'Relations'),
(29, '27', '6', 'Topic 5', 'Counting');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `lid` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'lecturer',
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `dob`, `phone`, `lid`, `faculty`, `role`, `avatar`) VALUES
(3, 'Diep', 'Tran', 'diep@hcmut.edu.vn', '$2y$10$S9faHUXaHxx81jifQlBXK.ic9nCXofHopM6f4F6Sscbb.ySJsv/6u', '1994-07-15', '0399284289', '#', 'Faculty of Computer Science and Engineering', 'admin', 'diep.png'),
(4, 'Nhan', 'Luong', 'nhan@gmail.com', '$2y$10$15vQKWWWlikqtGE8ckt1qeBFiWW7BluXdwtqJUJm5Mi1XUx2YzmvG', '1995-04-21', '0342575569', '#', 'Computer Science and Engineering', 'lecturer', 'nhan.png'),
(5, 'Barrack', 'Obama', 'obama@gmail.com', '$2y$10$nj83msWhT/M5OWGdYoexLemlhWS6VCCx7nuA2e7DoplYNY0I681Ga', '1976-12-09', '0978776642', '4', 'Industry Management', 'lecturer', 'obama.png'),
(6, 'Donald', 'Trump', 'trump@gmail.com', '$2y$10$pcnachQdFvuk6AVXaQyz9uUY5gCl/7AE0zLbnIcDSRLzziUU0FZ7O', '1975-12-19', '0977666555', '5', 'Chemical Engineering', 'lecturer', 'trump.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
