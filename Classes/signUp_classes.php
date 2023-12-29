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
}
