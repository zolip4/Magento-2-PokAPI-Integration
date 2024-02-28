<?php

declare(strict_types=1);

namespace Onion\PokeApi\Controller\Adminhtml\Import;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Serialize\SerializerInterface;
use Onion\PokeApi\Helper\Data as Helper;
use Onion\PokeApi\Model\Api\PokeApiService;
use Onion\PokeApi\Model\ImportManager;

/**
 * @SuppressWarnings(PHPMD)
 */
class Index extends Action
{
    public function __construct(
        protected readonly Helper $helper,
        protected readonly SerializerInterface $serializer,
        protected readonly PokeApiService $apiService,
        protected readonly ImportManager $importManager,
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute(): void
    {
        $result = [];

        $response = $this->apiService->doRequest(
            Helper::API_REQUEST_ENDPOINT,
            ['query' => ['limit' => $this->helper->getPokemonLimit()]]
        );

        if ($response->getStatusCode() == \Magento\Framework\Webapi\Response::HTTP_OK) {
            $this->importManager->doProcess($response->getBody()->getContents());
            $result['isDataImport'] = $this->importManager->importTableHasData();
            $result['status'] = ImportManager::COMPLETED_IMPORT_CSS_CLASS;
        } else {
            $result['error'] = $response->getReasonPhrase();
            $result['status'] = ImportManager::FAILED_IMPORT_CSS_CLASS;
        }

        $this->getResponse()->setBody($this->serializer->serialize($result));
    }
}
