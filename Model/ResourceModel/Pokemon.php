<?php

declare(strict_types=1);

namespace Onion\PokeApi\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pokemon extends AbstractDb
{
    public const TABLE = 'onion_import_pokemon';
    public const PRIMARY_KEY_NAME = 'entity_id';

    protected function _construct()
    {
        $this->_init(self::TABLE, self::PRIMARY_KEY_NAME);
    }
}
