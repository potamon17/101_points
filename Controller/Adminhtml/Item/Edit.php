<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Controller\Adminhtml\Item;

use Andriy\Points\Model\PointsRepository;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Points
{
    /**
     * @var
     */
    protected PageFactory $resultPageFactory;

    /**
     * @var PointsRepository
     */
    protected PointsRepository $pointsRepository;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param PointsRepository $pointsRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        PointsRepository $pointsRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->pointsRepository = $pointsRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $rowId = (int) $this->getRequest()->getParam('id');

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            try {
                $brand = $this->pointsRepository->get($rowId);
                $resultPage->getConfig()->getTitle()->prepend(__($brand->getName()));
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This point no longer exists.'));

                return $this->_redirect('*/*/index');
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New point'));
        }

        return $resultPage;
    }
}
