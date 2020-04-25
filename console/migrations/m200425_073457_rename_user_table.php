<?php

use yii\db\Migration;

/**
 * Class m200425_073457_rename_user_table
 */
class m200425_073457_rename_user_table extends Migration
{
    /**
     * @return bool|void|null
     */
    public function up()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }

    /**
     * @return bool|void|null
     */
    public function down()
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}
