<?php

declare(strict_types=1);

require_once('dbh_classes.php');

class User extends Dbh
{
    private int $id;
    private string $username;
    private string $email;

    public function __construct(int $id, string $username = "", string $email = "")
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    public function getUserID(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function emailTaken(): bool
    {
        if ($this->checkEmail($this->id, $this->email)) return true;
        return false;
    }

    private function usernameTaken(): bool
    {
        if ($this->checkUsername($this->id, $this->email)) return true;
        return false;
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

    protected function setUser($id, $username, $email)
    {
        $stmt = $this->connect()->prepare(
            'UPDATE users SET username = ?, email = ? WHERE ID = ?'
        );

        if (!$stmt->execute(array($username, $email, $id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $_SESSION["userid"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;

        $stmt = null;
    }

    protected function checkEmail($id, $email): bool
    {
        $stmt = $this->connect()->prepare(
            'SELECT email FROM users WHERE email = ? AND NOT ID = ?'
        );

        if (!$stmt->execute(array($email, $id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) return true;

        return false;
    }

    protected function checkUsername($username, $id): bool
    {
        $stmt = $this->connect()->prepare(
            "SELECT username FROM users WHERE username = ? AND NOT ID = ?;"
        );

        if (!$stmt->execute(array($username, $id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) return true;

        return false;
    }

    public static function getRecommendedUsers(int $loggedUser = 0): array
    {
        $Dbh = new Dbh();
        $stmt = $Dbh->connect()->prepare(
            "SELECT * FROM users WHERE fk_roleID = 3 AND NOT ID = ? ORDER BY RAND() LIMIT 5;"
        );

        if (!$stmt->execute(array($loggedUser))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            $usersData = $stmt->fetchALL(PDO::FETCH_ASSOC);

            $array = [];

            foreach ($usersData as $userData) {
                $user = new User(
                    $userData["ID"],
                    $userData["username"],
                    $userData["email"]
                );

                array_push($array, $user);
            }
        }
        return $array;
    }

    public function getUsernameById(int $id): string
    {
        $stmt = $this->connect()->prepare(
            "SELECT username FROM users WHERE ID = ?;"
        );

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $username = $stmt->fetch(PDO::FETCH_ASSOC);

        return $username["username"];
    }

    public function getProfilePictureCID(int $id): string
    {
        $stmt = $this->connect()->prepare(
            "SELECT p.CID FROM photos p, users_profile_photos usp, users u WHERE u.ID = ? AND p.ID = usp.fk_photoID AND u.ID = usp.fk_userID;"
        );

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["CID"];
        }

        return $this->getDefaultProfilePictureCID();
    }

    protected function getDefaultProfilePictureCID(): string
    {
        $stmt = $this->connect()->prepare(
            "SELECT CID FROM photos WHERE ID = 1 AND description = 'Default photo for user';"
        );

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["CID"];
        }
    }
}