-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2024 at 07:10 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u920736511_chatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `rid` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `question`, `rid`, `active`) VALUES
(1, 'What is your name?', 1, 1),
(2, 'Where are you from?', 26, 1),
(3, 'Why are you here?', 25, 1),
(4, 'Good morning', 2, 1),
(5, 'Good afternoon', 3, 1),
(6, 'Good evening', 4, 1),
(7, 'How are you?', 24, 1),
(8, 'Who are you?', 1, 1),
(9, 'What food do you like?', 5, 1),
(10, 'Hi', 6, 1),
(11, 'Hello', 6, 1),
(12, 'What types of exercises should I do?', 7, 1),
(13, 'What physical activities is the most effective in reducing weight?', 8, 1),
(14, 'How often do you take part in the physical activity?', 9, 1),
(15, 'Do you consider your diet to be healthy or unhealthy currently?', 10, 1),
(16, 'Do you eat the daily recommended intake of macro nutrients?(i.e Carbohydrates: General recommendation; 3-7 g/kg of body weight, Protein: General recommendation;  0.8-1.0 g/kg of body weight, Fats; 0.5-1.5 g/kg of body weight. For athelets and older adults, these results may vary.)', 11, 1),
(17, 'What are the protein rich foods you eat?', 12, 1),
(18, 'What should my daily intake for macro nutrinets be like?', 13, 1),
(19, 'What type of protein rich foods should I eat?', 14, 1),
(20, 'Recommend me some good body weight exercises?', 15, 1),
(21, 'How often is it good to exercise?', 16, 1),
(22, 'How to reduce belly fat?', 17, 1),
(23, 'Is walking a good exercise?', 18, 1),
(24, 'How to track my food intake?', 19, 1),
(25, 'Is gym membership worth it?', 20, 1),
(26, 'Is egg a good food?', 21, 1),
(27, 'Bye!', 22, 1),
(28, 'What can you do?', 1, 1),
(29, 'What are you doing?', 1, 1),
(30, 'What are you doing here?', 1, 1),
(31, 'What do you do?', 1, 1),
(32, 'Is walking a  good exercise?', 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `rid` int(11) NOT NULL,
  `response` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`rid`, `response`, `active`) VALUES
(1, 'I am a virtual assistant designed to help you with health care and fitness-related questions. How can I assist you today?', 1),
(2, 'Good Morning. How can I help you today?', 1),
(3, 'Good Afternoon. How can I help you today?	', 1),
(4, 'Good Evening. How can I help you?', 1),
(5, 'I don\'t eat. Because I am a ChatBot', 1),
(6, 'Hi, How can I help you today?', 1),
(7, 'Reduce weight', 1),
(8, 'exercise', 1),
(9, '4 times a week', 1),
(10, 'A mix of both', 1),
(11, 'Not really', 1),
(12, 'eggs and fish', 1),
(13, ' Carbohydrates: General recommendation; 3-7 g/kg of body weight, Protein: General recommendation; 0.8-1.0 g/kg of body weight, Fats; 0.5-1.5 g/kg of body weight. For athelets and older adults, these results may vary.', 1),
(14, 'eggs are a good source of macros like protein and fats(just eat the yolk, dont worry about it As its a good source of unstaturated fats). Fish are also a good source of protein.', 1),
(15, 'pushup, pullups, dips', 1),
(16, '4 times a week is the best recommendation. But based on your time availability try to incoporate some form of physical activity every day.', 1),
(17, 'Reduce your calorie intake. Eat alot of organic foods. Avoid eating junk foods.', 1),
(18, 'Yes, it is. But it does not involve movement of upper body much. A good mix of upper body and lower body exercise is recommended. So you could incorporate some weight lifting into your routine for optimal results.', 1),
(19, 'Simplest method would be to write these in a google sheet for each, like breakfast - eggs, lentils, etc, lunch- red rice, fish, etc and so on. And start to check which items you eat more and investigate further on the macros and micro nutrients of each, so you can increase, reduce them accordingly.', 1),
(20, 'Yes, but it depends on the person goal. Reducing weight can be achive from home by doing home exercises, going for a walk and most importantly improving your diet. But if you want to build really good strength and train for competitions, going for gym is recommended. Anyways it depends on the persons long term goal. Health is a life long journey.', 1),
(21, 'Yes, egg is a rich source of protein plus other macro and micro nutrients.', 1),
(22, 'Bye, Have a great day ahead!', 1),
(23, ' Yes, it is. But it does not involve movement of upper body much. A good mix of upper body and lower body exercise is recommended. So you could incorporate some weight lifting into your routine for optimal results. ', 1),
(24, 'Doing good. And you?', 1),
(25, 'To answer all of your fitness and health related questions.', 1),
(26, 'Sorry, please repeat your question.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unanswered`
--

CREATE TABLE `unanswered` (
  `uaid` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `askcount` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unanswered`
--

INSERT INTO `unanswered` (`uaid`, `question`, `askcount`, `active`) VALUES
(1, 'Hi', 1, 0),
(2, 'Hello', 1, 0),
(9, 'Is walking a  good exercise?', 1, 0),
(12, 'bye', 1, 0),
(15, 'What do you do?', 1, 0),
(16, 'What are you doing?', 1, 0),
(17, 'What can you do?', 1, 0),
(18, 'what are you doing here', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `useremail`, `password`, `code`, `active`) VALUES
(2, 'Theesan', 'tkmtheesan1996@gmail.com', 'baa7e8db6d79df25f012e426112ed505', 1700655610, 1),
(5, 'Jaeson', 'jaeson08@gmail.com', '7a4f4de423f2672c34c56efff2dc7082', 1717168406, 1),
(6, 'Admin', 'admin@esoft.academy', 'a59327b71d2a5decb97646e2472f32a8', 1717394631, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `unanswered`
--
ALTER TABLE `unanswered`
  ADD PRIMARY KEY (`uaid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `unanswered`
--
ALTER TABLE `unanswered`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
