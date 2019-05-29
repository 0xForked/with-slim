<?php


use Phinx\Migration\AbstractMigration;

class CreateMerchantOwnerTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $merchant_owners = $this->table('merchant_owners');
        $merchant_owners->addColumn('name', 'string')
            ->addColumn('identity_type', 'enum', ['values' => ['KTP', 'SIM']])
            ->addColumn('identity_number', 'integer', ['limit' => 50, 'null' => false])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
