<?php

class Somecomp_Articles_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $pageNumber = (int) $this->getRequest()->getParam('pagenum');

        if (!$pageNumber) {
            $pageNumber = 1;
        }

        Mage::getSingleton('core/session')->setPageNumber($pageNumber);

        $direction = strtoupper($this->getRequest()->getParam('direction'));
        if (in_array($direction, ['ASC', 'DESC'])) {
            Mage::getSingleton('core/session')->setDirection($direction);
        }

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->addCss('css/somecomp_articles/articlestable.css');
        $this->renderLayout();
    }


    public function viewAction()
    {
        $articlesId = Mage::app()->getRequest()->getParam('id', 0);
        $articles = Mage::getModel('somecomparticles/articles')->load($articlesId);

        if ($articles->getId() > 0) {
            $this->loadLayout();
            $this->getLayout()->getBlock('articles.content')->assign(array(
                "articlesItem" => $articles,
            ));
            $this->renderLayout();
        } else {
            $this->_forward('noRoute');
        }
    }
}