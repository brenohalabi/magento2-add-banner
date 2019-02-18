<?php

namespace Breno\Banner\Controller\Adminhtml\Brenobanner;

use Breno\Banner\Api\Data\BannerInterfaceFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;
use Breno\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

class Save extends \Breno\Banner\Controller\Adminhtml\Banner
{
    /**
     * Backend session
     *
     * @var Session
     */
    protected $session;

    /**
     * Banner Interface
     *
     * @var BannerInterfaceFactory
     */
    protected $bannerFactory;

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
     * @param Session
     * @param BannerInterfaceFactory BannerFactory
     * @param BannerRepositoryInterface BannerRepository
     * @param LoggerInterface logger
     */
    public function __construct(
        Context $context,
        Session $session,
        BannerInterfaceFactory $bannerFactory,
        BannerRepositoryInterface $bannerRepository,
        LoggerInterface $logger

    ) {
        $this->bannerFactory = $bannerFactory;
        $this->session = $session;
        $this->bannerRepository = $bannerRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        
        try {
            $id = isset($data['banner_id']) ? $data['banner_id'] : 0;

            $bannerModel = $this->bannerRepository->getById($id);
            $bannerModel->setContent($data['content']);

            $this->bannerRepository->save($bannerModel);

            $this->messageManager->addSuccess(__('You saved the item.'));

            $this->session->setFormData(false);
        } catch (NoSuchEntityException $e) {
            $bannerModel = $this->bannerFactory->create()->setcontent($data['content']);
            $this->bannerRepository->save($bannerModel);

            $this->logger->error($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            
            $this->messageManager->addError($e->getMessage());

            $this->session->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        
        return $resultRedirect->setPath('*/*/edit', ['id' => $bannerModel->getId()]);
    }
}
