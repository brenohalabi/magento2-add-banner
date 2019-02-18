<?php

namespace Breno\Banner\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Breno\Banner\Api\Data\BannerInterface;

class Banner extends AbstractExtensibleModel implements BannerInterface
{
    const BANNER_ID = 'banner_id';
    const CONTENT = 'content';

    protected function _construct()
    {
        $this->_init('Breno\Banner\Model\ResourceModel\Banner');
    }

    /**
     * @return int
     */
    public function getBannerId()
    {
        return $this->_getData(self::BANNER_ID);
    }

    /**
     * @param int $id
     * @return void
     */
    public function setBannerId($id)
    {
        $this->setData(self::BANNER_ID, $id);
    }
    
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->_getData(self::CONTENT);
    }
    /**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->setData(self::CONTENT, $content);
    }
}
