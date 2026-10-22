-- Orion Clinic Database Schema & Initial Data
-- Generated for Orion Clinic Telemedicine System (CodeIgniter 4)
-- Compatible with MySQL 5.7+, MySQL 8.0+, MariaDB 10.3+

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `orionclinic` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `orionclinic`;

-- --------------------------------------------------------
-- Table structure for `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'patient',
  `phone` VARCHAR(20) DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `patients`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `date_of_birth` DATE DEFAULT NULL,
  `gender` ENUM('male','female') NOT NULL DEFAULT 'male',
  `blood_type` VARCHAR(5) DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `allergies` TEXT DEFAULT NULL,
  `pre_existing_conditions` TEXT DEFAULT NULL,
  `emergency_contact` VARCHAR(100) DEFAULT NULL,
  `emergency_contact_phone` VARCHAR(20) DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_patients_user_id` (`user_id`),
  CONSTRAINT `fk_patients_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `doctors`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `specialization` VARCHAR(100) NOT NULL,
  `experience_years` INT(11) NOT NULL DEFAULT 0,
  `str_number` VARCHAR(100) DEFAULT NULL,
  `sip_number` VARCHAR(100) DEFAULT NULL,
  `consultation_fee` DECIMAL(15,2) NOT NULL DEFAULT 0.00,
  `is_verified` TINYINT(1) NOT NULL DEFAULT 0,
  `status` ENUM('online','offline','busy') NOT NULL DEFAULT 'offline',
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_doctors_user_id` (`user_id`),
  CONSTRAINT `fk_doctors_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `doctor_schedules`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `doctor_schedules`;
CREATE TABLE `doctor_schedules` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` INT(11) UNSIGNED NOT NULL,
  `day_of_week` VARCHAR(20) NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schedules_doctor_id` (`doctor_id`),
  CONSTRAINT `fk_schedules_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `specializations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `specializations`;
CREATE TABLE `specializations` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `family_members`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `family_members`;
CREATE TABLE `family_members` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `relation` VARCHAR(50) NOT NULL,
  `date_of_birth` DATE DEFAULT NULL,
  `gender` ENUM('male','female') NOT NULL DEFAULT 'male',
  `blood_type` VARCHAR(5) DEFAULT NULL,
  `allergies` TEXT DEFAULT NULL,
  `pre_existing_conditions` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_family_user_id` (`user_id`),
  CONSTRAINT `fk_family_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `appointments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patient_id` INT(11) UNSIGNED NOT NULL,
  `doctor_id` INT(11) UNSIGNED NOT NULL,
  `appointment_date` DATE NOT NULL,
  `time_slot` TIME NOT NULL,
  `reason` TEXT DEFAULT NULL,
  `queue_number` VARCHAR(50) DEFAULT NULL,
  `status` ENUM('unpaid','pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'unpaid',
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_appointments_patient_id` (`patient_id`),
  KEY `fk_appointments_doctor_id` (`doctor_id`),
  CONSTRAINT `fk_appointments_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_appointments_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `consultations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `consultations`;
CREATE TABLE `consultations` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointment_id` INT(11) UNSIGNED NOT NULL,
  `doctor_notes` TEXT DEFAULT NULL,
  `diagnosis` TEXT DEFAULT NULL,
  `status` ENUM('active','ended') NOT NULL DEFAULT 'active',
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_consultations_appointment_id` (`appointment_id`),
  CONSTRAINT `fk_consultations_appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `messages`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultation_id` INT(11) UNSIGNED NOT NULL,
  `sender_id` INT(11) UNSIGNED NOT NULL,
  `message` TEXT NOT NULL,
  `attachment_path` VARCHAR(255) DEFAULT NULL,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_consultation_id` (`consultation_id`),
  KEY `fk_messages_sender_id` (`sender_id`),
  CONSTRAINT `fk_messages_consultation_id` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_messages_sender_id` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `prescriptions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE `prescriptions` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultation_id` INT(11) UNSIGNED NOT NULL,
  `status` ENUM('issued','redeemed','preparing','ready','completed') NOT NULL DEFAULT 'issued',
  `notes` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prescriptions_consultation_id` (`consultation_id`),
  CONSTRAINT `fk_prescriptions_consultation_id` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `prescription_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `prescription_items`;
CREATE TABLE `prescription_items` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prescription_id` INT(11) UNSIGNED NOT NULL,
  `medicine_name` VARCHAR(255) NOT NULL,
  `dosage` VARCHAR(100) NOT NULL,
  `frequency` VARCHAR(100) NOT NULL,
  `duration` VARCHAR(100) NOT NULL,
  `quantity` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_items_prescription_id` (`prescription_id`),
  CONSTRAINT `fk_items_prescription_id` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `medical_records`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `medical_records`;
