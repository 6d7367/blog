create table `blog_entries` (
  `id` int(11) not null auto_increment primary key,
  `title` varchar(255) not null,
  `content` text not null,
  `created_at` datetime not null
);