-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2016 at 10:36 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grandmapizzas`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Normal Pizza'),
(2, 'Veggeterian Pizzas');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `C_Id` int(11) NOT NULL,
  `C_Name` varchar(100) NOT NULL,
  `C_Email` varchar(255) NOT NULL,
  `C_Subject` varchar(255) NOT NULL,
  `C_Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`C_Id`, `C_Name`, `C_Email`, `C_Subject`, `C_Message`) VALUES
(1, 'Myhedin', 'myhedinzika@gmail.com', 'Testing purpose', 'A123123'),
(2, 'Myhedin', 'myhedinzika@gmail.com', 'MyhedinZika', 'A123123'),
(3, 'Test@1AM', 'myhedinzika@gmail.com', 'TEST@1AM', 'Testing'),
(4, 'Test@1.01AM', 'myhedinzika@gmail.com', 'TEST@1.01AM', 'Testing'),
(5, 'tgt', 'contact@grandmapizzas.com', 'tgte', 'rtge'),
(6, 'LocalTest', 'LocalTest@gmail.com', 'Local Test', 'Local Test');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `i_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`i_name`) VALUES
('Babycorn'),
('Barbeque Chicken'),
('Black Olives'),
('Capsicum'),
('Chicken Rashers'),
('Chunky Chicken'),
('Crisp Capsicum'),
('Double Barbeque Chicken'),
('Double Chicken Rashers'),
('Extra Cheese'),
('Fresh Tomato'),
('Golden Corn'),
('Hot n Spicy Chicken'),
('Jalapeno'),
('Mushroom'),
('ok this one next wait '),
('Onion'),
('Paneer\r\n'),
('Red Paprika'),
('Red Pepper'),
('Spicy Chicken'),
('Yellow Bell Pepper'),
('ZzzAZ'),
('ZZZZ');

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_photo` varchar(255) NOT NULL,
  `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`p_id`, `p_name`, `p_photo`, `Category`) VALUES
(1, 'Grandmas Pizza', 'GrandmasPizza.png', 1),
(2, 'Non Veg Suprem', 'NonVegSupreme.png', 1),
(3, 'Chicken Golden Delight', 'ChickenGoldenDelight.png', 1),
(4, 'Chunky Fiesta', 'Chunkyfiesta.png', 1),
(5, 'Seventh Heaven', 'SeventhHeaven.png', 1),
(6, 'Chef''s Chicken Choise\r\n', 'ChefsChickenChoice.png', 1),
(7, 'Margherita', 'https://s17.postimg.org/w12b0vm0r/Margherita.png', 2),
(8, 'Deluxe Veggie', 'https://s17.postimg.org/wo17qeiwr/Deluxeveggie.png', 2),
(9, 'Country Special', 'https://s17.postimg.org/9y22xezp7/Countryspecial.png', 2),
(10, 'Cloud 9', 'https://s17.postimg.org/7s36p66uz/Cloud9.png', 2),
(11, 'Veggie Paradise', 'https://s17.postimg.org/c7q7868mz/Veggie_Paradise.png', 2),
(12, 'Farm House', 'https://s17.postimg.org/bsexf5mpn/Farmhouse.png', 2),
(21, 'Saturday ', '20054.jpg', 2),
(22, 'Sunday', '494220.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pizza_ingredient`
--

