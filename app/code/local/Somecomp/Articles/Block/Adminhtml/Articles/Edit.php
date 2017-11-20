<?php

class Somecomp_Articles_Block_Adminhtml_Articles_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'somecomparticles';
        $this->_controller = 'adminhtml_articles';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('somecomparticles');
        $model = Mage::registry('current_article');

        if ($model->getId()) {
            return $helper->__("Edit Articles item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add Articles item");
        }
    }

}