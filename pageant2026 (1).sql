-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2026 at 10:41 AM
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
-- Database: `pageant2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contestants`
--

INSERT INTO `contestants` (`id`, `name`, `gender`, `number`, `created_at`, `updated_at`) VALUES
(1, 'Female Contestant 1', 'female', 1, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(2, 'Female Contestant 2', 'female', 2, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(3, 'Female Contestant 3', 'female', 3, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(4, 'Female Contestant 4', 'female', 4, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(5, 'Female Contestant 5', 'female', 5, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(6, 'Female Contestant 6', 'female', 6, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(7, 'Female Contestant 7', 'female', 7, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(8, 'Female Contestant 8', 'female', 8, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(9, 'Female Contestant 9', 'female', 9, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(10, 'Female Contestant 10', 'female', 10, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(11, 'Female Contestant 11', 'female', 11, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(12, 'Male Contestant 1', 'male', 1, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(13, 'Male Contestant 2', 'male', 2, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(14, 'Male Contestant 3', 'male', 3, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(15, 'Male Contestant 4', 'male', 4, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(16, 'Male Contestant 5', 'male', 5, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(17, 'Male Contestant 6', 'male', 6, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(18, 'Male Contestant 7', 'male', 7, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(19, 'Male Contestant 8', 'male', 8, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(20, 'Male Contestant 9', 'male', 9, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(21, 'Male Contestant 10', 'male', 10, '2026-02-06 02:40:18', '2026-02-06 02:40:18'),
(22, 'Male Contestant 11', 'male', 11, '2026-02-06 02:40:18', '2026-02-06 02:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `criterion_scores`
--

CREATE TABLE `criterion_scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contestant_id` bigint(20) UNSIGNED NOT NULL,
  `segment_id` bigint(20) UNSIGNED NOT NULL,
  `criterion_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(4,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_05_053534_add_role_to_users_table', 1),
(5, '2026_02_05_054007_add_judge_code_pin_to_users_table', 1),
(6, '2026_02_05_055137_add_is_chairman_to_users_table', 1),
(7, '2026_02_05_055604_make_email_nullable_in_users_table', 1),
(8, '2026_02_05_060311_create_segments_table', 1),
(9, '2026_02_05_060359_create_segment_submissions_table', 1),
(10, '2026_02_05_062731_create_contestants_table', 1),
(11, '2026_02_05_063905_add_controls_to_segments_table', 1),
(12, '2026_02_05_064949_add_controls_to_segments_table', 1),
(13, '2026_02_05_065115_create_segment_submissions_table', 1),
(14, '2026_02_06_130348_create_scores_table', 2),
(15, '2026_02_07_102908_create_segment_criteria_table', 3),
(16, '2026_02_07_103008_create_criterion_scores_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contestant_id` bigint(20) UNSIGNED NOT NULL,
  `segment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(4,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `segments`
--

CREATE TABLE `segments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `gender_scope` enum('male','female','both') NOT NULL DEFAULT 'both',
  `is_final` tinyint(1) NOT NULL DEFAULT 0,
  `is_open` tinyint(1) NOT NULL DEFAULT 0,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `visible_to_judges` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `segments`
--

INSERT INTO `segments` (`id`, `name`, `created_at`, `updated_at`, `display_order`, `gender_scope`, `is_final`, `is_open`, `is_locked`, `visible_to_judges`) VALUES
(1, 'Production Number', '2026-02-06 02:40:12', '2026-02-22 21:58:17', 1, 'both', 0, 0, 0, 0),
(2, 'Swimwear', '2026-02-06 02:40:12', '2026-02-22 21:58:17', 1, 'both', 0, 0, 0, 0),
(5, 'Final Q&A', '2026-02-06 02:40:12', '2026-02-22 21:58:36', 1, 'both', 0, 0, 0, 0),
(6, 'Evening Gown and Formal Wear', '2026-02-08 19:57:29', '2026-02-22 21:58:17', 1, 'both', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `segment_criteria`
--

CREATE TABLE `segment_criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `segment_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `segment_criteria`
--

INSERT INTO `segment_criteria` (`id`, `segment_id`, `name`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mastery and Execution', 1, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(2, 1, 'Gracefulness and Certainty', 2, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(3, 1, 'Audience Impact', 3, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(4, 1, 'Poise and Bearing', 4, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(5, 2, 'Fitness and Grace', 1, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(6, 2, 'Confidence and Stage Presence', 2, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(7, 2, 'Walk and Movements', 3, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(8, 2, 'Overall Impact', 4, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(17, 5, 'Wit and Content', 1, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(18, 5, 'Stage Presence and Confidence', 2, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(19, 5, 'Projection and Delivery', 3, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(20, 5, 'Overall Impact', 4, '2026-02-07 02:33:57', '2026-02-07 02:33:57'),
(21, 6, 'Design and Fitting', 1, '2026-02-08 20:09:09', '2026-02-08 20:09:09'),
(22, 6, 'Stage Deportment', 2, '2026-02-08 20:09:09', '2026-02-08 20:09:09'),
(23, 6, 'Poise and Bearing', 3, '2026-02-08 20:09:09', '2026-02-08 20:09:09'),
(24, 6, 'Overall Impact', 4, '2026-02-08 20:09:09', '2026-02-08 20:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `segment_judge_submissions`
--

CREATE TABLE `segment_judge_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `segment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `segment_submissions`
--

CREATE TABLE `segment_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `segment_id` bigint(20) UNSIGNED NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','judge') NOT NULL DEFAULT 'judge',
  `judge_code` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `is_chairman` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `judge_code`, `pin`, `is_chairman`) VALUES
(8, 'Judge 1', 'judge1@pageant.local', NULL, '$2y$12$jdMRts3n6SnjXYU0GwucQ.oViowx9fD6cc9jtpkZWIOn5eJh08Qv6', NULL, '2026-02-06 03:06:26', '2026-02-06 03:06:26', 'judge', 'J001', '$2y$12$8N.UybX2aBOjzRWcNMUlsuIptkLFMDgqYB2F7ceM1FwiGHEHAxWgu', 0),
(9, 'Judge 2', 'judge2@pageant.local', NULL, '$2y$12$VYMW.QH/NJ6LSSs5.JoFZOxwtUm1qY0iQ2pct5MQZMnKzCykgo.N6', NULL, '2026-02-06 03:06:27', '2026-02-06 03:06:27', 'judge', 'J002', '$2y$12$j2ULC65PT3LnYux7rn3fsOqV32C3RVVjhxHnQpI0qusrRfzVU4eFq', 0),
(10, 'Judge 3', 'judge3@pageant.local', NULL, '$2y$12$NZSalTMz1pytscx0AZsPX.bOTT8D4s9xmDOv5cxl1aBWMMflQvxvK', NULL, '2026-02-06 03:06:27', '2026-02-06 03:06:27', 'judge', 'J003', '$2y$12$WC06YtorcJIz8YBYeWUHCe..vopTterau348uNGxgRni52uaUb5nq', 0),
(11, 'Judge 4', 'judge4@pageant.local', NULL, '$2y$12$2nZd/QRa6gUK/lztjU9zoe65RdyV9zHvJD1fIYab.Q1k8m7JRxf3K', NULL, '2026-02-06 03:06:28', '2026-02-06 03:06:28', 'judge', 'J004', '$2y$12$Yf8GGg52P.sC4t96nwNzEu9wb1yPDLnZSrqPPzJ2iQS9I69R9SxFO', 0),
(12, 'Judge 5', 'judge5@pageant.local', NULL, '$2y$12$e364ge2dcuHDEGmFH3CB/e8gadTpF5GbkLDp22aeVv1DwYfr2nti6', NULL, '2026-02-06 03:06:28', '2026-02-06 03:06:28', 'judge', 'J005', '$2y$12$59.JG4fodj.ytxyRZLgqSeIf91uk9hzMDCNILcmsWfB4YyNRP3lKe', 0),
(13, 'Chairman', 'chairman@pageant.local', NULL, '$2y$12$gp/5W2uK9fze3AEd1VKxCub2gb.fxm1t4fKDGUWgtG.ZF8yThoOiS', NULL, '2026-02-06 03:06:29', '2026-02-06 03:06:29', 'judge', 'J006', '$2y$12$vGEgoK4Zx8e4pu6pBovFm.XQxgBvTt7DsaslmCo9sc40tWaI/i4Ai', 1),
(15, 'Admin', 'admin@pageant.local', NULL, '$2y$12$VIGY6EMEuThVXIdynswCcO7xp4oPT2nlWRkfOedlTiz5qXmGdkGqq', NULL, '2026-02-06 11:26:38', '2026-02-06 03:34:18', 'admin', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criterion_scores`
--
ALTER TABLE `criterion_scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_crit_score` (`contestant_id`,`segment_id`,`criterion_id`,`user_id`),
  ADD KEY `criterion_scores_segment_id_foreign` (`segment_id`),
  ADD KEY `criterion_scores_criterion_id_foreign` (`criterion_id`),
  ADD KEY `criterion_scores_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scores_contestant_id_segment_id_user_id_unique` (`contestant_id`,`segment_id`,`user_id`),
  ADD KEY `scores_segment_id_foreign` (`segment_id`),
  ADD KEY `scores_user_id_foreign` (`user_id`);

--
-- Indexes for table `segments`
--
ALTER TABLE `segments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `segment_criteria`
--
ALTER TABLE `segment_criteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `segment_criteria_segment_id_name_unique` (`segment_id`,`name`);

--
-- Indexes for table `segment_judge_submissions`
--
ALTER TABLE `segment_judge_submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `segment_judge_submissions_segment_id_user_id_unique` (`segment_id`,`user_id`),
  ADD KEY `segment_judge_submissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `segment_submissions`
--
ALTER TABLE `segment_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `segment_submissions_segment_id_foreign` (`segment_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_judge_code_unique` (`judge_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `criterion_scores`
--
ALTER TABLE `criterion_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `segments`
--
ALTER TABLE `segments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `segment_criteria`
--
ALTER TABLE `segment_criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `segment_judge_submissions`
--
ALTER TABLE `segment_judge_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `segment_submissions`
--
ALTER TABLE `segment_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criterion_scores`
--
ALTER TABLE `criterion_scores`
  ADD CONSTRAINT `criterion_scores_contestant_id_foreign` FOREIGN KEY (`contestant_id`) REFERENCES `contestants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `criterion_scores_criterion_id_foreign` FOREIGN KEY (`criterion_id`) REFERENCES `segment_criteria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `criterion_scores_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `criterion_scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_contestant_id_foreign` FOREIGN KEY (`contestant_id`) REFERENCES `contestants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `segment_criteria`
--
ALTER TABLE `segment_criteria`
  ADD CONSTRAINT `segment_criteria_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `segment_judge_submissions`
--
ALTER TABLE `segment_judge_submissions`
  ADD CONSTRAINT `segment_judge_submissions_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `segment_judge_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `segment_submissions`
--
ALTER TABLE `segment_submissions`
  ADD CONSTRAINT `segment_submissions_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
