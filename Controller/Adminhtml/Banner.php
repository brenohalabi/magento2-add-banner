<?php

namespace Breno\Banner\Controller\Adminhtml;

abstract class Banner extends \Magento\Backend\App\Action
{
    /**
     * Init actions
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Breno_Banner::manage'
        )->_addBreadcrumb(
            __('Banner'),
            __('Banner')
        );
        return $this;
    }
}
