<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Block\Widget;

use Andriy\Points\Model\ResourceModel\Points\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Shipping\Model\CarrierFactory;
use Magento\Shipping\Model\Config;
use Magento\Widget\Block\BlockInterface;

class PointsList extends Template implements BlockInterface, IdentityInterface
{
    /**
     * Config path
     */
    const API = 'point/general/google_api_key';
    /**
     * Cache tag
     */
    const CACHE_TAG = 'andriy_points_lost';

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var CarrierFactory
     */
    protected CarrierFactory $carrierFactory;

    /**
     * PointsList constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param CarrierFactory $carrierFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        CarrierFactory $carrierFactory,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->carrierFactory = $carrierFactory;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @return string[]
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG];
    }

    /**
     * @return array
     */
    public function getPointsCollection(): array
    {
        $points = $this->collectionFactory->create();

        return $points->getItems();
    }

    /**
     * @param $codeBlock
     * @return mixed
     */
    public function getShipping($codeBlock): mixed
    {
        $code = explode("_", $codeBlock);

        return $this->carrierFactory->create($code[1])->getConfigData('title');
    }

    /**
     * @return mixed
     */
    public function getApi(): mixed
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        return $this->_scopeConfig->getValue(self::API, $storeScope);
    }
}
