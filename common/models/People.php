<?php

namespace common\models;

use yii\db\ActiveRecord;

class People extends ActiveRecord{

	public static function tableName(){
		return 'people';
	}

	public static function getListByPeopleID($peopleID){
		$connection = \Yii::$app->db;
		$command = $connection->createCommand('SELECT d.*,p.`name` FROM people AS p LEFT JOIN detail AS d ON d.name_id = p.id WHERE p.id ='.$peopleID);
		$list = $command->queryAll();
		return $list;
	}

}