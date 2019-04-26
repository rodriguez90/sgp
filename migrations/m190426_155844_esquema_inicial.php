<?php

use yii\db\Migration;

/**
 * Class m190426_155844_esquema_inicial
 */
class m190426_155844_esquema_inicial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Información de contacto
        $this->createTable('informacion_contacto', [
            'id' => $this->primaryKey()->comment('Perfil'),
            'telefono' => $this->string()->notNull()->comment('Telefono'),
            'direccion' => $this->string()->null()->comment('Dirección'),
            'fecha_creacion' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk_informacion_contacto_usuario',
            'informacion_contacto',
            'id',
            'profile',
            'user_id',
            'CASCADE',
            'CASCADE');

        // Medicamento
        $this->createTable('tipo_medicamento', [
            'id' => $this->primaryKey()->comment('No.'),
            'nombre' => $this->string()->comment('Nombre'),
            'descripcion' => $this->text()->comment('Descripcion'),
        ]);

        $this->createTable('medicamento', [
            'id' => $this->primaryKey()->comment('No.'),
            'codigo' => $this->string()->unique()->notNull()->comment('Código'),
            'nombre' => $this->string()->notNull()->comment('Nombre'),
            'indicacion' => $this->text()->notNull()->comment('Indicación'),
            'contraindicacion' => $this->text()->notNull()->comment('Contraindicación'),
            'observacion' => $this->text()->comment('Observación'),
            'stock' => $this->integer()->notNull()->comment('Stock'),
            'proveedor_id' => $this->integer()->notNull()->comment('Proveedor'),
            'tipo_id' => $this->integer()->notNull()->comment('Tipo'),
            'fecha_registro' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk_medicamento_tipo_medicamento',
            'medicamento',
            'tipo_id',
            'tipo_medicamento',
            'id',
            'CASCADE',
            'CASCADE');

        $this->addForeignKey(
            'fk_medicamento_proveedor',
            'medicamento',
            'proveedor_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE');

        // Pedido
        $this->createTable('pedido', [
            'id' => $this->primaryKey()->comment('No.'),
            'codigo' => $this->string()->unique()->notNull()->comment('Código'),
            'estado' => $this->smallInteger()->notNull()->comment('Estado'),
            'observacion' => $this->text()->comment('Observación'),
            'usuario_id' => $this->integer()->notNull()->comment('Usuario'),
            'fecha_registro' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'fecha_entrega' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_pedido_usuario',
            'pedido',
            'usuario_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE');

        // Pedido Detalle
        $this->createTable('pedido_detalle', [
            'id' => $this->primaryKey()->comment('No.'),
            'cantidad' => $this->integer()->notNull()->comment('Cantidad'),
            'pedido_id' => $this->integer()->notNull()->comment('Pedido'),
            'medicamento_id' => $this->integer()->notNull()->comment('Medicamento'),
            'fecha_registro' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'fecha_entrega' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_pedido_detalle_medicamento',
            'pedido_detalle',
            'medicamento_id',
            'medicamento',
            'id',
            'CASCADE',
            'CASCADE');

        $this->addForeignKey(
            'fk_pedido_detalle_pedido',
            'pedido_detalle',
            'pedido_id',
            'pedido',
            'id',
            'CASCADE',
            'CASCADE');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pedido_detalle');
        $this->dropTable('pedido');
        $this->dropTable('medicamento');
        $this->dropTable('tipo_medicamento');
        $this->dropTable('informacion_contacto');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190426_155844_esquema_inicial cannot be reverted.\n";

        return false;
    }
    */
}
