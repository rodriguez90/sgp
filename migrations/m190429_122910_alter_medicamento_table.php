<?php

use yii\db\Migration;

/**
 * Class m190429_122910_alter_medicamento_table
 */
class m190429_122910_alter_medicamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('tipo_medicamento', 'activo', $this->boolean()->defaultValue(true)->comment('Activo'));
        $this->addColumn('medicamento', 'activo', $this->boolean()->defaultValue(true)->comment('Activo'));
        $this->addColumn('medicamento', 'imagen', $this->text()->comment('Imagen'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tipo_medicamento', 'activo');
        $this->dropColumn('medicamento', 'activo');
        $this->addColumn('medicamento', 'imagen');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190429_122910_alter_medicamento_table cannot be reverted.\n";

        return false;
    }
    */
}
