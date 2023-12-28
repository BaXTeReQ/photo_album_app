<?php

declare(strict_types = 1);

class PasswordResetController extends \PasswordReset
{
    private string $username;
    private string $email;
    private string $password;

    public function __construct(string $username, string $email, string $password)// :self
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function checkUser()
    {
        $this->getUser($this->username, $this->email);
    }

    public function setNewPassword()
    {
        $redirect = "location: ../Views/passwordReset.php?";

        if($this->passwordIncorrect() == true) $redirect .= "username=$this->username&email=$this->email&invalidpasswordError=1";

        if($redirect == "location: ../Views/passwordReset.php?") $this->updatePassword($this->username, $this->password);
        else 
        {
            header($redirect);
            exit();
        }

        header("location: ../Views/passwordResetSuccess.php");
    }

    private function passwordIncorrect(): bool 
    {
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number = preg_match('@[0-9]@', $this->password);
        $specialChars = preg_match('@[^\w]@', $this->password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8) $result = true;
        else $result = false;
        
        return $result;
    }
}