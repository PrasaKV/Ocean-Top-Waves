CREATE DATABASE IF NOT EXISTS ocean_top_waves;

USE ocean_top_waves;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', '$2y$10$E.qC5om13rgwcvVdqe/8J.z2u.yU1.KpvyiYvnsVLL2Sg42VO8gUK');

CREATE TABLE `carousel_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `background_image_url` varchar(255) NOT NULL,
  `catch_phrase` varchar(255) NOT NULL,
  `sub_text` text DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `button_color` varchar(7) DEFAULT '#FFC107',
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `carousel_slides` (`background_image_url`, `catch_phrase`, `sub_text`, `button_text`, `button_url`, `display_order`) VALUES
('https://images.unsplash.com/photo-1531722569936-825d3dd91b15?q=80&w=2070&auto=format&fit=crop', 'Ride The Perfect Wave', 'Unforgettable surfing lessons for all levels in the heart of paradise.', 'Explore Packages', '#surfing-lessons', 1),
('https://images.unsplash.com/photo-1528578577-25928e19c961?q=80&w=1925&auto=format&fit=crop', 'Discover Your Adventure', 'More than just surfing. Explore our shop and transport services.', 'See More', '#services', 2);

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) NOT NULL,
  `category` enum('surfing','tours','shop') NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gallery_images` (`image_url`, `category`, `caption`) VALUES
('https://images.unsplash.com/photo-1516055018132-722a0090218b?q=80&w=2070&auto=format&fit=crop', 'surfing', 'Catching the morning sun.'),
('https://images.unsplash.com/photo-1590704174377-f8510a20a8c3?q=80&w=1974&auto=format&fit=crop', 'surfing', 'Perfect form on a clean wave.'),
('https://images.unsplash.com/photo-1620775336049-55018a75346e?q=80&w=1964&auto=format&fit=crop', 'shop', 'Handcrafted souvenirs.'),
('https://images.unsplash.com/photo-1506502280283-3c990a4a4d62?q=80&w=2070&auto=format&fit=crop', 'tours', 'Island transport with a view.');

CREATE TABLE `surfing_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `features` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `surfing_packages` (`name`, `price`, `features`) VALUES
('Beginner\'s Bliss', 75.00, '2-hour lesson,Board & leash rental,Expert instructor'),
('Intermediate Rider', 120.00, '3-hour session,Video analysis,Advanced techniques'),
('Pro-Level Week', 450.00, '5-day course,All gear included,Personalized coaching');

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('whatsapp_number', '1234567890');

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `quote` text NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `testimonials` (`author`, `quote`, `is_featured`) VALUES
('Alex Johnson', 'An absolutely unforgettable experience! The instructors were patient and professional, and I was riding waves by the end of my first lesson.', 1),
('Samantha Bee', 'Ocean Top Waves made our trip. From the thrilling surf lessons to the beautiful souvenirs, everything was perfect. Highly recommend!', 1);
