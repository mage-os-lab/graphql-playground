<?php

declare(strict_types=1);

namespace MageOS\GraphQlPlayground\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;
use MageOS\GraphQlPlayground\Model\Config;

class Index implements HttpGetActionInterface
{
    public function __construct(
        private Config $config,
        private PageFactory $pageFactory,
        private ForwardFactory $forwardFactory,
        private StoreManagerInterface $storeManager,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        if (!$this->config->isEnabled($this->storeManager->getStore())) {
            $resultForward = $this->forwardFactory->create();
            $resultForward->setController('index');
            $resultForward->forward('defaultNoRoute');

            return $resultForward;
        }

        return $this->pageFactory->create();
    }
}
