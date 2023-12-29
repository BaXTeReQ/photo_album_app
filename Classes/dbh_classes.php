<?php

declare(strict_types=1);

class Dbh
{
    const USERNAME = 'root';
    const PASSWORD = '';

    const DBNAME = 'photo_album';

    protected function connect()
    {
        try {
            $dbh = new  PDO('mysql:host=localhost;dbname=' . self::DBNAME, self::USERNAME, self::PASSWORD);
            return $dbh;
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br />";
            die();
        }
    }
}
