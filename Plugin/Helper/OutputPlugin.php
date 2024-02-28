<?php

declare(strict_types=1);

namespace Onion\PokeApi\Plugin\Helper;

use Onion\PokeApi\Model\AbstractPlugin;

class OutputPlugin extends AbstractPlugin
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeProductAttribute($subject, $product, $attributeHtml, $attributeName)
    {
        if ($attributeName == 'short_description' && $response = $this->getPokemonDetails($product)) {
            $html = '';

            foreach ($response['stats'] as $stat) {
                $html .= '<div><b>'. $stat['stat']['name'] .': </b>' . $stat['base_stat'] . '</div>';
            }

            $attributeHtml = $html;
        }

        return [$product, $attributeHtml, $attributeName];
    }
}
