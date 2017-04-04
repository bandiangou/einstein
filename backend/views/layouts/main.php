<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\models\Menu;

AppAsset::register($this);
$menus = Menu::getMenu();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="sidebar">
        <div class="logo">
            <a href="#"><img src="img/logo.png"></a>
        </div>


        <div class="menu-wrap">
            <ul class="menu">
                <?php foreach($menus as $k=>$menu){?>
                    <li>
                        <a href="<?php echo $menu['url']?>"><i class="icon <?php echo $menu['icon_style'];?>"></i><span><?php echo $menu['name'];?></span></a>
                        <?php if(isset($menu['_child'])){?>
                            <ul class="submenu">
                                <?php foreach($menu['_child'] as $k1=>$submenu){ ?>
                                    <?php $current = explode('/',$submenu['url']); ?>
                                    <li class="<?php echo (Yii::$app->controller->id == $current[0]) ? 'active' : ''?>">
                                        <a href="<?php echo $submenu['url']?>">
                                            <?php echo $submenu['name']?>
                                        </a>
                                    </li>
                                <?php }?>
                            </ul>
                        <?php }?>
                    </li>
                <?php }?>
            </ul>
        </div>

    </div>

    <div class="right">
        <div class="top">
            <div class="avatar">
                <a href="#"><img src="img/user-avatar.png"></a>
                <ul>
                    <li><a href="#">个人设置</a></li>
                    <li><a href="#">退出</a></li>
                </ul>
            </div>
        </div>
        <div class="navigation">
            <a href="">首页</a>|<a href="#">管理首页</a>|<a href="#">添加管理员</a>|<a href="#">角色</a>
        </div>
        <div class="content">
            <div class="warp"> <?= $content ?></div>
        </div>
    </div>

</div>


<?php $this->endBody() ?>
<script src="js/main.js"></script>
</body>
</html>
<?php $this->endPage() ?>
