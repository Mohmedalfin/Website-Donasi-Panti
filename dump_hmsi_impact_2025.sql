DROP TABLE IF EXISTS `images`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `profile`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
) ;

CREATE TABLE `posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `author_id` INT DEFAULT NULL,
  `category_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` ENUM('draft','published','archived') DEFAULT 'draft',
  `scheduled_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `posts_category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ;

CREATE TABLE `images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_id` INT DEFAULT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
);

-- Table: profile
CREATE TABLE `profile` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL DEFAULT '',
  `logo` VARCHAR(50) DEFAULT '',
  `phone` VARCHAR(50) NOT NULL DEFAULT '',
  `email` VARCHAR(50) NOT NULL,
  `alamat` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- Table: users
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id`)
) ;

INSERT INTO `categories` (`name`, `slug`) VALUES
('Berita', 'berita'),
('Kegiatan', 'kegiatan'),
('Pengumuman', 'pengumuman');

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `author_id`, `category_id`, `created_at`, `updated_at`, `status`, `scheduled_at`) VALUES
(1, 'Halo semuanya Pekenalkan ', 'halo-semuanya-pekenalkan', '<p>asdkanasbdasdh adas dhadhad ashasohd</p>', NULL, 1, '2025-03-23 11:01:38', '2025-03-23 19:19:09', 'published', NULL),
(2, 'Bambang', 'bambang', '<p>Kacauuuuuuu</p>', NULL, 2, '2025-03-23 16:04:28', '2025-03-23 20:07:50', 'draft', '2025-03-24 08:15:00');


INSERT INTO `profile` (`id`, `nama`, `logo`, `phone`, `email`, `alamat`) VALUES
(1, 'Dusun Dukuh Sleman', '1322830342_Logodesa.png', '+6282169338008', 'bintan@mail.com', 'Teluk Bintan, Bintan Regency, Riau Islands 29132');

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'superadmin', 'superadmin@admin.com', '186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae');
