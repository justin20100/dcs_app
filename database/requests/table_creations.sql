CREATE TABLE `notes` (
                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                         `description` text NOT NULL,
                         `user_id` int unsigned NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `user_id` (`user_id`),
                         CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                         `name` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;