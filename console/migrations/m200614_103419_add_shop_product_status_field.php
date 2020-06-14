<?php

use yii\db\Migration;

/**
 * Class m200614_103419_add_shop_product_status_field
 */
class m200614_103419_add_shop_product_status_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200614_103419_add_shop_product_status_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200614_103419_add_shop_product_status_field cannot be reverted.\n";

        return false;
    }
    */
}
