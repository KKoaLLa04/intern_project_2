-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 08:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phponline_radix`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT 0,
  `content` text DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `thumbnail` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `user_id`, `category_id`, `content`, `view_count`, `thumbnail`, `description`, `duplicate`, `create_at`, `update_at`) VALUES
(1, 'Xét xử', 'blog-1', 2, 15, '&#60;p&#62;X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa&#60;/p&#62;&#13;&#10;', 0, 'http://localhost/radix_module6/radix/uploads/images/blog1.jpg', '', 5, NULL, '0000-00-00 00:00:00'),
(15, 'Xét xử 5', 'xet-xu-5', 2, 25, '&#60;p&#62;X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa&#60;/p&#62;&#13;&#10;', 0, 'http://localhost/radix_module6/radix/uploads/images/blog5.jpg', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Xét xử  2', 'xet-xu-2', 2, 18, '&#60;p&#62;X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa&#60;/p&#62;&#13;&#10;', 0, 'http://localhost/radix_module6/radix/uploads/images/blog4.jpg', '', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Xét xử', 'blog-1', 2, 25, '&#60;p&#62;X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa&#60;/p&#62;&#13;&#10;', 0, 'http://localhost/radix_module6/radix/uploads/images/blog3.jpg', '', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Xét xử 1', 'xet-xu-1', 2, 25, '&#60;p&#62;X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa X&#38;eacute;t xử &#38;quot;chuyến bay giải cứu&#38;quot;: Cựu Ph&#38;oacute; Chủ tịch H&#38;agrave; Nội được học tr&#38;ograve; b&#38;agrave;o chữa&#60;/p&#62;&#13;&#10;', 0, 'http://localhost/radix_module6/radix/uploads/images/blog2.jpg', '', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(15, 'Chính trị', 'chinh-tri', 2, 0, '2018-07-23 15:55:45', '0000-00-00 00:00:00'),
(16, 'information', 'information', 2, 2, '2018-07-23 16:36:13', NULL),
(18, 'tin tức', NULL, 2, 2, '0000-00-00 00:00:00', NULL),
(25, 'thể thao', 'the-thao', 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `blog_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 0 COMMENT 'Trạng thái bình luận:\r\n0: Chưa duyệt\r\n1: Đã duyệt',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `type_id` int(11) DEFAULT 0,
  `message` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT 'Trạng thái xử lý:\r\n0: Chưa xử lý\r\n1: Đang xử lý\r\n2: Đã xử lý',
  `note` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `type_id`, `message`, `status`, `note`, `create_at`, `update_at`) VALUES
