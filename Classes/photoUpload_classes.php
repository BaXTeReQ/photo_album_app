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
            $file = $this->resizeProfilePhoto($file, $fileExtension);
            $CID = $ipfs->pinPhoto($file, $newFileName);
            $desc = "Profile photo for user with ID = $userID";

            // TODO: think about not adding another record if user adds photo pinned before

            $stmt = $this->connect()->prepare(
                'INSERT INTO photos(CID, photoName, description) VALUES (?,?,?)'
            );

            $stmt->execute(array($CID, $newFileName, $desc));

            $photoID = $this->getLastProfilePhotoID();

            $stmt = $this->connect()->prepare(
                'UPDATE users_profile_photos SET fk_photoID = ? WHERE fk_userID = ?;'
            );

            $stmt->execute(array($photoID, $userID));
        }
    }

    public function getLastProfilePhotoID()
    {
        $dbh = new Dbh();
        $connection = $dbh->connect();

        $query = "SELECT ID FROM photos ORDER BY ID DESC LIMIT 1;";
        $stmt = $connection->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastID = $result["ID"];

        if ($stmt->rowCount() > 0) return $lastID;
        else return 1;
    }

    public function resizeProfilePhoto($file, $extension)
    {
        $targetSize = 500;

        if (is_array($file) && isset($file['tmp_name'])) {
            $file_tmp = $file['tmp_name'];
        }

        list($originalWidth, $originalHeight) = getimagesize($file_tmp);

        if ($originalHeight < $originalWidth) {
            $resizeRatioHeight = $originalHeight / $targetSize;
            $newHeight = intval($targetSize);
            $newWidth = intval($originalWidth / $resizeRatioHeight);
        } else if ($originalHeight > $originalWidth) {
            $resizeRatioWidth = $originalWidth / $targetSize;
            $newHeight = intval($originalHeight / $resizeRatioWidth);
            $newWidth = intval($targetSize);
        } else {
            $newHeight = intval($targetSize);
            $newWidth = intval($targetSize);
        }

        $cropValue = abs($newHeight - $newWidth) / 2;

        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        if ($extension === 'jpeg' || $extension === 'jpg') $sourceImage = imagecreatefromjpeg($file_tmp);
        else if ($extension === 'png') $sourceImage = imagecreatefrompng($file_tmp);
        else die('Unsupported file type');

        imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

        $tempResizedFileName = tempnam(sys_get_temp_dir(), 'resized_image_') . '.' . $extension;

        if ($originalHeight < $originalWidth) {
            $croppedImage = imagecrop($resizedImage, [
                'x' => $cropValue,
                'y' => 0,
                'width' => $targetSize,
                'height' => $targetSize
            ]);
        } else if ($originalHeight > $originalWidth) {
            $croppedImage = imagecrop($resizedImage, [
                'x' => 0,
                'y' => $cropValue,
                'width' => $targetSize,
                'height' => $targetSize
            ]);
        } else {
            $croppedImage = $resizedImage;
        }

        if ($extension === 'jpeg' || $extension === 'jpg') imagejpeg($croppedImage, $tempResizedFileName);
        else if ($extension === 'png') imagepng($croppedImage, $tempResizedFileName);

        imagedestroy($sourceImage);

        return array(
            'width' => $targetSize,
            'height' => $targetSize,
            'mime' => image_type_to_mime_type(exif_imagetype($tempResizedFileName)), // Get MIME type
            'tmp_name' => $tempResizedFileName, // Temporary file path
        );
    }
}
