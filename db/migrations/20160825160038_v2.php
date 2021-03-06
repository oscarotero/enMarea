<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class V2 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('news')
            ->addColumn('title', 'string')
            ->addColumn('slug', 'string')
            ->addColumn('imageFile', 'string')
            ->addColumn('intro', 'string')
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('body', 'text', ['limit' => MysqlAdapter::TEXT_REGULAR])
            ->addColumn('isActive', 'boolean')
            ->addIndex(['slug'], ['unique' => true])
            ->create();
    }
}
