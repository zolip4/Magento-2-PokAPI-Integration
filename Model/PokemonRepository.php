<?php

declare(strict_types=1);

namespace Onion\PokeApi\Model;

use Magento\Framework\Api\Search\SearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Onion\PokeApi\Api\PokemonRepositoryInterface;
use Onion\PokeApi\Model\ResourceModel\Pokemon\CollectionFactory;
use Onion\PokeApi\Model\PokemonFactory;

class PokemonRepository implements PokemonRepositoryInterface
{
    protected $entitiesById = [];

    public function __construct(
        protected readonly SearchResultInterfaceFactory $searchResultsFactory,
        protected readonly CollectionFactory $collectionFactory,
        protected readonly CollectionProcessorInterface $processor,
        protected readonly PokemonFactory $pokemonFactory
    ) {
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResult = $this->searchResultsFactory->create();
        $collection = $this->collectionFactory->create();
        $this->processor->process($searchCriteria, $collection);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    /**
     * @inheritdoc
     */
    public function getById($id)
    {
        if (isset($this->entitiesById[$id])) {
            return $this->entitiesById[$id];
        }

        $entity = $this->pokemonFactory->create();
        $entity->getResource()->load($entity, $id);

        if (!$entity->getId()) {
            return null;
        }

        $this->entitiesById[$id] = $entity;

        return $entity;
    }
}
