<?php

declare(strict_types=1);

require_once('dbh_classes.php');

class Post extends Dbh
{
    private int $postID;
    private string $photoCID;
    private string $desc;
    private int $userID;

    public function __construct(int $postID, string $photoCID, string $desc, int $userID)
    {
        $this->postID = $postID;
        $this->photoCID = $photoCID;
        $this->desc = $desc;
        $this->userID = $userID;
    }

    public function getID()
    {
        return $this->postID;
    }

    public function getCID()
    {
        return $this->photoCID;
    }

    public function getDescription()
    {
        return $this->desc;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public static function insertLike($userID, $photoID)
    {
        $dbh = new Dbh();
        $stmt = $dbh->connect()->prepare(
            "INSERT INTO favourites (ID, fk_userID, fk_postID) VALUES (?, ?, ?);"
        );

        $lastID = self::checkLastPostID();
        $newID = $lastID + 1;

        if (!$stmt->execute(array($newID, $userID, $photoID))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }
    }

    public static function deleteLike($userID, $photoID)
    {
        $dbh = new Dbh();
        $stmt = $dbh->connect()->prepare(
            "DELETE FROM favourites WHERE fk_userID = ? AND fk_postID = ?;"
        );

        if (!$stmt->execute(array($userID, $photoID))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }
    }

    public function checkIfPostIsLiked($userID, $photoID): bool
    {
        $stmt = $this->connect()->prepare(
            "SELECT * FROM favourites WHERE fk_userID = ? AND fk_postID = ?;"
        );

        if (!$stmt->execute(array($userID, $photoID))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    protected static function checkLastPostID(): int
    {
        $dbh = new Dbh();
        $stmt = $dbh->connect()->prepare(
            "SELECT ID FROM favourites ORDER BY ID DESC LIMIT 1;"
        );

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) return 0;
        return $result["ID"];
    }

    public static function getPosts(): array
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT ID, CID, description as 'desc', fk_userID as userID FROM posts ORDER BY ID DESC";
        $stmt = $connection->query($query);
        $data = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($data as $singleData) {
            $post = new Post(
                $singleData['ID'],
                $singleData['CID'],
                $singleData['desc'],
                $singleData['userID']
            );

            array_push($array, $post);
        }

        return $array;
    }

    public static function getLikedPosts(int $userID): array
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT p1.ID, p1.CID, p1.description as 'desc', p1.fk_userID as 'userID'
            FROM users u1 INNER JOIN posts p1 ON u1.ID = p1.fk_userID INNER JOIN favourites f1 ON p1.ID = f1.fk_postID
            WHERE f1.fk_userID = ? ORDER BY f1.ID DESC;";

        $stmt = $connection->prepare($query);
        $stmt->execute(array($userID));

        if (!$stmt->execute(array($userID))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($data as $singleData) {
            $post = new Post(
                $singleData['ID'],
                $singleData['CID'],
                $singleData['desc'],
                $singleData['userID']
            );

            array_push($array, $post);
        }

        return $array;
    }

    public static function getUserPosts(int $userID): array
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT ID, CID, description as 'desc', fk_userID as 'userID'
                FROM posts WHERE fk_userID = ?;";

        $stmt = $connection->prepare($query);
        $stmt->execute(array($userID));

        if (!$stmt->execute(array($userID))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($data as $singleData) {
            $post = new Post(
                $singleData['ID'],
                $singleData['CID'],
                $singleData['desc'],
                $singleData['userID']
            );

            array_push($array, $post);
        }

        return $array;
    }
}