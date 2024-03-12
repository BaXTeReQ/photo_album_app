<?php

declare (strict_types = 1);

class SignUp extends Dbh
{
    private string $username;
    private string $email;
    private string $password;
    private string $confirm_password;
    protected string $default_profile_photoCID = "Qmb6WUqrY2GVDMMxoJk9Fe7qRHVrLWUMpYb9tsVeaDTGCC";

    public function __construct(string $username, string $email, string $password, string $confirm_password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
    }

    public function signUpUser()
    {
        $redirect = "location: ../Views/signUp.php?";

        if ($this->emailTaken() == true) {
            if ($redirect != "location: ../Views/signUp.php?") {
                $redirect .= "&emailTakenError=1";
            } else {
                $redirect .= "emailTakenError=1";
            }

        }

        if ($this->usernameTaken() == true) {
            if ($redirect != "location: ../Views/signUp.php?") {
                $redirect .= "&usernameTakenError=1";
            } else {
                $redirect .= "usernameTakenError=1";
            }

        }

        if ($this->passwordMatch() == false) {
            if ($redirect != "location: ../Views/signUp.php?") {
                $redirect .= "&password!matchError=1";
            } else {
                $redirect .= "password!matchError=1";
            }

        }

        if ($this->passwordIncorrect() == true) {
            if ($redirect != "location: ../Views/signUp.php?") {
                $redirect .= "&invalidpasswordError=1";
            } else {
                $redirect .= "invalidpasswordError=1";
            }

        }

        if ($redirect == "location: ../Views/signUp.php?") {
            $this->setUser($this->username, $this->email, $this->password);
        } else {
            header($redirect);
            exit();
        }
    }

    private function emailTaken(): bool
    {
        if ($this->checkEmail($this->email)) {
            return true;
        }

        return false;
    }

    private function usernameTaken(): bool
    {
        if ($this->checkUsername($this->username)) {
            return true;
        }

        return false;
    }

    private function passwordIncorrect(): bool
    {
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number = preg_match('@[0-9]@', $this->password);
        $specialChars = preg_match('@[^\w]@', $this->password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8) {
            return true;
        }

        return false;
    }

    protected function passwordMatch(): bool
    {
        if ($this->password !== $this->confirm_password) {
            return false;
        }

        return true;
    }

    protected function setUser($username, $email, $password)
    {
        $stmt = $this->connect()->prepare(
            'INSERT INTO users (username, email, password, profile_photoCID, fk_roleID) VALUES (?,?,?,?,?);'
        );

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($username, $email, $hashedPassword, $this->default_profile_photoCID, 3))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }
    }

    protected function checkUsername($username): bool
    {
        $stmt = $this->connect()->prepare(
            'SELECT username FROM users WHERE username = ?'
        );

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    protected function checkEmail($email): bool
    {
        $stmt = $this->connect()->prepare(
            'SELECT email FROM users WHERE email = ?'
        );

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }
}
