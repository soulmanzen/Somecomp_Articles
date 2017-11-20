<?php

class Somecomp_Articles_Model_Resource_Articles extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('somecomparticles/table_articles', 'article_id');
    }
}