<?php

declare(strict_types=1);

class UserController extends \User
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

    public function updateUser()
    {
        $redirect = "location: ../Views/user.php?";

        if ($this->emailTaken()) {
            if ($redirect != "location: ../Views/user.php?") $redirect .= "&emailTakenError=1";
            else $redirect .= "emailTakenError=1";
        }

        if ($this->usernameTaken()) {
            if ($redirect != "location: ../Views/user.php?") $redirect .= "&usernameTakenError=1";
            else $redirect .= "usernameTakenError=1";
        }

        if ($redirect == "location: ../Views/user.php?") $this->setUser($this->id, $this->username, $this->email);
        else {
            header($redirect);
            exit();
        }
    }

    private function emailTaken(): bool
    {
        if ($this->checkEmail($this->id, $this->email)) return true;

        return false;
    }

    private function usernameTaken(): bool
    {
        if ($this->checkUsername($this->id, $this->username)) return true;

        return false;
    }
}
