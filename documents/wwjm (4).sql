-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2026 at 08:28 AM
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
-- Database: `wwjm`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail_report`
--

CREATE TABLE `audit_trail_report` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_details`
--

CREATE TABLE `bank_account_details` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(45) DEFAULT NULL,
  `branch` varchar(45) DEFAULT NULL,
  `ac_no` varchar(45) DEFAULT NULL,
  `ac_name` varchar(45) DEFAULT NULL,
  `swif_code` varchar(45) DEFAULT NULL,
  `current_ac` tinyint(1) DEFAULT NULL,
  `savings_ac` tinyint(1) DEFAULT NULL,
  `dis` varchar(450) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank_account_details`
--

INSERT INTO `bank_account_details` (`id`, `bank_name`, `branch`, `ac_no`, `ac_name`, `swif_code`, `current_ac`, `savings_ac`, `dis`, `main_user_login_id`, `sdt`, `ast`) VALUES
(1, 'Samson Gould', 'Sed quod velit corru', '56', 'Maris Ryan', 'Suscipit eu voluptas', 0, 1, 'Et est numquam corpo', 1, '2026-08-28 02:38:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_deposit_data_history`
--

CREATE TABLE `bank_deposit_data_history` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `bank_account_details_id` int(11) NOT NULL,
  `wwjm_payment_slip_id` int(11) NOT NULL,
  `wwjm_bank_deposit_slip_id` int(11) NOT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `credit_amout` double DEFAULT NULL,
  `debet_amount` double DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `pay_resion_subcption` tinyint(1) DEFAULT NULL,
  `pay_resion_donation` tinyint(1) DEFAULT NULL,
  `pay_resion_zakath` tinyint(1) DEFAULT NULL,
  `pay_resion_projects` tinyint(1) DEFAULT NULL,
  `pay_resion_others` tinyint(1) DEFAULT NULL,
  `pay_resion_other_by_text` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank_deposit_data_history`
--

INSERT INTO `bank_deposit_data_history` (`id`, `ast`, `sdt`, `bank_account_details_id`, `wwjm_payment_slip_id`, `wwjm_bank_deposit_slip_id`, `dis`, `credit_amout`, `debet_amount`, `main_user_login_id`, `pay_resion_subcption`, `pay_resion_donation`, `pay_resion_zakath`, `pay_resion_projects`, `pay_resion_others`, `pay_resion_other_by_text`) VALUES
(1, 1, '2026-08-28 03:08:00', 1, 2, 1, 'Ref: 313511 - jhjgfxdfzdzdzfxxgchjvhbjnk', 500, 0, 5, 1, 0, 0, 0, 0, 'Ref: 313511 - jhjgfxdfzdzdzfxxgchjvhbjnk'),
(2, 1, '2026-08-28 03:11:56', 1, 3, 2, 'hghfgxgfchgjh', 1236, 0, 1, 0, 1, 0, 0, 0, 'hghfgxgfchgjh'),
(3, 1, '2026-08-28 03:24:45', 1, 4, 3, 'Ref: ergtrtrt - rt3rtt3', 100, 0, 5, 1, 0, 0, 0, 0, 'Ref: ergtrtrt - rt3rtt3'),
(4, 1, '2026-08-28 04:55:18', 1, 5, 4, 'Ref: 223223322 - sddwwwsqww', 122, 0, 5, 1, 0, 0, 0, 0, 'Ref: 223223322 - sddwwwsqww'),
(5, 1, '2026-08-28 05:18:22', 1, 6, 5, 'Ref: 3231232 - 32defeewrwfwwrer', 344, 0, 5, 1, 0, 0, 0, 0, 'Ref: 3231232 - 32defeewrwfwwrer'),
(6, 1, '2026-08-28 06:12:59', 1, 7, 6, 'Ref: Aute perferendis dol - Et dolore quis dolor', 37, 0, 5, 1, 0, 0, 0, 0, 'Ref: Aute perferendis dol - Et dolore quis do');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `collection_bank_account`
--

CREATE TABLE `collection_bank_account` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_projects_collection_list_id` int(11) NOT NULL,
  `bank_account_details_id` int(11) NOT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collection_bank_account`
--

INSERT INTO `collection_bank_account` (`id`, `ast`, `sdt`, `wwjm_projects_collection_list_id`, `bank_account_details_id`, `main_user_login_id`) VALUES
(1, 1, '2026-08-28 08:19:19', 2, 1, 5),
(2, 0, '2026-08-28 08:23:45', 3, 1, 5),
(3, 1, '2026-08-28 08:25:04', 4, 1, 5),
(4, 1, '2026-08-28 08:32:32', 3, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `collection_ticket_tiers`
--

CREATE TABLE `collection_ticket_tiers` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total_capacity` int(11) DEFAULT NULL,
  `total_sold` int(11) DEFAULT NULL,
  `show_on_web` tinyint(1) DEFAULT NULL,
  `wwjm_projects_collection_list_id` int(11) NOT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collection_ticket_tiers`
--

INSERT INTO `collection_ticket_tiers` (`id`, `ast`, `sdt`, `price`, `total_capacity`, `total_sold`, `show_on_web`, `wwjm_projects_collection_list_id`, `main_user_login_id`) VALUES
(1, 1, '2026-08-25 07:03:44', 100, 100, 0, 1, 1, 1),
(2, 1, '2026-08-25 07:03:44', 500, 50, 0, 1, 1, 1),
(3, 1, '2026-08-28 08:19:19', 824, 838, 0, 1, 2, 5),
(4, 1, '2026-08-28 08:19:19', 666, 7, 0, 1, 2, 5),
(5, 0, '2026-08-28 08:23:45', 570, 252, 0, 1, 3, 5),
(6, 1, '2026-08-28 08:25:04', 450, 407, 0, 1, 4, 5),
(7, 1, '2026-08-28 08:32:32', 570, 252, 0, 1, 3, 5),
(8, 1, '2026-08-28 08:32:32', 500, 10, 0, 1, 3, 5),
(9, 1, '2026-08-28 08:32:32', 1000, 2, 0, 1, 3, 5),
(10, 1, '2026-08-28 08:32:32', 4000, 3, 0, 1, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `ast`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_person_list`
--

CREATE TABLE `contact_person_list` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `contact_person_name` varchar(450) DEFAULT NULL,
  `contact_person_member_id` varchar(45) DEFAULT NULL,
  `wwjm_member_list_id` int(11) NOT NULL,
  `contact_person_mobile` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_email_history`
--

CREATE TABLE `department_email_history` (
  `id` int(11) NOT NULL,
  `subject_value` varchar(4500) DEFAULT NULL,
  `message_body` text DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_email_notification`
--

