<?php

class Somecomp_Articles_Model_Articles extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('somecomparticles/articles');
    }

    protected function _afterDelete()
    {
        $helper = Mage::helper('somecomparticles');
        @unlink($helper->getImagePath($this->getId()));
        return parent::_afterDelete();
    }

    protected function _beforeSave()
    {
        $helper = Mage::helper('somecomparticles');

        if (!$this->getData('link')) {
            $this->setData('link', $helper->prepareUrl($this->getTitle()));
        } else {
            $this->setData('link', $helper->prepareUrl($this->getData('link')));
        }
        return parent::_beforeSave();
    }


    public function getImageUrl()
    {
        $helper = Mage::helper('somecomparticles');
        if ($this->getId() && file_exists($helper->getImagePath($this->getId()))) {
            return $helper->getImageUrl($this->getId());
        }
        return null;
    }
}