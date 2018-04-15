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
        $user->addColumn('uuid', 'string', ['unique' => true])
              ->addColumn('ugid', 'string', ['unique' => true])
              ->addColumn('full_name', 'string', ['limit' => 50])
              ->addColumn('avatar', 'string', ['limit' => 50, 'null' => true])
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
