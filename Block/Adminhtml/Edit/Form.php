<?php

namespace Breno\Banner\Block\Adminhtml\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var Config
     */
    protected $wysiwygConfig;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('brenobanner__form');
        $this->setTitle(__('Banner Information'));
    }

    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('breno_banner');

        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $fieldset = $form->addFieldset('add_banner_form', ['legend' => __('Banner Information')]);

        if ($model->getBannerId()) {
            $fieldset->addField('banner_id', 'hidden', ['name' => 'banner_id', 'value' => $model->getBannerId()]);
        }
        
        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'style' => 'height:10em',
                'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->wysiwygConfig->getConfig(),
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
