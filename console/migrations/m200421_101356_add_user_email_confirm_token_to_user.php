<?php

use yii\db\Migration;

/**
 * Class m200421_101356_add_user_email_confirm_token_to_user
 */
class m200421_101356_add_user_email_confirm_token_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'email_confirm_token', $this->string()->unique()->after('email'));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'email_confirm_token');
    }

}