(1, 'Duy kiên', 'kienndph39656@fpt.edu.vn', 3, 'i want to ask to the product&#39;s price', 0, 'nothing', '2023-07-18 13:22:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `duplicate`, `create_at`, `update_at`) VALUES
(2, 'kỹ thuật', 3, '2023-07-11 00:00:00', '0000-00-00 00:00:00'),
(3, 'digital marketing', 1, '2019-07-23 12:44:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `permission` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `create_at`, `update_at`) VALUES
(2, 'Super Admin', NULL, '2023-07-11 21:16:26', '0000-00-00 00:00:00'),
(3, 'Admin', NULL, '2023-07-10 00:00:00', '0000-00-00 00:00:00'),
(4, 'Manager', NULL, '2023-07-04 00:07:20', NULL),
(5, 'Sales', NULL, '2023-07-06 00:00:00', '0000-00-00 00:00:00'),
(6, 'developer', NULL, '2012-07-23 12:42:25', NULL),
(11, 'digital', NULL, '2015-07-23 07:51:37', NULL),
(12, 'marketing', NULL, '2015-07-23 07:51:42', NULL),
(13, 'marketing', NULL, '2015-07-23 07:51:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `token` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`id`, `user_id`, `token`, `create_at`) VALUES
(76, 2, '722ed72e0ae068b5c9c1549387cb89782020c8c7', '2023-12-29 02:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `otp_key` varchar(100) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `otp_key`, `value`, `name`) VALUES
(1, 'general_hotline', '0368031178', 'Hotline'),
(2, 'general_email', 'kienndph39656@fpt.edu.vn', 'Email'),
(3, 'general_time', 'Opening: 5h-17h30', 'Time to work'),
(4, 'header_search', 'Từ khóa tìm kiếm', 'Từ khóa tìm kiếm'),
(5, 'general_twitter', 'https://twitter.com', 'Twitter'),
(6, 'general_facebook', 'https://facebook.com', 'Facebook'),
(7, 'general_linkedin', 'https://linkedin.com', 'Linkedin'),
(8, 'general_behance', '#', 'Behance'),
(9, 'general_youtube', 'https://youtube.com', 'Youtube'),
(10, 'header_quote_text', 'Nhận báo giá', 'Quote text'),
(11, 'header_quote_link', '#', 'Quote link'),
(12, 'general_logo', 'http://localhost/phplessons/module06/radix/uploads/images/logo.png', 'Logo'),
(13, 'general_favicon', 'http://localhost/phplessons/module06/radix/uploads/images/2021_Facebook_icon.svg.webp', 'Favicon'),
(14, 'general_sitename', 'Radix', 'Website\'s name'),
(15, 'general_sitedesc', 'radix company is ...', 'Website\'s description'),
(16, 'home_about', '{\"information\":\"{\\\"title_background\\\":\\\"Radix\\\",\\\"desc\\\":\\\"&#60;h1&#62;About Company&#60;\\\\\\/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"information\\\":\\\"&#60;h2&#62;We Are Professional Website Design &#38;amp; Development Company!&#60;\\\\\\/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. You think water moves fast? You should see ice.&#60;\\\\\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a weeked do incididunt magna Lorem&#60;\\\\\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalancip isicing elit, sed do eiusmod tempor incididunt&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"video\\\":\\\"https:\\\\\\/\\\\\\/www.youtube.com\\\\\\/watch?v=E-2ocmhF6TA\\\",\\\"avatar\\\":\\\"http:\\\\\\/\\\\\\/localhost\\\\\\/radix_module6\\\\\\/radix\\\\\\/uploads\\\\\\/images\\\\\\/gallery-4.jpg\\\",\\\"skill\\\":{\\\"name\\\":[\\\"N\\\\u0103ng l\\\\u1ef1c 1\\\",\\\"N\\\\u0103ng l\\\\u1ef1c 2\\\",\\\"N\\\\u0103ng l\\\\u1ef1c 3\\\",\\\"N\\\\u0103ng l\\\\u1ef1c 4\\\"],\\\"value\\\":[\\\"63\\\",\\\"77\\\",\\\"64\\\",\\\"87\\\"]}}\",\"skill\":\"[{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 1\\\",\\\"value\\\":\\\"63\\\"},{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 2\\\",\\\"value\\\":\\\"77\\\"},{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 3\\\",\\\"value\\\":\\\"64\\\"},{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 4\\\",\\\"value\\\":\\\"87\\\"}]\"}', 'introduce about your website'),
(17, 'home_service_title_bg', 'DUY KIÊN', 'Background title'),
(18, 'home_service_title', 'DỊCH VỤ', 'Title of services'),
(19, 'home_service_subtitle', 'Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin', 'Subtitle'),
(20, 'home_fact_subtitle', 'Thành tựu của chúng tôi', 'subtitle'),
(21, 'home_fact_title', 'With Smooth Animation Numbering', 'Title'),
(22, 'home_fact_desc', 'Pellentesque vitae gravida nulla. Maecenas molestie ligula quis urna viverra venenatis. Donec at ex metus. Suspendisse ac est et magna viverra eleifend. Etiam varius auctor est eu eleifend.', 'Description'),
(23, 'home_fact_button_text', 'Liên hệ', 'Button text'),
(24, 'home_fact_button_link', '#', 'Button link'),
(25, 'home_fact_years_number', '35', 'Years of success'),
(26, 'home_fact_projects_number', '88', 'Project complete'),
(27, 'home_fact_earning_number', '10', 'Total earnings'),
(28, 'home_fact_awards_number', '32', 'Winning awards'),
(32, 'home_slide', '[{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_button_text\":\"Our Portfolio\",\"slide_background\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/gallery-image2.jpg\",\"slide_button_link\":\"#\",\"slide_youtube\":\"https:\\/\\/youtu.be\\/FZQPhrdKjow\",\"slide_image_1\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/gallery-image1.jpg\",\"slide_image_2\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/slider-image1.jpg\",\"slide_position\":\"left\"},{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_button_text\":\"Our Portfolio\",\"slide_background\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/gallery-image2.jpg\",\"slide_button_link\":\"#\",\"slide_youtube\":\"https:\\/\\/youtu.be\\/FZQPhrdKjow\",\"slide_image_1\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/gallery-image1.jpg\",\"slide_image_2\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/slider-image1.jpg\",\"slide_position\":\"right\"},{\"slide_title\":\"Build your website with Radix Multipurpose &#60;span&#62;Business&#60;\\/span&#62; Template.\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_button_text\":\"About Company\",\"slide_background\":\"\",\"slide_button_link\":\"#\",\"slide_youtube\":\"https:\\/\\/youtu.be\\/FZQPhrdKjow\",\"slide_image_1\":\"\",\"slide_image_2\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/slider-image1.jpg\",\"slide_position\":\"center\"}]', 'Slide'),
(33, 'home_portfolios_subtitle', 'DỰ ÁN', 'Tiêu đề nền'),
(34, 'home_portfolios_title', 'Dự án của chúng tôi', 'Tiêu đề'),
(35, 'home_portfolios_desc', 'Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin', 'Mô tả'),
(36, 'home_portfolios_more_text', 'Xem thêm dự án', 'Nút xem thêm'),
(37, 'home_portfolios_more_link', 'http://localhost/radix_module6/radix/?module=portfolios', 'Link nút'),
(39, 'home_blog_title_bg', 'NEWS', 'Background title'),
(40, 'home_blog_title', 'Latest Blogs', 'Title of services'),
(41, 'home_blog_subtitle', 'Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin', 'Subtitle'),
(42, 'home_partner_title_bg', 'Clients', 'Background title'),
(43, 'home_partner_title', 'Our Partners', 'Title'),
(44, 'home_partner_subtitle', 'Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin', 'Subtitle'),
(45, 'home_partner_content', '[{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-1.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-2.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-3.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-4.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-5.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-6.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-7.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-8.png\",\"link\":\"#\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-1.png\",\"link\":\"\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-2.png\",\"link\":\"\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-3.png\",\"link\":\"\"},{\"logo\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/partner-4.png\",\"link\":\"\"}]', 'Danh sách đối tác'),
(46, 'general_address', 'House 20, Sector-7, Road-5, California, US', 'Địa chỉ'),
(47, 'footer_title_1', 'Office Location', 'Tiêu đề'),
(48, 'footer_content_1', '&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim.&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(49, 'footer_title_2', 'Quick Links', 'Tiêu đề'),
(50, 'footer_content_2', '&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;About Our Company&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Our Latest services&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Our Recent Project&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Latest Blog&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Help Desk&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Contact With Us&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;', 'Nội dung'),
(51, 'footer_title_3', 'Recent Tweets', 'Tiêu đề'),
(52, 'footer_twitter_3', 'giaotrinhcntt', 'Tài khoản twitter'),
(53, 'footer_title_4', 'Newsletter', 'Tiêu đề'),
(54, 'footer_content_4', '&#60;p&#62;&#38;copy; 2020 All Right Reserved. Design &#38;amp; Development By&#38;nbsp;&#60;a href=&#34;http://themelamp.com/&#34; target=&#34;_blank&#34;&#62;ThemeLamp.Com&#60;/a&#62;, Theme Provided By&#38;nbsp;&#60;a href=&#34;https://codeglim.com/&#34; target=&#34;_blank&#34;&#62;CodeGlim.Com&#60;/a&#62;&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(55, 'footer_copyright', '© 2020 All Right Reserved. Design &#38; Development By ThemeLamp.Com, Theme Provided By CodeGlim.Com', 'Copyright'),
(56, 'about_title', 'Giới thiệu chung', 'Tiêu đề trang'),
(57, 'team_title', 'Đội ngũ', 'Tiêu đề trang'),
(58, 'team_title_bg', 'Teams', 'Tiêu đề nền'),
(59, 'team_subTitle', 'Đội ngũ chuyên nghiệp với nhiều năm kinh nghiệm trong nghành nghề', 'Tiêu đề phụ'),
(60, 'team_content', '[{\"name\":\"Collis Molate\",\"position\":\"Founder\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\",\"image\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/t1.jpg\"},{\"name\":\"Domani Plavon\",\"position\":\"Co-Founder\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\",\"image\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/t2.jpg\"},{\"name\":\"John Mard\",\"position\":\"Developer\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\",\"image\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/t3.jpg\"},{\"name\":\"Amanal Frond\",\"position\":\"Marketer\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\",\"image\":\"http:\\/\\/localhost\\/radix_module6\\/radix\\/uploads\\/images\\/t4.jpg\"}]', 'Nội dung'),
(61, 'service_title', 'Dịch vụ Radix', 'Tiêu đề trang'),
(62, 'portfolios_title', 'Dự án', 'Tiêu đề trang'),
(63, 'blog_title', 'Bài Viết', 'Tiêu đề trang'),
(64, 'blog_per_page', '9', 'Số bài viết trên 1 trang');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(1, 'hướng dẫn mua hàng', 'huong-dan-mua-hang', 'đang cập nhật...', 3, 3, NULL, NULL),
(2, 'phương thức thanh toán', 'phuong-thuc-thanh-toan', 'đang cập nhật...', 2, 2, NULL, NULL),
(4, 'hướng dẫn mua hàng (1)', 'huong-dan-mua-hang', 'đang cập nhật...', 3, 0, NULL, NULL),
(7, 'phương thức thanh toán (1)', 'phuong-thuc-thanh-toan', 'đang cập nhật...', 2, 0, NULL, NULL),
(17, 'Chính sách bảo mật', 'chinh-sach-bao-mat', '&#60;p&#62;Nội dung đang cập nhật....&#60;/p&#62;&#13;&#10;', 2, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `portfolio_categories_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `slug`, `thumbnail`, `description`, `video`, `content`, `user_id`, `portfolio_categories_id`, `duplicate`, `create_at`, `update_at`) VALUES
(12, 'Creative Work', 'creative-work', 'http://localhost/radix_module6/radix/uploads/images/project1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA&#38;embeds_referring_euri=http%3A%2F%2Flocalhost%2F&#38;', '&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 3, 6, NULL, '0000-00-00 00:00:00'),
(27, 'Clean Design', 'clean-design', 'http://localhost/radix_module6/radix/uploads/images/project4.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA&#38;embeds_referring_euri=http%3A%2F%2Flocalhost%2F&#38;', '&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 26, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Responsive Design', 'responsive-design', 'http://localhost/radix_module6/radix/uploads/images/project2.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA&#38;embeds_referring_euri=http%3A%2F%2Flocalhost%2F&#38;', '&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Animation', 'animation', 'http://localhost/radix_module6/radix/uploads/images/project5.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA&#38;embeds_referring_euri=http%3A%2F%2Flocalhost%2F&#38;', '&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 8, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Bootstrap Based', 'bootstrap-based', 'http://localhost/radix_module6/radix/uploads/images/project3.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA&#38;embeds_referring_euri=http%3A%2F%2Flocalhost%2F&#38;', '&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 25, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Parallax', 'parallax', 'http://localhost/radix_module6/radix/uploads/images/project6.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA&#38;embeds_referring_euri=http%3A%2F%2Flocalhost%2F&#38;', '&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios_categories`
--

CREATE TABLE `portfolios_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolios_categories`
--

INSERT INTO `portfolios_categories` (`id`, `name`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(2, 'marketing', 3, 5, '2017-07-23 12:54:29', '0000-00-00 00:00:00'),
(3, 'thiet ke website', 2, 3, '2017-07-23 12:53:16', NULL),
(8, 'đào tạo lập trình', 2, 2, '2017-07-23 12:45:01', NULL),
(25, 'Thiết kế hiệu ứng', 2, 0, '0000-00-00 00:00:00', NULL),
(26, 'Trường học', 2, 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` int(11) NOT NULL,
  `portfolio_id` int(11) DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `icon`, `description`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(15, 'Creative Plan', 'creative-plan', '&#60;i class=&#34;fa fa-lightbulb-o&#34;&#62;&#60;/i&#62;', 'Information sapien erat, non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin', '&#60;p&#62;this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description&#60;/p&#62;&#13;&#10;', 2, 6, NULL, '0000-00-00 00:00:00'),
(16, 'Direct Work', 'direct-work', '&#60;i class=&#34;fa fa-bullhorn &#34;&#62;&#60;/i&#62;', 'Everything ien erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat Latin', '&#60;p&#62;this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description&#60;/p&#62;&#13;&#10;', 2, 6, NULL, '0000-00-00 00:00:00'),
(17, 'Marketing', 'marketing', '&#60;i class=&#34;fa fa-magic&#34;&#62;&#60;/i&#62;', 'Possible of erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin', '&#60;p&#62;this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description&#60;/p&#62;&#13;&#10;', 2, 6, NULL, '0000-00-00 00:00:00'),
(18, 'Creative Idea', 'creative-idea', '&#60;i class=&#34;fa fa-wordpress&#34;&#62;&#60;/i&#62;', 'Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin', '&#60;p&#62;this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description&#60;/p&#62;&#13;&#10;', 2, 8, NULL, '0000-00-00 00:00:00'),
(19, 'Development', 'development', '&#60;i class=&#34;fa fa-wordpress&#34;&#62;&#60;/i&#62;', 'just fine erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin', '&#60;p&#62;content of desginer and create website&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;', 2, 4, NULL, '0000-00-00 00:00:00'),
(41, 'Direct Work (6)', 'direct-work', '&#60;i class=&#34;fa fa-bullhorn &#34;&#62;&#60;/i&#62;', 'Everything ien erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat Latin', '&#60;p&#62;this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is description this is descriptionthis is description this is description&#60;/p&#62;&#13;&#10;', 2, 5, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT 'Trạng thái xử lý:\r\n0: Chưa xử lý\r\n1: Đang xử lý\r\n2: Đã xử lý',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `about_content` text DEFAULT NULL,
  `contact_facebook` varchar(100) DEFAULT NULL,
  `contact_twitter` varchar(100) DEFAULT NULL,
  `contact_linkedin` varchar(100) DEFAULT NULL,
  `contact_pinterest` varchar(100) DEFAULT NULL,
  `forgot_token` varchar(100) DEFAULT NULL,
  `group_id` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0,
  `last_activity` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `about_content`, `contact_facebook`, `contact_twitter`, `contact_linkedin`, `contact_pinterest`, `forgot_token`, `group_id`, `status`, `last_activity`, `create_at`, `update_at`) VALUES
(2, 'Kiên', 'kienndph39656@fpt.edu.vn', '$2y$10$nhVvKW0pwLoZdXUwMk5ikusHnLqb7zQDzDTDovGElFeii3QJ91UKC', 'my profile is success for something else... 1111', 'https://facebook.com', 'https:///twitter.com', 'https://linkedin.com', 'https://pinterest.com', NULL, 2, 1, '2023-12-29 02:51:18', '2023-07-10 14:29:50', '2023-09-11 13:34:00'),
(3, 'phung tuyet lan ', 'tuyetlan.language@gmail.com', '$2y$10$DNyteojIZJGI4oMpsnqwjeYwa37Ig/eWWEFcXq/QaaJ/JfwB79Obe', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `portfolio_categories_id` (`portfolio_categories_id`);

--
-- Indexes for table `portfolios_categories`
--
ALTER TABLE `portfolios_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_id` (`portfolio_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `portfolios_categories`
--
ALTER TABLE `portfolios_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`);

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `blog_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `contact_type` (`id`);

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `portfolios_ibfk_2` FOREIGN KEY (`portfolio_categories_id`) REFERENCES `portfolios_categories` (`id`);

--
-- Constraints for table `portfolios_categories`
--
ALTER TABLE `portfolios_categories`
  ADD CONSTRAINT `portfolios_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
