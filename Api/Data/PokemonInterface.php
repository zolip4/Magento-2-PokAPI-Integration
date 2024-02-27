<?php

namespace Onion\PokeApi\Api\Data;

interface PokemonInterface
{
    const ENTITY_ID = 'entity_id';
    const POKEMON_NAME = 'pokemon_name';

    /**
     * @return string
     */
    public function getId(): ?string;

    /**
     * @return string
     */
    public function getName(): ?string;
}
