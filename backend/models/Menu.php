<?php
/**
 * Created by PhpStorm.
 * User: jackdeng
 * Date: 3/24 0024
 * Time: 16:12
 */

namespace backend\models;

use yii\db\ActiveRecord;
use common\libs\Tree;

class Menu extends ActiveRecord{

    const DISPLAY = 1;
    const HIDE = 0;

    public static function tableName()
    {
        return '{{%menu}}';
    }

    public static $displays = [
        self::DISPLAY => '显示',
        self::HIDE => '隐藏'
    ];

    public static $displayStyles = [
        self::HIDE => 'label-warning',
        self::DISPLAY => 'label-info',
    ];

    public function __construct(){
        $this->display = self::DISPLAY;
    }

    public function rules(){
        return [
            [['pid','display','sort'],'integer'],
            [['name','icon_style'],'string','max'=>50],
            [['url'],'string','max'=>60],
        ];
    }

    public static function getMenu(){
        $menus = static::find()->where(['display'=>1])->asArray()->all();
        $treeObj = new Tree($menus);
        return $treeObj->getMenuTree();
    }



}