<?php

namespace Heroes\Common;

trait MarvelApiRequestTrait
{
    public function getUrl(string $url, int $timeStamp = null, array $queryParam = [])
    {
        return $url.$this->getQueryParams($timeStamp, $queryParam);
    }

    private function getApiKey()
    {
        if (!empty(getenv('MARVEL_API_KEY'))) {
            return getenv('MARVEL_API_KEY');
        }

        if (!empty(getenv('MARVEL_PUBLIC_KEY'))) {
            return getenv('MARVEL_PUBLIC_KEY');
        }

        return "";
    }

    private function getHash(int $timeStamp = null)
    {
        if (!empty(getenv('MARVEL_API_HASH'))) {
            return getenv('MARVEL_API_HASH');
        }

        if (!empty(getenv('MARVEL_PRIVATE_KEY'))) {
            $hash = $this->getTs($timeStamp) . getenv('MARVEL_PRIVATE_KEY') . $this->getApiKey();
            return md5($hash);
        }

        return "";
    }

    public function getTs(?int $timeStamp = null) : int
    {
        if (empty($timeStamp)) {
            return 1;
        }
        return $timeStamp;
    }

    public function getQueryParams(int $timeStamp = null, array $queryParam = [])
    {
        $params = "?ts={$this->getTs($timeStamp)}&apikey={$this->getApiKey()}&hash={$this->getHash($timeStamp)}";
        if (empty($queryParam)) {
            return $params;
        }

        $queryParam = collect($queryParam);
        $queryParam->each(function ($paramValue, $paramKey) use (&$params) {
            $params.= "&{$paramKey}={$paramValue}";
        });

        return $params;
    }
}
