<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Controller\Adminhtml\Item;

use Andriy\Points\Api\PointsRepositoryInterface;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Points
{
    /**
     * Property for Api NewsRepositoryInterface
     *
     * @var PointsRepositoryInterface
     */
    protected PointsRepositoryInterface $pointsRepositoryInterface;

    /**
     * Delete construct
     *
     * @param Context $context
     * @param PointsRepositoryInterface $pointsRepositoryInterface
     */
    public function __construct(
        Action\Context $context,
        PointsRepositoryInterface $pointsRepositoryInterface
    ) {
        $this->pointsRepositoryInterface = $pointsRepositoryInterface;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id');

        if ($id) {
            try {
                $this->pointsRepositoryInterface->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the Point.'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a Point to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
