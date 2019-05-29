<?php


use Phinx\Migration\AbstractMigration;

class CreateMerchantTypeTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $merchant_types = $this->table('merchant_types');
        $merchant_types->addColumn('title', 'string')
            ->addColumn('description', 'text')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
