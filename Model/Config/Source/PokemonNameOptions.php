<?php

namespace Onion\PokeApi\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Onion\PokeApi\Model\PokemonRepository;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

class PokemonNameOptions extends AbstractSource
{
    public function __construct(
        protected readonly PokemonRepository $pokemonRepository,
        protected readonly SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
    }

    public function getAllOptions(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $pokemonNameList = $this->pokemonRepository->getList($searchCriteria);

        $this->_options[] = ['label' => '---Choose a pokemon name', 'value' => 0];

        foreach ($pokemonNameList->getItems() as $key => $pokemon) {
            $this->_options[] = ['label' => $pokemon->getName(), 'value' => $pokemon->getId()];
        }

        return $this->_options;
    }
}
