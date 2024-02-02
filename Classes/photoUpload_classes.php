<?php

declare(strict_types=1);

require_once('dbh_classes.php');
require_once('ipfs_classes.php');

class PhotoUpload extends Dbh
{
    public function changeProfilePhoto(int $userID, $file)
    {
        if ($this->checkFileExtension($file)) {

            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

            $newFileName = "photoBy_$userID.$fileExtension";

            $ipfs = new IPFS();

            if (!$ipfs->API_PinResponse()) return false;
            else {
                $CID = $ipfs->pinPhoto($file, $newFileName);

                $stmt = $this->connect()->prepare(
                    'UPDATE users SET profile_photoCID = ? WHERE ID = ?'
                );

                $stmt->execute(array($CID, $userID));
            }
        }
    }

    public function addPostPhoto(int $userID, $file, string $desc)
    {
        if ($this->checkFileExtension($file)) {

            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

            $newFileName = "photoBy_$userID.$fileExtension";

            $ipfs = new IPFS();
            if (!$ipfs->API_PinResponse()) return false;
            else {
                $CID = $ipfs->pinPhoto($file, $newFileName);

                $stmt = $this->connect()->prepare(
                    'INSERT INTO posts(CID, description, fk_userID) VALUES (?,?,?)'
                );

                $stmt->execute(array($CID, $desc, $userID));
            }
        }
    }

    protected function checkFileExtension($file): bool
    {
        $allowedExtensions = array("jpeg", "jpg", "png");
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) return false;
        return true;
    }

    public function processPhoto($file): string
    {
        list($type, $data) = explode(';', $file);
        list(, $data)      = explode(',', $data);

        $binaryData = base64_decode($data);

        if (preg_match("/^data:image\/(\w+);base64,/", $file, $matches)) $fileExtension = '.' . $matches[1];

        $filename = 'image_' . uniqid() . $fileExtension;

        $uploadPath = '../Images/';

        file_put_contents($uploadPath . $filename, $binaryData);

        $filePath = $uploadPath . $filename;

        return $filePath;
    }
}