<?php


use Phinx\Migration\AbstractMigration;

class CreateUserTokenTable extends AbstractMigration
{
      /**
     * Migrate Up.
     */
    public function up()
    {
        $group = $this->table('users_token');
        $group->addColumn('uuid', 'string')
              ->addColumn('unique_token', 'string')
              ->addColumn('token_created', 'string', ['limit' => 20])
              ->addColumn('token_expired', 'string', ['limit' => 20])
              ->addIndex(['unique_token'], ['unique' => true])
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
