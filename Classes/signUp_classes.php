<?php

declare(strict_types=1);

class SignUp extends Dbh
{
    protected function setUser($username, $email, $password)
    {
        $stmt = $this->connect()->prepare(
            'INSERT INTO users (username, email, password, fk_roleID) VALUES (?,?,?,?);'
        );

        if (!$stmt->execute(array($username, $email,  $password, 3))) {
            $stmt = null;
            header("location: ../signUp.php?error=stmtfailed");
            exit();
        }

        $insertedID = $this->getLastUserID();

        $stmt = $this->connect()->prepare(
            'INSERT INTO users_profile_photos(fk_userID, fk_photoID) VALUES (?,?);'
        );

        if (!$stmt->execute(array($insertedID, 1))) {
            $stmt = null;
            header("location: ../signUp.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    public function checkUsername($username): bool
    {
        $stmt = $this->connect()->prepare(
            'SELECT username FROM users WHERE username = ?'
        );

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../signUp.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) $result = true;
        else $result = false;

        return $result;
    }

    public function checkEmail($email): bool
    {
        $stmt = $this->connect()->prepare(
            'SELECT email FROM users WHERE email = ?'
        );

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../signUp.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) $result = true;
        else $result = false;

        return $result;
    }

    public function getLastUserID()
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT ID FROM users ORDER BY ID DESC LIMIT 1;";
        $stmt = $connection->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastID = $result["ID"];

        if ($stmt->rowCount() > 0) return $lastID;
        else return 1;
    }
}
