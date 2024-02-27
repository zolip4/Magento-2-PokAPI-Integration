<?php

declare(strict_types=1);

namespace Onion\PokeApi\Block\Adminhtml;

use Magento\Backend\Block\Template as MagentoTemplate;
use Magento\Backend\Block\Template\Context;

class Template extends MagentoTemplate
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }
}
