<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateAspArticleTable extends AbstractMigration
{

    public function up()
    {
        $asp_article = $this->table('asp_articles');
        $asp_article->addColumn('_author_id', 'string', ['limit' => 75])
                    ->addColumn('_category_id', 'string', ['limit' => 75])
                    ->addColumn('_tag_id', 'string', ['limit' => 75])
                    ->addColumn('_slug', 'string', ['limit' => 75])
                    ->addColumn('_title', 'string', ['limit' => 75])
                    ->addColumn('_content', 'text', ['limit' => MysqlAdapter::TEXT_LONG])
                    ->addColumn('_image', 'string', ['limit' => 50])
                    ->addColumn('_published', 'integer', ['limit' => MysqlAdapter::INT_TINY])
                    ->addColumn('_headline', 'integer', ['limit' => MysqlAdapter::INT_TINY])
                    ->addColumn('_like_count', 'integer')
                    ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
                    ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
                    ->save();
    }

    public function down()
    {

    }

}
