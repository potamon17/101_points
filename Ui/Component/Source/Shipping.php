<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Ui\Component\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Option\ArrayInterface;
use Magento\Shipping\Model\Config;

class Shipping implements ArrayInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @var Config
     */
    protected Config $shipconfig;

    /**
     * Shipping constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param Config $shipconfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Config $shipconfig
    ) {
        $this->shipconfig = $shipconfig;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $activeCarriers = $this->shipconfig->getActiveCarriers();

        foreach ($activeCarriers as $carrierCode => $carrierModel) {
            $options = [];

            if ($carrierMethods = $carrierModel->getAllowedMethods()) {
                foreach ($carrierMethods as $methodCode => $method) {
                    $code = $carrierCode . '_' . $methodCode;
                    $options[] = ['value' => $code, 'label' => $method];
                }
                $carrierTitle = $this->scopeConfig
                    ->getValue('carriers/' . $carrierCode . '/title');
            }

            $methods[] = ['value' => $options, 'label' => $carrierTitle];
        }

        return $methods;
    }
}
