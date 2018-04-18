<?php


use Phinx\Migration\AbstractMigration;

class CreateUserDetailTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $user = $this->table('users_details');
        $user->addColumn('uuid', 'string')
              ->addColumn('ugid', 'integer')
              ->addColumn('full_name', 'string', ['limit' => 50])
              ->addColumn('avatar', 'string', ['limit' => 50, 'null' => true])
              ->addIndex(['uuid'], ['unique' => true])
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
