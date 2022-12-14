<?php
declare(strict_types=1);

class Config
{
    private static $instance;

    private $apiKey;
    private $apiDomain;

    private function __construct()
    {
        $this->apiKey = env('HOSTIFY_API_KEY', '');
        $this->apiDomain = env('API_DOMAIN', '');
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getDomain(): string
    {
        return $this->apiDomain;
    }
}
