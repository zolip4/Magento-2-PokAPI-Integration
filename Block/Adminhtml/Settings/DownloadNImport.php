<?php

declare(strict_types=1);

namespace Onion\PokeApi\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;
use Onion\PokeApi\Block\Adminhtml\Template;
use Onion\PokeApi\Model\ImportManager;

class DownloadNImport extends Field
{
    protected const DOWNLOAD_N_IMPORT_TEMPLATE = 'Onion_PokeApi::download_n_import.phtml';
    protected const ONION_IMPORT_ACTION = 'onion/import/index';

    public function __construct(
        protected readonly ImportManager $importManager,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @throws LocalizedException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function _getElementHtml(AbstractElement $element): string
    {
        $block = $this->getLayout()
            ->createBlock(Template::class)
            ->setTemplate(self::DOWNLOAD_N_IMPORT_TEMPLATE)
            ->setConfig(json_encode($this->getUrl(
                self::ONION_IMPORT_ACTION
            )));
        $this->setIsDataImport($block);

        return $block->toHtml();
    }

    public function setIsDataImport($block): void
    {
        $block->setImportedClass(
            json_encode(
                $this->importManager->importTableHasData()
                    ? ImportManager::COMPLETED_IMPORT_CSS_CLASS
                    : ImportManager::FAILED_IMPORT_CSS_CLASS
        ));
    }
}
