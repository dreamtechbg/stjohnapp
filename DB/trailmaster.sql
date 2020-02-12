-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: 192.168.1.3:3306
-- Generation Time: Feb 22, 2013 at 05:20 PM
-- Server version: 5.1.56
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trailmaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_app`
--

CREATE TABLE IF NOT EXISTS `about_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `about_app`
--

INSERT INTO `about_app` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'St. John Island', 'St. John  is an island in the Caribbean Sea and a constituent district of the United States Virgin Islands (USVI), an unincorporated territory of the United States. St. John is located about four miles east of Saint Thomas, the location of the territory''s capital, Charlotte Amalie, and four miles southwest of Tortola, part of the British Virgin Islands. It is 50.8 km² (19.61 sq mi) in area with a population of 4,170 (2010 census).[1] Because there are no airports on St. John, the only access to', '2013-01-10 15:57:23'),
(3, 'test', 'test descriptiontest description', '2013-01-16 12:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `about_island`
--

CREATE TABLE IF NOT EXISTS `about_island` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `discription` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `about_island`
--

INSERT INTO `about_island` (`id`, `name`, `discription`, `created_at`) VALUES
(1, 'History ', 'What makes this little Caribbean island the travellers'' Choice top beach destination for the second year in a row? Families love it for its uncrowded beaches at...', '2013-01-08 12:03:23'),
(7, 'Climate', 'test description', '2013-01-16 18:12:02'),
(11, 'test', 'test', '2013-02-22 11:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`, `created_at`) VALUES
(5, 'zoondia', 'development@zoondia.in', 'admin', '123456', '2013-02-22 10:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('Informational','Commercial') NOT NULL,
  `parent` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `parent`, `created_at`) VALUES
(1, 'Trails', 'Informational', 0, '2013-02-21 11:38:00'),
(2, 'Beaches', 'Informational', 0, '2013-02-21 11:38:13'),
(3, 'Place of Interest', 'Informational', 0, '2013-02-21 11:38:41'),
(4, 'Snorkeling', 'Informational', 0, '2013-02-21 11:38:53'),
(5, 'Accomodations', 'Commercial', 0, '2013-02-21 11:39:14'),
(6, 'Bars & Restaurants', 'Commercial', 0, '2013-02-21 11:39:33'),
(7, 'Activities', 'Commercial', 0, '2013-02-21 11:40:04'),
(8, 'Rental Cars', 'Commercial', 0, '2013-02-21 11:40:31'),
(9, 'Shopping', 'Commercial', 0, '2013-02-21 11:40:56'),
(10, 'Biking', 'Commercial', 7, '0000-00-00 00:00:00'),
(11, 'Scuba Diving', 'Commercial', 7, '0000-00-00 00:00:00'),
(12, 'B & B', 'Commercial', 5, '2013-02-21 11:45:01'),
(13, 'Camp Grounds', 'Commercial', 5, '2013-02-21 11:45:04'),
(14, 'Hotels & Villas', 'Commercial', 5, '2013-02-21 11:45:29'),
(15, 'Main Trails', 'Informational', 1, '2013-02-21 11:49:17'),
(16, 'Secondary Trials', 'Informational', 1, '2013-02-21 11:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(300) DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `latitude` double NOT NULL,
  `lognitude` double NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `name`, `description`, `phone`, `email`, `website`, `location`, `latitude`, `lognitude`, `created_at`) VALUES
(1, 15, 'Lind Point Trail', 'This beach is very nice and theres good snorkeling. The hike to get to the beach was scenic (if you take the upper trail to Lind Point). As with most beaches on St John, the beach is small, but because it requires a hike its not too crowded', NULL, NULL, NULL, NULL, 18.335742, 64.798272, '0000-00-00 00:00:00'),
(2, 15, 'Salomon Beach', 'What makes this little Caribbean island the travellers'' Choice top beach destination for the second year in a row? Families love it for its uncrowded beaches at...', NULL, NULL, NULL, NULL, 18.339108, 64.794683, '0000-00-00 00:00:00'),
(3, 15, 'Caneel Spur Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.337775, 64.791244, '0000-00-00 00:00:00'),
(4, 15, 'Caneel Hill Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.335139, 64.790578, '0000-00-00 00:00:00'),
(5, 15, 'Margaret Hill Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.339919, 64.782039, '0000-00-00 00:00:00'),
(6, 15, 'Water Catchment Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.341653, 64.777461, '0000-00-00 00:00:00'),
(7, 15, 'Hawksnest Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.345306, 64.784222, '0000-00-00 00:00:00'),
(8, 15, 'Peace Hill Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.352181, 64.777628, '0000-00-00 00:00:00'),
(9, 15, 'Susannaberg Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.345172, 64.771669, '0000-00-00 00:00:00'),
(10, 15, 'Catherineberg Road', 'Test Description', NULL, NULL, NULL, NULL, 18.346328, 64.756425, '0000-00-00 00:00:00'),
(11, 15, 'Cinnamon Bay Self Guiding Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.350158, 64.753539, '0000-00-00 00:00:00'),
(12, 15, 'Cinnamon Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.349578, 64.748353, '0000-00-00 00:00:00'),
(13, 15, 'Maria Hope Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.351431, 64.743894, '0000-00-00 00:00:00'),
(14, 15, 'Maho Bay Goat Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.360111, 64.743083, '0000-00-00 00:00:00'),
(15, 15, 'Francis Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.367706, 64.743081, '0000-00-00 00:00:00'),
(16, 15, 'Leinster Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.362181, 64.724606, '0000-00-00 00:00:00'),
(18, 15, 'Brown Bay Tail', 'Test Description', NULL, NULL, NULL, NULL, 18.359258, 64.706842, '0000-00-00 00:00:00'),
(19, 15, 'L Esperance Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.337683, 64.75885, '0000-00-00 00:00:00'),
(20, 15, 'Great Seiban Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.328769, 64.760739, '0000-00-00 00:00:00'),
(21, 15, 'Parret Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.316997, 64.755753, '0000-00-00 00:00:00'),
(22, 15, 'Reef Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.4919, 64.742936, '0000-00-00 00:00:00'),
(23, 15, 'Petroglyph Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.331575, 64.742542, '0000-00-00 00:00:00'),
(24, 15, 'Lameshur Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.326639, 64.737958, '0000-00-00 00:00:00'),
(25, 15, 'Europa Bay Trails', 'Test Description', NULL, NULL, NULL, NULL, 18.319306, 64.730761, '0000-00-00 00:00:00'),
(26, 15, 'Bordeaux Peak Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.334872, 64.729147, '0000-00-00 00:00:00'),
(27, 15, 'Bordeaux Mountain Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.327075, 64.723258, '0000-00-00 00:00:00'),
(28, 15, 'Yawzi Point Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.318039, 64.723258, '0000-00-00 00:00:00'),
(29, 15, 'Lameshur Bay Shoreline Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.315925, 64.72045, '0000-00-00 00:00:00'),
(30, 15, 'Tektite Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.313417, 64.717808, '0000-00-00 00:00:00'),
(31, 15, 'Salt Pond Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.310161, 64.707783, '0000-00-00 00:00:00'),
(32, 15, ' Ram Head Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.305575, 64.705433, '0000-00-00 00:00:00'),
(33, 15, 'Drunk Bay Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.309069, 64.703186, '0000-00-00 00:00:00'),
(34, 15, 'King Hill Road', 'Test Description', NULL, NULL, NULL, NULL, 18.350233, 64.727986, '0000-00-00 00:00:00'),
(35, 16, 'Tamarind Tree Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.338672, 64.784008, '0000-00-00 00:00:00'),
(36, 16, 'Water Catchment Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.341303, 64.780361, '0000-00-00 00:00:00'),
(37, 16, 'Trunk Bay Trail Susannaberg Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.3463, 64.770486, '0000-00-00 00:00:00'),
(38, 16, 'Trunk Bay Road', 'Test Description', NULL, NULL, NULL, NULL, 18.349422, 64.767481, '0000-00-00 00:00:00'),
(39, 16, 'Trunk Bay Road', 'Test Description', NULL, NULL, NULL, NULL, 18.346822, 64.764675, '0000-00-00 00:00:00'),
(40, 16, ' Trunk Bay Trail Catherineberg Spur ', 'Test Description', NULL, NULL, NULL, NULL, 18.345861, 64.762467, '0000-00-00 00:00:00'),
(41, 16, 'Lâ€™Esperance Trail Fish Bay Gut Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.333772, 64.762147, '0000-00-00 00:00:00'),
(42, 16, 'Unnamed Trail 1', 'Test Description', NULL, NULL, NULL, NULL, 18.334256, 64.757453, '0000-00-00 00:00:00'),
(43, 16, '*Camelberg Road', 'Test Description', NULL, NULL, NULL, NULL, 18.332156, 64.753383, '0000-00-00 00:00:00'),
(44, 16, 'Camelberg Road Lesperance Spur 1', 'Test Description', NULL, NULL, NULL, NULL, 18.331903, 64.755994, '0000-00-00 00:00:00'),
(45, 16, 'Camelberg Road Lesperance Spur 2', 'Test Description', NULL, NULL, NULL, NULL, 18.331267, 64.750142, '0000-00-00 00:00:00'),
(46, 16, 'Lesperance Fish Bay Gut Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.327356, 64.751225, '0000-00-00 00:00:00'),
(47, 16, 'Unnamed Trail 2', 'Test Description', NULL, NULL, NULL, NULL, 18.347117, 64.748167, '0000-00-00 00:00:00'),
(48, 16, 'Old Centerline Road Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.347122, 64.745072, '0000-00-00 00:00:00'),
(49, 16, '*Maria Hope Trail South', 'Test Description', NULL, NULL, NULL, NULL, 18.3438, 64.739819, '0000-00-00 00:00:00'),
(50, 16, '*Maria Hope Bordeaux Mt. Road Spu', 'Test Description', NULL, NULL, NULL, NULL, 18.340175, 64.736944, '0000-00-00 00:00:00'),
(51, 16, 'Misgunst Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.336344, 64.732156, '0000-00-00 00:00:00'),
(52, 16, '** White Cliffs Trail (17E)', 'Test Description', NULL, NULL, NULL, NULL, 18.316844, 64.733664, '0000-00-00 00:00:00'),
(53, 16, ' ** White Cliffs Trail (17W)', 'Test Description', NULL, NULL, NULL, NULL, 18.319897, 64.740044, '0000-00-00 00:00:00'),
(54, 16, 'Europa Point Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.319233, 64.728639, '0000-00-00 00:00:00'),
(55, 16, '**Tektite Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.314889, 64.717897, '0000-00-00 00:00:00'),
(56, 16, '** Cabritte Horn Spur Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.309114, 64.719883, '0000-00-00 00:00:00'),
(57, 16, 'Cabritte Horn Grootpan Bay Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.310928, 64.718853, '0000-00-00 00:00:00'),
(58, 16, 'Cabritte Horn Grootpan Bay Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.311628, 64.702283, '0000-00-00 00:00:00'),
(59, 16, 'Brown Bay Princess Bay Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.359481, 64.696142, '0000-00-00 00:00:00'),
(60, 16, 'Turner Point Trail â€“ (24E)', 'Test Description', NULL, NULL, NULL, NULL, 18.347289, 64.682119, '0000-00-00 00:00:00'),
(61, 16, 'Turner Point Trail â€“ (24W)', 'Test Description', NULL, NULL, NULL, NULL, 18.346306, 64.688861, '0000-00-00 00:00:00'),
(62, 16, 'Brown Bay Trail Waterlemon Bay Spur', 'Test Description', NULL, NULL, NULL, NULL, 18.361247, 64.718514, '0000-00-00 00:00:00'),
(63, 16, 'Winberg mamey Peak Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.354189, 64.742917, '0000-00-00 00:00:00'),
(64, 16, 'Mammy Peak Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.349436, 64.738953, '0000-00-00 00:00:00'),
(65, 16, 'Rustenberg Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.343458, 64.751119, '0000-00-00 00:00:00'),
(66, 16, '** The Maria Hope Trailâ€“ (29N)', 'Test Description', NULL, NULL, NULL, NULL, 18.353225, 64.747214, '0000-00-00 00:00:00'),
(67, 16, '** The Maria Hope Trail-(29S)', 'Test Description', NULL, NULL, NULL, NULL, 18.349411, 64.743664, '0000-00-00 00:00:00'),
(68, 16, '** Maria Hope Spur Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.356125, 64.744394, '0000-00-00 00:00:00'),
(69, 16, '* Par Force Trail', 'Test Description', NULL, NULL, NULL, NULL, 18.3304, 64.738569, '0000-00-00 00:00:00'),
(70, 16, '** The Great Seiban Trail ', 'Test Description', NULL, NULL, NULL, NULL, 18.328625, 64.709072, '0000-00-00 00:00:00'),
(71, 16, 'Unnamed Trail 3', 'Test Description', NULL, NULL, NULL, NULL, 18.33055, 64.715578, '0000-00-00 00:00:00'),
(73, 15, 'trail', 'test trail', NULL, NULL, NULL, NULL, 1.3, 1.3, '2013-01-15 12:35:53'),
(75, 15, 'test', 'tesr description', NULL, NULL, NULL, NULL, 1.123445, 1.56789909, '2013-01-15 20:30:39'),
(76, 15, 'vineeth', 'test', NULL, NULL, NULL, NULL, 1.123123, 1.123123, '2013-01-18 12:15:05'),
(77, 15, 'vineeth', 'test', NULL, NULL, NULL, NULL, 1.123123, 1.123123, '2013-01-18 12:15:05'),
(78, 15, 'vineeth', 'test', NULL, NULL, NULL, NULL, 1.123123, 1.123123, '2013-01-18 12:15:05'),
(81, 15, 'test', 'asdasd', NULL, NULL, NULL, NULL, 2123123, 123123123, '2013-01-18 12:30:24'),
(83, 15, 'asdasd', 'teessasdasd', NULL, NULL, NULL, NULL, 12312312, -1.322222, '2013-01-21 16:12:10'),
(87, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(88, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(89, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(90, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(91, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(92, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(93, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(94, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(95, 4, 'sadfasdf', 'sdfsdf', '5454', 'sdfasdf', 'sdafsdf', 'sadfsadf', 52.5564, 52.54585, '0000-00-00 00:00:00'),
(96, 6, 'asd', 'asfas', '12312', 'dfgf@dgfdg.fdg', 'www.ggg.com', 'vineeth', 45.55, -1.12312312, '2013-02-21 19:52:58'),
(97, 6, 'bars', 'xdfg', '62141', 'sdfsd@ef.fgd', 'www.koothara.com', 'dfgdfg', 45.5565, 45.5565, '2013-02-21 19:55:20'),
(98, 6, 'dsfsdf', 'sdf', '62141', 'dfgf@dgfdg.fdg', 'www.fgf.com', 'dfgdfg', 1.123123123, 45.5565, '2013-02-21 20:07:18'),
(99, 6, 'dsfsdf', 'sdf', '62141', 'dfgf@dgfdg.fdg', 'www.fgf.com', 'dfgdfg', 1.123123123, 45.5565, '2013-02-21 20:07:57'),
(100, 6, 'sdfsdf', 'sdfdsf', '565645', 'dfgf@dgfdg.fdg', 'www.fgf.com', 'dfgdfg', 1.123123123, -1.12312312, '2013-02-21 20:08:16'),
(101, 6, 'sdfsdf', 'sdfdsf', '565645', 'dfgf@dgfdg.fdg', 'www.fgf.com', 'dfgdfg', 1.123123123, -1.12312312, '2013-02-21 20:13:27'),
(102, 6, 'sdfsdf', 'sdfdsf', '565645', 'dfgf@dgfdg.fdg', 'www.fgf.com', 'dfgdfg', 1.123123123, -1.12312312, '2013-02-21 20:14:01'),
(104, 6, 'sdfsdf', 'sdfdsf', '565645', 'dfgf@dgfdg.fdg', 'www.fgf.com', 'dfgdfg', 1.123123123, -1.12312312, '2013-02-21 20:16:35'),
(105, 6, 'sdfsdf', 'sdfdsf', '565645', 'dfgf@dgfdg.fdg', 'www.fgf.com', 'dfgdfg', 1.123123123, -1.12312312, '2013-02-21 20:16:50'),
(106, 6, 'dfsdf', 'sdfsdf', '1231231', 'gggg@gggg.com', 'www.fgf.com', 'dfgdfg', 45.55, 45.55, '2013-02-21 20:18:33'),
(107, 6, 'sdfsdf', 'sdfsdf', '12312', 'gggg@gggg.com', 'www.fgf.com', 'ggggg', 1.123123123, 45.55, '2013-02-21 20:27:36'),
(110, 2, 'sdfsdf', 'sdgfsdf', '', '', '', '', 45.55, 45.5565, '2013-02-21 20:33:46'),
(111, 2, 'sdfsdf', 'sdfsdf', '', '', '', '', 45.55, 45.5565, '2013-02-21 20:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

CREATE TABLE IF NOT EXISTS `item_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned NOT NULL,
  `image` varchar(150) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `item_images`
--

INSERT INTO `item_images` (`id`, `item_id`, `image`, `caption`, `created_at`) VALUES
(1, 105, '02212013081650green-nature-wallpaper1.jpg', 'sefrsd', '0000-00-00 00:00:00'),
(2, 106, '02212013081833nature-wallpaper-06.jpg', 'sdfsdf', '0000-00-00 00:00:00'),
(3, 106, '02212013081833green-nature-wallpaper1.jpg', 'sdfsdfsdfsdf', '0000-00-00 00:00:00'),
(6, 111, '02212013083357green-nature-wallpaper1.jpg', 'sdfsdf', '0000-00-00 00:00:00'),
(7, 105, '02222013030400nature-wallpaper-06.jpg', 'Test Caption', '0000-00-00 00:00:00'),
(9, 95, '02222013042502green-nature-wallpaper1.jpg', 'caption test', '0000-00-00 00:00:00'),
(10, 95, '02222013043643nature-wallpaper-06.jpg', 'Test Caption', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_images`
--
ALTER TABLE `item_images`
  ADD CONSTRAINT `item_images_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
