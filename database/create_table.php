<?php
require "MyPDO.php";
$env_file = __DIR__ . "/../env.ini";
try {
    $connection = new MyPDO($env_file);
    delete_tables($connection);
    create_tables($connection);
    seed_tables($connection);
} catch (Exception $e) {
    echo($e->getMessage());
}
function delete_tables(MyPDO $connection): void
{
    $connection->exec("DROP TABLE IF EXISTS notes");
    $connection->exec("DROP TABLE IF EXISTS users");
}

function create_tables(MyPDO $connection): void
{
    $connection->exec(<<<SQL
                    CREATE TABLE `users` (
                        `id` int unsigned NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `email` (`email`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
SQL
    );
    $connection->exec("
CREATE TABLE `notes` (
                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                         `description` text NOT NULL,
                         `user_id` int unsigned NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `user_id` (`user_id`),
                         CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");
}

function seed_tables(MyPDO $connection):void
{
    $sql = <<<SQL
INSERT INTO users(name,email) VALUES ('john doe', 'john@doe.com');
SQL;
    $connection->exec($sql);
}