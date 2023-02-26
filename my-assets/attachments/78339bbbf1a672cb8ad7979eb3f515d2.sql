-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2022 at 01:31 AM
-- Server version: 5.7.38-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kop-ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('first','bg-st','feat','emp','with-bg','bg-nd') COLLATE utf8_unicode_ci NOT NULL,
  `links` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `deleted_at`, `created_at`, `updated_at`, `icon`, `image`, `type`, `links`, `video`) VALUES
(12, 'كيف بدأنا', 'HOW WE BEGIN', 'نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا نص عربى صحيح جدا', 'The Restbeef Steakhouse was est in 1989 in Chicago. We started as a small stall in the middle of Chicago City. Our first experience was based on traditional recipes, that our founder, George Freeman, received from his grandmother. Those recipes were transmitted in his family through generations. It would seem a simple thing - to fry meat, but it became a profitable business and over time, George expanded his stall to a small cafe where hot steaks were served. Pretty soon, the news about the cafe, which serves excellent steaks, spread throughout Chicago. People who wanted to try fresh beef were lined up. Then George realized that he had long outgrown his cafe and it was time to expand. It was then that the Restbeef trademark was registered and the small cafe turned into a chic meat restaurant. At the same time, our Chef Renzo Rogers came to us, and gathered a team of specialists who delight the people of Chicago every day with wonderful dishes.', '2022-08-15 19:18:56', '2022-08-11 00:16:25', '2022-08-15 19:18:56', NULL, '/aboutus/16601517851619348028lPato1ZXYe7HyqKU4hndpKIPsSyfR9zNYD2nFg0z.jpeg', 'first', '', NULL),
(13, 'اليوم الاسود', 'RENZO ROGERS', 'نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ نص عربى خطأ', 'Renzo Rogers began his journey to culinary excellence 15 years ago after graduating from the Chicago Cookery Academy with honors. After graduation he worked for a long time abroad in various restaurants, gaining experience. After 10 years, he had return to his hometown, to take lead the kitchen in our restaurant, what has been successfully engaged in the past 5 years. The winner of many culinary competitions, has many awards and is currently working on his own author\'s menu.', '2022-08-18 23:05:40', '2022-08-11 00:16:59', '2022-08-18 23:05:40', NULL, '/aboutus/16601518191619347674r55Iv4Iy1yo1MmzQYVCfPMsdjsGLEwg8TPGbVvpT.png', 'bg-st', '', NULL),
(14, 'سشياشستنياشستنيا', 'FOOD DELIVERY', 'نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص', 'We delivering fast, faster and fastest way! It does not matter where you are: working at office, sitting at home or take a walk in the park. If you will be hungry - we will find you everywhere and deliver to you fresh and hot meal from our menu. To make an order select needed meal from our menu page, fill in order form and wait for a call. We call you back immediately (or maybe in 3-5 minutes), clarify the details and will sent your order for you. All our delivery men are fastest drivers in the world, so your order will stay hot!', '2022-08-18 23:05:41', '2022-08-11 00:17:32', '2022-08-18 23:05:41', NULL, '/aboutus/166015185216528587354.jpg', 'bg-nd', '', NULL),
(15, 'ششششش', 'FRESHLY COOKED', 'Our steaks are always fresh and perfect, because we use only best meat from proven suppliers.', 'Our steaks are always fresh and perfect, because we use only best meat from proven suppliers.', '2022-08-18 23:05:44', '2022-08-11 16:17:39', '2022-08-18 23:05:44', 'fa-id-card', NULL, 'feat', '', NULL),
(16, 'اليوم الاسود15', 'PROFESSIONAL TEAM', 'We understand how to best serve our customers through tried and true service principles.', 'We understand how to best serve our customers through tried and true service principles.', '2022-08-18 23:05:45', '2022-08-11 16:18:17', '2022-08-18 23:05:45', 'fa-users', NULL, 'feat', '', NULL),
(17, 'سشياشستنياشستنيا', 'QUICK DELIVERY', 'Quick and quality delivering. You may sure, that your order will be fresh, just like from a fire.', 'Quick and quality delivering. You may sure, that your order will be fresh, just like from a fire.', '2022-08-18 23:05:47', '2022-08-11 16:20:01', '2022-08-18 23:05:47', 'fa-truck', NULL, 'feat', '', NULL),
(18, 'WIDE RANGE DRINKS', 'WIDE RANGE DRINKS', 'No matter what you prefer: strong whiskey, light beer or tasty wine. We have all of this and more.', 'No matter what you prefer: strong whiskey, light beer or tasty wine. We have all of this and more.', '2022-08-18 23:05:49', '2022-08-11 16:20:41', '2022-08-18 23:05:49', 'fa-glass-martini', NULL, 'feat', '', NULL),
(19, 'شسخحهعيتن شساي', 'SAVE YOUR TIME', 'We know the cost of the time, so we cooking for you really fast, but always with the best quality.', 'We know the cost of the time, so we cooking for you really fast, but always with the best quality.', '2022-08-18 23:05:51', '2022-08-11 16:21:29', '2022-08-18 23:05:51', 'fa-clock', NULL, 'feat', '', NULL),
(20, 'صشسيشس شسيشسي', 'LIVE MUSIC', 'Every evening you can enjoy not only perfect steaks, but also wonderful lounge live music.', 'Every evening you can enjoy not only perfect steaks, but also wonderful lounge live music.', '2022-08-18 23:05:52', '2022-08-11 16:21:58', '2022-08-18 23:05:52', 'fa-music', NULL, 'feat', '', NULL),
(21, 'احمد عادل', 'ahmed Adel', NULL, NULL, '2022-08-18 23:05:54', '2022-08-14 19:39:05', '2022-08-18 23:05:54', NULL, '/aboutus/16604807451619348028lPato1ZXYe7HyqKU4hndpKIPsSyfR9zNYD2nFg0z.jpeg', 'emp', '[\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",\"https:\\/\\/www.twitter.com\\/OfficialAzharEg\",\"https:\\/\\/www.instgram.com\\/OfficialAzharEg\",null]', NULL),
(22, 'على حسن', 'Ali Hassan', NULL, NULL, '2022-08-18 23:05:56', '2022-08-14 20:10:56', '2022-08-18 23:05:56', NULL, '/aboutus/16604826561631891478male-profile-avatar-with-brown-hair-vector-12055105.jpeg', 'emp', '[\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",\"https:\\/\\/www.facebook.com\\/OfficialAzharEgasdasd\",null,\"https:\\/\\/www.facebook.com\\/OfficialAzharEgw\"]', NULL),
(23, 'محمد على', 'Mohamed ali', NULL, NULL, '2022-08-18 23:05:58', '2022-08-14 20:11:40', '2022-08-18 23:05:58', NULL, '/aboutus/16604827001631888221male-profile-avatar-with-brown-hair-vector-12055105.jpeg', 'emp', '[\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",null,\"https:\\/\\/www.facebook.com\\/OfficialAzharEgasdasd\",\"https:\\/\\/www.facebook.com\\/OfficialAzharEgasdasd\"]', NULL),
(24, 'ابوعادل', 'Abo adel', NULL, NULL, '2022-08-18 23:06:00', '2022-08-14 20:12:13', '2022-08-18 23:06:00', NULL, '/aboutus/16604827331631891478male-profile-avatar-with-brown-hair-vector-12055105.jpeg', 'emp', '[null,\"https:\\/\\/www.facebook.com\\/OfficialAzharEgasdasd\",\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",null]', NULL),
(25, 'اليوم الاسود25', 'A Moments Of Delivered', 'The restaurants in Hangzhou also catered to many northern Chinese who had fled south from Kaifeng during the Jurchen invasion of the 1120s, while it is also known that many restaurants were run by families.', 'The restaurants in Hangzhou also catered to many northern Chinese who had fled south from Kaifeng during the Jurchen invasion of the 1120s, while it is also known that many restaurants were run by families.', '2022-08-18 23:06:02', '2022-08-15 18:07:34', '2022-08-18 23:06:02', NULL, '/aboutus/16601517851619348028lPato1ZXYe7HyqKU4hndpKIPsSyfR9zNYD2nFg0z.jpeg', 'with-bg', NULL, NULL),
(26, 'اليوم الاسود25', 'asdjashdjkashd', 'asfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasd', 'asfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd as asfd asdas das dasd asd asdasdasd as asd asdasdd asdasdasd as asd asdasd asfd asdas das dasd asd asdasdasd as asd asdasd', '2022-08-15 19:17:21', '2022-08-15 19:17:12', '2022-08-15 19:17:21', NULL, NULL, 'first', '[null,null,null,null]', '/aboutus/16605658321652855282vid.mp4'),
(27, 'ششششش', 'wwwwwwwasdadwe', 'asfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasd asfd asdas das dasd asd asdasdasd as asd asdasd asfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasd asfd asdas das dasd asd asdasdasd as asd asdasd', 'asfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasd asfd asdas asfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasdasfd asdas das dasd asd asdasdasd as asd asdasd asfd asdas das dasd asd asdasdasd as asd asdasd das dasd asd asdasdasd as asd asdasd', '2022-08-18 23:05:37', '2022-08-15 19:18:07', '2022-08-18 23:05:37', NULL, '/aboutus/16605658871619348028lPato1ZXYe7HyqKU4hndpKIPsSyfR9zNYD2nFg0z.jpeg', 'first', '[null,null,null,null]', '/aboutus/16605658871652855282vid.mp4'),
(28, 'قيمنا', 'Rate us', 'منذ بداية عملياتنا وخدماتنا والقيم الأساسية هي المحرك الأساسي والمحفز لنا بشكل مستمر.', 'Since the beginning of our operations and services, the core values ​​have been the main driver and motivator for us continuously.', NULL, '2022-08-18 23:10:50', '2022-08-29 23:03:15', NULL, '/aboutus/1660839050about02 (1).png', 'first', '[null,null,null,null]', '/aboutus/1660839050bg.mp4'),
(29, 'الجودة', 'The quality', 'تلتزم مملكة المعجنات بالحفاظ على مستوى عال من الجودة، ليس فقط في الغذاء والخدمات ولكن أيضا بالبيئة المحيطة بها.', 'The Kingdom of Pastries is committing a high level of quality, not only in the food and service but also in the surrounding environment.', NULL, '2022-08-18 23:12:30', '2022-08-29 23:04:02', NULL, '/aboutus/1660839150featured-deal-2.png', 'bg-st', '[null,null,null,null]', NULL),
(30, 'أخمد عادل', 'Ahmed Adel', 'رئيس الطباخين', 'master chef', NULL, '2022-08-18 23:14:12', '2022-08-18 23:14:12', NULL, '/aboutus/1660839252team-01.jpg', 'emp', '[\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",null,\"https:\\/\\/www.instgram.com\\/OfficialAzharEg\",null]', NULL),
(31, 'حسن على', 'Hassan Ali', 'Head Chef', 'Head Chef', NULL, '2022-08-18 23:15:06', '2022-08-18 23:15:06', NULL, '/aboutus/1660839306team-02.jpg', 'emp', '[\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",\"https:\\/\\/www.facebook.com\\/OfficialAzharEgasdasd\",\"https:\\/\\/www.facebook.com\\/OfficialAzharEgw\"]', NULL),
(32, 'عبدالله محمد', 'AbdAllah Mohamed', 'طاه مبتدئ', 'Junior Chef', NULL, '2022-08-18 23:15:53', '2022-08-18 23:15:53', NULL, '/aboutus/1660839353team-03.jpg', 'emp', '[\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",null,null,\"https:\\/\\/www.facebook.com\\/OfficialAzharEgw\"]', NULL),
(33, 'Hassan Hosny', 'حسن حسنى', NULL, NULL, NULL, '2022-08-18 23:16:38', '2022-08-18 23:16:38', NULL, '/aboutus/1660839398team-04.jpg', 'emp', '[\"https:\\/\\/www.facebook.com\\/OfficialAzharEg\",null,null,null]', NULL),
(34, 'الابتكار', 'Innovation', 'نسعى جاهدين على الابتكار المستمر في منجاتنا من أجل تلبية جميع أذواق عملائنا. الطهاة لدينا يسعون لإرضاء مختلف الأذواق بخلق منتجات مبتكرة ذات نكهات فريدة.', 'Our chefs strive continuously to satisfy different tastes by creating innovative products with unique flavors.', NULL, '2022-08-18 23:18:40', '2022-08-29 23:07:03', NULL, '/aboutus/16608395201647948321DSC_8300.jpg', 'bg-nd', '[null,null,null,null]', NULL),
(35, 'النظافة', 'Cleanliness', 'صحة وسلامة عملائنا هما على رأس أولوياتنا ولتحقيق هذا الهدف نقوم بفحص دوري في المطبخ وجميع المرافق ذات الصلة في الفروع لدينا بما في ذلك على موظفينا داخل وخارج المطبخ.', 'Health and safety of our customers are our top priority. To achieve this, we do a periodic check in our branches including our employees inside and outside the kitchen.', NULL, '2022-08-18 23:21:11', '2022-08-29 23:06:28', NULL, '/aboutus/1661789188food-img-04.png', 'with-bg', '[null,null,null,null]', NULL),
(36, 'الاهتمام بالعملاء', 'Customer care', 'عملائنا هم خط الحياة لدينا والدافع من وراء كل عمل هو إرضاء أذواقهم وتحقيق الراحة لهم. نحن نؤمن إيمانا راسخا بأن لدى جميع عملائنا الحق في المطالبة بالجودة العالية والخدمة المميزة من قبلنا.', 'Our customers are our life line. Their satisfaction and comfort are the motive behind every work. We firmly believe that our customers have the right to demand superior quality and outstanding service from us.', NULL, '2022-08-18 23:23:31', '2022-08-29 23:07:50', NULL, '/aboutus/166083981116528587354.jpg', 'bg-nd', '[null,null,null,null]', NULL),
(37, 'نصل إلى عتبة منزلك', 'We come to you', 'نريد لعملائنا أن يزورونا في منافذ البيع والتمتع بالضيافة لدينا ولكن في نفس الوقت علينا أن نضمن أننا نصل لطلب عملائنا في جميع الوجهات القابلة للوصول.', 'We want our customers to visit us at our outlets and enjoy our hospitality.  However, we have to ensure that we can reach them in all destinations.', NULL, '2022-08-29 23:09:28', '2022-08-29 23:09:28', NULL, '/aboutus/1661789368delivery-boy.svg', 'bg-st', '[null,null,null,null]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `building_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `floor_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `name`, `street`, `building_number`, `floor_number`, `landmark`, `city_id`, `area_id`, `customer_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(33, 'جديد', 'عنوان جديد', '5', '5', 'لل', 12, 1846, 70, NULL, '2020-03-23 04:13:26', '2020-03-23 04:13:26'),
(35, 'St', 'Address 1', '1', '3', 'Jdhd', 13, 1430, 70, NULL, '2020-03-23 05:32:19', '2020-03-23 05:32:19'),
(36, 'asdfasdf', 'adfsda fdsa asdf', '2', '3', 'shasdfbrawy resturant', 3, 2, 70, NULL, '2020-03-23 06:24:27', '2020-03-23 06:24:27'),
(37, '77', 'Hahhahaba', '23', '1', 'Jagagag', 3, 7, 70, NULL, '2020-03-23 06:38:00', '2020-03-23 06:38:00'),
(38, 'Jd', 'Hashsh', '3', '2', 'Lallaal', 2, 1, 70, NULL, '2020-03-23 07:17:30', '2020-03-23 07:17:30'),
(39, 'Ha', 'Frfrfr', NULL, NULL, 'Tea', 3, 8, 70, NULL, '2020-03-23 07:27:53', '2020-03-23 07:27:53'),
(40, 'Jeddah home', NULL, NULL, NULL, 'Fjjd', 18, 632, 70, NULL, '2020-03-23 07:30:50', '2020-03-23 07:30:50'),
(45, 'Hf HD', NULL, NULL, NULL, 'Bdbfbfb', 13, 1427, 70, NULL, '2020-03-23 11:53:39', '2020-03-23 11:53:39'),
(46, 'Hdjdjfjjf', NULL, NULL, NULL, 'Hdhfjf', 9, 1, 70, NULL, '2020-03-23 11:55:16', '2020-03-23 11:55:16'),
(47, 'New address', NULL, NULL, NULL, 'Dfrhfff', 18, 636, 70, NULL, '2020-03-23 12:01:25', '2020-03-23 12:01:25'),
(54, 'الرياض', NULL, NULL, NULL, 'العمل', 3, 1, 72, NULL, '2020-03-24 00:04:08', '2020-03-24 00:04:08'),
(56, 'Wael farouk', 'Test', '5', '5', 'Test', 1, 2138, 75, NULL, '2020-03-30 06:06:38', '2020-03-30 06:06:38'),
(57, 'النموزجيه', 'جد', '5', '5', 'تتت', 3, 2, 75, NULL, '2020-04-02 12:18:50', '2020-04-02 12:18:50'),
(58, 'Othman Ahmed Othman Rd, El Sheikh Zayed, Al Ismailia, Ismailia Governorate, Egypt', NULL, NULL, NULL, 'الذ', 10, 1, 76, NULL, '2020-04-06 08:42:50', '2020-04-06 08:42:50'),
(59, '1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA', NULL, NULL, NULL, 'Any', 1, 1, 75, NULL, '2020-04-19 21:19:21', '2020-04-19 21:19:21'),
(60, 'Test1', NULL, NULL, NULL, 'Test', 3, 4, 75, NULL, '2020-04-20 11:01:02', '2020-04-20 11:01:02'),
(61, 'Test', NULL, NULL, NULL, 'Test', 1, 2136, 79, NULL, '2020-04-21 03:29:40', '2020-04-21 03:29:40'),
(62, 'Test, test , test ,test ,test ,test ,test ,testes ,testesfhvxbcbvcb', NULL, NULL, NULL, 'Ggbcv', 1, 2139, 79, NULL, '2020-04-21 08:51:10', '2020-04-21 08:51:10'),
(63, 'عنوان جديد', NULL, NULL, NULL, 'لاند مارك', 5, 458, 75, NULL, '2020-04-27 09:53:34', '2020-04-27 09:53:34'),
(64, '6369, Town Center, Al Hufuf and Al Mubarraz 36341 2096, Saudi Arabia', NULL, NULL, NULL, 'Otbim', 12, 1, 75, NULL, '2020-04-30 23:14:45', '2020-04-30 23:14:45'),
(65, '6369, Town Center, Al Hufuf and Al Mubarraz 36341 2096, Saudi Arabia', NULL, NULL, NULL, 'Nader', 12, 1341, 75, NULL, '2020-05-11 00:18:15', '2020-05-11 00:18:15'),
(66, '6369, Town Center, Al Hufuf and Al Mubarraz 36341 2096, Saudi Arabia', NULL, NULL, NULL, 'Nader', 12, 1341, 75, NULL, '2020-05-11 00:18:15', '2020-05-11 00:18:15'),
(67, 'Al Tiraan', NULL, NULL, NULL, NULL, 4, 1, 70, NULL, '2020-09-29 20:41:42', '2020-09-29 20:41:42'),
(68, 'ات ورك للاثاث المكتبي، 22-عمارات العبور-صلاح سالم مصر الجديده-القاهره، 22-عمارات العبور صلاح سالم، منشية البكري، قسم مصر الجديدة،، Mansheya El-Bakry, Qesm Than Madinet Nasr, Cairo Governorate, Egypt', NULL, NULL, NULL, 'Land', 13, 1426, 70, NULL, '2020-11-15 22:42:12', '2020-11-15 22:42:12'),
(69, 'شارع الطالبية، فيصل، Kafr Tohormos /B, Bolak Al Dakrour, Giza Governorate, Egypt', 'الاهرام', '2', '1', 'الخبرات', 3, 1, 70, NULL, '2020-12-30 05:01:02', '2020-12-30 05:01:02'),
(70, '4034 King Khalid Branch Rd, Al Khuzama, Riyadh 12581 8059, Saudi Arabia', '4034', '2', '8', 'الخزامى', 3, 2, 70, NULL, '2020-12-30 09:33:47', '2020-12-30 09:33:47'),
(77, 'المدينه', '50', '4', '3', 'للل ااا 3', 1, 2135, 159, NULL, '2021-07-09 07:02:22', '2021-07-09 07:02:22'),
(78, 'sb\\sfgsd dsbsbdgsdg dfbdfbdfnfd', 'المدينه', '4', '56', '12 fdhdh', 2748, 1846, 159, NULL, '2021-07-09 08:03:24', '2021-07-09 08:03:24'),
(79, 'address of ahmed mohamed el morshdey', 'el zahraa', '34', '1', '30', 1, 2135, 175, NULL, '2021-09-18 04:17:01', '2021-09-18 04:17:01'),
(81, 'برج الملحم الاداري', 'شارع الستين-مخطط الصفا', '1', '1', 'خلف مطعم الصفا والمروى', 2748, 1859, 188, NULL, '2022-04-06 09:10:40', '2022-04-06 09:10:40'),
(84, 'sadasdas', 'wewewe', '4', '5', 'asdq', 1, 3, 204, NULL, NULL, NULL),
(85, 'newew', 'some place at another', '36', '5', 'wwewe', 1, 1, 93, '2022-08-16 19:31:49', NULL, '2022-08-16 19:31:49'),
(86, 'wwdadasdasw wexdsd', 'homas stas  asd wea iiiidasdas dasd asd', '558', '9', 'ksjdaskldh', 1, 1, 93, '2022-08-16 21:15:20', NULL, '2022-08-16 21:15:20'),
(87, 'home lastwwwwwww', 'homas stas  asd wea dasdas dasd asd', '2', '3', 'asdhweee', 5, 459, 93, '2022-08-16 21:15:23', '2022-08-16 20:58:24', '2022-08-16 21:15:23'),
(88, 'home lastwwwwwww', 'homas stas  asd wea dasdas dasd asd', '3', '2', 'asdhweee', 5, 460, 93, '2022-08-16 21:15:14', '2022-08-16 21:00:28', '2022-08-16 21:15:14'),
(89, 'home lastwwwwwww', 'homas stas  asd wea dasdas dasd asd', '2', '3', 'asdhweee', 3, 7, 93, '2022-08-16 21:15:17', '2022-08-16 21:07:04', '2022-08-16 21:15:17'),
(90, 'home lastwwwwwww', '34sadasd asdasd asdzxc232323zxc', '23', '55', 'sdfsdfasd', 1, 2148, 222, NULL, '2022-08-21 17:52:13', '2022-08-21 17:53:31'),
(91, 'home last', 'homas stas  asd wea iiiidasdas dasd asd', '558', '55', 'asdhweee', 3, 11, 222, '2022-08-21 17:53:39', '2022-08-21 17:53:17', '2022-08-21 17:53:39'),
(92, 'ds', 'oiuhhk', 'ujiojkn', '154', 'kmojmiio', 1, 2136, 226, NULL, '2022-08-22 19:33:36', '2022-08-22 19:33:36'),
(93, 'My location23', NULL, NULL, NULL, NULL, 1, 1, 226, NULL, '2022-08-24 21:52:38', '2022-08-24 21:52:38'),
(94, 'My location23', '121', '2121', '4', 'dfsd 123', 3, 1, 231, '2022-08-31 17:31:49', '2022-08-27 18:07:14', '2022-08-31 17:31:49'),
(95, 'mlknklnklnkl', 'm;mkmkl', 'klnlknkn', 'nlknklnkl', 'lknlknlknl', 13, 73, 231, '2022-09-07 17:53:13', '2022-08-31 17:31:39', '2022-09-07 17:53:13'),
(96, 'lhlhkjhjkk', 'KGAE4282، 4282 رافع الحارثي، 8379، البلدة القديمة، Tabuk 47914', 'ghjkgbkjjkj', 'bkjkjbvjk', 'kjvjkhvhkjv', 13, 71, 231, '2022-09-05 21:19:14', '2022-08-31 17:49:52', '2022-09-05 21:19:14'),
(97, 'test', '658H+5M, Al Thawn, Al Khobar 34632, Saudi Arabia', 'test', '154', 'test', 23421, 1, 231, NULL, '2022-09-01 20:50:16', '2022-09-01 20:50:16'),
(98, 'Mom Address', 'al hizam al akhdar street, Building 21 Park', '21', '3', 'white buiding', 31, 130, 231, NULL, '2022-09-05 21:22:21', '2022-09-05 21:22:21'),
(99, 'عنوان العمل', 'ش ال خليفة', '٢٣', '٢', 'مبنى شركة سامسونج', 23421, 9, 231, NULL, '2022-09-05 22:21:19', '2022-09-05 22:21:19'),
(100, 'klmnjjhbjhbjh', 'lknjknjmnkj', '4844', '498864', 'fasdff dsafsadsafdsadsadlkm,sdml.,asmmasdf464646454564564556', 13, 76, 231, '2022-09-07 17:53:19', '2022-09-05 23:29:38', '2022-09-07 17:53:19'),
(101, 'test address', '3 rd avenu', '56', '87', 'yellow building', 31, 139, 231, NULL, '2022-09-06 01:27:38', '2022-09-06 01:27:38'),
(102, 'برج الملحم', 'البستان', NULL, '3', 'برج الملحم', 23421, 172, 231, '2022-09-07 03:42:11', '2022-09-06 15:57:14', '2022-09-07 03:42:11'),
(103, 'نادر', NULL, '55555', NULL, NULL, 23421, 53, 231, '2022-09-07 03:42:03', '2022-09-06 16:29:06', '2022-09-07 03:42:03'),
(104, 'محمد العربي', 'الشارع الاول', NULL, NULL, NULL, 13, 70, 231, '2022-09-07 17:53:00', '2022-09-07 14:53:07', '2022-09-07 17:53:00'),
(105, 'jdgg', 'ydghf', 'grfjj', 'hgfjdd', 'c NH ddhj', 13, 70, 231, '2022-09-07 17:53:04', '2022-09-07 17:52:37', '2022-09-07 17:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `anoucement`
--

CREATE TABLE `anoucement` (
  `id` bigint(20) NOT NULL,
  `description_ar` varchar(255) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anoucement`
--

INSERT INTO `anoucement` (`id`, `description_ar`, `description_en`, `name_ar`, `name_en`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'تلبي المطاعم في هانغتشو أيضًا العديد من الصينيين الشماليين الذين فروا جنوبًا من كايفنغ خلال غزو الجورشن في عشرينيات القرن الحادي عشر ، بينما من المعروف أيضًا أن العديد من المطاعم كانت تديرها العائلات.', 'The restaurants in Hangzhou also catered to many northern Chinese who had fled south from Kaifeng during the Jurchen invasion of the 1120s, while it is also known that many restaurants were run by families.', 'Caferio ممتازة من نوعية البرغر!', 'The Caferio Have Excellent Of Quality Burgers!', '/Anoucement/1662629159الجزء الخاص بالاعلانات.png', '2022-08-18 22:30:19', '2022-09-08 16:25:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `delivery_fees` double DEFAULT NULL,
  `min_delivery_ammount` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `city_id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `delivery_fees`, `min_delivery_ammount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 13, 'الأحياء', 'Districts ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(2, 13, 'الضباب', 'Ad Dabab', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(3, 13, 'الدواسر', 'Ad Dawasir', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(4, 13, 'العدامة', 'Al Adamah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(5, 13, 'الأمل', 'Al Amal', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(6, 13, 'العمامرة', 'Al Amamrah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(7, 13, 'الأنوار', 'Al Anwar', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(8, 13, 'الأثير', 'Al Athir', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(9, 13, 'العزيزية', 'Al Aziziyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(10, 13, 'البديع', 'Al Badi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(11, 13, 'البادية ', 'Al Badiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(12, 13, 'البساتين', 'Al Basatin', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(13, 13, 'الفيصلية', 'Al Faisaliyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(14, 13, 'الفيحاء', 'Al Fayha', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(15, 13, 'الفردوس', 'Al Firdaws', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(16, 13, 'الفرسان', 'Al Fursan', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(17, 13, 'الإسكان', 'Al Iskan', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(18, 13, 'الاتصالات', 'Al Itisalat', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(19, 13, 'الجلوية', 'Al Jalawiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(20, 13, 'الجامعيين', 'Al Jamiyin ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(21, 13, 'الجوهرة', 'Al Jawharah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(22, 13, 'الخالدية الشمالية', 'Al Khalidiyah Ash Shamaliyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(23, 13, 'الخليج', 'Al Khalij', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(24, 13, 'الخضرية', 'Al Khodaryah ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(25, 13, 'المنار', 'Al Manar', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(26, 13, 'المطار', 'Al Matar', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(27, 13, 'المزروعية', 'Al Mazruiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(28, 13, 'المحمدية', 'Al Muhammadiyah ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(29, 13, 'المركبات', 'Al Muraikabat', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(30, 13, 'النخيل', 'Al Nakhil', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(31, 13, 'النزهة', 'Al Nuzha', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(32, 13, 'القادسية', 'Al Qadisiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(33, 13, 'القزاز', 'Al Qazaz', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(34, 13, 'الشفا - عبد الله فؤاد ', 'Al Shifa', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(35, 13, 'السوق', 'Al Souq', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(36, 13, 'الواحة', 'Al Wahah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(37, 13, 'الحمرا', 'Al-Hamra\'a', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(38, 13, 'النابية', 'An Nabiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(39, 13, 'الندى', 'An Nada', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(40, 13, 'النهضة', 'An Nahdah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(41, 13, 'النخيل', 'An Nakhil', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(42, 13, 'الناصرية', 'An Nasriyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(43, 13, 'النورس', 'An Nawras', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(44, 13, 'النور', 'An Nur', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(45, 13, 'الربيع', 'Ar Rabi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(46, 13, 'الروضة', 'Ar Rawdah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(47, 13, 'الريان', 'Ar Rayyan ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(48, 13, 'السلام', 'As Salam', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(49, 13, 'الشاطئ الغربي', 'Ash Shati Al Gharbi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(50, 13, 'الشاطى الشرقي', 'Ash Shati Ash Sharqi ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(51, 13, 'الشعلة', 'Ash Shulah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(52, 13, 'الطبيشي', 'At Tubayshi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(53, 13, 'الزهور', 'Az Zuhur', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(54, 13, 'بدر', 'Badr', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(55, 13, 'غرناطة', 'Ghirnatah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(56, 13, 'هجر', 'Hajar', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(57, 13, 'ابن خلدون', 'Ibn Khaldun', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(58, 13, 'المدينة الصناعية الأولى', 'Industrial area no1', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(59, 13, 'إسكان الدمام', 'Iskan Dammam', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(60, 13, 'ميناء الملك عبد العزيز', 'King Abdul aziz seaport', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(61, 13, 'ضاحية الملك فهد', 'King Fahar Subrub', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(62, 13, 'مطار الملك  فهد الدولي', 'King Fahd International Airport', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(63, 13, 'مدينة العمال', 'Madinat Al Umal', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(64, 13, 'محمد بن سعود', 'Muhammed Ibn Saud', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(65, 13, 'قصر الخليج', 'Qasr Al Khaleej', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(66, 13, 'طيبة', 'Taibah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(67, 13, 'أحد', 'Uhud', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:34:09', '2022-09-14 11:34:09'),
(69, 31, 'الأندلس', 'Al Andalus', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(70, 31, 'العقربية', 'Al Aqrabiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(71, 31, 'العزيزية', 'Al Aziziyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(72, 31, 'البندرية', 'Al Bandariyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(73, 31, 'البستان', 'Al Bustan', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(74, 31, 'الدوحة الجنوبية', 'Al Dawhah Al Janubiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(75, 31, 'الدوحة الشمالية', 'Al Dawhah Ash Shamaliyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(76, 31, 'الهدا', 'Al Hada', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(77, 31, 'الحمرا', 'Al Hamra', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(78, 31, 'الحزام الأخضر', 'Al Hizam Al Akhdar ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(79, 31, 'الحزام الذهبي', 'Al Hizam Al Thahabi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(80, 31, 'حي الجامعة', 'Al Jamiah District', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(81, 31, 'الجوهرة', 'Al Jawharah ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(82, 31, 'الجسر', 'Al Jisr', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(83, 31, 'الخالدية الجنوبية', 'Al Khalidiyyah Al janubiyyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(84, 31, 'الخبر الجنوبية', 'Al Khobar Al Janubiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(85, 31, 'الخبر الشمالية', 'Al Khobar Al Shamalia', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(86, 31, 'الخزامى', 'Al Khuzama ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(87, 31, 'الكورنيش', 'Al Kurnaish', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(88, 31, 'القصور', 'Al Qusur', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(89, 31, 'الراكة الجنوبية', 'Al Rakah Al Janubiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(90, 31, 'الراكة الشمالية', 'Al Rakah Ash Shamaliyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(91, 31, 'الروابي', 'Al Rawabi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(92, 31, 'اليرموك', 'Al Yarmouk', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(93, 31, 'الثقبة', 'Al-Thuqbah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(94, 31, 'الرابية', 'Ar Rabiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(95, 31, 'غرب الظهران', 'Gharb Al Dhahran', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(96, 31, 'الإسكان', 'Iskan', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(97, 31, 'مدينة العمال', 'Madinat Al Umal', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(98, 31, 'العليا', 'Olaya', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(99, 31, 'قرطبة', 'Qurtoba', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:15', '2022-09-14 11:35:15'),
(101, 23421, 'العزيزية ', 'Al Aziziyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(102, 23421, 'الإسكان', 'Al Eskan Alaam', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(103, 23421, 'الحمرا', 'Al Hamra\'a 1st', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(104, 23421, 'الجامعيين', 'Al Jameyeen', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(105, 23421, 'الخالدية', 'Al Khaldiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(106, 23421, 'العويمرية ', 'Al Omairiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(107, 23421, 'الرفيعة الشمالية', 'Al Rafaa North', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(108, 23421, 'السنيدية', 'Al Sunaidah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(109, 23421, 'الوسيطة', 'Al Wasitah ', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(110, 23421, 'الزهراء', 'Al Zahra', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(111, 23421, 'العسيلة', 'Al-Asilah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(112, 23421, 'البندرية', 'Albandariyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(113, 23421, 'الرقيقة', 'Al Ruqaiqah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(114, 23421, 'المرقاب', 'Almirqab', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(115, 23421, 'المعلمين', 'Almuallimeen', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(116, 23421, 'العليا', 'Alolaya', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(117, 23421, 'الثليثية ', 'Althulaythiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(118, 23421, 'جوبا', 'Juba', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(119, 23421, 'المزروعية', 'Al Mazrouyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:35:48', '2022-09-14 11:35:48'),
(121, 23421, 'المحمدية', 'Al Muhammadiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(122, 23421, 'الربوة', 'Al Rabwah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(123, 23421, 'السلام', 'Al Salam', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(124, 23421, 'السلمانية الشمالية', 'Al Salmaniyah North', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(125, 23421, 'الصيهد', 'Al Sayhad', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(126, 23421, 'المهندسين', 'Almuhandisin', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(127, 23421, 'النايفية', 'An Nayfiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(128, 23421, 'محاسن', 'Mahasin', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:36:39', '2022-09-14 11:36:39'),
(130, 23421, 'القرين', 'Al Qurain', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(131, 23421, 'النزهة', 'Al Nuzha', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(132, 23421, 'القرن', 'Al Qarn', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(133, 23421, 'الراشدية الأول ', 'Al Rashdiyah 1st', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(134, 23421, 'الراشدية الثاني', 'Al Rashdiyah 2nd', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(135, 23421, 'الخرس', 'Al Khars', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(136, 23421, 'الحزم', 'Alhazm Al Shimali', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(137, 23421, 'الغسانية ١', 'Al-Ghassaniya-1', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(138, 23421, 'الغسانية ٢', 'Al-Ghassaniya-2', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(139, 23421, 'عين الحارة', 'Ain Al-Harrah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(140, 23421, 'الشروفية', 'Al Shurofiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(141, 23421, 'مشرفة', 'Mishrifah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(142, 23421, 'الفتح', 'Alfath', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(143, 23421, 'المسعودي', 'Almasudi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(144, 23421, 'المطيرفي', 'Almutayrifi', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:37:19', '2022-09-14 11:37:19'),
(146, 23421, 'العيون', 'Al Oyun', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(147, 23421, 'الوزية ', 'Al Wozeyh', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(148, 23421, 'المراح', 'Al Marah', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(149, 23421, 'العوضية', 'Al Awadiyah', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(150, 23421, 'الشعبة', 'Al Shuabah', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(151, 23421, 'الحليلة', 'Al Hulaylah ', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(152, 23421, 'البطالية', 'Al Battaliyah', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(153, 23421, 'جليلة', 'Julayjilah', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:38:10', '2022-09-14 11:38:10'),
(155, 23421, 'الغويبة', 'Alghawbia', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:39:46', '2022-09-14 11:39:46'),
(156, 23421, 'الطرف', 'Al Tarf', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:39:46', '2022-09-14 11:39:46'),
(157, 23421, 'الجشة', 'Al Jishah', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:39:46', '2022-09-14 11:39:46'),
(158, 23421, 'المركز', 'Al Markaz', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:39:46', '2022-09-14 11:39:46'),
(159, 23421, 'الفضول', 'Al Fodhool', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:39:46', '2022-09-14 11:39:46'),
(160, 23421, 'العمران', 'Madinatal Umran', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:39:46', '2022-09-14 11:39:46'),
(161, 23421, 'القارة', 'Al Qarah', NULL, NULL, 23, NULL, NULL, '2022-09-14 11:39:47', '2022-09-14 11:39:47'),
(163, 23421, 'الجبيل ', 'Al Jubayl', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(164, 23421, 'الجفر', 'Madinat Al Jafr', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(165, 23421, 'بني معن', 'Banimaan', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(166, 23421, 'المنصورة', 'Al Mansourah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(167, 23421, 'الأندلس', 'Al Andalus', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(168, 23421, 'الواحة', 'Al Waha', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(169, 23421, 'حي الملك فهد', 'King Fahd', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(170, 23421, 'النسيم', 'Al Nasim', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(171, 23421, 'البصيرة', 'Almubarakiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(172, 23421, 'الصالحية', 'Al Salhiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(173, 23421, 'عين موسى', 'Aynmusa', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(174, 23421, 'الفيصلية الثاني', 'Al Faisaliyah 2nd', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(175, 23421, 'الروضة', 'Al Rawdha', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(176, 23421, 'العليا', 'Alolaya', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(177, 23421, 'حي الحوراء', 'Alhawra', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(178, 23421, 'الشهابية', 'Al Shehabiyah', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(179, 23421, 'الرويضة', 'Al Ruwaida', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(180, 23421, 'المزروع', 'Al Mazrooa', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51'),
(181, 23421, 'المزروع الثاني', 'Al Mazrooa 2nd', NULL, NULL, 5.75, NULL, NULL, '2022-09-14 11:40:51', '2022-09-14 11:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(7, '/banners/16054565121603192445WhatsApp Image 2020-03-31 at 9.42.22 PM.jpeg', '2022-08-25 16:17:22', '2020-09-23 13:51:49', '2022-08-25 16:17:22'),
(8, '/banners/16054565261603192531CF037288.jpg', NULL, '2020-09-28 18:22:03', '2020-11-16 06:08:46'),
(41, '/banners/16054566231603192550CF037346.jpg', NULL, '2020-09-23 20:51:49', '2020-11-16 06:10:23'),
(42, '/banners/16054570051603193064_DSC4935.jpg', NULL, '2020-09-29 01:22:03', '2020-11-16 06:17:10'),
(51, '/banners/1662621516بيتزا دجاج باربيكيو.jpg', NULL, '2020-09-23 20:51:49', '2022-09-08 14:18:36'),
(52, '/banners/1640501182Pizza steps big-01.jpg', NULL, '2021-09-23 09:14:15', '2021-12-26 20:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `address_description` text COLLATE utf8_unicode_ci NOT NULL,
  `address_description_en` text COLLATE utf8_unicode_ci,
  `first_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `second_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_fees` int(11) DEFAULT NULL,
  `service_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name_ar`, `name_en`, `city_id`, `area_id`, `address_description`, `address_description_en`, `first_phone`, `second_phone`, `email`, `delivery_fees`, `service_type`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(16, 'فرع المبرز', 'Elmabraz', 23421, 1, 'في شارع الظهران بالقرب من قصر اللؤلؤة', 'In middle of Mubarez', '00966928374653', '00966928374653', 'Elmabraz@Elmabraz.com', 0, '\"delivery,takeaway\"', NULL, NULL, NULL, '2020-03-23 02:00:37', '2022-09-05 21:09:29'),
(17, 'فرع الثليثية', 'ِAl thulathia restaurant branch', 23421, 12, 'مطعم الهفوف فرع الثليثية', 'tholathia branch', '920001939', '920001939', 'aljameai@gmail.com', 0, '\"delivery,takeaway\"', NULL, NULL, NULL, '2020-05-05 23:30:19', '2022-09-05 21:09:46'),
(18, 'فرع الستين', 'seteen branch', 23421, 13, 'مطعم فرع الستين بالاحساء', 'setten branch', '+966135888815', NULL, 'aljameai@gmail.com', 0, '\"delivery,takeaway\"', NULL, NULL, NULL, '2020-05-05 23:32:34', '2022-09-05 21:09:56'),
(19, 'فرع النخيل بلازا', 'Nakhel Branch', 23421, 14, 'مطعم فرع النخيل بلازا', 'Nakheel branch', '920001939', '920001939', 'aljameai@gmail.com', 0, '\"delivery,takeaway\"', NULL, NULL, NULL, '2020-05-05 23:34:02', '2022-09-05 21:10:04'),
(20, 'فرع الخليج التجارى', 'Dammam branch restaurant', 13, 70, 'مطعم الدمام بالشارع الاول', 'Dammam Restaurant branch', '+966138306262', NULL, 'aljameai@gmail.com', 0, '\"delivery,takeaway\"', NULL, NULL, NULL, '2020-05-05 23:36:19', '2022-09-05 21:10:15'),
(21, 'مطعم فرع الأندلس', 'Andalus branch', 13, 17, 'مطعم فرع الاندلس بلازا', 'andalus restaurant', '920001939', '920001939', 'aljameai@gmail.com', 0, '\"delivery,takeaway\"', NULL, NULL, '2022-08-29 17:01:31', '2020-05-05 23:38:14', '2022-03-22 22:28:20'),
(27, 'فرع الخبر بلازا', 'Khubar branch', 13, 130, 'مطعم فرع الخبر , بالقرب من شارع البيبسي , الحزام الاخضر', 'Khobar Restaurant Branch', '920001939', NULL, 'aljameai@gmail.com', 0, '\"delivery,takeaway\"', NULL, NULL, NULL, NULL, '2022-09-05 21:09:12'),
(28, 'فرع الأندلس', 'Andalus branch', 13, 92, 'مطعم فرع الاندلس بلازا', 'andalus restaurant', '920001939', '920001939', 'aljameai@gmail.com', 0, '\"delivery,takeaway\"', NULL, NULL, '2022-09-05 22:39:12', '2022-09-05 15:58:52', '2022-09-05 22:39:12'),
(29, 'فرع الرياض', 'Riyadh branch restaurant', 3, 0, 'مطعم فرع الرياض', 'Riyadh branch restaurant', '553856006', NULL, 'aljameai@gmail.com', 0, '\"takeaway\"', NULL, NULL, NULL, '2022-09-05 16:17:20', '2022-09-05 21:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `branch_delivery_areas`
--

CREATE TABLE `branch_delivery_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `branch_delivery_areas`
--

INSERT INTO `branch_delivery_areas` (`id`, `branch_id`, `area_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 20, 1, NULL, NULL, NULL),
(2, 20, 2, NULL, NULL, NULL),
(3, 20, 3, NULL, NULL, NULL),
(4, 20, 4, NULL, NULL, NULL),
(5, 20, 5, NULL, NULL, NULL),
(6, 20, 6, NULL, NULL, NULL),
(7, 20, 7, NULL, NULL, NULL),
(8, 20, 8, NULL, NULL, NULL),
(9, 20, 9, NULL, NULL, NULL),
(10, 20, 10, NULL, NULL, NULL),
(11, 20, 11, NULL, NULL, NULL),
(12, 20, 12, NULL, NULL, NULL),
(13, 20, 13, NULL, NULL, NULL),
(14, 20, 14, NULL, NULL, NULL),
(15, 20, 15, NULL, NULL, NULL),
(16, 20, 16, NULL, NULL, NULL),
(17, 20, 17, NULL, NULL, NULL),
(18, 20, 18, NULL, NULL, NULL),
(19, 20, 19, NULL, NULL, NULL),
(20, 20, 20, NULL, NULL, NULL),
(21, 20, 21, NULL, NULL, NULL),
(22, 20, 22, NULL, NULL, NULL),
(23, 20, 23, NULL, NULL, NULL),
(24, 20, 24, NULL, NULL, NULL),
(25, 20, 25, NULL, NULL, NULL),
(26, 20, 26, NULL, NULL, NULL),
(27, 20, 27, NULL, NULL, NULL),
(28, 20, 28, NULL, NULL, NULL),
(29, 20, 29, NULL, NULL, NULL),
(30, 20, 30, NULL, NULL, NULL),
(31, 20, 31, NULL, NULL, NULL),
(32, 20, 32, NULL, NULL, NULL),
(33, 20, 33, NULL, NULL, NULL),
(34, 20, 34, NULL, NULL, NULL),
(35, 20, 35, NULL, NULL, NULL),
(36, 20, 36, NULL, NULL, NULL),
(37, 20, 37, NULL, NULL, NULL),
(38, 20, 38, NULL, NULL, NULL),
(39, 20, 39, NULL, NULL, NULL),
(40, 20, 40, NULL, NULL, NULL),
(41, 20, 41, NULL, NULL, NULL),
(42, 20, 42, NULL, NULL, NULL),
(43, 20, 43, NULL, NULL, NULL),
(44, 20, 44, NULL, NULL, NULL),
(45, 20, 45, NULL, NULL, NULL),
(46, 20, 46, NULL, NULL, NULL),
(47, 20, 47, NULL, NULL, NULL),
(48, 20, 48, NULL, NULL, NULL),
(49, 20, 49, NULL, NULL, NULL),
(50, 20, 50, NULL, NULL, NULL),
(51, 20, 51, NULL, NULL, NULL),
(52, 20, 52, NULL, NULL, NULL),
(53, 20, 53, NULL, NULL, NULL),
(54, 20, 54, NULL, NULL, NULL),
(55, 20, 55, NULL, NULL, NULL),
(56, 20, 56, NULL, NULL, NULL),
(57, 20, 57, NULL, NULL, NULL),
(58, 20, 58, NULL, NULL, NULL),
(59, 20, 59, NULL, NULL, NULL),
(60, 20, 60, NULL, NULL, NULL),
(61, 20, 61, NULL, NULL, NULL),
(62, 20, 62, NULL, NULL, NULL),
(63, 20, 63, NULL, NULL, NULL),
(64, 20, 64, NULL, NULL, NULL),
(65, 20, 65, NULL, NULL, NULL),
(66, 20, 66, NULL, NULL, NULL),
(67, 20, 67, NULL, NULL, NULL),
(128, 27, 69, NULL, NULL, NULL),
(129, 27, 70, NULL, NULL, NULL),
(130, 27, 71, NULL, NULL, NULL),
(131, 27, 72, NULL, NULL, NULL),
(132, 27, 73, NULL, NULL, NULL),
(133, 27, 74, NULL, NULL, NULL),
(134, 27, 75, NULL, NULL, NULL),
(135, 27, 76, NULL, NULL, NULL),
(136, 27, 77, NULL, NULL, NULL),
(137, 27, 78, NULL, NULL, NULL),
(138, 27, 79, NULL, NULL, NULL),
(139, 27, 80, NULL, NULL, NULL),
(140, 27, 81, NULL, NULL, NULL),
(141, 27, 82, NULL, NULL, NULL),
(142, 27, 83, NULL, NULL, NULL),
(143, 27, 84, NULL, NULL, NULL),
(144, 27, 85, NULL, NULL, NULL),
(145, 27, 86, NULL, NULL, NULL),
(146, 27, 87, NULL, NULL, NULL),
(147, 27, 88, NULL, NULL, NULL),
(148, 27, 89, NULL, NULL, NULL),
(149, 27, 90, NULL, NULL, NULL),
(150, 27, 91, NULL, NULL, NULL),
(151, 27, 92, NULL, NULL, NULL),
(152, 27, 93, NULL, NULL, NULL),
(153, 27, 94, NULL, NULL, NULL),
(154, 27, 95, NULL, NULL, NULL),
(155, 27, 96, NULL, NULL, NULL),
(156, 27, 97, NULL, NULL, NULL),
(157, 27, 98, NULL, NULL, NULL),
(158, 27, 99, NULL, NULL, NULL),
(159, 17, 101, NULL, NULL, NULL),
(160, 17, 102, NULL, NULL, NULL),
(161, 17, 103, NULL, NULL, NULL),
(162, 17, 104, NULL, NULL, NULL),
(163, 17, 105, NULL, NULL, NULL),
(164, 17, 106, NULL, NULL, NULL),
(165, 17, 107, NULL, NULL, NULL),
(166, 17, 108, NULL, NULL, NULL),
(167, 17, 109, NULL, NULL, NULL),
(168, 17, 110, NULL, NULL, NULL),
(169, 17, 111, NULL, NULL, NULL),
(170, 17, 112, NULL, NULL, NULL),
(171, 17, 113, NULL, NULL, NULL),
(172, 17, 114, NULL, NULL, NULL),
(173, 17, 115, NULL, NULL, NULL),
(174, 17, 116, NULL, NULL, NULL),
(175, 17, 117, NULL, NULL, NULL),
(176, 17, 118, NULL, NULL, NULL),
(177, 17, 119, NULL, NULL, NULL),
(191, 19, 121, NULL, NULL, NULL),
(192, 19, 122, NULL, NULL, NULL),
(193, 19, 123, NULL, NULL, NULL),
(194, 19, 124, NULL, NULL, NULL),
(195, 19, 125, NULL, NULL, NULL),
(196, 19, 126, NULL, NULL, NULL),
(197, 19, 127, NULL, NULL, NULL),
(198, 19, 128, NULL, NULL, NULL),
(205, 16, 130, NULL, NULL, NULL),
(206, 16, 131, NULL, NULL, NULL),
(207, 16, 132, NULL, NULL, NULL),
(208, 16, 133, NULL, NULL, NULL),
(209, 16, 134, NULL, NULL, NULL),
(210, 16, 135, NULL, NULL, NULL),
(211, 16, 136, NULL, NULL, NULL),
(212, 16, 137, NULL, NULL, NULL),
(213, 16, 138, NULL, NULL, NULL),
(214, 16, 139, NULL, NULL, NULL),
(215, 16, 140, NULL, NULL, NULL),
(216, 16, 141, NULL, NULL, NULL),
(217, 16, 142, NULL, NULL, NULL),
(218, 16, 143, NULL, NULL, NULL),
(219, 16, 144, NULL, NULL, NULL),
(221, 16, 146, NULL, NULL, NULL),
(222, 16, 147, NULL, NULL, NULL),
(223, 16, 148, NULL, NULL, NULL),
(224, 16, 149, NULL, NULL, NULL),
(225, 16, 150, NULL, NULL, NULL),
(226, 16, 151, NULL, NULL, NULL),
(227, 16, 152, NULL, NULL, NULL),
(228, 16, 153, NULL, NULL, NULL),
(236, 18, 155, NULL, NULL, NULL),
(237, 18, 156, NULL, NULL, NULL),
(238, 18, 157, NULL, NULL, NULL),
(239, 18, 158, NULL, NULL, NULL),
(240, 18, 159, NULL, NULL, NULL),
(241, 18, 160, NULL, NULL, NULL),
(242, 18, 161, NULL, NULL, NULL),
(243, 18, 163, NULL, NULL, NULL),
(244, 18, 164, NULL, NULL, NULL),
(245, 18, 165, NULL, NULL, NULL),
(246, 18, 166, NULL, NULL, NULL),
(247, 18, 167, NULL, NULL, NULL),
(248, 18, 168, NULL, NULL, NULL),
(249, 18, 169, NULL, NULL, NULL),
(250, 18, 170, NULL, NULL, NULL),
(251, 18, 171, NULL, NULL, NULL),
(252, 18, 172, NULL, NULL, NULL),
(253, 18, 173, NULL, NULL, NULL),
(254, 18, 174, NULL, NULL, NULL),
(255, 18, 175, NULL, NULL, NULL),
(256, 18, 176, NULL, NULL, NULL),
(257, 18, 177, NULL, NULL, NULL),
(258, 18, 178, NULL, NULL, NULL),
(259, 18, 179, NULL, NULL, NULL),
(260, 18, 180, NULL, NULL, NULL),
(261, 18, 181, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_offer`
--

CREATE TABLE `branch_offer` (
  `id` bigint(20) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch_offer`
--

INSERT INTO `branch_offer` (`id`, `branch_id`, `offer_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(36, 16, 2, NULL, NULL, NULL),
(37, 17, 2, NULL, NULL, NULL),
(38, 18, 2, NULL, NULL, NULL),
(39, 19, 2, NULL, NULL, NULL),
(40, 20, 2, NULL, NULL, NULL),
(41, 27, 2, NULL, NULL, NULL),
(42, 29, 2, NULL, NULL, NULL),
(43, 16, 1, NULL, NULL, NULL),
(44, 17, 1, NULL, NULL, NULL),
(45, 18, 1, NULL, NULL, NULL),
(46, 19, 1, NULL, NULL, NULL),
(47, 20, 1, NULL, NULL, NULL),
(48, 27, 1, NULL, NULL, NULL),
(49, 29, 1, NULL, NULL, NULL),
(57, 16, 3, NULL, NULL, NULL),
(58, 17, 3, NULL, NULL, NULL),
(59, 18, 3, NULL, NULL, NULL),
(60, 19, 3, NULL, NULL, NULL),
(61, 20, 3, NULL, NULL, NULL),
(62, 27, 3, NULL, NULL, NULL),
(63, 29, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_user`
--

CREATE TABLE `branch_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `branch_user`
--

INSERT INTO `branch_user` (`id`, `branch_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(50, 21, 90, NULL, NULL, NULL),
(57, 16, 91, NULL, NULL, NULL),
(58, 16, 93, NULL, NULL, NULL),
(61, 16, 96, NULL, NULL, NULL),
(63, 16, 98, NULL, NULL, NULL),
(65, 16, 151, NULL, NULL, NULL),
(80, 16, 156, NULL, NULL, NULL),
(102, 21, 179, NULL, NULL, NULL),
(104, 16, 97, NULL, NULL, NULL),
(105, 16, 203, NULL, NULL, NULL),
(112, 16, 204, NULL, NULL, NULL),
(113, 17, 204, NULL, NULL, NULL),
(114, 18, 204, NULL, NULL, NULL),
(115, 19, 204, NULL, NULL, NULL),
(116, 20, 204, NULL, NULL, NULL),
(117, 27, 204, NULL, NULL, NULL),
(118, 16, 241, NULL, NULL, NULL),
(119, 17, 241, NULL, NULL, NULL),
(120, 18, 241, NULL, NULL, NULL),
(121, 19, 241, NULL, NULL, NULL),
(122, 20, 241, NULL, NULL, NULL),
(123, 27, 241, NULL, NULL, NULL),
(124, 29, 241, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_working_days`
--

CREATE TABLE `branch_working_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `branch_working_days`
--

INSERT INTO `branch_working_days` (`id`, `day`, `time_from`, `time_to`, `branch_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(553, 'sunday', '5:00 AM', '4:59 PM', 17, '2022-09-05 15:33:45', '2022-07-05 23:50:07', '2022-09-05 15:33:45'),
(554, 'monday', '5:00 AM', '4:59 PM', 17, '2022-09-05 15:33:45', '2022-07-05 23:50:07', '2022-09-05 15:33:45'),
(555, 'tuesday', '5:00 AM', '4:59 PM', 17, '2022-09-05 15:33:45', '2022-07-05 23:50:07', '2022-09-05 15:33:45'),
(556, 'wednesday', '5:00 AM', '4:59 PM', 17, '2022-09-05 15:33:45', '2022-07-05 23:50:07', '2022-09-05 15:33:45'),
(557, 'thursday', '5:00 AM', '4:59 PM', 17, '2022-09-05 15:33:45', '2022-07-05 23:50:07', '2022-09-05 15:33:45'),
(558, 'friday', '5:00 AM', '4:59 PM', 17, '2022-09-05 15:33:45', '2022-07-05 23:50:07', '2022-09-05 15:33:45'),
(559, 'saturday', '5:00 AM', '4:59 PM', 17, '2022-09-05 15:33:45', '2022-07-05 23:50:07', '2022-09-05 15:33:45'),
(560, 'sunday', '5:00 AM', '4:59 PM', 18, '2022-09-05 15:34:42', '2022-07-05 23:52:29', '2022-09-05 15:34:42'),
(561, 'monday', '5:00 AM', '4:59 PM', 18, '2022-09-05 15:34:42', '2022-07-05 23:52:29', '2022-09-05 15:34:42'),
(562, 'tuesday', '5:00 AM', '4:59 PM', 18, '2022-09-05 15:34:42', '2022-07-05 23:52:29', '2022-09-05 15:34:42'),
(563, 'wednesday', '5:00 AM', '4:59 PM', 18, '2022-09-05 15:34:42', '2022-07-05 23:52:29', '2022-09-05 15:34:42'),
(564, 'thursday', '5:00 AM', '4:59 PM', 18, '2022-09-05 15:34:42', '2022-07-05 23:52:29', '2022-09-05 15:34:42'),
(565, 'friday', '5:00 AM', '4:59 PM', 18, '2022-09-05 15:34:42', '2022-07-05 23:52:29', '2022-09-05 15:34:42'),
(566, 'saturday', '5:00 AM', '4:59 PM', 18, '2022-09-05 15:34:42', '2022-07-05 23:52:29', '2022-09-05 15:34:42'),
(567, 'sunday', '5:00 AM', '4:59 PM', 19, '2022-09-05 15:35:45', '2022-07-05 23:56:07', '2022-09-05 15:35:45'),
(568, 'monday', '5:00 AM', '4:59 PM', 19, '2022-09-05 15:35:45', '2022-07-05 23:56:07', '2022-09-05 15:35:45'),
(569, 'tuesday', '5:00 AM', '4:59 PM', 19, '2022-09-05 15:35:45', '2022-07-05 23:56:07', '2022-09-05 15:35:45'),
(570, 'wednesday', '5:00 AM', '4:59 PM', 19, '2022-09-05 15:35:45', '2022-07-05 23:56:07', '2022-09-05 15:35:45'),
(571, 'thursday', '5:00 AM', '4:59 PM', 19, '2022-09-05 15:35:45', '2022-07-05 23:56:07', '2022-09-05 15:35:45'),
(572, 'friday', '5:00 AM', '4:59 PM', 19, '2022-09-05 15:35:45', '2022-07-05 23:56:07', '2022-09-05 15:35:45'),
(573, 'saturday', '5:00 AM', '4:59 PM', 19, '2022-09-05 15:35:45', '2022-07-05 23:56:07', '2022-09-05 15:35:45'),
(574, 'sunday', '5:00 AM', '4:59 PM', 20, '2022-09-05 15:36:48', '2022-07-06 00:07:18', '2022-09-05 15:36:48'),
(575, 'monday', '5:00 AM', '4:59 PM', 20, '2022-09-05 15:36:48', '2022-07-06 00:07:18', '2022-09-05 15:36:48'),
(576, 'tuesday', '5:00 AM', '4:59 PM', 20, '2022-09-05 15:36:48', '2022-07-06 00:07:18', '2022-09-05 15:36:48'),
(577, 'wednesday', '5:00 AM', '4:59 PM', 20, '2022-09-05 15:36:48', '2022-07-06 00:07:18', '2022-09-05 15:36:48'),
(578, 'thursday', '5:00 AM', '4:59 PM', 20, '2022-09-05 15:36:48', '2022-07-06 00:07:18', '2022-09-05 15:36:48'),
(579, 'friday', '5:00 AM', '4:59 PM', 20, '2022-09-05 15:36:48', '2022-07-06 00:07:18', '2022-09-05 15:36:48'),
(580, 'saturday', '5:00 AM', '4:59 PM', 20, '2022-09-05 15:36:48', '2022-07-06 00:07:18', '2022-09-05 15:36:48'),
(581, 'sunday', '5:00 AM', '4:59 PM', 21, NULL, '2022-07-06 00:10:18', '2022-07-06 00:10:18'),
(582, 'monday', '5:00 AM', '4:59 PM', 21, NULL, '2022-07-06 00:10:18', '2022-07-06 00:10:18'),
(583, 'tuesday', '5:00 AM', '4:59 PM', 21, NULL, '2022-07-06 00:10:18', '2022-07-06 00:10:18'),
(584, 'wednesday', '5:00 AM', '4:59 PM', 21, NULL, '2022-07-06 00:10:18', '2022-07-06 00:10:18'),
(585, 'thursday', '5:00 AM', '4:59 PM', 21, NULL, '2022-07-06 00:10:18', '2022-07-06 00:10:18'),
(586, 'friday', '5:00 AM', '4:59 PM', 21, NULL, '2022-07-06 00:10:18', '2022-07-06 00:10:18'),
(587, 'saturday', '5:00 AM', '4:59 PM', 21, NULL, '2022-07-06 00:10:18', '2022-07-06 00:10:18'),
(616, 'sunday', '5:00 AM', '4:59 PM', 16, '2022-09-05 02:05:25', '2022-07-18 07:42:23', '2022-09-05 02:05:25'),
(617, 'monday', '5:00 AM', '4:59 PM', 16, '2022-09-05 02:05:25', '2022-07-18 07:42:23', '2022-09-05 02:05:25'),
(618, 'tuesday', '5:00 AM', '4:59 PM', 16, '2022-09-05 02:05:25', '2022-07-18 07:42:23', '2022-09-05 02:05:25'),
(619, 'wednesday', '5:00 AM', '4:59 PM', 16, '2022-09-05 02:05:25', '2022-07-18 07:42:23', '2022-09-05 02:05:25'),
(620, 'thursday', '5:00 AM', '4:59 PM', 16, '2022-09-05 02:05:25', '2022-07-18 07:42:23', '2022-09-05 02:05:25'),
(621, 'friday', '5:00 AM', '4:59 PM', 16, '2022-09-05 02:05:25', '2022-07-18 07:42:23', '2022-09-05 02:05:25'),
(622, 'saturday', '5:00 AM', '4:59 PM', 16, '2022-09-05 02:05:25', '2022-07-18 07:42:23', '2022-09-05 02:05:25'),
(623, 'sunday', '5:00 AM', '6:57 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(624, 'sunday', '5:58 AM', '6:58 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(625, 'monday', '5:58 AM', '6:58 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(626, 'monday', '5:58 AM', '6:58 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(627, 'tuesday', '5:58 AM', '5:58 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(628, 'tuesday', '6:58 AM', '6:58 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(629, 'wednesday', '6:58 AM', '6:59 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(630, 'wednesday', '6:59 AM', '6:59 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(631, 'thursday', '6:59 AM', '6:59 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(632, 'thursday', '6:59 AM', '7:00 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(633, 'friday', '7:00 AM', '7:00 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(634, 'friday', '7:00 AM', '7:00 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(635, 'saturday', '7:00 AM', '7:00 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(636, 'saturday', '7:00 AM', '7:00 PM', 27, '2022-09-02 00:02:39', '2022-09-02 00:00:45', '2022-09-02 00:02:39'),
(637, 'sunday', '5:00 AM', '6:57 PM', 27, '2022-09-05 01:10:14', '2022-09-02 00:02:39', '2022-09-05 01:10:14'),
(638, 'monday', '5:58 AM', '6:58 PM', 27, '2022-09-05 01:10:14', '2022-09-02 00:02:39', '2022-09-05 01:10:14'),
(639, 'tuesday', '5:58 AM', '5:58 PM', 27, '2022-09-05 01:10:14', '2022-09-02 00:02:39', '2022-09-05 01:10:14'),
(640, 'wednesday', '6:58 AM', '6:59 PM', 27, '2022-09-05 01:10:14', '2022-09-02 00:02:39', '2022-09-05 01:10:14'),
(641, 'thursday', '6:59 AM', '6:59 PM', 27, '2022-09-05 01:10:14', '2022-09-02 00:02:39', '2022-09-05 01:10:14'),
(642, 'friday', '7:00 AM', '7:00 PM', 27, '2022-09-05 01:10:14', '2022-09-02 00:02:39', '2022-09-05 01:10:14'),
(643, 'saturday', '7:00 AM', '7:00 PM', 27, '2022-09-05 01:10:14', '2022-09-02 00:02:39', '2022-09-05 01:10:14'),
(644, 'sunday', '5:00 AM', '11:57 PM', 27, '2022-09-05 02:00:00', '2022-09-05 01:10:14', '2022-09-05 02:00:00'),
(645, 'monday', '5:58 AM', '11:58 PM', 27, '2022-09-05 02:00:00', '2022-09-05 01:10:14', '2022-09-05 02:00:00'),
(646, 'tuesday', '5:58 AM', '11:58 PM', 27, '2022-09-05 02:00:00', '2022-09-05 01:10:14', '2022-09-05 02:00:00'),
(647, 'wednesday', '6:58 AM', '11:59 PM', 27, '2022-09-05 02:00:00', '2022-09-05 01:10:14', '2022-09-05 02:00:00'),
(648, 'thursday', '6:59 AM', '11:59 PM', 27, '2022-09-05 02:00:00', '2022-09-05 01:10:14', '2022-09-05 02:00:00'),
(649, 'friday', '7:00 AM', '11:00 PM', 27, '2022-09-05 02:00:00', '2022-09-05 01:10:14', '2022-09-05 02:00:00'),
(650, 'saturday', '7:00 AM', '11:00 PM', 27, '2022-09-05 02:00:00', '2022-09-05 01:10:14', '2022-09-05 02:00:00'),
(651, 'sunday', '5:00 AM', '12:00 PM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(652, 'sunday', '4:00 PM', '1:00 AM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(653, 'monday', '5:00 AM', '12:00 PM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(654, 'monday', '4:00 PM', '1:00 AM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(655, 'tuesday', '5:00 AM', '11:58 PM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(656, 'wednesday', '6:58 AM', '11:59 PM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(657, 'thursday', '6:59 AM', '11:59 PM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(658, 'friday', '7:00 AM', '11:00 PM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(659, 'saturday', '7:00 AM', '11:00 PM', 27, '2022-09-05 15:29:48', '2022-09-05 02:00:00', '2022-09-05 15:29:48'),
(660, 'sunday', '5:00 AM', '12:00 AM', 16, '2022-09-05 15:32:42', '2022-09-05 02:05:25', '2022-09-05 15:32:42'),
(661, 'monday', '5:00 AM', '12:00 AM', 16, '2022-09-05 15:32:42', '2022-09-05 02:05:25', '2022-09-05 15:32:42'),
(662, 'tuesday', '5:00 AM', '12:00 AM', 16, '2022-09-05 15:32:42', '2022-09-05 02:05:25', '2022-09-05 15:32:42'),
(663, 'wednesday', '5:00 AM', '12:00 AM', 16, '2022-09-05 15:32:42', '2022-09-05 02:05:25', '2022-09-05 15:32:42'),
(664, 'thursday', '5:00 AM', '12:00 AM', 16, '2022-09-05 15:32:42', '2022-09-05 02:05:25', '2022-09-05 15:32:42'),
(665, 'friday', '5:00 AM', '12:00 AM', 16, '2022-09-05 15:32:42', '2022-09-05 02:05:25', '2022-09-05 15:32:42'),
(666, 'saturday', '5:00 AM', '12:00 AM', 16, '2022-09-05 15:32:42', '2022-09-05 02:05:25', '2022-09-05 15:32:42'),
(667, 'sunday', '5:00 AM', '12:00 PM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(668, 'sunday', '4:00 PM', '1:00 AM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(669, 'monday', '5:00 AM', '12:00 PM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(670, 'monday', '4:00 PM', '1:00 AM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(671, 'tuesday', '5:00 AM', '12:00 PM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(672, 'tuesday', '4:00 PM', '1:00 AM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(673, 'wednesday', '5:00 AM', '12:00 PM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(674, 'wednesday', '4:00 PM', '1:00 AM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(675, 'thursday', '5:00 AM', '12:00 PM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(676, 'thursday', '4:00 PM', '1:00 AM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(677, 'friday', '5:00 AM', '12:00 PM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(678, 'friday', '4:00 PM', '1:00 AM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(679, 'saturday', '5:00 AM', '12:00 PM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(680, 'saturday', '4:00 PM', '1:00 AM', 27, '2022-09-05 21:09:12', '2022-09-05 15:29:48', '2022-09-05 21:09:12'),
(681, 'sunday', '5:00 AM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(682, 'sunday', '4:00 PM', '1:00 AM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(683, 'monday', '5:00 AM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(684, 'monday', '4:00 PM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(685, 'tuesday', '5:00 AM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(686, 'tuesday', '4:00 PM', '1:00 AM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(687, 'wednesday', '5:00 AM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(688, 'wednesday', '4:00 PM', '1:00 AM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(689, 'thursday', '5:00 AM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(690, 'thursday', '4:00 PM', '1:00 AM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(691, 'friday', '5:00 AM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(692, 'friday', '4:00 PM', '1:00 AM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(693, 'saturday', '5:00 AM', '12:00 PM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(694, 'saturday', '4:00 PM', '1:00 AM', 16, '2022-09-05 21:09:29', '2022-09-05 15:32:42', '2022-09-05 21:09:29'),
(695, 'sunday', '5:00 AM', '12:00 PM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(696, 'sunday', '4:00 PM', '1:00 AM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(697, 'monday', '5:00 AM', '12:00 PM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(698, 'monday', '4:00 PM', '1:00 AM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(699, 'tuesday', '5:00 AM', '12:00 PM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(700, 'tuesday', '4:00 PM', '1:00 AM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(701, 'wednesday', '5:00 AM', '12:00 PM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(702, 'wednesday', '4:00 PM', '1:00 AM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(703, 'thursday', '5:00 AM', '12:00 PM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(704, 'thursday', '4:00 PM', '1:00 AM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(705, 'friday', '5:00 AM', '12:00 PM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(706, 'friday', '4:00 PM', '1:00 AM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(707, 'saturday', '5:00 AM', '12:00 PM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(708, 'saturday', '4:00 PM', '1:00 AM', 17, '2022-09-05 21:09:46', '2022-09-05 15:33:45', '2022-09-05 21:09:46'),
(709, 'sunday', '5:00 AM', '12:00 PM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(710, 'sunday', '4:00 PM', '1:00 AM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(711, 'monday', '5:00 AM', '12:00 PM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(712, 'monday', '4:00 PM', '1:00 AM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(713, 'tuesday', '5:00 AM', '12:00 PM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(714, 'tuesday', '4:00 PM', '1:00 AM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(715, 'wednesday', '5:00 AM', '12:00 PM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(716, 'wednesday', '4:00 PM', '1:00 AM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(717, 'thursday', '5:00 AM', '12:00 PM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(718, 'thursday', '4:00 PM', '1:00 AM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(719, 'friday', '5:00 AM', '12:00 PM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(720, 'friday', '4:00 PM', '1:00 AM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(721, 'saturday', '5:00 AM', '12:00 PM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(722, 'saturday', '4:00 PM', '1:00 AM', 18, '2022-09-05 21:09:56', '2022-09-05 15:34:42', '2022-09-05 21:09:56'),
(723, 'sunday', '5:00 AM', '12:00 PM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(724, 'sunday', '4:00 PM', '1:00 AM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(725, 'monday', '5:00 AM', '12:00 PM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(726, 'monday', '4:00 PM', '1:00 AM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(727, 'tuesday', '5:00 AM', '12:00 PM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(728, 'tuesday', '4:00 PM', '1:00 AM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(729, 'wednesday', '5:00 AM', '12:00 PM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(730, 'wednesday', '4:00 PM', '1:00 AM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(731, 'thursday', '5:00 AM', '12:00 PM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(732, 'thursday', '4:00 PM', '1:00 AM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(733, 'friday', '5:00 AM', '12:00 PM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(734, 'friday', '4:00 PM', '1:00 AM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(735, 'saturday', '5:00 AM', '12:00 PM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(736, 'saturday', '4:00 PM', '1:00 AM', 19, '2022-09-05 21:10:04', '2022-09-05 15:35:45', '2022-09-05 21:10:04'),
(737, 'sunday', '5:00 AM', '12:00 PM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(738, 'sunday', '4:00 PM', '1:00 AM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(739, 'monday', '5:00 AM', '12:00 PM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(740, 'monday', '4:00 PM', '1:00 AM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(741, 'tuesday', '5:00 AM', '12:00 PM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(742, 'tuesday', '4:00 PM', '1:00 AM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(743, 'wednesday', '5:00 AM', '12:00 PM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(744, 'wednesday', '4:00 PM', '1:00 AM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(745, 'thursday', '5:00 AM', '12:00 PM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(746, 'thursday', '4:00 PM', '1:00 AM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(747, 'friday', '5:00 AM', '12:00 PM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(748, 'friday', '4:00 PM', '1:00 AM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(749, 'saturday', '5:00 AM', '12:00 PM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(750, 'saturday', '4:00 PM', '1:00 AM', 20, '2022-09-05 21:10:15', '2022-09-05 15:36:48', '2022-09-05 21:10:15'),
(751, 'sunday', '5:00 AM', '12:00 PM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(752, 'sunday', '4:00 PM', '1:00 AM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(753, 'monday', '5:00 AM', '12:00 PM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(754, 'monday', '4:00 PM', '1:00 AM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(755, 'tuesday', '5:00 AM', '12:00 PM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(756, 'tuesday', '4:00 PM', '1:00 AM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(757, 'wednesday', '5:00 AM', '12:00 PM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(758, 'wednesday', '4:00 PM', '1:00 AM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(759, 'thursday', '5:00 AM', '12:00 PM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(760, 'friday', '5:00 AM', '12:00 PM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(761, 'friday', '4:00 PM', '1:00 AM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(762, 'saturday', '5:00 AM', '12:00 PM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(763, 'saturday', '4:00 PM', '1:00 AM', 28, '2022-09-05 16:36:51', '2022-09-05 16:00:00', '2022-09-05 16:36:51'),
(764, 'sunday', '5:00 AM', '12:00 PM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(765, 'monday', '5:00 AM', '12:00 PM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(766, 'monday', '4:00 PM', '1:00 AM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(767, 'tuesday', '5:00 AM', '12:00 PM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(768, 'tuesday', '4:00 PM', '1:00 AM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(769, 'wednesday', '5:00 AM', '12:00 PM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(770, 'wednesday', '4:00 PM', '1:00 AM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(771, 'thursday', '5:00 AM', '12:00 PM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(772, 'thursday', '4:00 PM', '1:00 AM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(773, 'friday', '5:00 AM', '12:00 PM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(774, 'friday', '4:00 PM', '1:00 AM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(775, 'saturday', '5:00 AM', '12:00 PM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(776, 'saturday', '4:00 PM', '1:00 AM', 29, '2022-09-05 16:30:11', '2022-09-05 16:28:09', '2022-09-05 16:30:11'),
(777, 'sunday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:10:44', '2022-09-05 16:30:11', '2022-09-05 21:10:44'),
(778, 'monday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:10:44', '2022-09-05 16:30:11', '2022-09-05 21:10:44'),
(779, 'tuesday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:10:44', '2022-09-05 16:30:11', '2022-09-05 21:10:44'),
(780, 'wednesday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:10:44', '2022-09-05 16:30:11', '2022-09-05 21:10:44'),
(781, 'thursday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:10:44', '2022-09-05 16:30:11', '2022-09-05 21:10:44'),
(782, 'friday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:10:44', '2022-09-05 16:30:11', '2022-09-05 21:10:44'),
(783, 'saturday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:10:44', '2022-09-05 16:30:11', '2022-09-05 21:10:44'),
(784, 'sunday', '5:00 AM', '12:00 PM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(785, 'sunday', '4:00 PM', '1:00 AM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(786, 'monday', '5:00 AM', '12:00 PM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(787, 'monday', '4:00 PM', '1:00 AM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(788, 'tuesday', '5:00 AM', '12:00 PM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(789, 'tuesday', '4:00 PM', '1:00 AM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(790, 'wednesday', '5:00 AM', '12:00 PM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(791, 'wednesday', '4:00 PM', '1:00 AM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(792, 'thursday', '5:00 AM', '12:00 PM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(793, 'friday', '5:00 AM', '12:00 PM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(794, 'friday', '4:00 PM', '1:00 AM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(795, 'saturday', '5:00 AM', '12:00 PM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(796, 'saturday', '4:00 PM', '1:00 AM', 28, '2022-09-05 21:10:23', '2022-09-05 16:36:51', '2022-09-05 21:10:23'),
(797, 'sunday', '5:00 AM', '12:00 PM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(798, 'sunday', '4:00 PM', '1:00 AM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(799, 'monday', '5:00 AM', '12:00 PM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(800, 'monday', '4:00 PM', '1:00 AM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(801, 'tuesday', '5:00 AM', '12:00 PM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(802, 'tuesday', '4:00 PM', '1:00 AM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(803, 'wednesday', '5:00 AM', '12:00 PM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(804, 'wednesday', '4:00 PM', '1:00 AM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(805, 'thursday', '5:00 AM', '12:00 PM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(806, 'thursday', '4:00 PM', '1:00 AM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(807, 'friday', '5:00 AM', '12:00 PM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(808, 'friday', '4:00 PM', '1:00 AM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(809, 'saturday', '5:00 AM', '12:00 PM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(810, 'saturday', '4:00 PM', '1:00 AM', 27, NULL, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(811, 'sunday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(812, 'sunday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(813, 'monday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(814, 'monday', '4:00 PM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(815, 'tuesday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(816, 'tuesday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(817, 'wednesday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(818, 'wednesday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(819, 'thursday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(820, 'thursday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(821, 'friday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(822, 'friday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(823, 'saturday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(824, 'saturday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:14', '2022-09-05 21:09:29', '2022-09-05 22:47:14'),
(825, 'sunday', '5:00 AM', '12:00 PM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(826, 'sunday', '4:00 PM', '1:00 AM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(827, 'monday', '5:00 AM', '12:00 PM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(828, 'monday', '4:00 PM', '1:00 AM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(829, 'tuesday', '5:00 AM', '12:00 PM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(830, 'tuesday', '4:00 PM', '1:00 AM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(831, 'wednesday', '5:00 AM', '12:00 PM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(832, 'wednesday', '4:00 PM', '1:00 AM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(833, 'thursday', '5:00 AM', '12:00 PM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(834, 'thursday', '4:00 PM', '1:00 AM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(835, 'friday', '5:00 AM', '12:00 PM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(836, 'friday', '4:00 PM', '1:00 AM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(837, 'saturday', '5:00 AM', '12:00 PM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(838, 'saturday', '4:00 PM', '1:00 AM', 17, NULL, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(839, 'sunday', '5:00 AM', '12:00 PM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(840, 'sunday', '4:00 PM', '1:00 AM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(841, 'monday', '5:00 AM', '12:00 PM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(842, 'monday', '4:00 PM', '1:00 AM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(843, 'tuesday', '5:00 AM', '12:00 PM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(844, 'tuesday', '4:00 PM', '1:00 AM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(845, 'wednesday', '5:00 AM', '12:00 PM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(846, 'wednesday', '4:00 PM', '1:00 AM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(847, 'thursday', '5:00 AM', '12:00 PM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(848, 'thursday', '4:00 PM', '1:00 AM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(849, 'friday', '5:00 AM', '12:00 PM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(850, 'friday', '4:00 PM', '1:00 AM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(851, 'saturday', '5:00 AM', '12:00 PM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(852, 'saturday', '4:00 PM', '1:00 AM', 18, NULL, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(853, 'sunday', '5:00 AM', '12:00 PM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(854, 'sunday', '4:00 PM', '1:00 AM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(855, 'monday', '5:00 AM', '12:00 PM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(856, 'monday', '4:00 PM', '1:00 AM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(857, 'tuesday', '5:00 AM', '12:00 PM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(858, 'tuesday', '4:00 PM', '1:00 AM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(859, 'wednesday', '5:00 AM', '12:00 PM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(860, 'wednesday', '4:00 PM', '1:00 AM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(861, 'thursday', '5:00 AM', '12:00 PM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(862, 'thursday', '4:00 PM', '1:00 AM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(863, 'friday', '5:00 AM', '12:00 PM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(864, 'friday', '4:00 PM', '1:00 AM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(865, 'saturday', '5:00 AM', '12:00 PM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(866, 'saturday', '4:00 PM', '1:00 AM', 19, NULL, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(867, 'sunday', '5:00 AM', '12:00 PM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(868, 'sunday', '4:00 PM', '1:00 AM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(869, 'monday', '5:00 AM', '12:00 PM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(870, 'monday', '4:00 PM', '1:00 AM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(871, 'tuesday', '5:00 AM', '12:00 PM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(872, 'tuesday', '4:00 PM', '1:00 AM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(873, 'wednesday', '5:00 AM', '12:00 PM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(874, 'wednesday', '4:00 PM', '1:00 AM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(875, 'thursday', '5:00 AM', '12:00 PM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(876, 'thursday', '4:00 PM', '1:00 AM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(877, 'friday', '5:00 AM', '12:00 PM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(878, 'friday', '4:00 PM', '1:00 AM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(879, 'saturday', '5:00 AM', '12:00 PM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(880, 'saturday', '4:00 PM', '1:00 AM', 20, NULL, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(881, 'sunday', '5:00 AM', '12:00 PM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(882, 'sunday', '4:00 PM', '1:00 AM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(883, 'monday', '5:00 AM', '12:00 PM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(884, 'monday', '4:00 PM', '1:00 AM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(885, 'tuesday', '5:00 AM', '12:00 PM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(886, 'tuesday', '4:00 PM', '1:00 AM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(887, 'wednesday', '5:00 AM', '12:00 PM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(888, 'wednesday', '4:00 PM', '1:00 AM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(889, 'thursday', '5:00 AM', '12:00 PM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(890, 'friday', '5:00 AM', '12:00 PM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(891, 'friday', '4:00 PM', '1:00 AM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(892, 'saturday', '5:00 AM', '12:00 PM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(893, 'saturday', '4:00 PM', '1:00 AM', 28, NULL, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(894, 'sunday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:11:03', '2022-09-05 21:10:44', '2022-09-05 21:11:03'),
(895, 'monday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:11:03', '2022-09-05 21:10:44', '2022-09-05 21:11:03'),
(896, 'tuesday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:11:03', '2022-09-05 21:10:44', '2022-09-05 21:11:03'),
(897, 'wednesday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:11:03', '2022-09-05 21:10:44', '2022-09-05 21:11:03'),
(898, 'thursday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:11:03', '2022-09-05 21:10:44', '2022-09-05 21:11:03'),
(899, 'friday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:11:03', '2022-09-05 21:10:44', '2022-09-05 21:11:03'),
(900, 'saturday', '6:00 AM', '1:00 AM', 29, '2022-09-05 21:11:03', '2022-09-05 21:10:44', '2022-09-05 21:11:03'),
(901, 'sunday', '6:00 AM', '1:00 AM', 29, NULL, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(902, 'monday', '6:00 AM', '1:00 AM', 29, NULL, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(903, 'tuesday', '6:00 AM', '1:00 AM', 29, NULL, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(904, 'wednesday', '6:00 AM', '1:00 AM', 29, NULL, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(905, 'thursday', '6:00 AM', '1:00 AM', 29, NULL, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(906, 'friday', '6:00 AM', '1:00 AM', 29, NULL, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(907, 'saturday', '6:00 AM', '1:00 AM', 29, NULL, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(908, 'sunday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(909, 'sunday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(910, 'monday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(911, 'monday', '4:00 PM', '11:59 AM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(912, 'tuesday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(913, 'tuesday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(914, 'wednesday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(915, 'wednesday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(916, 'thursday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(917, 'thursday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(918, 'friday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(919, 'friday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(920, 'saturday', '5:00 AM', '12:00 PM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(921, 'saturday', '4:00 PM', '1:00 AM', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:14', '2022-09-05 22:47:47'),
(922, 'sunday', '5:00 AM', '12:00 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(923, 'sunday', '4:00 PM', '1:00 AM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(924, 'monday', '5:00 AM', '12:00 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(925, 'monday', '4:00 PM', '11:59 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(926, 'tuesday', '5:00 AM', '12:00 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(927, 'tuesday', '4:00 PM', '1:00 AM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(928, 'wednesday', '5:00 AM', '12:00 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(929, 'wednesday', '4:00 PM', '1:00 AM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(930, 'thursday', '5:00 AM', '12:00 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(931, 'thursday', '4:00 PM', '1:00 AM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(932, 'friday', '5:00 AM', '12:00 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(933, 'friday', '4:00 PM', '1:00 AM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(934, 'saturday', '5:00 AM', '12:00 PM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(935, 'saturday', '4:00 PM', '1:00 AM', 16, NULL, '2022-09-05 22:47:47', '2022-09-05 22:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `extras` text COLLATE utf8_unicode_ci,
  `withouts` text COLLATE utf8_unicode_ci,
  `dough_type_ar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dough_type_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `offer_id` text COLLATE utf8_unicode_ci,
  `offer_price` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dough_type_2_ar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dough_type_2_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `item_id`, `extras`, `withouts`, `dough_type_ar`, `dough_type_en`, `quantity`, `offer_id`, `offer_price`, `deleted_at`, `created_at`, `updated_at`, `dough_type_2_ar`, `dough_type_2_en`) VALUES
(1, 93, 10, 'null', 'null', 'رقيقة', 'Thin', 2, NULL, NULL, '2022-08-18 16:16:38', '2022-07-20 22:23:14', '2022-08-18 16:16:38', NULL, NULL),
(2, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:13', '2022-08-11 19:16:20', '2022-08-11 19:27:13', NULL, NULL),
(3, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:12', '2022-08-11 19:16:20', '2022-08-11 19:27:12', NULL, NULL),
(4, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:11', '2022-08-11 19:16:20', '2022-08-11 19:27:11', NULL, NULL),
(5, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:10', '2022-08-11 19:16:20', '2022-08-11 19:27:10', NULL, NULL),
(6, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:06', '2022-08-11 19:16:20', '2022-08-11 19:27:06', NULL, NULL),
(7, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:03', '2022-08-11 19:16:20', '2022-08-11 19:27:03', NULL, NULL),
(8, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:05', '2022-08-11 19:16:20', '2022-08-11 19:27:05', NULL, NULL),
(9, 91, 2, '[]', '[]', 'سميكة', 'Thick', 9, NULL, NULL, '2022-08-11 19:27:05', '2022-08-11 19:16:20', '2022-08-11 19:27:05', NULL, NULL),
(10, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:27:07', '2022-08-11 19:16:20', '2022-08-11 19:27:07', NULL, NULL),
(11, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:27:09', '2022-08-11 19:16:55', '2022-08-11 19:27:09', NULL, NULL),
(12, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:26', '2022-08-11 19:27:32', '2022-08-11 19:30:26', NULL, NULL),
(13, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:23', '2022-08-11 19:27:32', '2022-08-11 19:30:23', NULL, NULL),
(14, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:22', '2022-08-11 19:27:32', '2022-08-11 19:30:22', NULL, NULL),
(15, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:24', '2022-08-11 19:27:32', '2022-08-11 19:30:24', NULL, NULL),
(16, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:20', '2022-08-11 19:27:32', '2022-08-11 19:30:20', NULL, NULL),
(17, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:21', '2022-08-11 19:27:32', '2022-08-11 19:30:21', NULL, NULL),
(18, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:16', '2022-08-11 19:27:32', '2022-08-11 19:30:16', NULL, NULL),
(19, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:18', '2022-08-11 19:27:32', '2022-08-11 19:30:18', NULL, NULL),
(20, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:17', '2022-08-11 19:27:32', '2022-08-11 19:30:17', NULL, NULL),
(21, 91, 2, '[]', '[]', 'سميكة', 'Thick', 10, NULL, NULL, '2022-08-11 19:30:19', '2022-08-11 19:27:32', '2022-08-11 19:30:19', NULL, NULL),
(22, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:30:36', '2022-08-11 19:45:45', NULL, NULL),
(23, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:30:36', '2022-08-11 19:45:45', NULL, NULL),
(24, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:30:36', '2022-08-11 19:45:45', NULL, NULL),
(25, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(26, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(27, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(28, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(29, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(30, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(31, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(32, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:31:45', '2022-08-11 19:45:45', NULL, NULL),
(33, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:40:01', '2022-08-11 19:45:45', NULL, NULL),
(34, 91, 2, '[]', '[]', 'رقيقة', 'Thin', 1, NULL, NULL, '2022-08-11 19:45:45', '2022-08-11 19:40:01', '2022-08-11 19:45:45', NULL, NULL),
(35, 91, 2, '[]', '[]', 'سميكة', 'Thick', 2, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(36, 91, 2, '[]', '[]', 'سميكة', 'Thick', 2, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(37, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(38, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(39, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(40, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(41, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(42, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(43, 91, 2, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(44, 91, 2, '[]', '[]', 'سميكة', 'Thick', 2, NULL, NULL, '2022-08-11 19:48:26', '2022-08-11 19:47:07', '2022-08-11 19:48:26', NULL, NULL),
(45, 91, 2, NULL, NULL, NULL, NULL, 1, '6', 2.3, NULL, '2022-08-11 20:10:03', '2022-08-11 20:10:03', NULL, NULL),
(46, 91, 3, NULL, NULL, NULL, NULL, 1, '6', 5.75, NULL, '2022-08-11 20:10:03', '2022-08-11 20:10:03', NULL, NULL),
(47, 91, 8, NULL, NULL, NULL, NULL, 1, '6', 0, NULL, '2022-08-11 20:10:03', '2022-08-11 20:10:03', NULL, NULL),
(48, 91, 9, NULL, NULL, NULL, NULL, 1, '6', 0, NULL, '2022-08-11 20:10:03', '2022-08-11 20:10:03', NULL, NULL),
(49, 91, 4, NULL, NULL, NULL, NULL, 1, '6', 2.3, NULL, '2022-08-11 20:10:39', '2022-08-11 20:10:39', NULL, NULL),
(50, 91, 10, NULL, NULL, NULL, NULL, 1, '6', 0, NULL, '2022-08-11 20:10:39', '2022-08-11 20:10:39', NULL, NULL),
(51, 91, 11, NULL, NULL, NULL, NULL, 1, '6', 0, NULL, '2022-08-11 20:10:39', '2022-08-11 20:10:39', NULL, NULL),
(52, 91, 2, '[3]', '[1]', 'سميكة', 'Thick', 1, NULL, NULL, NULL, '2022-08-11 20:38:06', '2022-08-11 20:38:06', NULL, NULL),
(53, 93, 2, '[]', '[]', 'سميكة', 'Thick', 1, '9', 1.5, '2022-08-18 16:35:08', '2022-08-16 23:57:35', '2022-08-18 16:35:08', NULL, NULL),
(54, 93, 2, '[]', '[]', 'سميكة', 'Thick', 1, '9', 1.5, '2022-08-18 16:35:08', '2022-08-16 23:57:35', '2022-08-18 16:35:08', NULL, NULL),
(57, 93, 3, '[1,2]', '[2]', 'سميكة', 'Thick', 1, '9', 3.74, '2022-08-18 17:40:00', '2022-08-18 17:37:41', '2022-08-18 17:40:00', NULL, NULL),
(58, 93, 3, '[3]', '[1]', 'رقيقة', 'Thin', 1, '9', 3.74, '2022-08-18 17:40:00', '2022-08-18 17:37:41', '2022-08-18 17:40:00', NULL, NULL),
(59, 93, 20, '[]', '[]', 'سميكة', 'Thick', 1, '12', 5.87, '2022-08-18 18:46:03', '2022-08-18 18:44:19', '2022-08-18 18:46:03', NULL, NULL),
(60, 93, 20, '[]', '[]', 'رقيقة', 'Thin', 1, '12', 5.87, '2022-08-18 18:46:03', '2022-08-18 18:44:19', '2022-08-18 18:46:03', NULL, NULL),
(61, 93, 2, '[2,3]', '[2]', 'سميكة', 'Thick', 1, '9', 1.5, '2022-08-18 18:46:03', '2022-08-18 18:45:06', '2022-08-18 18:46:03', NULL, NULL),
(62, 93, 20, NULL, NULL, 'سميكة', 'Thick', 1, '12', 5.87, '2022-08-18 19:08:03', '2022-08-18 19:06:34', '2022-08-18 19:08:03', NULL, NULL),
(63, 93, 20, NULL, NULL, 'رقيقة', 'Thin', 1, '12', 5.87, '2022-08-18 19:08:07', '2022-08-18 19:06:34', '2022-08-18 19:08:07', NULL, NULL),
(64, 93, 2, NULL, NULL, 'سميكة', 'Thick', 1, '9', 31.5, '2022-08-18 19:08:06', '2022-08-18 19:06:34', '2022-08-18 19:08:06', NULL, NULL),
(65, 93, 20, NULL, NULL, 'سميكة', 'Thick', 2, '12', 5.87, '2022-08-18 22:06:33', '2022-08-18 19:09:10', '2022-08-18 22:06:33', NULL, NULL),
(66, 93, 20, NULL, NULL, 'رقيقة', 'Thin', 2, '12', 5.87, '2022-08-18 21:56:05', '2022-08-18 19:09:10', '2022-08-18 21:56:05', NULL, NULL),
(67, 93, 2, NULL, NULL, 'سميكة', 'Thick', 2, '9', 31.5, '2022-08-18 22:03:43', '2022-08-18 19:09:10', '2022-08-18 22:03:43', NULL, NULL),
(68, 93, 2, '[]', '[]', 'سميكة', 'Thick', 1, '9', 1.5, '2022-08-28 16:41:23', '2022-08-18 22:07:35', '2022-08-28 16:41:23', NULL, NULL),
(69, 93, 2, '[]', '[]', 'سميكة', 'Thick', 1, '9', 1.5, '2022-08-18 22:13:03', '2022-08-18 22:07:35', '2022-08-18 22:13:03', NULL, NULL),
(70, 93, 68, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-18 22:13:07', '2022-08-18 22:07:40', '2022-08-18 22:13:07', NULL, NULL),
(71, 93, 71, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-18 22:13:25', '2022-08-18 22:07:49', '2022-08-18 22:13:25', NULL, NULL),
(72, 93, 79, '[]', '[]', 'سميكة', 'Thick', 1, NULL, NULL, '2022-08-28 16:41:23', '2022-08-18 22:08:21', '2022-08-28 16:41:23', NULL, NULL),
(79, 226, 3, '[1,2]', '[3]', 'سميكة', 'Thick', 2, '9', 3.74, '2022-08-23 23:12:52', '2022-08-23 23:07:56', '2022-08-23 23:12:52', NULL, NULL),
(80, 226, 3, '[1,2]', '[2]', 'سميكة', 'Thick', 1, '9', 3.74, '2022-08-23 23:12:52', '2022-08-23 23:11:00', '2022-08-23 23:12:52', NULL, NULL),
(81, 226, 3, '[1]', '[3,2]', 'سميكة', 'Thick', 2, '9', 3.74, '2022-08-23 23:12:52', '2022-08-23 23:11:00', '2022-08-23 23:12:52', NULL, NULL),
(82, 93, 2, NULL, NULL, NULL, NULL, 1, '6', 2.3, '2022-08-28 16:41:21', '2022-08-28 16:41:14', '2022-08-28 16:41:21', NULL, NULL),
(83, 93, 8, NULL, NULL, NULL, NULL, 1, '6', 0, '2022-08-28 16:41:21', '2022-08-28 16:41:14', '2022-08-28 16:41:21', NULL, NULL),
(84, 93, 9, NULL, NULL, NULL, NULL, 1, '6', 0, '2022-08-28 16:41:21', '2022-08-28 16:41:14', '2022-08-28 16:41:21', NULL, NULL),
(85, 93, 2, NULL, NULL, NULL, NULL, 1, '6', 2.3, '2022-08-28 16:42:17', '2022-08-28 16:41:44', '2022-08-28 16:42:17', NULL, NULL),
(86, 93, 8, NULL, NULL, NULL, NULL, 1, '6', 0, '2022-08-28 16:42:17', '2022-08-28 16:41:44', '2022-08-28 16:42:17', NULL, NULL),
(87, 93, 9, NULL, NULL, NULL, NULL, 1, '6', 0, '2022-08-28 16:42:17', '2022-08-28 16:41:44', '2022-08-28 16:42:17', NULL, NULL),
(88, 230, 3, '[1,2]', '[]', 'بر', 'Borr', 2, '9', 3.74, NULL, '2022-08-29 15:53:13', '2022-08-29 15:53:13', NULL, NULL),
(89, 93, 3, '[]', '[]', 'بر', 'Borr', 1, '9', 3.74, '2022-08-29 19:33:27', '2022-08-29 19:23:37', '2022-08-29 19:33:27', NULL, NULL),
(90, 93, 3, '[]', '[]', 'بر', 'Borr', 2, '9', 3.74, '2022-08-29 19:33:27', '2022-08-29 19:23:37', '2022-08-29 19:33:27', NULL, NULL),
(91, 93, 3, '[]', '[]', 'بر', 'Borr', 1, '9', 3.74, '2022-08-29 19:33:27', '2022-08-29 19:23:37', '2022-08-29 19:33:27', NULL, NULL),
(92, 93, 3, '[]', '[]', 'بر', 'Borr', 2, '9', 3.74, '2022-08-29 19:33:27', '2022-08-29 19:23:37', '2022-08-29 19:33:27', NULL, NULL),
(93, 93, 2, '[1]', '[]', 'عادي', 'normal', 1, '9', 1.5, '2022-08-29 19:33:27', '2022-08-29 19:23:51', '2022-08-29 19:33:27', NULL, NULL),
(98, 93, 3, '[1,2]', '[]', 'بر', 'Borr', 1, '9', 3.74, '2022-08-29 21:59:36', '2022-08-29 21:58:54', '2022-08-29 21:59:36', NULL, NULL),
(99, 93, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-29 21:59:36', '2022-08-29 21:58:54', '2022-08-29 21:59:36', NULL, NULL),
(100, 93, 3, '[]', '[]', 'بر', 'Borr', 2, '9', 3.74, '2022-08-29 22:21:30', '2022-08-29 22:03:05', '2022-08-29 22:21:30', NULL, NULL),
(101, 93, 4, '[1,2]', '[3,2]', 'عادي', 'normal', 3, '9', 4.49, '2022-08-29 22:21:30', '2022-08-29 22:05:26', '2022-08-29 22:21:30', NULL, NULL),
(102, 231, 3, '[3]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-30 15:23:59', '2022-08-30 15:13:18', '2022-08-30 15:23:59', NULL, NULL),
(103, 231, 3, '[1]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-30 15:23:59', '2022-08-30 15:13:18', '2022-08-30 15:23:59', NULL, NULL),
(104, 231, 3, '[1,2,3]', '[]', 'عادي', 'normal', 9, '9', 3.74, '2022-08-30 16:12:40', '2022-08-30 16:12:04', '2022-08-30 16:12:40', NULL, NULL),
(105, 231, 3, '[3,2,1]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-30 16:12:40', '2022-08-30 16:12:04', '2022-08-30 16:12:40', NULL, NULL),
(106, 231, 3, '[1,2,3]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-30 16:12:40', '2022-08-30 16:12:04', '2022-08-30 16:12:40', NULL, NULL),
(107, 231, 3, '[1,2,3]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-30 16:12:40', '2022-08-30 16:12:04', '2022-08-30 16:12:40', NULL, NULL),
(109, 231, 104, '[]', '[]', NULL, NULL, 2, NULL, NULL, '2022-09-04 23:59:45', '2022-08-30 16:33:26', '2022-09-04 23:59:45', NULL, NULL),
(110, 231, 104, '[]', '[]', NULL, NULL, 3, NULL, NULL, '2022-09-04 23:59:45', '2022-08-30 16:33:26', '2022-09-04 23:59:45', NULL, NULL),
(111, 255, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-08-30 22:00:40', '2022-08-30 22:00:40', NULL, NULL),
(112, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:17:12', '2022-08-30 23:06:07', '2022-08-31 00:17:12', NULL, NULL),
(113, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:17:12', '2022-08-30 23:06:07', '2022-08-31 00:17:12', NULL, NULL),
(114, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:17:12', '2022-08-30 23:06:07', '2022-08-31 00:17:12', NULL, NULL),
(115, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:17:12', '2022-08-30 23:06:07', '2022-08-31 00:17:12', NULL, NULL),
(116, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:22:33', '2022-08-31 00:20:58', '2022-08-31 00:22:33', NULL, NULL),
(117, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:22:33', '2022-08-31 00:20:58', '2022-08-31 00:22:33', NULL, NULL),
(118, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:42:36', '2022-08-31 00:24:08', '2022-08-31 00:42:36', NULL, NULL),
(119, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:42:36', '2022-08-31 00:24:08', '2022-08-31 00:42:36', NULL, NULL),
(120, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:42:36', '2022-08-31 00:24:08', '2022-08-31 00:42:36', NULL, NULL),
(121, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:42:36', '2022-08-31 00:24:08', '2022-08-31 00:42:36', NULL, NULL),
(122, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(123, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(124, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(125, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(126, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(127, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(128, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(129, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(130, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-08-31 00:43:24', '2022-08-31 00:42:57', '2022-08-31 00:43:24', NULL, NULL),
(131, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-08-31 00:43:49', '2022-08-31 00:43:49', NULL, NULL),
(132, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-08-31 00:43:49', '2022-08-31 00:43:49', NULL, NULL),
(133, 259, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-08-31 00:43:50', '2022-08-31 00:43:50', NULL, NULL),
(134, 231, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-09-04 23:59:45', '2022-09-01 20:36:22', '2022-09-04 23:59:45', NULL, NULL),
(135, 231, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-09-04 23:59:45', '2022-09-01 20:36:22', '2022-09-04 23:59:45', NULL, NULL),
(136, 231, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-09-04 23:59:45', '2022-09-01 20:36:22', '2022-09-04 23:59:45', NULL, NULL),
(139, 231, 3, '[2]', '[]', 'عادي', 'normal', 2, '9', 3.74, '2022-09-04 23:31:51', '2022-09-04 23:05:00', '2022-09-04 23:31:51', NULL, NULL),
(140, 231, 3, '[3,2,1]', '[3,2,1]', 'عادي', 'normal', 1, '9', 3.74, '2022-09-04 23:31:09', '2022-09-04 23:05:00', '2022-09-04 23:31:09', NULL, NULL),
(141, 231, 5, NULL, NULL, NULL, NULL, 1, '16', 4.6, '2022-09-04 23:31:03', '2022-09-04 23:30:51', '2022-09-04 23:31:03', NULL, NULL),
(142, 231, 7, NULL, NULL, NULL, NULL, 1, '16', 8.05, '2022-09-04 23:31:03', '2022-09-04 23:30:51', '2022-09-04 23:31:03', NULL, NULL),
(143, 231, 5, NULL, NULL, NULL, NULL, 1, '16', 0, '2022-09-04 23:31:03', '2022-09-04 23:30:51', '2022-09-04 23:31:03', NULL, NULL),
(144, 231, 5, 'null', 'null', NULL, NULL, 4, '10', 0, '2022-09-04 23:31:38', '2022-09-04 23:31:23', '2022-09-04 23:31:38', NULL, NULL),
(145, 93, 5, 'null', 'null', NULL, NULL, 4, '10', 0, '2022-09-04 23:44:43', '2022-09-04 23:44:28', '2022-09-04 23:44:43', NULL, NULL),
(146, 93, 6, 'null', 'null', NULL, NULL, 4, '10', 0, '2022-09-04 23:44:43', '2022-09-04 23:44:29', '2022-09-04 23:44:43', NULL, NULL),
(147, 93, 5, NULL, NULL, NULL, NULL, 4, '10', NULL, '2022-09-04 23:45:04', '2022-09-04 23:45:01', '2022-09-04 23:45:04', NULL, NULL),
(148, 93, 6, NULL, NULL, NULL, NULL, 4, '10', NULL, '2022-09-04 23:45:04', '2022-09-04 23:45:01', '2022-09-04 23:45:04', NULL, NULL),
(149, 93, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-09-04 23:57:22', '2022-09-04 23:57:22', NULL, NULL),
(150, 93, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-09-04 23:57:22', '2022-09-04 23:57:22', NULL, NULL),
(151, 93, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-09-04 23:57:22', '2022-09-04 23:57:22', NULL, NULL),
(152, 231, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-09-05 00:17:21', '2022-09-05 00:05:57', '2022-09-05 00:17:21', NULL, NULL),
(153, 231, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-09-05 00:17:21', '2022-09-05 00:05:57', '2022-09-05 00:17:21', NULL, NULL),
(154, 231, 3, '[]', '[]', 'عادي', 'normal', 1, '9', 3.74, '2022-09-05 00:17:21', '2022-09-05 00:05:57', '2022-09-05 00:17:21', NULL, NULL),
(155, 231, 5, NULL, NULL, NULL, NULL, 1, '16', 4.6, '2022-09-05 00:18:36', '2022-09-05 00:18:19', '2022-09-05 00:18:36', NULL, NULL),
(156, 231, 7, NULL, NULL, NULL, NULL, 1, '16', 8.05, '2022-09-05 00:18:36', '2022-09-05 00:18:19', '2022-09-05 00:18:36', NULL, NULL),
(157, 231, 5, NULL, NULL, NULL, NULL, 1, '16', 0, '2022-09-05 00:18:36', '2022-09-05 00:18:19', '2022-09-05 00:18:36', NULL, NULL),
(158, 231, 5, NULL, NULL, NULL, NULL, 1, '16', 4.6, '2022-09-05 00:19:01', '2022-09-05 00:18:57', '2022-09-05 00:19:01', NULL, NULL),
(159, 231, 7, NULL, NULL, NULL, NULL, 1, '16', 8.05, '2022-09-05 00:19:01', '2022-09-05 00:18:57', '2022-09-05 00:19:01', NULL, NULL),
(160, 231, 5, NULL, NULL, NULL, NULL, 1, '16', NULL, '2022-09-05 00:19:01', '2022-09-05 00:18:57', '2022-09-05 00:19:01', NULL, NULL),
(161, 231, 3, '[1,2]', '[]', 'عادي', 'normal', 1, '9', 3.74, NULL, '2022-09-06 01:03:21', '2022-09-06 01:03:21', NULL, NULL),
(162, 231, 78, NULL, NULL, NULL, NULL, 1, '19', 18.4, NULL, '2022-09-06 01:12:02', '2022-09-06 01:12:02', NULL, NULL),
(163, 231, 79, NULL, NULL, NULL, NULL, 1, '19', 13.8, NULL, '2022-09-06 01:12:02', '2022-09-06 01:12:02', NULL, NULL),
(164, 231, 90, NULL, NULL, NULL, NULL, 1, '19', 0, NULL, '2022-09-06 01:12:02', '2022-09-06 01:12:02', NULL, NULL),
(165, 231, 9, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-06 22:14:48', '2022-09-06 22:14:48', NULL, NULL),
(166, 231, 9, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-06 22:14:58', '2022-09-06 22:14:58', NULL, NULL),
(167, 231, 9, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-06 22:15:10', '2022-09-06 22:15:10', NULL, NULL),
(168, 231, 3, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-06 23:52:50', '2022-09-06 23:52:50', NULL, NULL),
(169, 231, 3, 'null', 'null', NULL, NULL, 1, '2', 0, '2022-09-06 23:53:17', '2022-09-06 23:52:59', '2022-09-06 23:53:17', NULL, NULL),
(170, 231, 6, NULL, NULL, NULL, NULL, 1, '3', 4.6, '2022-09-07 00:16:16', '2022-09-07 00:16:04', '2022-09-07 00:16:16', NULL, NULL),
(171, 231, 6, NULL, NULL, NULL, NULL, 1, '3', 0, '2022-09-07 00:16:16', '2022-09-07 00:16:04', '2022-09-07 00:16:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `dough_type_id` int(11) DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dough_type_2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `dough_type_id`, `image`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`, `dough_type_2_id`) VALUES
(2, 19, 'الزعتر', 'Zaatar', 'الزعتر', 'Zaater', NULL, '/categories/1658215588زعتر.jpg', NULL, NULL, NULL, '2022-07-19 21:26:28', '2022-07-19 21:26:28', NULL),
(3, 19, 'اللبنة', 'Lebnah', 'اللبنة', 'Lebnah', NULL, '/categories/1658215668لبنة 2.jpg', NULL, NULL, NULL, '2022-07-19 21:27:48', '2022-07-19 21:27:48', NULL),
(4, 19, 'الجبن', 'Cheese', 'الجبن', 'Cheese', NULL, '/categories/1658215764جبن بيض.jpg', NULL, NULL, NULL, '2022-07-19 21:29:24', '2022-07-19 21:29:24', NULL),
(5, 19, 'الجبن السائل', 'liquid cheese', 'الجبن السائل', 'liquid cheese', NULL, '/categories/1658215881جبن سائل.jpg', NULL, NULL, NULL, '2022-07-19 21:31:21', '2022-07-19 21:31:21', NULL),
(6, 20, 'الفلافل', 'falafel', 'الفلافل', 'falafel', NULL, '/categories/16582160831641972211QEuV9C.jpeg', NULL, NULL, NULL, '2022-07-19 21:34:43', '2022-07-19 21:34:43', NULL),
(7, 20, 'شكشوكة', 'Shakshuka', 'شكشوكة', 'Shakshuka', NULL, '/categories/1658216185شكشوكة.jpeg', NULL, NULL, NULL, '2022-07-19 21:36:25', '2022-07-19 21:36:25', NULL),
(8, 20, 'سبانخ', 'spinach', 'سبانخ', 'spinach', NULL, '/categories/1658216283cWiHFeiNBMXukPi4WrEI.jpeg', NULL, NULL, NULL, '2022-07-19 21:38:03', '2022-08-07 21:27:13', NULL),
(9, 20, 'لحم بالعجين', 'meat with dough', 'لحم بالعجين', 'meat with dough', NULL, '/categories/165821642816419736015I8MUd.jpeg', NULL, NULL, NULL, '2022-07-19 21:40:28', '2022-07-19 21:40:28', NULL),
(10, 20, 'المشويات', 'Barbecue', 'المشويات', 'Barbecue', NULL, '/categories/1658216510Barbecue.jpeg', NULL, NULL, NULL, '2022-07-19 21:41:50', '2022-07-19 21:41:50', NULL),
(11, 20, 'هوت دوج', 'Hotdog', 'هوت دوج', 'Hotdog', NULL, '/categories/1658216563Hotdog.jpeg', NULL, 93, NULL, '2022-07-19 21:42:43', '2022-08-30 00:26:32', NULL),
(12, 21, 'سويت باستري', 'Sweet', 'سويت باستري', 'Sweet', NULL, '/categories/1658216668Sweet.jpeg', NULL, 93, NULL, '2022-07-19 21:44:28', '2022-08-30 00:26:22', NULL),
(13, 21, 'البيتزا', 'Pizza', 'البيتزا', 'Pizza', NULL, '/categories/16582167201642011197bduIkJ.jpeg', NULL, NULL, NULL, '2022-07-19 21:45:20', '2022-07-19 21:45:20', NULL),
(14, 21, 'الوجبات العائلية', 'family meals', 'الوجبات العائلية', 'family meals', NULL, '/categories/16582167811625346023145ko1.jpg', NULL, 225, NULL, '2022-07-19 21:46:21', '2022-08-21 22:42:08', NULL),
(15, 21, 'المشروبات', 'Drinks', 'المشروبات', 'Drinks', NULL, '/categories/16582168411625346199gu54fp.jpg', NULL, NULL, '2022-08-08 18:35:54', '2022-07-19 21:47:21', '2022-08-08 18:35:54', NULL),
(16, 21, 'الأصناف الجديدة', 'New items', 'الأصناف الجديدة', 'New items', NULL, '/categories/16582169481625346199gu54fp.jpg', NULL, 91, '2022-08-08 18:35:50', '2022-07-19 21:49:08', '2022-08-08 18:35:50', NULL),
(17, 20, 'reftf', 'rrefrf', 'poi', 'sdfhf', NULL, '', NULL, NULL, '2022-08-07 21:26:16', '2022-08-07 16:41:16', '2022-08-07 21:26:16', NULL),
(18, 19, 'المشروبات', 'Drinks', 'zdasdasd', 'aweweaweawe', NULL, '/categories/166179426816582168411625346199gu54fp.jpg', NULL, NULL, NULL, '2022-08-30 00:31:08', '2022-08-30 00:31:08', NULL),
(19, NULL, 'رجالى', 'Men', 'ملابس', 'men cloths', NULL, '/categories/1658216283cWiHFeiNBMXukPi4WrEI.jpeg', NULL, NULL, NULL, '2022-09-20 17:13:15', '2022-09-20 17:13:15', NULL),
(20, NULL, 'نسائية', 'Women', 'نسائية', 'women', NULL, '/categories/1658216510Barbecue.jpeg', NULL, NULL, NULL, '2022-09-20 17:15:17', '2022-09-20 17:15:17', NULL),
(21, NULL, 'أطفال', 'Kids', 'أطفال', 'Kids', NULL, '/categories/1658215588زعتر.jpg', NULL, NULL, NULL, '2022-09-20 17:16:15', '2022-09-20 17:16:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_extra`
--

CREATE TABLE `category_extra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `extra_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'الرياض', 'Riyadh', '', '', NULL, '2020-02-11 10:31:52', '2020-02-11 10:31:52'),
(13, 'الدمام', 'Dammam', '', '', NULL, '2020-02-11 10:31:52', '2020-02-11 10:31:52'),
(31, 'الخبر', 'Al Khobar', '', '', NULL, '2020-02-11 10:31:52', '2020-02-11 10:31:52'),
(23421, 'الاحساء', 'Al Ahsa', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `subject`, `body`, `customer_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:14:26', '2020-09-22 15:14:26'),
(2, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:52:05', '2020-09-22 15:52:05'),
(3, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:53:14', '2020-09-22 15:53:14'),
(4, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:53:56', '2020-09-22 15:53:56'),
(5, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:54:53', '2020-09-22 15:54:53'),
(6, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:57:10', '2020-09-22 15:57:10'),
(7, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:57:38', '2020-09-22 15:57:38'),
(8, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:58:25', '2020-09-22 15:58:25'),
(9, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:58:43', '2020-09-22 15:58:43'),
(10, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 15:59:59', '2020-09-22 15:59:59'),
(11, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 16:01:01', '2020-09-22 16:01:01'),
(12, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 16:01:49', '2020-09-22 16:01:49'),
(13, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 16:02:11', '2020-09-22 16:02:11'),
(14, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 16:03:50', '2020-09-22 16:03:50'),
(15, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 16:06:10', '2020-09-22 16:06:10'),
(16, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 16:06:43', '2020-09-22 16:06:43'),
(17, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-22 16:08:53', '2020-09-22 16:08:53'),
(18, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-23 14:41:43', '2020-09-23 14:41:43'),
(19, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-23 17:54:39', '2020-09-23 17:54:39'),
(20, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-23 17:58:44', '2020-09-23 17:58:44'),
(21, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-30 13:48:41', '2020-09-30 13:48:41'),
(22, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-30 16:02:26', '2020-09-30 16:02:26'),
(23, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-09-30 16:03:55', '2020-09-30 16:03:55'),
(24, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-10-01 16:58:17', '2020-10-01 16:58:17'),
(25, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-10-07 13:58:02', '2020-10-07 13:58:02'),
(26, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-10-07 14:00:44', '2020-10-07 14:00:44'),
(27, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-10-07 14:03:09', '2020-10-07 14:03:09'),
(28, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-10-07 14:03:22', '2020-10-07 14:03:22'),
(29, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-10-19 18:14:30', '2020-10-19 18:14:30'),
(30, 'شكوى', 'هناك مشكلة', 70, NULL, '2020-11-10 22:08:34', '2020-11-10 22:08:34'),
(31, 'شكوى', 'هناك رسالة', 70, NULL, '2020-11-10 22:19:43', '2020-11-10 22:19:43'),
(32, 'test', 'test', 70, NULL, '2020-11-10 22:40:13', '2020-11-10 22:40:13'),
(33, 'Can not make reorder', 'all are 0', 70, NULL, '2020-11-16 00:39:08', '2020-11-16 00:39:08'),
(34, 'problem', 'I have a problem', 70, NULL, '2020-12-23 21:32:40', '2020-12-23 21:32:40'),
(35, 'Test', 'Test Body', 70, NULL, '2020-12-24 00:48:53', '2020-12-24 00:48:53'),
(36, 'مشكلة فى الاوردر', 'الاوردر طويل خالص ولا يوجد فيه اى مشكلة عامة', 70, NULL, '2020-12-30 20:34:01', '2020-12-30 20:34:01'),
(37, 'Testing', 'fffffff', 70, NULL, '2021-06-09 23:46:39', '2021-06-09 23:46:39'),
(38, 'شكوى', 'هناك مشكلة', 70, NULL, '2021-06-11 04:51:26', '2021-06-11 04:51:26'),
(39, 'Test', 'test', 70, NULL, '2021-08-13 06:03:01', '2021-08-13 06:03:01'),
(43, 'complain', 'complain', 70, NULL, '2021-09-29 13:04:40', '2021-09-29 13:04:40'),
(44, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:14:23', '2022-08-09 19:14:23'),
(45, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:14:53', '2022-08-09 19:14:53'),
(46, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:16:15', '2022-08-09 19:16:15'),
(47, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:16:49', '2022-08-09 19:16:49'),
(48, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:17:08', '2022-08-09 19:17:08'),
(49, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:17:54', '2022-08-09 19:17:54'),
(50, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:18:23', '2022-08-09 19:18:23'),
(51, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:19:57', '2022-08-09 19:19:57'),
(52, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:26:34', '2022-08-09 19:26:34'),
(53, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:26:46', '2022-08-09 19:26:46'),
(54, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:26:57', '2022-08-09 19:26:57'),
(55, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 19:27:09', '2022-08-09 19:27:09'),
(56, 'شكوى', 'هناك مشكلة', 70, NULL, '2022-08-09 20:26:00', '2022-08-09 20:26:00'),
(57, 'Suggestions', 'rwerwerwerwe wer wer', 91, NULL, '2022-08-11 20:15:09', '2022-08-11 20:15:09'),
(58, 'Suggestions', 'asdasd asd asd', 91, NULL, '2022-08-11 20:16:27', '2022-08-11 20:16:27'),
(59, 'Suggestions', 'asd asd asd asd asd asd', 91, NULL, '2022-08-11 20:16:55', '2022-08-11 20:16:55'),
(60, 'Suggestions', 'fsd we qwe qweq', 91, NULL, '2022-08-11 20:18:11', '2022-08-11 20:18:11'),
(61, 'Suggestions', 'asd asd asdasd asd asd asd', 93, NULL, '2022-08-15 17:32:34', '2022-08-15 17:32:34'),
(62, 'Suggestions', 'asd asd asdasd asd asd asd', 93, NULL, '2022-08-15 17:33:06', '2022-08-15 17:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `second_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `dough_types`
--

CREATE TABLE `dough_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dough_type_id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `dough_types`
--

INSERT INTO `dough_types` (`id`, `dough_type_id`, `name_ar`, `name_en`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 1, 'بر', 'Borr', NULL, NULL, NULL),
(6, 1, 'عادي', 'normal', NULL, NULL, NULL),
(7, 2, 'سميكة', 'Thick', NULL, NULL, NULL),
(8, 2, 'رقيقة', 'Thin', NULL, NULL, NULL),
(9, 0, 'بر', 'Borr', NULL, '2022-09-08 19:08:30', '2022-09-08 19:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `price` double NOT NULL,
  `calories` double NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `price`, `calories`, `category_id`, `deleted_at`, `created_at`, `updated_at`, `image`) VALUES
(1, 'تنشسايتنشساي', 'asldasdhjk', 'شسنمياشستنياشستنايتنشسا يشستايتنشس', 'kljhaskldh asjkdh asjkdhasjkdhjkasdh', 25, 350, 2, NULL, '2022-08-11 20:32:57', '2022-08-11 20:32:57', '/extras/16602247771619348028lPato1ZXYe7HyqKU4hndpKIPsSyfR9zNYD2nFg0z.jpeg'),
(2, 'صصصصشيشسي', 'aisludasndjkh', 'شسيتن اشلاستي لشسي شسيشسايل', 'asdlh asjkdh asjkdh asjkdhasjkhdjk ashdjkashd', 5, 250, 2, NULL, '2022-08-11 20:33:38', '2022-08-11 20:33:38', '/extras/16602248181649507652careers.jpg'),
(3, 'ضضضضشسي شسي', 'asl;dj askld asdh', 'asd asd asd asdasd', 'sad asd wrxcvxc asedasd', 25, 10, 2, NULL, '2022-08-11 20:34:03', '2022-08-11 20:34:03', '/extras/16602248431647948321DSC_8300.jpg'),
(4, 'صصصصشيشسي', 'asdasdasd', 'asdasdasd', 'asdasdasd asd', 33, 2232, 6, NULL, '2022-08-13 18:35:30', '2022-08-13 18:35:30', '/extras/16603905300fkwZat5TdiwAqzQXjDm8gRyTVMcIOOKpqWqf1wg.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_item`
--

CREATE TABLE `favourite_item` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `favourite_item`
--

INSERT INTO `favourite_item` (`user_id`, `item_id`) VALUES
(204, 5),
(204, 5),
(204, 5),
(204, 5),
(204, 5),
(204, 5),
(204, 5),
(204, 5),
(231, 19);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title_ar`, `title_en`, `url`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'اليوم الاسود', 'HOW WE BEGIN', '/gallery/1660215139165286387212.jpg', NULL, '2022-08-11 17:52:19', '2022-08-11 17:52:19'),
(2, 'شستنياشستي', 'uioyashbndj', '/gallery/1619347674r55Iv4Iy1yo1MmzQYVCfPMsdjsGLEwg8TPGbVvpT.png', NULL, NULL, NULL),
(3, 'شسمنياشس', 'wewewe', '/gallery/1619348028lPato1ZXYe7HyqKU4hndpKIPsSyfR9zNYD2nFg0z.jpeg', NULL, NULL, NULL),
(4, 'asdasd', 'wwewew', '/gallery/1647948321DSC_8300.jpg', NULL, NULL, NULL),
(5, 'qqqqq', 'asxcvxc', '/gallery/1652855928DSC_9199.jpg', NULL, NULL, NULL),
(6, 'ewewe', 'vdfdf', '/gallery/16528586463.jpg', NULL, NULL, NULL),
(7, 'oiuius', 'jkljasj', '/gallery/1649507652careers.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `id` int(11) NOT NULL,
  `key` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `for` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`id`, `key`, `value`, `deleted_at`, `for`) VALUES
(1, 'pointsValue', '20', NULL, 100),
(2, 'pointsValue', '30', '2022-08-13 19:30:58', 400),
(3, 'pointsValue', '32', '2022-08-13 19:31:03', 3323),
(4, 'pointsValue', '33', '2022-08-13 19:30:53', 111),
(5, 'pointsValue', '22', '2022-08-13 19:31:00', 6464),
(6, 'pointsValue', '22', '2022-08-13 19:30:50', 3333),
(7, 'pointsValue', '50', NULL, 200),
(8, 'pointsValue', '150', NULL, 500);

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `name`, `name_en`, `points`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ميكروويف', 'microwave', 300, '/branchs/16617790341632145443microwave.jpeg', NULL, '2022-08-29 20:17:14', '2022-08-29 20:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `gifts_orders`
--

CREATE TABLE `gifts_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `gifts_order_items`
--

CREATE TABLE `gifts_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gifts_order_id` bigint(20) UNSIGNED NOT NULL,
  `gift_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `health_infos`
--

CREATE TABLE `health_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `health_infos`
--

INSERT INTO `health_infos` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `deleted_at`, `created_at`, `updated_at`, `image`) VALUES
(1, 'سشياشستنياشستنيا', 'asdjashdjkashd', 'شسيمنشستينمتشسنيتشستنيا شستنياتنشاي تنشساي تنشسايتناشس تنياشستنياشستنياتنشس ايتنشسا يتنا شستنياشستنياتنشسياتنشساي', 'asdklhasjk dhasjkdh jashd jashd klasdhjk ashdjkashd jkashdjas hdjkash dashd askldh jkasdh klashdjkasdhjkasdhjkasas asd asd', '2022-08-10 21:37:48', '2022-08-10 21:07:16', '2022-08-10 21:37:48', NULL),
(2, 'اليوم الاسود', 'asdjashdjkashd', 'شسيمنشستينمتشسنيتشستنيا شستنياتنشاي تنشساي تنشسايتناشس تنياشستنياشستنياتنشس ايتنشسا يتنا شستنياشستنياتنشسياتنشساي', 'alskdj klashd asjdh asjkdyh jkashd jasdhjahd jkashd hasdjh asjkdh askjdh asjkdhww', '2022-08-10 21:37:45', '2022-08-10 21:07:37', '2022-08-10 21:37:45', NULL),
(3, 'ششششش', 'wwwwwwwasdadwe', 'نمشسيى تشسلايتن شسلاي شسلايتشسلاي تشسايتنشسايتناشستنياشس شسةىي شستنيلا تذ', 'asmkd basmndb asjkdumcv,xngkdftgisopriuasiohdjkasdhjk hasldk asiod', '2022-08-10 21:37:42', '2022-08-10 21:08:36', '2022-08-10 21:37:42', NULL),
(4, 'اليوم الاسود25', 'qwqwqwqwqw', 'شسيغاىرلاءؤرهفةوىئةوؤىئءةوؤىةوىئءؤةى ئءةؤىةو ئءلاؤشسعه يعهشسياشستنيلاعغعاشسعيال', 'askjdgh asnd asdhk ashdkl asdasbmnzxbcmnvxcvxm,vzkl diosfhjsdkf jsgafgfuystgfui mnsdfg', '2022-08-10 21:37:40', '2022-08-10 21:09:03', '2022-08-10 21:37:40', NULL),
(5, 'ششششش', 'asdjashdjkashd', 'شسي نتشسن اتل يشسلي شبيسيال بسيلبا شسيلب شليسب شسيخحبع سيشع هبشسيانتيبغعهذ', 'as dhjfsdajb fasdgfjksdagf gasdf sdjhfklhjkhsdjkagfasdgf', '2022-08-10 21:37:37', '2022-08-10 21:09:27', '2022-08-10 21:37:37', NULL),
(6, 'ششششش', 'asdjashdjkashd', 'شسينم شساي اشستنيا شسي شسىتنيلا شستةىئؤلاءىرلاشسيخحسشيخحشسهي', 'aslnd jkash dagsdf asbsdjfhsdjfkljasd mfsdjkfhajksfh jksdfsdghfhgsdf', '2022-08-10 21:37:34', '2022-08-10 21:34:38', '2022-08-10 21:37:34', NULL),
(7, 'اليوم الاسود', 'asdjashdjkashd', 'شس يةشهخسغعيشسعهي شسلاةىي لشسعغيف شسعهي شسيتشسنيا', 'askl dbasmnvxcjhzguiahsd ajsdfp sfusdhf ajksdfhsdjkfyasduify', '2022-08-10 21:37:27', '2022-08-10 21:37:06', '2022-08-10 21:37:27', NULL),
(8, 'اليوم الاسود25', 'black Day', 'سيبناسيبى سيتنبل لشسي شسي لاشستنياشسياشسنميتنمشساي', 'aslkh dasmdhasjhd asdklasjd lasudasiouydiasy dhasmndasjkdghasjdghjkas hashdj khas', '2022-08-10 21:42:28', '2022-08-10 21:39:39', '2022-08-10 21:42:28', NULL),
(9, 'اليوم الاسود', 'asd asd asd asdweaszxc', 'شسمن يشتلاى يشسنتيفغ شسيف شسغيف شسيلا شسيتنلشس', 'as jkdgasdnasvbdn fasduyt asyudtasdj asdjkdyasuidgjh aswwe', '2022-08-10 21:53:04', '2022-08-10 21:42:48', '2022-08-10 21:53:04', NULL),
(10, 'اليوم الاسود', 'asd asd asd asdasd', 'اليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسوداليوم الاسود', 'asdasdzxczxdc asdas dasdasd', '2022-08-10 21:53:19', '2022-08-10 21:51:48', '2022-08-10 21:53:19', NULL),
(11, 'اليوم الاسود', 'wasd vxcfgvsdfsdf', 'asd asd asklhd asjkdh asjkhdjkashd', 'asdj askldhn asmdgashasjkdhasjkhdjkas', '2022-08-10 21:53:22', '2022-08-10 21:52:31', '2022-08-10 21:53:22', NULL),
(12, 'اليوم الاسود', 'wasd vxcfgvsdfsdf', 'asd asd asklhd asjkdh asjkhdjkashd', 'asdj askldhn asmdgashasjkdhasjkhdjkas', '2022-08-10 21:53:25', '2022-08-10 21:52:50', '2022-08-10 21:53:25', '/health_infos/post-6.jpg'),
(13, 'القمح - الطحين', 'Wheat - flour', 'للقمح العديد من الفوائد الصحية المذهلة، وخاصةً عند تناول منتجات القمح المصنوعة من الحبوب￼￼￼￼\r\nالكاملة، وفيما يأتي أهم هذه الفوائد:\r\n\r\n1. زيادة طاقة وحيوية الجسم\r\n2. تحسين عمليات الايض والهضم وتعزيز صحة الامعاء\r\n3. الحماية من حصى المرارة\r\n4. تزويد الجسم من الالياف النافعة', 'Wheat has many amazing health benefits, especially when eating wheat products made from grains\r\ncomplete, and the following are the most important of these benefits:\r\n\r\n1. Increase the energy and vitality of the body\r\n2. Improving metabolism and digestion and promoting bowel health \r\n3. Protection from gallstones\r\n4. Providing the body with beneficial fibers', NULL, '2022-08-10 21:52:59', '2022-08-29 22:55:15', '/health_infos/post-5.jpg'),
(14, 'الزعتر', 'Thyme', '1- مضاد حيوي طبيعي\r\n2- مفيد للجهاز التنفسي\r\n3- مفيد للجهاز الهضمي 4- مكافح للأمراض السرطانية\r\n5- غني بالفيتامينات (فيتامين أ و ج و ب)', '1- A natural antibiotic\r\n2- Beneficial for the respiratory system\r\n3- Useful for the digestive system 4- Fighting cancerous diseases\r\n5- Rich in vitamins (vitamins A, C and B)', NULL, '2022-08-10 21:53:45', '2022-08-29 22:55:42', '/health_infos/post-4.jpg'),
(15, 'النعناع', 'Mint', '1. السيطرة على اضطرابات المعدة ومتلازمة القولون العصبي\r\n2. السيطرة على تشنجات المريء\r\n3. يساعد في علاج حالات الصداع\r\n4. التخلص من رائحة الفم الكريهة\r\n5. التخفيف من انسدادالجيوب الأنفية والأعراض المصاحبة للبرد\r\n6. يخفف من الحساسية الموسمية\r\n7. تخفيف حالات الغثيان الناتج عن تلقي العلاج الكيميائي', '1. Control stomach disorders and irritable bowel syndrome\r\n2. Control of esophageal spasms\r\n3. Helps treat headaches\r\n4. Get rid of bad breath\r\n5. Reducing blocked sinuses and symptoms associated with a cold\r\n6. Relieves seasonal allergies\r\n7. Reducing nausea caused by chemotherapy', NULL, '2022-08-10 21:54:08', '2022-08-29 22:56:11', '/health_infos/post-1.jpg'),
(16, 'السمسم', 'Sesame', '1. تنظيم ضغط الدم\r\n 2. المحافظة على صحة القلب\r\n3. تنظيم مستويات الهرمونات\r\n4. خفض مستويات الكولسترول\r\n5. محاربة الالتهابات\r\n6. محاربة السرطانات\r\n7. يعزز من فعالية أدوية السكري', '1. Regulating blood pressure\r\n  2. Maintain a healthy heart\r\n3. Regulating hormone levels\r\n4. Lower cholesterol levels\r\n5. Fight infections\r\n6. Fighting cancers\r\n7. Enhances the effectiveness of diabetes drugs', NULL, '2022-08-10 21:54:43', '2022-08-29 22:56:36', '/health_infos/post-3.jpg'),
(17, 'البيض', 'Eggs with cheese', '1. غذاء متكامل للإنسان\r\n2. تحسين صحة الدماغ\r\n3. منع فقرالدم\r\n4. تحسين صحة الجنين تقوية العظام\r\n5. بناء العضلات\r\n6. تحسين صحة الجلد', '1. Complete food for man\r\n2. Improve brain health\r\n3. Prevent anemia\r\n4. Improving the health of the fetus, strengthening the bones\r\n5. Build muscle\r\n6. Improve skin health', NULL, '2022-08-29 22:58:13', '2022-08-29 22:58:13', '/health_infos/1661788693post-2 (1).jpg'),
(18, 'زيت الزيتون', 'olive oil', '1. يعزز من صحة الأمعاء\r\n￼￼￼￼ 2. يعزز من صحة القلب والجهاز الدوراني\r\n 3. يقلل من خطر الإصابة بالسرطان \r\n4. يحمي الكبد \r\n5. يمنع الإصابة بالزهايمر', '1. Promotes gut health\r\n2. Promotes the health of the heart and circulatory system\r\n  3. Reduces the risk of cancer\r\n4. Protects the liver\r\n5. Prevents Alzheimer\'s disease', NULL, '2022-08-29 22:58:52', '2022-08-29 22:58:52', '/health_infos/1661788732post-1 (1).jpg'),
(19, 'السبانخ', 'Spinach', '1. الوقاية من السرطان\r\n2. دعم جهازالمناعة\r\n3. تنظيم ضغط الدم\r\n4. الحفاظ على صحة جهاز الدوران\r\n5. تحسين الهضم\r\n6. الحفاظ على صحة العظام\r\n7. الوقاية منفقرالدم\r\n8. المساعدة في خسارة الوزن', '1. Cancer prevention\r\n2. Support the immune system\r\n3. Regulating blood pressure\r\n4. Maintain the health of the circulatory system\r\n5. Improve digestion\r\n6. Maintain bone health\r\n7. Prevention of anemia\r\n8. Helping lose weight', NULL, '2022-08-29 22:59:33', '2022-08-29 22:59:33', '/health_infos/1661788773post-6 (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `home_item`
--

CREATE TABLE `home_item` (
  `id` bigint(20) NOT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_item`
--

INSERT INTO `home_item` (`id`, `description_en`, `description_ar`, `item_id`, `category_id`, `number`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Family Box', 'مشكل الصفائح', 57, 9, 1, '/items/1662289660صور الموقع home items-01.jpg', '2022-08-17 19:01:28', '2022-09-04 18:07:40', NULL),
(2, 'zaatar', 'زعتر', 2, 2, 2, '/items/1662289710صور الموقع home items-02.jpg', '2022-08-17 18:29:17', '2022-09-04 18:08:30', NULL),
(3, 'Falafel', 'فلافل', 7, 6, 3, '/items/1662289779صور الموقع home items-03.jpg', '2022-08-17 18:32:29', '2022-09-04 18:09:39', NULL),
(4, 'The three cheeses', 'الأجبان الثلاثة', 22, 4, 4, '/items/1662289907صور الموقع home items-04.jpg', '2022-08-17 18:32:29', '2022-09-04 18:11:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `price` double NOT NULL,
  `calories` double NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branches` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `best_seller` enum('activate','deactivate') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'deactivate',
  `view` tinyint(1) NOT NULL DEFAULT '1',
  `recommended` tinyint(1) DEFAULT '0',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `website_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `price`, `calories`, `image`, `branches`, `best_seller`, `view`, `recommended`, `category_id`, `deleted_at`, `created_at`, `updated_at`, `website_image`) VALUES
(2, 'زعتر', 'Zaatar', 'زعتر', 'Zaater', 2.3, 660, '/items/1658217234zatar.jpg', NULL, 'activate', 1, 0, 2, NULL, '2022-07-19 21:53:54', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658217234zatar.jpg'),
(3, 'زعتر مملكة المعجنات', 'Zaatar kingdom of pastries', 'زعتر مملكة المعجنات', 'Zaatar kingdom of pastries', 5.75, 620, '/items/1658217349زعتر مملكة المعجنات.jpg', NULL, 'deactivate', 1, 0, 2, NULL, '2022-07-19 21:55:49', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658217349زعتر مملكة المعجنات.jpg'),
(4, 'زعتر مشكل', 'Zaater Mix', 'زعتر مشكل', 'Zaater Mix', 6.9, 620, '/items/1658217535زعتر مشكل .jpg', NULL, 'activate', 1, 0, 2, NULL, '2022-07-19 21:58:55', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658217535زعتر مشكل .jpg'),
(5, 'فلافل', 'falafel', 'فلافل', 'falafel', 4.6, 700, '/items/1658217631فلافل.jpg', NULL, 'deactivate', 1, 0, 6, NULL, '2022-07-19 22:00:31', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658217631فلافل.jpg'),
(6, 'فلافل باللبنة', 'Falafel with Labneh', 'فلافل باللبنة', 'Falafel with Labneh', 8.05, 780, '/items/1658217718فلافل لبنة.jpg', NULL, 'deactivate', 1, 0, 6, NULL, '2022-07-19 22:01:58', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658217718فلافل لبنة.jpg'),
(7, 'فلافل بالشيدر', 'Falafel with Cheddar', 'فلافل بالشيدر', 'Falafel with Cheddar', 8.05, 820, '/items/1658217954فلافل جبن شيدر.jpg', NULL, 'deactivate', 1, 0, 6, NULL, '2022-07-19 22:05:54', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658217954فلافل جبن شيدر.jpg'),
(8, 'لبنة', 'Lebnah', 'لبنة', 'Lebnah', 6.9, 500, '/items/1658218050لبنة.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:07:30', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218050لبنة.jpg'),
(9, 'لبنة ألبيستو', 'Labneh Albesto', 'لبنة ألبيستو', 'Labneh Albesto', 12, 532, '/items/1658218249لبنة بيستو.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:10:49', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218249لبنة بيستو.jpg'),
(10, 'لبنة بالجبن', 'Labneh With Cheese', 'لبنة بالجبن', 'Labneh With Cheese', 8.05, 580, '/items/1658218341لبنة.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:12:21', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218341لبنة.jpg'),
(11, 'لبنة بالذرة', 'Labneh With Corn', 'لبنة بالذرة', 'Labneh With Corn', 8.05, 640, '/items/1658218459لبنة ذرة.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:14:19', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218459لبنة ذرة.jpg'),
(12, 'لبنة بالزعتر', 'Labneh With Zaater', 'لبنة بالزعتر', 'Labneh With Zaater', 8.05, 520, '/items/1658218537لبنة زعتر 2.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:15:37', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218537لبنة زعتر 2.jpg'),
(13, 'لبنة بالزيتون', 'Labneh With Olives', 'لبنة بالزيتون', 'Labneh With Olives', 8.05, 510, '/items/1658218606لبنة بالزيتون.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:16:46', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218606لبنة بالزيتون.jpg'),
(14, 'لبنة بالنعناع', 'Labneh With Mint', 'لبنة بالنعناع', 'Labneh With Mint', 8.05, 505, '/items/1658218675لبنة نعناع.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:17:55', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218675لبنة نعناع.jpg'),
(15, 'لبنة بالطماطم', 'Labneh With Tomato', 'لبنة بالطماطم', 'Labneh With Tomato', 8.05, 505, '/items/1658218742لبنة طماطم 2.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:19:02', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218742لبنة طماطم 2.jpg'),
(16, 'لبنة بالجبن والزعتر', 'Labneh with Cheese and Zaater', 'لبنة بالجبن والزعتر', 'Labneh with Cheese and Zaater', 9.2, 610, '/items/1658218834لبنة جبن زعتر.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:20:34', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218834لبنة جبن زعتر.jpg'),
(17, 'لبنة بالجبن والبيض', 'Labneh with cheese and eggs', 'لبنة بالجبن والبيض', 'Labneh with cheese and eggs', 10.35, 630, '/items/1658218931لبنة جبن بيض.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:22:11', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658218931لبنة جبن بيض.jpg'),
(18, 'لبنة بالجبن والزيتون', 'Labneh with cheese and olives', 'لبنة بالجبن والزيتون', 'Labneh with cheese and olives', 9.2, 590, '/items/1658219025لبنة بالزيتون.jpg', NULL, 'deactivate', 1, 0, 3, NULL, '2022-07-19 22:23:45', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219025لبنة بالزيتون.jpg'),
(19, 'صفائح جبن', 'cheese sheets', 'صفائح جبن', 'cheese sheets', 8.05, 610, '/items/1658219172جبن مازورلا 2.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:26:12', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219172جبن مازورلا 2.jpg'),
(20, 'جبن شيدر', 'cheddar cheese', 'جبن شيدر', 'cheddar cheese', 6.9, 540, '/items/1658219235جبن شيدر.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:27:15', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219235جبن شيدر.jpg'),
(21, 'جبن مملكة المعجنات', 'Kingdom cheese', 'جبن المملكة', 'Kingdom cheese', 6.9, 560, '/items/16582193521612556666-2.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:29:12', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/16582193521612556666-2.jpg'),
(22, 'جبن موزريلا', 'Mozzarella', 'جبن موزريلا', 'Mozzarella', 6.9, 520, '/items/1658219433جبن مازورلا 2.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:30:33', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219433جبن مازورلا 2.jpg'),
(23, 'جبن بالنعناع', 'mint cheese', 'جبن بالنعناع', 'mint cheese', 8.05, 525, '/items/1658219509جبن نعناع.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:31:49', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219509جبن نعناع.jpg'),
(24, 'جبن بالزيتون', 'cheese with olives', 'جبن بالزيتون', 'cheese with olives', 8.05, 530, '/items/1658219654جبن زيتون.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:34:14', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219654جبن زيتون.jpg'),
(25, 'جبن بالطماطم', 'tomato cheese', 'جبن بالطماطم', 'tomato cheese', 8.05, 525, '/items/1658219758جبن طماطم.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:35:58', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219758جبن طماطم.jpg'),
(26, 'جبن بالذرة', 'corn cheese', 'جبن بالذرة', 'corn cheese', 8.05, 660, '/items/1658219834جبن ذرة 2.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:37:14', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219834جبن ذرة 2.jpg'),
(27, 'جبن بالزعتر', 'cheese with Zaater', 'جبن بالزعتر', 'cheese with Zaater', 8.05, 550, '/items/1658219913جبن بالزعتر.jpeg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:38:33', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219913جبن بالزعتر.jpeg'),
(28, 'جبن بالبيض', 'cheese with eggs', 'جبن بالبيض', 'cheese with eggs', 9.2, 590, '/items/1658219984جبن بيض.jpg', NULL, 'deactivate', 1, 0, 4, NULL, '2022-07-19 22:39:44', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658219984جبن بيض.jpg'),
(29, 'جبن سائل', 'liquid cheese', 'جبن سائل', 'liquid cheese', 8.05, 580, '/items/1658220061جبن سائل.jpg', NULL, 'deactivate', 1, 0, 5, NULL, '2022-07-19 22:41:01', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220061جبن سائل.jpg'),
(30, 'جبن سائل بالخضار', 'Soft cheese with vegetables', 'جبن سائل بالخضار', 'Soft cheese with vegetables', 9.2, 600, '/items/1658220134جبن سائل خضار 2.jpg', NULL, 'deactivate', 1, 0, 5, NULL, '2022-07-19 22:42:14', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220134جبن سائل خضار 2.jpg'),
(31, 'جبن سائل بالزيتون', 'Cheese with olives', 'جبن سائل بالزيتون', 'Cheese with olives', 9.2, 590, '/items/1658220202جبن سائل زيتون 2.jpg', NULL, 'deactivate', 1, 0, 5, NULL, '2022-07-19 22:43:22', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220202جبن سائل زيتون 2.jpg'),
(32, 'جبن سائل بالنعناع', 'Cottage cheese with mint', 'جبن سائل بالنعناع', 'Cottage cheese with mint', 9.2, 585, '/items/1658220342جبن سائل نعناع 2.jpg', NULL, 'deactivate', 1, 0, 5, NULL, '2022-07-19 22:45:42', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220342جبن سائل نعناع 2.jpg'),
(33, 'جبن سائل بالذرة', 'cream cheese with corn', 'جبن سائل بالذرة', 'cream cheese with corn', 9.2, 720, '/items/1658220468جبن سائل ذرة 3.jpg', NULL, 'deactivate', 1, 0, 5, NULL, '2022-07-19 22:47:48', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220468جبن سائل ذرة 3.jpg'),
(34, 'شكشوكة', 'Shakshuka', 'شكشوكة', 'Shakshuka', 6.9, 520, '/items/1658220537شكشوكة 2.jpg', NULL, 'deactivate', 1, 0, 7, NULL, '2022-07-19 22:48:57', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220537شكشوكة 2.jpg'),
(35, 'شكشوكة جبن موزريلا', 'Shakshouka mozzarella cheese', 'شكشوكة جبن موزريلا', 'Shakshouka mozzarella cheese', 8.05, 550, '/items/1658220604شكشوكة جبن موزريلا4.jpg', NULL, 'deactivate', 1, 0, 7, NULL, '2022-07-19 22:50:04', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220604شكشوكة جبن موزريلا4.jpg'),
(36, 'شكشوكة جبن سائل', 'Shakshouka liquid cheese', 'شكشوكة جبن سائل', 'Shakshouka liquid cheese', 8.05, 630, '/items/1658220689شكشوكة جبن سائل 4.jpg', NULL, 'deactivate', 1, 0, 7, NULL, '2022-07-19 22:51:29', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220689شكشوكة جبن سائل 4.jpg'),
(37, 'صفائح سبانخ', 'spinach sheets', 'صفائح سبانخ', 'spinach sheets', 8.05, 450, '/items/1658220769صفائح سبانخ.jpeg', NULL, 'deactivate', 1, 0, 8, NULL, '2022-07-19 22:52:49', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220769صفائح سبانخ.jpeg'),
(38, 'سبانخ بالبيض', 'Spinach with eggs', 'سبانخ بالبيض', 'Spinach with eggs', 8.05, 510, '/items/1658220843سبانخ بالبيض 4.jpg', NULL, 'deactivate', 1, 0, 8, NULL, '2022-07-19 22:54:03', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220843سبانخ بالبيض 4.jpg'),
(39, 'سبانخ جبن موزريلا', 'spinach mozzarella cheese', 'سبانخ جبن موزريلا', 'spinach mozzarella cheese', 8.05, 540, '/items/1658220998سبانخ جبن.jpg', NULL, 'deactivate', 1, 0, 8, NULL, '2022-07-19 22:56:38', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658220998سبانخ جبن.jpg'),
(40, 'سبانخ باللبنة', 'Spinach with Labneh', 'سبانخ باللبنة', 'Spinach with Labneh', 8.05, 530, '/items/1658221071سبانخ لبنة.jpg', NULL, 'deactivate', 1, 0, 8, NULL, '2022-07-19 22:57:51', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221071سبانخ لبنة.jpg'),
(41, 'سبانخ جبن سائل', 'Spinach cheese liquid', 'سبانخ جبن سائل', 'Spinach cheese liquid', 9.2, 520, '/items/1658221144سبانخ جبن سائل.jpg', NULL, 'deactivate', 1, 0, 8, NULL, '2022-07-19 22:59:04', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221144سبانخ جبن سائل.jpg'),
(42, 'سبانخ بالجبن والبيض', 'Spinach with cheese and eggs', 'سبانخ بالجبن والبيض', 'Spinach with cheese and eggs', 10.35, 600, '/items/1658221235سبانخ جبن بيض.jpg', NULL, 'deactivate', 1, 0, 8, NULL, '2022-07-19 23:00:35', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221235سبانخ جبن بيض.jpg'),
(43, 'لحم بالجبن والبيض', 'Meat with cheese and eggs', 'لحم بالجبن والبيض', 'Meat with cheese and eggs', 10.35, 650, '/items/1658221334لحم بالجبن و البيض.jpg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:02:14', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221334لحم بالجبن و البيض.jpg'),
(44, 'صفائح لحم', 'Meat plates', 'صفائح لحم', 'Meat plates', 9.2, 510, '/items/1658221423صفائح لحم بالعجين.jpeg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:03:43', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221423صفائح لحم بالعجين.jpeg'),
(45, 'لحم بالجبن', 'Meat with cheese', 'لحم الجبن', 'Meat with cheese', 9.2, 580, '/items/1658221517لحم بالجبن 3.jpg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:05:17', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221517لحم بالجبن 3.jpg'),
(46, 'لحم بالبيض', 'meat with egg', 'لحم بالبيض', 'meat with egg', 9.2, 560, '/items/1658221611لحم بالبيض 3.jpg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:06:51', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221611لحم بالبيض 3.jpg'),
(47, 'لحم بالزيتون', 'Meat with olives', 'لحم بالزيتون', 'Meat with olives', 9.2, 520, '/items/1658221703لحم بالزيتون 2.jpg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:08:23', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221703لحم بالزيتون 2.jpg'),
(48, 'لحم بالنعناع', 'mint meat', 'لحم بالنعناع', 'mint meat', 9.2, 515, '/items/1658221785لحم بالنعناع 4.jpg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:09:45', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221785لحم بالنعناع 4.jpg'),
(49, 'لحم بالطماط', 'tomato meat', 'لحم بالطماط', 'tomato meat', 9.2, 515, '/items/1658221903لحم بالطماطم 6.jpg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:11:43', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221903لحم بالطماطم 6.jpg'),
(50, 'لحم بالجبن السائل', 'Meat with liquid cheese', 'لحم بالجبن السائل', 'Meat with liquid cheese', 9.2, 620, '/items/1658221975لحم بالجبن السائل.jpg', NULL, 'deactivate', 1, 0, 9, NULL, '2022-07-19 23:12:55', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658221975لحم بالجبن السائل.jpg'),
(51, 'كباب لحم', 'Meat Kebab', 'كباب لحم', 'Meat Kebab', 9.2, 570, '/items/1658222075كباب لحم.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:14:35', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658222075كباب لحم.jpg'),
(52, 'كباب لحم باللبنة', 'Meat Kebab With Labneh', 'كباب لحم باللبنة', 'Meat Kebab With Labneh', 10.35, 640, '/items/1658222153كباب لحم لبنة.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:15:53', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658222153كباب لحم لبنة.jpg'),
(53, 'كباب لحم بالشيدر', 'Cheddar Meat Kebab', 'كباب لحم بالشيدر', 'Cheddar Meat Kebab', 10.35, 680, '/items/1658222762كباب لحم جبن شيدر.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:26:05', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658222762كباب لحم جبن شيدر.jpg'),
(54, 'كباب لحم موزريلا', 'Mozzarella meat kebab', 'كباب لحم موزريلا', 'Mozzarella meat kebab', 10.35, 630, '/items/1658222856كباب لحم جبن مازورلا.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:27:36', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658222856كباب لحم جبن مازورلا.jpg'),
(55, 'كباب دجاج', 'chicken kebab', 'كباب دجاج', 'chicken kebab', 9.2, 570, '/items/1658222941كباب دجاج.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:29:01', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658222941كباب دجاج.jpg'),
(56, 'كباب دجاج باللبنة', 'Labneh Chicken Kebab', 'كباب دجاج باللبنة', 'Labneh Chicken Kebab', 10.35, 650, '/items/1658223017كباب دجاج لبنة.jpeg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:30:17', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223017كباب دجاج لبنة.jpeg'),
(57, 'أوصال لحم', 'Awsal Meat', 'أوصال لحم', 'Awsal Meat', 9.2, 540, '/items/1658223094اوصال لحم 2.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:31:34', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223094اوصال لحم 2.jpg'),
(58, 'أوصال لحم باللبنة', 'Awsal Meat With Labneh', 'أوصال لحم باللبنة', 'Awsal Meat With Labneh', 10.35, 620, '/items/1658223179اوصال لحم لبنة 2.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:32:59', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223179اوصال لحم لبنة 2.jpg'),
(59, 'أوصال لحم بالشيدر', 'Awsal Meat With Cheddar', 'أوصال لحم بالشيدر', 'Awsal Meat With Cheddar', 10.35, 660, '/items/1658223278اوصال لحم جبن شيدر.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:34:38', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223278اوصال لحم جبن شيدر.jpg'),
(60, 'أوصال لحم جبن موزريلا', 'Awsal Mozzarella Cheese', 'أوصال لحم جبن موزريلا', 'Awsal Mozzarella Cheese', 10.35, 600, '/items/1658223369اوصال لحم جبن مازورلا 2.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:36:09', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223369اوصال لحم جبن مازورلا 2.jpg'),
(61, 'كباب دجاج بالشيدر', 'Cheddar chicken kebab', 'كباب دجاج بالشيدر', 'Cheddar chicken kebab', 10.35, 690, '/items/1658223472كباب دجاج شيدر.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:37:52', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223472كباب دجاج شيدر.jpg'),
(62, 'كباب دجاج موزريلا', 'Chicken mozzarella kebab', 'كباب دجاج موزريلا', 'Chicken mozzarella kebab', 10.35, 630, '/items/1658223555كباب دجاج جبن مازورلا.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:39:15', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223555كباب دجاج جبن مازورلا.jpg'),
(63, 'شيش طاووق', 'chicken Grill', 'شيش طاووق', 'chicken Grill', 9.2, 600, '/items/1658223656شيش طاووق 2.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:40:56', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223656شيش طاووق 2.jpg'),
(64, 'شيش طاووق لبنة', 'Shish Tawook Labneh', 'شيش طاووق لبنة', 'Shish Tawook Labneh', 10.35, 680, '/items/1658223730شيش طاووق لبنة 2.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:42:10', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223730شيش طاووق لبنة 2.jpg'),
(65, 'شيش طاووق بالشيدر', 'Shish Tawook with Cheddar', 'شيش طاووق بالشيدر', 'Shish Tawook with Cheddar', 10.35, 720, '/items/1658223870شيش طاووق جبن شيدر 2.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:44:30', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223870شيش طاووق جبن شيدر 2.jpg'),
(66, 'شيش طاووق جبن موزريلا', 'shish tawook mozzarella cheese', 'شيش طاووق جبن موزريلا', 'shish tawook mozzarella cheese', 10.35, 660, '/items/1658223951شيش طاووق جبن مازورلا 6.jpg', NULL, 'deactivate', 1, 0, 10, NULL, '2022-07-19 23:45:51', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658223951شيش طاووق جبن مازورلا 6.jpg'),
(67, 'هوت دوج', 'Hotdog', 'هوت دوج', 'Hotdog', 10.35, 570, '/items/1658224075هوت دوج.jpg', NULL, 'deactivate', 1, 0, 11, NULL, '2022-07-19 23:47:55', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224075هوت دوج.jpg'),
(68, 'هوت دوج بالشيدر', 'Cheddar Hot Dog', 'هوت دوج بالشيدر', 'Cheddar Hot Dog', 11.5, 680, '/items/1658224171هوت دوج شيدار 2.jpg', NULL, 'deactivate', 1, 0, 11, NULL, '2022-07-19 23:49:31', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224171هوت دوج شيدار 2.jpg'),
(69, 'هوت ودج بللبنة', 'Labneh hot dog', 'هوت دوج باللبنة', 'Labneh hot dog', 11.5, 640, '/items/1658224299هوت دوج.jpg', NULL, 'deactivate', 1, 0, 11, NULL, '2022-07-19 23:51:39', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224299هوت دوج.jpg'),
(70, 'حلاوة', 'halawa', 'حلاوة', 'halawa', 6.9, 640, '/items/1658224482حلاوة.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-19 23:54:42', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224482حلاوة.jpg'),
(71, 'حلاوة بالجبن الموزريلا', 'Halawa with mozzarella cheese', 'حلاوة بالجبن الموزريلا', 'Halawa with mozzarella cheese', 8.05, 690, '/items/1658224628حلاوة.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-19 23:57:08', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224628حلاوة.jpg'),
(72, 'جبن بالعسل', 'cheese with honey', 'جبن بالعسل', 'cheese with honey', 8.05, 550, '/items/1658224702جبن بالعسل 2.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-19 23:58:22', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224702جبن بالعسل 2.jpg'),
(73, 'لبنة بالعسل', 'Labneh with honey', 'لبنة بالعسل', 'Labneh with honey', 8.05, 530, '/items/1658224792لبنة بالعسل 2.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-19 23:59:52', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224792لبنة بالعسل 2.jpg'),
(74, 'شوكلاتة بالعجين', 'Chocolate with dough', 'شوكلاتة بالعجين', 'Chocolate with dough', 8.05, 600, '/items/1658224876شيكولاتة.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-20 00:01:16', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658224876شيكولاتة.jpg'),
(75, 'شوكلاتة جبن موزريلا', 'Chocolate mozzarella cheese', 'شوكلاتة جبن موزريلا', 'Chocolate mozzarella cheese', 9.2, 630, '/items/1658225027شيكولاتة بالجبن 3.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-20 00:03:47', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225027شيكولاتة بالجبن 3.jpg'),
(76, 'عش البلبل كبير', 'Big size bulbul nest', 'عش البلبل كبير', 'Big size bulbul nest', 20.7, 500, '/items/1658225215عش البلبل.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-20 00:06:55', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225215عش البلبل.jpg'),
(77, 'عش البلبل صغير', 'small size bulbul nest', 'عش البلبل صغير', 'small size bulbul nest', 16.1, 500, '/items/1658225268عش البلبل.jpg', NULL, 'deactivate', 1, 0, 12, NULL, '2022-07-20 00:07:48', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225268عش البلبل.jpg'),
(78, 'بيتزا مارجريتا كبير', 'Margherita Pizza Large', 'بيتزا مارجريتا كبير', 'Margherita Pizza Large', 18.4, 1380, '/items/16582254511642060156ODnW84.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:10:51', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/16582254511642060156ODnW84.jpg'),
(79, 'بيتزا مارجريتا صغير', 'Margherita Pizza small', 'بيتزا مارجريتا صغير', 'Margherita Pizza small', 13.8, 830, '/items/16582255281642060156ODnW84.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:12:08', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/16582255281642060156ODnW84.jpg'),
(80, 'بيتزا خضار كبير', 'Large vegetable pizza', 'بيتزا خضار كبير', 'Large vegetable pizza', 19.55, 1420, '/items/1658225651بيتزا خضار2.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:14:11', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225651بيتزا خضار2.jpg'),
(81, 'بيتزا خضار صغير', 'small vegetable pizza', 'بيتزا خضار صغير', 'small vegetable pizza', 14.95, 830, '/items/1658225723بيتزا خضار2.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:15:23', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225723بيتزا خضار2.jpg'),
(82, 'بيتزا لحم حجم كبير', 'Large meat pizza', 'بيتزا لحم حجم كبير', 'Large meat pizza', 19.55, 1400, '/items/1658225811بيتزا لحم.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:16:51', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225811بيتزا لحم.jpg'),
(83, 'بيتزا لحم حجم صغير', 'small meat pizza', 'بيتزا لحم حجم صغير', 'small meat pizza', 14.95, 1400, '/items/1658225865بيتزا لحم.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:17:45', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225865بيتزا لحم.jpg'),
(84, 'بيتزا الدجاج حجم كبير', 'Large chicken pizza', 'بيتزا دجاج حجم كبير', 'Large chicken pizza', 19.55, 1480, '/items/1658225959بيتزا دجاج 2.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:19:19', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658225959بيتزا دجاج 2.jpg'),
(85, 'بيتزا دجاج صغير', 'smaLL chicken pizza', 'بيتزا دجاج صغير', 'smaLL chicken pizza', 14.95, 1400, '/items/1658226057بيتزا دجاج3.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:20:57', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658226057بيتزا دجاج3.jpg'),
(86, 'بيتزا ببروني حجم كبير', 'Large pepperoni pizza', 'بيتزا ببروني حجم كبير', 'Large pepperoni pizza', 19.55, 1400, '/items/1658226202بيتزا ببرونى.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:23:22', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658226202بيتزا ببرونى.jpg'),
(87, 'بيتزا ببروني حجم صغير', 'small pepperoni pizza', 'بيتزا ببروني حجم كبير', 'small pepperoni pizza', 14.95, 1400, '/items/1658226265بيتزا ببرونى.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:24:25', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658226265بيتزا ببرونى.jpg'),
(88, 'بيتزا هوت دوج كبير', 'Large hot dog pizza', 'بيتزا هوت دوج كبير', 'Large hot dog pizza', 19.55, 1480, '/items/1658226342بيتزا هوت دوج 3.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:25:42', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658226342بيتزا هوت دوج 3.jpg'),
(89, 'بيتزا هوت دوج صغير', 'small hot dog pizza', 'بيتزا هوت دوج صغير', 'small hot dog pizza', 14.95, 1400, '/items/1658226778بيتزا هوت دوج 3.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:32:58', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658226778بيتزا هوت دوج 3.jpg'),
(90, 'بيتزا دجاج باربكيو', 'BBQ Chicken Pizza', 'بيتزا دجاج باربكيو', 'BBQ Chicken Pizza', 20.7, 1480, '/items/1658226874بيتزا دجاج باربيكيو.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:34:34', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658226874بيتزا دجاج باربيكيو.jpg'),
(91, 'بيتزا دجاج باربكيو صغير', 'Small BBQ Chicken Pizza', 'بيتزا دجاج باربكيو صغير', 'Small BBQ Chicken Pizza', 16.1, 890, '/items/1658226937بيتزا دجاج باربيكيو.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:35:37', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658226937بيتزا دجاج باربيكيو.jpg'),
(92, 'بيتزا فلافل كبير', 'Large Falafel Pizza', 'بيتزا فلافل كبير', 'Large Falafel Pizza', 19.55, 1670, '/items/1658227020بيتزا فلافل.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:37:00', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227020بيتزا فلافل.jpg'),
(93, 'بيتزا فلافل صغير', 'small Falafel Pizza', 'بيتزا فلافل صغير', 'small Falafel Pizza', 14.95, 990, '/items/1658227077بيتزا فلافل.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:37:57', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227077بيتزا فلافل.jpg'),
(94, 'بيتزا دجاج رانش كبير', 'Large chicken ranch pizza', 'بيتزا دجاج رانش كبير', 'Large chicken ranch pizza', 20.7, 1487, '/items/1658227157بيتزا دجاج رانش.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:39:17', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227157بيتزا دجاج رانش.jpg'),
(95, 'بيتزا دجاج رانش صغير', 'Small chicken ranch pizza', 'بيتزا دجاج رانش صغير', 'Small chicken ranch pizza', 16.1, 1000, '/items/1658227243بيتزا دجاج رانش.jpg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:40:43', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227243بيتزا دجاج رانش.jpg'),
(96, 'بيتزا ديناميت حجم كبير', 'Large dynamite pizza', 'بيتزا ديناميت حجم كبير', 'Large dynamite pizza', 21.85, 1000, '/items/165822735716420646159ZSd3_.jpeg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:42:37', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/165822735716420646159ZSd3_.jpeg'),
(97, 'بيتزا ديناميت حجم صغير', 'small dynamite pizza', 'بيتزا ديناميت حجم صغير', 'small dynamite pizza', 17.25, 1000, '/items/165822741716420646159ZSd3_.jpeg', NULL, 'deactivate', 1, 0, 13, NULL, '2022-07-20 00:43:37', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/165822741716420646159ZSd3_.jpeg'),
(98, 'مشكل سوبر', 'Super mix', 'مشكل سوبر', 'mix super', 24.15, 2335, '/items/1658227506مشكل سوبر.jpg', NULL, 'deactivate', 1, 0, 14, NULL, '2022-07-20 00:45:06', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227506مشكل سوبر.jpg'),
(99, 'مشكل أكسترا', 'extra mix', 'مشكل أكسترا', 'extra mix', 49.45, 3445, '/items/1658227569مشكل اكسترا.jpg', NULL, 'deactivate', 1, 0, 14, NULL, '2022-07-20 00:46:09', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227569مشكل اكسترا.jpg'),
(100, 'مشكل مملكة المعجنات', 'Kingdom Mix', 'مشكل مملكة المعجنات', 'Kingdom Mix', 75.9, 5185, '/items/1658227646مشكل مملكة المعجنات.jpg', NULL, 'deactivate', 1, 0, 14, NULL, '2022-07-20 00:47:26', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227646مشكل مملكة المعجنات.jpg'),
(101, 'صفائح مشكل صغير', 'Small Mix Sheets', 'صفائح مشكل صغير', 'Small Mix Sheets', 8.05, 512, '/items/16582277571642577791G8Cz_-.jpg', NULL, 'deactivate', 1, 0, 14, NULL, '2022-07-20 00:49:17', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/16582277571642577791G8Cz_-.jpg'),
(102, 'صفائح مشكل كبير', 'big Mix Sheets', 'صفائح مشكل كبير', 'big Mix Sheets', 32.2, 2141, '/items/1662630743╪¼╪»┘è╪»┘å╪º.png', '', 'deactivate', 1, 0, 14, NULL, '2022-07-20 00:50:26', '2022-09-08 16:52:23', '/items/1662630743╪¼╪»┘è╪»┘å╪º.png'),
(103, 'مياه معدنية', 'Water', 'مياه', 'Water', 1.15, 0, '/items/1658227895مياه-معدنيه-كبيره.jpg', '', 'deactivate', 1, 0, 18, NULL, '2022-07-20 00:51:35', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227895مياه-معدنيه-كبيره.jpg'),
(104, 'بيبسي', 'pepsi', 'بيبسي', 'pepsi', 3.45, 145, '/items/1658227947بيبسي.jpg', '', 'deactivate', 1, 0, 18, NULL, '2022-07-20 00:52:27', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658227947بيبسي.jpg'),
(105, 'سفن اب', '7up', 'ماونتن ديو', '7up', 3.45, 145, '/items/1658228025سغن.jpg', '', 'deactivate', 1, 0, 18, NULL, '2022-07-20 00:53:45', '2022-09-05 01:35:05', 'https://itrplanet.com/Kop-rest22/public/items/1658228025سغن.jpg'),
(106, 'ميرندا', 'Mirinda', 'مبيرندا - حمضيات, برتقال', 'Mirinda', 3.45, 191, '/items/1658228108ميرندا.jpg', '', 'deactivate', 1, 0, 18, NULL, '2022-07-20 00:55:08', '2022-09-05 01:35:06', 'https://itrplanet.com/Kop-rest22/public/items/1658228108ميرندا.jpg'),
(107, 'ماونتن ديو', 'Mountain Dew', 'ماونتن ديو', 'Mountain Dew', 3.45, 173, '/items/1658228177ماونتن.jpg', '', 'deactivate', 1, 0, 18, NULL, '2022-07-20 00:56:17', '2022-09-05 01:35:06', 'https://itrplanet.com/Kop-rest22/public/items/1658228177ماونتن.jpg'),
(108, 'جبن فيتا خبز بالثوم', 'feta cheese garlic bread', 'جبن فيتا خبز بالثوم', 'feta cheese garlic bread', 8.05, 536, '/items/1658228345الاجبان الثلاثة بالثوم.jpg', '', 'deactivate', 1, 0, 4, NULL, '2022-07-20 00:59:05', '2022-09-05 01:35:06', 'https://itrplanet.com/Kop-rest22/public/items/1658228345الاجبان الثلاثة بالثوم.jpg'),
(109, 'جبن فيتا', 'feta cheese', 'جبن فيتا', 'feta cheese', 8.05, 534, '/items/16582284501612553867-3.jpg', '', 'deactivate', 1, 1, 4, NULL, '2022-07-20 01:00:50', '2022-09-05 01:35:06', 'https://itrplanet.com/Kop-rest22/public/items/16582284501612553867-3.jpg'),
(110, 'الاجبان الثلاثة خبز بالثوم', 'Three cheese garlic bread', 'الاجبان الثلاثة خبز بالثوم', 'Three cheese garlic bread', 8.05, 534, '/items/1658228551الاجبان الثلاثة بالثوم 3.jpg', '', 'deactivate', 1, 1, 4, NULL, '2022-07-20 01:02:31', '2022-09-05 01:35:06', 'https://itrplanet.com/Kop-rest22/public/items/1658228551الاجبان الثلاثة بالثوم 3.jpg'),
(111, 'الأجبان الثلاثة خبز عادي', 'Three cheeses, plain bread', 'الأجبان الثلاثة خبز عادي', 'Three cheeses, plain bread', 8.05, 571, '/items/16582286461612554060-5.jpg', ',16', 'deactivate', 1, 1, 4, NULL, '2022-07-20 01:04:06', '2022-09-05 01:35:06', 'https://itrplanet.com/Kop-rest22/public/items/16582286461612554060-5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `brief_description_ar` text COLLATE utf8_unicode_ci,
  `brief_description_en` text COLLATE utf8_unicode_ci,
  `responsibilities_ar` text COLLATE utf8_unicode_ci,
  `responsibilities_en` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `status`, `brief_description_ar`, `brief_description_en`, `responsibilities_ar`, `responsibilities_en`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'مدير', 'Manager', 'السن لا يزيد عن ٣٠ سنة\r\nحسن المظهر و الخلق\r\nشهادة في تخصص العلوم الإدارية', 'Age not more than 30 years\r\nGood looking and good manners\r\nCertificate in Administrative Sciences', 0, 'مدير مطعم', 'Manager Manager Manager Manager Manager ManagerManager Manager Manager Manager Manager Manager', 'إدارة جميع العاملين بالمطعم ورفع مستوى إنتاجيتهم الى الحـد الأقصى\r\n تدريب ومتابعة تدريب جميع العاملين ( جدد – قدامى ) حسب الخطة الموضوعة من إدارة التدريب\r\nمتابعة صيانة واصلاح جميع المعدات المستخدمة فى التحـضير والتجهيز والخدمة بالتنسيق مع الادارة الهندسية', 'Managing all restaurant employees and raising their productivity to the maximum-\r\n Training and follow-up training of all employees (new - old) according to the plan set by the Training Department-\r\nFollow-up maintenance and repair of all equipment used in preparation, processing and service in coordination with the Engineering Department-', NULL, '2021-09-23 02:01:58', '2022-06-22 21:12:03'),
(2, 'خدمة عملاء', 'Customer Service', 'سعودية الجنسية\r\nاللباقة في الحديث\r\nالقدرة على التعامل مع العملاء', '000000', 0, 'كول سنتر', '000000', 'الصبر\r\nالإصغاء\r\nالتواصل\r\nمعرفة المنتج', '000000', NULL, '2021-09-23 02:08:19', '2021-12-26 21:42:55'),
(3, 'محاسب زبائن (كاشير)', 'Cashier', 'محاسب زبائن للعمل في فروع مملكة المعجنات في المنطقة الشرقية', 'A customer accountant to work in the branches of the Kingdom of Pastries in the Eastern Province', 1, NULL, NULL, 'المسمي الوظيفي:\r\n- كاشير / كاشيرة.\r\nالشروط:\r\n1- شهادة الثانوية العامة أو ما يعادلها.\r\n2- يفضل خبرة سنة فأكثر.', 'Job title:\r\nCashier / cashier.\r\nthe conditions:\r\n1- A high school diploma or its equivalent.\r\n2- A year or more of experience is preferred.', NULL, '2022-06-22 21:16:54', '2022-06-22 21:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE `job_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cv_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `job_requests`
--

INSERT INTO `job_requests` (`id`, `name`, `email`, `phone`, `cv_file`, `description`, `job_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ds', 'n@n.gmail.com', '01234567892', '/CV/1659971000alpha final report.pdf', 'uuipo', 1, '2022-08-09 00:03:20', '2022-08-08 22:03:20', '2022-08-08 22:03:20'),
(2, 'ds', 'n@n.gmail.com', '01234567892', '/CV/1659972427report.pdf', 'o[opj[', 2, '2022-08-09 00:27:07', '2022-08-08 22:27:07', '2022-08-08 22:27:07'),
(3, 'ds', 'n@n.gmail.com', '01234567892', '/CV/1659974128report.pdf', 'sdgesrg', 2, '2022-08-09 00:55:28', '2022-08-08 22:55:28', '2022-08-08 22:55:28'),
(4, 'ds w3rwqr', 'n@n.gmail.com', '01234567892', '/CV/1660047727report.pdf', 'yt t7u', 2, '2022-08-09 21:22:07', '2022-08-09 19:22:07', '2022-08-09 19:22:07'),
(5, 'home lastwwwwwww', 'ahmed@gmail.com', '032415445564', '/CV/1660645674dummy.pdf', 'asd asdj askldj askdh asjhd jkasdhjk ashdjkash djkashdjk ashdjkashdsad', 1, '2022-08-16 19:27:54', '2022-08-16 17:27:54', '2022-08-16 17:27:54'),
(6, 'home lastwwwwwww', 'sdfhsdjkfhsdf@gmail.com', '032415445564', '/CV/1662309589مناطق التوصيل.pdf', 'sdfsd sdf sdf', 3, '2022-09-04 16:39:49', '2022-09-04 23:39:49', '2022-09-04 23:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `log_files`
--

CREATE TABLE `log_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `log_files`
--

INSERT INTO `log_files` (`id`, `user_id`, `model`, `action`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 91, 'App\\Models\\AboutUS', 'create', 4, '2022-08-07 16:45:50', '2022-08-07 16:45:50'),
(2, 91, 'App\\Models\\AboutUS', 'create', 4, '2022-08-07 16:51:22', '2022-08-07 16:51:22'),
(3, 91, 'App\\Models\\AboutUS', 'delete', 4, '2022-08-07 16:51:27', '2022-08-07 16:51:27'),
(4, 91, 'App\\Models\\Banner', 'create', 1, '2022-08-07 16:53:06', '2022-08-07 16:53:06'),
(5, 91, 'App\\Models\\Banner', 'delete', 52, '2022-08-07 16:53:45', '2022-08-07 16:53:45'),
(6, 91, 'App\\Models\\Banner', 'create', 53, '2022-08-07 16:54:59', '2022-08-07 16:54:59'),
(7, 91, 'App\\Models\\Banner', 'update', 53, '2022-08-07 16:55:19', '2022-08-07 16:55:19'),
(8, 91, 'App\\Models\\Banner', 'delete', 53, '2022-08-07 16:55:40', '2022-08-07 16:55:40'),
(9, 91, 'App\\Models\\Branch', 'update', 23, '2022-08-07 17:02:45', '2022-08-07 17:02:45'),
(10, 91, 'App\\Models\\Branch', 'delete', 23, '2022-08-07 17:02:58', '2022-08-07 17:02:58'),
(11, 91, 'App\\Models\\Category', 'update', 16, '2022-08-07 17:15:03', '2022-08-07 17:15:03'),
(12, 91, 'App\\Models\\User', 'update', 193, '2022-08-07 18:36:58', '2022-08-07 18:36:58'),
(13, 91, 'App\\Models\\User', 'create', 195, '2022-08-07 18:40:21', '2022-08-07 18:40:21'),
(14, 91, 'App\\Models\\User', 'delete', 195, '2022-08-07 18:40:29', '2022-08-07 18:40:29'),
(15, 91, 'App\\Models\\Category', 'create', 18, '2022-08-07 18:41:50', '2022-08-07 18:41:50'),
(16, 91, 'App\\Models\\Category', 'update', 18, '2022-08-07 18:41:59', '2022-08-07 18:41:59'),
(17, 91, 'App\\Models\\Category', 'delete', 18, '2022-08-07 18:42:02', '2022-08-07 18:42:02'),
(18, 91, 'App\\Models\\Item', 'create', 113, '2022-08-07 18:43:22', '2022-08-07 18:43:22'),
(19, 91, 'App\\Models\\Extra', 'create', 3, '2022-08-07 18:44:13', '2022-08-07 18:44:13'),
(20, 91, 'App\\Models\\Without', 'create', 3, '2022-08-07 18:44:58', '2022-08-07 18:44:58'),
(21, 91, 'App\\Models\\General', 'update', 4, '2022-08-07 18:48:01', '2022-08-07 18:48:01'),
(22, 91, 'App\\Models\\Gift', 'create', 5, '2022-08-07 18:48:57', '2022-08-07 18:48:57'),
(23, 91, 'App\\Models\\Gift', 'update', 5, '2022-08-07 18:49:26', '2022-08-07 18:49:26'),
(24, 91, 'App\\Models\\Gift', 'delete', 4, '2022-08-07 18:49:40', '2022-08-07 18:49:40'),
(25, 91, 'App\\Models\\Gift', 'delete', 5, '2022-08-07 18:49:42', '2022-08-07 18:49:42'),
(26, 91, 'App\\Models\\Item', 'dealOfWeekStatus', 1, '2022-08-07 18:50:55', '2022-08-07 18:50:55'),
(27, 91, 'App\\Models\\Item', 'dealOfWeekStatus', 1, '2022-08-07 18:51:11', '2022-08-07 18:51:11'),
(28, 91, 'App\\Models\\Item', 'dealOfWeekStatus', 1, '2022-08-07 18:56:49', '2022-08-07 18:56:49'),
(29, 91, 'App\\Models\\Item', 'dealOfWeekStatus', 2, '2022-08-07 18:58:21', '2022-08-07 18:58:21'),
(30, 91, 'App\\Models\\Item', 'dealOfWeekStatus', 2, '2022-08-07 18:58:24', '2022-08-07 18:58:24'),
(31, 91, 'App\\Models\\Item', 'dealOfWeekStatus', 2, '2022-08-07 18:58:24', '2022-08-07 18:58:24'),
(32, 91, 'App\\Models\\Item', 'dealOfWeekStatus', 3, '2022-08-07 18:58:37', '2022-08-07 18:58:37'),
(33, 91, 'App\\Models\\AboutUS', 'create', 6, '2022-08-07 19:00:05', '2022-08-07 19:00:05'),
(34, 91, 'App\\Models\\Media', 'update', 5, '2022-08-07 19:02:18', '2022-08-07 19:02:18'),
(35, 91, 'App\\Models\\Careers', 'update', 3, '2022-08-07 19:02:40', '2022-08-07 19:02:40'),
(36, 91, 'App\\Models\\Careers', 'create', 5, '2022-08-07 19:03:16', '2022-08-07 19:03:16'),
(37, 91, 'App\\Models\\Careers', 'update', 4, '2022-08-07 19:03:22', '2022-08-07 19:03:22'),
(38, 91, 'App\\Models\\Careers', 'delete', 5, '2022-08-07 19:03:25', '2022-08-07 19:03:25'),
(39, 91, 'App\\Models\\Careers', 'delete', 4, '2022-08-07 19:03:28', '2022-08-07 19:03:28'),
(40, 91, 'App\\Models\\News', 'create', 5, '2022-08-07 19:04:15', '2022-08-07 19:04:15'),
(41, 91, 'App\\Models\\News', 'delete', 5, '2022-08-07 19:04:19', '2022-08-07 19:04:19'),
(42, 91, 'App\\Models\\News', 'update', 4, '2022-08-07 19:04:31', '2022-08-07 19:04:31'),
(43, 91, 'App\\Models\\HealthInfo', 'create', 9, '2022-08-07 19:05:06', '2022-08-07 19:05:06'),
(44, 91, 'App\\Models\\HealthInfo', 'update', 8, '2022-08-07 19:05:14', '2022-08-07 19:05:14'),
(45, 91, 'App\\Models\\HealthInfo', 'delete', 9, '2022-08-07 19:05:17', '2022-08-07 19:05:17'),
(46, 91, 'App\\Models\\HealthInfo', 'delete', 8, '2022-08-07 19:05:20', '2022-08-07 19:05:20'),
(47, 91, 'App\\Models\\Banner', 'create', 54, '2022-08-07 19:06:04', '2022-08-07 19:06:04'),
(48, 91, 'App\\Models\\Banner', 'delete', 54, '2022-08-07 19:06:11', '2022-08-07 19:06:11'),
(49, 91, 'App\\Models\\Offer', 'create', 2, '2022-08-07 19:08:05', '2022-08-07 19:08:05'),
(50, 91, 'App\\Models\\OfferDiscount', 'create', 1, '2022-08-07 19:08:05', '2022-08-07 19:08:05'),
(51, 91, 'App\\Models\\Offer', 'create', 3, '2022-08-07 19:20:46', '2022-08-07 19:20:46'),
(52, 91, 'App\\Models\\OfferBuyGet', 'create', 1, '2022-08-07 19:20:46', '2022-08-07 19:20:46'),
(53, 91, 'App\\Models\\Offer', 'delete', 3, '2022-08-07 19:21:07', '2022-08-07 19:21:07'),
(54, 91, 'App\\Models\\Offer', 'delete', 2, '2022-08-07 19:21:27', '2022-08-07 19:21:27'),
(55, 91, 'App\\Models\\Branch', 'create', 26, '2022-08-07 19:22:27', '2022-08-07 19:22:27'),
(56, 91, 'App\\Models\\Branch', 'delete', 25, '2022-08-07 19:22:33', '2022-08-07 19:22:33'),
(57, 91, 'App\\Models\\Branch', 'delete', 24, '2022-08-07 19:22:36', '2022-08-07 19:22:36'),
(58, 91, 'App\\Models\\Branch', 'update', 26, '2022-08-07 19:22:42', '2022-08-07 19:22:42'),
(59, 91, 'App\\Models\\User', 'create', 197, '2022-08-07 19:24:27', '2022-08-07 19:24:27'),
(60, 91, 'App\\Models\\User', 'delete', 197, '2022-08-07 19:24:46', '2022-08-07 19:24:46'),
(61, 91, 'App\\Models\\User', 'update', 97, '2022-08-07 19:24:55', '2022-08-07 19:24:55'),
(62, 91, 'App\\Models\\Role', 'create', 12, '2022-08-07 19:25:54', '2022-08-07 19:25:54'),
(63, 91, 'App\\Models\\Permission', 'asignPermission', 15, '2022-08-07 19:32:45', '2022-08-07 19:32:45'),
(64, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-07 20:09:29', '2022-08-07 20:09:29'),
(65, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 20:09:36', '2022-08-07 20:09:36'),
(66, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 20:09:45', '2022-08-07 20:09:45'),
(67, 91, 'App\\Models\\Item', 'view', 0, '2022-08-07 20:09:46', '2022-08-07 20:09:46'),
(68, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-07 20:09:48', '2022-08-07 20:09:48'),
(69, 91, 'App\\Models\\Without', 'view', 0, '2022-08-07 20:09:49', '2022-08-07 20:09:49'),
(70, 91, 'App\\Models\\Without', 'view', 0, '2022-08-07 20:10:19', '2022-08-07 20:10:19'),
(71, 91, 'App\\Models\\Gift', 'view', 0, '2022-08-07 20:10:43', '2022-08-07 20:10:43'),
(72, 91, 'App\\Models\\Order', 'view', 0, '2022-08-07 20:10:46', '2022-08-07 20:10:46'),
(73, 91, 'App\\Models\\Contact', 'view', 0, '2022-08-07 20:11:33', '2022-08-07 20:11:33'),
(74, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-07 20:11:39', '2022-08-07 20:11:39'),
(75, 91, 'App\\Models\\News', 'view', 0, '2022-08-07 20:11:40', '2022-08-07 20:11:40'),
(76, 91, 'App\\Models\\Careers', 'view', 0, '2022-08-07 20:11:41', '2022-08-07 20:11:41'),
(77, 91, 'App\\Models\\Media', 'view', 0, '2022-08-07 20:11:42', '2022-08-07 20:11:42'),
(78, 91, 'App\\Models\\Gallery', 'view', 0, '2022-08-07 20:11:43', '2022-08-07 20:11:43'),
(79, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-07 20:11:44', '2022-08-07 20:11:44'),
(80, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-07 20:11:48', '2022-08-07 20:11:48'),
(81, 91, 'App\\Models\\Branch', 'view', 0, '2022-08-07 20:11:51', '2022-08-07 20:11:51'),
(82, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 20:12:02', '2022-08-07 20:12:02'),
(83, 91, 'App\\Models\\Role', 'view', 0, '2022-08-07 20:12:06', '2022-08-07 20:12:06'),
(84, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-07 20:14:29', '2022-08-07 20:14:29'),
(85, 91, 'App\\Models\\Branch', 'view', 0, '2022-08-07 20:14:36', '2022-08-07 20:14:36'),
(86, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-07 20:14:44', '2022-08-07 20:14:44'),
(87, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 20:14:46', '2022-08-07 20:14:46'),
(88, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 20:32:22', '2022-08-07 20:32:22'),
(89, 91, 'App\\Models\\Order', 'view', 0, '2022-08-07 20:33:16', '2022-08-07 20:33:16'),
(90, 91, 'App\\Models\\User', 'report', 0, '2022-08-07 20:33:18', '2022-08-07 20:33:18'),
(91, 91, 'App\\Models\\Order', 'report', 0, '2022-08-07 20:33:26', '2022-08-07 20:33:26'),
(92, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-07 21:23:20', '2022-08-07 21:23:20'),
(93, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 21:23:24', '2022-08-07 21:23:24'),
(94, 91, 'App\\Models\\Order', 'view', 0, '2022-08-07 21:23:29', '2022-08-07 21:23:29'),
(95, 91, 'App\\Models\\Order', 'view', 0, '2022-08-07 21:23:31', '2022-08-07 21:23:31'),
(96, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 21:23:33', '2022-08-07 21:23:33'),
(97, 91, 'App\\Models\\User', 'delete', 193, '2022-08-07 21:23:38', '2022-08-07 21:23:38'),
(98, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 21:23:38', '2022-08-07 21:23:38'),
(99, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 21:25:06', '2022-08-07 21:25:06'),
(100, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 21:25:10', '2022-08-07 21:25:10'),
(101, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 21:26:12', '2022-08-07 21:26:12'),
(102, 91, 'App\\Models\\Category', 'delete', 17, '2022-08-07 21:26:16', '2022-08-07 21:26:16'),
(103, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 21:26:16', '2022-08-07 21:26:16'),
(104, 91, 'App\\Models\\Category', 'delete', 8, '2022-08-07 21:27:13', '2022-08-07 21:27:13'),
(105, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 21:27:13', '2022-08-07 21:27:13'),
(106, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 21:27:17', '2022-08-07 21:27:17'),
(107, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 21:27:49', '2022-08-07 21:27:49'),
(108, 91, 'App\\Models\\Branch', 'view', 0, '2022-08-07 21:27:53', '2022-08-07 21:27:53'),
(109, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-07 22:43:51', '2022-08-07 22:43:51'),
(110, 91, 'App\\Models\\Careers', 'view', 0, '2022-08-07 22:43:56', '2022-08-07 22:43:56'),
(111, 91, 'App\\Models\\Careers', 'view', 0, '2022-08-07 22:44:37', '2022-08-07 22:44:37'),
(112, 91, 'App\\Models\\User', 'report', 0, '2022-08-07 22:54:15', '2022-08-07 22:54:15'),
(113, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-07 22:54:18', '2022-08-07 22:54:18'),
(114, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 22:54:20', '2022-08-07 22:54:20'),
(115, 91, 'App\\Models\\Category', 'view', 0, '2022-08-07 22:54:22', '2022-08-07 22:54:22'),
(116, 91, 'App\\Models\\Item', 'view', 0, '2022-08-07 22:54:23', '2022-08-07 22:54:23'),
(117, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-07 22:54:25', '2022-08-07 22:54:25'),
(118, 91, 'App\\Models\\Without', 'view', 0, '2022-08-07 22:54:26', '2022-08-07 22:54:26'),
(119, 91, 'App\\Models\\Gift', 'view', 0, '2022-08-07 22:54:30', '2022-08-07 22:54:30'),
(120, 91, 'App\\Models\\Order', 'view', 0, '2022-08-07 22:54:32', '2022-08-07 22:54:32'),
(121, 91, 'App\\Models\\User', 'report', 0, '2022-08-07 22:54:34', '2022-08-07 22:54:34'),
(122, 91, 'App\\Models\\Order', 'report', 0, '2022-08-07 22:54:36', '2022-08-07 22:54:36'),
(123, 91, 'App\\Models\\Income', 'report', 0, '2022-08-07 22:54:37', '2022-08-07 22:54:37'),
(124, 91, 'App\\Models\\Income', 'report', 0, '2022-08-07 22:54:38', '2022-08-07 22:54:38'),
(125, 91, 'App\\Models\\Item', 'report', 0, '2022-08-07 22:54:39', '2022-08-07 22:54:39'),
(126, 91, 'App\\Models\\Extra', 'report', 0, '2022-08-07 22:54:41', '2022-08-07 22:54:41'),
(127, 91, 'App\\Models\\OrderStatus', 'report', 0, '2022-08-07 22:54:42', '2022-08-07 22:54:42'),
(128, 91, 'App\\Models\\OrderCustomer', 'report', 0, '2022-08-07 22:54:42', '2022-08-07 22:54:42'),
(129, 91, 'App\\Models\\OrderItems', 'report', 0, '2022-08-07 22:54:44', '2022-08-07 22:54:44'),
(130, 91, 'App\\Models\\OrderItems', 'report', 0, '2022-08-07 22:54:46', '2022-08-07 22:54:46'),
(131, 91, 'App\\Models\\User', 'view', 0, '2022-08-07 22:54:51', '2022-08-07 22:54:51'),
(132, 91, 'App\\Models\\Role', 'view', 0, '2022-08-07 22:54:52', '2022-08-07 22:54:52'),
(133, 91, 'App\\Models\\Role', 'view', 0, '2022-08-07 22:54:55', '2022-08-07 22:54:55'),
(134, 91, 'App\\Models\\Role', 'view', 0, '2022-08-07 22:54:56', '2022-08-07 22:54:56'),
(135, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-07 22:55:23', '2022-08-07 22:55:23'),
(136, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-08 18:35:44', '2022-08-08 18:35:44'),
(137, 91, 'App\\Models\\Category', 'view', 0, '2022-08-08 18:35:47', '2022-08-08 18:35:47'),
(138, 91, 'App\\Models\\Category', 'delete', 16, '2022-08-08 18:35:50', '2022-08-08 18:35:50'),
(139, 91, 'App\\Models\\Category', 'view', 0, '2022-08-08 18:35:50', '2022-08-08 18:35:50'),
(140, 91, 'App\\Models\\Category', 'delete', 15, '2022-08-08 18:35:54', '2022-08-08 18:35:54'),
(141, 91, 'App\\Models\\Category', 'view', 0, '2022-08-08 18:35:55', '2022-08-08 18:35:55'),
(142, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-08 20:03:40', '2022-08-08 20:03:40'),
(143, 91, 'App\\Models\\Category', 'view', 0, '2022-08-08 20:03:47', '2022-08-08 20:03:47'),
(144, 91, 'App\\Models\\Gift', 'view', 0, '2022-08-08 20:03:58', '2022-08-08 20:03:58'),
(145, 91, 'App\\Models\\Branch', 'view', 0, '2022-08-08 20:04:00', '2022-08-08 20:04:00'),
(146, 91, 'App\\Models\\Branch', 'view', 0, '2022-08-08 20:04:02', '2022-08-08 20:04:02'),
(147, 91, 'App\\Models\\User', 'view', 0, '2022-08-08 20:04:04', '2022-08-08 20:04:04'),
(148, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-08 23:28:56', '2022-08-08 23:28:56'),
(149, 91, 'App\\Models\\Careers', 'view', 0, '2022-08-08 23:29:05', '2022-08-08 23:29:05'),
(150, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-09 20:38:48', '2022-08-09 20:38:48'),
(151, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-10 20:41:42', '2022-08-10 20:41:42'),
(152, 91, 'App\\Models\\Order', 'view', 0, '2022-08-10 20:41:50', '2022-08-10 20:41:50'),
(153, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:41:54', '2022-08-10 20:41:54'),
(154, 91, 'App\\Models\\Offer', 'create', 2, '2022-08-10 20:43:13', '2022-08-10 20:43:13'),
(155, 91, 'App\\Models\\OfferBuyGet', 'create', 1, '2022-08-10 20:43:13', '2022-08-10 20:43:13'),
(156, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:43:19', '2022-08-10 20:43:19'),
(157, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:43:25', '2022-08-10 20:43:25'),
(158, 91, 'App\\Models\\Offer', 'create', 3, '2022-08-10 20:44:53', '2022-08-10 20:44:53'),
(159, 91, 'App\\Models\\OfferBuyGet', 'create', 2, '2022-08-10 20:44:53', '2022-08-10 20:44:53'),
(160, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:44:59', '2022-08-10 20:44:59'),
(161, 91, 'App\\Models\\Offer', 'create', 4, '2022-08-10 20:45:51', '2022-08-10 20:45:51'),
(162, 91, 'App\\Models\\OfferDiscount', 'create', 1, '2022-08-10 20:45:51', '2022-08-10 20:45:51'),
(163, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:45:57', '2022-08-10 20:45:57'),
(164, 91, 'App\\Models\\Offer', 'create', 5, '2022-08-10 20:49:34', '2022-08-10 20:49:34'),
(165, 91, 'App\\Models\\OfferBuyGet', 'create', 3, '2022-08-10 20:49:34', '2022-08-10 20:49:34'),
(166, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:49:40', '2022-08-10 20:49:40'),
(167, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:51:49', '2022-08-10 20:51:49'),
(168, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:52:52', '2022-08-10 20:52:52'),
(169, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-10 20:54:02', '2022-08-10 20:54:02'),
(170, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-10 20:54:23', '2022-08-10 20:54:23'),
(171, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-10 21:06:25', '2022-08-10 21:06:25'),
(172, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:06:49', '2022-08-10 21:06:49'),
(173, 91, 'App\\Models\\HealthInfo', 'create', 1, '2022-08-10 21:07:16', '2022-08-10 21:07:16'),
(174, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:07:16', '2022-08-10 21:07:16'),
(175, 91, 'App\\Models\\HealthInfo', 'create', 2, '2022-08-10 21:07:37', '2022-08-10 21:07:37'),
(176, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:07:37', '2022-08-10 21:07:37'),
(177, 91, 'App\\Models\\HealthInfo', 'create', 3, '2022-08-10 21:08:36', '2022-08-10 21:08:36'),
(178, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:08:36', '2022-08-10 21:08:36'),
(179, 91, 'App\\Models\\HealthInfo', 'create', 4, '2022-08-10 21:09:03', '2022-08-10 21:09:03'),
(180, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:09:04', '2022-08-10 21:09:04'),
(181, 91, 'App\\Models\\HealthInfo', 'create', 5, '2022-08-10 21:09:27', '2022-08-10 21:09:27'),
(182, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:09:27', '2022-08-10 21:09:27'),
(183, 91, 'App\\Models\\HealthInfo', 'create', 6, '2022-08-10 21:34:38', '2022-08-10 21:34:38'),
(184, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:34:38', '2022-08-10 21:34:38'),
(185, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:36:46', '2022-08-10 21:36:46'),
(186, 91, 'App\\Models\\HealthInfo', 'create', 7, '2022-08-10 21:37:06', '2022-08-10 21:37:06'),
(187, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:06', '2022-08-10 21:37:06'),
(188, 91, 'App\\Models\\HealthInfo', 'delete', 7, '2022-08-10 21:37:27', '2022-08-10 21:37:27'),
(189, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:28', '2022-08-10 21:37:28'),
(190, 91, 'App\\Models\\HealthInfo', 'delete', 6, '2022-08-10 21:37:34', '2022-08-10 21:37:34'),
(191, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:34', '2022-08-10 21:37:34'),
(192, 91, 'App\\Models\\HealthInfo', 'delete', 5, '2022-08-10 21:37:37', '2022-08-10 21:37:37'),
(193, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:37', '2022-08-10 21:37:37'),
(194, 91, 'App\\Models\\HealthInfo', 'delete', 4, '2022-08-10 21:37:40', '2022-08-10 21:37:40'),
(195, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:40', '2022-08-10 21:37:40'),
(196, 91, 'App\\Models\\HealthInfo', 'delete', 3, '2022-08-10 21:37:42', '2022-08-10 21:37:42'),
(197, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:42', '2022-08-10 21:37:42'),
(198, 91, 'App\\Models\\HealthInfo', 'delete', 2, '2022-08-10 21:37:45', '2022-08-10 21:37:45'),
(199, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:45', '2022-08-10 21:37:45'),
(200, 91, 'App\\Models\\HealthInfo', 'delete', 1, '2022-08-10 21:37:48', '2022-08-10 21:37:48'),
(201, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:37:48', '2022-08-10 21:37:48'),
(202, 91, 'App\\Models\\HealthInfo', 'create', 8, '2022-08-10 21:39:39', '2022-08-10 21:39:39'),
(203, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:39:39', '2022-08-10 21:39:39'),
(204, 91, 'App\\Models\\HealthInfo', 'delete', 8, '2022-08-10 21:42:28', '2022-08-10 21:42:28'),
(205, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:42:28', '2022-08-10 21:42:28'),
(206, 91, 'App\\Models\\HealthInfo', 'create', 9, '2022-08-10 21:42:48', '2022-08-10 21:42:48'),
(207, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:42:48', '2022-08-10 21:42:48'),
(208, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:43:17', '2022-08-10 21:43:17'),
(209, 91, 'App\\Models\\HealthInfo', 'create', 10, '2022-08-10 21:51:48', '2022-08-10 21:51:48'),
(210, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:51:48', '2022-08-10 21:51:48'),
(211, 91, 'App\\Models\\HealthInfo', 'create', 13, '2022-08-10 21:52:59', '2022-08-10 21:52:59'),
(212, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:53:00', '2022-08-10 21:53:00'),
(213, 91, 'App\\Models\\HealthInfo', 'delete', 9, '2022-08-10 21:53:04', '2022-08-10 21:53:04'),
(214, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:53:05', '2022-08-10 21:53:05'),
(215, 91, 'App\\Models\\HealthInfo', 'delete', 10, '2022-08-10 21:53:19', '2022-08-10 21:53:19'),
(216, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:53:19', '2022-08-10 21:53:19'),
(217, 91, 'App\\Models\\HealthInfo', 'delete', 11, '2022-08-10 21:53:22', '2022-08-10 21:53:22'),
(218, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:53:23', '2022-08-10 21:53:23'),
(219, 91, 'App\\Models\\HealthInfo', 'delete', 12, '2022-08-10 21:53:25', '2022-08-10 21:53:25'),
(220, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:53:25', '2022-08-10 21:53:25'),
(221, 91, 'App\\Models\\HealthInfo', 'create', 14, '2022-08-10 21:53:45', '2022-08-10 21:53:45'),
(222, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:53:45', '2022-08-10 21:53:45'),
(223, 91, 'App\\Models\\HealthInfo', 'create', 15, '2022-08-10 21:54:08', '2022-08-10 21:54:08'),
(224, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:54:09', '2022-08-10 21:54:09'),
(225, 91, 'App\\Models\\HealthInfo', 'create', 16, '2022-08-10 21:54:43', '2022-08-10 21:54:43'),
(226, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 21:54:43', '2022-08-10 21:54:43'),
(227, 91, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-10 22:02:15', '2022-08-10 22:02:15'),
(228, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-10 23:30:58', '2022-08-10 23:30:58'),
(229, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-10 23:31:05', '2022-08-10 23:31:05'),
(230, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-10 23:40:44', '2022-08-10 23:40:44'),
(231, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-10 23:53:02', '2022-08-10 23:53:02'),
(232, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-10 23:56:58', '2022-08-10 23:56:58'),
(233, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-10 23:57:01', '2022-08-10 23:57:01'),
(234, 91, 'App\\Models\\AboutUS', 'create', 7, '2022-08-10 23:57:35', '2022-08-10 23:57:35'),
(235, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-10 23:57:36', '2022-08-10 23:57:36'),
(236, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:02:11', '2022-08-11 00:02:11'),
(237, 91, 'App\\Models\\AboutUS', 'delete', 7, '2022-08-11 00:02:15', '2022-08-11 00:02:15'),
(238, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:02:15', '2022-08-11 00:02:15'),
(239, 91, 'App\\Models\\AboutUS', 'create', 8, '2022-08-11 00:03:05', '2022-08-11 00:03:05'),
(240, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:03:05', '2022-08-11 00:03:05'),
(241, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:03:47', '2022-08-11 00:03:47'),
(242, 91, 'App\\Models\\AboutUS', 'create', 9, '2022-08-11 00:04:33', '2022-08-11 00:04:33'),
(243, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:04:34', '2022-08-11 00:04:34'),
(244, 91, 'App\\Models\\AboutUS', 'create', 10, '2022-08-11 00:07:44', '2022-08-11 00:07:44'),
(245, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:07:44', '2022-08-11 00:07:44'),
(246, 91, 'App\\Models\\AboutUS', 'delete', 10, '2022-08-11 00:11:49', '2022-08-11 00:11:49'),
(247, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:11:49', '2022-08-11 00:11:49'),
(248, 91, 'App\\Models\\AboutUS', 'delete', 9, '2022-08-11 00:11:51', '2022-08-11 00:11:51'),
(249, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:11:51', '2022-08-11 00:11:51'),
(250, 91, 'App\\Models\\AboutUS', 'delete', 8, '2022-08-11 00:11:53', '2022-08-11 00:11:53'),
(251, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:11:54', '2022-08-11 00:11:54'),
(252, 91, 'App\\Models\\AboutUS', 'create', 11, '2022-08-11 00:15:37', '2022-08-11 00:15:37'),
(253, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:15:37', '2022-08-11 00:15:37'),
(254, 91, 'App\\Models\\AboutUS', 'delete', 11, '2022-08-11 00:15:42', '2022-08-11 00:15:42'),
(255, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:15:42', '2022-08-11 00:15:42'),
(256, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:15:54', '2022-08-11 00:15:54'),
(257, 91, 'App\\Models\\AboutUS', 'create', 12, '2022-08-11 00:16:25', '2022-08-11 00:16:25'),
(258, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:16:25', '2022-08-11 00:16:25'),
(259, 91, 'App\\Models\\AboutUS', 'create', 13, '2022-08-11 00:16:59', '2022-08-11 00:16:59'),
(260, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:16:59', '2022-08-11 00:16:59'),
(261, 91, 'App\\Models\\AboutUS', 'create', 14, '2022-08-11 00:17:32', '2022-08-11 00:17:32'),
(262, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 00:17:32', '2022-08-11 00:17:32'),
(263, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-11 14:55:44', '2022-08-11 14:55:44'),
(264, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 14:55:49', '2022-08-11 14:55:49'),
(265, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 15:06:36', '2022-08-11 15:06:36'),
(266, 91, 'App\\Models\\AboutUS', 'update', 12, '2022-08-11 15:06:42', '2022-08-11 15:06:42'),
(267, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 15:06:42', '2022-08-11 15:06:42'),
(268, 91, 'App\\Models\\AboutUS', 'update', 13, '2022-08-11 15:06:50', '2022-08-11 15:06:50'),
(269, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 15:06:50', '2022-08-11 15:06:50'),
(270, 91, 'App\\Models\\AboutUS', 'update', 14, '2022-08-11 15:06:55', '2022-08-11 15:06:55'),
(271, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 15:06:55', '2022-08-11 15:06:55'),
(272, 91, 'App\\Models\\AboutUS', 'update', 13, '2022-08-11 15:10:07', '2022-08-11 15:10:07'),
(273, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 15:10:07', '2022-08-11 15:10:07'),
(274, 91, 'App\\Models\\AboutUS', 'update', 13, '2022-08-11 15:11:37', '2022-08-11 15:11:37'),
(275, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 15:11:37', '2022-08-11 15:11:37'),
(276, 91, 'App\\Models\\AboutUS', 'update', 13, '2022-08-11 15:11:43', '2022-08-11 15:11:43'),
(277, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 15:11:43', '2022-08-11 15:11:43'),
(278, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-11 15:18:32', '2022-08-11 15:18:32'),
(279, 91, 'App\\Models\\Branch', 'view', 0, '2022-08-11 15:20:19', '2022-08-11 15:20:19'),
(280, 91, 'App\\Models\\Order', 'view', 0, '2022-08-11 15:20:37', '2022-08-11 15:20:37'),
(281, 91, 'App\\Models\\User', 'view', 0, '2022-08-11 15:20:43', '2022-08-11 15:20:43'),
(282, 91, 'App\\Models\\User', 'view', 0, '2022-08-11 15:28:44', '2022-08-11 15:28:44'),
(283, 91, 'App\\Models\\User', 'create', 203, '2022-08-11 15:30:07', '2022-08-11 15:30:07'),
(284, 91, 'App\\Models\\User', 'view', 0, '2022-08-11 15:30:07', '2022-08-11 15:30:07'),
(285, 203, 'App\\Models\\dashboard', 'view', 0, '2022-08-11 15:31:33', '2022-08-11 15:31:33'),
(286, 203, 'App\\Models\\Order', 'view', 0, '2022-08-11 16:05:47', '2022-08-11 16:05:47'),
(287, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:06:04', '2022-08-11 16:06:04'),
(288, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:06:40', '2022-08-11 16:06:40'),
(289, 91, 'App\\Models\\AboutUS', 'update', 13, '2022-08-11 16:06:47', '2022-08-11 16:06:47'),
(290, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:06:47', '2022-08-11 16:06:47'),
(291, 91, 'App\\Models\\AboutUS', 'update', 13, '2022-08-11 16:10:31', '2022-08-11 16:10:31'),
(292, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:10:31', '2022-08-11 16:10:31'),
(293, 91, 'App\\Models\\AboutUS', 'update', 14, '2022-08-11 16:10:38', '2022-08-11 16:10:38'),
(294, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:10:38', '2022-08-11 16:10:38'),
(295, 91, 'App\\Models\\AboutUS', 'update', 12, '2022-08-11 16:10:43', '2022-08-11 16:10:43'),
(296, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:10:43', '2022-08-11 16:10:43'),
(297, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:14:18', '2022-08-11 16:14:18'),
(298, 91, 'App\\Models\\AboutUS', 'create', 15, '2022-08-11 16:17:39', '2022-08-11 16:17:39'),
(299, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:17:39', '2022-08-11 16:17:39'),
(300, 91, 'App\\Models\\AboutUS', 'create', 16, '2022-08-11 16:18:17', '2022-08-11 16:18:17'),
(301, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:18:17', '2022-08-11 16:18:17'),
(302, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:19:36', '2022-08-11 16:19:36'),
(303, 91, 'App\\Models\\AboutUS', 'create', 17, '2022-08-11 16:20:01', '2022-08-11 16:20:01'),
(304, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:20:01', '2022-08-11 16:20:01'),
(305, 91, 'App\\Models\\AboutUS', 'create', 18, '2022-08-11 16:20:41', '2022-08-11 16:20:41'),
(306, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:20:41', '2022-08-11 16:20:41'),
(307, 91, 'App\\Models\\AboutUS', 'update', 17, '2022-08-11 16:20:48', '2022-08-11 16:20:48'),
(308, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:20:48', '2022-08-11 16:20:48'),
(309, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:20:53', '2022-08-11 16:20:53'),
(310, 91, 'App\\Models\\AboutUS', 'create', 19, '2022-08-11 16:21:29', '2022-08-11 16:21:29'),
(311, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:21:30', '2022-08-11 16:21:30'),
(312, 91, 'App\\Models\\AboutUS', 'update', 19, '2022-08-11 16:21:35', '2022-08-11 16:21:35'),
(313, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:21:35', '2022-08-11 16:21:35'),
(314, 91, 'App\\Models\\AboutUS', 'create', 20, '2022-08-11 16:21:58', '2022-08-11 16:21:58'),
(315, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:21:58', '2022-08-11 16:21:58'),
(316, 91, 'App\\Models\\AboutUS', 'update', 20, '2022-08-11 16:22:04', '2022-08-11 16:22:04'),
(317, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:22:04', '2022-08-11 16:22:04'),
(318, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:23:14', '2022-08-11 16:23:14'),
(319, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:24:54', '2022-08-11 16:24:54'),
(320, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 16:26:04', '2022-08-11 16:26:04'),
(321, 91, 'App\\Models\\Gallery', 'view', 0, '2022-08-11 17:51:50', '2022-08-11 17:51:50'),
(322, 91, 'App\\Models\\Gallery', 'create', 1, '2022-08-11 17:52:19', '2022-08-11 17:52:19'),
(323, 91, 'App\\Models\\Gallery', 'view', 0, '2022-08-11 17:52:19', '2022-08-11 17:52:19'),
(324, 91, 'App\\Models\\Gallery', 'view', 0, '2022-08-11 18:27:51', '2022-08-11 18:27:51'),
(325, 91, 'App\\Models\\AboutUS', 'view', 0, '2022-08-11 19:49:14', '2022-08-11 19:49:14'),
(326, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:05:21', '2022-08-11 20:05:21'),
(327, 91, 'App\\Models\\Offer', 'updete', 3, '2022-08-11 20:05:40', '2022-08-11 20:05:40'),
(328, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:06:00', '2022-08-11 20:06:00'),
(329, 91, 'App\\Models\\Offer', 'updete', 2, '2022-08-11 20:06:44', '2022-08-11 20:06:44'),
(330, 91, 'App\\Models\\Offer', 'updete', 2, '2022-08-11 20:08:26', '2022-08-11 20:08:26'),
(331, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:08:40', '2022-08-11 20:08:40'),
(332, 91, 'App\\Models\\Offer', 'create', 6, '2022-08-11 20:09:40', '2022-08-11 20:09:40'),
(333, 91, 'App\\Models\\OfferBuyGet', 'create', 6, '2022-08-11 20:09:40', '2022-08-11 20:09:40'),
(334, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:09:46', '2022-08-11 20:09:46'),
(335, 91, 'App\\Models\\Offer', 'delete', 2, '2022-08-11 20:24:58', '2022-08-11 20:24:58'),
(336, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:24:58', '2022-08-11 20:24:58'),
(337, 91, 'App\\Models\\Offer', 'delete', 3, '2022-08-11 20:25:02', '2022-08-11 20:25:02'),
(338, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:25:02', '2022-08-11 20:25:02'),
(339, 91, 'App\\Models\\Offer', 'delete', 4, '2022-08-11 20:25:04', '2022-08-11 20:25:04'),
(340, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:25:05', '2022-08-11 20:25:05'),
(341, 91, 'App\\Models\\Offer', 'delete', 5, '2022-08-11 20:25:07', '2022-08-11 20:25:07'),
(342, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:25:07', '2022-08-11 20:25:07'),
(343, 91, 'App\\Models\\Offer', 'create', 7, '2022-08-11 20:27:55', '2022-08-11 20:27:55'),
(344, 91, 'App\\Models\\OfferBuyGet', 'create', 7, '2022-08-11 20:27:55', '2022-08-11 20:27:55'),
(345, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:28:02', '2022-08-11 20:28:02'),
(346, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-11 20:32:00', '2022-08-11 20:32:00'),
(347, 91, 'App\\Models\\Without', 'view', 0, '2022-08-11 20:32:02', '2022-08-11 20:32:02'),
(348, 91, 'App\\Models\\Category', 'view', 0, '2022-08-11 20:32:05', '2022-08-11 20:32:05'),
(349, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-11 20:32:08', '2022-08-11 20:32:08'),
(350, 91, 'App\\Models\\Extra', 'create', 1, '2022-08-11 20:32:57', '2022-08-11 20:32:57'),
(351, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-11 20:32:58', '2022-08-11 20:32:58'),
(352, 91, 'App\\Models\\Extra', 'create', 2, '2022-08-11 20:33:38', '2022-08-11 20:33:38'),
(353, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-11 20:33:38', '2022-08-11 20:33:38'),
(354, 91, 'App\\Models\\Extra', 'create', 3, '2022-08-11 20:34:03', '2022-08-11 20:34:03'),
(355, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-11 20:34:04', '2022-08-11 20:34:04'),
(356, 91, 'App\\Models\\Without', 'view', 0, '2022-08-11 20:34:11', '2022-08-11 20:34:11'),
(357, 91, 'App\\Models\\Without', 'create', 1, '2022-08-11 20:35:52', '2022-08-11 20:35:52'),
(358, 91, 'App\\Models\\Without', 'view', 0, '2022-08-11 20:35:52', '2022-08-11 20:35:52'),
(359, 91, 'App\\Models\\Without', 'create', 2, '2022-08-11 20:36:24', '2022-08-11 20:36:24'),
(360, 91, 'App\\Models\\Without', 'view', 0, '2022-08-11 20:36:25', '2022-08-11 20:36:25'),
(361, 91, 'App\\Models\\Without', 'create', 3, '2022-08-11 20:36:54', '2022-08-11 20:36:54'),
(362, 91, 'App\\Models\\Without', 'view', 0, '2022-08-11 20:36:54', '2022-08-11 20:36:54'),
(363, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-11 20:37:45', '2022-08-11 20:37:45'),
(364, 91, 'App\\Models\\Without', 'view', 0, '2022-08-11 20:37:49', '2022-08-11 20:37:49'),
(365, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-11 20:37:54', '2022-08-11 20:37:54'),
(366, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:38:16', '2022-08-11 20:38:16'),
(367, 91, 'App\\Models\\Offer', 'create', 8, '2022-08-11 20:39:11', '2022-08-11 20:39:11'),
(368, 91, 'App\\Models\\OfferBuyGet', 'create', 8, '2022-08-11 20:39:11', '2022-08-11 20:39:11'),
(369, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:39:17', '2022-08-11 20:39:17'),
(370, 91, 'App\\Models\\Offer', 'create', 9, '2022-08-11 20:40:16', '2022-08-11 20:40:16'),
(371, 91, 'App\\Models\\OfferDiscount', 'create', 2, '2022-08-11 20:40:16', '2022-08-11 20:40:16'),
(372, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:40:22', '2022-08-11 20:40:22'),
(373, 91, 'App\\Models\\Offer', 'create', 10, '2022-08-11 20:41:04', '2022-08-11 20:41:04'),
(374, 91, 'App\\Models\\OfferDiscount', 'create', 3, '2022-08-11 20:41:04', '2022-08-11 20:41:04'),
(375, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:41:10', '2022-08-11 20:41:10'),
(376, 91, 'App\\Models\\Offer', 'create', 11, '2022-08-11 20:42:14', '2022-08-11 20:42:14'),
(377, 91, 'App\\Models\\OfferBuyGet', 'create', 9, '2022-08-11 20:42:14', '2022-08-11 20:42:14'),
(378, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:42:20', '2022-08-11 20:42:20'),
(379, 91, 'App\\Models\\Offer', 'create', 12, '2022-08-11 20:43:24', '2022-08-11 20:43:24'),
(380, 91, 'App\\Models\\OfferDiscount', 'create', 4, '2022-08-11 20:43:24', '2022-08-11 20:43:24'),
(381, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:43:29', '2022-08-11 20:43:29'),
(382, 91, 'App\\Models\\Offer', 'create', 13, '2022-08-11 20:44:14', '2022-08-11 20:44:14'),
(383, 91, 'App\\Models\\OfferDiscount', 'create', 5, '2022-08-11 20:44:14', '2022-08-11 20:44:14'),
(384, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:44:20', '2022-08-11 20:44:20'),
(385, 91, 'App\\Models\\Order', 'view', 0, '2022-08-11 20:44:24', '2022-08-11 20:44:24'),
(386, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-11 20:44:32', '2022-08-11 20:44:32'),
(387, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-13 18:21:17', '2022-08-13 18:21:17'),
(388, 91, 'App\\Models\\Order', 'view', 0, '2022-08-13 18:21:20', '2022-08-13 18:21:20'),
(389, 91, 'App\\Models\\Offer', 'view', 0, '2022-08-13 18:21:33', '2022-08-13 18:21:33'),
(390, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-13 18:34:38', '2022-08-13 18:34:38'),
(391, 91, 'App\\Models\\Extra', 'create', 4, '2022-08-13 18:35:30', '2022-08-13 18:35:30'),
(392, 91, 'App\\Models\\Extra', 'view', 0, '2022-08-13 18:35:31', '2022-08-13 18:35:31'),
(393, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-13 19:03:00', '2022-08-13 19:03:00'),
(394, 91, 'App\\Models\\General', 'update', 1, '2022-08-13 19:07:27', '2022-08-13 19:07:27'),
(395, 91, 'App\\Models\\General', 'update', 2, '2022-08-13 19:08:22', '2022-08-13 19:08:22'),
(396, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-13 19:18:02', '2022-08-13 19:18:02'),
(397, 91, 'App\\Models\\dashboard', 'view', 0, '2022-08-13 19:18:25', '2022-08-13 19:18:25'),
(398, 91, 'App\\Models\\General', 'update', 3, '2022-08-13 19:22:11', '2022-08-13 19:22:11'),
(399, 91, 'App\\Models\\General', 'update', 4, '2022-08-13 19:22:54', '2022-08-13 19:22:54'),
(400, 91, 'App\\Models\\General', 'update', 5, '2022-08-13 19:23:31', '2022-08-13 19:23:31'),
(401, 91, 'App\\Models\\General', 'update', 6, '2022-08-13 19:23:49', '2022-08-13 19:23:49'),
(402, 91, 'App\\Models\\General', 'update', 3, '2022-08-13 19:29:46', '2022-08-13 19:29:46'),
(403, 91, 'App\\Models\\General', 'update', 5, '2022-08-13 19:29:54', '2022-08-13 19:29:54'),
(404, 91, 'App\\Models\\General', 'update', 7, '2022-08-13 19:31:11', '2022-08-13 19:31:11'),
(405, 91, 'App\\Models\\General', 'update', 7, '2022-08-13 19:31:18', '2022-08-13 19:31:18'),
(406, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-14 16:08:02', '2022-08-14 16:08:02'),
(407, 93, 'App\\Models\\Category', 'view', 0, '2022-08-14 16:08:07', '2022-08-14 16:08:07'),
(408, 93, 'App\\Models\\Category', 'view', 0, '2022-08-14 16:23:01', '2022-08-14 16:23:01'),
(409, 93, 'App\\Models\\Category', 'view', 0, '2022-08-14 16:40:36', '2022-08-14 16:40:36'),
(410, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-14 19:09:14', '2022-08-14 19:09:14'),
(411, 93, 'App\\Models\\Order', 'view', 0, '2022-08-14 19:09:23', '2022-08-14 19:09:23'),
(412, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:09:26', '2022-08-14 19:09:26'),
(413, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:11:57', '2022-08-14 19:11:57'),
(414, 93, 'App\\Models\\AboutUS', 'create', 21, '2022-08-14 19:39:05', '2022-08-14 19:39:05'),
(415, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:39:05', '2022-08-14 19:39:05'),
(416, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:41:10', '2022-08-14 19:41:10'),
(417, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:43:19', '2022-08-14 19:43:19'),
(418, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:43:27', '2022-08-14 19:43:27'),
(419, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:44:06', '2022-08-14 19:44:06'),
(420, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:46:48', '2022-08-14 19:46:48'),
(421, 93, 'App\\Models\\Order', 'view', 0, '2022-08-14 19:57:27', '2022-08-14 19:57:27'),
(422, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:57:31', '2022-08-14 19:57:31'),
(423, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 19:59:21', '2022-08-14 19:59:21'),
(424, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:01:49', '2022-08-14 20:01:49'),
(425, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:06:34', '2022-08-14 20:06:34'),
(426, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:06:59', '2022-08-14 20:06:59'),
(427, 93, 'App\\Models\\AboutUS', 'create', 22, '2022-08-14 20:10:56', '2022-08-14 20:10:56'),
(428, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:10:56', '2022-08-14 20:10:56'),
(429, 93, 'App\\Models\\AboutUS', 'create', 23, '2022-08-14 20:11:40', '2022-08-14 20:11:40'),
(430, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:11:41', '2022-08-14 20:11:41'),
(431, 93, 'App\\Models\\AboutUS', 'create', 24, '2022-08-14 20:12:13', '2022-08-14 20:12:13'),
(432, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:12:13', '2022-08-14 20:12:13'),
(433, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:12:26', '2022-08-14 20:12:26'),
(434, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:13:45', '2022-08-14 20:13:45'),
(435, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:14:13', '2022-08-14 20:14:13'),
(436, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:15:53', '2022-08-14 20:15:53'),
(437, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:16:35', '2022-08-14 20:16:35'),
(438, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:16:44', '2022-08-14 20:16:44'),
(439, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:16:51', '2022-08-14 20:16:51'),
(440, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:19:19', '2022-08-14 20:19:19'),
(441, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:19:59', '2022-08-14 20:19:59'),
(442, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:20:23', '2022-08-14 20:20:23'),
(443, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-14 20:20:29', '2022-08-14 20:20:29'),
(444, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:27:54', '2022-08-14 23:27:54'),
(445, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:28:10', '2022-08-14 23:28:10'),
(446, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:31:09', '2022-08-14 23:31:09'),
(447, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:31:24', '2022-08-14 23:31:24'),
(448, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:31:49', '2022-08-14 23:31:49'),
(449, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:32:47', '2022-08-14 23:32:47'),
(450, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:33:10', '2022-08-14 23:33:10'),
(451, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:33:19', '2022-08-14 23:33:19'),
(452, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:33:28', '2022-08-14 23:33:28'),
(453, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:33:52', '2022-08-14 23:33:52'),
(454, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:34:05', '2022-08-14 23:34:05'),
(455, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:34:58', '2022-08-14 23:34:58'),
(456, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:35:02', '2022-08-14 23:35:02'),
(457, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:35:05', '2022-08-14 23:35:05'),
(458, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-14 23:36:09', '2022-08-14 23:36:09'),
(459, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-15 00:10:56', '2022-08-15 00:10:56'),
(460, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-15 15:29:04', '2022-08-15 15:29:04'),
(461, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 15:29:21', '2022-08-15 15:29:21'),
(462, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-15 15:29:29', '2022-08-15 15:29:29'),
(463, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-15 16:05:09', '2022-08-15 16:05:09'),
(464, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-15 16:05:19', '2022-08-15 16:05:19'),
(465, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-15 16:05:38', '2022-08-15 16:05:38'),
(466, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-15 16:05:59', '2022-08-15 16:05:59'),
(467, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-15 16:06:20', '2022-08-15 16:06:20'),
(468, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-15 16:06:37', '2022-08-15 16:06:37'),
(469, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-15 16:11:24', '2022-08-15 16:11:24'),
(470, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-15 16:15:15', '2022-08-15 16:15:15'),
(471, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-15 16:38:02', '2022-08-15 16:38:02'),
(472, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:00:25', '2022-08-15 18:00:25'),
(473, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:03:00', '2022-08-15 18:03:00'),
(474, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:03:17', '2022-08-15 18:03:17'),
(475, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:03:21', '2022-08-15 18:03:21'),
(476, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:04:22', '2022-08-15 18:04:22'),
(477, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:05:43', '2022-08-15 18:05:43'),
(478, 93, 'App\\Models\\AboutUS', 'create', 25, '2022-08-15 18:07:34', '2022-08-15 18:07:34'),
(479, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:07:34', '2022-08-15 18:07:34'),
(480, 93, 'App\\Models\\AboutUS', 'update', 25, '2022-08-15 18:09:10', '2022-08-15 18:09:10'),
(481, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:09:10', '2022-08-15 18:09:10'),
(482, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:14:58', '2022-08-15 18:14:58'),
(483, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:23:14', '2022-08-15 18:23:14'),
(484, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 18:23:25', '2022-08-15 18:23:25'),
(485, 93, 'App\\Models\\AboutUS', 'create', 26, '2022-08-15 19:17:12', '2022-08-15 19:17:12'),
(486, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:17:12', '2022-08-15 19:17:12'),
(487, 93, 'App\\Models\\AboutUS', 'delete', 26, '2022-08-15 19:17:21', '2022-08-15 19:17:21'),
(488, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:17:21', '2022-08-15 19:17:21'),
(489, 93, 'App\\Models\\AboutUS', 'create', 27, '2022-08-15 19:18:07', '2022-08-15 19:18:07'),
(490, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:18:07', '2022-08-15 19:18:07'),
(491, 93, 'App\\Models\\AboutUS', 'delete', 12, '2022-08-15 19:18:56', '2022-08-15 19:18:56'),
(492, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:18:56', '2022-08-15 19:18:56'),
(493, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:23:02', '2022-08-15 19:23:02'),
(494, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:24:57', '2022-08-15 19:24:57'),
(495, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:30:11', '2022-08-15 19:30:11'),
(496, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-15 19:31:18', '2022-08-15 19:31:18'),
(497, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-15 19:34:13', '2022-08-15 19:34:13'),
(498, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:02:55', '2022-08-15 20:02:55'),
(499, 93, 'App\\Models\\Gallery', 'view', 0, '2022-08-15 20:02:57', '2022-08-15 20:02:57'),
(500, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:46:19', '2022-08-15 20:46:19'),
(501, 93, 'App\\Models\\Media', 'create', 6, '2022-08-15 20:49:09', '2022-08-15 20:49:09'),
(502, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:49:09', '2022-08-15 20:49:09'),
(503, 93, 'App\\Models\\Media', 'delete', 6, '2022-08-15 20:49:38', '2022-08-15 20:49:38'),
(504, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:49:38', '2022-08-15 20:49:38'),
(505, 93, 'App\\Models\\Media', 'create', 7, '2022-08-15 20:50:15', '2022-08-15 20:50:15'),
(506, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:50:15', '2022-08-15 20:50:15'),
(507, 93, 'App\\Models\\Media', 'delete', 7, '2022-08-15 20:50:35', '2022-08-15 20:50:35'),
(508, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:50:36', '2022-08-15 20:50:36'),
(509, 93, 'App\\Models\\Media', 'create', 8, '2022-08-15 20:51:10', '2022-08-15 20:51:10'),
(510, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:51:11', '2022-08-15 20:51:11'),
(511, 93, 'App\\Models\\Media', 'delete', 8, '2022-08-15 20:51:51', '2022-08-15 20:51:51'),
(512, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:51:52', '2022-08-15 20:51:52'),
(513, 93, 'App\\Models\\Media', 'create', 9, '2022-08-15 20:52:09', '2022-08-15 20:52:09'),
(514, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:52:10', '2022-08-15 20:52:10'),
(515, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:56:20', '2022-08-15 20:56:20'),
(516, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:57:38', '2022-08-15 20:57:38'),
(517, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:58:13', '2022-08-15 20:58:13'),
(518, 93, 'App\\Models\\Media', 'view', 0, '2022-08-15 20:58:29', '2022-08-15 20:58:29'),
(519, 93, 'App\\Models\\Extra', 'view', 0, '2022-08-15 21:17:34', '2022-08-15 21:17:34'),
(520, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-16 18:05:07', '2022-08-16 18:05:07'),
(521, 93, 'App\\Models\\Extra', 'view', 0, '2022-08-16 18:05:11', '2022-08-16 18:05:11'),
(550, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-17 17:27:41', '2022-08-17 17:27:41'),
(551, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:27:48', '2022-08-17 17:27:48'),
(552, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:29:50', '2022-08-17 17:29:50'),
(553, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:30:27', '2022-08-17 17:30:27'),
(554, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:30:30', '2022-08-17 17:30:30'),
(555, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:30:33', '2022-08-17 17:30:33'),
(556, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:30:36', '2022-08-17 17:30:36'),
(557, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:33:01', '2022-08-17 17:33:01'),
(558, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:33:03', '2022-08-17 17:33:03'),
(559, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:33:06', '2022-08-17 17:33:06'),
(560, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:33:08', '2022-08-17 17:33:08'),
(561, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:33:15', '2022-08-17 17:33:15'),
(562, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:33:17', '2022-08-17 17:33:17'),
(563, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-17 17:35:50', '2022-08-17 17:35:50'),
(579, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:06:37', '2022-08-18 20:06:37'),
(580, 93, 'App\\Models\\Offer', 'updete', 6, '2022-08-18 20:07:26', '2022-08-18 20:07:26'),
(581, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-08-18 20:07:26', '2022-08-18 20:07:26'),
(582, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:07:26', '2022-08-18 20:07:26'),
(583, 93, 'App\\Models\\Offer', 'updete', 12, '2022-08-18 20:08:14', '2022-08-18 20:08:14'),
(584, 93, 'App\\Models\\OfferDiscount', 'updete', 4, '2022-08-18 20:08:14', '2022-08-18 20:08:14'),
(585, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:08:14', '2022-08-18 20:08:14'),
(586, 93, 'App\\Models\\Offer', 'updete', 13, '2022-08-18 20:08:49', '2022-08-18 20:08:49'),
(587, 93, 'App\\Models\\OfferDiscount', 'updete', 5, '2022-08-18 20:08:50', '2022-08-18 20:08:50'),
(588, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:08:50', '2022-08-18 20:08:50'),
(589, 93, 'App\\Models\\Offer', 'updete', 12, '2022-08-18 20:09:12', '2022-08-18 20:09:12'),
(590, 93, 'App\\Models\\OfferDiscount', 'updete', 4, '2022-08-18 20:09:12', '2022-08-18 20:09:12'),
(591, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:09:13', '2022-08-18 20:09:13'),
(592, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:09:40', '2022-08-18 20:09:40');
INSERT INTO `log_files` (`id`, `user_id`, `model`, `action`, `action_id`, `created_at`, `updated_at`) VALUES
(593, 93, 'App\\Models\\Item', 'update', 112, '2022-08-18 20:09:54', '2022-08-18 20:09:54'),
(594, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:09:54', '2022-08-18 20:09:54'),
(595, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:09:58', '2022-08-18 20:09:58'),
(596, 93, 'App\\Models\\Item', 'update', 111, '2022-08-18 20:10:13', '2022-08-18 20:10:13'),
(597, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:10:13', '2022-08-18 20:10:13'),
(598, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:10:18', '2022-08-18 20:10:18'),
(599, 93, 'App\\Models\\Item', 'update', 111, '2022-08-18 20:10:31', '2022-08-18 20:10:31'),
(600, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:10:32', '2022-08-18 20:10:32'),
(601, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:10:54', '2022-08-18 20:10:54'),
(602, 93, 'App\\Models\\Offer', 'updete', 10, '2022-08-18 20:11:28', '2022-08-18 20:11:28'),
(603, 93, 'App\\Models\\OfferDiscount', 'updete', 3, '2022-08-18 20:11:28', '2022-08-18 20:11:28'),
(604, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:11:28', '2022-08-18 20:11:28'),
(605, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:12:29', '2022-08-18 20:12:29'),
(606, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:12:35', '2022-08-18 20:12:35'),
(607, 93, 'App\\Models\\Item', 'update', 110, '2022-08-18 20:12:58', '2022-08-18 20:12:58'),
(608, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:12:58', '2022-08-18 20:12:58'),
(609, 93, 'App\\Models\\Item', 'update', 109, '2022-08-18 20:13:21', '2022-08-18 20:13:21'),
(610, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:13:22', '2022-08-18 20:13:22'),
(611, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:14:01', '2022-08-18 20:14:01'),
(612, 93, 'App\\Models\\Item', 'update', 1, '2022-08-18 20:14:15', '2022-08-18 20:14:15'),
(613, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:14:15', '2022-08-18 20:14:15'),
(614, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:16:22', '2022-08-18 20:16:22'),
(615, 93, 'App\\Models\\Offer', 'updete', 13, '2022-08-18 20:16:47', '2022-08-18 20:16:47'),
(616, 93, 'App\\Models\\OfferDiscount', 'updete', 5, '2022-08-18 20:16:47', '2022-08-18 20:16:47'),
(617, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-18 20:16:47', '2022-08-18 20:16:47'),
(618, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:21:44', '2022-08-18 20:21:44'),
(619, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:21:55', '2022-08-18 20:21:55'),
(620, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:21:59', '2022-08-18 20:21:59'),
(621, 93, 'App\\Models\\Item', 'update', 4, '2022-08-18 20:22:08', '2022-08-18 20:22:08'),
(622, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:22:09', '2022-08-18 20:22:09'),
(623, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:22:13', '2022-08-18 20:22:13'),
(624, 93, 'App\\Models\\Item', 'update', 3, '2022-08-18 20:22:25', '2022-08-18 20:22:25'),
(625, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:22:25', '2022-08-18 20:22:25'),
(626, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:22:31', '2022-08-18 20:22:31'),
(627, 93, 'App\\Models\\Item', 'update', 2, '2022-08-18 20:22:41', '2022-08-18 20:22:41'),
(628, 93, 'App\\Models\\Item', 'view', 0, '2022-08-18 20:22:41', '2022-08-18 20:22:41'),
(629, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-18 23:05:05', '2022-08-18 23:05:05'),
(630, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:09', '2022-08-18 23:05:09'),
(631, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:14', '2022-08-18 23:05:14'),
(632, 93, 'App\\Models\\AboutUS', 'delete', 27, '2022-08-18 23:05:37', '2022-08-18 23:05:37'),
(633, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:37', '2022-08-18 23:05:37'),
(634, 93, 'App\\Models\\AboutUS', 'delete', 13, '2022-08-18 23:05:40', '2022-08-18 23:05:40'),
(635, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:40', '2022-08-18 23:05:40'),
(636, 93, 'App\\Models\\AboutUS', 'delete', 14, '2022-08-18 23:05:41', '2022-08-18 23:05:41'),
(637, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:42', '2022-08-18 23:05:42'),
(638, 93, 'App\\Models\\AboutUS', 'delete', 15, '2022-08-18 23:05:44', '2022-08-18 23:05:44'),
(639, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:44', '2022-08-18 23:05:44'),
(640, 93, 'App\\Models\\AboutUS', 'delete', 16, '2022-08-18 23:05:45', '2022-08-18 23:05:45'),
(641, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:45', '2022-08-18 23:05:45'),
(642, 93, 'App\\Models\\AboutUS', 'delete', 17, '2022-08-18 23:05:47', '2022-08-18 23:05:47'),
(643, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:47', '2022-08-18 23:05:47'),
(644, 93, 'App\\Models\\AboutUS', 'delete', 18, '2022-08-18 23:05:49', '2022-08-18 23:05:49'),
(645, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:49', '2022-08-18 23:05:49'),
(646, 93, 'App\\Models\\AboutUS', 'delete', 19, '2022-08-18 23:05:51', '2022-08-18 23:05:51'),
(647, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:51', '2022-08-18 23:05:51'),
(648, 93, 'App\\Models\\AboutUS', 'delete', 20, '2022-08-18 23:05:52', '2022-08-18 23:05:52'),
(649, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:53', '2022-08-18 23:05:53'),
(650, 93, 'App\\Models\\AboutUS', 'delete', 21, '2022-08-18 23:05:54', '2022-08-18 23:05:54'),
(651, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:54', '2022-08-18 23:05:54'),
(652, 93, 'App\\Models\\AboutUS', 'delete', 22, '2022-08-18 23:05:56', '2022-08-18 23:05:56'),
(653, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:57', '2022-08-18 23:05:57'),
(654, 93, 'App\\Models\\AboutUS', 'delete', 23, '2022-08-18 23:05:58', '2022-08-18 23:05:58'),
(655, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:05:58', '2022-08-18 23:05:58'),
(656, 93, 'App\\Models\\AboutUS', 'delete', 24, '2022-08-18 23:06:00', '2022-08-18 23:06:00'),
(657, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:06:00', '2022-08-18 23:06:00'),
(658, 93, 'App\\Models\\AboutUS', 'delete', 25, '2022-08-18 23:06:02', '2022-08-18 23:06:02'),
(659, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:06:02', '2022-08-18 23:06:02'),
(660, 93, 'App\\Models\\AboutUS', 'create', 28, '2022-08-18 23:10:50', '2022-08-18 23:10:50'),
(661, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:10:50', '2022-08-18 23:10:50'),
(662, 93, 'App\\Models\\AboutUS', 'create', 29, '2022-08-18 23:12:30', '2022-08-18 23:12:30'),
(663, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:12:30', '2022-08-18 23:12:30'),
(664, 93, 'App\\Models\\AboutUS', 'create', 30, '2022-08-18 23:14:12', '2022-08-18 23:14:12'),
(665, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:14:12', '2022-08-18 23:14:12'),
(666, 93, 'App\\Models\\AboutUS', 'create', 31, '2022-08-18 23:15:06', '2022-08-18 23:15:06'),
(667, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:15:06', '2022-08-18 23:15:06'),
(668, 93, 'App\\Models\\AboutUS', 'create', 32, '2022-08-18 23:15:53', '2022-08-18 23:15:53'),
(669, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:15:53', '2022-08-18 23:15:53'),
(670, 93, 'App\\Models\\AboutUS', 'create', 33, '2022-08-18 23:16:38', '2022-08-18 23:16:38'),
(671, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:16:38', '2022-08-18 23:16:38'),
(672, 93, 'App\\Models\\AboutUS', 'create', 34, '2022-08-18 23:18:40', '2022-08-18 23:18:40'),
(673, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:18:40', '2022-08-18 23:18:40'),
(674, 93, 'App\\Models\\AboutUS', 'create', 35, '2022-08-18 23:21:11', '2022-08-18 23:21:11'),
(675, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:21:11', '2022-08-18 23:21:11'),
(676, 93, 'App\\Models\\AboutUS', 'create', 36, '2022-08-18 23:23:31', '2022-08-18 23:23:31'),
(677, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-18 23:23:32', '2022-08-18 23:23:32'),
(678, 70, 'App\\Models\\dashboard', 'view', 0, '2022-08-21 19:43:57', '2022-08-21 19:43:57'),
(679, 70, 'App\\Models\\Category', 'view', 0, '2022-08-21 19:44:02', '2022-08-21 19:44:02'),
(680, 70, 'App\\Models\\Item', 'view', 0, '2022-08-21 19:44:16', '2022-08-21 19:44:16'),
(681, 70, 'App\\Models\\Item', 'view', 0, '2022-08-21 19:44:24', '2022-08-21 19:44:24'),
(682, 70, 'App\\Models\\Item', 'update', 113, '2022-08-21 19:44:32', '2022-08-21 19:44:32'),
(683, 70, 'App\\Models\\Item', 'view', 0, '2022-08-21 19:44:32', '2022-08-21 19:44:32'),
(684, 225, 'App\\Models\\dashboard', 'view', 0, '2022-08-21 22:41:35', '2022-08-21 22:41:35'),
(685, 225, 'App\\Models\\Order', 'view', 0, '2022-08-21 22:41:45', '2022-08-21 22:41:45'),
(686, 225, 'App\\Models\\Without', 'view', 0, '2022-08-21 22:41:48', '2022-08-21 22:41:48'),
(687, 225, 'App\\Models\\Without', 'view', 0, '2022-08-21 22:41:54', '2022-08-21 22:41:54'),
(688, 225, 'App\\Models\\Extra', 'view', 0, '2022-08-21 22:41:56', '2022-08-21 22:41:56'),
(689, 225, 'App\\Models\\Item', 'view', 0, '2022-08-21 22:42:00', '2022-08-21 22:42:00'),
(690, 225, 'App\\Models\\Category', 'view', 0, '2022-08-21 22:42:01', '2022-08-21 22:42:01'),
(691, 225, 'App\\Models\\Category', 'update', 14, '2022-08-21 22:42:08', '2022-08-21 22:42:08'),
(692, 225, 'App\\Models\\Category', 'view', 0, '2022-08-21 22:42:08', '2022-08-21 22:42:08'),
(693, 225, 'App\\Models\\dashboard', 'view', 0, '2022-08-22 17:25:51', '2022-08-22 17:25:51'),
(694, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-22 18:58:52', '2022-08-22 18:58:52'),
(695, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-22 19:06:26', '2022-08-22 19:06:26'),
(696, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-22 19:06:29', '2022-08-22 19:06:29'),
(697, 93, 'App\\Models\\Offer', 'updete', 10, '2022-08-22 19:07:57', '2022-08-22 19:07:57'),
(698, 93, 'App\\Models\\OfferDiscount', 'updete', 3, '2022-08-22 19:07:57', '2022-08-22 19:07:57'),
(699, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-22 19:07:57', '2022-08-22 19:07:57'),
(700, 93, 'App\\Models\\Offer', 'updete', 10, '2022-08-22 19:08:29', '2022-08-22 19:08:29'),
(701, 93, 'App\\Models\\OfferDiscount', 'updete', 3, '2022-08-22 19:08:29', '2022-08-22 19:08:29'),
(702, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-22 19:08:30', '2022-08-22 19:08:30'),
(703, 93, 'App\\Models\\Offer', 'updete', 13, '2022-08-22 19:09:36', '2022-08-22 19:09:36'),
(704, 93, 'App\\Models\\OfferDiscount', 'updete', 5, '2022-08-22 19:09:36', '2022-08-22 19:09:36'),
(705, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-22 19:09:36', '2022-08-22 19:09:36'),
(706, 93, 'App\\Models\\Offer', 'updete', 13, '2022-08-22 19:10:34', '2022-08-22 19:10:34'),
(707, 93, 'App\\Models\\OfferDiscount', 'updete', 5, '2022-08-22 19:10:34', '2022-08-22 19:10:34'),
(708, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-22 19:10:34', '2022-08-22 19:10:34'),
(709, 93, 'App\\Models\\Item', 'view', 0, '2022-08-22 19:10:56', '2022-08-22 19:10:56'),
(710, 93, 'App\\Models\\Item', 'view', 0, '2022-08-22 19:11:04', '2022-08-22 19:11:04'),
(711, 93, 'App\\Models\\Item', 'view', 0, '2022-08-22 19:11:10', '2022-08-22 19:11:10'),
(712, 93, 'App\\Models\\Item', 'view', 0, '2022-08-22 19:11:14', '2022-08-22 19:11:14'),
(713, 93, 'App\\Models\\Item', 'view', 0, '2022-08-22 19:11:17', '2022-08-22 19:11:17'),
(714, 93, 'App\\Models\\Item', 'update', 111, '2022-08-22 19:12:02', '2022-08-22 19:12:02'),
(715, 93, 'App\\Models\\Item', 'view', 0, '2022-08-22 19:12:02', '2022-08-22 19:12:02'),
(716, 93, 'App\\Models\\Item', 'view', 0, '2022-08-22 19:12:08', '2022-08-22 19:12:08'),
(717, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-24 16:52:00', '2022-08-24 16:52:00'),
(718, 93, 'App\\Models\\User', 'view', 0, '2022-08-24 16:52:05', '2022-08-24 16:52:05'),
(719, 93, 'App\\Models\\User', 'update', 161, '2022-08-24 16:52:18', '2022-08-24 16:52:18'),
(720, 93, 'App\\Models\\User', 'view', 0, '2022-08-24 16:52:19', '2022-08-24 16:52:19'),
(721, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-24 20:23:34', '2022-08-24 20:23:34'),
(722, 93, 'App\\Models\\Item', 'view', 0, '2022-08-24 20:23:43', '2022-08-24 20:23:43'),
(723, 93, 'App\\Models\\Category', 'view', 0, '2022-08-24 20:23:55', '2022-08-24 20:23:55'),
(724, 93, 'App\\Models\\Item', 'view', 0, '2022-08-24 20:23:59', '2022-08-24 20:23:59'),
(725, 93, 'App\\Models\\Item', 'view', 0, '2022-08-24 20:24:19', '2022-08-24 20:24:19'),
(726, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-24 21:56:18', '2022-08-24 21:56:18'),
(727, 93, 'App\\Models\\User', 'view', 0, '2022-08-24 21:56:25', '2022-08-24 21:56:25'),
(728, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-24 21:56:27', '2022-08-24 21:56:27'),
(729, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-25 15:44:30', '2022-08-25 15:44:30'),
(730, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-25 15:46:15', '2022-08-25 15:46:15'),
(731, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-25 15:46:39', '2022-08-25 15:46:39'),
(732, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-25 15:51:09', '2022-08-25 15:51:09'),
(733, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-25 15:54:03', '2022-08-25 15:54:03'),
(734, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-25 15:55:33', '2022-08-25 15:55:33'),
(735, 93, 'App\\Models\\User', 'view', 0, '2022-08-25 15:55:35', '2022-08-25 15:55:35'),
(736, 93, 'App\\Models\\User', 'view', 0, '2022-08-25 16:01:19', '2022-08-25 16:01:19'),
(737, 93, 'App\\Models\\Category', 'view', 0, '2022-08-25 16:01:22', '2022-08-25 16:01:22'),
(738, 93, 'App\\Models\\Careers', 'view', 0, '2022-08-25 16:01:30', '2022-08-25 16:01:30'),
(739, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-25 16:01:35', '2022-08-25 16:01:35'),
(740, 93, 'App\\Models\\Messages', 'create', 2, '2022-08-25 16:07:47', '2022-08-25 16:07:47'),
(741, 93, 'App\\Models\\Messages', 'create', 3, '2022-08-25 16:08:15', '2022-08-25 16:08:15'),
(742, 93, 'App\\Models\\Messages', 'create', 4, '2022-08-25 16:08:38', '2022-08-25 16:08:38'),
(743, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-25 16:17:14', '2022-08-25 16:17:14'),
(744, 93, 'App\\Models\\Banner', 'delete', 7, '2022-08-25 16:17:22', '2022-08-25 16:17:22'),
(745, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-25 16:17:22', '2022-08-25 16:17:22'),
(746, 93, 'App\\Models\\Messages', 'delete', 3, '2022-08-25 16:26:16', '2022-08-25 16:26:16'),
(747, 93, 'App\\Models\\Messages', 'delete', 4, '2022-08-25 16:27:36', '2022-08-25 16:27:36'),
(748, 93, 'App\\Models\\Messages', 'delete', 2, '2022-08-25 16:29:13', '2022-08-25 16:29:13'),
(749, 93, 'App\\Models\\Messages', 'delete', 1, '2022-08-25 16:30:27', '2022-08-25 16:30:27'),
(750, 93, 'App\\Models\\Messages', 'create', 5, '2022-08-25 16:30:49', '2022-08-25 16:30:49'),
(751, 93, 'App\\Models\\Messages', 'create', 6, '2022-08-25 16:31:24', '2022-08-25 16:31:24'),
(752, 93, 'App\\Models\\Messages', 'create', 7, '2022-08-25 16:31:50', '2022-08-25 16:31:50'),
(753, 93, 'App\\Models\\Messages', 'create', 8, '2022-08-25 16:38:16', '2022-08-25 16:38:16'),
(754, 93, 'App\\Models\\Messages', 'create', 9, '2022-08-25 16:41:28', '2022-08-25 16:41:28'),
(755, 93, 'App\\Models\\Messages', 'create', 10, '2022-08-25 16:46:08', '2022-08-25 16:46:08'),
(756, 93, 'App\\Models\\Messages', 'create', 11, '2022-08-25 16:46:18', '2022-08-25 16:46:18'),
(757, 93, 'App\\Models\\Messages', 'create', 12, '2022-08-25 16:46:37', '2022-08-25 16:46:37'),
(758, 93, 'App\\Models\\Messages', 'create', 13, '2022-08-25 16:49:59', '2022-08-25 16:49:59'),
(759, 93, 'App\\Models\\Messages', 'create', 14, '2022-08-25 16:50:19', '2022-08-25 16:50:19'),
(760, 93, 'App\\Models\\Messages', 'create', 15, '2022-08-25 16:51:07', '2022-08-25 16:51:07'),
(761, 93, 'App\\Models\\Messages', 'create', 16, '2022-08-25 16:51:17', '2022-08-25 16:51:17'),
(762, 93, 'App\\Models\\Messages', 'create', 17, '2022-08-25 16:56:21', '2022-08-25 16:56:21'),
(763, 93, 'App\\Models\\Messages', 'create', 18, '2022-08-25 16:57:41', '2022-08-25 16:57:41'),
(764, 93, 'App\\Models\\Messages', 'create', 19, '2022-08-25 16:58:11', '2022-08-25 16:58:11'),
(765, 93, 'App\\Models\\Messages', 'create', 20, '2022-08-25 17:00:09', '2022-08-25 17:00:09'),
(766, 93, 'App\\Models\\Messages', 'create', 21, '2022-08-25 17:00:23', '2022-08-25 17:00:23'),
(767, 93, 'App\\Models\\Messages', 'create', 22, '2022-08-25 17:01:24', '2022-08-25 17:01:24'),
(768, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-08-25 17:10:38', '2022-08-25 17:10:38'),
(769, 93, 'App\\Models\\Anoucement', 'update', 1, '2022-08-25 17:11:14', '2022-08-25 17:11:14'),
(770, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-08-25 17:11:14', '2022-08-25 17:11:14'),
(771, 93, 'App\\Models\\Messages', 'create', 23, '2022-08-25 19:25:13', '2022-08-25 19:25:13'),
(772, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-28 15:19:24', '2022-08-28 15:19:24'),
(773, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-28 15:32:14', '2022-08-28 15:32:14'),
(774, 93, 'App\\Models\\Item', 'dealOfWeekStatus', 4, '2022-08-28 15:34:03', '2022-08-28 15:34:03'),
(775, 93, 'App\\Models\\Item', 'dealOfWeekStatus', 3, '2022-08-28 15:34:06', '2022-08-28 15:34:06'),
(776, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-28 15:40:20', '2022-08-28 15:40:20'),
(777, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-08-28 15:40:37', '2022-08-28 15:40:37'),
(778, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-08-28 16:19:25', '2022-08-28 16:19:25'),
(779, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 16:19:51', '2022-08-28 16:19:51'),
(780, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 16:20:50', '2022-08-28 16:20:50'),
(781, 93, 'App\\Models\\Category', 'view', 0, '2022-08-28 16:21:42', '2022-08-28 16:21:42'),
(782, 93, 'App\\Models\\Item', 'view', 0, '2022-08-28 16:21:44', '2022-08-28 16:21:44'),
(783, 93, 'App\\Models\\Extra', 'view', 0, '2022-08-28 16:21:46', '2022-08-28 16:21:46'),
(784, 93, 'App\\Models\\Without', 'view', 0, '2022-08-28 16:21:49', '2022-08-28 16:21:49'),
(785, 93, 'App\\Models\\Banner', 'view', 0, '2022-08-28 16:21:55', '2022-08-28 16:21:55'),
(786, 93, 'App\\Models\\Media', 'view', 0, '2022-08-28 16:22:04', '2022-08-28 16:22:04'),
(787, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-28 16:22:06', '2022-08-28 16:22:06'),
(788, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 16:24:01', '2022-08-28 16:24:01'),
(789, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-28 16:55:04', '2022-08-28 16:55:04'),
(790, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-28 17:09:30', '2022-08-28 17:09:30'),
(791, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:09:35', '2022-08-28 17:09:35'),
(792, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:16:39', '2022-08-28 17:16:39'),
(793, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:16:43', '2022-08-28 17:16:43'),
(794, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:16:48', '2022-08-28 17:16:48'),
(795, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:19:03', '2022-08-28 17:19:03'),
(796, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:19:18', '2022-08-28 17:19:18'),
(797, 93, 'App\\Models\\Contact', 'show', 0, '2022-08-28 17:19:22', '2022-08-28 17:19:22'),
(798, 93, 'App\\Models\\Contact', 'show', 0, '2022-08-28 17:20:54', '2022-08-28 17:20:54'),
(799, 93, 'App\\Models\\Contact', 'show', 0, '2022-08-28 17:21:08', '2022-08-28 17:21:08'),
(800, 93, 'App\\Models\\Contact', 'show', 0, '2022-08-28 17:24:03', '2022-08-28 17:24:03'),
(801, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:28:13', '2022-08-28 17:28:13'),
(802, 93, 'App\\Models\\Contact', 'show', 0, '2022-08-28 17:32:34', '2022-08-28 17:32:34'),
(803, 93, 'App\\Models\\Contact', 'show', 0, '2022-08-28 17:33:02', '2022-08-28 17:33:02'),
(804, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-28 17:33:18', '2022-08-28 17:33:18'),
(805, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-28 22:12:56', '2022-08-28 22:12:56'),
(806, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-28 22:13:01', '2022-08-28 22:13:01'),
(807, 93, 'App\\Models\\Offer', 'updete', 11, '2022-08-28 22:13:30', '2022-08-28 22:13:30'),
(808, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-08-28 22:13:30', '2022-08-28 22:13:30'),
(809, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-28 22:13:30', '2022-08-28 22:13:30'),
(810, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-28 22:14:28', '2022-08-28 22:14:28'),
(811, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-29 18:14:09', '2022-08-29 18:14:09'),
(812, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-29 18:14:15', '2022-08-29 18:14:15'),
(813, 93, 'App\\Models\\User', 'view', 0, '2022-08-29 19:21:23', '2022-08-29 19:21:23'),
(814, 93, 'App\\Models\\User', 'update', 161, '2022-08-29 19:21:37', '2022-08-29 19:21:37'),
(815, 93, 'App\\Models\\User', 'view', 0, '2022-08-29 19:21:37', '2022-08-29 19:21:37'),
(816, 93, 'App\\Models\\User', 'view', 0, '2022-08-29 20:16:15', '2022-08-29 20:16:15'),
(817, 93, 'App\\Models\\Gift', 'view', 0, '2022-08-29 20:16:19', '2022-08-29 20:16:19'),
(818, 93, 'App\\Models\\Gift', 'create', 1, '2022-08-29 20:17:14', '2022-08-29 20:17:14'),
(819, 93, 'App\\Models\\Gift', 'view', 0, '2022-08-29 20:17:14', '2022-08-29 20:17:14'),
(820, 93, 'App\\Models\\Gift', 'view', 0, '2022-08-29 20:17:21', '2022-08-29 20:17:21'),
(821, 93, 'App\\Models\\Gift', 'view', 0, '2022-08-29 20:17:26', '2022-08-29 20:17:26'),
(822, 93, 'App\\Models\\General', 'update', 8, '2022-08-29 20:37:05', '2022-08-29 20:37:05'),
(823, 93, 'App\\Models\\Gift', 'view', 0, '2022-08-29 20:59:47', '2022-08-29 20:59:47'),
(824, 93, 'App\\Models\\Gift', 'view', 0, '2022-08-29 20:59:58', '2022-08-29 20:59:58'),
(825, 93, 'App\\Models\\Order', 'view', 0, '2022-08-29 21:00:08', '2022-08-29 21:00:08'),
(826, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 22:48:09', '2022-08-29 22:48:09'),
(827, 93, 'App\\Models\\News', 'view', 0, '2022-08-29 22:53:36', '2022-08-29 22:53:36'),
(828, 93, 'App\\Models\\News', 'delete', 4, '2022-08-29 22:53:57', '2022-08-29 22:53:57'),
(829, 93, 'App\\Models\\News', 'view', 0, '2022-08-29 22:53:57', '2022-08-29 22:53:57'),
(830, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:54:02', '2022-08-29 22:54:02'),
(831, 93, 'App\\Models\\HealthInfo', 'update', 13, '2022-08-29 22:55:15', '2022-08-29 22:55:15'),
(832, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:55:15', '2022-08-29 22:55:15'),
(833, 93, 'App\\Models\\HealthInfo', 'update', 14, '2022-08-29 22:55:42', '2022-08-29 22:55:42'),
(834, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:55:43', '2022-08-29 22:55:43'),
(835, 93, 'App\\Models\\HealthInfo', 'update', 15, '2022-08-29 22:56:11', '2022-08-29 22:56:11'),
(836, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:56:11', '2022-08-29 22:56:11'),
(837, 93, 'App\\Models\\HealthInfo', 'update', 16, '2022-08-29 22:56:36', '2022-08-29 22:56:36'),
(838, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:56:36', '2022-08-29 22:56:36'),
(839, 93, 'App\\Models\\HealthInfo', 'create', 17, '2022-08-29 22:58:13', '2022-08-29 22:58:13'),
(840, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:58:13', '2022-08-29 22:58:13'),
(841, 93, 'App\\Models\\HealthInfo', 'create', 18, '2022-08-29 22:58:52', '2022-08-29 22:58:52'),
(842, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:58:53', '2022-08-29 22:58:53'),
(843, 93, 'App\\Models\\HealthInfo', 'create', 19, '2022-08-29 22:59:33', '2022-08-29 22:59:33'),
(844, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 22:59:34', '2022-08-29 22:59:34'),
(845, 93, 'App\\Models\\News', 'view', 0, '2022-08-29 22:59:40', '2022-08-29 22:59:40'),
(846, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 23:01:22', '2022-08-29 23:01:22'),
(847, 93, 'App\\Models\\AboutUS', 'update', 28, '2022-08-29 23:03:15', '2022-08-29 23:03:15'),
(848, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 23:03:16', '2022-08-29 23:03:16'),
(849, 93, 'App\\Models\\AboutUS', 'update', 29, '2022-08-29 23:04:02', '2022-08-29 23:04:02'),
(850, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 23:04:02', '2022-08-29 23:04:02'),
(851, 93, 'App\\Models\\AboutUS', 'update', 35, '2022-08-29 23:06:28', '2022-08-29 23:06:28'),
(852, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 23:06:29', '2022-08-29 23:06:29'),
(853, 93, 'App\\Models\\AboutUS', 'update', 34, '2022-08-29 23:07:03', '2022-08-29 23:07:03'),
(854, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 23:07:03', '2022-08-29 23:07:03'),
(855, 93, 'App\\Models\\AboutUS', 'update', 36, '2022-08-29 23:07:50', '2022-08-29 23:07:50'),
(856, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 23:07:50', '2022-08-29 23:07:50'),
(857, 93, 'App\\Models\\AboutUS', 'create', 37, '2022-08-29 23:09:28', '2022-08-29 23:09:28'),
(858, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-08-29 23:09:28', '2022-08-29 23:09:28'),
(859, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 23:11:42', '2022-08-29 23:11:42'),
(860, 93, 'App\\Models\\HealthInfo', 'update', 16, '2022-08-29 23:14:59', '2022-08-29 23:14:59'),
(861, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-08-29 23:14:59', '2022-08-29 23:14:59'),
(862, 93, 'App\\Models\\Contact', 'view', 0, '2022-08-29 23:16:48', '2022-08-29 23:16:48'),
(863, 93, 'App\\Models\\Branch', 'view', 0, '2022-08-29 23:19:26', '2022-08-29 23:19:26'),
(864, 93, 'App\\Models\\Branch', 'delete', 26, '2022-08-29 23:20:41', '2022-08-29 23:20:41'),
(865, 93, 'App\\Models\\Branch', 'view', 0, '2022-08-29 23:20:41', '2022-08-29 23:20:41'),
(866, 93, 'App\\Models\\Category', 'view', 0, '2022-08-29 23:21:57', '2022-08-29 23:21:57'),
(867, 93, 'App\\Models\\Category', 'view', 0, '2022-08-29 23:54:15', '2022-08-29 23:54:15'),
(868, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:13:02', '2022-08-30 00:13:02'),
(869, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:18:26', '2022-08-30 00:18:26'),
(870, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:20:21', '2022-08-30 00:20:21'),
(871, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:26:10', '2022-08-30 00:26:10'),
(872, 93, 'App\\Models\\Category', 'update', 12, '2022-08-30 00:26:22', '2022-08-30 00:26:22'),
(873, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:26:22', '2022-08-30 00:26:22'),
(874, 93, 'App\\Models\\Category', 'update', 11, '2022-08-30 00:26:32', '2022-08-30 00:26:32'),
(875, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:26:33', '2022-08-30 00:26:33'),
(876, 93, 'App\\Models\\Category', 'create', 18, '2022-08-30 00:31:08', '2022-08-30 00:31:08'),
(877, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:31:09', '2022-08-30 00:31:09'),
(878, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:38:04', '2022-08-30 00:38:04'),
(879, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 00:47:42', '2022-08-30 00:47:42'),
(880, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-30 16:08:10', '2022-08-30 16:08:10'),
(881, 93, 'App\\Models\\User', 'view', 0, '2022-08-30 16:08:28', '2022-08-30 16:08:28'),
(882, 93, 'App\\Models\\User', 'create', 241, '2022-08-30 16:09:21', '2022-08-30 16:09:21'),
(883, 93, 'App\\Models\\User', 'view', 0, '2022-08-30 16:09:22', '2022-08-30 16:09:22'),
(884, 93, 'App\\Models\\Category', 'view', 0, '2022-08-30 16:26:32', '2022-08-30 16:26:32'),
(885, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:26:38', '2022-08-30 16:26:38'),
(886, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:31:58', '2022-08-30 16:31:58'),
(887, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:32:10', '2022-08-30 16:32:10'),
(888, 93, 'App\\Models\\Item', 'update', 107, '2022-08-30 16:32:19', '2022-08-30 16:32:19'),
(889, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:32:19', '2022-08-30 16:32:19'),
(890, 93, 'App\\Models\\Item', 'update', 106, '2022-08-30 16:32:29', '2022-08-30 16:32:29'),
(891, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:32:29', '2022-08-30 16:32:29'),
(892, 93, 'App\\Models\\Item', 'update', 105, '2022-08-30 16:32:38', '2022-08-30 16:32:38'),
(893, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:32:38', '2022-08-30 16:32:38'),
(894, 93, 'App\\Models\\Item', 'update', 104, '2022-08-30 16:32:48', '2022-08-30 16:32:48'),
(895, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:32:48', '2022-08-30 16:32:48'),
(896, 93, 'App\\Models\\Item', 'update', 103, '2022-08-30 16:32:59', '2022-08-30 16:32:59'),
(897, 93, 'App\\Models\\Item', 'view', 0, '2022-08-30 16:32:59', '2022-08-30 16:32:59'),
(898, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-30 17:52:29', '2022-08-30 17:52:29'),
(899, 93, 'App\\Models\\General', 'update', 8, '2022-08-30 17:52:47', '2022-08-30 17:52:47'),
(900, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-31 17:54:40', '2022-08-31 17:54:40'),
(901, 93, 'App\\Models\\Messages', 'create', 1, '2022-08-31 17:55:05', '2022-08-31 17:55:05'),
(902, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-31 18:26:31', '2022-08-31 18:26:31'),
(903, 93, 'App\\Models\\Messages', 'create', 2, '2022-08-31 18:26:45', '2022-08-31 18:26:45'),
(904, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-31 20:04:30', '2022-08-31 20:04:30'),
(905, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 20:04:32', '2022-08-31 20:04:32'),
(906, 93, 'App\\Models\\Offer', 'create', 15, '2022-08-31 20:06:19', '2022-08-31 20:06:19'),
(907, 93, 'App\\Models\\OfferBuyGet', 'create', 12, '2022-08-31 20:06:19', '2022-08-31 20:06:19'),
(908, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 20:06:24', '2022-08-31 20:06:24'),
(909, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 21:00:00', '2022-08-31 21:00:00'),
(910, 93, 'App\\Models\\Offer', 'create', 16, '2022-08-31 21:01:17', '2022-08-31 21:01:17'),
(911, 93, 'App\\Models\\OfferBuyGet', 'create', 13, '2022-08-31 21:01:17', '2022-08-31 21:01:17'),
(912, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 21:01:29', '2022-08-31 21:01:29'),
(913, 93, 'App\\Models\\dashboard', 'view', 0, '2022-08-31 23:28:36', '2022-08-31 23:28:36'),
(914, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 23:28:47', '2022-08-31 23:28:47'),
(915, 93, 'App\\Models\\Offer', 'updete', 15, '2022-08-31 23:30:18', '2022-08-31 23:30:18'),
(916, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-08-31 23:30:18', '2022-08-31 23:30:18'),
(917, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 23:30:18', '2022-08-31 23:30:18'),
(918, 93, 'App\\Models\\Offer', 'create', 16, '2022-08-31 23:31:24', '2022-08-31 23:31:24'),
(919, 93, 'App\\Models\\OfferBuyGet', 'create', 15, '2022-08-31 23:31:24', '2022-08-31 23:31:24'),
(920, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 23:31:29', '2022-08-31 23:31:29'),
(921, 93, 'App\\Models\\Item', 'view', 0, '2022-08-31 23:33:33', '2022-08-31 23:33:33'),
(922, 93, 'App\\Models\\Category', 'view', 0, '2022-08-31 23:33:49', '2022-08-31 23:33:49'),
(923, 93, 'App\\Models\\Item', 'view', 0, '2022-08-31 23:34:05', '2022-08-31 23:34:05'),
(924, 93, 'App\\Models\\Item', 'view', 0, '2022-08-31 23:34:39', '2022-08-31 23:34:39'),
(925, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 23:34:58', '2022-08-31 23:34:58'),
(926, 93, 'App\\Models\\Offer', 'updete', 16, '2022-08-31 23:35:56', '2022-08-31 23:35:56'),
(927, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-08-31 23:35:56', '2022-08-31 23:35:56'),
(928, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 23:35:56', '2022-08-31 23:35:56'),
(929, 93, 'App\\Models\\Offer', 'updete', 16, '2022-08-31 23:37:55', '2022-08-31 23:37:55'),
(930, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-08-31 23:37:55', '2022-08-31 23:37:55'),
(931, 93, 'App\\Models\\Offer', 'view', 0, '2022-08-31 23:37:55', '2022-08-31 23:37:55'),
(932, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-08-31 23:53:11', '2022-08-31 23:53:11'),
(933, 93, 'App\\Models\\Anoucement', 'update', 1, '2022-08-31 23:53:42', '2022-08-31 23:53:42'),
(934, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-08-31 23:53:42', '2022-08-31 23:53:42'),
(935, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 15:57:25', '2022-09-01 15:57:25'),
(936, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 15:58:18', '2022-09-01 15:58:18'),
(937, 93, 'App\\Models\\Order', 'view', 0, '2022-09-01 15:58:29', '2022-09-01 15:58:29'),
(938, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-01 15:58:39', '2022-09-01 15:58:39'),
(939, 93, 'App\\Models\\Category', 'view', 0, '2022-09-01 15:58:46', '2022-09-01 15:58:46'),
(940, 93, 'App\\Models\\User', 'view', 0, '2022-09-01 15:58:54', '2022-09-01 15:58:54'),
(941, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 17:48:13', '2022-09-01 17:48:13'),
(942, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 17:48:24', '2022-09-01 17:48:24'),
(943, 93, 'App\\Models\\User', 'view', 0, '2022-09-01 18:28:10', '2022-09-01 18:28:10'),
(944, 93, 'App\\Models\\Category', 'view', 0, '2022-09-01 18:28:25', '2022-09-01 18:28:25'),
(945, 93, 'App\\Models\\Item', 'view', 0, '2022-09-01 18:28:34', '2022-09-01 18:28:34'),
(946, 93, 'App\\Models\\Extra', 'view', 0, '2022-09-01 18:29:03', '2022-09-01 18:29:03'),
(947, 93, 'App\\Models\\Without', 'view', 0, '2022-09-01 18:29:12', '2022-09-01 18:29:12'),
(948, 93, 'App\\Models\\Order', 'view', 0, '2022-09-01 18:30:03', '2022-09-01 18:30:03'),
(949, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-09-01 18:30:39', '2022-09-01 18:30:39'),
(950, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-09-01 18:30:59', '2022-09-01 18:30:59'),
(951, 93, 'App\\Models\\Gallery', 'view', 0, '2022-09-01 18:31:37', '2022-09-01 18:31:37'),
(952, 93, 'App\\Models\\Media', 'view', 0, '2022-09-01 18:31:54', '2022-09-01 18:31:54'),
(953, 93, 'App\\Models\\Careers', 'view', 0, '2022-09-01 18:32:10', '2022-09-01 18:32:10'),
(954, 93, 'App\\Models\\News', 'view', 0, '2022-09-01 18:32:30', '2022-09-01 18:32:30'),
(955, 93, 'App\\Models\\News', 'view', 0, '2022-09-01 18:32:39', '2022-09-01 18:32:39'),
(956, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-09-01 18:32:42', '2022-09-01 18:32:42'),
(957, 93, 'App\\Models\\HealthInfo', 'view', 0, '2022-09-01 18:32:58', '2022-09-01 18:32:58'),
(958, 93, 'App\\Models\\Contact', 'view', 0, '2022-09-01 18:33:04', '2022-09-01 18:33:04'),
(959, 93, 'App\\Models\\Banner', 'view', 0, '2022-09-01 18:33:17', '2022-09-01 18:33:17'),
(960, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-01 18:33:41', '2022-09-01 18:33:41'),
(961, 93, 'App\\Models\\User', 'report', 0, '2022-09-01 18:33:51', '2022-09-01 18:33:51'),
(962, 93, 'App\\Models\\User', 'view', 0, '2022-09-01 18:34:54', '2022-09-01 18:34:54'),
(963, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 18:47:53', '2022-09-01 18:47:53'),
(964, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-01 18:48:00', '2022-09-01 18:48:00'),
(965, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 18:48:57', '2022-09-01 18:48:57'),
(966, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 20:47:10', '2022-09-01 20:47:10'),
(967, 93, 'App\\Models\\User', 'view', 0, '2022-09-01 20:47:15', '2022-09-01 20:47:15'),
(968, 93, 'App\\Models\\User', 'update', 204, '2022-09-01 20:47:38', '2022-09-01 20:47:38'),
(969, 93, 'App\\Models\\User', 'view', 0, '2022-09-01 20:47:39', '2022-09-01 20:47:39'),
(970, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-01 22:48:55', '2022-09-01 22:48:55'),
(971, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-01 23:40:22', '2022-09-01 23:40:22'),
(972, 93, 'App\\Models\\User', 'view', 0, '2022-09-01 23:57:15', '2022-09-01 23:57:15'),
(973, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-01 23:57:37', '2022-09-01 23:57:37'),
(974, 93, 'App\\Models\\Branch', 'update', 27, '2022-09-02 00:00:45', '2022-09-02 00:00:45'),
(975, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-02 00:00:45', '2022-09-02 00:00:45'),
(976, 93, 'App\\Models\\Branch', 'update', 27, '2022-09-02 00:02:39', '2022-09-02 00:02:39'),
(977, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-02 00:02:40', '2022-09-02 00:02:40'),
(978, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-02 18:24:54', '2022-09-02 18:24:54'),
(979, 93, 'App\\Models\\Item', 'view', 0, '2022-09-02 18:26:33', '2022-09-02 18:26:33'),
(980, 93, 'App\\Models\\Item', 'view', 0, '2022-09-02 18:27:10', '2022-09-02 18:27:10'),
(981, 93, 'App\\Models\\Item', 'view', 0, '2022-09-02 18:27:30', '2022-09-02 18:27:30'),
(982, 93, 'App\\Models\\Item', 'view', 0, '2022-09-02 18:28:23', '2022-09-02 18:28:23'),
(983, 93, 'App\\Models\\Item', 'view', 0, '2022-09-02 18:31:01', '2022-09-02 18:31:01'),
(984, 93, 'App\\Models\\Item', 'view', 0, '2022-09-02 18:32:10', '2022-09-02 18:32:10'),
(985, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-04 15:50:37', '2022-09-04 15:50:37'),
(986, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-04 15:51:11', '2022-09-04 15:51:11'),
(987, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-04 17:41:44', '2022-09-04 17:41:44'),
(988, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-04 17:42:32', '2022-09-04 17:42:32'),
(989, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-09-04 17:43:19', '2022-09-04 17:43:19'),
(990, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-09-04 17:43:23', '2022-09-04 17:43:23'),
(991, 93, 'App\\Models\\Gallery', 'view', 0, '2022-09-04 17:43:30', '2022-09-04 17:43:30'),
(992, 93, 'App\\Models\\Media', 'view', 0, '2022-09-04 17:43:38', '2022-09-04 17:43:38'),
(993, 93, 'App\\Models\\Careers', 'view', 0, '2022-09-04 17:43:45', '2022-09-04 17:43:45'),
(994, 93, 'App\\Models\\News', 'view', 0, '2022-09-04 17:43:47', '2022-09-04 17:43:47'),
(995, 93, 'App\\Models\\homeitem', 'update', 1, '2022-09-04 18:02:03', '2022-09-04 18:02:03'),
(996, 93, 'App\\Models\\homeitem', 'update', 1, '2022-09-04 18:07:40', '2022-09-04 18:07:40'),
(997, 93, 'App\\Models\\homeitem', 'update', 2, '2022-09-04 18:08:30', '2022-09-04 18:08:30'),
(998, 93, 'App\\Models\\homeitem', 'update', 3, '2022-09-04 18:09:39', '2022-09-04 18:09:39'),
(999, 93, 'App\\Models\\homeitem', 'update', 4, '2022-09-04 18:11:47', '2022-09-04 18:11:47'),
(1000, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-04 18:13:22', '2022-09-04 18:13:22'),
(1001, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-04 18:13:24', '2022-09-04 18:13:24'),
(1002, 93, 'App\\Models\\Banner', 'view', 0, '2022-09-04 18:13:56', '2022-09-04 18:13:56'),
(1003, 93, 'App\\Models\\Order', 'view', 0, '2022-09-04 18:14:05', '2022-09-04 18:14:05'),
(1004, 93, 'App\\Models\\News', 'view', 0, '2022-09-04 18:14:13', '2022-09-04 18:14:13'),
(1005, 93, 'App\\Models\\Careers', 'view', 0, '2022-09-04 18:14:19', '2022-09-04 18:14:19'),
(1006, 93, 'App\\Models\\Media', 'view', 0, '2022-09-04 18:14:21', '2022-09-04 18:14:21'),
(1007, 93, 'App\\Models\\Gallery', 'view', 0, '2022-09-04 18:14:25', '2022-09-04 18:14:25'),
(1008, 93, 'App\\Models\\AboutUS', 'view', 0, '2022-09-04 18:14:29', '2022-09-04 18:14:29'),
(1009, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-04 23:37:17', '2022-09-04 23:37:17'),
(1010, 93, 'App\\Models\\Media', 'view', 0, '2022-09-04 23:37:31', '2022-09-04 23:37:31'),
(1011, 93, 'App\\Models\\Media', 'view', 0, '2022-09-04 23:37:36', '2022-09-04 23:37:36'),
(1012, 93, 'App\\Models\\Media', 'view', 0, '2022-09-04 23:37:41', '2022-09-04 23:37:41'),
(1013, 93, 'App\\Models\\Payment', 'report', 0, '2022-09-04 23:40:10', '2022-09-04 23:40:10'),
(1014, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 00:35:28', '2022-09-05 00:35:28'),
(1015, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 00:35:37', '2022-09-05 00:35:37'),
(1016, 93, 'App\\Models\\Item', 'update', 111, '2022-09-05 00:46:35', '2022-09-05 00:46:35'),
(1017, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 00:46:36', '2022-09-05 00:46:36'),
(1018, 93, 'App\\Models\\Item', 'update', 110, '2022-09-05 00:47:27', '2022-09-05 00:47:27'),
(1019, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 00:47:28', '2022-09-05 00:47:28'),
(1020, 93, 'App\\Models\\Item', 'update', 109, '2022-09-05 00:47:39', '2022-09-05 00:47:39'),
(1021, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 00:47:39', '2022-09-05 00:47:39'),
(1022, 93, 'App\\Models\\Item', 'update', 108, '2022-09-05 00:48:20', '2022-09-05 00:48:20'),
(1023, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 00:48:21', '2022-09-05 00:48:21'),
(1024, 93, 'App\\Models\\Item', 'delete', 113, '2022-09-05 00:51:13', '2022-09-05 00:51:13'),
(1025, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 00:51:14', '2022-09-05 00:51:14'),
(1026, 93, 'App\\Models\\Item', 'delete', 112, '2022-09-05 00:51:20', '2022-09-05 00:51:20'),
(1027, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 00:51:21', '2022-09-05 00:51:21'),
(1028, 93, 'App\\Models\\Category', 'view', 0, '2022-09-05 01:01:31', '2022-09-05 01:01:31'),
(1029, 93, 'App\\Models\\Category', 'delete', 1, '2022-09-05 01:01:38', '2022-09-05 01:01:38'),
(1030, 93, 'App\\Models\\Category', 'view', 0, '2022-09-05 01:01:38', '2022-09-05 01:01:38'),
(1031, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 01:01:44', '2022-09-05 01:01:44'),
(1032, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 01:09:27', '2022-09-05 01:09:27'),
(1033, 93, 'App\\Models\\Branch', 'update', 27, '2022-09-05 01:10:14', '2022-09-05 01:10:14'),
(1034, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 01:10:14', '2022-09-05 01:10:14'),
(1035, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 01:15:33', '2022-09-05 01:15:33'),
(1036, 93, 'App\\Models\\Category', 'view', 0, '2022-09-05 01:17:56', '2022-09-05 01:17:56'),
(1037, 93, 'App\\Models\\Category', 'view', 0, '2022-09-05 01:21:35', '2022-09-05 01:21:35'),
(1038, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 01:31:24', '2022-09-05 01:31:24'),
(1039, 93, 'App\\Models\\Item', 'view', 0, '2022-09-05 01:43:16', '2022-09-05 01:43:16'),
(1040, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 01:43:19', '2022-09-05 01:43:19'),
(1041, 93, 'App\\Models\\Branch', 'update', 27, '2022-09-05 02:00:00', '2022-09-05 02:00:00'),
(1042, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 02:00:00', '2022-09-05 02:00:00'),
(1043, 93, 'App\\Models\\Branch', 'update', 16, '2022-09-05 02:05:25', '2022-09-05 02:05:25'),
(1044, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 02:05:25', '2022-09-05 02:05:25'),
(1045, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 15:23:46', '2022-09-05 15:23:46'),
(1046, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:24:00', '2022-09-05 15:24:00'),
(1047, 93, 'App\\Models\\Branch', 'update', 27, '2022-09-05 15:29:48', '2022-09-05 15:29:48'),
(1048, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:29:48', '2022-09-05 15:29:48'),
(1049, 93, 'App\\Models\\Branch', 'update', 16, '2022-09-05 15:32:42', '2022-09-05 15:32:42'),
(1050, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:32:42', '2022-09-05 15:32:42'),
(1051, 93, 'App\\Models\\Branch', 'update', 17, '2022-09-05 15:33:45', '2022-09-05 15:33:45'),
(1052, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:33:45', '2022-09-05 15:33:45'),
(1053, 93, 'App\\Models\\Branch', 'update', 18, '2022-09-05 15:34:42', '2022-09-05 15:34:42'),
(1054, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:34:43', '2022-09-05 15:34:43'),
(1055, 93, 'App\\Models\\Branch', 'update', 19, '2022-09-05 15:35:45', '2022-09-05 15:35:45'),
(1056, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:35:46', '2022-09-05 15:35:46'),
(1057, 93, 'App\\Models\\Branch', 'update', 20, '2022-09-05 15:36:48', '2022-09-05 15:36:48'),
(1058, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:36:49', '2022-09-05 15:36:49'),
(1059, 93, 'App\\Models\\Branch', 'create', 28, '2022-09-05 15:58:52', '2022-09-05 15:58:52'),
(1060, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 15:58:53', '2022-09-05 15:58:53'),
(1061, 93, 'App\\Models\\Branch', 'update', 28, '2022-09-05 16:00:00', '2022-09-05 16:00:00'),
(1062, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 16:00:01', '2022-09-05 16:00:01'),
(1063, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 16:00:15', '2022-09-05 16:00:15'),
(1064, 93, 'App\\Models\\Branch', 'create', 29, '2022-09-05 16:17:20', '2022-09-05 16:17:20'),
(1065, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 16:17:20', '2022-09-05 16:17:20'),
(1066, 93, 'App\\Models\\Branch', 'update', 29, '2022-09-05 16:28:09', '2022-09-05 16:28:09'),
(1067, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 16:28:09', '2022-09-05 16:28:09'),
(1068, 93, 'App\\Models\\Branch', 'update', 29, '2022-09-05 16:30:11', '2022-09-05 16:30:11'),
(1069, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 16:30:12', '2022-09-05 16:30:12'),
(1070, 93, 'App\\Models\\Branch', 'update', 28, '2022-09-05 16:36:51', '2022-09-05 16:36:51'),
(1071, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 16:36:52', '2022-09-05 16:36:52'),
(1072, 93, 'App\\Models\\Extra', 'view', 0, '2022-09-05 18:32:38', '2022-09-05 18:32:38'),
(1073, 93, 'App\\Models\\Without', 'view', 0, '2022-09-05 18:32:41', '2022-09-05 18:32:41'),
(1074, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 18:33:00', '2022-09-05 18:33:00'),
(1075, 93, 'App\\Models\\Extra', 'view', 0, '2022-09-05 18:33:06', '2022-09-05 18:33:06'),
(1076, 93, 'App\\Models\\Extra', 'view', 0, '2022-09-05 18:33:42', '2022-09-05 18:33:42'),
(1077, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 21:08:58', '2022-09-05 21:08:58'),
(1078, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:09:02', '2022-09-05 21:09:02'),
(1079, 93, 'App\\Models\\Branch', 'update', 27, '2022-09-05 21:09:12', '2022-09-05 21:09:12'),
(1080, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:09:13', '2022-09-05 21:09:13'),
(1081, 93, 'App\\Models\\Branch', 'update', 16, '2022-09-05 21:09:29', '2022-09-05 21:09:29'),
(1082, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:09:30', '2022-09-05 21:09:30'),
(1083, 93, 'App\\Models\\Branch', 'update', 17, '2022-09-05 21:09:46', '2022-09-05 21:09:46'),
(1084, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:09:47', '2022-09-05 21:09:47'),
(1085, 93, 'App\\Models\\Branch', 'update', 18, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(1086, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:09:56', '2022-09-05 21:09:56'),
(1087, 93, 'App\\Models\\Branch', 'update', 19, '2022-09-05 21:10:04', '2022-09-05 21:10:04'),
(1088, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:10:05', '2022-09-05 21:10:05'),
(1089, 93, 'App\\Models\\Branch', 'update', 20, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(1090, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:10:15', '2022-09-05 21:10:15'),
(1091, 93, 'App\\Models\\Branch', 'update', 28, '2022-09-05 21:10:23', '2022-09-05 21:10:23'),
(1092, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:10:24', '2022-09-05 21:10:24'),
(1093, 93, 'App\\Models\\Branch', 'update', 29, '2022-09-05 21:10:44', '2022-09-05 21:10:44'),
(1094, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:10:44', '2022-09-05 21:10:44'),
(1095, 93, 'App\\Models\\Branch', 'update', 29, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(1096, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 21:11:03', '2022-09-05 21:11:03'),
(1097, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 22:31:08', '2022-09-05 22:31:08'),
(1098, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 22:31:22', '2022-09-05 22:31:22'),
(1099, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:31:25', '2022-09-05 22:31:25'),
(1100, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:32:42', '2022-09-05 22:32:42'),
(1101, 93, 'App\\Models\\Offer', 'create', 17, '2022-09-05 22:36:07', '2022-09-05 22:36:07'),
(1102, 93, 'App\\Models\\OfferDiscount', 'create', 6, '2022-09-05 22:36:07', '2022-09-05 22:36:07'),
(1103, 93, 'App\\Models\\Offer', 'create', 18, '2022-09-05 22:36:16', '2022-09-05 22:36:16'),
(1104, 93, 'App\\Models\\OfferDiscount', 'create', 7, '2022-09-05 22:36:16', '2022-09-05 22:36:16'),
(1105, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:36:20', '2022-09-05 22:36:20'),
(1106, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 22:38:45', '2022-09-05 22:38:45'),
(1107, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 22:38:56', '2022-09-05 22:38:56'),
(1108, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 22:38:58', '2022-09-05 22:38:58'),
(1109, 93, 'App\\Models\\Branch', 'delete', 28, '2022-09-05 22:39:12', '2022-09-05 22:39:12'),
(1110, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 22:39:13', '2022-09-05 22:39:13'),
(1111, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:39:15', '2022-09-05 22:39:15'),
(1112, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:39:41', '2022-09-05 22:39:41'),
(1113, 93, 'App\\Models\\Offer', 'create', 19, '2022-09-05 22:43:30', '2022-09-05 22:43:30'),
(1114, 93, 'App\\Models\\OfferBuyGet', 'create', 17, '2022-09-05 22:43:30', '2022-09-05 22:43:30'),
(1115, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:43:34', '2022-09-05 22:43:34'),
(1116, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 22:46:14', '2022-09-05 22:46:14'),
(1117, 93, 'App\\Models\\Branch', 'update', 16, '2022-09-05 22:47:14', '2022-09-05 22:47:14'),
(1118, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 22:47:14', '2022-09-05 22:47:14'),
(1119, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 22:47:30', '2022-09-05 22:47:30'),
(1120, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 22:47:32', '2022-09-05 22:47:32'),
(1121, 93, 'App\\Models\\Branch', 'update', 16, '2022-09-05 22:47:47', '2022-09-05 22:47:47'),
(1122, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 22:47:48', '2022-09-05 22:47:48'),
(1123, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:48:10', '2022-09-05 22:48:10'),
(1124, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:48:45', '2022-09-05 22:48:45'),
(1125, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 22:48:55', '2022-09-05 22:48:55'),
(1126, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-05 23:11:08', '2022-09-05 23:11:08'),
(1127, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-05 23:11:12', '2022-09-05 23:11:12'),
(1128, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 23:11:16', '2022-09-05 23:11:16'),
(1129, 93, 'App\\Models\\Offer', 'updete', 19, '2022-09-05 23:12:06', '2022-09-05 23:12:06'),
(1130, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-05 23:12:06', '2022-09-05 23:12:06'),
(1131, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 23:12:07', '2022-09-05 23:12:07'),
(1132, 93, 'App\\Models\\Offer', 'updete', 18, '2022-09-05 23:12:13', '2022-09-05 23:12:13'),
(1133, 93, 'App\\Models\\OfferDiscount', 'updete', 7, '2022-09-05 23:12:13', '2022-09-05 23:12:13'),
(1134, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 23:12:13', '2022-09-05 23:12:13'),
(1135, 93, 'App\\Models\\Offer', 'updete', 18, '2022-09-05 23:14:49', '2022-09-05 23:14:49'),
(1136, 93, 'App\\Models\\OfferDiscount', 'updete', 7, '2022-09-05 23:14:49', '2022-09-05 23:14:49'),
(1137, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 23:14:49', '2022-09-05 23:14:49'),
(1138, 93, 'App\\Models\\Offer', 'create', 20, '2022-09-05 23:40:13', '2022-09-05 23:40:13'),
(1139, 93, 'App\\Models\\OfferDiscount', 'create', 8, '2022-09-05 23:40:13', '2022-09-05 23:40:13'),
(1140, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 23:40:18', '2022-09-05 23:40:18'),
(1141, 93, 'App\\Models\\Offer', 'updete', 20, '2022-09-05 23:41:40', '2022-09-05 23:41:40');
INSERT INTO `log_files` (`id`, `user_id`, `model`, `action`, `action_id`, `created_at`, `updated_at`) VALUES
(1142, 93, 'App\\Models\\OfferDiscount', 'updete', 8, '2022-09-05 23:41:40', '2022-09-05 23:41:40'),
(1143, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-05 23:41:40', '2022-09-05 23:41:40'),
(1144, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-06 02:13:08', '2022-09-06 02:13:08'),
(1145, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 02:13:37', '2022-09-06 02:13:37'),
(1146, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 02:14:51', '2022-09-06 02:14:51'),
(1147, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 02:14:53', '2022-09-06 02:14:53'),
(1148, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 02:15:34', '2022-09-06 02:15:34'),
(1149, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 02:15:45', '2022-09-06 02:15:45'),
(1150, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 15:26:28', '2022-09-06 15:26:28'),
(1151, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-06 16:14:18', '2022-09-06 16:14:18'),
(1152, 93, 'App\\Models\\News', 'view', 0, '2022-09-06 16:14:29', '2022-09-06 16:14:29'),
(1153, 93, 'App\\Models\\News', 'view', 0, '2022-09-06 16:15:35', '2022-09-06 16:15:35'),
(1154, 93, 'App\\Models\\News', 'view', 0, '2022-09-06 16:29:57', '2022-09-06 16:29:57'),
(1155, 93, 'App\\Models\\News', 'update', 3, '2022-09-06 16:30:09', '2022-09-06 16:30:09'),
(1156, 93, 'App\\Models\\News', 'view', 0, '2022-09-06 16:30:09', '2022-09-06 16:30:09'),
(1157, 93, 'App\\Models\\News', 'update', 2, '2022-09-06 16:30:21', '2022-09-06 16:30:21'),
(1158, 93, 'App\\Models\\News', 'view', 0, '2022-09-06 16:30:21', '2022-09-06 16:30:21'),
(1159, 93, 'App\\Models\\News', 'update', 1, '2022-09-06 16:30:36', '2022-09-06 16:30:36'),
(1160, 93, 'App\\Models\\News', 'view', 0, '2022-09-06 16:30:36', '2022-09-06 16:30:36'),
(1161, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-06 17:21:57', '2022-09-06 17:21:57'),
(1162, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:26:47', '2022-09-06 17:26:47'),
(1163, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-06 17:44:50', '2022-09-06 17:44:50'),
(1164, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:44:53', '2022-09-06 17:44:53'),
(1165, 93, 'App\\Models\\Offer', 'create', 1, '2022-09-06 17:46:18', '2022-09-06 17:46:18'),
(1166, 93, 'App\\Models\\OfferDiscount', 'create', 9, '2022-09-06 17:46:18', '2022-09-06 17:46:18'),
(1167, 93, 'App\\Models\\Offer', 'create', 2, '2022-09-06 17:46:18', '2022-09-06 17:46:18'),
(1168, 93, 'App\\Models\\OfferDiscount', 'create', 10, '2022-09-06 17:46:18', '2022-09-06 17:46:18'),
(1169, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:46:23', '2022-09-06 17:46:23'),
(1170, 93, 'App\\Models\\Offer', 'create', 3, '2022-09-06 17:47:37', '2022-09-06 17:47:37'),
(1171, 93, 'App\\Models\\OfferBuyGet', 'create', 19, '2022-09-06 17:47:37', '2022-09-06 17:47:37'),
(1172, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:47:44', '2022-09-06 17:47:44'),
(1173, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:50:02', '2022-09-06 17:50:02'),
(1174, 93, 'App\\Models\\Offer', 'updete', 1, '2022-09-06 17:51:14', '2022-09-06 17:51:14'),
(1175, 93, 'App\\Models\\OfferDiscount', 'updete', 9, '2022-09-06 17:51:14', '2022-09-06 17:51:14'),
(1176, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:51:14', '2022-09-06 17:51:14'),
(1177, 93, 'App\\Models\\Offer', 'updete', 3, '2022-09-06 17:51:45', '2022-09-06 17:51:45'),
(1178, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-06 17:51:45', '2022-09-06 17:51:45'),
(1179, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:51:45', '2022-09-06 17:51:45'),
(1180, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:52:04', '2022-09-06 17:52:04'),
(1181, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:52:39', '2022-09-06 17:52:39'),
(1182, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:52:42', '2022-09-06 17:52:42'),
(1183, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:53:02', '2022-09-06 17:53:02'),
(1184, 93, 'App\\Models\\Offer', 'updete', 1, '2022-09-06 17:55:08', '2022-09-06 17:55:08'),
(1185, 93, 'App\\Models\\OfferDiscount', 'updete', 9, '2022-09-06 17:55:08', '2022-09-06 17:55:08'),
(1186, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:55:08', '2022-09-06 17:55:08'),
(1187, 93, 'App\\Models\\Offer', 'create', 4, '2022-09-06 17:56:57', '2022-09-06 17:56:57'),
(1188, 93, 'App\\Models\\OfferBuyGet', 'create', 21, '2022-09-06 17:56:57', '2022-09-06 17:56:57'),
(1189, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:57:01', '2022-09-06 17:57:01'),
(1190, 93, 'App\\Models\\Offer', 'delete', 1, '2022-09-06 17:57:22', '2022-09-06 17:57:22'),
(1191, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:57:23', '2022-09-06 17:57:23'),
(1192, 93, 'App\\Models\\Offer', 'updete', 4, '2022-09-06 17:57:45', '2022-09-06 17:57:45'),
(1193, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-06 17:57:45', '2022-09-06 17:57:45'),
(1194, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 17:57:46', '2022-09-06 17:57:46'),
(1195, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:00:15', '2022-09-06 19:00:15'),
(1196, 93, 'App\\Models\\Offer', 'create', 1, '2022-09-06 19:01:51', '2022-09-06 19:01:51'),
(1197, 93, 'App\\Models\\OfferDiscount', 'create', 1, '2022-09-06 19:01:51', '2022-09-06 19:01:51'),
(1198, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:01:56', '2022-09-06 19:01:56'),
(1199, 93, 'App\\Models\\Offer', 'create', 2, '2022-09-06 19:03:17', '2022-09-06 19:03:17'),
(1200, 93, 'App\\Models\\OfferDiscount', 'create', 2, '2022-09-06 19:03:17', '2022-09-06 19:03:17'),
(1201, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:03:22', '2022-09-06 19:03:22'),
(1202, 93, 'App\\Models\\Offer', 'create', 3, '2022-09-06 19:05:14', '2022-09-06 19:05:14'),
(1203, 93, 'App\\Models\\OfferBuyGet', 'create', 1, '2022-09-06 19:05:14', '2022-09-06 19:05:14'),
(1204, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:05:22', '2022-09-06 19:05:22'),
(1205, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:05:24', '2022-09-06 19:05:24'),
(1206, 93, 'App\\Models\\Offer', 'updete', 3, '2022-09-06 19:05:49', '2022-09-06 19:05:49'),
(1207, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-06 19:05:49', '2022-09-06 19:05:49'),
(1208, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:05:50', '2022-09-06 19:05:50'),
(1209, 93, 'App\\Models\\Offer', 'updete', 3, '2022-09-06 19:06:04', '2022-09-06 19:06:04'),
(1210, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-06 19:06:04', '2022-09-06 19:06:04'),
(1211, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:06:04', '2022-09-06 19:06:04'),
(1212, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:14:23', '2022-09-06 19:14:23'),
(1213, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:14:26', '2022-09-06 19:14:26'),
(1214, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:14:26', '2022-09-06 19:14:26'),
(1215, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:14:28', '2022-09-06 19:14:28'),
(1216, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 19:18:50', '2022-09-06 19:18:50'),
(1217, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-06 19:40:15', '2022-09-06 19:40:15'),
(1218, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-09-06 19:40:21', '2022-09-06 19:40:21'),
(1219, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-06 22:34:19', '2022-09-06 22:34:19'),
(1220, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-06 22:34:24', '2022-09-06 22:34:24'),
(1221, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 22:34:43', '2022-09-06 22:34:43'),
(1222, 93, 'App\\Models\\Offer', 'updete', 3, '2022-09-06 22:36:29', '2022-09-06 22:36:29'),
(1223, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-06 22:36:29', '2022-09-06 22:36:29'),
(1224, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 22:36:29', '2022-09-06 22:36:29'),
(1225, 93, 'App\\Models\\Offer', 'updete', 2, '2022-09-06 22:36:43', '2022-09-06 22:36:43'),
(1226, 93, 'App\\Models\\OfferDiscount', 'updete', 2, '2022-09-06 22:36:43', '2022-09-06 22:36:43'),
(1227, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 22:36:43', '2022-09-06 22:36:43'),
(1228, 93, 'App\\Models\\Offer', 'updete', 1, '2022-09-06 22:36:57', '2022-09-06 22:36:57'),
(1229, 93, 'App\\Models\\OfferDiscount', 'updete', 1, '2022-09-06 22:36:57', '2022-09-06 22:36:57'),
(1230, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(1231, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-06 22:43:50', '2022-09-06 22:43:50'),
(1232, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-08 13:43:49', '2022-09-08 13:43:49'),
(1233, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 13:44:24', '2022-09-08 13:44:24'),
(1234, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 13:45:57', '2022-09-08 13:45:57'),
(1235, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 13:46:05', '2022-09-08 13:46:05'),
(1236, 93, 'App\\Models\\Offer', 'updete', 3, '2022-09-08 13:46:49', '2022-09-08 13:46:49'),
(1237, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-08 13:46:49', '2022-09-08 13:46:49'),
(1238, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 13:46:49', '2022-09-08 13:46:49'),
(1239, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 13:48:31', '2022-09-08 13:48:31'),
(1240, 93, 'App\\Models\\Banner', 'view', 0, '2022-09-08 13:48:35', '2022-09-08 13:48:35'),
(1241, 93, 'App\\Models\\Banner', 'update', 51, '2022-09-08 13:51:24', '2022-09-08 13:51:24'),
(1242, 93, 'App\\Models\\Banner', 'view', 0, '2022-09-08 13:51:25', '2022-09-08 13:51:25'),
(1243, 93, 'App\\Models\\Banner', 'view', 0, '2022-09-08 13:55:49', '2022-09-08 13:55:49'),
(1244, 93, 'App\\Models\\Messages', 'create', 3, '2022-09-08 13:56:56', '2022-09-08 13:56:56'),
(1245, 93, 'App\\Models\\Messages', 'delete', 3, '2022-09-08 13:58:31', '2022-09-08 13:58:31'),
(1246, 93, 'App\\Models\\Messages', 'create', 4, '2022-09-08 13:58:57', '2022-09-08 13:58:57'),
(1247, 93, 'App\\Models\\Messages', 'delete', 4, '2022-09-08 13:59:14', '2022-09-08 13:59:14'),
(1248, 93, 'App\\Models\\User', 'view', 0, '2022-09-08 13:59:40', '2022-09-08 13:59:40'),
(1249, 93, 'App\\Models\\Category', 'view', 0, '2022-09-08 13:59:54', '2022-09-08 13:59:54'),
(1250, 93, 'App\\Models\\Item', 'view', 0, '2022-09-08 14:00:01', '2022-09-08 14:00:01'),
(1251, 93, 'App\\Models\\Item', 'view', 0, '2022-09-08 14:00:11', '2022-09-08 14:00:11'),
(1252, 93, 'App\\Models\\Extra', 'view', 0, '2022-09-08 14:00:15', '2022-09-08 14:00:15'),
(1253, 93, 'App\\Models\\Branch', 'view', 0, '2022-09-08 14:16:32', '2022-09-08 14:16:32'),
(1254, 93, 'App\\Models\\Banner', 'view', 0, '2022-09-08 14:16:51', '2022-09-08 14:16:51'),
(1255, 93, 'App\\Models\\Banner', 'update', 51, '2022-09-08 14:18:36', '2022-09-08 14:18:36'),
(1256, 93, 'App\\Models\\Banner', 'view', 0, '2022-09-08 14:18:36', '2022-09-08 14:18:36'),
(1257, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-08 16:04:18', '2022-09-08 16:04:18'),
(1258, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 16:04:43', '2022-09-08 16:04:43'),
(1259, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 16:19:34', '2022-09-08 16:19:34'),
(1260, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-09-08 16:25:31', '2022-09-08 16:25:31'),
(1261, 93, 'App\\Models\\Anoucement', 'update', 1, '2022-09-08 16:25:59', '2022-09-08 16:25:59'),
(1262, 93, 'App\\Models\\Anoucement', 'view', 0, '2022-09-08 16:25:59', '2022-09-08 16:25:59'),
(1263, 93, 'App\\Models\\Item', 'view', 0, '2022-09-08 16:50:47', '2022-09-08 16:50:47'),
(1264, 93, 'App\\Models\\Item', 'update', 102, '2022-09-08 16:52:23', '2022-09-08 16:52:23'),
(1265, 93, 'App\\Models\\Item', 'view', 0, '2022-09-08 16:52:23', '2022-09-08 16:52:23'),
(1266, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-08 17:15:32', '2022-09-08 17:15:32'),
(1267, 93, 'App\\Models\\User', 'view', 0, '2022-09-08 17:15:35', '2022-09-08 17:15:35'),
(1268, 93, 'App\\Models\\User', 'update', 241, '2022-09-08 17:15:50', '2022-09-08 17:15:50'),
(1269, 93, 'App\\Models\\User', 'view', 0, '2022-09-08 17:15:50', '2022-09-08 17:15:50'),
(1270, 93, 'App\\Models\\User', 'view', 0, '2022-09-08 18:22:08', '2022-09-08 18:22:08'),
(1271, 93, 'App\\Models\\User', 'view', 0, '2022-09-08 18:23:02', '2022-09-08 18:23:02'),
(1272, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-08 18:35:28', '2022-09-08 18:35:28'),
(1273, 93, 'App\\Models\\User', 'view', 0, '2022-09-08 18:35:54', '2022-09-08 18:35:54'),
(1274, 93, 'App\\Models\\User', 'view', 0, '2022-09-08 18:58:57', '2022-09-08 18:58:57'),
(1275, 93, 'App\\Models\\dashboard', 'view', 0, '2022-09-08 18:59:14', '2022-09-08 18:59:14'),
(1276, 93, 'App\\Models\\Category', 'view', 0, '2022-09-08 18:59:48', '2022-09-08 18:59:48'),
(1277, 93, 'App\\Models\\Messages', 'delete', 2, '2022-09-08 19:00:16', '2022-09-08 19:00:16'),
(1278, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 19:00:23', '2022-09-08 19:00:23'),
(1279, 93, 'App\\Models\\Offer', 'updete', 3, '2022-09-08 19:06:36', '2022-09-08 19:06:36'),
(1280, 93, 'App\\Models\\OfferBuyGet', 'updete', 0, '2022-09-08 19:06:36', '2022-09-08 19:06:36'),
(1281, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 19:06:36', '2022-09-08 19:06:36'),
(1282, 93, 'App\\Models\\Extra', 'view', 0, '2022-09-08 19:07:02', '2022-09-08 19:07:02'),
(1283, 93, 'App\\Models\\Extra', 'view', 0, '2022-09-08 19:07:48', '2022-09-08 19:07:48'),
(1284, 93, 'App\\Models\\Without', 'view', 0, '2022-09-08 19:07:51', '2022-09-08 19:07:51'),
(1285, 93, 'App\\Models\\Messages', 'create', 5, '2022-09-08 19:10:43', '2022-09-08 19:10:43'),
(1286, 93, 'App\\Models\\Messages', 'create', 6, '2022-09-08 19:12:19', '2022-09-08 19:12:19'),
(1287, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 19:12:54', '2022-09-08 19:12:54'),
(1288, 93, 'App\\Models\\Offer', 'view', 0, '2022-09-08 19:20:16', '2022-09-08 19:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title_ar`, `title_en`, `url`, `author`, `deleted_at`, `created_at`, `updated_at`, `img`) VALUES
(1, 'فيديو فيديو', 'media media', '/media/1641877366Videoleap-FBE9A370-3456-4B70-9847-DD46F5EEF1EF.mp4', 'mhmm', NULL, '2021-05-27 17:22:27', '2022-01-11 19:03:03', '/media/post-1.jpg'),
(2, 'افتتاح الفرع الاول لمملكة المعجنات', 'bjbjkb fndkn', '/media/1641877457Videoleap-AC3AA8AD-59B3-4BF0-B510-B79E5FEE3808.mp4', 'mhmm', NULL, '2021-05-31 20:33:13', '2022-08-15 20:56:20', '/media/post-2.jpg'),
(3, 'تجربة', 'video1', '/media/1652855282vid.mp4', 'عبدالله', NULL, '2022-05-18 20:29:00', '2022-05-18 20:29:00', '/media/post-3.jpg'),
(4, 'تجربة1', 'video2', '/media/1652855627vid2.mp4', 'عبدالله', NULL, '2022-05-18 20:34:00', '2022-05-18 20:34:00', '/media/post-4.jpg'),
(5, 'تجربة2', 'video3', '/media/1652855680vid3.mp4', 'عبدالله', NULL, '2022-05-18 20:34:51', '2022-05-18 20:34:51', '/media/post-5.jpg'),
(6, 'سشياشستنياشستنيا', 'HOW WE BEGIN', '/media/16605713491652855627vid2.mp4', 'gjhgjhghj', '2022-08-15 20:49:38', '2022-08-15 20:49:09', '2022-08-15 20:49:38', '/media/post-6.jpg'),
(7, 'ششششش', 'HOW WE BEGINw', '/media/16605714151652855627vid2.mp4', 'asdasdasd', '2022-08-15 20:50:35', '2022-08-15 20:50:15', '2022-08-15 20:50:35', ''),
(8, 'adasdasdasd', 'HOW WE BEGINwwe', '/media/16605714701652855627vid2.mp4', 'asdaszxcas', '2022-08-15 20:51:51', '2022-08-15 20:51:10', '2022-08-15 20:51:51', '/media/post-2.jpg'),
(9, 'wwwwwwwwww', 'HOW WE BEGINeeeee', '/media/16605715291652855627vid2.mp4', 'aaaaaaaaaa', NULL, '2022-08-15 20:52:09', '2022-08-15 20:52:09', '/media/166057152916528587354.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` bigint(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `subject`, `user_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Notification subject', 93, 'Notification Description', '2022-08-31 17:55:05', '2022-08-31 17:55:05', NULL),
(2, 'test', 93, 'test', '2022-08-31 18:26:45', '2022-09-08 19:00:16', '2022-09-08 19:00:16'),
(3, 'إشعارات التطبيق', 93, 'حياكم الله في تطبيق مملكة المعجنات', '2022-09-08 13:56:56', '2022-09-08 13:58:31', '2022-09-08 13:58:31'),
(4, 'إشعارات التطبيق', 93, 'منورين', '2022-09-08 13:58:57', '2022-09-08 13:59:14', '2022-09-08 13:59:14'),
(5, 'عرض اليوم الوطني', 93, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL),
(6, 'إشعارات التطبيق', 93, 'تجربة الاشعارات- عبدالله الحمود', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2021_05_22_142956_create_cities_table', 1),
(7, '2021_05_23_142956_create_areas_table', 1),
(8, '2021_05_24_142956_create_branches_table', 1),
(9, '2021_05_25_142956_create_users_table', 1),
(10, '2021_05_26_141000_create_categories_table', 1),
(11, '2021_05_26_142000_create_items_table', 1),
(12, '2021_05_26_142900_create_gifts_orders_table', 1),
(13, '2021_05_26_142900_create_gifts_table', 1),
(14, '2021_05_26_142940_create_offers_table', 1),
(15, '2021_05_26_142945_create_roles_table', 1),
(16, '2021_05_26_142950_create_jobs_table', 1),
(17, '2021_05_26_142950_create_permissions_table', 1),
(18, '2021_05_26_142956_create_about_us_table', 1),
(19, '2021_05_26_142956_create_addresses_table', 1),
(20, '2021_05_26_142956_create_banners_table', 1),
(21, '2021_05_26_142956_create_branch_delivery_areas_table', 1),
(22, '2021_05_26_142956_create_branch_user_table', 1),
(23, '2021_05_26_142956_create_branch_working_days_table', 1),
(24, '2021_05_26_142956_create_carts_table', 1),
(25, '2021_05_26_142956_create_category_extra_table', 1),
(26, '2021_05_26_142956_create_contact_us_table', 1),
(27, '2021_05_26_142956_create_contacts_table', 1),
(28, '2021_05_26_142956_create_customers_table', 1),
(29, '2021_05_26_142956_create_dough_types_table', 1),
(30, '2021_05_26_142956_create_extras_table', 1),
(31, '2021_05_26_142956_create_galleries_table', 1),
(32, '2021_05_26_142956_create_general_table', 1),
(33, '2021_05_26_142956_create_gifts_order_items_table', 1),
(34, '2021_05_26_142956_create_health_infos_table', 1),
(35, '2021_05_26_142956_create_job_requests_table', 1),
(36, '2021_05_26_142956_create_media_table', 1),
(37, '2021_05_26_142956_create_news_table', 1),
(38, '2021_05_26_142956_create_noti_tokens_table', 1),
(39, '2021_05_26_142956_create_offer_buy_items_table', 1),
(40, '2021_05_26_142956_create_offer_discount_items_table', 1),
(41, '2021_05_26_142956_create_offer_get_items_table', 1),
(42, '2021_05_26_142956_create_offers_buy_get_table', 1),
(43, '2021_05_26_142956_create_offers_discount_table', 1),
(44, '2021_05_26_142956_create_order_item_table', 1),
(45, '2021_05_26_142956_create_orders_table', 1),
(46, '2021_05_26_142956_create_password_resets_table', 1),
(47, '2021_05_26_142956_create_payments_table', 1),
(48, '2021_05_26_142956_create_permission_role_table', 1),
(49, '2021_05_26_142956_create_points_transactions_table', 1),
(50, '2021_05_26_142956_create_role_user_table', 1),
(51, '2021_05_26_142956_create_taxes_table', 1),
(52, '2021_05_26_142956_create_third_party_user_ids_table', 1),
(53, '2021_05_26_142956_create_user_branches_table', 1),
(54, '2021_05_26_142956_create_withouts_table', 1),
(55, '2021_06_07_133247_add_orderfrom_to_orders_table', 1),
(56, '2022_08_07_095146_create_favourite_item_table', 2),
(57, '2021_06_08_125722_entrust_setup_tables', 3),
(58, '2022_08_10_143311_add_image_to_health_infos_table', 4),
(59, '2022_08_10_164237_add_icon_to_about_us_table', 5),
(60, '2022_08_10_165813_add_image_to_about_us_table', 6),
(61, '2022_08_11_074909_add_type_to_about_us_table', 7),
(63, '2022_08_14_082542_create_notification_logs_table', 8),
(64, '2022_08_14_122157_add_links_column_to_about_us_table', 9),
(65, '2022_08_14_162154_add_main_column_to_offers_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'صفائح اللحم', 'The grand reopening of Kingdom of Pastries new branch', 'ودك تستمتع بطعم لحم طازج متبل ومضاف اليه الفلفل الألوان المغذي الغني بفيتامين سي مع إضافة خاصة بنا تميزنا عن غيرنا في الطعم والجودة مع خبزتنا اللذيذة ودلل نفسك حسب اختيارك سواء بإضافة جبن المازوريلا او الهلابينو الذي يضفي مذاق شهي عند فطورك او عشاءك ولا تنسى طلب الصوص المجاني ليكتمل جمال الطعم الشهي', 'You would like to enjoy the taste of fresh, seasoned meat with nutritious color pepper added to it, rich in vitamin C, with a special addition that distinguishes us from others in taste and quality with our delicious bread. Treat yourself according to your choice, whether by adding mozzarella cheese or jalapeno, which adds a delicious taste to your breakfast or dinner, and do not forget to order the free sauce To complete the beauty of the delicious taste.', '/blogs/16624566361654761692special food-01.jpg', NULL, '2021-05-31 14:34:33', '2022-09-06 16:30:36'),
(2, 'بيتزا الفلافل', 'Falafel Pizza', 'محتار تآكل عندنا ساندويتش فلافل او بيتزا الحل عندنا بيتزا فلافل خبزتنا اللذيذة مضاف اليها صوص الطماطم المميز بالاوريجانو وقطع الفلفل والمشروم مغمورين بالجبن المازوريلا الشهية مع قطع الفلافل اللذيذة وماتشيل هم الحيرة', 'Confused, we have a falafel sandwich or pizza, the solution is we have a falafel pizza, our delicious bread, in addition to the distinctive tomato sauce with oregano, pepper pieces and mushrooms, covered with delicious mozzarella cheese with delicious falafel pieces.', '/blogs/16624566211654761622special food-02.jpg', NULL, '2021-05-31 14:35:21', '2022-09-06 16:30:21'),
(3, 'بيتزا الرانش', 'Ranch Pizza', 'ما تحب الصلصة مليت من بيتزا بها صلصة الحل عندنا اختار بيتزا الرانش مطعمة بصوص الرانش اللذيذ المريح للمعدة مع حلقات البصل وشرائح الفلفل الأخضر وقطع المشروم مغمورين بالجبن الموز ريلا الشهية وقطع الدجاج المتبل وتمتع بالطعم الجديد الشهي', 'You don\'t like the sauce. It\'s full of pizza with our solution. Choose the ranch pizza with delicious ranch sauce, which is comfortable for the stomach, with onion rings, green pepper slices and mushroom pieces, covered with delicious banana rilla cheese and seasoned chicken pieces, and enjoy the new delicious taste', '/blogs/16624566091654761535special food-06.jpg', NULL, '2021-09-23 04:39:36', '2022-09-06 16:30:09'),
(4, 'yur', 'yu', 'ytty', 'tdtrd', '/blogs/post-4.jpg', '2022-08-29 22:53:57', '2022-08-07 17:03:56', '2022-08-29 22:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `chat_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Notification',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `notification_logs`
--

INSERT INTO `notification_logs` (`id`, `user_id`, `chat_id`, `body`, `data`, `type`, `created_at`, `updated_at`, `deleted_at`, `customer_id`) VALUES
(173, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 16:52:43', '2022-08-17 16:52:43', NULL, 70),
(174, 70, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-08-17 16:52:49', '2022-08-17 16:52:49', NULL, NULL),
(175, 70, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-08-17 16:52:50', '2022-08-17 16:52:50', NULL, NULL),
(176, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:32:51', '2022-08-17 20:32:51', NULL, 70),
(177, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:34:24', '2022-08-17 20:34:24', NULL, 70),
(178, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:34:48', '2022-08-17 20:34:48', NULL, 70),
(179, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:35:56', '2022-08-17 20:35:56', NULL, 70),
(180, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:36:42', '2022-08-17 20:36:42', NULL, 70),
(181, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:36:50', '2022-08-17 20:36:50', NULL, 70),
(182, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:37:06', '2022-08-17 20:37:06', NULL, 70),
(183, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:37:25', '2022-08-17 20:37:25', NULL, 70),
(184, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 20:37:32', '2022-08-17 20:37:32', NULL, 70),
(185, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 21:01:05', '2022-08-17 21:01:05', NULL, 70),
(186, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 21:05:50', '2022-08-17 21:05:50', NULL, 70),
(187, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 21:06:36', '2022-08-17 21:06:36', NULL, 70),
(188, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 21:08:05', '2022-08-17 21:08:05', NULL, 70),
(189, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 21:52:57', '2022-08-17 21:52:57', NULL, 70),
(190, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-17 21:56:16', '2022-08-17 21:56:16', NULL, 70),
(197, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:50', '2022-08-25 16:31:50', NULL, NULL),
(198, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:51', '2022-08-25 16:31:51', NULL, NULL),
(199, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:51', '2022-08-25 16:31:51', NULL, NULL),
(200, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:52', '2022-08-25 16:31:52', NULL, NULL),
(201, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:52', '2022-08-25 16:31:52', NULL, NULL),
(202, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:53', '2022-08-25 16:31:53', NULL, NULL),
(203, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:53', '2022-08-25 16:31:53', NULL, NULL),
(204, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:53', '2022-08-25 16:31:53', NULL, NULL),
(205, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:54', '2022-08-25 16:31:54', NULL, NULL),
(206, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:54', '2022-08-25 16:31:54', NULL, NULL),
(207, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:55', '2022-08-25 16:31:55', NULL, NULL),
(208, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:55', '2022-08-25 16:31:55', NULL, NULL),
(209, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:56', '2022-08-25 16:31:56', NULL, NULL),
(210, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:56', '2022-08-25 16:31:56', NULL, NULL),
(211, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:56', '2022-08-25 16:31:56', NULL, NULL),
(212, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:57', '2022-08-25 16:31:57', NULL, NULL),
(213, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:31:58', '2022-08-25 16:31:58', NULL, NULL),
(214, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:46:37', '2022-08-25 16:46:37', NULL, 70),
(215, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:46:37', '2022-08-25 16:46:37', NULL, 72),
(216, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:17', '2022-08-25 16:51:17', NULL, 70),
(217, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:17', '2022-08-25 16:51:17', NULL, 72),
(218, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:18', '2022-08-25 16:51:18', NULL, 75),
(219, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:19', '2022-08-25 16:51:19', NULL, 76),
(220, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:19', '2022-08-25 16:51:19', NULL, 79),
(221, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:19', '2022-08-25 16:51:19', NULL, 79),
(222, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:20', '2022-08-25 16:51:20', NULL, 85),
(223, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:20', '2022-08-25 16:51:20', NULL, 75),
(224, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:20', '2022-08-25 16:51:20', NULL, 87),
(225, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:21', '2022-08-25 16:51:21', NULL, 90),
(226, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:21', '2022-08-25 16:51:21', NULL, 143),
(227, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:22', '2022-08-25 16:51:22', NULL, 144),
(228, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:23', '2022-08-25 16:51:23', NULL, 70),
(229, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:23', '2022-08-25 16:51:23', NULL, 157),
(230, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:23', '2022-08-25 16:51:23', NULL, 161),
(231, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:24', '2022-08-25 16:51:24', NULL, 182),
(232, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:51:24', '2022-08-25 16:51:24', NULL, 191),
(233, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:21', '2022-08-25 16:56:21', NULL, 70),
(234, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:21', '2022-08-25 16:56:21', NULL, 72),
(235, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:22', '2022-08-25 16:56:22', NULL, 75),
(236, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:22', '2022-08-25 16:56:22', NULL, 76),
(237, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:22', '2022-08-25 16:56:22', NULL, 79),
(238, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:23', '2022-08-25 16:56:23', NULL, 79),
(239, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:23', '2022-08-25 16:56:23', NULL, 85),
(240, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:23', '2022-08-25 16:56:23', NULL, 75),
(241, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:24', '2022-08-25 16:56:24', NULL, 87),
(242, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:24', '2022-08-25 16:56:24', NULL, 90),
(243, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:24', '2022-08-25 16:56:24', NULL, 143),
(244, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:25', '2022-08-25 16:56:25', NULL, 144),
(245, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:25', '2022-08-25 16:56:25', NULL, 70),
(246, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:25', '2022-08-25 16:56:25', NULL, 157),
(247, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:26', '2022-08-25 16:56:26', NULL, 161),
(248, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:26', '2022-08-25 16:56:26', NULL, 182),
(249, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:56:27', '2022-08-25 16:56:27', NULL, 191),
(250, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:41', '2022-08-25 16:57:41', NULL, 70),
(251, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:41', '2022-08-25 16:57:41', NULL, 72),
(252, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:42', '2022-08-25 16:57:42', NULL, 75),
(253, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:42', '2022-08-25 16:57:42', NULL, 76),
(254, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:42', '2022-08-25 16:57:42', NULL, 79),
(255, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:43', '2022-08-25 16:57:43', NULL, 79),
(256, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:43', '2022-08-25 16:57:43', NULL, 85),
(257, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:43', '2022-08-25 16:57:43', NULL, 75),
(258, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:43', '2022-08-25 16:57:43', NULL, 87),
(259, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:44', '2022-08-25 16:57:44', NULL, 90),
(260, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:44', '2022-08-25 16:57:44', NULL, 143),
(261, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:45', '2022-08-25 16:57:45', NULL, 144),
(262, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:45', '2022-08-25 16:57:45', NULL, 70),
(263, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:45', '2022-08-25 16:57:45', NULL, 157),
(264, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:45', '2022-08-25 16:57:45', NULL, 161),
(265, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:46', '2022-08-25 16:57:46', NULL, 182),
(266, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:57:46', '2022-08-25 16:57:46', NULL, 191),
(267, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:11', '2022-08-25 16:58:11', NULL, 70),
(268, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:11', '2022-08-25 16:58:11', NULL, 72),
(269, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:11', '2022-08-25 16:58:11', NULL, 75),
(270, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:12', '2022-08-25 16:58:12', NULL, 76),
(271, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:12', '2022-08-25 16:58:12', NULL, 79),
(272, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:12', '2022-08-25 16:58:12', NULL, 79),
(273, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:13', '2022-08-25 16:58:13', NULL, 85),
(274, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:13', '2022-08-25 16:58:13', NULL, 75),
(275, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:13', '2022-08-25 16:58:13', NULL, 87),
(276, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:14', '2022-08-25 16:58:14', NULL, 90),
(277, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:14', '2022-08-25 16:58:14', NULL, 143),
(278, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:15', '2022-08-25 16:58:15', NULL, 144),
(279, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:15', '2022-08-25 16:58:15', NULL, 70),
(280, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:15', '2022-08-25 16:58:15', NULL, 157),
(281, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:15', '2022-08-25 16:58:15', NULL, 161),
(282, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:16', '2022-08-25 16:58:16', NULL, 182),
(283, 93, NULL, 'Notification Description', NULL, 'Notification subject', '2022-08-25 16:58:16', '2022-08-25 16:58:16', NULL, 191),
(284, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:13', '2022-08-25 19:25:13', NULL, 70),
(285, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:13', '2022-08-25 19:25:13', NULL, 72),
(286, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:14', '2022-08-25 19:25:14', NULL, 75),
(287, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:14', '2022-08-25 19:25:14', NULL, 76),
(288, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:14', '2022-08-25 19:25:14', NULL, 79),
(289, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:14', '2022-08-25 19:25:14', NULL, 79),
(290, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:15', '2022-08-25 19:25:15', NULL, 85),
(291, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:15', '2022-08-25 19:25:15', NULL, 75),
(292, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:15', '2022-08-25 19:25:15', NULL, 87),
(293, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:16', '2022-08-25 19:25:16', NULL, 90),
(294, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:16', '2022-08-25 19:25:16', NULL, 143),
(295, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:16', '2022-08-25 19:25:16', NULL, 144),
(296, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:17', '2022-08-25 19:25:17', NULL, 70),
(297, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:17', '2022-08-25 19:25:17', NULL, 157),
(298, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:17', '2022-08-25 19:25:17', NULL, 161),
(299, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:18', '2022-08-25 19:25:18', NULL, 182),
(300, 93, NULL, 'yhh', NULL, 'Notification subject', '2022-08-25 19:25:18', '2022-08-25 19:25:18', NULL, 191),
(301, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 19:33:26', '2022-08-29 19:33:26', NULL, 93),
(302, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 19:42:14', '2022-08-29 19:42:14', NULL, 70),
(303, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 19:52:28', '2022-08-29 19:52:28', NULL, 70),
(304, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 20:28:08', '2022-08-29 20:28:08', NULL, 231),
(305, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 20:28:15', '2022-08-29 20:28:15', NULL, 231),
(306, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 20:28:59', '2022-08-29 20:28:59', NULL, 231),
(307, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 20:29:23', '2022-08-29 20:29:23', NULL, 231),
(308, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 20:29:36', '2022-08-29 20:29:36', NULL, 231),
(309, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 20:30:33', '2022-08-29 20:30:33', NULL, 231),
(310, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 20:30:45', '2022-08-29 20:30:45', NULL, 231),
(311, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 21:07:38', '2022-08-29 21:07:38', NULL, 70),
(312, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 21:14:19', '2022-08-29 21:14:19', NULL, 70),
(313, 70, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-08-29 21:35:19', '2022-08-29 21:35:19', NULL, NULL),
(314, 70, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-08-29 21:35:20', '2022-08-29 21:35:20', NULL, NULL),
(315, 70, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-08-29 21:35:31', '2022-08-29 21:35:31', NULL, NULL),
(316, 70, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-08-29 21:35:32', '2022-08-29 21:35:32', NULL, NULL),
(317, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 21:59:35', '2022-08-29 21:59:35', NULL, 93),
(318, 161, NULL, 'New Order has been placed', NULL, 'Order', '2022-08-29 22:21:30', '2022-08-29 22:21:30', NULL, 93),
(319, 70, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:19', '2022-08-31 20:06:19', NULL, NULL),
(320, 70, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:19', '2022-08-31 20:06:19', NULL, NULL),
(321, 72, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:19', '2022-08-31 20:06:19', NULL, NULL),
(322, 75, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:20', '2022-08-31 20:06:20', NULL, NULL),
(323, 75, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:20', '2022-08-31 20:06:20', NULL, NULL),
(324, 76, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:20', '2022-08-31 20:06:20', NULL, NULL),
(325, 79, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:21', '2022-08-31 20:06:21', NULL, NULL),
(326, 79, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:21', '2022-08-31 20:06:21', NULL, NULL),
(327, 85, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:21', '2022-08-31 20:06:21', NULL, NULL),
(328, 87, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:22', '2022-08-31 20:06:22', NULL, NULL),
(329, 143, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:22', '2022-08-31 20:06:22', NULL, NULL),
(330, 144, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:22', '2022-08-31 20:06:22', NULL, NULL),
(331, 157, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:23', '2022-08-31 20:06:23', NULL, NULL),
(332, 182, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:23', '2022-08-31 20:06:23', NULL, NULL),
(333, 191, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 20:06:23', '2022-08-31 20:06:23', NULL, NULL),
(334, 70, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:17', '2022-08-31 21:01:17', NULL, NULL),
(335, 70, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:18', '2022-08-31 21:01:18', NULL, NULL),
(336, 72, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:21', '2022-08-31 21:01:21', NULL, NULL),
(337, 75, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:21', '2022-08-31 21:01:21', NULL, NULL),
(338, 75, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:22', '2022-08-31 21:01:22', NULL, NULL),
(339, 76, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:22', '2022-08-31 21:01:22', NULL, NULL),
(340, 79, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:22', '2022-08-31 21:01:22', NULL, NULL),
(341, 79, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:24', '2022-08-31 21:01:24', NULL, NULL),
(342, 85, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:24', '2022-08-31 21:01:24', NULL, NULL),
(343, 87, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:24', '2022-08-31 21:01:24', NULL, NULL),
(344, 143, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:24', '2022-08-31 21:01:24', NULL, NULL),
(345, 144, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:25', '2022-08-31 21:01:25', NULL, NULL),
(346, 157, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:26', '2022-08-31 21:01:26', NULL, NULL),
(347, 182, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:28', '2022-08-31 21:01:28', NULL, NULL),
(348, 191, NULL, 'New Offer: teest', NULL, 'Offer', '2022-08-31 21:01:29', '2022-08-31 21:01:29', NULL, NULL),
(349, 70, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:24', '2022-08-31 23:31:24', NULL, NULL),
(350, 70, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:24', '2022-08-31 23:31:24', NULL, NULL),
(351, 72, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:25', '2022-08-31 23:31:25', NULL, NULL),
(352, 75, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:25', '2022-08-31 23:31:25', NULL, NULL),
(353, 75, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:25', '2022-08-31 23:31:25', NULL, NULL),
(354, 76, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:26', '2022-08-31 23:31:26', NULL, NULL),
(355, 79, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:26', '2022-08-31 23:31:26', NULL, NULL),
(356, 79, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:26', '2022-08-31 23:31:26', NULL, NULL),
(357, 85, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:26', '2022-08-31 23:31:26', NULL, NULL),
(358, 87, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:27', '2022-08-31 23:31:27', NULL, NULL),
(359, 143, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:27', '2022-08-31 23:31:27', NULL, NULL),
(360, 144, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:27', '2022-08-31 23:31:27', NULL, NULL),
(361, 157, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:27', '2022-08-31 23:31:27', NULL, NULL),
(362, 182, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:28', '2022-08-31 23:31:28', NULL, NULL),
(363, 191, NULL, 'New Offer: test', NULL, 'Offer', '2022-08-31 23:31:28', '2022-08-31 23:31:28', NULL, NULL),
(364, 70, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-01 20:49:06', '2022-09-01 20:49:06', NULL, NULL),
(365, 70, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-01 20:49:07', '2022-09-01 20:49:07', NULL, NULL),
(366, 70, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-01 20:49:25', '2022-09-01 20:49:25', NULL, NULL),
(367, 70, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-01 20:49:26', '2022-09-01 20:49:26', NULL, NULL),
(368, 70, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:07', '2022-09-05 22:36:07', NULL, NULL),
(369, 70, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:08', '2022-09-05 22:36:08', NULL, NULL),
(370, 72, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:08', '2022-09-05 22:36:08', NULL, NULL),
(371, 75, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:08', '2022-09-05 22:36:08', NULL, NULL),
(372, 75, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:09', '2022-09-05 22:36:09', NULL, NULL),
(373, 76, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:09', '2022-09-05 22:36:09', NULL, NULL),
(374, 79, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:09', '2022-09-05 22:36:09', NULL, NULL),
(375, 79, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:09', '2022-09-05 22:36:09', NULL, NULL),
(376, 85, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:09', '2022-09-05 22:36:09', NULL, NULL),
(377, 87, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:10', '2022-09-05 22:36:10', NULL, NULL),
(378, 143, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:10', '2022-09-05 22:36:10', NULL, NULL),
(379, 144, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:10', '2022-09-05 22:36:10', NULL, NULL),
(380, 157, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:10', '2022-09-05 22:36:10', NULL, NULL),
(381, 182, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:11', '2022-09-05 22:36:11', NULL, NULL),
(382, 191, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:11', '2022-09-05 22:36:11', NULL, NULL),
(383, 70, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:16', '2022-09-05 22:36:16', NULL, NULL),
(384, 70, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:16', '2022-09-05 22:36:16', NULL, NULL),
(385, 72, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:17', '2022-09-05 22:36:17', NULL, NULL),
(386, 75, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:17', '2022-09-05 22:36:17', NULL, NULL),
(387, 75, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:17', '2022-09-05 22:36:17', NULL, NULL),
(388, 76, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:17', '2022-09-05 22:36:17', NULL, NULL),
(389, 79, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:18', '2022-09-05 22:36:18', NULL, NULL),
(390, 79, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:18', '2022-09-05 22:36:18', NULL, NULL),
(391, 85, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:18', '2022-09-05 22:36:18', NULL, NULL),
(392, 87, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:18', '2022-09-05 22:36:18', NULL, NULL),
(393, 143, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:18', '2022-09-05 22:36:18', NULL, NULL),
(394, 144, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:18', '2022-09-05 22:36:18', NULL, NULL),
(395, 157, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:19', '2022-09-05 22:36:19', NULL, NULL),
(396, 182, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:19', '2022-09-05 22:36:19', NULL, NULL),
(397, 191, NULL, 'New Offer: Al Ahsa Offer', NULL, 'Offer', '2022-09-05 22:36:19', '2022-09-05 22:36:19', NULL, NULL),
(398, 70, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:13', '2022-09-05 23:40:13', NULL, NULL),
(399, 70, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:14', '2022-09-05 23:40:14', NULL, NULL),
(400, 72, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:14', '2022-09-05 23:40:14', NULL, NULL),
(401, 75, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:14', '2022-09-05 23:40:14', NULL, NULL),
(402, 75, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:15', '2022-09-05 23:40:15', NULL, NULL),
(403, 76, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:15', '2022-09-05 23:40:15', NULL, NULL),
(404, 79, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:15', '2022-09-05 23:40:15', NULL, NULL),
(405, 79, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:15', '2022-09-05 23:40:15', NULL, NULL),
(406, 85, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:16', '2022-09-05 23:40:16', NULL, NULL),
(407, 87, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:16', '2022-09-05 23:40:16', NULL, NULL),
(408, 143, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:16', '2022-09-05 23:40:16', NULL, NULL),
(409, 144, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:16', '2022-09-05 23:40:16', NULL, NULL),
(410, 157, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:17', '2022-09-05 23:40:17', NULL, NULL),
(411, 182, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:17', '2022-09-05 23:40:17', NULL, NULL),
(412, 191, NULL, 'New Offer: testtestdiscount', NULL, 'Offer', '2022-09-05 23:40:17', '2022-09-05 23:40:17', NULL, NULL),
(413, 70, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:18', '2022-09-06 17:46:18', NULL, NULL),
(414, 70, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:19', '2022-09-06 17:46:19', NULL, NULL),
(415, 72, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:19', '2022-09-06 17:46:19', NULL, NULL),
(416, 75, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:19', '2022-09-06 17:46:19', NULL, NULL),
(417, 75, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:20', '2022-09-06 17:46:20', NULL, NULL),
(418, 76, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:20', '2022-09-06 17:46:20', NULL, NULL),
(419, 79, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:20', '2022-09-06 17:46:20', NULL, NULL),
(420, 79, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:20', '2022-09-06 17:46:20', NULL, NULL),
(421, 85, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:20', '2022-09-06 17:46:20', NULL, NULL),
(422, 87, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:21', '2022-09-06 17:46:21', NULL, NULL),
(423, 143, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:21', '2022-09-06 17:46:21', NULL, NULL),
(424, 144, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:21', '2022-09-06 17:46:21', NULL, NULL),
(425, 157, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:21', '2022-09-06 17:46:21', NULL, NULL),
(426, 182, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:22', '2022-09-06 17:46:22', NULL, NULL),
(427, 191, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 17:46:22', '2022-09-06 17:46:22', NULL, NULL),
(428, 70, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:51', '2022-09-06 19:01:51', NULL, NULL),
(429, 70, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:51', '2022-09-06 19:01:51', NULL, NULL),
(430, 72, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:51', '2022-09-06 19:01:51', NULL, NULL),
(431, 75, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:52', '2022-09-06 19:01:52', NULL, NULL),
(432, 75, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:52', '2022-09-06 19:01:52', NULL, NULL),
(433, 76, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:53', '2022-09-06 19:01:53', NULL, NULL),
(434, 79, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:53', '2022-09-06 19:01:53', NULL, NULL),
(435, 79, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:53', '2022-09-06 19:01:53', NULL, NULL),
(436, 85, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:53', '2022-09-06 19:01:53', NULL, NULL),
(437, 87, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:54', '2022-09-06 19:01:54', NULL, NULL),
(438, 143, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:54', '2022-09-06 19:01:54', NULL, NULL),
(439, 144, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:55', '2022-09-06 19:01:55', NULL, NULL),
(440, 157, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:55', '2022-09-06 19:01:55', NULL, NULL),
(441, 182, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:55', '2022-09-06 19:01:55', NULL, NULL),
(442, 191, NULL, 'New Offer: pizza offer', NULL, 'Offer', '2022-09-06 19:01:55', '2022-09-06 19:01:55', NULL, NULL),
(443, 70, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:17', '2022-09-06 19:03:17', NULL, NULL),
(444, 70, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:18', '2022-09-06 19:03:18', NULL, NULL),
(445, 72, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:18', '2022-09-06 19:03:18', NULL, NULL),
(446, 75, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:18', '2022-09-06 19:03:18', NULL, NULL),
(447, 75, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:18', '2022-09-06 19:03:18', NULL, NULL),
(448, 76, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:19', '2022-09-06 19:03:19', NULL, NULL),
(449, 79, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:19', '2022-09-06 19:03:19', NULL, NULL),
(450, 79, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:19', '2022-09-06 19:03:19', NULL, NULL),
(451, 85, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:19', '2022-09-06 19:03:19', NULL, NULL),
(452, 87, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:19', '2022-09-06 19:03:19', NULL, NULL),
(453, 143, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:20', '2022-09-06 19:03:20', NULL, NULL),
(454, 144, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:20', '2022-09-06 19:03:20', NULL, NULL),
(455, 157, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:20', '2022-09-06 19:03:20', NULL, NULL),
(456, 182, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:20', '2022-09-06 19:03:20', NULL, NULL),
(457, 191, NULL, 'New Offer: zataar offer takeaway', NULL, 'Offer', '2022-09-06 19:03:21', '2022-09-06 19:03:21', NULL, NULL),
(458, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-07 19:35:51', '2022-09-07 19:35:51', NULL, NULL),
(459, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-07 19:36:09', '2022-09-07 19:36:09', NULL, NULL),
(460, 231, NULL, 'Your Order has been Cancelled, لقد تم إلغاء طلبك', NULL, 'Order', '2022-09-07 19:36:39', '2022-09-07 19:36:39', NULL, NULL),
(461, 231, NULL, 'Your Order has been Rejected, لقد تم رفض طلبك', NULL, 'Order', '2022-09-07 19:37:01', '2022-09-07 19:37:01', NULL, NULL),
(462, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-07 19:41:56', '2022-09-07 19:41:56', NULL, NULL),
(463, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-07 19:42:01', '2022-09-07 19:42:01', NULL, NULL),
(464, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 00:02:12', '2022-09-08 00:02:12', NULL, NULL),
(465, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 00:02:19', '2022-09-08 00:02:19', NULL, NULL),
(466, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 00:12:36', '2022-09-08 00:12:36', NULL, NULL),
(467, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 00:12:40', '2022-09-08 00:12:40', NULL, NULL),
(468, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:56', '2022-09-08 13:56:56', NULL, 70),
(469, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:57', '2022-09-08 13:56:57', NULL, 72),
(470, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:57', '2022-09-08 13:56:57', NULL, 75),
(471, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:57', '2022-09-08 13:56:57', NULL, 76),
(472, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:58', '2022-09-08 13:56:58', NULL, 79),
(473, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:58', '2022-09-08 13:56:58', NULL, 79),
(474, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:58', '2022-09-08 13:56:58', NULL, 85),
(475, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:58', '2022-09-08 13:56:58', NULL, 75),
(476, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:59', '2022-09-08 13:56:59', NULL, 87),
(477, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:59', '2022-09-08 13:56:59', NULL, 90),
(478, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:56:59', '2022-09-08 13:56:59', NULL, 143),
(479, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:57:00', '2022-09-08 13:57:00', NULL, 144),
(480, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:57:00', '2022-09-08 13:57:00', NULL, 70),
(481, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:57:00', '2022-09-08 13:57:00', NULL, 157),
(482, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:57:00', '2022-09-08 13:57:00', NULL, 182),
(483, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:57:01', '2022-09-08 13:57:01', NULL, 191),
(484, 93, NULL, 'حياكم الله في تطبيق مملكة المعجنات', NULL, 'إشعارات التطبيق', '2022-09-08 13:57:01', '2022-09-08 13:57:01', NULL, 231),
(485, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:57', '2022-09-08 13:58:57', NULL, 70),
(486, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:58', '2022-09-08 13:58:58', NULL, 72),
(487, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:58', '2022-09-08 13:58:58', NULL, 75),
(488, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:58', '2022-09-08 13:58:58', NULL, 76),
(489, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:58', '2022-09-08 13:58:58', NULL, 79),
(490, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:58', '2022-09-08 13:58:58', NULL, 79),
(491, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:59', '2022-09-08 13:58:59', NULL, 85),
(492, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:59', '2022-09-08 13:58:59', NULL, 75),
(493, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:59', '2022-09-08 13:58:59', NULL, 87),
(494, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:58:59', '2022-09-08 13:58:59', NULL, 90),
(495, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:59:00', '2022-09-08 13:59:00', NULL, 143),
(496, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:59:00', '2022-09-08 13:59:00', NULL, 144),
(497, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:59:00', '2022-09-08 13:59:00', NULL, 70),
(498, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:59:00', '2022-09-08 13:59:00', NULL, 157),
(499, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:59:01', '2022-09-08 13:59:01', NULL, 182),
(500, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:59:01', '2022-09-08 13:59:01', NULL, 191),
(501, 93, NULL, 'منورين', NULL, 'إشعارات التطبيق', '2022-09-08 13:59:01', '2022-09-08 13:59:01', NULL, 231),
(502, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 16:08:13', '2022-09-08 16:08:13', NULL, NULL),
(503, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 16:08:28', '2022-09-08 16:08:28', NULL, NULL),
(504, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 17:15:25', '2022-09-08 17:15:25', NULL, NULL),
(505, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 17:15:38', '2022-09-08 17:15:38', NULL, NULL),
(506, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 17:15:43', '2022-09-08 17:15:43', NULL, NULL),
(507, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 17:15:51', '2022-09-08 17:15:51', NULL, NULL),
(508, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 17:15:55', '2022-09-08 17:15:55', NULL, NULL),
(509, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 17:16:01', '2022-09-08 17:16:01', NULL, NULL),
(510, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 17:18:03', '2022-09-08 17:18:03', NULL, NULL),
(511, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 17:18:09', '2022-09-08 17:18:09', NULL, NULL),
(512, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 17:18:14', '2022-09-08 17:18:14', NULL, NULL),
(513, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 17:18:20', '2022-09-08 17:18:20', NULL, NULL),
(514, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 17:18:51', '2022-09-08 17:18:51', NULL, NULL),
(515, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-08 17:19:13', '2022-09-08 17:19:13', NULL, NULL),
(516, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 17:19:46', '2022-09-08 17:19:46', NULL, NULL),
(517, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-08 17:19:57', '2022-09-08 17:19:57', NULL, NULL),
(518, 231, NULL, 'Your Order has been Rejected, لقد تم رفض طلبك', NULL, 'Order', '2022-09-08 17:22:08', '2022-09-08 17:22:08', NULL, NULL),
(519, 231, NULL, 'Your Order has been Cancelled, لقد تم إلغاء طلبك', NULL, 'Order', '2022-09-08 17:34:58', '2022-09-08 17:34:58', NULL, NULL),
(520, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 70),
(521, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 72),
(522, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 75),
(523, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 76),
(524, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 79),
(525, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 79),
(526, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 85),
(527, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 75),
(528, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 87),
(529, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 90),
(530, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 143),
(531, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 144),
(532, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 70),
(533, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 157),
(534, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 182),
(535, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 191),
(536, 93, NULL, 'استمتع بعرض اليوم الوطني من مملكة المعجنات واحصل عليه مباشرة', NULL, 'عرض اليوم الوطني', '2022-09-08 19:10:43', '2022-09-08 19:10:43', NULL, 231),
(537, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 70),
(538, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 72),
(539, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 75),
(540, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 76),
(541, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 79),
(542, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 79),
(543, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 85),
(544, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 75),
(545, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 87),
(546, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 90),
(547, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 143),
(548, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 144),
(549, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 70),
(550, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 157),
(551, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 182),
(552, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 191),
(553, 93, NULL, 'تجربة الاشعارات- عبدالله الحمود', NULL, 'إشعارات التطبيق', '2022-09-08 19:12:19', '2022-09-08 19:12:19', NULL, 231),
(554, 231, NULL, 'Your Order has been Accepted, لقد تم قبول طلبك', NULL, 'Order', '2022-09-10 01:12:09', '2022-09-10 01:12:09', NULL, NULL),
(555, 231, NULL, 'Your Order has been completed, تم تجهيز الطلب', NULL, 'Order', '2022-09-10 01:12:18', '2022-09-10 01:12:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `noti_tokens`
--

CREATE TABLE `noti_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `platform` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `noti_tokens`
--

INSERT INTO `noti_tokens` (`id`, `user_id`, `platform`, `token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(24, 70, 'Android', 'cT5uoUu0T4-cjFjKOObHdx:APA91bG1LHY_st_CStZWbzDSXJkfw-9TdopS5GDG-1rxoljIZAywsBBLO2Bd4e7fway15U4QxmShtARd5anDC832SuKMzLXBrCpwNOSDkA0GvSrCkRhr0VLMM2_uYvA2BOwEmtWcEg01', NULL, '2020-03-23 03:58:15', '2022-08-06 23:43:42'),
(25, 72, 'Android', 'c1fYoLlDJqA:APA91bEiyKMBY0T6D2coDi_AZUGy4AQoEKlaKv3fcr8LLa6yfWjzJICcxvY0rZdcyuvCTaT1pRnYXeSaYFr6ldF6ZWBATw5ZYJOuJ3XvGyVS3F-sMHK3ptksht5yhL6m-Rhxm9_8FrrT', NULL, '2020-03-23 04:11:23', '2020-03-30 05:42:27'),
(26, 1, 'Android', 'eWBnyQXivlE:APA91bHzSN-9siYfb-H0UmvpxwqNGJxr11ASTeifY9-HXY_MTVUmWYeWsF4-l_SuBGhcjCezTQMBcKTNq5zSmtbPS1QXNrYnFaID6WB8ns3ZTTq_hQv3TDszkCPU8Qw1u8Gc3pT38x2x', NULL, '2020-03-23 08:36:51', '2020-03-24 10:38:14'),
(27, 75, 'Android', 'd0giUBxambg:APA91bGVgC1xxos9-CEupuKW_LaYN1GHsdLRsfL4PwW0TBJOMWJZVSHR8LcXuFGdRdn9ylsAnFAVI4BWJgJpWNr4znSoCUxmWI_UGDvRldUjOZeyPbA4S6yapq-6QdBruLoUYIwC5NRj', NULL, '2020-03-30 07:41:38', '2020-09-16 20:01:44'),
(28, 76, 'Android', 'd00803DH5z8:APA91bGLYrVZOOtdTK1lmizKy4fi0dOEWpGHI6ZKaektco2fWuBMLFWH-Lus8nchaeiRj8oyqx-uCU78qUrLmos3BlrZt5zJ96R-AEOC1qADN9vpifukQxd8OILck0rs3UlQHUtsfu8e', NULL, '2020-04-06 03:38:09', '2020-04-07 09:39:32'),
(29, 79, 'Android', 'eS2kLzizdrQ:APA91bGBQuXlYEtEkV3IWs9CTf0kxu1G091oD1TObhTPnuSKa96a15jWG_Sy4lCGiHvUX6oAFIrp81Udmm41xrrhXnm1vhM8mdkrHvJULSXurvXoASF9Sh7O4XHuFbcQgfYEx1198DTE', NULL, '2020-04-21 04:05:44', '2020-05-29 05:48:24'),
(30, 78, 'Android', 'ddTgRVanzKI:APA91bEbnsc3U93pA0BeOgsYt1M2ss78VDPE68LvkELOmzsIaIEVhV9PtBO4TxJDng6sZw-OeNO_WpzrpSjnjprVpbrUpwDrccCySnCP4Nvn5iohU4ouVBM0yFc2OsxYgorK31IYoCtt', NULL, '2020-04-23 05:36:18', '2020-05-04 03:45:14'),
(31, 79, 'iOS', NULL, NULL, '2020-04-27 09:31:23', '2020-05-30 21:33:33'),
(32, 85, 'Android', 'cN6VeAtMLgc:APA91bGcK4W2y3vCcAdNw60I9LBJPIi0cU80H1adbQw8kp4G5sA_QWw7Ny3rO5CenOx4pxOR7F7XDAM58nZ49dFUSYP9M212CqKMq8BvimYTMZn0JLRS8n-6iXa_NhatHh9DYvNoLQTk', NULL, '2020-05-04 06:03:52', '2020-05-07 16:16:00'),
(33, 75, 'iOS', NULL, NULL, '2020-06-27 07:13:22', '2020-08-18 03:13:29'),
(34, 87, 'Android', 'cK_vFhRRVMU:APA91bH4gf0vhMoZgMuyHyRqA15Gt9zu_YdCwNNLxJctcmyxa_BHIpz_0qZOAXnA8fpfC2_6r_6x322dVuL_ubh6QyOc57QIgZ8rIjZqnmTxtMfD8ASH2Ao42y4yrwZQdjPvPkbG467U', NULL, '2020-08-09 06:03:50', '2020-08-10 06:30:13'),
(35, 88, 'Android', 'f4Iyo8RU5_U:APA91bGRVoXIaTUxQQSAYPCg5tMHCeFuElf6mqhubHfaM7fzoF8WQfdebNc0osrOE7DrmTLXnIEgEcb3minm1cyHmxbsAMUsdFpqj3SS0I2xG03O-CyBTtlU5s3eq_Xg0dbCx5Gz6ui5', NULL, '2020-08-10 06:29:40', '2022-06-21 20:54:39'),
(36, 74, 'Android', 'cUfqK3anHEg:APA91bE7X-TdcN3jPxQxDIMrnqZOJ2jjWLyq6mXWIF9QDp5n9OoNjHV_mFri28dk9f4j-1gRSqvaCgDVonrJwt97SCHsveegkP6o6xYLXLpmoRIbTytOmjM2JfS8OHcqVLOfcWzVJRym', NULL, '2020-08-24 03:57:50', '2022-07-05 08:03:00'),
(37, 90, 'Android', 'dMG10IdYrA8:APA91bFVDCPAixQrO5qF8iLgSG-emC08ujMoauWEZLJPPN3KoNpPsaB8IK0i7ZK7L9sYa-SEl8XOeHS5VC28ab8hU3Hzc4OHFgd45JSmukHVnTPCFjhhlQzO8qvHQ4JVcNgKyR3r92OA', NULL, '2020-08-24 23:24:05', '2020-09-21 07:30:11'),
(38, 143, 'Android', NULL, NULL, '2020-11-13 00:35:34', '2020-11-13 00:35:34'),
(39, 144, 'Android', NULL, NULL, '2020-11-13 00:42:00', '2020-11-13 00:42:00'),
(40, 70, 'iOS', NULL, NULL, '2021-03-17 03:53:23', '2021-10-13 06:36:00'),
(41, 157, 'Android', 'elYUAbhHJE8:APA91bH-nP3kANOsbgD-wjOI8hsUYWsuw5zEXZaY_GFCPsTdyfJu7Ox3hNugm3C8Y5dYT7_6YukeGkPezn5zmsYf8GPFkSatNcJPV1V1hnsqAblFe6GVY1zjIgpoLc2NX-UxT1cdSWCC', NULL, '2021-06-21 11:04:34', '2021-06-21 11:04:34'),
(42, 161, 'Android', 'cUfqK3anHEg:APA91bE7X-TdcN3jPxQxDIMrnqZOJ2jjWLyq6mXWIF9QDp5n9OoNjHV_mFri28dk9f4j-1gRSqvaCgDVonrJwt97SCHsveegkP6o6xYLXLpmoRIbTytOmjM2JfS8OHcqVLOfcWzVJRym', NULL, '2021-09-16 06:34:42', '2021-10-13 06:26:33'),
(43, 182, 'iOS', 'fQ43pX8RS0SQtP1LSfkTXO:APA91bGP5XRuN7glxjGsuw4cA_6l9dF3_E6TvKFZwLxWhZAC1qituZkogQuCruPSn16fYX1sm6Ug3h7y9tGX49zBBs-C7PkJP5NEfIGZGPvzdNvE_v7iYAjVEM60RpSLwtS1oA41onL_', NULL, '2021-10-26 07:21:41', '2021-10-26 07:41:29'),
(44, 191, 'Android', 'fgT5oo1wHnI:APA91bFn50B5R4-wqsm9T1GvrXgmF5ORHjpfTtfXWfUF87GoVWz8IA4xDqVBKLbezF3_x1VSLxekwCQjVchBoxuCoTdFMHI9LqrJYdIB10Ui2CVC7RQfDNFOCCzZGSG5t73Yl14Kjb7k', NULL, '2022-04-18 10:33:09', '2022-06-26 19:45:38'),
(45, 194, 'Android', 'ejoz8OAbYM0:APA91bE4Ho-KlgP7892z1EtSUnbXd8NAKCXcCP52c0HlC0LyW1BD7ursR4uZBAwLEyrJzxC3r40o-6xdgwDfcMS4fX0h_Yu289_IOhYbapO_epH4_Eh1fTL_1o7oeKSDCRTtTwPgibA1', NULL, '2022-06-07 23:35:46', '2022-06-10 01:01:21'),
(46, 231, 'mobile', 'e5Vrd3BXSkmjQdZBALyY0O:APA91bEp0H2wodMfozYbld1vfkTGAfmSswMzp66wY3V4kc9nVQ1Ei8-bmEqc2ZGBu6v0AJzsqnCmGYu_DNqTJ-JtHZBUREm0TekWKsEYgkwrkv6LTVX-Bx2zNJ_PA0ZEgIMXBP0Il-NI', NULL, '2022-09-07 18:54:32', '2022-09-12 15:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('09a99e5996921f001a5c8ab11eda6bba8e91e8021cb64d3ea0a15f20a6caa29ffbfdf9d94c2cf315', 245, 3, 'AppName', '[]', 0, '2022-08-30 22:21:05', '2022-08-30 22:21:05', '2023-08-30 15:21:05'),
('209716e7ea2b9534f14cc318b913ab06825dce1b6a855b6ac8c103ecd878748c555d0b3ad0999679', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:10:59', '2022-08-25 19:10:59', '2023-08-25 12:10:59'),
('25b0665d137c4b101476774a1ed4c2e79fabdb5a16a4e0f77af22d3609237c1e4e0ec2c9ecbbc2bb', 70, 3, 'AppName', '[]', 0, '2022-08-23 23:40:59', '2022-08-23 23:40:59', '2023-08-23 16:40:59'),
('294d74d333f087af63922d8d13e8107f98f18a16ac03fb58ed09992658857f859bd972f3843d0e0f', 226, 3, 'AppName', '[]', 0, '2022-08-25 17:58:04', '2022-08-25 17:58:04', '2023-08-25 10:58:04'),
('31469a2c2f46090aa6037251778d053eb6f0ded4d61a0bc9abdad1446879e9160fed6f7174839779', 161, 1, 'AppName', '[]', 0, '2022-08-17 16:37:34', '2022-08-17 16:37:34', '2023-08-17 09:37:34'),
('3206d4a27b383b3e9ab3522daa85305189cb6ef921999c805571290158a0f0c2d1473673c3a8b1ba', 204, 3, 'AppName', '[]', 0, '2022-09-06 20:20:31', '2022-09-06 20:20:31', '2023-09-06 13:20:31'),
('347d288154f60fae310849141c27a0a6b3e72093f52d78cbd149286eaeef7a02151c1c3011f8c179', 70, 1, 'AppName', '[]', 0, '2022-08-16 22:03:58', '2022-08-16 22:03:58', '2023-08-16 15:03:58'),
('36cf5740a52d7b75ddba4ab7765847fedf4ea83c3662b2aaa3f5e78bbc4369bd294a1431aab590e0', 245, 3, 'AppName', '[]', 0, '2022-08-30 21:15:33', '2022-08-30 21:15:33', '2023-08-30 14:15:33'),
('36ead0a2271bf4e63886b6e73837f99f15166797f327f2aa59ae04da9b915f7a07abc3ce6afd53bd', 231, 3, 'AppName', '[]', 0, '2022-08-31 17:28:52', '2022-08-31 17:28:52', '2023-08-31 10:28:52'),
('383584821098bde54521b850f620996fb18351126f0c484a509603b5dc10b16af55a768d8dce9a1e', 204, 3, 'AppName', '[]', 0, '2022-09-01 20:48:40', '2022-09-01 20:48:40', '2023-09-01 13:48:40'),
('3d94a2b4b1f178c131babe2862d083c9a12df23cf1869e0e6ee90af79b49b0ed994f5a72c4968b23', 70, 1, 'AppName', '[]', 0, '2022-08-16 22:57:25', '2022-08-16 22:57:25', '2023-08-16 15:57:25'),
('41cad499bd5c77d3c97b5379703de0e442d596799ffccbdaa620c4a7bfd7d9a97a75d89b42d7309f', 161, 1, 'AppName', '[]', 0, '2022-08-18 18:11:49', '2022-08-18 18:11:49', '2023-08-18 11:11:49'),
('41d67a9685fe6b650f21bd19c85d5de5714212ff71e910c017b50e4d6993c2b62fde44ed94dbab62', 70, 1, 'AppName', '[]', 0, '2022-08-18 16:37:04', '2022-08-18 16:37:04', '2023-08-18 09:37:04'),
('437feb84d7057d08747d034c0b4d5b50f634a88198d2070dd30cde7d4f2915588551319614e85506', 70, 1, 'AppName', '[]', 0, '2022-08-18 01:58:55', '2022-08-18 01:58:55', '2023-08-17 18:58:55'),
('463be1005008419dad05e0ce6569134275df0423f95b0c4bc461b7fea2baec419f544be2cebd3ead', 202, 1, 'AppName', '[]', 0, '2022-08-10 22:39:41', '2022-08-10 22:39:41', '2023-08-10 15:39:41'),
('4c86d7ae026f25de60dd7b01f0883dd5047279aac22900c954610507e0fb16216aca14dbcae8811a', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:05:09', '2022-08-25 19:05:09', '2023-08-25 12:05:09'),
('4cffd1f14b88aeb90cc6085c217df8f4f5cdc5b58b4081297beafa83394f161a71ed5723c972787a', 204, 1, 'AppName', '[]', 0, '2022-08-14 16:54:18', '2022-08-14 16:54:18', '2023-08-14 09:54:18'),
('53b7a1df8051a3ac0b0432f2e557f23d0ae1f0c5a03596afa721b69214b7e59549c1690fce070f05', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:07:22', '2022-08-25 19:07:22', '2023-08-25 12:07:22'),
('587d228b0c3040c23b757d0dc8a00d98abc871f80f05118fd784084bc67328ede68d95693fe3ca82', 70, 1, 'AppName', '[]', 0, '2022-08-18 01:57:18', '2022-08-18 01:57:18', '2023-08-17 18:57:18'),
('5c1d3c65dd7dc5162b52fc3ae42be42eb532d13d12d3a71f1c62381fd7080ea3213603178455fe25', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:06:06', '2022-08-25 19:06:06', '2023-08-25 12:06:06'),
('5c6ed36618bcfb3239ec96cf6ab547717d69dd5b9d3524cac2adb055bff3e1c60a6760b02a10a870', 161, 1, 'AppName', '[]', 0, '2022-08-18 00:35:49', '2022-08-18 00:35:49', '2023-08-17 17:35:49'),
('65a5acdc83c3e935849b74939510f58dda9224c91768a420371a433ec6c9761c4715e4ba9c6e4d93', 70, 1, 'AppName', '[]', 0, '2022-08-17 16:55:18', '2022-08-17 16:55:18', '2023-08-17 09:55:18'),
('6d1db8c593490739e0a6d7b41f358e2acd0d3d3f027ac1b65ef1454d027bb335030e6b300357d7f7', 161, 1, 'AppName', '[]', 0, '2022-08-10 20:18:57', '2022-08-10 20:18:57', '2023-08-10 13:18:57'),
('785a1bdfddd19274e6fcd7016df6f6f4b06ec80b99e136490481d39cae54992ba47045efda0ebb1a', 204, 1, 'AppName', '[]', 0, '2022-08-14 23:16:31', '2022-08-14 23:16:31', '2023-08-14 16:16:31'),
('805282b48ccc3ccda2cfc8d2cd26f135885f291354f7b0ac2231f3abe252c81e6dbf8e8b7052f379', 226, 3, 'AppName', '[]', 0, '2022-08-24 21:50:58', '2022-08-24 21:50:58', '2023-08-24 14:50:58'),
('81814d02ae4732b633e111bbc12e9174af944175d2be3a34daa0e49853843825a20ad877e652f674', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:08:21', '2022-08-25 19:08:21', '2023-08-25 12:08:21'),
('8b1cb84610f606050593aa8fb4e7dcf76f0355a007d60fbc6102492ace0a6e3c64cad2cb8026245d', 204, 1, 'AppName', '[]', 0, '2022-08-14 16:53:04', '2022-08-14 16:53:04', '2023-08-14 09:53:04'),
('8c2bff9fc4da47cc34afe333caabfd14cd9521675fa056bb3797a2c837334ea0f59bc3838fcd284a', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:03:33', '2022-08-25 19:03:33', '2023-08-25 12:03:33'),
('90eaacce8f045b47c5c1c00aec52e8dabae5e6c42fd97e79bfed4a494d6fd9603c169c2e1b0ab8d6', 231, 3, 'AppName', '[]', 0, '2022-08-29 20:23:35', '2022-08-29 20:23:35', '2023-08-29 13:23:35'),
('9143c5bcd026b0c69df8c02275865e3a796e509a11e9f5b2e5605bbc23e240306ab5428028108655', 161, 1, 'AppName', '[]', 0, '2022-08-16 15:17:23', '2022-08-16 15:17:23', '2023-08-16 08:17:23'),
('970203d41c81462916555615287a53f589ed9dcfe85596e0e51e3f699991e56f940a4f48bd0d7f55', 226, 3, 'AppName', '[]', 0, '2022-08-22 19:31:54', '2022-08-22 19:31:54', '2023-08-22 12:31:54'),
('976f8a85b6404a594b991184fc5f66a03970ea6922d139013086d091ed22ae0ea876b6b44d127e6a', 231, 3, 'AppName', '[]', 0, '2022-08-27 18:05:27', '2022-08-27 18:05:27', '2023-08-27 11:05:27'),
('a4d09c013b8a3a190946749a236d0e54cdac436cff03dce8908830af12a3dbacadcf362a1e69d24c', 70, 1, 'AppName', '[]', 0, '2022-08-17 18:15:30', '2022-08-17 18:15:30', '2023-08-17 11:15:30'),
('a769d84c1a6855c4ac2c79a6fe0afe7fed6aa174cc48884e946aad91585526e0bb3dd33d2506f591', 204, 1, 'AppName', '[]', 0, '2022-08-13 20:49:27', '2022-08-13 20:49:27', '2023-08-13 13:49:27'),
('a96171f0df37fc0ee720a517ce45abe3b4513df59e4825a18cb92807a875cdf8abb0e90f3ac75149', 234, 3, 'AppName', '[]', 0, '2022-08-29 19:20:39', '2022-08-29 19:20:39', '2023-08-29 12:20:39'),
('a9d45c7235cf97ec1179a2debb83aa67368f216fc377e2c5c7a99c9bdf353a3fbc10f29906875d4f', 161, 3, 'AppName', '[]', 0, '2022-08-24 21:16:28', '2022-08-24 21:16:28', '2023-08-24 14:16:28'),
('a9ebd5db37601efeb22f1478b109a500e9eaa1b4081f9420754f3273347b21751ab4a9d79c241b29', 70, 3, 'AppName', '[]', 0, '2022-08-24 15:10:53', '2022-08-24 15:10:53', '2023-08-24 08:10:53'),
('aae28bfacd21bbfe8ad19fcfe9005c48fb97d58e32049ea0289533e84055d2fce580d1b6e3b3f6f0', 161, 1, 'AppName', '[]', 0, '2022-08-18 00:41:38', '2022-08-18 00:41:38', '2023-08-17 17:41:38'),
('b520f1cd4a65a81740246768e2207c46a8898e22ac2d702a161affaf0c6a5ace8792e22822bffded', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:23:11', '2022-08-25 19:23:11', '2023-08-25 12:23:11'),
('b74417cbe1edd4df76a620e9889e4b5b131d1d4e231f76fe2f20a7db53af893e79b2c7a4fcd361f1', 241, 3, 'AppName', '[]', 0, '2022-08-30 16:09:59', '2022-08-30 16:09:59', '2023-08-30 09:09:59'),
('bda792c01a212a6eeae16e2c30aa43adb2ac16a2e161625a2ab7e4628e676a75e2e566c7e0dbf687', 161, 1, 'AppName', '[]', 0, '2022-08-11 16:26:52', '2022-08-11 16:26:52', '2023-08-11 09:26:52'),
('bf8527c50c811d9ceff354b0860dcacf953c3e3f12ebb554897772eb51cbc4840c069ae1f9c274de', 231, 3, 'AppName', '[]', 0, '2022-08-31 17:27:14', '2022-08-31 17:27:14', '2023-08-31 10:27:14'),
('c389b2a507ce4033d78251a7e3caf33426ab64a4f64ea73a3d4b9013c44980540e231e309b980c30', 226, 3, 'AppName', '[]', 0, '2022-08-25 19:06:48', '2022-08-25 19:06:48', '2023-08-25 12:06:48'),
('cca5eecda713a48f21d8682b214133c92c8fea3a54de0566373c8385c9835eaa81eb593c6c50723e', 70, 1, 'AppName', '[]', 0, '2022-08-17 16:14:08', '2022-08-17 16:14:08', '2023-08-17 09:14:08'),
('cd4d55b51f4a1c77ce714716e4aa54a1ee56684c71f3464b7b8d3bc30b010d306307df777e7e7915', 201, 1, 'AppName', '[]', 0, '2022-08-10 22:38:24', '2022-08-10 22:38:24', '2023-08-10 15:38:24'),
('d0906302f01def3549198c2811dc259df0ef6e6e44a274597de5729e0e92cab0796c4de5ee4f880e', 70, 1, 'AppName', '[]', 0, '2022-08-13 20:37:39', '2022-08-13 20:37:39', '2023-08-13 13:37:39'),
('e3025a5e8657d810b2ac52a330b2af2c977375bc9d96625ab47ea8f064828317c02c446b70cf9ad3', 161, 3, 'AppName', '[]', 0, '2022-08-29 19:20:43', '2022-08-29 19:20:43', '2023-08-29 12:20:43'),
('e639dda0151cac9d667a4ca4fa7b7972320b056b1800bcba1b05c8402c4ea1686ef2247cf62c3608', 161, 3, 'AppName', '[]', 0, '2022-08-24 16:50:17', '2022-08-24 16:50:17', '2023-08-24 09:50:17'),
('e8bcfb290902e43f0710c67a6d7ac7f7f13886694d3280cabe36798c0ca36858b6f578e16694d8e3', 161, 1, 'AppName', '[]', 0, '2022-08-15 14:54:28', '2022-08-15 14:54:28', '2023-08-15 07:54:28'),
('fcea1f791b1d20ed933c40ad512fba1f79534694f81ea926c85f32f7247335ba6cfe0420a8143a24', 70, 3, 'AppName', '[]', 0, '2022-08-22 14:53:07', '2022-08-22 14:53:07', '2023-08-22 07:53:07'),
('fd17e9495f6a8bf5deca579da45134739a7a7aca07f0af90ee3a2aa467173f03ab42b88fde8fadc9', 161, 1, 'AppName', '[]', 0, '2022-08-17 20:32:39', '2022-08-17 20:32:39', '2023-08-17 13:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'KOP Personal Access Client', 'EqrWl5wrwwQ0PKOESq9i53BzOwtd4JowA0gdL7av', 'http://localhost', 1, 0, 0, '2022-08-10 20:18:53', '2022-08-10 20:18:53'),
(2, NULL, 'KOP Password Grant Client', 'hIH256SSkQlcUO0g2KQwIOs8OoYKTXf1KIT1TQZC', 'http://localhost', 0, 1, 0, '2022-08-10 20:18:53', '2022-08-10 20:18:53'),
(3, NULL, 'KOP Personal Access Client', 'un8i3Q3OEDZ9FjFSJbIegP1Ep7zSGYyi8PRRfmB4', 'http://localhost', 1, 0, 0, '2022-08-22 14:52:57', '2022-08-22 14:52:57'),
(4, NULL, 'KOP Password Grant Client', '0t2iqzJwanaZAugJVQxXDI3AkylcYlTOMlTUWDrj', 'http://localhost', 0, 1, 0, '2022-08-22 14:52:57', '2022-08-22 14:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-08-10 20:18:53', '2022-08-10 20:18:53'),
(2, 3, '2022-08-22 14:52:57', '2022-08-22 14:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_type` enum('takeaway','delivery') COLLATE utf8_unicode_ci NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `offer_type` enum('buy-get','discount') COLLATE utf8_unicode_ci NOT NULL,
  `title_ar` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_ar` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `main` tinyint(1) NOT NULL,
  `website_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website_image_menu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `service_type`, `date_from`, `date_to`, `description`, `image`, `offer_type`, `title_ar`, `description_ar`, `deleted_at`, `created_at`, `updated_at`, `created_by`, `updated_by`, `main`, `website_image`, `website_image_menu`) VALUES
(1, 'pizza offer', 'delivery', '2022-09-05 14:00:00', '2022-09-30 14:00:00', 'pizza offer', '/offers/1662478617banner03.jpg', 'discount', 'pizza offer', 'pizza offer', NULL, '2022-09-06 19:01:51', '2022-09-06 22:36:57', 93, 93, 1, '/offers/1662465711about01.png', '/offers/1662465711food06.png'),
(2, 'zataar offer takeaway', 'takeaway', '2022-09-04 14:02:00', '2022-09-29 14:02:00', 'zataar offer takeaway', '/offers/1662478603banner02.jpg', 'discount', 'pizza offer takeaway', 'zataar offer takeaway', NULL, '2022-09-06 19:03:17', '2022-09-06 22:36:43', 93, 93, 1, '/offers/1662465797about01.png', '/offers/1662465797food02.png'),
(3, 'buy&get', 'takeaway', '2022-09-04 14:04:00', '2022-09-30 14:04:00', 'buy&get', '/offers/1662478588banner01.jpg', 'buy-get', 'أشتر وأحصل', 'اشتر وأحصل', NULL, '2022-09-06 19:05:14', '2022-09-08 19:06:36', 93, 93, 1, '/offers/1662465914about01.png', '/offers/1662465914food06.png');

-- --------------------------------------------------------

--
-- Table structure for table `offers_buy_get`
--

CREATE TABLE `offers_buy_get` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `buy_quantity` int(11) NOT NULL,
  `buy_category_id` bigint(20) UNSIGNED NOT NULL,
  `get_quantity` int(11) NOT NULL,
  `get_category_id` bigint(20) UNSIGNED NOT NULL,
  `offer_price` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `offers_buy_get`
--

INSERT INTO `offers_buy_get` (`id`, `offer_id`, `buy_quantity`, `buy_category_id`, `get_quantity`, `get_category_id`, `offer_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 6, 1, 6, 100, NULL, '2022-09-06 19:05:14', '2022-09-06 19:05:14'),
(2, 3, 1, 2, 1, 6, 100, NULL, '2022-09-06 19:05:49', '2022-09-06 19:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `offers_discount`
--

CREATE TABLE `offers_discount` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount_value` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `offers_discount`
--

INSERT INTO `offers_discount` (`id`, `offer_id`, `quantity`, `category_id`, `discount_type`, `discount_value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 13, 1, 50, NULL, '2022-09-06 19:01:51', '2022-09-06 19:01:51'),
(2, 2, 1, 2, 1, 50, NULL, '2022-09-06 19:03:17', '2022-09-06 19:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `offer_buy_items`
--

CREATE TABLE `offer_buy_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `offer_buy_items`
--

INSERT INTO `offer_buy_items` (`id`, `offer_id`, `item_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 1, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offer_discount_items`
--

CREATE TABLE `offer_discount_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `offer_discount_items`
--

INSERT INTO `offer_discount_items` (`id`, `offer_id`, `item_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 78, NULL, NULL, NULL),
(2, 1, 79, NULL, NULL, NULL),
(3, 1, 80, NULL, NULL, NULL),
(4, 1, 81, NULL, NULL, NULL),
(5, 1, 82, NULL, NULL, NULL),
(6, 1, 83, NULL, NULL, NULL),
(7, 1, 84, NULL, NULL, NULL),
(8, 1, 85, NULL, NULL, NULL),
(9, 1, 86, NULL, NULL, NULL),
(10, 1, 87, NULL, NULL, NULL),
(11, 1, 88, NULL, NULL, NULL),
(12, 1, 89, NULL, NULL, NULL),
(13, 1, 90, NULL, NULL, NULL),
(14, 1, 91, NULL, NULL, NULL),
(15, 1, 92, NULL, NULL, NULL),
(16, 1, 93, NULL, NULL, NULL),
(17, 1, 94, NULL, NULL, NULL),
(18, 1, 95, NULL, NULL, NULL),
(19, 1, 96, NULL, NULL, NULL),
(20, 1, 97, NULL, NULL, NULL),
(21, 2, 2, NULL, NULL, NULL),
(22, 2, 3, NULL, NULL, NULL),
(23, 2, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offer_get_items`
--

CREATE TABLE `offer_get_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `offer_get_items`
--

INSERT INTO `offer_get_items` (`id`, `offer_id`, `item_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, NULL, NULL),
(2, 1, 6, NULL, NULL, NULL),
(3, 1, 7, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `service_type` enum('takeaway','delivery') COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` double NOT NULL,
  `taxes` double NOT NULL,
  `delivery_fees` double DEFAULT NULL,
  `total` double NOT NULL,
  `cancellation_reason` text COLLATE utf8_unicode_ci,
  `state` enum('pending','rejected','in-progress','completed','canceled','on-way') COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `points_paid` int(11) NOT NULL DEFAULT '0',
  `offer_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `offer_value` int(11) DEFAULT NULL,
  `payment_type` enum('online','cash') COLLATE utf8_unicode_ci NOT NULL,
  `description_box` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `branch_id`, `service_type`, `subtotal`, `taxes`, `delivery_fees`, `total`, `cancellation_reason`, `state`, `points`, `deleted_at`, `created_at`, `updated_at`, `created_by`, `updated_by`, `address_id`, `points_paid`, `offer_type`, `order_from`, `offer_value`, `payment_type`, `description_box`) VALUES
(37, 231, 16, 'takeaway', 13, 1.9499999999999993, 0, 14.95, NULL, 'pending', NULL, NULL, '2022-09-06 13:47:37', '2022-09-06 13:47:37', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(38, 231, 16, 'takeaway', 48, 7.200000000000003, 0, 55.2, NULL, 'pending', NULL, NULL, '2022-09-06 13:48:14', '2022-09-06 13:48:14', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(39, 231, 16, 'takeaway', 55, 8.25, 0, 63.25, NULL, 'pending', NULL, NULL, '2022-09-06 13:50:07', '2022-09-06 13:50:07', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(40, 231, 16, 'takeaway', 55, 8.25, 0, 63.25, NULL, 'pending', NULL, NULL, '2022-09-06 13:50:12', '2022-09-06 13:50:12', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(41, 70, 16, 'delivery', 35, 10, 5, 20, NULL, 'pending', NULL, NULL, '2022-09-06 14:40:33', '2022-09-06 14:40:33', NULL, NULL, 39, 20, NULL, 'mobile', 0, 'online', NULL),
(42, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 113.85, NULL, 'pending', NULL, NULL, '2022-09-06 16:05:36', '2022-09-06 16:05:36', NULL, NULL, NULL, 200, NULL, 'mobile', 0, 'cash', NULL),
(43, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 113.85, NULL, 'pending', NULL, NULL, '2022-09-06 16:11:41', '2022-09-06 16:11:41', NULL, NULL, NULL, 200, NULL, 'mobile', 0, 'cash', NULL),
(44, 231, 16, 'takeaway', 36, 5.399999999999999, 0, 41.4, NULL, 'pending', NULL, NULL, '2022-09-06 16:14:27', '2022-09-06 16:14:27', NULL, NULL, NULL, 200, NULL, 'mobile', 0, 'cash', NULL),
(45, 231, 16, 'takeaway', 36, 5.399999999999999, 0, 0, NULL, 'pending', NULL, NULL, '2022-09-06 16:26:07', '2022-09-06 16:26:07', NULL, NULL, NULL, 200, NULL, 'mobile', 0, 'cash', NULL),
(46, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 28.75, NULL, 'pending', NULL, NULL, '2022-09-06 16:27:56', '2022-09-06 16:27:56', NULL, NULL, NULL, 200, NULL, 'mobile', 0, 'cash', NULL),
(47, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 28.75, NULL, 'pending', NULL, NULL, '2022-09-06 16:28:36', '2022-09-06 16:28:36', NULL, NULL, NULL, 200, NULL, 'mobile', 0, 'cash', NULL),
(48, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 28.75, NULL, 'pending', NULL, NULL, '2022-09-06 16:34:59', '2022-09-06 16:34:59', NULL, NULL, NULL, 200, NULL, 'mobile', 0, 'cash', NULL),
(49, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 28.75, NULL, 'pending', NULL, NULL, '2022-09-06 16:44:07', '2022-09-06 16:44:07', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(50, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 28.75, NULL, 'pending', NULL, NULL, '2022-09-06 16:45:49', '2022-09-06 16:45:49', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(51, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 28.75, NULL, 'pending', NULL, NULL, '2022-09-06 16:47:18', '2022-09-06 16:47:18', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(52, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 71.3, NULL, 'pending', NULL, NULL, '2022-09-06 16:48:03', '2022-09-06 16:48:03', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(53, 231, 16, 'takeaway', 99, 14.849999999999994, 0, 113.85, NULL, 'pending', NULL, NULL, '2022-09-06 17:04:18', '2022-09-06 17:04:18', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(54, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', NULL, NULL, '2022-09-06 17:05:42', '2022-09-06 17:05:42', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(55, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 21:24:57', '2022-09-06 21:24:57', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(56, 231, 16, 'takeaway', 38, 5.700000000000003, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 21:37:19', '2022-09-06 21:37:19', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(57, 231, 16, 'takeaway', 86.27, 12.930000000000007, 0, 79.2, NULL, 'pending', 20, NULL, '2022-09-06 21:39:16', '2022-09-06 21:39:16', NULL, NULL, NULL, 100, NULL, 'mobile', 0, 'cash', NULL),
(58, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 22:55:40', '2022-09-06 22:55:40', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(59, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 22:56:57', '2022-09-06 22:56:57', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(60, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 22:58:34', '2022-09-06 22:58:34', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(61, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 22:59:51', '2022-09-06 22:59:51', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(62, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 23:01:04', '2022-09-06 23:01:04', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(63, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 23:03:54', '2022-09-06 23:03:54', NULL, NULL, NULL, 0, NULL, 'mobile', 1, 'cash', NULL),
(64, 231, 16, 'takeaway', 114.36, 17.14, 0, 81.5, NULL, 'pending', 50, NULL, '2022-09-06 23:20:45', '2022-09-06 23:20:45', NULL, NULL, NULL, 200, NULL, 'mobile', 1, 'cash', NULL),
(65, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 23:40:52', '2022-09-06 23:40:52', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(66, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 23:46:17', '2022-09-06 23:46:17', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(67, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-06 23:46:53', '2022-09-06 23:46:53', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(68, 231, 16, 'takeaway', 4, 0.5999999999999996, 0, 4.6, NULL, 'pending', 0, NULL, '2022-09-06 23:47:22', '2022-09-06 23:47:22', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(69, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-06 23:57:48', '2022-09-06 23:57:48', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(70, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-06 23:59:20', '2022-09-06 23:59:20', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(71, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:03:49', '2022-09-07 00:03:49', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(72, 231, 16, 'takeaway', 4, 0.5999999999999996, 0, 4.6, NULL, 'pending', 0, NULL, '2022-09-07 00:08:30', '2022-09-07 00:08:30', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(73, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:21:36', '2022-09-07 00:21:36', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(74, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:22:26', '2022-09-07 00:22:26', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(75, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:23:51', '2022-09-07 00:23:51', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(76, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 00:24:39', '2022-09-07 00:24:39', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(77, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 00:26:33', '2022-09-07 00:26:33', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(78, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:26:58', '2022-09-07 00:26:58', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(79, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 00:28:43', '2022-09-07 00:28:43', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(80, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:29:05', '2022-09-07 00:29:05', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(81, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:32:08', '2022-09-07 00:32:08', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(82, 231, 16, 'takeaway', 6, 0.9000000000000004, 0, 6.9, NULL, 'pending', 0, NULL, '2022-09-07 00:32:29', '2022-09-07 00:32:29', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(83, 231, 16, 'takeaway', 6, 0.9000000000000004, 0, 6.9, NULL, 'pending', 0, NULL, '2022-09-07 00:36:45', '2022-09-07 00:36:45', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(84, 231, 16, 'takeaway', 32, 4.799999999999997, 0, 36.8, NULL, 'pending', 0, NULL, '2022-09-07 00:38:39', '2022-09-07 00:38:39', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(85, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 00:39:02', '2022-09-07 00:39:02', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(86, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:41:04', '2022-09-07 00:41:04', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(87, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 00:51:34', '2022-09-07 00:51:34', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(88, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:52:06', '2022-09-07 00:52:06', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(89, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 00:52:34', '2022-09-07 00:52:34', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(90, 231, 16, 'takeaway', 4, 0.5999999999999996, 0, 4.6, NULL, 'pending', 0, NULL, '2022-09-07 00:52:58', '2022-09-07 00:52:58', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(91, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 00:54:05', '2022-09-07 00:54:05', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(92, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 00:54:23', '2022-09-07 00:54:23', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(93, 231, 16, 'takeaway', 4, 0.5999999999999996, 0, 4.6, NULL, 'pending', 0, NULL, '2022-09-07 00:54:48', '2022-09-07 00:54:48', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(94, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 01:20:08', '2022-09-07 01:20:08', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(95, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 01:40:51', '2022-09-07 01:40:51', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(96, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 01:42:33', '2022-09-07 01:42:33', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(97, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 01:42:52', '2022-09-07 01:42:52', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(98, 231, 16, 'takeaway', 6, 0.9000000000000004, 0, 6.9, NULL, 'pending', 0, NULL, '2022-09-07 01:43:12', '2022-09-07 01:43:12', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(99, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 02:06:27', '2022-09-07 02:06:27', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(100, 231, 16, 'takeaway', 23, 3.4499999999999993, 0, 26.45, NULL, 'pending', NULL, NULL, '2022-09-07 14:57:48', '2022-09-07 14:57:48', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(101, 231, 16, 'takeaway', 7, 1.0500000000000007, 0, 8.05, NULL, 'pending', NULL, NULL, '2022-09-07 14:59:08', '2022-09-07 14:59:08', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(102, 231, 16, 'takeaway', 20, 3, 0, 23, NULL, 'pending', NULL, NULL, '2022-09-07 15:06:18', '2022-09-07 15:06:18', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(103, 231, 16, 'takeaway', 14, 2.1000000000000014, 0, 16.1, NULL, 'pending', 0, NULL, '2022-09-07 15:58:58', '2022-09-07 15:58:58', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(104, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', NULL, NULL, '2022-09-07 16:22:13', '2022-09-07 16:22:13', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(105, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 16:26:37', '2022-09-07 16:26:37', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(106, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 16:26:53', '2022-09-07 16:26:53', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(107, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 16:30:25', '2022-09-07 16:30:25', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(108, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 16:30:53', '2022-09-07 16:30:53', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(109, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 16:45:39', '2022-09-07 16:45:39', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(110, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 16:46:08', '2022-09-07 16:46:08', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(111, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, NULL, 'pending', 0, NULL, '2022-09-07 16:47:47', '2022-09-07 16:47:47', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(112, 231, 16, 'takeaway', 32, 4.799999999999997, 0, 36.8, NULL, 'pending', 0, NULL, '2022-09-07 16:48:14', '2022-09-07 16:48:14', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(113, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 16:53:09', '2022-09-07 16:53:09', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(114, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 17:00:34', '2022-09-07 17:00:34', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(115, 231, 16, 'takeaway', 4, 0.5999999999999996, 0, 4.6, NULL, 'completed', 0, NULL, '2022-09-07 17:07:06', '2022-09-07 19:42:01', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(116, 231, 16, 'takeaway', 16, 2.3999999999999986, 0, 18.4, 'ككك', 'rejected', 0, NULL, '2022-09-07 17:07:40', '2022-09-07 19:37:01', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(117, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, 'ا', 'canceled', 0, NULL, '2022-09-07 17:14:20', '2022-09-07 19:36:39', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(118, 231, 16, 'takeaway', 56.18, 8.419999999999995, 0, 70.35, NULL, 'completed', 0, NULL, '2022-09-07 17:36:30', '2022-09-07 19:36:09', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(119, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 22:45:11', '2022-09-07 22:45:11', NULL, NULL, NULL, 500, NULL, 'mobile', 0, 'cash', NULL),
(120, 231, 16, 'takeaway', 66.89999999999999, 10.04, 0, 76.94, NULL, 'pending', NULL, NULL, '2022-09-07 23:28:15', '2022-09-07 23:28:15', NULL, NULL, NULL, 0, NULL, 'mobile', NULL, '', NULL),
(121, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', 0, NULL, '2022-09-07 23:38:20', '2022-09-07 23:38:20', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', '2tiu2t2tuit225ii2'),
(122, 231, 17, 'takeaway', 28.09, 4.209999999999997, 0, 32.3, NULL, 'pending', 0, NULL, '2022-09-07 23:45:33', '2022-09-07 23:45:33', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(123, 231, 16, 'takeaway', 66.89999999999999, 10.04, 0, 76.94, NULL, 'pending', NULL, NULL, '2022-09-07 23:58:56', '2022-09-07 23:58:56', NULL, NULL, NULL, 0, NULL, 'mobile', NULL, '', NULL),
(124, 231, 16, 'takeaway', 66.89999999999999, 10.04, 0, 76.94, NULL, 'pending', NULL, NULL, '2022-09-08 00:00:30', '2022-09-08 00:00:30', NULL, NULL, NULL, 0, NULL, 'mobile', NULL, '', NULL),
(125, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'completed', 0, NULL, '2022-09-08 00:01:47', '2022-09-08 00:02:19', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(126, 231, 16, 'takeaway', 2.3, 0.35, 0, 2.65, NULL, 'pending', NULL, NULL, '2022-09-08 00:02:51', '2022-09-08 00:02:51', NULL, NULL, NULL, 0, NULL, 'mobile', NULL, '', NULL),
(127, 231, 16, 'takeaway', 2.3, 0.35, 0, 2.65, NULL, 'pending', NULL, NULL, '2022-09-08 00:03:00', '2022-09-08 00:03:00', NULL, NULL, NULL, 0, NULL, 'mobile', NULL, '', NULL),
(128, 231, 16, 'takeaway', 6.35, 0.9500000000000002, 0, 7.3, NULL, 'completed', 0, NULL, '2022-09-08 00:12:17', '2022-09-08 00:12:40', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(129, 231, 16, 'takeaway', 66, 9.900000000000006, 0, 75.9, NULL, 'pending', NULL, NULL, '2022-09-08 02:56:15', '2022-09-08 02:56:15', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(130, 231, 16, 'takeaway', 2, 0.2999999999999998, 5, 8.05, NULL, 'completed', 0, NULL, '2022-09-08 16:07:36', '2022-09-08 16:08:28', NULL, NULL, NULL, 500, NULL, 'mobile', 0, 'cash', NULL),
(131, 231, 16, 'takeaway', 35, 5.25, 0, 40.25, NULL, 'completed', NULL, NULL, '2022-09-08 17:13:34', '2022-09-08 17:15:51', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(132, 231, 16, 'takeaway', 8, 1.1999999999999993, 0, 9.2, NULL, 'completed', NULL, NULL, '2022-09-08 17:13:41', '2022-09-08 17:15:55', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(133, 231, 16, 'takeaway', 35, 5.25, 0, 40.25, NULL, 'completed', NULL, NULL, '2022-09-08 17:13:44', '2022-09-08 17:16:01', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(134, 231, 16, 'takeaway', 23.43, 3.5199999999999996, 0, 26.95, NULL, 'completed', NULL, NULL, '2022-09-08 17:15:02', '2022-09-08 17:18:20', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(135, 231, 16, 'takeaway', 13, 1.9499999999999993, 0, 14.95, NULL, 'completed', NULL, NULL, '2022-09-08 17:15:58', '2022-09-08 17:18:09', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(136, 231, 16, 'takeaway', 13, 1.9499999999999993, 0, 14.95, NULL, 'completed', NULL, NULL, '2022-09-08 17:17:56', '2022-09-08 17:19:46', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(137, 231, 16, 'takeaway', 42, 6.299999999999997, 0, 48.3, NULL, 'completed', NULL, NULL, '2022-09-08 17:18:02', '2022-09-08 17:19:57', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(138, 231, 16, 'takeaway', 13, 1.9499999999999993, 0, 14.95, 'يبانترؤؤفؤلءقؤغلهل', 'rejected', NULL, NULL, '2022-09-08 17:20:38', '2022-09-08 17:22:08', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(139, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, 'اا', 'canceled', 0, NULL, '2022-09-08 17:34:09', '2022-09-08 17:34:58', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(140, 231, 16, 'takeaway', 9, 1.3499999999999996, 0, 10.35, NULL, 'pending', 0, NULL, '2022-09-09 01:24:47', '2022-09-09 01:24:47', NULL, NULL, NULL, 0, NULL, 'mobile', 1, 'cash', NULL),
(141, 231, 19, 'takeaway', 12.43, 1.870000000000001, 0, 14.3, NULL, 'pending', 0, NULL, '2022-09-09 03:28:29', '2022-09-09 03:28:29', NULL, NULL, NULL, 0, NULL, 'mobile', 1, 'cash', 'test'),
(142, 231, 19, 'takeaway', 6, 0.9000000000000004, 0, 6.9, NULL, 'pending', 0, NULL, '2022-09-09 03:30:05', '2022-09-09 03:30:05', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(143, 231, 16, 'takeaway', 4, 0.5999999999999996, 0, 4.6, NULL, 'pending', 0, NULL, '2022-09-09 16:08:33', '2022-09-09 16:08:33', NULL, NULL, NULL, 0, NULL, 'mobile', 2, 'cash', NULL),
(144, 231, 16, 'takeaway', 9, 1.3499999999999996, 0, 1.15, NULL, 'pending', 0, NULL, '2022-09-09 20:38:29', '2022-09-09 20:38:29', NULL, NULL, NULL, 0, NULL, 'mobile', 5, 'cash', NULL),
(145, 231, 16, 'takeaway', 9, 1.3499999999999996, 0, 1.15, NULL, 'pending', 0, NULL, '2022-09-09 20:39:53', '2022-09-09 20:39:53', NULL, NULL, NULL, 0, NULL, 'mobile', 5, 'cash', NULL),
(146, 231, 16, 'takeaway', 9, 1.3499999999999996, 0, 1.15, NULL, 'pending', 0, NULL, '2022-09-09 20:42:25', '2022-09-09 20:42:25', NULL, NULL, NULL, 0, NULL, 'mobile', 5, 'cash', NULL),
(147, 231, 17, 'takeaway', 9, 1.3499999999999996, 0, 5.75, NULL, 'pending', 0, NULL, '2022-09-09 21:01:08', '2022-09-09 21:01:08', NULL, NULL, NULL, 0, NULL, 'mobile', 5, 'cash', NULL),
(148, 231, 17, 'takeaway', 4, 0.5999999999999996, 0, 4.6, NULL, 'pending', 0, NULL, '2022-09-09 21:15:46', '2022-09-09 21:15:46', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL),
(149, 231, 17, 'takeaway', 151.4, 22.69999999999999, 0, 24.1, NULL, 'pending', 150, NULL, '2022-09-09 21:47:40', '2022-09-09 21:47:40', NULL, NULL, NULL, 500, NULL, 'mobile', 0, 'cash', NULL),
(150, 231, 16, 'takeaway', 6, 0.9000000000000004, 0, 6.9, NULL, 'completed', NULL, NULL, '2022-09-10 01:10:17', '2022-09-10 01:12:18', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', 'بدون دهن بيض'),
(151, 231, 17, 'takeaway', 76.53, 11.469999999999999, 0, 59.95, NULL, 'pending', 20, NULL, '2022-09-11 22:22:48', '2022-09-11 22:22:48', NULL, NULL, NULL, 100, NULL, 'mobile', 8, 'cash', NULL),
(152, 231, 27, 'delivery', 50, 10, 5, 250, NULL, 'pending', NULL, NULL, '2022-09-11 22:34:15', '2022-09-11 22:34:15', NULL, NULL, 101, 20, NULL, 'mobile', 0, 'online', 'an description for that order'),
(153, 231, 16, 'takeaway', 2, 0.2999999999999998, 0, 2.3, NULL, 'pending', NULL, NULL, '2022-09-12 04:58:08', '2022-09-12 04:58:08', NULL, NULL, NULL, 0, NULL, 'mobile', 0, 'cash', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `item_extras` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_withouts` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dough_type_ar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dough_type_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `offer_price` double DEFAULT NULL,
  `offer_id` bigint(20) DEFAULT NULL,
  `offer_last_updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pure_price` double DEFAULT NULL,
  `dough_type_2_ar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dough_type_2_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `item_id`, `quantity`, `item_extras`, `item_withouts`, `dough_type_ar`, `dough_type_en`, `price`, `offer_price`, `offer_id`, `offer_last_updated_at`, `deleted_at`, `created_at`, `updated_at`, `pure_price`, `dough_type_2_ar`, `dough_type_2_en`) VALUES
(1, 1, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(2, 1, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(3, 1, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(4, 2, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(5, 3, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(6, 3, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(7, 4, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(8, 4, 2, 1, '2, 1', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(9, 5, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(10, 5, 2, 1, '2, 1', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(11, 6, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(12, 6, 2, 1, '2, 1', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(13, 7, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(14, 7, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(15, 8, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(16, 8, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(17, 9, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(18, 9, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(19, 10, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(20, 10, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(21, 11, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(22, 11, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(23, 12, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(24, 12, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(25, 13, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(26, 14, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(27, 14, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(28, 15, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(29, 15, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(30, 16, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(31, 17, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(32, 18, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(33, 19, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(34, 19, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(35, 19, 8, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(36, 20, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(37, 20, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(38, 21, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(39, 22, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(40, 23, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(41, 24, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(42, 25, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(43, 26, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(44, 27, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(45, 28, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(46, 29, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(47, 30, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(48, 31, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(49, 31, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(50, 31, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(51, 32, 2, 1, '', '', NULL, NULL, 2.3, 1.5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(52, 32, 2, 1, '2, 1', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(53, 33, 2, 1, '2', '', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(54, 33, 2, 1, '', '', NULL, NULL, 2.3, 1.5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(55, 34, 2, 1, '[null]', '[null]', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(56, 34, 2, 1, '[null,null]', '[null]', 'n', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(57, 35, 2, 1, '[null]', '[null]', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(58, 35, 2, 1, '[null,null]', '[null]', 'n', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(59, 36, 2, 1, '2', '1', 'normal', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(60, 37, 20, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(61, 37, 23, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(62, 38, 20, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(63, 38, 23, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(64, 38, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(65, 38, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(66, 38, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(67, 38, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(68, 38, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(69, 39, 20, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(70, 39, 23, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(71, 39, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(72, 39, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(73, 39, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(74, 39, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(75, 39, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(76, 39, 110, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(77, 40, 20, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(78, 40, 23, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(79, 40, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(80, 40, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(81, 40, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(82, 40, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(83, 40, 27, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(84, 40, 110, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(85, 41, 9, 1, '', '', '', 't', 12, 13.25, 15, '2022-08-31 16:30:18', NULL, NULL, NULL, 12, NULL, NULL),
(86, 42, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(87, 42, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(88, 42, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(89, 42, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(90, 42, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(91, 42, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(92, 43, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(93, 43, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(94, 43, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(95, 43, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(96, 43, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(97, 43, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(98, 44, 5, 1, '', '', NULL, NULL, 4.6, 0, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(99, 44, 6, 1, '', '', NULL, NULL, 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(100, 44, 7, 1, '', '', NULL, NULL, 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(101, 44, 5, 1, '', '', NULL, NULL, 4.6, -4.6, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(102, 44, 6, 1, '', '', NULL, NULL, 8.05, -8.05, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(103, 44, 7, 1, '', '', NULL, NULL, 8.05, -8.05, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(104, 45, 5, 1, '', '', NULL, NULL, 4.6, 0, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(105, 45, 6, 1, '', '', NULL, NULL, 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(106, 45, 7, 1, '', '', NULL, NULL, 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(107, 45, 5, 1, '', '', NULL, NULL, 4.6, -4.6, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(108, 45, 6, 1, '', '', NULL, NULL, 8.05, -8.05, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(109, 45, 7, 1, '', '', NULL, NULL, 8.05, -8.05, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(110, 46, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(111, 46, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(112, 46, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(113, 46, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(114, 46, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(115, 46, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(116, 47, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(117, 47, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(118, 47, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(119, 47, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(120, 47, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(121, 47, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(122, 48, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(123, 48, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(124, 48, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(125, 48, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(126, 48, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(127, 48, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(128, 49, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(129, 49, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(130, 49, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(131, 49, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(132, 49, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(133, 49, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(134, 50, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(135, 50, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(136, 50, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(137, 50, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(138, 50, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(139, 50, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(140, 51, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(141, 51, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(142, 51, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(143, 51, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(144, 51, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(145, 51, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(146, 52, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(147, 52, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(148, 52, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(149, 52, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(150, 52, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(151, 52, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(152, 53, 78, 1, '', '', NULL, NULL, 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(153, 53, 79, 1, '', '', NULL, NULL, 13.8, 0, NULL, NULL, NULL, NULL, NULL, 13.8, NULL, NULL),
(154, 53, 80, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(155, 53, 82, 1, '', '', NULL, NULL, 19.55, 0, NULL, NULL, NULL, NULL, NULL, 19.55, NULL, NULL),
(156, 53, 90, 1, '', '', NULL, NULL, 20.7, -20.7, NULL, NULL, NULL, NULL, NULL, 20.7, NULL, NULL),
(157, 53, 96, 1, '', '', NULL, NULL, 21.85, -21.85, NULL, NULL, NULL, NULL, NULL, 21.85, NULL, NULL),
(158, 54, 2, 1, '', '', NULL, NULL, 2.3, 1.5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(159, 55, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(160, 56, 5, 1, '', '', NULL, NULL, 4.6, 0, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(161, 56, 6, 1, '', '', NULL, NULL, 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(162, 56, 7, 1, '', '', NULL, NULL, 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(163, 56, 5, 1, '', '', NULL, NULL, 4.6, -4.6, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(164, 56, 6, 1, '', '', NULL, NULL, 8.05, -8.05, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(165, 56, 7, 1, '', '', NULL, NULL, 8.05, -8.05, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(166, 56, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(167, 57, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(168, 57, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(169, 57, 2, 1, '', '', 'normal', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(170, 57, 2, 1, '2, 3', '', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(171, 58, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(172, 59, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(173, 60, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(174, 61, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(175, 62, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(176, 63, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(177, 64, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(178, 64, 2, 1, '2, 3', '2', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(179, 64, 2, 1, '2, 3', '2', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(180, 64, 2, 1, '2, 3', '1', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(181, 64, 2, 1, '2, 3', '2', 'normal', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(182, 65, 2, 1, '', '', 'Borr', 'Borr', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(183, 66, 2, 1, '', '', 'بر', 'Borr', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(184, 67, 2, 1, '', '', 'بر', 'Borr', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(185, 68, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(186, 68, 2, 1, '', '', 'بر', 'Borr', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(187, 69, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(188, 70, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(189, 71, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(190, 72, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(191, 72, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(192, 73, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(193, 74, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(194, 75, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(195, 76, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(196, 77, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(197, 78, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(198, 79, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(199, 80, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(200, 81, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(201, 82, 8, 1, '', '', 'عادي', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, 'رقيقة', 'thin'),
(202, 83, 8, 1, '', '', 'عادي', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, 'رقيقة', 'thin'),
(203, 84, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(204, 84, 78, 1, '', '', 'بر', 'Borr', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'سميكة', 'Thick'),
(205, 85, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(206, 86, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(207, 87, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(208, 88, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(209, 89, 2, 1, '', '', 'بر', 'Borr', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(210, 90, 2, 1, '', '', 'بر', 'Borr', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(211, 90, 2, 1, '', '', 'بر', 'Borr', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(212, 91, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(213, 92, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(214, 93, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(215, 93, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(216, 94, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(217, 95, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(218, 96, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(219, 97, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(220, 98, 8, 1, '', '', 'عادي', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(221, 99, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(222, 100, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(223, 100, 98, 1, '', '', 'normal', 'normal', 24.15, 0, NULL, NULL, NULL, NULL, NULL, 24.15, NULL, NULL),
(224, 101, 29, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(225, 102, 5, 1, '', '', 'normal', 'normal', 4.6, 0, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(226, 102, 34, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(227, 102, 36, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(228, 102, 106, 1, '', '', 'normal', 'normal', 3.45, 0, NULL, NULL, NULL, NULL, NULL, 3.45, NULL, NULL),
(229, 103, 91, 1, '', '', 'عادي', 'normal', 16.1, 0, NULL, NULL, NULL, NULL, NULL, 16.1, NULL, NULL),
(230, 104, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(231, 105, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(232, 106, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(233, 107, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(234, 108, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(235, 109, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(236, 110, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(237, 111, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(238, 112, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(239, 112, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, NULL, NULL),
(240, 113, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(241, 114, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, 'رقيقة', 'thin'),
(242, 115, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(243, 115, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(244, 116, 78, 1, '', '', 'عادي', 'normal', 18.4, 0, NULL, NULL, NULL, NULL, NULL, 18.4, 'رقيقة', 'thin'),
(245, 117, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(246, 118, 2, 1, '2, 3', '2, 3', 'عادي', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(247, 118, 2, 1, '', '', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(248, 118, 2, 1, '2, 1', '', 'عادي', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(249, 119, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(250, 120, 2, 1, '[null,null]', '[null,null]', '', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(251, 120, 2, 1, '[null]', '[null]', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(252, 120, 2, 1, '[null,null]', '[null]', '', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(253, 121, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(254, 122, 2, 1, '2, 1', '', 'عادي', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(255, 123, 2, 1, '[null,null]', '[null,null]', '', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(256, 123, 2, 1, '[null]', '[null]', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(257, 123, 2, 1, '[null,null]', '[null]', '', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(258, 124, 2, 1, '[null,null]', '[null,null]', '', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(259, 124, 2, 1, '[null]', '[null]', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(260, 124, 2, 1, '[null,null]', '[null]', '', 'n', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(261, 125, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(262, 126, 2, 1, '[null]', '[null]', '', 'n', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(263, 127, 2, 1, '[null]', '[null]', '', 'n', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(264, 128, 2, 1, '2', '', 'عادي', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(265, 129, 100, 1, '', '', 'normal', 'normal', 75.9, 0, NULL, NULL, NULL, NULL, NULL, 75.9, NULL, NULL),
(266, 130, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(267, 131, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(268, 131, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(269, 131, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(270, 131, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(271, 131, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(272, 132, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(273, 132, 8, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(274, 133, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(275, 133, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(276, 133, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(277, 133, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(278, 133, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(279, 134, 8, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(280, 134, 9, 1, '', '', 'normal', 'normal', 12, 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL),
(281, 134, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(282, 135, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(283, 135, 3, 1, '', '', NULL, NULL, 5.75, 2.88, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(284, 135, 8, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(285, 136, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(286, 136, 3, 1, '', '', NULL, NULL, 5.75, 2.88, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(287, 136, 8, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(288, 137, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(289, 137, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(290, 137, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(291, 137, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(292, 137, 19, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(293, 137, 29, 1, '', '', 'normal', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(294, 138, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(295, 138, 3, 1, '', '', NULL, NULL, 5.75, 2.88, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(296, 138, 8, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(297, 139, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(298, 140, 109, 1, '', '', 'عادي', 'normal', 8.05, 0, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(299, 140, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(300, 141, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(301, 141, 9, 1, '', '', 'عادي', 'normal', 12, 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL),
(302, 142, 8, 1, '', '', 'عادي', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(303, 143, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(304, 143, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(305, 144, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(306, 144, 5, 1, '', '', NULL, NULL, 4.6, -4.6, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(307, 145, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(308, 145, 5, 1, '', '', NULL, NULL, 4.6, -4.6, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(309, 146, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(310, 146, 5, 1, '', '', NULL, NULL, 4.6, -4.6, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(311, 147, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(312, 147, 5, 1, '', '', NULL, NULL, 4.6, -4.6, NULL, NULL, NULL, NULL, NULL, 4.6, NULL, NULL),
(313, 148, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(314, 148, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(315, 149, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(316, 149, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(317, 149, 3, 1, '1, 3', '', 'عادي', 'normal', 55.75, 50, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(318, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(319, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(320, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(321, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(322, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(323, 149, 3, 1, '2, 1, 3', '', 'عادي', 'normal', 60.75, 55, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(324, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(325, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(326, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(327, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(328, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(329, 149, 3, 1, '1, 2', '', 'عادي', 'normal', 35.75, 30, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(330, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(331, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(332, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(333, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(334, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(335, 149, 3, 1, '', '', 'عادي', 'normal', 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(336, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(337, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(338, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(339, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(340, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(341, 149, 3, 1, '', '', 'عادي', 'normal', 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(342, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(343, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(344, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(345, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(346, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(347, 149, 3, 1, '', '', 'عادي', 'normal', 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(348, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(349, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(350, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(351, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(352, 149, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(353, 150, 8, 1, '', '', 'normal', 'normal', 6.9, 0, NULL, NULL, NULL, NULL, NULL, 6.9, NULL, NULL),
(354, 151, 2, 1, '', '', 'عادي', 'normal', 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(355, 151, 2, 1, '2', '', 'عادي', 'normal', 7.3, 5, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(356, 151, 2, 1, '', '', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(357, 151, 2, 1, '2, 3', '', 'عادي', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(358, 151, 2, 1, '', '', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(359, 151, 3, 1, '', '', NULL, NULL, 5.75, 0, NULL, NULL, NULL, NULL, NULL, 5.75, NULL, NULL),
(360, 151, 7, 1, '', '', NULL, NULL, 8.05, -8.05, NULL, NULL, NULL, NULL, NULL, 8.05, NULL, NULL),
(361, 151, 2, 1, '2, 3', '', 'عادي', 'normal', 32.3, 30, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(362, 151, 2, 1, '', '', NULL, NULL, 2.3, 0, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL),
(363, 152, 9, 1, '', '', 'عادى', 'noraml', 12, 0, NULL, NULL, NULL, NULL, NULL, 12, 'سميكة', 'thick'),
(364, 152, 9, 1, '1, 2, 3', '3, 4', 'عادى', 'noraml', 67, 55, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL),
(365, 152, 9, 1, '2', '1', 'عادى', 'noraml', 17, 5, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL),
(366, 153, 2, 1, '', '', NULL, NULL, 2.3, 1.15, NULL, NULL, NULL, NULL, NULL, 2.3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('abo3adel35@gmail.com', '986452', NULL),
('abo3adel35@gmail.com', '276812', NULL),
('abo3adel35@gmail.com', '656053', NULL),
('abo3adel35@gmail.comwwwwww', '959980', NULL),
('abo3adel35@gmail.com', '788573', NULL),
('abo3adel35@gmail.com', '884610', NULL),
('abo3adel35@gmail.com', '500745', NULL),
('abo3adel35@gmail.com', '680774', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('youssef4242014@gmail.com', '530611', NULL),
('youssef4242014@gmail.com', '856575', NULL),
('youssef4242014@gmail.com', '596509', NULL),
('youssef4242014@gmail.com', '759792', NULL),
('youssef4242014@gmail.com', '129989', NULL),
('youssef4242014@gmail.com', '554196', NULL),
('youssef4242014@gmail.com', '929640', NULL),
('youssef4242014@gmail.com', '624735', NULL),
('youssef4242014@gmail.com', '877475', NULL),
('sherifmim15@gmail.com', '932162', NULL),
('sherifmim15@gmail.com', '221400', NULL),
('aa@aa.com', '551510', NULL),
('eng_mohgamal81@yahoo.com', '983333', NULL),
('eng_mohgamal81@yahoo.com', '627237', NULL),
('eng_mohgamal81@yahoo.com', '709181', NULL),
('eng_mohgamal81@yahoo.com', '923411', NULL),
('eng_mohgamal81@yahoo.com', '516088', NULL),
('eng_mohgamal81@yahoo.com', '710776', NULL),
('eng_mohgamal81@yahoo.com', '964452', NULL),
('hosssinkamal17@gmail.com', '332453', NULL),
('naderyanoo@hotmail.com', '275582', NULL),
('naderyanoo@hotmail.com', '289798', NULL),
('nourasamyy39@gmail.com', '545823', NULL),
('nourasamyy39@gmail.com', '826418', NULL),
('nourasamyy39@gmail.com', '389230', NULL),
('nourasamyy39@gmail.com', '976370', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_paid` double(20,0) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'customer_index', 'Get All Customers', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(2, 'customer_create', 'Create New Customer', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(3, 'customer_edit', 'Edit Customer', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(4, 'menu_index', 'Get All Menus', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(5, 'menu_create', 'Create New Menu', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(6, 'menu_edit', 'Edit Menu', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(7, 'offer_index', 'Get All Offers', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(8, 'offer_create', 'Create New Offer', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(9, 'offer_edit', 'Edit Offer', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(10, 'branch_index', 'Get All Branches', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(11, 'branch_create', 'Create New Branch', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(12, 'branch_edit', 'Edit Branch', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(13, 'user_index', 'Get All Users', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(14, 'user_create', 'Create New User', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(15, 'user_edit', 'Edit User', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(16, 'role_index', 'Get All Roles', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(17, 'role_create', 'Create New Role', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(18, 'role_edit', 'Edit Role', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(19, 'order_index', 'Get All Orders', NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(4, 7),
(5, 7),
(6, 7),
(7, 7),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(12, 7),
(19, 7),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(9, 9),
(10, 9),
(11, 9),
(12, 9),
(13, 9),
(14, 9),
(15, 9),
(16, 9),
(17, 9),
(18, 9),
(19, 9);

-- --------------------------------------------------------

--
-- Table structure for table `points_transactions`
--

CREATE TABLE `points_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `point_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `points_transactions`
--

INSERT INTO `points_transactions` (`id`, `points`, `user_id`, `order_id`, `status`, `deleted_at`, `created_at`, `updated_at`, `point_id`) VALUES
(101, 3000, 72, 203, 0, NULL, '2020-03-23 23:26:21', '2020-03-23 23:26:21', NULL),
(102, 3, 72, 204, 0, NULL, '2020-03-24 00:45:24', '2020-03-24 00:45:24', NULL),
(103, 3, 72, 205, 0, NULL, '2020-03-24 10:37:46', '2020-03-24 10:37:46', NULL),
(104, 47, 75, 210, 0, NULL, '2020-03-30 07:51:35', '2020-03-30 07:51:35', NULL),
(105, 44, 70, 2000, 0, NULL, '2020-03-30 07:51:47', '2020-03-30 07:51:47', NULL),
(106, 2, 75, 209, 0, NULL, '2020-03-30 07:52:18', '2020-03-30 07:52:18', NULL),
(107, 3000, 75, 208, 0, NULL, '2020-03-30 07:53:00', '2020-03-30 07:53:00', NULL),
(108, 253, 75, 211, 0, NULL, '2020-03-30 07:54:41', '2020-03-30 07:54:41', NULL),
(114, 24, 75, 207, 0, NULL, '2020-04-02 11:58:32', '2020-04-02 11:58:32', NULL),
(115, 2, 75, 212, 0, NULL, '2020-04-02 11:58:38', '2020-04-02 11:58:38', NULL),
(116, 39, 75, 213, 0, NULL, '2020-04-02 11:58:40', '2020-04-02 11:58:40', NULL),
(117, 2, 75, 214, 0, NULL, '2020-04-02 11:58:42', '2020-04-02 11:58:42', NULL),
(118, 2, 75, 215, 0, NULL, '2020-04-02 11:58:44', '2020-04-02 11:58:44', NULL),
(119, -100, 75, NULL, 2, NULL, '2020-04-02 12:08:07', '2020-04-02 12:08:07', NULL),
(120, 2, 75, 216, 0, NULL, '2020-04-02 12:11:26', '2020-04-02 12:11:26', NULL),
(121, 0, 75, 217, 0, NULL, '2020-04-02 12:11:30', '2020-04-02 12:11:30', NULL),
(122, 4, 75, 218, 0, NULL, '2020-04-02 12:11:33', '2020-04-02 12:11:33', NULL),
(123, 4, 75, 219, 0, NULL, '2020-04-02 12:11:37', '2020-04-02 12:11:37', NULL),
(124, 2, 75, 220, 0, NULL, '2020-04-02 12:11:39', '2020-04-02 12:11:39', NULL),
(125, 2, 75, 221, 0, NULL, '2020-04-02 12:11:43', '2020-04-02 12:11:43', NULL),
(126, 2, 75, 222, 0, NULL, '2020-04-02 12:11:47', '2020-04-02 12:11:47', NULL),
(127, 1, 75, 223, 0, NULL, '2020-04-02 12:11:50', '2020-04-02 12:11:50', NULL),
(128, 1, 75, 224, 0, NULL, '2020-04-02 12:11:53', '2020-04-02 12:11:53', NULL),
(129, 1, 75, 225, 0, NULL, '2020-04-02 12:11:56', '2020-04-02 12:11:56', NULL),
(130, 1, 75, 226, 0, NULL, '2020-04-02 12:12:00', '2020-04-02 12:12:00', NULL),
(131, 2, 75, 227, 0, NULL, '2020-04-02 12:12:03', '2020-04-02 12:12:03', NULL),
(132, 7, 75, 228, 0, NULL, '2020-04-02 12:12:06', '2020-04-02 12:12:06', NULL),
(133, 9, 75, 229, 0, NULL, '2020-04-02 12:12:09', '2020-04-02 12:12:09', NULL),
(134, 4, 75, 230, 0, NULL, '2020-04-02 12:12:12', '2020-04-02 12:12:12', NULL),
(135, 2, 75, 231, 0, NULL, '2020-04-02 12:12:15', '2020-04-02 12:12:15', NULL),
(136, 1, 75, 232, 0, NULL, '2020-04-02 12:12:16', '2020-04-02 12:12:16', NULL),
(137, 2, 75, 233, 0, NULL, '2020-04-02 12:12:18', '2020-04-02 12:12:18', NULL),
(138, 2, 75, 234, 0, NULL, '2020-04-02 12:12:20', '2020-04-02 12:12:20', NULL),
(139, 1, 71, 202, 0, NULL, '2020-04-02 12:12:23', '2020-04-02 12:12:23', NULL),
(140, -100, 75, NULL, 2, NULL, '2020-04-02 12:19:05', '2020-04-02 12:19:05', NULL),
(141, -100, 75, NULL, 2, NULL, '2020-04-02 12:22:04', '2020-04-02 12:22:04', NULL),
(142, -100, 75, NULL, 2, NULL, '2020-04-06 02:55:51', '2020-04-06 02:55:51', NULL),
(143, -100, 75, NULL, 2, NULL, '2020-04-06 05:18:17', '2020-04-06 05:18:17', NULL),
(144, 1, 75, 235, 0, NULL, '2020-04-06 05:18:54', '2020-04-06 05:18:54', NULL),
(145, 3, 75, 236, 0, NULL, '2020-04-06 05:19:26', '2020-04-06 05:19:26', NULL),
(146, -100, 76, NULL, 2, NULL, '2020-04-06 13:42:48', '2020-04-06 13:42:48', NULL),
(147, -100, 76, NULL, 2, NULL, '2020-04-06 13:44:25', '2020-04-06 13:44:25', NULL),
(148, -100, 76, NULL, 2, NULL, '2020-04-06 14:00:13', '2020-04-06 14:00:13', NULL),
(149, -100, 75, NULL, 2, NULL, '2020-04-06 14:34:59', '2020-04-06 14:34:59', NULL),
(150, -100, 75, NULL, 2, NULL, '2020-04-06 14:36:16', '2020-04-06 14:36:16', NULL),
(151, -100, 75, NULL, 2, NULL, '2020-04-10 00:24:29', '2020-04-10 00:24:29', NULL),
(152, -100, 75, NULL, 2, NULL, '2020-04-10 00:29:45', '2020-04-10 00:29:45', NULL),
(153, -100, 75, NULL, 2, NULL, '2020-04-19 00:01:22', '2020-04-19 00:01:22', NULL),
(154, -100, 75, NULL, 2, NULL, '2020-04-19 21:41:39', '2020-04-19 21:41:39', NULL),
(155, -100, 75, NULL, 2, NULL, '2020-04-19 22:09:32', '2020-04-19 22:09:32', NULL),
(156, -100, 75, NULL, 2, NULL, '2020-04-19 23:46:33', '2020-04-19 23:46:33', NULL),
(157, -100, 75, NULL, 2, NULL, '2020-04-20 00:22:05', '2020-04-20 00:22:05', NULL),
(158, 22, 75, 237, 0, NULL, '2020-04-20 01:46:10', '2020-04-20 01:46:10', NULL),
(159, 15, 75, 238, 0, NULL, '2020-04-20 01:46:12', '2020-04-20 01:46:12', NULL),
(160, 22, 75, 239, 0, NULL, '2020-04-20 01:46:14', '2020-04-20 01:46:14', NULL),
(161, 20, 75, 240, 0, NULL, '2020-04-20 01:46:16', '2020-04-20 01:46:16', NULL),
(162, 0, 75, 245, 0, NULL, '2020-04-20 01:46:18', '2020-04-20 01:46:18', NULL),
(163, 106, 75, 246, 0, NULL, '2020-04-20 01:46:20', '2020-04-20 01:46:20', NULL),
(164, 0, 76, 247, 0, NULL, '2020-04-20 01:46:22', '2020-04-20 01:46:22', NULL),
(165, 2, 76, 248, 0, NULL, '2020-04-20 01:46:24', '2020-04-20 01:46:24', NULL),
(166, 2, 75, 254, 0, NULL, '2020-04-20 01:46:26', '2020-04-20 01:46:26', NULL),
(167, -100, 75, NULL, 2, NULL, '2020-04-20 01:47:44', '2020-04-20 01:47:44', NULL),
(168, -100, 75, NULL, 2, NULL, '2020-04-20 01:56:07', '2020-04-20 01:56:07', NULL),
(169, -100, 75, NULL, 2, NULL, '2020-04-20 02:49:24', '2020-04-20 02:49:24', NULL),
(170, -100, 75, NULL, 2, NULL, '2020-04-20 02:59:41', '2020-04-20 02:59:41', NULL),
(171, -100, 75, NULL, 2, NULL, '2020-04-20 03:06:41', '2020-04-20 03:06:41', NULL),
(172, -100, 75, NULL, 2, NULL, '2020-04-20 03:08:05', '2020-04-20 03:08:05', NULL),
(173, 2000, 75, NULL, 2, NULL, '2020-04-20 04:05:20', '2020-04-20 04:05:20', NULL),
(174, -20, 75, NULL, 2, NULL, '2020-04-20 05:54:07', '2020-04-20 05:54:07', NULL),
(175, -20, 75, NULL, 2, NULL, '2020-04-20 06:51:22', '2020-04-20 06:51:22', NULL),
(176, -20, 75, NULL, 2, NULL, '2020-04-20 06:53:57', '2020-04-20 06:53:57', NULL),
(177, -100, 75, NULL, 2, NULL, '2020-04-20 07:19:03', '2020-04-20 07:19:03', NULL),
(178, -100, 75, NULL, 2, NULL, '2020-04-20 10:52:07', '2020-04-20 10:52:07', NULL),
(179, -100, 75, NULL, 2, NULL, '2020-04-20 10:58:25', '2020-04-20 10:58:25', NULL),
(180, -100, 75, NULL, 2, NULL, '2020-04-20 10:59:33', '2020-04-20 10:59:33', NULL),
(181, -100, 75, NULL, 2, NULL, '2020-04-20 11:06:54', '2020-04-20 11:06:54', NULL),
(182, 20, 75, 241, 3, NULL, '2020-04-21 03:15:30', '2020-04-21 03:15:30', NULL),
(183, 1, 72, 206, 0, NULL, '2020-04-21 03:19:08', '2020-04-21 03:19:08', NULL),
(184, 20, 75, 242, 0, NULL, '2020-04-21 03:19:10', '2020-04-21 03:19:10', NULL),
(185, 20, 75, 243, 0, NULL, '2020-04-21 03:19:13', '2020-04-21 03:19:13', NULL),
(186, 14, 75, 244, 0, NULL, '2020-04-21 03:19:16', '2020-04-21 03:19:16', NULL),
(187, 2, 76, 249, 0, NULL, '2020-04-21 03:19:19', '2020-04-21 03:19:19', NULL),
(188, 1, 75, 250, 0, NULL, '2020-04-21 03:19:22', '2020-04-21 03:19:22', NULL),
(189, 116, 75, 251, 0, NULL, '2020-04-21 03:19:24', '2020-04-21 03:19:24', NULL),
(190, 25, 75, 252, 0, NULL, '2020-04-21 03:19:26', '2020-04-21 03:19:26', NULL),
(191, 274, 75, 253, 0, NULL, '2020-04-21 03:19:28', '2020-04-21 03:19:28', NULL),
(192, 22, 75, 255, 0, NULL, '2020-04-21 03:19:30', '2020-04-21 03:19:30', NULL),
(193, 2, 75, 256, 0, NULL, '2020-04-21 03:19:33', '2020-04-21 03:19:33', NULL),
(194, 118, 75, 277, 0, NULL, '2020-04-21 03:19:35', '2020-04-21 03:19:35', NULL),
(195, 1, 75, 278, 0, NULL, '2020-04-21 03:19:37', '2020-04-21 03:19:37', NULL),
(196, 43, 75, 281, 0, NULL, '2020-04-21 03:19:39', '2020-04-21 03:19:39', NULL),
(197, 1, 75, 282, 0, NULL, '2020-04-21 03:19:41', '2020-04-21 03:19:41', NULL),
(198, 21, 75, 283, 0, NULL, '2020-04-21 03:19:42', '2020-04-21 03:19:42', NULL),
(199, 3, 75, 284, 0, NULL, '2020-04-21 03:19:45', '2020-04-21 03:19:45', NULL),
(200, 2, 75, 285, 0, NULL, '2020-04-21 03:19:46', '2020-04-21 03:19:46', NULL),
(201, 2, 75, 286, 0, NULL, '2020-04-21 03:19:48', '2020-04-21 03:19:48', NULL),
(202, 1, 75, 287, 0, NULL, '2020-04-21 03:19:50', '2020-04-21 03:19:50', NULL),
(203, 42, 79, 306, 0, NULL, '2020-04-21 03:37:06', '2020-04-21 03:37:06', NULL),
(204, 5, 75, 257, 0, NULL, '2020-04-21 03:38:10', '2020-04-21 03:38:10', NULL),
(205, 3, 75, 258, 0, NULL, '2020-04-21 03:38:12', '2020-04-21 03:38:12', NULL),
(206, 652, 75, 259, 0, NULL, '2020-04-21 03:38:14', '2020-04-21 03:38:14', NULL),
(207, 610, 75, 260, 0, NULL, '2020-04-21 03:38:16', '2020-04-21 03:38:16', NULL),
(208, 1, 75, 261, 0, NULL, '2020-04-21 03:38:18', '2020-04-21 03:38:18', NULL),
(209, 1, 75, 262, 0, NULL, '2020-04-21 03:38:20', '2020-04-21 03:38:20', NULL),
(210, 43, 75, 263, 0, NULL, '2020-04-21 03:38:22', '2020-04-21 03:38:22', NULL),
(211, 3, 75, 264, 0, NULL, '2020-04-21 03:38:24', '2020-04-21 03:38:24', NULL),
(212, 43, 75, 271, 0, NULL, '2020-04-21 03:38:25', '2020-04-21 03:38:25', NULL),
(213, 43, 75, 272, 0, NULL, '2020-04-21 03:38:27', '2020-04-21 03:38:27', NULL),
(214, 2, 75, 273, 0, NULL, '2020-04-21 03:38:29', '2020-04-21 03:38:29', NULL),
(215, 2, 75, 274, 0, NULL, '2020-04-21 03:38:31', '2020-04-21 03:38:31', NULL),
(216, 64, 75, 275, 0, NULL, '2020-04-21 03:39:20', '2020-04-21 03:39:20', NULL),
(217, 1076, 75, 276, 0, NULL, '2020-04-21 03:39:33', '2020-04-21 03:39:33', NULL),
(218, 8, 75, 288, 0, NULL, '2020-04-21 03:39:41', '2020-04-21 03:39:41', NULL),
(219, 2, 75, 289, 0, NULL, '2020-04-21 03:39:43', '2020-04-21 03:39:43', NULL),
(220, 1, 75, 290, 0, NULL, '2020-04-21 03:39:45', '2020-04-21 03:39:45', NULL),
(221, 23, 75, 291, 0, NULL, '2020-04-21 03:39:47', '2020-04-21 03:39:47', NULL),
(222, 20, 75, 292, 0, NULL, '2020-04-21 03:39:49', '2020-04-21 03:39:49', NULL),
(223, 12, 79, 307, 0, NULL, '2020-04-21 03:39:54', '2020-04-21 03:39:54', NULL),
(224, 20, 75, 295, 0, NULL, '2020-04-21 03:39:57', '2020-04-21 03:39:57', NULL),
(225, 44, 75, 296, 0, NULL, '2020-04-21 03:39:59', '2020-04-21 03:39:59', NULL),
(226, 41, 75, 297, 0, NULL, '2020-04-21 03:40:01', '2020-04-21 03:40:01', NULL),
(227, 92, 75, 298, 0, NULL, '2020-04-21 03:40:03', '2020-04-21 03:40:03', NULL),
(228, 7, 75, 299, 0, NULL, '2020-04-21 03:40:04', '2020-04-21 03:40:04', NULL),
(229, 3, 75, 300, 0, NULL, '2020-04-21 03:40:05', '2020-04-21 03:40:05', NULL),
(230, 358, 75, 301, 0, NULL, '2020-04-21 03:40:07', '2020-04-21 03:40:07', NULL),
(231, 1, 75, 302, 0, NULL, '2020-04-21 03:40:09', '2020-04-21 03:40:09', NULL),
(232, 3, 75, 303, 0, NULL, '2020-04-21 03:40:11', '2020-04-21 03:40:11', NULL),
(233, 1, 75, 304, 0, NULL, '2020-04-21 03:40:13', '2020-04-21 03:40:13', NULL),
(234, 3, 75, 305, 0, NULL, '2020-04-21 03:40:14', '2020-04-21 03:40:14', NULL),
(235, 1154, 75, 294, 0, NULL, '2020-04-21 03:40:16', '2020-04-21 03:40:16', NULL),
(236, 37, 75, 293, 0, NULL, '2020-04-21 03:40:18', '2020-04-21 03:40:18', NULL),
(237, 148, 79, 308, 0, NULL, '2020-04-21 03:41:18', '2020-04-21 03:41:18', NULL),
(238, -100, 79, NULL, 2, NULL, '2020-04-21 03:42:22', '2020-04-21 03:42:22', NULL),
(239, 8, 79, 309, 0, NULL, '2020-04-21 03:45:07', '2020-04-21 03:45:07', NULL),
(240, -100, 75, NULL, 2, NULL, '2020-04-21 06:42:17', '2020-04-21 06:42:17', NULL),
(241, -100, 75, NULL, 2, NULL, '2020-04-21 06:43:22', '2020-04-21 06:43:22', NULL),
(242, -100, 75, NULL, 2, NULL, '2020-04-21 06:56:12', '2020-04-21 06:56:12', NULL),
(243, -100, 75, NULL, 2, NULL, '2020-04-22 05:49:15', '2020-04-22 05:49:15', NULL),
(244, -100, 75, NULL, 2, NULL, '2020-04-22 05:50:53', '2020-04-22 05:50:53', NULL),
(245, 2, 75, 311, 0, NULL, '2020-04-22 08:13:16', '2020-04-22 08:13:16', NULL),
(246, 505, 79, 310, 0, NULL, '2020-04-22 08:13:48', '2020-04-22 08:13:48', NULL),
(247, 20, 75, 312, 3, NULL, '2020-04-23 06:31:53', '2020-04-23 06:31:53', NULL),
(248, 10, 79, 340, 0, NULL, '2020-04-23 10:18:42', '2020-04-23 10:18:42', NULL),
(249, 146, 75, 313, 0, NULL, '2020-04-23 10:25:19', '2020-04-23 10:25:19', NULL),
(250, 20, 75, 315, 3, NULL, '2020-04-23 11:00:39', '2020-04-23 11:00:39', NULL),
(251, 3, 75, 338, 0, NULL, '2020-04-23 21:08:08', '2020-04-23 21:08:08', NULL),
(252, -100, 79, NULL, 2, NULL, '2020-04-24 03:46:37', '2020-04-24 03:46:37', NULL),
(253, -100, 75, NULL, 2, NULL, '2020-04-24 10:21:21', '2020-04-24 10:21:21', NULL),
(254, 3, 79, 339, 0, NULL, '2020-04-24 10:44:20', '2020-04-24 10:44:20', NULL),
(255, -100, 79, NULL, 2, NULL, '2020-04-27 08:49:59', '2020-04-27 08:49:59', NULL),
(256, -100, 79, NULL, 2, NULL, '2020-04-27 09:34:43', '2020-04-27 09:34:43', NULL),
(257, 4, 79, 354, 0, NULL, '2020-04-27 09:37:11', '2020-04-27 09:37:11', NULL),
(258, -100, 75, NULL, 2, NULL, '2020-04-27 10:17:51', '2020-04-27 10:17:51', NULL),
(259, -100, 75, NULL, 2, NULL, '2020-04-27 10:23:37', '2020-04-27 10:23:37', NULL),
(260, -100, 75, NULL, 2, NULL, '2020-04-27 21:54:02', '2020-04-27 21:54:02', NULL),
(261, 1, 79, 353, 0, NULL, '2020-04-27 23:25:52', '2020-04-27 23:25:52', NULL),
(262, 2, 79, 352, 0, NULL, '2020-04-27 23:25:56', '2020-04-27 23:25:56', NULL),
(263, 0, 79, 363, 0, NULL, '2020-04-28 10:16:33', '2020-04-28 10:16:33', NULL),
(264, 1, 75, 361, 0, NULL, '2020-04-28 10:16:35', '2020-04-28 10:16:35', NULL),
(265, 1, 75, 350, 0, NULL, '2020-04-28 10:16:38', '2020-04-28 10:16:38', NULL),
(266, 11, 79, 349, 0, NULL, '2020-04-28 10:16:40', '2020-04-28 10:16:40', NULL),
(267, -100, 75, NULL, 2, NULL, '2020-04-28 10:19:34', '2020-04-28 10:19:34', NULL),
(268, 2, 79, 369, 0, NULL, '2020-08-24 04:01:50', '2020-08-24 04:01:50', NULL),
(269, 2, 79, 368, 0, NULL, '2020-08-24 04:01:53', '2020-08-24 04:01:53', NULL),
(270, 6, 79, 367, 0, NULL, '2020-08-24 04:01:56', '2020-08-24 04:01:56', NULL),
(271, 1, 79, 366, 0, NULL, '2020-08-24 04:01:58', '2020-08-24 04:01:58', NULL),
(272, 3, 79, 365, 0, NULL, '2020-08-24 04:02:01', '2020-08-24 04:02:01', NULL),
(273, 1, 79, 364, 0, NULL, '2020-08-24 04:02:03', '2020-08-24 04:02:03', NULL),
(274, 6, 75, 363, 0, NULL, '2020-08-24 04:02:06', '2020-08-24 04:02:06', NULL),
(275, 1, 79, 355, 0, NULL, '2020-08-24 04:02:08', '2020-08-24 04:02:08', NULL),
(276, 3, 79, 344, 0, NULL, '2020-08-24 04:02:10', '2020-08-24 04:02:10', NULL),
(277, 2, 79, 341, 0, NULL, '2020-08-24 04:02:13', '2020-08-24 04:02:13', NULL),
(278, 1, 75, 329, 0, NULL, '2020-08-24 04:02:15', '2020-08-24 04:02:15', NULL),
(279, 2, 75, 319, 0, NULL, '2020-08-24 04:02:17', '2020-08-24 04:02:17', NULL),
(280, 1, 79, 318, 0, NULL, '2020-08-24 04:02:19', '2020-08-24 04:02:19', NULL),
(281, 2, 79, 317, 0, NULL, '2020-08-24 04:02:21', '2020-08-24 04:02:21', NULL),
(282, 1, 79, 316, 0, NULL, '2020-08-24 04:02:23', '2020-08-24 04:02:23', NULL),
(283, 2, 79, 342, 0, NULL, '2020-08-24 04:13:42', '2020-08-24 04:13:42', NULL),
(284, 4, 79, 330, 0, NULL, '2020-08-24 04:14:01', '2020-08-24 04:14:01', NULL),
(285, 2, 79, 328, 0, NULL, '2020-08-24 04:14:03', '2020-08-24 04:14:03', NULL),
(286, 2, 75, 374, 0, NULL, '2020-08-24 05:14:28', '2020-08-24 05:14:28', NULL),
(287, 22, 75, 380, 0, NULL, '2020-09-21 07:30:35', '2020-09-21 07:30:35', NULL),
(288, 34, 70, 422, 0, NULL, '2020-10-20 21:05:26', '2020-10-20 21:05:26', NULL),
(289, 34, 70, 422, 0, NULL, '2020-10-20 21:06:48', '2020-10-20 21:06:48', NULL),
(290, 34, 70, 422, 0, NULL, '2020-10-20 21:08:27', '2020-10-20 21:08:27', NULL),
(291, 34, 70, 422, 0, NULL, '2020-10-20 21:10:23', '2020-10-20 21:10:23', NULL),
(292, 34, 70, 422, 0, NULL, '2020-10-20 21:11:07', '2020-10-20 21:11:07', NULL),
(293, 34, 70, 422, 0, NULL, '2020-10-21 12:23:46', '2020-10-21 12:23:46', NULL),
(294, 4, 70, 469, 0, NULL, '2020-11-13 04:59:30', '2020-11-13 04:59:30', NULL),
(295, -100, 70, NULL, 2, NULL, '2020-11-16 06:20:00', '2020-11-16 06:20:00', NULL),
(296, -100, 70, NULL, 2, NULL, '2020-11-16 06:23:04', '2020-11-16 06:23:04', NULL),
(297, 125, 70, 40, 0, NULL, '2020-11-16 23:47:10', '2020-11-16 23:47:10', NULL),
(298, -100, 70, NULL, 2, NULL, '2020-11-16 23:49:45', '2020-11-16 23:49:45', NULL),
(299, 95, 70, 38, 0, NULL, '2020-11-17 00:05:47', '2020-11-17 00:05:47', NULL),
(300, 78, 70, 37, 0, NULL, '2020-11-17 00:06:15', '2020-11-17 00:06:15', NULL),
(301, 1, 70, 41, 0, NULL, '2020-11-17 02:34:42', '2020-11-17 02:34:42', NULL),
(302, -100, 70, NULL, 2, NULL, '2020-11-17 04:58:42', '2020-11-17 04:58:42', NULL),
(303, 1, 70, 46, 0, NULL, '2020-12-23 21:55:19', '2020-12-23 21:55:19', NULL),
(304, 20, 70, 45, 3, NULL, '2020-12-23 21:55:30', '2020-12-23 21:55:30', NULL),
(305, -100, 70, NULL, 2, NULL, '2020-12-30 20:29:30', '2020-12-30 20:29:30', NULL),
(306, 6, 70, 80, 0, NULL, '2021-05-04 23:57:07', '2021-05-04 23:57:07', NULL),
(307, 2, 70, 79, 0, NULL, '2021-05-04 23:57:09', '2021-05-04 23:57:09', NULL),
(308, 1, 70, 78, 0, NULL, '2021-05-04 23:57:12', '2021-05-04 23:57:12', NULL),
(309, 2, 70, 77, 0, NULL, '2021-05-04 23:57:13', '2021-05-04 23:57:13', NULL),
(310, 2, 70, 76, 0, NULL, '2021-05-04 23:57:14', '2021-05-04 23:57:14', NULL),
(311, 1, 70, 75, 0, NULL, '2021-05-04 23:57:18', '2021-05-04 23:57:18', NULL),
(312, 2, 70, 74, 0, NULL, '2021-05-04 23:57:20', '2021-05-04 23:57:20', NULL),
(313, 1, 70, 73, 0, NULL, '2021-05-04 23:57:21', '2021-05-04 23:57:21', NULL),
(314, 1, 70, 72, 0, NULL, '2021-05-04 23:57:23', '2021-05-04 23:57:23', NULL),
(315, 2, 70, 71, 0, NULL, '2021-05-04 23:57:26', '2021-05-04 23:57:26', NULL),
(316, 74, 70, 81, 0, NULL, '2021-05-04 23:59:59', '2021-05-04 23:59:59', NULL),
(317, 2, 70, 70, 0, NULL, '2021-05-05 00:00:01', '2021-05-05 00:00:01', NULL),
(318, -100, 70, NULL, 2, NULL, '2021-05-05 00:01:12', '2021-05-05 00:01:12', NULL),
(319, 1, 70, 82, 0, NULL, '2021-05-05 00:01:43', '2021-05-05 00:01:43', NULL),
(320, 46, 70, 84, 0, NULL, '2021-05-05 00:12:28', '2021-05-05 00:12:28', NULL),
(321, 44, 70, 83, 0, NULL, '2021-05-05 00:12:32', '2021-05-05 00:12:32', NULL),
(322, 306, 70, 69, 0, NULL, '2021-05-05 00:12:39', '2021-05-05 00:12:39', NULL),
(323, 1, 70, 68, 0, NULL, '2021-05-05 00:12:41', '2021-05-05 00:12:41', NULL),
(324, 1, 70, 67, 0, NULL, '2021-05-05 00:12:44', '2021-05-05 00:12:44', NULL),
(325, 2, 70, 66, 0, NULL, '2021-05-05 00:12:46', '2021-05-05 00:12:46', NULL),
(326, 175, 70, 65, 0, NULL, '2021-05-05 00:12:49', '2021-05-05 00:12:49', NULL),
(327, 2, 70, 64, 0, NULL, '2021-05-05 00:12:52', '2021-05-05 00:12:52', NULL),
(328, 5, 70, 63, 0, NULL, '2021-05-05 00:12:54', '2021-05-05 00:12:54', NULL),
(329, 2, 70, 62, 0, NULL, '2021-05-05 00:12:56', '2021-05-05 00:12:56', NULL),
(330, 3, 70, 15, 0, NULL, '2021-05-05 00:12:59', '2021-05-05 00:12:59', NULL),
(331, 3, 70, 14, 0, NULL, '2021-05-05 00:13:01', '2021-05-05 00:13:01', NULL),
(332, 3, 70, 13, 0, NULL, '2021-05-05 00:13:03', '2021-05-05 00:13:03', NULL),
(333, 3, 70, 12, 0, NULL, '2021-05-05 00:13:05', '2021-05-05 00:13:05', NULL),
(334, 3, 70, 11, 0, NULL, '2021-05-05 00:13:07', '2021-05-05 00:13:07', NULL),
(335, 1, 70, 10, 0, NULL, '2021-05-05 00:13:09', '2021-05-05 00:13:09', NULL),
(336, 1, 70, 9, 0, NULL, '2021-05-05 00:13:11', '2021-05-05 00:13:11', NULL),
(337, 1, 70, 8, 0, NULL, '2021-05-05 00:13:59', '2021-05-05 00:13:59', NULL),
(338, 1, 70, 7, 0, NULL, '2021-05-05 00:14:01', '2021-05-05 00:14:01', NULL),
(339, 2, 70, 6, 0, NULL, '2021-05-05 00:14:02', '2021-05-05 00:14:02', NULL),
(340, 4, 70, 61, 0, NULL, '2021-05-05 00:47:39', '2021-05-05 00:47:39', NULL),
(341, 175, 70, 60, 0, NULL, '2021-05-05 00:47:41', '2021-05-05 00:47:41', NULL),
(342, 306, 70, 59, 0, NULL, '2021-05-05 00:47:43', '2021-05-05 00:47:43', NULL),
(343, 306, 70, 58, 0, NULL, '2021-05-05 00:47:45', '2021-05-05 00:47:45', NULL),
(344, 4, 70, 56, 0, NULL, '2021-05-05 00:47:47', '2021-05-05 00:47:47', NULL),
(345, 1, 70, 55, 0, NULL, '2021-05-05 00:47:49', '2021-05-05 00:47:49', NULL),
(346, 3, 70, 53, 0, NULL, '2021-05-05 00:47:51', '2021-05-05 00:47:51', NULL),
(347, 3, 70, 52, 0, NULL, '2021-05-05 00:47:53', '2021-05-05 00:47:53', NULL),
(348, 3, 70, 51, 0, NULL, '2021-05-05 00:47:55', '2021-05-05 00:47:55', NULL),
(349, 3, 70, 50, 0, NULL, '2021-05-05 00:47:57', '2021-05-05 00:47:57', NULL),
(350, 4, 70, 49, 0, NULL, '2021-05-05 00:47:59', '2021-05-05 00:47:59', NULL),
(351, 2, 70, 47, 0, NULL, '2021-05-05 00:48:01', '2021-05-05 00:48:01', NULL),
(352, 1, 70, 44, 0, NULL, '2021-05-05 00:48:03', '2021-05-05 00:48:03', NULL),
(353, 1, 70, 43, 0, NULL, '2021-05-05 00:48:06', '2021-05-05 00:48:06', NULL),
(354, 2, 70, 36, 0, NULL, '2021-05-05 00:48:08', '2021-05-05 00:48:08', NULL),
(355, 1, 70, 34, 0, NULL, '2021-05-05 00:48:11', '2021-05-05 00:48:11', NULL),
(356, 2, 70, 33, 0, NULL, '2021-05-05 00:48:16', '2021-05-05 00:48:16', NULL),
(357, 2, 70, 32, 0, NULL, '2021-05-05 00:48:18', '2021-05-05 00:48:18', NULL),
(358, 1, 70, 31, 0, NULL, '2021-05-05 00:48:20', '2021-05-05 00:48:20', NULL),
(359, 1, 70, 30, 0, NULL, '2021-05-05 00:48:24', '2021-05-05 00:48:24', NULL),
(360, 1, 70, 19, 0, NULL, '2021-05-05 00:48:26', '2021-05-05 00:48:26', NULL),
(361, 1, 70, 18, 0, NULL, '2021-05-05 00:48:27', '2021-05-05 00:48:27', NULL),
(362, 1, 70, 17, 0, NULL, '2021-05-05 00:48:28', '2021-05-05 00:48:28', NULL),
(363, 3, 70, 16, 0, NULL, '2021-05-05 00:48:29', '2021-05-05 00:48:29', NULL),
(364, 2, 70, 5, 0, NULL, '2021-05-05 00:48:30', '2021-05-05 00:48:30', NULL),
(365, 1, 70, 4, 0, NULL, '2021-05-05 00:48:31', '2021-05-05 00:48:31', NULL),
(366, 1, 70, 3, 0, NULL, '2021-05-05 00:48:32', '2021-05-05 00:48:32', NULL),
(367, 1, 70, 2, 0, NULL, '2021-05-05 00:48:33', '2021-05-05 00:48:33', NULL),
(368, 1, 70, 1, 0, NULL, '2021-05-05 00:48:34', '2021-05-05 00:48:34', NULL),
(369, 1, 70, 29, 0, NULL, '2021-05-05 00:49:24', '2021-05-05 00:49:24', NULL),
(370, 1, 70, 28, 0, NULL, '2021-05-05 00:49:27', '2021-05-05 00:49:27', NULL),
(371, 2, 70, 27, 0, NULL, '2021-05-05 00:49:30', '2021-05-05 00:49:30', NULL),
(372, 2, 70, 26, 0, NULL, '2021-05-05 00:49:32', '2021-05-05 00:49:32', NULL),
(373, 1, 70, 25, 0, NULL, '2021-05-05 00:49:34', '2021-05-05 00:49:34', NULL),
(374, 1, 70, 24, 0, NULL, '2021-05-05 00:49:35', '2021-05-05 00:49:35', NULL),
(375, 1, 70, 23, 0, NULL, '2021-05-05 00:49:37', '2021-05-05 00:49:37', NULL),
(376, 3, 70, 22, 0, NULL, '2021-05-05 00:49:39', '2021-05-05 00:49:39', NULL),
(377, 1, 70, 21, 0, NULL, '2021-05-05 00:49:40', '2021-05-05 00:49:40', NULL),
(378, 3, 70, 20, 0, NULL, '2021-05-05 00:49:41', '2021-05-05 00:49:41', NULL),
(379, 100, 70, NULL, 2, NULL, '2021-05-30 20:34:49', '2021-05-30 20:34:49', NULL),
(380, 100, 70, NULL, 2, NULL, '2021-05-30 20:35:17', '2021-05-30 20:35:17', NULL),
(381, 100, 70, NULL, 2, NULL, '2021-05-30 20:35:38', '2021-05-30 20:35:38', NULL),
(382, 100, 70, NULL, 2, NULL, '2021-05-30 20:45:05', '2021-05-30 20:45:05', NULL),
(383, 100, 70, NULL, 2, NULL, '2021-05-30 20:52:15', '2021-05-30 20:52:15', NULL),
(384, 100, 70, NULL, 2, NULL, '2021-05-30 20:55:02', '2021-05-30 20:55:02', NULL),
(385, 100, 70, NULL, 2, NULL, '2021-05-30 21:10:45', '2021-05-30 21:10:45', NULL),
(386, 5, 70, 185, 0, NULL, '2021-06-09 06:31:29', '2021-06-09 06:31:29', NULL),
(387, 306, 70, 183, 0, NULL, '2021-06-09 06:32:24', '2021-06-09 06:32:24', NULL),
(388, 1, 70, 187, 0, NULL, '2021-06-09 23:00:11', '2021-06-09 23:00:11', NULL),
(389, 2, 70, 186, 0, NULL, '2021-06-09 23:33:03', '2021-06-09 23:33:03', NULL),
(390, 2, 70, 179, 0, NULL, '2021-06-09 23:33:20', '2021-06-09 23:33:20', NULL),
(391, -100, 70, NULL, 2, NULL, '2021-06-09 23:54:04', '2021-06-09 23:54:04', NULL),
(392, 2, 70, 190, 0, NULL, '2021-06-09 23:55:25', '2021-06-09 23:55:25', NULL),
(393, -100, 70, NULL, 2, NULL, '2021-06-09 23:56:04', '2021-06-09 23:56:04', NULL),
(394, 2, 70, 192, 0, NULL, '2021-06-10 01:37:21', '2021-06-10 01:37:21', NULL),
(395, 4, 70, 172, 0, NULL, '2021-06-10 05:19:52', '2021-06-10 05:19:52', NULL),
(396, 2, 70, 191, 0, NULL, '2021-06-10 05:19:54', '2021-06-10 05:19:54', NULL),
(397, 2, 70, 189, 0, NULL, '2021-06-10 05:19:56', '2021-06-10 05:19:56', NULL),
(398, 2, 70, 178, 0, NULL, '2021-06-10 05:19:58', '2021-06-10 05:19:58', NULL),
(399, 1, 70, 177, 0, NULL, '2021-06-10 05:19:59', '2021-06-10 05:19:59', NULL),
(400, 2, 70, 176, 0, NULL, '2021-06-10 05:20:00', '2021-06-10 05:20:00', NULL),
(401, 2, 70, 175, 0, NULL, '2021-06-10 05:20:01', '2021-06-10 05:20:01', NULL),
(402, 2, 70, 174, 0, NULL, '2021-06-10 05:20:03', '2021-06-10 05:20:03', NULL),
(403, 2, 70, 173, 0, NULL, '2021-06-10 05:20:04', '2021-06-10 05:20:04', NULL),
(404, 2, 70, 171, 0, NULL, '2021-06-10 05:20:05', '2021-06-10 05:20:05', NULL),
(405, 2, 70, 170, 0, NULL, '2021-06-10 05:20:06', '2021-06-10 05:20:06', NULL),
(406, 2, 70, 169, 0, NULL, '2021-06-10 05:20:08', '2021-06-10 05:20:08', NULL),
(407, 2, 70, 168, 0, NULL, '2021-06-10 05:20:09', '2021-06-10 05:20:09', NULL),
(408, 0, 70, 167, 0, NULL, '2021-06-10 05:20:10', '2021-06-10 05:20:10', NULL),
(409, 3, 70, 166, 0, NULL, '2021-06-10 05:20:11', '2021-06-10 05:20:11', NULL),
(410, 3, 70, 165, 0, NULL, '2021-06-10 05:20:23', '2021-06-10 05:20:23', NULL),
(411, 3, 70, 164, 0, NULL, '2021-06-10 05:20:25', '2021-06-10 05:20:25', NULL),
(412, 3, 70, 163, 0, NULL, '2021-06-10 05:20:26', '2021-06-10 05:20:26', NULL),
(413, 3, 70, 162, 0, NULL, '2021-06-10 05:20:27', '2021-06-10 05:20:27', NULL),
(414, 3, 70, 161, 0, NULL, '2021-06-10 05:20:29', '2021-06-10 05:20:29', NULL),
(415, 3, 70, 160, 0, NULL, '2021-06-10 05:20:30', '2021-06-10 05:20:30', NULL),
(416, 3, 70, 159, 0, NULL, '2021-06-10 05:20:31', '2021-06-10 05:20:31', NULL),
(417, 3, 70, 158, 0, NULL, '2021-06-10 05:20:38', '2021-06-10 05:20:38', NULL),
(418, 3, 70, 157, 0, NULL, '2021-06-10 05:20:39', '2021-06-10 05:20:39', NULL),
(419, 3, 70, 156, 0, NULL, '2021-06-10 05:20:41', '2021-06-10 05:20:41', NULL),
(420, 3, 70, 154, 0, NULL, '2021-06-10 05:20:42', '2021-06-10 05:20:42', NULL),
(421, 3, 70, 153, 0, NULL, '2021-06-10 05:20:44', '2021-06-10 05:20:44', NULL),
(422, 3, 70, 152, 0, NULL, '2021-06-10 05:20:45', '2021-06-10 05:20:45', NULL),
(423, 3, 70, 151, 0, NULL, '2021-06-10 05:20:48', '2021-06-10 05:20:48', NULL),
(424, 3, 70, 150, 0, NULL, '2021-06-10 05:20:49', '2021-06-10 05:20:49', NULL),
(425, 3, 70, 149, 0, NULL, '2021-06-10 05:20:52', '2021-06-10 05:20:52', NULL),
(426, 3, 70, 148, 0, NULL, '2021-06-10 05:20:55', '2021-06-10 05:20:55', NULL),
(427, 3, 70, 147, 0, NULL, '2021-06-10 05:20:56', '2021-06-10 05:20:56', NULL),
(428, 3, 70, 146, 0, NULL, '2021-06-10 05:21:01', '2021-06-10 05:21:01', NULL),
(429, 3, 70, 145, 0, NULL, '2021-06-10 05:21:05', '2021-06-10 05:21:05', NULL),
(430, 1, 70, 129, 0, NULL, '2021-06-10 05:21:08', '2021-06-10 05:21:08', NULL),
(431, 1, 70, 128, 0, NULL, '2021-06-10 05:21:09', '2021-06-10 05:21:09', NULL),
(432, 1, 70, 127, 0, NULL, '2021-06-10 05:21:11', '2021-06-10 05:21:11', NULL),
(433, 1, 70, 126, 0, NULL, '2021-06-10 05:21:13', '2021-06-10 05:21:13', NULL),
(434, 1, 70, 125, 0, NULL, '2021-06-10 05:21:15', '2021-06-10 05:21:15', NULL),
(435, 1, 70, 124, 0, NULL, '2021-06-10 05:21:16', '2021-06-10 05:21:16', NULL),
(436, 1, 70, 123, 0, NULL, '2021-06-10 05:21:18', '2021-06-10 05:21:18', NULL),
(437, 6, 70, 122, 0, NULL, '2021-06-10 05:21:19', '2021-06-10 05:21:19', NULL),
(438, 4, 70, 121, 0, NULL, '2021-06-10 05:21:20', '2021-06-10 05:21:20', NULL),
(439, 4, 70, 120, 0, NULL, '2021-06-10 05:21:21', '2021-06-10 05:21:21', NULL),
(440, 0, 70, 119, 0, NULL, '2021-06-10 05:21:22', '2021-06-10 05:21:22', NULL),
(441, 2, 70, 118, 0, NULL, '2021-06-10 05:21:23', '2021-06-10 05:21:23', NULL),
(442, 1, 70, 117, 0, NULL, '2021-06-10 05:21:25', '2021-06-10 05:21:25', NULL),
(443, 8, 70, 116, 0, NULL, '2021-06-10 05:21:27', '2021-06-10 05:21:27', NULL),
(444, 1, 70, 115, 0, NULL, '2021-06-10 05:21:29', '2021-06-10 05:21:29', NULL),
(445, 1, 70, 114, 0, NULL, '2021-06-10 05:21:31', '2021-06-10 05:21:31', NULL),
(446, 1, 70, 113, 0, NULL, '2021-06-10 05:21:32', '2021-06-10 05:21:32', NULL),
(447, 1, 70, 112, 0, NULL, '2021-06-10 05:21:34', '2021-06-10 05:21:34', NULL),
(448, 8, 70, 111, 0, NULL, '2021-06-10 05:21:35', '2021-06-10 05:21:35', NULL),
(449, 8, 70, 110, 0, NULL, '2021-06-10 05:21:36', '2021-06-10 05:21:36', NULL),
(450, 8, 70, 109, 0, NULL, '2021-06-10 05:21:38', '2021-06-10 05:21:38', NULL),
(451, 8, 70, 108, 0, NULL, '2021-06-10 05:21:39', '2021-06-10 05:21:39', NULL),
(452, 8, 70, 107, 0, NULL, '2021-06-10 05:21:42', '2021-06-10 05:21:42', NULL),
(453, 8, 70, 106, 0, NULL, '2021-06-10 05:21:43', '2021-06-10 05:21:43', NULL),
(454, 8, 70, 105, 0, NULL, '2021-06-10 05:21:45', '2021-06-10 05:21:45', NULL),
(455, 3, 70, 135, 0, NULL, '2021-06-10 05:21:46', '2021-06-10 05:21:46', NULL),
(456, 3, 70, 134, 0, NULL, '2021-06-10 05:21:48', '2021-06-10 05:21:48', NULL),
(457, 8, 70, 133, 0, NULL, '2021-06-10 05:21:49', '2021-06-10 05:21:49', NULL),
(458, 1, 70, 131, 0, NULL, '2021-06-10 05:21:51', '2021-06-10 05:21:51', NULL),
(459, 1, 70, 130, 0, NULL, '2021-06-10 05:21:52', '2021-06-10 05:21:52', NULL),
(460, 3, 70, 155, 0, NULL, '2021-06-10 05:21:56', '2021-06-10 05:21:56', NULL),
(461, 3, 70, 144, 0, NULL, '2021-06-10 05:21:57', '2021-06-10 05:21:57', NULL),
(462, 3, 70, 143, 0, NULL, '2021-06-10 05:21:59', '2021-06-10 05:21:59', NULL),
(463, 3, 70, 142, 0, NULL, '2021-06-10 05:22:00', '2021-06-10 05:22:00', NULL),
(464, 3, 70, 141, 0, NULL, '2021-06-10 05:22:01', '2021-06-10 05:22:01', NULL),
(465, 3, 70, 140, 0, NULL, '2021-06-10 05:22:02', '2021-06-10 05:22:02', NULL),
(466, 3, 70, 139, 0, NULL, '2021-06-10 05:22:03', '2021-06-10 05:22:03', NULL),
(467, 3, 70, 138, 0, NULL, '2021-06-10 05:22:04', '2021-06-10 05:22:04', NULL),
(468, 3, 70, 137, 0, NULL, '2021-06-10 05:22:05', '2021-06-10 05:22:05', NULL),
(469, 3, 70, 136, 0, NULL, '2021-06-10 05:22:06', '2021-06-10 05:22:06', NULL),
(470, 2, 70, 195, 0, NULL, '2021-06-11 01:05:54', '2021-06-11 01:05:54', NULL),
(471, 2, 70, 199, 0, NULL, '2021-06-11 01:26:51', '2021-06-11 01:26:51', NULL),
(472, 2, 70, 198, 0, NULL, '2021-06-11 01:26:52', '2021-06-11 01:26:52', NULL),
(473, 2, 70, 202, 0, NULL, '2021-06-11 02:20:15', '2021-06-11 02:20:15', NULL),
(474, 1, 70, 203, 0, NULL, '2021-06-11 02:21:57', '2021-06-11 02:21:57', NULL),
(475, 2, 70, 241, 0, NULL, '2021-06-28 04:06:11', '2021-06-28 04:06:11', NULL),
(476, 1, 70, 305, 0, NULL, '2021-08-08 03:48:05', '2021-08-08 03:48:05', NULL),
(478, 1, 70, 322, 0, NULL, '2021-09-30 06:30:38', '2021-09-30 06:30:38', NULL),
(479, 1, 182, 325, 0, NULL, '2021-10-13 06:49:33', '2021-10-13 06:49:33', NULL),
(480, 2, 70, 326, 0, NULL, '2022-02-27 06:41:29', '2022-02-27 06:41:29', NULL),
(481, 2, 70, 328, 0, NULL, '2022-02-27 08:42:13', '2022-02-27 08:42:13', NULL),
(482, 20, 70, 311, 3, NULL, '2022-04-06 11:09:13', '2022-04-06 11:09:13', NULL),
(483, 1, 70, 306, 0, NULL, '2022-04-06 11:22:11', '2022-04-06 11:22:11', NULL),
(484, 2, 70, 304, 0, NULL, '2022-04-06 11:22:14', '2022-04-06 11:22:14', NULL),
(485, 3, 184, 334, 0, NULL, '2022-05-31 03:05:07', '2022-05-31 03:05:07', NULL),
(486, 100, 70, NULL, 2, NULL, '2022-07-02 21:45:19', '2022-07-02 21:45:19', NULL),
(487, 13, 70, 336, 0, NULL, '2022-08-06 23:41:41', '2022-08-06 23:41:41', NULL),
(488, 1, 204, 15, 0, NULL, '2022-08-13 20:58:11', '2022-08-13 20:58:11', NULL),
(489, 10, 204, 16, 0, NULL, '2022-08-13 20:59:43', '2022-08-13 20:59:43', NULL),
(491, 5, 204, NULL, 2, NULL, '2022-08-13 21:08:38', '2022-08-13 21:08:38', NULL),
(494, 5, 204, 17, 4, NULL, '2022-08-13 21:14:11', '2022-08-13 21:14:11', NULL),
(495, 2, 204, 18, 0, NULL, '2022-08-14 16:55:34', '2022-08-14 16:55:34', NULL),
(496, 0, 70, 19, 4, NULL, '2022-08-15 14:57:48', '2022-08-15 14:57:48', NULL),
(497, 500, 93, 52, 0, NULL, '2022-08-15 15:01:26', '2022-08-15 15:01:26', NULL),
(498, 1000, 93, 51, 0, NULL, '2022-08-24 01:08:28', '2022-08-18 01:08:34', NULL),
(499, 250, 93, 53, 0, NULL, '2022-08-24 01:08:42', '2022-08-19 01:08:45', NULL),
(500, 40, 70, 117, 0, NULL, '2022-08-29 21:35:31', '2022-08-29 21:35:31', NULL),
(501, 57, 231, 121, 0, NULL, '2022-08-30 16:11:10', '2022-08-30 16:11:10', NULL),
(502, 705, 231, 122, 0, NULL, '2022-08-30 16:13:09', '2022-08-30 16:13:09', NULL),
(503, 25, 231, 123, 0, NULL, '2022-08-30 16:14:39', '2022-08-30 16:14:39', NULL),
(504, 40, 70, 137, 0, NULL, '2022-09-01 20:49:25', '2022-09-01 20:49:25', NULL),
(505, 250, 231, 140, 0, NULL, '2022-09-01 20:55:53', '2022-09-01 20:55:53', NULL),
(506, 7, 231, 142, 0, NULL, '2022-09-03 14:16:08', '2022-09-03 14:16:08', NULL),
(507, 7, 231, 148, 0, NULL, '2022-09-03 19:09:57', '2022-09-03 19:09:57', NULL),
(508, 7, 231, 145, 0, NULL, '2022-09-03 19:10:02', '2022-09-03 19:10:02', NULL),
(509, 7, 231, 143, 0, NULL, '2022-09-03 19:10:05', '2022-09-03 19:10:05', NULL),
(510, 32, 231, 157, 0, NULL, '2022-09-04 04:27:18', '2022-09-04 04:27:18', NULL),
(511, 2, 231, 2, 0, NULL, '2022-09-06 00:02:52', '2022-09-06 00:02:52', NULL),
(512, 7, 231, 16, 0, NULL, '2022-09-06 00:30:05', '2022-09-06 00:30:05', NULL),
(513, 35, 231, 32, 0, NULL, '2022-09-06 01:43:11', '2022-09-06 01:43:11', NULL),
(514, 7, 231, 36, 0, NULL, '2022-09-06 02:57:11', '2022-09-06 02:57:11', NULL),
(515, 40, 231, 35, 0, NULL, '2022-09-06 13:47:53', '2022-09-06 13:47:53', NULL),
(516, 70, 231, 118, 0, NULL, '2022-09-07 19:36:09', '2022-09-07 19:36:09', NULL),
(517, 5, 231, 115, 0, NULL, '2022-09-07 19:42:01', '2022-09-07 19:42:01', NULL),
(518, 2, 231, 125, 0, NULL, '2022-09-08 00:02:19', '2022-09-08 00:02:19', NULL),
(519, 7, 231, 128, 0, NULL, '2022-09-08 00:12:40', '2022-09-08 00:12:40', NULL),
(520, 8, 231, 130, 0, NULL, '2022-09-08 16:08:28', '2022-09-08 16:08:28', NULL),
(521, 40, 231, 131, 0, NULL, '2022-09-08 17:15:51', '2022-09-08 17:15:51', NULL),
(522, 9, 231, 132, 0, NULL, '2022-09-08 17:15:55', '2022-09-08 17:15:55', NULL),
(523, 40, 231, 133, 0, NULL, '2022-09-08 17:16:01', '2022-09-08 17:16:01', NULL),
(524, 15, 231, 135, 0, NULL, '2022-09-08 17:18:09', '2022-09-08 17:18:09', NULL),
(525, 27, 231, 134, 0, NULL, '2022-09-08 17:18:20', '2022-09-08 17:18:20', NULL),
(526, 15, 231, 136, 0, NULL, '2022-09-08 17:19:46', '2022-09-08 17:19:46', NULL),
(527, 48, 231, 137, 0, NULL, '2022-09-08 17:19:57', '2022-09-08 17:19:57', NULL),
(528, 7, 231, 150, 0, NULL, '2022-09-10 01:12:18', '2022-09-10 01:12:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(2, 'cashier', 'Cashier', NULL, NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(3, 'customer', 'Customer', NULL, NULL, '2020-02-11 03:31:50', '2020-02-11 03:31:50'),
(5, 'Branch Manager', 'Branch Manager', NULL, NULL, '2020-10-20 17:45:31', '2020-10-20 17:45:31'),
(7, 'Test', 'Test', 'Test', NULL, '2020-12-23 22:49:47', '2020-12-23 22:49:47'),
(8, 'ssss', 'Molly Clay', 'Sunt aut corporis au', NULL, '2021-05-19 18:24:56', '2021-05-19 18:24:56'),
(9, 'owner1', 'owner2', NULL, NULL, '2021-09-23 13:14:54', '2021-09-23 13:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(91, 1),
(93, 1),
(98, 1),
(197, 1),
(90, 2),
(156, 2),
(197, 2),
(203, 2),
(204, 2),
(241, 2),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(75, 3),
(76, 3),
(79, 3),
(82, 3),
(85, 3),
(87, 3),
(89, 3),
(91, 3),
(94, 3),
(95, 3),
(121, 3),
(122, 3),
(123, 3),
(124, 3),
(125, 3),
(127, 3),
(129, 3),
(130, 3),
(131, 3),
(132, 3),
(133, 3),
(134, 3),
(135, 3),
(136, 3),
(137, 3),
(138, 3),
(139, 3),
(140, 3),
(141, 3),
(142, 3),
(143, 3),
(144, 3),
(145, 3),
(146, 3),
(147, 3),
(148, 3),
(149, 3),
(150, 3),
(152, 3),
(153, 3),
(154, 3),
(157, 3),
(158, 3),
(159, 3),
(162, 3),
(163, 3),
(164, 3),
(165, 3),
(166, 3),
(167, 3),
(168, 3),
(169, 3),
(170, 3),
(171, 3),
(172, 3),
(175, 3),
(176, 3),
(180, 3),
(181, 3),
(182, 3),
(183, 3),
(184, 3),
(185, 3),
(186, 3),
(187, 3),
(188, 3),
(189, 3),
(190, 3),
(191, 3),
(192, 3),
(199, 3),
(200, 3),
(201, 3),
(202, 3),
(208, 3),
(209, 3),
(210, 3),
(211, 3),
(212, 3),
(213, 3),
(214, 3),
(215, 3),
(216, 3),
(217, 3),
(218, 3),
(219, 3),
(220, 3),
(221, 3),
(222, 3),
(224, 3),
(225, 3),
(226, 3),
(227, 3),
(231, 3),
(235, 3),
(236, 3),
(238, 3),
(239, 3),
(240, 3),
(242, 3),
(243, 3),
(244, 3),
(245, 3),
(246, 3),
(247, 3),
(248, 3),
(249, 3),
(250, 3),
(251, 3),
(252, 3),
(253, 3),
(254, 3),
(255, 3),
(256, 3),
(257, 3),
(258, 3),
(259, 3),
(260, 3),
(261, 3),
(262, 3),
(263, 3),
(96, 5),
(97, 5),
(179, 5),
(151, 7);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taxes` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `third_party_user_ids`
--

CREATE TABLE `third_party_user_ids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `google_user_id` text COLLATE utf8_unicode_ci,
  `facebook_user_id` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activation_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_offer_available` tinyint(1) NOT NULL DEFAULT '1',
  `token` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `middle_name`, `last_name`, `first_phone`, `second_phone`, `image`, `email`, `age`, `email_verified_at`, `active`, `activation_token`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `created_by`, `updated_by`, `branch_id`, `device_token`, `first_offer_available`, `token`) VALUES
(70, 'Eng Wael', 'Eng', 'Middle', 'Wael', '0098764321', NULL, NULL, 'abdosrs@yahoo.com', '40', '2021-06-07 21:06:56', 1, '', '$2y$10$HFJxmTJnOBh2t2UKnl7V0urIU2C7a8LKZfTrtpwed0Ngvc1Vd5axG', 'GSG1AgzefclG8E0OQnUWFAVClzKTbGYN51UYAjVXDhVCe1NmhgotUGRgEoJs', NULL, '2020-03-23 03:56:54', '2022-09-06 14:40:33', NULL, NULL, NULL, NULL, 0, NULL),
(71, 'Mohannad Elemary', 'Mohannad', NULL, 'Elemary', '+966837263546', NULL, NULL, 'wael123@gmail.com', '30', NULL, 1, '', '$2y$10$MUDEVRd4mE6uae/GTpPuTeZgcsWxrIm2k4LXpcMJV.lDe5TJ7Eh3S', 'zoH7QnDrmMGoyYtqqUk4MCNXmou5Tet6xClQcPTeMe6I250nz4bgr2NKDodc', NULL, '2020-03-23 04:04:03', '2022-08-11 15:47:28', NULL, NULL, NULL, NULL, 0, NULL),
(72, 'Wael Elsersy', 'Wael', NULL, 'Elsersy', '+966556688997', NULL, NULL, 'test@yahoo.com', '45', NULL, 1, '', '$2y$10$HweOwImnYdkkwXIkffMtEOTenAv9/mRtNK0fVF4E2.f/P2oG79JrK', 'yHxP4AYm5AzkvfYZlpHxbq4RTpaTaqJBsIN935bzyoaqWO8bn5WoxJ4pKbB1', NULL, '2020-03-23 04:08:32', '2020-03-23 09:01:00', NULL, NULL, NULL, NULL, 0, NULL),
(73, 'Hhshh dbbdbd', 'Hhshh', NULL, 'dbbdbd', '+966369785587', NULL, NULL, 'app@test.com', NULL, NULL, 0, '776924', '$2y$10$99Gmv5QGBfJGlorrBNB4GOCaq.e5URGdTeSMidovzbBOPXk6Mv/VS', NULL, NULL, '2020-03-23 06:49:57', '2020-03-23 06:49:57', NULL, NULL, NULL, NULL, 1, NULL),
(75, 'Wael farouk', 'Wael', NULL, 'farouk', '+966551234567', NULL, NULL, 'test@gmail.com', '45', NULL, 1, '', '$2y$10$3cd6I2H.D6gNQTVnlnHUJOB6KOnLpFXMAHQd0XcCV1OqkOOnNOdke', 'CN0XLiUpRNxM24rxf6pX9oEF2ovc0wGNsSc41EgbZL7JZOxwVOA5rLgQ4YAl', NULL, '2020-03-30 05:55:17', '2020-03-30 06:07:27', NULL, NULL, NULL, NULL, 0, NULL),
(76, 'Mohamed yousef', 'Mohamed', NULL, 'yousef', '+966555555555', NULL, NULL, 'mo.alarand@gmail.com', '22', NULL, 1, '', '$2y$10$iNJll900TuBTBusKf.q.YOeK5S0B0RtKdEJXeM7D//dLJmwPJ7.oy', 'g7a8xQgIVgcFBrWLk5Q4A3pzvsZETsv0o1S5eX8qh7xAJ9If2jNmegU1TUAK', NULL, '2020-04-06 03:28:21', '2020-04-06 13:42:47', NULL, NULL, NULL, NULL, 0, NULL),
(79, 'youssef ali', 'youssef', NULL, 'ali', '+966558955543', NULL, NULL, 'youssef4242014@gmail.com', '24', NULL, 1, '', '$2y$10$.zCGYAwxpyXo0BqYSWBfye/DGhOh0aegzxFez6kqUEIpfmVRTfrM6', 'QdnyS4RvGmHWuLTGzkfG7nmogx8g4nmVkIxBaftu0un4QKazcWZ1Wokac2KR', NULL, '2020-04-21 03:23:43', '2020-05-03 23:10:14', NULL, NULL, NULL, NULL, 0, NULL),
(82, 'youssef ali', 'youssef', NULL, 'ali', '+966555554444', NULL, NULL, 'youssefAliGaber@gmail.com', '24', NULL, 1, '', '$2y$10$Yd6haEt8FVS.Od5/os0ll.iotaIP3YE9SJlZJEZsXZnhhRWIpUDB2', 'FvRGTqgiyIdgdIsEQT395K7ytUzYWndAGcU78AdypiaIWUjwssvkU7EIwSdT', NULL, '2020-05-04 02:03:25', '2020-05-04 02:10:41', NULL, NULL, NULL, NULL, 1, NULL),
(85, 'محمد صلاح', 'محمد', NULL, 'صلاح', '+966555666886', NULL, NULL, 'wael@tikzon.com', '40', NULL, 1, '', '$2y$10$PdMrPHKMFiBypytHQyI43OH43Hq2HD6pw4UFfz7Zb173KW0Dl5DFa', NULL, NULL, '2020-05-04 06:00:20', '2020-05-04 06:05:40', NULL, NULL, NULL, NULL, 1, NULL),
(87, 'Mohamed almnje', 'Mohamed', NULL, 'almnje', '+966534678040', NULL, NULL, 'm.almnje19@gmail.com', '28', NULL, 0, '693040', '$2y$10$kD9kMiWYHwLF4pEJs8lvU.ohQT0kvjl1AgcJa62Y.53iIj6c1FbKW', NULL, NULL, '2020-08-09 06:01:10', '2020-08-09 06:01:10', NULL, NULL, NULL, NULL, 1, NULL),
(89, 'Sherif Mohammed', 'Sherif', NULL, 'Mohammed', '+966536242999', NULL, NULL, 'sherifmim15@gmail.com', '44', NULL, 0, '208854', '$2y$10$mmWsdNOKn.5fuSXmv3mae.tCoUx2yAXrZwLl772R4nECDijphPDny', NULL, NULL, '2020-08-23 19:27:19', '2020-08-23 19:27:19', NULL, NULL, NULL, NULL, 1, NULL),
(90, 'Andalus branch', 'Andalus', NULL, 'branch', '01018618600', NULL, NULL, 'Andalus@gmail.com', '22', NULL, 1, '', '$2a$04$lmhdntiRV6TfOv9yTypaqe8i1T18MyZeknWPo6WbaKRX9Glga0yju', NULL, NULL, '2020-08-24 05:01:27', '2020-08-24 05:01:27', NULL, NULL, NULL, NULL, 1, NULL),
(91, 'ahmed Ahmed', 'ahmed', NULL, 'Ahmed', NULL, NULL, NULL, 'ahmed@gmail.com', '25', NULL, 1, '', '$2a$04$Z3aIm1HIocpBL/pWuH5oBu3qbqvb40NAGM7tyZYQFxrCWr0IPfWqm', NULL, NULL, '2020-08-31 03:15:34', '2022-08-11 19:48:26', NULL, NULL, NULL, NULL, 0, NULL),
(93, 'admin test test', 'admin', 'test', 'test', '0102123456789', '0114365254544', NULL, 'admintest@gmail.com', '12', NULL, 1, '', '$2y$10$HFJxmTJnOBh2t2UKnl7V0urIU2C7a8LKZfTrtpwed0Ngvc1Vd5axG', 's3m0b7pfdvrY7MlM0dPEYFOajoxB5LGdZVrThfp9D7Sje0MAOdpucfqWOpYp', NULL, '2020-09-29 15:51:24', '2022-08-16 19:49:27', NULL, NULL, NULL, NULL, 1, NULL),
(94, 'admin test', 'admin', NULL, 'test', '123456789', NULL, NULL, 'test5@gmail.com', NULL, NULL, 0, '', '$2y$10$S5bA266GwewK0eDWB/L4o.UkiPyaLHyPksMKVTBRMXuWX0AarmE2i', NULL, NULL, '2020-09-29 20:44:51', '2020-09-29 20:44:51', NULL, NULL, NULL, NULL, 1, NULL),
(95, '11111 11111', '11111', NULL, '11111', '11111111', NULL, NULL, 'qqqqq@212solutions.com', NULL, NULL, 0, '', '$2y$10$wQSUXdvBSZTbIDdLQqqBeOSqjaue9GLPnWd11ASxnaxq9.EmHfp92', NULL, NULL, '2020-09-30 18:50:07', '2020-09-30 18:50:07', NULL, NULL, NULL, NULL, 1, NULL),
(96, 'Branch Manager', 'Branch', NULL, 'Manager', '0102123456789', '01234567890', '', 'admin@admin.com', '24', NULL, 1, '', '$2y$10$AfSKMu5RYkizLM61mJMqsOp1HdPba4gTZbwaXScnNUlVykY10cYjW', 'wFEhB6xB88MS9cpJL2QpiwSi8HROGctlRBSvYwakbJ5JtrAx8bW3O47Zj9X9', NULL, '2020-10-19 20:47:35', '2020-10-19 20:47:35', NULL, NULL, NULL, NULL, 1, NULL),
(97, 'admin test', 'admin', NULL, 'test', '11111111', '01234567890', '', 'a@a.com', '12', NULL, 1, '', '$2y$10$IB8pNHusB2V.AWUyYJuL5uVczYkhk2N39h0ykWfoj6Y.xeHsrIVXe', NULL, NULL, '2020-10-20 16:28:39', '2020-10-20 16:28:39', NULL, NULL, NULL, NULL, 1, NULL),
(98, 'admin test', 'admin', NULL, 'test', '0102123456789', '01234567890', '', 'qqq@qaaa.com', '12', NULL, 1, '', '$2y$10$Oeismqs6Ewb6I2KUU3wxKuHMw9MkojSI.kK1oBzeJRYRsi2xc1pUG', NULL, NULL, '2020-10-20 16:31:53', '2020-10-20 16:31:53', NULL, NULL, NULL, NULL, 1, NULL),
(121, 'new oned', 'new', NULL, 'oned', '01018618608', NULL, NULL, 'new1@gmail.comd1', NULL, NULL, 0, '131200', '$2y$10$.ooAOtO02ScGxewoN.Sh8eTYPsfXWqGvoc0FW3DNu8zb9t6TNcNXW', NULL, NULL, '2020-11-08 15:26:32', '2020-11-08 15:26:32', NULL, NULL, NULL, NULL, 1, NULL),
(122, 'new oned', 'new', NULL, 'oned', '01018618608332', NULL, NULL, 'new11@gmail.comd1ff', NULL, NULL, 0, '494149', '$2y$10$V.87OGWRPgxzMVVUHvzqHuHOlaNKUD45namOfzP0iUMzzzOodnmv.', NULL, NULL, '2020-11-09 14:50:38', '2020-11-09 14:50:38', NULL, NULL, NULL, NULL, 1, NULL),
(123, 'new oned', 'new', NULL, 'oned', '12312331211', NULL, NULL, 'new11@gmail.comd1ffs', NULL, NULL, 0, '867260', '$2y$10$k8jfDfsOzrsmjMGuVpnW8eZ0JdtbRF8jqmhSyzZLhVaTglcr1bgRu', NULL, NULL, '2020-11-09 14:51:36', '2020-11-09 14:51:36', NULL, NULL, NULL, NULL, 1, NULL),
(124, 'new oned', 'new', NULL, 'oned', '01091404269', NULL, NULL, 'new11@gmail.comd1ffsq', NULL, NULL, 0, '432050', '$2y$10$8D49FWgBB.1FmzOLd4m6Wu3mhsYSigeKO7wR59OxJPH3Fl4DyioVu', NULL, NULL, '2020-11-09 14:52:51', '2020-11-09 14:52:51', NULL, NULL, NULL, NULL, 1, NULL),
(125, 'new oned', 'new', NULL, 'oned', '01091404261', NULL, NULL, 'new11@gmail.comd1ffsqd', NULL, NULL, 0, '920436', '$2y$10$BKBPN/t3fogpgfL1uabWvuqDi5.d.rfmSg5i6TsXRJEYsFfrTVS2G', NULL, NULL, '2020-11-09 14:57:41', '2020-11-09 14:57:41', NULL, NULL, NULL, NULL, 1, NULL),
(127, 'tst test', 'tst', NULL, 'test', '+201033170097', NULL, NULL, 'test@test.com', NULL, NULL, 0, '560976', '$2y$10$hvJzrEwRMeSUZBAb.S/vgeqh8ePplVLRb3nGeOWHwtxEa6cNgMyta', NULL, NULL, '2020-11-09 20:14:48', '2020-11-09 20:14:48', NULL, NULL, NULL, NULL, 1, NULL),
(129, 'youssef ali', 'youssef', NULL, 'ali', '+966123456780', NULL, NULL, 'h@gmail.com', '24', NULL, 0, '359531', '$2y$10$7doMdMVVbjWRYfZWmwB7p.Ee4/h8lmNliu0smn8hQKpkmYJMWV.n2', NULL, NULL, '2020-11-10 23:48:11', '2020-11-10 23:48:11', NULL, NULL, NULL, NULL, 1, NULL),
(130, 'youssef ali', 'youssef', NULL, 'ali', '+966123456789', NULL, NULL, 'g@g.com', '24', '2022-08-27 08:45:16', 0, '473043', '$2y$10$zoFPy8/wnKNnRU/yK9AAhuEwAD88psZqnuVx6Le3q3FCLq9Z2OXSq', NULL, NULL, '2020-11-10 23:50:11', '2022-08-27 15:45:16', NULL, NULL, NULL, NULL, 1, NULL),
(131, 'yousef ali', 'yousef', NULL, 'ali', '+966123456788', NULL, NULL, 'g@h.com', '24', NULL, 0, '541448', '$2y$10$c0mdA2amK4u7ifr/.Ed4xu3idlhlegb3/qb/VKPAIdghc95PqwgoS', NULL, NULL, '2020-11-10 23:52:33', '2020-11-10 23:52:33', NULL, NULL, NULL, NULL, 1, NULL),
(132, 'test test', 'test', NULL, 'test', '01234567895', NULL, NULL, 'dd@yahoo.com', NULL, NULL, 0, '287395', '$2y$10$FISvWxqOQu/acvXFoRRaI.3lOaIHzmgGiEwYHA7/DIkcCDzvVCOSe', NULL, NULL, '2020-11-11 00:29:22', '2020-11-11 00:29:22', NULL, NULL, NULL, NULL, 1, NULL),
(133, 'test test', 'test', NULL, 'test', '01234567898', NULL, NULL, 'd2d@yahoo.com', NULL, NULL, 0, '727215', '$2y$10$pSf.0b8h3/8AHwk7plyIHOZ.VmqGYcrcgMTjCH49lGCv54ADSwYum', NULL, NULL, '2020-11-11 00:32:17', '2020-11-11 00:32:17', NULL, NULL, NULL, NULL, 1, NULL),
(134, 'test test', 'test', NULL, 'test', '01234567891', NULL, NULL, 'd23d@yahoo.com', NULL, NULL, 0, '364525', '$2y$10$gvQa8oHEzRZP/ajQWNOOGuNkI3UCfQZQxM4LR8LT4PAsEe8dreHC6', NULL, NULL, '2020-11-11 00:33:18', '2020-11-11 00:33:18', NULL, NULL, NULL, NULL, 1, NULL),
(135, 'test test', 'test', NULL, 'test', '+201114897188', NULL, NULL, 'esraaa@gmail.com', NULL, NULL, 0, '121721', '$2y$10$VsdLQTPzFp5ozeVbPRaZRuXNaB08za.3bRpUIoSZUpCA32gGPbjUW', NULL, NULL, '2020-11-11 00:47:11', '2020-11-11 00:47:11', NULL, NULL, NULL, NULL, 1, NULL),
(136, 'new oned', 'new', NULL, 'oned', '01018618609', NULL, NULL, 'new11@gmail.comd15', NULL, NULL, 0, '330555', '$2y$10$6josbbmqWFFAhdwczxrJ8OPrNWQ5.KaPs3IcfQJsTA/qFXr2uuxMq', NULL, NULL, '2020-11-11 02:37:57', '2020-11-11 02:37:57', NULL, NULL, NULL, NULL, 1, NULL),
(137, 'new oned', 'new', NULL, 'oned', '01018618655', NULL, NULL, 'new31@gmail.comd', NULL, NULL, 0, '873514', '$2y$10$U5iaZhMU3iCcBEQajofh8OKNotg2W0WaJ6FdClf4E3DrQyaJfA70.', NULL, NULL, '2020-11-11 02:38:42', '2020-11-11 02:38:42', NULL, NULL, NULL, NULL, 1, NULL),
(138, 'new oned', 'new', NULL, 'oned', '01018618677', NULL, NULL, 'new31@gmail.comddd', NULL, NULL, 0, '263376', '$2y$10$HIX6Oz7TYbH5pvwQFZi7deYepe2LFGo7yRr773sMllprVfuLmavv.', NULL, NULL, '2020-11-11 02:44:22', '2020-11-11 02:44:22', NULL, NULL, NULL, NULL, 1, NULL),
(139, 'new oned', 'new', NULL, 'oned', '010186186771', NULL, NULL, 'new31@gmail.comdddd', NULL, NULL, 0, '218932', '$2y$10$vE9UpWKD6fvijaMQhCgQ0.bY3PCmgaUxUuAb2c3ZFt7.6cIWvlnpC', NULL, NULL, '2020-11-11 02:44:52', '2020-11-11 02:44:52', NULL, NULL, NULL, NULL, 1, NULL),
(140, 'yousef ali', 'yousef', NULL, 'ali', '+966123456799', NULL, NULL, 'g@j.com', '24', NULL, 0, '419737', '$2y$10$ep/df5PADJPsR5EOE5/m5.94EEvdaq3BatqDD8yWo.0QeVrY/QD2m', NULL, NULL, '2020-11-11 02:46:15', '2020-11-11 02:46:15', NULL, NULL, NULL, NULL, 1, NULL),
(141, 'yousef ali', 'yousef', NULL, 'ali', '+966123456700', NULL, NULL, 'g@l.com', '24', NULL, 0, '137525', '$2y$10$HwWKLv/skiWniURKZznP.O9/riMYKZAB65KBjUXHHryRIzZ9m2QqG', NULL, NULL, '2020-11-11 02:46:52', '2020-11-11 02:46:52', NULL, NULL, NULL, NULL, 1, NULL),
(142, 'youssef ali', 'youssef', NULL, 'ali', '+966123456789', NULL, NULL, 'aa@aa.com', '24', NULL, 0, '139466', '$2y$10$c1LaTNFDwSHWr.70ryq31e0o4jM1GLkfYEDmqs/p3ea/zTxGCd0aO', NULL, NULL, '2020-11-13 00:26:17', '2020-11-13 00:26:17', NULL, NULL, NULL, NULL, 1, NULL),
(143, 'youssef ali', 'youssef', NULL, 'ali', '+201114897180', NULL, NULL, 'a1@a.com', '25', NULL, 1, '', '$2y$10$Z41BaV/IJhqr2g2gGjct1.ZPbml7XCt495mFJILhmGUbcwa.MxqIO', '2M66jceWx0fUfkKqj3r2SluxWEeMTiArSZ4JvPmBFhTho6EP9vXI0728qCp1', NULL, '2020-11-13 00:27:29', '2020-11-13 00:28:31', NULL, NULL, NULL, NULL, 1, NULL),
(144, 'y a', 'y', NULL, 'a', '+201114897180', NULL, NULL, 'dd@dd.com', '24', NULL, 1, '', '$2y$10$w00h6IrBRh4turyuUF9T8eUKYBs06Zm2eAgkstMpFKVYsx3oBlG6u', 'bDOmD8LMlkY53NgOYjiBPSWQYGgHElIWcF3agUm0FxEIIGi8gQJTTHdsUWUZ', NULL, '2020-11-13 00:36:11', '2020-11-13 00:40:13', NULL, NULL, NULL, NULL, 1, NULL),
(145, 'y a', 'y', NULL, 'a', '+201114897180', NULL, NULL, 'ty@y.com', '24', NULL, 0, '838420', '$2y$10$2JStAIyLI3t0zg9SZCY5Be1YdT1JpP14yQPKMrA80c4RJ73Q2GfvK', NULL, NULL, '2020-11-13 00:45:13', '2020-11-13 00:45:13', NULL, NULL, NULL, NULL, 1, NULL),
(146, 'Noor Wael', 'Noor', NULL, 'Wael', '+966551234567', NULL, NULL, 'noor@gmail.com', '20', NULL, 0, '170438', '$2y$10$Rz91ivZ0TmM/TScKNz3cseEzgSmIqK.lM5E5VypOmP244eV4QZeDq', NULL, NULL, '2020-11-15 22:40:06', '2020-11-15 22:40:06', NULL, NULL, NULL, NULL, 1, NULL),
(147, 'Wael moh', 'Wael', NULL, 'moh', '+966553692587', NULL, NULL, 'standard@gmail.com', '25', NULL, 0, '496709', '$2y$10$IYNqO6f8EUaRYpIHv3/1l.KwGg9Svmkh1PDir.WBwk/WrYYjCAC.6', NULL, NULL, '2020-11-15 22:47:27', '2020-11-15 22:47:27', NULL, NULL, NULL, NULL, 1, NULL),
(148, 'test test', 'test', NULL, 'test', '+201114897188', NULL, NULL, 'esraaha@gmail.com', NULL, NULL, 0, '289798', '$2y$10$aICglXVLYvTy65.o2ibRUO34mgStU.Xzhnvb0vUmnU9pa0Ipt5.iS', NULL, NULL, '2020-11-15 22:53:22', '2020-11-15 22:53:22', NULL, NULL, NULL, NULL, 1, NULL),
(149, 'test test', 'test', NULL, 'test', '+201033170097', NULL, NULL, 'twesr@gmail.com', NULL, NULL, 0, '488774', '$2y$10$wyZCFWJpLv2KY6pnWc2Yt.0p80pVCc0kL7fHvn2PVY6YBPHN4iry.', NULL, NULL, '2020-11-15 23:01:28', '2020-11-15 23:01:28', NULL, NULL, NULL, NULL, 1, NULL),
(150, 'test test', 'test', NULL, 'test', '+201033170097', NULL, NULL, 'ttr@gmail.com', NULL, NULL, 0, '380097', '$2y$10$sHalVkFJLOqdFVCPcUXBdO.nUH3aCSVmBABbxCf3UDYB7y64ktdHa', NULL, NULL, '2020-11-15 23:13:12', '2020-11-15 23:13:12', NULL, NULL, NULL, NULL, 1, NULL),
(151, 'Test Test', 'Test', NULL, 'Test', '01478523690', '01478523694', '', 'test26@gmail.com', '21', NULL, 1, '', '$2y$10$WejQd4VrUE5X42T6f47bLOBkSU9oJA7EnkUflj3ATfFkZvZxxky16', 'n79l67R6o8uGGVfJZXLe4olw5ijRP3aiSvErHM6LHpVVusmwA1CLDPMaK7eO', NULL, '2020-12-23 22:51:13', '2020-12-23 22:51:13', NULL, NULL, NULL, NULL, 1, NULL),
(152, 'محمد الجزار', 'محمد', NULL, 'الجزار', '+966656885658', NULL, NULL, 'engmohamedelgzar2010@gmail.com', '28', NULL, 0, '271446', '$2y$10$Rco/DtixMGzpqaCwOhTdb.rJi6X2Lv9n9T7fv5jyQpQSdfXml.OVq', NULL, NULL, '2020-12-30 04:38:57', '2020-12-30 04:38:57', NULL, NULL, NULL, NULL, 1, NULL),
(153, 'Mohamed Ahmed', 'Mohamed', NULL, 'Ahmed', '+966998877445', NULL, NULL, 'mohamedahmed@gmail.com', '30', NULL, 0, '645864', '$2y$10$rh2JNhOIYprLCYFNrRWzFepxsmUtHnRrNEBeBokCVH9eeqafWTCvu', NULL, NULL, '2021-03-17 05:22:16', '2021-03-17 05:22:16', NULL, NULL, NULL, NULL, 1, NULL),
(154, 'Djdjd duudud', 'Djdjd', NULL, 'duudud', '+966542570147', NULL, NULL, 'Abdulrahmannabil12@gmail.com', '9494', NULL, 0, '958667', '$2y$10$GmnFEP0Ngz6GjTWVNf1SAePA8gOFDUSHhHglHtrFZucYOvE1Mj0D2', NULL, NULL, '2021-04-28 01:06:04', '2021-04-28 01:06:04', NULL, NULL, NULL, NULL, 1, NULL),
(156, 'ccc ccc ccc', 'ccc', 'ccc', 'ccc', '05512345678', '05512345678', '', 'cc@cc.com', '19', NULL, 1, '', '$2a$04$lmhdntiRV6TfOv9yTypaqe8i1T18MyZeknWPo6WbaKRX9Glga0yju', NULL, NULL, '2021-06-09 05:22:48', '2021-06-09 05:22:48', NULL, NULL, NULL, NULL, 1, NULL),
(157, 'Hamada Samir', 'Hamada', NULL, 'Samir', '+9665555555', NULL, NULL, 'hamada.samir@gmail.com', '36', NULL, 0, '294311', '$2y$10$3.9s2ocTRn6dssYUtBlwneraNY7GqDCA76N9QUsX93T0wyqkyLdoC', NULL, NULL, '2021-06-09 10:57:16', '2021-06-09 10:57:16', NULL, NULL, NULL, NULL, 1, NULL),
(158, 'User 2', 'User', NULL, '2', '+966101553250', NULL, NULL, 'user2@app.com', '20', NULL, 0, '976480', '$2y$10$qwOfyBeg8Sn29o4/km4FU.b5eOzjSUs97gg4lxswccACp2CNWaD8a', NULL, NULL, '2021-06-09 23:47:32', '2021-06-09 23:47:32', NULL, NULL, NULL, NULL, 1, NULL),
(159, 'Mohamed Hassan', 'Mohamed', NULL, 'Hassan', '01123211442', NULL, NULL, 'mohamedhassan225588@gmail.com', NULL, '2021-07-08 23:32:56', 0, '527769', '$2y$10$ZREyozi2leZXHnpM1LcrhuEfV.gYMUmTxSd8YjvzG0O0N7IjNJWTa', NULL, NULL, '2021-07-09 06:32:18', '2021-07-09 06:32:56', NULL, NULL, NULL, NULL, 1, NULL),
(162, 'Testing User', 'Testing', NULL, 'User', '+966123456789', NULL, NULL, 'test@example.com', '35', NULL, 0, '692063', '$2y$10$itpT37XBnLmzB3gnY9WsMevL1MbacK5MFEjyPw3nEIv1kajZYIBMK', NULL, NULL, '2021-08-11 16:11:30', '2021-08-11 16:11:30', NULL, NULL, NULL, NULL, 1, NULL),
(163, 'Mohamed test', 'Mohamed', NULL, 'test', '+966920022222', NULL, NULL, 'mohamedhassan@cis.asu.edu.eg', '23', NULL, 0, '261587', '$2y$10$lpjUra/P7b7AI9LCJka83evEGGV6Hvgdfxte1v1BWDW0hekzdHv7e', NULL, NULL, '2021-08-12 02:14:42', '2021-08-12 02:14:42', NULL, NULL, NULL, NULL, 1, NULL),
(164, 'Mohamed test', 'Mohamed', NULL, 'test', '+966920022222', NULL, NULL, 'mohamedan@cis.asu.edu.eg', '23', NULL, 0, '741715', '$2y$10$9A.IH8A1lEb2msH0jpBZROE9n.CjRgeUIKWbFXaB12zrks9L7JCcq', NULL, NULL, '2021-08-12 02:31:07', '2021-08-12 02:31:07', NULL, NULL, NULL, NULL, 1, NULL),
(165, 'Mohamed test', 'Mohamed', NULL, 'test', '+966920022222', NULL, NULL, 'mohamed@cis.asu.edu.eg', '23', NULL, 0, '395614', '$2y$10$i533ZRPlIcfIWx.dgYhNTuVdTEY6cuYs7MRRZye4q3KmDP101lq6e', NULL, NULL, '2021-08-12 02:32:10', '2021-08-12 02:32:10', NULL, NULL, NULL, NULL, 1, NULL),
(166, 'mhmm test', 'mhmm', NULL, 'test', '966920022223', NULL, NULL, 'mohamed@gmail.com', NULL, NULL, 0, '518368', '$2y$10$7gN98XTJ9aTdp099e8FVDutje/izXqBL3nih2UG61iZMgtiDSwSt.', NULL, NULL, '2021-08-12 02:35:44', '2021-08-12 02:35:44', NULL, NULL, NULL, NULL, 1, NULL),
(167, 'mhmm test', 'mhmm', NULL, 'test', '05512345678', NULL, NULL, 'mohamede@gmail.com', NULL, NULL, 0, '347594', '$2y$10$WICmJ0hXFrQbiou6PxD0GO3qbp.SjlDdnkfYu3g0m.Cf1FtWKqdmu', NULL, NULL, '2021-08-12 02:36:29', '2021-08-12 02:36:29', NULL, NULL, NULL, NULL, 1, NULL),
(168, 'mhmm test', 'mhmm', NULL, 'test', '05512345674', NULL, NULL, 'mohamedtre@gmail.com', NULL, NULL, 0, '198228', '$2y$10$R7cEMzdN26hOU4mMlSuDKubm.HmQU8TxQy8s9vvT3Yg8xOIzLFvuK', NULL, NULL, '2021-08-12 02:36:50', '2021-08-12 02:36:50', NULL, NULL, NULL, NULL, 1, NULL),
(169, 'mhmm test', 'mhmm', NULL, 'test', '05512345674', NULL, NULL, 'mohamedtree@gmail.com', NULL, NULL, 0, '458944', '$2y$10$LYAZPJXz8QqAnjKTXzIyceFYpgyoxEBa7wAclXMiQAcTEO4UtA1y2', NULL, NULL, '2021-08-12 02:37:19', '2021-08-12 02:37:19', NULL, NULL, NULL, NULL, 1, NULL),
(170, 'mhmm test', 'mhmm', NULL, 'test', '05512345674', NULL, NULL, 'mohamedtest1@gmail.com', NULL, NULL, 0, '866001', '$2y$10$dPWIETUalHXKQ0DjcrB/7.u5zkV4Rjfz5FSD6x8omrflC6RVzqn7m', NULL, NULL, '2021-08-12 02:39:04', '2021-08-12 02:39:04', NULL, NULL, NULL, NULL, 1, NULL),
(171, 'mhmm test', 'mhmm', NULL, 'test', '05512345674', NULL, NULL, 'mohamedtest31@gmail.com', NULL, NULL, 0, '829682', '$2y$10$FwhHNG1Z.RXeq3SU4zpyEuep1XxMLC308IqtcrgfE7OGSI6Xd7B5q', NULL, NULL, '2021-08-12 02:39:31', '2021-08-12 02:39:31', NULL, NULL, NULL, NULL, 1, NULL),
(172, 'محمد جمال ابراهيم', 'محمد', NULL, 'جمال', '00966550920800', NULL, NULL, 'eng_mohgamal81@yahoo.com', NULL, NULL, 0, '552020', '$2y$10$Q7JrzAV538vr51pHczWXyucsd6nJj.v1CJj8Dj2gGkNkQ0t1u9OLm', NULL, NULL, '2021-08-28 22:36:26', '2021-08-28 22:36:26', NULL, NULL, NULL, NULL, 1, NULL),
(175, 'ahmed mohamed el morshdey', 'ahmed', 'mohamed', 'el morshdey', '00912345678945', NULL, '/customers/1631888221male-profile-avatar-with-brown-hair-vector-12055105.jpeg', 'ahmed@212solutionsllc.com', NULL, NULL, 0, '', '$2y$10$x2cYHk/cqYrBlx29bqLA3OC6T.bMr/0MMDTJ8FiOY1Ko95LO3WaVm', NULL, NULL, '2021-09-18 04:17:01', '2021-09-18 04:17:01', NULL, NULL, NULL, NULL, 1, NULL),
(176, 'mohamed test', 'mohamed', NULL, 'test', '01123211555789', NULL, '', 'sayed@212solutionsllc.com', NULL, NULL, 0, '', '$2y$10$/OlScEyxtf35TPwN2lrveOBijE6L0eHq33c5JK3a09yeY5OW3F3p2', NULL, NULL, '2021-09-22 15:07:17', '2021-09-22 15:07:17', NULL, NULL, NULL, NULL, 1, NULL),
(179, 'ahmed grggwgrwg vasvasvas', 'ahmed', 'grggwgrwg', 'vasvasvas', '12345678901234', '12345678901234', '', 'abdo@gmail.com', NULL, NULL, 1, '', '$2y$10$JVd9dn.iP3cxPergRNDTO.2/CvA5DXLEwCrYMY2VvDviR.xIPgv7q', NULL, NULL, '2021-09-23 13:49:16', '2021-09-23 13:49:16', NULL, NULL, NULL, NULL, 1, NULL),
(180, 'ahmed el morshdey', 'ahmed', NULL, 'el', '01234567890', NULL, NULL, 'morshdey@gmail.com', NULL, NULL, 0, '219062', '$2y$10$b2zNY.FW/KwmZcLDZAtTBu9gB2qxouLeK7iclvQ8aPuqNZaHuFtwK', NULL, NULL, '2021-09-24 04:32:33', '2021-09-24 04:32:33', NULL, NULL, NULL, NULL, 1, NULL),
(181, 'ahmed el morshdey', 'ahmed', NULL, 'el', '00987654321234', NULL, NULL, 'morshdey@hotmail.com', NULL, '2021-09-24 00:58:05', 1, '349152', '$2y$10$3lr1pqyVlncuff9NNtD69uJ7DPDhegD2kyW3vOBl0tlzDq0Vheu0C', NULL, NULL, '2021-09-24 05:25:38', '2021-09-24 05:25:38', NULL, NULL, NULL, NULL, 1, NULL),
(182, 'Ahmed  mohamed', 'Ahmed', NULL, '', '+966123456789', NULL, NULL, 'morshdeymhmm@gmail.com', '39', NULL, 1, '', '$2y$10$RE0LKkKwGo/VnC8grjVQdO.t8Txec5g53HkJZ7u1hBkxFSZHXMjlC', 'K7jFfPCwxRTuk6BzfhIW1r2fuHFbh6r5YwC0xb0wfWNi44XzFUDTIAg32S9l', NULL, '2021-10-13 06:41:36', '2021-10-13 06:48:51', NULL, NULL, NULL, NULL, 0, NULL),
(183, 'unique alharby', 'unique', NULL, 'alharby', '966596981646', NULL, NULL, 'harbi484@gmail.com', NULL, NULL, 0, '245719', '$2y$10$pcSRWFOx6IW/.GWgK0ILUuh1YZbfT1fdyT3S2BK.08lKNBOeqnwQ6', NULL, NULL, '2022-03-03 18:18:34', '2022-03-03 18:18:34', NULL, NULL, NULL, NULL, 1, NULL),
(184, 'nader galal', 'nader', NULL, 'galal', '966535122111', NULL, NULL, 'naderyanoo@hotmail.com', NULL, '2022-03-20 17:25:26', 0, '811949', '$2y$10$a9fOFkBs9QwYTKFSwdUf0evi/V3QTjgUTgWvd09qQhgxQmSvxFWt6', NULL, NULL, '2022-03-19 23:52:23', '2022-03-21 00:25:26', NULL, NULL, NULL, NULL, 1, NULL),
(185, 'nader galal', 'nader', NULL, 'galal', '966535122111', NULL, NULL, 'nader.galal10@hotmail.com', NULL, '2022-03-19 16:54:16', 0, '821515', '$2y$10$COt4ldw6eYAZkSiyUJnYv.4aVDPOjqe7isEm22SiZINrSZpqnqRP2', NULL, NULL, '2022-03-19 23:53:30', '2022-03-19 23:54:16', NULL, NULL, NULL, NULL, 1, NULL),
(186, 'فواز الزعبي', 'فواز', NULL, 'الزعبي', '966553757076', NULL, NULL, 'ofawazx@gmail.com', NULL, NULL, 0, '107256', '$2y$10$dkHyXhaMN3w.JybK9sfqGeX2U0ir19hh0w3UJW7QyWaTohFfhugGG', NULL, NULL, '2022-03-31 04:44:09', '2022-03-31 04:44:09', NULL, NULL, NULL, NULL, 1, NULL),
(187, 'Abdullah alkhldi', 'Abdullah', NULL, 'alkhldi', '00966500547747', NULL, NULL, 'abdullah-alkhldi@hotmail.com', NULL, NULL, 0, '835109', '$2y$10$U9IwMjl4YslMPCWNtbBijeZiYyktGoLAlqdaPMtPecjwzSSqJWKHm', NULL, NULL, '2022-04-01 11:38:34', '2022-04-01 11:38:34', NULL, NULL, NULL, NULL, 1, NULL),
(188, 'Abade Salman', 'Abade', NULL, 'Salman', '966553856006', NULL, NULL, 'aljameai@gmail.com', NULL, '2022-04-06 02:04:07', 0, '438691', '$2y$10$Lcb5huwGJe0W0QRLuZgrEuWh2cuPIagq3cGSaNHt063eGOG2Mtci.', NULL, NULL, '2022-04-06 08:57:34', '2022-04-06 09:04:07', NULL, NULL, NULL, NULL, 1, NULL),
(189, 'kamal hossain', 'kamal', NULL, 'hossain', '+966570027979', NULL, NULL, 'hosssinkamal17@gmail.com', '32', NULL, 0, '570944', '$2y$10$h4hjt6ylBxBX.4UlXapLne4b2858Gxxz.O6pOI8z2U9VHoZ4GyhdW', NULL, NULL, '2022-04-18 10:14:18', '2022-04-18 10:14:18', NULL, NULL, NULL, NULL, 1, NULL),
(190, 'kamal hossain', 'kamal', NULL, 'hossain', '+966570027979', NULL, NULL, 'kh7639559@gmail.com', '32', NULL, 0, '736098', '$2y$10$Vba84DFMfEWUyzK0prUci.2PcbMR0etXr9zOqI8vPms.2g5nvF34.', NULL, NULL, '2022-04-18 10:20:12', '2022-04-18 10:20:12', NULL, NULL, NULL, NULL, 1, NULL),
(191, 'kamal hossain', 'kamal', NULL, 'hossain', '+966570027979', NULL, NULL, 'kh7275904@gmail.com', '32', NULL, 0, '837565', '$2y$10$ums8I28OpKpw.su54DnQveENwNJZLjV0ljrcSGI1MIuZopp0vyNKy', NULL, NULL, '2022-04-18 10:30:30', '2022-04-18 10:30:30', NULL, NULL, NULL, NULL, 1, NULL),
(192, 'سلطان سعود', 'سلطان', NULL, 'سعود', '00966569693869', NULL, NULL, 's6s9ss@hotmail.com', NULL, NULL, 0, '912211', '$2y$10$qd4UFRUdWaEogR.xIXPQk.gSKuUo8Kmkaqf4cQckTnjMUyQOv80zi', NULL, NULL, '2022-06-05 08:40:42', '2022-06-05 08:40:42', NULL, NULL, NULL, NULL, 1, NULL),
(197, 'Ahmed Adel', 'Ahmed', NULL, 'Adel', '+966523415456', NULL, NULL, 'abo3adel35@gmail.com', '25', '2022-06-20 15:24:55', 1, '555556', '$2y$10$l43NfFkG5f/UTh1uHdNjaOeGHStkBb1du7oiSzbeTlLsw.6fA6V4O', NULL, NULL, NULL, '2022-08-21 15:58:23', NULL, NULL, NULL, NULL, 1, NULL),
(199, 'Ahmed Adel', 'Ahmed', NULL, 'Adel', '01143645787', NULL, NULL, 'abo3adel35@gmail.comw', NULL, NULL, 0, '445000', '$2y$10$7gMJ7oLtjZB9bzWVnq2W4eFKZArsRcytNY/GwNyvtd4aA4tyKc2Qi', NULL, NULL, '2022-08-10 21:49:57', '2022-08-10 21:49:57', NULL, NULL, NULL, NULL, 1, NULL),
(200, 'Ahmed Adel', 'Ahmed', NULL, 'Adel', '01143645787', NULL, NULL, 'abo3adel35@gmail.comww', NULL, NULL, 0, '707113', '$2y$10$tYw5AVndnDRQBO8WfLwG3eMhdVDfkHfVcWqu4q3xcF7AEBi2W9TAG', NULL, NULL, '2022-08-10 22:37:41', '2022-08-10 22:37:41', NULL, NULL, NULL, NULL, 1, NULL),
(201, 'Ahmed Adel', 'Ahmed', NULL, 'Adel', '01143645787', NULL, NULL, 'abo3adel35@gmail.comwww', NULL, NULL, 0, '253047', '$2y$10$FsISM4L2Oa4MX8JAr5cQX.IEdRZf73kInJl6YnebIlNoDcnHFmADC', NULL, NULL, '2022-08-10 22:38:24', '2022-08-10 22:38:24', NULL, NULL, NULL, NULL, 1, NULL),
(202, 'Ahmed Adel', 'Ahmed', NULL, 'Adel', '01143645787', NULL, NULL, 'abo3adel35@gmail.comwwww', NULL, NULL, 0, '651374', '$2y$10$db.nfF1d1sDKBBJDx12rU.xsPItGHerssgscMtmf3yIkNeUIos.BK', NULL, NULL, '2022-08-10 22:39:41', '2022-08-10 22:39:41', NULL, NULL, NULL, NULL, 1, NULL),
(203, 'Ahwwww aeeeeeeeee sww', 'Ahwwww', 'aeeeeeeeee', 'sww', '01123654789521', NULL, '', 'ahmed@gmail.comw', '22', NULL, 1, '', '$2y$10$0BwSznb0A2YMlTYyECag8u5UgGy6PxMokMVpXcSu0tUt5rZ1aNy/G', NULL, NULL, '2022-08-11 15:30:07', '2022-08-11 15:30:07', NULL, NULL, NULL, NULL, 1, NULL),
(204, 'ahmed adel', 'ahmed', NULL, 'adel', '01143647417', NULL, NULL, 'ahmed2@gmail.com', '25', '2022-09-01 13:48:40', 1, '523850', '$2y$10$xI8AZXK7B3wt7flNIsc77uMVOcaJ/x2ljNTHpPkRZKnwkT9gj4PRS', NULL, NULL, '2022-08-13 20:49:27', '2022-09-01 20:48:40', NULL, NULL, NULL, NULL, 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4MzU4NDgyMTA5OGJkZTU0NTIxYjg1MGY2MjA5OTZmYjE4MzUxMTI2ZjBjNDg0YTUwOTYwM2I1ZGMxMGIxNmFmNTVhNzY4ZDhkY2U5YTFlIn0.eyJhdWQiOiIzIiwianRpIjoiMzgzNTg0ODIxMDk4YmRlNTQ1MjFiODUwZjYyMDk5NmZiMTgzNTExMjZmMGM0ODRhNTA5NjAzYjVkYzEwYjE2YWY1NWE3NjhkOGRjZTlhMWUiLCJpYXQiOjE2NjIwNDAxMjAsIm5iZiI6MTY2MjA0MDEyMCwiZXhwIjoxNjkzNTc2MTIwLCJzdWIiOiIyMDQiLCJzY29wZXMiOltdfQ.Y8kr2aK-iIIZdoiTW4YUwLCpKXIU5qFv1DoPUOPDsnZ5BRCBWKgZP3ZnSXai0hr8Ba9zy7_eTJv4levBvWzfPj9ZU1A-PlY2QA52EAktMzLsvW_sVWPkkbgxlJT5q7TLV3JkEJLnEM63zUz1dnKwM4rLCVP-JXMOpGNVf82tUV9K5x-uihyJRFtlP-F_ltt4CY6Kp_w_3Rs9rFu7PfPw9Q23MedGYrr_RG1LLu0sOHkSylZmiT4NiH4YYBh4N65xe7jO7HSZPlOK2X73Zs5YHRmFc4yTOd4bUXqSQLRKDjzAYtT-TeeqNmQCtOvU9CmdXWELpjZWg9iBqzDGqXw5F1FdRjwqNnsI8KXxNMNTh8v9h63xrFIrM2EFU9UaOPbH9WFmvfNI9Fhm78Qooo9VsM79OsxU1REzNK0Oetw6RUVIbD0V724byszJvYPokJPPh_Zg8aowoAjoAxPi1QLIfgUtMIXP3kiIBsmn9hAvopy-vfH566PZxW40Aw7Ebh0byy8y8QpyuNV8-ftAma6NoZTr3SahFy8a-0THa9GnDzJ-0N0EqbRb6cqSl8uNhHgTVEzB3zSUJzNrClPJKgzVccQ7_T_frsMB-Ktm8dC3XoutOmofytp9CAS0x6jl3wmAcyrXDMuAFaaXVMybJpCK0E7W7mHNqFCa9A0JsnYwb2Y'),
(208, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445564', NULL, NULL, 'abo3adel35@gmail.com2', NULL, NULL, 0, '829561', '$2y$10$Yux7/2FPXel.sEjrrHTMy./OtSAMQwwtyvLnAb9FnMICSlpbFWXtG', NULL, NULL, '2022-08-17 22:20:02', '2022-08-17 22:20:02', NULL, NULL, NULL, NULL, 1, NULL),
(209, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445564', NULL, NULL, 'abo3adel35@gmail.comwwwwww', NULL, '2022-08-18 16:47:39', 0, '341117', '$2y$10$FsDbLLJxYKSxcdFNg9nVu.gMKmAd6EBDkzq5CkWoXIRSkbxRb88E.', NULL, NULL, '2022-08-18 23:39:32', '2022-08-18 23:47:39', NULL, NULL, NULL, NULL, 1, NULL),
(210, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445564', NULL, NULL, 'abo3adel35@gmail.comqasasasas', NULL, NULL, 0, '493581', '$2y$10$lppAKLJZ9jKN1jMKjsEmgeSKkjy4AMqAkw0W2dNFS0beUsQIBhvdi', NULL, NULL, '2022-08-21 16:09:39', '2022-08-21 16:09:39', NULL, NULL, NULL, NULL, 1, NULL),
(211, 'home lastwwwwwwwq', 'home', NULL, 'lastwwwwwwwq', '032415445564332', NULL, NULL, 'abdosrs@yahoo.comwwwww', NULL, NULL, 0, '153137', '$2y$10$h8j.wkZBB5zbrIRGhMYAsuuLLvSe2.L22Dx2NqG6dE7q9ZrQR3Q96', NULL, NULL, '2022-08-21 16:12:18', '2022-08-21 16:12:18', NULL, NULL, NULL, NULL, 1, NULL),
(212, 'home lastwwwwwwwq', 'home', NULL, 'lastwwwwwwwq', '032415445564332', NULL, NULL, 'abdosrs@yahoo.comwwwwwwewewewe', NULL, NULL, 0, '599807', '$2y$10$4FTZDbAtuSlH6ZQ8I2phK.2WlU0cIgf7yMgpaXcYjd/uzNkTsxe7e', NULL, NULL, '2022-08-21 16:13:44', '2022-08-21 16:13:44', NULL, NULL, NULL, NULL, 1, NULL),
(213, 'home lastw', 'home', NULL, 'lastw', '01145266448978544', NULL, NULL, 'abo3adel35@gmail.comwwwwwwwwwwwww', NULL, '2022-08-21 09:16:46', 0, '440851', '$2y$10$Bgjk3nz3ZrEE.caaoGM3oeniwGNzb5fj95Lb/2.nHUMoeMWYB7lqC', NULL, NULL, '2022-08-21 16:16:21', '2022-08-21 16:16:46', NULL, NULL, NULL, NULL, 1, NULL),
(214, 'home lastwq', 'home', NULL, 'lastwq', '03241544522564', NULL, NULL, 'ahmed@gmail.comeeeeeeee', NULL, NULL, 0, '586967', '$2y$10$D9nrlp2dzGB5tVp1DiajKe3VqHqqBet2fcHXC6hFOffjg2vY4T6Nu', NULL, NULL, '2022-08-21 16:18:51', '2022-08-21 16:18:51', NULL, NULL, NULL, NULL, 1, NULL),
(215, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143647417', NULL, NULL, 'abo3adel35@gmail.comewewe', NULL, NULL, 0, '420383', '$2y$10$rQJtKoH6F9/SCdJFMZnydO/XPa305./WK4Q2SqgcihmqkWkQSSY6u', NULL, NULL, '2022-08-21 17:10:22', '2022-08-21 17:10:22', NULL, NULL, NULL, NULL, 1, NULL),
(216, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143647417', NULL, NULL, 'abo3adel35@gmail.comssd', NULL, NULL, 0, '565897', '$2y$10$vzlvT.gyhRYJAsbjV5cdHu7bcxBWQY.h3QAZkaY/K3Q5GKuzpUh8W', NULL, NULL, '2022-08-21 17:15:59', '2022-08-21 17:15:59', NULL, NULL, NULL, NULL, 1, NULL),
(217, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143647417', NULL, NULL, 'abo3adel35@gmail.comssdrr', NULL, NULL, 0, '401251', '$2y$10$h3gRl5f0XGzb0tQesNN.r.695oBNihOjVEXyVuxcb1rhAMDoL4gny', NULL, NULL, '2022-08-21 17:16:19', '2022-08-21 17:16:19', NULL, NULL, NULL, NULL, 1, NULL),
(218, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143647417', NULL, NULL, 'abo3adel35@gmail.comssdrre', NULL, NULL, 0, '953992', '$2y$10$gNfIaxhn3wf/p3o0tfVHBuuxh5WpArSDEzfkPbBf/5UIfg1xk8icW', NULL, NULL, '2022-08-21 17:16:45', '2022-08-21 17:16:45', NULL, NULL, NULL, NULL, 1, NULL),
(219, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143647417', NULL, NULL, 'abo3adel35@gmail.comssdrred', NULL, NULL, 0, '485455', '$2y$10$jo8.vbQyhkDZQfR7I99CiuhOUOpvvnuMSyo007HEbCuV6AYJouvHS', NULL, NULL, '2022-08-21 17:17:29', '2022-08-21 17:17:29', NULL, NULL, NULL, NULL, 1, NULL),
(220, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143647417', NULL, NULL, 'abo3adel35@gmail.comdfdfdf', NULL, NULL, 0, '439181', '$2y$10$NCh5ToWrowSO4gXzwCjqFO/FnIVyUFX17Iqpw2k/p6mVvUCSdPCg6', NULL, NULL, '2022-08-21 17:18:50', '2022-08-21 17:18:50', NULL, NULL, NULL, NULL, 1, NULL),
(221, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143647417', NULL, NULL, 'abo3adel35@gmail.comdfdfdfsdsd', NULL, NULL, 0, '688333', '$2y$10$zGYTBrH1gJ/2z6PZakbcD.brgRejoZNvwGNJZZrzyBNGapESyGFtu', NULL, NULL, '2022-08-21 17:19:39', '2022-08-21 17:19:39', NULL, NULL, NULL, NULL, 1, NULL),
(222, 'home lastwq', 'home', NULL, 'lastwq', '201143647417', NULL, NULL, 'abo3adel35@gmail.comwsdx', NULL, '2022-08-21 10:41:27', 0, '701250', '$2y$10$MrqDWDz8HtjApUggA3n10.lc8g.ZuKrnvJUxaHU6yxTaVLxpYd.fa', NULL, NULL, '2022-08-21 17:38:54', '2022-08-21 17:41:27', NULL, NULL, NULL, NULL, 1, NULL),
(223, 'ahmed adel', 'ahmed', NULL, 'adel', '032415445564', NULL, NULL, 'abo@gmail.com', NULL, NULL, 0, '710298', '$2y$10$OjyFVrFtD0z/5LdRBv.nx.0MAcz/ny1HgDlEoGPer7jK71tnDdr4y', NULL, NULL, '2022-08-21 21:29:36', '2022-08-21 21:29:36', NULL, NULL, NULL, NULL, 1, NULL),
(224, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445564', NULL, NULL, 'abo3adel35@gmail.comwwewe', NULL, '2022-08-21 14:38:51', 0, '686762', '$2y$10$ncvlUK.eu0MZ9vBTm0.0OuzNcVaoczbdb6mrrGcJ8r.VNdR1CdYim', NULL, NULL, '2022-08-21 21:38:11', '2022-08-21 21:38:51', NULL, NULL, NULL, NULL, 1, NULL),
(225, 'Ahmed Adel', 'Ahmed', NULL, 'Adel', '201143647417', NULL, '/customers/16610967161649507652careers.jpg', 'a@gmail.com', '24', '2022-08-21 15:30:22', 0, '897406', '$2y$10$WHtTOAsKCsybvlLzvY5D8OLiVN0BN01CM4Z9aPO8gzV.zRUjbRMau', NULL, NULL, '2022-08-21 22:30:00', '2022-08-21 22:47:09', NULL, NULL, NULL, NULL, 0, NULL),
(226, 'Ahmed Adel1', 'Ahmed', NULL, 'Adel1', '201143645787', NULL, NULL, 'abo3adel33335@gmail.comwww', NULL, NULL, 0, '305097', '$2y$10$UZCPqTU.Bg1rCEH0z1jr7.Hk.YBqQxGDxjwv8NV2nH2Uxzu29HLyy', NULL, NULL, '2022-08-22 23:47:57', '2022-08-22 23:47:57', NULL, NULL, NULL, NULL, 1, NULL),
(227, 'Ahmed Adel1', 'Ahmed', NULL, 'Adel1', '966123456789', NULL, NULL, 'abo3adel33335@gmail.comwwwer', NULL, NULL, 0, '199220', '$2y$10$B.dBorVQqzMQCnMgpsaDfOsmdMl2mmXiE0V4t/sumKw6YuS7OB5ky', NULL, NULL, '2022-08-22 23:48:29', '2022-08-22 23:48:29', NULL, NULL, NULL, NULL, 1, NULL),
(228, 'Ahmed Adel1', 'Ahmed', NULL, 'Adel1', '9661234567894', NULL, NULL, 'abo3adel33335@gmail.comuwwwer', NULL, NULL, 0, '903544', '$2y$10$vDmrD2Lolq7xqWLgFjWFKedU9f.pnnUoQibSaKId1vETdH810rVuq', NULL, NULL, '2022-08-22 23:48:53', '2022-08-22 23:48:53', NULL, NULL, NULL, NULL, 1, NULL),
(229, 'Ahmed Adel1', 'Ahmed', NULL, 'Adel1', '963256412546', NULL, NULL, 'abo3adel33335@gmail.comuwwweree', NULL, NULL, 0, '558717', '$2y$10$/zbldCh6Liv2uzW02ZDG9eCQ9fhZwIkoqJfsHob5UyGppxiNnAJ9i', NULL, NULL, '2022-08-23 00:06:59', '2022-08-23 00:06:59', NULL, NULL, NULL, NULL, 1, NULL),
(230, 'home lastwwwwwwwq', 'home', NULL, 'lastwwwwwwwq', '201143647418', NULL, NULL, 'admintest2@gmail.com', NULL, '2022-08-27 09:58:51', 0, '198906', '$2y$10$GMIZf7b6JkDZp4dU8SD8qOAUyeHKOuGRh9lmHBFHbjX7XWXT6g/kW', NULL, NULL, '2022-08-23 21:48:16', '2022-08-27 16:58:51', NULL, NULL, NULL, NULL, 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmNTAzZDMxYTE3MGE3MGNiMDQ2NmRhM2VmYmYwNmE2MjljM2Q3ZmUzZDI4ZDY1N2NhYWVjYTIxMTdlODg0N2ZiODg4ZTUzODI1MjVlYmJhIn0.eyJhdWQiOiIzIiwianRpIjoiMWY1MDNkMzFhMTcwYTcwY2IwNDY2ZGEzZWZiZjA2YTYyOWMzZDdmZTNkMjhkNjU3Y2FhZWNhMjE'),
(231, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030219', NULL, '/customers/1661850419food-img-04.png', 'md.sallam@gmail.com', '255', '2022-08-31 10:28:52', 1, '408967', '$2y$10$Pn79doTGXbzwlIiiWad/Uu/u1WoHTivFyQVodexQcn51.wV6Tadx.', NULL, NULL, '2022-08-27 15:03:15', '2022-09-05 17:27:42', NULL, NULL, NULL, NULL, 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM2ZWFkMGEyMjcxYmY0ZTYzODg2YjZlNzM4MzdmOTlmMTUxNjY3OTdmMzI3ZjJhYTU5YWUwNGRhOWI5MTVmN2EwN2FiYzNjZTZhZmQ1M2JkIn0.eyJhdWQiOiIzIiwianRpIjoiMzZlYWQwYTIyNzFiZjRlNjM4ODZiNmU3MzgzN2Y5OWYxNTE2Njc5N2YzMjdmMmFhNTlhZTA0ZGE5YjkxNWY3YTA3YWJjM2NlNmFmZDUzYmQiLCJpYXQiOjE2NjE5NDE3MzIsIm5iZiI6MTY2MTk0MTczMiwiZXhwIjoxNjkzNDc3NzMyLCJzdWIiOiIyMzEiLCJzY29wZXMiOltdfQ.QlV0ZHEuJF5XaGWRJGNnT0PFkZJ3CF8YwC_l82q4FowbE7oUOTnloo-wB1RiMia8LiEVYM_FEiC9ESu9PxqhrbFJakR6ghJY1GRPZaXs14De7VYDyG8WR4c_9FGkFryoD_ZXZ1TlObgAghFBcIxcJtLf6-cHfjjAGECuShiO52HxZ3E4EchZhBupIpmDKMJC9gsjbgWxu5ldlU3KT8Sfi_mxW5TGyxunHsLfnsuP77Kymc4bj_IsMuaMnpkstvU5k_i9T8ox1kvGytSBXyryBqmRRMVzqUrDaN8SsFt-1v9PVF7CXKS8TcwCey-wTkGhnzaDBP1gEKosYo1k8L0J6BH-Ytcca9Sepm7AVf2ZB8QLQf98EloHo5Foo5Cr6hHxNzNk6RbdS_kSduzbHBU1ow8TO3-JVv2kDOTa7DbAqsRk4OmthpKKYAmiusFgBkg_a_ggVnnLHg3SBk8np4IAFgk--RCJbQ1S3wp4V94rrX52XdE8aH5q70hojbCpZkpmtkswd9pqAA0LEJsWQIl-2UKeqfjVCEgFD-aiKxs26--PbDnv7SN6IKHD_ADSXI-kSAQ8moHJRkSxl7kw7-y7H3QwdPUWVCmivTXuAdfdO1sS-bSfWblrk63VJhvCIrR_MVViwhTKHMxP6J1vV7H_TdEPUhasDPLpBtcA90ZG7kg'),
(232, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030215', NULL, NULL, 'md.sallam@gmail.comw', NULL, '2022-08-27 10:52:32', 0, '163510', '$2y$10$7sW6OaQQ5nM4bYl156B86.6GyGvwIHE/iivW5Vz7qqDbuX7Nnbyya', NULL, NULL, '2022-08-27 15:04:34', '2022-08-27 17:52:32', NULL, NULL, NULL, NULL, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ5M2RlNzUxNjQ2MWI0NDNjY2QyM2E0YjhkMjY0MDA3N2QzY2QxNzIyZGRiZTQwNTRjOTg4Mzg3YWRiMDVlYWE0NTdlN2VmNjBmYTc1ZjJlIn0.eyJhdWQiOiIzIiwianRpIjoiZDkzZGU3NTE2NDYxYjQ0M2NjZDIzYTRiOGQyNjQwMDc3ZDNjZDE3MjJkZGJlNDA1NGM5ODgzODdhZGIwNWVhYTQ1N2U3ZWY2MGZhNzVmMmUiLCJpYXQiOjE2NjE1OTc1NTIsIm5iZiI6MTY2MTU5NzU1MiwiZXhwIjoxNjkzMTMzNTUyLCJzdWIiOiIyMzIiLCJzY29wZXMiOltdfQ.foKneSD61LBO4uvk6r6OvwrZILLqGkn50n_VCYu7PgH8XwigW3tFRGsRpQwPwbc5A4yl6_sAh5INSoeX22H49aBQPHWUSkyNgjv1Wxbaj8bQHNEfpLtpveJl8CJxNaZ_jmrfJ6-RUjP6NLIZTDt4otBOr3ESUrS-_US0x_cl7JLoya4uz3fHiNrd4lJO2M4POdqRYrpFq9K_FlHErupVmAIVo2rmeFtmTrctXX9MGkK_gn6P7TMdqXgDxab8CCi-I_lMGtjzXpDvVZDRCQSsD-JU-lW7GyRB_ax8IQ7cUntDS4dayoGGJ9uziHMdvwIfhf5ogSRoiZOw_PbaNVurPQNAmnMfK8sJ01sHipRFgYHCsuJYoNESamu9nz11StXCau_SHAvStFVItcxCyfknuN5AAZ2iFMFtsxlMk4ZUL4r0W5WzOxJsE4aPBVaKSsYSIAHyPERTALSENbQ0FHuew552XmxunqgKwxHEq3uJdJF74TL3UAqcvZDo8XiyoG2tnFs6JOqnxg22yZbiO48JmNk6rno-BlAqqmdRi60vwViH_DyUdEhdMKRp0AvXM4MnpUzhqh4bI1qDXCc_hsI9hxV0zi7l9MPaORNUtx4xsEuz9gQCsU8YVABbqODKG1COvTCFZaR9Q1F4RagKFWOu4puY5yD1Fd2v-nXy9ynmnmI'),
(233, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '201143685964', NULL, NULL, 'admintest255@gmail.com', NULL, '2022-08-27 10:52:43', 0, '688673', '$2y$10$RXduV3CNj3Mzym4A27/GR.YIpgzevgu6HED5qMyJVB/jIIPT.Lugm', NULL, NULL, '2022-08-27 15:53:50', '2022-08-27 17:52:43', NULL, NULL, NULL, NULL, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjUzODM3MGI2NDczOTcyZGQ4NjhkNDkwODExOGJlMWE0MDcwYzhmNGQ4ODJjY2EzYTVkNWQ0YTBiNjIxMzIxYWQwMzljZjhjYmYwZDAyNzcyIn0.eyJhdWQiOiIzIiwianRpIjoiNTM4MzcwYjY0NzM5NzJkZDg2OGQ0OTA4MTE4YmUxYTQwNzBjOGY0ZDg4MmNjYTNhNWQ1ZDRhMGI2MjEzMjFhZDAzOWNmOGNiZjBkMDI3NzIiLCJpYXQiOjE2NjE1OTc1NjMsIm5iZiI6MTY2MTU5NzU2MywiZXhwIjoxNjkzMTMzNTYzLCJzdWIiOiIyMzMiLCJzY29wZXMiOltdfQ.D5g5QgiYyw5HVBWUc73i5uChD3jY9meWS7mkrwH6nY4RVBMxXrBDR8clrkbKVXE-HbfVcAHFhGGxR_caigEnaqFP_8-s3Bvj7SQaCGn1UPv5F3_JFIQK55EVU1OKn9fYFnH0OayGPdM6ie_lap0QAnr8MlR6w4hazp1FWUOGhl7meDMVLgwDZKnebZsFEB26FeiiiwRVpi39H7wIzQ1LrigJX_1w2dkQkdWeQFegwfLLp5nOU4Z7E0zNC6RhYap3GK28zilhFP0uxXWUPxiK9XnvlCnNAkB9zm0UucL2BOF7BXwHZwFSwhpLlNJi4Q971RvZYGbwH7vnY6ldSqiJ4AWVoQA3RFINAV1IHa5XtBoeKdZHQx8Tj4bARRlNVd2QEy8QdJ8qgDlY132Gff-eFAEkm2pOgZEepwCR2oTbm7TIxCkBp0JstcuvxrxL5sIqkaY-mEeNS3dKBO2dmYp6nK9vY9imbEnKYeMvDgivUVlJj4FAbtJTapZsRUpMNzZeV6zBXz2NnieVbmDA6tugUubL7ch8DqMhvxE82WCD7oapT5lUML71dADF7wOXQGgre1ywgE6cRg13E37utqwWHbM1FFXQgPfgEsDgbk9OJqvYRB1XYKmY4RrJGzgO25OWsE-wzp0HKoxdOsQesghkHMhr7Ib-xNaclD3Y1Ep5oWY'),
(234, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030212', NULL, NULL, 'md.sallam@gmail.com555', NULL, '2022-08-29 12:20:39', 0, '945136', '$2y$10$HVBtDJegcXWpfaUsaWmFwO6T.rG7ceKySohQe2R7uI0cF415qeLri', NULL, NULL, '2022-08-27 17:09:08', '2022-08-29 19:20:39', NULL, NULL, NULL, NULL, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE5NjE3MWYwZGYzN2ZjMGVlNzIwYTUxN2NlNDVhYmUzYjQ1MTNkZjU5ZTQ4MjVhMThjYjkyODA3YTg3NWNkZjhhYmIwZTkwZjNhYzc1MTQ5In0.eyJhdWQiOiIzIiwianRpIjoiYTk2MTcxZjBkZjM3ZmMwZWU3MjBhNTE3Y2U0NWFiZTNiNDUxM2RmNTllNDgyNWExOGNiOTI4MDdhODc1Y2RmOGFiYjBlOTBmM2FjNzUxNDkiLCJpYXQiOjE2NjE3NzU2MzksIm5iZiI6MTY2MTc3NTYzOSwiZXhwIjoxNjkzMzExNjM5LCJzdWIiOiIyMzQiLCJzY29wZXMiOltdfQ.GNf6SQVM8tPGKRl17qJAFeASrlLq4QmoYUkbK2vnvX_RP6xUaPiOCpNwa53lUHwQKoRycXn-hr7b__L_7N409cYtvwLMOz0iCWt5_u-CCa2Lsv1aS0ns3ZyIyyEyYTrruetXQImK8xqzRu-Y1VGxibJ5Y-q7M4sTplhhuaFMKYqTZbeG3P5pVU_5II65Qj_HIgHuGms0ewOAs7O77-prtjPjAEz8EHGnAG38EmX2r5yN19__CTMynBNkcLJK6qHTZMXs2z-6W-h1W1BfC4NLJl9Arl92bofpjE-1gdP-SYeMJxUE6SaKccSbyTIgIeRdn3WcenuBLqR-c2ed2O068U2cgVt12FLP023-bXtuFo93fCAY96ojrtUF8SFToSUpzST2eoLfJB129Wjp6iI9zddJquYXdF35AR_D2SKwL8FR9qcBcb3sDHOV84NQYbyorHv4RaTMN0uS1ProKUgkNLasN_-opbFV3Iz_CUlYvFdiuDmI6Tx9MzU16DrS-ZXJlFnVf5mC2NTiFQkuJ3akiBMnMieVeteFveZ80kGgepZFr7_xxFUc0-IKZzB5t2oQ0aMP0mMXHmjF2aPzZY-FF2zULuLwlOWofwUFnXolManUgTqCsMZMG7jqydANBeK5sShBjXc4yqqTQh8jyqMiSilH0T1ePdgy6ZBOcyFmqGA'),
(235, 'nnn gmail.com', 'nnn', NULL, 'gmail.com', '+20 111 229 7239', NULL, NULL, 'nnn@gmail.com', NULL, NULL, 0, '730067', '$2y$10$5uxYbp3J5Odj8lxiGzO8zeCscrl3BWzzR.UdiQWO3UrQQOqqa7PDq', NULL, NULL, '2022-08-27 21:10:17', '2022-08-27 23:46:50', NULL, NULL, NULL, NULL, 1, NULL),
(236, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030210', NULL, NULL, 'mddd.sallam@gmail.com', NULL, NULL, 0, '675006', '$2y$10$DFTWZPONjHKMOyWnRBpKo.ApFVxU7sDYfmNz1o7xDFNWctiW254Ue', NULL, NULL, '2022-08-28 20:54:21', '2022-08-28 20:54:21', NULL, NULL, NULL, NULL, 1, NULL),
(237, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030218', NULL, NULL, 'mdd.sallam@gmail.com', NULL, NULL, 0, '724189', '$2y$10$55HaZPA86w09Jhq511LB0OFwL.0IISsiw7XgiO8yUH/hJQdJPG/T6', NULL, NULL, '2022-08-28 20:54:50', '2022-08-28 20:54:50', NULL, NULL, NULL, NULL, 1, NULL),
(238, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030213', NULL, NULL, 'mdd1.sallam@gmail.com', NULL, NULL, 0, '679292', '$2y$10$5Yva6B.pI2vVFXZbmcGoueMaMGj//J2iE7gtXHm48dr8GZ8Wex462', NULL, NULL, '2022-08-28 20:55:39', '2022-08-28 20:55:39', NULL, NULL, NULL, NULL, 1, NULL),
(239, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030216', NULL, NULL, 'mdd6.sallam@gmail.com', NULL, NULL, 0, '180004', '$2y$10$PnVDrs54KwGSlAiPLM4lheNLfUQU78CCpairj4VHaAHj6xpPt5bde', NULL, NULL, '2022-08-28 20:57:57', '2022-08-28 20:57:57', NULL, NULL, NULL, NULL, 1, NULL),
(240, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030200', NULL, NULL, 'mdd0.sallam@gmail.com', NULL, NULL, 0, '542336', '$2y$10$83uZ951thrPVz/v7azj1xelzF/5GX45tmKLb9JXiFxw7mlulh8UoC', NULL, NULL, '2022-08-28 20:59:05', '2022-08-28 20:59:05', NULL, NULL, NULL, NULL, 1, NULL),
(241, 'Cashier Kop', 'Cashier', NULL, 'Kop', '201143647417', NULL, '', 'cashier@212.net', '255', '2022-08-30 09:09:59', 1, '', '$2y$10$xqZnwn3.up6K1Yuhn7XfEeYXV6691I7Mf3.hsUf9TgFHGU.V/.Os6', NULL, NULL, '2022-08-30 16:09:21', '2022-08-30 16:09:59', NULL, NULL, NULL, NULL, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImI3NDQxN2NiZTFlZGQ0ZGY3NmE2MjBlOTg4OWU0YjViMTMxZDFkNGUyMzFmNzZmZTJmMjBhN2RiNTNhZjg5M2U3OWIyYzdhNGZjZDM2MWYxIn0.eyJhdWQiOiIzIiwianRpIjoiYjc0NDE3Y2JlMWVkZDRkZjc2YTYyMGU5ODg5ZTRiNWIxMzFkMWQ0ZTIzMWY3NmZlMmYyMGE3ZGI1M2FmODkzZTc5YjJjN2E0ZmNkMzYxZjEiLCJpYXQiOjE2NjE4NTA1OTksIm5iZiI6MTY2MTg1MDU5OSwiZXhwIjoxNjkzMzg2NTk5LCJzdWIiOiIyNDEiLCJzY29wZXMiOltdfQ.D76liF2zKdNFvUjYWbZ4LmdmZ49NtKHT_o0ZXevu9JHQH4NU_PNKIf5u460dStO3OWFpL0HBT3pEkNj-U65snoK9kvwQKEN7_7gliWGMqSkRwR1ms2VbgmF29fQUf8IUuoo27jqlKifChhohEP26VsC_N6RDxNRPfncr0uVNaEygjsXuDL3DQj-vWK6AnIdCCIXzE4VDJidIK-fv50r54642WKqiS4RYJyhjg1BxXiWT3pHbiU9BbplaUdEjDzty8B1cwJx2mcmQC6PIkqcaCxyzs7q-GsAvzl54qpdmjFbechqac6agzLj7G71sdEuULFyAhC25y_60Qu8ulUnT9UJ1Rd2Ox3wYd-4ALAdRQPmMoH7SGIJw5CW80ec1Bn0hByv0pU0uAr7Y5dgSqbCZfr320OCZmL7aMgWN1K1ItIxRw5M_23HF0z3z7kMytiUfguO8gGt_QAX7xEAtNnp308fSuSeE-iTPBoyZghHqHW7BXQGdnxnk2dbxPYLe5YMIK1MLzhDSpugbiLIs-xizymmX3mwlp-PFec_zMfOZXXcO6nt13SsOTPYxMrDwURgi-egFK2r6RqCidH1mvrUS3S1LOIIgAhIvu3bKu14VetnVmPf_bKnqTobGlCbwFJBDCnTSvkDeF3tKvMFrPbzQVQxvEUjSGGOBfJROPr7UqJo'),
(242, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030232', NULL, NULL, 'md.sallam@gmail.comww', NULL, NULL, 0, '183095', '$2y$10$VTcmh5ZT3AE67ziiM0GQheh.10xpkE0AANrgY.w0/0/zdDf4L.jSS', NULL, NULL, '2022-08-30 20:50:00', '2022-08-30 20:50:00', NULL, NULL, NULL, NULL, 1, NULL),
(243, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030234', NULL, NULL, 'md.sallam@gmail.comwwe', NULL, NULL, 0, '544971', '$2y$10$Y1Qof4Vnptmm9rvL0NrE2OHP9/NPvad0SuIftOqa.TEbJROoIv46e', NULL, NULL, '2022-08-30 20:54:14', '2022-08-30 20:54:14', NULL, NULL, NULL, NULL, 1, NULL),
(244, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030231', NULL, NULL, 'md.sallam@gmail.comwweq', NULL, NULL, 0, '497478', '$2y$10$enHce.RAZYtG3DmkEITxFumyi1VWq0M8OinEg8pro9GJdra5QskJW', NULL, NULL, '2022-08-30 20:58:59', '2022-08-30 20:58:59', NULL, NULL, NULL, NULL, 1, NULL),
(245, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030230', NULL, NULL, 'md.sallam@gmail.comwwequ', NULL, '2022-08-30 15:21:05', 1, '779196', '$2y$10$Xtdv0wkAoNBgaj0SXZlvZe4TF.qjsXFkhLpoMSWD6uFdFHoZBWz.u', NULL, NULL, '2022-08-30 21:10:16', '2022-08-30 22:21:05', NULL, NULL, NULL, NULL, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjA5YTk5ZTU5OTY5MjFmMDAxYTVjOGFiMTFlZGE2YmJhOGU5MWU4MDIxY2I2NGQzZWEwYTE1ZjIwYTZjYWEyOWZmYmZkZjlkOTRjMmNmMzE1In0.eyJhdWQiOiIzIiwianRpIjoiMDlhOTllNTk5NjkyMWYwMDFhNWM4YWIxMWVkYTZiYmE4ZTkxZTgwMjFjYjY0ZDNlYTBhMTVmMjBhNmNhYTI5ZmZiZmRmOWQ5NGMyY2YzMTUiLCJpYXQiOjE2NjE4NzI4NjUsIm5iZiI6MTY2MTg3Mjg2NSwiZXhwIjoxNjkzNDA4ODY1LCJzdWIiOiIyNDUiLCJzY29wZXMiOltdfQ.T4ehyknDw8e78NbIEBTfF6o70vcYQTtCCCIqc8VOpXw7xZTMAAHNI_6ViB9mjdVSMcknxOYGOX0wDe8BYVCNOzFkqtXWfvAGfqwRVohs5kvQZnlgwiKTPAM27_wfuB0v0cP33ucETWsi-Uc94FNSZLQQUjiWOIAhrX9VQDs6AG795oDWGlU3iqX0J0EP45mr8z1DA3q3mIOJehikmGv31vKoItXSrXfWzJJC_1YKs1A9LBGL7CxTa4UUyF5B9ZcXVq0PC2BDIZ1KGRpMEEu1iDyDfwEPM4vrs7dEGtTE4gblXTZ0GByqbS1qU1cSt1FRT5r_rjnFbyTU46sREvyMTiPX0vvSMwjyzXOMnkETZ6AcQZQFYtIAbw_gHMc1y5iYlTE-Fv_G38mtpGEqIZnKwwATRUHnamSlLd6CWYAKWdIGERcpnUJnHA3FlcSf8cEQrzu2cjob-EfeZR0yznUIybPD30AOQ4pD8iNb1QGJPcQ97dM8TwAA_TxQ7-CudASVMjRpKE1V-4EkIsdmUeP_kV8Z9GPTwGJz2jTq0uWyQ5831kJoYhSXAom8KEFSmI7nFEDDBmyWpbWlE0UF1QVrT8AlgJm0yI3GLZyqm_FXk45nSy2fVnsR9DiV00a29x1cU3zgUIlJ4LT5rj0n1heLNqG3NL9fB4ORYI0ecSLSYFk'),
(246, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445560', NULL, NULL, 'md.sallam@gmail.comwewewe', NULL, NULL, 0, '452847', '$2y$10$YcSgAbLHtyBVolyvLrXMDO9/gnc.YCIp86nwbO6jTXc4qJ9BfTR0m', NULL, NULL, '2022-08-30 21:33:38', '2022-08-30 21:33:38', NULL, NULL, NULL, NULL, 1, NULL),
(247, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445520', NULL, NULL, 'md.sallam@gmail.comwewewerrr', NULL, NULL, 0, '622177', '$2y$10$w9EyNDoBU2lTDkBhPB4YGeBEF1lstu7dD07skXXivwwYaa1nXag8q', NULL, NULL, '2022-08-30 21:37:32', '2022-08-30 21:37:32', NULL, NULL, NULL, NULL, 1, NULL),
(248, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445514', NULL, NULL, 'md.sallam@gmail.comwewewerrro', NULL, NULL, 0, '773640', '$2y$10$7iX5xji0pgArUXB260CmyezLoIZ5yYgJbI9zdgKFguUwjsz9ubPqu', NULL, NULL, '2022-08-30 21:38:16', '2022-08-30 21:38:16', NULL, NULL, NULL, NULL, 1, NULL),
(249, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445213', NULL, NULL, 'md.sallam@gmail.comwewewerrro44', NULL, NULL, 0, '930420', '$2y$10$ZDLzApf8n....j/cSR2Sre.2JRNNnWHv8hAodXx6jmr0H/hB4VOta', NULL, NULL, '2022-08-30 21:39:51', '2022-08-30 21:39:51', NULL, NULL, NULL, NULL, 1, NULL),
(250, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445211', NULL, NULL, 'md.sallam@gmail.comwewewerrro448', NULL, NULL, 0, '718619', '$2y$10$Be5o7iRZVyFwVDN3Q5Wy8.xw2h86xqpI/QEe6wn532x.R3My4DLNW', NULL, NULL, '2022-08-30 21:47:12', '2022-08-30 21:47:12', NULL, NULL, NULL, NULL, 1, NULL),
(251, 'home lastwq', 'home', NULL, 'lastwq', '032415445510', NULL, NULL, 'md.sallam@gmail.comwewewerrror', NULL, NULL, 0, '598093', '$2y$10$NEeqhEgz4DSOMuG6INWlL.dLKpiPsEpN5G8Hokd837KDabxlWxKGW', NULL, NULL, '2022-08-30 21:49:41', '2022-08-30 21:49:41', NULL, NULL, NULL, NULL, 1, NULL),
(252, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445203', NULL, NULL, 'md.sallam@gmail.comwewewerrrow', NULL, NULL, 0, '347743', '$2y$10$RaoGbob3K4RC55ww/jHfQuBGQJRkuiL5OLKdyxX1TzuU1Td7kON6q', NULL, NULL, '2022-08-30 21:51:51', '2022-08-30 21:51:51', NULL, NULL, NULL, NULL, 1, NULL),
(253, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415145203', NULL, NULL, 'md.sallam@gmail.comweweewerrrow', NULL, NULL, 0, '790992', '$2y$10$OPXEw1i8voC0iecCM9Too.DwiNuuiGHKRnuit3O3Q.FjAkSjRekA.', NULL, NULL, '2022-08-30 21:52:45', '2022-08-30 21:52:45', NULL, NULL, NULL, NULL, 1, NULL),
(254, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415145104', NULL, NULL, 'md.sallam@gmail.comweweewerrroow', NULL, NULL, 0, '247912', '$2y$10$3D.BHvyrpjCrLWeRcWyDXOYGoDajV/Rg4p3yVMk81XcMHPomEW/Ly', NULL, NULL, '2022-08-30 21:55:58', '2022-08-30 21:55:58', NULL, NULL, NULL, NULL, 1, NULL),
(255, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415145124', NULL, NULL, 'md.sallam@gmail.cormweweewerrroow', '44', '2022-08-30 14:59:56', 1, '605889', '$2y$10$QF5s8SHdRGRD2ktwbffk7ez.mSra/WpjsLuUsjxw3iyKbwzwD/v.6', NULL, NULL, '2022-08-30 21:56:48', '2022-08-30 22:00:10', NULL, NULL, NULL, NULL, 1, NULL),
(256, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445486', NULL, NULL, 'md.sallam@gmail.comwewewerrroffff', NULL, '2022-08-30 15:41:12', 1, '120294', '$2y$10$eP.kdEXSCfBaMoDsYQyluuiTakZdYalsOr5ST.7FKeaCNo/ICASqy', NULL, NULL, '2022-08-30 22:23:33', '2022-08-30 22:41:12', NULL, NULL, NULL, NULL, 1, NULL),
(257, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '015365482365', NULL, NULL, 'md.sallam@gmail.comwewewerrroeew', NULL, NULL, 0, '831658', '$2y$10$1X58wSyV2L0f5UYT7C.kYekyRaKFVBLim.ClxzSRvn2lks8.K2tc2', NULL, NULL, '2022-08-30 22:42:53', '2022-08-30 22:42:53', NULL, NULL, NULL, NULL, 1, NULL),
(258, 'home lastwq', 'home', NULL, 'lastwq', '012365478952', NULL, NULL, 'md.sallam@gmail.comwewewerrroaaa', NULL, '2022-08-30 15:44:32', 1, '505491', '$2y$10$/SXShte886xbvJfaM3MWOO4EmaMUPfSAlGNJsSCnCYEiHHj4q8hIG', NULL, NULL, '2022-08-30 22:44:07', '2022-08-30 22:44:32', NULL, NULL, NULL, NULL, 1, NULL),
(259, 'home lastwwwwwww', 'home', NULL, 'lastwwwwwww', '032415445540', NULL, NULL, 'md.sallam@gmail.comwewewerrrowww', NULL, '2022-08-30 15:54:44', 1, '590168', '$2y$10$vONyoi/lBXhS1RZ6iWMDmOBXcfxu4uCM3kYTFbgzOBCryx9GfClOm', NULL, NULL, '2022-08-30 22:52:43', '2022-08-31 00:17:12', NULL, NULL, NULL, NULL, 0, NULL),
(260, 'nnn nnn', 'nnn', NULL, 'nnn', '123456789012', NULL, NULL, 'nourasamyy39@gmail.com', NULL, NULL, 0, '138250', '$2y$10$zQ3VPmnTZ7LSpWlUPYc4V.aF9dP4rU2FmslyOz4ecQo/BoeAVW.gG', NULL, NULL, '2022-08-31 18:51:29', '2022-09-01 22:29:40', NULL, NULL, NULL, NULL, 1, NULL),
(261, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030211', NULL, NULL, 'md.sallam@gmail.comee', NULL, NULL, 0, '361828', '$2y$10$RLikyaWVz1UchxoxN798TOySi/eVeST1f7Vao4JoJrKJpbQkNiLBm', NULL, NULL, '2022-08-31 22:55:06', '2022-08-31 22:55:06', NULL, NULL, NULL, NULL, 1, NULL),
(262, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030217', NULL, NULL, 'mdd3.sallam@gmail.com', NULL, NULL, 0, '295427', '$2y$10$XluHY9uEC6ac2jB0QpT31.r2fdji//HyGkQaA/mjLB3s276osKW9C', NULL, NULL, '2022-09-07 16:25:13', '2022-09-07 16:25:13', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `users` (`id`, `name`, `first_name`, `middle_name`, `last_name`, `first_phone`, `second_phone`, `image`, `email`, `age`, `email_verified_at`, `active`, `activation_token`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `created_by`, `updated_by`, `branch_id`, `device_token`, `first_offer_available`, `token`) VALUES
(263, 'Mohamed Sallam', 'Mohamed', NULL, 'Sallam', '011439030227', NULL, NULL, 'mod.sallam@gmail.com', NULL, NULL, 0, '564664', '$2y$10$VT..FrTGoVDhCjaggPZBje0uRQjGGl7vKIxqKhyvavHpxbsqbsCbG', NULL, NULL, '2022-09-07 17:05:30', '2022-09-07 17:05:30', NULL, NULL, NULL, 'fvaMvFCeQ2uJ1sqswqDKSf:APA91bHD5qBpqjTDyUV_xMyn2l3fmXl-meFWg5A9bKJ08N_HegaDh5WdikZM-2EJtGNPW8FFRIDxACjfXy2ADV02mszyMe_-d2EXHowWD1KBxl-d3pjJ5T-xiWJukgIdtv8IO7MBa-C0', 1, 'fvaMvFCeQ2uJ1sqswqDKSf:APA91bHD5qBpqjTDyUV_xMyn2l3fmXl-meFWg5A9bKJ08N_HegaDh5WdikZM-2EJtGNPW8FFRIDxACjfXy2ADV02mszyMe_-d2EXHowWD1KBxl-d3pjJ5T-xiWJukgIdtv8IO7MBa-C0');

-- --------------------------------------------------------

--
-- Table structure for table `user_branches`
--

CREATE TABLE `user_branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `withouts`
--

CREATE TABLE `withouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `price` double NOT NULL DEFAULT '0',
  `calories` double NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `withouts`
--

INSERT INTO `withouts` (`id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `price`, `calories`, `category_id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'صصصصشيشسي', 'asd asd asd asd', 'zxcasd asd asd asd asdasd', 'wasdadzxczxc asd asdasd asdasd', 40, 100, 2, '/withouts/166022495216528592177.jpg', NULL, '2022-08-11 20:35:52', '2022-08-11 20:35:52'),
(2, 'صصصصشيشسي', 'wsdas asdasd', 'asd asd asd asd asd asd', 'sad asd asldh asjkldh asjkdsd', 25, 65, 2, '/withouts/166022498516528592618.jpg', NULL, '2022-08-11 20:36:24', '2022-08-11 20:36:25'),
(3, 'ضضضضشسي شسي', 'aslwdj askld asdh', 'klashd asbdg asd asdhgashdgashdmnvb', 'aiosyd jkasdbh jkasdghashd ashdjk asghd', 15, 15, 2, '/withouts/1660225014165286415215.jpg', NULL, '2022-08-11 20:36:54', '2022-08-11 20:36:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_city_id_index` (`city_id`),
  ADD KEY `addresses_area_id_index` (`area_id`),
  ADD KEY `addresses_customer_id_index` (`customer_id`);

--
-- Indexes for table `anoucement`
--
ALTER TABLE `anoucement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_city_id_index` (`city_id`),
  ADD KEY `branches_area_id_index` (`area_id`);

--
-- Indexes for table `branch_delivery_areas`
--
ALTER TABLE `branch_delivery_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_delivery_areas_branch_id_index` (`branch_id`),
  ADD KEY `branch_delivery_areas_area_id_index` (`area_id`);

--
-- Indexes for table `branch_offer`
--
ALTER TABLE `branch_offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `branch_user`
--
ALTER TABLE `branch_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_user_branch_id_index` (`branch_id`),
  ADD KEY `branch_user_user_id_index` (`user_id`);

--
-- Indexes for table `branch_working_days`
--
ALTER TABLE `branch_working_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_working_days_branch_id_index` (`branch_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_item_id_foreign` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_index` (`created_by`),
  ADD KEY `categories_updated_by_index` (`updated_by`),
  ADD KEY `categories_parent_id_foreign` (`category_id`);

--
-- Indexes for table `category_extra`
--
ALTER TABLE `category_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_extra_category_id_index` (`category_id`),
  ADD KEY `category_extra_extra_id_index` (`extra_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_created_by_index` (`created_by`),
  ADD KEY `customers_updated_by_index` (`updated_by`);

--
-- Indexes for table `dough_types`
--
ALTER TABLE `dough_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extras_category_id_index` (`category_id`);

--
-- Indexes for table `favourite_item`
--
ALTER TABLE `favourite_item`
  ADD KEY `favourite_item_user_id_foreign` (`user_id`),
  ADD KEY `favourite_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gifts_orders`
--
ALTER TABLE `gifts_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gifts_orders_user_id_index` (`user_id`);

--
-- Indexes for table `gifts_order_items`
--
ALTER TABLE `gifts_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gifts_order_items_gifts_order_id_index` (`gifts_order_id`),
  ADD KEY `gifts_order_items_gift_id_index` (`gift_id`);

--
-- Indexes for table `health_infos`
--
ALTER TABLE `health_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_item`
--
ALTER TABLE `home_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_1` (`item_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `category_id_2` (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_index` (`category_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_requests_job_id_foreign` (`job_id`);

--
-- Indexes for table `log_files`
--
ALTER TABLE `log_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logfile_user_id_index` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noti_tokens`
--
ALTER TABLE `noti_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_created_by_index` (`created_by`),
  ADD KEY `offers_updated_by_index` (`updated_by`);

--
-- Indexes for table `offers_buy_get`
--
ALTER TABLE `offers_buy_get`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_buy_get_offer_id_index` (`offer_id`),
  ADD KEY `offers_buy_get_buy_category_id_index` (`buy_category_id`),
  ADD KEY `offers_buy_get_get_category_id_index` (`get_category_id`);

--
-- Indexes for table `offers_discount`
--
ALTER TABLE `offers_discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_discount_offer_id_foreign` (`offer_id`),
  ADD KEY `offers_discount_category_id_foreign` (`category_id`);

--
-- Indexes for table `offer_buy_items`
--
ALTER TABLE `offer_buy_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_discount_items`
--
ALTER TABLE `offer_discount_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_get_items`
--
ALTER TABLE `offer_get_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_index` (`customer_id`),
  ADD KEY `orders_branch_id_index` (`branch_id`),
  ADD KEY `orders_created_by_index` (`created_by`),
  ADD KEY `orders_updated_by_index` (`updated_by`),
  ADD KEY `orders_address_id_foreign` (`address_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_customer_id_index` (`customer_id`),
  ADD KEY `payments_order_id_index` (`order_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `points_transactions`
--
ALTER TABLE `points_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `points_transactions_user_id_index` (`user_id`),
  ADD KEY `points_transactions_order_id_index` (`order_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_party_user_ids`
--
ALTER TABLE `third_party_user_ids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `third_party_user_ids_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_index` (`created_by`),
  ADD KEY `users_updated_by_index` (`updated_by`),
  ADD KEY `users_branch_id_index` (`branch_id`);

--
-- Indexes for table `user_branches`
--
ALTER TABLE `user_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withouts`
--
ALTER TABLE `withouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withouts_category_id_index` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `anoucement`
--
ALTER TABLE `anoucement`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `branch_delivery_areas`
--
ALTER TABLE `branch_delivery_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `branch_offer`
--
ALTER TABLE `branch_offer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `branch_user`
--
ALTER TABLE `branch_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `branch_working_days`
--
ALTER TABLE `branch_working_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=936;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category_extra`
--
ALTER TABLE `category_extra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dough_types`
--
ALTER TABLE `dough_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gifts_orders`
--
ALTER TABLE `gifts_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gifts_order_items`
--
ALTER TABLE `gifts_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_infos`
--
ALTER TABLE `health_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `home_item`
--
ALTER TABLE `home_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_requests`
--
ALTER TABLE `job_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_files`
--
ALTER TABLE `log_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1289;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=556;

--
-- AUTO_INCREMENT for table `noti_tokens`
--
ALTER TABLE `noti_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offers_buy_get`
--
ALTER TABLE `offers_buy_get`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offers_discount`
--
ALTER TABLE `offers_discount`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offer_buy_items`
--
ALTER TABLE `offer_buy_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offer_discount_items`
--
ALTER TABLE `offer_discount_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `offer_get_items`
--
ALTER TABLE `offer_get_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `points_transactions`
--
ALTER TABLE `points_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=529;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `third_party_user_ids`
--
ALTER TABLE `third_party_user_ids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `user_branches`
--
ALTER TABLE `user_branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withouts`
--
ALTER TABLE `withouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branch_offer`
--
ALTER TABLE `branch_offer`
  ADD CONSTRAINT `branch_offer_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `branch_offer_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`);

--
-- Constraints for table `branch_user`
--
ALTER TABLE `branch_user`
  ADD CONSTRAINT `branch_user_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `branch_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branch_working_days`
--
ALTER TABLE `branch_working_days`
  ADD CONSTRAINT `branch_working_days_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `extras`
--
ALTER TABLE `extras`
  ADD CONSTRAINT `extras_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourite_item`
--
ALTER TABLE `favourite_item`
  ADD CONSTRAINT `favourite_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_item_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gifts_orders`
--
ALTER TABLE `gifts_orders`
  ADD CONSTRAINT `gifts_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gifts_order_items`
--
ALTER TABLE `gifts_order_items`
  ADD CONSTRAINT `gifts_order_items_gift_id_foreign` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gifts_order_items_gifts_order_id_foreign` FOREIGN KEY (`gifts_order_id`) REFERENCES `gifts_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `home_item`
--
ALTER TABLE `home_item`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD CONSTRAINT `job_requests_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers_buy_get`
--
ALTER TABLE `offers_buy_get`
  ADD CONSTRAINT `offers_buy_get_buy_category_id_foreign` FOREIGN KEY (`buy_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offers_buy_get_get_category_id_foreign` FOREIGN KEY (`get_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offers_buy_get_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers_discount`
--
ALTER TABLE `offers_discount`
  ADD CONSTRAINT `offers_discount_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offers_discount_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `points_transactions`
--
ALTER TABLE `points_transactions`
  ADD CONSTRAINT `points_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `third_party_user_ids`
--
ALTER TABLE `third_party_user_ids`
  ADD CONSTRAINT `third_party_user_ids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withouts`
--
ALTER TABLE `withouts`
  ADD CONSTRAINT `withouts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
