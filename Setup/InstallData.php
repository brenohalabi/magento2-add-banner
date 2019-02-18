<?php

namespace Breno\Banner\Setup;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Breno\Banner\Api\Data\BannerInterfaceFactory;
use Breno\Banner\Api\BannerRepositoryInterface;

class InstallData implements InstallDataInterface
{
    /**
     *
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     *
     * @var BannerInterfaceFactory
     */
    private $bannerFactory;

    /**
     *
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;

    public function __construct(
        BlockFactory $blockFactory,
                                BannerInterfaceFactory $bannerFactory,
                                BannerRepositoryInterface $bannerRepository
    ) {
        $this->blockFactory = $blockFactory;
        $this->bannerFactory = $bannerFactory;
        $this->bannerRepository = $bannerRepository;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->defaultBannerData();
        $this->createBlockBanner();
    }

    protected function defaultBannerData()
    {
        $data = ['content' => '<div>Insert banner</div>'];
        $banner = $this->bannerFactory->create();
        $banner->setContent($data['content']);

        $this->bannerRepository->save($banner);
    }

    protected function createBlockBanner()
    {
        $data = [
            'title' => 'CMS Banner Block',
            'identifier' => 'cms_breno_banner',
            'content' => "{{widget type=\"Breno\Banner\Block\Widget\Banner\" banner_id=\"1\" template=\"banner.phtml\"}}",
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->blockFactory->create()->setData($data)->save();
    }
}
