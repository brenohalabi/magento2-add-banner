<?php
 
namespace Breno\Banner\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface BannerInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getBannerId();
 
    /**
     * @param int $id
     * @return void
     */
    public function setBannerId($id);
 
    /**
     * @return string
     */
    public function getContent();
 
    /**
     * @param string $content
     * @return void
     */
    public function setContent($content);
}
