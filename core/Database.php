<?php

namespace Core;
use Exception;
use PDO;
use PDOStatement;

class Database
{
    private PDO $connection;
    private PDOStatement $st;

    public function __construct(string $file)
    {
        if (!$settings = @parse_ini_file($file, true)) {
            throw new Exception('Unable to open ' . $file . '.');
        }
        $dsn = $settings['database']['driver'] .
            ':host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['schema'];
        $username = $settings['database']['username'];
        $password = $settings['database']['password'];
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
    public function query(string $sql, array $params = []): Database
    {
        $this->st = $this->connection->prepare($sql);
        $this->st->execute($params);
        return $this;
    }
    public function all(): array
    {
        return $this->st->fetchAll();
    }
    public function find(): object|bool
    {
        return $this->st->fetch();
    }
    public function findOrFail()
    {
        $row = $this->find();
        if (!$row) {
            abort();
        }
        return $row;
    }
}