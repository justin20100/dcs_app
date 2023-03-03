<?php
class MyPDO extends PDO
{
    public function __construct($file = '')
    {
        if (!$settings = @parse_ini_file($file, TRUE)) {
            throw new exception('Unable to open ' . $file . '.');
        }

        $dsn = $settings['database']['driver'] .
            ':host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['schema'];

        parent::__construct($dsn, $settings['database']['username'], $settings['database']['password'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
}