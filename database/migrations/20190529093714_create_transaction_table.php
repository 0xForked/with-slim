<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateTransactionTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $transactions = $this->table('transactions');
        $transactions->addColumn('title', 'string')
            ->addColumn('date', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
            ->addColumn('building_id', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => false])
            ->addColumn('payable', 'integer', ['limit' => 50, 'null' => false])
            ->addColumn('mulct', 'integer', ['limit' => 50, 'null' => false]) //denda
            ->addColumn('total', 'integer', ['limit' => 50, 'null' => false]) // bayar + denda
            ->addColumn('payment_type', 'enum', ['values' => ['NONE', 'CASH', 'CARD']])
            ->addColumn('payment_status', 'enum', ['values' => ['NONE', 'FULL_PAY', 'HALF_PAY']])
            ->addColumn('payment_time', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
            ->addColumn('collector_id', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => false])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
