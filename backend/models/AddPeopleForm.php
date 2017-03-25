<?php

namespace backend\models;

use yii\base\Model;
use common\models\People;


class AddPeopleForm extends Model{
	
	public $name;

	public function rules(){
		return [
			[['name'],'required']
			
		];
	}
	
	public function add(){
		if($this->validate()){
			$pepole = new People();
			$pepole->name = $this->name;
			$pepole->addtime = time();
			if($pepole->save()){
				return $pepole;
			} 
		}
		
		return null;
	}
	
}