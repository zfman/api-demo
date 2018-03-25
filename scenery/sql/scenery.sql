-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-02-22 12:38:32
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scenery`
--

-- --------------------------------------------------------

--
-- 表的结构 `collect`
--

CREATE TABLE IF NOT EXISTS `collect` (
  `cid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `cowner` varchar(50) NOT NULL COMMENT '持有用户ID',
  `ctarget` bigint(20) NOT NULL COMMENT 'Scenery ID',
  `ctime` varchar(30) NOT NULL COMMENT '时间',
  `cenable` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否可用',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='收藏表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `collect`
--

INSERT INTO `collect` (`cid`, `cowner`, `ctarget`, `ctime`, `cenable`) VALUES
(3, '56bb813c7638ac210eb8ca4fe4e43d0a', 9, '1519295763', 0),
(4, '56bb813c7638ac210eb8ca4fe4e43d0a', 10, '1519297990', 1);

-- --------------------------------------------------------

--
-- 表的结构 `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `fid` bigint(20) NOT NULL AUTO_INCREMENT,
  `fowner` varchar(50) NOT NULL,
  `ftarget` varchar(50) NOT NULL,
  `ftime` varchar(30) NOT NULL,
  `fenable` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`fid`),
  UNIQUE KEY `fid` (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `friends`
--

INSERT INTO `friends` (`fid`, `fowner`, `ftarget`, `ftime`, `fenable`) VALUES
(7, '56bb813c7638ac210eb8ca4fe4e43d0a', '2fce00147a76002934a9e04bcd83c729', '1519271456', 0),
(8, '56bb813c7638ac210eb8ca4fe4e43d0a', '2fce00147a76002934a9e04bcd83c729', '1519271477', 0),
(9, '56bb813c7638ac210eb8ca4fe4e43d0a', '2fce00147a76002934a9e04bcd83c729', '1519278502', 0);

-- --------------------------------------------------------

--
-- 表的结构 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `rid` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `revent` varchar(50) NOT NULL,
  `rtime` varchar(30) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `scenery`
--

CREATE TABLE IF NOT EXISTS `scenery` (
  `sid` bigint(20) NOT NULL AUTO_INCREMENT,
  `sarticle` varchar(10000) NOT NULL,
  `sowner` varchar(50) NOT NULL,
  `stime` varchar(30) NOT NULL,
  `slongitude` float NOT NULL COMMENT '经度',
  `slatitude` float NOT NULL COMMENT '纬度',
  `slocation` varchar(30) NOT NULL COMMENT '地址',
  `senable` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`sid`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `scenery`
--

INSERT INTO `scenery` (`sid`, `sarticle`, `sowner`, `stime`, `slongitude`, `slatitude`, `slocation`, `senable`) VALUES
(9, '这是Scenery', '56bb813c7638ac210eb8ca4fe4e43d0a', '1519295609', 114.578, 35.4055, '白露村', 0),
(10, '这是Scenery', '56bb813c7638ac210eb8ca4fe4e43d0a', '1519297104', 114.578, 35.4055, '白露村', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` varchar(50) NOT NULL,
  `utel` varchar(20) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `uimage` varchar(30) DEFAULT NULL,
  `upasswd` varchar(70) NOT NULL,
  `upower` tinyint(4) NOT NULL DEFAULT '0',
  `uenable` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `utel`, `uname`, `uimage`, `upasswd`, `upower`, `uenable`) VALUES
('2fce00147a76002934a9e04bcd83c729', '18737211793', '壮飞', NULL, '0db6264a574f7511b273950806f2443b63c9e6c2', 0, 1),
('56bb813c7638ac210eb8ca4fe4e43d0a', '13937267417', '11', NULL, '0db6264a574f7511b273950806f2443b63c9e6c2', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
