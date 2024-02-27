<?php

namespace Onion\PokeApi\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PokemonRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);
}
