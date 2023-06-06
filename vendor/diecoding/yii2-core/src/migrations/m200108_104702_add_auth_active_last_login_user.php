<?php

use yii\db\Migration;

/**
 * Class m200108_104702_add_auth_active_last_login_user
 */
class m200108_104702_add_auth_active_last_login_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'auth_active', $this->string(64));
        $this->addColumn('{{%user}}', 'last_login', $this->integer());
        $this->addColumn('{{%user}}', 'last_online', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'auth_active');
        $this->dropColumn('{{%user}}', 'last_login');
        $this->dropColumn('{{%user}}', 'last_online');
    }
}
