<?php

$installer = $this;
$tableNews = $installer->getTable('somecomparticles/table_articles');

$installer->startSetup();
$installer->getConnection()
    ->addColumn($tableNews, 'link', array(
        'comment'   => 'News URL link',
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => '255',
        'nullable'  => true,
    ));

$installer->getConnection()
    ->addKey($tableNews, 'IDX_UNIQUE_ARTICLE_LINK', 'link', Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE);


foreach (Mage::getModel('somecomparticles/articles')->getCollection() as $article) {
    try {
        $article->load($article->getId())->setDataChanges(true)->save();
    } catch (Exception $e) {
        $article->setId($article->getId())->setLink($article->getId())->save();
    }
}

$installer->endSetup();
