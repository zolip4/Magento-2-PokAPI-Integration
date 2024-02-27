<?php

declare(strict_types=1);

namespace Onion\PokeApi\Plugin\Model\Product;

use Onion\PokeApi\Model\AbstractPlugin;

class ProductPlugin extends AbstractPlugin
{
    public function afterGetName($subject, $result)
    {
        if ($response = $this->getPokemonDetails($subject)) {
            return $response['name'];
        }

        return $result;
    }
}
