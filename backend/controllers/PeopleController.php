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
class PeopleController extends Controller
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
                        'actions' => ['login', 'error','add','delete','update','detail'],
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
        $dataProvider = new SqlDataProvider(['sql'=>$sql,'key'=>'id','pagination'=>['pagesize'=>20]]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    public function actionDetail($id)
    {
        $sql = "SELECT d.*,p.`name` FROM people AS p LEFT JOIN detail AS d ON d.pid = p.id WHERE d.pid = $id";
    	$dataProvider = new SqlDataProvider(['sql'=>$sql,'key'=>'id','pagination'=>['pagesize'=>20]]);

        return $this->render('detail',['dataProvider'=>$dataProvider,'id'=>$id]);
    }

    /**
     * @return string|\yii\web\Response
     * 添加人物
     */
    public function actionAdd(){

        $model = new AddPeopleForm();

        if($model->load(Yii::$app->request->post()) && $model->add()){
            Yii::$app->session->setFlash('添加成功');
    		return $this->goBack();
        }

        return $this->render('add',['model'=>$model]);
    }

    public function actionUpdate($id){
        $people = People::findOne($id);

        $people->load(Yii::$app->request->post());
        
        if(Yii::$app->request->isPost && $people->validate()){
            $people->addtime = time();
            if($people->save()){
                Yii::$app->session->setFlash('修改成功');
                $this->redirect('index');
            }else{
                Yii::$app->session->setFlash('修改失败');
            }
        }else{
            Yii::$app->session->setFlash('修改失败');
        }

        return $this->render('addpeople',['model'=>$people]);
    }

    /**
     * 添加详情
     */
    public function actionAdddetail(){
        $model = new AddDetailForm();

        if($model->load(Yii::$app->request->post()) && $model->add()){
            return $this->goBack();
        }

        return $this->render('adddetail',['model'=>$model]);
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
