<?php


use Phinx\Migration\AbstractMigration;

class CreateAspMessageTable extends AbstractMigration
{

    public function up()
    {
        $asp_message = $this->table('asp_messages');
        $asp_message->addColumn('_sender_name', 'string', ['limit' => 75])
                    ->addColumn('_sender_email', 'string', ['limit' => 75])
                    ->addColumn('_message_title', 'string')
                    ->addColumn('_message_body', 'string')
                    ->addColumn('_message_status', 'integer')
                    ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
                    ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
                    ->save();
    }

    public function down()
    {

    }
}
