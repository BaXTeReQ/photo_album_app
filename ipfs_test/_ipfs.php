<?php

// Set the IPFS API endpoint
$ipfsApiEndpoint = "http://localhost:5001/api/v0/add";

// Function to upload file to IPFS
function uploadToIPFS($file)
{
    global $ipfsApiEndpoint;

    $postData = array('file' => curl_file_create($file['tmp_name'], $file['type'], $file['name']));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ipfsApiEndpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    var_dump($response);

    curl_close($ch);

    return json_decode($response, true);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadedFile = $_FILES['image'];

    // Upload the image to IPFS
    $ipfsResponse = uploadToIPFS($uploadedFile);

    // Display the IPFS hash and the image
    if (isset($ipfsResponse['Hash'])) {
        $ipfsHash = $ipfsResponse['Hash'];
        echo "Image uploaded successfully to IPFS!<br>";
        echo "IPFS Hash: " . $ipfsHash;

        // Display the image using an img tag
        // bramka publiczna
        echo "<br><img src='https://ipfs.io/ipfs/$ipfsHash' alt='Uploaded Image'>";
        // bramka lokalna
        echo "<br><img src='http://localhost:8080/ipfs/$ipfsHash' alt='Uploaded Image'>";

        // Copy the file to IPFS files

        $fileName = $ipfsResponse['Name'];
        $ipfsFilesCpCommand = "C:\Users\BaXTeR\Desktop\kubo\ipfs.exe files cp /ipfs/$ipfsHash /$fileName";
        shell_exec($ipfsFilesCpCommand);
    } else {
        echo "Failed to upload image to IPFS.";
    }
}
