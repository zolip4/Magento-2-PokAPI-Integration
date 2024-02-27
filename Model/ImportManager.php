<?php

namespace Onion\PokeApi\Model;

use Magento\Framework\Model\AbstractModel;
use Onion\PokeApi\Helper\Data;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\ResourceConnection;

class ImportManager extends AbstractModel
{
    protected const POKEMON_TABLE_NAME = 'onion_import_pokemon';
    public const COMPLETED_IMPORT_CSS_CLASS = 'completed';
    public const FAILED_IMPORT_CSS_CLASS = 'failed';

    public function __construct(
        protected readonly SerializerInterface $serializer,
        protected readonly ResourceConnection $resource,
        protected readonly Data $data
    ) {
    }

    public function doProcess($data): void
    {
        $data = $this->prepareDataToImport($data);
        $write = $this->resource->getConnection();

        //delete all records
        $write->truncateTable($this->resource->getTableName(self::POKEMON_TABLE_NAME));
        //prepare data for insert
        $dataForInsert = $this->importItem($data['results']);
        //insert new data from response
        $write->insertMultiple(self::POKEMON_TABLE_NAME, $dataForInsert);
    }

    public function importTableHasData(): bool
    {
        $write = $this->resource->getConnection();
        $blockTable = $this->resource->getTableName(self::POKEMON_TABLE_NAME);

        $countBlock = $write->select('count(entity_id)')->from($blockTable)->limit(1);

        $block = $write->fetchCol($countBlock);

        return array_key_exists(0, $block) && $block[0];
    }

    protected function importItem($dataForImport): array
    {
        $dataForInsert = [];

        foreach ($dataForImport as $data) {
            $dataForInsert[] = [
                'pokemon_name' => $data['name'],
            ];
        }

        return $dataForInsert;
    }

    protected function prepareDataToImport($data): mixed
    {
        return $this->serializer->unserialize($data);
    }
}
