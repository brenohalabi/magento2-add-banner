<?php

namespace Breno\Banner\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Construct
     *
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }
    
    protected function _construct()
    {
        $this->_init('banners', 'banner_id');
    }
}
