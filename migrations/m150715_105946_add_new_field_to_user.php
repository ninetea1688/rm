<?php

use yii\db\Schema;
use yii\db\Migration;

class m150715_105946_add_new_field_to_user extends Migration
{
   public function up()
    {
        $this->addColumn('{{%user}}', 'level', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'level');
    }
}
