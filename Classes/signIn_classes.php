<?php

declare(strict_types=1);

require_once('dbh_classes.php');

class SignIn extends Dbh
{
    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function signInUser()
    {
        $userData = $this->getUser($this->username, $this->password);

        session_start();
        $_SESSION["userid"] = $userData["ID"];
        $_SESSION["username"] = $userData["username"];
        $_SESSION["email"] = $userData["email"];
        $_SESSION["role"] = $userData["role"];
    }

    protected function getUser($username, $password): array
    {
        $stmt = $this->connect()->prepare(
            'SELECT ID, username, email, fk_roleID as "role" FROM users WHERE username = ? AND password = ?;'
        );

        if (!$stmt->execute(array($username, $password))) {
            $stmt = null;
            header("location: ../Views/signIn.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../Views/signIn.php?error=incorrectuser");
            exit();
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}