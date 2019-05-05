<?php

use yii\db\Migration;

/**
 * Class m190503_183224_alter_table_pedido_detalle
 */
class m190503_183224_alter_table_pedido_detalle extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('pedido_detalle', 'fecha_registro');
        $this->dropColumn('pedido_detalle', 'fecha_entrega');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190503_183224_alter_table_pedido_detalle cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190503_183224_alter_table_pedido_detalle cannot be reverted.\n";

        return false;
    }
    */
}
