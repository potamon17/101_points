<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Store\Model\Store;

class AddCmsPage implements DataPatchInterface, PatchRevertableInterface
{
    const CMS_PAGE_IDENTIFIER = 'pick-up-points';

    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var PageFactory
     */
    private PageFactory $pageFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $this->pageFactory->create()
            ->setTitle('Pick-up points')
            ->setIdentifier(self::CMS_PAGE_IDENTIFIER)
            ->setIsActive(true)
            ->setPageLayout('1column')
            ->setContent('{{widget type="Magento\Cms\Block\Widget\Block" template="widget/static_block/default.phtml" block_id="points-list" type_name="CMS Static Block"}}')
            ->setStores([Store::DEFAULT_STORE_ID])
            ->save();

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function revert()
    {
        $sampleCmsPage = $this->pageFactory
            ->create()
            ->load(self::CMS_PAGE_IDENTIFIER, 'identifier');

        if ($sampleCmsPage->getId()) {
            $sampleCmsPage->delete();
        }
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
