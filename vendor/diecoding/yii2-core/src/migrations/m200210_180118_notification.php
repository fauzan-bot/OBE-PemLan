<?php

use yii\db\Migration;

/**
 * Class m200210_180118_notification
 */
class m200210_180118_notification extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notification}}', [
            'id'      => $this->bigPrimaryKey(),
            'type'    => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'subject' => $this->string()->notNull(),
            'body'    => $this->text(),
            'trigger' => $this->text(),
            'read_at' => $this->dateTime(),
            'data'    => $this->binary(),

            'status'     => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%notification}}');
    }
}
