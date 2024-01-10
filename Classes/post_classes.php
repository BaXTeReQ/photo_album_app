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

    public static function checkIfPhotoIsLiked($userID, $photoID): bool
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT * FROM favourites WHERE fk_userID = $userID AND fk_photoID = $photoID;";
        $stmt = $connection->query($query);
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        if (isset($result)) return true;

        return false;
    }
}
