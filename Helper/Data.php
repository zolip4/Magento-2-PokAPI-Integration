<?php

declare(strict_types=1);

namespace Onion\PokeApi\Helper;

use Magento\Framework\App\Cache\StateInterface;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\ObjectManagerInterface;

class Data extends AbstractHelper
{
    public const API_REQUEST_ENDPOINT = 'pokemon/';
    protected const BASE_API_URL_PATH = 'onion/general/base_api_url';
    protected const POKEMON_IMPORT_LIMIT_PATH = 'onion/download_import/limit';
    protected const ONION_MODULE_ENABLE_PATH = 'onion/general/enable';

    public function __construct(
        protected readonly Context $context,
        protected readonly DirectoryList $directoryList,
        protected readonly ConfigInterface $_resource,
        protected readonly StateInterface $state,
        protected readonly File $fileDriver,
        protected readonly ObjectManagerInterface $objectManager
    ) {
        parent::__construct($context);
    }

    public function getBaseApiUrl()
    {
        return $this->scopeConfig->getValue(self::BASE_API_URL_PATH);
    }

    public function getPokemonLimit()
    {
        return $this->scopeConfig->getValue(self::POKEMON_IMPORT_LIMIT_PATH);
    }

    public function isModuleEnable()
    {
        return $this->scopeConfig->getValue(self::ONION_MODULE_ENABLE_PATH);
    }
}
