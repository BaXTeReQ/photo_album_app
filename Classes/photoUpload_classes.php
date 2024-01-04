<?php

declare(strict_types=1);

require_once('dbh_classes.php');
require_once('ipfs_classes.php');

class PhotoUpload extends Dbh
{
    public function changeProfilePhoto($userID, $file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return false;

        $allowedExtensions = array("jpeg", "jpg", "png");
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) return false;

        $newFileName = "profilePic_$userID.$fileExtension";

        $ipfs = new IPFS();

        if (!$ipfs->API_PinResponse()) return false;
        else {
            $CID = $ipfs->pinPhoto($file, $newFileName);
            $desc = "Profile photo for user with ID = $userID";

            $stmt = $this->connect()->prepare(
                'INSERT INTO photos(CID, photoName, description) VALUES (?,?,?)'
            );

            $stmt->execute(array($CID, $newFileName, $desc));

            $photoID = $this->getLastProfilePhotoID();

            $stmt = $this->connect()->prepare(
                'INSERT INTO users_profile_photos(fk_userID, fk_PhotoID) VALUES(?,?);'
            );

            $stmt->execute(array($userID, $photoID));
        }
    }

    public function getLastProfilePhotoID()
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT ID FROM users_profile_photos ORDER BY ID DESC LIMIT 1;";
        $stmt = $connection->query($query);
        $lastID = $stmt->fetchALL(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) return $lastID;
        else return 1;
    }
}
