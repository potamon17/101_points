<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Controller\Adminhtml\Item;

use Magento\Backend\App\Action;

abstract class Points extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Andriy_Points::Points';
}
