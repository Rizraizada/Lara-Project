-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 02:20 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laraseip`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `participants` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intake_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `name`, `description`, `year`, `intake_id`, `created_at`, `updated_at`) VALUES
(2, 'ক্রয় সংক্রান্ত -২০২২', 'Active', '১২১.১২১.১২১.১৩', 2, '2022-02-19 04:22:25', '2022-02-19 04:29:02'),
(3, 'salary সংক্রান্ত ফাইল', 'Active', '১৩.১৩.১৩.৩৪৫৫', 2, '2022-02-20 01:43:30', '2022-02-20 01:43:30'),
(5, 'software প্রস্তুতকরন', 'Active', '12312312.123123', 3, '2022-03-14 02:19:05', '2022-03-14 02:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `course_offereds`
--

CREATE TABLE `course_offereds` (
  `id` int(10) UNSIGNED NOT NULL,
  `Courses_offered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intakes`
--

CREATE TABLE `intakes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intakes`
--

INSERT INTO `intakes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'SALES', '2022-02-19 03:30:25', '2022-02-19 03:30:32'),
(3, 'IT', '2022-02-19 04:22:35', '2022-02-19 04:22:35'),
(4, 'Admin', '2022-02-21 15:03:46', '2022-02-21 15:03:46'),
(5, 'Board of Director', '2022-03-11 03:18:24', '2022-03-11 03:18:24'),
(6, 'HR', '2022-03-11 03:18:36', '2022-03-11 03:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(10) UNSIGNED NOT NULL,
  `participant_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `intake_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `marks` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_08_07_175746_create_batches_table', 1),
(6, '2021_08_07_183724_create_intakes_table', 1),
(7, '2021_08_08_115924_create_subjects_table', 1),
(8, '2021_08_08_120719_create_modules_table', 1),
(9, '2021_08_17_165146_create_notices_table', 1),
(10, '2021_08_21_160809_create_progress_reports_table', 1),
(11, '2021_08_23_082342_create_progressbs_table', 1),
(12, '2021_08_23_083833_create_placed_jobs_table', 1),
(13, '2021_08_23_093920_create_course_offereds_table', 1),
(14, '2021_08_23_104724_create_trainers_involveds_table', 1),
(15, '2021_08_24_104417_create_number_trainers_table', 1),
(16, '2021_08_24_111303_create_accessories_table', 1),
(17, '2021_08_28_061825_create_module_wise_courses_table', 1),
(18, '2021_08_28_110840_create_marks_table', 1),
(19, '2021_08_28_111531_create_participants_table', 1),
(20, '2021_08_28_111913_create_participant_and_institutes_table', 1),
(21, '2021_08_08_120719_create_templates_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `month` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tranche` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forwarded` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `batch_id`, `month`, `tranche`, `created_at`, `updated_at`, `file_name`, `file_path`, `status`, `forwarded`, `created_by`) VALUES
(1, 'Monthly-salary-জানুয়ায়ি-2022', 3, '<p>january salry 20202</p>', NULL, '2022-03-12 11:12:09', '2022-03-12 11:13:25', '1647054729_doctor-character-background_1270-84.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647054729_doctor-character-background_1270-84.jpg', 'Approved', 'Y', 1),
(2, 'BUY LAPTOP', 2, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, '2022-03-12 11:24:40', '2022-03-12 12:10:45', '1647055480_61c4131d3073e-square.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647055480_61c4131d3073e-square.jpg', 'Approved', 'Y', 1),
(3, 'Monthly-salarymarch-2022', 2, '<p>march slary</p>', NULL, '2022-03-12 12:39:49', '2022-03-12 12:41:44', '1647059989_doctor-character-background_1270-84.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647059989_doctor-character-background_1270-84.jpg', 'Approved', 'Y', 2),
(5, 'BUY LAPTOP', 2, '<p>laptop -3</p>\r\n\r\n<p>proceed</p>', NULL, '2022-03-12 14:22:16', '2022-03-12 14:35:23', '1647066150_61c4131d3073e-square.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647066150_61c4131d3073e-square.jpg', 'Rejected', NULL, 2),
(6, 'Monthly-salary-february-2022', 3, '<p>salary process february</p>\r\n\r\n<p>take initiate</p>', NULL, '2022-03-12 14:31:26', '2022-03-12 14:32:38', NULL, NULL, 'Approved', 'Y', 1),
(7, 'Monthly-april-2022', 3, '<p>adasdasasd</p>', NULL, '2022-03-12 14:41:54', '2022-03-17 00:58:36', NULL, NULL, 'Rejected', 'Y', 2),
(9, 'software চালু করন প্রসঙ্গে', 5, '<p>প্রশাসনিক কাজের প্রয়োজনে একটি ERP সফটওয়্যার চালু করা প্রয়োজন।</p>\r\n\r\n<p>বিষয়টি বিবেচনা করা যেতে পারে</p>\r\nPlease Take necessary step', NULL, '2022-03-14 02:20:33', '2022-03-14 02:25:56', '1647199382_samle.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647199382_samle.jpg', 'Approved', 'Y', 1),
(10, 'ল্যাপটপ ক্রয়', 2, '<p>test data</p>', NULL, '2022-03-15 02:59:33', '2022-03-17 00:56:28', '1647287989_math_vocabulary_and_common_symbols.pdf', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647287989_math_vocabulary_and_common_symbols.pdf', 'Approved', 'Y', 1),
(12, 'software চালু করন প্রসঙ্গে', 5, '<p>প্রশাসনিক কাজের প্রয়োজনে একটি সফটওয়্যার প্রয়োজন। প্রশাসনিক কাজের প্রয়োজনে একটি সফটওয়্যার প্রয়োজন প্রশাসনিক কাজের প্রয়োজনে একটি সফটওয়্যার প্রয়োজনসকল ডকুমেন্ট প্রেরণ করা হলো।&nbsp;<br />\nবিষয়টি বিবেচনা করা যেতে পারে&nbsp;</p>', NULL, '2022-03-16 01:23:10', '2022-03-16 01:28:15', '1647368591_sample.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647368591_sample.jpg', 'Approved', 'Y', 3),
(13, 'Monthly-salary-জানুয়ায়ি-2022', 3, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>empname</td>\r\n			<td>salary</td>\r\n		</tr>\r\n		<tr>\r\n			<td>fahim</td>\r\n			<td>34000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>tanim</td>\r\n			<td>30000</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>বিষয়টি বিবেচনা করা যেতে&nbsp; পারে । সদয় অনুমোদনের জন্য প্রেরন করা হল ।</p>', NULL, '2022-03-16 07:13:04', '2022-03-17 00:15:18', '1647389584_sample.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647389584_sample.jpg', 'Rejected', NULL, 2),
(14, 'software চালু করন প্রসঙ্গে', 5, '<p>take strep to iplement erp software</p>', NULL, '2022-03-17 00:12:07', '2022-03-17 00:13:39', '1647450728_doctor-character-background_1270-84.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647450728_doctor-character-background_1270-84.jpg', 'Approved', 'Y', 1),
(15, 'Monthly-salarymarch-2022', 3, '<p>Salary proceed for the&nbsp; month march</p>', NULL, '2022-03-17 01:04:52', '2022-03-17 01:05:39', NULL, NULL, 'Approved', 'Y', 2),
(16, NULL, NULL, NULL, NULL, '2022-03-20 09:30:03', '2022-03-20 09:30:03', NULL, NULL, NULL, NULL, 2),
(27, 'software চালু করন প্রসঙ্গে -12', 5, '<p>softwareon process</p>', NULL, '2022-03-23 02:17:22', '2022-03-23 02:18:13', '1647976643_doctor-character-background_1270-84.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647976643_doctor-character-background_1270-84.jpg', NULL, 'Y', 1),
(30, 'software চালু করন প্রসঙ্গে 2023', 5, '<p>test data-1</p>', NULL, '2022-03-23 02:55:00', '2022-03-23 02:55:00', NULL, NULL, NULL, NULL, 2),
(32, 'Monthly-salary-জানুয়ায়ি-2022-202341', 2, '<p>test data</p>', NULL, '2022-03-23 02:58:18', '2022-03-23 02:58:18', NULL, NULL, NULL, NULL, 2),
(35, 'Monthly-salary-জানুয়ায়ি-2022', 2, '<p>test data</p>', NULL, '2022-03-23 03:05:19', '2022-03-23 03:05:19', NULL, NULL, NULL, NULL, 3),
(48, NULL, NULL, NULL, NULL, '2022-03-23 07:29:06', '2022-03-23 07:29:06', NULL, NULL, NULL, NULL, 1),
(49, NULL, NULL, NULL, NULL, '2022-03-23 07:29:17', '2022-03-23 07:29:17', NULL, NULL, NULL, NULL, 1),
(50, NULL, NULL, NULL, NULL, '2022-03-23 07:30:28', '2022-03-23 07:30:28', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_wise_courses`
--

CREATE TABLE `module_wise_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `subject_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_wise_courses`
--

INSERT INTO `module_wise_courses` (`id`, `module_id`, `subject_id`, `created_at`, `updated_at`, `flag`, `subject_name`, `remarks`) VALUES
(1, 1, 2, '2022-03-12 11:12:09', '2022-03-12 11:12:27', 1, NULL, 'initiate'),
(2, 1, 3, '2022-03-12 11:12:09', '2022-03-12 11:12:43', 1, NULL, 'take action already'),
(3, 1, 5, '2022-03-12 11:12:09', '2022-03-12 11:13:25', 1, NULL, 'appoved'),
(4, 1, 6, '2022-03-12 11:12:09', '2022-03-12 11:12:09', 0, NULL, NULL),
(5, 2, 3, '2022-03-12 11:24:40', '2022-03-12 11:25:48', 1, NULL, 'initiate buy.It is necessary for taking action'),
(6, 2, 5, '2022-03-12 11:24:40', '2022-03-12 12:09:26', 1, NULL, 'send for apporval. Please approve the file'),
(7, 2, 6, '2022-03-12 11:24:40', '2022-03-12 12:10:45', 1, NULL, 'Approved .take action'),
(8, 3, 3, '2022-03-12 12:39:49', '2022-03-12 12:40:07', 1, NULL, 'initiate'),
(9, 3, 5, '2022-03-12 12:39:49', '2022-03-12 12:41:44', 1, NULL, NULL),
(13, 5, 3, '2022-03-12 14:22:16', '2022-03-12 14:35:23', 1, NULL, NULL),
(14, 5, 5, '2022-03-12 14:22:16', '2022-03-12 14:22:16', 0, NULL, NULL),
(15, 5, 6, '2022-03-12 14:22:16', '2022-03-12 14:22:16', 0, NULL, NULL),
(16, 6, 2, '2022-03-12 14:31:27', '2022-03-12 14:31:46', 1, NULL, 'initiate'),
(17, 6, 5, '2022-03-12 14:31:27', '2022-03-12 14:32:38', 1, NULL, NULL),
(18, 6, 6, '2022-03-12 14:31:27', '2022-03-12 14:31:27', 0, NULL, NULL),
(19, 7, 3, '2022-03-12 14:41:54', '2022-03-12 14:42:46', 1, NULL, 'initialte imewrwqrqw'),
(20, 7, 5, '2022-03-12 14:41:54', '2022-03-17 00:58:36', 1, NULL, 'reject for wrong data'),
(21, 7, 6, '2022-03-12 14:41:55', '2022-03-12 14:41:55', 0, NULL, NULL),
(25, 9, 2, '2022-03-14 02:20:33', '2022-03-14 02:23:33', 1, NULL, 'initiate'),
(26, 9, 5, '2022-03-14 02:20:33', '2022-03-14 02:25:17', 1, NULL, 'send for apporval'),
(27, 9, 6, '2022-03-14 02:20:33', '2022-03-14 02:25:56', 1, NULL, 'Approved .take action'),
(28, 10, 2, '2022-03-15 02:59:34', '2022-03-15 03:00:36', 1, NULL, 'initiate data'),
(29, 10, 3, '2022-03-15 02:59:34', '2022-03-17 00:55:52', 1, NULL, 'oaky send for approval'),
(30, 10, 5, '2022-03-15 02:59:34', '2022-03-17 00:56:28', 1, NULL, 'Approved. please proceed .'),
(31, 12, 2, '2022-03-16 01:23:10', '2022-03-16 01:25:01', 1, NULL, 'Initiate file'),
(32, 12, 5, '2022-03-16 01:23:10', '2022-03-16 01:27:55', 1, NULL, 'Okay. send for approval'),
(33, 12, 6, '2022-03-16 01:23:10', '2022-03-16 01:28:15', 1, NULL, 'Approved. Take action'),
(34, 13, 3, '2022-03-16 07:13:04', '2022-03-17 00:15:18', 1, NULL, NULL),
(35, 13, 5, '2022-03-16 07:13:04', '2022-03-16 07:13:04', 0, NULL, NULL),
(36, 13, 6, '2022-03-16 07:13:04', '2022-03-16 07:13:04', 0, NULL, NULL),
(37, 14, 3, '2022-03-17 00:12:08', '2022-03-17 00:12:56', 1, NULL, 'Initiate and take necessary step'),
(38, 14, 5, '2022-03-17 00:12:08', '2022-03-17 00:13:39', 1, NULL, NULL),
(39, 15, 3, '2022-03-17 01:04:54', '2022-03-17 01:05:17', 1, NULL, 'initiate'),
(40, 15, 6, '2022-03-17 01:04:54', '2022-03-17 01:05:39', 1, NULL, 'Approved. please proceed .'),
(59, 27, 3, '2022-03-23 02:17:23', '2022-03-23 02:18:13', 1, NULL, 'Initiate software process'),
(60, 27, 5, '2022-03-23 02:17:23', '2022-03-23 02:17:23', 0, NULL, NULL),
(65, 30, 2, '2022-03-23 02:55:00', '2022-03-23 02:55:00', 0, NULL, NULL),
(66, 30, 3, '2022-03-23 02:55:00', '2022-03-23 02:55:00', 0, NULL, NULL),
(69, 32, 2, '2022-03-23 02:58:19', '2022-03-23 02:58:19', 0, NULL, NULL),
(70, 32, 3, '2022-03-23 02:58:19', '2022-03-23 02:58:19', 0, NULL, NULL),
(75, 35, 2, '2022-03-23 03:05:19', '2022-03-23 03:05:19', 0, NULL, NULL),
(101, 48, 3, '2022-03-23 07:29:06', '2022-03-23 07:29:06', 0, NULL, NULL),
(102, 49, 2, '2022-03-23 07:29:17', '2022-03-23 07:29:17', 0, NULL, NULL),
(103, 50, 5, '2022-03-23 07:30:29', '2022-03-23 07:30:29', 0, NULL, NULL),
(104, 50, 3, '2022-03-23 07:30:29', '2022-03-23 07:30:29', 0, NULL, NULL),
(105, 50, 18, '2022-03-23 07:30:29', '2022-03-23 07:30:29', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `number_trainers`
--

CREATE TABLE `number_trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `skills_areas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `participants` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_vill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_post_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_upazilla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_vill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_post_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_upazilla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `intake_id` int(11) DEFAULT NULL,
  `desig_id` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `is_flow` int(11) DEFAULT NULL,
  `signature_file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `name`, `email`, `father_name`, `mother_name`, `present_vill`, `present_post`, `present_post_number`, `present_upazilla`, `present_district`, `permanent_vill`, `permanent_post`, `permanent_post_number`, `permanent_upazilla`, `permanent_district`, `phone_no`, `gender`, `country`, `created_at`, `updated_at`, `intake_id`, `desig_id`, `password`, `role`, `is_flow`, `signature_file_name`, `signature_file_path`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012123123123', NULL, NULL, '2022-03-12 02:58:15', '2022-03-12 02:58:15', 4, 4, '$2y$10$ZWXT/iPEwgqVILhkmKZul.g.jq3AjKs1/7e.mZKJ1IX9YQGJNTyX6', 3, NULL, NULL, NULL),
(2, 'Mr X', 'x@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01231212413', NULL, NULL, '2022-03-12 10:59:47', '2022-03-16 04:49:25', 2, 1, '$2y$10$gbAH3kV0ZGXpEfP9uFzSfeDcau2AA5aubSDtq418XLiqW8FuqPvSC', 1, 1, '1647380965_Sign_Nayem.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647380965_Sign_Nayem.jpg'),
(3, 'Mr.Tanim Ahmed', 'tanim@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01794593007', NULL, NULL, '2022-03-12 11:00:08', '2022-03-16 04:12:14', 2, 2, '$2y$10$ecw5NyBFpwLiCBJ3NslIBetwSJgPaNtDZmd72EHl2qjrbHcqSTe1W', 1, 1, '1647378734_Sign_Fahim.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647378734_Sign_Fahim.jpg'),
(5, 'Managing Director', 'md@cityinsurance.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01221412412', NULL, NULL, '2022-03-12 11:02:35', '2022-03-16 06:12:10', 5, 7, '$2y$10$sSadiCvLZD1TZS1lDz/G8OqAUAbC.pLiZHRNdk6fXl0d1R3V4foWS', 4, 1, '1647385930_Sign_Fahim.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647385930_Sign_Fahim.jpg'),
(6, 'Chairman', 'chairman@cityinsurance.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01241241241', NULL, NULL, '2022-03-12 11:04:28', '2022-03-16 06:16:41', 5, 6, '$2y$10$pmfWf8pB07BWzNyJFmEYzOFzcrctGmcbFAhossYo8cONl7nXtIOl2', 4, 1, '1647386201_Sign_Fahim.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647386201_Sign_Fahim.jpg'),
(12, 'Md. Mahbubur Rahman', 'fahim@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01794593007', NULL, NULL, '2022-03-16 04:38:32', '2022-03-16 04:44:32', 2, 1, '$2y$10$Nwuz9VPjVPWAdESBum6B5e0cvV0E8L2BHYcC9wjSLs7es799mmsU.', 1, 1, '1647380672_Sign_Fahim.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647380672_Sign_Fahim.jpg'),
(18, 'Mr Y', 'y@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01794593007', NULL, NULL, '2022-03-16 04:43:04', '2022-03-16 04:43:04', 3, 1, '$2y$10$PGO54Yty6ERPTvO36OxQUecfS65dlpKzkpnmvOBWvTQjc1tf89mGS', 1, 1, '1647380584_Sign_Nayem.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647380584_Sign_Nayem.jpg'),
(19, 'test1', 'tes1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0123213', NULL, NULL, '2022-03-17 04:21:43', '2022-03-17 04:21:43', 3, 2, '$2y$10$BQcu4Ig6W8U6yTC1jy15eemGsGktsANgvvKUBbbQdbzGHsovFwcky', 1, 1, NULL, NULL),
(20, 'test2', 'test2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01313123', NULL, NULL, '2022-03-17 04:23:42', '2022-03-17 04:23:42', 3, 2, '$2y$10$QFF6g.U.fZx70f5oM1Gxi.eZ5qUbmUCQLucffFzb60PiEttdCDdjC', 1, 1, NULL, NULL),
(26, 'karim', 'karim@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01312123', NULL, NULL, '2022-03-17 04:31:12', '2022-03-17 04:31:12', 2, 2, '$2y$10$GIehHSa4d591I3XtUxfH.OQRxzyz6JQOCiRF91x3ZCJm3aLUEzDmu', 1, 1, NULL, NULL),
(27, 'rumman', 'rumman@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0131312123213', NULL, NULL, '2022-03-17 04:32:04', '2022-03-17 04:32:04', 2, 3, '$2y$10$FN/N.T70RSSyOcg/Q0Ia7uLuv2Ki3zY9Dn61zsazJxiLReiCUrI0i', 1, 1, '1647466324_Sign_Nayem.jpg', 'D:\\xampp\\htdocs\\AFS\\public\\images\\1647466324_Sign_Nayem.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `participant_and_institutes`
--

CREATE TABLE `participant_and_institutes` (
  `id` int(10) UNSIGNED NOT NULL,
  `participant_id` int(11) NOT NULL,
  `participant_type` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `placed_jobs`
--

CREATE TABLE `placed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `Courses_offered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Level_skills` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_placement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_placement_2nd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cummulative_achived` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progressbs`
--

CREATE TABLE `progressbs` (
  `id` int(10) UNSIGNED NOT NULL,
  `Courses_offered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Level_skills` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Training_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Training_target_2nd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cummulative_achived` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress_reports`
--

CREATE TABLE `progress_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `Courses_offered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Level_skills` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Training_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Training_target_2nd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cummulative_achived` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `description`, `code`, `addedBy`, `created_at`, `updated_at`) VALUES
(1, 'Sales Manager', NULL, NULL, NULL, '2022-02-19 17:35:32', '2022-02-19 17:35:32'),
(2, 'Sr. Offcier', NULL, NULL, NULL, '2022-02-19 17:35:43', '2022-02-19 17:35:43'),
(3, 'Programmer', NULL, NULL, NULL, '2022-03-11 03:12:51', '2022-03-11 03:12:51'),
(4, 'System Analyst', NULL, NULL, NULL, '2022-03-11 03:13:01', '2022-03-11 03:13:01'),
(5, 'HOD OF IT', NULL, NULL, NULL, '2022-03-11 03:13:11', '2022-03-11 03:13:11'),
(6, 'Chairman', NULL, NULL, NULL, '2022-03-11 03:13:21', '2022-03-11 03:13:21'),
(7, 'Managing Director', NULL, NULL, NULL, '2022-03-11 03:13:25', '2022-03-11 03:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `template_name`, `template_details`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Application letter for apply', '<p>Date : 18.03.2022</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To,</p>\r\n\r\n<p>The Registrar</p>\r\n\r\n<p>Sonargaon University, Bangladesh</p>\r\n\r\n<p>147/I, Green Road, Tejgaon, Dhaka-1215&nbsp;</p>\r\n\r\n<p><strong>Subject </strong><strong>: Application for the Post of </strong>&ldquo;<strong>Sr.</strong>&nbsp;<strong>Lecturer(CSE)&rdquo;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dear Sir/madam,</p>\r\n\r\n<p>In response to your advertisement in the &ldquo;bdjobs.com&rdquo; online job posting,&nbsp;&nbsp;&nbsp;&nbsp; <strong>&ldquo;Sr. Lecturer&rdquo;</strong>&nbsp;&nbsp; is going to be appointed under your renowned University. I beg most respectfully offer myself as a candidate for the post. My CV and others necessary documents&nbsp; is attached for your kind consideration.</p>\r\n\r\n<p>I hope that you would be kind enough to appoint me for the same.</p>\r\n\r\n<p>Thanking You,</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sincerely Yours,</p>\r\n\r\n<p><strong>Mohammad Mahbubur Rahman</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '2022-03-19 09:47:30', '2022-03-20 01:27:17', 2),
(3, 'test temp', '<p>test hbjbnkn<br />\r\n<br />\r\njgcjvhbkj</p>', '2022-03-20 01:27:05', '2022-03-20 01:27:05', 2),
(4, 'test test', '<p>test data</p>', '2022-03-23 02:54:39', '2022-03-23 02:54:39', 2);

-- --------------------------------------------------------

--
-- Table structure for table `trainers_involveds`
--

CREATE TABLE `trainers_involveds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Courses_offered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `is_flow` int(11) DEFAULT NULL,
  `desig_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `is_flow`, `desig_id`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$IR8tCjOrwC2i/LwpusPttOLURH8JldbYkf0uNl6Ff91QN1znmlKEy', NULL, '2022-03-12 02:56:48', '2022-03-12 02:56:48', 3, NULL, NULL),
(2, 'Mr X', 'x@gmail.com', NULL, '$2y$10$0XdsxwCkl13lt9lCYBoSxenBmHLHvnwRsJ78NhOMAIHrNabH7GHDe', NULL, '2022-03-12 10:59:48', '2022-03-12 10:59:48', 1, NULL, 1),
(3, 'Mr.Tanim Ahmed', 'tanim@gmail.com', NULL, '$2y$10$cSjUVViwdW7yiAUkWJgfju8VnZq9kpKke0MxL0H3UxrQFgnb2hXL.', NULL, '2022-03-12 11:00:08', '2022-03-16 04:12:14', 1, NULL, 2),
(5, 'Managing Director', 'md@cityinsurance.com', NULL, '$2y$10$p4DEAQz4tBWEFew3gJkUtubRDHIkK3fPz8w26H5j.jpbJKdNk7bo6', NULL, '2022-03-12 11:02:36', '2022-03-12 11:02:36', 4, NULL, 7),
(6, 'Chairman', 'chairman@cityinsurance.com', NULL, '$2y$10$Wb9lLiVS2vnWYk7sJLuBfe5qzYvK7a4m2PdFDmTLA6Kvgp3KZFM/6', NULL, '2022-03-12 11:04:28', '2022-03-12 11:04:28', 4, NULL, 6),
(12, 'Md. Mahbubur Rahman', 'fahim@gmail.com', NULL, '$2y$10$eiLcPii2YdffUYELL2QR0ev7kefRp6tymAp6vgZ.EuQgbGCTo6RXO', NULL, '2022-03-16 04:38:32', '2022-03-16 04:44:32', 1, NULL, 1),
(18, 'Mr Y', 'y@gmail.com', NULL, '$2y$10$yCUCWo0ji56il8KL0NTITO68pH/jRo9Jc6xzyFkrQ8vnYfj58hLiS', NULL, '2022-03-16 04:43:04', '2022-03-16 04:43:04', 1, NULL, 1),
(20, 'test2', 'test2@gmail.com', NULL, '$2y$10$5y1dh6Pvf6amFDlcwTwpWOQrFkm6Q782r.xTBAibiBpHhBBS27WBK', NULL, '2022-03-17 04:23:43', '2022-03-17 04:23:43', 1, NULL, 2),
(26, 'karim', 'karim@gmail.com', NULL, '$2y$10$Ms.Go0I.m7UEmy.iLBR.e.SDqwfz33aXF13essjy8hUHbbpuJQHVq', NULL, '2022-03-17 04:31:12', '2022-03-17 04:31:12', 1, NULL, 2),
(27, 'rumman', 'rumman@gmail.com', NULL, '$2y$10$NTJ4oAUbb6qa8hrWFmlLU.0wSlYjWZm.3ojRoqXTDEpJTLo7i0ANG', NULL, '2022-03-17 04:32:04', '2022-03-17 04:32:04', 1, NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_offereds`
--
ALTER TABLE `course_offereds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `intakes`
--
ALTER TABLE `intakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_wise_courses`
--
ALTER TABLE `module_wise_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `number_trainers`
--
ALTER TABLE `number_trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant_and_institutes`
--
ALTER TABLE `participant_and_institutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `placed_jobs`
--
ALTER TABLE `placed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progressbs`
--
ALTER TABLE `progressbs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress_reports`
--
ALTER TABLE `progress_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers_involveds`
--
ALTER TABLE `trainers_involveds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_offereds`
--
ALTER TABLE `course_offereds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intakes`
--
ALTER TABLE `intakes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `module_wise_courses`
--
ALTER TABLE `module_wise_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `number_trainers`
--
ALTER TABLE `number_trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `participant_and_institutes`
--
ALTER TABLE `participant_and_institutes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `placed_jobs`
--
ALTER TABLE `placed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progressbs`
--
ALTER TABLE `progressbs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_reports`
--
ALTER TABLE `progress_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainers_involveds`
--
ALTER TABLE `trainers_involveds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
