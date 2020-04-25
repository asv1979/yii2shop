<?php

use yii\db\Migration;

/**
 * Class m200425_090613_change_users_field_requirements
 */
class m200425_090613_change_users_field_requirements extends Migration
{
    /**
     * @return bool|void|null
     */
    public function up()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string());
        $this->alterColumn('{{%users}}', 'email', $this->string());
    }

    /**
     * @return bool|void|null
     */
    public function down()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'email', $this->string()->notNull());
    }
}
