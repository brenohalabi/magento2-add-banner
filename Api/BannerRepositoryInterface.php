<?php
 
namespace Breno\Banner\Api;

use Breno\Banner\Api\Data\BannerInterface;

interface BannerRepositoryInterface
{
    /**
     * @param int $id
     * @return \Breno\Banner\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
 
    /**
     * @param \Breno\Banner\Api\Data\BannerInterface $banner
     * @return \Breno\Banner\Api\Data\BannerInterface
     */
    public function save(BannerInterface $hamburger);
}
