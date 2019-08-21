<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;

/**
 * PedidoSearch represents the model behind the search form of `app\models\Pedido`.
 */
class PedidoSearch extends Pedido
{
    public $usuario;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'estado', 'usuario_id'], 'integer'],
            [['observacion', 'fecha_registro', 'fecha_entrega', 'usuario'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $user = Yii::$app->user;

        $identity = $user->identity;

        $query = Pedido::find();

        // add conditions that should always apply here

        $query->joinWith(['usuario', 'pedidoDetalles']);


        if(!$identity->getIsAdmin())
        {
            $query->innerJoin('medicamento', 'medicamento.id=pedido_detalle.medicamento_id');
            $query->where(['pedido.usuario_id'=>$user->id])
                ->orWhere(['medicamento.proveedor_id'=>$user->id]);
        }

        $query->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);



        $dataProvider->sort->attributes['usuario'] = [
            'asc'=>['user.name' => SORT_ASC],
            'desc'=>['user.name'=> SORT_DESC] ,
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pedido.id' => $this->id,
            'estado' => $this->estado,
            'usuario_id' => $this->usuario_id,
            'fecha_registro' => $this->fecha_registro,
            'fecha_entrega' => $this->fecha_entrega,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion]);
        $query->andFilterWhere(['like', 'user.username', $this->usuario]);

        return $dataProvider;
    }
}
