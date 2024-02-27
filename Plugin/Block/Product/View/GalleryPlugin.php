<?php

declare(strict_types=1);

namespace Onion\PokeApi\Plugin\Block\Product\View;

use Onion\PokeApi\Model\AbstractPlugin;

class GalleryPlugin extends AbstractPlugin
{
    public function afterGetGalleryImagesJson($subject, $result)
    {
        $product = $subject->getProduct();

        if ($response = $this->getPokemonDetails($product)) {
            $unserializeData = $this->serializer->unserialize($result);

            foreach ($unserializeData as &$data) {
                $data['thumb'] = $response['sprites']['other']['dream_world']['front_default'];
                $data['img'] = $response['sprites']['other']['dream_world']['front_default'];
                $data['full'] = $response['sprites']['other']['dream_world']['front_default'];
            }

            return $this->serializer->serialize($unserializeData);
        }

        return $result;
    }
}
