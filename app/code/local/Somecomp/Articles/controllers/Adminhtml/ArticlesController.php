<?php

class Somecomp_Articles_Adminhtml_ArticlesController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('catalog');

        $contentBlock = $this->getLayout()->createBlock('somecomparticles/adminhtml_articles');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $model = Mage::getModel('somecomparticles/articles');

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $model->setData($data)->setId($id);
        } else {
            $model->load($id);
        }
        Mage::register('current_article', $model);

        $this->loadLayout()->_setActiveMenu('catalog');
        $this->_addLeft($this->getLayout()->createBlock('somecomparticles/adminhtml_articles_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('somecomparticles/adminhtml_articles_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('somecomparticles');
                $model = Mage::getModel('somecomparticles/articles');

                $model->setData($data)->setId($id);
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();
                $id = $model->getId();

                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(), $id . '.jpg'); // Upload the image
                } else {
                    if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {
                        @unlink($helper->getImagePath($id));
                    }
                }

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Article was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $id
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('somecomparticles/articles')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Article was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $articles = $this->getRequest()->getParam('articles', null);

        if (is_array($articles) && sizeof($articles) > 0) {
            try {
                foreach ($articles as $id) {
                    Mage::getModel('somecomparticles/articles')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d articles have been deleted', sizeof($articles)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select article'));
        }
        $this->_redirect('*/*');
    }


}