<?php

use yii\db\Migration;

class m160919_181858_add_node_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%node}}', [
            'id' => $this->primaryKey(),
            'root' => $this->integer(),
            'lft' => $this->integer(),
            'rgt' => $this->integer(),
            'lvl' => $this->integer(),
            'name' => $this->string(),
            'tag' => $this->string(),
            'icon' => $this->string(),
            'icon_type' => $this->boolean()->defaultValue(true),
            'active' => $this->boolean()->defaultValue(true),
            'selected' => $this->boolean()->defaultValue(false),
            'disabled' => $this->boolean()->defaultValue(false),
            'readonly' => $this->boolean()->defaultValue(false),
            'visible' => $this->boolean()->defaultValue(true),
            'collapsed' => $this->boolean()->defaultValue(false),
            'movable_u' => $this->boolean()->defaultValue(true),
            'movable_d' => $this->boolean()->defaultValue(true),
            'movable_l' => $this->boolean()->defaultValue(true),
            'movable_r' => $this->boolean()->defaultValue(true),
            'removable' => $this->boolean()->defaultValue(true),
            'removable_all' => $this->boolean()->defaultValue(false),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%node}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
