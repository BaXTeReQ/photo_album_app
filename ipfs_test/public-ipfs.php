<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Specify the public IPFS gateway URL
        $gatewayUrl = 'https://ipfs.io';

        // API endpoint for adding a file to IPFS
        $apiUrl = $gatewayUrl . '/api/v0/add';

        // Create a cURL handle
        $ch = curl_init($apiUrl);

        // Set cURL options
        $imageFilePath = $_FILES['image']['tmp_name'];
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'file' => curl_file_create($imageFilePath)
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        // Get cURL information for debugging
        $info = curl_getinfo($ch);

        // Close cURL handle
        curl_close($ch);

        // Output cURL information
        echo 'cURL Info: ' . PHP_EOL;
        echo '<pre>';
        var_dump($info);
        echo '</pre>';

        // Check if the response is not empty
        if ($response === false) {
            echo 'Error: Empty response from IPFS API.' . PHP_EOL;
        } else {
            // Decode the JSON response
            $result = json_decode($response, true);

            // Check if the upload was successful
            if (isset($result['Hash'])) {
                echo 'Image uploaded successfully. IPFS hash: ' . $result['Hash'] . PHP_EOL;
                echo 'Public IPFS gateway URL: ' . $gatewayUrl . '/ipfs/' . $result['Hash'] . PHP_EOL;
            } else {
                echo 'Error uploading image to IPFS.' . PHP_EOL;
                var_dump($result); // Print the detailed error response
            }
        }
    } else {
        echo 'Error uploading image. Please make sure you selected a valid image file.' . PHP_EOL;
    }
} else {
    echo 'Invalid request method.' . PHP_EOL;
}
