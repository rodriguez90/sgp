<?php

use yii\db\Migration;

/**
 * Class m190503_143739_alter_table_pedido
 */
class m190503_143739_alter_table_pedido extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('pedido', 'codigo');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190503_143739_alter_table_pedido cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190503_143739_alter_table_pedido cannot be reverted.\n";

        return false;
    }
    */
}
