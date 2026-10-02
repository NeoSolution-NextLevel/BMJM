-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2026 at 08:51 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmjm`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail_report`
--

DROP TABLE IF EXISTS `audit_trail_report`;
CREATE TABLE IF NOT EXISTS `audit_trail_report` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_tral_report_main_user_login1_idx` (`main_user_login_id`),
  KEY `fk_audit_trail_report_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_details`
--

DROP TABLE IF EXISTS `bank_account_details`;
CREATE TABLE IF NOT EXISTS `bank_account_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(45) DEFAULT NULL,
  `branch` varchar(45) DEFAULT NULL,
  `ac_no` varchar(45) DEFAULT NULL,
  `ac_name` varchar(45) DEFAULT NULL,
  `swif_code` varchar(45) DEFAULT NULL,
  `current_ac` tinyint(1) DEFAULT NULL,
  `savings_ac` tinyint(1) DEFAULT NULL,
  `dis` varchar(450) DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bank_account_details_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bank_deposit_data_history`
--

DROP TABLE IF EXISTS `bank_deposit_data_history`;
CREATE TABLE IF NOT EXISTS `bank_deposit_data_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `bank_account_details_id` int NOT NULL,
  `wwjm_payment_slip_id` int NOT NULL,
  `wwjm_bank_deposit_slip_id` int NOT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `credit_amout` double DEFAULT NULL,
  `debet_amount` double DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `pay_resion_subcption` tinyint(1) DEFAULT NULL,
  `pay_resion_donation` tinyint(1) DEFAULT NULL,
  `pay_resion_zakath` tinyint(1) DEFAULT NULL,
  `pay_resion_projects` tinyint(1) DEFAULT NULL,
  `pay_resion_others` tinyint(1) DEFAULT NULL,
  `pay_resion_other_by_text` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bank_deposit_data_history_bank_account_details1_idx` (`bank_account_details_id`),
  KEY `fk_bank_deposit_data_history_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`),
  KEY `fk_bank_deposit_data_history_wwjm_bank_deposit_slip1_idx` (`wwjm_bank_deposit_slip_id`),
  KEY `fk_bank_deposit_data_history_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `collection_bank_account`
--

DROP TABLE IF EXISTS `collection_bank_account`;
CREATE TABLE IF NOT EXISTS `collection_bank_account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_projects_collection_list_id` int NOT NULL,
  `bank_account_details_id` int NOT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_collection_bank_account_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`),
  KEY `fk_collection_bank_account_bank_account_details1_idx` (`bank_account_details_id`),
  KEY `fk_collection_bank_account_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `collection_ticket_tiers`
--

DROP TABLE IF EXISTS `collection_ticket_tiers`;
CREATE TABLE IF NOT EXISTS `collection_ticket_tiers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total_capacity` int DEFAULT NULL,
  `total_sold` int DEFAULT NULL,
  `show_on_web` tinyint(1) DEFAULT NULL,
  `wwjm_projects_collection_list_id` int NOT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_collection_ticket_tiers_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`),
  KEY `fk_collection_ticket_tiers_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `contact_person_list`
--

DROP TABLE IF EXISTS `contact_person_list`;
CREATE TABLE IF NOT EXISTS `contact_person_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `contact_person_name` varchar(450) DEFAULT NULL,
  `contact_person_member_id` varchar(45) DEFAULT NULL,
  `wwjm_member_list_id` int NOT NULL,
  `contact_person_mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contact_person_list_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `department_email_history`
--

DROP TABLE IF EXISTS `department_email_history`;
CREATE TABLE IF NOT EXISTS `department_email_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_value` varchar(4500) DEFAULT NULL,
  `message_body` text,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_department_email_history_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `department_email_notification`
--

DROP TABLE IF EXISTS `department_email_notification`;
CREATE TABLE IF NOT EXISTS `department_email_notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dpt_name` varchar(45) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_department_email_notification_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `department_email_notification_has_email_history`
--

