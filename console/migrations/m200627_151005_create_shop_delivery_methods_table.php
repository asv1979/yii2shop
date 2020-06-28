<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_delivery_methods}}`.
 */
class m200627_151005_create_shop_delivery_methods_table extends Migration
{
    public function up(): void
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_delivery_methods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cost' => $this->integer()->notNull(),
            'min_weight' => $this->integer(),
            'max_weight' => $this->integer(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down(): void
    {
        $this->dropTable('{{%shop_delivery_methods}}');
    }
}
