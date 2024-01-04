<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $tmp_name = $_FILES["image"]["tmp_name"];
        // TODO: nazwa pliku w zaleznosci od tego czy to zdjecie profilowe czy do postu
        $file_name = $_FILES["image"]["name"];

        // Create a cURL handle
        $ch = curl_init();

        // Replace 'YOUR_PINATA_API_KEY' and 'YOUR_PINATA_API_SECRET' with your actual Pinata API credentials
        $pinata_api_key = 'b828c5078ee8ddbc5a64';
        $pinata_api_secret = 'ab5f0fefa904bc26a45887ae0d146354221852d3996b15e9aa2391a02eedea6a';

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, "https://api.pinata.cloud/pinning/pinFileToIPFS");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'file' => new CURLFile($tmp_name, mime_content_type($tmp_name), $file_name),
        ]);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: multipart/form-data',
            'pinata_api_key: ' . $pinata_api_key,
            'pinata_secret_api_key: ' . $pinata_api_secret,
        ]);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $result = json_decode($response, true);

        // Check if the upload was successful
        if (isset($result['IpfsHash'])) {
            echo "Upload successful! IPFS Hash: " . $result['IpfsHash'];
            echo "<br>";
            // bramka dedykowana
            echo "<img src='https://red-above-muskox-423.mypinata.cloud/ipfs/" . $result['IpfsHash'] . "'>";
            // bramka publiczna
            echo "<img src='https://gateway.pinata.cloud/ipfs/" . $result['IpfsHash'] . "'>";
        } else {
            echo "Upload failed. Please try again.";
        }
    } else {
        echo "Error uploading file. Please try again.";
    }
} else {
    // Redirect to the upload form if accessed directly
    header("Location: index.html");
    exit();
}
