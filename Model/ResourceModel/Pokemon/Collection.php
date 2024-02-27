<?php

namespace Onion\PokeApi\Model\ResourceModel\Pokemon;

use Onion\PokeApi\Model\Pokemon;
use Onion\PokeApi\Model\ResourceModel\Pokemon as PokemonResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = PokemonResource::PRIMARY_KEY_NAME;

    /**
     * Function for initialize model
     */
    protected function _construct()
    {
        $this->_init(Pokemon::class, PokemonResource::class);
    }

}
