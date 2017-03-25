
<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '后台';
?>
<div class="site-index">
	
	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'add-form']);?>
				<?php echo $model->name;?>
				<?php echo $form->field($model,'content')?>
				<div><?php echo Html::submitButton('add',['class'=>'btn btn-primary','name'=>'add-button'])?></div>
			<?php ActiveForm::end();?>
		</div>
	</div>
    
</div>
