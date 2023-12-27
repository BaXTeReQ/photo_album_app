<?php

declare(strict_types = 1);

class SignInController extends \SignIn
{
    private string $username;
    private string $password;

    public function __construct(string $username, string $password)// :self
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function signInUser()
    {
        $this->getUser($this->username, $this->password);
    }
}