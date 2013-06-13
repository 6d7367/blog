create table `blog_comments` (
  `id` int(11) not null auto_increment primary key,
  `entry_id` int(11) not null,
  `title` varchar(255) not null,
  `content` text not null,
  `author` varchar(255),
  `created_at` datetime not null
);