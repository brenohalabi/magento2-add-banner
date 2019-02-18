<?php

namespace Breno\Banner\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Breno\Banner\Model\Banner', 'Breno\Banner\Model\ResourceModel\Banner');
    }
}
