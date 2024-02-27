<?php

declare(strict_types=1);

namespace Onion\PokeApi\Api;

use GuzzleHttp\Psr7\Response;

interface PokeApiInterface
{
    /**
     * Fetch Data
     *
     * @param string $uriEndpoint
     * @param array $params
     * @param string $requestMethod
     * @return Response
     */
    public function doRequest(string $uriEndpoint, array $params, string $requestMethod): Response;
}
