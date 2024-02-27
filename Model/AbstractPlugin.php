<?php

declare(strict_types=1);

namespace Onion\PokeApi\Model;

use Magento\Catalog\Block\Product\ImageBuilder;
use Magento\Catalog\Helper\ImageFactory;
use Magento\Framework\Serialize\SerializerInterface;
use Onion\PokeApi\Model\Api\PokeApiService;

abstract class AbstractPlugin
{
    protected const ONION_POKEMON_NAME = 'onion_pokemon_name';

    public function __construct(
        protected readonly ImageFactory $imageFactory,
        protected readonly ImageBuilder $imageBuilder,
        protected readonly PokeApiService $apiService,
        protected readonly PokemonRepository $pokemonRepository,
        protected readonly PokemonDetails $pokemonDetails,
        protected readonly SerializerInterface $serializer
    ) {
    }

    public function getPokemonDetails($product)
    {
        if ($pokemonId = $this->hasPokemonName($product)) {
            $pokemonEntity = $this->pokemonRepository->getById($pokemonId);

            if ($pokemonEntity) {
                $pokemonDetails = $this->pokemonDetails->getPokemonDetails($pokemonEntity->getName());

                return $pokemonDetails;
            }
        }

        return false;
    }

    private function hasPokemonName($product)
    {
        return $product->getData(self::ONION_POKEMON_NAME);
    }
}
