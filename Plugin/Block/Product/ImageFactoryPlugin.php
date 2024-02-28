<?php

declare(strict_types=1);

namespace Onion\PokeApi\Plugin\Block\Product;

use Onion\PokeApi\Model\AbstractPlugin;

class ImageFactoryPlugin extends AbstractPlugin
{
    protected const ONION_POKEMON_NAME = 'onion_pokemon_name';

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterCreate($subject, $result, $product, $imageId, $attributes)
    {
        if ($response = $this->getPokemonDetails($product)) {
            $result->setData('image_url', $response['sprites']['other']['dream_world']['front_default']);
        }

        return $result;
    }
}
