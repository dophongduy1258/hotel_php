-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2020 at 09:21 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blockreal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE `app_setting` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `is_hidden` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `is_center_icon` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bản thông tin cấu hình màng hình chính cho app';

--
-- Dumping data for table `app_setting`
--

INSERT INTO `app_setting` (`id`, `title`, `link`, `img`, `deleted`, `is_hidden`, `created_at`, `is_center_icon`) VALUES
(1, 'Đối Tác Thiên Phong', 'https://vnexpress.net/giao-duc/nhung-cach-noi-dong-vien-nguoi-khac-trong-tieng-anh-3547970.html', 'https://s.vnecdn.net/vnexpress/restruct/i/v75/graphics/img_logo_vne_web.gif', 0, 1, 1561697208, 0),
(2, 'Đối Tác DGroup', 'https://vnexpress.net/giao-duc/nhung-cach-noi-dong-vien-nguoi-khac-trong-tieng-anh-3547970.html', 'https://s.vnecdn.net/vnexpress/restruct/i/v75/graphics/img_logo_vne_web.gif', 0, 1, 0, 0),
(3, 'Đối Tác Vinagroups', 'https://vnexpress.net/giao-duc/nhung-cach-noi-dong-vien-nguoi-khac-trong-tieng-anh-3547970.html', 'https://s.vnecdn.net/vnexpress/restruct/i/v75/graphics/img_logo_vne_web.gif', 0, 0, 1561697205, 0),
(4, 'Đối Tác Duy Tân', 'https://vnexpress.net/giao-duc/nhung-cach-noi-dong-vien-nguoi-khac-trong-tieng-anh-3547970.html', 'https://s.vnecdn.net/vnexpress/restruct/i/v75/graphics/img_logo_vne_web.gif', 0, 1, 0, 0),
(5, 'Đối Tác Let\'s Việt', 'https://vnexpress.net/giao-duc/nhung-cach-noi-dong-vien-nguoi-khac-trong-tieng-anh-3547970.html', 'https://s.vnecdn.net/vnexpress/restruct/i/v75/graphics/img_logo_vne_web.gif', 0, 0, 0, 1),
(6, 'Đối Tác Moca', 'https://vnexpress.net/giao-duc/nhung-cach-noi-dong-vien-nguoi-khac-trong-tieng-anh-3547970.html', 'https://s.vnecdn.net/vnexpress/restruct/i/v75/graphics/img_logo_vne_web.gif', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bank Listing';

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank_code`, `bank_name`, `bank_account`, `bank_account_name`, `url`) VALUES
(2, 'BIDV', 'Ngân Hàng Đầu Tư Và Phát Triển Việt Nam', '0432000413149', 'CTY CP TRUSTPAY', 'http://sandbox.vnpayment.vn/apis/assets/images/bank/bidv_logo.png'),
(4, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '0421000415149', 'LE NGOC HUAN', 'https://abc.com/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `bank_change`
--

CREATE TABLE `bank_change` (
  `id` int(11) NOT NULL,
  `transaction_funding_id` int(11) NOT NULL,
  `sender` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_change`
--

INSERT INTO `bank_change` (`id`, `transaction_funding_id`, `sender`, `content`, `created_at`) VALUES
(1, 0, 'Vietcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.FPAGE 00000003', 1571045157),
(2, 0, 'Vietcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.FPAGE 00000003', 1571045157),
(3, 0, 'Vietcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.FPAGE 00000003', 1571045157),
(4, 0, 'Vietcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.FPAGE 00000003', 1571045157),
(5, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(6, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(7, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(8, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(9, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(10, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(11, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(12, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(13, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(14, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(15, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(16, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(17, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(18, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(19, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(20, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(21, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(22, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(23, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(24, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(25, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(26, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(27, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(28, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(29, 0, 'Techcombankabc', 'SD TK 0421000415149 +46,000,000VND luc 05-11-2019 15:39:38. SD 63,182,708VND. Ref IBVCB.0511190646601002.NGUYEN VU LINH.BLOCKREAL 00000003', 1571045157),
(30, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628388),
(31, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628409),
(32, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628461),
(33, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628481),
(34, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628482),
(35, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628525),
(36, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628530),
(37, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628556),
(38, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628569),
(39, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628622),
(40, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628642),
(41, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628763),
(42, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628784),
(43, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628800),
(44, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628942),
(45, 0, 'ACBabc', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587628961),
(46, 0, 'ACB', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587631003),
(47, 0, 'ACB', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587635516),
(48, 0, 'ACB', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20', 1587635686),
(49, 0, 'ACB', 'ACB: TK 43448888(VND) + 700,000 luc 13:12 08/12/2018. So du 700,000. GD: KYQUY HD101 huanln GD 020428-120818 13:12:20; Giao dịch này thuộc về một người dùng khác.', 1587635722);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Cities';

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `province_id`, `deleted`, `created_by`, `priority`) VALUES
(1, 'Quận 1', 1, 0, 1, 0),
(2, 'Quận 2', 1, 0, 1, 0),
(3, 'Ninh Kiều', 2, 0, 1, 0),
(4, 'Quận 3', 1, 0, 0, 0),
(5, 'Quận 4', 1, 0, 0, 0),
(6, 'Quận 5', 1, 0, 0, 0),
(7, 'Quận 6', 1, 0, 0, 0),
(8, 'Quận 7', 1, 0, 0, 0),
(9, 'Quận 8', 1, 0, 0, 0),
(10, 'Quận 9', 1, 0, 0, 0),
(11, 'Quận 10', 1, 0, 0, 0),
(12, 'Quận 11', 1, 0, 0, 0),
(13, 'Quận 12', 1, 0, 0, 0),
(14, 'Quận Thủ Đức', 1, 0, 0, 0),
(15, 'Quận Bình Tân', 1, 0, 0, 0),
(16, 'Bình Thủy', 2, 0, 0, 0),
(17, 'Cái Răng', 2, 0, 0, 0),
(18, 'Thủ Dầu', 3, 0, 0, 0),
(19, 'Dĩ An', 3, 0, 0, 0),
(20, 'Cái Bè', 4, 0, 0, 0),
(21, 'Cay Lậy', 4, 0, 0, 0),
(22, 'Tân Phước', 4, 0, 0, 0),
(23, 'Gò Công', 4, 0, 0, 0),
(24, 'Mỹ Tho', 4, 0, 0, 0),
(25, 'Bình Đại', 5, 0, 0, 0),
(26, 'Ba Tri', 5, 0, 0, 0),
(27, 'Thạnh Phong', 5, 0, 0, 0),
(28, 'TP Bến Tre', 5, 0, 0, 0),
(29, 'Đức Hòa', 6, 0, 0, 0),
(30, 'Bến Lức', 6, 0, 0, 0),
(31, 'Tân An', 6, 0, 0, 0),
(32, 'Châu thành', 4, 0, 0, 0),
(33, 'Giồng Trôm', 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `hint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `investor_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Danh bạ người dùng';

-- --------------------------------------------------------

--
-- Table structure for table `deposit_info`
--

CREATE TABLE `deposit_info` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT 'Loại đặt cọc; mua cọc hay đặt cọc cố định',
  `value` int(11) NOT NULL,
  `investor_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `web_product_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_refund` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `object` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL COMMENT '=0 là waiting; =1 là done √; = -1 là đã refund',
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin đặt mua bds và mua bds';

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount_status` int(1) NOT NULL,
  `amount_value` float NOT NULL,
  `percent_status` int(1) NOT NULL,
  `percent_value` float NOT NULL,
  `script_status` int(1) NOT NULL,
  `script_value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Cấu hình phí nạp, rút, chuyển';

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `type`, `name`, `amount_status`, `amount_value`, `percent_status`, `percent_value`, `script_status`, `script_value`) VALUES
(1, 'withdraw', 'Phí rút tiền', 0, 1000000, 0, 10, 1, ''),
(2, 'transfer', 'Phí chuyển khoản', 0, 1000000, 0, 10, 1, ''),
(3, 'trading', 'Phí chuyển nhượng', 0, 1000000, 0, 10, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `gid`
--

CREATE TABLE `gid` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `default_permission` text COLLATE utf8_unicode_ci,
  `default_report` text COLLATE utf8_unicode_ci,
  `permission_resellers` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Group of users';

--
-- Dumping data for table `gid`
--

INSERT INTO `gid` (`id`, `name`, `default_permission`, `default_report`, `permission_resellers`) VALUES
(1, 'Administrator', '', '', ';6;5;'),
(17, 'Quản trị test', '1;2;3;25;32;33;5;7;8;17;18;26;38;43;44;46;47;48;49;50;51;52;9;28;45;12;13;14;15;27;19;20;22;23;35;36;37;39;40;41;42;21;', '', ''),
(18, 'Quản trị test 2', '1;2;3;25;32;33;5;7;8;17;18;26;38;43;44;9;28;12;13;14;15;27;19;20;22;23;35;36;37;39;40;41;42;54;55;56;21;', '', ''),
(20, 'Quản trị test 3', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gift_history`
--

CREATE TABLE `gift_history` (
  `id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investor`
--

CREATE TABLE `investor` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission` float NOT NULL,
  `parent` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `beneficiary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bankname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bankaccnum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `joined_at` int(11) NOT NULL,
  `last_logined_at` int(11) NOT NULL,
  `sessionToken` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `investor`
--

INSERT INTO `investor` (`id`, `fullname`, `username`, `commission`, `parent`, `mobile`, `email`, `diachi`, `beneficiary`, `bankname`, `branch`, `bankaccnum`, `version`, `joined_at`, `last_logined_at`, `sessionToken`, `activate`) VALUES
('-3389437964399784770', 'Lê Ngọc Huân cha', 'lehuantest2', 392400, 'fffffff', '0905 093 290', 'lengochuan@yopmail.com', '579 Tổ 23, Ap 1, An Huu, Cai Be, TG', 'Lê Ngọc Huân', 'Vietcombank', 'Phú Thọ', '0421000415149', 0, 1541218677, 1545120212, '', 1),
('6277729709507225502', 'fffffff', 'fffffff', 0, 'qqqqqq', '0193123123123', 'fffffff@gmail.com', '579, To 23, Ap 1, An Huu, Cai Be, Tien Giang', 'Huan LE NGOC', 'vcb', 'bcb', '33123131231233', 0, 1545124355, 1569572745, '', 1),
('6277729709507469214', 'qqqqqq', 'qqqqqq', 0, 'lehuantest2', '0906091233', 'qqqqqq@gmail.com', '234 Quận 4', 'Huan LE NGOC', 'vcb', 'vcb', '1231231313123123', 0, 1545124203, 1545124203, '', 1),
('6277729709508870046', 'Lê Ngọc Huân con', 'lehuantest3', 1055520, 'lehuantest2', '0905094291', 'lengochuan@yopmail.com', '', '', '', '', '', 6, 1545468472, 1561620035, 'lRpOoHPofL4Mlvwo62mxnIjLzdlxhdxG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_commission`
--

CREATE TABLE `mlm_commission` (
  `id` int(11) NOT NULL COMMENT 'id',
  `amount` float NOT NULL,
  `total_delivered` float NOT NULL,
  `source` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'source created record',
  `created_at` int(11) NOT NULL COMMENT 'created time',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'username created ',
  `commission_from_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Các đợt nạp commission cho nhân viên';

--
-- Dumping data for table `mlm_commission`
--

INSERT INTO `mlm_commission` (`id`, `amount`, `total_delivered`, `source`, `created_at`, `created_by`, `commission_from_user`, `note`) VALUES
(3, 1200000, 482640, 'backoffice_delivery', 1563356138, '1', 'fffffff', 'lần đầu phá');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_commission_history`
--

CREATE TABLE `mlm_commission_history` (
  `id` int(11) NOT NULL,
  `mlm_commission_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `commission` float NOT NULL,
  `mlm_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mlm_commission_history`
--

INSERT INTO `mlm_commission_history` (`id`, `mlm_commission_id`, `created_at`, `username`, `commission`, `mlm_level_id`) VALUES
(3, 3, 1563356138, 'lehuantest3', 351840, 1),
(4, 3, 1563356138, 'lehuantest2', 130800, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_detail`
--

CREATE TABLE `mlm_detail` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'username of the user related',
  `parent` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'parent level of user related',
  `mlm_level_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `total_commission` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Multi level marketing: detail table';

--
-- Dumping data for table `mlm_detail`
--

INSERT INTO `mlm_detail` (`id`, `username`, `parent`, `mlm_level_id`, `created_at`, `total_commission`) VALUES
(1, 'lehuantest3', 'lehuantest2', 1, 1111111111, 0),
(7, 'fffffff', 'qqqqqq', 1, 1563356652, 0),
(8, 'fffffff', 'lehuantest2', 2, 1563356652, 0),
(9, 'qqqqqq', 'lehuantest2', 1, 1563987699, 0),
(10, 'lehuantest2', 'fffffff', 1, 1563988018, 0),
(11, 'lehuantest2', 'qqqqqq', 2, 1563988018, 0),
(12, 'lehuantest2', 'lehuantest2', 3, 1563988018, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_level`
--

CREATE TABLE `mlm_level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `commission` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Multi level marketing: levels table';

--
-- Dumping data for table `mlm_level`
--

INSERT INTO `mlm_level` (`id`, `name`, `commission`) VALUES
(1, 'Cấp 1', 29.32),
(2, 'Cấp 2', 10.9),
(3, 'Cấp 3', 10.78),
(4, 'Cấp 4', 10),
(5, 'Cấp 5', 10),
(6, 'Cấp 6', 10),
(7, 'Cấp 7', 10),
(8, 'Cấp 8', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci COMMENT 'content of message',
  `to` text COLLATE utf8_unicode_ci COMMENT 'Notification to user with format: reseller_id_1;reseller_id_2;...',
  `read_status` text COLLATE utf8_unicode_ci COMMENT 'Người đã xem',
  `deleted` text COLLATE utf8_unicode_ci,
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT 'Thời gian phát sinh',
  `force_read` int(1) NOT NULL DEFAULT '0' COMMENT '0=0; 1= force',
  `created_by` int(11) DEFAULT NULL COMMENT 'user created',
  `regarding_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Notifications ' ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `subject`, `content`, `to`, `read_status`, `deleted`, `created_at`, `force_read`, `created_by`, `regarding_product_id`) VALUES
(2, 'Tin nhắn 2', 'Tin nhắn 2', ';lengochuan;huynhanhtan06;', '', '', 1928181928, 0, 1, 1),
(3, 'Tin nhắn 3', 'Tin nhắn 3', ';lengochuan;huynhanhtan06;', '', '', 1928181928, 0, 1, 1),
(4, 'Tin nhắn 4', 'Tin nhắn 4', ';lengochuan;huynhanhtan06;', '', '', 1928181928, 0, 1, 1),
(5, 'Tin nhắn 5', 'Tin nhắn 5', ';lengochuan;huynhanhtan06;', '', '', 1928181928, 0, 1, 1),
(8, 'Đầu tư mã BDS mới liền đi', '<p><span style=\"color:#c0392b\">Đầu tư m&atilde; BDS mới liền đi</span></p>\n', 'lengochuan;huynhanhtan06;', '', '', 1541229414, 0, 1, 0),
(11, 'Tin nhắn thứ 100', '<p>Tin nhắn thứ 100</p>\n', 'huynhanhtan06;lengochuan;ctycpblockreal02;', '', '', 1541233179, 0, 1, 0),
(13, 'Lê Ngọc Huân Test', '<p>Tin tức&nbsp;<a href=\"http://kenh14.vn/nua-dem-nhan-tin-du-netizen-viet-dau-long-vinh-biet-bieu-tuong-cua-marvel-stan-lee-20181113065137956.chn\" target=\"_blank\" title=\"Nửa đêm nhận tin dữ, netizen Việt đau lòng vĩnh biệt biểu tượng của Marvel Stan Lee \">Stan Lee</a>&nbsp;qua đời ở tuổi 95 v&agrave;o h&ocirc;m 12/11 đ&atilde; để lại nỗi thương tiếc v&ocirc; bờ kh&ocirc;ng chỉ cho người h&acirc;m mộ, m&agrave; c&ograve;n cho cả những ng&ocirc;i sao phim Marvel v&agrave; c&aacute;c nghệ sĩ qu&yacute; mến &ocirc;ng. Tr&ecirc;n&nbsp;<a href=\"http://kenh14.vn/mang-xa-hoi.html\" target=\"_blank\" title=\"mạng xã hội\">mạng x&atilde; hội</a>, họ đ&atilde; để lại những d&ograve;ng tưởng nhớ, t&ocirc;n vinh người \"cha đẻ\" vĩ đại của c&aacute;c nh&acirc;n vật si&ecirc;u&nbsp;<a href=\"http://kenh14.vn/anh-hung-marvel.html\" target=\"_blank\" title=\"anh hùng Marvel\">anh h&ugrave;ng Marvel</a>.</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/ryan-reynolds-stan-lee-154207151357086483775.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 1.\" id=\"img_1d32aad0-e6e1-11e8-b0b3-cfbb9c56d1cd\" src=\"https://kenh14cdn.com/2018/11/13/ryan-reynolds-stan-lee-154207151357086483775.jpg\" /></a></p>\n\n<p>\"Deadpool\" Ryan Reynolds chia sẻ: \"Kh&ocirc;ng thể tin được... H&atilde;y y&ecirc;n nghỉ&nbsp;<a href=\"http://kenh14.vn/nhung-cot-moc-dang-nho-trong-su-nghiep-cua-stan-lee-nguoi-tao-ra-nhung-sieu-anh-hung-20181113040911831.chn\" title=\"Những cột mốc đáng nhớ trong sự nghiệp của Stan Lee - người tạo ra những siêu anh hùng \">Stan Lee</a>. Cảm ơn về tất cả\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/0010fbbb-500-15420718175711554594661.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 2.\" id=\"img_d1c5ee80-e6e1-11e8-bd7b-19b0cfbf5c7b\" src=\"https://kenh14cdn.com/2018/11/13/0010fbbb-500-15420718175711554594661.jpg\" /></a></p>\n\n<p>\"Captain America\" Chris Evans b&agrave;y tỏ: \"Sẽ kh&ocirc;ng bao giờ c&oacute; một&nbsp;Stan Lee&nbsp;thứ hai. Suốt nhiều thập ni&ecirc;n, &ocirc;ng ấy đ&atilde; cho mọi thế hệ kh&aacute;n giả trải nghiệm những chuyến phi&ecirc;u lưu, t&igrave;m được lối tho&aacute;t khỏi cuộc sống kh&oacute; khăn, c&oacute; được sự an ủi, sự tự tin, nguồn cảm hứng, sức mạnh, t&igrave;nh bạn v&agrave; niềm vui. &Ocirc;ng ấy lan truyền t&igrave;nh y&ecirc;u thương v&agrave; l&ograve;ng nh&acirc;n hậu, dấu ấn &ocirc;ng để lại sẽ kh&ocirc;ng bao giờ phai mờ. M&atilde;i m&atilde;i như thế!\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/446267011034094239657882123965955426140472n-1542072100255849986613.jpg\" title=\"Robert Downey Jr. - nam diễn viên được vực dậy cả sự nghiệp nhờ vai Iron Man - xúc động: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 3.\" id=\"img_7a2f2eb0-e6e2-11e8-af51-395b3808a125\" src=\"https://kenh14cdn.com/2018/11/13/446267011034094239657882123965955426140472n-1542072100255849986613.jpg\" /></a></p>\n\n<p>Robert Downey Jr. - nam diễn vi&ecirc;n được vực dậy cả sự nghiệp nhờ vai Iron Man - x&uacute;c động: \"T&ocirc;i nợ ng&agrave;i tất cả. H&atilde;y y&ecirc;n nghỉ&nbsp;<a href=\"http://kenh14.vn/stan-lee.html\" title=\"Stan Lee\">Stan Lee</a>\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-82302-am-15420722002741796636903.png\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 4.\" id=\"img_b738f200-e6e2-11e8-af51-395b3808a125\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-82302-am-15420722002741796636903.png\" /></a></p>\n\n<p>\"Wolverine\" Hugh Jackman ghi: \"Ch&uacute;ng ta đ&atilde; mất đi một thi&ecirc;n t&agrave;i s&aacute;ng tạo.&nbsp;<a href=\"http://kenh14.vn/stan-lee-qua-doi.html\" title=\"Stan Lee qua đời \">Stan Lee</a>&nbsp;đ&atilde; l&agrave; nh&agrave; ti&ecirc;n phong trong vũ trụ si&ecirc;u anh h&ugrave;ng T&ocirc;i tự h&agrave;o khi được l&agrave; một phần nhỏ trong di sản của &ocirc;ng ấy, được thể hiện một trong những nh&acirc;n vật của &ocirc;ng ấy tạo ra\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/dr1kgqsuuaasaej-1542072326648414629001.jpg\" title=\"Dwayne Johnson tuy không đóng trong phim Marvel nhưng cũng thương tiếc ngài Stan Lee: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 5.\" id=\"img_01048c00-e6e3-11e8-8cf7-a76ebed0868f\" src=\"https://kenh14cdn.com/2018/11/13/dr1kgqsuuaasaej-1542072326648414629001.jpg\" /></a></p>\n\n<p>Dwayne Johnson tuy kh&ocirc;ng đ&oacute;ng trong phim Marvel nhưng cũng thương tiếc ng&agrave;i&nbsp;<a href=\"http://kenh14.vn/cha-de-marvel-ong-stan-le-da-qua-doi-o-tuoi-95-20181113020924691.chn\" title=\"“Cha đẻ” Marvel - Ông Stan Lee đã qua đời ở tuổi 95 \">Stan Lee</a>: \"Một người đ&agrave;n &ocirc;ng vĩ đại. Một cuộc đời đ&aacute;ng nhớ. Khi t&ocirc;i mới bắt đầu sự nghiệp ở Hollywood, &ocirc;ng ấy ch&agrave;o đ&oacute;n t&ocirc;i bằng v&ograve;ng tay rộng mở v&agrave; những lời khuy&ecirc;n s&acirc;u sắc. Một biểu tượng thật sự c&oacute; sức ảnh hưởng tới nhiều thế hệ. H&atilde;y y&ecirc;n nghỉ, người bạn của t&ocirc;i\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/4440346520603488306960954029945991877375850n-15420725411541019390758.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 6.\" id=\"img_8140ea80-e6e3-11e8-aa0c-e17d95e7b66b\" src=\"https://kenh14cdn.com/2018/11/13/4440346520603488306960954029945991877375850n-15420725411541019390758.jpg\" /></a></p>\n\n<p>\"Hawkeye\" Jeremy Renner: \"H&atilde;y y&ecirc;n nghỉ,&nbsp;Stan Lee. Ng&agrave;i l&agrave; một huyền thoại v&agrave; một người bạn của t&ocirc;i\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/003-1542072858507464125614.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 7.\" id=\"img_40e9db80-e6e4-11e8-bd18-2f6bc00919b9\" src=\"https://kenh14cdn.com/2018/11/13/003-1542072858507464125614.jpg\" /></a></p>\n\n<p>\"Hulk\" Mark Ruffalo b&agrave;y tỏ: \"Một ng&agrave;y thật buồn. H&atilde;y y&ecirc;n nghỉ, b&aacute;c Stan. B&aacute;c đ&atilde; l&agrave;m cho thế giới tốt đẹp hơn bằng sức mạnh của những c&acirc;u chuyện huyền thoại thời hiện đại v&agrave; t&igrave;nh y&ecirc;u nghệ thuật của m&igrave;nh\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83504-am-1542072919533304218716.png\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 8.\" id=\"img_62c108f0-e6e4-11e8-85e0-b31eabbc3701\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83504-am-1542072919533304218716.png\" /></a></p>\n\n<p>\"Star-Lord\" Chris Pratt: \"Cảm ơn v&igrave; tất cả, Stan Lee! Ng&agrave;i đ&atilde; sống một cuộc đời đ&aacute;ng nhớ. T&ocirc;i tự xem bản th&acirc;n m&igrave;nh v&ocirc; c&ugrave;ng may mắn v&igrave; được gặp ng&agrave;i v&agrave; đ&oacute;ng phim trong thế giới ng&agrave;i tạo ra\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83639-am-1542073015065540716073.png\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 9.\" id=\"img_9b7d1d00-e6e4-11e8-bdd7-8376f6f30f06\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83639-am-1542073015065540716073.png\" /></a></p>\n\n<p>\"Falcon\" Anthony Mackie: \"Ng&agrave;i từng l&agrave; người đi trước thời đại. Giờ th&igrave; ng&agrave;i đ&atilde; ra đi trước mọi người. H&atilde;y y&ecirc;n nghỉ Stan, con người vĩ đại. Cảm ơn về những tiếng cười v&agrave; những lời động vi&ecirc;n. Thật vinh dự khi được sống trong vũ trụ của ng&agrave;i tạo ra!\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/dr1ref1uwaeq3on-1542073038912629251624.jpg\" title=\"Halle Berry - minh tinh đóng vai Storm trong \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 10.\" id=\"img_a97c55b0-e6e4-11e8-8581-51d6c8440636\" src=\"https://kenh14cdn.com/2018/11/13/dr1ref1uwaeq3on-1542073038912629251624.jpg\" /></a></p>\n\n<p><a href=\"http://kenh14.vn/halle-berry.html\" title=\"Halle Berry\">Halle Berry</a>&nbsp;- minh tinh đ&oacute;ng vai Storm trong \"X-Men\" chia sẻ: \"H&atilde;y y&ecirc;n nghỉ&nbsp;Stan Lee. Cảm ơn v&igrave; đ&atilde; chia sẻ những h&igrave;nh ảnh ng&agrave;i tạo ra với ch&uacute;ng t&ocirc;i. Ch&uacute;ng t&ocirc;i m&atilde;i m&atilde;i biết ơn ng&agrave;i, ch&uacute;ng t&ocirc;i sẽ kh&ocirc;ng được như b&acirc;y giờ nếu kh&ocirc;ng c&oacute; t&aacute;c phẩm của ng&agrave;i. T&ocirc;i thật vinh dự khi tham gia diễn xuất trong thế giới của ng&agrave;i v&agrave; sẽ lu&ocirc;n &ocirc;n lại kỷ niệm đ&oacute; bằng tất cả t&igrave;nh y&ecirc;u thương\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/448931341393467470359333572460550477084156n-15420815118671726735669.jpg\" title=\"Không tham gia các bộ phim Marvel, nhưng nữ diễn viên Kaley Cuoco cũng vô cùng thương tiếc: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 11.\" id=\"img_63f09830-e6f8-11e8-8369-7ff7119e6cae\" src=\"https://kenh14cdn.com/2018/11/13/448931341393467470359333572460550477084156n-15420815118671726735669.jpg\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 11.\" /></a></p>\n\n<p>Kh&ocirc;ng tham gia c&aacute;c bộ phim Marvel, nhưng nữ diễn vi&ecirc;n Kaley Cuoco cũng v&ocirc; c&ugrave;ng thương tiếc: \"T&ocirc;i rất buồn khi nghe tin Stan Lee qua đời. &Ocirc;ng ấy đ&atilde; để lại một dấu ấn tuyệt đẹp cho bộ phim The Big Bang Theory của ch&uacute;ng t&ocirc;i v&agrave; ch&uacute;ng t&ocirc;i v&ocirc; c&ugrave;ng biết ơn. T&ocirc;i tr&acirc;n trọng những lần &ocirc;ng ấy thăm hỏi, trao cho t&ocirc;i những c&aacute;i &ocirc;m v&agrave; kể những c&acirc;u chuyện hư cấu. &Ocirc;ng ấy l&agrave; một si&ecirc;u anh hũng vĩ đại. T&ocirc;i sẽ kh&ocirc;ng bao giờ qu&ecirc;n ng&agrave;i!\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/seth-rogen-1542081917810498158158.jpg\" title=\"Nam diễn viên Seth Rogen chia sẻ: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 12.\" id=\"img_5706d1b0-e6f9-11e8-86db-61e3517b9a39\" src=\"https://kenh14cdn.com/2018/11/13/seth-rogen-1542081917810498158158.jpg\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 12.\" /></a></p>\n\n<p>Nam diễn vi&ecirc;n Seth Rogen chia sẻ: \"Cảm ơn Stan Lee v&igrave; đ&atilde; l&agrave;m những người cảm thấy m&igrave;nh kh&aacute;c biệt so với số đ&ocirc;ng nhận ra rằng thật ra họ rất đặc biệt\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-110723-am-15420820620941152520045.png\" title=\"Người dẫn chương trình talkshow Jimmy Kimmel chia sẻ: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 13.\" id=\"img_ac45f070-e6f9-11e8-bae2-a15b51698730\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-110723-am-15420820620941152520045.png\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 13.\" /></a></p>\n\n<p>Người dẫn chương tr&igrave;nh talkshow Jimmy Kimmel chia sẻ: \"Năm 7 tuổi, t&ocirc;i đ&atilde; vẽ bức họa kỳ cục n&agrave;y về Stan Lee v&agrave; nhờ mẹ gửi cho &ocirc;ng ấy. May m&agrave; mẹ đ&atilde; kh&ocirc;ng l&agrave;m thế, v&igrave; hơn 30 năm sau đ&oacute;, t&ocirc;i đ&atilde; được dịp trao cho &ocirc;ng ấy trực tiếp. Cảm ơn về những niềm vui ng&agrave;i đ&atilde; cho t&ocirc;i, Stan\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-111037-am-1542082252447377287747.png\" title=\"Jennifer Garner - từng đóng vai Elektra trong phim \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 14.\" id=\"img_1dbeb4d0-e6fa-11e8-87da-d19bc8560c4b\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-111037-am-1542082252447377287747.png\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 14.\" /></a></p>\n\n<p>Jennifer Garner - từng đ&oacute;ng vai Elektra trong phim \"Daredevil\" của Marvel - b&agrave;y tỏ: \"Ng&agrave;i đ&atilde; l&agrave;m những người phụ nữ trở th&agrave;nh người h&ugrave;ng . T&ocirc;i rất biết ơn v&igrave; đ&atilde; được l&agrave; một trong số người h&ugrave;ng đ&oacute;. Cảm ơn, Stan Lee. H&atilde;y y&ecirc;n nghỉ\".</p>\n', 'lehuan;', '', '', 1542084246, 0, 1, 0),
(14, 'Nạp tiền thành công', 'Giao dịch nạp tiền #HD30 với số tiền 1,000,000 của bạn đã hoàn tất.', 'lengochuan;', '', '', 1545884956, 0, 1, 0),
(15, 'Cộng tiền tài khoả', 'Bạn vừa được cộng 12,000,000. Nội dung nạp: Nạp tiền user', 'lehuantest2;', '', '', 1545982930, 0, 1, 0),
(16, 'Trừ tiền tài khoản', 'Tài khoản của bạn đã bị trừ 999,900. Nội dung trừ: Rút tiền nạp cho nó chẵn chơi thôi', 'lehuantest2;', '', '', 1545984371, 0, 1, 0),
(17, 'Trừ tiền tài khoản', 'Tài khoản của bạn đã bị trừ 1,000,000. Nội dung trừ: Rút tiền chơi', 'lehuantest2;', '', '', 1545984664, 0, 1, 0),
(18, 'Trừ tiền tài khoản', 'Tài khoản của bạn đã bị trừ 1,000,000. Nội dung trừ: Rút tiền lại nhé, chuyển dư', 'lehuantest2;', '', '', 1546053459, 0, 1, 0),
(19, 'Trừ tiền tài khoản', 'Tài khoản của bạn đã bị trừ 1,000,000. Nội dung trừ: Rút tiền lại nhé, chuyển dư', 'lehuantest2;', '', '', 1546058674, 0, 1, 0),
(20, 'Cộng tiền tài khoả', 'Bạn vừa được cộng 1,000,000. Nội dung nạp: ', 'lehuantest2;', '', '', 1547029579, 0, 1, 0),
(21, 'Trừ tiền tài khoản', 'Tài khoản của bạn đã bị trừ 100,000. Nội dung trừ: ', 'lehuantest2;', '', '', 1547031029, 0, 1, 0),
(22, 'hhh', '<p>hhhhh</p>\n', 'huynhanhtan06;lengochuan;', '', '', 1564028223, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL COMMENT 'id',
  `group` int(11) NOT NULL DEFAULT '0',
  `root` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Title of permission',
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci COMMENT 'String permission',
  `gid_option` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Format: :1:2:6: string permission of this group',
  `gid_default` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Format: :1:2:6: -> string default permission'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng chia phân quyền';

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `group`, `root`, `title`, `note`, `permission`, `gid_option`, `gid_default`) VALUES
(1, 1, 0, 'Lịch sử đầu tư', 'Báo cáo', ':indexreport:reporthistory:reportdetail_investor:', '', ''),
(2, 1, 0, 'Lợi nhuận đầu tư', 'Báo cáo', ':indexreport:reportROI:', '', ''),
(3, 1, 0, 'Lịch sử nạp tiền', 'Báo cáo', ':indexreport:reportdeposit:', '', ''),
(5, 2, 0, 'Xem', 'Quản lý product', ':indexproduct:productidx:', '', ''),
(7, 2, 0, 'Quản lý danh mục', 'Quản lý product', ':productprovince:productcity:', '', ''),
(8, 2, 0, 'Xóa', 'Quản lý product', ':productdelete:', '', ''),
(9, 3, 0, 'Xem', 'Quản lý nhà đầu tư', ':indexinvestor:investoridx:', '', ''),
(10, -3, 0, 'Sửa thông tin', 'Quản lý  nhà đầu tư', ':investorsave:', '', ''),
(11, -3, 0, 'Xóa', 'Xóa nhà đầu tư', ':investordelete:', '', ''),
(12, 4, 0, 'Xem', 'Quản lý nhân viên', ':indexstaff:staffidx:', '', ''),
(13, 4, 0, 'Quản lý nhóm', 'Quản lý nhân viên', ':staffgid:', '', ''),
(14, 4, 0, 'Thêm/ Cập nhập', 'Quản lý nhân viên', ':staffsave:', '', ''),
(15, 4, 0, 'Xóa', 'Quản lý nhân viên', ':staffdelete:', '', ''),
(17, 2, 0, 'Thêm', 'Quản lý product', ':productadd:', '', ''),
(18, 2, 0, 'Sửa', 'Quản lý product', ':productedit:', '', ''),
(19, 5, 0, 'Cho phép', 'Quản lý tài khoản', ':indexbank:bankidx:', '', ''),
(20, 6, 0, 'Xem', 'Notification', ':indexnotification:notificationidx:', '', ''),
(21, 7, 0, 'Cho phép', 'Quản lý cài đặt', ':indexsetting:settingidx:', '', ''),
(22, 6, 0, 'Gửi', 'Notification', ':notificationsave:', '', ''),
(23, 6, 0, 'Xóa', 'Notification', ':notificationdelete:', '', ''),
(24, -3, 0, 'Khóa tài khoản', 'Quản lý nhà đầu tư', ':investorsuspend:', '', ''),
(25, 1, 0, 'Lịch sử rút tiền', 'Báo cáo', ':indexreport:reportwithdraw:', '', ''),
(26, 2, 0, 'Chia lãi', 'Quản lý product', ':productROI:', '', ''),
(27, 4, 0, 'Đặt lại mật khẩu', 'Quản lý nhân viên', ':staffreset_password:', '', ''),
(28, 3, 0, 'Reset mật khẩu', 'Quản lý nhà đầu tư', ':investorpassword_reset:', '', ''),
(29, -3, 0, 'Khóa mật khẩu đăng nhập', 'Quản lý nhà đầu tư', ':investorpassword_unblock:', '', ''),
(30, -3, 0, 'Mở lại mật khẩu đăng nhập', 'Quản lý nhà đầu tư', ':investorpassword_enable:', '', ''),
(31, -3, 0, 'Khóa mật khẩu đăng nhập', 'Quản lý nhà đầu tư', ':investorpassword_disable:', '', ''),
(32, 1, 0, 'Xử lý nạp tiền', 'Báo cáo', ':reportdeposit_done:', '', ''),
(33, 1, 0, 'Xử lý rút tiền', 'Báo cáo', ':reportwithdraw_done:', '', ''),
(35, 8, 0, 'Xem giao dịch nạp/rút', 'Xem danh sách giao dịch nạp rút', ':indextransaction:transactionidx:', '', ''),
(36, 8, 0, 'Rút tiền', 'Rút tiền', ':transactionwithdraw:', '', ''),
(37, 8, 0, 'Nạp tiền', 'Nạp tiền tiền', ':transactiondeposit:', '', ''),
(38, 2, 0, 'Quản lý gói đầu tư', 'Quản lý gói đầu tư của nhà đầu tư: Thêm, Trả Lại Tiền', ':productproduct_history:', '', ''),
(39, 9, 0, 'Quản lý cọc/ mua BĐS', 'Quản lý việc mua BDS hoặc Cọc', ':indexdeposit:depositidx:', '', ''),
(40, 9, 0, 'Hoàn tất giao dịch', 'Quản lý xử lý hoàn tất giao dịch - Cọc/Mua BDS', ':depositdone:', '', ''),
(41, 9, 0, 'Hoàn tiền giao dịch', 'Quản lý xử lý hoàn tiền giao dịch - Cọc/Mua BDS', ':depositrefund:', '', ''),
(42, 9, 0, 'Xóa giao dịch', 'Quản lý xử lý xóa giao dịch - Cọc/Mua BDS', ':depositdelete:', '', ''),
(43, 2, 0, 'Sao chép', 'Quản lý product', ':productclone:', '', ''),
(44, 2, 0, 'Ẩn/ hiện', 'Quản lý product', ':producthidden:', '', ''),
(45, 3, 0, 'Lịch sử chuyển suất đầu tư', 'Quản lý nhà đầu tư', ':indextransfer:transferidx:', '', ''),
(46, 10, 0, 'Xem', 'Quản lý product', ':indexselling:sellingidx:', '', ''),
(47, 10, 0, 'Quản lý danh mục', 'Quản lý product', ':productprovince:productcity:', '', ''),
(48, 10, 0, 'Xóa', 'Quản lý product', ':sellingdelete:', '', ''),
(49, 10, 0, 'Thêm', 'Quản lý product', ':sellingadd:', '', ''),
(50, 10, 0, 'Sửa', 'Quản lý product', ':sellingedit:', '', ''),
(51, 10, 0, 'Sao chép', 'Quản lý product', ':sellingclone:', '', ''),
(52, 10, 0, 'Ẩn/ hiện', 'Quản lý product', ':sellinghidden:', '', ''),
(53, 11, 0, 'Cho phép', 'Quản lý icon đại diện cho app', ':indexapp-setting:app_settingidx:', '', ''),
(54, 12, 0, 'Quản lý hệ thống MLM', 'Quản lý liên kết người giới thiệu', ':indexmlm:mlmidx:', '', ''),
(55, 12, 0, 'Thay đổi mức hoa hồng', 'Quản lý liên kết người giới thiệu', ':indexmlm:mlmcommission:', '', ''),
(56, 12, 0, 'Chia hoa hồng', 'Quản lý liên kết người giới thiệu', ':indexmlm:mlmdelivery_commission:', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mã sản phẩm',
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `slots_total` int(11) NOT NULL COMMENT 'Xuất đầu tư tối đa',
  `slots_sold` int(11) NOT NULL,
  `price_sold` float NOT NULL COMMENT 'giá bán sau cùng',
  `fee_total` float NOT NULL COMMENT 'Tổng chi phí',
  `fee_detail` text COLLATE utf8_unicode_ci NOT NULL COMMENT '[{name:Trước bạn, price: 1230000},{name:Luật sư, price: 354000}] => chi tiết chi phí',
  `ROI` float NOT NULL COMMENT 'Lợi nhuận đầu tư',
  `status` int(1) NOT NULL COMMENT 'Trạng thái: chờ bán; bán xong =1',
  `images` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'images1;images2;',
  `receive_fund_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receive_fund_fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `is_hidden` int(1) NOT NULL DEFAULT '0',
  `top` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Products';

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `province_id`, `city_id`, `title`, `description`, `price`, `slots_total`, `slots_sold`, `price_sold`, `fee_total`, `fee_detail`, `ROI`, `status`, `images`, `receive_fund_account`, `receive_fund_fullname`, `created_by`, `created_at`, `is_hidden`, `top`) VALUES
(1, 'GV112312', 5, 26, 'Nhà mới đặt cọc PROJECT GV112312', '<p>4x3M Gi&aacute; B&aacute;n: 5 Tỉ</p>\n', 10000000, 120, 0, 1350000000, 1584000, '[]', 0.12368, 0, 'https://img2.dothi.net/dothi_svr_1_resize_624_476_3.20180316153955-b6d7_wm.jpg;https://cdn.homedy.com/store/img/2017/12/27/ban-nha-sai-gon-320150311105222-b2e5-636500098731895059.jpg;https://cdn.homedy.com/store/images/2018/08/20/ban-nha-sai-gon-320150331092337-9757-636703703941214105.jpg;', 'null', '', 1, 1540026556, 0, 0),
(2, 'GV1123123', 1, 4, 'Nhà mới đặt cọc PROJECT GV1123123, Giá Tốt có thể mua liền', '<p>4x3M Gi&aacute; B&aacute;n: 5 Tỉ</p>\n', 10000000, 130, 0, 1450000000, 1584000, '[]', 0.114166, 0, 'https://img.dothi.net/resize/624x476/2017/06/10/20170610084818-5ee0.jpg;https://batdongsan24h.com.vn/buysell/2015/7/13/130812366306153750.jpg;', 'null', '', 1, 1540026593, 0, 0),
(3, 'CT123333', 5, 26, 'Nhà mới đặt cọc PROJECT CT123333 - Cần Thơ', '4x3M\n\nGiá Bán: 1,250 Tỉ\n\nGiá Mua: 1tỉ', 10000000, 110, 37, 1250000000, 1584000, '[]', 0.134924, -1, 'https://img.tinbatdongsan.com/crop/680x480/2017/12/28/20171228094202-e022.png;http://www.nhadatdiangiare.com.vn/uploads/images/25.png;https://static2.cafeland.vn/static01/sgd/news/2017/11/nha-ban-huyen-binh-chanh-tp-ho-chi-minh-1711520888_1_cafeland.vn.jpg;', 'ctycpblockreal01', 'CTY Cổ Phần BlockReal', 1, 1540456958, 0, 0),
(4, 'CT1244444', 2, 3, 'Nhà mới đặt cọc PROJECT CT1244444 - Cần Thơ', '<p>4x30M Gi&aacute; B&aacute;n: 1,500 Tỉ Gi&aacute; Mua: 1,200 tỉ</p>\n', 10000000, 130, 20, 1400000000, 1584000, '[{\"id\":6,\"name\":\"Trước bạ\",\"price\":\"500000\"},{\"id\":7,\"name\":\"Trước bạ\",\"price\":\"500000\"},{\"id\":8,\"name\":\"Trước bạ\",\"price\":\"584000\"}]', 0.0757046, 0, 'https://cdn.muaban.net/cdn/images/thumb-detail/201809/26/028/9a4dac8476d74861a26db780de7131cf.jpg;https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0WPvoxHhSqTnMp7VX-soGNUkiu2rPu7d8nIKUT2IspYfXc0tWOA;', 'null', '', 1, 1540457008, 0, 0),
(5, 'VIN100011', 5, 26, 'VINHOMES RIVERSIDE “KHU ĐÔ THỊ TỐT NHẤT VIỆT NAM” 2018', '<p>5x12M Gi&aacute; B&aacute;n: 2,5Tỉ Gi&aacute; Mua: 2.2 Tỉ Ch&iacute;nh thức vận h&agrave;nh từ năm 2012, Vinhomes Riverside hiện l&agrave; nơi an cư l&yacute; tưởng của hơn 3000 cư d&acirc;n. Giai đoạn 2 Vinhomes Riverside &ndash; The Harmony cũng đ&atilde; ch&iacute;nh thức ch&agrave;o đ&oacute;n cư d&acirc;n về an cư từ Qu&yacute; IV/2017. Trước Giải thưởng Bất động sản Ch&acirc;u &Aacute; &ndash;Th&aacute;i B&igrave;nh Dương, Khu đ&ocirc; thị Vinhomes Riverside cũng vinh dự được độc giả B&aacute;o Đầu tư b&igrave;nh chọn l&agrave; &ldquo;Kh&ocirc;ng gian sống chuẩn mực nhất Việt Nam&rdquo; năm 2018. Trước đ&oacute;, Chủ đầu tư Vinhomes đ&atilde; nhiều lần được vinh danh ở c&aacute;c hạng mục quan trọng của giải thưởng Bất động sản Ch&acirc;u &Aacute; &ndash; Th&aacute;i B&igrave;nh Dương. Năm 2016, Vinhomes d&agrave;nh trọn 3 giải: Khu đ&ocirc; thị phức hợp tốt nhất; T&ograve;a nh&agrave; cao tầng tốt nhất v&agrave; Khu đ&ocirc; thị c&oacute; thiết kế cảnh quan tốt nhất lần lượt với 3 dự &aacute;n Vinhomes Central Park, T&ograve;a Landmark 81 &ndash; Vinhomes Central Park v&agrave; Vinhomes Times City &ndash; Park Hill. Sau đ&oacute;, tại v&ograve;ng chung kết, t&ograve;a th&aacute;p cao 81 tầng Landmark 81 thuộc Khu đ&ocirc; thị Vinhomes Central Park đ&atilde; bước l&ecirc;n đ&agrave;i vinh quang với giải thưởng &ldquo;C&ocirc;ng tr&igrave;nh kiến tr&uacute;c cao tầng tốt nhất Thế giới&rdquo;. Năm 2017, Vinhomes Metropolis vượt qua nhiều dự &aacute;n tầm cỡ kh&aacute;c trong khu vực v&agrave; vinh dự đạt giải T&ograve;a nh&agrave; cao tầng tốt nhất Ch&acirc;u &Aacute; Th&aacute;i B&igrave;nh Dương C&aacute;c giải thưởng danh gi&aacute; tr&ecirc;n kh&ocirc;ng chỉ l&agrave; sự ghi nhận của c&aacute;c tổ chức quốc tế với những bứt ph&aacute; kh&ocirc;ng ngừng của Vinhomes, tiếp tục khẳng định uy t&iacute;n, vị thế h&agrave;ng đầu của Vinhomes tr&ecirc;n thị trường bất động sản trong nước, m&agrave; c&ograve;n g&oacute;p phần đưa c&aacute;c sản phẩm bất động sản Việt Nam vươn tầm quốc tế.</p>\n', 10000000, 220, 0, 2500000000, 1000000, '[]', 0.135909, 0, 'http://blockreal.local/uploads/product/images/127.0.0.1-1541090732-6628504-blockreal.vn.jpg;https://static.ecosite.vn/7738/picture/2018/05/15/vinhomes-riverside-duoc-appa-vinh-danh-khu-do-thi-tot-nhat-viet-nam-2018-khu-do-thi-tot-nhat-viet-nam-1-1526263359-979-width600height400-1526370128.jpg;', 'null', '', 1, 1540608476, 0, 1561347380),
(6, 'BRP100012', 5, 26, 'BLOCKREAL DỰ ÁN SỐ HOÁ TOÀ NHÀ BLOCKUP CẦN THƠ', '<p>15x50M Gi&aacute; B&aacute;n: 12Tỉ Gi&aacute; Mua: 10 Tỉ TH&Ocirc;NG TIN CHI TIẾT TO&Agrave; NH&Agrave; BLOCKUP CẦN THƠ Giới thiệu to&agrave; nh&agrave; Kh&ocirc;ng gian l&agrave;m việc chung, kết hợp đại diện thương hiệu v&agrave; ph&acirc;n phối h&agrave;ng h&aacute; dịch vụ c&aacute;c đối t&aacute;c Diện T&iacute;ch Sử Dụng: 1.600 M2 Bao Gồm 1 Trệt Và 4 Tầng Vị tr&iacute; địa l&yacute; Vị tr&iacute; đắc địa c&aacute;ch Đại Học Cần Thơ 1km, Đại Học Y Dược Cần Thơ 1.5km, C&aacute;ch bệnh viện Đa Khoa 1km, C&aacute;ch s&acirc;n bay quốc tế 6km, C&aacute;ch si&ecirc;u thị MegaMart 300 m&eacute;t Tổng thầu Chủ đầu tư: C&ocirc;ng ty cổ phần Bất Động Sản BlockReal Đơn vị hợp t&aacute;c triển khai: Dgroup, Biggroup, 3S, TrustPay, Vinagroups Thiết kế v&agrave; Thi c&ocirc;ng: C&ocirc;ng ty cổ phần x&acirc;y dựng BlockArch Quản l&yacute; v&agrave; cho thu&ecirc;: C&ocirc;ng ty cổ phần Bất Động Sản BlockReal CÁC HOẠT Đ&Ocirc;̣NG KINH DOANH Tầng Trệt: Khu Trưng B&agrave;y Quảng B&aacute; sản phẩm dịch vụ c&aacute;c Nh&agrave; Sản Xuất Khu đặc sản v&ugrave;ng miền. Khu trưng b&agrave;y Mỹ phẩm, Fashion, Nước hoa&hellip; Khu quầy phục vụ Beer &ndash; Coffee. Bố tr&iacute; khu vực quầy giao dịch &ndash; mở t&agrave;i khoản ng&acirc;n h&agrave;ng v&agrave; c&acirc;y ATM. Dịch vụ Book Tour du lịch vé máy bay. Tầng 1 v&agrave; Tầng 2: Khu vực cho thu&ecirc; văn ph&ograve;ng, văn ph&ograve;ng ảo Dịch vụ cho doanh nghiệp: t&agrave;i ch&iacute;nh, tư vấn, c&ocirc;ng nghệ, tiếp thị, quảng b&aacute;, đại diện thương hiệu, ph&acirc;n phối sản phẩm&hellip; Tầng 3: Hội trường đ&agrave;o tạo khởi nghiệp thực tế. Đ&agrave;o tạo huấn luyện doanh nghiệp. Tầng 4: Kh&ocirc;ng gian l&agrave;m việc chung Member Ship (Co-Working Space): Các phòng làm vi&ecirc;̣c cho đ&ocirc;̣i nhóm. Khu vực coffee &ndash; thư gi&atilde;n. Khu vực nghỉ trưa. Khu vực LiveStream. Khu vực vui chơi cho trẻ em.</p>\n', 10000000, 100, 0, 1300000000, 0, '[]', 0.3, -1, 'https://lamtuan.com/wp-content/uploads/2018/08/blockup-can-tho-700x420.jpg;http://blockreal.local/uploads/product/images/127.0.0.1-1541090709-84200476-blockreal.vn.jpg;http://static.nguyentanvu.com/978/picture/2018/08/13/103dc76c38-1534146088.jpeg;http://dautunhachothue.com/thiet-ke-toa-nha-cho-thue-block-up-can-tho-wwwdautunhachothuecom-0938592248.jpg;', 'null', '', 1, 1540608707, 0, 0),
(7, 'VINPER000001', 5, 26, 'Dự Án Vinpearl Villas', '40ha\n\nGiá Bán: 120Tỉ\n\nGiá Mua:  100Tỉ\n\nTHÔNG TIN CHI TIẾT TOÀ NHÀ BLOCKUP CẦN THƠ\nGiới thiệu toà nhà\nKhông gian làm việc chung, kết hợp đại diện thương hiệu và phân phối hàng há dịch vụ các đối tác\nDiện Tích Sử Dụng: 1.600 M2 Bao Gồm 1 Trệt Và 4 Tầng\nVị trí địa lý\nVị trí đắc địa cách Đại Học Cần Thơ 1km, Đại Học Y Dược Cần Thơ 1.5km,\nCách bệnh viện Đa Khoa 1km, Cách sân bay quốc tế 6km, Cách siêu thị MegaMart 300 mét\nTổng thầu\nChủ đầu tư: Công ty cổ phần Bất Động Sản BlockReal\nĐơn vị hợp tác triển khai: Dgroup, Biggroup, 3S, TrustPay, Vinagroups\nThiết kế và Thi công: Công ty cổ phần xây dựng BlockArch\nQuản lý và cho thuê: Công ty cổ phần Bất Động Sản BlockReal\n\n\nCÁC HOẠT ĐỘNG KINH DOANH\nTầng Trệt: Khu Trưng Bày Quảng Bá sản phẩm dịch vụ các Nhà Sản Xuất\n\nKhu đặc sản vùng miền.\nKhu trưng bày Mỹ phẩm, Fashion, Nước hoa…\nKhu quầy phục vụ Beer – Coffee.\nBố trí khu vực quầy giao dịch – mở tài khoản ngân hàng và cây ATM.\nDịch vụ Book Tour du lịch vé máy bay.\nTầng 1 và Tầng 2:\n\nKhu vực cho thuê văn phòng, văn phòng ảo\nDịch vụ cho doanh nghiệp: tài chính, tư vấn, công nghệ, tiếp thị, quảng bá, đại diện thương hiệu, phân phối sản phẩm…\nTầng 3:\n\nHội trường đào tạo khởi nghiệp thực tế.\nĐào tạo huấn luyện doanh nghiệp.\nTầng 4: Không gian làm việc chung Member Ship (Co-Working Space):\n\nCác phòng làm việc cho đội nhóm.\nKhu vực coffee – thư giãn.\nKhu vực nghỉ trưa.\nKhu vực LiveStream.\nKhu vực vui chơi cho trẻ em.', 100000000, 1000, 0, 120000000000, 1000000, '[]', 0.19999, -1, 'http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-27-1466670666-jpg-1eb5d05dbc7da0c3847bc20199b6e1d2-1506150490.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/banner-web-1-1506150341.png;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-1-1466670649-jpg-03a12da3396250e1c6464b393286442f-1506150343.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-2-1466670652-png-7942044bbadae7b88b4fa38336802e25-1506150344.png;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-7-1466670653-jpg-bd709c994b6c71fcb873a8b6778b594e-1506150346.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-8-1466670653-jpg-f5465e53e10fa507e74bf27e1553357d-1506150347.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-11-1466670654-jpg-1a27ec7f9929c876b72735ece1267c80-1506150348.jpg;', 'ctycpblockreal01', 'Cty Cổ Phần BlockReal', 1, 1540608923, 0, 0),
(8, 'HCMQ200011101', 1, 1, 'Bán nhà Quận 2, trung tâm hành chính mới của TP', 'Sản phẩm bán nhanh gọn lẹ ai mua thì nhàu vô ngay và luôn nhe', 10000000, 1000, 0, 12000000000, 0, '[]', 0.2, -1, 'http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-27-1466670666-jpg-1eb5d05dbc7da0c3847bc20199b6e1d2-1506150490.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/banner-web-1-1506150341.png;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-1-1466670649-jpg-03a12da3396250e1c6464b393286442f-1506150343.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-2-1466670652-png-7942044bbadae7b88b4fa38336802e25-1506150344.png;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-7-1466670653-jpg-bd709c994b6c71fcb873a8b6778b594e-1506150346.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-8-1466670653-jpg-f5465e53e10fa507e74bf27e1553357d-1506150347.jpg;http://static.nguyentanvu.com/978/picture/2017/09/23/vinpearl-villas-11-1466670654-jpg-1a27ec7f9929c876b72735ece1267c80-1506150348.jpg;', 'ctycpblockreal01', 'Cty Cổ Phần BlockReal Việt Nam', 1, 1541086117, 0, 0),
(9, 'MABDSMOI1101', 6, 30, 'Bán đất nhanh trung tâm thành phố ', '<p>Tin tức&nbsp;<a href=\"http://kenh14.vn/nua-dem-nhan-tin-du-netizen-viet-dau-long-vinh-biet-bieu-tuong-cua-marvel-stan-lee-20181113065137956.chn\" target=\"_blank\" title=\"Nửa đêm nhận tin dữ, netizen Việt đau lòng vĩnh biệt biểu tượng của Marvel Stan Lee \">Stan Lee</a>&nbsp;qua đời ở tuổi 95 v&agrave;o h&ocirc;m 12/11 đ&atilde; để lại nỗi thương tiếc v&ocirc; bờ kh&ocirc;ng chỉ cho người h&acirc;m mộ, m&agrave; c&ograve;n cho cả những ng&ocirc;i sao phim Marvel v&agrave; c&aacute;c nghệ sĩ qu&yacute; mến &ocirc;ng. Tr&ecirc;n&nbsp;<a href=\"http://kenh14.vn/mang-xa-hoi.html\" target=\"_blank\" title=\"mạng xã hội\">mạng x&atilde; hội</a>, họ đ&atilde; để lại những d&ograve;ng tưởng nhớ, t&ocirc;n vinh người \"cha đẻ\" vĩ đại của c&aacute;c nh&acirc;n vật si&ecirc;u&nbsp;<a href=\"http://kenh14.vn/anh-hung-marvel.html\" target=\"_blank\" title=\"anh hùng Marvel\">anh h&ugrave;ng Marvel</a>.</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/ryan-reynolds-stan-lee-154207151357086483775.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 1.\" id=\"img_1d32aad0-e6e1-11e8-b0b3-cfbb9c56d1cd\" src=\"https://kenh14cdn.com/2018/11/13/ryan-reynolds-stan-lee-154207151357086483775.jpg\" /></a></p>\n\n<p>\"Deadpool\" Ryan Reynolds chia sẻ: \"Kh&ocirc;ng thể tin được... H&atilde;y y&ecirc;n nghỉ&nbsp;<a href=\"http://kenh14.vn/nhung-cot-moc-dang-nho-trong-su-nghiep-cua-stan-lee-nguoi-tao-ra-nhung-sieu-anh-hung-20181113040911831.chn\" title=\"Những cột mốc đáng nhớ trong sự nghiệp của Stan Lee - người tạo ra những siêu anh hùng \">Stan Lee</a>. Cảm ơn về tất cả\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/0010fbbb-500-15420718175711554594661.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 2.\" id=\"img_d1c5ee80-e6e1-11e8-bd7b-19b0cfbf5c7b\" src=\"https://kenh14cdn.com/2018/11/13/0010fbbb-500-15420718175711554594661.jpg\" /></a></p>\n\n<p>\"Captain America\" Chris Evans b&agrave;y tỏ: \"Sẽ kh&ocirc;ng bao giờ c&oacute; một&nbsp;Stan Lee&nbsp;thứ hai. Suốt nhiều thập ni&ecirc;n, &ocirc;ng ấy đ&atilde; cho mọi thế hệ kh&aacute;n giả trải nghiệm những chuyến phi&ecirc;u lưu, t&igrave;m được lối tho&aacute;t khỏi cuộc sống kh&oacute; khăn, c&oacute; được sự an ủi, sự tự tin, nguồn cảm hứng, sức mạnh, t&igrave;nh bạn v&agrave; niềm vui. &Ocirc;ng ấy lan truyền t&igrave;nh y&ecirc;u thương v&agrave; l&ograve;ng nh&acirc;n hậu, dấu ấn &ocirc;ng để lại sẽ kh&ocirc;ng bao giờ phai mờ. M&atilde;i m&atilde;i như thế!\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/446267011034094239657882123965955426140472n-1542072100255849986613.jpg\" title=\"Robert Downey Jr. - nam diễn viên được vực dậy cả sự nghiệp nhờ vai Iron Man - xúc động: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 3.\" id=\"img_7a2f2eb0-e6e2-11e8-af51-395b3808a125\" src=\"https://kenh14cdn.com/2018/11/13/446267011034094239657882123965955426140472n-1542072100255849986613.jpg\" /></a></p>\n\n<p>Robert Downey Jr. - nam diễn vi&ecirc;n được vực dậy cả sự nghiệp nhờ vai Iron Man - x&uacute;c động: \"T&ocirc;i nợ ng&agrave;i tất cả. H&atilde;y y&ecirc;n nghỉ&nbsp;<a href=\"http://kenh14.vn/stan-lee.html\" title=\"Stan Lee\">Stan Lee</a>\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-82302-am-15420722002741796636903.png\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 4.\" id=\"img_b738f200-e6e2-11e8-af51-395b3808a125\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-82302-am-15420722002741796636903.png\" /></a></p>\n\n<p>\"Wolverine\" Hugh Jackman ghi: \"Ch&uacute;ng ta đ&atilde; mất đi một thi&ecirc;n t&agrave;i s&aacute;ng tạo.&nbsp;<a href=\"http://kenh14.vn/stan-lee-qua-doi.html\" title=\"Stan Lee qua đời \">Stan Lee</a>&nbsp;đ&atilde; l&agrave; nh&agrave; ti&ecirc;n phong trong vũ trụ si&ecirc;u anh h&ugrave;ng T&ocirc;i tự h&agrave;o khi được l&agrave; một phần nhỏ trong di sản của &ocirc;ng ấy, được thể hiện một trong những nh&acirc;n vật của &ocirc;ng ấy tạo ra\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/dr1kgqsuuaasaej-1542072326648414629001.jpg\" title=\"Dwayne Johnson tuy không đóng trong phim Marvel nhưng cũng thương tiếc ngài Stan Lee: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 5.\" id=\"img_01048c00-e6e3-11e8-8cf7-a76ebed0868f\" src=\"https://kenh14cdn.com/2018/11/13/dr1kgqsuuaasaej-1542072326648414629001.jpg\" /></a></p>\n\n<p>Dwayne Johnson tuy kh&ocirc;ng đ&oacute;ng trong phim Marvel nhưng cũng thương tiếc ng&agrave;i&nbsp;<a href=\"http://kenh14.vn/cha-de-marvel-ong-stan-le-da-qua-doi-o-tuoi-95-20181113020924691.chn\" title=\"“Cha đẻ” Marvel - Ông Stan Lee đã qua đời ở tuổi 95 \">Stan Lee</a>: \"Một người đ&agrave;n &ocirc;ng vĩ đại. Một cuộc đời đ&aacute;ng nhớ. Khi t&ocirc;i mới bắt đầu sự nghiệp ở Hollywood, &ocirc;ng ấy ch&agrave;o đ&oacute;n t&ocirc;i bằng v&ograve;ng tay rộng mở v&agrave; những lời khuy&ecirc;n s&acirc;u sắc. Một biểu tượng thật sự c&oacute; sức ảnh hưởng tới nhiều thế hệ. H&atilde;y y&ecirc;n nghỉ, người bạn của t&ocirc;i\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/4440346520603488306960954029945991877375850n-15420725411541019390758.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 6.\" id=\"img_8140ea80-e6e3-11e8-aa0c-e17d95e7b66b\" src=\"https://kenh14cdn.com/2018/11/13/4440346520603488306960954029945991877375850n-15420725411541019390758.jpg\" /></a></p>\n\n<p>\"Hawkeye\" Jeremy Renner: \"H&atilde;y y&ecirc;n nghỉ,&nbsp;Stan Lee. Ng&agrave;i l&agrave; một huyền thoại v&agrave; một người bạn của t&ocirc;i\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/003-1542072858507464125614.jpg\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 7.\" id=\"img_40e9db80-e6e4-11e8-bd18-2f6bc00919b9\" src=\"https://kenh14cdn.com/2018/11/13/003-1542072858507464125614.jpg\" /></a></p>\n\n<p>\"Hulk\" Mark Ruffalo b&agrave;y tỏ: \"Một ng&agrave;y thật buồn. H&atilde;y y&ecirc;n nghỉ, b&aacute;c Stan. B&aacute;c đ&atilde; l&agrave;m cho thế giới tốt đẹp hơn bằng sức mạnh của những c&acirc;u chuyện huyền thoại thời hiện đại v&agrave; t&igrave;nh y&ecirc;u nghệ thuật của m&igrave;nh\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83504-am-1542072919533304218716.png\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 8.\" id=\"img_62c108f0-e6e4-11e8-85e0-b31eabbc3701\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83504-am-1542072919533304218716.png\" /></a></p>\n\n<p>\"Star-Lord\" Chris Pratt: \"Cảm ơn v&igrave; tất cả, Stan Lee! Ng&agrave;i đ&atilde; sống một cuộc đời đ&aacute;ng nhớ. T&ocirc;i tự xem bản th&acirc;n m&igrave;nh v&ocirc; c&ugrave;ng may mắn v&igrave; được gặp ng&agrave;i v&agrave; đ&oacute;ng phim trong thế giới ng&agrave;i tạo ra\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83639-am-1542073015065540716073.png\" title=\"\"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 9.\" id=\"img_9b7d1d00-e6e4-11e8-bdd7-8376f6f30f06\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-83639-am-1542073015065540716073.png\" /></a></p>\n\n<p>\"Falcon\" Anthony Mackie: \"Ng&agrave;i từng l&agrave; người đi trước thời đại. Giờ th&igrave; ng&agrave;i đ&atilde; ra đi trước mọi người. H&atilde;y y&ecirc;n nghỉ Stan, con người vĩ đại. Cảm ơn về những tiếng cười v&agrave; những lời động vi&ecirc;n. Thật vinh dự khi được sống trong vũ trụ của ng&agrave;i tạo ra!\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/dr1ref1uwaeq3on-1542073038912629251624.jpg\" title=\"Halle Berry - minh tinh đóng vai Storm trong \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 10.\" id=\"img_a97c55b0-e6e4-11e8-8581-51d6c8440636\" src=\"https://kenh14cdn.com/2018/11/13/dr1ref1uwaeq3on-1542073038912629251624.jpg\" /></a></p>\n\n<p><a href=\"http://kenh14.vn/halle-berry.html\" title=\"Halle Berry\">Halle Berry</a>&nbsp;- minh tinh đ&oacute;ng vai Storm trong \"X-Men\" chia sẻ: \"H&atilde;y y&ecirc;n nghỉ&nbsp;Stan Lee. Cảm ơn v&igrave; đ&atilde; chia sẻ những h&igrave;nh ảnh ng&agrave;i tạo ra với ch&uacute;ng t&ocirc;i. Ch&uacute;ng t&ocirc;i m&atilde;i m&atilde;i biết ơn ng&agrave;i, ch&uacute;ng t&ocirc;i sẽ kh&ocirc;ng được như b&acirc;y giờ nếu kh&ocirc;ng c&oacute; t&aacute;c phẩm của ng&agrave;i. T&ocirc;i thật vinh dự khi tham gia diễn xuất trong thế giới của ng&agrave;i v&agrave; sẽ lu&ocirc;n &ocirc;n lại kỷ niệm đ&oacute; bằng tất cả t&igrave;nh y&ecirc;u thương\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/448931341393467470359333572460550477084156n-15420815118671726735669.jpg\" title=\"Không tham gia các bộ phim Marvel, nhưng nữ diễn viên Kaley Cuoco cũng vô cùng thương tiếc: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 11.\" id=\"img_63f09830-e6f8-11e8-8369-7ff7119e6cae\" src=\"https://kenh14cdn.com/2018/11/13/448931341393467470359333572460550477084156n-15420815118671726735669.jpg\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 11.\" /></a></p>\n\n<p>Kh&ocirc;ng tham gia c&aacute;c bộ phim Marvel, nhưng nữ diễn vi&ecirc;n Kaley Cuoco cũng v&ocirc; c&ugrave;ng thương tiếc: \"T&ocirc;i rất buồn khi nghe tin Stan Lee qua đời. &Ocirc;ng ấy đ&atilde; để lại một dấu ấn tuyệt đẹp cho bộ phim The Big Bang Theory của ch&uacute;ng t&ocirc;i v&agrave; ch&uacute;ng t&ocirc;i v&ocirc; c&ugrave;ng biết ơn. T&ocirc;i tr&acirc;n trọng những lần &ocirc;ng ấy thăm hỏi, trao cho t&ocirc;i những c&aacute;i &ocirc;m v&agrave; kể những c&acirc;u chuyện hư cấu. &Ocirc;ng ấy l&agrave; một si&ecirc;u anh hũng vĩ đại. T&ocirc;i sẽ kh&ocirc;ng bao giờ qu&ecirc;n ng&agrave;i!\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/seth-rogen-1542081917810498158158.jpg\" title=\"Nam diễn viên Seth Rogen chia sẻ: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 12.\" id=\"img_5706d1b0-e6f9-11e8-86db-61e3517b9a39\" src=\"https://kenh14cdn.com/2018/11/13/seth-rogen-1542081917810498158158.jpg\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 12.\" /></a></p>\n\n<p>Nam diễn vi&ecirc;n Seth Rogen chia sẻ: \"Cảm ơn Stan Lee v&igrave; đ&atilde; l&agrave;m những người cảm thấy m&igrave;nh kh&aacute;c biệt so với số đ&ocirc;ng nhận ra rằng thật ra họ rất đặc biệt\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-110723-am-15420820620941152520045.png\" title=\"Người dẫn chương trình talkshow Jimmy Kimmel chia sẻ: \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 13.\" id=\"img_ac45f070-e6f9-11e8-bae2-a15b51698730\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-110723-am-15420820620941152520045.png\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 13.\" /></a></p>\n\n<p>Người dẫn chương tr&igrave;nh talkshow Jimmy Kimmel chia sẻ: \"Năm 7 tuổi, t&ocirc;i đ&atilde; vẽ bức họa kỳ cục n&agrave;y về Stan Lee v&agrave; nhờ mẹ gửi cho &ocirc;ng ấy. May m&agrave; mẹ đ&atilde; kh&ocirc;ng l&agrave;m thế, v&igrave; hơn 30 năm sau đ&oacute;, t&ocirc;i đ&atilde; được dịp trao cho &ocirc;ng ấy trực tiếp. Cảm ơn về những niềm vui ng&agrave;i đ&atilde; cho t&ocirc;i, Stan\".</p>\n\n<p><a href=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-111037-am-1542082252447377287747.png\" title=\"Jennifer Garner - từng đóng vai Elektra trong phim \"><img alt=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 14.\" id=\"img_1dbeb4d0-e6fa-11e8-87da-d19bc8560c4b\" src=\"https://kenh14cdn.com/2018/11/13/screen-shot-2018-11-13-at-111037-am-1542082252447377287747.png\" title=\"Dàn sao phim Marvel và nhiều nghệ sĩ khác cùng tưởng nhớ Stan Lee sau tin cha đẻ các siêu anh hùng qua đời - Ảnh 14.\" /></a></p>\n\n<p>Jennifer Garner - từng đ&oacute;ng vai Elektra trong phim \"Daredevil\" của Marvel - b&agrave;y tỏ: \"Ng&agrave;i đ&atilde; l&agrave;m những người phụ nữ trở th&agrave;nh người h&ugrave;ng . T&ocirc;i rất biết ơn v&igrave; đ&atilde; được l&agrave; một trong số người h&ugrave;ng đ&oacute;. Cảm ơn, Stan Lee. H&atilde;y y&ecirc;n nghỉ\".</p>\n', 10000000, 1000, 0, 11500000000, 631000000, '[]', 0.0869, 0, 'http://blockreal.local/uploads/product/images/127.0.0.1-1541090666-1082543-blockreal.vn.jpg;http://blockreal.local/uploads/product/images/127.0.0.1-1541090650-27862756-blockreal.vn.jpg;', 'null', '', 1, 1541088236, 0, 1561694068),
(10, 'MB0129319', 1, 13, 'Lê Ngọc Huân', '<p>800,000,000</p>\n\n<p>&nbsp;</p>\n\n<p>87600000000</p>\n', 10000000, 67, 0, 800000000, 6830000, '[{\"id\":6,\"name\":\"Thu gì\",\"price\":\"1230000\"},{\"id\":7,\"name\":\"Phí gì\",\"price\":\"5600000\"}]', 0.183836, 0, 'http://blockreal.local/uploads/product/images/127.0.0.1-1561005550-74340354-blockreal.vn.jpeg;http://blockreal.local/uploads/product/images/127.0.0.1-1561005541-17265067-blockreal.vn.jpg;http://blockreal.local/uploads/product/images/127.0.0.1-1561005509-18100784-blockreal.vn.jpg;', 'null', '', 1, 1543395013, 0, 0),
(11, 'abc', 5, 26, 'adbc', '<p>Thanh L&yacute; to&agrave;n bộ hệ thống</p>\n', 12000000, 34, 0, 600000000, 110000000, '[{\"id\":6,\"name\":\"Nhà Kho\",\"price\":\"10000000\"},{\"id\":7,\"name\":\"Nhảm nhí\",\"price\":\"100000000\"}]', 0.20098, 0, '', 'null', '', 1, 1543396981, 1, 1561347150),
(12, 'abc234', 5, 26, 'adbc', '<p>Thanh L&yacute; to&agrave;n bộ hệ thống</p>\n', 12000000, 34, 0, 600000000, 110000000, '[{\"id\":6,\"name\":\"Nhà Kho\",\"price\":\"10000000\"},{\"id\":7,\"name\":\"Nhảm nhí\",\"price\":\"100000000\"}]', 0.20098, -1, 'http://blockreal.local/uploads/product/images/127.0.0.1-1561013810-24530981-blockreal.vn.jpg;http://blockreal.local/uploads/product/images/127.0.0.1-1561013807-75805420-blockreal.vn.jpg;http://blockreal.local/uploads/product/images/127.0.0.1-1561013803-98855896-blockreal.vn.png;', 'null', '', 1, 1561000740, 1, 0),
(13, 'abc2344', 5, 26, 'adbc', '<p>Thanh L&yacute; to&agrave;n bộ hệ thống</p>\n', 12000000, 34, 0, 600000000, 110000000, '[{\"id\":6,\"name\":\"Nhà Kho\",\"price\":\"10000000\"},{\"id\":7,\"name\":\"Nhảm nhí\",\"price\":\"100000000\"}]', 0.20098, -1, 'http://blockreal.local/uploads/product/images/127.0.0.1-1561013810-24530981-blockreal.vn.jpg;http://blockreal.local/uploads/product/images/127.0.0.1-1561013807-75805420-blockreal.vn.jpg;http://blockreal.local/uploads/product/images/127.0.0.1-1561013803-98855896-blockreal.vn.png;', 'null', '', 1, 1561013843, 1, 0),
(14, 'COPYOF-abc', 5, 26, 'adbc', '<p>Thanh L&yacute; to&agrave;n bộ hệ thống</p>\n', 12000000, 34, 0, 600000000, 110000000, '[{\"id\":6,\"name\":\"Nhà Kho\",\"price\":\"10000000\"},{\"id\":7,\"name\":\"Nhảm nhí\",\"price\":\"100000000\"}]', 0.20098, -1, '', 'null', '', 1, 1561013932, 1, 0),
(15, 'abc-copy', 5, 26, 'adbc', '<p>Thanh L&yacute; to&agrave;n bộ hệ thống</p>\n', 12000000, 34, 0, 600000000, 110000000, '[{\"id\":6,\"name\":\"Nhà Kho\",\"price\":\"10000000\"},{\"id\":7,\"name\":\"Nhảm nhí\",\"price\":\"100000000\"}]', 0.20098, 0, '', 'null', '', 1, 1561013985, 1, 1561347926);

-- --------------------------------------------------------

--
-- Table structure for table `product_sold_history`
--

CREATE TABLE `product_sold_history` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Username from Cyclos; who buy the product',
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Fullname Who bought from cyclos',
  `slots` int(11) NOT NULL COMMENT 'total slots bought',
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL COMMENT 'Total value bought',
  `product_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'Trạng thái giao dịch; = 0 là vẫn đang giữ',
  `cyclos_transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cyclos_transaction_id_ROI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cyclos_transaction_id_principal` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Products sold history';

--
-- Dumping data for table `product_sold_history`
--

INSERT INTO `product_sold_history` (`id`, `username`, `fullname`, `slots`, `price`, `total`, `product_id`, `created_at`, `status`, `cyclos_transaction_id`, `cyclos_transaction_id_ROI`, `cyclos_transaction_id_principal`) VALUES
(1, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 1, 1540027205, 0, '', '', ''),
(2, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 1, 1540027235, 0, '', '', ''),
(3, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 2, 1540027235, -1, '', '', ''),
(4, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 2, 1540027235, 0, '', '', ''),
(5, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 3, 1540027235, 0, '', '', ''),
(6, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 3, 1540027235, -1, '', '', ''),
(7, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 4, 1540027235, -1, '', '', ''),
(8, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 4, 1540027235, -1, '', '', ''),
(9, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 4, 1540027235, 0, '', '', ''),
(10, 'huynhanhtan06', 'Huỳnh Anh Tấn', 10, 10000000, 0, 4, 1540027235, 0, '', '', ''),
(11, 'huynhanhtan06', 'Huynh Van Ku 3', 1, 10000000, 10000000, 1, 1540466088, 0, '', '', ''),
(12, 'huynhanhtan06', 'undefined', 1, 10000000, 10000000, 1, 1540521082, -1, '', '', ''),
(13, 'huynhanhtan06', 'Huynh Van Ku 3', 1, 10000000, 10000000, 1, 1540521234, -1, '', '', ''),
(14, 'huynhanhtan06', 'Huynh Van Ku 3', 1, 10000000, 10000000, 1, 1540521970, -1, '', '', ''),
(15, 'lengochuan', 'Lê Ngọc Huân', 2, 10000000, 20000000, 2, 1540527220, 0, '', '', ''),
(16, 'lengochuan', 'Lê Ngọc Huân', 2, 10000000, 20000000, 3, 1540528121, 0, '', '', ''),
(17, 'lengochuan', 'Lê Ngọc Huân', 2, 10000000, 20000000, 3, 1540528139, 0, '', '', ''),
(18, 'huynhanhtan06', 'Huynh Van Ku 3', 2, 10000000, 20000000, 2, 1540533013, 0, '', '', ''),
(19, 'huynhanhtan06', 'Huynh Van Ku', 1, 10000000, 10000000, 2, 1540542611, 0, '', '', ''),
(20, 'lengochuan', 'Lê Ngọc Huân', 2, 10000000, 20000000, 3, 1540543472, 0, '', '', ''),
(21, 'lengochuan', 'Lê Ngọc Huân', 3, 10000000, 30000000, 3, 1540544419, 0, '', '', ''),
(22, 'lengochuan', 'Lê Ngọc Huân', 3, 10000000, 30000000, 3, 1540544433, 0, '', '', ''),
(23, 'lengochuan', 'Lê Ngọc Huân', 3, 10000000, 30000000, 3, 1540544436, 0, '', '', ''),
(24, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 3, 1540544460, 0, '', '', ''),
(25, 'huynhanhtan06', 'Huynh Van Ku', 1, 10000000, 10000000, 2, 1540547026, 0, '', '', ''),
(26, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 3, 1540559687, 0, '', '', ''),
(27, 'huynhanhtan06', 'Huynh Van Ku', 1, 10000000, 10000000, 1, 1540617814, 0, '', '', ''),
(28, 'huynhanhtan06', 'Huynh Van Ku', 1, 10000000, 10000000, 5, 1540623801, 0, '', '', ''),
(29, 'ctycpblockreal02', 'CTY Cổ Phần BlockReal', 2, 10000000, 20000000, 2, 1540626389, 0, '', '', ''),
(30, 'ctycpblockreal02', 'CTY Cổ Phần BlockReal', 1, 10000000, 10000000, 6, 1540630445, 0, '', '', ''),
(31, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 6, 1541057825, 0, '', '', ''),
(32, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 1, 1541058274, 0, '', '', ''),
(33, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 1, 1541058402, 0, '', '', ''),
(34, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 1, 1541058560, 0, '', '', ''),
(35, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 1, 1541058671, 0, '', '', ''),
(36, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 1, 1541059719, 0, '', '', ''),
(37, 'lengochuan', 'Lê Ngọc Huân', 1, 10000000, 10000000, 1, 1541060234, 0, '', '', ''),
(38, 'lengochuan', 'Lê Ngọc Huân 2', 1, 10000000, 10000000, 1, 1541064445, 0, '', '', ''),
(39, 'lengochuan', 'Lê Ngọc Huân 2', 1, 10000000, 10000000, 1, 1541064855, 0, '', '', ''),
(40, 'lengochuan', 'Lê Ngọc Huân 2', 1, 10000000, 10000000, 1, 1541064934, 0, '', '', ''),
(41, 'lengochuan', 'Lê Ngọc Huân 2', 1, 10000000, 10000000, 1, 1541066472, 0, '', '', ''),
(42, 'lengochuan', 'Lê Ngọc Huân 2', 1, 10000000, 10000000, 1, 1541066711, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_suggest`
--

CREATE TABLE `product_suggest` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `address` text COLLATE utf8mb4_polish_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `images` text COLLATE utf8mb4_polish_ci NOT NULL,
  `description` text COLLATE utf8mb4_polish_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci COMMENT='BDS được đề suất bởi investor';

--
-- Dumping data for table `product_suggest`
--

INSERT INTO `product_suggest` (`id`, `username`, `fullname`, `address`, `price`, `mobile`, `province_id`, `images`, `description`, `created_at`) VALUES
(5, 'lengochuan', 'Lê Ngọc Huân 2', 'quận 5', '12000000000', '', 1, 'http://a8.vietbao.vn/images/vn888/hot/v2014/fa3fd588c5-1-la-ban-29857438.jpeg;https://images.vov.vn/w600/uploaded/g3zdcpr1cvuly8uzveukg/2018_01_28/bat_dong_san_2018_mvka.jpg;https://image.theleader.vn/thumbs/788x0/upload/ngocson/2018/1/9/phoi-canh-cua-chung-cu-hinode-city.png;http://baodansinh.vn/Images/2015/01/07/bat-dong-san.JPG;', 'Không có gì để mô tả cần thì alo theo số phone kia', 1542268851),
(6, 'lengochuan', 'Lê Ngọc Huân 2', 'quận 5', '12000000000', '', 1, 'http://a8.vietbao.vn/images/vn888/hot/v2014/fa3fd588c5-1-la-ban-29857438.jpeg;https://images.vov.vn/w600/uploaded/g3zdcpr1cvuly8uzveukg/2018_01_28/bat_dong_san_2018_mvka.jpg;https://image.theleader.vn/thumbs/788x0/upload/ngocson/2018/1/9/phoi-canh-cua-chung-cu-hinode-city.png;http://baodansinh.vn/Images/2015/01/07/bat-dong-san.JPG;', 'Không có gì để mô tả cần thì alo theo số phone kia', 1542268852),
(7, 'lengochuan', 'Lê Ngọc Huân 2', 'quận 5', '12000000000', '', 1, 'http://a8.vietbao.vn/images/vn888/hot/v2014/fa3fd588c5-1-la-ban-29857438.jpeg;https://images.vov.vn/w600/uploaded/g3zdcpr1cvuly8uzveukg/2018_01_28/bat_dong_san_2018_mvka.jpg;https://image.theleader.vn/thumbs/788x0/upload/ngocson/2018/1/9/phoi-canh-cua-chung-cu-hinode-city.png;http://baodansinh.vn/Images/2015/01/07/bat-dong-san.JPG;', 'Không có gì để mô tả cần thì alo theo số phone kia', 1542268852),
(8, 'lengochuan', 'Lê Ngọc Huân 2', 'quận 5', '12000000000', '', 1, 'http://a8.vietbao.vn/images/vn888/hot/v2014/fa3fd588c5-1-la-ban-29857438.jpeg;https://images.vov.vn/w600/uploaded/g3zdcpr1cvuly8uzveukg/2018_01_28/bat_dong_san_2018_mvka.jpg;https://image.theleader.vn/thumbs/788x0/upload/ngocson/2018/1/9/phoi-canh-cua-chung-cu-hinode-city.png;http://baodansinh.vn/Images/2015/01/07/bat-dong-san.JPG;', 'Không có gì để mô tả cần thì alo theo số phone kia', 1542268852),
(9, 'lengochuan', 'Lê Ngọc Huân 2', 'quận 5', '12000000000', '', 1, 'http://a8.vietbao.vn/images/vn888/hot/v2014/fa3fd588c5-1-la-ban-29857438.jpeg;https://images.vov.vn/w600/uploaded/g3zdcpr1cvuly8uzveukg/2018_01_28/bat_dong_san_2018_mvka.jpg;https://image.theleader.vn/thumbs/788x0/upload/ngocson/2018/1/9/phoi-canh-cua-chung-cu-hinode-city.png;http://baodansinh.vn/Images/2015/01/07/bat-dong-san.JPG;', 'Không có gì để mô tả cần thì alo theo số phone kia', 1542268853);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Provinces List';

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`, `deleted`, `priority`, `created_by`) VALUES
(1, 'Hồ Chí Minh', 0, 0, 1),
(2, 'Cần Thơ', 0, 1, 1),
(3, 'Bình Dương', 0, 0, 1),
(4, 'Tiền Giang', 0, 0, 1),
(5, 'Bến Tre vvc', 0, 0, 1),
(6, 'Long An', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `selling`
--

CREATE TABLE `selling` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `selling_type_root` int(11) NOT NULL,
  `selling_type_id` int(11) NOT NULL,
  `selling_unit_id` int(11) NOT NULL DEFAULT '0',
  `project_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acreage` float NOT NULL COMMENT 'diện tích',
  `direction_house` int(11) NOT NULL,
  `direction_balcony` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `no_room` int(11) NOT NULL,
  `no_toilet` int(11) NOT NULL,
  `contact_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_mobile` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_hidden` int(1) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `top` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Sản phẩm đang rao bán ';

--
-- Dumping data for table `selling`
--

INSERT INTO `selling` (`id`, `code`, `title`, `province_id`, `city_id`, `address`, `selling_type_root`, `selling_type_id`, `selling_unit_id`, `project_name`, `acreage`, `direction_house`, `direction_balcony`, `price`, `unit`, `no_room`, `no_toilet`, `contact_name`, `contact_mobile`, `description`, `img`, `created_by`, `is_hidden`, `deleted`, `created_at`, `top`) VALUES
(1, 'MBDSD234234', 'Bán Đất Quận 9 - ABC XYZ', 5, 27, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 1, 0, 0, 1561213973, 1561348844),
(2, 'MB2342', 'Thành Phần Không Làm Gì', 5, 25, '', 1, 5, 1, '', 0, 0, 0, 0, 0, 0, 0, '', '0905094280', '', '', 1, 0, 0, 1561214634, 0),
(3, 'MD234', 'Thiên Phong Làm Ăn Ngon', 5, 28, '', 1, 6, 1, '', 0, 0, 0, 0, 0, 0, 0, '', '0905094280', '', '', 1, 0, 0, 1561214830, 0),
(4, '26', 'Lê Thành Nam', 5, 26, 'lkadjflaksdjfl', 1, 7, 3, '324234', 234, 1, 2, 23, 0, 23, 3, 'Lê ngọc Huân', '029412301923', '<p>029412301923</p>\n\n<p>029412301923</p>\n\n<p>029412301923</p>\n\n<p>029412301923</p>\n\n<p>029412301923</p>\n', 'http://blockreal.local/uploads/product/images/127.0.0.1-1561215013-58820319-blockreal.vn.jpg;', 1, 0, 0, 1561215017, 0),
(5, '26ss', 'Lê Thành Nam', 5, 26, 'lkadjflaksdjfl', 1, 4, 0, '324234', 234, 1, 2, 23, 0, 23, 3, 'Lê ngọc Huân', '029412301923', '<p>029412301923</p>\n\n<p>029412301923</p>\n\n<p>029412301923</p>\n\n<p>029412301923</p>\n\n<p>029412301923</p>\n', 'http://blockreal.local/uploads/product/images/127.0.0.1-1561215013-58820319-blockreal.vn.jpg;', 1, 0, 0, 1561215721, 0),
(6, 'àdsfads', 'fadsfasdf', 5, 26, 'ádfa', 1, 5, 3, 'sdfasdf', 123, 1, 1, 12, 0, 12, 2, '123123', '1323123123123123', '', 'http://blockreal.local/uploads/product/images/127.0.0.1-1561348485-21593956-blockreal.vn.jpeg;', 1, 0, 0, 1561348487, 1561348846),
(7, 'ssdsa', 'sdfasdfasdf', 5, 25, 'asdfasdfasdf', 2, 15, 6, 'asdfasdf', 232, 1, 1, 122, 0, 122, 0, '', '0905094280', '', 'http://blockreal.local/uploads/product/images/127.0.0.1-1563424560-57844276-blockreal.vn.jpeg;', 1, 0, 0, 1563424561, 1563424561);

-- --------------------------------------------------------

--
-- Table structure for table `selling_direction`
--

CREATE TABLE `selling_direction` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `selling_direction`
--

INSERT INTO `selling_direction` (`id`, `name`) VALUES
(1, 'Không xác định'),
(2, 'Đông'),
(3, 'Tây'),
(4, 'Nam'),
(5, 'Bắc'),
(6, 'Đông bắc'),
(7, 'Đông nam'),
(8, 'Tây bắc'),
(9, 'Tây nam');

-- --------------------------------------------------------

--
-- Table structure for table `selling_type`
--

CREATE TABLE `selling_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `root_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Loại hình thức rao bán';

--
-- Dumping data for table `selling_type`
--

INSERT INTO `selling_type` (`id`, `name`, `root_id`) VALUES
(1, 'Nhà đất bán', 0),
(2, 'Nhà đất cho thuê', 0),
(3, 'Không xác định', -1),
(4, 'Không xác định', 1),
(5, 'Bán căn hộ chung cư', 1),
(6, 'Bán nhà riêng', 1),
(7, 'Bán nhà biệt thự, liền kề', 1),
(8, 'Bán nhà mặt phố', 1),
(9, 'Bán đất nền dự án', 1),
(10, 'Bán đất', 1),
(11, 'Bán trang trại, khu nghỉ dưỡng', 1),
(12, 'Bán kho, nhà xưởng', 1),
(13, 'Bán loại bất động sản khác', 1),
(14, 'Không xác định', 2),
(15, 'Cho thuê căn hộ chung cư', 2),
(16, 'Cho thuê nhà riêng', 2),
(17, 'Cho thuê nhà mặt phố', 2),
(18, 'Cho thuê nhà trọ, phòng trọ', 2),
(19, 'Cho thuê văn phòng', 2),
(20, 'Cho thuê cửa hàng, ki ốt', 2),
(21, 'Cho thuê kho, nhà xưởng, đất', 2),
(22, 'Cho thuê loại bất động sản khác', 2);

-- --------------------------------------------------------

--
-- Table structure for table `selling_unit`
--

CREATE TABLE `selling_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `root_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `selling_unit`
--

INSERT INTO `selling_unit` (`id`, `name`, `root_id`) VALUES
(1, 'Thỏa thuận', 1),
(2, 'Triệu', 1),
(3, 'Tỷ', 1),
(4, 'Trăm nghìn/ m2', 1),
(5, 'Triệu/ m2', 1),
(6, 'Thỏa thuận', 2),
(7, 'Trăm nghìn/ tháng', 2),
(8, 'Triệu/ Tháng', 2),
(9, 'Trăm nghìn/ m2/ Tháng', 2),
(10, 'Triệu/ m2/ Tháng', 2),
(11, 'Nghìn/ m2/ Tháng', 2),
(12, 'Không xác định', -1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `varname` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` text,
  `defaultvalue` text,
  `datatype` varchar(50) NOT NULL DEFAULT '',
  `group` varchar(50) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`varname`, `title`, `value`, `defaultvalue`, `datatype`, `group`, `priority`) VALUES
('api_key_store_kht', 'API KEY kết nối kho hàng tổng', '8bfba1e9d39dfdb5d498b904824aa128', '8bfba1e9d39dfdb5d498b904824aa128', 'text', 'version', 1),
('app_description', 'Nội dung giới thiệu trang chủ trên APP', 'D-member là hệ thống điểm nội bộ của DGroup', 'Keller Williams là công ty nhường quyền môi giới Bất Động Sản số một tại Mỹ, được thành lập từ năm 1983, hiện đang có hơn 1.000.000 môi giới toàn cầu, tại 42 quốc gia trên thành phố. Keller Williams Việt Nam là đại diện chính thức của Keller Williams USA tại thị trường Việt Nam', 'text', '1', 0),
('cyclos_account_type', 'The account type Cyclos', 'vndcacc', 'vndcacc', 'text', '1', 0),
('cyclos_admin_account', 'Tài khoản Admin Cyclos để thực hiện chuyển tiền', 'administrator', 'tanha', 'text', '1', 0),
('cyclos_admin_password', 'Mật khẩu tài khoản Admin Cyclos để thực hiện chuyển tiền', 'WdgqeeM@bQ8GT7vV', 'tanha', 'password', '1', 0),
('cyclos_group_building', 'Cyclos Group Building Code', 'brs_building', 'brs_building', 'text', '1', 0),
('cyclos_payment_type_for_deposit', 'Mã/ loại thanh toán trong hệ thống Cyclos cho nạp', 'vndacc.vndnap', 'vndcacc.chuyenvndcotp', 'text', '1', 0),
('cyclos_payment_type_for_deposit_info', 'Mã/ loại thanh toán trong hệ thống Cyclos cho cọc/mua BĐS', 'vndacc.vndnap', 'vndcacc.chuyenvndcotp', 'text', '1', 0),
('cyclos_payment_type_for_investor', 'Mã/ loại thanh toán trong hệ thống Cyclos cho đầu tư', 'vndacc.vnddautu', 'vndcacc.chuyenvndcotp', 'text', '1', 0),
('cyclos_payment_type_for_transfer', 'Mã chuyển khoản giữa user của cyclos', 'vndacc.chuyenvnd', 'vndacc.chuyenvnd', 'text', '1', 0),
('cyclos_payment_type_for_withdraw', 'Mã/ loại thanh toán trong hệ thống Cyclos cho rut', 'vndacc.vndrut', 'vndcacc.chuyenvndcotp', 'text', '1', 0),
('decimal', 'Decimal length default', '0', 'xxx.00', 'text', '1', 0),
('default_password', 'Default Password', '1234Abcd', '1234Abcd', 'password', '1', 0),
('fixed_deposit', 'Fixed Deposit', '20000000', '20000000', 'text', '1', 0),
('group_register', 'Cấu hình nhóm đăng ký theo cyclos', 'brs_newbie', 'Admin Dashboard', 'text', '1', 0),
('is_self_selling', 'Chợ là sản phẩm tự đăng đã đăng nhập', '1', '0', 'checkbox', '1', 0),
('is_self_selling_without_login', 'Chợ là sản phẩm tự đăng chưa đăng nhập', '1', '0', 'checkbox', '1', 0),
('lang', 'Langage', 'vi', 'en|kh', 'text', '1', 0),
('link_API', 'Link API to Cyclos System', 'https://share.ecosite.vn/api', 'https://sandbox.trustbank.asia', 'text', '1', 0),
('link_API_external', 'Link API to External System', 'https://musado.vn/blockreal/api', 'http://blockreal.local/api', 'text', '1', 0),
('link_domain', 'Link System domain', 'https://musado.vn/blockreal', 'https://musado.vn/blockreal', 'text', '1', 0),
('main_current', 'Mã đồng tiền ( dòng tiền) chính trên cyclos', 'dpoint', 'VND', 'text', '1', 0),
('opt_status', 'Trạng thái sử dung OTP thanh toán của hệ thống', 'true', 'true|false\r\n\r\nbằng false là không sử dụng OTP\r\n\r\n= true là sử dụng OTP: password; email; OTP SMS', 'text', '1', 0),
('opt_type', 'Loại OTP đang sử dụng', 'otp', 'otp = email; sms OTP|login = dùng mật khẩu', 'text', '1', 0),
('perpage', 'Số dòng trên một trang', '20', '30 record/perpage', 'text', '1', 0),
('receive_deposit_info_account', 'Tài khoản Cyclos chuyên nhận cọc/mua BĐS', 'brsgateway', 'brsgateway', 'text', '1', 0),
('receive_fund_account', 'Tài khoản nhận tiền khi người dùng rút tiền', 'brsgateway', 'ctycpblockreal01', 'text', '1', 0),
('receive_fund_fullname', 'Tên tài khoản nhận tiền khi người dùng rút tiền', 'Cty Cổ Phần DGroup', 'Cty Cổ Phần BlockReal Việt Nam', 'text', '1', 0),
('timezone', 'timezone', 'Asia/Ho_Chi_Minh', 'Admin Dashboard', 'text', '1', 0),
('transfer_fund_account', 'Tài khoản rút tiền, để nạp cho user', 'brsgateway', 'ctycpblockreal01', 'text', '1', 0),
('transfer_fund_fullname', 'Tên tài khoản rút tiền, để nạp cho user', 'Cty Cổ Phần DGroup', 'Cty Cổ Phần BlockReal', 'text', '1', 0),
('version', 'Version of Website', '0.00001', '1.00', 'text', 'version', 1),
('webtitle', 'Web Title', 'D-Member Pay', 'Admin Dashboard', 'text', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trade`
--

CREATE TABLE `trade` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `investor_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `contact_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_mobile` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Treo bán bất động sản';

-- --------------------------------------------------------

--
-- Table structure for table `transaction_funding`
--

CREATE TABLE `transaction_funding` (
  `id` int(11) NOT NULL,
  `bank_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'withdraw|deposite',
  `status` int(1) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `branch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cyclos_transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Danh sách giao dịch nạp rút tiền';

--
-- Dumping data for table `transaction_funding`
--

INSERT INTO `transaction_funding` (`id`, `bank_code`, `bank_name`, `bank_account`, `bank_account_name`, `amount`, `username`, `fullname`, `type`, `status`, `approved_by`, `created_at`, `branch`, `note`, `cyclos_transaction_id`) VALUES
(1, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '54848488454', 'Ngô Thanh Tuấn', 5000000, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519151, '', '', ''),
(2, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '65648', 'Ngo Thanh Tuan', 500000, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519254, '', '0', ''),
(3, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '5484848', 'Ndhdbdh', 545484848, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519332, '', '0', ''),
(4, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '855888', 'Fffvb', 55555888, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519459, '', '0', ''),
(5, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '545454545848778', 'Ncbcjf', 848787, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519725, '', '0', ''),
(6, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '545454545848778', 'Ncbcjf', 848787, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519726, '', '0', ''),
(7, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '97878989', 'Bxbcncnc', 500000, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519844, '', '0', ''),
(8, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '55882585', 'Ggdgg', 558855, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540519927, '', '0', ''),
(9, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '8784848', 'Ndhdh', 1000000, 'huynhanhtan06', 'Huynh Van Ku 3', 'withdraw', 0, 0, 1540522002, '', '0', ''),
(10, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 5000000, 'huynhanhtan06', 'Huynh Van Ku 3', 'deposit', 0, 0, 1540522012, '', '0', ''),
(11, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 200000000, 'lengochuan', 'Lê Ngọc Huân', 'deposit', 0, 0, 1540528206, '', '0', ''),
(12, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 1000000, 'lengochuan', 'Lê Ngọc Huân', 'deposit', 0, 0, 1540528237, '', '0', ''),
(13, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 500000, 'huynhanhtan06', 'Huynh Van Ku', 'deposit', 0, 0, 1540542625, '', '0', ''),
(14, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '048515187751548', 'le ngoc huan', 10000000, 'lengochuan', 'Lê Ngọc Huân', 'withdraw', -1, 0, 1540543863, '', '0', ''),
(15, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 1000000, 'lengochuan', 'Lê Ngọc Huân', 'deposit', 0, 0, 1540544728, '', '0', ''),
(16, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '123456789test', 'Huynh Van Ku 3', 30000, 'huynhanhtan06', 'Huynh Van Ku', 'withdraw', 0, 0, 1540550973, '', '0', ''),
(17, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 1000000, 'lengochuan', 'Lê Ngọc Huân', 'deposit', 0, 0, 1540559471, '', '0', ''),
(18, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '13448Abc', 'hhh', 1000000, 'lengochuan', 'Lê Ngọc Huân', 'withdraw', 0, 0, 1540559504, '', '0', ''),
(19, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 1000000, 'lengochuan', 'Lê Ngọc Huân', 'deposit', 0, 0, 1540559539, '', '0', ''),
(20, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '123456789', 'Huynh Van Ku', 500000, 'huynhanhtan06', 'Huynh Van Ku', 'withdraw', 0, 0, 1540606936, '', '0', ''),
(21, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '123456789', 'Huynh Van Ku', 500000, 'huynhanhtan06', 'Huynh Van Ku', 'withdraw', 0, 0, 1540608196, '', '0', ''),
(22, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 12000000, 'ctycpblockreal02', 'CTY Cổ Phần BlockReal', 'deposit', 0, 0, 1540632604, '', '0', ''),
(23, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 50000000, 'ctycpblockreal02', 'CTY Cổ Phần BlockReal', 'deposit', 0, 0, 1540649861, '', '0', ''),
(24, 'BIDV', 'Ngân Hàng Đầu Tư Và Phát Triển Việt Nam', '0432000413149', 'CTY CP TRUSTPAY', 500000, 'ctycpblockreal02', 'CTY Cổ Phần BlockReal', 'deposit', 0, 0, 1540730498, '', '0', ''),
(25, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 5000000, 'thanhtuan123', 'undefined', 'deposit', 0, 0, 1540879338, '', '', ''),
(26, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 200000, 'lengochuan', 'undefined', 'deposit', 0, 0, 1541057244, '', '', ''),
(27, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', 'ccvvhh', 'Đcvg', 8885588, 'lengochuan', 'undefined', 'withdraw', 0, 0, 1541057264, '', 'Cvvv', ''),
(28, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '04320004A1319', 'CTY CP TRUSTPAY', 100000000, 'lengochuan', 'Lê Ngọc Huân 2', 'deposit', 0, 0, 1541067049, '', '', ''),
(29, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '123456781', 'Le Ngọc Huan', 12000000, 'lengochuan', 'Lê Ngọc Huân 2', 'withdraw', 0, 0, 1541067158, '', 'Rút tiền\n', ''),
(31, 'VCB', 'Ngân Hàng Ngoại Thương Việt Nam', '012931309912312', 'Cty Cổ Phần TrustPay', 1000000, 'lengochuan', 'Lê Ngọc Huân 2', 'withdraw', 0, 0, 1541220315, '', '', '12313131313123'),
(101, 'ACB', 'Ngân Hàng Ngoại Thương Việt Nam', '012931309912312', 'Cty Cổ Phần TrustPay', 1000000, 'lengochuan', 'Lê Ngọc Huân 2', 'deposit', 0, 1, 1541220285, '', '', 'VND000645404');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `from_investor_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `from_investor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_investor_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `to_investor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cyclos_transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_investor_paid_at` int(11) NOT NULL DEFAULT '0',
  `cylos_note` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_history`
--

CREATE TABLE `transfer_history` (
  `id` int(11) NOT NULL,
  `related_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `related_account` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `related_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `is_deposit` int(1) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `cyclos_transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Lịch sử giao dịch nạp rút từ Backoffice';

--
-- Dumping data for table `transfer_history`
--

INSERT INTO `transfer_history` (`id`, `related_name`, `related_account`, `related_id`, `amount`, `fee`, `is_deposit`, `description`, `cyclos_transaction_id`, `created_at`, `created_by`) VALUES
(1, 'Lê Ngọc Huân', 'lehuantest2', 2147483647, 999900, 0, 0, '0', 'VND000650126', 1545984371, 1),
(2, 'Lê Ngọc Huân', 'lehuantest2', 2147483647, 1000000, 0, 0, 'Rút tiền chơi', 'VND000650147', 1545984664, 1),
(3, 'Lê Ngọc Huân', 'lehuantest2', 2147483647, 1000000, 0, 0, 'Rút tiền lại nhé, chuyển dư', 'VND000653435', 1546053459, 1),
(4, 'Lê Ngọc Huân', 'lehuantest2', 2147483647, 1000000, 0, 0, 'Rút tiền lại nhé, chuyển dư', 'VND000653678', 1546058674, 1),
(5, 'Lê Ngọc Huân', 'lehuantest2', 2147483647, 1000000, 0, 1, '', 'VND000700096', 1547029579, 1),
(6, 'Lê Ngọc Huân', 'lehuantest2', 2147483647, 100000, 0, 0, '', 'VND000700163', 1547031029, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL DEFAULT '0',
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sex` int(1) NOT NULL DEFAULT '1' COMMENT '=0 is women, = 1 is men',
  `day` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '00',
  `month` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '00',
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2018',
  `avatar` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_login_at` int(11) NOT NULL DEFAULT '0',
  `permission` text COLLATE utf8_unicode_ci COMMENT 'permission access functions',
  `created_at` int(11) NOT NULL,
  `lang` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'vi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng thành viên';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `gid`, `password`, `salt`, `mobile`, `email`, `address`, `note`, `status`, `fullname`, `sex`, `day`, `month`, `year`, `avatar`, `last_login_at`, `permission`, `created_at`, `lang`) VALUES
(1, 1, '62dd981d06adaf601f502b0117ed7c8e', '64GGZ7vxLo', '+8550000000', 'admin@gmail.com', 'No.58E0 St.53, Psar thmey 3, Duan penh District, (133.77 mi) Phnom Penh 855', '', 'Active', 'Administrator', 1, '01', '01', '1990', '', 1536740963, '', 0, 'vi'),
(3, 18, '514cd946dbd301d75a8f720528cb2ef3', 'gA4dOzmrS8', '0905094280', 'lengochuan@yopmail.com', '123 Lê Ngọc Huân, Quận 5', '', 'Active', 'Lê Ngọc Huân', 0, '31', '10', '2018', '', 0, ':indexreport:reporthistory:reportdetail_investor:;:indexreport:reportROI:;:indexreport:reportdeposit:;:indexproduct:productidx:;:productprovince:productcity:;:productdelete:;:indexinvestor:investoridx:;:indexstaff:staffidx:;:staffgid:;:staffsave:;:staffdelete:;:productadd:;:productedit:;:indexbank:bankidx:;:indexnotification:notificationidx:;:indexsetting:settingidx:;:notificationsave:;:notificationdelete:;:indexreport:reportwithdraw:;:productROI:;:staffreset_password:;:investorpassword_reset:;:reportdeposit_done:;:reportwithdraw_done:;:indextransaction:transactionidx:;:transactionwithdraw:;:transactiondeposit:;:productproduct_history:;:indexdeposit:depositidx:;:depositdone:;:depositrefund:;:depositdelete:;:productclone:;:producthidden:;:indexmlm:mlmidx:;:indexmlm:mlmcommission:;:indexmlm:mlmdelivery_commission:;:useridx:', 1540983874, 'vi'),
(5, 20, '2c39f63bc38c9439140f03c9e2bf0431', '3B6IfAhxGH', '0909090909', '09090909090@gmail.com', 'Lê Huân, Quận 10, TP.HCM', '', 'Active', 'Lê Ngọc', 0, '12', '11', '2018', '', 0, ':useridx:', 1542008586, 'vi'),
(6, 1, '86ff1b874f7e9ecf37d3106669743f24', '8dHMiNv8ga', '0905094289', 'lehuan22@gmail.com', 'Lê Huân 23, Trần Não 4, Quận 4, HCM', '', 'Active', 'Lê Ngọc Huân', 0, '18', '12', '2018', '', 0, ':useridx:', 1545104081, 'vi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_change`
--
ALTER TABLE `bank_change`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_info`
--
ALTER TABLE `deposit_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gid`
--
ALTER TABLE `gid`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_commission`
--
ALTER TABLE `mlm_commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_commission_history`
--
ALTER TABLE `mlm_commission_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_detail`
--
ALTER TABLE `mlm_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_level`
--
ALTER TABLE `mlm_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sold_history`
--
ALTER TABLE `product_sold_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_suggest`
--
ALTER TABLE `product_suggest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selling_direction`
--
ALTER TABLE `selling_direction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selling_type`
--
ALTER TABLE `selling_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selling_unit`
--
ALTER TABLE `selling_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`varname`);

--
-- Indexes for table `trade`
--
ALTER TABLE `trade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_funding`
--
ALTER TABLE `transaction_funding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_history`
--
ALTER TABLE `transfer_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gid` (`gid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_change`
--
ALTER TABLE `bank_change`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_info`
--
ALTER TABLE `deposit_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gid`
--
ALTER TABLE `gid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mlm_commission`
--
ALTER TABLE `mlm_commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mlm_commission_history`
--
ALTER TABLE `mlm_commission_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_detail`
--
ALTER TABLE `mlm_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mlm_level`
--
ALTER TABLE `mlm_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_sold_history`
--
ALTER TABLE `product_sold_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_suggest`
--
ALTER TABLE `product_suggest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `selling`
--
ALTER TABLE `selling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `selling_direction`
--
ALTER TABLE `selling_direction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `selling_type`
--
ALTER TABLE `selling_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `selling_unit`
--
ALTER TABLE `selling_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trade`
--
ALTER TABLE `trade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_funding`
--
ALTER TABLE `transaction_funding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_history`
--
ALTER TABLE `transfer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
