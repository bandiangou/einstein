<?php
namespace backend\controllers;

use backend\models\AddPeopleForm;
use common\models\Detail;
use yii\data\SqlDataProvider;
use yii\grid\GridView;

use common\models\People;

use yii\data\ActiveDataProvider;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\AddDetailForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class DetailController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','add','update','delete'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(){
        $sql = 'select * from people';
        $dataProvider = new SqlDataProvider(['sql'=>$sql,'pagination'=>['pagesize'=>20]]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    public function actionDetaillist()
    {

        $model = new Detail();
        $list = $model->getList();
        $sql = 'SELECT d.*,p.`name` FROM people AS p LEFT JOIN detail AS d ON d.name_id = p.id';
    	$dataProvider = new SqlDataProvider(['sql'=>$sql,'pagination'=>['pagesize'=>20]]);

        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    /**
     * 添加详情
     */
    public function actionAdd($id){
        $model = new AddDetailForm();

        if($model->load(Yii::$app->request->post()) && $model->add($id)){
            return $this->redirect(['people/detail?id='.$id]);
        }

        $people = new People();
        $info = $people->findOne($id);
        $model->name = $info->name;

        return $this->render('add',['model'=>$model]);
    }
    
    public function actionDelete($id){
    	$model = new People();
    	if($model->findOne($id)->delete()){
    		$this->redirect(['index']);
    	}
    }
    

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    
}
