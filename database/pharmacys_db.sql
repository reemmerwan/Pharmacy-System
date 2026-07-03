-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: 03 يوليو 2026 الساعة 17:35
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacys_db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'مضادات حيوية (Antibiotics)'),
(2, 'مسكنات الألم (Analgesics)'),
(3, 'فيتامينات ومكملات (Vitamins)'),
(4, 'أدوية الجهاز التنفسي\" (Respiratory Drugs)'),
(5, 'أدوية البرد والزكام '),
(6, 'أدوية الجهاز الهضمي'),
(7, 'أدوية الحساسية'),
(8, 'أدوية الغدد الصماء'),
(9, 'أدوية القلب ومدرات البول');

-- --------------------------------------------------------

--
-- بنية الجدول `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `name`, `price`, `stock_quantity`, `description`, `image`, `category_id`) VALUES
(18, 'Salbutamol', 10.00, 50, 'السالبوتامول (Salbutamol)، والمعروف أيضاً باسم ألبوتيرول (Albuterol)، هو دواء موسع للشعب الهوائية سريع المفعول ينتمي إلى فئة محفزات مستقبلات بيتا-2 الأدرينالية قصيرة المفعول (SABA). يُستخدم بشكل أساسي لتخفيف النوبات الحادة من ضيق التنفس والأزيز الناتج عن تشنج القصبات الهوائية.', 'image_medicines/1782886022_salbutamil.webp', 4),
(19, 'Ibuprofen', 10.00, 200, 'إيبوبروفين (Ibuprofen)، وهو مسكن للألم ومضاد للالتهابات ومخفض للحرارة.ينتمي الدواء إلى عائلة \"مضادات الالتهاب غير الستيرويدية\" (NSAIDs) ويُستخدم بشكل شائع لتخفيف الآلام الخفيفة والمتوسطة وتخفيف الآلام: مثل صداع الرأس، ألم الأسنان، وآلام الظهر والعضلات والمفاصل.خافض للحرارة: يُستعمل لعلاج الحمى الناتجة عن نزلات البرد أو الإنفلونزا.تسكين آلام الدورة الشهرية: يخفف من التشنجات المصاحبة للطمث لدى النساء.', 'image_medicines/1783092479_بروفين.jpg', 2),
(20, 'Amoxicillin', 20.00, 160, 'الأموكسيسيلين (Amoxicillin) هو مضاد حيوي واسع الطيف ينتمي إلى عائلة البنسلين، ويستخدم لعلاج مجموعة متنوعة من الالتهابات البكتيرية. يعمل هذا الدواء عن طريق تثبيط نمو البكتيريا وقتلها، ولكنه لا يعالج العدوى الفيروسية مثل الإنفلونز', '1781589075_Amoxicillin.png', 1),
(21, 'Pseudoephedrine', 25.00, 200, 'السودوإيفيدرين (Pseudoephedrine) هو دواء مضاد للاحتقان (Decongestant) يعمل عن طريق تضييق الأوعية الدموية المتوسعة في الممرات الأنفية. هذا التضييق يساعد على تقليل التورم والالتهاب داخل الأنف والجيوب الأنفية، مما يسهل عملية التنفس بشكل مباشر وفوري', '1781589466_Pseudoephedrine.png', 5),
(22, 'Omeprazole', 25.00, 150, 'دواء أوميبرازول (Omeprazole) هو مثبط لمضخة البروتون (PPI) يعمل على تقليل إفراز حمض المعدة. يُستخدم بشكل واسع لعلاج حرقة المعدة، وارتجاع المريء، وقرحة الجهاز الهضمي.', '1781590282_Omeprazole.webp', 6),
(23, 'Cetirizine', 32.00, 100, 'السيتريزين (Cetirizine) هو دواء مضاد للهستامين من الجيل الثاني، يُستخدم بفعالية لعلاج أعراض الحساسية مثل العطس، وسيلان الأنف، وحكة العينين، والطفح الجلدي التحسسي. يتميز بتأثيره طويل المدى وقدرته المنخفضة على اختراق الجهاز العصبي، مما يجعله أقل تسببًا في النعاس مقارنة بأدوية الجيل الأول', '1781592430_Zetrizin-box.png', 7),
(24, 'Levothyroxine', 32.00, 140, 'دواء ليفوثيروكسين (Levothyroxine) هو هرمون درقي اصطناعي يُستخدم كبديل تعويضي لهرمون الثيروكسين الطبيعي (T4) الذي تنتجه الغدة الدرقية يستخدم لعلاج قصور الغدة الذي يسبب التعب، زيادة الوزن، وجفاف الجلد وللمساعدة في تقليل حجم الغدة المتضخمة (الدُّراق).', '1781592842_الليفوثيروكسين.jpg', 8),
(25, 'Furosemide', 34.00, 170, 'الفوروسيميد (Furosemide) هو دواء مدر للبول عروي قوي (Loop Diuretic)، يُعرف تجارياً بشكل واسع باسم لازيكس (Lasix). يعمل الدواء على الكلى لتحفيز التخلص من الماء والأملاح الزائدة (مثل الصوديوم والبوتاسيوم) عبر البول.', '1781593101_فوروسيميد.jpg', 9);

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `delivery_address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `status`, `delivery_address`, `phone`, `created_at`) VALUES
(1, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(2, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(3, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(4, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(5, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(6, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(7, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(8, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(9, 3, 'confirmed', 'غزة  الزيتون', '0596755600', '2026-06-19 06:55:23'),
(10, 3, 'confirmed', 'غزة  الزيتون', '0596755600', '2026-06-19 06:55:23'),
(11, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(12, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(13, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(14, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(15, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(16, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(17, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 06:55:23'),
(18, 1, 'pending', NULL, NULL, '2026-06-19 06:55:23'),
(19, 2, 'confirmed', 'غزة  ارمال', '0594569800', '2026-06-19 07:35:09'),
(20, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-19 07:44:45'),
(21, 2, 'confirmed', 'غزة  الزيتون', '0594569800', '2026-06-19 07:49:14'),
(22, 2, 'delivered', NULL, NULL, '2026-06-19 07:50:13'),
(23, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-20 05:52:31'),
(24, 2, 'confirmed', 'غزة  الزيتون', '0594569800', '2026-06-20 06:03:03'),
(25, 2, 'confirmed', 'غزة  ارمال', '0594569800', '2026-06-20 06:03:31'),
(26, 2, 'confirmed', 'غزة  ارمال', '0594569800', '2026-06-20 06:59:26'),
(27, 2, 'confirmed', 'غزة  الزيتون', '0598576778', '2026-06-20 07:17:08'),
(28, 5, 'confirmed', 'غزة الدرج', '059789543', '2026-06-20 07:26:56'),
(29, 5, 'confirmed', 'غزة الدرج', '0596755600', '2026-06-20 07:30:37'),
(30, 5, 'confirmed', 'غزة الدرج', '0596755600', '2026-06-21 06:47:01'),
(31, 5, 'confirmed', 'غزة  ارمال', '0596755600', '2026-06-21 07:35:09'),
(32, 5, 'confirmed', 'غزة الدرج', '0598576778', '2026-06-21 07:41:29'),
(33, 5, 'confirmed', 'غزة تل الهوا', '059678546', '2026-06-21 08:09:15'),
(34, 2, 'confirmed', 'غزة الدرج', '0598576778', '2026-06-21 08:19:16'),
(35, 2, 'confirmed', 'غزة تل الهوا', '0594569800', '2026-06-21 08:20:28'),
(36, 2, 'confirmed', 'غزة  الزيتون', '0596755600', '2026-06-21 08:23:04'),
(37, 5, 'confirmed', 'غزة تل الهوا', '0596755600', '2026-06-22 05:30:30'),
(38, 4, 'confirmed', 'غزة الدرج', '0598576778', '2026-06-29 15:10:15'),
(39, 4, 'confirmed', 'غزة الدرج', '0596755600', '2026-07-01 06:08:34'),
(40, 3, 'confirmed', 'غزة الدرج', '0594569800', '2026-07-03 13:01:15'),
(41, 3, 'confirmed', 'غزة الدرج', '0598576778', '2026-07-03 13:01:40'),
(42, 9, 'confirmed', 'غزة الدرج', '0598576778', '2026-07-03 15:25:07');

-- --------------------------------------------------------

--
-- بنية الجدول `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_order` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `medicine_id`, `quantity`, `price_at_order`) VALUES
(8, 1, 18, 1, NULL),
(9, 19, 18, 1, NULL),
(10, 20, 24, 1, NULL),
(11, 20, 25, 1, NULL),
(12, 21, 24, 1, NULL),
(13, 22, 20, 1, NULL),
(15, 23, 18, 1, NULL),
(16, 23, 21, 1, NULL),
(17, 23, 19, 1, NULL),
(18, 24, 21, 1, NULL),
(19, 25, 19, 2, NULL),
(21, 25, 18, 1, NULL),
(22, 26, 22, 1, NULL),
(25, 26, 18, 1, NULL),
(26, 27, 18, 1, NULL),
(27, 28, 18, 1, NULL),
(28, 29, 19, 1, NULL),
(30, 30, 25, 1, NULL),
(32, 31, 20, 1, NULL),
(33, 32, 18, 1, NULL),
(34, 33, 19, 1, NULL),
(35, 34, 23, 1, NULL),
(36, 35, 21, 1, NULL),
(37, 36, 19, 1, NULL),
(39, 37, 18, 1, NULL),
(41, 18, 19, 2, NULL),
(42, 38, 18, 1, NULL),
(43, 39, 18, 1, NULL),
(44, 18, 18, 1, NULL),
(45, 9, 18, 1, NULL),
(46, 40, 19, 1, NULL),
(47, 41, 18, 1, NULL),
(48, 42, 19, 1, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'reem1@gmail.com', '$2y$10$71HQtEsHziYy7Q20f15QlunhR4mIMGB9LNny5EvXVvLc3p3VZ9shi', 'admin'),
(2, 'mona@gmail.com', '$2y$10$9xlvYJfVVg7yva9hD1U26e4ZRjMwAnrWFUTKY1Vdnn2vBk820fdy6', 'customer'),
(3, 'neveen', '$2y$10$x2TMsiXaKY8ogjXp1bRnhO2T5pB9jY9ujnP7xFf/qT2YD/eja.kIq', 'customer'),
(4, 'amal', '$2y$10$ZEyAnr94/3D/z/Q1jdzOE.BcHdGt1.h8.aYVOwOLGhe8EJcSqsdF.', 'customer'),
(5, 'nevo', '$2y$10$TeT0PPzudNGdxpeY.cU0iOArofGlQTM6I1fOFX04BZV.OyOJGcQoe', 'customer'),
(8, 'asseel', '$2y$10$7oi9XwzGPEv9ZyCP8NFOJenzAKP3jHs6k63f0DdSZy3RWUKn9hQTy', 'customer'),
(9, 'lama', '$2y$10$LMk7cYB7xbbN73pbpsYs.ugEY/YMTE8adBTP0W1vyNI/yOjQ6jH66', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `fk_medicine_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- قيود الجداول `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`medicine_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
