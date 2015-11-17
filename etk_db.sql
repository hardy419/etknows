-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 11 月 17 日 09:03
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `etk_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `etk_comment`
--

CREATE TABLE IF NOT EXISTS `etk_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `file_pic` varchar(255) NOT NULL,
  `file_audio` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `addtime` datetime NOT NULL,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `POST_ID` (`post_id`),
  KEY `COMMENT_ID` (`comment_id`),
  KEY `STATUS` (`status`),
  KEY `USERID` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- 表的结构 `etk_post`
--

CREATE TABLE IF NOT EXISTS `etk_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `file_pic` varchar(255) NOT NULL,
  `file_audio` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `addtime` datetime NOT NULL,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `STATUS` (`status`),
  KEY `USERID` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- 表的结构 `etk_user`
--

CREATE TABLE IF NOT EXISTS `etk_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `addtime` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `sid` varchar(1000) NOT NULL,
  `last_login_datetime` datetime NOT NULL,
  `last_login_location` varchar(120) NOT NULL,
  `cur_login_datetime` datetime NOT NULL,
  `cur_login_location` varchar(120) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idcard_num` varchar(30) NOT NULL,
  `idcard_front` varchar(255) NOT NULL,
  `idcard_back` varchar(255) NOT NULL,
  `payee` varchar(20) NOT NULL,
  `bankcard_num` varchar(30) NOT NULL,
  `bankcard_issuer` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `info` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `USERNAME` (`username`),
  KEY `STATUS` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `etk_user`
--

INSERT INTO `etk_user` (`id`, `username`, `password`, `addtime`, `type`, `sid`, `last_login_datetime`, `last_login_location`, `cur_login_datetime`, `cur_login_location`, `contact`, `qq`, `tel`, `email`, `idcard_num`, `idcard_front`, `idcard_back`, `payee`, `bankcard_num`, `bankcard_issuer`, `status`, `info`) VALUES
(1, 'hardy', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '2015-10-22 22:25:46', 1, '9c60b644db1538304eb57ac96662e95c0ca8c5dd', '2015-10-23 19:43:12', '', '2015-10-23 19:44:57', '深圳市', '', '', '', '', '', '', '', '', '', '', 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
