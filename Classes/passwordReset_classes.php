<?php 

declare(strict_types = 1);

class PasswordReset extends Dbh
{
    protected function getUser($username, $email)
    {
        $stmt = $this->connect()->prepare(
            'SELECT username, email FROM users WHERE username = ? AND email = ?;'
        );
    
        if (!$stmt->execute(array($username, $email)))
        {
            $stmt = null;
            header("location: ../Views/passwordReset.php?error=stmtfailed"); 
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: ../Views/passwordReset.php?error=incorrectuser");
            exit();
        }
    }

    protected function updatePassword($username, $password) 
    {
        $stmt = $this->connect()->prepare(
            'UPDATE users SET password = ? WHERE username = ?;'
        );

        if (!$stmt->execute(array($password, $username))) {
            $stmt = null;
            header("location: ../passwordReset.php?error=stmtfailed");
            exit();
        }

        // echo $stmt;

        
        $stmt = null;
    }
}