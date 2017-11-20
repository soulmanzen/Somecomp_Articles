<?php

class Somecomp_Articles_Block_Adminhtml_Articles_Edit_Tabs_General extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {

        $helper = Mage::helper('somecomparticles');
        $model = Mage::registry('current_article');


        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('general_form', array(
            'legend' => $helper->__('General Information')
        ));

        $fieldset->addField('title', 'text', array(
            'label' => $helper->__('Title'),
            'required' => true,
            'name' => 'title',
        ));

        $fieldset->addField('description', 'editor', array(
            'label' => $helper->__('Description'),
            'required' => true,
            'name' => 'description',
        ));

        $fieldset->addField('content', 'editor', array(
            'label' => $helper->__('Content'),
            'required' => true,
            'name' => 'content',
        ));

        $fieldset->addField('created', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => $helper->__('Created'),
            'name' => 'created'
        ));

        $fieldset->addField('image', 'image', array(
            'label' => $helper->__('Image'),
            'name' => 'image',
        ));

        $fieldset->addField('link', 'text', array(
            'label' => $helper->__('Link'),
            'name' => 'link',
        ));

        $formData = array_merge($model->getData(), array('image' => $model->getImageUrl()));

        $form->setValues($formData);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}