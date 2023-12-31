<?php

declare(strict_types=1);

namespace MageOS\GraphQlPlayground\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Configuration for Swagger
 */
class Config
{
    private const XML_PATH_ENABLED_IN_PRODUCTION = 'dev/graphiql/enabled_in_production';

    /**
     * @param State $state
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private State $state,
        private ScopeConfigInterface $scopeConfig,
    )
    {
    }

    /**
     * Is GraphiQL enabled
     *
     * @param StoreInterface $store
     * @return bool
     */
    public function isEnabled(StoreInterface $store): bool
    {
        return $this->state->getMode() === State::MODE_DEVELOPER ||
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_ENABLED_IN_PRODUCTION,
                ScopeInterface::SCOPE_STORE,
                $store
            );
    }
}
