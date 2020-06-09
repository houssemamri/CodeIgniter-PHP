-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2016 at 12:54 PM
-- Server version: 5.6.28
-- PHP Version: 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `active` text NOT NULL,
  `email` text NOT NULL,
  `resetToken` text NOT NULL,
  `resetComplete` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'sample@email.com', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `bulky`
--

CREATE TABLE IF NOT EXISTS `bulky` (
  `id` int(11) NOT NULL,
  `template` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulky`
--

INSERT INTO `bulky` (`id`, `template`) VALUES
(1, '<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">\r\n	<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">\r\n    <tbody>\r\n        <tr>\r\n        	<td>\r\n                <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">\r\n                <tbody>\r\n                	<tr>\r\n                    	<td>\r\n                			<table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">\r\n                            <tbody>\r\n                            	<tr>\r\n                                    <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">\r\n                                        <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">\r\n                                        <tbody>\r\n                                        	<tr>\r\n                                            	<td width="30"></td>\r\n                                                <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://www.codexworld.com/" target="_blank"><img src="http://www.codexworld.com/wp-content/uploads/2014/09/codexworld-logo.png" alt="codexworld" ></a></td>\r\n                                                <td width="30"></td>\r\n                                            </tr>\r\n                                       	</tbody>\r\n                                        </table>\r\n                                  	</td>\r\n                    			</tr>\r\n                                <tr>\r\n                                    <td colspan="3" align="center">\r\n                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0">\r\n                                        <tbody>\r\n                                        	<tr>\r\n                                            	<td colspan="3" height="60"></td></tr><tr><td width="25"></td>\r\n                                                <td align="center">\r\n                                                    <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Welcome to CodexWorld Programming Blog</h1>\r\n                                                </td>\r\n                                                <td width="25"></td>\r\n                                            </tr>\r\n                                            <tr>\r\n                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">\r\n                                                    <p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">CodexWorld was released on September, 2014 as a programming blog. Our mission is to provide the best online resources on programming and web development. We deliver the useful and best tutorials for web professionals &mdash; developers, programmers, freelancers and site owners. Any visitors of this site are free to browse our tutorials, live demos and download scripts.</p><br>\r\n                                                    <p style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">\r\n                    Learn PHP, MySQL, JavaScript, jQuery, Ajax, WordPress, Drupal, CodeIgniter, CakePHP, Web Development with CodexWorld tutorials. View live demo and download scripts.</p>\r\n                                                </td>\r\n                                            </tr>\r\n                                            <tr>\r\n                                            <td colspan="4">\r\n                                                <div style="width:100%;text-align:center;margin:30px 0">\r\n                                                    <table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0">\r\n                                                    <tbody>\r\n                                                    	<tr>\r\n                                                            <td align="center" style="margin:0;text-align:center"><a href="http://www.codexworld.com/" style="font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Visit website!</a></td>\r\n                                                      	</tr>\r\n                                                   	</tbody>\r\n                                                    </table>\r\n                                               	</div>\r\n                                           	</td>\r\n                                       	</tr>\r\n                                        <tr><td colspan="3" height="30"></td></tr>\r\n                                 	</tbody>\r\n                                    </table>\r\n                             	</td>\r\n                   			</tr>\r\n                            \r\n                            <tr bgcolor="#ffffff">\r\n                                <td width="30" bgcolor="#eeeeee"></td>\r\n                                <td>\r\n                                    <table width="570" align="center" border="0" cellspacing="0" cellpadding="0">\r\n                                    <tbody>\r\n                                    	<tr>\r\n                                        	<td colspan="4" align="center">&nbsp;</td>\r\n                                      	</tr>\r\n                                        <tr>\r\n                                        	<td colspan="4" align="center"><h2 style="font-size:24px">Best Tutorials on</h2></td>\r\n                                      	</tr>\r\n                                        <tr>\r\n                                        	<td colspan="4">&nbsp;</td>\r\n                                      	</tr>\r\n                                        <tr>\r\n                                        	<td width="120" align="right" valign="top"><img src="http://i.imgbox.com/qrfX6RWN.png" alt="tool" width="120" height="120"></td>\r\n                                            <td width="30"></td>\r\n                                            <td align="left" valign="middle">\r\n                                                <h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Programming</h3>\r\n                                                <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>\r\n                                                <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">PHP/MySQL, Frameworks (CodeIgniter, CakePHP etc.), CMS (Drupal, WordPress etc.), Ajax, jQuery, JavaScript, HTML, CSS amd many more.</div>\r\n                                                <div style="line-height:10px;padding:0;margin:0">&nbsp;</div>\r\n                                          	</td>\r\n                                            <td width="30"></td>\r\n                                        </tr>\r\n                                        <tr>\r\n                                        	<td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>\r\n                                      	</tr>\r\n                                        <tr>\r\n                                        	<td width="120" align="right" valign="top"><img src="http://i.imgbox.com/5zbmOytI.png" alt="no fees" width="120" height="120"></td>\r\n                                            <td width="30"></td>\r\n                                            <td align="left" valign="middle">\r\n                                            	<h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Web Development</h3>\r\n                                              	<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>\r\n                                              	<div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Web development makes simple.</div>\r\n                                              	<div style="line-height:10px;padding:0;margin:0">&nbsp;</div>\r\n                                          	</td>\r\n                                            <td width="30"></td>\r\n                                        </tr>\r\n                                        <tr>\r\n                                        	<td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>\r\n                                       	</tr>\r\n                                        <tr>\r\n                                        	<td width="120" align="right" valign="top"><img src="http://i.imgbox.com/AXtx1Oto.png" alt="creditibility" width="120" height="120" class="CToWUd"></td>\r\n                                            <td width="30"></td>\r\n                                            <td align="left" valign="middle">\r\n                                            	<h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">API Implementation</h3>\r\n                                              	<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>\r\n                                              	<div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Google, Google+, Google Map, Facebook, Twitter, LinkedIn and many more.</div>\r\n                                          		<div style="line-height:10px;padding:0;margin:0">&nbsp;</div>\r\n                                           	</td>\r\n                                            <td width="30"></td>\r\n                                        </tr>\r\n                                        <tr>\r\n                                        	<td colspan="4">&nbsp;</td>\r\n                                        </tr>\r\n                                  	</tbody>\r\n                                    </table>\r\n                                    <table width="570" align="center" border="0" cellspacing="0" cellpadding="0">\r\n                                    <tbody>\r\n                                    	<tr>\r\n                                        	<td>\r\n                                            	<h2 style="color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0">&nbsp;</h2>\r\n                                        		<div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Visit CodexWorld now and access tutorials, view live demo, download scripts at free of cost. </div>\r\n                                          	</td>\r\n                                      	</tr>\r\n                                        <tr>\r\n                                        	<td align="center">\r\n                                                <div style="text-align:center;width:100%;padding:40px 0">\r\n                                                    <table align="center" cellpadding="0" cellspacing="0" style="margin:0 auto;padding:0">\r\n                                                    <tbody>\r\n                                                    	<tr>\r\n                                                        	<td align="center" style="margin:0;text-align:center"><a href="http://www.codexworld.com/" style="font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block" target="_blank">Visit Now!</a></td>\r\n                                                    	</tr>\r\n                                                   	</tbody>\r\n                                                 	</table>\r\n                                              	</div>\r\n                                        	</td>\r\n                                      </tr><tr><td>&nbsp;</td>\r\n                                      </tr></tbody></table></td>\r\n                                <td width="30" bgcolor="#eeeeee"></td>\r\n                            </tr>\r\n                          	</tbody>\r\n                            </table>\r\n                  			<table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">\r\n                            <tbody>\r\n                            	<tr>\r\n                                	<td>\r\n                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">\r\n                                        <tbody>\r\n                                        	<tr><td colspan="2" height="30"></td></tr>\r\n                                            <tr>\r\n                                            	<td width="360" valign="top">\r\n                                                	<div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">&copy; 2015 CodexWorld. All rights reserved.</div>\r\n                                                	<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>\r\n                                                	<div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">Made in India</div>\r\n                                        		</td>\r\n                                              	<td align="right" valign="top">\r\n                                                	<span style="line-height:20px;font-size:10px"><a href="https://www.facebook.com/codexworld" target="_blank"><img src="http://i.imgbox.com/BggPYqAh.png" alt="fb"></a>&nbsp;</span>\r\n                                                    <span style="line-height:20px;font-size:10px"><a href="https://twitter.com/codexworldblog" target="_blank"><img src="http://i.imgbox.com/j3NsGLak.png" alt="twit"></a>&nbsp;</span>\r\n                                                    <span style="line-height:20px;font-size:10px"><a href="https://plus.google.com/+codexworld" target="_blank"><img src="http://i.imgbox.com/wFyxXQyf.png" alt="g"></a>&nbsp;</span>\r\n                                              	</td>\r\n                                            </tr>\r\n                                            <tr><td colspan="2" height="5"></td></tr>\r\n                                           \r\n                                      	</tbody>\r\n                                        </table>\r\n                                   	</td>\r\n                  				</tr>\r\n                          	</tbody>\r\n                            </table>\r\n                  		</td>\r\n                	</tr>\r\n              	</tbody>\r\n                </table>\r\n            </td>\r\n		</tr>\r\n 	</tbody>\r\n    </table>\r\n</div>');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL,
  `pageid` text NOT NULL,
  `name` text NOT NULL,
  `contact_address` text NOT NULL,
  `phone` text NOT NULL,
  `emails` text NOT NULL,
  `website` text NOT NULL,
  `fan_count` text NOT NULL,
  `link` text NOT NULL,
  `is_verified` text NOT NULL,
  `about` text NOT NULL,
  `picture` text NOT NULL,
  `category` text NOT NULL,
  `cover` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

CREATE TABLE IF NOT EXISTS `email_verification` (
  `email` varchar(255) NOT NULL,
  `code` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `active` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `active`, `email`) VALUES
(2, 'josphat', '$2y$10$gmeTmyMGmqku3ZS3KS5DWO3fbFsJ2NrTCzfqs5DjPtJow9IkKKWuS', 'Yes', 'josshewanjiru@gmail.com'),
(3, 'natan', '$2y$10$9fjTjynyZ5O8V/37dbABZOVvIaVHZ/v/MXWheLlAKKnjlh19KGhGm', 'Yes', 'natanmizrahi@gmail.com'),
(4, 'emersonbigguns', '$2y$10$YpUs8ZM18ayDcf1auu71luz9y3z4pI35/C9dgivzDkvdxxrxrQvi2', 'd9c1c980bd4a788fdb9c3a65d3b19d26', 'hackmackdude2012@yahoo.com'),
(5, 'ads Ã ', '$2y$10$gqzrRRM9thA7qOUvuiAg4euLbTtr3r4k7p5lfmSHJU8YqYfGumNL.', '7f434ae8f24b09ffbe02355b271141f5', 'sssss@ddddd.vn'),
(6, 'trytest1', '$2y$10$szDUdi.490dqbd8YYcb2n.Wmjr6DKU89YzxwxjFF.2U0HOKSM5TKm', 'Yes', 'zaman_waheed@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(50) NOT NULL,
  `plan_price` int(10) NOT NULL,
  `plan_code` int(1) unsigned NOT NULL,
  `plan_desc` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `plan_name`, `plan_price`, `plan_code`, `plan_desc`) VALUES
(1, 'Free', 0, 0, 'This plan allows you to use the site as a free member.'),
(2, 'Starter', 4, 1, 'This plan gives you the option to use the site as a premium starter member.'),
(3, 'Premier', 10, 2, 'This plan gives you the option to use the site as a premium premier member.'),
(4, 'Ultimate', 15, 3, 'This plan gives you the option to use the site as a premium ultimate member.');

-- --------------------------------------------------------

--
-- Table structure for table `premium_users`
--

CREATE TABLE IF NOT EXISTS `premium_users` (
  `user_id` int(10) unsigned NOT NULL,
  `premium_plan` varchar(3) NOT NULL DEFAULT '1',
  `reg_date` char(10) NOT NULL,
  `exp_date` char(10) NOT NULL,
  `next_plan` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premium_users`
--

INSERT INTO `premium_users` (`user_id`, `premium_plan`, `reg_date`, `exp_date`, `next_plan`) VALUES
(2, '3', '18-08-2012', '18-11-2012', 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL,
  `sername` text NOT NULL,
  `serno` text NOT NULL,
  `serip` text NOT NULL,
  `sertime` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `password` char(40) NOT NULL,
  `premium` varchar(3) NOT NULL DEFAULT 'no',
  `reg_date` char(10) NOT NULL,
  `verified` char(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `email`, `country`, `password`, `premium`, `reg_date`, `verified`) VALUES
(1, 'Free User', 'freeuser', 'freeuser@sample.com', 'United States', 'fec5d5fefee049ef327decced150e7322d849fa5', 'no', '18-08-2012', 'yes'),
(2, 'Premium User', 'premium', 'premium@sample.com', 'United States', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', '12-08-2012', 'yes'),
(13, 'wanjiru', '', 'josshewanjiru@gmail.com', 'Kenya', '1300729dc67a0941dd51beee7d9545382bd7ee2f', 'no', '29-08-2016', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bulky`
--
ALTER TABLE `bulky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verification`
--
ALTER TABLE `email_verification`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `premium_users`
--
ALTER TABLE `premium_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bulky`
--
ALTER TABLE `bulky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `premium_users`
--
ALTER TABLE `premium_users`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
