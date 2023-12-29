<?php

declare(strict_types=1);

require_once('dbh_classes.php');
require_once('user_classes.php');

class Search extends Dbh
{
    private array $users;
    private array $posts;
    private array $hashtags;

    public function __construct(int $users, string $posts, string $hashtags)
    {
        $this->users = $users;
        $this->posts = $posts;
        $this->hashtags = $hashtags;
    }

    public static function getUsersBySearch($search): array
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT * FROM users WHERE username LIKE '%$search%' AND fk_roleID = 3;";
        $stmt = $connection->query($query);
        $usersData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($usersData as $userData) {
            $user = new User(
                $userData["ID"],
                $userData["username"],
                $userData["email"],
                $userData["fk_roleID"]
            );

            array_push($array, $user);
        }

        return $array;
    }
}