CREATE TABLE `department_email_notification` (
  `id` int(11) NOT NULL,
  `dpt_name` varchar(45) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_email_notification_has_email_history`
--

CREATE TABLE `department_email_notification_has_email_history` (
  `sdt` timestamp NULL DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `department_email_notification_id` int(11) NOT NULL,
  `department_email_history_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_link_manament`
--

CREATE TABLE `email_sms_link_manament` (
  `id` int(11) NOT NULL,
  `state_of_view` tinyint(1) DEFAULT NULL,
  `on_short_lock` tinyint(1) DEFAULT NULL,
  `key_of_encript` varchar(450) DEFAULT NULL,
  `url_after_process` text DEFAULT NULL,
  `id_of_value` text DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `state_email` tinyint(1) DEFAULT NULL,
  `state_sms` tinyint(1) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_link_view_history`
--

CREATE TABLE `email_sms_link_view_history` (
  `id` int(11) NOT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `Email_SMS_link_manament_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE `employee_list` (
  `id` int(11) NOT NULL,
  `name_in_full` varchar(4500) DEFAULT NULL,
  `name_in_initials` varchar(450) DEFAULT NULL,
  `display_name` varchar(45) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `phone_no` varchar(45) DEFAULT NULL,
  `variable_data_state` tinyint(1) DEFAULT NULL,
  `verify_email_state` tinyint(1) DEFAULT NULL,
  `verify_phone_state` tinyint(1) DEFAULT NULL,
  `self_account_state` tinyint(1) DEFAULT NULL,
  `verify_state` tinyint(1) DEFAULT NULL,
  `user_account_avable` tinyint(1) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_supporting_doc_list`
--

CREATE TABLE `emp_supporting_doc_list` (
  `id` int(11) NOT NULL,
  `doc_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `state_of_req` tinyint(1) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_support_doc_img_pth_list`
--

CREATE TABLE `emp_support_doc_img_pth_list` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `pth` varchar(4500) DEFAULT NULL,
  `employee_list_id` int(11) NOT NULL,
  `emp_supporting_doc_list_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_variable_anwer_list`
--

CREATE TABLE `emp_variable_anwer_list` (
  `id` int(11) NOT NULL,
  `answer` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `employee_list_id` int(11) NOT NULL,
  `emp_variable_list_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_variable_list`
--

CREATE TABLE `emp_variable_list` (
  `id` int(11) NOT NULL,
  `variable_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `state_of_req` tinyint(1) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_expence_data`
--

CREATE TABLE `income_expence_data` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `date_of_doc` date DEFAULT NULL,
  `is_type_income` tinyint(1) DEFAULT NULL,
  `is_type_expece` tinyint(1) DEFAULT NULL,
  `finish_state` tinyint(1) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `dis` varchar(4500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `income_expence_data`
--

INSERT INTO `income_expence_data` (`id`, `ast`, `sdt`, `date_of_doc`, `is_type_income`, `is_type_expece`, `finish_state`, `total_amount`, `main_user_login_id`, `dis`) VALUES
(1, 1, '2026-08-25 07:11:18', '2026-08-25', 1, 0, 1, 100, 1, 'Member Auto Subscription (Slip #1)'),
(2, 1, '2026-08-28 03:08:00', '2026-08-28', 1, 0, 1, 500, 5, 'Member Auto Subscription (Slip #2)'),
(3, 1, '2026-08-28 03:08:00', '2026-08-28', 1, 0, 1, 500, 5, 'Member Auto Subscription (Slip #2)'),
(4, 1, '2026-08-28 03:24:45', '2026-08-28', 1, 0, 1, 100, 5, 'Member Auto Subscription (Slip #4)'),
(5, 1, '2026-08-28 03:24:45', '2026-08-28', 1, 0, 1, 100, 5, 'Member Auto Subscription (Slip #4)'),
(6, 1, '2026-08-28 03:27:02', '2026-08-28', 1, 0, 1, 100, 1, 'Bank Deposit Approved (Slip #4)'),
(7, 1, '2026-08-28 03:27:13', '2026-08-28', 1, 0, 1, 100, 1, 'Bank Deposit Approved (Slip #4)'),
(8, 1, '2026-08-28 03:31:55', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(9, 1, '2026-08-28 03:32:12', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(10, 1, '2026-08-28 03:35:50', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(11, 1, '2026-08-28 03:35:51', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(12, 1, '2026-08-28 03:35:52', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(13, 1, '2026-08-28 03:35:53', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(14, 1, '2026-08-28 03:35:54', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(15, 1, '2026-08-28 03:35:54', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(16, 1, '2026-08-28 03:35:55', '2026-08-28', 1, 0, 1, 100, 5, 'Bank Deposit Approved (Slip #4)'),
(17, 1, '2026-08-28 04:55:18', '2026-08-28', 1, 0, 1, 122, 5, 'Member Auto Subscription (Slip #5)'),
(18, 1, '2026-08-28 04:55:18', '2026-08-28', 1, 0, 1, 122, 5, 'Member Auto Subscription (Slip #5)'),
(19, 1, '2026-08-28 05:02:56', '2026-08-28', 1, 0, 1, 122, 5, 'Bank Deposit Approved (Slip #5)'),
(20, 1, '2026-08-28 05:03:59', '2026-08-28', 1, 0, 1, 122, 5, 'Bank Deposit Approved (Slip #5)'),
(21, 1, '2026-08-28 05:04:02', '2026-08-28', 1, 0, 1, 122, 5, 'Bank Deposit Approved (Slip #5)'),
(22, 1, '2026-08-28 05:18:22', '2026-08-28', 1, 0, 1, 344, 5, 'Member Auto Subscription (Slip #6)'),
(23, 1, '2026-08-28 05:18:22', '2026-08-28', 1, 0, 1, 344, 5, 'Member Auto Subscription (Slip #6)'),
(24, 1, '2026-08-28 06:12:59', '2026-08-28', 1, 0, 1, 37, 5, 'Member Auto Subscription (Slip #7)'),
(25, 1, '2026-08-28 06:12:59', '2026-08-28', 1, 0, 1, 37, 5, 'Member Auto Subscription (Slip #7)'),
(26, 1, '2026-08-28 06:50:46', '2026-08-28', 0, 1, 1, 5000, 1, 'lunch (Vendor: j.j hdbfhhd)'),
(27, 1, '2026-08-28 08:28:56', '2026-08-28', 1, 0, 1, 3333, 5, 'Member Auto Subscription (Slip #8)');

-- --------------------------------------------------------

--
-- Table structure for table `income_expence_data_info_list`
--

CREATE TABLE `income_expence_data_info_list` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `is_type_of_income` tinyint(1) DEFAULT NULL,
  `is_type_of_expence` tinyint(1) DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `income_expence_data_id` int(11) NOT NULL,
  `income_expence_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `income_expence_data_info_list`
--

INSERT INTO `income_expence_data_info_list` (`id`, `ast`, `sdt`, `is_type_of_income`, `is_type_of_expence`, `dis`, `amount`, `main_user_login_id`, `income_expence_data_id`, `income_expence_type_id`) VALUES
(1, 1, '2026-08-25 07:11:18', 1, 0, 'Member Subscription Payment', 100, 1, 1, 1),
(2, 1, '2026-08-28 03:08:00', 1, 0, 'Member Subscription Payment', 500, 5, 2, 1),
(3, 1, '2026-08-28 03:08:00', 1, 0, 'Member Subscription Payment', 500, 5, 3, 1),
(4, 1, '2026-08-28 03:24:45', 1, 0, 'Member Subscription Payment', 100, 5, 4, 1),
(5, 1, '2026-08-28 03:24:45', 1, 0, 'Member Subscription Payment', 100, 5, 5, 1),
(6, 1, '2026-08-28 03:27:02', 1, 0, 'Approved Bank Deposit', 100, 1, 6, 1),
(7, 1, '2026-08-28 03:27:13', 1, 0, 'Approved Bank Deposit', 100, 1, 7, 1),
(8, 1, '2026-08-28 03:31:55', 1, 0, 'Approved Bank Deposit', 100, 5, 8, 1),
(9, 1, '2026-08-28 03:32:12', 1, 0, 'Approved Bank Deposit', 100, 5, 9, 1),
(10, 1, '2026-08-28 03:35:50', 1, 0, 'Approved Bank Deposit', 100, 5, 10, 1),
(11, 1, '2026-08-28 03:35:51', 1, 0, 'Approved Bank Deposit', 100, 5, 11, 1),
(12, 1, '2026-08-28 03:35:52', 1, 0, 'Approved Bank Deposit', 100, 5, 12, 1),
(13, 1, '2026-08-28 03:35:53', 1, 0, 'Approved Bank Deposit', 100, 5, 13, 1),
(14, 1, '2026-08-28 03:35:54', 1, 0, 'Approved Bank Deposit', 100, 5, 14, 1),
(15, 1, '2026-08-28 03:35:54', 1, 0, 'Approved Bank Deposit', 100, 5, 15, 1),
(16, 1, '2026-08-28 03:35:55', 1, 0, 'Approved Bank Deposit', 100, 5, 16, 1),
(17, 1, '2026-08-28 04:55:18', 1, 0, 'Member Subscription Payment', 122, 5, 17, 1),
(18, 1, '2026-08-28 04:55:18', 1, 0, 'Member Subscription Payment', 122, 5, 18, 1),
(19, 1, '2026-08-28 05:02:56', 1, 0, 'Approved Bank Deposit', 122, 5, 19, 1),
(20, 1, '2026-08-28 05:03:59', 1, 0, 'Approved Bank Deposit', 122, 5, 20, 1),
(21, 1, '2026-08-28 05:04:02', 1, 0, 'Approved Bank Deposit', 122, 5, 21, 1),
(22, 1, '2026-08-28 05:18:22', 1, 0, 'Member Subscription Payment', 344, 5, 22, 1),
(23, 1, '2026-08-28 05:18:22', 1, 0, 'Member Subscription Payment', 344, 5, 23, 1),
(24, 1, '2026-08-28 06:12:59', 1, 0, 'Member Subscription Payment', 37, 5, 24, 1),
(25, 1, '2026-08-28 06:12:59', 1, 0, 'Member Subscription Payment', 37, 5, 25, 1),
(26, 1, '2026-08-28 06:50:47', 0, 1, 'lunch (Vendor: j.j hdbfhhd)', 5000, 1, 26, 2),
(27, 1, '2026-08-28 08:28:56', 1, 0, 'Member Subscription Payment', 3333, 5, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `income_expence_type`
--

CREATE TABLE `income_expence_type` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `income_expence_type_name` varchar(45) DEFAULT NULL,
  `is_income_type` tinyint(1) DEFAULT NULL,
  `is_expece_type` tinyint(1) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `income_expence_type`
--

INSERT INTO `income_expence_type` (`id`, `ast`, `sdt`, `income_expence_type_name`, `is_income_type`, `is_expece_type`, `main_user_login_id`) VALUES
(1, 1, '2026-08-25 07:11:18', 'Subscription', 1, 0, 1),
(2, 1, '2026-08-28 06:50:47', 'Magee Mathews', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ipg_list`
--

CREATE TABLE `ipg_list` (
  `id` int(11) NOT NULL,
  `process_start_sdt` timestamp NULL DEFAULT NULL,
  `process_end_sdt` timestamp NULL DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ipg_transaction_id` varchar(4500) DEFAULT NULL,
  `type_of_transation` varchar(45) DEFAULT NULL,
  `cus_name` varchar(45) DEFAULT NULL,
  `cus_phone` varchar(45) DEFAULT NULL,
  `cus_email` varchar(45) DEFAULT NULL,
  `state_of_msg` varchar(45) DEFAULT NULL,
  `state_of_sucess` tinyint(1) DEFAULT NULL,
  `payment_slip_id` varchar(4500) DEFAULT NULL,
  `amout` double DEFAULT NULL,
  `reciveing_state` tinyint(1) DEFAULT NULL,
  `not_reciveing_state_msg` varchar(450) DEFAULT NULL,
  `is_user` tinyint(1) DEFAULT NULL,
  `is_member` tinyint(1) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipg_send_by_url`
--

CREATE TABLE `ipg_send_by_url` (
  `id` int(11) NOT NULL,
  `sec_id` varchar(4500) DEFAULT NULL,
  `is_member` tinyint(1) DEFAULT NULL,
  `is_subction` tinyint(1) DEFAULT NULL,
  `is_zakath` tinyint(1) DEFAULT NULL,
  `is_projcet` tinyint(1) DEFAULT NULL,
  `is_donation` tinyint(1) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `cus_name` varchar(450) DEFAULT NULL,
  `cus_phone_no` varchar(45) DEFAULT NULL,
  `cus_email` varchar(450) DEFAULT NULL,
  `is_bank_fee` tinyint(1) DEFAULT NULL,
  `bank_fee_amount` double DEFAULT NULL,
  `transation_amount` double DEFAULT NULL,
  `is_user` tinyint(1) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ipg_transaction_id` varchar(4500) DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ipg_send_by_url`
--

INSERT INTO `ipg_send_by_url` (`id`, `sec_id`, `is_member`, `is_subction`, `is_zakath`, `is_projcet`, `is_donation`, `amount`, `cus_name`, `cus_phone_no`, `cus_email`, `is_bank_fee`, `bank_fee_amount`, `transation_amount`, `is_user`, `ast`, `sdt`, `ipg_transaction_id`, `payment_status`) VALUES
(1, 'M2dJRE5SYkwxRE53ZWdKZ1NoN200QT09', 0, 0, 0, 1, 0, 100, 'jhgjfhf', '46568798', '', 0, 0, 100, 0, 1, '2026-08-28 00:59:39', 'QU3X1192CEBCE89E68E53', 0),
(2, 'ZVNJYVhhdTFqSm1ETkVObFpkN2pWZz09', 0, 0, 0, 1, 0, 500, 'wqedqwew', '1232', '', 0, 0, 500, 0, 1, '2026-08-28 01:00:19', '', 0),
(3, 'NVJSV3ljTnJZZXIxYS9pdkdWSXBLQT09', 1, 1, 0, 0, 0, 0, 'Tanek Thompson', '', 'w@w', 0, 0, 0, 1, 1, '2026-08-28 01:02:52', '', 0),
(4, 'V3paZFJiN2xxWVpaU1UrRzBFWlM0dz09', 0, 0, 0, 1, 0, 233, 'Member Payment', '0770000000', '', 0, 0, 233, 0, 1, '2026-08-28 06:01:28', '', 0),
(5, 'VjZYbjI1Z2hBa1JaVUVsNUpHK3dDdz09', 0, 0, 0, 1, 0, 233, 'Member Payment', '0770000000', '', 0, 0, 233, 0, 1, '2026-08-28 06:03:00', '', 0),
(6, 'WVRQdUZ1SXF0LytTbEFQRFBGTU9SQT09', 1, 1, 0, 0, 0, -1236, 'Tanek Thompson', '', 'w@w', 0, 0, -1236, 1, 1, '2026-08-28 07:28:47', '', 0),
(7, 'dkJ6WDlLREFpa05JTXNJdHlZekhBZz09', 1, 1, 0, 0, 0, -1236, 'Tanek Thompson', '', 'w@w', 0, 0, -1236, 1, 1, '2026-08-28 07:35:52', '', 0),
(8, 'cVRUZ2dCT3NpbjFvYUNldXp0OXk4dz09', 1, 1, 0, 0, 0, 236, 'Tanek Thompson', '', 'w@w', 0, 0, 236, 1, 1, '2026-08-28 07:41:57', 'Z8B21192CEBDEA4D6EEF0', 0),
(9, 'RGFCRmNaaE1lQURlVXNOTjl3azBMUT09', 1, 1, 0, 0, 0, -1236, 'Tanek Thompson', '', 'w@w', 0, 0, -1236, 1, 1, '2026-08-28 07:54:03', 'G6ZL1192CEBDEC1E35784', 0),
(10, 'VGcwcjNheGRoUEZPdmxIaHpCeTFhQT09', 0, 0, 0, 1, 0, 1000, 'adasd', '123213', '', 0, 0, 1000, 0, 1, '2026-08-28 08:33:11', 'F72J1192CEBE08D81C191', 0),
(11, 'NmFtUVVsM2R4dEtoeUJmUmQ5NkFhdz09', 0, 0, 0, 1, 0, 8000, 'sdfdf', '2313123', '', 0, 0, 8000, 0, 1, '2026-08-28 08:33:47', '', 0),
(12, 'UHZzYmJFaHovY3Z2OEd3eWQvZTF3Zz09', 0, 0, 0, 1, 0, 500, 'Member Payment', '0770000000', '', 0, 0, 500, 0, 1, '2026-08-28 08:49:13', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `main_user_account_access_level_list`
--

CREATE TABLE `main_user_account_access_level_list` (
  `id` int(11) NOT NULL,
  `type_of_access` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `url_home` varchar(4500) DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `job_role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `main_user_account_access_level_list`
--

INSERT INTO `main_user_account_access_level_list` (`id`, `type_of_access`, `ast`, `sdt`, `url_home`, `dis`, `company_id`, `job_role`) VALUES
(1, 'admin', 1, '2026-08-25 10:28:00', NULL, NULL, 1, NULL),
(2, 'user', 1, '2026-08-25 10:31:09', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login`
--

CREATE TABLE `main_user_login` (
  `id` int(11) NOT NULL,
  `user_name` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `account_active_state` tinyint(1) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `name_show` varchar(45) DEFAULT NULL,
  `email_verify` tinyint(1) DEFAULT NULL,
  `moible_verfiy` tinyint(1) DEFAULT NULL,
  `very_first_login` tinyint(1) DEFAULT NULL,
  `cook_key` varchar(4500) DEFAULT NULL,
  `ref_key` varchar(45) DEFAULT NULL,
  `temp_lock` tinyint(1) DEFAULT NULL,
  `full_block` tinyint(1) DEFAULT NULL,
  `ac_type` varchar(45) DEFAULT NULL,
  `control_account_state` tinyint(1) DEFAULT NULL,
  `main_user_account_access_level_list_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `image_url` varchar(4500) DEFAULT NULL,
  `google_id` varchar(450) DEFAULT NULL,
  `google_authentication_secret` varchar(4500) DEFAULT NULL,
  `is_google_authentication_enable` tinyint(1) DEFAULT NULL,
  `microsoft_id` varchar(450) DEFAULT NULL,
  `first_name` varchar(450) DEFAULT NULL,
  `last_name` varchar(450) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `is_two_factor_auth_enable` tinyint(1) DEFAULT NULL,
  `wrong_login_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `main_user_login`
--

INSERT INTO `main_user_login` (`id`, `user_name`, `password`, `account_active_state`, `ast`, `sdt`, `last_login`, `name_show`, `email_verify`, `moible_verfiy`, `very_first_login`, `cook_key`, `ref_key`, `temp_lock`, `full_block`, `ac_type`, `control_account_state`, `main_user_account_access_level_list_id`, `company_id`, `image_url`, `google_id`, `google_authentication_secret`, `is_google_authentication_enable`, `microsoft_id`, `first_name`, `last_name`, `phone_number`, `dis`, `is_two_factor_auth_enable`, `wrong_login_count`) VALUES
(1, 'ansif@neosolution.lk', 'YXk3a1M0K0RHeURhMFhDcnNBTndKQT09', 1, 1, '2026-08-25 06:59:07', '2026-08-25 06:59:07', 'Angelica Gallagher', 0, 0, 0, 'aUVvalY2OW9sbkZyVnZPbnhuaFVZdz09', '3762746', 0, 0, 'Quia molestiae cum a', 0, 1, 1, '', '', NULL, 0, '', 'Angelica', 'Gallagher', '', '', 0, 0),
(2, 'a@a', 'cjBxdmMxTGdJQVhBeVZRcDVyUm8zUT09', 1, 1, '2026-08-25 07:00:31', '2026-08-25 07:00:31', 'Tasha Waters', 0, 0, 0, 'YXZ2cW54TVBkcW9OMlRzWlZnWlRVZz09', '4575464', 0, 0, 'A saepe voluptas con', 0, 2, 1, '', '', NULL, 0, '', 'Tasha', 'Waters', '', '', 0, 0),
(3, 'qanagov@mailinator.com', 'bXg1RGhjY3gzS0lORGNmRHhFY1VVZz09', 1, 1, '2026-08-25 07:10:01', '2026-08-25 07:10:01', 'Ulysses Lancaster', 0, 0, 0, '', '', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Ulysses Lancaster', '', '', '', 0, 1),
(4, 'jogi@mailinator.com', 'clZUazk0eHo5Z0pFTjk3OUs1eGc2dz09', 1, 1, '2026-08-28 00:23:10', '2026-08-28 00:23:10', 'Stacy Alvarez', 0, 0, 0, '', '', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Stacy Alvarez', '', '', '', 0, 0),
(5, 'w@w', 'SWhTUzFIOGtTREQ2eFAyYkhXS05ZZz09', 1, 1, '2026-08-28 00:48:02', '2026-08-28 00:48:02', 'Tanek Thompson', 0, 0, 0, 'MHpmRGZHZ3hWbWZtNnlybjNMaElvZz09', '0820506', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Tanek Thompson', '', '', '', 0, 1),
(6, 'kuqajyha@mailinator.com', 'cld6bElzSlkranJIcmtOYUFDS0NwQnROeEU1blRBYkduTXI0Vy9EV2FiVT0=', 1, 1, '2026-08-28 08:27:07', '2026-08-28 08:27:07', 'Ulysses Hayes', 0, 0, 0, '', '', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Ulysses Hayes', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_device`
--

CREATE TABLE `main_user_login_device` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `device_type` varchar(45) DEFAULT NULL,
  `browser` varchar(45) DEFAULT NULL,
  `os` varchar(45) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `session_token` varchar(4500) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `main_user_login_device`
--

INSERT INTO `main_user_login_device` (`id`, `ast`, `sdt`, `device_type`, `browser`, `os`, `ip_address`, `last_activity`, `login_time`, `is_active`, `session_token`, `location`, `main_user_login_id`) VALUES
(1, 1, '2026-08-25 06:59:22', 'Desktop', 'Chrome', 'Windows 10', '::1', '2026-08-28 12:58:06', '2026-08-25 12:29:22', 1, '8078e2f411a070c9d6886477fa7539ed841ffd3c04ea5aedb3bdb3572cf8c9fa', 'Localhost', 1),
(2, 1, '2026-08-25 07:12:55', 'Desktop', 'Chrome', 'Windows 10', '::1', '2026-08-28 05:48:26', '2026-08-25 12:42:55', 1, 'd56855c02a394063c6f9267438088a5c4442e2cfcd47ff6fe781318b62903235', 'Localhost', 2),
(3, 1, '2026-08-28 00:50:20', 'Desktop', 'Chrome', 'Windows 10', '::1', '2026-08-28 10:53:49', '2026-08-28 06:20:20', 1, '182d4256d80904d84032853424d25dcb001bd40d4fd64464f52f3db88ac4127c', 'Localhost', 5);

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_email_list`
--

CREATE TABLE `main_user_login_email_list` (
  `id` int(11) NOT NULL,
  `email_steate` tinyint(1) DEFAULT NULL,
  `key_of_email` varchar(4500) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `type_email` varchar(45) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_has_ipg_list`
--

CREATE TABLE `main_user_login_has_ipg_list` (
  `main_user_login_id` int(11) NOT NULL,
  `IPG_List_id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_has_ipg_send_by_url`
--

CREATE TABLE `main_user_login_has_ipg_send_by_url` (
  `main_user_login_id` int(11) NOT NULL,
  `IPG_Send_By_URL_id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `main_user_login_has_ipg_send_by_url`
--

INSERT INTO `main_user_login_has_ipg_send_by_url` (`main_user_login_id`, `IPG_Send_By_URL_id`, `ast`) VALUES
(1, 3, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `management_notification`
--

CREATE TABLE `management_notification` (
  `id` int(11) NOT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `process_state` tinyint(1) DEFAULT NULL,
  `wwjm_member_list_id` int(11) NOT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `sec_id` varchar(450) DEFAULT NULL,
  `management_person_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `management_person_list`
--

CREATE TABLE `management_person_list` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `notification_contact_no` varchar(45) DEFAULT NULL,
  `notification_email` varchar(45) DEFAULT NULL,
  `notification_sms_state` tinyint(1) DEFAULT NULL,
  `notification_email_state` tinyint(1) DEFAULT NULL,
  `address` varchar(450) DEFAULT NULL,
  `active_state` tinyint(1) DEFAULT NULL,
  `cancel_state_sdt` timestamp NULL DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `management_position_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `management_position_list`
--

CREATE TABLE `management_position_list` (
  `id` int(11) NOT NULL,
  `position_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recommended_person_data`
--

CREATE TABLE `recommended_person_data` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `name` varchar(450) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `wwjm_member_list_id` int(11) NOT NULL,
  `membership_no` varchar(45) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `recommended_person_data`
--

INSERT INTO `recommended_person_data` (`id`, `ast`, `sdt`, `name`, `contact_no`, `wwjm_member_list_id`, `membership_no`, `main_user_login_id`) VALUES
(1, 1, '2026-08-25 07:10:04', 'Jana Mcpherson', '+1 (738) 821-3005', 1, 'Et reiciendis earum', 1),
(2, 1, '2026-08-25 07:10:04', 'William Brewer', '+1 (884) 277-8919', 1, 'Consequat Natus et', 1),
(3, 1, '2026-08-25 07:10:04', 'Clarke Miller', '+1 (579) 377-6404', 1, 'Deleniti cum ut aut', 1),
(4, 1, '2026-08-28 00:23:12', 'Raja Roach', '+1 (737) 817-8278', 2, 'Sed qui reiciendis e', 1),
(5, 1, '2026-08-28 00:23:12', 'Murphy Browning', '+1 (399) 327-7569', 2, 'Itaque aspernatur la', 1),
(6, 1, '2026-08-28 00:23:12', 'Yoshi Matthews', '+1 (962) 536-8727', 2, 'Totam distinctio Qu', 1),
(7, 1, '2026-08-28 00:48:08', 'Xena Barton', '+1 (447) 578-2592', 3, 'Similique autem qui', 1),
(8, 1, '2026-08-28 00:48:08', 'Adena Graves', '+1 (518) 729-9511', 3, 'Impedit tempor face', 1),
(9, 1, '2026-08-28 00:48:08', 'Ferris Graves', '+1 (582) 478-4548', 3, 'Voluptate debitis ni', 1),
(10, 1, '2026-08-28 08:27:13', 'Carter Moses', '+1 (311) 866-6373', 4, 'Adipisicing pariatur', 5),
(11, 1, '2026-08-28 08:27:13', 'Myles Huffman', '+1 (288) 723-6411', 4, 'Incididunt eum sit', 5),
(12, 1, '2026-08-28 08:27:13', 'Ria Schneider', '+1 (483) 958-8522', 4, 'Qui est officia lab', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_transactions`
--

CREATE TABLE `ticket_transactions` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `qty_bougth` int(11) DEFAULT NULL,
  `collection_ticket_tiers_id` int(11) NOT NULL,
  `wwjm_projects_collection_list_id` int(11) NOT NULL,
  `wwjm_member_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_bank_deposit_slip`
--

CREATE TABLE `wwjm_bank_deposit_slip` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `image_pth` varchar(4500) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_payment_slip_id` int(11) NOT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `approve_by` varchar(45) DEFAULT NULL,
  `resion_to_approve` varchar(4500) DEFAULT NULL,
  `approve_state` tinyint(1) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `bank_account_details_id` int(11) NOT NULL,
  `approve_cancel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wwjm_bank_deposit_slip`
--

INSERT INTO `wwjm_bank_deposit_slip` (`id`, `ast`, `image_pth`, `sdt`, `wwjm_payment_slip_id`, `main_user_login_id`, `approve_by`, `resion_to_approve`, `approve_state`, `amount`, `bank_account_details_id`, `approve_cancel`) VALUES
(1, 1, 'data:image/png;base64,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', '2026-08-28 03:08:00', 2, 5, 'Not Approve Yet', 'Ref: 313511 - jhjgfxdfzdzdzfxxgchjvhbjnk', 0, 500, 1, 0),
(2, 1, 'Data/WWJM/WWJM_CHEQUE_IMAGE_6a912db3733ba0.02828511.png', '2026-08-28 03:11:56', 3, 1, 'Not Approve Yet', 'hghfgxgfchgjh', 1, 1236, 1, 0),
(3, 1, 'data:image/jpeg;base64,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', '2026-08-28 03:24:45', 4, 5, 'Finance Admin', 'Approved via Finance Verification Portal', 1, 100, 1, 0),
(4, 1, 'Data/WWJM/WWJM_BANK_RECEIPT_6a9145ed574418.80253093.jpg', '2026-08-28 04:55:18', 5, 5, 'Finance Admin', 'Approved via Finance Verification Portal', 1, 122, 1, 0),
(5, 1, 'Data/WWJM/WWJM_BANK_RECEIPT_6a914b51b9d7a6.71523129.png', '2026-08-28 05:18:22', 6, 5, 'Finance Admin', 'i dont like his name', 0, 344, 1, 1),
(6, 1, 'Data/WWJM/WWJM_BANK_RECEIPT_6a9158224354f4.26461778.png', '2026-08-28 06:12:59', 7, 5, 'Not Approve Yet', 'Ref: Aute perferendis dol - Et dolore quis dolor', 0, 37, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_collection_payments`
--

CREATE TABLE `wwjm_collection_payments` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_payment_slip_id` int(11) NOT NULL,
  `wwjm_projects_collection_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list`
--

CREATE TABLE `wwjm_member_list` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `name_M` varchar(450) DEFAULT NULL,
  `residence_address_M` varchar(4500) DEFAULT NULL,
  `is_own_house` tinyint(1) DEFAULT NULL,
  `is_rented_house` tinyint(1) DEFAULT NULL,
  `nic_M` varchar(450) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `notification_moible_no` varchar(45) DEFAULT NULL,
  `secondry_mobile` varchar(45) DEFAULT NULL,
  `notification_whatup` varchar(45) DEFAULT NULL,
  `profession` varchar(450) DEFAULT NULL,
  `monlty_payment` double DEFAULT NULL,
  `opening_balance` double DEFAULT NULL,
  `approve_level_01_state` tinyint(1) DEFAULT NULL,
  `approve_level_01_person` varchar(45) DEFAULT NULL,
  `approve_level_01_sdt` timestamp NULL DEFAULT NULL,
  `approve_level_02_state` tinyint(1) DEFAULT NULL,
  `approve_level_02_person` varchar(45) DEFAULT NULL,
  `approve_level_02_sdt` timestamp NULL DEFAULT NULL,
  `nofication_update_app` tinyint(1) DEFAULT NULL,
  `nofication_update_sms` tinyint(1) DEFAULT NULL,
  `nofication_update_email` tinyint(1) DEFAULT NULL,
  `due_to_pay` double DEFAULT NULL,
  `active_state` tinyint(1) DEFAULT NULL,
  `dis` varchar(450) DEFAULT NULL,
  `membership_no` varchar(45) DEFAULT NULL,
  `zakath_pay_state` tinyint(1) DEFAULT NULL,
  `account_type_zakath_payee` tinyint(1) DEFAULT NULL,
  `account_type_subcrption` tinyint(1) DEFAULT NULL,
  `account_type_zakath_reciver` tinyint(1) DEFAULT NULL,
  `self_account` tinyint(1) DEFAULT NULL,
  `is_login_avable` tinyint(1) DEFAULT NULL,
  `wwjm_road_name_id` int(11) NOT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wwjm_member_list`
--

INSERT INTO `wwjm_member_list` (`id`, `ast`, `sdt`, `name_M`, `residence_address_M`, `is_own_house`, `is_rented_house`, `nic_M`, `email`, `notification_moible_no`, `secondry_mobile`, `notification_whatup`, `profession`, `monlty_payment`, `opening_balance`, `approve_level_01_state`, `approve_level_01_person`, `approve_level_01_sdt`, `approve_level_02_state`, `approve_level_02_person`, `approve_level_02_sdt`, `nofication_update_app`, `nofication_update_sms`, `nofication_update_email`, `due_to_pay`, `active_state`, `dis`, `membership_no`, `zakath_pay_state`, `account_type_zakath_payee`, `account_type_subcrption`, `account_type_zakath_reciver`, `self_account`, `is_login_avable`, `wwjm_road_name_id`, `main_user_login_id`) VALUES
(1, 1, '2026-08-25 07:10:01', 'Ulysses Lancaster', 'Et autem magna hic q', 1, 1, 'Voluptas voluptatem', 'qanagov@mailinator.com', '+1 (904) 539-2269', '+1 (707) 643-4542', '+1 (748) 904-9272', 'Consequatur adipisci', 10, 99, 1, 'Angelica Gallagher', '2026-08-25 07:10:01', 1, 'Angelica Gallagher', '2026-08-25 07:10:01', 0, 0, 0, -100, 1, '0', '00001', 1, 1, 1, 1, 0, 0, 1, 3),
(2, 1, '2026-08-28 00:23:10', 'Stacy Alvarez', 'In fugiat neque et', 0, 0, 'Maiores duis facilis', 'jogi@mailinator.com', '+1 (804) 349-9675', '+1 (323) 197-1571', '+1 (768) 915-9749', 'Sunt voluptatum vol', 10, 47, 1, 'Angelica Gallagher', '2026-08-28 00:23:10', 1, 'Angelica Gallagher', '2026-08-28 00:23:10', 0, 0, 0, 0, 1, '0', '00002', 1, 1, 0, 0, 0, 0, 1, 4),
(3, 1, '2026-08-28 00:48:02', 'Tanek Thompson', 'Ducimus in incidunt', 0, 1, '200123704050', 'w@w', '0711734502', '0711734502', '0711734502', 'Non sint fugiat sint', 1, 40, 1, 'Angelica Gallagher', '2026-08-28 00:48:02', 1, 'Angelica Gallagher', '2026-08-28 00:48:02', 0, 0, 0, -1236, 1, '0', '00003', 1, 1, 1, 1, 0, 0, 1, 5),
(4, 1, '2026-08-28 08:27:07', 'Ulysses Hayes', 'Illum accusamus eli', 1, 0, 'Ut repudiandae ut do', 'kuqajyha@mailinator.com', '+1 (648) 183-5648', '+1 (482) 958-3383', '+1 (648) 183-5648', 'Et voluptatem ut qui', 10, 84, 1, 'Tanek Thompson', '2026-08-28 08:27:07', 1, 'Tanek Thompson', '2026-08-28 08:27:07', 0, 0, 0, -3333, 1, '0', '00004', 1, 1, 1, 1, 0, 0, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_ipg_list`
--

CREATE TABLE `wwjm_member_list_has_ipg_list` (
  `wwjm_member_list_id` int(11) NOT NULL,
  `IPG_List_id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_ipg_send_by_url`
--

CREATE TABLE `wwjm_member_list_has_ipg_send_by_url` (
  `wwjm_member_list_id` int(11) NOT NULL,
  `IPG_Send_By_URL_id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wwjm_member_list_has_ipg_send_by_url`
--

INSERT INTO `wwjm_member_list_has_ipg_send_by_url` (`wwjm_member_list_id`, `IPG_Send_By_URL_id`, `ast`) VALUES
(3, 3, 1),
(3, 6, 1),
(3, 7, 1),
(3, 8, 1),
(3, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_main_user_login`
--

CREATE TABLE `wwjm_member_list_has_main_user_login` (
  `wwjm_member_list_id` int(11) NOT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_management_person_list`
--

CREATE TABLE `wwjm_member_list_has_management_person_list` (
  `wwjm_member_list_id` int(11) NOT NULL,
  `management_person_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_user_login`
--

CREATE TABLE `wwjm_member_list_user_login` (
  `id` int(11) NOT NULL,
  `wwjm_member_list_id` int(11) NOT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_old_list`
--

CREATE TABLE `wwjm_member_old_list` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `member_no` varchar(45) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `account_craete_state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_payment_slilp`
--

CREATE TABLE `wwjm_member_payment_slilp` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_member_list_id` int(11) NOT NULL,
  `wwjm_payment_slip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wwjm_member_payment_slilp`
--

INSERT INTO `wwjm_member_payment_slilp` (`id`, `ast`, `sdt`, `wwjm_member_list_id`, `wwjm_payment_slip_id`) VALUES
(1, 1, '2026-08-25 07:11:18', 1, 1),
(2, 1, '2026-08-28 03:08:00', 3, 2),
(3, 1, '2026-08-28 03:11:56', 3, 3),
(4, 1, '2026-08-28 03:24:45', 3, 4),
(5, 1, '2026-08-28 04:55:18', 3, 5),
(6, 1, '2026-08-28 05:18:22', 3, 6),
(7, 1, '2026-08-28 06:12:59', 3, 7),
(8, 1, '2026-08-28 08:28:56', 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_payment_slip`
--

CREATE TABLE `wwjm_payment_slip` (
  `id` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `is_cash` tinyint(1) DEFAULT NULL,
  `is_bank_deposit` tinyint(1) DEFAULT NULL,
  `is_IPG` tinyint(1) DEFAULT NULL,
  `slip_print` tinyint(1) DEFAULT NULL,
  `pay_resion_subcption` tinyint(1) DEFAULT NULL,
  `pay_resion_donation` tinyint(1) DEFAULT NULL,
  `pay_resion_zakath` tinyint(1) DEFAULT NULL,
  `pay_resion_projects` tinyint(1) DEFAULT NULL,
  `is_member` tinyint(1) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `person_name` varchar(45) DEFAULT NULL,
  `address` varchar(4500) DEFAULT NULL,
  `membership_no` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wwjm_payment_slip`
--

INSERT INTO `wwjm_payment_slip` (`id`, `payment_date`, `ast`, `sdt`, `amount`, `dis`, `is_cash`, `is_bank_deposit`, `is_IPG`, `slip_print`, `pay_resion_subcption`, `pay_resion_donation`, `pay_resion_zakath`, `pay_resion_projects`, `is_member`, `main_user_login_id`, `person_name`, `address`, `membership_no`, `phone_number`, `email`) VALUES
(1, '2026-08-25', 1, '2026-08-25 07:11:18', 100, '0', 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 'Ulysses Lancaster', 'Et autem magna hic q', '00001', '', 'qanagov@mailinator.com'),
(2, '2026-08-28', 1, '2026-08-28 03:08:00', 500, 'Ref: 313511 - jhjgfxdfzdzdzfxxgchjvhbjnk', 0, 1, 0, 0, 1, 0, 0, 0, 1, 5, 'Member', '', '00003', '', ''),
(3, '2026-08-28', 1, '2026-08-28 03:11:56', 1236, 'hghfgxgfchgjh', 0, 1, 0, 0, 0, 1, 0, 0, 1, 1, 'Tanek Thompson', 'Ducimus in incidunt', '00003', '', 'w@w'),
(4, '2026-08-28', 1, '2026-08-28 03:24:45', 100, 'Ref: ergtrtrt - rt3rtt3', 0, 1, 0, 0, 1, 0, 0, 0, 1, 5, 'Member', '', '00003', '', ''),
(5, '2026-08-28', 1, '2026-08-28 04:55:18', 122, 'Ref: 223223322 - sddwwwsqww', 0, 1, 0, 0, 1, 0, 0, 0, 1, 5, 'Member', '', '00003', '', ''),
(6, '2026-08-28', 1, '2026-08-28 05:18:22', 344, 'Ref: 3231232 - 32defeewrwfwwrer', 0, 1, 0, 0, 1, 0, 0, 0, 1, 5, 'Tanek Thompson', 'Ducimus in incidunt', '00003', '0711734502', 'w@w'),
(7, '2026-08-28', 1, '2026-08-28 06:12:59', 37, 'Ref: Aute perferendis dol - Et dolore quis dolor', 0, 1, 0, 0, 1, 0, 0, 0, 1, 5, 'Tanek Thompson', 'Ducimus in incidunt', '00003', '0711734502', 'w@w'),
(8, '2026-08-28', 1, '2026-08-28 08:28:56', 3333, '0', 1, 0, 0, 0, 1, 0, 0, 0, 1, 5, 'Ulysses Hayes', 'Illum accusamus eli', '00004', '', 'kuqajyha@mailinator.com');

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_projects_collection_list`
--

CREATE TABLE `wwjm_projects_collection_list` (
  `id` int(11) NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `project_name` varchar(450) DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `image_pth` varchar(450) DEFAULT NULL,
  `is_fix_budget` tinyint(1) DEFAULT NULL,
  `is_end_date` tinyint(1) DEFAULT NULL,
  `fix_amount` double DEFAULT NULL,
  `fix_end_date` datetime DEFAULT NULL,
  `is_cash` tinyint(1) DEFAULT NULL,
  `is_share_qr` tinyint(1) DEFAULT NULL,
  `is_bank_deposit` tinyint(1) DEFAULT NULL,
  `is_members_only` tinyint(1) DEFAULT NULL,
  `is_all_person` tinyint(1) DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL,
  `have_tickets` tinyint(1) DEFAULT NULL,
  `assign_bank_account` tinyint(1) DEFAULT NULL,
  `collected_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wwjm_projects_collection_list`
--

INSERT INTO `wwjm_projects_collection_list` (`id`, `ast`, `sdt`, `project_name`, `dis`, `image_pth`, `is_fix_budget`, `is_end_date`, `fix_amount`, `fix_end_date`, `is_cash`, `is_share_qr`, `is_bank_deposit`, `is_members_only`, `is_all_person`, `main_user_login_id`, `have_tickets`, `assign_bank_account`, `collected_amount`) VALUES
(1, 1, '2026-08-25 07:03:44', 'Magee Mathews', 'Non aspernatur natus', 'Uploads/Projects/COL_IMG_1787654024_6a8d6f8884c18.jpg', 1, 1, 61000, '2026-08-29 21:31:00', 1, 1, 0, 0, 1, 1, 1, 0, 0),
(2, 1, '2026-08-28 08:19:19', 'Raya Stark', 'Voluptatibus et aut', 'Uploads/Projects/COL_IMG_1787917759_6a9175bf2ee9d.jpg', 1, 1, 26000, '2027-05-26 11:59:00', 1, 1, 0, 0, 1, 5, 1, 1, 0),
(3, 1, '2026-08-28 08:23:45', 'Charde Wagner', 'Dignissimos tempor t', 'Uploads/Projects/COL_IMG_1787918025_6a9176c904348.jfif', 0, 1, 0, '2005-03-10 20:36:00', 1, 1, 0, 1, 0, 5, 1, 1, 0),
(4, 1, '2026-08-28 08:25:04', 'Kyra Kim', 'Sunt quas ut aut et', 'Uploads/Projects/COL_IMG_1787918104_6a91771824816.PNG', 1, 1, 46, '2018-07-14 16:17:00', 1, 1, 0, 1, 0, 5, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_road_name`
--

CREATE TABLE `wwjm_road_name` (
  `id` int(11) NOT NULL,
  `road_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `main_user_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wwjm_road_name`
--

INSERT INTO `wwjm_road_name` (`id`, `road_name`, `ast`, `sdt`, `main_user_login_id`) VALUES
(1, 'road_01', 1, '2026-08-25 07:09:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_subscription`
--

CREATE TABLE `wwjm_subscription` (
  `id` int(11) NOT NULL,
  `genarate_date` date DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `disption_pay` varchar(450) DEFAULT NULL,
  `crt_amount` double DEFAULT NULL,
  `dbt_amount` double DEFAULT NULL,
  `wwjm_member_list_id` int(11) NOT NULL,
  `sms_send_state` tinyint(1) DEFAULT NULL,
  `email_send_state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail_report`
--
ALTER TABLE `audit_trail_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_tral_report_main_user_login1_idx` (`main_user_login_id`),
  ADD KEY `fk_audit_trail_report_company1_idx` (`company_id`);

--
-- Indexes for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bank_account_details_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `bank_deposit_data_history`
--
ALTER TABLE `bank_deposit_data_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bank_deposit_data_history_bank_account_details1_idx` (`bank_account_details_id`),
  ADD KEY `fk_bank_deposit_data_history_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`),
  ADD KEY `fk_bank_deposit_data_history_wwjm_bank_deposit_slip1_idx` (`wwjm_bank_deposit_slip_id`),
  ADD KEY `fk_bank_deposit_data_history_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_bank_account`
--
ALTER TABLE `collection_bank_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_collection_bank_account_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`),
  ADD KEY `fk_collection_bank_account_bank_account_details1_idx` (`bank_account_details_id`),
  ADD KEY `fk_collection_bank_account_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `collection_ticket_tiers`
--
ALTER TABLE `collection_ticket_tiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_collection_ticket_tiers_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`),
  ADD KEY `fk_collection_ticket_tiers_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_person_list`
--
ALTER TABLE `contact_person_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_person_list_wwjm_member_list1_idx` (`wwjm_member_list_id`);

--
-- Indexes for table `department_email_history`
--
ALTER TABLE `department_email_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_department_email_history_company1_idx` (`company_id`);

--
-- Indexes for table `department_email_notification`
--
ALTER TABLE `department_email_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_department_email_notification_company1_idx` (`company_id`);

--
-- Indexes for table `department_email_notification_has_email_history`
--
ALTER TABLE `department_email_notification_has_email_history`
  ADD KEY `fk_department_email_notification_has_email_history_company1_idx` (`company_id`),
  ADD KEY `fk_department_email_notification_has_email_history_departme_idx` (`department_email_notification_id`),
  ADD KEY `fk_department_email_notification_has_email_history_departme_idx1` (`department_email_history_id`);

--
-- Indexes for table `email_sms_link_manament`
--
ALTER TABLE `email_sms_link_manament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Email_SMS_link_manament_company1_idx` (`company_id`),
  ADD KEY `fk_Email_SMS_link_manament_branch1_idx` (`branch_id`);

--
-- Indexes for table `email_sms_link_view_history`
--
ALTER TABLE `email_sms_link_view_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Email_SMS_link_view_history_Email_SMS_link_manament1_idx` (`Email_SMS_link_manament_id`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_employee_list_main_user_login1_idx` (`main_user_login_id`),
  ADD KEY `fk_employee_list_company1_idx` (`company_id`);

--
-- Indexes for table `emp_supporting_doc_list`
--
ALTER TABLE `emp_supporting_doc_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emp_supporting_doc_list_company1_idx` (`company_id`);

--
-- Indexes for table `emp_support_doc_img_pth_list`
--
ALTER TABLE `emp_support_doc_img_pth_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emp_support_doc_img_pth_list_employee_list2_idx` (`employee_list_id`),
  ADD KEY `fk_emp_support_doc_img_pth_list_emp_supporting_doc_list2_idx` (`emp_supporting_doc_list_id`),
  ADD KEY `fk_emp_support_doc_img_pth_list_company1_idx` (`company_id`);

--
-- Indexes for table `emp_variable_anwer_list`
--
ALTER TABLE `emp_variable_anwer_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emp_variable_anwer_list_employee_list2_idx` (`employee_list_id`),
  ADD KEY `fk_emp_variable_anwer_list_emp_variable_list2_idx` (`emp_variable_list_id`),
  ADD KEY `fk_emp_variable_anwer_list_company1_idx` (`company_id`);

--
-- Indexes for table `emp_variable_list`
--
ALTER TABLE `emp_variable_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emp_variable_list_company1_idx` (`company_id`);

--
-- Indexes for table `income_expence_data`
--
ALTER TABLE `income_expence_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_income_expence_data_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `income_expence_data_info_list`
--
ALTER TABLE `income_expence_data_info_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_income_expence_data_info_list_main_user_login1_idx` (`main_user_login_id`),
  ADD KEY `fk_income_expence_data_info_list_income_expence_data1_idx` (`income_expence_data_id`),
  ADD KEY `fk_income_expence_data_info_list_income_expence_type1_idx` (`income_expence_type_id`);

--
-- Indexes for table `income_expence_type`
--
ALTER TABLE `income_expence_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_income_expence_type_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `ipg_list`
--
ALTER TABLE `ipg_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipg_send_by_url`
--
ALTER TABLE `ipg_send_by_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_user_account_access_level_list`
--
ALTER TABLE `main_user_account_access_level_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_main_user_account_access_level_list_company1_idx` (`company_id`);

--
-- Indexes for table `main_user_login`
--
ALTER TABLE `main_user_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_main_user_login_main_user_account_access_level_list1_idx` (`main_user_account_access_level_list_id`),
  ADD KEY `fk_main_user_login_company1_idx` (`company_id`);

--
-- Indexes for table `main_user_login_device`
--
ALTER TABLE `main_user_login_device`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_main_user_login_device_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `main_user_login_email_list`
--
ALTER TABLE `main_user_login_email_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_main_user_login_email_list_main_user_login2_idx` (`main_user_login_id`),
  ADD KEY `fk_main_user_login_email_list_company1_idx` (`company_id`);

--
-- Indexes for table `main_user_login_has_ipg_list`
--
ALTER TABLE `main_user_login_has_ipg_list`
  ADD PRIMARY KEY (`main_user_login_id`,`IPG_List_id`),
  ADD KEY `fk_main_user_login_has_IPG_List_IPG_List1_idx` (`IPG_List_id`),
  ADD KEY `fk_main_user_login_has_IPG_List_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `main_user_login_has_ipg_send_by_url`
--
ALTER TABLE `main_user_login_has_ipg_send_by_url`
  ADD PRIMARY KEY (`main_user_login_id`,`IPG_Send_By_URL_id`),
  ADD KEY `fk_main_user_login_has_IPG_Send_By_URL_IPG_Send_By_URL1_idx` (`IPG_Send_By_URL_id`),
  ADD KEY `fk_main_user_login_has_IPG_Send_By_URL_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `management_notification`
--
ALTER TABLE `management_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_management_notification_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  ADD KEY `fk_management_notification_main_user_login1_idx` (`main_user_login_id`),
  ADD KEY `fk_management_notification_management_person_list1_idx` (`management_person_list_id`);

--
-- Indexes for table `management_person_list`
--
ALTER TABLE `management_person_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_management_person_list_main_user_login1_idx` (`main_user_login_id`),
  ADD KEY `fk_management_person_list_management_position_list1_idx` (`management_position_list_id`);

--
-- Indexes for table `management_position_list`
--
ALTER TABLE `management_position_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_management_position_list_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `recommended_person_data`
--
ALTER TABLE `recommended_person_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recommended_person_data_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  ADD KEY `fk_recommended_person_data_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `ticket_transactions`
--
ALTER TABLE `ticket_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ticket_transactions_collection_ticket_tiers1_idx` (`collection_ticket_tiers_id`),
  ADD KEY `fk_ticket_transactions_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`),
  ADD KEY `fk_ticket_transactions_wwjm_member_list1_idx` (`wwjm_member_list_id`);

--
-- Indexes for table `wwjm_bank_deposit_slip`
--
ALTER TABLE `wwjm_bank_deposit_slip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_bank_deposit_slip_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`),
  ADD KEY `fk_wwjm_bank_deposit_slip_main_user_login1_idx` (`main_user_login_id`),
  ADD KEY `fk_wwjm_bank_deposit_slip_bank_account_details1_idx` (`bank_account_details_id`);

--
-- Indexes for table `wwjm_collection_payments`
--
ALTER TABLE `wwjm_collection_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_collection_payments_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`),
  ADD KEY `fk_wwjm_collection_payments_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`);

--
-- Indexes for table `wwjm_member_list`
--
ALTER TABLE `wwjm_member_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_member_list_wwjm_road_name1_idx` (`wwjm_road_name_id`),
  ADD KEY `fk_wwjm_member_list_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `wwjm_member_list_has_ipg_list`
--
ALTER TABLE `wwjm_member_list_has_ipg_list`
  ADD PRIMARY KEY (`wwjm_member_list_id`,`IPG_List_id`),
  ADD KEY `fk_wwjm_member_list_has_IPG_List_IPG_List1_idx` (`IPG_List_id`),
  ADD KEY `fk_wwjm_member_list_has_IPG_List_wwjm_member_list1_idx` (`wwjm_member_list_id`);

--
-- Indexes for table `wwjm_member_list_has_ipg_send_by_url`
--
ALTER TABLE `wwjm_member_list_has_ipg_send_by_url`
  ADD PRIMARY KEY (`wwjm_member_list_id`,`IPG_Send_By_URL_id`),
  ADD KEY `fk_wwjm_member_list_has_IPG_Send_By_URL_IPG_Send_By_URL1_idx` (`IPG_Send_By_URL_id`),
  ADD KEY `fk_wwjm_member_list_has_IPG_Send_By_URL_wwjm_member_list1_idx` (`wwjm_member_list_id`);

--
-- Indexes for table `wwjm_member_list_has_main_user_login`
--
ALTER TABLE `wwjm_member_list_has_main_user_login`
  ADD PRIMARY KEY (`wwjm_member_list_id`,`main_user_login_id`),
  ADD KEY `fk_wwjm_member_list_has_main_user_login_main_user_login1_idx` (`main_user_login_id`),
  ADD KEY `fk_wwjm_member_list_has_main_user_login_wwjm_member_list1_idx` (`wwjm_member_list_id`);

--
-- Indexes for table `wwjm_member_list_has_management_person_list`
--
ALTER TABLE `wwjm_member_list_has_management_person_list`
  ADD PRIMARY KEY (`wwjm_member_list_id`,`management_person_list_id`),
  ADD KEY `fk_wwjm_member_list_has_management_person_list_management_p_idx` (`management_person_list_id`),
  ADD KEY `fk_wwjm_member_list_has_management_person_list_wwjm_member__idx` (`wwjm_member_list_id`);

--
-- Indexes for table `wwjm_member_list_user_login`
--
ALTER TABLE `wwjm_member_list_user_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_member_list_user_login_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  ADD KEY `fk_wwjm_member_list_user_login_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `wwjm_member_old_list`
--
ALTER TABLE `wwjm_member_old_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_member_old_list_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `wwjm_member_payment_slilp`
--
ALTER TABLE `wwjm_member_payment_slilp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_member_payment_slilp_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  ADD KEY `fk_wwjm_member_payment_slilp_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`);

--
-- Indexes for table `wwjm_payment_slip`
--
ALTER TABLE `wwjm_payment_slip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_payment_slip_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `wwjm_projects_collection_list`
--
ALTER TABLE `wwjm_projects_collection_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_projects_collection_list_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `wwjm_road_name`
--
ALTER TABLE `wwjm_road_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_road_name_main_user_login1_idx` (`main_user_login_id`);

--
-- Indexes for table `wwjm_subscription`
--
ALTER TABLE `wwjm_subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wwjm_subscription_wwjm_member_list1_idx` (`wwjm_member_list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail_report`
--
ALTER TABLE `audit_trail_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_deposit_data_history`
--
ALTER TABLE `bank_deposit_data_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collection_bank_account`
--
ALTER TABLE `collection_bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collection_ticket_tiers`
--
ALTER TABLE `collection_ticket_tiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_person_list`
--
ALTER TABLE `contact_person_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_email_history`
--
ALTER TABLE `department_email_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_email_notification`
--
ALTER TABLE `department_email_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_link_manament`
--
ALTER TABLE `email_sms_link_manament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_link_view_history`
--
ALTER TABLE `email_sms_link_view_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_supporting_doc_list`
--
ALTER TABLE `emp_supporting_doc_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_support_doc_img_pth_list`
--
ALTER TABLE `emp_support_doc_img_pth_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_variable_anwer_list`
--
ALTER TABLE `emp_variable_anwer_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_variable_list`
--
ALTER TABLE `emp_variable_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_expence_data`
--
ALTER TABLE `income_expence_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `income_expence_data_info_list`
--
ALTER TABLE `income_expence_data_info_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `income_expence_type`
--
ALTER TABLE `income_expence_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ipg_list`
--
ALTER TABLE `ipg_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipg_send_by_url`
--
ALTER TABLE `ipg_send_by_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `main_user_account_access_level_list`
--
ALTER TABLE `main_user_account_access_level_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `main_user_login`
--
ALTER TABLE `main_user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `main_user_login_device`
--
ALTER TABLE `main_user_login_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main_user_login_email_list`
--
ALTER TABLE `main_user_login_email_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `management_notification`
--
ALTER TABLE `management_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `management_person_list`
--
ALTER TABLE `management_person_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `management_position_list`
--
ALTER TABLE `management_position_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recommended_person_data`
--
ALTER TABLE `recommended_person_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ticket_transactions`
--
ALTER TABLE `ticket_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wwjm_bank_deposit_slip`
--
ALTER TABLE `wwjm_bank_deposit_slip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wwjm_collection_payments`
--
ALTER TABLE `wwjm_collection_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wwjm_member_list`
--
ALTER TABLE `wwjm_member_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wwjm_member_list_user_login`
--
ALTER TABLE `wwjm_member_list_user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wwjm_member_old_list`
--
ALTER TABLE `wwjm_member_old_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wwjm_member_payment_slilp`
--
ALTER TABLE `wwjm_member_payment_slilp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wwjm_payment_slip`
--
ALTER TABLE `wwjm_payment_slip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wwjm_projects_collection_list`
--
ALTER TABLE `wwjm_projects_collection_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wwjm_road_name`
--
ALTER TABLE `wwjm_road_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_trail_report`
--
ALTER TABLE `audit_trail_report`
  ADD CONSTRAINT `fk_audit_trail_report_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_audit_tral_report_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  ADD CONSTRAINT `fk_bank_account_details_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bank_deposit_data_history`
--
ALTER TABLE `bank_deposit_data_history`
  ADD CONSTRAINT `fk_bank_deposit_data_history_bank_account_details1` FOREIGN KEY (`bank_account_details_id`) REFERENCES `bank_account_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bank_deposit_data_history_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bank_deposit_data_history_wwjm_bank_deposit_slip1` FOREIGN KEY (`wwjm_bank_deposit_slip_id`) REFERENCES `wwjm_bank_deposit_slip` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bank_deposit_data_history_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `collection_bank_account`
--
ALTER TABLE `collection_bank_account`
  ADD CONSTRAINT `fk_collection_bank_account_bank_account_details1` FOREIGN KEY (`bank_account_details_id`) REFERENCES `bank_account_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_collection_bank_account_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_collection_bank_account_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `collection_ticket_tiers`
--
ALTER TABLE `collection_ticket_tiers`
  ADD CONSTRAINT `fk_collection_ticket_tiers_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_collection_ticket_tiers_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contact_person_list`
--
ALTER TABLE `contact_person_list`
  ADD CONSTRAINT `fk_contact_person_list_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `department_email_history`
--
ALTER TABLE `department_email_history`
  ADD CONSTRAINT `fk_department_email_history_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `department_email_notification`
--
ALTER TABLE `department_email_notification`
  ADD CONSTRAINT `fk_department_email_notification_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `department_email_notification_has_email_history`
--
ALTER TABLE `department_email_notification_has_email_history`
  ADD CONSTRAINT `fk_department_email_notification_has_email_history_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_department_email_notification_has_email_history_department1` FOREIGN KEY (`department_email_notification_id`) REFERENCES `department_email_notification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_department_email_notification_has_email_history_department2` FOREIGN KEY (`department_email_history_id`) REFERENCES `department_email_history` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `email_sms_link_manament`
--
ALTER TABLE `email_sms_link_manament`
  ADD CONSTRAINT `fk_Email_SMS_link_manament_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Email_SMS_link_manament_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `email_sms_link_view_history`
--
ALTER TABLE `email_sms_link_view_history`
  ADD CONSTRAINT `fk_Email_SMS_link_view_history_Email_SMS_link_manament1` FOREIGN KEY (`Email_SMS_link_manament_id`) REFERENCES `email_sms_link_manament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD CONSTRAINT `fk_employee_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_supporting_doc_list`
--
ALTER TABLE `emp_supporting_doc_list`
  ADD CONSTRAINT `fk_emp_supporting_doc_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_support_doc_img_pth_list`
--
ALTER TABLE `emp_support_doc_img_pth_list`
  ADD CONSTRAINT `fk_emp_support_doc_img_pth_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emp_support_doc_img_pth_list_emp_supporting_doc_list2` FOREIGN KEY (`emp_supporting_doc_list_id`) REFERENCES `emp_supporting_doc_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emp_support_doc_img_pth_list_employee_list2` FOREIGN KEY (`employee_list_id`) REFERENCES `employee_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_variable_anwer_list`
--
ALTER TABLE `emp_variable_anwer_list`
  ADD CONSTRAINT `fk_emp_variable_anwer_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emp_variable_anwer_list_emp_variable_list2` FOREIGN KEY (`emp_variable_list_id`) REFERENCES `emp_variable_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emp_variable_anwer_list_employee_list2` FOREIGN KEY (`employee_list_id`) REFERENCES `employee_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_variable_list`
--
ALTER TABLE `emp_variable_list`
  ADD CONSTRAINT `fk_emp_variable_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `income_expence_data`
--
ALTER TABLE `income_expence_data`
  ADD CONSTRAINT `fk_income_expence_data_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `income_expence_data_info_list`
--
ALTER TABLE `income_expence_data_info_list`
  ADD CONSTRAINT `fk_income_expence_data_info_list_income_expence_data1` FOREIGN KEY (`income_expence_data_id`) REFERENCES `income_expence_data` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_income_expence_data_info_list_income_expence_type1` FOREIGN KEY (`income_expence_type_id`) REFERENCES `income_expence_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_income_expence_data_info_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `income_expence_type`
--
ALTER TABLE `income_expence_type`
  ADD CONSTRAINT `fk_income_expence_type_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `main_user_account_access_level_list`
--
ALTER TABLE `main_user_account_access_level_list`
  ADD CONSTRAINT `fk_main_user_account_access_level_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `main_user_login`
--
ALTER TABLE `main_user_login`
  ADD CONSTRAINT `fk_main_user_login_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_main_user_login_main_user_account_access_level_list1` FOREIGN KEY (`main_user_account_access_level_list_id`) REFERENCES `main_user_account_access_level_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `main_user_login_device`
--
ALTER TABLE `main_user_login_device`
  ADD CONSTRAINT `fk_main_user_login_device_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `main_user_login_email_list`
--
ALTER TABLE `main_user_login_email_list`
  ADD CONSTRAINT `fk_main_user_login_email_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_main_user_login_email_list_main_user_login2` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `main_user_login_has_ipg_list`
--
ALTER TABLE `main_user_login_has_ipg_list`
  ADD CONSTRAINT `fk_main_user_login_has_IPG_List_IPG_List1` FOREIGN KEY (`IPG_List_id`) REFERENCES `ipg_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_main_user_login_has_IPG_List_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `main_user_login_has_ipg_send_by_url`
--
ALTER TABLE `main_user_login_has_ipg_send_by_url`
  ADD CONSTRAINT `fk_main_user_login_has_IPG_Send_By_URL_IPG_Send_By_URL1` FOREIGN KEY (`IPG_Send_By_URL_id`) REFERENCES `ipg_send_by_url` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_main_user_login_has_IPG_Send_By_URL_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `management_notification`
--
ALTER TABLE `management_notification`
  ADD CONSTRAINT `fk_management_notification_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_management_notification_management_person_list1` FOREIGN KEY (`management_person_list_id`) REFERENCES `management_person_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_management_notification_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `management_person_list`
--
ALTER TABLE `management_person_list`
  ADD CONSTRAINT `fk_management_person_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_management_person_list_management_position_list1` FOREIGN KEY (`management_position_list_id`) REFERENCES `management_position_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `management_position_list`
--
ALTER TABLE `management_position_list`
  ADD CONSTRAINT `fk_management_position_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recommended_person_data`
--
ALTER TABLE `recommended_person_data`
  ADD CONSTRAINT `fk_recommended_person_data_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recommended_person_data_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ticket_transactions`
--
ALTER TABLE `ticket_transactions`
  ADD CONSTRAINT `fk_ticket_transactions_collection_ticket_tiers1` FOREIGN KEY (`collection_ticket_tiers_id`) REFERENCES `collection_ticket_tiers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ticket_transactions_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ticket_transactions_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_bank_deposit_slip`
--
ALTER TABLE `wwjm_bank_deposit_slip`
  ADD CONSTRAINT `fk_wwjm_bank_deposit_slip_bank_account_details1` FOREIGN KEY (`bank_account_details_id`) REFERENCES `bank_account_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_bank_deposit_slip_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_bank_deposit_slip_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_collection_payments`
--
ALTER TABLE `wwjm_collection_payments`
  ADD CONSTRAINT `fk_wwjm_collection_payments_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_collection_payments_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_list`
--
ALTER TABLE `wwjm_member_list`
  ADD CONSTRAINT `fk_wwjm_member_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_member_list_wwjm_road_name1` FOREIGN KEY (`wwjm_road_name_id`) REFERENCES `wwjm_road_name` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_list_has_ipg_list`
--
ALTER TABLE `wwjm_member_list_has_ipg_list`
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_List_IPG_List1` FOREIGN KEY (`IPG_List_id`) REFERENCES `ipg_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_List_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_list_has_ipg_send_by_url`
--
ALTER TABLE `wwjm_member_list_has_ipg_send_by_url`
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_Send_By_URL_IPG_Send_By_URL1` FOREIGN KEY (`IPG_Send_By_URL_id`) REFERENCES `ipg_send_by_url` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_Send_By_URL_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_list_has_main_user_login`
--
ALTER TABLE `wwjm_member_list_has_main_user_login`
  ADD CONSTRAINT `fk_wwjm_member_list_has_main_user_login_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_member_list_has_main_user_login_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_list_has_management_person_list`
--
ALTER TABLE `wwjm_member_list_has_management_person_list`
  ADD CONSTRAINT `fk_wwjm_member_list_has_management_person_list_management_per1` FOREIGN KEY (`management_person_list_id`) REFERENCES `management_person_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_member_list_has_management_person_list_wwjm_member_li1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_list_user_login`
--
ALTER TABLE `wwjm_member_list_user_login`
  ADD CONSTRAINT `fk_wwjm_member_list_user_login_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_member_list_user_login_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_old_list`
--
ALTER TABLE `wwjm_member_old_list`
  ADD CONSTRAINT `fk_wwjm_member_old_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_member_payment_slilp`
--
ALTER TABLE `wwjm_member_payment_slilp`
  ADD CONSTRAINT `fk_wwjm_member_payment_slilp_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wwjm_member_payment_slilp_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_payment_slip`
--
ALTER TABLE `wwjm_payment_slip`
  ADD CONSTRAINT `fk_wwjm_payment_slip_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_projects_collection_list`
--
ALTER TABLE `wwjm_projects_collection_list`
  ADD CONSTRAINT `fk_wwjm_projects_collection_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_road_name`
--
ALTER TABLE `wwjm_road_name`
  ADD CONSTRAINT `fk_wwjm_road_name_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wwjm_subscription`
--
ALTER TABLE `wwjm_subscription`
  ADD CONSTRAINT `fk_wwjm_subscription_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
