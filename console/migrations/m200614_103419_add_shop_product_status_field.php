<?php

use yii\db\Migration;

/**
 * Class m200614_103419_add_shop_product_status_field
 */
class m200614_103419_add_shop_product_status_field extends Migration
{
    public function up(): void
    {
        $this->addColumn('{{%shop_products}}', 'status', $this->smallInteger()->notNull());
        $this->update('{{%shop_products}}', ['status' => 1]);
    }

    public function down(): void
    {
        $this->dropColumn('{{%shop_products}}', 'status');
    }
}
