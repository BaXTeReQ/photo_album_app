<?php

declare(strict_types=1);

require_once('dbh_classes.php');

class User extends Dbh
{
    private int $id;
    private string $username;
    private string $email;

    public function __construct(int $id, string $username, string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    protected function setUser($id, $username, $email)
    {
        $stmt = $this->connect()->prepare(
            'UPDATE users SET username = ?, email = ? WHERE ID = ?'
        );

        if (!$stmt->execute(array($username, $email, $id))) {
            $stmt = null;
            header("location: ../user.php?error=stmtfailed");
            exit();
        }

        $_SESSION["userid"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;

        $stmt = null;
    }

    public function checkEmail($id, $email): bool
    {
        $stmt = $this->connect()->prepare(
            'SELECT email FROM users WHERE email = ? AND NOT ID = ?'
        );

        if (!$stmt->execute(array($email, $id))) {
            $stmt = null;
            header("location: ../user.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) return true;

        return false;
    }

    public function checkUsername($username, $id): bool
    {
        $stmt = $this->connect()->prepare(
            "SELECT username FROM users WHERE username = ? AND NOT ID = ?"
        );

        if (!$stmt->execute(array($username, $id))) {
            $stmt = null;
            header("location: ../user.php?errorstmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) return true;

        return false;
    }

    public static function getRecommendedUsers(int $loggedUser = 0): array
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT * FROM users WHERE fk_roleID = 3 AND NOT ID = $loggedUser ORDER BY RAND() LIMIT 5";
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

    public function getUserID(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
