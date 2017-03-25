<?php

use yii\grid\GridView;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = '后台';

?>
<?php echo Html::a('人物列表',['people/index'],['class'=>'btn']);?>
<?php echo Html::a('添加详情',['detail/add?id='.$id],['class'=>'btn']);?>

<?php 
echo GridView::widget([
		'dataProvider'=>$dataProvider,
		'columns'=>[
			'id',
			'pid',
			'name',
			['attribute'=>'date','format'=>['date','php:Y-m-d H:i:s']],
			'content',
			[
				'class' => 'yii\grid\ActionColumn',
				'header'=>'操作',
				'template' => '{update} {delete} {detail} ',
				'buttons' => [
					'detail' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>', $url, ['title' => '添加详情']);
					},
				]
			],
		],
	]);
?>