DROP TABLE IF EXISTS `department_email_notification_has_email_history`;
CREATE TABLE IF NOT EXISTS `department_email_notification_has_email_history` (
  `sdt` timestamp NULL DEFAULT NULL,
  `company_id` int NOT NULL,
  `department_email_notification_id` int NOT NULL,
  `department_email_history_id` int NOT NULL,
  KEY `fk_department_email_notification_has_email_history_company1_idx` (`company_id`),
  KEY `fk_department_email_notification_has_email_history_departme_idx` (`department_email_notification_id`),
  KEY `fk_department_email_notification_has_email_history_departme_idx1` (`department_email_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_link_manament`
--

DROP TABLE IF EXISTS `email_sms_link_manament`;
CREATE TABLE IF NOT EXISTS `email_sms_link_manament` (
  `id` int NOT NULL AUTO_INCREMENT,
  `state_of_view` tinyint(1) DEFAULT NULL,
  `on_short_lock` tinyint(1) DEFAULT NULL,
  `key_of_encript` varchar(450) DEFAULT NULL,
  `url_after_process` text,
  `id_of_value` text,
  `view_count` int DEFAULT NULL,
  `state_email` tinyint(1) DEFAULT NULL,
  `state_sms` tinyint(1) DEFAULT NULL,
  `company_id` int NOT NULL,
  `branch_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Email_SMS_link_manament_company1_idx` (`company_id`),
  KEY `fk_Email_SMS_link_manament_branch1_idx` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_link_view_history`
--

DROP TABLE IF EXISTS `email_sms_link_view_history`;
CREATE TABLE IF NOT EXISTS `email_sms_link_view_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `Email_SMS_link_manament_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Email_SMS_link_view_history_Email_SMS_link_manament1_idx` (`Email_SMS_link_manament_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

DROP TABLE IF EXISTS `employee_list`;
CREATE TABLE IF NOT EXISTS `employee_list` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `main_user_login_id` int NOT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_employee_list_main_user_login1_idx` (`main_user_login_id`),
  KEY `fk_employee_list_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `emp_supporting_doc_list`
--

DROP TABLE IF EXISTS `emp_supporting_doc_list`;
CREATE TABLE IF NOT EXISTS `emp_supporting_doc_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `state_of_req` tinyint(1) DEFAULT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emp_supporting_doc_list_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `emp_support_doc_img_pth_list`
--

DROP TABLE IF EXISTS `emp_support_doc_img_pth_list`;
CREATE TABLE IF NOT EXISTS `emp_support_doc_img_pth_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `pth` varchar(4500) DEFAULT NULL,
  `employee_list_id` int NOT NULL,
  `emp_supporting_doc_list_id` int NOT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emp_support_doc_img_pth_list_employee_list2_idx` (`employee_list_id`),
  KEY `fk_emp_support_doc_img_pth_list_emp_supporting_doc_list2_idx` (`emp_supporting_doc_list_id`),
  KEY `fk_emp_support_doc_img_pth_list_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `emp_variable_anwer_list`
--

DROP TABLE IF EXISTS `emp_variable_anwer_list`;
CREATE TABLE IF NOT EXISTS `emp_variable_anwer_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `answer` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `employee_list_id` int NOT NULL,
  `emp_variable_list_id` int NOT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emp_variable_anwer_list_employee_list2_idx` (`employee_list_id`),
  KEY `fk_emp_variable_anwer_list_emp_variable_list2_idx` (`emp_variable_list_id`),
  KEY `fk_emp_variable_anwer_list_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `emp_variable_list`
--

DROP TABLE IF EXISTS `emp_variable_list`;
CREATE TABLE IF NOT EXISTS `emp_variable_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `variable_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `state_of_req` tinyint(1) DEFAULT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emp_variable_list_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `fcm_tokens`
--

DROP TABLE IF EXISTS `fcm_tokens`;
CREATE TABLE IF NOT EXISTS `fcm_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `platform` varchar(30) DEFAULT 'android',
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `wwjm_member_list_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  KEY `fk_fcm_tokens_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `income_expence_data`
--

DROP TABLE IF EXISTS `income_expence_data`;
CREATE TABLE IF NOT EXISTS `income_expence_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `date_of_doc` date DEFAULT NULL,
  `is_type_income` tinyint(1) DEFAULT NULL,
  `is_type_expece` tinyint(1) DEFAULT NULL,
  `finish_state` tinyint(1) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_income_expence_data_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `income_expence_data_info_list`
--

DROP TABLE IF EXISTS `income_expence_data_info_list`;
CREATE TABLE IF NOT EXISTS `income_expence_data_info_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `is_type_of_income` tinyint(1) DEFAULT NULL,
  `is_type_of_expence` tinyint(1) DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `income_expence_data_id` int NOT NULL,
  `income_expence_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_income_expence_data_info_list_main_user_login1_idx` (`main_user_login_id`),
  KEY `fk_income_expence_data_info_list_income_expence_data1_idx` (`income_expence_data_id`),
  KEY `fk_income_expence_data_info_list_income_expence_type1_idx` (`income_expence_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `income_expence_type`
--

DROP TABLE IF EXISTS `income_expence_type`;
CREATE TABLE IF NOT EXISTS `income_expence_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `income_expence_type_name` varchar(45) DEFAULT NULL,
  `is_income_type` tinyint(1) DEFAULT NULL,
  `is_expece_type` tinyint(1) DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_income_expence_type_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ipg_list`
--

DROP TABLE IF EXISTS `ipg_list`;
CREATE TABLE IF NOT EXISTS `ipg_list` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ipg_send_by_url`
--

DROP TABLE IF EXISTS `ipg_send_by_url`;
CREATE TABLE IF NOT EXISTS `ipg_send_by_url` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `payment_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_account_access_level_list`
--

DROP TABLE IF EXISTS `main_user_account_access_level_list`;
CREATE TABLE IF NOT EXISTS `main_user_account_access_level_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_of_access` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `url_home` varchar(4500) DEFAULT NULL,
  `dis` varchar(4500) DEFAULT NULL,
  `company_id` int NOT NULL,
  `job_role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_main_user_account_access_level_list_company1_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login`
--

DROP TABLE IF EXISTS `main_user_login`;
CREATE TABLE IF NOT EXISTS `main_user_login` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `main_user_account_access_level_list_id` int NOT NULL,
  `company_id` int NOT NULL,
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
  `wrong_login_count` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_main_user_login_main_user_account_access_level_list1_idx` (`main_user_account_access_level_list_id`),
  KEY `fk_main_user_login_company1_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_device`
--

DROP TABLE IF EXISTS `main_user_login_device`;
CREATE TABLE IF NOT EXISTS `main_user_login_device` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_main_user_login_device_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_email_list`
--

DROP TABLE IF EXISTS `main_user_login_email_list`;
CREATE TABLE IF NOT EXISTS `main_user_login_email_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_steate` tinyint(1) DEFAULT NULL,
  `key_of_email` varchar(4500) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `type_email` varchar(45) DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_main_user_login_email_list_main_user_login2_idx` (`main_user_login_id`),
  KEY `fk_main_user_login_email_list_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_has_ipg_list`
--

DROP TABLE IF EXISTS `main_user_login_has_ipg_list`;
CREATE TABLE IF NOT EXISTS `main_user_login_has_ipg_list` (
  `main_user_login_id` int NOT NULL,
  `IPG_List_id` int NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`main_user_login_id`,`IPG_List_id`),
  KEY `fk_main_user_login_has_IPG_List_IPG_List1_idx` (`IPG_List_id`),
  KEY `fk_main_user_login_has_IPG_List_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_login_has_ipg_send_by_url`
--

DROP TABLE IF EXISTS `main_user_login_has_ipg_send_by_url`;
CREATE TABLE IF NOT EXISTS `main_user_login_has_ipg_send_by_url` (
  `main_user_login_id` int NOT NULL,
  `IPG_Send_By_URL_id` int NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`main_user_login_id`,`IPG_Send_By_URL_id`),
  KEY `fk_main_user_login_has_IPG_Send_By_URL_IPG_Send_By_URL1_idx` (`IPG_Send_By_URL_id`),
  KEY `fk_main_user_login_has_IPG_Send_By_URL_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `main_user_password_reset_otp`
--

DROP TABLE IF EXISTS `main_user_password_reset_otp`;
CREATE TABLE IF NOT EXISTS `main_user_password_reset_otp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_token_hash` char(64) NOT NULL,
  `otp_hash` varchar(255) DEFAULT NULL,
  `delivery_method` varchar(10) DEFAULT NULL,
  `attempts` int DEFAULT '0',
  `expires_at` timestamp NULL DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `request_token_hash_UNIQUE` (`request_token_hash`),
  KEY `fk_main_user_password_reset_otp_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `management_notification`
--

DROP TABLE IF EXISTS `management_notification`;
CREATE TABLE IF NOT EXISTS `management_notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `process_state` tinyint(1) DEFAULT NULL,
  `wwjm_member_list_id` int NOT NULL,
  `main_user_login_id` int NOT NULL,
  `sec_id` varchar(450) DEFAULT NULL,
  `management_person_list_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_management_notification_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  KEY `fk_management_notification_main_user_login1_idx` (`main_user_login_id`),
  KEY `fk_management_notification_management_person_list1_idx` (`management_person_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `management_person_list`
--

DROP TABLE IF EXISTS `management_person_list`;
CREATE TABLE IF NOT EXISTS `management_person_list` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `main_user_login_id` int NOT NULL,
  `management_position_list_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_management_person_list_main_user_login1_idx` (`main_user_login_id`),
  KEY `fk_management_person_list_management_position_list1_idx` (`management_position_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `management_position_list`
--

DROP TABLE IF EXISTS `management_position_list`;
CREATE TABLE IF NOT EXISTS `management_position_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_management_position_list_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `subscription_id` varchar(100) DEFAULT NULL,
  `main_user_login_id` int DEFAULT NULL,
  `image_pth` varchar(4500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `notification_inbox`
--

DROP TABLE IF EXISTS `notification_inbox`;
CREATE TABLE IF NOT EXISTS `notification_inbox` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_read` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `notifications_id` int NOT NULL,
  `wwjm_member_list_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notification_member_UNIQUE` (`notifications_id`,`wwjm_member_list_id`),
  KEY `fk_notification_inbox_notifications1_idx` (`notifications_id`),
  KEY `fk_notification_inbox_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `recommended_person_data`
--

DROP TABLE IF EXISTS `recommended_person_data`;
CREATE TABLE IF NOT EXISTS `recommended_person_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `name` varchar(450) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `wwjm_member_list_id` int NOT NULL,
  `membership_no` varchar(45) DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recommended_person_data_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  KEY `fk_recommended_person_data_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_transactions`
--

DROP TABLE IF EXISTS `ticket_transactions`;
CREATE TABLE IF NOT EXISTS `ticket_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `qty_bougth` int DEFAULT NULL,
  `collection_ticket_tiers_id` int NOT NULL,
  `wwjm_projects_collection_list_id` int NOT NULL,
  `wwjm_member_list_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ticket_transactions_collection_ticket_tiers1_idx` (`collection_ticket_tiers_id`),
  KEY `fk_ticket_transactions_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`),
  KEY `fk_ticket_transactions_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_bank_deposit_slip`
--

DROP TABLE IF EXISTS `wwjm_bank_deposit_slip`;
CREATE TABLE IF NOT EXISTS `wwjm_bank_deposit_slip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `image_pth` varchar(4500) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_payment_slip_id` int NOT NULL,
  `main_user_login_id` int NOT NULL,
  `approve_by` varchar(45) DEFAULT NULL,
  `resion_to_approve` varchar(4500) DEFAULT NULL,
  `approve_state` tinyint(1) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `bank_account_details_id` int NOT NULL,
  `approve_cancel` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_bank_deposit_slip_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`),
  KEY `fk_wwjm_bank_deposit_slip_main_user_login1_idx` (`main_user_login_id`),
  KEY `fk_wwjm_bank_deposit_slip_bank_account_details1_idx` (`bank_account_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_collection_payments`
--

DROP TABLE IF EXISTS `wwjm_collection_payments`;
CREATE TABLE IF NOT EXISTS `wwjm_collection_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_payment_slip_id` int NOT NULL,
  `wwjm_projects_collection_list_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_collection_payments_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`),
  KEY `fk_wwjm_collection_payments_wwjm_projects_collection_list1_idx` (`wwjm_projects_collection_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list`
--

DROP TABLE IF EXISTS `wwjm_member_list`;
CREATE TABLE IF NOT EXISTS `wwjm_member_list` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `wwjm_road_name_id` int NOT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_member_list_wwjm_road_name1_idx` (`wwjm_road_name_id`),
  KEY `fk_wwjm_member_list_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_ipg_list`
--

DROP TABLE IF EXISTS `wwjm_member_list_has_ipg_list`;
CREATE TABLE IF NOT EXISTS `wwjm_member_list_has_ipg_list` (
  `wwjm_member_list_id` int NOT NULL,
  `IPG_List_id` int NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`wwjm_member_list_id`,`IPG_List_id`),
  KEY `fk_wwjm_member_list_has_IPG_List_IPG_List1_idx` (`IPG_List_id`),
  KEY `fk_wwjm_member_list_has_IPG_List_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_ipg_send_by_url`
--

DROP TABLE IF EXISTS `wwjm_member_list_has_ipg_send_by_url`;
CREATE TABLE IF NOT EXISTS `wwjm_member_list_has_ipg_send_by_url` (
  `wwjm_member_list_id` int NOT NULL,
  `IPG_Send_By_URL_id` int NOT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`wwjm_member_list_id`,`IPG_Send_By_URL_id`),
  KEY `fk_wwjm_member_list_has_IPG_Send_By_URL_IPG_Send_By_URL1_idx` (`IPG_Send_By_URL_id`),
  KEY `fk_wwjm_member_list_has_IPG_Send_By_URL_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_main_user_login`
--

DROP TABLE IF EXISTS `wwjm_member_list_has_main_user_login`;
CREATE TABLE IF NOT EXISTS `wwjm_member_list_has_main_user_login` (
  `wwjm_member_list_id` int NOT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`wwjm_member_list_id`,`main_user_login_id`),
  KEY `fk_wwjm_member_list_has_main_user_login_main_user_login1_idx` (`main_user_login_id`),
  KEY `fk_wwjm_member_list_has_main_user_login_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_has_management_person_list`
--

DROP TABLE IF EXISTS `wwjm_member_list_has_management_person_list`;
CREATE TABLE IF NOT EXISTS `wwjm_member_list_has_management_person_list` (
  `wwjm_member_list_id` int NOT NULL,
  `management_person_list_id` int NOT NULL,
  PRIMARY KEY (`wwjm_member_list_id`,`management_person_list_id`),
  KEY `fk_wwjm_member_list_has_management_person_list_management_p_idx` (`management_person_list_id`),
  KEY `fk_wwjm_member_list_has_management_person_list_wwjm_member__idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_list_user_login`
--

DROP TABLE IF EXISTS `wwjm_member_list_user_login`;
CREATE TABLE IF NOT EXISTS `wwjm_member_list_user_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `wwjm_member_list_id` int NOT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_member_list_user_login_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  KEY `fk_wwjm_member_list_user_login_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_old_list`
--

DROP TABLE IF EXISTS `wwjm_member_old_list`;
CREATE TABLE IF NOT EXISTS `wwjm_member_old_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `member_no` varchar(45) DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  `account_craete_state` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_member_old_list_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_member_payment_slilp`
--

DROP TABLE IF EXISTS `wwjm_member_payment_slilp`;
CREATE TABLE IF NOT EXISTS `wwjm_member_payment_slilp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `wwjm_member_list_id` int NOT NULL,
  `wwjm_payment_slip_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_member_payment_slilp_wwjm_member_list1_idx` (`wwjm_member_list_id`),
  KEY `fk_wwjm_member_payment_slilp_wwjm_payment_slip1_idx` (`wwjm_payment_slip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_payment_slip`
--

DROP TABLE IF EXISTS `wwjm_payment_slip`;
CREATE TABLE IF NOT EXISTS `wwjm_payment_slip` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `main_user_login_id` int NOT NULL,
  `person_name` varchar(45) DEFAULT NULL,
  `address` varchar(4500) DEFAULT NULL,
  `membership_no` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_payment_slip_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_projects_collection_list`
--

DROP TABLE IF EXISTS `wwjm_projects_collection_list`;
CREATE TABLE IF NOT EXISTS `wwjm_projects_collection_list` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `main_user_login_id` int NOT NULL,
  `have_tickets` tinyint(1) DEFAULT NULL,
  `assign_bank_account` tinyint(1) DEFAULT NULL,
  `collected_amount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_projects_collection_list_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_road_name`
--

DROP TABLE IF EXISTS `wwjm_road_name`;
CREATE TABLE IF NOT EXISTS `wwjm_road_name` (
  `id` int NOT NULL AUTO_INCREMENT,
  `road_name` varchar(45) DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `main_user_login_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wwjm_road_name_main_user_login1_idx` (`main_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wwjm_subscription`
--

DROP TABLE IF EXISTS `wwjm_subscription`;
CREATE TABLE IF NOT EXISTS `wwjm_subscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genarate_date` date DEFAULT NULL,
  `sdt` timestamp NULL DEFAULT NULL,
  `ast` tinyint(1) DEFAULT NULL,
  `disption_pay` varchar(450) DEFAULT NULL,
  `crt_amount` double DEFAULT NULL,
  `dbt_amount` double DEFAULT NULL,
  `wwjm_member_list_id` int NOT NULL,
  `sms_send_state` tinyint(1) DEFAULT NULL,
  `email_send_state` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_wwjm_subscription_wwjm_member_list1_idx` (`wwjm_member_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Constraints for dumped tables
--


-- ============================================================================
-- CLEAN BMJM TEST/STARTER DATASET
-- Generated from the supplied bmjm(1).sql dump.
--
-- Preserved: all company/access-level/main-user-login/member records,
-- one road (id=1), one payment slip (id=1), its member-payment link,
-- and the directly associated income/expense ledger rows.
--
-- IMPORTANT: Member road references are normalized to road id=1 so that all
-- preserved member rows remain valid when only one road is retained.
-- ============================================================================

SET FOREIGN_KEY_CHECKS=0;
START TRANSACTION;

INSERT INTO `company` (`id`, `ast`) VALUES
(1, 1);

INSERT INTO `main_user_account_access_level_list` (`id`, `type_of_access`, `ast`, `sdt`, `url_home`, `dis`, `company_id`, `job_role`) VALUES
(1, 'admin', 1, '2026-08-25 10:28:00', NULL, NULL, 1, NULL),
(2, 'user', 1, '2026-08-25 10:31:09', NULL, NULL, 1, NULL);

INSERT INTO `main_user_login` (`id`, `user_name`, `password`, `account_active_state`, `ast`, `sdt`, `last_login`, `name_show`, `email_verify`, `moible_verfiy`, `very_first_login`, `cook_key`, `ref_key`, `temp_lock`, `full_block`, `ac_type`, `control_account_state`, `main_user_account_access_level_list_id`, `company_id`, `image_url`, `google_id`, `google_authentication_secret`, `is_google_authentication_enable`, `microsoft_id`, `first_name`, `last_name`, `phone_number`, `dis`, `is_two_factor_auth_enable`, `wrong_login_count`) VALUES
(1, 'ansif@neosolution.lk', 'YXk3a1M0K0RHeURhMFhDcnNBTndKQT09', 1, 1, '2026-08-25 06:59:07', '2026-08-25 06:59:07', 'Angelica Gallagher', 0, 0, 0, 'RUZPZ3dOT1NHd1pkcnlubmo5RUNOZz09', '6223402', 0, 0, 'Quia molestiae cum a', 0, 1, 1, '', '', NULL, 0, '', 'Angelica', 'Gallagher', '', '', 0, 1),
(2, 'a@a', 'YXk3a1M0K0RHeURhMFhDcnNBTndKQT09', 1, 1, '2026-08-25 07:00:31', '2026-08-25 07:00:31', 'Tasha Waters', 0, 0, 0, 'YXZ2cW54TVBkcW9OMlRzWlZnWlRVZz09', '4575464', 1, 0, 'A saepe voluptas con', 0, 2, 1, '', '', NULL, 0, '', 'Tasha', 'Waters', '', '', 0, 4),
(3, 'qanagov@mailinator.com', 'bXg1RGhjY3gzS0lORGNmRHhFY1VVZz09', 1, 1, '2026-08-25 07:10:01', '2026-08-25 07:10:01', 'Ulysses Lancaster', 0, 0, 0, '', '', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Ulysses Lancaster', '', '', '', 0, 1),
(4, 'jogi@mailinator.com', 'clZUazk0eHo5Z0pFTjk3OUs1eGc2dz09', 1, 1, '2026-08-28 00:23:10', '2026-08-28 00:23:10', 'Stacy Alvarez', 0, 0, 0, '', '', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Stacy Alvarez', '', '', '', 0, 0),
(5, 'w@gmail.com', 'SWpBVTFROG45eWE4VU5HYndEclFsZz09', 1, 1, '2026-08-28 00:48:02', '2026-08-28 00:48:02', 'Tanek Thompson cc', 0, 0, 0, 'NO_DATA', '1642823', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Tanek Thompson cc', '', '0789362885', '', 0, 2),
(6, 'kuqajyha@mailinator.com', 'cld6bElzSlkranJIcmtOYUFDS0NwQnROeEU1blRBYkduTXI0Vy9EV2FiVT0=', 1, 1, '2026-08-28 08:27:07', '2026-08-28 08:27:07', 'Ulysses Hayes', 0, 0, 0, '', '', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Ulysses Hayes', '', '', '', 0, 0),
(7, 'chathura.neosolution@gmail.com', 'UXFIY09xOXRuU3Y0cVZFaERpK0hhZz09', 1, 1, '2026-09-05 00:53:22', '2026-09-05 00:53:22', 'Chathura Kavindu', 0, 0, 0, 'MnNtR3VPNm9nb0Vibis5Unc3MUZhZz09', '7305242', 0, 1, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Chathura Kavindu', '', '', '', 0, 1),
(8, 'chathurakavindu15@gmail.com', 'WXJhWDFTekZXTnpycll3NGZLSFhBQT09', 1, 1, '2026-09-05 04:09:30', '2026-09-05 04:09:30', 'Chathura Kavindu', 0, 0, 0, 'NO_DATA', '1614240', 0, 0, 'aasss', 0, 1, 1, '', '', NULL, 0, '', 'Chathura', 'Kavindu', '', '', 0, 0),
(9, 'kavindubandara2018@gmail.com', 'aDl5OFY0T1VRNWxoUERiZ3ZydmFHUT09', 1, 1, '2026-09-05 04:13:14', '2026-09-05 04:13:14', 'Chathura Kavindu', 0, 0, 0, 'NO_DATA', '2544526', 0, 0, 'aasss', 0, 1, 1, '', '', NULL, 0, '', 'Chathura', 'Kavindu', '', '', 0, 1),
(10, 'pewevegi@mailinator.com', 'cTZaaXVFU3BsdktpSjR4SGVrV1plZz09', 1, 1, '2026-09-07 23:25:16', '2026-09-07 23:25:16', 'Hyatt Floyd', 0, 0, 0, 'NO_DATA', '3628474', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Hyatt', 'Floyd', '', '', 0, 0),
(11, 'testsignup0909@example.com', 'd2Jmekc3WE1JNGF1bEpjclk0dUJMUT09', 1, 1, '2026-09-09 04:30:38', '2026-09-09 04:30:38', 'Test Signup Member', 1, 0, 0, '', '', 0, 1, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Test Signup Member', '', '', '', 0, 0),
(12, 'dugaqy@mailinator.com', 'aSsyeWpMSjgveFdmV3h5dXd0Y0Nvdz09', 1, 1, '2026-09-09 04:32:17', '2026-09-09 04:32:17', 'Anjolie Bishop', 1, 0, 0, 'NO_DATA', '8258103', 0, 0, 'Member', 0, 2, 1, '', '', NULL, 0, '', 'Anjolie Bishop', '', '0789362880', '', 0, 0);

INSERT INTO `wwjm_road_name` (`id`, `road_name`, `ast`, `sdt`, `main_user_login_id`) VALUES
(1, 'road_01', 1, '2026-08-25 07:09:16', 1);

INSERT INTO `wwjm_member_list` (`id`, `ast`, `sdt`, `name_M`, `residence_address_M`, `is_own_house`, `is_rented_house`, `nic_M`, `email`, `notification_moible_no`, `secondry_mobile`, `notification_whatup`, `profession`, `monlty_payment`, `opening_balance`, `approve_level_01_state`, `approve_level_01_person`, `approve_level_01_sdt`, `approve_level_02_state`, `approve_level_02_person`, `approve_level_02_sdt`, `nofication_update_app`, `nofication_update_sms`, `nofication_update_email`, `due_to_pay`, `active_state`, `dis`, `membership_no`, `zakath_pay_state`, `account_type_zakath_payee`, `account_type_subcrption`, `account_type_zakath_reciver`, `self_account`, `is_login_avable`, `wwjm_road_name_id`, `main_user_login_id`) VALUES
(1, 1, '2026-08-25 07:10:01', 'Ulysses Lancaster', 'Et autem magna hic q', 1, 1, 'Voluptas voluptatem', 'qanagov@mailinator.com', '+1 (904) 539-2269', '+1 (707) 643-4542', '+1 (748) 904-9272', 'Consequatur adipisci', 10, 99, 1, 'Angelica Gallagher', '2026-08-25 07:10:01', 1, 'Angelica Gallagher', '2026-08-25 07:10:01', 0, 0, 0, -90, 1, '0', '00001', 1, 1, 1, 1, 0, 0, 1, 3),
(2, 1, '2026-08-28 00:23:10', 'Stacy Alvarez', 'In fugiat neque et', 0, 0, 'Maiores duis facilis', 'jogi@mailinator.com', '+1 (804) 349-9675', '+1 (323) 197-1571', '+1 (768) 915-9749', 'Sunt voluptatum vol', 10, 47, 1, 'Angelica Gallagher', '2026-08-28 00:23:10', 1, 'Angelica Gallagher', '2026-08-28 00:23:10', 0, 0, 0, 0, 1, '0', '00002', 1, 1, 0, 0, 0, 0, 1, 4),
(3, 1, '2026-08-28 00:48:02', 'Tanek Thompson cc', 'Ducimus in incidunt', 0, 1, '200123704050', 'w@gmail.com', '0789362885', '0789362885', '0789362885', 'Non sint fugiat sint', 1000.02, 40, 1, 'Angelica Gallagher', '2026-08-28 00:48:02', 1, 'Angelica Gallagher', '2026-08-28 00:48:02', 0, 0, 0, 1064, 1, '0', '00003', 0, 0, 1, 1, 0, 0, 1, 5),
(4, 1, '2026-08-28 08:27:07', 'Ulysses Hayes', 'Illum accusamus eli', 1, 0, 'Ut repudiandae ut do', 'kuqajyha@mailinator.com', '+1 (648) 183-5648', '+1 (482) 958-3383', '+1 (648) 183-5648', 'Et voluptatem ut qui', 10, 84, 1, 'Tanek Thompson', '2026-08-28 08:27:07', 1, 'Tanek Thompson', '2026-08-28 08:27:07', 0, 0, 0, -3323, 1, '0', '00004', 1, 1, 1, 1, 0, 0, 1, 6),
(5, 1, '2026-09-05 00:53:22', 'Chathura Kavindu', 'fffffffffffffffffffffffffff', 0, 1, '200401500019', 'chathura.neosolution@gmail.com', '0789362880', '0789362885', '0789362885', '', 10, 0, 1, 'Angelica Gallagher', '2026-09-05 00:53:22', 1, 'Angelica Gallagher', '2026-09-05 00:53:22', 0, 0, 0, 10, 1, '0', '00005', 0, 0, 1, 1, 0, 0, 1, 7),
(6, 1, '2026-09-09 04:30:38', 'Test Signup Member', '12 Test Lane, Colombo 06', 1, 0, '199509091234', 'testsignup0909@example.com', '0779988776', '0112345678', '0779988776', 'Engineer', 500, 0, 1, 'Angelica Gallagher', '2026-09-09 05:32:35', 1, 'Angelica Gallagher', '2026-09-09 06:38:33', 0, 0, 0, 500, 1, '0', '00006', 0, 0, 1, 0, 0, 0, 1, 11),
(7, 1, '2026-09-09 04:32:17', 'Anjolie Bishop', 'Animi dolor dolor r', 0, 1, '200401500020', 'dugaqy@mailinator.com', '0789362880', '0789362885', '0789362885', 'Nostrum quia et ex e', 1000, 0, 1, 'Angelica Gallagher', '2026-09-09 04:33:18', 1, 'Angelica Gallagher', '2026-09-09 04:33:20', 0, 0, 0, -200, 1, '0', '00007', 0, 0, 0, 1, 0, 0, 1, 12);

INSERT INTO `income_expence_type` (`id`, `ast`, `sdt`, `income_expence_type_name`, `is_income_type`, `is_expece_type`, `main_user_login_id`) VALUES
(1, 1, '2026-08-25 07:11:18', 'Subscription', 1, 0, 1);

INSERT INTO `wwjm_payment_slip` (`id`, `payment_date`, `ast`, `sdt`, `amount`, `dis`, `is_cash`, `is_bank_deposit`, `is_IPG`, `slip_print`, `pay_resion_subcption`, `pay_resion_donation`, `pay_resion_zakath`, `pay_resion_projects`, `is_member`, `main_user_login_id`, `person_name`, `address`, `membership_no`, `phone_number`, `email`) VALUES
(1, '2026-08-25', 1, '2026-08-25 07:11:18', 100, '0', 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 'Ulysses Lancaster', 'Et autem magna hic q', '00001', '+1 (904) 539-2269', 'qanagov@mailinator.com');

INSERT INTO `wwjm_member_payment_slilp` (`id`, `ast`, `sdt`, `wwjm_member_list_id`, `wwjm_payment_slip_id`) VALUES
(1, 1, '2026-08-25 07:11:18', 1, 1);

INSERT INTO `income_expence_data` (`id`, `ast`, `sdt`, `date_of_doc`, `is_type_income`, `is_type_expece`, `finish_state`, `total_amount`, `main_user_login_id`, `dis`) VALUES
(1, 1, '2026-08-25 07:11:18', '2026-08-25', 1, 0, 1, 100, 1, 'Member Auto Subscription (Slip #1)');

INSERT INTO `income_expence_data_info_list` (`id`, `ast`, `sdt`, `is_type_of_income`, `is_type_of_expence`, `dis`, `amount`, `main_user_login_id`, `income_expence_data_id`, `income_expence_type_id`) VALUES
(1, 1, '2026-08-25 07:11:18', 1, 0, 'Member Subscription Payment', 100, 1, 1, 1);

-- Reset AUTO_INCREMENT counters for the retained records.
ALTER TABLE `company` AUTO_INCREMENT = 2;
ALTER TABLE `main_user_account_access_level_list` AUTO_INCREMENT = 3;
ALTER TABLE `main_user_login` AUTO_INCREMENT = 13;
ALTER TABLE `wwjm_road_name` AUTO_INCREMENT = 2;
ALTER TABLE `wwjm_member_list` AUTO_INCREMENT = 8;
ALTER TABLE `income_expence_type` AUTO_INCREMENT = 2;
ALTER TABLE `wwjm_payment_slip` AUTO_INCREMENT = 2;
ALTER TABLE `wwjm_member_payment_slilp` AUTO_INCREMENT = 2;
ALTER TABLE `income_expence_data` AUTO_INCREMENT = 2;
ALTER TABLE `income_expence_data_info_list` AUTO_INCREMENT = 2;

--
-- Constraints for table `audit_trail_report`
--
ALTER TABLE `audit_trail_report`
  ADD CONSTRAINT `fk_audit_trail_report_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_audit_tral_report_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  ADD CONSTRAINT `fk_bank_account_details_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `bank_deposit_data_history`
--
ALTER TABLE `bank_deposit_data_history`
  ADD CONSTRAINT `fk_bank_deposit_data_history_bank_account_details1` FOREIGN KEY (`bank_account_details_id`) REFERENCES `bank_account_details` (`id`),
  ADD CONSTRAINT `fk_bank_deposit_data_history_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_bank_deposit_data_history_wwjm_bank_deposit_slip1` FOREIGN KEY (`wwjm_bank_deposit_slip_id`) REFERENCES `wwjm_bank_deposit_slip` (`id`),
  ADD CONSTRAINT `fk_bank_deposit_data_history_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`);

--
-- Constraints for table `collection_bank_account`
--
ALTER TABLE `collection_bank_account`
  ADD CONSTRAINT `fk_collection_bank_account_bank_account_details1` FOREIGN KEY (`bank_account_details_id`) REFERENCES `bank_account_details` (`id`),
  ADD CONSTRAINT `fk_collection_bank_account_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_collection_bank_account_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`);

--
-- Constraints for table `collection_ticket_tiers`
--
ALTER TABLE `collection_ticket_tiers`
  ADD CONSTRAINT `fk_collection_ticket_tiers_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_collection_ticket_tiers_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`);

--
-- Constraints for table `contact_person_list`
--
ALTER TABLE `contact_person_list`
  ADD CONSTRAINT `fk_contact_person_list_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `department_email_history`
--
ALTER TABLE `department_email_history`
  ADD CONSTRAINT `fk_department_email_history_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `department_email_notification`
--
ALTER TABLE `department_email_notification`
  ADD CONSTRAINT `fk_department_email_notification_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `department_email_notification_has_email_history`
--
ALTER TABLE `department_email_notification_has_email_history`
  ADD CONSTRAINT `fk_department_email_notification_has_email_history_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_department_email_notification_has_email_history_department1` FOREIGN KEY (`department_email_notification_id`) REFERENCES `department_email_notification` (`id`),
  ADD CONSTRAINT `fk_department_email_notification_has_email_history_department2` FOREIGN KEY (`department_email_history_id`) REFERENCES `department_email_history` (`id`);

--
-- Constraints for table `email_sms_link_manament`
--
ALTER TABLE `email_sms_link_manament`
  ADD CONSTRAINT `fk_Email_SMS_link_manament_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `fk_Email_SMS_link_manament_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `email_sms_link_view_history`
--
ALTER TABLE `email_sms_link_view_history`
  ADD CONSTRAINT `fk_Email_SMS_link_view_history_Email_SMS_link_manament1` FOREIGN KEY (`Email_SMS_link_manament_id`) REFERENCES `email_sms_link_manament` (`id`);

--
-- Constraints for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD CONSTRAINT `fk_employee_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_employee_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `emp_supporting_doc_list`
--
ALTER TABLE `emp_supporting_doc_list`
  ADD CONSTRAINT `fk_emp_supporting_doc_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `emp_support_doc_img_pth_list`
--
ALTER TABLE `emp_support_doc_img_pth_list`
  ADD CONSTRAINT `fk_emp_support_doc_img_pth_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_emp_support_doc_img_pth_list_emp_supporting_doc_list2` FOREIGN KEY (`emp_supporting_doc_list_id`) REFERENCES `emp_supporting_doc_list` (`id`),
  ADD CONSTRAINT `fk_emp_support_doc_img_pth_list_employee_list2` FOREIGN KEY (`employee_list_id`) REFERENCES `employee_list` (`id`);

--
-- Constraints for table `emp_variable_anwer_list`
--
ALTER TABLE `emp_variable_anwer_list`
  ADD CONSTRAINT `fk_emp_variable_anwer_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_emp_variable_anwer_list_emp_variable_list2` FOREIGN KEY (`emp_variable_list_id`) REFERENCES `emp_variable_list` (`id`),
  ADD CONSTRAINT `fk_emp_variable_anwer_list_employee_list2` FOREIGN KEY (`employee_list_id`) REFERENCES `employee_list` (`id`);

--
-- Constraints for table `emp_variable_list`
--
ALTER TABLE `emp_variable_list`
  ADD CONSTRAINT `fk_emp_variable_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `fcm_tokens`
--
ALTER TABLE `fcm_tokens`
  ADD CONSTRAINT `fk_fcm_tokens_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `income_expence_data`
--
ALTER TABLE `income_expence_data`
  ADD CONSTRAINT `fk_income_expence_data_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `income_expence_data_info_list`
--
ALTER TABLE `income_expence_data_info_list`
  ADD CONSTRAINT `fk_income_expence_data_info_list_income_expence_data1` FOREIGN KEY (`income_expence_data_id`) REFERENCES `income_expence_data` (`id`),
  ADD CONSTRAINT `fk_income_expence_data_info_list_income_expence_type1` FOREIGN KEY (`income_expence_type_id`) REFERENCES `income_expence_type` (`id`),
  ADD CONSTRAINT `fk_income_expence_data_info_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `income_expence_type`
--
ALTER TABLE `income_expence_type`
  ADD CONSTRAINT `fk_income_expence_type_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `main_user_account_access_level_list`
--
ALTER TABLE `main_user_account_access_level_list`
  ADD CONSTRAINT `fk_main_user_account_access_level_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `main_user_login`
--
ALTER TABLE `main_user_login`
  ADD CONSTRAINT `fk_main_user_login_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_main_user_login_main_user_account_access_level_list1` FOREIGN KEY (`main_user_account_access_level_list_id`) REFERENCES `main_user_account_access_level_list` (`id`);

--
-- Constraints for table `main_user_login_device`
--
ALTER TABLE `main_user_login_device`
  ADD CONSTRAINT `fk_main_user_login_device_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `main_user_login_email_list`
--
ALTER TABLE `main_user_login_email_list`
  ADD CONSTRAINT `fk_main_user_login_email_list_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `fk_main_user_login_email_list_main_user_login2` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `main_user_login_has_ipg_list`
--
ALTER TABLE `main_user_login_has_ipg_list`
  ADD CONSTRAINT `fk_main_user_login_has_IPG_List_IPG_List1` FOREIGN KEY (`IPG_List_id`) REFERENCES `ipg_list` (`id`),
  ADD CONSTRAINT `fk_main_user_login_has_IPG_List_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `main_user_login_has_ipg_send_by_url`
--
ALTER TABLE `main_user_login_has_ipg_send_by_url`
  ADD CONSTRAINT `fk_main_user_login_has_IPG_Send_By_URL_IPG_Send_By_URL1` FOREIGN KEY (`IPG_Send_By_URL_id`) REFERENCES `ipg_send_by_url` (`id`),
  ADD CONSTRAINT `fk_main_user_login_has_IPG_Send_By_URL_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `main_user_password_reset_otp`
--
ALTER TABLE `main_user_password_reset_otp`
  ADD CONSTRAINT `fk_main_user_password_reset_otp_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `management_notification`
--
ALTER TABLE `management_notification`
  ADD CONSTRAINT `fk_management_notification_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_management_notification_management_person_list1` FOREIGN KEY (`management_person_list_id`) REFERENCES `management_person_list` (`id`),
  ADD CONSTRAINT `fk_management_notification_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `management_person_list`
--
ALTER TABLE `management_person_list`
  ADD CONSTRAINT `fk_management_person_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_management_person_list_management_position_list1` FOREIGN KEY (`management_position_list_id`) REFERENCES `management_position_list` (`id`);

--
-- Constraints for table `management_position_list`
--
ALTER TABLE `management_position_list`
  ADD CONSTRAINT `fk_management_position_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `notification_inbox`
--
ALTER TABLE `notification_inbox`
  ADD CONSTRAINT `fk_notification_inbox_notifications1` FOREIGN KEY (`notifications_id`) REFERENCES `notifications` (`id`),
  ADD CONSTRAINT `fk_notification_inbox_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `recommended_person_data`
--
ALTER TABLE `recommended_person_data`
  ADD CONSTRAINT `fk_recommended_person_data_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_recommended_person_data_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `ticket_transactions`
--
ALTER TABLE `ticket_transactions`
  ADD CONSTRAINT `fk_ticket_transactions_collection_ticket_tiers1` FOREIGN KEY (`collection_ticket_tiers_id`) REFERENCES `collection_ticket_tiers` (`id`),
  ADD CONSTRAINT `fk_ticket_transactions_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`),
  ADD CONSTRAINT `fk_ticket_transactions_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`);

--
-- Constraints for table `wwjm_bank_deposit_slip`
--
ALTER TABLE `wwjm_bank_deposit_slip`
  ADD CONSTRAINT `fk_wwjm_bank_deposit_slip_bank_account_details1` FOREIGN KEY (`bank_account_details_id`) REFERENCES `bank_account_details` (`id`),
  ADD CONSTRAINT `fk_wwjm_bank_deposit_slip_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_wwjm_bank_deposit_slip_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`);

--
-- Constraints for table `wwjm_collection_payments`
--
ALTER TABLE `wwjm_collection_payments`
  ADD CONSTRAINT `fk_wwjm_collection_payments_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`),
  ADD CONSTRAINT `fk_wwjm_collection_payments_wwjm_projects_collection_list1` FOREIGN KEY (`wwjm_projects_collection_list_id`) REFERENCES `wwjm_projects_collection_list` (`id`);

--
-- Constraints for table `wwjm_member_list`
--
ALTER TABLE `wwjm_member_list`
  ADD CONSTRAINT `fk_wwjm_member_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_wwjm_member_list_wwjm_road_name1` FOREIGN KEY (`wwjm_road_name_id`) REFERENCES `wwjm_road_name` (`id`);

--
-- Constraints for table `wwjm_member_list_has_ipg_list`
--
ALTER TABLE `wwjm_member_list_has_ipg_list`
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_List_IPG_List1` FOREIGN KEY (`IPG_List_id`) REFERENCES `ipg_list` (`id`),
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_List_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `wwjm_member_list_has_ipg_send_by_url`
--
ALTER TABLE `wwjm_member_list_has_ipg_send_by_url`
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_Send_By_URL_IPG_Send_By_URL1` FOREIGN KEY (`IPG_Send_By_URL_id`) REFERENCES `ipg_send_by_url` (`id`),
  ADD CONSTRAINT `fk_wwjm_member_list_has_IPG_Send_By_URL_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `wwjm_member_list_has_main_user_login`
--
ALTER TABLE `wwjm_member_list_has_main_user_login`
  ADD CONSTRAINT `fk_wwjm_member_list_has_main_user_login_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_wwjm_member_list_has_main_user_login_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `wwjm_member_list_has_management_person_list`
--
ALTER TABLE `wwjm_member_list_has_management_person_list`
  ADD CONSTRAINT `fk_wwjm_member_list_has_management_person_list_management_per1` FOREIGN KEY (`management_person_list_id`) REFERENCES `management_person_list` (`id`),
  ADD CONSTRAINT `fk_wwjm_member_list_has_management_person_list_wwjm_member_li1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `wwjm_member_list_user_login`
--
ALTER TABLE `wwjm_member_list_user_login`
  ADD CONSTRAINT `fk_wwjm_member_list_user_login_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`),
  ADD CONSTRAINT `fk_wwjm_member_list_user_login_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

--
-- Constraints for table `wwjm_member_old_list`
--
ALTER TABLE `wwjm_member_old_list`
  ADD CONSTRAINT `fk_wwjm_member_old_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `wwjm_member_payment_slilp`
--
ALTER TABLE `wwjm_member_payment_slilp`
  ADD CONSTRAINT `fk_wwjm_member_payment_slilp_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`),
  ADD CONSTRAINT `fk_wwjm_member_payment_slilp_wwjm_payment_slip1` FOREIGN KEY (`wwjm_payment_slip_id`) REFERENCES `wwjm_payment_slip` (`id`);

--
-- Constraints for table `wwjm_payment_slip`
--
ALTER TABLE `wwjm_payment_slip`
  ADD CONSTRAINT `fk_wwjm_payment_slip_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `wwjm_projects_collection_list`
--
ALTER TABLE `wwjm_projects_collection_list`
  ADD CONSTRAINT `fk_wwjm_projects_collection_list_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `wwjm_road_name`
--
ALTER TABLE `wwjm_road_name`
  ADD CONSTRAINT `fk_wwjm_road_name_main_user_login1` FOREIGN KEY (`main_user_login_id`) REFERENCES `main_user_login` (`id`);

--
-- Constraints for table `wwjm_subscription`
--
ALTER TABLE `wwjm_subscription`
  ADD CONSTRAINT `fk_wwjm_subscription_wwjm_member_list1` FOREIGN KEY (`wwjm_member_list_id`) REFERENCES `wwjm_member_list` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


COMMIT;
SET FOREIGN_KEY_CHECKS=1;

-- Verification: these counts should reflect the retained starter data.
SELECT COUNT(*) AS main_user_login_count FROM `main_user_login`;
SELECT COUNT(*) AS member_count FROM `wwjm_member_list`;
SELECT COUNT(*) AS road_count FROM `wwjm_road_name`;
SELECT COUNT(*) AS payment_count FROM `wwjm_payment_slip`;
SELECT COUNT(*) AS member_payment_link_count FROM `wwjm_member_payment_slilp`;
