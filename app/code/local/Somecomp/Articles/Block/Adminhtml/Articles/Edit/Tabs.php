<?php

class Somecomp_Articles_Block_Adminhtml_Articles_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        $helper = Mage::helper('somecomparticles');

        parent::__construct();
        $this->setId('article_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($helper->__('Article Information'));
    }

    protected function _prepareLayout()
    {
        $helper = Mage::helper('somecomparticles');

        $this->addTab('general_section', array(
            'label' => $helper->__('General Information'),
            'title' => $helper->__('General Information'),
            'content' => $this->getLayout()->createBlock('somecomparticles/adminhtml_articles_edit_tabs_general')->toHtml(),
        ));
        return parent::_prepareLayout();
    }

}