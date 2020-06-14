<?php

use yii\db\Migration;

/**
 * Class m200425_073457_rename_user_table
 */
class m200425_073457_rename_user_table extends Migration
{
    public function up(): void
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }

    public function down(): void
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}
