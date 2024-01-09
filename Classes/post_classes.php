<?php

declare(strict_types=1);

require_once('dbh_classes.php');

class Post extends Dbh
{
    public function __construct()
    {
    }

    public static function likePhoto($userID, $photoID)
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "INSERT INTO favourites (fk_userID, fk_photoID) VALUES ('$userID', '$photoID');";
        $stmt = $connection->query($query);
    }
}