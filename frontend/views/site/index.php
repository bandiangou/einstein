<?php

/* @var $this yii\web\View */

$this->title = '时光';
?>
<div class="site-index">
<style type="text/css" href="index.css"></style>
    <h5><?php echo $lists[0]['name']?></h5>
<ul>
    <?php
    foreach($lists as $k=>$v){
?>
        <li>
            <span class="date"><?php echo date('Y-m-d H:i:s',$v['date'])?></span>
            <span class="content"><?php echo $v['content']?></span>
        </li>

    <?php end_foreach;}?>

</ul>
</div>
