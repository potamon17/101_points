<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Controller\Adminhtml\Item;

use Andriy\Points\Api\PointsRepositoryInterface;
use Andriy\Points\Model\PointsFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Points
{
    /**
     * @return PointsFactory
     */
    protected PointsFactory $pointsFactory;

    /**
     * @return DataPersistorInterface
     */
    protected DataPersistorInterface $dataPersistor;

    /**
     * @var PointsRepositoryInterface
     */
    protected PointsRepositoryInterface $pointsRepositoryInterface;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param PointsFactory $pointsFactory
     * @param PointsRepositoryInterface $pointsRepositoryInterface
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        PointsFactory $pointsFactory,
        PointsRepositoryInterface $pointsRepositoryInterface
    ) {
        /** @noinspection PhpUndefinedFieldInspection */
        $this->pointsRepositoryInterface = $pointsRepositoryInterface;
        $this->dataPersistor = $dataPersistor;
        $this->pointsFactory = $pointsFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data = $this->getRequest()->getPostValue()) {

            /** @noinspection PhpUndefinedMethodInspection */
            $model = $this->pointsFactory->create();
            $model->setData($data);
            try {
                $this->messageManager->addSuccessMessage(__('You saved the Point'));
                $this->dataPersistor->clear('andriy_points_item');

                $this->pointsRepositoryInterface->save($model);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Point.'));
            }

            $this->dataPersistor->set('andriy_points_item', $data);

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
