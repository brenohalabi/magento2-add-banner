<?php
 
namespace Breno\Banner\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Breno\Banner\Api\Data\BannerInterface;
use Breno\Banner\Api\BannerRepositoryInterface;
use Breno\Banner\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
use Breno\Banner\Model\ResourceModel\Banner\Collection;

class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var BannerFactory
     */
    private $bannerFactory;
 
    /**
     * @var BannerCollectionFactory
     */
    private $bannerCollectionFactory;
 
    public function __construct(
        BannerFactory $bannerFactory,
        BannerCollectionFactory $bannerCollectionFactory
    ) {
        $this->bannerFactory = $bannerFactory;
        $this->bannerCollectionFactory = $bannerCollectionFactory;
    }

    public function getById($id)
    {
        $banner = $this->bannerFactory->create();
        $banner->getResource()->load($banner, $id);
        if (! $banner->getBannerId()) {
            throw new NoSuchEntityException(__('Unable to find banner with ID "%1"', $id));
        }
        return $banner;
    }
     
    public function save(BannerInterface $banner)
    {
        $banner->getResource()->save($banner);
        return $banner;
    }
}
