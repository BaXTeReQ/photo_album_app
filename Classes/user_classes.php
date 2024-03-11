<?php

declare (strict_types = 1);

require_once 'dbh_classes.php';

class User extends Dbh
{
    private int $id;
    private string $username;
    private string $email;
    private string $profile_photoCID;

    public function __construct(int $id, string $username = "", string $email = "", string $profile_photoCID = "")
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->profile_photoCID = $profile_photoCID;
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

    public function getProfilePhotoCID(): string
    {
        return $this->profile_photoCID;
    }

    private function emailTaken(): bool
    {
        if ($this->checkEmail($this->id, $this->email)) {
            return true;
        }

        return false;
    }

    private function usernameTaken(): bool
    {
        if ($this->checkUsername($this->id, $this->email)) {
            return true;
        }

        return false;
    }

    public function updateUser()
    {
        $redirect = "location: ../Views/user.php?";

        if ($this->emailTaken()) {
            if ($redirect != "location: ../Views/user.php?") {
                $redirect .= "&emailTakenError=1";
            } else {
                $redirect .= "emailTakenError=1";
            }

        }

        if ($this->usernameTaken()) {
            if ($redirect != "location: ../Views/user.php?") {
                $redirect .= "&usernameTakenError=1";
            } else {
                $redirect .= "usernameTakenError=1";
            }

        }

        if ($redirect == "location: ../Views/user.php?") {
            $this->setUser($this->id, $this->username, $this->email);
        } else {
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

        if ($stmt->rowCount() > 0) {
            return true;
        }

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

        if ($stmt->rowCount() > 0) {
            return true;
        }

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
                    $userData["email"],
                    $userData["profile_photoCID"]
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

    public function getProfilePhotoCIDById($userID)
    {
        $stmt = $this->connect()->prepare(
            "SELECT profile_photoCID as 'CID' FROM users WHERE ID = ?;"
        );

        if (!$stmt->execute(array($userID))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["CID"];
    }

    public static function getUserDataByID(int $id): User
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT ID, username, email, profile_photoCID as 'photo'
        FROM users WHERE ID = ? ";

        $stmt = $connection->prepare($query);
        $stmt->execute(array($id));

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = new User(
            $data['ID'],
            $data['username'],
            $data['email'],
            $data['photo']
        );

        return $user;
    }

    public static function getUserPasswordByID(int $id): string
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT password FROM users WHERE ID = ? ";

        $stmt = $connection->prepare($query);
        $stmt->execute(array($id));

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['password'];
    }

    public static function editUser(int $id, string $username, string $email, string $password)
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE ID = ?";

        $stmt = $connection->prepare($query);

        if (!$stmt->execute(array($username, $email, $password, $id))) {
            $stmt = null;
            header("location: ../Views/error.php?error=stmtfailed");
            exit();
        }
    }

    public static function deleteUser(int $id)
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "DELETE FROM users WHERE ID = ?";

        $stmt = $connection->prepare($query);
        $stmt->execute(array($id));
    }
}