CREATE TABLE `pizza_ingredient` (
  `pizza` int(11) NOT NULL,
  `ingredient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza_ingredient`
--

INSERT INTO `pizza_ingredient` (`pizza`, `ingredient`) VALUES
(1, 'Black Olives'),
(1, 'Chunky Chicken'),
(1, 'Double Chicken Rashers'),
(1, 'Extra Cheese'),
(1, 'Mushroom'),
(2, 'Barbeque Chicken'),
(2, 'Black Olives'),
(2, 'Chunky Chicken'),
(2, 'Crisp Capsicum'),
(2, 'Hot n Spicy Chicken'),
(2, 'Mushroom'),
(2, 'Onion'),
(3, 'Double Barbeque Chicken'),
(3, 'Extra Cheese'),
(3, 'Golden Corn'),
(4, 'Capsicum'),
(4, 'Chunky Chicken'),
(4, 'Onion'),
(4, 'Spicy Chicken'),
(5, 'Barbeque Chicken'),
(5, 'Double Chicken Rashers'),
(5, 'Jalapeno'),
(5, 'Onion'),
(5, 'Red Pepper'),
(5, 'Yellow Bell Pepper'),
(6, 'Black Olives'),
(6, 'Chicken Rashers'),
(6, 'Crisp Capsicum'),
(6, 'Red Paprika'),
(7, 'Extra Cheese'),
(8, 'Crisp Capsicum'),
(8, 'Golden Corn'),
(8, 'Mushroom'),
(8, 'Onion'),
(8, 'Paneer\r\n'),
(9, 'Crisp Capsicum'),
(9, 'Fresh Tomato'),
(9, 'Onion'),
(10, 'Babycorn'),
(10, 'Crisp Capsicum'),
(10, 'Fresh Tomato'),
(10, 'Jalapeno'),
(10, 'Onion'),
(10, 'Paneer\r\n'),
(11, 'Babycorn'),
(11, 'Black Olives'),
(11, 'Crisp Capsicum'),
(11, 'Red Paprika'),
(12, 'Crisp Capsicum'),
(12, 'Fresh Tomato'),
(12, 'Mushroom'),
(12, 'Onion'),
(21, 'Extra Cheese'),
(21, 'Fresh Tomato'),
(22, 'Capsicum');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_size`
--

CREATE TABLE `pizza_size` (
  `pizza` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza_size`
--

INSERT INTO `pizza_size` (`pizza`, `size`, `price`) VALUES
(1, 1, 3.5),
(1, 2, 5.5),
(1, 3, 7.5),
(2, 1, 2.5),
(2, 2, 4.5),
(2, 3, 6.5),
(3, 1, 3),
(3, 2, 5),
(3, 3, 7),
(4, 1, 2.5),
(4, 2, 4.5),
(4, 3, 6.5),
(5, 1, 3),
(5, 2, 5),
(5, 3, 7),
(6, 1, 2.5),
(6, 2, 4.5),
(6, 3, 6.5),
(7, 1, 1.5),
(7, 2, 3.5),
(7, 3, 4.5),
(8, 1, 2.5),
(8, 2, 4.5),
(8, 3, 6.5),
(9, 1, 3),
(9, 2, 5),
(9, 3, 7),
(10, 1, 2.5),
(10, 2, 4.5),
(10, 3, 6.5),
(11, 1, 2),
(11, 2, 4),
(11, 3, 6),
(12, 1, 2),
(12, 2, 4),
(12, 3, 6),
(21, 1, 5),
(21, 2, 7),
(21, 3, 9),
(22, 1, 1.2),
(22, 2, 2.2),
(22, 3, 3.2);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `diameter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name`, `diameter`) VALUES
(1, 'Small', 20),
(2, 'Medium', 30),
(3, 'Large', 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`C_Id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`i_name`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `pizza_fk0` (`Category`);

--
-- Indexes for table `pizza_ingredient`
--
ALTER TABLE `pizza_ingredient`
  ADD PRIMARY KEY (`pizza`,`ingredient`),
  ADD KEY `pizza_ingredient_fk1` (`ingredient`);

--
-- Indexes for table `pizza_size`
--
ALTER TABLE `pizza_size`
  ADD PRIMARY KEY (`pizza`,`size`),
  ADD KEY `pizza_size_fk1` (`size`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `C_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pizza`
--
ALTER TABLE `pizza`
  ADD CONSTRAINT `pizza_fk0` FOREIGN KEY (`Category`) REFERENCES `category` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `pizza_ingredient`
--
ALTER TABLE `pizza_ingredient`
  ADD CONSTRAINT `pizza_ingredient_fk0` FOREIGN KEY (`pizza`) REFERENCES `pizza` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pizza_ingredient_fk1` FOREIGN KEY (`ingredient`) REFERENCES `ingredients` (`i_name`) ON DELETE CASCADE;

--
-- Constraints for table `pizza_size`
--
ALTER TABLE `pizza_size`
  ADD CONSTRAINT `pizza_size_fk0` FOREIGN KEY (`pizza`) REFERENCES `pizza` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pizza_size_fk1` FOREIGN KEY (`size`) REFERENCES `size` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
