<?php

namespace app\controllers;

use Yii;
use app\models\Employe;
use app\models\EmployeHistory;
use app\models\EmployeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeController implements the CRUD actions for Employe model.
 */
class EmployeController extends Controller
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
        ];
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

    public function actionEmployeOne($id)
    {
        $user = Yii::$app->user->identity;
        $employe = Employe::find()->where(['user_id'=>$id])->all();

        $model = new Employe();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Employee created successfully.");
            } else {
                Yii::$app->session->setFlash('error', "Employee not saved.");
                return $this->render('employe-one', [
                    'employe' => false,
                    'model' => $model,
                    'user' => $user,
                ]);
            }
        }

        if (!empty($employe)) {
            return $this->render('employe-one', [
                'employe' => $employe,
                'model' => $model,
                'user' => $user,
            ]);
        } else {
            return $this->render('employe-one', [
                'employe' => false,
                'model' => $model,
                'user' => $user,
            ]);
        }
        
    }

    public function actionEmployeStatusData()
    {
        $id  = Yii::$app->request->get('id');
        $employe = Employe::findOne($id);
        if (!empty($employe)) {
            $employe_history = EmployeHistory::find()->where(['employe_id' => $employe->id])->andwhere(['employe_status_id' => 3])
            ->one();

            if (!empty($employe_history)) {
                $data = [
                    'status' => $employe_history->status->name,
                    'diadline' => date('Y-m-d', $employe_history->diadline_time),
                    'comment' => $employe_history->comment,
                    'created' => date('Y-m-d H:i:s', $employe_history->create_at)
                ];

                return json_encode($data);
            } else {
                return 'no-satus';
            }
            
        } else {
            return 'no-employe';
        }
        
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

    public function actionEmployeDiadline()
    {
        $history = EmployeHistory::find()
            ->orderBy([
                'create_at' => SORT_DESC
            ])
            ->all();

        return $this->render('employe-diadline', [
            'history' => $history,
        ]);             
    }

    /**
     * Creates a new Employe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = Yii::$app->user->identity;
        $model = new Employe();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Employee created successfully.");
            } else {
                Yii::$app->session->setFlash('error', "Employee not saved.");
                return $this->render('create', [
                    'model' => $model,
                    'user' => $user,
                ]);
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
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
        $user = Yii::$app->user->identity;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Employee update successfully.");
            } else {
                Yii::$app->session->setFlash('error', "Employee not saved.");
                return $this->render('update', [
                    'model' => $model,
                    'user' => $user,
                ]);
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionStatus()
    {
        $user = Yii::$app->user->identity;
        $request = Yii::$app->request;
        $post = $request->post();
        $employe_history = new EmployeHistory();
        $post_employe = $post['Employe'];
        $post_employe_history = $post['EmployeHistory'];


        $employe = Employe::findOne($post_employe['id']);
        if (!empty($employe) && $employe->load($post)) {
            $employe->employe_status_id = $post_employe['status_id'];
            if ($employe->save()) {
                if ($employe_history->load($post)) {
                    $employe_history->employe_id = $employe->id;
                    $employe_history->employe_status_id = $employe->employe_status_id;
                    $employe_history->comment = $post_employe_history['comment'];
                    $employe_history->diadline_time = $post_employe_history['diadline_time']?strtotime($post_employe_history['diadline_time']):time();
                    $employe_history->create_at = time();
                    $employe_history->user_id = $user->getId();
                    if ($employe_history->save()) {
                     Yii::$app->session->setFlash('success', "Employee history successfully.");
                    } else {
                        Yii::$app->session->setFlash('error', "Employee history not saved");
                    }
                    
                } else {
                    Yii::$app->session->setFlash('error', "Employee history not saved");
                }
                
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
