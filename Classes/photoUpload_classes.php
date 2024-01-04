<?php

declare(strict_types=1);

require_once('dbh_classes.php');

class PhotoUpload extends Dbh
{
    public function changeProfilePhoto($userID, $file)
    {
        // $CID = 'test_439424416241389';

        if ($file['error'] !== UPLOAD_ERR_OK) return false;

        $allowedExtensions = array("jpeg", "jpg", "png");
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) return false;

        // Set the target directory where you want to store uploaded files
        $targetDir = "../pictures/";

        $newFileName = "profilePic_$userID.$fileExtension";

        // Construct the target filename with the desired name
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            // File uploaded successfully, you can now insert its information into the database if needed.
            // Use the parent::connect() method to get a database connection.
            $stmt = $this->connect()->prepare(
                'INSERT INTO photos(CID, photoName) VALUES (?,?)'
            );

            $stmt->execute(array($targetFile, $newFileName));

            $photoID = $this->getLastProfilePhotoID();

            $stmt = $this->connect()->prepare(
                'INSERT INTO users_profile_photos(fk_userID, fk_PhotoID) VALUES(?,?);'
            );

            $stmt->execute(array($userID, $photoID));

            return true;
        } else return false; // Error uploading the file
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
