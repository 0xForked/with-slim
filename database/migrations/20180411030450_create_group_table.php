<?php


use Phinx\Migration\AbstractMigration;

class CreateGroupTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $group = $this->table('groups');
        $group->addColumn('name', 'string', ['limit' => 20])
              ->addColumn('description', 'string', ['limit' => 75])
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }

}
