<?php
/**
 * Created by PhpStorm.
 * User: underwood
 * Date: 2017-3-26
 * Time: 10:19 PM
 */

namespace backend\controllers;

use yii\web\Controller;

class IndexController extends Controller{

    public function actionIndex(){
        return $this->render('index');
    }

}