<?php

declare(strict_types = 1);

require_once ('dbh_classes.php');

class SignIn extends Dbh
{
    protected function getUser($username, $password)
    {
        $stmt = $this->connect()->prepare(
            'SELECT * FROM users WHERE username = ? AND password = ?;'
        );

        if (!$stmt->execute(array($username, $password)))
        {
            $stmt = null;
            header("location: ../Views/signIn.php?error=stmtfailed"); 
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: ../Views/signIn.php?error=incorrectuser");
            exit();
        }

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION["userid"]= $user[0]["ID"];
        $_SESSION["username"]= $user[0]["username"];
        $_SESSION["email"] = $user[0]["email"];

        $stmt = null;
    }
}