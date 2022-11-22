<?php
declare(strict_types=1);

/**
 * @info HostifyApi actions from https://app.hostify.com/docs
 */
class ListingController
{
    use ValidatorTrait;

    private $client;
    private $curlManager;
    public function __construct()
    {
        $this->client = Config::getInstance();
        $this->curlManager = new CurlManager();
    }

    public function list(string $endpoint, array $params = [], ?int $id = null)
    {
        try {
            if ($id) {
                $endpoint = str_replace('ID', (string)$id, $endpoint);
            }
            return $this->curlManager->sendGet($endpoint, $params);
        } catch (Throwable $e) {
            throw new Exception($e);
        }
    }

    public function create(string $endpoint, array $params = [], ?int $id = null)
    {
        try {
            $errors = $this->validateCreate($endpoint, $params);

            if (empty($errors)) {
                return $this->curlManager->sendPost($endpoint, $params);
            } else {
                return json_encode($errors);
            }
        } catch (Throwable $e) {
            throw new Exception($e);
        }
    }

    public function update(string $endpoint, array $params = [], ?int $id = null)
    {
        try {
            if ($id) {
                $endpoint = str_replace('ID', (string)$id, $endpoint);
            }
            $errors = $this->validateUpdate($endpoint, $params);

            if (empty($errors)) {
                return $this->curlManager->sendPut($endpoint, $params);
            } else {
                return json_encode($errors);
            }
        } catch (Throwable $e) {
            throw new Exception($e);
        }
    }
}
