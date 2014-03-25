-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 03 月 25 日 08:00
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `carful`
--

-- --------------------------------------------------------

--
-- 表的结构 `imicro_baby`
--

CREATE TABLE IF NOT EXISTS `imicro_baby` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `pic1` varchar(500) NOT NULL,
  `pic2` varchar(500) NOT NULL,
  `pic3` varchar(500) NOT NULL,
  `content` varchar(255) NOT NULL,
  `praise` int(8) NOT NULL,
  `data` varchar(255) NOT NULL,
  `ispass` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `imicro_pinfo`
--

CREATE TABLE IF NOT EXISTS `imicro_pinfo` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `tel` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `imicro_praise`
--

CREATE TABLE IF NOT EXISTS `imicro_praise` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `data` varchar(200) NOT NULL,
  `bid` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
