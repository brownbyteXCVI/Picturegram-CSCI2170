-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 29, 2020 at 09:30 PM
-- Server version: 5.7.30
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Picturegram`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`CommentID`, `UserID`, `PostID`, `Comment`, `Date`) VALUES
(1, 1, 1, 'Cras sagittis arcu orci, ut vestibulum neque ornare id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eu leo vitae velit consequat consectetur a eu est.  ', '2020-10-31 16:16:12'),
(2, 1, 1, 'Nnon ullamcorper ante. Nulla aliquam volutpat ligula, vel pretium arcu interdum vel. Nam id varius nisi, ut fringilla diam. Vestibulum congue ultricies nisl eget malesuada. Donec eget dapibus tortor. ', '2020-10-31 16:16:12'),
(3, 1, 1, 'Aenean cursus scelerisque iaculis. Vivamus enim sem, pharetra placerat vulputate pellentesque, ornare in velit. Donec sollicitudin pharetra fringilla. Duis pretium malesuada nisi. Vivamus at varius lectus. Praesent est sem, lobortis nec dui et, efficitur aliquet metus. Quisque pharetra vulputate turpis a sagittis. ', '2020-10-31 16:16:12'),
(4, 1, 2, 'Vivamus volutpat viverra ultrices. Pellentesque porta scelerisque auctor. Sed luctus, massa nec luctus fringilla, urna diam semper turpis, a cursus massa ligula vitae mi.', '2020-10-31 16:16:12'),
(5, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing!! ', '2020-10-31 16:16:12'),
(6, 1, 2, 'Strange, wonder how they got there??!', '2020-10-31 16:16:12'),
(7, 1, 3, 'Donec eu leo vitae velit consequat consectetur a eu est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean laoreet tortor eros, sed pretium mi lacinia ut. Nunc imperdiet velit quam, quis aliquet augue imperdiet vel.', '2020-10-31 16:16:12'),
(8, 1, 3, 'Is this a winery?', '2020-10-31 16:16:12'),
(9, 1, 3, 'What a view!!', '2020-10-31 16:16:12'),
(10, 1, 4, 'Nostra, per inceptos himenaeos. Aenean laoreet tortor eros, sed pretium mi lacinia ut. Nunc imperdiet velit quam, quis aliquet augue imperdiet vel.', '2020-10-31 16:16:12'),
(11, 1, 4, 'In id risus justo. Aenean id elementum justo. Fusce rutrum ligula a ligula fermentum dapibus. Nunc non libero tincidunt leo lacinia blandit quis vel elit.\r\n', '2020-10-31 16:16:12'),
(12, 1, 4, 'Looks like you\'re on the ferry!', '2020-10-31 16:16:12'),
(13, 1, 5, 'Venenatis vitae, tincidunt id nisi. Sed ipsum velit, sodales nec ultricies eget, sagittis eget lorem. Nam in congue nulla.', '2020-10-31 16:16:12'),
(14, 1, 5, 'Gotta love fresh veggies!', '2020-10-31 16:16:12'),
(15, 1, 1, 'wow!!', '2020-10-31 16:16:12'),
(16, 1, 1, 'What a sunset!', '2020-10-31 16:16:12'),
(17, 1, 2, 'Nice!', '2020-10-31 16:16:12'),
(18, 1, 2, 'Pretty!', '2020-10-31 16:16:12'),
(19, 1, 2, 'How do they grow like that!?', '2020-10-31 16:16:12'),
(20, 1, 2, 'How do they do that!', '2020-10-31 16:16:12'),
(21, 1, 2, 'How do they do that!', '2020-10-31 16:16:12'),
(22, 1, 2, 'Nice photo!', '2020-10-31 16:16:12'),
(23, 1, 2, 'Nice photo!', '2020-10-31 16:16:12'),
(24, 1, 5, 'Nice farm!', '2020-10-31 16:16:12'),
(25, 1, 3, 'Looks hot there!', '2020-10-31 16:16:12'),
(26, 1, 7, 'hello', '2020-11-23 22:29:02'),
(99, 2, 10, 'So pretty!', '2020-11-29 09:12:20'),
(100, 13, 10, 'This looks so good...', '2020-11-29 09:14:35'),
(104, 13, 13, 'This is a nice looking rainbow', '2020-11-29 09:44:42'),
(105, 13, 6, 'Nice fall colors!', '2020-11-29 09:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `LoginID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`LoginID`, `UserID`, `Username`, `Password`) VALUES
(1, 1, 'lorem_nullam', 'password1'),
(2, 2, 'jo_malone', 'password2'),
(8, 13, 'rocket_man', 'password3');

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostImage` varchar(50) NOT NULL,
  `Post` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`PostID`, `UserID`, `PostImage`, `Post`, `Date`) VALUES
(1, 1, 'sunset.jpg', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.', '2020-10-31 15:59:25'),
(2, 1, 'poppies.jpg', 'Pellentesque pellentesque hendrerit rhoncus. Curabitur quis elementum lorem, finibus molestie.', '2020-10-31 15:55:19'),
(3, 1, 'valley1.jpg', 'Donec eu leo vitae velit consequat consectetur a eu est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean laoreet tortor eros, sed pretium mi lacinia ut. Nunc imperdiet velit quam, quis aliquet augue imperdiet vel.', '2020-10-31 15:55:19'),
(4, 1, 'cityscape.jpg', 'Quisque consequat tellus diam, ut.Vestibulum non purus magna. Nam varius, justo dignissim dapibus sollicitudin.', '2020-10-31 15:55:19'),
(5, 1, 'farm.jpg', 'Lorem ipsum dolor sit amet. Fusce ac nisi quis.', '2020-10-31 15:55:19'),
(6, 1, 'fall.jpg', 'Vestibulum pretium ultricies orci, vitae fringilla augue mattis sed. Phasellus sodales tincidunt mauris, vitae dignissim ipsum ', '2020-11-09 22:57:35'),
(7, 1, 'beach.jpg', 'Quisque quis nulla at tellus luctus hendrerit. Integer et nisl viverra, ornare orci aliquam, fermentum lacus', '2020-11-09 23:20:03'),
(10, 2, 'galaxy.jpg', 'Fusce id libero nibh. Praesent vehicula erat non lacus mollis, non vehicula massa semper', '2020-11-28 09:52:27'),
(13, 13, 'rainbow.jpg', 'Phasellus sollicitudin pellentesque leo, eget feugiat metus laoreet porta. Morbi at sollicitudin mi.', '2020-11-29 06:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `About` text NOT NULL,
  `AboutImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Name`, `About`, `AboutImage`) VALUES
(1, 'Lorem Nullam', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque id varius magna, scelerisque aliquet odio. Fusce vel scelerisque felis, a facilisis felis. Donec pharetra lacus nulla, vel lobortis turpis convallis porttitor. Quisque vehicula ut purus ac venenatis. Phasellus pharetra sit amet tellus sit amet accumsan. Vivamus in faucibus metus. Proin et tellus luctus ipsum finibus posuere. In vulputate urna orci, vel tristique quam ornare eget. Etiam eget odio felis. Vestibulum a eros eleifend, bibendum dui nec, tristique quam. Phasellus molestie ex ac ipsum posuere, sit amet pellentesque orci vulputate. Proin posuere augue at turpis tincidunt venenatis.\r\n\r\nIn id ante laoreet, interdum ex sed, varius nunc. Etiam ut felis congue lacus imperdiet egestas quis in odio. Nam rhoncus purus enim, a pharetra urna hendrerit vel. Morbi laoreet et mauris quis egestas. Vivamus euismod quam a nisi accumsan volutpat. Pellentesque dui diam, consequat nec consequat nec, ultrices quis tellus. Sed aliquam luctus nisl non lacinia. Etiam faucibus magna et tincidunt fringilla. Nulla sed justo pulvinar, porta mi vel, ornare nisi. Maecenas sit amet cursus justo. Proin lacinia neque urna.', 'dal-about.jpg '),
(2, 'Jo Malone', 'In id ante laoreet, interdum ex sed, varius nunc. Etiam ut felis congue lacus imperdiet egestas quis in odio. Nam rhoncus purus enim, a pharetra urna hendrerit vel. Morbi laoreet et mauris quis egestas. Vivamus euismod quam a nisi accumsan volutpat. Pellentesque dui diam, consequat nec consequat nec, ultrices quis tellus. Sed aliquam luctus nisl non lacinia. Etiam faucibus magna et tincidunt fringilla. Nulla sed justo pulvinar, porta mi vel, ornare nisi. Maecenas sit amet cursus justo. Proin lacinia neque urna.', 'high-sierra.jpg'),
(13, 'Robert Oppenheimer', 'Nunc tristique odio quis leo semper, sit amet tempor purus aliquet. Donec urna lorem, aliquam id vulputate sollicitudin, tincidunt vel ipsum. Phasellus ac massa tortor. Nunc at mi arcu. Nullam id elit erat. Mauris nec nisl suscipit, congue enim tempor, luctus nulla. Quisque aliquet lorem eu vulputate efficitur. Donec gravida consequat tempus. Vestibulum eu augue volutpat, pellentesque eros in, tristique ipsum. Sed aliquam cursus leo, vitae tristique odio viverra sed. Nulla pretium, ligula quis venenatis placerat, tortor felis vulputate magna, a aliquet nulla orci at tortor. Proin a vehicula mauris. Cras lacinia est vel dolor vehicula ullamcorper. Sed lectus eros, congue id orci nec, dignissim rutrum dui. Nulla nisl quam, ullamcorper eu consequat a, tempus a elit.', 'nuclear.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PostID` (`PostID`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`LoginID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `LoginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `Posts` (`PostID`);

--
-- Constraints for table `Login`
--
ALTER TABLE `Login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);
