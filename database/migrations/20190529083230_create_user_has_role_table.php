<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateUserHasRoleTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $user_has_role = $this->table('user_has_role');
        $user_has_role

                ->addColumn('user_id','integer', ['null' => true])
                ->addColumn('role_id','integer', ['null' => true])
                ->addForeignKey(
                    'user_id',
                    'users',
                    'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->addForeignKey(
                    'role_id',
                    'roles',
                    'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
