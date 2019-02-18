<?php

namespace Breno\Banner\Block\Widget;

use Magento\Framework\View\Element\Template;
use Breno\Banner\Api\Data\BannerInterfaceFactory;

class Banner extends Template implements \Magento\Widget\Block\BlockInterface
{
    /**
     * @var BannerInterfaceFactory
     */
    protected $bannerFactory;

    /**
     * @param Context $context
     * @param BannerInterfaceFactory $bannerFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        BannerInterfaceFactory $bannerFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->bannerFactory = $bannerFactory;
    }

    /**
     * @return BannerInterface
     */
    public function getModel()
    {
        return $this->bannerFactory->create();
    }
    
    /**
     * @return BannerInterface
     */
    public function getBannerById($id)
    {
        $banner = $this->getModel()->load($id);
        return $banner;
    }
}