CREATE TABLE `medical_records` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patient_id` INT(11) UNSIGNED NOT NULL,
  `consultation_id` INT(11) UNSIGNED DEFAULT NULL,
  `blood_pressure` VARCHAR(20) DEFAULT NULL,
  `weight` DECIMAL(5,2) DEFAULT NULL,
  `height` DECIMAL(5,2) DEFAULT NULL,
  `summary` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_records_patient_id` (`patient_id`),
  KEY `fk_records_consultation_id` (`consultation_id`),
  CONSTRAINT `fk_records_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_records_consultation_id` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `payments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointment_id` INT(11) UNSIGNED NOT NULL,
  `type` ENUM('consultation','prescription') NOT NULL DEFAULT 'consultation',
  `amount` DECIMAL(10,2) NOT NULL,
  `payment_method` VARCHAR(50) DEFAULT NULL,
  `status` ENUM('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `payment_date` DATETIME DEFAULT NULL,
  `bukti_transfer` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payments_appointment_id` (`appointment_id`),
  CONSTRAINT `fk_payments_appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `notifications`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `type` VARCHAR(50) NOT NULL DEFAULT 'system',
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_user_id` (`user_id`),
  CONSTRAINT `fk_notifications_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `audit_logs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED DEFAULT NULL,
  `action` VARCHAR(100) NOT NULL,
  `details` TEXT DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_user_id` (`user_id`),
  CONSTRAINT `fk_audit_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `migrations` (CodeIgniter Migration Tracking)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` VARCHAR(255) NOT NULL,
  `class` VARCHAR(255) NOT NULL,
  `group` VARCHAR(255) NOT NULL,
  `namespace` VARCHAR(255) NOT NULL,
  `time` INT(11) NOT NULL,
  `batch` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Migration History so CI4 Spark won't duplicate runs
INSERT INTO `migrations` (`version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
('2026-04-15-163546', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-06-11-143315', 'App\\Database\\Migrations\\CreateTelemedicineTables', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-06-22-012519', 'App\\Database\\Migrations\\CreateDoctorSchedulesTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-06-23-100000', 'App\\Database\\Migrations\\CreateSpecializationsFamilyAuditTables', 'default', 'App', UNIX_TIMESTAMP(), 1);

-- --------------------------------------------------------
-- Initial Data Seeding
-- --------------------------------------------------------

-- 1. Specializations
INSERT INTO `specializations` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dokter Umum', 'Konsultasi keluhan umum dan rujukan awal.', NOW(), NOW()),
(2, 'Spesialis Anak (Sp.A)', 'Kesehatan bayi, anak, dan tumbuh kembang.', NOW(), NOW()),
(3, 'Spesialis Jantung (Sp.JP)', 'Kesehatan kardiovaskular dan sirkulasi darah.', NOW(), NOW()),
(4, 'Spesialis Penyakit Dalam (Sp.PD)', 'Organ internal dewasa dan metabolik.', NOW(), NOW()),
(5, 'Spesialis Kulit & Kelamin (Sp.KK)', 'Kesehatan kulit, rambut, dan alergi.', NOW(), NOW());

-- 2. Users (Passwords: admin123, farmasi123, password123)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Administrator Orion', 'admin@clinic.com', '$2y$12$zZNdhUD22QpT8PTtA5rAWeX0NNDEELfVGotG20dU4ie6jqiF6u46y', 'admin', '081100000001', NOW(), NOW()),
(2, 'Apoteker Orion Farma', 'farmasi@clinic.com', '$2y$12$wCgrQYyg0HPoQpG8JAiXA./jnf5g9MfPTiYVMNvYvNleeG60YJ5cC', 'farmasi', '081100000002', NOW(), NOW()),
(3, 'Dr. Sarah Wijaya', 'sarah@clinic.com', '$2y$12$SXYD0Pd.C571ew.sDber1.cKD5B7VNzojgJdIP79Tu4Wz5/DoLBy6', 'doctor', '081234567890', NOW(), NOW()),
(4, 'Dr. Andi Pratama, Sp.A', 'andi@clinic.com', '$2y$12$SXYD0Pd.C571ew.sDber1.cKD5B7VNzojgJdIP79Tu4Wz5/DoLBy6', 'doctor', '081234567891', NOW(), NOW()),
(5, 'Dr. Maya Sari, Sp.JP', 'maya@clinic.com', '$2y$12$SXYD0Pd.C571ew.sDber1.cKD5B7VNzojgJdIP79Tu4Wz5/DoLBy6', 'doctor', '081234567892', NOW(), NOW()),
(6, 'Budi Santoso', 'budi@gmail.com', '$2y$12$SXYD0Pd.C571ew.sDber1.cKD5B7VNzojgJdIP79Tu4Wz5/DoLBy6', 'patient', '089988776655', NOW(), NOW());

-- 3. Doctor Profiles
INSERT INTO `doctors` (`id`, `user_id`, `specialization`, `experience_years`, `str_number`, `sip_number`, `consultation_fee`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dokter Umum', 6, 'STR123456', 'SIP123456', 50000.00, 1, 'online', NOW(), NOW()),
(2, 4, 'Spesialis Anak (Sp.A)', 12, 'STR234567', 'SIP234567', 100000.00, 1, 'online', NOW(), NOW()),
(3, 5, 'Spesialis Jantung (Sp.JP)', 15, 'STR345678', 'SIP345678', 150000.00, 1, 'offline', NOW(), NOW());

-- 4. Doctor Schedules (Senin - Jumat)
INSERT INTO `doctor_schedules` (`doctor_id`, `day_of_week`, `start_time`, `end_time`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Senin', '08:00:00', '16:00:00', 1, NOW(), NOW()),
(1, 'Selasa', '08:00:00', '16:00:00', 1, NOW(), NOW()),
(1, 'Rabu', '08:00:00', '16:00:00', 1, NOW(), NOW()),
(1, 'Kamis', '08:00:00', '16:00:00', 1, NOW(), NOW()),
(1, 'Jumat', '08:00:00', '16:00:00', 1, NOW(), NOW()),
(2, 'Senin', '09:00:00', '15:00:00', 1, NOW(), NOW()),
(2, 'Rabu', '09:00:00', '15:00:00', 1, NOW(), NOW()),
(2, 'Jumat', '09:00:00', '15:00:00', 1, NOW(), NOW()),
(3, 'Selasa', '10:00:00', '17:00:00', 1, NOW(), NOW()),
(3, 'Kamis', '10:00:00', '17:00:00', 1, NOW(), NOW());

-- 5. Patient Profile
INSERT INTO `patients` (`id`, `user_id`, `date_of_birth`, `gender`, `blood_type`, `address`, `allergies`, `pre_existing_conditions`, `emergency_contact`, `emergency_contact_phone`, `created_at`, `updated_at`) VALUES
(1, 6, '1992-05-15', 'male', 'O', 'Jl. Pahlawan No. 45, Semarang', 'Penisilin', 'Asma ringan', 'Siti Rahmawati (Istri)', '081298765432', NOW(), NOW());

-- 6. Family Members
INSERT INTO `family_members` (`id`, `user_id`, `name`, `relation`, `date_of_birth`, `gender`, `blood_type`, `allergies`, `pre_existing_conditions`, `created_at`, `updated_at`) VALUES
(1, 6, 'Rizky Santoso', 'Anak', '2019-08-20', 'male', 'O', 'Dingin', 'Tidak ada', NOW(), NOW());

-- 7. Sample Appointment & Transaction
INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `time_slot`, `reason`, `queue_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, CURDATE(), '09:30:00', 'Demam tinggi dan flu sejak 2 hari.', 'Q-A101', 'confirmed', NOW(), NOW());

INSERT INTO `payments` (`id`, `appointment_id`, `type`, `amount`, `payment_method`, `status`, `payment_date`, `bukti_transfer`, `created_at`, `updated_at`) VALUES
(1, 1, 'consultation', 50000.00, 'Transfer Bank BCA', 'paid', NOW(), NULL, NOW(), NOW());

INSERT INTO `consultations` (`id`, `appointment_id`, `doctor_notes`, `diagnosis`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pasien mengalami demam dan radang tenggorokan. Disarankan istirahat cukup.', 'Infeksi Saluran Pernapasan Akut (ISPA)', 'active', NOW(), NOW());

INSERT INTO `messages` (`id`, `consultation_id`, `sender_id`, `message`, `attachment_path`, `is_read`, `created_at`) VALUES
(1, 1, 6, 'Halo Dokter Sarah, saya mengalami demam sejak kemarin malam dan tenggorokan sakit.', NULL, 1, NOW());

INSERT INTO `prescriptions` (`id`, `consultation_id`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'issued', 'Diminum sesudah makan secara teratur.', NOW(), NOW());

INSERT INTO `prescription_items` (`id`, `prescription_id`, `medicine_name`, `dosage`, `frequency`, `duration`, `quantity`) VALUES
(1, 1, 'Paracetamol 500mg', '1 tablet', '3x sehari', '3 hari', 10),
(2, 1, 'Ambroxol 30mg', '1 tablet', '3x sehari', '3 hari', 10);

INSERT INTO `medical_records` (`id`, `patient_id`, `consultation_id`, `blood_pressure`, `weight`, `height`, `summary`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '120/80', 65.50, 170.00, 'Gejala demam dan batuk. Diagnosa ISPA. Terapi Paracetamol dan Ambroxol.', NOW(), NOW());

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `is_read`, `created_at`) VALUES
(1, 6, 'Janji Temu Dikonfirmasi', 'Janji temu Anda telah dikonfirmasi oleh Dr. Sarah Wijaya.', 'consultation', 0, NOW());

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES
(1, 1, 'System Initialization', 'Database berhasil diinisialisasi dengan data awal.', '127.0.0.1', NOW());

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
