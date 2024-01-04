<?php

declare(strict_types=1);

class IPFS
{
    private string $apiPing = "https://api.pinata.cloud/data/testAuthentication";
    private string $apiKey = "x";
    private string $apiSecret = "x";

    public function __construct()
    {
    }

    public function API_Response()
    {
        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $this->apiPing);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'pinata_api_key: ' . $this->apiKey,
            'pinata_secret_api_key: ' . $this->apiSecret
        ]);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Debugging information
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo 'HTTP Code: ' . $httpCode . '<br>';

            // Decode the JSON response
            $responseData = json_decode($response, true);

            echo "<pre>" . var_dump($responseData) . "</pre>";

            // Check if the API response contains a "message" key with the expected message
            if ($responseData && isset($responseData['message']) && $responseData['message'] === 'Congratulations! You are communicating with the Pinata API!') {
                echo 'Piñata API is working!';
            } else {
                echo 'Piñata API is not responding correctly. Check your API endpoint and credentials.';
            }
        }

        // Close cURL session
        curl_close($ch);
    }
}
