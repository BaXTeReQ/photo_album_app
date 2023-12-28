<?php

declare(strict_types=1);

class User extends Dbh
{
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

    public function checkEmail($email): bool
    {
        $stmt = $this->connect()->prepare(
            'SELECT email FROM users WHERE email = ?'
        );

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../user.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) return true;

        return false;
    }

    public function checkUsername($username): bool
    {
        $stmt = $this->connect()->prepare(
            "SELECT username FROM users WHERE username = ?"
        );

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../user.php?errorstmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) return true;

        return false;
    }
}
