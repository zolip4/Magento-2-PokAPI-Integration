<?php

declare(strict_types=1);

namespace Onion\PokeApi\Model;

use Magento\Framework\Model\AbstractModel;
use Onion\PokeApi\Api\Data\PokemonInterface;
use Onion\PokeApi\Model\ResourceModel\Pokemon as ResourceModel;

class Pokemon extends AbstractModel implements PokemonInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getId(): ?string
    {
        return $this->_getData(self::ENTITY_ID);
    }

    public function getName(): ?string
    {
        return $this->_getData(self::POKEMON_NAME);
    }
}
