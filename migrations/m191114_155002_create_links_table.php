<?php

use yii\db\Migration;
use yii\db\Schema;

class m191114_155002_create_links_table extends Migration
{
    public function up()
    {
        $this->createTable('links', [
            'id' => Schema::TYPE_PK,
            'url' => Schema::TYPE_STRING,
            'alias' => Schema::TYPE_STRING,
            'create_date' => Schema::TYPE_DATETIME
        ]);

        $this->createIndex(
            'links-url-index',
            'links',
            'url'
        );
    }

    public function down()
    {
        $this->dropIndex(
            'links-url-index',
            'links'
        );

        $this->dropTable('links');
    }
}
