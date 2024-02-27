<?php

declare(strict_types=1);

namespace Onion\PokeApi\Model\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\Webapi\Rest\Request;
use Onion\PokeApi\Api\PokeApiInterface;
use Onion\PokeApi\Helper\Data;

class PokeApiService implements PokeApiInterface
{
    public function __construct(
        protected readonly Data $helper,
        protected readonly Client $client,
        protected readonly ClientFactory $clientFactory,
        protected readonly SerializerInterface $serializer,
        protected readonly ResponseFactory $responseFactory
    ) {
    }

    public function doRequest(
        string $uriEndpoint,
        array $params = [],
        $requestMethod = Request::HTTP_METHOD_GET
    ): Response {
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => $this->helper->getBaseApiUrl()
        ]]);

        try {
            $response = $client->request(
                $requestMethod,
                $uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }

        return $response;
    }
}
