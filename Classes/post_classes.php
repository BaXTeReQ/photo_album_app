<?php

declare(strict_types=1);

require_once('dbh_classes.php');

class Post extends Dbh
{
    private int $userID;
    private string $username;
    private string $CID;
    private string $desc;

    public function __construct(int $userID, string $username, string $CID, string $desc)
    {
        $this->userID = $userID;
        $this->username = $username;
        $this->CID = $CID;
        $this->desc = $desc;
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

    public static function deleteLike($userID, $photoID)
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "DELETE FROM favourites WHERE fk_userID = $userID AND fk_photoID = $photoID;";
        $stmt = $connection->query($query);
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function getPosts(): array
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT u.ID, u.username, p.CID, p.description FROM users_uploaded_photos uup INNER JOIN users u ON uup.fk_userID = u.ID INNER JOIN photos p ON uup.fk_photoID = p.ID;";
        $stmt = $connection->query($query);
        $data = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($data as $singleData) {
            $post = new Post(
                $singleData['ID'],
                $singleData["username"],
                $singleData["CID"],
                $singleData["description"]
            );

            array_push($array, $post);
        }

        return $array;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getCID()
    {
        return $this->CID;
    }

    public function getDescription()
    {
        return $this->desc;
    }
}