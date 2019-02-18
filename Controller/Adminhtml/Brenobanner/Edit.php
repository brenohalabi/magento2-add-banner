<?php

namespace Breno\Banner\Controller\Adminhtml\Brenobanner;

use Breno\Banner\Api\Data\BannerInterfaceFactory;
use Magento\Backend\Model\Session;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Breno\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

class Edit extends \Breno\Banner\Controller\Adminhtml\Banner
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry = null;

    /**
     * Banner interface
     *
     * @var BannerInterfaceFactory
     */
    protected $bannerFactory;

    /**
     * Backend session
     *
     * @var Session
     */
    protected $session;

    /**
     * Banner repository interface
     *
     * @var BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * Logger interface
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param Session $session
     * @param BannerInterfaceFactory $bannerFactory
     * @param BannerRepositoryInterface $bannerRepository
     */
    public function __construct(
        Context $context,
                                Registry $coreRegistry,
                                Session $session,
                                BannerInterfaceFactory $bannerFactory,
                                BannerRepositoryInterface $bannerRepository,
                                LoggerInterface $logger
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->session = $session;
        $this->bannerFactory = $bannerFactory;
        $this->bannerRepository = $bannerRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        try {
            if ($id) {
                $bannerModel = $this->bannerRepository->getById($id);
            } else {
                $bannerModel = $this->bannerFactory->create();
            }

            $data = $this->session->getFormData(true);
            if (!empty($data)) {
                $bannerModel->setData($data);
            }

            $this->coreRegistry->register('breno_banner', $bannerModel);
        } catch (NoSuchEntityException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addError(__($e->getMessage()));
            $this->_redirect('*/*/*');
            return;
        }

        $this->_initAction()->_addBreadcrumb(__('Edit Banner'), __('Edit banner'));

        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Banners'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Edit Banner'));

        $this->_view->renderLayout();
    }
}
