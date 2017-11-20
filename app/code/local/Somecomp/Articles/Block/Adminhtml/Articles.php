<?php

class Somecomp_Articles_Block_Adminhtml_Articles extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('somecomparticles');
        $this->_blockGroup = 'somecomparticles';
        $this->_controller = 'adminhtml_articles';

        $this->_headerText = $helper->__('Articles Management');
        $this->_addButtonLabel = $helper->__('Add Article');
    }
}