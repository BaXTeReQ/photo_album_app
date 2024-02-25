<?php

declare(strict_types=1);

require_once('dbh_classes.php');
require_once('user_classes.php');
require_once('post_classes.php');

class Search extends Dbh
{
    public function getUsersBySearch($search): array
    {
        $stmt = $this->connect()->prepare(
            "SELECT * FROM users WHERE username LIKE ? AND fk_roleID = 3;"
        );

        if (!$stmt->execute(array("%$search%"))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $usersData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($usersData as $userData) {
            $user = new User(
                $userData["ID"],
                $userData["username"],
                $userData["email"],
                $userData["profile_photoCID"]
            );

            array_push($array, $user);
        }

        return $array;
    }

    public function getPostsBySearch(string $search): array
    {
        $stmt = $this->connect()->prepare(
            "SELECT ID, CID, description as 'desc', fk_userID as 'userID' FROM posts WHERE description LIKE ?;"
        );

        if (!$stmt->execute(array("%$search%"))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $postsData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($postsData as $postData) {
            $post = new Post(
                $postData['ID'],
                $postData['CID'],
                $postData['desc'],
                $postData["userID"]
            );

            array_push($array, $post);
        }

        return $array;
    }
}