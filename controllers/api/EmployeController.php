<?php

namespace app\controllers\api;

use Yii;
use app\models\Employe;
use app\models\EmployeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * EmployeController implements the CRUD actions for Employe model.
 */
class EmployeController extends Controller
{
    public function init()
    {
        Yii::$app->response->format=Response::FORMAT_JSON;;
        parent::init();
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'employe-list' => ['GET'],
                    'employe-create'=>['post'],
                    'employe-update'=>['PUT'],
                    'employe-delete' => ['GET'],
                ],
            ],
        ];
    }

    public function actionEmployeAdd()
    {
        $model = new Employe();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
               return $this->responsePost($model);
            } else {
                return $this->responsePost($model->getErrors());
            }
        }
        return $this->responsePost($model);
    }

    public function actionEmployeInterview()
    {

    }

    public function actionEmployeUpdate($id = false)
    {
        $request = Yii::$app->request;
        $params = $request->bodyParams;
        $employe = Employe::findOne($id);

        if ($employe->load($params, '')) {

            if ($employe->save()) {
                return $this->responsePost($employe);
            } else {
               return $this->responsePost($employe->getErrors());
            }
            
        } else {
            return $this->responsePost($employe);
        }
        return $this->responsePost([]);
    }

    public function actionEmployeDelete($id = false)
    {
        $request = Yii::$app->request;
        $get = $request->get();
        if (!empty($get) && $id) {
            $employe = Employe::findOne($id);
            if (isset($employe) && $employe->delete()) {
               return $this->responseGet($employe);
            } else {
               return $this->responseGet($employe->getErrors());
            }
            
        } else {
            return $this->responseGet([]);
        }
    }

    public function actionEmployeList($id = false)
    {
        $request = Yii::$app->request;
        $get = $request->get();
        if (!empty($get) && $id) {
            $employe = Employe::findOne($id);
            if (isset($employe)) {
               return $this->responseGet($employe);
            } else {
               return $this->responseGet($employe);
            }
            
        } else {
            return $this->responseGet([]);
        }
    }


    public function responseGet($res)
    {
        switch (true){
            case empty($res): return ['code'=>1, 'message'=>'Not Found', 'employe'=>$res];
                break;
            case !isset($res): return ['code'=>2, 'message'=>'Error'];
                break;
            default: return ['code'=>0, 'message'=>'Success', 'employe'=>$res];
                break;
        }
    }

    public function responsePost($res)
    {
        var_dump($res);die();

        switch (true){
            case empty($res): return ['code'=>1, 'message'=>'Not Found', 'employe'=>$res];
                break;
            case !isset($res): return ['code'=>2, 'message'=>'Error'];
                break;
            default: return ['code'=>0, 'message'=>'Success', 'employe'=>$res];
                break;
        }
    }

    /**
     * Lists all Employe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeSearch();
        $query = Employe::find()
            ->orderBy([
                'created' => SORT_DESC
            ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employe model.
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
     * Creates a new Employe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employe();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Employee created successfully.");
            } else {
                Yii::$app->session->setFlash('error', "Employee not saved.");
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Employee update successfully.");
            } else {
                Yii::$app->session->setFlash('error', "Employee not saved.");
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionStatus()
    {
        $request = Yii::$app->request;
        $post = $request->post();

        $employe = Employe::findOne($post['Employe']['id']);

        if (!empty($employe) && $employe->load($post)) {
            $employe->employe_status_id = $post['Employe']['status_id'];
            if ($employe->save()) {
                Yii::$app->session->setFlash('success', "Employee status update successfully.");
            } else {
                Yii::$app->session->setFlash('error', "Employee status update not saved");
            }
            
        } else {
            Yii::$app->session->setFlash('error', "Employee not found");
            return $this->redirect(['index']);
        }
        return $this->redirect(['index']);        

    }

    /**
     * Deletes an existing Employe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', "Employee detele successfully.");
        } else {
            Yii::$app->session->setFlash('error', "Employee not delete.");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employe::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
