CREATE TABLE IF NOT EXISTS `library_config` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `config_key` VARCHAR(255) NOT NULL,
  `config_value` LONGTEXT NOT NULL,
  `value_type` VARCHAR(20) NOT NULL DEFAULT 'json',
  `description` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `library_config_config_key_unique` (`config_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `library_members` (
  `member_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NULL,
  `notes` TEXT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_by_admin_branch_id` BIGINT UNSIGNED NULL,
  `updated_by_admin_branch_id` BIGINT UNSIGNED NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`member_id`),
  KEY `library_members_created_by_admin_branch_id_foreign` (`created_by_admin_branch_id`),
  KEY `library_members_updated_by_admin_branch_id_foreign` (`updated_by_admin_branch_id`),
  CONSTRAINT `library_members_created_by_admin_branch_id_foreign` FOREIGN KEY (`created_by_admin_branch_id`) REFERENCES `branch` (`id`) ON DELETE SET NULL,
  CONSTRAINT `library_members_updated_by_admin_branch_id_foreign` FOREIGN KEY (`updated_by_admin_branch_id`) REFERENCES `branch` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `library_bookings` (
  `booking_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_group_id` VARCHAR(64) NOT NULL,
  `member_id` BIGINT UNSIGNED NOT NULL,
  `booking_year` SMALLINT UNSIGNED NOT NULL,
  `booking_month` TINYINT UNSIGNED NOT NULL,
  `status` ENUM('confirmed','secured') NOT NULL DEFAULT 'confirmed',
  `block_code` VARCHAR(20) NOT NULL,
  `seat_id` VARCHAR(100) NOT NULL,
  `seat_label` VARCHAR(50) NOT NULL,
  `note` TEXT NULL,
  `monthly_price` DECIMAL(10,2) NOT NULL,
  `payment_status` ENUM('pending','paid') NOT NULL DEFAULT 'pending',
  `payment_method` VARCHAR(50) NULL,
  `payment_collected_by` VARCHAR(255) NULL,
  `payment_note` TEXT NULL,
  `payment_paid_at` TIMESTAMP NULL,
  `created_by_admin_branch_id` BIGINT UNSIGNED NULL,
  `updated_by_admin_branch_id` BIGINT UNSIGNED NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `library_bookings_group_month_unique` (`booking_group_id`,`booking_year`,`booking_month`),
  KEY `library_bookings_member_id_foreign` (`member_id`),
  KEY `library_bookings_year_month_index` (`booking_year`,`booking_month`),
  KEY `library_bookings_created_by_admin_branch_id_foreign` (`created_by_admin_branch_id`),
  KEY `library_bookings_updated_by_admin_branch_id_foreign` (`updated_by_admin_branch_id`),
  CONSTRAINT `library_bookings_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `library_members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `library_bookings_created_by_admin_branch_id_foreign` FOREIGN KEY (`created_by_admin_branch_id`) REFERENCES `branch` (`id`) ON DELETE SET NULL,
  CONSTRAINT `library_bookings_updated_by_admin_branch_id_foreign` FOREIGN KEY (`updated_by_admin_branch_id`) REFERENCES `branch` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `library_booking_slots` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` BIGINT UNSIGNED NOT NULL,
  `booking_year` SMALLINT UNSIGNED NOT NULL,
  `booking_month` TINYINT UNSIGNED NOT NULL,
  `seat_id` VARCHAR(100) NOT NULL,
  `slot_code` VARCHAR(20) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `library_slot_seat_unique` (`booking_year`,`booking_month`,`seat_id`,`slot_code`),
  KEY `library_booking_slots_booking_id_foreign` (`booking_id`),
  CONSTRAINT `library_booking_slots_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `library_bookings` (`booking_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `library_booking_lockers` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` BIGINT UNSIGNED NOT NULL,
  `booking_year` SMALLINT UNSIGNED NOT NULL,
  `booking_month` TINYINT UNSIGNED NOT NULL,
  `locker_number` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `library_locker_month_unique` (`booking_year`,`booking_month`,`locker_number`),
  KEY `library_booking_lockers_booking_id_foreign` (`booking_id`),
  CONSTRAINT `library_booking_lockers_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `library_bookings` (`booking_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `library_payment_logs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` BIGINT UNSIGNED NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `payment_method` VARCHAR(50) NULL,
  `collected_by` VARCHAR(255) NULL,
  `note` TEXT NULL,
  `paid_at` TIMESTAMP NULL,
  `created_by_admin_branch_id` BIGINT UNSIGNED NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `library_payment_logs_booking_id_foreign` (`booking_id`),
  KEY `library_payment_logs_created_by_admin_branch_id_foreign` (`created_by_admin_branch_id`),
  CONSTRAINT `library_payment_logs_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `library_bookings` (`booking_id`) ON DELETE CASCADE,
  CONSTRAINT `library_payment_logs_created_by_admin_branch_id_foreign` FOREIGN KEY (`created_by_admin_branch_id`) REFERENCES `branch` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `library_config` (`config_key`, `config_value`, `value_type`, `description`)
VALUES
('slot_definitions', '[{"id":"A","label":"Slot A","time":"6AM-10AM","color":"#f59e0b"},{"id":"B","label":"Slot B","time":"10AM-2PM","color":"#10b981"},{"id":"C","label":"Slot C","time":"2PM-6PM","color":"#3b82f6"},{"id":"D","label":"Slot D","time":"6PM-10PM","color":"#a78bfa"}]', 'json', 'Available library slot definitions.'),
('pricing_tiers', '{"1":300,"2":500,"3":800,"4":1000}', 'json', 'Monthly pricing by number of selected slots.'),
('locker_price', '300', 'number', 'Monthly price per locker.'),
('locker_numbers', '[1,2,3,4,5,6]', 'json', 'Available locker numbers.'),
('seat_layout', '{"A":[{"row":"A","seats":[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]},{"row":"B","seats":[0,1,2,3,4,5,6,7,8,9,10,11]},{"row":"C","seats":[0,1,2,3,4,5,6,7,8,9,10,11]},{"row":"D","seats":[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17]},{"row":"E","seats":[1,2,3,4,5,6,7]}],"B":[{"row":"A","seats":[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]},{"row":"B","seats":[1,2,3,4,5,6,7,8,9,10,11,12,13,14]},{"row":"C","seats":[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]},{"row":"D","seats":[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]}]}', 'json', 'Library seat layout grouped by block and row.')
ON DUPLICATE KEY UPDATE
`config_value` = VALUES(`config_value`),
`value_type` = VALUES(`value_type`),
`description` = VALUES(`description`),
`updated_at` = CURRENT_TIMESTAMP;
