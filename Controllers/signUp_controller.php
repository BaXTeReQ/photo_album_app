<?php

declare(strict_types = 1);

class SignUpController extends \SignUp 
{
    private string $username;
    private string $email;
    private string $password;
    private string $confirm_password;

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

        if($this->emailTaken() == true) 
        {
            if($redirect != "location: ../Views/signUp.php?") $redirect .= "&emailTakenError=1";
            else $redirect .= "emailTakenError=1";
        }

        if($this->usernameTaken() == true) 
        {
            if($redirect != "location: ../Views/signUp.php?") $redirect .= "&usernameTakenError=1";
            else $redirect .= "usernameTakenError=1";
        }

        if($this->passwordMatch() == false) 
        {
            if($redirect != "location: ../Views/signUp.php?") $redirect .= "&password!matchError=1";
            else $redirect .= "password!matchError=1";
        }

        if($this->passwordIncorrect() == true) 
        {
            if($redirect != "location: ../Views/signUp.php?") $redirect .= "&invalidpasswordError=1";
            else $redirect .= "invalidpasswordError=1";
        }

        if($redirect=="location: ../Views/signUp.php?") 
        {
            $this->setUser($this->username, $this->password, $this->email);
        } 
        else 
        {
            header($redirect);
            exit();
        }
    }

    private function emailTaken(): bool 
    {
        if($this->checkEmail($this->email)) $result = true;
        else $result = false;

        return $result;
    }

    private function usernameTaken(): bool 
    {
        if($this->checkUsername($this->username)) $result = true;
        else $result = false;
        
        return $result;
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

    private function passwordMatch(): bool 
    {
        if($this->password !== $this->confirm_password) $result = false;
        else $result = true;

        return $result;
    }
}