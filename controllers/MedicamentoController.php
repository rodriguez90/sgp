<?php

namespace app\controllers;

use Yii;
use app\models\Medicamento;
use app\models\MedicamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\User\Filter\AccessRuleFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * MedicamentoController implements the CRUD actions for Medicamento model.
 */
class MedicamentoController extends Controller
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
                    'stock' => ['GET']
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
                        'roles' => ['medicamento/index'],
                    ],
                    [
                        'actions' => ['create',],
                        'allow' => true,
                        'roles' => ['medicamento/create'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['medicamento/update'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['medicamento/delete'],
                    ],
                    [
                        'actions' => ['list', 'stock'],
                        'allow' => true,
                        'roles' => ['medicamento/index'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['medicamento/view'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Medicamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medicamento model.
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
     * Creates a new Medicamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medicamento();

        if(Yii::$app->request->isPost)
        {
            $ficheros = UploadedFile::getInstances($model, 'imagen');

            if ($model->load(Yii::$app->request->post())) {

                if($model->save())
                {
                    if(count($ficheros)) {
                        $nombreImagen = 'medicamento-images/' . $ficheros[0]->baseName . '_'. $model->id . '.' . $ficheros[0]->extension;
                        if($ficheros[0]->saveAs($nombreImagen)) {
                            $model->imagen = $nombreImagen;
                            $model->save();
                        }
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Medicamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost)
        {
            if($model->load(Yii::$app->request->post())) {
                $ficheros = UploadedFile::getInstances($model, 'imagen');
                if(count($ficheros)) {
                    $nombreImagen = 'medicamento-images/' . $ficheros[0]->baseName . $model->id . '.' . $ficheros[0]->extension;
                    $nombreImagenTmp = $nombreImagen;
                    if($ficheros[0]->saveAs($nombreImagen)) {
                        $model->imagen = $nombreImagenTmp;
                    }
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Medicamento model.
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
     * Finds the Medicamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Medicamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medicamento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*
     * Retorna el stock del medicamento
     */
    public function actionStock() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->get('id');
        $cantidad = Yii::$app->request->get('cantidad');
        $response = array();
        $response['success'] = true;
        $response['data'] = [];
        $response['msg'] = '';
        $response['msg_dev'] = '';

        if(!is_null($id) && !is_null($cantidad))
        {
            try
            {
                 $medicamento = Medicamento::findOne(['id'=>$id]);
                $medicamentoData = [
                    'id' => $medicamento->id,
                    'nombre' => $medicamento->nombre,
                    'codigo' => $medicamento->codigo,
                    'stock' => $medicamento->stock,
                    'proveedor' => $medicamento->getNombreProveedor(),
                    'cantidad' => $cantidad,
                ];

                 if($medicamento && $medicamento->stock === 0 ) {
                     $response['success'] = false;
                     $response['msg'] = 'El medicamento esta agotado.';
                 }
                 elseif ($medicamento && $medicamento->stock < $cantidad) {
                     $response['success'] = false;
                     $response['msg'] = 'La cantidad solicidata es mayor que la q tenemos en Stock.';
                 }
                 else {
                     $response['data'] = $medicamentoData;
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
