<?php
declare(strict_types=1);

class CurlManager
{
    private $client;

    public function __construct()
    {
        $this->client = Config::getInstance();
    }

    public function sendGet(string $endpoint, array $params = [])
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->client->getDomain() . $endpoint . (!empty($params) ? http_build_query($params) : ''));
            curl_setopt($ch, CURLOPT_POST, 0);

            $headers = [
                'x-api-key: ' . $this->client->getValue(),
            ];
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = json_decode(curl_exec($ch), true);

            curl_close($ch);

            return $server_output;
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function sendPost(string $endpoint, array $params = [])
    {
        try {
            $ch = curl_init();
            $payload = json_encode($params);
            $headers = [
                'x-api-key: ' . $this->client->getValue(),
            ];

            curl_setopt($ch, CURLOPT_URL, $this->client->getDomain() . $endpoint . (!empty($params) ? http_build_query($params) : ''));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = json_decode(curl_exec($ch), true);

            curl_close($ch);

            return $server_output;
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function sendPut(string $endpoint, array $params = [])
    {
        try {
            $ch = curl_init();
            $payload = json_encode($params);
            $headers = [
                'x-api-key: ' . $this->client->getValue(),
            ];

            curl_setopt($ch, CURLOPT_URL, $this->client->getDomain() . $endpoint . (!empty($params) ? http_build_query($params) : ''));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = json_decode(curl_exec($ch), true);

            curl_close($ch);

            return $server_output;
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
