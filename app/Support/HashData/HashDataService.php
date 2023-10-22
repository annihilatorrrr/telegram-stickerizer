<?php

namespace App\Support\HashData;

class HashDataService
{
    protected const SECRET_KEY = 'HashData';

    public function validate(string $rawData): array
    {
        [$remoteHash, $sortedData] = $this->parseQueryString($rawData);
        $secretKey = $this->createHashHmac(config('app.key'), self::SECRET_KEY);
        $localHash = bin2hex($this->createHashHmac($sortedData, $secretKey));

        if (strcmp($localHash, $remoteHash) !== 0) {
            throw new InvalidHashDataException('Invalid data');
        }

        return $this->queryStringToArray($rawData);
    }

    public function build(array $data): string
    {
        $queryString = http_build_query(array_filter($data));

        [, $sortedData] = $this->parseQueryString($queryString);
        $secretKey = $this->createHashHmac(config('app.key'), self::SECRET_KEY);
        $hash = bin2hex($this->createHashHmac($sortedData, $secretKey));

        return $queryString.'&hash='.$hash;
    }

    protected function queryStringToArray(string $queryString): array
    {
        $data = [];
        parse_str($queryString, $data);
        return $data;
    }

    protected function parseQueryString(string $queryString): array
    {
        // convert url encoded string to array
        $data = $this->queryStringToArray($queryString);

        // pull out the hash
        $hash = $data['hash'] ?? null;
        unset($data['hash']);

        // sort and stringify the remaining data
        ksort($data);
        $data = array_filter($data);
        $data = array_map(
            fn ($key, $value) => sprintf('%s=%s', $key, $value),
            array_keys($data),
            $data,
        );
        $stringData = implode("\n", $data);

        // return the hash and the sorted data
        return [$hash, $stringData];
    }

    protected function createHashHmac(string $data, string $secretKey): string
    {
        return hash_hmac('sha256', $data, $secretKey, true);
    }
}
