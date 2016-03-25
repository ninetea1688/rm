<?php

use yii\db\Schema;
use yii\db\Migration;

class m150630_050927_create_user_table extends Migration {

    public function up() {
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING.' NOT NULL',
            'auth_key' => Schema::TYPE_STRING,
            'password_hash' => Schema::TYPE_STRING.' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING .' NOT NULL',
            'role' => Schema::TYPE_SMALLINT,
            'status' => Schema::TYPE_SMALLINT,
            'created_at' => Schema::TYPE_TIMESTAMP,
            'updated_at' => Schema::TYPE_TIMESTAMP,
        ]);
        $this->createIndex('username', 'user', 'username', true);
        $this->createIndex('email', 'user', 'email', true);

        $this->createTable('profile', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER. ' NOT NULL',
            'fullname' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP,
        ]);
        $security = yii::$app->security;
        $this->batchInsert('user', ['username', 'auth_key', 'password_hash', 'email', 'role', 'status', 'created_at'], [
        ['admin', $security->generateRandomString(),$security->generatePasswordHash('admin'), 'admin@hotmail.com', 10, 1, date("Y-m-d")],
        ['demo', $security->generateRandomString(), $security->generatePasswordHash('demo'), 'demo@hotmail.com', 1, 1, date("Y-m-d")]
        ]);
        $this->batchInsert('profile', ['user_id', 'fullname', 'created_at'], [
            [1, 'Administrator', date("Y-m-d H:i:s")],
            [2, 'Demo', date("Y-m-d H:i:s")]
        ]);
    }

    public function down() {
        $this->dropTable('user');
        $this->dropTable('profile');
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
