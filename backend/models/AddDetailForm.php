<?php

namespace backend\models;

use common\models\Detail;
use yii\base\Model;
use common\models\People;


class AddDetailForm extends Model{
	
	public $name;
	public $content;

	public function rules(){
		return [
			[['content'],'required']
			
		];
	}
	
	public function add($pid){
		if($this->validate()){
			$detail = new Detail();
			$detail->pid = $pid;
			$detail->content = $this->content;
			$detail->date = time();
			if($detail->save()){
				return $detail;
			} 
		}
		
		return null;
	}
	
}