<?php

require __DIR__ . '/MyPDO.php';
$file =  __DIR__ . '/../env.local.ini';

try {
    $connection = new MyPDO($file);
    deleteTables($connection);
    createTables($connection);
    seedTables($connection);
} catch (Exception $e) {
    echo ($e->getMessage());
};

function deleteTables(MyPDO $connection): void
{
    $sql = <<<sql
    DROP TABLE IF EXISTS `notes`;
sql;
    $connection->exec($sql);
    $sql = <<<sql
    DROP TABLE IF EXISTS `userAccount`;
sql;
    $connection->exec($sql);
}
function createTables(MyPDO $connection): void
{
    $sql = <<<sql
    CREATE TABLE `userAccount` (
      `id` int unsigned NOT NULL AUTO_INCREMENT,
      `firstname` varchar(255) NOT NULL,
      `lastname` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
sql;
    $connection->exec($sql);
    $sql = <<<sql
    CREATE TABLE `notes` (
      `id` int unsigned NOT NULL AUTO_INCREMENT,
      `user_id` int unsigned NOT NULL,
      `description` text NOT NULL,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userAccount` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

sql;
    $connection->exec($sql);
}
function seedTables(MyPDO $connection): void
{
    $sql = <<<sql
    INSERT INTO `userAccount` (`id`, `firstname`,'lastname','password', `email`)
    VALUES
        (1,'Justin','Vincent','azerty123456','justinvincent@gmail.com'),
        (2,'Louis','Debras','azerty123456','louisdebras@gmail.com'),
        (3,'Aurélie','Louon','azerty123456','aurelielouon@gmail.com'),
        (4,'Julien','Dupont','azerty123456','juliendupont@gmail.com'),
        (5,'Theo','Brousse','azerty123456','theobrousse@gmail.com'),
        (6,'Lea','Frix','azerty123456','leafrix@gmail.com'),
        (7,'Alexi','Loulou','azerty123456','alexiloulou@gmail.com'),
        (8,'Jean','dance','azerty123456','jeandance@gmail.com'),
        (9,'Lucas','disco','azerty123456','lucasdisco@gmail.com'),
        (10,'Maxime','jazou','azerty123456','maximejazou@gmail.com');

    INSERT INTO `notes` (`id`, `user_id`, `description`)
    VALUES
        (1,1,'Ma premiere note sur notion'),
        (2,1,'Ma deuxième note'),
        (3,2,'Ma premiere note'),
        (4,2,'Ma deuxième note'),
        (5,3,'Ma premiere note'),
        (6,3,'Ma deuxième note'),
        (7,4,'Ma premiere note'),
        (8,4,'Ma deuxième note'),
        (9,5,'Ma premiere note'),
        (10,5,'Ma deuxième note'),
        (11,6,'Ma premiere note'),
        (12,6,'Ma deuxième note'),
        (13,7,'Ma premiere note'),
        (14,7,'Ma deuxième note'),
        (15,8,'Ma premiere note'),
        (16,8,'Ma deuxième note'),
        (17,9,'Ma premiere note'),
        (18,9,'Ma deuxième note'),
        (19,10,'Ma premiere note'),
        (20,10,'Ma deuxième note');
sql;
    $connection->exec($sql);

}
