-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 05:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `u_id`, `date`, `time`) VALUES
(1, 11, '2024-03-01', '09:08:23'),
(2, 10, '2024-03-01', '10:09:23'),
(3, 10, '2024-03-02', '09:04:09'),
(4, 9, '2024-03-02', '09:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `date_names`
--

CREATE TABLE `date_names` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `date_names`
--

INSERT INTO `date_names` (`id`, `name`) VALUES
(1, 'วันสงกรานต์'),
(2, 'วันคริสต์มาส'),
(3, 'วันครู'),
(4, 'วันลอยกระทง'),
(5, 'วันพ่อแห่งชาติ'),
(6, 'วันแม่แห่งชาติ'),
(7, 'วันแรงงาน');

-- --------------------------------------------------------

--
-- Table structure for table `event_dates`
--

CREATE TABLE `event_dates` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `detail` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateN.id` int(11) NOT NULL,
  `checkRest` tinyint(1) NOT NULL COMMENT 'หยุด=1 ไม่หยุด=0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_dates`
--

INSERT INTO `event_dates` (`id`, `date`, `detail`, `dateN.id`, `checkRest`) VALUES
(1, '2024-12-25', 'จัดขึ้นเป็นประจำทุกปีเพื่อเป็นการเฉลิมฉลองการประสูติของพระเยซู ', 2, 0),
(2, '2024-10-05', 'เป็นวันเฉลิมพระชนมพรรษาในพระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leavebalances`
--

CREATE TABLE `leavebalances` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `typeL_id` int(11) NOT NULL,
  `usedLeave` int(11) NOT NULL DEFAULT 0,
  `remainingLeave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leavebalances`
--

INSERT INTO `leavebalances` (`id`, `u_id`, `typeL_id`, `usedLeave`, `remainingLeave`) VALUES
(1, 9, 4, 0, 23),
(2, 9, 5, 1, 22),
(6, 9, 3, 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `leaveofabsences`
--

CREATE TABLE `leaveofabsences` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `typeL_id` int(11) NOT NULL,
  `firstDate` date NOT NULL,
  `endDate` date NOT NULL,
  `detail` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('อนุมัติ','ไม่อนุมัติ','กำลังดำเนินงาน','ยกเลิก') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'กำลังดำเนินงาน',
  `u_approver` int(11) NOT NULL,
  `acknowledge` enum('ยังไม่รับทราบ','รับทราบ','','') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'ยังไม่รับทราบ'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leaveofabsences`
--

INSERT INTO `leaveofabsences` (`id`, `u_id`, `typeL_id`, `firstDate`, `endDate`, `detail`, `date`, `file`, `status`, `u_approver`, `acknowledge`) VALUES
(17, 9, 3, '2024-03-04', '2024-03-08', 'สวัสดีครับ', '2024-03-14 18:05:25', NULL, 'กำลังดำเนินงาน', 14, 'ยังไม่รับทราบ'),
(18, 9, 5, '2024-03-16', '2024-03-23', NULL, '2024-03-14 18:06:24', NULL, 'กำลังดำเนินงาน', 14, 'ยังไม่รับทราบ'),
(19, 12, 3, '2024-03-01', '2024-03-02', NULL, '2024-03-15 03:00:34', NULL, 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(20, 12, 5, '2024-03-02', '2024-03-23', 'adsdawdad', '2024-03-15 03:00:50', NULL, 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(21, 12, 5, '2024-03-01', '2024-03-09', 'สวัสดีครับผมต้องไปต่างจังหวัดหลายวันโปรดเห็นใจในการลาของผมด้วยครับจำเป็นจริงๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆๆ', '2024-03-15 04:06:36', 'uploads/leave/1710475596.jpg', 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(22, 9, 5, '2024-03-01', '2024-03-16', 'sssssssssssssssssssssssssss', '2024-03-15 14:05:20', 'uploads/leave/1710511520.jpg', 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(23, 9, 4, '2024-03-02', '2024-03-03', NULL, '2024-03-15 14:13:58', 'uploads/leave/1710512038.pdf', 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(24, 12, 3, '2024-03-01', '2024-03-02', 'wdwdad', '2024-03-16 07:40:16', 'uploads/leave/1710574816.pdf', 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(25, 12, 3, '2024-03-01', '2024-03-01', 'dwadsadaawd', '2024-03-16 08:18:07', 'uploads/leave/1710577087.jpg', 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(26, 10, 5, '2024-03-01', '2024-03-02', 'ฟหกฟกฟหกฟกฟกฟ', '2024-03-16 08:46:52', 'uploads/leave/1710577087.jpg\r\n', 'อนุมัติ', 12, 'รับทราบ'),
(27, 17, 3, '2024-03-01', '2024-03-16', 'iojodjoajwdajoiajdiojiawjdaijaiodjoiawjodjoawda', '2024-03-19 13:35:49', 'uploads/leave/1710855349.jpg', 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ'),
(28, 12, 3, '2024-03-01', '2024-03-02', 'dawiudahashdohaowhdoiahoiawhdoahawihdoiawihdoawiidaawoidowaa', '2024-03-19 15:50:22', 'uploads/leave/1710863422.jpg', 'กำลังดำเนินงาน', 13, 'ยังไม่รับทราบ');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(7, 'ผู้อำนวยการ'),
(8, 'รองผู้อำนวยการ'),
(9, 'ครู'),
(10, 'หัวหน้าหมวด'),
(11, 'ผู้ดูแลระบบ');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 9, 9),
(2, 11, 12),
(3, 7, 13),
(4, 8, 12),
(5, 10, 14),
(6, 11, 10),
(7, 9, 10),
(11, 10, 17),
(12, 11, 17);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`) VALUES
(1, 'หมวดวิชาคณิตศาสตร์'),
(2, 'หมวดวิชาวิทยาศาสตร์'),
(3, 'หมวดวิชาสังคม'),
(4, 'หมวดวิชาภาษาอังกฤษ'),
(5, 'หมวดวิชาฟิสิกส์'),
(6, 'ผู้บริหาร');

-- --------------------------------------------------------

--
-- Table structure for table `typeleaves`
--

CREATE TABLE `typeleaves` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `cutDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `typeleaves`
--

INSERT INTO `typeleaves` (`id`, `name`, `number`, `cutDate`) VALUES
(3, 'ลาป่วย', 23, '2024-12-31'),
(4, 'ลากิจ', 23, '2024-12-31'),
(5, 'ลาพักร้อน', 23, '2024-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `s_id`) VALUES
(9, 'จิรภา', 'บุญพาสุข', 'a@gmail.com', '$2y$10$34G1GKeukKzJQ/AJ0XNCbuNItDqJgjCWMTXnrEuZzXLuMXeU2iDnK', 1),
(10, 'ชุติมาพร', 'หมอนใหญ', 'b@gmail.com', '$2y$10$nQ6MhoXg/FXtUwbYSQRUV.CwqRzl6ax6THQVH2QMbB/vgXmkxXFvG', 5),
(11, 'ฐาปนะ', 'ทรงธรักษ์', 'c@gmail.com', '$2y$10$hP3XMUWtxFV722gIDb/bkuGS4Yn0BsDZJbJ/d/4HTbOmS6TvZTsHC', 2),
(12, 'ดวงพร', 'แก้วทอง', 'd@gmail.com', '$2y$10$v20rX2/Q1kvwrZHsGrtZhOGnMbiezdigIU08qKMaOO37efLFGL.lO', 4),
(13, 'ยรรยง', 'ตั้งจิตต์กุล', 'f@gmail.com', '$2y$10$C9HCZ0QS257ilRb2SP/EIu47d8SF0drN6X8DGCLj0USTSXDpyFu1e', 6),
(14, 'ปริญญา', 'แซ่อั้ง', 'g@gmail.com', '$2y$10$RiRxpZmtI6lQyzzfB9cjZe/r3gTi.sWopObP3ROTWyZmR964Vo.aa', 1),
(17, 'thanakrit', 'sakiarbuangam', 'h@gmail.com', '$2y$12$jfacq0k0fuMMMZ83KXR4Gu8J1pxU4rJe2cRM9/E/sSuW1GaYBLLry', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u.id` (`u_id`);

--
-- Indexes for table `date_names`
--
ALTER TABLE `date_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_dates`
--
ALTER TABLE `event_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dateN.id` (`dateN.id`);

--
-- Indexes for table `leavebalances`
--
ALTER TABLE `leavebalances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u.id` (`u_id`),
  ADD KEY `typeL.id` (`typeL_id`);

--
-- Indexes for table `leaveofabsences`
--
ALTER TABLE `leaveofabsences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeL.id` (`typeL_id`),
  ADD KEY `u.id` (`u_id`),
  ADD KEY `u.approver` (`u_approver`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role.id` (`role_id`),
  ADD KEY `u.id` (`user_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typeleaves`
--
ALTER TABLE `typeleaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s.id` (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `date_names`
--
ALTER TABLE `date_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_dates`
--
ALTER TABLE `event_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leavebalances`
--
ALTER TABLE `leavebalances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leaveofabsences`
--
ALTER TABLE `leaveofabsences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `typeleaves`
--
ALTER TABLE `typeleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_dates`
--
ALTER TABLE `event_dates`
  ADD CONSTRAINT `event_dates_ibfk_3` FOREIGN KEY (`dateN.id`) REFERENCES `date_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leavebalances`
--
ALTER TABLE `leavebalances`
  ADD CONSTRAINT `leavebalances_ibfk_1` FOREIGN KEY (`typeL_id`) REFERENCES `typeleaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leavebalances_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaveofabsences`
--
ALTER TABLE `leaveofabsences`
  ADD CONSTRAINT `leaveofabsences_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leaveofabsences_ibfk_3` FOREIGN KEY (`typeL_id`) REFERENCES `typeleaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leaveofabsences_ibfk_4` FOREIGN KEY (`u_approver`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
