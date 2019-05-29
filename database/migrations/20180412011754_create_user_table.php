<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateUserTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $user = $this->table('users');
        $user->addColumn('phone', 'string', ['limit' => 50])
              ->addColumn('email', 'string', ['limit' => 50])
              ->addColumn('password', 'string')
              ->addColumn('activation_code', 'string', ['limit' => 50, 'null' => true])
              ->addColumn('forgotten_password_code', 'string', ['limit' => 50, 'null' => true])
              ->addColumn('forgotten_password_time', 'integer', ['limit' => 10, 'null' => true])
              ->addColumn('status_acc', 'integer',  ['limit' => MysqlAdapter::INT_TINY])
              ->addColumn('last_login', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }

}
