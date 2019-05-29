<?php


use Phinx\Migration\AbstractMigration;

class CreateRoleTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
   public function up()
   {
       $role = $this->table('roles');
       $role->addColumn('title', 'string')
             ->save();
   }

   /**
    * Migrate Down.
    */
   public function down()
   {

   }
}
