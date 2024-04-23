<?php

declare (strict_types = 1);

class IPFS
{
    private string $apiPing = "https://api.pinata.cloud/data/testAuthentication";
    private string $apiPin = "https://api.pinata.cloud/pinning/pinFileToIPFS";
    private string $apiKey = "";
    private string $apiSecret = "";
    private string $gateway = "";

    public function __construct()
    {
        include '../_api/variables.php';
        $this->apiKey = $key;
        $this->apiSecret = $secret;
        $this->gateway = $gateway;
    }

    public function API_PinResponse(): bool
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiPing);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'pinata_api_key: ' . $this->apiKey,
            'pinata_secret_api_key: ' . $this->apiSecret,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            $responseData = json_decode($response, true);

            if (
                $responseData && isset($responseData['message'])
                && $responseData['message'] === 'Congratulations! You are communicating with the Pinata API!'
            ) {
                curl_close($ch);
                return true;
            } else {
                curl_close($ch);
                return false;
            }
        }
    }

    public function pinPhoto($filePath, $newFileName): string
    {
        $ch = curl_init();

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

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response, true);

        return $result['IpfsHash'];
    }

    public function getGateway(): string
    {
        return $this->gateway;
    }

    public static function changeGateway(string $newGateway)
    {
        $file = '../_api/variables.php';

        $handle = fopen($file, 'r+');

        if (flock($handle, LOCK_EX)) {
            $lines = [];
            while (!feof($handle)) {
                $lines[] = fgets($handle);
            }

            foreach ($lines as $lineIndex => $line) {
                if (strpos($line, '$gateway') !== false) {
                    $lines[$lineIndex] = '$gateway = "' . $newGateway . '";' . PHP_EOL;
                    break;
                }
            }

            $content = implode('', $lines);

            ftruncate($handle, 0);
            rewind($handle);
            fwrite($handle, $content);

            flock($handle, LOCK_UN);
            fclose($handle);
        } else {
            fclose($handle);
            throw new Exception("Nie udało się zablokować pliku $file.");
        }

    }

    public function calcTimeForGateway(string $gateway)
    {
        $start_time = microtime(true);

        $image_hash = 'QmP8SdGsd7Yv7pVdLKmGbYU6xLFDuTBMm5pAoQQSCqtB4V';

        $gateway_url = $gateway . $image_hash;

        $ch = curl_init($gateway_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);

        $end_time = microtime(true);

        $loading_time = $end_time - $start_time;

        return $loading_time;
    }
}
