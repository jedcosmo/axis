-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2016 at 11:52 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `axis`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `uri` varchar(300) DEFAULT NULL,
  `heading` text NOT NULL,
  `subheading` text NOT NULL,
  `excerpt` varchar(250) DEFAULT NULL,
  `content1` text,
  `content2` text NOT NULL,
  `content3` text NOT NULL,
  `content4` text NOT NULL,
  `content5` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'published',
  `featured_img` varchar(300) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `video1` varchar(255) DEFAULT NULL,
  `video2` varchar(255) DEFAULT NULL,
  `video3` varchar(255) DEFAULT NULL,
  `video4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `user_id`, `title`, `uri`, `heading`, `subheading`, `excerpt`, `content1`, `content2`, `content3`, `content4`, `content5`, `status`, `featured_img`, `date_created`, `date_updated`, `video1`, `video2`, `video3`, `video4`) VALUES
(9, 1, 'Home', 'home', 'GET ACTIVE. GET FIT.', 'Get on board with your Active Empowered Community', NULL, '<h3>WHO WE ARE?</h3>\r\n\r\n<hr />\r\n<p>The Axis Project is a multidisciplinary center committed to providing high quality services for those with physical disabilities. This unique center empowers people with physical disabilities to pursue a healthy, active lifestyle. Our center is completely wheelchair accessible and includes all accessible equipment. The Axis Project ofers programs, activities, and classes specifically designed for people with physical disabilities and ofers the chance to take charge of you</p>\r\n', '<h3>OUR PROGRAMS</h3>\r\n\r\n<hr />', '<p>Work Your <span class="orange">Mind,</span> <span class="green"> Body</span> <span class="purple"> and Spirit</span></p>\r\n\r\n<p><span class="text-left">DO IT NOW...</span></p>\r\n\r\n<div class="clearfix">&nbsp;</div>\r\n\r\n<p><span class="text-right">Sometimes &#39;LATER&#39; becomes &#39;NEVER&#39;</span></p>\r\n', '<h3>BLOGS</h3>\r\n\r\n<hr />', '<h3>EVENTS</h3>\r\n\r\n<hr />', 'published', '', '2016-10-14 23:20:13', '2016-10-14 23:44:12', NULL, NULL, NULL, NULL),
(10, 1, 'Programs', 'programs', 'PROGRAMS', 'Spinal Mobility &amp;bull;\r\nAdvocay Desk &amp;bull; &lt;br/&gt;\r\nAccess Computing Lab &amp;bull;\r\nWheelchair Pit Stop &amp;bull;\r\nTherapeutic Yoga &amp;bull;\r\nCardio Boxing &amp;bull;&lt;br/&gt;\r\nSpinning and Handcycling', NULL, '<p><span>Donec eleifend, velit consectetur congue pharetra</span></p>\r\n\r\n<p>Velit eros dignissim tellus, ac euismod enim sapien et quam. Sed sed condimentum mi. Aliquam fringilla ornare luctus. Aenean semper nulla tempor dolor tempor, nec dictum leo finibus.</p>\r\n', '<p><span>Donec eleifend, velit consectetur congue pharetra</span></p>\r\n\r\n<p>Velit eros dignissim tellus, ac euismod enim sapien et quam. Sed sed condimentum mi. Aliquam fringilla ornare luctus. Aenean semper nulla tempor dolor tempor, nec dictum leo finibus.</p>\r\n', '<h3>JOIN US</h3>\r\n\r\n<hr />\r\n<p>Proin id justo lacus. Integer nec ex pretium, ullamcorper neque et, condimentum orci. Proin iaculis ex est, eu tincidunt leo sagittis et. Praesent scelerisque, ligula sit amet fermentum blandit, erat lectus aliquam enim, sed aliquet libero mauris ut neque. Nam eleifend semper dignissim. Vivamus fringilla ornare ligula id euismod.</p>\r\n', '', '', 'published', '/upload/programs.jpg', '2016-10-14 23:23:41', '2016-10-20 21:55:14', NULL, NULL, NULL, NULL),
(11, 1, 'About', 'about', 'ABOUT AXIS PROJECT', 'The Axis Project is a new and innovative multidisciplinary center\r\nspecifically designed for people with disabilities.', NULL, '<h3>OUR MISSION</h3>\r\n\r\n<hr />\r\n<p>Nunc suscipit dictum sodales. Ut eleifend non velit non iaculis. Suspendisse convallis suscipit dui. Donec faucibus in nunc non gravida. Maecenas ornare ligula ut tristique mattis. Fusce ultricies maximus nibh, id vehicula elit blandit sed. Suspendisse nec elit rutrum, interdum lorem vel, imperdiet dolor. Sed ante quam, tristique sed arcu a, vulputate lacinia nibh. Morbi scelerisque laoreet dui vel consequat. Cras cursus eget tortor in ultricies.</p>\r\n', '<h3>OUR STORY</h3>\r\n\r\n<hr />\r\n<p>Nunc suscipit dictum sodales. Ut eleifend non velit non iaculis. Suspendisse convallis suscipit dui. Donec faucibus in nunc non gravida. Maecenas ornare ligula ut tristique mattis. Fusce ultricies maximus nibh, id vehicula elit blandit sed. Suspendisse nec elit rutrum, interdum lorem vel, imperdiet dolor. Sed ante quam, tristique sed arcu a, vulputate lacinia nibh. Morbi scelerisque laoreet dui vel consequat. Cras cursus eget tortor in ultricies. Pellentesque molestie varius lectus, vitae convallis tellus pulvinar et. Cras vulputate convallis neque et placerat.<br />\r\n<br />\r\nProin fringilla consequat tellus, quis accumsan metus accumsan sit amet. Vivamus tincidunt accumsan erat, non commodo dui tristique ac. Pellentesque a sem vestibulum, cursus metus eget, accumsan arcu. In vel pretium tellus. Donec tincidunt tristique elit laoreet sodales. Aenean vel nibh vitae diam eleifend ultrices. Aenean consequat nisi neque, et hendrerit risus mattis in. Etiam bibendum leo a ipsum feugiat, vitae efficitur quam bibendum. Morbi pretium bibendum massa, tempus tempor leo efficitur sed.<br />\r\n<br />\r\nProin id justo lacus. Integer nec ex pretium, ullamcorper neque et, condimentum orci. Proin iaculis ex est, eu tincidunt leo sagittis et. Praesent scelerisque, ligula sit amet fermentum blandit, erat lectus aliquam enim, sed aliquet libero mauris ut neque. Nam eleifend semper dignissim. Vivamus fringilla ornare ligula id euismod. Nulla aliquam eleifend leo, at elementum felis placerat sed. Phasellus pellentesque, risus nec placerat tristique, elit erat aliquam lacus, sit amet molestie enim.</p>\r\n', '<h3>NEEDS</h3>\r\n\r\n<hr />\r\n<p>Proin id justo lacus. Integer nec ex pretium, ullamcorper neque et, condimentum orci. Proin iaculis ex est, eu tincidunt leo sagittis et. Praesent scelerisque, ligula sit amet fermentum blandit, erat lectus aliquam enim, sed aliquet libero mauris ut neque. Nam eleifend semper dignissim. Vivamus fringilla ornare ligula id euismod.</p>\r\n', '<h3>RESPONSE</h3>\r\n\r\n<hr />\r\n<p>Proin id justo lacus. Integer nec ex pretium, ullamcorper neque et, condimentum orci. Proin iaculis ex est, eu tincidunt.</p>\r\n', '<div class="row related">\r\n<div class="col-md-6"><img src="http://localhost/axis/assets/img/wf.png" />\r\n<p>Nulla viverra consectetur libero, a euismod dolor. Donec sed malesuada dolor, id varius orci. Sed quis accumsan erat. Sed pretium nec eros id varius. Etiam volutpat venenatis semper. Vestibulum tempor non nisi vitae ornare. Curabitur vitae tristique augue.</p>\r\n</div>\r\n\r\n<div class="col-md-6"><img src="http://localhost/axis/assets/img/wof.png" />\r\n<p>Nulla viverra consectetur libero, a euismod dolor. Donec sed malesuada dolor, id varius orci. Sed quis accumsan erat. Sed pretium nec eros id varius. Etiam volutpat venenatis semper. Vestibulum tempor non nisi vitae ornare. Curabitur vitae tristique augue.</p>\r\n</div>\r\n</div>\r\n', 'published', '/upload/about.jpg', '2016-10-14 23:25:43', '2016-10-24 19:46:16', 'https://vimeo.com/115548511', '', '', ''),
(12, 1, 'Calendar', 'calendar', 'CALENDAR', 'Join the Axis Project for Action Packed Events. Get Active. Get Empowered. Here with Us!', NULL, '<h3>TODAY AT AXIS</h3>\r\n\r\n<hr />', '<h3>WEEKLY CALENDAR</h3>\r\n\r\n<hr />', '<h3>EVENTS</h3>\r\n\r\n<hr />', '', '', 'published', '/upload/calendar.jpg', '2016-10-14 23:26:41', '2016-10-20 21:55:21', NULL, NULL, NULL, NULL),
(13, 1, 'Shop', 'shop', 'SHOP', 'The Axis Project is a new and innovative multidisciplinary center\r\nspecifically designed for people with disabilities.', NULL, '', '', '', '', '', 'published', '/upload/shop.jpg', '2016-10-14 23:27:02', '2016-10-20 21:55:24', NULL, NULL, NULL, NULL),
(14, 1, 'Client Profiles', 'client-profiles', 'Stories', 'The Axis Project is a new and innovative multidisciplinary center\r\nspecifically designed for people with disabilities.', NULL, '<h3>VIDEO TITLE</h3>\r\n\r\n<p>Vestibulum dictum ipsum mi. Aliquam eu turpis nisl. Donec id magna ac nulla maximus sollicitudin nec eu libero. In volutpat justo dictum, semper sem eu, hendrerit dolor.</p>\r\n', '', '', '', '', 'published', '/upload/client_profile.jpg', '2016-10-14 23:27:49', '2016-10-24 20:08:15', 'https://vimeo.com/115548511', '', '', ''),
(15, 1, 'Blogs', 'blogs', 'BLOGS', 'The Axis Project is a new and innovative multidisciplinary center\r\nspecifically designed for people with disabilities.', NULL, '', '', '', '', '', 'published', '/upload/blogs.jpg', '2016-10-14 23:28:15', '2016-10-20 21:55:07', NULL, NULL, NULL, NULL),
(16, 1, 'Contact', 'contact', 'CONTACT US', '1325 5th Ave, New York, New York 10026\r\n&lt;br/&gt;\r\n+1 646-450-0077', NULL, '', '', '', '', '', 'published', '/upload/contact.jpg', '2016-10-15 00:09:17', '2016-10-20 21:54:57', NULL, NULL, NULL, NULL),
(17, 1, 'Get Involved', 'get-involved', '', '', NULL, '<ul class="list-unstyled">\r\n	<li style="background:;">\r\n	<div><a href="javascript:void(0)"><i class="fa fa-fw fa-building"></i></a></div>\r\n	<a href="javascript:void(0)"><span>BRING AXIS TO YOUR COMMUNITY</span> </a></li>\r\n	<li style="background:;">\r\n	<div><a href="javascript:void(0)"><i class="fa fa-fw fa-tty"></i></a></div>\r\n	<a href="javascript:void(0)"><span>START A CONVERSATION</span> </a></li>\r\n	<li style="background:;">\r\n	<div><a href="javascript:void(0)"><i class="fa fa-fw fa-rss"></i></a></div>\r\n	<a href="javascript:void(0)"><span>STAY INFORMED</span> </a></li>\r\n	<li style="background:;">\r\n	<div><a href="javascript:void(0)"><i class="fa fa-fw fa-flag"></i></a></div>\r\n	<a href="javascript:void(0)"><span>EVENTS AND CAMPAIGNS</span> </a></li>\r\n	<li style="background:;">\r\n	<div><a href="javascript:void(0)"><i class="fa fa-fw fa-money"></i></a></div>\r\n	<a href="javascript:void(0)"><span>FUNDRAISE</span> </a></li>\r\n</ul>\r\n', '<h4>JOIN US</h4>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent suscipit neque sed mi dignissim, ut elementum libero luctus. Phasellus sed vulputate lorem. Mauris dapibus lacus sapien, at vulputate metus tempus eget. Ut ornare vehicula tempor. Curabitur scelerisque vulputate ornare. Maecenas ultrices finibus nibh, ac mollis velit. Nam mauris turpis, varius quis orci id, pretium eleifend odio. Sed eget neque velit. Suspendisse fringilla, nisi ac lacinia gravida</p>\r\n', '<h4>VOLUNTEER</h4>\r\n\r\n<p>Cras placerat tempus ligula, vel tincidunt dolor suscipit eu. Etiam feugiat justo vel sem pellentesque, eget lacinia quam aliquet. Integer et vulputate odio, quis malesuada arcu. Etiam posuere arcu ex, a viverra mi congue vel. Nam commodo velit non dui tempus vulputate. Nulla vel metus et arcu blandit convallis sagittis sit amet enim.</p>\r\n', '<h4>PARTNER WITH US</h4>\r\n\r\n<p>Proin ut ex sed erat tempor ultricies quis ac neque. Nullam ultrices eu ex in lacinia. Morbi et neque ac ante molestie gravida non ut justo. Nulla facilisi. Suspendisse lectus tellus, sagittis vel quam at, eleifend facilisis felis.</p>\r\n', '', 'published', '', '2016-10-18 22:54:18', '2016-10-24 17:34:55', NULL, NULL, NULL, NULL),
(18, 1, 'asdasdasd', 'asdasdasd', '', '', NULL, '', '', '', '', '', 'trashed', '/upload/\\play.png', '2016-10-20 21:30:27', '2016-10-20 21:35:35', NULL, NULL, NULL, NULL),
(19, 1, 'asdasdasd', 'asdasdasd-1', '', '', NULL, '', '', '', '', '', 'trashed', '/upload/\\tart.PNG', '2016-10-20 21:34:59', '2016-10-20 21:35:43', NULL, NULL, NULL, NULL),
(20, 1, 'Test Page', 'test-page', '', '', NULL, '', '', '', '', '', 'trashed', '/upload/\\arrow_white.png', '2016-10-20 22:02:07', '2016-10-20 22:05:36', NULL, NULL, NULL, NULL),
(21, 1, 'Join Us', 'join-us', 'JOIN US', 'Join Us Now', NULL, '<p>Nullam eget nunc ac velit cursus feugiat. Praesent luctus ligula sit amet tempus ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean interdum ex vitae lacus ultrices, vitae facilisis velit pretium. Fusce lobortis eros in velit eleifend euismod. Suspendisse potenti. Aliquam sed quam sapien. Aliquam erat volutpat. Ut ornare ex at lobortis posuere. Proin sollicitudin tempor suscipit. Nam luctus, nisi nec iaculis aliquet, nisi neque fermentum ipsum, eget bibendum lorem augue nec sapien. Fusce sem mi, maximus eget leo at, ultricies efficitur arcu. Sed nulla est, maximus ultricies leo id, molestie pretium turpis.</p>\r\n', '', '', '', '', 'published', '', '2016-10-21 00:59:40', '2016-10-21 01:06:31', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `uri` (`uri`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
