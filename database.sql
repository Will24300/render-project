CREATE DATABASE IF NOT EXISTS `coding_courses`;
USE `coding_courses`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `courses` (`id`, `name`, `slug`) VALUES
(1, 'Python', 'python'),
(2, 'Java', 'java'),
(3, 'JavaScript', 'javascript'),
(4, 'PHP', 'php'),
(5, 'C++', 'cpp');

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail_url` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `views` varchar(20) NOT NULL,
  `likes` varchar(20) NOT NULL,
  `comments` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserting Sample Data
-- Python (5 videos)
INSERT INTO `videos` (`course_id`, `title`, `thumbnail_url`, `video_url`, `views`, `likes`, `comments`) VALUES
(1, 'Python Tutorial for Beginners - Full Course', 'https://img.youtube.com/vi/_uQrJ0TkZlc/maxresdefault.jpg', 'https://www.youtube.com/watch?v=_uQrJ0TkZlc', '39M', '1.1M', '60K'),
(1, 'Python in 100 Seconds', 'https://img.youtube.com/vi/x7X9w_GIm1s/maxresdefault.jpg', 'https://www.youtube.com/watch?v=x7X9w_GIm1s', '4.2M', '150K', '8K'),
(1, 'Learn Python - Full Course for Beginners [Tutorial]', 'https://img.youtube.com/vi/rfscVS0vtbw/maxresdefault.jpg', 'https://www.youtube.com/watch?v=rfscVS0vtbw', '43M', '950K', '45K'),
(1, 'Python Crash Course for Beginners', 'https://img.youtube.com/vi/JJmcL1N2KQs/maxresdefault.jpg', 'https://www.youtube.com/watch?v=JJmcL1N2KQs', '4.5M', '120K', '5K'),
(1, 'Python for Beginners - Learn Python in 1 Hour', 'https://img.youtube.com/vi/kqtD5dpn9C8/maxresdefault.jpg', 'https://www.youtube.com/watch?v=kqtD5dpn9C8', '11M', '240K', '15K');

-- Java (5 videos)
INSERT INTO `videos` (`course_id`, `title`, `thumbnail_url`, `video_url`, `views`, `likes`, `comments`) VALUES
(2, 'Java Tutorial for Beginners', 'https://img.youtube.com/vi/eIrMbAQSU34/maxresdefault.jpg', 'https://www.youtube.com/watch?v=eIrMbAQSU34', '14M', '350K', '25K'),
(2, 'Java Full Course | Java Tutorial for Beginners', 'https://img.youtube.com/vi/grEKMHGYyns/maxresdefault.jpg', 'https://www.youtube.com/watch?v=grEKMHGYyns', '5.1M', '110K', '9K'),
(2, 'Learn Java in 14 Minutes', 'https://img.youtube.com/vi/RRubcjpTkks/maxresdefault.jpg', 'https://www.youtube.com/watch?v=RRubcjpTkks', '3.5M', '140K', '6K'),
(2, 'Java Programming Tutorial - 1 - Installing the JDK', 'https://img.youtube.com/vi/Hl-zzrqQoSE/maxresdefault.jpg', 'https://www.youtube.com/watch?v=Hl-zzrqQoSE', '7.8M', '100K', '5K'),
(2, 'Java in 100 Seconds', 'https://img.youtube.com/vi/l9AzO1FMgM8/maxresdefault.jpg', 'https://www.youtube.com/watch?v=l9AzO1FMgM8', '1.2M', '60K', '3K');

-- JavaScript (5 videos)
INSERT INTO `videos` (`course_id`, `title`, `thumbnail_url`, `video_url`, `views`, `likes`, `comments`) VALUES
(3, 'JavaScript Tutorial for Beginners: Learn JavaScript in 1 Hour', 'https://img.youtube.com/vi/W6NZfCO5SIk/maxresdefault.jpg', 'https://www.youtube.com/watch?v=W6NZfCO5SIk', '11M', '260K', '14K'),
(3, 'JavaScript in 100 Seconds', 'https://img.youtube.com/vi/upDLs1sn7g4/maxresdefault.jpg', 'https://www.youtube.com/watch?v=upDLs1sn7g4', '2.5M', '110K', '4K'),
(3, 'Learn JavaScript - Full Course for Beginners', 'https://img.youtube.com/vi/PkZNo7MFOUg/maxresdefault.jpg', 'https://www.youtube.com/watch?v=PkZNo7MFOUg', '15M', '300K', '12K'),
(3, 'JavaScript Full Course - Beginner to Pro', 'https://img.youtube.com/vi/SBmSRK3feww/maxresdefault.jpg', 'https://www.youtube.com/watch?v=SBmSRK3feww', '4.3M', '160K', '7K'),
(3, 'Modern JavaScript Tutorial', 'https://img.youtube.com/vi/hdI2bqOjy3c/maxresdefault.jpg', 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2.8M', '85K', '5K');

-- PHP (5 videos)
INSERT INTO `videos` (`course_id`, `title`, `thumbnail_url`, `video_url`, `views`, `likes`, `comments`) VALUES
(4, 'PHP Programming Language Tutorial - Full Course', 'https://img.youtube.com/vi/OK_JCtrrv-c/maxresdefault.jpg', 'https://www.youtube.com/watch?v=OK_JCtrrv-c', '3.8M', '70K', '4K'),
(4, 'PHP in 100 Seconds', 'https://img.youtube.com/vi/a7_WFUlFS94/maxresdefault.jpg', 'https://www.youtube.com/watch?v=a7_WFUlFS94', '1.5M', '60K', '3K'),
(4, 'PHP For Beginners | 3 Hour Crash Course', 'https://img.youtube.com/vi/BUCiSSyIGGU/maxresdefault.jpg', 'https://www.youtube.com/watch?v=BUCiSSyIGGU', '1.2M', '35K', '2K'),
(4, 'Learn PHP in 15 Minutes', 'https://img.youtube.com/vi/ZdP0PD80RDo/maxresdefault.jpg', 'https://www.youtube.com/watch?v=ZdP0PD80RDo', '2.1M', '45K', '2K'),
(4, 'PHP Tutorial for Beginners', 'https://img.youtube.com/vi/2eebptXprTI/maxresdefault.jpg', 'https://www.youtube.com/watch?v=2eebptXprTI', '1.1M', '20K', '1K');

-- C++ (5 videos)
INSERT INTO `videos` (`course_id`, `title`, `thumbnail_url`, `video_url`, `views`, `likes`, `comments`) VALUES
(5, 'C++ Tutorial for Beginners - Full Course', 'https://img.youtube.com/vi/vLnPwxZdW4Y/maxresdefault.jpg', 'https://www.youtube.com/watch?v=vLnPwxZdW4Y', '14M', '290K', '18K'),
(5, 'C++ Programming All-in-One Tutorial', 'https://img.youtube.com/vi/ZzaPdXTrSb8/maxresdefault.jpg', 'https://www.youtube.com/watch?v=ZzaPdXTrSb8', '4.2M', '110K', '6K'),
(5, 'Learn C++ in 10 Minutes', 'https://img.youtube.com/vi/18c3MTX0PK0/maxresdefault.jpg', 'https://www.youtube.com/watch?v=18c3MTX0PK0', '1.3M', '60K', '3K'),
(5, 'C++ Full Course for free', 'https://img.youtube.com/vi/-TkoO8Z07hI/maxresdefault.jpg', 'https://www.youtube.com/watch?v=-TkoO8Z07hI', '3.1M', '75K', '4K'),
(5, 'C++ in 100 Seconds', 'https://img.youtube.com/vi/MNeX4EGtR5Y/maxresdefault.jpg', 'https://www.youtube.com/watch?v=MNeX4EGtR5Y', '2M', '80K', '4K');
