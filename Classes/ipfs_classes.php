<?php

declare(strict_types=1);

class IPFS
{
    private string $apiPing = "https://api.pinata.cloud/data/testAuthentication";
    private string $apiPin = "https://api.pinata.cloud/pinning/pinFileToIPFS";
    private string $apiKey = "";
    private string $apiSecret = "";
    private string $publicGatewayIpfsIo = "https://ipfs.io/ipfs/";
    private string $publicGatewayPinata = "https://gateway.pinata.cloud/ipfs/";
    private string $dedicatedGateway = "";
    private array $gateways = [];

    public function __construct()
    {
        include('../_api/variables.php');
        $this->apiKey = $key;
        $this->apiSecret = $secret;
        $this->dedicatedGateway = $gateway;
        $this->gateways = [
            $this->publicGatewayIpfsIo,
            $this->publicGatewayPinata,
            $this->dedicatedGateway
        ];
    }

    public function API_PinResponse(): bool
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

        // Check errors
        if (curl_errno($ch)) echo 'Curl error: ' . curl_error($ch);
        else {
            // Decode the JSON response
            $responseData = json_decode($response, true);

            // Check if the API response contains a "message" key with the expected message
            if (
                $responseData && isset($responseData['message'])
                && $responseData['message'] === 'Congratulations! You are communicating with the Pinata API!'
            ) {
                // Close cURL session
                curl_close($ch);
                return true;
            } else {
                // Close cURL session
                curl_close($ch);
                return false;
            }
        }
    }

    public function pinPhoto($filePath, $newFileName): string
    {
        // $tmp_path = $file["tmp_name"];

        // Create a cURL handle
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $this->apiPin);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'file' => new CURLFile($filePath, mime_content_type($filePath), $newFileName),
        ]);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: multipart/form-data',
            'pinata_api_key: ' . $this->apiKey,
            'pinata_secret_api_key: ' . $this->apiSecret,
        ]);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $result = json_decode($response, true);

        return $result['IpfsHash'];
    }

    public function getGateway(): string
    {
        return $this->dedicatedGateway;
    }

    public function calcTimeForGateway(string $gateway)
    {
        // Start the timer
        $start_time = microtime(true);

        // Replace 'your_image_hash' with the actual hash of the image you want to load
        $image_hash = 'QmP8SdGsd7Yv7pVdLKmGbYU6xLFDuTBMm5pAoQQSCqtB4V';

        // IPFS gateway URL
        $gateway_url = $gateway . $image_hash;

        // Use cURL to fetch the image
        $ch = curl_init($gateway_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);

        // Stop the timer
        $end_time = microtime(true);

        // Calculate the loading time in seconds
        $loading_time = $end_time - $start_time;

        // Output the loading time
        return $loading_time;
    }
}