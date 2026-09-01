SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

-- =====================================================
-- 1. التأكد من إنشاء الجداول الجديدة مع الاحتفاظ بالبيانات إن وُجدت
-- =====================================================

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`applications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `application_type` enum('job','cadres') NOT NULL DEFAULT 'job',
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rejection_reason` text NULL,
  `first_name` varchar(191) NULL DEFAULT NULL,
  `last_name` varchar(191) NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `gender` enum('male','female') NULL DEFAULT NULL,
  `phone` varchar(191) NULL DEFAULT NULL,
  `email` varchar(191) NULL DEFAULT NULL,
  `nationality` varchar(191) NULL DEFAULT NULL,
  `passport_number` varchar(191) NULL DEFAULT NULL,
  `passport_expiry` date NULL DEFAULT NULL,
  `passport_country` varchar(191) NULL DEFAULT NULL,
  `photo` varchar(191) NULL DEFAULT NULL,
  `certificate` varchar(191) NULL DEFAULT NULL,
  `education_level` enum('high_school','diploma','bachelor','master','phd','other') NULL DEFAULT NULL,
  `specialization` varchar(191) NULL DEFAULT NULL,
  `origin_country` varchar(191) NULL DEFAULT NULL,
  `target_countries` longtext NULL,
  `job_title_desired` varchar(191) NULL DEFAULT NULL,
  `desired_job_type` enum('full_time','part_time','remote','freelance') NULL DEFAULT NULL,
  `expected_salary_min` decimal(10, 2) NULL DEFAULT NULL,
  `expected_salary_max` decimal(10, 2) NULL DEFAULT NULL,
  `notes` text NULL,
  `country` varchar(191) NULL DEFAULT NULL,
  `city` varchar(191) NULL DEFAULT NULL,
  `father_name` varchar(191) NULL DEFAULT NULL,
  `country_code` varchar(10) NULL DEFAULT NULL,
  `work_country` varchar(191) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`bs_company_profiles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NULL DEFAULT NULL,
  `commercial_registration` varchar(191) NULL DEFAULT NULL,
  `address` varchar(191) NULL DEFAULT NULL,
  `email` varchar(191) NULL DEFAULT NULL,
  `phone` varchar(191) NULL DEFAULT NULL,
  `manager_name` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`bs_contract_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `bs_contract_types_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`bs_contract_clauses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `contract_type_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NULL,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bs_contract_clauses_contract_type_id_foreign`(`contract_type_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`bs_contracts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` varchar(191) NOT NULL,
  `contract_type_id` bigint UNSIGNED NULL DEFAULT NULL,
  `price` decimal(12, 2) NOT NULL DEFAULT 0.00,
  `clauses_json` longtext NULL,
  `party_name` varchar(191) NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bs_contracts_contract_type_id_foreign`(`contract_type_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`commercial_agencies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `name_en` varchar(191) NULL DEFAULT NULL,
  `logo` varchar(191) NULL DEFAULT NULL,
  `category` varchar(191) NOT NULL,
  `description` text NULL,
  `description_en` text NULL,
  `country_origin` varchar(191) NOT NULL DEFAULT 'السعودية',
  `available_regions` longtext NULL,
  `agency_type` enum('exclusive_agent','distributor','strategic_partner','reseller','certified_dealer') NOT NULL DEFAULT 'exclusive_agent',
  `investment_min` bigint UNSIGNED NOT NULL DEFAULT 0,
  `investment_max` bigint UNSIGNED NOT NULL DEFAULT 0,
  `min_years_experience` smallint UNSIGNED NOT NULL DEFAULT 0,
  `requirements` longtext NULL,
  `benefits` longtext NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('active','inactive','draft') NOT NULL DEFAULT 'active',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`consultant_bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultant_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `timezone` varchar(191) NOT NULL DEFAULT 'Asia/Riyadh',
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text NULL,
  `cancellation_reason` text NULL,
  `amount` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `payment_status` varchar(191) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(191) NULL DEFAULT NULL,
  `transaction_id` varchar(191) NULL DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `is_reminder_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `consultant_bookings_consultant_id_booking_date_index`(`consultant_id` ASC, `booking_date` ASC) USING BTREE,
  INDEX `consultant_bookings_user_id_status_index`(`user_id` ASC, `status` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`consultant_reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultant_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NULL DEFAULT NULL,
  `rating` int NOT NULL DEFAULT 5,
  `comment` text NULL,
  `criteria_ratings` longtext NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `consultant_reviews_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `consultant_reviews_consultant_id_rating_index`(`consultant_id` ASC, `rating` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`consultant_skill` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultant_id` bigint UNSIGNED NOT NULL,
  `skill_id` bigint UNSIGNED NOT NULL,
  `proficiency_level` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `consultant_skill_skill_id_foreign`(`skill_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`consultant_specialty` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultant_id` bigint UNSIGNED NOT NULL,
  `specialty_id` bigint UNSIGNED NOT NULL,
  `years_of_experience` int NULL DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `consultant_specialty_specialty_id_foreign`(`specialty_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`consultants` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NULL DEFAULT NULL,
  `title` varchar(191) NULL DEFAULT NULL,
  `bio` text NULL,
  `bio_en` text NULL,
  `city` varchar(191) NULL DEFAULT NULL,
  `country` varchar(191) NOT NULL DEFAULT 'السعودية',
  `experience_years` int NOT NULL DEFAULT 0,
  `qualifications` longtext NULL,
  `languages` longtext NULL,
  `certificates` longtext NULL,
  `profile_photo` varchar(191) NULL DEFAULT NULL,
  `cover_photo` varchar(191) NULL DEFAULT NULL,
  `rating` decimal(3, 2) NOT NULL DEFAULT 0.00,
  `reviews_count` int NOT NULL DEFAULT 0,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'pending',
  `availability` enum('available','busy','unavailable','on_leave') NOT NULL DEFAULT 'available',
  `consultation_fee` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `working_hours` longtext NULL,
  `slug` varchar(191) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `consultants_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `consultants_status_availability_index`(`status` ASC, `availability` ASC) USING BTREE,
  INDEX `consultants_city_index`(`city` ASC) USING BTREE,
  INDEX `consultants_rating_index`(`rating` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`franchise_applications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `opportunity_id` bigint UNSIGNED NULL DEFAULT NULL,
  `brand_name` varchar(191) NULL DEFAULT NULL,
  `full_name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `region` varchar(191) NULL DEFAULT NULL,
  `capital_range` varchar(191) NULL DEFAULT NULL,
  `has_experience` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text NULL,
  `status` enum('pending','reviewing','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `franchise_applications_opportunity_id_foreign`(`opportunity_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`officiant_bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `officiant_id` bigint UNSIGNED NOT NULL,
  `officiant_service_id` bigint UNSIGNED NULL DEFAULT NULL,
  `event_date` date NOT NULL,
  `phone` varchar(20) NULL DEFAULT NULL,
  `notes` text NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `officiant_bookings_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `officiant_bookings_officiant_id_foreign`(`officiant_id` ASC) USING BTREE,
  INDEX `officiant_bookings_officiant_service_id_foreign`(`officiant_service_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`officiant_media` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `officiant_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(191) NOT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `officiant_media_officiant_id_foreign`(`officiant_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`officiant_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `officiant_id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `officiant_services_officiant_id_foreign`(`officiant_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`officiants` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `license_number` varchar(60) NULL DEFAULT NULL,
  `working_hours` varchar(100) NULL DEFAULT NULL,
  `bank_account` varchar(60) NULL DEFAULT NULL,
  `iban` varchar(34) NULL DEFAULT NULL,
  `city` varchar(100) NULL DEFAULT NULL,
  `neighborhood` varchar(100) NULL DEFAULT NULL,
  `street` varchar(150) NULL DEFAULT NULL,
  `country` varchar(100) NULL DEFAULT NULL,
  `address` varchar(255) NULL DEFAULT NULL,
  `bio` text NULL,
  `profile_photo` varchar(191) NULL DEFAULT NULL,
  `cover_photo` varchar(191) NULL DEFAULT NULL,
  `phone` varchar(20) NULL DEFAULT NULL,
  `manager_first_name` varchar(60) NULL DEFAULT NULL,
  `manager_father_name` varchar(60) NULL DEFAULT NULL,
  `manager_grandfather_name` varchar(60) NULL DEFAULT NULL,
  `manager_phone` varchar(20) NULL DEFAULT NULL,
  `rep_first_name` varchar(60) NULL DEFAULT NULL,
  `rep_father_name` varchar(60) NULL DEFAULT NULL,
  `rep_grandfather_name` varchar(60) NULL DEFAULT NULL,
  `status` enum('pending','active','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `officiants_user_id_foreign`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`skills` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NULL DEFAULT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'fa-star',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `amrtmco_business_old`.`specialties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NULL DEFAULT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'fa-briefcase',
  `description` text NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- =====================================================
-- 2. تحويل المحركات لـ InnoDB مع الحفاظ على البيانات
-- =====================================================

ALTER TABLE `amrtmco_business_old`.`additional_features` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`agent_ref_codes` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`bs_categories` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`bs_entities` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`bs_office_services` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`bs_office_users` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`bs_payments` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`bs_request_logs` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`bs_services` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`business_notifications` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`cache` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`cache_locks` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`cart_items` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`carts` ENGINE = InnoDB, ROW_FORMAT = Dynamic;
ALTER TABLE `amrtmco_business_old`.`categories` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`entities` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`failed_jobs` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`franchise_auctions` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`franchise_bids` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`franchise_brand_images` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`franchise_opportunity_steps` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`gov_services` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`hall_bookings` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`hall_busy_dates` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`hall_features` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`hall_media` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`hall_partners` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`hall_seasonal_prices` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`hall_verification_documents` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`halls` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`job_batches` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`jobs` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`migrations` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`order_items` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`orders` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`page_sliders` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`partner_categories` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`partner_media` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`partner_services` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`partners` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`password_reset_tokens` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`referrals` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`request_logs` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`service_bookings` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`service_payments` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`sessions` ENGINE = InnoDB;
ALTER TABLE `amrtmco_business_old`.`users` ENGINE = InnoDB;

SET FOREIGN_KEY_CHECKS = 1;
