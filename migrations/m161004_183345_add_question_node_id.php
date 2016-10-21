<?php

use yii\db\Migration;

class m161004_183345_add_question_node_id extends Migration
{
    public function up()
    {
        $this->addColumn('{{%question}}', 'node_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%question}}', 'node_id');
    }
}
