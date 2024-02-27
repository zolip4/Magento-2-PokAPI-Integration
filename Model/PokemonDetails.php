<?php

declare(strict_types=1);

namespace Onion\PokeApi\Model;

use Magento\Framework\Serialize\SerializerInterface;
use Onion\PokeApi\Helper\Data;
use Onion\PokeApi\Model\Api\PokeApiService;

class PokemonDetails
{
    protected $pokemonDetailsCache = [];

    public function __construct(
        protected readonly Data $helper,
        protected readonly SerializerInterface $serializer,
        protected readonly PokeApiService $apiService
    ) {
    }

    public function getPokemonDetails(string $name)
    {
        if (isset($this->pokemonDetailsCache[$name])) {
            return $this->pokemonDetailsCache[$name];
        }

        try {
            $pokemonDetails = $this->apiService->doRequest(Data::API_REQUEST_ENDPOINT . $name);
        } catch (\Exception $exception) {
        }

        $this->pokemonDetailsCache[$name] = $this->serializer->unserialize($pokemonDetails->getBody()->getContents());

        return $this->pokemonDetailsCache[$name];
    }
}
