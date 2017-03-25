<?php

use yii\grid\GridView;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = '后台';

?>
<?php echo Html::a('添加人物',['people/add'],['class'=>'btn']);?>

<?php 
echo GridView::widget([
		'dataProvider'=>$dataProvider,
		'columns'=>[
			'id',
			'name',
			['attribute'=>'addtime','format'=>['date','php:Y-m-d H:i:s']],
			[
				'class' => 'yii\grid\ActionColumn',
				'header'=>'操作',
				'template' => '{update} {delete} {detail} {surplus}',
				'buttons' => [
					'detail' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>', $url, ['title' => '添加详情']);
					},
					'surplus' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>', $url, ['title' => '库存变化记录']);
					},
				]
			],
		],
	]);
?>