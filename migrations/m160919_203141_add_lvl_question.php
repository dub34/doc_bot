<?php

use yii\db\Migration;

class m160919_203141_add_lvl_question extends Migration
{
    public function up()
    {
//        $this->alterColumn('{{%question}}', 'id', $this->primaryKey());
        $this->addColumn('{{%question}}', 'lvl', $this->integer());
        $this->addColumn('{{%question}}', 'root', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%question}}', 'lvl');
        $this->dropColumn('{{%question}}', 'root');
    }
}
