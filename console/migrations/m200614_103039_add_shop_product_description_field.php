<?php

use yii\db\Migration;

/**
 * Class m200614_103039_add_shop_product_description_field
 */
class m200614_103039_add_shop_product_description_field extends Migration
{
    public function up(): void
    {
        $this->addColumn('{{%shop_products}}', 'description', $this->text()->after('name'));
    }

    public function down(): void
    {
        $this->dropColumn('{{%shop_products}}', 'description');
    }
}
