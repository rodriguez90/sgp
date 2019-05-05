<?php

namespace app\controllers;

use app\forms\PedidoForm;
use app\models\Medicamento;
use app\models\MedicamentoSearch;
use app\models\PedidoDetalle;
use Yii;
use app\models\Pedido;
use app\models\PedidoSearch;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\User\Filter\AccessRuleFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRuleFilter::class,
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['pedido/index'],
                    ],
                    [
                        'actions' => ['create', 'eliminar-detalle'],
                        'allow' => true,
                        'roles' => ['pedido/create'],
                    ],
                    [
                        'actions' => ['update', 'detalles'],
                        'allow' => true,
                        'roles' => ['pedido/update'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['pedido/delete'],
                    ],
                    [
                        'actions' => ['list'],
                        'allow' => true,
                        'roles' => ['pedido/list'],
                    ],
                    [
                        'actions' => ['view', 'detalles'],
                        'allow' => true,
                        'roles' => ['pedido/view'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PedidoForm();

        if (Yii::$app->request->isPost) {

            $model->setAttributes(Yii::$app->request->post());

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->pedido->id]);
            }

        }

        $query = Medicamento::find();

        $searchModel = new MedicamentoSearch();
//        $medicamentosDataProvider = $searchModel->search([]);
        $medicamentosDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3
            ]
        ]);

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'medicamentosDataProvider' => $medicamentosDataProvider,
        ]);
    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        $pedido = Pedido::findOne(['id'=>id]);
//
//        if($pedido->estado !== Pedido::RECHAZADO) {
//
//        }

        $model = new PedidoForm(['id'=>$id]);

        if (Yii::$app->request->isPost) {

            $model->setAttributes(Yii::$app->request->post());

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->pedido->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetalles() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->get('id');
        $response = array();
        $response['success'] = true;
        $response['data'] = [];
        $response['msg'] = '';
        $response['msg_dev'] = '';

        if(!is_null($id))
        {
            try
            {
                $response['data'] = PedidoDetalle::find()
                    ->select([
                        'medicamento.id as id',
                        'medicamento.nombre as nombre',
                        'medicamento.codigo as codigo',
                        'medicamento.stock as stock',
                        'profile.name as proveedor',
                        'cantidad',
                        ])
                    ->joinWith(['pedido', 'medicamento'])
                    ->innerJoin('profile', 'profile.user_id=medicamento.proveedor_id')
                    ->asArray()
                    ->where(['pedido_id'=>$id])->all();

            }
            catch ( Exception $e)
            {
                $response['success'] = false;
                $response['msg'] = "Ah ocurrido un error al recuperar los medicamentos del pedido.";
                $response['msg_dev'] = $e->getMessage();
                $response['data'] = [];
            }
        }

        return $response;
    }

    public function actionEliminarDetalle() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->get('id');
        $medicamentoId = Yii::$app->request->get('medicamentoId');
        $response = array();
        $response['success'] = true;
        $response['data'] = [];
        $response['msg'] = '';
        $response['msg_dev'] = '';

        if(!is_null($id))
        {
            try
            {
                $detalle = PedidoDetalle::find()
                    ->where(['pedido_id'=>$id,
                    'medicamento_id' => $medicamentoId])->one();

                if($detalle == null)
                {
                    $response['success'] = false;
                    $response['msg'] = 'No es posible eliminar el detalle';
                }

                $transaction  = Yii::$app->db->beginTransaction();

                $medicamento = $detalle->medicamento;

                $medicamento->stock += $detalle->cantidad;

                if($detalle->delete() !== false && $medicamento->save()) {
                }
            }
            catch ( \Exception $e)
            {
                $response['success'] = false;
                $response['msg'] = "Ah ocurrido un error al recuperar el stock del medicamento.";
                $response['msg_dev'] = $e->getMessage();
                $response['data'] = [];
            }
        }

        return $response;
    }
}
