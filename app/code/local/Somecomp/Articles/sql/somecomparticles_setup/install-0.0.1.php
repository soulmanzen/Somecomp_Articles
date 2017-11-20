<?php
$installer = $this;
$tableArticles = $installer->getTable('somecomparticles/table_articles');

$installer->startSetup();

$installer->getConnection()->dropTable($tableArticles);
$table = $installer->getConnection()
    ->newTable($tableArticles)
    ->addColumn('article_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Article ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
    ), 'Article Title')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ), 'Article Description')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ), 'Article Content')
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ))
    ->setComment('Somecomp_Article entity table');
$installer->getConnection()->createTable($table);

$installer->endSetup();
