<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Medicamento;

/**
 * MedicamentoSearch represents the model behind the search form of `app\models\Medicamento`.
 */
class MedicamentoSearch extends Medicamento
{
    public $nombreProveedor;
    public $nombreTipo;
    public $cantidadPedidos;
    public $total;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'tipo_id', 'activo'], 'integer'],
            [[
                'codigo',
                'nombre',
                'indicacion',
                'contraindicacion',
                'observacion',
                'fecha_registro',
                'nombreProveedor',
                'nombreTipo' ,
                'cantidadPedidos',
                'total',
                ], 'safe'],
            [['stock'], 'number'],
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
        $query = Medicamento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        $query->joinWith(['proveedor', 'tipo'])
            ->innerJoin('profile', 'user.id = profile.user_id');

        $query->orderBy([
            'medicamento.nombre'=>SORT_ASC,
        ]);

        $dataProvider->sort->attributes['nombreProveedor'] = [
            'asc'=>['profile.name' => SORT_ASC],
            'desc'=>['profile.name'=> SORT_DESC] ,
        ];

        $dataProvider->sort->attributes['nombreTipo'] = [
            'asc'=>['tipo_medicamento.nombre' => SORT_ASC],
            'desc'=>['tipo_medicamento.nombre'=> SORT_DESC] ,
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'medicamento.id' => $this->id,
            'stock' => $this->stock,
            'proveedor_id' => $this->proveedor_id,
            'tipo_id' => $this->tipo_id,
            'fecha_registro' => $this->fecha_registro,
            'medicamento.activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'medicamento.nombre', $this->nombre])
            ->andFilterWhere(['like', 'tipo_medicamento.nombre', $this->nombreTipo])
            ->andFilterWhere(['like', 'profile.name', $this->nombreProveedor])
            ->andFilterWhere(['like', 'indicacion', $this->indicacion])
            ->andFilterWhere(['like', 'contraindicacion', $this->contraindicacion])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }

    public function searchEstadistica($params)
    {
        $subQuery = Medicamento::find()
            ->select([
                'medicamento.id as medicamento_id',
                'count(pedido.id) as cantidadPedidos',
                'sum(pedido_detalle.cantidad) as total'
            ])
            ->leftJoin('pedido_detalle', 'pedido_detalle.medicamento_id=medicamento.id')
            ->leftJoin('pedido', 'pedido.id=pedido_detalle.pedido_id')
            ->groupBy(['medicamento.id']);

        $query = Medicamento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        $query->joinWith(['proveedor', 'tipo', 'pedidoDetalles'])
            ->innerJoin('profile', 'user.id = profile.user_id')
            ->leftJoin('pedido', 'pedido.id=pedido_detalle.pedido_id')
            ->leftJoin(['totales'=>$subQuery], 'totales.medicamento_id=medicamento.id');

        $query->orderBy([
            'medicamento.nombre'=>SORT_ASC,
        ]);

        $dataProvider->sort->attributes['nombreProveedor'] = [
            'asc'=>['profile.name' => SORT_ASC],
            'desc'=>['profile.name'=> SORT_DESC] ,
        ];

        $dataProvider->sort->attributes['nombreTipo'] = [
            'asc'=>['tipo_medicamento.nombre' => SORT_ASC],
            'desc'=>['tipo_medicamento.nombre'=> SORT_DESC] ,
        ];

        $dataProvider->sort->attributes['cantidadPedidos'] = [
            'asc'=>['cantidadPedidos' => SORT_ASC],
            'desc'=>['cantidadPedidos'=> SORT_DESC] ,
        ];

        $dataProvider->sort->attributes['total'] = [
            'asc'=>['total' => SORT_ASC],
            'desc'=>['total'=> SORT_DESC] ,
        ];

        $this->load($params, 'MedicamentoSearch');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'medicamento.id' => $this->id,
            'stock' => $this->stock,
            'proveedor_id' => $this->proveedor_id,
            'tipo_id' => $this->tipo_id,
            'fecha_registro' => $this->fecha_registro,
            'medicamento.activo' => $this->activo,
            'cantidadPedidos' => $this->cantidadPedidos,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'medicamento.nombre', $this->nombre])
            ->andFilterWhere(['like', 'tipo_medicamento.nombre', $this->nombreTipo])
            ->andFilterWhere(['like', 'profile.name', $this->nombreProveedor])
            ->andFilterWhere(['like', 'indicacion', $this->indicacion])
            ->andFilterWhere(['like', 'contraindicacion', $this->contraindicacion])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }

}
