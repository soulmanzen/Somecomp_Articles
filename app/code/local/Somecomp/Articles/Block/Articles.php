<?php

class Somecomp_Articles_Block_Articles extends Mage_Core_Block_Template
{

    public function getByPage()
    {
        $pageNumber = $this->getPageNumber();
        $direction = $this->getDirection();
        $pageSize = 5;

        $collection = Mage::getModel('somecomparticles/articles')->getCollection();
        if ($direction) {
            $collection->getSelect()->order("created $direction");
        }
        $collection->getSelect()->limit($pageSize, $pageSize * ($pageNumber - 1));

        return $collection;
    }

    public function getPagination()
    {
        $links = [];
        $collection = Mage::getModel('somecomparticles/articles')->getCollection();

        $articlesCount = $collection->count();

        if ($articlesCount > 5) {
            $pages = ceil($articlesCount / 5);
            for ($i = 1; $i <= $pages; $i++) {
                $links[] = [
                    'pagenum' => $i,
                    'href' => "{$this->getPageUrl("pagenum/$i")}",
                ];
            }
        }

        return $links;
    }

    public function getPageNumber()
    {
        return Mage::getSingleton('core/session')->getPageNumber();
    }

    public function getDirection()
    {
        return Mage::getSingleton('core/session')->getDirection();
    }

    public function prepareUrl($url)
    {
        $helper = Mage::helper('somecomparticles');

        return $helper->prepareUrl($url);
    }

    public function getPageUrl($param)
    {
        if ($this->getDirection()) {
            return Mage::getUrl("articles/index/index/direction/{$this->getDirection()}/$param/");
        }

        return Mage::getUrl("articles/index/index/$param");
    }

    public function getDirectionUrl($param)
    {
        return Mage::getUrl("articles/index/index/$param/pagenum/{$this->getPageNumber()}/");
    }

}