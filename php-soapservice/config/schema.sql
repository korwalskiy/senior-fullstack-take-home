CREATE TABLE `companies` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `name` varchar(255),
  `email` varchar(255),
  `logo_url` varchar(255),
  `address` varchar(255),
  `country` varchar(255),
  `tax_rate` decimal(5,2)
);

CREATE TABLE `employees` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `company_id` int,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `avatar_url` varchar(255),
  `email` varchar(255),
  `role` varchar(32),
  `hourly_rate` decimal(5,2),
  FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
);

CREATE TABLE `holidays` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `company_id` int,
  `employee_id` int,
  `start_date` timestamp,
  `end_date` timestamp,
  `approved` tinyint(1),
  FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
);

CREATE TABLE `service_categories` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `name` varchar(255) UNIQUE
);

CREATE TABLE `services` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_category_id` int,
  `company_id` int,
  `name` varchar(255),
  FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  UNIQUE KEY `service_key` (`name`,`company_id`,`service_category_id`)
);

CREATE TABLE `service_rates` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_id` int,
  `unit` decimal(4,2),
  `amount` decimal(7,2),
  `duration` decimal(5,2),
  `supply_markup` decimal(10,2),
  `overhead_markup` decimal(10,2),
  `misc_markup` decimal(10,2),
  FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
);

CREATE TABLE `customers` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `name` varchar(255),
  `address` varchar(255),
  `phone` varchar(255),
  `email` varchar(255)
);

CREATE TABLE `service_requests` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_id` int,
  `customer_id` int,
  `proposed_start_date` timestamp,
  `proposed_end_date` timestamp,
  `actual_start_date` timestamp,
  `actual_end_date` timestamp,
  `title` varchar(255),
  `status` text,
  `adjustment` decimal(10,2),
  FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
);

CREATE TABLE `workorders` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_request_id` int,
  `employee_id` int,
  `status` tinyint(1),
  FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
);