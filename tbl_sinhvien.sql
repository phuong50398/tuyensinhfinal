-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2019 at 11:44 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devfithou_nh2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sinhvien`
--

CREATE TABLE IF NOT EXISTS `tbl_sinhvien` (
  `soBD` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CMND` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `masv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoten` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ngaysinh` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioitinh` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `FK_sMaNganh` int(11) NOT NULL,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hokhau` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chucvu` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namtotnghiep` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hedaotao` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FK_tongiao` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nangkhieu` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noitotnghiep` text COLLATE utf8_unicode_ci,
  `sdt` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trinhdo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noisinh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doan` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quequan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FK_Dantoc` int(11) DEFAULT NULL,
  `doituong` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `khuvuc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bachoc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `khoihoc` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `toan` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vatly` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoahoc` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sinhhoc` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguvan` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lichsu` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dialy` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngoaingu` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tongdiem_goc` float DEFAULT NULL,
  `tongdiem_xettuyen` float DEFAULT NULL,
  `hoten_bo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namsinh_bo` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nghenghiep_bo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt_bo` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoten_me` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namsinh_me` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nghenghiep_me` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt_me` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` int(1) DEFAULT NULL,
  `ktx` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FK_iMaQuyen` int(11) NOT NULL,
  `ngaycapcmnd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noicapcmnd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nangkhieu1` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nangkhieu2` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nangkhieu3` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoso` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocphi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `tongtien_dathu` bigint(20) DEFAULT NULL,
  `nguoinhaphs` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoithu_hocphi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoithuhs` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoigian_nhaphs` datetime DEFAULT NULL,
  `thoigian_thuhs` datetime DEFAULT NULL,
  `thoigian_hocphi` datetime DEFAULT NULL,
  `nguoithuhp_nh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoithu_phieudiem` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoigian_thuphieudiem` datetime DEFAULT NULL,
  `nguoitra_giaybao` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoigian_tragiaybao` datetime DEFAULT NULL,
  `sohs_nh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tinh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `huyen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoigiancho_hangdoi` date DEFAULT NULL,
  `nguoian_hangdoi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_sinhvien`
--

INSERT INTO `tbl_sinhvien` (`soBD`, `CMND`, `masv`, `hoten`, `ngaysinh`, `gioitinh`, `FK_sMaNganh`, `ghichu`, `hokhau`, `chucvu`, `namtotnghiep`, `email`, `hedaotao`, `FK_tongiao`, `diachi`, `nangkhieu`, `noitotnghiep`, `sdt`, `trinhdo`, `noisinh`, `doan`, `quequan`, `FK_Dantoc`, `doituong`, `khuvuc`, `bachoc`, `khoihoc`, `toan`, `vatly`, `hoahoc`, `sinhhoc`, `nguvan`, `lichsu`, `dialy`, `ngoaingu`, `tongdiem_goc`, `tongdiem_xettuyen`, `hoten_bo`, `namsinh_bo`, `nghenghiep_bo`, `sdt_bo`, `hoten_me`, `namsinh_me`, `nghenghiep_me`, `sdt_me`, `trangthai`, `ktx`, `FK_iMaQuyen`, `ngaycapcmnd`, `noicapcmnd`, `nangkhieu1`, `nangkhieu2`, `nangkhieu3`, `hoso`, `hocphi`, `thoigian`, `tongtien_dathu`, `nguoinhaphs`, `nguoithu_hocphi`, `nguoithuhs`, `thoigian_nhaphs`, `thoigian_thuhs`, `thoigian_hocphi`, `nguoithuhp_nh`, `nguoithu_phieudiem`, `thoigian_thuphieudiem`, `nguoitra_giaybao`, `thoigian_tragiaybao`, `sohs_nh`, `tinh`, `huyen`, `xa`, `thoigiancho_hangdoi`, `nguoian_hangdoi`) VALUES
('19001110', '1', NULL, 'Trần Mạnh Hùng', '02/10/1999', 'Nam', 15, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '04-10-13', NULL, NULL, NULL, NULL, NULL),
('19001111', '1', NULL, 'Nguyễn Thị Bích Phương', '03/10/1999', 'Nữ', 10, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-14', NULL, NULL, NULL, NULL, NULL),
('19001112', '1', NULL, 'Đặng Thị Hương Lan', '04/10/1999', 'Nữ', 61, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '2017-01-01', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-15', NULL, NULL, NULL, NULL, NULL),
('19001113', '1', NULL, 'Lê Thị Yên', '05/10/1999', 'Nữ', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-12', NULL, NULL, NULL, NULL, NULL),
('19001114', '1', NULL, 'Lê Thị Tuyên', '06/10/1999', 'Nữ', 15, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '04-10-16', NULL, NULL, NULL, NULL, NULL),
('19001115', '1', NULL, 'Nguyễn Tiến Dũng', '07/10/1999', 'Nam', 10, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-17', NULL, NULL, NULL, NULL, NULL),
('19001116', '1', NULL, 'Nguyễn Văn Bảo', '08/10/1999', 'Nam', 61, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '17/07/2019', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-18', NULL, NULL, NULL, NULL, NULL),
('19001117', '1', NULL, 'Nguyễn Duy Thành', '09/10/1999', 'Nam', 43, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', NULL, NULL, 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, 'Không', 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01-12-19', NULL, NULL, NULL, NULL, NULL),
('19001118', '1', NULL, 'Trần Mạnh Hùng', '10/10/1999', 'Nam', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '02-12-20', NULL, NULL, NULL, NULL, NULL),
('19001119', '1', NULL, 'Phạm Thị Ngoãn', '11/10/1999', 'Nữ', 44, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', NULL, NULL, 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, 'Không', 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01-12-21', NULL, NULL, NULL, NULL, NULL),
('19001120', '1', NULL, 'Nguyễn Thúy Thu', '12/10/1999', 'Nữ', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '02-12-22', NULL, NULL, NULL, NULL, NULL),
('19001121', '1', NULL, 'Bùi Văn Hùng', '13/10/1999', 'Nam', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-23', NULL, NULL, NULL, NULL, NULL),
('19001122', '1', NULL, 'Lê Thị Khanh Linh', '14/10/1999', 'Nữ', 15, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '04-10-24', NULL, NULL, NULL, NULL, NULL),
('19001123', '1', NULL, 'Bùi Đăng Khoa', '15/10/1999', 'Nữ', 10, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-25', NULL, NULL, NULL, NULL, NULL),
('19001124', '1', NULL, 'Nguyễn Thị Hương Lan', '16/10/1999', 'Nữ', 61, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '17/07/2019', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-26', NULL, NULL, NULL, NULL, NULL),
('19001191', '1', NULL, 'Nguyễn Thị Linh', '17/10/1999', 'Nữ', 10, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', NULL, NULL, 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, 'Không', 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01-12-27', NULL, NULL, NULL, NULL, NULL),
('19001192', '1', NULL, 'Nguyễn Đình Thi', '18/10/1999', 'Nam', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '02-12-28', NULL, NULL, NULL, NULL, NULL),
('19001193', '1', NULL, 'Nguyễn Văn Lâm', '19/10/1999', 'Nam', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-29', NULL, NULL, NULL, NULL, NULL),
('19001194', '1', NULL, 'Trần Mạnh Hùng', '20/10/1999', 'Nam', 15, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '04-10-30', NULL, NULL, NULL, NULL, NULL),
('19001195', '1', NULL, 'Nguyễn Thị Bích Phương', '21/10/1999', 'Nữ', 10, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A00', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-32', NULL, NULL, NULL, NULL, NULL),
('19001196', '1', NULL, 'Nguyễn Thị Hương Lan', '22/10/1999', 'Nữ', 61, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '17/07/2019', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-31', NULL, NULL, NULL, NULL, NULL),
('19001197', '1', NULL, 'Nguyễn Thị Linh', '23/10/1999', 'Nữ', 10, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', NULL, NULL, 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, 'Không', 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01-12-32', NULL, NULL, NULL, NULL, NULL),
('19001198', '1', NULL, 'Nguyễn Đình Thi', '24/10/1999', 'Nam', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '02-12-33', NULL, NULL, NULL, NULL, NULL),
('19001199', '1', NULL, 'Nguyễn Thị Bích Thủy', '25/10/1999', 'Nam', 12, NULL, NULL, NULL, 2019, NULL, 'Chính quy', 'khong', NULL, NULL, NULL, NULL, 'Đại học', NULL, NULL, NULL, 29, '01', 'KV2-NT', 'Trung học phổ thông', 'A01', '5', '5', '8', '9', '9', '9', '9', '9', 18, 19, NULL, '1980', 'Làm Nông', '018238129', 'Nguyễn Thị B', '1980', 'Làm Nông', '098218213', NULL, NULL, 7, '16/07/2017', 'Bắc Ninh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03-10-34', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD PRIMARY KEY (`soBD`),
  ADD KEY `PK_sMaNganh` (`FK_sMaNganh`),
  ADD KEY `FK_Hedaotao` (`hedaotao`),
  ADD KEY `FK_Dantoc` (`FK_Dantoc`),
  ADD KEY `FK_iMaQuyen` (`FK_iMaQuyen`),
  ADD KEY `mathutien` (`hocphi`),
  ADD KEY `khoihoc` (`khoihoc`),
  ADD KEY `doituong` (`doituong`,`khuvuc`),
  ADD KEY `khuvuc` (`khuvuc`),
  ADD KEY `nguoinhaphs` (`nguoinhaphs`,`nguoithu_hocphi`,`nguoithuhs`),
  ADD KEY `nguoithutien` (`nguoithu_hocphi`),
  ADD KEY `nguoithuhs` (`nguoithuhs`),
  ADD KEY `trangthai` (`trangthai`),
  ADD KEY `PK_tongiao` (`FK_tongiao`),
  ADD KEY `masv` (`masv`),
  ADD KEY `masv_2` (`masv`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD CONSTRAINT `tbl_sinhvien_ibfk_10` FOREIGN KEY (`nguoinhaphs`) REFERENCES `dm_canbo` (`macb`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_11` FOREIGN KEY (`nguoithu_hocphi`) REFERENCES `dm_canbo` (`macb`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_12` FOREIGN KEY (`nguoithuhs`) REFERENCES `dm_canbo` (`macb`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_13` FOREIGN KEY (`trangthai`) REFERENCES `dm_trangthai` (`matt`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_14` FOREIGN KEY (`FK_tongiao`) REFERENCES `dm_tongiao` (`madm_tongiao`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_3` FOREIGN KEY (`FK_Dantoc`) REFERENCES `dm_dantoc` (`iMaDT`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_5` FOREIGN KEY (`FK_iMaQuyen`) REFERENCES `tbl_quyen` (`iMa_Quyen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_6` FOREIGN KEY (`FK_sMaNganh`) REFERENCES `tbl_nganh` (`iMa_nganh`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_7` FOREIGN KEY (`khoihoc`) REFERENCES `tbl_khoihoc` (`makhoi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_8` FOREIGN KEY (`doituong`) REFERENCES `dm_doituong` (`madt`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sinhvien_ibfk_9` FOREIGN KEY (`khuvuc`) REFERENCES `dm_khuvuc` (`makv`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
